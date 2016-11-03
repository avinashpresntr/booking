<?php
class Menu_item extends DataMapper {

	var $table = 'menu_items';
	var $has_one = array("menu_section");
	
	function __construct($id = NULL)
	{
		parent::__construct($id);
	}
}