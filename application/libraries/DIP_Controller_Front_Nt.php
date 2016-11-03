<?php
class DIP_Controller_Front_Nt extends DIP_Controller{
	public $setting = array();
	function __construct(){
		parent::__construct();
		$this->load->library('api');
		$api_token = $this->input->get("token");

		// if($api_token != "dip&d3v%0x0"){
		// 	$this->api->error(400);
		// }
		
		$set = new Setting();
		$set->get_by_user_id(1);

		$this->setting = array();
		foreach ($set as $s) {
			$this->setting[$s->name] = decode_data($s->value);
		}
	}
}