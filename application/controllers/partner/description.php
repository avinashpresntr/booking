<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Description extends DIP_Controller_Partner {

        public function index(){
                
                // when the form is submitted
                if($this->input->post()){
                        $rules = array();
                         foreach ($this->data['client']->parent->languages as $key => $value) {

                                 $required_if = $this->input->post('descr')[$value] ? '|required' : '' ;
                                $rules['descr['.$value.']'] = array(
                                                'field'=>'descr['.$value.']',
                                                'label'=> $this->lang->line('DescriptionFor'),
                                                'rules'=>'xss_clean'
                                );
                         }
                        $this->form_validation->set_rules($rules);
                        if ($this->form_validation->run() == TRUE){
                                $post = $this->input->post();
                                $this->partner_m->save_descr($post,$this->data['user']['id']);
                                // show($post);
                        }
                }

                $this->data['page'] = array(
                        'title' =>$this->lang->line('Description') ,
                        'slug' => 'description',
                        'nav' => 'description',
                        'desc' =>$this->lang->line('Descriptionaboutthis') ,
                        'main' => '_layout_backend',
                        'subview' => 'partner/description'
                );
                $this->load->view('_layout_main',$this->data);
                // show($this->data['user_types'][$this->data['user']['type']]);
        }
}
