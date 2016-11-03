<?php
class Golfclub extends DataMapper {

	var $table = 'golfclubs';
	var $has_one = array("user");
	var $has_many = array();
	
	function __construct($id = NULL)
	{
		parent::__construct($id);
	}
}