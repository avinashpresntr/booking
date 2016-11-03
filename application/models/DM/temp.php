<?php
class Temp extends DataMapper {

	var $table = 'temps';
	
	function __construct($id = NULL)
	{
		parent::__construct($id);
	}
}