<?php
class Package extends DataMapper {

	var $table = 'packages';
	var $has_one = array("user");
	
	function __construct($id = NULL)
	{
		parent::__construct($id);
	}
}