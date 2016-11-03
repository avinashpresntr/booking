<?php
class DIP_Controller_Master extends DIP_Controller_Back{

	function __construct(){
		parent::__construct();

		if ($this->login_m->logtype() != 0){
			redirect('login/home');
		}
			
		$this->data['user'] = $this->data['session'];
		$this->data['nav'] = array(
				array(
					'title' => 'Profile',
					'slug' => 'profile',
					'icon' => '<i class="fa fa-user"></i>',
					'url' => 'master/profile'
				),
				array(
					'title' => 'Manage Users',
					'slug' => 'manageusers',
					'icon' => '<i class="fa fa-server"></i>',
					'url' => 'master/manageusers'
				),
				array(
					'title' => 'Next Tee Settings',
					'slug' => 'nexttee',
					'icon' => '<i class="fa fa-cog"></i>',
					'url' => 'master/nexttee'
				),
				array(
					'title' => 'GolfApp Ad',
					'slug' => 'golfapp_advertising',
					'icon' => '<i class="fa fa-cog"></i>',
					'url' => 'master/golfapp_advertising'
				),
				array(
					'title' => 'Log Out',
					'slug' => 'logout',
					'icon' => '<i class="fa fa-power-off"></i>',
					'url' => 'logout'
				),
		);
	}
}