<?php
class Facility extends DataMapper {

	var $table = 'facilities';
	var $has_many = array("course");
	
	function __construct($id = NULL)
	{
		parent::__construct($id);
	}
}