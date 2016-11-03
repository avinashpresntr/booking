<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends DIP_Controller_Master {

	public function index(){
		
		//get master password
		$master = new User();
		$master->where(array('id'=>$this->data['user']['id'],'type'=>0))->get();
		$this->data['master']['name'] = $master->name;
		$this->data['master']['username'] = $master->username;
		$this->data['master']['password'] = $master->password;

		/**
		 * page with input
		 */
		if($this->input->post()){
			
			$rules = array(
					'name' =>  array(
							'field'=>'name',
							'label'=>'Name',
							'rules'=>'xss_clean|required'
					),
					'username' =>  array(
							'field'=>'username',
							'label'=>'Username',
							'rules'=>'tream|xss_clean|required|callback__unique_username'
					),
					'password' =>  array(
							'field'=>'password',
							'label'=>'Password',
							'rules'=>'tream|required'
					),
			);
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run() == TRUE){
				$post = $this->input->post();
				$master->name = $post['name'];
				$master->username = $post['username'];
				$master->password = $post['password'];
				$master->save();
				$this->session->set_flashdata('success_msg', 'Your proflie is updated successfully');
				redirect($this->uri->uri_string());
			}
		}
		
		$this->data['page'] = array(
			'title' => 'Profile',
			'slug' => 'profile',
			'nav' => 'profile',
			'url' => 'master/profile',
			'desc' => 'Edit your profile settings',
			'main' => '_layout_backend',
			'subview' => 'master/profile'
		);
		$this->load->view('_layout_main',$this->data);
		// $this->show($this->data);
	}
	/**
	 * callback function to check if username already exists
	 * also do not check it for this client username
	 */
	public function _unique_username($str){
		$check_u = new User();
		$count_u = $check_u->where(array('username' => $this->input->post('username'),'id !=' => $this->data['user']['id']))->count();
		if($count_u != 0){
			$this->form_validation->set_message('_unique_username', '%s should be unique');
			return FALSE;
		}
		return TRUE;
	}
}
