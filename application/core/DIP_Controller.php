<?php
class DIP_Controller extends CI_Controller{

	public $data = array(); //$this->data array will be used to hold all page datas available on views
	
	function __construct(){
		parent::__construct();
		$this->data['errors'] = array();
		$this->data['meta']['title'] = config_item('site_name');
		$this->data['meta']['desc'] = config_item('meta_desc');
		$this->data['meta']['key'] = config_item('meta_key');
		$this->data['meta']['demoimg'] = config_item('demo_img');

		//user levels
		$this->data['user_types'] = config_item('user_types');
		$this->data['user_levels'] = config_item('user_levels');
		$this->load->helper('text');
	}
}