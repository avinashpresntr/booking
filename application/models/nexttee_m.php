<?php
class Nexttee_m extends DIP_Model{

	public $course_rules = array(
			'holes' =>  array(
					'field'=>'holes',
					'label'=>'Hole',
					'rules'=>'trim|xss_clean|integer|required'
			),
			'par' =>  array(
					'field'=>'par',
					'label'=>'Par',
					'rules'=>'trim|xss_clean|integer|required'
			),
			'length' =>  array(
					'field'=>'length',
					'label'=>'Length',
					'rules'=>'xss_clean|required'
			),
			'range_from' =>  array(
					'field'=>'range_from',
					'label'=>'Green Fee Range From',
					'rules'=>'xss_clean|integer'
			),
			'range_to' =>  array(
					'field'=>'range_to',
					'label'=>'Green Fee Range to',
					'rules'=>'xss_clean|integer'
			),
	);
	public $offer_rules = array(
			'email' =>  array(
					'field'=>'email',
					'label'=>'Offer Email',
					'rules'=>'tream|xss_clean|valid_email'
			),
			'phone' =>  array(
					'field'=>'phone',
					'label'=>'Offer Phone',
					'rules'=>'xss_clean'
			),
			'starting' =>  array(
					'field'=>'starting',
					'label'=>'Offer Starting Date',
					'rules'=>'xss_clean'
			),
			'ending' =>  array(
					'field'=>'ending',
					'label'=>'Offer Ending Date',
					'rules'=>'xss_clean'
			),
	);
	public $reward_rules = array(
			'starting' =>  array(
					'field'=>'starting',
					'label'=>'Reward Starting Date',
					'rules'=>'xss_clean|required'
			),
			'ending' =>  array(
					'field'=>'ending',
					'label'=>'Reward Ending Date',
					'rules'=>'xss_clean|required'
			),
			'points' =>  array(
					'field'=>'points',
					'label'=>'Reward Points',
					'rules'=>'xss_clean|integer|required'
			),
	);
	function __construct(){
		parent::__construct();
	}
	//save details
	public function save_details($post,$pid){
		$g = new Golfclub();
		$g->get_by_user_id($pid);
		$g->descr = encode_data($post['descr']);
		$g->facilities = encode_data(array_values($post['facilities']));
		$success = $g->save();
		if(! $success)
		{
			$this->session->set_flashdata('error_msg', 'Sorry! Data is not saved');
			redirect(current_full_url());
		}else{
			if(isset($post['previmage2']) || isset($post['thumb2'])){
				isset($post['previmage2'])||$post['previmage2']=null;
				isset($post['thumb2'])||$post['thumb2']=null;
				//if record saved is done i.e, record exists with an id
				$dzid = $g->id;
				$upload_url = 'uploads/'.$this->data['user']['id'].'/nt_details/';
				$g->logo = get_uploaded_image_list($upload_url,$g->logo,$post['previmage2'],$post['thumb2']);
				$g->save();
			}
			if(isset($post['previmage']) || isset($post['thumb'])){
				isset($post['previmage'])||$post['previmage']=null;
				isset($post['thumb'])||$post['thumb']=null;
				//if record saved is done i.e, record exists with an id
				$dzid = $g->id;
				$upload_url = 'uploads/'.$this->data['user']['id'].'/nt_details/';
				$g->pics = get_uploaded_image_list($upload_url,$g->pics,$post['previmage'],$post['thumb']);
				$g->save();
			}
			return true;
		}
	}
	// courses
	public function get_course($pid,$id=null){
		$u = new Nt_course();
		$u->where(array('id'=>$id,'user_id'=>$pid))->get();
		$u->stored->name = decode_data($u->name);
		$u->stored->cr = decode_data($u->cr);
		$u->stored->slope = decode_data($u->slope);
		$u->stored->welcome_option2 = decode_data($u->welcome_option2);
		return $u->stored;
	}
	public function save_course($post,$pid,$id=null){
		/*echo "<pre>";
		print_r($post);
		echo "</pre>";
		die();*/
		$r = new Nt_course();
		if($id){
			$r->get_by_id($id);
		}else{
			$r->user_id = $pid;
			//getting the next position
			$rp = new Nt_course();
			$rp->select_max('position');
			$rp->where('user_id',$pid);
			$rp->get();
			$r->position = intval($rp->position) + 1;
		}
		$r->name = encode_data($post['name']);
		$r->holes = $post['holes'];
		$r->par = $post['par'];
		$r->length = $post['length'];
		$r->length_unit = $post['length_unit'];
		//added
		$r->range_from = $post['range_from'];
		if(isset($post['range_to']))
			$r->range_to = $post['range_to'];
		$r->range_currency = $post['range_currency'];
		$r->difficulty = $post['difficulty'];
		$r->welcome_option = $post['welcome_option'];
		if($post['welcome_option']=='Everyday'){
			$r->welcome_option2 = encode_data(array_values($post['welcome_option2']));
		}else{
			$r->welcome_option2 = null;
		}
		$r->open_from = $post['open_from'];
		if(isset($post['open_to']))
			$r->open_to = $post['open_to'];
		$r->handicap_men = $post['handicap_men'];
		$r->handicap_women = $post['handicap_women'];
		
		$r->cr = encode_data(array_values($post['cr']));
		$r->slope = encode_data(array_values($post['slope']));

		// return $r;
		$success = $r->save();
		if(! $success)
		{
			$this->session->set_flashdata('error_msg', 'Sorry! Data is not saved');
			redirect(current_full_url());
		}else{
			return $r->id;
		}
	}
	public function delete_course($pid,$id){
		$r = new Nt_course();
		$r->where(array('id'=>$id,'user_id'=>$pid))->get();
		if($r->exists()){
			$or = new Nt_course();
			$or->where(array('user_id'=>$pid, 'position >' => $r->position))
				->update('position' ,'position - 1', FALSE);
			$r->delete();
			return TRUE;
		}else {
			return FALSE;
		}
	}
	public function position_course($pid,$id,$pos){
		$r = new Nt_course();
		$r->get_by_id($id);
		$or = new Nt_course();
		if($pos < $r->position){
			$or->where(array('user_id'=>$pid, 'position >=' => $pos,'position <' => $r->position))
				->update('position' ,'position + 1', FALSE);
		}else{
			$or->where(array('user_id'=>$pid, 'position <=' => $pos,'position >' => $r->position))
				->update('position' ,'position - 1', FALSE);
		}
		$r->position = $pos;
		$success = $r->save();
		if(!$success)
			return false;
		else
			return true;
	}


