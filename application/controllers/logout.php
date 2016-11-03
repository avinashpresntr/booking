<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends DIP_Controller_Back {
	
	function __construct(){
		parent::__construct();
		
	}
	public function index(){
		session_unset(); 
		// session_destroy();
		$this->session->sess_destroy();
		redirect('login');
	}
}