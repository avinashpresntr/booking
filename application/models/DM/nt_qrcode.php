<?php
class Nt_qrcode extends DataMapper {

	var $table = 'nt_qrcodes';
	var $has_one = array("user","nt_reward");
	
	function __construct($id = NULL)
	{
		parent::__construct($id);
	}
}