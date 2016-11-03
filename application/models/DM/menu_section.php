<?php
class Menu_section extends DataMapper {

	var $table = 'menu_sections';
	var $has_one = array("user");
	var $has_many = array("menu_item");
	
	function __construct($id = NULL)
	{
		parent::__construct($id);
	}
}