<?php

//namespace DM;

class User extends DataMapper {

	var $table = 'users';
	var $has_one = array("golfclub","golfgroup","partner");
	var $has_many = array("course","event","newz","advertisement","nt_rating","nt_course","nt_offer","nt_reward","nt_regid");

	function __construct($id = NULL)
	{
		parent::__construct($id);
	}
}