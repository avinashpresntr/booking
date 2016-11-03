<?php
class Currency extends DataMapper {

	var $table = 'currencies';
	var $has_many = array("country");
	
	function __construct($id = NULL)
	{
		parent::__construct($id);
	}
}