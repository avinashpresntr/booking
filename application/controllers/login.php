<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends DIP_Controller_Back {
	
	function __construct(){
		parent::__construct();
		//$this->config->set_item('language','english');
		//$this->lang->load('message','english');
	}
	public function index(){
		if ($this->login_m->loggedin() == TRUE){redirect('login/home');}

		$this->data['page'] = array(
			'title' => 'Log In',
			'slug' => 'login',
			'nav' => 'login',
			'url' => 'login',
			'desc' => $this->data['meta']['desc'],
			'main' => '_layout_login',
			'foot' => '_foot_login'
		);
		$this->load->view('_layout_main',$this->data);
	}
	public function auth(){
		if($this->input->post()){

			$rules = array(
               array(
                     'field'   => 'username', 
                     'label'   => 'Username', 
                     'rules'   => 'required|trim'
                  ),
               array(
                     'field'   => 'password', 
                     'label'   => 'Password', 
                     'rules'   => 'required|trim'
                  )
            );
			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run() == TRUE){

				$user = $this->login_m->get_user($this->input->post());
				
				//data will be processed for login check and return result
				if($user == FALSE){
					$result = array(
						'status' => 'Failed',
						'msg' => 'Sorry! Incorrect Username or Password'
					);
				}else{
					$this->login_m->login($user);
					$url = site_url('login/home');
					$result = array(
						'status' => 'success',
						'url' => $url
					);
				}
			}else{
				$error = validation_errors();
				$result = array(
					'status' => 'validation_error',
					'msg' => $error
				);
			}
			echo json_encode($result);
		}
		else{
			redirect('login');
		}
	}
	public function home(){
		$ut = $this->login_m->logtype();
		switch ($ut) {
			case 0:
				redirect('master/manageusers');
				break;
			case 1:
				redirect('golfgroup/profile');
				break;
			case 2:
				redirect('golfclub/profile');
				break;
			case 3:
				redirect('partner/profile');
				break;
			case 4:
				redirect('partner/profile');
				break;
			case 5:
				redirect('partner/profile');
				break;
			case 6:
				redirect('partner/profile');
				break;
			default:
				redirect('login');
				break;
		}
	}
}
