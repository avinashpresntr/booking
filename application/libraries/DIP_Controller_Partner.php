<?php
session_start();
class DIP_Controller_Partner extends DIP_Controller_Back{

        function __construct(){
                parent::__construct();
                
                /**
                 * authenticating page access
                 * allowed -> master, golfclub, golfgroup
                 */
                $ses_type = $this->login_m->logtype();
                
                if ($ses_type <= 2){
                
                        $u = $this->input->get('user');

                        //if logged in from the master
                        if($ses_type == 0){
                                if(is_numeric($u)){
                                        // user set to the get requested user 
                                        $this->data['user'] = $this->user_m->getuser($u);
                                }else{
                                        redirect('login/home');
                                }
                        }
                        //if logged in from the father golfclub
                        elseif($ses_type==2){
                                $this->data['user'] = $this->user_m->getuser($u);
                                if($this->data['user']['parrent'] != $this->data['session']['id']){
                                        redirect('login/home');
                                }
                        }
                        // if logged in from the father golfgroup
                        elseif($ses_type==1){
                                $this->data['user'] = $this->user_m->getuser($u);
                                $golfclub = $this->user_m->getuser($this->data['user']['id']);
                                if($golfclub['parrent'] != $this->data['session']['id']){
                                        redirect('login/home');
                                }
                        }else{
                                redirect('login/home');
                        }
                }else{
                        $this->data['user'] = $this->data['session'];
                }

                /**
                 * Navigation
                 */
                 
                  $this->lang->load('message', $_SESSION["lang"]);
                $this->data['nav'] = array(
                                array(
                                        'title' => $this->lang->line('Profile'),
                                        'slug' => 'profile',
                                        'icon' => '<i class="fa fa-user"></i>',
                                        'url' => 'partner/profile'
                                ),
                                array(
                                        'title' => $this->lang->line('Description_left_menu') ,
                                        'slug' => 'description',
                                        'icon' => '<i class="icon-descritption"></i>',
                                        'url' => 'partner/description'
                                ),
                );
                switch ($this->data['user']['type']) {
                        case 3:
                                $this->data['nav'][] = array(
                                        'title' =>$this->lang->line('HotelPackages') ,
                                        'slug' => 'packages',
                                        'icon' => '<i class="icon-package1"></i>',
                                        'url' => 'partner/packages'
                                );
                                break;
                        case 4:
                                $this->data['nav'][] = array(
                                        'title' =>$this->lang->line('Tarif&Packages')  ,
                                        'slug' => 'packages',
                                        'icon' => '<i class="icon-package1"></i>',
                                        'url' => 'partner/packages'
                                );
                                break;
                        case 5:
                                $this->data['nav'][] = array(
                                        'title' =>$this->lang->line('Proshopoffers') ,
                                        'slug' => 'packages',
                                        'icon' => '<i class="icon-package1"></i>',
                                        'url' => 'partner/packages'
                                );
                                break;
                        case 6:
                                $this->data['nav'][] = array(
                                        'title' =>$this->lang->line('Suggestions'),
                                        'slug' => 'packages',
                                        'icon' => '<i class="icon-suggestion"><span class="path1"></span><span class="path2"></span></i>',
                                        'url' => 'partner/packages'
                                );
                                $this->data['nav'][] = array(
                                        'title' =>$this->lang->line('Menu') ,
                                        'slug' => 'menu',
                                        'icon' => '<i class="icon-restaurantmenu"></i>',
                                        'url' => 'partner/menu'
                                );
                                break;
                        default:
                                break;
                }

                /**
                 * Getting all languages
                 */
                $this->load->model('lang_m');
                $this->data['langs'] = $this->lang_m->get_lang();

                /**
                 * get golfclub's languages and default languages
                 */
                $this->load->model('partner_m');
                $this->data['client'] = $this->partner_m->get_full_details($this->data['user']['id']);
                if(!$this->data['client']->id)
                        redirect('login/home');
                
                $this->load->model('golfclub_m');
                $this->data['client']->parent = $this->golfclub_m->get_full_details($this->data['client']->parrent);
        
                $this->data['client']->languages = $this->data['client']->parent->languages;
                $this->data['client']->default_language = $this->data['client']->parent->default_language;


                // push counter re-setter
                $month=date('M');
                if($this->data['client']->push_month != $month){
                        $this->partner_m->reset_push_counter($this->data['user']['id'],$month);
                }
        }
}
