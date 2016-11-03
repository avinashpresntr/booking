<?php
session_start();
class DIP_Controller_Golfclub extends DIP_Controller_Back{

        function __construct(){
                parent::__construct();

                /**
                 * authenticating page access
                 * allowed -> master, hotelgroup(specific), hotel
                 */
                $ses_type = $this->login_m->logtype();
                //$ses_type = 'master';
                if ($ses_type != 2){

                        $u = $this->input->get('user');

                        //if logged in from the master
                        if($ses_type == 0){
                                if(is_numeric($u)){
                                        // user set to the get requested user
                                        $this->data['user'] = $this->user_m->getuser($u);
                                        if($this->data['user']==false) redirect('login/home');
                                }else{
                                        redirect('login/home');
                                }
                        }
                        //if logged in from the father hotelgroup
                        elseif($ses_type==1){
                                $this->data['user'] = $this->user_m->getuser($u);
                                if($this->data['user']==false) redirect('login/home');
                                if($this->data['user']['parrent'] != $this->data['session']['id']){
                                        redirect('login/home');
                                }
                        }
                        // if hotelgroup but not the father
                        else{
                                redirect('login/home');
                        }
                }else{
                        $this->data['user'] = $this->data['session'];
                }
                /**
                 * Navigation
                 */
                  if (isset($this->current_user->language)) {
                    $this->config->set_item('language', $this->current_user->language);
                    $this->session->set_userdata('language', $this->current_user->language);
                }

                 $this->lang->load('message', $_SESSION["lang"]);
                $this->data['nav'] = array(
                                array(
                                       'title' =>$this->lang->line('ClubProfile') ,
                                        'slug' => 'profile',
                                        'icon' => '<i class="fa fa-user"></i>',
                                        'url' => 'golfclub/profile'
                                ),
                                array(
                                        'title' => $this->lang->line('TheCourses').' '.($this->data['user']['level']==3?' ':'<i class="dip-icon fa fa-lock"></i>'),
                                        'slug' => 'courses',
                                        'icon' => '<i class="icon-courses"></i>',
                                        'url' => 'golfclub/courses',
                                        'class' => ($this->data['user']['level']==3?'':'inactive'),
                                ),
                                array(
                                        'title' => $this->lang->line('EventsCalendar').' '.($this->data['user']['level']==3?' ':'<i class="dip-icon fa fa-lock"></i>') ,
                                        'slug' => 'events',
                                        'icon' => '<i class="icon-events"></i>',
                                        'url' => 'golfclub/events',
                                        'class' => ($this->data['user']['level']==3?'':'inactive'),
                                ),
                                array(
                                        'title' => $this->lang->line('ClubNews').' '.($this->data['user']['level']==3?' ':'<i class="dip-icon fa fa-lock"></i>'),
                                        'slug' => 'news',
                                        'icon' => '<i class="icon-news"></i>',
                                        'url' => 'golfclub/news',
                                        'class' => ($this->data['user']['level']==3?'':'inactive'),
                                ),
                                array(
                                        'title' =>$this->lang->line('ClubPartners').' '.($this->data['user']['level']==3?' ':'<i class="dip-icon fa fa-lock"></i>'),
                                        'slug' => 'partners',
                                        'icon' => '<i class="icon-partners"></i>',
                                        'url' => 'golfclub/partners',
                                        'class' => ($this->data['user']['level']==3?'':'inactive'),
                                ),
                                array(
                                        'title' =>$this->lang->line('NextTee'),
                                        'slug' => 'nexttee',
                                        'icon' => '<i class="icon-nexttee"></i>',
                                        'url' => 'golfclub/nexttee'
                                ),
                                array(
                                        'title' => $this->lang->line('LogOut'),
                                        'slug' => 'logout',
                                        'icon' => '<i class="fa fa-power-off"></i>',
                                        'url' => 'logout'
                                ),
                );

                /**
                 * get golfclub's full details
                 */
                $this->load->model('golfclub_m');
                $this->data['client'] = $this->golfclub_m->get_full_details($this->data['user']['id']);
                if($this->data['client'] == FALSE){
                        redirect('login/home');
                }

                // push counter re-setter
                $month=date('M');
                if(!empty($this->data['client']->city) && !empty($this->data['client']->country)){
                  $month = date("M", strtotime(get_timee($this->data['client']->city,$this->data['client']->country)));
                }
                if($this->data['client']->push_month != $month){
                        $this->golfclub_m->reset_push_counter($this->data['user']['id'],$month);
                }
        }
}
