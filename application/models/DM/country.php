<?php
class Country extends DataMapper {

	var $table = 'countries';
	var $has_one = array("currency");
	var $has_many = array("user");
	
	function __construct($id = NULL)
	{
		parent::__construct($id);
	}
}