<?php
class Course extends DataMapper {

	var $table = 'courses';
	var $has_one = array("user");
	var $has_many = array("course_rate_section");
	
	function __construct($id = NULL)
	{
		parent::__construct($id);
	}
}