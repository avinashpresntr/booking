<?php
class Partner extends DataMapper {

	var $table = 'partners';
	var $has_one = array("user");
	
	function __construct($id = NULL)
	{
		parent::__construct($id);
	}
}