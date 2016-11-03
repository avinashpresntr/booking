<?php
class Course_rate_section extends DataMapper {

	var $table = 'course_rate_sections';
	var $has_one = array("course");
	
	function __construct($id = NULL)
	{
		parent::__construct($id);
	}
}