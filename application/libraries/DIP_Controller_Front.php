<?php
class DIP_Controller_Front extends DIP_Controller{

	function __construct(){
		parent::__construct();
		
		// get request parameters
		$this->uid = $this->input->get('client');
		$this->lid = $this->input->get('language');
		$this->page = $this->input->get('page');
		$this->draw = $this->input->get('draw');
		$this->order = $this->input->get('order');

		$this->load->library('api');
		

		$g = $this->input->get();//important for strict php
		// if no get request
		if(empty($g)){
			$this->api->error(400);
		}

		//check if user exists
		if(isset($this->uid) && empty($this->uid)){
			$this->api->error(100);
		}else{
			$h = new Golfclub();
			$h->include_related('user', array('id', 'name','status','level','creation_date','renewal_date'));
			$h->where_related('user', 'id',$this->uid);
			$h->where_related('user', 'status',1);

			$h->get();
			if(!$h->exists()){
				$this->api->error(101);
			}
		}
		$this->user = $h->stored;
		$this->user->languages = decode_data($this->user->languages);
		
		$this->api->add_data('client',$h->user_name);
		

		
		// all available languages with name
		$str = implode (", ", $this->user->languages);
		$l = new Language();
		$l->where('id IN ('.$str.')')->get();
		$langs = array();
		foreach ($l as $li) {
			$langs[$li->id] = $li->name;
		}
		$this->user->languages = $langs;
		
		// the languages that the client have
		if($this->lid){
			$l = new Language();
			$l->get_by_id($this->lid);
			if(!$l->exists()){
				$this->api->error(102);
			}
			//check if language is available 
			if(!array_key_exists($this->lid, $this->user->languages)){
				$this->api->error(103);
			}
			$this->api->add_data('language',$l->name);
		}else{
			$this->api->add_data('languages',$langs);
		}
		// show($this->user);
	}
}