<?php
class Language extends DataMapper {

	var $table = 'languages';
	var $has_many = array("gcm_user");

	function __construct($id = NULL)
	{
		parent::__construct($id);
	}
}