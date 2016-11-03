<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Packages extends DIP_Controller_Partner {

	protected $parent_id;

	public function index(){

		$i_type =$this->lang->line('Packages');
		if($this->data['user']['type']==6)$i_type = $this->lang->line('Suggestions');
		$this->data['page'] = array(
			'title' => $i_type,
			'slug' => 'packages',
			'nav' => 'packages',
			'desc' => $i_type,
			'main' => '_layout_backend',
			'subview' => 'partner/packages',
			'foot' => 'partner/packages_foot'
		);
		$this->load->view('_layout_main',$this->data);
		// show($this->data);
	}
	public function get_packages(){
		$this->jqgrid->from('dip_packages');
		$this->jqgrid->select('id, user_id, title, subtitle, descr, pubdate, status, position');
		$this->jqgrid->searchable('title, subtitle, descr');
		$this->jqgrid->where('user_id='.$this->data['user']['id']);
		echo escape_quote($this->jqgrid->get_result('json'));
	}

	public function edit($id=null){
		$this->load->model('package_m');
		$this->data['row'] = $this->package_m->get_package($this->data['user']['id'],$id);
		!$id || !empty($this->data['row']->id) || redirect(site_full_url('partner/packages/edit'));
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

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run() == TRUE){
				$post = $this->input->post();
				$pkg = $this->package_m->save_package($post,$this->data['user']['id'],$id);


				//if saved successfully save notification
				if($pkg->id && !isset($post['draft'])){
					$usid = $this->data['user']['parrent'];

					//remember pem filename and path
					$this->parent_id = $this->data['user']['parrent'];
					$push = array(
						'sid' => $this->data['user']['id'],
						'sname' => $this->data['user']['name'],
						'post_id' => $pkg->id,
						'post_type' => $this->data['user_types'][$this->data['user']['type']],
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
						$this->load->library('apn',$apn_config);
						$this->apn->payloadMethod = 'enhance';

						$counter = false;
						foreach ($post['push'] as $lang_id => $value) {

							//send notification for this lang_id
							if(!empty($value) && !empty($pkg->title[$lang_id])){


								//get recipent from the table who have this client
								$recipent = new Regid();
								$recipent->where(array('user_id'=>$usid,'language_id'=>$lang_id))->get();

								if($recipent->exists()){
									// show($recipent->all);
									$msgIos = $push;
									$msgAndroid = array(
										'package' => $push['post_id'],
										'name' => $push['sname'],
										'partnerId' => $push['sid'],
										'page' => $push['post_type'],
										'sid' => $push['sid'],
										'title' => $value
									);


									// create Notification and save with device relations
									$noti = new Notification();
									$noti->where(array('post_id'=>$push['post_id'],
										'post_type'=>$push['post_type'],'language_id'=>$lang_id))->get();
									$noti->post_id = $push['post_id'];
									$noti->post_type = $push['post_type'];
									$noti->user_id = $push['sid'];
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
											$this->apn->setData($msgIos); // aditional data
											$this->apn->sendMessage($recp->token,$value,$recp->push_count);

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

							// bring it to top
							$this->package_m->position_package(1,$this->data['user']['id'],$pkg->id);

							// show($counter);
							$hotel = new Partner();
							$hotel->where('user_id',$this->data['user']['id'])->update('push_counter','push_counter + 1', FALSE);
						}
					}
				}
				//success message
				$this->session->set_flashdata('success_msg', 'The Offer has been saved successfully');
				redirect(site_full_url('partner/packages'));
		 	}
		}

		$i_type =$this->lang->line('Packages');
		if($this->data['user']['type']==6)$i_type = $this->lang->line('Suggestions');
		$this->data['page'] = array(
			'title' => $i_type,
			'slug' => 'packages',
			'nav' => 'packages',
			'desc' => ($id?$this->lang->line('Edit'):$this->lang->line('Add')).' '.$i_type,
			'main' => '_layout_backend',
			'subview' => 'partner/packages_edit'
		);
		$this->load->view('_layout_main',$this->data);
		// show($this->data);
	}

	public function delete(){
		$this->load->model('package_m');
		echo $this->package_m->delete_package($this->data['user']['id'],$this->input->post('id'));
	}
	public function position(){
		$this->load->model('package_m');
		echo $this->package_m->position_package($this->input->post('position'),$this->data['user']['id'],$this->input->post('id'));
	}
}
