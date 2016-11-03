<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Courses extends DIP_Controller_Golfclub {

        function __construct(){
                parent::__construct();
                $this->load->model('course_m');
        }
        public function index(){
			
				$nu = new User();
				$userdata = $nu->get_by_id($this->data['user']['id']);
				if($userdata->type==1)
					$nh = new Golfgroup();
				elseif($userdata->type==2)
					$nh = new Golfclub();
				else
					$nh = new Partner();					
				$nh->where(array('user_id' => $this->data['user']['id']))->get();
				$query = $this->db->query("SELECT * from dip_languages WHERE id =".$nh->default_language); 
				$data = $query->result();
				if(is_dir(FCPATH."application/language/".strtolower($data[0]->name)))
				{
					//echo "in";
					$this->config->set_item('language', strtolower($data[0]->name));
					$this->lang->load('message',strtolower($data[0]->name));
				}
				else
				{
					//echo "out";
					$this->config->set_item('language','english');
					$this->lang->load('message','english');
				}

                $this->data['page'] = array(
                        'title' =>$this->lang->line('ManageCourses') ,
                        'slug' => 'courses',
                        'nav' => 'courses',
                        'desc' =>$this->lang->line('AllCourses') ,
                        'main' => '_layout_backend',
                        'subview' => 'golfclub/courses/courses',
                        'foot' => 'golfclub/courses/courses_foot',
                );
                $this->load->view('_layout_main',$this->data);
                // show($this->data);
        }
        public function get_courses() {
                $this->jqgrid->from('dip_courses');
                $this->jqgrid->select('id, user_id, name, descr, position');
                $this->jqgrid->searchable('name, descr');
                $this->jqgrid->where('user_id='.$this->data['user']['id']);
                echo escape_quote($this->jqgrid->get_result('json'));
        }
        public function edit($id=null) {
                
                $this->data['row'] = $this->course_m->get_details($this->data['user']['id'],$id);
                !$id || !empty($this->data['row']->id) || redirect(site_full_url('golfclub/courses/edit'));

                $this->data['facilities'] = $this->course_m->get_all_facilities();

                if($this->input->post()){

                         $rules = $this->course_m->rules;
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
                                $this->course_m->save($post,$this->data['user']['id'],$id);
                                // show($post);
                         }
                }

                $this->data['page'] = array(
                        'title' =>  $this->lang->line('ManageCourses'),
                        'slug' => 'courses',
                        'nav' => 'courses',
                        'desc' => ($id ? $this->lang->line('EditCourse') :$this->lang->line('AddNewCourses')),
                        'main' => '_layout_backend',
                        'subview' => 'golfclub/courses/courses_edit'
                );
                $this->data['page']['subnav'] = array(
                        array(
                                'title' =>$this->lang->line('Details')  ,
                                'active' => true,
                                'disabled' => false,
                                'url' => current_full_url(),
                        ),
                        array(
                                'title' => $this->lang->line('Rates') ,
                                'active' => false,
                                'disabled' => ($id ? false : true),
                                'url' => site_full_url('golfclub/courses/rates/'.($id ? $id : '')),
                        ),
                );
                $this->load->view('_layout_main',$this->data);
                // show($this->data);
        }
        public function delete(){
                echo $this->course_m->delete($this->data['user']['id'],$this->input->post('id'));
        }
        public function position(){
                echo $this->course_m->position($this->data['user']['id'],$this->input->post('id'),$this->input->post('position'));
        }

        // ajax base rates managing with sections
        public function rates($id) {
                $id || redirect(site_full_url('golfclub/courses'));
                $this->data['row'] = $this->course_m->get_details($this->data['user']['id'],$id);
                !empty($this->data['row']->id) || redirect(site_full_url('golfclub/courses'));

                $this->load->model('xtra_m');
                $this->data['currencies'] = $this->xtra_m->get_all_currencies();
                $this->data['client']->currency = $this->xtra_m->get_currency_by_country($this->data['client']->country);

                $this->data['page'] = array(
                        'title' =>$this->lang->line('ManageCourseRates') ,
                        'slug' => 'courses',
                        'nav' => 'courses',
                        'desc' =>$this->lang->line('ManageCourseRates'),
                        'main' => '_layout_backend',
                        'subview' => 'golfclub/courses/courses_rates',
                        'foot' => 'golfclub/courses/courses_rates_foot',
                );
                $this->data['page']['subnav'] = array(
                        array(
                                'title' =>$this->lang->line('Details')  ,
                                'active' => false,
                                'disabled' => false,
                                'url' => site_full_url('golfclub/courses/edit/'.$id),
                        ),
                        array(
                                'title' =>$this->lang->line('Rates')  ,
                                'active' => true,
                                'disabled' => false,
                                'url' => current_full_url(),
                        ),
                );
                $this->load->view('_layout_main',$this->data);
                // show($this->data);
        }

        public function get_rate_sections($id){
                $this->jqgrid->from('dip_course_rate_sections');
                $this->jqgrid->select('id, course_id, name, position');
                $this->jqgrid->searchable('name');
                $this->jqgrid->where('course_id='.$id);
                // echo '<br/>';
                echo escape_quote($this->jqgrid->get_result('json'));
        }
        public function get_rate_section($cid,$id=null){
                // show($this->course_m->get_rate_section($cid,$id));
                echo str_replace("\'","'",encode_data($this->course_m->get_rate_section($cid,$id)));
        }
        public function save_rate_section($cid,$id=null){
                echo $this->course_m->save_rate_section($this->input->post(),$cid,$id);
        }
        public function save_rate_sec_position($pid,$id,$pos){
                echo $this->course_m->position_rate_section($pos,$pid,$id);
        }
        public function delete_rate_section(){
                echo $this->course_m->delete_rate_section($this->input->post('parent'),$this->input->post('id'));
        }

        public function get_rates($id){
                $this->jqgrid->from('dip_course_rates');
                $this->jqgrid->select('id, course_rate_section_id, descr, price,currency, position');
                $this->jqgrid->searchable('descr,price');
                $this->jqgrid->where('course_rate_section_id='.$id);
                echo escape_quote($this->jqgrid->get_result('json'));
        }
        public function get_rate($pid,$id=null){
                echo str_replace("\'","'",encode_data($this->course_m->get_rate($pid,$id)));
        }
        public function save_rate($pid,$id=null){
                echo $this->course_m->save_rate($this->input->post(),$pid,$id);
        }
        public function save_rate_position($pid,$id,$pos){
                echo $this->course_m->position_rate($pos,$pid,$id);
        }
        public function delete_rate(){
                echo $this->course_m->delete_rate($this->input->post('parent'),$this->input->post('id'));
        }
}
