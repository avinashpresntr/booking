<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nexttee extends DIP_Controller_Master {

	public function index(){

		// get settings from the settings table
		$ss = new Setting();
		$data = $ss->get_by_user_id($this->data['user']['id']);
		/*echo "<pre>";
		print_r($data);
		echo "</pre>";*/
		$this->data['settings'] = array();
		foreach ($ss as $s) 
		{
			$this->data['settings'][$s->name] = decode_data($s->value);
			
		}
		
		if($this->input->post()){
			$post = $this->input->post();
		//show($post);
		//	die();
			//language
			if(isset($post['languages'])){
				$sp1 = new Setting();
				$sp1->where(array('user_id'=>1, 'name'=>'nt_languages'));
				$sp1->update('value',encode_data($post['languages']));
			}
			//advertisment
			if(isset($post['name'])){
				$sp1 = new Setting();
				$sp1->where(array('user_id'=>1, 'name'=>'nt_adv_name'));
				$sp1->update('value',encode_data($post['name']));
			}
			if(isset($post['url'])){
				$sp1 = new Setting();
				$sp1->where(array('user_id'=>1, 'name'=>'nt_adv_url'));
				$sp1->update('value',encode_data($post['url']));
			}
			if(isset($post['pics']) && isset($post['languages'])){
				$sp2 = new Setting();
				$sp2->where(array('user_id'=>1,'name'=>'nt_adv_pics'))->get();

				$up_dir = 'uploads/advertisements/';
				$arrayOld = decode_data($sp2->value);
				$sp2->value = encode_data($this->gettemp($post['pics'],$up_dir,$arrayOld,$post['languages']));
				$sp2->save();
			}
			if(isset($post['offer'])){
				$sp1 = new Setting();
				$sp1->where(array('user_id'=>1, 'name'=>'nt_offers'));
				$sp1->update('value',encode_data($post['offer']));
			}
			if(isset($post['reward'])){
				$sp1 = new Setting();
				$sp1->where(array('user_id'=>1, 'name'=>'nt_rewards'));
				$sp1->update('value',encode_data($post['reward']));
			}
			if(isset($post['push'])){
				$sp1 = new Setting();
				$sp1->where(array('user_id'=>1, 'name'=>'nt_push'));
				$sp1->update('value',encode_data($post['push']));
			}
			if(isset($post['events'])){
				//die("aaa");
				$sp1 = new Setting();
				$sp1->where(array('user_id'=>1, 'name'=>'nt_events'));
				/*echo count($data_event);
				echo "<pre>";
				print_r($data_event);
				echo "</pre>";
				die();*/
				$sp1->update('value',encode_data($post['events']));
			}
			if(isset($post['radius'])){
				$sp1 = new Setting();
				$sp1->where(array('user_id'=>1, 'name'=>'nt_radius'));
				$sp1->update('value',encode_data($post['radius']));
			}

			if(isset($post['app_url'])){
				$sp1 = new Setting();
				$sp1->where(array('user_id'=>1, 'name'=>'nt_app_url'));
				$sp1->update('value',encode_data($post['app_url']));
			}
			if(isset($post['event_radius'])){
				$sp1 = new Setting();
				$sp1->where(array('user_id'=>1, 'name'=>'nt_event_radius'));
				$sp1->update('value',encode_data($post['event_radius']));
			}
			if(isset($post['event_time_frame'])){
				$sp1 = new Setting();
				$sp1->where(array('user_id'=>1, 'name'=>'nt_event_time_frame'));
				$sp1->update('value',encode_data($post['event_time_frame']));
			}
			if(isset($post['previmage']) || isset($post['thumb'])){
				isset($post['previmage'])||$post['previmage']=null;
				isset($post['thumb'])||$post['thumb']=null;
				$sp1 = new Setting();
				$sp1->where(array('user_id'=>1, 'name'=>'nt_hm_imgs'))->get();
				$upload_url = 'uploads/home_images/';
				$sp1->value = get_uploaded_image_list2($upload_url,$sp1->stored->value,$post['previmage'],$post['thumb']);
				$sp1->save();
			}

			$this->session->set_flashdata('success_msg', 'The Next Tee settngs saved successfully');
			redirect(site_full_url('master/nexttee'));
		}
		$this->data['page'] = array(
			'title' => 'Next Tee',
			'slug' => 'nexttee',
			'nav' => 'nexttee',
			'desc' => 'Next Tee Settings',
			'main' => '_layout_backend',
			'subview' => 'master/nexttee',
		);
		$this->load->view('_layout_main',$this->data);
		// show($this->data['settings']);
	}
	public function gettemp($array,$up_dir,$arrayOld,$newkeys){
		$delt = array_diff_key($arrayOld,array_flip($newkeys));
		foreach ($delt as $key => $value) {
			if(!empty($delt[$key])){
				delete_img($delt[$key]);
				unset($arrayOld[$key]);
			}
		}
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