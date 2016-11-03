<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Nt_events extends DIP_Controller_Golfclub {

        public function index(){
/*---for lock the tabs---*/
        $sp2 = new Setting();
        $sp2->where('user_id', 1)->get();
        foreach ($sp2 as $s) {
            $this->data['settings'][$s->name] = decode_data($s->value);
        }
/*---for lock the tabs---*/
                if(isset($_FILES) && !empty($_FILES)){
                        // make directory
                        $upload_dir = 'uploads/'.$this->data['user']['id'].'/events/';
                        // $upload_dir = 'temp/';
                        if (!is_dir($upload_dir)) {
                            mkdir($upload_dir, 0777, true);
                        }
                        $config['upload_path'] = $upload_dir;
                        $config['file_name'] = 'events_calender';
                        $config['allowed_types'] = 'xlsx|xls|csv';
                        $config['max_size']        = '200480';
                        $this->load->library('upload', $config);
                        if ($this->upload->do_upload())
                                $data = $this->upload->data();
                        else
                                show($this->upload->display_errors());

                        $file = './'.$upload_dir.$data['file_name'];
                        $this->load->library('excel');
                        $Spreadsheet = $this->excel->read($file);
                        $Sheets = $Spreadsheet->Sheets();
						
							if($data['file_ext'] == '.xlsx'){
	
						 foreach ($Sheets as $Index => $Name)
                {
                                $keyFound = array_search($Name, $this->data['langs']);
                                if($keyFound){
                                $Spreadsheet->ChangeSheet($Index);
                                foreach ($Spreadsheet as $key => $row)
                            	{
                                    if($key>0 && !empty($row[0]) && !empty($row[1]) ){

                                            $row[0] = date('Y-m-d',strtotime($row[0]));
                                            if($data['file_ext'] == '.xls'){
                                                    /*$row[1] = encode_ascii($row[1]);
                                                    $row[2] = encode_ascii($row[2]);
                                                    $row[3] = encode_ascii($row[3]);
                                                    $row[4] = encode_ascii($row[4]);*/
                                                    //echo '<pre>';
                                                   // print_r($key);
                                                    //echo '</pre>';

                                  if (preg_match('/’/', $row[1]))
                                  {
                                   $row[1] = $row[1];
    
                                  }
                                  else
                                  {
                                    $row[1] =  utf8_encode($row[1]);
                                  }



                                  if (preg_match('/’/', $row[2]))
                                  {
                                   $row[2] = $row[2];
    
                                  }
                                  else
                                  {
                                    $row[2] =  utf8_encode($row[2]);
                                  }



                                  if (preg_match('/’/', $row[3]))
                                  {
                                   $row[3] = $row[3];
    
                                  }
                                  else
                                  {
                                    $row[3] =  utf8_encode($row[3]);
                                  }



                                  if (preg_match('/’/', $row[4]))
                                  {
                                   $row[4] = $row[4];
    
                                  }
                                  else
                                  {
                                    $row[4] =  utf8_encode($row[4]);
                                  }            
                                                  
                                                  
													//$row[1] = htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
                                                   // $row[1] = encode_ascii($row[1]);
													//$row[1] =  utf8_encode($row[1]);


                                                    //$html = mb_convert_encoding($row[1], "HTML-ENTITIES", "UTF-8");

                                                    //$row[2] = utf8_encode($row[2]);//encode_ascii($row[2]);
                                                    //$row[2] = htmlspecialchars($row[2], ENT_QUOTES, 'UTF-8');
                                                    //$row[3] = utf8_encode($row[3]);
                                                   // $row[3] = htmlspecialchars($row[3], ENT_QUOTES, 'UTF-8');
                                                   // $row[4] = utf8_encode($row[4]);
                                                    //$row[4] = htmlspecialchars($row[4], ENT_QUOTES, 'UTF-8');
                                            }

                                           //now check if already exists
                                            $ev = new Nt_event();
                                            $ev->where(array('user_id'=>$this->data['user']['id'],'event_date'=>$row[0],'name'=>$row[1]))->get();
											//$ev->where(array('user_id'=>$this->data['user']['id'],'event_date'=>$row[0],'name'=>html_entity_decode(htmlspecialchars($row[1]), ENT_COMPAT, "ISO-8859-1")))->get();
                                            if(!$ev->exists()){
                                                    $ev->user_id = $this->data['user']['id'];
                                                    //$ev->event_date = $row[0];
													$ev->event_date = $row[0];
													//$ev->name = html_entity_decode(htmlspecialchars($row[1]), ENT_COMPAT, "ISO-8859-1");
                                                    $ev->name = $row[1];
                                                    $format=array();
                                                    $remark1=array();
                                                    $remark2=array();
                                            }else{
                                                    $format = decode_data($ev->format);
                                                    $remark1 = decode_data($ev->remark1);
                                                    $remark2 = decode_data($ev->remark2);
                                            }

                                            if(isset($row[2])){
                                                    $format[$keyFound] = $row[2];
                                                    $ev->format = encode_data($format);
                                            }
                                            if(isset($row[3])){
                                                    $remark1[$keyFound] = $row[3];
                                                    $ev->remark1 = encode_data($remark1);
                                            }
                                            if(isset($row[4])){
                                                    $remark2[$keyFound] = $row[4];
                                                    $ev->remark2 = encode_data($remark2);
                                            }
                                        //$ev->save();
                                             show($row);

                                }
                            }
                    }
                }
	
	
	}
	else {
                foreach ($Sheets as $Index => $Name)
                {
                                $keyFound = array_search($Name, $this->data['langs']);
                                if($keyFound){
                                $Spreadsheet->ChangeSheet($Index);
                                foreach ($Spreadsheet as $key => $row)
                            	{
                                    if($key>1 && !empty($row[0]) && !empty($row[1]) ){

                                            $row[0] = date('Y-m-d',strtotime($row[0]));
                                            if($data['file_ext'] == '.xls'){
                                                    /*$row[1] = encode_ascii($row[1]);
                                                    $row[2] = encode_ascii($row[2]);
                                                    $row[3] = encode_ascii($row[3]);
                                                    $row[4] = encode_ascii($row[4]);*/
                                                    //echo '<pre>';
                                                   // print_r($key);
                                                    //echo '</pre>';

                                  if (preg_match('/’/', $row[1]))
                                  {
                                   $row[1] = $row[1];
    
                                  }
                                  else
                                  {
                                    $row[1] =  utf8_encode($row[1]);
                                  }



                                  if (preg_match('/’/', $row[2]))
                                  {
                                   $row[2] = $row[2];
    
                                  }
                                  else
                                  {
                                    $row[2] =  utf8_encode($row[2]);
                                  }



                                  if (preg_match('/’/', $row[3]))
                                  {
                                   $row[3] = $row[3];
    
                                  }
                                  else
                                  {
                                    $row[3] =  utf8_encode($row[3]);
                                  }



                                  if (preg_match('/’/', $row[4]))
                                  {
                                   $row[4] = $row[4];
    
                                  }
                                  else
                                  {
                                    $row[4] =  utf8_encode($row[4]);
                                  }            
                                                  
                                                  
													//$row[1] = htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
                                                   // $row[1] = encode_ascii($row[1]);
													//$row[1] =  utf8_encode($row[1]);


                                                    //$html = mb_convert_encoding($row[1], "HTML-ENTITIES", "UTF-8");

                                                    //$row[2] = utf8_encode($row[2]);//encode_ascii($row[2]);
                                                    //$row[2] = htmlspecialchars($row[2], ENT_QUOTES, 'UTF-8');
                                                    //$row[3] = utf8_encode($row[3]);
                                                   // $row[3] = htmlspecialchars($row[3], ENT_QUOTES, 'UTF-8');
                                                   // $row[4] = utf8_encode($row[4]);
                                                    //$row[4] = htmlspecialchars($row[4], ENT_QUOTES, 'UTF-8');
                                            }

                                           //now check if already exists
                                            $ev = new Nt_event();
                                            $ev->where(array('user_id'=>$this->data['user']['id'],'event_date'=>$row[0],'name'=>$row[1]))->get();
											//$ev->where(array('user_id'=>$this->data['user']['id'],'event_date'=>$row[0],'name'=>html_entity_decode(htmlspecialchars($row[1]), ENT_COMPAT, "ISO-8859-1")))->get();
                                            if(!$ev->exists()){
                                                    $ev->user_id = $this->data['user']['id'];
                                                    //$ev->event_date = $row[0];
													$ev->event_date = $row[0];
													//$ev->name = html_entity_decode(htmlspecialchars($row[1]), ENT_COMPAT, "ISO-8859-1");
                                                    $ev->name = $row[1];
                                                    $format=array();
                                                    $remark1=array();
                                                    $remark2=array();
                                            }else{
                                                    $format = decode_data($ev->format);
                                                    $remark1 = decode_data($ev->remark1);
                                                    $remark2 = decode_data($ev->remark2);
                                            }

                                            if(isset($row[2])){
                                                    $format[$keyFound] = $row[2];
                                                    $ev->format = encode_data($format);
                                            }
                                            if(isset($row[3])){
                                                    $remark1[$keyFound] = $row[3];
                                                    $ev->remark1 = encode_data($remark1);
                                            }
                                            if(isset($row[4])){
                                                    $remark2[$keyFound] = $row[4];
                                                    $ev->remark2 = encode_data($remark2);
                                            }
                                        $ev->save();
                                             //show($key);

                                }
                            }
                    }
                }
	}
                // unlink($file);
            }

              /* $this->data['page'] = array(
                        'title' => $this->lang->line('ManageEvents'),
                        'slug' =>'nexttee' ,
                        'nav' =>'nexttee',
                        'desc' =>$this->lang->line( 'AllEvents'),
                        'main' => '_layout_backend',
                        'subview' => 'golfclub/nexttee/nt_events',
                        'foot' => 'golfclub/nexttee/nt_events_foot'
                );
*/
                $this->data['page'] = array(
            'title' => $this->lang->line('NextTee'),
            'slug' => 'nexttee',
            'nav' => 'nexttee',
            'desc' =>$this->lang->line('NextTeeDetails'),
            'main' => '_layout_backend',
             'subview' => 'golfclub/nexttee/nt_events',
             'foot' => 'golfclub/nexttee/nt_events_foot'

                        
        );
                 $this->data['page']['subnav'] = array(
            array(
                'title' => $this->lang->line('ClubDetails'),
                'disabled' => false,
                'url' => site_full_url('golfclub/nexttee'),
            ),
            array(
                'title' => $this->lang->line('TheCourses'),
                'active' => false,
                'disabled' => false,
                'url' => site_full_url('golfclub/nexttee/courses'),
            ),
            array(
                'title' => $this->lang->line('SpecialOffers') . ($this->data['settings']['nt_offers'][$this->data['user']['level']] == 0 ? '<i class="dip-icon-t fa fa-lock"></i>' : ''),
                'active' => false,
                'disabled' => ($this->data['settings']['nt_offers'][$this->data['user']['level']] == 0 ? true : false),
                'url' => site_full_url('golfclub/nexttee/offers'),
            ),
            array(
                'title' => $this->lang->line('RewardProgram' ). ($this->data['settings']['nt_rewards'][$this->data['user']['level']] == 0 ? '<i class="dip-icon-t fa fa-lock"></i>' : ''),
                'active' => false,
                'disabled' => ($this->data['settings']['nt_rewards'][$this->data['user']['level']] == 0 ? true : false),
                'url' => site_full_url('golfclub/nexttee/rewards'),
            ),
             array(
                'title' => 'Events',
                'active' => false,
                'disabled' => false,
                'url' => site_full_url('golfclub/nexttee/nt_events'),
            ),


        );
               $this->data['page']['subview'] = 'golfclub/nexttee/nt_events';
                 $this->data['page']['subnav'][4]['active'] = true;
                $this->load->view('_layout_main',$this->data);
                // show($keyFound);
        }
       

      
       

/*
         public function edit($id=null){
                $this->load->model('nt_events_m');
                $this->data['row'] = $this->nt_events_m->get_details($this->data['user']['id'],$id);
                !$id || !empty($this->data['row']->id) || redirect(site_full_url('golfclub/nt_events/edit'));

                if($this->input->post()){
                        $rules = $this->nt_events_m->rules;
                        $this->form_validation->set_rules($rules);
                         if ($this->form_validation->run() == TRUE){
                                 $post = $this->input->post();
                                $this->nt_events_m->save($post,$this->data['user']['id'],$id);
                                 // show($post);
                         }
                }

                $this->data['page'] = array(
                       'title' => $this->lang->line('ManageEvents'),
                        'slug' =>'events' ,
                        'nav' =>'events' ,
                        'desc' => ($id?$this->lang->line('EditEvent'): $this->lang->line('AddEvent')),
                        'main' => '_layout_backend',
                        'subview' => 'golfclub/nt_events/nt_events_edit'
                );
                $this->load->view('_layout_main',$this->data);
                // show($this->data);
        }

        */

         
    
		
		public function updatedata(){
               
				//$query1 = $this->db->query("SELECT * from dip_events order by id Desc"); 
				//$query2 = $this->db->query("SELECT * from dip_translations order by id Desc"); 
				$query = $this->db->query("SELECT * from dip_users order by id Desc");
   				$data = $query->result();				
				/*echo "<pre>";
				print_r($data);
				echo "<pre>";*/	
				//echo count($data);			
				//die();
				for($i=0;$i<count($data);$i++)
				{
					if(strchr(htmlspecialchars($data[$i]->name),"#"))
					{						
						//$name_data = html_entity_decode(htmlspecialchars($data[$i]->name), ENT_COMPAT, "ISO-8859-1");
						//$name_data = utf8_encode($data[$i]->name);
						//$sql_d_1 = "UPDATE `dip_users` SET `name`='".$name_data."' WHERE `id`=".$data[$i]->id;
						//echo $sql_d_1.";<br>";
						
						//$data[] = array('id' => $data[$i]->id, 'item_order' => utf8_encode($data[$i]->name));						
						
						
						/*$data = array('name' => utf8_encode($data[$i]->name));
						$this->db->where('id', $data[$i]->id);
						$this->db->update('dip_users', $data);*/
						
						$updateArray[] = array(
												'name'=>utf8_encode($data[$i]->name)
											);						
						
					}
					
					
					
				}	
								
               
        }

        public function nt_updatedata(){
               
        //$query1 = $this->db->query("SELECT * from dip_events order by id Desc"); 
        //$query2 = $this->db->query("SELECT * from dip_translations order by id Desc"); 
        $query = $this->db->query("SELECT * from dip_users order by id Desc");
          $data = $query->result();       
        /*echo "<pre>";
        print_r($data);
        echo "<pre>";*/ 
        //echo count($data);      
        //die();
        for($i=0;$i<count($data);$i++)
        {
          if(strchr(htmlspecialchars($data[$i]->name),"#"))
          {           
            //$name_data = html_entity_decode(htmlspecialchars($data[$i]->name), ENT_COMPAT, "ISO-8859-1");
            //$name_data = utf8_encode($data[$i]->name);
            //$sql_d_1 = "UPDATE `dip_users` SET `name`='".$name_data."' WHERE `id`=".$data[$i]->id;
            //echo $sql_d_1.";<br>";
            
            //$data[] = array('id' => $data[$i]->id, 'item_order' => utf8_encode($data[$i]->name));           
            
            
            /*$data = array('name' => utf8_encode($data[$i]->name));
            $this->db->where('id', $data[$i]->id);
            $this->db->update('dip_users', $data);*/
            
            $updateArray[] = array(
                        'name'=>utf8_encode($data[$i]->name)
                      );            
            
          }
          
          
          
        } 
                
               
        }
}
