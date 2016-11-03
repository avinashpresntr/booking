<?php
class Notification extends DataMapper {

	var $table = 'notifications';
	var $has_one = array("user");
	var $has_many = array("regid");

	function __construct($id = NULL)
	{
		parent::__construct($id);
	}
}