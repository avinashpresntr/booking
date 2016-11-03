<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Golfapp_advertising extends DIP_Controller_Master {

	public function index(){
		$this->data['page'] = array(
			'title' => 'GolfApp Ad',
			'slug' => 'golfapp_advertising',
			'nav' => 'golfapp_advertising',
			'desc' => 'Manage advertisments for Golfapp',
			'main' => '_layout_backend',
			'subview' => 'master/advertising',
			'foot' => 'master/advertising_foot',
		);
		$this->load->view('_layout_main',$this->data);
	}
	public function get_all() {
		$this->jqgrid->from('dip_advertisements');
		$this->jqgrid->select('id, pics, url, name, startdate, enddate');
		$this->jqgrid->searchable('name, url, startdate, enddate');
		echo $this->jqgrid->get_result('json');
	}
	public function edit($id=null) {

		$this->load->model('adv_m');
		$this->load->model('xtra_m');
		$this->data['countries'] = $this->xtra_m->get_all_countries();
		$this->data['row'] = $this->adv_m->get_details($id);
		$this->data['row']->clients = array();
		!$id || $this->data['row']->clients = $this->adv_m->get_rel_clients($id);

		if($this->input->post()){
			$rules = $this->adv_m->rules;
			$this->form_validation->set_rules($rules);
		 	if ($this->form_validation->run() == TRUE){
				$post = $this->input->post();
				$this->adv_m->save($post,$id);
				// show($post);
		 	}
		}
		$this->data['page'] = array(
			'title' => 'GolfApp Ad',
			'slug' => 'golfapp_advertising',
			'nav' => 'golfapp_advertising',
			'desc' => 'Edit advertisments for Golfapp',
			'main' => '_layout_backend',
			'subview' => 'master/advertising_edit'
		);
		$this->load->view('_layout_main',$this->data);
		// show($this->data['row']);
	}
	public function delete(){
		$this->load->model('adv_m');
		if($this->input->post('multiID')){
			foreach ($this->input->post('multiID') as $key => $value) {
				$this->adv_m->delete($value);
			}
			echo true;
		}
		if($this->input->post('deleteAll')){
			$this->adv_m->delete_all();
			echo true;
		}
		else 
			echo $this->adv_m->delete($this->input->post('id'));
	}
	public function get_clients() {
		$search = $this->input->post('search');
		$exclude = $this->input->post('exclude');
		$country = $this->input->post('country');
		$langs = $this->input->post('langs');
		$page = $this->input->post('page');
		$draw = 2000;

		$u = new User();
		$u->select('id,name');
		$u->where(array('type'=>2,'status'=>1,'level'=>3));
		if($country!=null){
			$u->where_in_related('golfclub','country',$country);
		}
		if($langs!=null){
			$u->group_start();
			foreach ($langs as $key => $value) {
				if($key==0)
					$u->like_related('golfclub','languages','"'.$value.'"');
				else
					$u->or_like_related('golfclub','languages','"'.$value.'"');
			}
			$u->group_end();
		}
		$u->where_not_in('id',explode( ',',$exclude));
		
		if($search!=null)
			$u->like('name',$search);

		$u->order_by('name', 'asc');
		$clone = $u->get_clone();
		// echo $u->get_sql();
		$u->get_paged_iterated($page,$draw);
		
		$total = $clone->count();
		$index = $page*$draw - $draw;

		$res = array();
		foreach ($u as $r) {
			if($total>$index){
				$i = new stdClass;
				$i->id = $r->id;
				$i->name = decode_ascii($r->name);
				$res[] = $i;
			}
		}
		echo encode_data($res);
	}
}