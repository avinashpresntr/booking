<?php
class Nt_rating extends DataMapper {

	var $table = 'nt_ratings';
	var $has_one = array("regid","user");
	
	function __construct($id = NULL)
	{
		parent::__construct($id);
	}
}