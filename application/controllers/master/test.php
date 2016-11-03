<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends DIP_Controller_Master {

	public function index(){
		$this->data['page'] = array(
			'title' => 'Profile',
			'slug' => 'profile',
			'nav' => 'profile',
			'desc' => 'All profile',
			'main' => '_layout_backend',
			'subview' => 'master/test',
		);
		$this->load->view('_layout_main',$this->data);
	}

}