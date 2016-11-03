<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends DIP_Controller_Partner {

        public function index(){
               
                // when the form is submitted
        			if(is_dir(FCPATH."application/language/".$_SESSION["lang1"]))
					{
						$this->config->set_item('language', $_SESSION["lang1"]);
						$this->lang->load('message',$_SESSION["lang1"]);
					}
					else
					{
						$this->config->set_item('language','english');
						$this->lang->load('message','english');
					}
               //echo '<pre>';
              // print_r($this->config);
              // echo '</pre>';
					//echo $_SESSION["lang1"];
                if($this->input->post()){
                        $rules = $this->partner_m->profile_rules;
                        $this->form_validation->set_rules($rules);
                        if ($this->form_validation->run() == TRUE){
                                $post = $this->input->post();
                                $this->partner_m->save($post,$this->data['user']['id']);
                                // show($post);
                        }
                }

                
                $this->data['partner'] = $this->partner_m->get_full_details($this->data['user']['id']);
                if(!$this->data['partner']->id)
                        redirect('login/home');

                // parent details
                $this->load->model('golfclub_m');
                $this->data['partner']->parent = $this->golfclub_m->get_full_details($this->data['partner']->parrent);

                $this->load->model('xtra_m');
                $this->data['countries'] = $this->xtra_m->get_all_countries();
                
                $this->data['page'] = array(
                        'title' => $this->lang->line('Profile') ,
                        'slug' => 'profile',
                        'nav' => 'profile',
                        'desc' => $this->lang->line('Yourprofiledetails'),
                        'main' => '_layout_backend',
                        'subview' => 'partner/profile'
                );
                $this->load->view('_layout_main',$this->data);
                // show($this->data['partner']);
        }
}