	// offers
	public function get_offer($pid,$id=null){
		$u = new Nt_offer();
		$u->where(array('id'=>$id,'user_id'=>$pid))->get();
		$u->stored->title = decode_data($u->title);
		$u->stored->descr = decode_data($u->descr);
		$u->stored->pics = decode_data($u->pics);
		$u->stored->startdate = decode_date($u->startdate);
		$u->stored->enddate = decode_date($u->enddate);
		return $u->stored;
	}
	public function save_offer($post,$pid,$id=null){
		
		//print_r($post);
		//echo $pid."::::::".$id; 
		$r = new Nt_offer();
		if($id){
			$r->get_by_id($id);
		}else{
			$r->user_id = $pid;
			//getting the next position
			$rp = new Nt_offer();
			$rp->select_max('position');
			$rp->where('user_id',$pid);
			$rp->get();
			$r->position = intval($rp->position) + 1;
		}
		$r->title = encode_data($post['title']);
		$r->descr = encode_data($post['descr']);
		$r->startdate = encode_date($post['starting']);
		$r->enddate = encode_date($post['ending']);
		
		//print_r($r);
		// return $r;
		$success = $r->save();
		
		if(! $success)
		{
			//die("aaaa");
			$this->session->set_flashdata('error_msg', 'Sorry! Data is not saved');
			redirect(current_full_url());
		}else{
			//die("bbb");
			if(isset($post['previmage']) || isset($post['thumb']))
			{
				
				isset($post['previmage'])||$post['previmage']=null;
				isset($post['thumb'])||$post['thumb']=null;
				//if record saved is done i.e, record exists with an id
				$dzid = $r->id;
				// get the record to change the image field
				$last = new Nt_course();
				$last->where('id',$dzid)->get();
				
				$upload_url = 'uploads/'.$this->data['user']['id'].'/nt_offers/'.$dzid.'/';
				$last->pics = get_uploaded_image_list($upload_url,$last->stored->pics,$post['previmage'],$post['thumb']);
				
				$last->save();
			}
			return $r->stored;
			// !$id ||redirect(site_full_url('golfclub/nexttee/offers'));
			// $this->session->set_flashdata('success_msg', 'The Offer is saved successfully');
			// redirect(site_full_url('golfclub/nexttee/offers/edit/'.$r->id));
		}
	}
	public function delete_offer($pid,$id){
		$r = new Nt_offer();
		$r->where(array('id'=>$id,'user_id'=>$pid))->get();
		if($r->exists())
		{
			/*$or = new Nt_offer();
			$or->where(array('user_id'=>$pid, 'position >' => $r->position))
				->update('position' ,'position - 1', FALSE);*/
			$noti = new Nt_notification();
			$noti->where(array('post_id'=>$r->id))->get();
			$query = $this->db->query("SELECT * from dip_nt_notifications WHERE post_id =".$r->id); 
   			$data = $query->result();
			
						
			foreach($data as $key => $value)
			{
				$this->db->where('nt_notification_id', $value->id);
				$query = $this->db->query("SELECT * from dip_join_nt_notifications_nt_regids WHERE nt_notification_id =".$value->id); 
   				$data_dip_join_notifications_regids = $query->result();
				/*print_r($data_dip_join_notifications_regids);
				die();*/				
				foreach($data_dip_join_notifications_regids as $key => $value_1)
				{		
					$regid = new Nt_regid();
					$regid->where(array('id'=>$value_1->nt_regid_id))->get();
					$regid->update_all('push_count','push_count - 1',false);				
				}				
				$this->db->delete('dip_join_nt_notifications_nt_regids');			
				/*$regid = new Nt_regid();
				$regid->where(array('language_id'=>$value->language_id))->get();
				$regid->update_all('push_count','push_count - 1',false);*/
			}
			$this->db->where('post_id', $r->id);
			$this->db->delete('dip_nt_notifications');				
			$noti->delete();				
			$r->delete();
			return TRUE;
		}
		else 
		{
			return FALSE;
		}
	}
	public function position_offer($pid,$id,$pos){
		$r = new Nt_offer();
		$r->get_by_id($id);
		$or = new Nt_offer();
		if($pos < $r->position){
			$or->where(array('user_id'=>$pid, 'position >=' => $pos,'position <' => $r->position))
				->update('position' ,'position + 1', FALSE);
		}else{
			$or->where(array('user_id'=>$pid, 'position <=' => $pos,'position >' => $r->position))
				->update('position' ,'position - 1', FALSE);
		}
		$r->position = $pos;
		$success = $r->save();
		if(!$success)
			return false;
		else
			return true;
	}


