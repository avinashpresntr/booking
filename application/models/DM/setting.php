<?php
class Setting extends DataMapper {

	var $table = 'settings';
	var $has_many = array("user");
	function __construct($id = NULL)
	{
		parent::__construct($id);
	}
}