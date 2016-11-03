<?php
class Item extends DataMapper {

	var $table = 'items';
	var $has_one = array("menu");
	
	function __construct($id = NULL)
	{
		parent::__construct($id);
	}
}