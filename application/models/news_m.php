<?php
class News_m extends DIP_Model{

	function __construct(){
		parent::__construct();
	}

	// courses
	public function get_details($pid,$id=null){
		$u = new Newz();
		$u->where(array('id'=>$id,'user_id'=>$pid))->get();
		$u->stored->title = decode_data($u->title);
		$u->stored->subtitle = decode_data($u->subtitle);
		$u->stored->descr = decode_data($u->descr);
		$u->stored->pics = decode_data($u->pics);
		return $u->stored;
	}
	public function save($post,$pid,$id=null,$today){
		$r = new Newz();
		if($id){
			$r->get_by_id($id);
		}else{
			$r->user_id = $pid;
		}

		$r->title = encode_data($post['title']);
		$r->subtitle = encode_data($post['subtitle']);
		$r->descr = encode_data($post['descr']);

		$r->pubdate = $today;
		
		if(isset($post['draft']))
			$r->status = 0;
		else
			$r->status = 1;

		// return $r;
		$success = $r->save();
		if(! $success)
		{
			$this->session->set_flashdata('error_msg', 'Sorry! Data is not saved');
			redirect(current_full_url());
		}else{
			if(isset($post['previmage']) || isset($post['thumb'])){
				isset($post['previmage'])||$post['previmage']=null;
				isset($post['thumb'])||$post['thumb']=null;
				//if record saved is done i.e, record exists with an id
				$dzid = $r->id;
				// get the record to change the image field
				$last = new Newz();
				$last->where('id',$dzid)->get();
				
				$upload_url = 'uploads/'.$this->data['user']['id'].'/news/'.$dzid.'/';
				$last->pics = get_uploaded_image_list($upload_url,$last->stored->pics,$post['previmage'],$post['thumb']);
				
				$last->save();
			}
			//this will proceed to pushnotification
			return $r->stored;

			// !$id ||redirect(site_full_url('golfclub/courses'));
			// $this->session->set_flashdata('success_msg', 'The Restaurant or Bar is saved successfully');
			// redirect(site_full_url('partner/hotel_packages/edit/'.$r->id));
		}
	}
	public function delete($pid,$id){	
		
		$r = new Newz();
		$r->where(array('id'=>$id,'user_id'=>$pid))->get();
		if($r->exists()){			
			$noti = new Notification();
			//$noti->where(array('post_id'=>$r->id,'post_type'=>'Newz'))->get();
			$noti->where(array('post_id'=>$r->id))->get();
			$query = $this->db->query("SELECT * from dip_notifications WHERE post_id =".$r->id); 
   			$data = $query->result();
			
			//echo $r->id.','.$pid.",".$id;	
					//print_r($data);
					//die;
					
			foreach($data as $key => $value)
			{
				$this->db->where('notification_id', $value->id);
				
				$query = $this->db->query("SELECT * from dip_join_notifications_regids WHERE notification_id =".$value->id); 
   				$data_dip_join_notifications_regids = $query->result();
				//echo $r->id.','.$pid.",".$id;	
				//print_r($data_dip_join_notifications_regids);
				//die;
				foreach($data_dip_join_notifications_regids as $key => $value_1)
				{		
					$regid = new Regid();
					//$regid->where(array('user_id'=>$pid,'language_id'=>$value->language_id))->get();
					$regid->where(array('id'=>$value_1->regid_id))->get();
					$regid->update_all('push_count','push_count - 1',false);
				
				}				
				$this->db->delete('dip_join_notifications_regids');		 		
			}
			$this->db->where('post_id', $r->id);
			$this->db->delete('dip_notifications');				
			$noti->delete();			
			$upload_url = 'uploads/'.$pid.'/news/'.$id;
			if (is_dir($upload_url))
			{
				deleteFolder($upload_url);
			}
			$r->delete();
			return TRUE;
		}
		else 
		{
			return FALSE;
		}
	}
}