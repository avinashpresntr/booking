<?php
class Adv_m extends DIP_Model{
	public $rules = array(
			'url' =>  array(
					'field'=>'url',
					'label'=>'Advertisement Url',
					'rules'=>'trim|prep_url|xss_clean'
			),
			'startdate' =>  array(
					'field'=>'startdate',
					'label'=>'Advertisement Starting Date',
					'rules'=>'trim|xss_clean|required'
			),
			'enddate' =>  array(
					'field'=>'enddate',
					'label'=>'Advertisement Ending Date',
					'rules'=>'trim|xss_clean|required'
			),
	);
	function __construct(){
		parent::__construct();
	}

	// courses
	public function get_details($id=null){
		$u = new Advertisement();
		$u->include_related('user');
		$u->where('id',$id)->get();
		$u->stored->startdate = decode_date($u->startdate);
		$u->stored->enddate = decode_date($u->enddate);
		$u->stored->pics = decode_data($u->pics);
		$u->stored->languages = decode_data($u->languages);
		$u->stored->countries = decode_data($u->countries);
		return $u->stored;
	}
	public function get_rel_clients($id){
		$u = new User();
		$u->where_related('advertisement','id',$id);
		$u->get_iterated();
		$result = array();
		foreach ($u as $ui) {
			$result[$ui->id] = $ui->name;
		}
		return $result;
	}
	public function save($post,$id=null){
		$r = new Advertisement();
		if($id){
			$r->get_by_id($id);
		}
		$r->name = $post['name'];
		$r->url = $post['url'];
		$r->startdate = encode_date($post['startdate']);
		$r->enddate = encode_date($post['enddate']);
		if(isset($post['languages']))
			$r->languages = encode_data($post['languages']);
		if(isset($post['country']))
			$r->countries = encode_data($post['country']);

		// delete removed relation
		if($id){
			$uss = new User();
			$uss->where_related('advertisement','id',$id);
			$uss->where_not_in('id', explode( ',',$post['clients']))->get();
			$r->delete($uss->all);
		}
		// save with new relation
		$users = new User();
		$users->where_in('id', explode( ',',$post['clients']))->get();
		if($users->exists())
			$success = $r->save($users->all);
		else
			$success = $r->save();
		



		if(! $success)
		{
			$this->session->set_flashdata('error_msg', 'Sorry! Data is not saved');
			redirect(current_full_url());
		}else{

			$up_dir = 'uploads/advertisements/'.$r->id.'/';
			
			//if post files are there
			if(isset($post['pics'])){
				$arrayOld = decode_data($r->pics);
				$arrayNew = $this->gettemp($post['pics'],$up_dir,$arrayOld);
				$r->pics = encode_data($arrayNew);
				$r->save();
			}
			redirect(site_full_url('master/golfapp_advertising'));
			// $this->session->set_flashdata('success_msg', 'The Advertisement is saved successfully');
			// redirect(site_full_url('master/golfapp_advertising/edit/'.$r->id));
		}
	}
	public function delete($id){
		$r = new Advertisement();
		$r->where('id',$id)->get();
		if($r->exists()){
			//delete imge folder
			$upload_url = 'uploads/advertisements/'.$id;
			if (is_dir($upload_url))
				deleteFolder($upload_url);
			$r->delete();
			return TRUE;
		}else {
			return FALSE;
		}
	}
	public function delete_all(){
		$r = new Advertisement();
		//delete imge folder
		$upload_url = 'uploads/advertisements';
		if (is_dir($upload_url))
			deleteFolder($upload_url);
		$r->delete_all();
		return TRUE;
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
				unset($ndata[$key]);
			}
		}
		return $ndata;
	}
}