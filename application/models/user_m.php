<?php
class User_m extends DIP_Model{

	function __construct(){
		parent::__construct();
	}
	public function gettype(){
		return $this->session->userdata('type');
	}
	public function getuser($input){
		$u = new User();
		if(is_numeric($input)){
			$u->get_by_id($input);
		}else{
			$u->where($input)->get();
		}
		
		if(!empty($u->id)) {
			$data = array(
					'id' => $u->id,
					'name' => decode_ascii($u->name),
					'username' => $u->username,
					'type' => $u->type,
					'status'=> $u->status,
					'parrent' => $u->parrent,
					'level' => $u->level
			);

			return $data;
		}
		else {
			return FALSE;
		}
	}
	public function get_users($where){
		$hgs = new User();
		$hgs->where($where)->get();
		$result = array();
		foreach ($hgs as $hg)
		{
		    $result[$hg->id] = decode_ascii($hg->name);
		}
		return $result;
	}
	public function save($post,$id=null){

			//for user table
			$nu = new User();
			if($id) {$nu->get_by_id($id);}

			$nu->name = encode_ascii($post['name']);
			$nu->slug = encode_slug($post['name']);
			$nu->username = $post['username'];
			$nu->password = $post['password'];
			$nu->type = $post['type'];
			$nu->creation_date = encode_date($post['creation_date']);
			$nu->renewal_date = encode_date($post['renewal_date']);

			if(isset($post['parent']))
				$nu->parrent = $post['parent'];
			if($post['type']==1)
				$nu->parrent = 0;
			if(isset($post['level']))
				$nu->level = $post['level'];

			//for golfclub or golfgroup or partner table
			if($post['type']==1)
				$nh = new Golfgroup();
			elseif($post['type']==2)
				$nh = new Golfclub();
			else
				$nh = new Partner();

			if($id) {$nh->where(array('user_id' => $id))->get();}
			
			$nh->contact_person = $post['contact_person'];
			$nh->contact_email = $post['contact_email'];
			$nh->contact_phone = $post['contact_phone'];
			$nh->city = $post['city'];
			$nh->country = $post['country'];

			if(isset($post['default_lang']))
				$nh->default_language = $post['default_lang'];
			if(isset($post['ios_url']))
				$nh->ios_url = $post['ios_url'];
			if(isset($post['android_url']))
				$nh->android_url = $post['android_url'];
			if(isset($post['ios_status']))
				$nh->ios_status = encode_date($post['ios_status']);
			if(isset($post['android_status']))
				$nh->android_status = encode_date($post['android_status']);

			if(isset($post['languages']))
				$nh->languages = encode_data($post['languages']);

			if(isset($post['push_note']))
				$nh->push_notification = $post['push_note'];
			if(isset($post['nt_push_note']))
				$nh->nt_push_notification = $post['nt_push_note'];

			if(isset($post['visibility']))
				$nh->visibility = $post['visibility'];
			
			//if($nu->type > 2 && !isset($post['edit_name']))
			$nh->edit_name = $post['edit_name'];
			/*if(!isset($post['edit_name']))
				$nh->edit_name = 0;*/

			if(!$id && $nu->type > 2){
				$rp = new Partner();
				$rp->where_related('user','parrent',$nu->parrent);
				$rp->where_related('user','type',$nu->type);
				$rp->select_max('position');
				$rp->get();
				$nh->position = intval($rp->position) + 1;
			}



			// save the record
			$success = $nu->save();
			if(! $success)
			{
				$this->session->set_flashdata('error_msg', 'Sorry! User is not saved');
				redirect(current_full_url());
			}
			$success = $nh->save($nu,'user');
			if(! $success)
			{
				$this->session->set_flashdata('error_msg', 'Sorry! User Data is not saved');
				redirect(current_full_url());
			}else{
				!$id ||redirect(site_full_url('master/manageusers/index/'.($post['type']==1?'golfgroups':'golclubs')));
				$this->session->set_flashdata('success_msg', 'The User is saved successfully');
				redirect(current_full_url());
			}
	}

