<?php
class DIP_Controller_Golfgroup extends DIP_Controller_Back{

	function __construct(){
		parent::__construct();
		/**
		 * authenticating page access
		 * allowed -> master, hotelgroup
		 */
		$ses_type = $this->login_m->logtype();
		if ($ses_type != 1){
			
			if($ses_type == 0){
				$u = $this->input->get('user');
				if(is_numeric($u)){
					// user set to the get requested user 
					$this->data['user'] = $this->user_m->getuser($u);
				}else{
					redirect('login/home');
				}
			}else{
				redirect('login/home');
			}
		}else{
			$this->data['user'] = $this->data['session'];
		}

		/**
		 * Navigation
		 */
		$this->data['nav'] = array(
				array(
					'title' => 'Profile',
					'slug' => 'profile',
					'icon' => '<i class="fa fa-user"></i>',
					'url' => 'golfgroup/profile'
				),
				array(
					'title' => 'Manage Golf Clubs',
					'slug' => 'manage_golfclubs',
					'icon' => '<i class="fa fa-user"></i>',
					'url' => 'golfgroup/manageusers'
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