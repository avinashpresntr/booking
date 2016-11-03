<?php
class Golfgroup extends DataMapper {

	var $table = 'golfgroups';
	var $has_one = array("user");
	
	function __construct($id = NULL)
	{
		parent::__construct($id);
	}
}