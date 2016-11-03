<?php
class Device_m extends DIP_Model{

	function __construct(){
		parent::__construct();
	}
	public function get_all_facilities(){
		$langs = new Facility();
		$langs->get();
		$result = array();
		foreach ($langs as $lang)
		{
		    $result[$lang->id] = $lang->name;
		}
		return $result;
	}

	// courses
	public function get_details($pid,$id=null){
		$u = new Course();
		$u->where(array('id'=>$id,'user_id'=>$pid))->get();
		$u->stored->name = decode_data($u->name);
		$u->stored->descr = decode_data($u->descr);
		$u->stored->detail = decode_data($u->detail);
		$u->stored->pics = decode_data($u->pics);
		$u->stored->facilities = decode_data($u->facilities);
		return $u->stored;
	}
	public function save($post,$pid,$id=null){
		$r = new Course();
		if($id){
			$r->get_by_id($id);
		}else{
			$r->user_id = $pid;
			
			//getting the next position
			$rp = new Course();
			$rp->select_max('position');
			$rp->where('user_id',$pid);
			$rp->get();
			$r->position = intval($rp->position) + 1;
		}
		$r->name = encode_data($post['name']);
		$r->descr = encode_data($post['descr']);
		$r->holes = $post['holes'];
		$r->par = $post['par'];
		$r->length = $post['length'];
		$r->lenght_unit = $post['lenght_unit'];
		$r->facilities = encode_data(array_values($post['facilities']));
		
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
				$last = new Course();
				$last->where('id',$dzid)->get();
				
				$upload_url = 'uploads/'.$this->data['user']['id'].'/courses/'.$dzid.'/';
				$last->pics = get_uploaded_image_list($upload_url,$last->stored->pics,$post['previmage'],$post['thumb']);
				
				$last->save();
			}

			!$id ||redirect(site_full_url('golfclub/courses'));
			$this->session->set_flashdata('success_msg', 'The Restaurant or Bar is saved successfully');
			redirect(site_full_url('golfclub/courses/edit/'.$r->id));
		}
	}
	public function delete($pid,$id){
		$r = new Course();
		$r->where(array('id'=>$id,'user_id'=>$pid))->get();
		if($r->exists()){
			$or = new Course();
			$or->where(array('user_id'=>$pid, 'position >' => $r->position))
				->update('position' ,'position - 1', FALSE);
			$r->delete();
			return TRUE;
		}else {
			return FALSE;
		}
	}
	public function position($pid,$id,$pos){
		$r = new Course();
		$r->get_by_id($id);
		$or = new Course();
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


	// course rate sections
	public function get_rate_section($uid, $id=null){
		$u = new Course_rate_section();
		$u->where(array('id'=>$id,'course_id'=>$uid))->get();
		$u->stored->name = decode_data($u->name);
		return $u->stored;
	}
	public function save_rate_section($post,$pid,$id=null){
		$r = new Course_rate_section();
		if($id){
			$r->get_by_id($id);
		}else{
			$r->course_id = $pid;
			
			//getting the next position
			$rp = new Course_rate_section();
			$rp->select_max('position');
			$rp->where('course_id',$pid);
			$rp->get();
			$r->position = intval($rp->position) + 1;
		}
		$r->name = encode_data($post['name']);
		$success = $r->save();
		if(!$success)
			return false;
		else
			return true;
	}
	public function position_rate_section($pos,$pid,$id){
		$r = new Course_rate_section();
		$r->get_by_id($id);
		
		//check if the position exists or not
		$ud = new Course_rate_section();
		$ud->where(array('position'=>$pos,'course_id'=>$pid))->get();
		if($ud->exists()){
			$or = new Course_rate_section();
			if($pos < $r->position){
				$s = $or->where(array('course_id'=>$pid, 'position >=' => $pos,'position <' => $r->position))
					->update('position' ,'position + 1', FALSE);
			}else{
				$s = $or->where(array('course_id'=>$pid, 'position <=' => $pos,'position >' => $r->position))
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
	public function delete_rate_section($pid,$id){
		$r = new Course_rate_section();
		$r->where(array('id'=>$id,'course_id'=>$pid))->get();
		if($r->exists()){
			$or = new Course_rate_section();
			$or->where(array('course_id'=>$pid, 'position >' => $r->position))
				->update('position' ,'position - 1', FALSE);
			$r->delete();
			return TRUE;
		}else {
			return FALSE;
		}
	}



	// course rate sections
	public function get_rate($uid, $id=null){
		$u = new Course_rate();
		$u->where(array('id'=>$id,'course_rate_section_id'=>$uid))->get();
		$u->stored->descr = decode_data($u->descr);
		$u->stored->price = decode_data($u->price);
		return $u->stored;
	}
	public function save_rate($post,$pid,$id=null){
		$r = new Course_rate();
		if($id){
			$r->get_by_id($id);
		}else{
			$r->course_rate_section_id = $pid;
			
			//getting the next position
			$rp = new Course_rate();
			$rp->select_max('position');
			$rp->where('course_rate_section_id',$pid);
			$rp->get();
			$r->position = intval($rp->position) + 1;
		}
		$r->descr = encode_data($post['descr']);
		$r->price = encode_data($post['price']);
		$success = $r->save();
		if(!$success)
			return false;
		else
			return true;
	}
	public function position_rate($pos,$pid,$id){
		$r = new Course_rate();
		$r->get_by_id($id);

		//check if the position exists or not
		$ud = new Course_rate();
		$ud->where(array('position'=>$pos,'course_rate_section_id'=>$pid))->get();
		if($ud->exists()){
			$or = new Course_rate();
			if($pos < $r->position){
				$s = $or->where(array('course_rate_section_id'=>$pid, 'position >=' => $pos,'position <' => $r->position))
					->update('position' ,'position + 1', FALSE);
			}else{
				$s = $or->where(array('course_rate_section_id'=>$pid, 'position <=' => $pos,'position >' => $r->position))
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
	public function delete_rate($pid,$id){
		$r = new Course_rate();
		$r->where(array('id'=>$id,'course_rate_section_id'=>$pid))->get();
		if($r->exists()){
			$or = new Course_rate();
			$or->where(array('course_rate_section_id'=>$pid, 'position >' => $r->position))
				->update('position' ,'position - 1', FALSE);
			$r->delete();
			return TRUE;
		}else {
			return FALSE;
		}
	}
}