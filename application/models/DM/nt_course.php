<?php
class Nt_course extends DataMapper {

	var $table = 'nt_courses';
	var $has_one = array("user");
	
	function __construct($id = NULL)
	{
		parent::__construct($id);
	}
}