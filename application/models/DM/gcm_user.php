<?php
class Gcm_user extends DataMapper {

	var $table = 'gcm_users';
	var $has_one = array("user","language");
	
	function __construct($id = NULL)
	{
		parent::__construct($id);
	}
}