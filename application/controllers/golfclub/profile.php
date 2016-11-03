<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends DIP_Controller_Golfclub {

      public function index(){
				//$this->config->set_item('language', 'french'); 
					
				
					$nu = new User();
					//echo $this->data['user']['id'];
					$userdata = $nu->get_by_id($this->data['user']['id']);
					if($userdata->type==1)
						$nh = new Golfgroup();
					elseif($userdata->type==2)
						$nh = new Golfclub();
					else
						$nh = new Partner();					
					$nh->where(array('user_id' => $this->data['user']['id']))->get();

					//echo $nh->default_language.'language';
					
					
					$query = $this->db->query("SELECT * from dip_languages WHERE id =".$nh->default_language); 
   					$data = $query->result();	
					//echo $_SESSION['lang1'];
					//echo $_SESSION['lang'];
								
					if(is_dir(FCPATH."application/language/".$_SESSION['lang1']))
					{
						//echo "in";
						$this->config->set_item('language', $_SESSION['lang1']);
						$this->lang->load('message',$_SESSION['lang1']);
					}
					else
					{
						//echo "ourt";
						$this->config->set_item('language','english');
						$this->lang->load('message','english');
					}
					
					
					
                if($this->input->post()){
                        $rules = $this->golfclub_m->profile_rules;
                        $this->form_validation->set_rules($rules);
                        if ($this->form_validation->run() == TRUE){
                                $post = $this->input->post();
                                $s = $this->golfclub_m->save($post,$this->data['user']['id']);

                                if($s==true)
								{
									if($this->data['user']['id']==$this->data['session']['id'])
										$this->user_m->log($this->data['user']['id'],'2');
										$this->session->set_flashdata('success_msg',$this->lang->line('message_save_success'));
										redirect(current_full_url());
                                }
                                // show($post);
                        }
                }
                $this->data['golfclub'] = $this->data['client'];
                $this->data['golfclub']->parent = $this->user_m->getuser($this->data['golfclub']->parrent);
				
				//show($this->data['golfclub']);

                $this->load->model('xtra_m');
                $this->data['countries'] = $this->xtra_m->get_all_countries();
				$this->data['language_1'] = strtolower($data[0]->name);
				$this->data['level_1'] = $userdata->level;
                
                // nexttee push notification
                if(empty($this->data['golfclub']->nt_push_notification)){
                        $sp2 = new Setting();
                        $sp2->where(array('user_id'=>1,'name'=>'nt_push'))->get();
                        $push = decode_data($sp2->value);
                        $pushl = $push[$this->data['golfclub']->level];
                        !empty($pushl)||$pushl=0;
                        $this->data['golfclub']->nt_push_notification = $pushl;
                }


                $this->data['page'] = array(
                        'title' => $this->lang->line('Profile'),
                        'slug' => 'profile',
                        'nav' => 'profile',
                        'desc' => $this->lang->line('Yourprofiledetails'),
                        'main' => '_layout_backend',
                        'subview' => 'golfclub/profile'
                );
				$this->load->view('_layout_main',$this->data);
				
                // show($this->data);
        }
}
