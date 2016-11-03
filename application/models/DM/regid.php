<?php
class Regid extends DataMapper {

	var $table = 'regids';
	var $has_one = array("user","language");
	var $has_many = array("notification");
	
	function __construct($id = NULL)
	{
		parent::__construct($id);
	}
}