<?php
class Course_rate extends DataMapper {

	var $table = 'course_rates';
	var $has_one = array("course_rate_section");
	
	function __construct($id = NULL)
	{
		parent::__construct($id);
	}
}