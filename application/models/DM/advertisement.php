<?php
class Advertisement extends DataMapper {

	var $table = 'advertisements';
	var $has_many = array("user");
	var $auto_populate_has_many = TRUE;
	
	function __construct($id = NULL)
	{
		parent::__construct($id);
	}
}