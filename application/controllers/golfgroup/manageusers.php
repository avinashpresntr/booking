<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manageusers extends DIP_Controller_Golfgroup {

	public function index(){
		$this->data['page'] = array(
			'title' => 'Manage Golf Clubs',
			'slug' => 'manage_golfclubs',
			'nav' => 'manage_golfclubs',
			'desc' => 'All Golf Clubs',
			'foot' => 'golfgroup/_foot_manageusers',
			'main' => '_layout_backend',
			'subview' => 'golfgroup/manageusers'
		);
		$this->load->view('_layout_main',$this->data);
		// show($this->data);
	}
	public function get_golfclubs(){
		//join table with golfgroup table to fetch all details
		$table = "(dip_users AS u INNER JOIN (SELECT user_id, country, ios_status, android_status FROM dip_golfclubs) AS g ON u.id=g.user_id)";
		$this->jqgrid->from($table);
		$this->jqgrid->select('id, name, country, type, status, level, creation_date, ios_status, android_status');
		$this->jqgrid->searchable('name, country');
		
		if($this->data['user']['id'])
			$where = 'parrent='.$this->data['user']['id'];
		
		if($this->input->get('getLevel') != ''){
			if(isset($where))
				$where .= ' AND level='.$this->input->get('getLevel');
			else
				$where = 'level='.$this->input->get('getLevel');
		}
		if(isset($where))
			$this->jqgrid->where($where);

		echo decode_ascii($this->jqgrid->get_result('json'));
	}
	public function get_partners($pid=null){
		//join table with golfgroup table to fetch all details
		$table = "(dip_users AS u INNER JOIN (SELECT user_id, country FROM dip_partners) AS g ON u.id=g.user_id)";
		$this->jqgrid->from($table);
		$this->jqgrid->select('id, name, country, type, status, level, creation_date');
		$this->jqgrid->searchable('name, country');
		
		if($pid)
			$where = 'parrent='.$pid;
		
		if(isset($where))
			$this->jqgrid->where($where);

		echo decode_ascii($this->jqgrid->get_result('json'));
	}
}