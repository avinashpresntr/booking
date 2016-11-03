<?php
class DIP_Controller_Back extends DIP_Controller{

	function __construct(){
		parent::__construct();
		
		$this->load->library('session');
		$this->load->model('login_m');

		//login check
		$exception_uris = array(
			'login',
			'login/index',
			'login/auth',
			'logout'
		);
		if(in_array(uri_string(),$exception_uris) == FALSE){
			if ($this->login_m->loggedin() == TRUE){
				$this->data['session'] = $this->session->userdata; //set the session to acssess the logged in user data
			}else{
				if(isset($this->session->sess_expired)){
					if(uri_string() != ''){
						$this->session->set_flashdata('timeout_msg', 'Sorry your session has expired. Please login again');
					}
				}
				redirect('login');
			}
		}
		
		// Load models and library if logged In
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->model('user_m');

		//all languages
		$this->load->model('lang_m');
		$this->data['langs'] = $this->lang_m->get_lang();
	}
}