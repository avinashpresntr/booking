<?php
class Event extends DataMapper {

	var $table = 'events';
	var $has_one = array("user");
	
	function __construct($id = NULL)
	{
		parent::__construct($id);
	}
}