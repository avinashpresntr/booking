<?php
class Nt_regid extends DataMapper {

	var $table = 'nt_regids';
	var $has_one = array("language");
	var $has_many = array("nt_rating","nt_reward","user","nt_notification");
	
	function __construct($id = NULL)
	{
		parent::__construct($id);
	}
}