	public function delete($id){

		$u = new User();
		$u->get_by_id($id);
		
		// delete details datas from other tables also
		if($u->exists()) {
			if($u->type == 2){
				$this->multi_delete(array($id),'golfclub');
			}
			if($u->type == 1){
				$this->multi_delete(array($id),'golfgroup');

			}
			if($u->type > 2){
				return $this->multi_delete(array($id),'partner');
			}

			// $u->delete();
			return TRUE;
		}else return FALSE;
	}
	public function multi_delete($array,$type){

		$u = new User();
		$u->where_in('id',$array)->get();
		if($u->exists()) {

			if($type == 'golfclub'){
				//delete golfapp details 
				$uh = new Golfclub();
				$uh->where_in('user_id',$array)->get()->delete_all();
				$cr = new Course_rate();
				$cr->where_in_related('course_rate_section/course','user_id',$array)->get()->delete_all();
				$crs = new Course_rate_section();
				$crs->where_in_related('course','user_id',$array)->get()->delete_all();
				$c = new Course();
				$c->where_in('user_id',$array)->get()->delete_all();
				$c = new Event();
				$c->where_in('user_id',$array)->get()->delete_all();
				$c = new Newz();
				$c->where_in('user_id',$array)->get()->delete_all();

				//delete nexttee details
				$up = new Nt_course();
				$up->where_in('user_id',$array)->get()->delete_all();
				$up = new Nt_offer();
				$up->where_in('user_id',$array)->get()->delete_all();
				$up = new Nt_reward();
				$up->where_in('user_id',$array)->get()->delete_all();

				// delete qrcodes
				// $this->db->delete('dip_nt_qrcodes', array('user_id' => $id));
				// $this->db->delete('dip_nt_ratings', array('user_id' => $id));

				// delete related partners
				$up = new User();
				$up->where_in('parrent',$array)->get();
				if($up->exists()){
					$partners = array();
					foreach ($up as $key => $val)
						$partners[]=$val->id;
					$this->multi_delete($partners,'partner');
				}

				// delete user folders
				foreach ($array as $pid) {
					$upload_url = 'uploads/'.$pid;
					if (is_dir($upload_url))
						deleteFolder($upload_url);
				}
				
			}

			if($type == 'golfgroup'){
				$uhg = new Golfgroup();
				$uhg->where_in('user_id',$array)->get();
				if($uhg->exists()){
					$uhg->delete_all();
					// make all child individual
					$uh = new User();
					$uh->where_in('parrent',$array)->update('parrent',0);
				}
			}

			if($type == 'partner'){
				// delete all child partners
				$p = new Partner();
				$p->where_in('user_id',$array)->get()->delete_all();
				// delete related details
				$p = new Package();
				$p->where_in('user_id',$array)->get()->delete_all();
				$cr = new Menu_item();
				$cr->where_in_related('menu_section','user_id',$array)->get()->delete_all();
				$crs = new Menu_section();
				$crs->where_in('user_id',$array)->get()->delete_all();
				
				// delete user folders
				foreach ($u as $pid) {
					$upload_url = 'uploads/'.$pid->parrent.'/'.strtolower($this->data['user_types'][$pid->type]).'/'.$pid->id;
					if (is_dir($upload_url))
						deleteFolder($upload_url);
				}
			}

			$u->delete_all();

			return TRUE;
		}else return FALSE;
	}


	public function status($id,$status){
		$u = new User();
		$success = $u->where('id',$id)->update('status',$status);
		if($success) {
			return TRUE;
		}else{
			return FALSE;
		}
	}
	public function get_languages($uid,$type){
		if($type==1)
			$h = new Golfgroup();
		else
			$h = new Golfclub();
		
		// $h->select('user_id','languages','default_language');
		$h->where('user_id', $uid)->get();
		$r = new stdClass;
		$r->id= $h->user_id;
		$r->laguages= decode_data($h->languages);
		$r->default_language= $h->default_language;
		return $r;
	}
	public function position_partner($id,$pos){
		$r = new Partner();
		$r->include_related('user',array('id','type','parrent'));
		$r->get_by_user_id($id);
		if($r->position==0){
			$rp = new Partner();
			$rp->where_related('user','parrent',$r->user_parrent);
			$rp->where_related('user','type',$r->user_type);
			$rp->select_max('position');
			$rp->get();
			$r->position = intval($rp->position) + 1;
			$success = $r->save();
			if(!$success)
				return false;
			else
				return true;
		}

		$pos = $r->position + $pos;
		// show($pos);
		//check if the position exists or not
		$ud = new Partner();
		$ud->where_related('user','parrent',$r->user_parrent);
		$ud->where_related('user','type',$r->user_type);
		$ud->where('position',$pos)->get();
		if($ud->exists()){
			$or = new Partner();
			$or->select('id');
			$or->where_related('user','parrent',$r->user_parrent);
			$or->where_related('user','type',$r->user_type);
			if($pos < $r->position){
				$or->where(array('position >=' => $pos,'position <' => $r->position))->get();
				$array=array();
				foreach($or as $o){$array[]=$o->id;}
				$up = new Partner();
				$up->where_in('id',$array)->update('position' ,'position + 1', FALSE);
			}else{
				$or->where(array('position <=' => $pos,'position >' => $r->position))->get();
				$array=array();
				foreach($or as $o){$array[]=$o->id;}
				$up = new Partner();
				$up->where_in('id',$array)->update('position' ,'position - 1', FALSE);
			}

			$r->position = $pos;
			$success = $r->save();
			if(!$success)
				return false;
			else
				return true;
		}
		return false;
	}
	public function log($id,$v){
		$nh = new User();
		$nh->select('id,logs');
		$nh->where(array('id' => $id))->get();
		if (strpos($nh->logs, $v) == false && strpos($nh->logs, '1')==true){
			$array = str_split($nh->logs);
			$array[] = $v;
			array_shift($array);
			asort($array);
			$nh->logs = 'L'.implode('',$array);
			$nh->save();
		}
	}
}