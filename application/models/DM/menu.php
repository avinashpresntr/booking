<?php
class Menu extends DataMapper {

	var $table = 'menus';
	var $has_one = array("menu_section");
	
	function __construct($id = NULL)
	{
		parent::__construct($id);
	}
}