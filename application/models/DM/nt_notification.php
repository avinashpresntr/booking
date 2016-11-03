<?php
class Nt_notification extends DataMapper {

	var $table = 'nt_notifications';
	var $has_one = array("user","language");
	var $has_many = array("nt_regid");
	
	function __construct($id = NULL)
	{
		parent::__construct($id);
	}
}