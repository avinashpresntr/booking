<?php
class Package_m extends DIP_Model{

	function __construct(){
		parent::__construct();
	}

	// courses
	public function get_package($pid,$id=null){
		$u = new Package();
		$u->where(array('id'=>$id,'user_id'=>$pid))->get();
		$u->stored->title = decode_data($u->title);
		$u->stored->subtitle = decode_data($u->subtitle);
		$u->stored->descr = decode_data($u->descr);
		return $u->stored;
	}
	public function save_package($post,$pid,$id=null){
		$r = new Package();
		if($id){
			$r->get_by_id($id);
		}else{
			$r->user_id = $pid;

			$or = new Package();
			$or->where(array('user_id'=>$pid))->update('position' ,'position + 1', FALSE);

			$r->position = 1;
		}

		$r->title = encode_data($post['title']);
		$r->subtitle = encode_data($post['subtitle']);
		$r->descr = encode_data($post['descr']);
		
		$r->pubdate = date('Y-m-d');
		
		if(isset($post['draft']))
			$r->status = 0;
		else
			$r->status = 1;

		// return $r;
		$success = $r->save();
		if(! $success){
			$this->session->set_flashdata('error_msg', 'Sorry! Data is not saved');
			redirect(current_full_url());
		}else{
			//this will proceed to pushnotification
			return $r->stored;
			// !$id ||redirect(site_full_url('golfclub/courses'));
			// $this->session->set_flashdata('success_msg', 'The Restaurant or Bar is saved successfully');
			// redirect(site_full_url('partner/hotel_packages/edit/'.$r->id));
		}
	}
	public function delete_package($pid,$id){
		
		$r = new Package();
		$r->where(array('id'=>$id,'user_id'=>$pid))->get();
		if($r->exists()){
			
			$nu = new User();
			$nu->get_by_id($pid);			
			$noti = new Notification();
			$noti->where(array('post_id'=>$r->id))->get();
			$query = $this->db->query("SELECT * from dip_notifications WHERE post_id =".$r->id); 
   			$data = $query->result();			
			foreach($data as $key => $value)
			{
				$this->db->where('notification_id', $value->id);
				
				$query = $this->db->query("SELECT * from dip_join_notifications_regids WHERE notification_id =".$value->id); 
   				$data_dip_join_notifications_regids = $query->result();
				foreach($data_dip_join_notifications_regids as $key => $value_1)
				{		
					$regid = new Regid();
					//$regid->where(array('user_id'=>$pid,'language_id'=>$value->language_id))->get();
					$regid->where(array('id'=>$value_1->regid_id))->get();
					$regid->update_all('push_count','push_count - 1',false);				
				}				
				$this->db->delete('dip_join_notifications_regids');				
				/*
				$regid = new Regid();
				$regid->where(array('user_id'=>$nu->parrent,'language_id'=>$value->language_id))->get();
				$regid->update_all('push_count','push_count - 1',false);*/
			}
			$this->db->where('post_id', $r->id);
			$this->db->delete('dip_notifications');				
			$noti->delete();
			$r->delete();
			return TRUE;
		}else {
			return FALSE;
		}
	}
	public function position_package($pos,$pid,$id){
		$r = new Package();
		$r->where(array('id'=>$id,'user_id'=>$pid))->get();
		
		//check if the position exists or not
		$ud = new Package();
		$ud->where(array('position'=>$pos,'user_id'=>$pid))->get();
		if($ud->exists()){
			$or = new Package();
			if($pos < $r->position){
				$s = $or->where(array('user_id'=>$pid, 'position >=' => $pos,'position <' => $r->position))
					->update('position' ,'position + 1', FALSE);
			}else{
				$s = $or->where(array('user_id'=>$pid, 'position <=' => $pos,'position >' => $r->position))
					->update('position' ,'position - 1', FALSE);
			}

			$r->position = $pos;
			$success = $r->save();
			if(!$success)
				return false;
			else
				return true;
		}
	}
}