	// offers
	public function get_reward($pid,$id=null){
		$u = new Nt_reward();
		$u->where(array('id'=>$id,'user_id'=>$pid))->get();
		$u->stored->title = decode_data($u->title);
		$u->stored->descr = decode_data($u->descr);
		$u->stored->startdate = decode_date($u->startdate);
		$u->stored->enddate = decode_date($u->enddate);
		return $u->stored;
	}
	public function save_reward($post,$pid,$id=null){
		$r = new Nt_reward();
		if($id){
			$r->get_by_id($id);
		}else{
			$r->user_id = $pid;
			//getting the next position
			$rp = new Nt_reward();
			$rp->select_max('position');
			$rp->where('user_id',$pid);
			$rp->get();
			$r->position = intval($rp->position) + 1;
		}
		$r->title = encode_data($post['title']);
		$r->descr = encode_data($post['descr']);
		$r->startdate = encode_date($post['starting']);
		$r->enddate = encode_date($post['ending']);
		$r->points = $post['points'];
		
		// return $r;
		$success = $r->save();
		if(! $success)
		{
			$this->session->set_flashdata('error_msg', 'Sorry! Data is not saved');
			redirect(current_full_url());
		}else{

			return $r->stored;
			// !$id ||redirect(current_full_url());
			// $this->session->set_flashdata('success_msg', 'The Reward is saved successfully');
			// redirect(site_full_url('golfclub/nexttee/rewards/edit/'.$r->id));
		}
	}
	public function delete_reward($pid,$id){
		
		//die('aAS'); 
		$r = new Nt_reward();
		$r->where(array('id'=>$id,'user_id'=>$pid))->get();
		if($r->exists()){
			/*$or = new Nt_reward();
			$or->where(array('user_id'=>$pid, 'position >' => $r->position))
				->update('position' ,'position - 1', FALSE);*/
			$noti = new Nt_notification();
			$noti->where(array('post_id'=>$r->id))->get();
			$query = $this->db->query("SELECT * from dip_nt_notifications WHERE post_id =".$r->id); 
   			$data = $query->result();
			
			//print_r($data);
			//die();			
			foreach($data as $key => $value)
			{
				$this->db->where('nt_notification_id', $value->id);
				$query = $this->db->query("SELECT * from dip_join_nt_notifications_nt_regids WHERE nt_notification_id =".$value->id); 
   				$data_dip_join_notifications_regids = $query->result();
				/*print_r($data_dip_join_notifications_regids);
				die();*/				
				foreach($data_dip_join_notifications_regids as $key => $value_1)
				{		
					$regid = new Nt_regid();
					$regid->where(array('id'=>$value_1->nt_regid_id))->get();
					$regid->update_all('push_count','push_count - 1',false);				
				}	
				$this->db->delete('dip_join_nt_notifications_nt_regids');				
				/*$regid = new Nt_regid();
				$regid->where(array('language_id'=>$value->language_id))->get();
				$regid->update_all('push_count','push_count - 1',false);*/
			}
			$this->db->where('post_id', $r->id);
			$this->db->delete('dip_nt_notifications');				
			$noti->delete();
			$r->delete();
			return TRUE;
		}else {
			return FALSE;
		}
	}
	public function position_reward($pid,$id,$pos){
		$r = new Nt_reward();
		$r->get_by_id($id);
		$or = new Nt_reward();
		if($pos < $r->position){
			$or->where(array('user_id'=>$pid, 'position >=' => $pos,'position <' => $r->position))
				->update('position' ,'position + 1', FALSE);
		}else{
			$or->where(array('user_id'=>$pid, 'position <=' => $pos,'position >' => $r->position))
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