<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends DIP_Controller_Golfclub {

	protected $parent_id;

	public function index(){
		
			$nu = new User();
			$userdata = $nu->get_by_id($this->data['user']['id']);
			if($userdata->type==1)
				$nh = new Golfgroup();
			elseif($userdata->type==2)
				$nh = new Golfclub();
			else
				$nh = new Partner();					
			$nh->where(array('user_id' => $this->data['user']['id']))->get();
			$query = $this->db->query("SELECT * from dip_languages WHERE id =".$nh->default_language); 
			$data = $query->result();
			/*$this->config->set_item('language', strtolower($data[0]->name));
			$this->lang->load('message',strtolower($data[0]->name));*/
			//echo FCPATH."application/language/".strtolower($data[0]->name);
			if(is_dir(FCPATH."application/language/".strtolower($data[0]->name)))
			{
				//echo "in";
				$this->config->set_item('language', strtolower($data[0]->name));
				$this->lang->load('message',strtolower($data[0]->name));
			}
			else
			{
				//echo "out";
				$this->config->set_item('language','english');
				$this->lang->load('message','english');
			}
		
		$this->data['page'] = array(
			'title' =>$this->lang->line('ManageNews') ,
			'slug' => 'news',
			'nav' => 'news',
			'desc' =>$this->lang->line('AllNews') ,
			'main' => '_layout_backend',
			'subview' => 'golfclub/news/news',
			'foot' => 'golfclub/news/news_foot'
		);
		$this->load->view('_layout_main',$this->data);
		// show($this->data);
	}
	public function get_news(){
		$this->jqgrid->from('dip_newzs');
		$this->jqgrid->select('id, user_id, title, subtitle, descr, pubdate, status,updated');
		$this->jqgrid->searchable('title, subtitle, descr');
		$this->jqgrid->where('user_id='.$this->data['user']['id']);
		echo escape_quote($this->jqgrid->get_result('json'));
	}

	public function edit($id=null){
		$this->load->model('news_m');
		$this->data['row'] = $this->news_m->get_details($this->data['user']['id'],$id);
		!$id || !empty($this->data['row']->id) || redirect(site_full_url('golfclub/news/edit'));

		if($this->input->post()){
		 	$rules =array();
		 	foreach ($this->data['client']->languages as $key => $value) {
		 		$required_if = $this->input->post('desc')[$value] ? '|required' : '' ;
		 		$rules['title['.$value.']'] = array(
						'field'=>'title['.$value.']',
						'label'=>'Title for '.$this->data['langs'][$value],
						'rules'=>'xss_clean'.$required_if
				);
				$rules['subtitle['.$value.']'] = array(
						'field'=>'subtitle['.$value.']',
						'label'=>'Subtitle for '.$this->data['langs'][$value],
						'rules'=>'xss_clean'
				);
				$rules['descr['.$value.']'] = array(
						'field'=>'descr['.$value.']',
						'label'=>'Description for '.$this->data['langs'][$value],
						'rules'=>'xss_clean'
				);
				$rules['push['.$value.']'] = array(
						'field'=>'push['.$value.']',
						'label'=>'Push Notification Title for '.$this->data['langs'][$value],
						'rules'=>'xss_clean'
				);
		 	}
			
			$nu = new User();
			$userdata = $nu->get_by_id($this->data['user']['id']);
			if($userdata->type==1)
				$nh = new Golfgroup();
			elseif($userdata->type==2)
				$nh = new Golfclub();
			else
				$nh = new Partner();					
			$nh->where(array('user_id' => $this->data['user']['id']))->get();
			$query = $this->db->query("SELECT * from dip_languages WHERE id =".$nh->default_language); 
			$data = $query->result();
			/*$this->config->set_item('language', strtolower($data[0]->name));
			$this->lang->load('message',strtolower($data[0]->name));*/
			if(is_dir(FCPATH."application/language/".strtolower($data[0]->name)))
			{
				$this->config->set_item('language', strtolower($data[0]->name));
				$this->lang->load('message',strtolower($data[0]->name));
			}
			else
			{
				$this->config->set_item('language','english');
				$this->lang->load('message','english');
			}
			
		 	$this->form_validation->set_rules($rules);
		 	if ($this->form_validation->run() == TRUE){
		 		// saved post data
				$post = $this->input->post();
				$today = date('Y-m-d');
				if(!empty($this->data['client']->city) && !empty($this->data['client']->country)){
					$today = get_timee($this->data['client']->city,$this->data['client']->country);
				}
				$pkg = $this->news_m->save($post,$this->data['user']['id'],$id,$today);

				//if saved successfully save notification
				if($pkg->id && !isset($post['draft'])){
					$usid = $this->data['user']['id'];

					// remember pem filename
					$this->parent_id = $this->data['user']['id'];
					$push = array(
						'sid' => $usid,
						'sname' => $this->data['user']['name'],
						'post_id' => $pkg->id,
						'post_type' => 'News'
					);
					//languages in that have title
					$arrayLang = array();
					$pkg->title = decode_data($pkg->title);
					foreach ($pkg->title as $key => $value) {
						if(!empty($value))
							$arrayLang[] = $key;
					}

					// send notification message if given
					$total_push = $this->data['client']->push_notification;
					$used_push = $this->data['client']->push_counter;
					if(isset($post['push']) && ($total_push > $used_push)){

						//now send push notification
						$apn_config = array('PermissionFile'=>$this->parent_id);
						$this->load->library('gcm');
						//load apn with dynamic PermissionFile setting
						$this->load->library('apn', $apn_config);
						$this->apn->payloadMethod = 'enhance';

						$counter = false;
						foreach ($post['push'] as $lang_id => $value) {

							//send notification for this lang_id
							if(!empty($value) && !empty($pkg->title[$lang_id])){

								//get recipent from the table who have this client
								$recipent = new Regid();
								$recipent->where(array('user_id'=>$usid,'language_id'=>$lang_id))->get();

								// send push if recipent exits
								if($recipent->exists()){
									$msgIos = $push;
									$msgAndroid = array(
										'package' => $push['post_id'],
										'name' => $push['sname'],
										'partnerId' => $push['sid'],
										'page' => $push['post_type'],
										'sid' => $push['sid'],
										'title' => $value,

									);


									// create Notification and save with device relations
									$noti = new Notification();
									$noti->where(array('post_id'=>$push['post_id'],
										'post_type'=>$push['post_type'],'language_id'=>$lang_id))->get();
									$noti->post_id = $push['post_id'];
									$noti->post_type = $push['post_type'];
									$noti->user_id = $usid;
									$noti->language_id = $lang_id;
									$noti->title = $value;

									$rpending = new Regid();
									$rpending->select('id');
									$rpending->where(array('user_id'=>$usid,'language_id'=>$lang_id));
									// if notification already sent
									if($noti->exists()){
										// device who have this notification pending
										$q = $this->db->query('select * from dip_join_notifications_regids where notification_id ='.$noti->id);
										//update push count for those who does not have any pending
										if ($q->num_rows() > 0){
											$pending=array();
											foreach ($q->result() as $row)
												$pending[] = $row->regid_id;
											if(!empty($pending))
												$rpending->where_not_in('id',$pending);
										}
									}
									$rpending->update('push_count', 'push_count + 1',FALSE);
									// now create pending notificaton for all
									$noti->save($recipent->all);

									// push notification server api call
									$this->apn->connectToPush();
									foreach($recipent as $recp){
										// send notification according to the devce type
										if($recp->os == 'ios'){
											if(isset($pending) && !empty($pending)){
												if(!in_array($recp->id, $pending))
													$recp->push_count = $recp->push_count + 1;
											}else{
												$recp->push_count = $recp->push_count + 1;
											}
											$this->apn->setData($msgIos);
											$my_send_message = $this->apn->sendMessage($recp->token,$value,$recp->push_count); // aditional data
											if($my_send_message)
											{
												log_message('debug','Sent successfully, yepp');
											}
											else
											{
												log_message('error', 'Not sent: '.$this->apn->error);
											}

										}else{
											$this->gcm->addRecepient($recp->token);
										}
									}
									$this->apn->disconnectPush();
									$this->gcm->setMessage($msgAndroid);
									$this->gcm->send();
									// message send done
									$this->gcm->clearRecepients();
									$counter = true;
								}else{
									$this->session->set_flashdata('error_msg', 'No recipents found for Push notification');
								}

							}
						}
						if($counter==true){
							// show($counter);
							$hotel = new Golfclub();
							$hotel->where('user_id',$this->data['user']['id'])->update('push_counter','push_counter + 1', FALSE);
						}
					}
				}

				//success message
				!$id ||redirect(site_full_url('golfclub/news'));
				$this->session->set_flashdata('success_msg', $this->lang->line('message_save_success'));
				redirect(site_full_url('golfclub/news'));
		 	}
		}

		$this->data['page'] = array(
			'title' => $this->lang->line('ManageNews'),
			'slug' => 'news',
			'nav' => 'news',
			'desc' => ($id?$this->lang->line('EditNews'):$this->lang->line('AddNewNews')),
			'main' => '_layout_backend',
			'subview' => 'golfclub/news/news_edit'
		);
		$this->load->view('_layout_main',$this->data);
		// show($this->data);
	}

	public function delete(){
		$this->load->model('news_m');
		echo $this->news_m->delete($this->data['user']['id'],$this->input->post('id'));
	}
}
