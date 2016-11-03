<?php
class Nt_offer extends DataMapper {

	var $table = 'nt_offers';
	var $has_one = array("user");
	
	function __construct($id = NULL)
	{
		parent::__construct($id);
	}
}