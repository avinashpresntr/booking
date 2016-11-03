<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Partners extends DIP_Controller_Golfclub {

        public function index(){
                $this->data['page'] = array(
                        'title' =>$this->lang->line('ManagePartners') ,
                        'slug' => 'partners' ,
                        'nav' => 'partners' ,
                        'desc' => $this->lang->line('AllPartners') ,
                        'foot' => 'golfclub/partners/partners_foot',
                        'main' => '_layout_backend',
                        'subview' => 'golfclub/partners/partners'
                );
                $this->load->view('_layout_main',$this->data);
                // show($this->data);
        }
        public function get_partners(){
                //join table with golfgroup table to fetch all details
                $table = "(dip_users AS u 
                        INNER JOIN (SELECT user_id, country,visibility, position FROM dip_partners) AS g ON u.id=g.user_id
                        INNER JOIN (SELECT country_code, country_name FROM dip_countries) AS c ON c.country_code=g.country
                        )";
                $this->jqgrid->from($table);
                $this->jqgrid->select('id, name, country_name, type, status, level, position, creation_date');
                $this->jqgrid->searchable('name, position, country_name');
                
                if($this->data['user']['id'])
                        $where = 'status=1 AND visibility=1 AND parrent='.$this->data['user']['id'];

                if($this->input->get('getLevel') != ''){
                        if(isset($where))
                                $where .= ' AND type='.$this->input->get('getLevel');
                        else
                                $where = 'status=1 AND visibility=1 AND type='.$this->input->get('getLevel');
                }

                if(isset($where))
                        $this->jqgrid->where($where);

                echo escape_quote($this->jqgrid->get_result('json'));
        }
}
