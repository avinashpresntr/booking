<?php
class Event_m extends DIP_Model{
	public $rules = array(
			'event_date' =>  array(
					'field'=>'event_date',
					'label'=>'Event Date',
					'rules'=>'trim|xss_clean|required'
			),
			'name' =>  array(
					'field'=>'name',
					'label'=>'Event Name',
					'rules'=>'trim|xss_clean|required'
			),
			'format' =>  array(
					'field'=>'format',
					'label'=>'Format',
					'rules'=>'xss_clean'
			),
			'remark1' => array(
						'field'=>'remark1',
						'label'=> 'Remark 1',
						'rules'=>'xss_clean'
			),
			'remark1' => array(
						'field'=>'remark1',
						'label'=> 'Remark 1',
						'rules'=>'xss_clean'
			),
	);
	function __construct(){
		parent::__construct();
	}

	// courses
	public function get_details($pid,$id=null){
		$u = new Event();
		$u->where(array('id'=>$id,'user_id'=>$pid))->get();
		$u->stored->name = $u->name;
		$u->stored->event_date = decode_date($u->event_date);
		$u->stored->format = decode_data($u->format);
		$u->stored->remark1 = decode_data($u->remark1);
		$u->stored->remark2 = decode_data($u->remark2);
		$u->stored->file_detail = decode_data($u->file_detail);
		$u->stored->file_teetime = decode_data($u->file_teetime);
		$u->stored->file_result = decode_data($u->file_result);
		return $u->stored;
	}
	public function save($post,$pid,$id=null){
		$r = new Event();
		if($id){
			$r->get_by_id($id);
		}else{
			$r->user_id = $pid;
		}

		$r->name = $post['name'];
		
		$r->format = encode_data($post['format']);
		$r->remark1 = encode_data($post['remark1']);
		$r->remark2 = encode_data($post['remark2']);
		
		/*$r->format = $post['format'];
		$r->remark1 = $post['remark1'];
		$r->remark2 = $post['remark2'];*/
		
		$r->event_date = encode_date($post['event_date']);
		$r->pubdate = date('Y-m-d');

		if(isset($post['file_default']))
			$r->file_default = $post['file_default'];
		else
			$r->file_default = null;

		// return $r;
		$success = $r->save();
		
		if(! $success)
		{
			$this->session->set_flashdata('error_msg', 'Sorry! Data is not saved');
			redirect(current_full_url());
		}else{
			//this will proceed to pushnotification;
			// return $r->id;
			$eid = $r->id;
			$up_dir = 'uploads/'.$pid.'/events/'.$eid.'/';

			$a = new Event();
			$a->get_by_id($eid);

				//if post files are there
				if(isset($post['detail_post'])){
					$arrayOld = decode_data($a->file_detail);
					$arrayNew = $this->gettemp($post['detail_post'],$up_dir,$arrayOld);
					$a->file_detail = encode_data($arrayNew);
				}
				if(isset($post['teetime_post'])){
					$arrayOld2 = decode_data($a->file_teetime);
					$arrayNew2 = $this->gettemp($post['teetime_post'],$up_dir,$arrayOld2);
					$a->file_teetime = encode_data($arrayNew2);
				}
				if(isset($post['result_post'])){
					$arrayOld3 = decode_data($a->file_result);
					$arrayNew3 = $this->gettemp($post['result_post'],$up_dir,$arrayOld3);
					$a->file_result = encode_data($arrayNew3);
				}
			$a->save();
			redirect(site_full_url('golfclub/events'));
			
			// !$id ||redirect(site_full_url('golfclub/events'));
			// $this->session->set_flashdata('success_msg', 'The Event is saved successfully');
			// redirect(site_full_url('golfclub/events/edit/'.$r->id));
		}
	}
	public function delete($pid,$id){
		$r = new Event();
		$r->where(array('id'=>$id,'user_id'=>$pid))->get();
		if($r->exists()){
			//delete imge folder
			$upload_url = 'uploads/'.$pid.'/events/'.$id;
			if (is_dir($upload_url))
				deleteFolder($upload_url);
			$r->delete();
			return TRUE;
		}else {
			return FALSE;
		}
	}
	public function delete_all($pid){
		$r = new Event();
		$r->where('user_id',$pid)->get();
		if($r->exists()){
			$r->delete_all();
			$upload_url = 'uploads/'.$pid.'/events';
				if (is_dir($upload_url))
					deleteFolder($upload_url);
			return TRUE;
		}else {
			return FALSE;
		}
	}

	public function gettemp($array,$up_dir,$arrayOld){
		$ndata = $arrayOld;
		foreach ($array as $key => $value) {
			if(!empty($value)){
				// if previous file exists remove it
				if(isset($ndata[$key])){
					delete_img($ndata[$key]);
					unset($ndata[$key]);
				}
				if($value!=0){
					$tmp = new Temp();
					$tmp->get_by_id($value);

					$old_dir = $tmp->url;
					if (!is_dir($up_dir)) {
					    mkdir($up_dir, 0777, true);
					}
					$new_dir = $up_dir.'m'.$tmp->name;
					//rename the file to new location
					rename($old_dir,$new_dir);
					$ndata[$key] = $new_dir;
					// unlink('./'.$tmp->url);
					$tmp->delete();
				}
			}
			if(($value==0) && ($value!='')){
				delete_img($ndata[$key]);
				$ndata[$key] = 'sadsad';
				unset($ndata[$key]);
			}
		}
		return $ndata;
		
	}
}