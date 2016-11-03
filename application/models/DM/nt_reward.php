<?php
class Nt_reward extends DataMapper {

	var $table = 'nt_rewards';
	var $has_one = array("user");
	var $has_many = array("nt_regid","nt_qrcode");
	
	function __construct($id = NULL)
	{
		parent::__construct($id);
	}
}