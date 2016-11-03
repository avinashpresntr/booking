<?php
class Nt_event extends DataMapper {

	var $table = 'nt_events';
	var $has_one = array("user");
	
	function __construct($id = NULL)
	{
		parent::__construct($id);
	}
}