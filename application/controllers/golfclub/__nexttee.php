<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nexttee extends DIP_Controller_Golfclub {
        function __construct(){
                parent::__construct();

                $sp2 = new Setting();
                $sp2->where('user_id',1)->get();
                foreach ($sp2 as $s) {
                        $this->data['settings'][$s->name]= decode_data($s->value);
                }

                $this->data['page'] = array(
                        'title' =>$this->lang->line('NextTee'),
                        'slug' => 'nexttee',
                        'nav' => 'nexttee',
                        'desc' => 'Next Tee details',
                        'main' => '_layout_backend',
                );
                $this->data['page']['subnav'] = array(
                        array(
                                'title' => 'Club details',
                                'active' => false,
                                'disabled' => false,
                                'url' => site_full_url('golfclub/nexttee'),
                        ),
                        array(
                                'title' => 'The Courses',
                                'active' => false,
                                'disabled' => false,
                                'url' => site_full_url('golfclub/nexttee/courses'),
                        ),
                        array(
                                'title' => 'Special Offers '.($this->data['settings']['nt_offers'][$this->data['user']['level']] == 0 ? '<i class="dip-icon-t fa fa-lock"></i>':'') ,
                                'active' => false,
                                'disabled' => ($this->data['settings']['nt_offers'][$this->data['user']['level']] == 0 ? true:false),
                                'url' => site_full_url('golfclub/nexttee/offers'),
                        ),
                        array(
                                'title' => 'Reward Programs '.($this->data['settings']['nt_rewards'][$this->data['user']['level']] == 0 ? '<i class="dip-icon-t fa fa-lock"></i>':'') ,
                                'active' => false,
                                'disabled' => ($this->data['settings']['nt_rewards'][$this->data['user']['level']] == 0 ? true:false),
                                'url' => site_full_url('golfclub/nexttee/rewards'),
                        ),
                );


                // change the languages as per nexttee settings
                $sp1 = new Setting();
                $sp1->where(array('user_id'=>1, 'name'=>'nt_languages'))->get();
                $this->data['client']->languages = decode_data($sp1->value);

                $this->load->model('nexttee_m');
        }
        public function index(){

                if($this->input->post()){
                         $rules = array();
                         foreach ($this->data['client']->languages as $key => $value) {
                                 $required_if = $this->input->post('descr')[$value] ? '|required' : '' ;
                                $rules['descr['.$value.']'] = array(
                                                'field'=>'descr['.$value.']',
                                                'label'=> 'Description for '.$this->data['langs'][$value],
                                                'rules'=>'xss_clean'
                                );
                         }
                         $this->form_validation->set_rules($rules);
                         if ($this->form_validation->run() == TRUE){

                                $post = $this->input->post();
                                $s = $this->nexttee_m->save_details($post,$this->data['user']['id']);

                                //logs for activites
                                if($s==true){
                                        if($this->data['user']['id']==$this->data['session']['id'])
                                                $this->user_m->log($this->data['user']['id'],'3');
                                        $this->session->set_flashdata('success_msg', 'The Details is saved successfully');
                                        redirect(current_full_url());
                                }
                                // show($post);
                         }
                }

                $this->data['client']->descr =  decode_data($this->data['client']->descr);
                $this->data['client']->pics =  decode_data($this->data['client']->pics);
                $this->data['client']->logo =  decode_data($this->data['client']->logo);
                $this->data['client']->facilities =  decode_data($this->data['client']->facilities);

                $this->load->model('xtra_m');
                $this->data['facilities'] = $this->xtra_m->get_all_facilities();
                
                $this->data['page']['desc'] = 'Next Tee Details';
                $this->data['page']['subview'] = 'golfclub/nexttee/details';
                $this->data['page']['subnav'][0]['active'] =true;
                $this->load->view('_layout_main',$this->data);
                // show($this->data);
        }
        /**
         * Courses
         */
        public function courses(){
                $this->data['page']['desc'] = 'Next Tee Courses';
                $this->data['page']['subview'] = 'golfclub/nexttee/courses';
                $this->data['page']['foot'] = 'golfclub/nexttee/courses_foot';
                $this->data['page']['subnav'][1]['active'] = true;
                $this->load->view('_layout_main',$this->data);
                // show($this->data);
        }
        public function get_courses(){
                $this->jqgrid->from('dip_nt_courses');
                $this->jqgrid->select('id, user_id, name, holes, position');
                $this->jqgrid->searchable('name');
                $this->jqgrid->where('user_id='.$this->data['user']['id']);
                echo escape_quote($this->jqgrid->get_result('json'));
        }
        public function edit_courses($id=null){

                $this->data['row'] = $this->nexttee_m->get_course($this->data['user']['id'],$id);
                !$id || !empty($this->data['row']->id) || redirect(site_full_url('golfclub/nexttee/edit_courses'));
                
                $this->load->model('xtra_m');
                //if no currency is previously set
                if(empty($this->data['row']->range_currency))
                        $this->data['row']->range_currency = $this->xtra_m->get_currency_by_country($this->data['client']->country);

                $this->data['facilities'] = $this->xtra_m->get_all_facilities();
                $this->data['currencies'] = $this->xtra_m->get_all_currencies();
                $this->data['ratings'] = config_item('ratings');
                $this->data['dificulties'] = config_item('dificulties');
                $this->data['welcome_options'] = config_item('welcome_options');
                $this->data['weekdays'] = config_item('weekdays');

                if($this->input->post()){
                         $rules = $this->nexttee_m->course_rules;
                         foreach ($this->data['client']->languages as $key => $value) {
                                 $required_if = $this->input->post('descr')[$value] ? '|required' : '' ;
                                 $rules['name['.$value.']'] = array(
                                                'field'=>'name['.$value.']',
                                                'label'=> 'Name for '.$this->data['langs'][$value],
                                                'rules'=>'xss_clean'.$required_if
                                );
                                $rules['descr['.$value.']'] = array(
                                                'field'=>'descr['.$value.']',
                                                'label'=> 'Description for '.$this->data['langs'][$value],
                                                'rules'=>'xss_clean'
                                );
                         }
                         $this->form_validation->set_rules($rules);
                         if ($this->form_validation->run() == TRUE){
                                $post = $this->input->post();
                                if($post['price_opt']==1){
                                        $post['range_to']='';
                                }
                                if($post['price_opt']==3){
                                        $post['range_from']='On request';
                                        $post['range_to']='';
                                        $post['range_currency']=null;
                                }
                                if($post['opening_opt']==2){
                                        $post['open_from']='Weather dependent';
                                        $post['open_to']='';
                                }
                                $s = $this->nexttee_m->save_course($post,$this->data['user']['id'],$id);

                                //logs for activites
                                if($s){
                                        if($this->data['user']['id']==$this->data['session']['id'])
                                                $this->user_m->log($this->data['user']['id'],'4');
                                        !$id ||redirect(site_full_url('golfclub/nexttee/courses'));
                                        $this->session->set_flashdata('success_msg', 'The Course is saved successfully');
                                        redirect(site_full_url('golfclub/nexttee/courses/edit/'.$s));
                                }
                                // show($post);
                         }
                }

                $this->data['page']['desc'] = 'Next Tee Course Details';
                $this->data['page']['subview'] = 'golfclub/nexttee/courses_edit';
                $this->data['page']['subnav'][1]['active'] =true;
                $this->load->view('_layout_main',$this->data);
                // show($this->data);
        }
        public function delete_courses(){
                echo $this->nexttee_m->delete_course($this->data['user']['id'],$this->input->post('id'));
        }
        public function position_courses(){
                echo $this->nexttee_m->position_course($this->data['user']['id'],$this->input->post('id'),$this->input->post('position'));
        }
        /**
         * Offers
         */
        public function offers(){
                $this->data['page']['desc'] = 'Next Tee Offers';
                $this->data['page']['subview'] = 'golfclub/nexttee/offers';
                $this->data['page']['foot'] = 'golfclub/nexttee/offers_foot';
                $this->data['page']['subnav'][2]['active'] =true;
                $this->load->view('_layout_main',$this->data);
                // show($this->data);
        }
        public function get_offers(){
                $this->jqgrid->from('dip_nt_offers');
                $this->jqgrid->select('id, user_id, title, descr, startdate, enddate, position');
                $this->jqgrid->searchable('title, descr');
                $this->jqgrid->where('user_id='.$this->data['user']['id']);
                echo escape_quote($this->jqgrid->get_result('json'));
        }
        public function edit_offers($id=null) {
                $ul = $this->data['user']['level'];
                if(isset($this->data['settings']['nt_offers'][$ul]) && !empty($this->data['settings']['nt_offers'][$ul]))
                        $no_offer = $this->data['settings']['nt_offers'][$ul];
                else $no_offer = 0;

                //check for availability
                $r = new Nt_offer();
                $r->get_by_user_id($this->data['user']['id']);
                $this->data['row'] = $this->nexttee_m->get_offer($this->data['user']['id'],$id);
                if(empty($this->data['row']->id)){
                        !$id || redirect(site_full_url('golfclub/nexttee/edit_offers'));
                        if($r->result_count() >= $no_offer){
                                $this->session->set_flashdata('error_msg', 'You need to upgrade to creat more Offers');
                                redirect(site_full_url('golfclub/nexttee/offers'));
                        }
                }

                // makeing the nt push counter as counter
                if($this->data['client']->nt_push_notification){
                        $this->data['client']->push_notification = $this->data['client']->nt_push_notification;
                }else{
                        if(isset($this->data['settings']['nt_push'][$ul]) && !empty($this->data['settings']['nt_push'][$ul]))
                                $this->data['client']->push_notification = $this->data['settings']['nt_push'][$ul];
                        else
                                $this->data['client']->push_notification = 0;
                }
                // also the counter
                if($this->data['client']->nt_push_counter)
                        $this->data['client']->push_counter =  $this->data['client']->nt_push_counter;
                else
                        $this->data['client']->push_counter =  0;

                // make sure counter is always lower than total
                if($this->data['client']->push_counter > $this->data['client']->push_notification){
                        
                }


                if($this->input->post()){
                         $rules = $this->nexttee_m->offer_rules;
                         foreach ($this->data['client']->languages as $key => $value) {
                                 $required_if = $this->input->post('descr')[$value] ? '|required' : '' ;
                                 $rules['title['.$value.']'] = array(
                                                'field'=>'title['.$value.']',
                                                'label'=> 'Name for '.$this->data['langs'][$value],
                                                'rules'=>'xss_clean'.$required_if
                                );
                                $rules['descr['.$value.']'] = array(
                                                'field'=>'descr['.$value.']',
                                                'label'=> 'Description for '.$this->data['langs'][$value],
                                                'rules'=>'xss_clean'
                                );
                         }
                         $this->form_validation->set_rules($rules);
                         if ($this->form_validation->run() == TRUE){
                                $post = $this->input->post();
                                $pkg = $this->nexttee_m->save_offer($post,$this->data['user']['id'],$id);
                                // show($post);
                                
                                //logs for activites
                                if($pkg->id){
                                        if($this->data['user']['id']==$this->data['session']['id'])
                                                $this->user_m->log($this->data['user']['id'],'5');
                                }

                                //if saved successfully save notification
                                if($pkg->id && !isset($post['draft'])){
                                        
                                        $usid = $this->data['user']['id'];
                                        $push = array(
                                                'sid' => $usid,
                                                'sname' => $this->data['user']['name'],
                                                'post_id' => $pkg->id,
                                                'post_type' => 'Offer'
                                        );
                                        
                                        // send notification message if given
                                        $total_push = $this->data['client']->push_notification;
                                        $used_push = $this->data['client']->push_counter;
                                        if(isset($post['push']) && ($total_push > $used_push)){
                                                
                                                // change the languages as per nexttee settings
                                                $sp1 = new Setting();
                                                $sp1->where(array('user_id'=>1, 'name'=>'nt_radius'))->get();
                                                $radius = decode_data($sp1->value);

                                                //now send push notification
                                                $this->load->library('gcm');
                                                $this->load->library('apn');
                                                $this->apn->payloadMethod = 'enhance';
                                                $found=false;
                                                $counter = false;
                                                foreach ($post['push'] as $lang_id => $value) {
                                                        
                                                        //send notification for this lang_id
                                                        if(!empty($value) && !empty($pkg->title[$lang_id])){
                                                                
                                                                $allrecp = array();
                                                                // devices with user in favourit
                                                                $recipent1 = new Nt_regid();
                                                                $recipent1->where_related_user('id' , $this->data['user']['id']);
                                                                $recipent1->where('language_id', $lang_id)->get();
                                                                foreach ($recipent1 as $r) {
                                                                        $allrecp[$r->id] = $r->id;
                                                                }
                                                                // device in the radius
                                                                $recipent2 = new Nt_regid();
                                                                $recipent2->select("* , ( 6371 * acos( cos( radians(".$this->data['client']->latitude.") ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(".$this->data['client']->longitude.") ) + sin( radians(".$this->data['client']->latitude.") ) * sin( radians( latitude ) ) ) )*1.3 AS distance ");
                                                                $recipent2->where('language_id', $lang_id);
                                                                $recipent2->having('distance <', $radius[0]);
                                                                $recipent2->get();
                                                                foreach ($recipent2 as $r) {
                                                                        $allrecp[$r->id] = $r->id;
                                                                }
                                                                $allrecp = array_keys($allrecp);
                                                                
                                                                unset($recipent);

                                                                if(!empty($allrecp)){
                                                                        $recipent = new Nt_regid();
                                                                        $recipent->where_in('id',$allrecp)->get();
                                                                }
                                                                if(isset($recipent) && $recipent->exists()){

                                                                        $found=true;
                                                                        $msgIos = $push;
                                                                        $msgAndroid = array(
                                                                                'package' => $push['post_id'],
                                                                                'name' => $push['sname'],
                                                                                'page' => $push['post_type'],
                                                                                'sid' => $push['sid'],
                                                                                'title' => $value
                                                                        );


                                                                        // create Notification and save with device relations 
                                                                        $noti = new Nt_notification();
                                                                        $noti->where(array('post_id'=>$push['post_id'],
                                                                                'post_type'=>$push['post_type'],'language_id'=>$lang_id))->get();

                                                                        $noti->post_id = $push['post_id'];
                                                                        $noti->post_type = $push['post_type'];
                                                                        $noti->user_id = $usid;
                                                                        $noti->title = $value;
                                                                        $noti->language_id = $lang_id;

                                                                        $rpending = new Nt_regid();
                                                                        $rpending->where_in('id',$allrecp);

                                                                        // if notification already sent
                                                                        if($noti->exists()){
                                                                                // device who have this notification pending
                                                                                $q = $this->db->query('select * from dip_join_nt_notifications_nt_regids where nt_notification_id ='.$noti->id);
                                                                                //update push count for those who does not have any pending
                                                                                if ($q->num_rows() > 0){
                                                                                        $pending=array();
                                                                                        foreach ($q->result() as $row)
                                                                                                $pending[] = $row->nt_regid_id;
                                                                                        if(!empty($pending))
                                                                                                $rpending->where_not_in('id',$pending);
                                                                                }
                                                                        }
                                                                        $rpending->get();
                                                                        foreach ($rpending as $rp) {
                                                                                $rp->push_count = $rp->push_count + 1;
                                                                                $rp->save();
                                                                        }

                                                                        
                                                                        // now create pending notificaton for all 
                                                                        $noti->save($recipent->all);

                                                                        // push notification server api call
                                                                        $this->apn->connectToPush();
                                                                        foreach($recipent as $recp){
                                                                                // send notification according to the devce type
                                                                                if($recp->os == 'ios'){

                                                                                        if(isset($pending) && !empty($pending)){
                                                                                                if(!in_array($recp->id, $pending))
                                                                                                        $recp->push_count = $recp->push_count + 1;
                                                                                        }else{
                                                                                                $recp->push_count = $recp->push_count + 1;
                                                                                        }
                                                                                        $this->apn->setData($msgIos); // aditional data
                                                                                        $this->apn->sendMessage($recp->token,$value,$recp->push_count);
                                                                                        
                                                                                }else{
                                                                                        $this->gcm->addRecepient($recp->token);
                                                                                }
                                                                        }
                                                                        $this->apn->disconnectPush();
                                                                        $this->gcm->setMessage($msgAndroid);
                                                                        // show($this->gcm->getData());
                                                                        $this->gcm->send();
                                                                        // message send done 
                                                                        $this->gcm->clearRecepients();
                                                                }
                                                                $counter = true;
                                                        }
                                                }

                                                if($counter==true){
                                                        // show($counter);
                                                        $hotel = new Golfclub();
                                                        $hotel->where('user_id',$this->data['user']['id'])->update('nt_push_counter','nt_push_counter + 1', FALSE);
                                                }
                                        }
                                }

                                
                                // success message
                                !$id ||redirect(site_full_url('golfclub/nexttee/offers'));
                                $this->session->set_flashdata('success_msg', 'The Offer has been saved successfully');
                                redirect(site_full_url('golfclub/nexttee/offers/edit/'.$pkg->id));
                         }
                }


                $this->data['page']['desc'] = 'Next Tee Offer Details';
                $this->data['page']['subview'] = 'golfclub/nexttee/offers_edit';
                $this->data['page']['subnav'][2]['active'] =true;
                $this->load->view('_layout_main',$this->data);
                // show($this->data['row']);
        }
        public function delete_offers(){
                echo $this->nexttee_m->delete_offer($this->data['user']['id'],$this->input->post('id'));
        }
        public function position_offers(){
                echo $this->nexttee_m->position_offer($this->data['user']['id'],$this->input->post('id'),$this->input->post('position'));
        }
        /**
         * Rewards
         */
        public function rewards(){
                $this->data['page']['desc'] = 'Next Tee Rewards';
                $this->data['page']['subview'] = 'golfclub/nexttee/rewards';
                $this->data['page']['foot'] = 'golfclub/nexttee/rewards_foot';
                $this->data['page']['subnav'][3]['active'] =true;
                $this->load->view('_layout_main',$this->data);
                // show($this->data);
        }
        public function get_rewards(){
                $this->jqgrid->from('dip_nt_rewards');
                $this->jqgrid->select('id, user_id, title, descr, startdate, enddate,  position');
                $this->jqgrid->searchable('title, descr');
                $this->jqgrid->where('user_id='.$this->data['user']['id']);
                echo escape_quote($this->jqgrid->get_result('json'));
        }
        public function edit_rewards($id=null) {
                $ul = $this->data['user']['level'];
                if(isset($this->data['settings']['nt_rewards'][$ul]) && !empty($this->data['settings']['nt_rewards'][$ul]))
                        $no_reward = $this->data['settings']['nt_rewards'][$ul];
                else $no_reward = 0;

                //check for availability
                $r = new Nt_reward();
                $r->get_by_user_id($this->data['user']['id']);
                $this->data['row'] = $this->nexttee_m->get_reward($this->data['user']['id'],$id);
                if(empty($this->data['row']->id)){
                        !$id || redirect(site_full_url('golfclub/nexttee/edit_rewards'));
                        if($r->result_count() >= $no_reward){
                                $this->session->set_flashdata('error_msg', 'You need to upgrade to creat more Rewards');
                                redirect(site_full_url('golfclub/nexttee/rewards'));
                        }
                }
                // makeing the nt push counter as counter
                if($this->data['client']->nt_push_notification){
                        $this->data['client']->push_notification = $this->data['client']->nt_push_notification;
                }else{
                        if(isset($this->data['settings']['nt_push'][$ul]) && !empty($this->data['settings']['nt_push'][$ul]))
                                $this->data['client']->push_notification = $this->data['settings']['nt_push'][$ul];
                        else
                                $this->data['client']->push_notification = 0;
                }
                // also the counter
                if($this->data['client']->nt_push_counter)
                        $this->data['client']->push_counter =  $this->data['client']->nt_push_counter;
                else
                        $this->data['client']->push_counter =  0;
                
                if($this->input->post()){
                         $rules = $this->nexttee_m->reward_rules;
                         foreach ($this->data['client']->languages as $key => $value) {
                                 $required_if = $this->input->post('descr')[$value] ? '|required' : '' ;
                                 $rules['title['.$value.']'] = array(
                                                'field'=>'title['.$value.']',
                                                'label'=> 'Name for '.$this->data['langs'][$value],
                                                'rules'=>'max_length[70]|xss_clean'.$required_if
                                );
                                $rules['descr['.$value.']'] = array(
                                                'field'=>'descr['.$value.']',
                                                'label'=> 'Description for '.$this->data['langs'][$value],
                                                'rules'=>'xss_clean'
                                );
                         }
                         $this->form_validation->set_rules($rules);
                         if ($this->form_validation->run() == TRUE){
                                $post = $this->input->post();
                                $pkg = $this->nexttee_m->save_reward($post,$this->data['user']['id'],$id);
                                // show($post);
                                
                                //logs for activites
                                if($pkg->id){
                                        if($this->data['user']['id']==$this->data['session']['id'])
                                                $this->user_m->log($this->data['user']['id'],'6');
                                }

                                //if saved successfully save notification
                                if($pkg->id && !isset($post['draft'])){
                                        
                                        $usid = $this->data['user']['id'];
                                        $push = array(
                                                'sid' => $usid,
                                                'sname' => $this->data['user']['name'],
                                                'post_id' => $pkg->id,
                                                'post_type' => 'Reward'
                                        );
                                        
                                        // send notification message if given
                                        $total_push = $this->data['client']->push_notification;
                                        $used_push = $this->data['client']->push_counter;
                                        if(isset($post['push']) && ($total_push > $used_push)){
                                                // change the languages as per nexttee settings
                                                $sp1 = new Setting();
                                                $sp1->where(array('user_id'=>1, 'name'=>'nt_radius'))->get();
                                                $radius = decode_data($sp1->value);
                                                //now send push notification
                                                $this->load->library('gcm');
                                                $this->load->library('apn');
                                                $this->apn->payloadMethod = 'enhance';
                                                $found=false;
                                                $counter = false;
                                                foreach ($post['push'] as $lang_id => $value) {
                                                        //send notification for this lang_id
                                                        if(!empty($value) && !empty($pkg->title[$lang_id])){
                                                                
                                                                $allrecp = array();
                                                                // devices with user in favourit
                                                                $recipent1 = new Nt_regid();
                                                                $recipent1->where_related_user('id' , $this->data['user']['id']);
                                                                $recipent1->where('language_id', $lang_id)->get();
                                                                foreach ($recipent1 as $r) {
                                                                        $allrecp[$r->id] = $r->id;
                                                                }
                                                                // device in the radius
                                                                $recipent2 = new Nt_regid();
                                                                $recipent2->select("* , ( 6371 * acos( cos( radians(".$this->data['client']->latitude.") ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(".$this->data['client']->longitude.") ) + sin( radians(".$this->data['client']->latitude.") ) * sin( radians( latitude ) ) ) )*1.3 AS distance ");
                                                                $recipent2->where('language_id', $lang_id);
                                                                $recipent2->having('distance <', $radius[0]);
                                                                $recipent2->get();
                                                                foreach ($recipent2 as $r) {
                                                                        $allrecp[$r->id] = $r->id;
                                                                }
                                                                $allrecp = array_keys($allrecp);
                                                                
                                                                unset($recipent);

                                                                if(!empty($allrecp)){
                                                                        $recipent = new Nt_regid();
                                                                        $recipent->where_in('id',$allrecp)->get();
                                                                }
                                                                if(isset($recipent) && $recipent->exists()){
                                                                        $found=true;
                                                                        $msgIos = $push;
                                                                        $msgAndroid = array(
                                                                                'package' => $push['post_id'],
                                                                                'name' => $push['sname'],
                                                                                'page' => $push['post_type'],
                                                                                'sid' => $push['sid'],
                                                                                'title' => $value
                                                                        );


                                                                        // create Notification and save with device relations 
                                                                        $noti = new Nt_notification();
                                                                        $noti->where(array('post_id'=>$push['post_id'],
                                                                                'post_type'=>$push['post_type'],'language_id'=>$lang_id))->get();
                                                                        $noti->post_id = $push['post_id'];
                                                                        $noti->post_type = $push['post_type'];
                                                                        $noti->title = $value;
                                                                        $noti->user_id = $usid;
                                                                        $noti->language_id = $lang_id;

                                                                        $rpending = new Nt_regid();
                                                                        $rpending->where_in('id',$allrecp);

                                                                        // if notification already sent
                                                                        if($noti->exists()){
                                                                                // device who have this notification pending
                                                                                $q = $this->db->query('select * from dip_join_nt_notifications_nt_regids where nt_notification_id ='.$noti->id);
                                                                                //update push count for those who does not have any pending
                                                                                if ($q->num_rows() > 0){
                                                                                        $pending=array();
                                                                                        foreach ($q->result() as $row)
                                                                                                $pending[] = $row->nt_regid_id;
                                                                                        if(!empty($pending))
                                                                                                $rpending->where_not_in('id',$pending);
                                                                                }
                                                                        }
                                                                        $rpending->get();
                                                                        foreach ($rpending as $rp) {
                                                                                $rp->push_count = $rp->push_count + 1;
                                                                                $rp->save();
                                                                        }
                                                                        // now create pending notificaton for all 
                                                                        $noti->save($recipent->all);


                                                                        // push notification server api call
                                                                        $this->apn->connectToPush();
                                                                        foreach($recipent as $recp){
                                                                                // send notification according to the devce type
                                                                                if($recp->os == 'ios'){
                                                                                        if(isset($pending) && !empty($pending)){
                                                                                                if(!in_array($recp->id, $pending))
                                                                                                        $recp->push_count = $recp->push_count + 1;
                                                                                        }else{
                                                                                                $recp->push_count = $recp->push_count + 1;
                                                                                        }
                                                                                        $this->apn->setData($msgIos); // aditional data
                                                                                        $this->apn->sendMessage($recp->token,$value,$recp->push_count);
                                                                                        
                                                                                }else{
                                                                                        $this->gcm->addRecepient($recp->token);
                                                                                }
                                                                        }
                                                                        $this->apn->disconnectPush();
                                                                        $this->gcm->setMessage($msgAndroid);
                                                                        // show($this->gcm->getData());
                                                                        $this->gcm->send();
                                                                        // message send done 
                                                                        $this->gcm->clearRecepients();
                                                                }
                                                                $counter = true;
                                                        }
                                                }

                                                if($counter==true){
                                                        // show($counter);
                                                        $hotel = new Golfclub();
                                                        $hotel->where('user_id',$this->data['user']['id'])->update('nt_push_counter','nt_push_counter + 1', FALSE);
                                                }
                                        }
                                }

                                
                                $this->session->set_flashdata('success_msg', 'The Reward has been saved successfully');
                                redirect(site_full_url('golfclub/nexttee/edit_rewards/'.$pkg->id));
                         }
                }
                $this->data['page']['desc'] = 'Next Tee Reward Details';
                $this->data['page']['subview'] = 'golfclub/nexttee/rewards_edit';
                $this->data['page']['subnav'][3]['active'] =true;
                $this->load->view('_layout_main',$this->data);
                // show($this->data['row']);
        }
        public function delete_rewards(){
                echo $this->nexttee_m->delete_reward($this->data['user']['id'],$this->input->post('id'));
        }
        public function position_rewards(){
                echo $this->nexttee_m->position_reward($this->data['user']['id'],$this->input->post('id'),$this->input->post('position'));
        }
        public function genarate_qrcode($rid,$qrcno,$lang){
                if(!isset($rid) && !isset($qrcno)) redirect(site_full_url('golfclub/nexttee/rewards'));
                $reward = $this->nexttee_m->get_reward($this->data['user']['id'],$rid);
                if(!$reward->id) redirect(site_full_url('golfclub/nexttee/rewards'));
                $this->data['reward'] = $reward->title[$lang];
                $this->data['validity'] = $reward->enddate;

                //1. load the library
                $this->load->library('qrcode');

                $arrayName = array();
                $this->data['qrcUrls'] = array();
                $logo = FALSE;//decode_data($this->data['client']->logo);
                $logo = $logo[0]['url'];
                if($logo != FALSE){
                        $logo = imagecreatefromstring(file_get_contents($logo));
                }
                for ($i=0; $i < $qrcno; $i++) {
                        
                        //2. create the url
                        $qid = uniqid($reward->id);
                        $this->qrcode->add_data('QRCID',$qid);
                        $this->qrcode->add_data('REWARDID',$reward->id);
                        $this->qrcode->add_data('CLIENTID',$this->data['user']['id']);
                        $this->qrcode->add_data('CDATE',date('Y-m-d H:i:s'));
                        $arrayName[] = $this->qrcode->get_data_str();
                        // $this->data['qrcUrls'][] = $this->qrcode->get_url();
                        $url = (string)$this->qrcode->get_url();

                        //show($url);
                        //3. get the image to a file
                        $QR = imagecreatefrompng($url);
                        if($logo != FALSE){
                                $QR_width = imagesx($QR);
                                $QR_height = imagesy($QR);
                                
                                $logo_width = imagesx($logo);
                                $logo_height = imagesy($logo);
                                
                                // Scale logo to fit in the QR Code
                                $logo_qr_width = $QR_width/2;
                                $scale = $logo_width/$logo_qr_width;
                                $logo_qr_height = $logo_height/$scale;
                                imagecopyresampled($QR, $logo, $QR_width/4, $QR_height/3, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
                        }
                        $path = 'temp/'.$qid.'.png';
                        imagepng($QR,$path);
                        imagedestroy($QR);
                        $imgdata = 'data:image/png;base64,'. base64_encode(file_get_contents($path));
                        unlink($path);

                        $this->data['qrcUrls'][] = $imgdata;
                }
                $this->data['page'] = array(
                        'title' => 'Print QR Code',
                );
                $this->load->view('_layout_print',$this->data);
                //show($arrayName);
                header("Content-Type: application/pdf");
                // Get output html
                $html = $this->output->get_output();
                // Load library
                $this->load->library('dompdf_gen');
                
                // Convert to PDF
                $this->dompdf->load_html(utf8_decode($html),'UTF-8');
                $this->dompdf->set_paper(array(0,0,595,842));
                $this->dompdf->render();
                
                $this->dompdf->stream("qrcodes.pdf");
        }
}
