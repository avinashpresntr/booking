<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mailer extends DIP_Controller_Golfclub {
	
	function __construct(){
		parent::__construct();
	}
	public function index(){
		if($this->input->post()){

			$this->load->library('api');
			$this->api->set_title('Upgrade_request');
		 	$rules = array(
		 		'up_name' =>  array(
						'field'=>'up_name',
						'label'=>'Golf Club',
						'rules'=>'trim|xss_clean|required'
				),
				'up_subject' =>  array(
						'field'=>'up_subject',
						'label'=>'Subject',
						'rules'=>'trim|xss_clean|required'
				),
				'up_sender' =>  array(
						'field'=>'up_sender',
						'label'=>'Name',
						'rules'=>'trim|xss_clean'
				),
				'up_email' =>  array(
						'field'=>'up_email',
						'label'=>'Email',
						'rules'=>'trim|xss_clean|required|valid_email'
				),
				'up_phone' =>  array(
						'field'=>'up_phone',
						'label'=>'Phone',
						'rules'=>'trim|xss_clean'
				),
				'up_msg' =>  array(
						'field'=>'up_msg',
						'label'=>'Message',
						'rules'=>'trim|xss_clean'
				),
		 	);
		 	$this->form_validation->set_rules($rules);
		 	if ($this->form_validation->run() == TRUE){			
				$this->load->library('email');
				$this->email->from($this->input->post('up_email'), $this->input->post('up_sender'));
				$this->email->to('info@golfapp.ch');
				$this->email->subject($this->input->post('up_subject'));
				$message = '
Hello there is request from NEXT TEE CLIENT

Golf Name : '.$this->input->post('up_name').'
'.$this->input->post('up_subject').' level
Name : '.$this->input->post('up_sender').'
Email : '.$this->input->post('up_email').'
Phone : '.$this->input->post('up_phone').'
Message : '.$this->input->post('up_msg');
				$this->email->message($message);
				if ($this->email->send())
					$this->api->response();
				else
					$this->api->error(500);
		 	}else{
		 		$this->api->error(200,'Please fill the form correctly.');
		 	}
		}else redirect('login/home');
	}
}