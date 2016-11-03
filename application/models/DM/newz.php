<?php
class Newz extends DataMapper {

	var $table = 'newzs';
	var $has_one = array("user");
	var $created_field = 'updated';
    var $updated_field = 'updated';
    
	function __construct($id = NULL)
	{
		parent::__construct($id);
	}
}