<?php
class Lang_m extends DIP_Model{

	function __construct(){
		parent::__construct();
	}

	/**
	 * get hotel details from database table
	 */
	public function get_lang(){
		$langs = new Language();
		$langs->get();
		$result = array();
		foreach ($langs as $lang)
		{
		    $result[$lang->id] = $lang->name;
		}
		return $result;
	}
}	