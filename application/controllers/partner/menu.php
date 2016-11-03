<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends DIP_Controller_Partner {

	function __construct(){
		parent::__construct();
		$this->load->model('menu_m');
		if($this->data['client']->type !=6)
			redirect(site_full_url('partner/profile'));
	}
	public function index(){
		$this->load->model('xtra_m');
		$this->data['currencies'] = $this->xtra_m->get_all_currencies();

		$this->data['client']->currency = $this->xtra_m->get_currency_by_country($this->data['client']->country);

		$this->data['page'] = array(
			'title' => $this->lang->line('ManageYourMenu') ,
			'slug' => 'menu',
			'nav' => 'menu',
			'desc' => $this->lang->line('TheMenu'),
			'main' => '_layout_backend',
			'subview' => 'partner/menu',
			'foot' => 'partner/menu_foot',
		);
		$this->load->view('_layout_main',$this->data);
		// show($this->data);
	}


	public function get_menu_sections(){
		$this->jqgrid->from('dip_menu_sections');
		$this->jqgrid->select('id, user_id, name, position');
		$this->jqgrid->searchable('name');
		$this->jqgrid->where('user_id='.$this->data['user']['id']);
		echo escape_quote($this->jqgrid->get_result('json'));
	}
	public function get_menu_section($id=null){
		echo str_replace("\'","'",encode_data($this->menu_m->get_menu_section($this->data['user']['id'],$id)));
	}
	public function save_menu_section($id=null){
		echo $this->menu_m->save_menu_section($this->input->post(),$this->data['user']['id'],$id);
	}
	public function delete_menu_section(){
		echo $this->menu_m->delete_menu_section($this->data['user']['id'],$this->input->post('id'));
	}
	public function position_menu_section(){
		echo $this->menu_m->position_menu_section($this->input->post('position'),$this->data['user']['id'],$this->input->post('id'));
	}




	public function get_menu_items($id){
		$this->jqgrid->from('dip_menu_items');
		$this->jqgrid->select('id, menu_section_id, descr, price, currency, position');
		$this->jqgrid->searchable('descr,price');
		$this->jqgrid->where('menu_section_id='.$id);
		echo escape_quote($this->jqgrid->get_result('json'));
	}
	public function get_menu_item($pid,$id=null){
		echo str_replace("\'","'",encode_data($this->menu_m->get_menu_item($pid,$id)));
	}
	public function save_menu_item($pid,$id=null){
		echo $this->menu_m->save_menu_item($this->input->post(),$pid,$id);
	}
	public function position_menu_item(){
		echo $this->menu_m->position_menu_item($this->input->post('position'),$this->input->post('parent'),$this->input->post('id'));
	}
	public function delete_menu_item(){
		echo $this->menu_m->delete_menu_item($this->input->post('parent'),$this->input->post('id'));
	}
}
