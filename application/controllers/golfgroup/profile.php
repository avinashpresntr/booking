<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends DIP_Controller_Golfgroup {

	public function index()
	{
		$this->load->model('golfgroup_m');
		$this->data['golfgroup'] = $this->golfgroup_m->get_full_details($this->data['user']['id']);
		if(!$this->data['golfgroup']->id)
			redirect('login/home');
		
		$this->data['page'] = array(
			'title' => 'Profile',
			'slug' => 'profile',
			'nav' => 'profile',
			'desc' => 'Your profile details',
			'main' => '_layout_backend',
			'subview' => 'golfgroup/profile'
		);
		$this->load->view('_layout_main',$this->data);
		// show($this->data);
	}
}
