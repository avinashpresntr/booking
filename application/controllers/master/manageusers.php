<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manageusers extends DIP_Controller_Master {
	function __construct(){		
		parent::__construct();
		//$this->config->set_item('language','english');
		//$this->lang->load('message','english');
		$this->data['page'] = array(
			'title' => 'Manage Users',
			'desc' => 'Manage All Users',
			'slug' => 'manageusers',
			'nav' => 'manageusers',
			'main' => '_layout_backend',
			'subview' => 'master/manageusers'
		);
		$this->data['page']['subnav'] = array(
			array(
				'title' => 'Golf Clubs' ,
				'active' => false,
				'disabled' => false,
				'url' => site_full_url('master/manageusers/index/golfclubs'),
			),
			array(
				'title' => 'Golf Groups' ,
				'active' => false,
				'disabled' => false,
				'url' => site_full_url('master/manageusers/index/golfgroups'),
			),
		);
	}
	public function index($type=null){
		set_time_limit(3600);
		ini_set('memory_limit','1024M');
		mb_internal_encoding('UTF-8');

		if(isset($_FILES) && !empty($_FILES)){
			// Uploading the file
			$upload_dir = 'temp/';
			if (!is_dir($upload_dir)) {
			    mkdir($upload_dir, 0777, true);
			}
			$config['upload_path'] = $upload_dir;
			$config['file_name'] = uniqid();
			$config['allowed_types'] = '*';
			$config['max_size']	= '200480';
			$this->load->library('upload', $config);
			if ($this->upload->do_upload()){
				$data = $this->upload->data();
				$file = './'.$upload_dir.$data['file_name'];
			}else{
				$this->data['error'] = $this->upload->display_errors();
			}
			
			// Uploading the file
			$this->load->model('xtra_m');
			$countries = array_change_key_case(array_flip($this->xtra_m->get_all_countries()),CASE_LOWER);
			$facilities = array_change_key_case(array_flip($this->xtra_m->get_all_facilities()),CASE_LOWER);
			$levels = array_change_key_case(array_flip($this->data['user_levels']),CASE_LOWER);


			// extract from the excel
			// --------------------------------------------------------------------------------------------
			$this->load->library('excel');
			$Spreadsheet = $this->excel->read($file);
			$Sheets = $Spreadsheet->Sheets();
			$Spreadsheet->ChangeSheet(0);

				// database next insert id
	        	$user_id_p = $this->xtra_m->get_max_id('dip_users');
	        	$gc_id = $this->xtra_m->get_max_id('dip_golfclubs');
	        	$c_id = $this->xtra_m->get_max_id('dip_nt_courses');
				$o_id = $this->xtra_m->get_max_id('dip_nt_offers');
	        	$r_id = $this->xtra_m->get_max_id('dip_nt_rewards');

	        	// database next position for a user_id
	        	$c_pos = 0;$o_pos = 0;$r_pos = 0;

	        	$c_username='';//username ofcurrent row
	        	$c_userid = 0;
	        	$total = sizeof($Spreadsheet);//total rows
	        	$count=0;//how many stacked for inserting

	        	$user_val='';$golfclub_val='';$course_val='';$offer_val='';$reward_val='';
	        	foreach ($Spreadsheet as $key => $row)
	            {

	            	if($key>1 && !empty($row[0]) && !empty($row[1]) && !empty($row[2]) && !empty($row[3])){
	            		


	            		//if username is not same as the previous row
	            		if($row[1]!=$c_username){
	            			
	            			$q=$this->db->query("select id,username from dip_users where username='".trim($row[1])."'");
	            			if ($q->num_rows() > 0) {
	            				$r = $q->row();
								$user_id = $r->id;
	            			}else{
	            				$user_id_p++;
		            			$user_id = $user_id_p;
		            		}

	            			$gc_id++;
	            			if(!empty($row[17]))
	            				$c_pos = $this->xtra_m->get_next_pos('dip_nt_courses',$user_id);
	            			if(!empty($row[42]))
		            			$o_pos = $this->xtra_m->get_next_pos('dip_nt_offers',$user_id);
		            		if(!empty($row[46]))
		            			$r_pos = $this->xtra_m->get_next_pos('dip_nt_rewards',$user_id);
	            			$c_username=$row[1];
	            			$c_userid=$user_id;
	            		}else{

	            			$user_id=$c_userid;
	            			if(!empty($row[17]))
	            				$c_pos++;
	            			if(!empty($row[42]))
		            			$o_pos++;
		            		if(!empty($row[46]))
		            			$r_pos++;
	            		}

	            		// gofgroup
	            		$parent = 0;
	            		if(!empty($row[51]) && !empty($row[52]) && !empty($row[53])){
	            			$q=$this->db->query("select id,username from dip_users where username='".trim($row[52])."'");
	            			if ($q->num_rows() > 0) {
	            				$r = $q->row();
								$parent = $r->id;
	            			}else{
	            				$user_id_p++;
	            				$parent = $user_id_p;
	            				$psql = 'INSERT INTO dip_users (id,username,name,slug,password,type,creation_date) VALUES ';
					            $psql .= "(".$parent.", '".$row[52]."', '".encode_ascii($row[51])."', '".encode_slug($row[51])."', '".$row[53]."', 1, CURDATE())";
					            $psql .= ' ON DUPLICATE KEY UPDATE 
					            					name=VALUES(name), 
					            					slug=VALUES(slug), 
					            					password=VALUES(password), 
					            					type=VALUES(type), 
					            					creation_date=VALUES(creation_date)';
					            $this->db->query($psql);
								$this->db->insert('dip_golfgroups', array('user_id' => $parent));
	            			}
	            		}
	            		


	            		//user details
	            		$user_val .= "(".$user_id.", '".$row[1]."', '".encode_ascii($row[3])."', '".encode_slug($row[3])."', '".$row[2]."', '".$levels[$row[0]]."','".$parent."', CURDATE()),";


	            		//golfclub details
	            		//facilities
	            		if(!empty($row[5])){
	            			$fclts = encode_data(array_values(explode(",", $row[5])));
	            		}else $fclts = null;

	            		//getting the country code
	            		$row[14]=strtolower(trim(ascii_to_entities($row[14])));
						if(isset($countries[$row[14]]))
							$country = $countries[$row[14]];
						else
							$country = null;
						if(!empty($row[4]))
							$descr = encode_data(array('1' => $row[4]));
						else
							$descr = null;
	            		$golfclub_val .= "('".$gc_id."','".$user_id."','".encode_ascii($descr)."','".$fclts."','".$row[6]."','".$row[7]."', 
	            			'".$row[8]."', '".$row[9]."', '".encode_ascii($row[10])."', 
	            			'".$row[11]."','".encode_ascii($row[12])."','".encode_ascii($row[13])."','".$country."', 
	            			'".$row[15]."','".$row[16]."','".$row[41]."'),";
						
						// course 
						$c_id++;
						if(!empty($row[17])){
							$currency = $this->xtra_m->get_currency_by_country($country);
							$name = encode_data(array('1' => $row[17]));
							if(!empty($row[29])){
			            		if(strtolower(trim($row[29]))=='weather dependent'){
			            			$row[29]='Weather dependent';
			            		}else{
			            			$row[29] = date('d F', strtotime(str_replace('/', '-', $row[29].'/2010')));
			            		}
			            	}
		            		if(!empty($row[30])){
			            		$row[30] = date('d F', strtotime(str_replace('/', '-', $row[30].'/2010')));
			            	}
			            	$cr = encode_data(array($row[31],$row[33],$row[35],$row[37],$row[39]));
				            $slope = encode_data(array($row[32],$row[34],$row[36],$row[38],$row[40]));
		            		$course_val .= "('".$c_id."','".$user_id."','".encode_ascii($name)."','".$row[18]."','".$row[19]."','".$row[20]."', 
		            			'".$row[21]."', '".$row[22]."', '".$row[23]."', '".$currency."', '".$row[24]."', 
		            			'".$row[25]."','".$row[26]."','".encode_ascii($row[27])."','".$row[28]."','".$row[29]."',
		            			'".$row[30]."','".$cr."','".$slope."','.$c_pos.'),";
	            		}
						// offer
						$o_id++;
						if(!empty($row[42])){
							$title = encode_data(array('1' => $row[42]));
							$descr = encode_data(array('1' => $row[43]));
		            		$offer_val .= "('".$o_id."','".$user_id."','".encode_ascii($title)."','".encode_ascii($descr)."',
		            			'".encode_date($row[44])."','".encode_date($row[45])."','.$o_pos.'),";
						}
						// reward
						$r_id++;
						if(!empty($row[46])){
							$title = encode_data(array('1' => $row[46]));
							$descr = encode_data(array('1' => $row[47]));
		            		$reward_val .= "('".$o_id."','".$user_id."','".encode_ascii($title)."','".encode_ascii($descr)."',
		            			'".encode_date($row[48])."','".encode_date($row[49])."','".$row[50]."','.$r_pos.'),";
		                }







		                
						// -------------------insert-----------------
						$count++;
						if($count>=500 || $count==($total-1)){
							
							$user_sql = 'INSERT INTO dip_users (id,username,name,slug,password,level,parrent,creation_date) VALUES ';
				            $user_sql = $user_sql . rtrim($user_val,',');
				            $user_sql .= ' ON DUPLICATE KEY UPDATE 
				            					name=VALUES(name), 
				            					slug=VALUES(slug), 
				            					password=VALUES(password), 
				            					level=VALUES(level), 
				            					parrent=VALUES(parrent), 
				            					creation_date=VALUES(creation_date)';
				            $this->db->query($user_sql);
				            $this->db->query("ALTER TABLE dip_users AUTO_INCREMENT=".($user_id+1));
				            $user_val = '';
				            
				            $golfclub_sql = 'INSERT INTO dip_golfclubs (id,user_id,descr,facilities,ios_url,android_url,phone,email,address,postalcode,city,state,country,latitude,longitude,push_notification) VALUES ';
				            $golfclub_sql = $golfclub_sql . rtrim($golfclub_val,',');
				            $golfclub_sql .= ' ON DUPLICATE KEY UPDATE 
				            					descr=VALUES(descr),
				            					facilities=VALUES(facilities),
				            					ios_url=VALUES(ios_url),
				            					android_url=VALUES(android_url),
				            					phone=VALUES(phone),
				            					email=VALUES(email),
				            					address=VALUES(address),
				            					postalcode=VALUES(postalcode),
				            					city=VALUES(city),
				            					state=VALUES(state),
				            					country=VALUES(country),
				            					latitude=VALUES(latitude),
				            					longitude=VALUES(longitude),
				            					push_notification=VALUES(push_notification)';
				            $this->db->query($golfclub_sql);
				            $this->db->query("ALTER TABLE dip_golfclubs AUTO_INCREMENT=".($gc_id+1));
				            $golfclub_val = '';
				            if(!empty($course_val)){
				            	$course_sql = 'INSERT INTO dip_nt_courses (id,user_id,name,holes,par,length,length_unit,
	        					range_from,range_to,range_currency,difficulty,handicap_men,handicap_women,welcome_option,welcome_option2,open_from,open_to,cr,slope,position) VALUES ';
					            $course_sql = $course_sql . rtrim($course_val,',');
					            $course_sql .= ' ON DUPLICATE KEY UPDATE 
					            					holes=VALUES(holes),
					            					par=VALUES(par),
					            					length=VALUES(length),
					            					length_unit=VALUES(length_unit),
					            					range_from=VALUES(range_from),
					            					range_to=VALUES(range_to),
					            					range_currency=VALUES(range_currency),
					            					difficulty=VALUES(difficulty),
					            					handicap_men=VALUES(handicap_men),
					            					handicap_women=VALUES(handicap_women),
					            					welcome_option=VALUES(welcome_option),
					            					welcome_option2=VALUES(welcome_option2),
					            					open_from=VALUES(open_from),
					            					open_to=VALUES(open_to),
					            					cr=VALUES(cr),
					            					slope=VALUES(slope)';
					            $this->db->query($course_sql);
					            $this->db->query("ALTER TABLE dip_nt_courses AUTO_INCREMENT=".($c_id+1));
					            $course_val='';
					        }
					        if(!empty($offer_val)){
					        	$offer_sql = 'INSERT INTO dip_nt_offers (id,user_id,title,descr,startdate,enddate,position) VALUES ';
					            $offer_sql = $offer_sql . rtrim($offer_val,',');
					            $offer_sql .= ' ON DUPLICATE KEY UPDATE 
					            					descr=VALUES(descr),
					            					startdate=VALUES(startdate),
					            					enddate=VALUES(enddate)';
					            $this->db->query($offer_sql);
					            $this->db->query("ALTER TABLE dip_nt_offers AUTO_INCREMENT=".($o_id+1));
					            $offer_val='';
					        }
					        if(!empty($reward_val)){
					        	$reward_sql = 'INSERT INTO dip_nt_rewards (id,user_id,title,descr,startdate,enddate,points,position) VALUES ';
					            $reward_sql = $reward_sql . rtrim($reward_val,',');
					            $reward_sql .= ' ON DUPLICATE KEY UPDATE 
					            					descr=VALUES(descr),
					            					startdate=VALUES(startdate),
					            					points=VALUES(points),
					            					enddate=VALUES(enddate)';
					            $this->db->query($reward_sql);
					            $this->db->query("ALTER TABLE dip_nt_rewards AUTO_INCREMENT=".($r_id+1));
					            $reward_val='';
					        }
							$total = $total- $count;
							$count=0;
						}
	                }
           		}
	        // --------------------------------------------------------------------------------------------
	        unlink($file);
	    }

	    if($type=='golfgroups'){
			$this->data['grid'] = 'golfgroups';
			$this->data['page']['desc'] = 'Manage All GolfGroups';
			$this->data['page']['foot'] = 'master/manageusers_foot_gg';
			$this->data['page']['subnav'][1]['active'] =true;
		}else{
			$this->data['grid'] = 'golfclubs';
			$this->data['page']['desc'] = 'Manage All GolfClubs';
			$this->data['page']['foot'] = 'master/manageusers_foot_gc';
			$this->data['page']['subnav'][0]['active'] =true;
		}
		$this->load->view('_layout_main',$this->data);
	}
	public function get_golfgroups(){
		// $table = "(dip_users AS u 
		// 	INNER JOIN (SELECT user_id, country, ios_status, android_status FROM dip_golfgroups) AS g ON u.id=g.user_id 
		// 	INNER JOIN (SELECT country_code, country_name FROM dip_countries) AS c ON c.country_code=g.country
		// 	)";
		//join table with golfgroup table to fetch all details
		$table = "(dip_users AS u 
			INNER JOIN (SELECT user_id, ios_status, android_status FROM dip_golfgroups) AS g ON u.id=g.user_id 
			)";
		$this->jqgrid->from($table);
		$this->jqgrid->select('id, name,slug, type, status, creation_date,renewal_date, ios_status, android_status');
		$this->jqgrid->searchable('name,slug');
		echo decode_ascii($this->jqgrid->get_result('json'));
	}
	public function get_golfclubs($pid=null){
		//join table with golfgroup table to fetch all details
		$table = "(dip_users AS u 
			INNER JOIN (SELECT user_id, country, ios_status, android_status FROM dip_golfclubs) AS g ON u.id=g.user_id 
			INNER JOIN (SELECT country_code, country_name FROM dip_countries) AS c ON c.country_code=g.country
			)";
		$this->jqgrid->from($table);
		$this->jqgrid->select('id, name, slug, country_name, type, status, level, creation_date,renewal_date, ios_status, android_status,logs');
		$this->jqgrid->searchable('name, slug, country_name, logs');
		
		if($pid)
			$where = 'parrent='.$pid;
		
		if($this->input->get('getLevel') != ''){
			if(isset($where))
				$where .= ' AND level='.$this->input->get('getLevel');
			else
				$where = 'level='.$this->input->get('getLevel');
		}
		if(isset($where))
			$this->jqgrid->where($where);
		
		echo decode_ascii($this->jqgrid->get_result('json'));
	}
	public function get_partners($pid=null){
		//join table with golfgroup table to fetch all details
		$table = "(dip_users AS u 
			INNER JOIN (SELECT user_id, country, position FROM dip_partners) AS g ON u.id=g.user_id 
			INNER JOIN (SELECT country_code, country_name FROM dip_countries) AS c ON c.country_code=g.country
			)";
		$this->jqgrid->from($table);
		$this->jqgrid->select('id, name, country_name, type, status,parrent,level, position, creation_date, renewal_date');
		$this->jqgrid->searchable('name, country_name');
		
		if($pid)
			$where = 'parrent='.$pid;
		
		if(isset($where))
			$this->jqgrid->where($where);

		echo $this->jqgrid->get_result('json');
	}
	public function delete() {
		echo $this->user_m->delete($this->input->post('id'));
	}
	public function status(){
		echo $this->user_m->status($this->input->post('id'),$this->input->post('status'));
	}
	public function position_partner(){
		echo $this->user_m->position_partner($this->input->post('id'),$this->input->post('position'));
	}

	public function multi_delete($type) {
		set_time_limit(3600);
		ini_set('memory_limit','512M');
		$users=array();
		if($this->input->post('deleteAll')){
			if($type=='golfclub')
				$sql = "SELECT id, name, country_name, type, level FROM (dip_users AS u INNER JOIN (SELECT user_id, country FROM dip_golfclubs) AS g ON u.id=g.user_id INNER JOIN (SELECT country_code, country_name FROM dip_countries) AS c ON c.country_code=g.country )";
			else
				$sql = "SELECT id, name, country_name, type, level FROM (dip_users AS u INNER JOIN (SELECT user_id, country FROM dip_golfgroups) AS g ON u.id=g.user_id INNER JOIN (SELECT country_code, country_name FROM dip_countries) AS c ON c.country_code=g.country )";
			
			$where = '';
			if($this->input->post('getLevel') != ''){
				$where = 'level='.$this->input->post('getLevel');
			}
			if($this->input->post('globalSearch') != ''){
				$search=$this->input->post('globalSearch');
				if($where !='')
					$where .= " AND ";
				$where .= "( name LIKE '%".$search."%' OR country_name LIKE '%".$search."%' )";
			}
			if($where!='')
				$sql .= " WHERE ".$where;

			$query = $this->db->query($sql);
			
	      	foreach($query->result_array() as $row) {
	          $users[] = $row['id'];
		    }
		}
		if($this->input->post('deleteSelected'))
			$users=$this->input->post('deleteSelected');
	    
	    // show($users);
	   	echo $this->user_m->multi_delete($users,$type);
	}
	/**
	 * Edit Pages
	 */
	public function golfgroup($id=null){
		$this->load->model('golfgroup_m');
		$this->load->model('xtra_m');
		$this->data['client'] = $this->golfgroup_m->get_full_details($id);
		if($this->input->post()){
			$rules = $this->golfgroup_m->rules_master;
			if($id){
				$rules['username'] = array(
						'field'=>'username',
						'label'=>'User Name',
						'rules'=>'tream|xss_clean|required|callback__unique_username['.$id.']'
					);
			}
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run() == TRUE){
				$post = $this->input->post();
				$post['type'] = 1;
				$this->user_m->save($post,$id);
				// show($post);
			}
		}
		if($this->input->post())
			$this->data['client']->languages = $this->input->post()['languages'];
		$this->data['countries'] = $this->xtra_m->get_all_countries();

		unset($this->data['page']['subnav']);
		unset($this->data['page']['foot']);
		$this->data['page']['type'] = 1;
		$this->data['page']['desc'] = ($id?'Edit':'Create').' GolfGroup';
		$this->data['page']['subview']='master/editusers';
		$this->load->view('_layout_main',$this->data);
		// show($this->data);
	}
	public function golfclub($id=null){
		
		$nu = new User();
		if($id){
			$userdata = $nu->get_by_id($id);
		}
		//print_r($userdata->type);
		if($userdata->type==1)
			$nh = new Golfgroup();
		elseif($userdata->type==2)
			$nh = new Golfclub();
		else
			$nh = new Partner();
		
		if($id) 
		{
			$lng = $nh->where(array('user_id' => $id))->get();
			$lang = $lng->default_language;
			
		}
		
		
		$this->load->model('golfclub_m');
		$this->load->model('xtra_m');
		if($this->input->post()){
			/*echo "<pre>";
			print_r($this->input->post());
			echo "</pre>";
			die("asAS");*/
			
			$rules = $this->golfclub_m->rules_master;
			if($id)
			{
				$rules['username'] = array(
						'field'=>'username',
						'label'=>'User Name',
						'rules'=>'tream|xss_clean|required|callback__unique_username['.$id.']'
					);
			}
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run() == TRUE){
				$post = $this->input->post();
				$post['type'] = 2;
				$this->user_m->save($post,$id);
				// show($post);
			}
		}

		//get client details if id exists or get empty
		$this->data['client'] = $this->golfclub_m->get_full_details($id);
		$this->data['countries'] = $this->xtra_m->get_all_countries();

		//if parent is given or already exists
		if(!$id && is_numeric($this->input->get('parent')))
			$this->data['client']->parrent = $this->input->get('parent');
		
		// get parent name and languages
		if($this->data['client']->parrent)
		{
			$this->data['client']->parent_name = $this->user_m->getuser($this->data['client']->parrent)['name'];
			$l = $this->user_m->get_languages($this->data['client']->parrent,1);
			$this->data['client']->parent_languages = $l->laguages;
			$this->data['client']->parent_default_language = $l->default_language;

			//languages are not set i.e, new user
			if(empty($this->data['client']->languages))
				$this->data['client']->languages = $this->data['client']->parent_languages;
			if(empty($this->data['client']->default_laguage))
				$this->data['client']->default_language = $this->data['client']->parent_default_language;
		}
		
		if(empty($lang)){
			if(empty($this->data['client']->languages))
				$this->data['client']->languages = array('1');
			if(empty($this->data['client']->default_language))
				$this->data['client']->default_language = 1;

		} else {
			$this->data['client']->default_language = $lang;
		}
		// if post is entered previously
		if($this->input->post()){
			$this->data['client']->languages = $this->input->post()['languages'];
		}

		unset($this->data['page']['subnav']);
		unset($this->data['page']['foot']);
		$this->data['page']['type'] = 2;
		$this->data['page']['desc'] = ($id?'Edit':'Create').' GolfClub';
		$this->data['page']['subview']='master/editusers';
		$this->load->view('_layout_main',$this->data);
		// show($this->data);
	}
	public function partner($id=null){
		$this->load->model('partner_m');
		$this->load->model('xtra_m');
		if($this->input->post()){
			$rules = $this->partner_m->rules_master;
			$rules['parent'] = array(
						'field'=>'parent',
						'label'=>'Golf Club Name',
						'rules'=>'tream|xss_clean|is_natural_no_zero'
					);
			if($id){
				$rules['username'] = array(
						'field'=>'username',
						'label'=>'User Name',
						'rules'=>'tream|xss_clean|required|callback__unique_username['.$id.']'
					);
			}
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run() == TRUE){
				$post = $this->input->post();
				/*print_r($post);
				die();*/ 
				$this->user_m->save($post,$id);
				// show($post);
			}
		}
		$this->data['client'] = $this->partner_m->get_full_details($id);
		$this->data['countries'] = $this->xtra_m->get_all_countries();
		if(!$id && is_numeric($this->input->get('parent')))
			$this->data['client']->parrent = $this->input->get('parent');
		
		if($this->data['client']->parrent)
			$this->data['client']->parent_name = $this->user_m->getuser($this->data['client']->parrent)['name'];

		unset($this->data['page']['subnav']);
		unset($this->data['page']['foot']);
		$this->data['page']['type'] = 3;
		$this->data['page']['desc'] = ($id?'Edit':'Create').' Partner';
		$this->data['page']['subview']='master/editusers';
		$this->load->view('_layout_main',$this->data);
		// show($this->data['client']);
	}
	
	/**
	 * callback function to check if username already exists
	 */
	public function _unique_username($str,$uid){
		$check_u = new User();
		$count_u = $check_u->where(array('username' => $this->input->post('username'),'id !=' => $uid))->count();

		if($count_u != 0){
			$this->form_validation->set_message('_unique_username', '%s should be unique');
			return FALSE;
		}
		return TRUE;
	}
	public function get_all_parents(){
		$page = $this->input->get('page');
		$draw = 25;
		$u = new User();
		$u->where(array('type'=>$this->input->get('type'),'status'=>1));
		if($this->input->get('type')==2)
			$u->where('level',3);
		
		if($this->input->get('search'))
			$u->like('name', $this->input->get('search'));
		
		$u->order_by('name', 'asc');
		$clone = $u->get_clone();
		$u->get_paged($page,$draw);
		
		$total = $clone->count();
		$index = $page*$draw - $draw;

		$res = array();
		foreach ($u as $r) {
			$obj = new stdClass;
			$obj->id = $r->id;
			$obj->name = $r->name;
			if($total>$index)
				$res[] = $obj;
		}
		echo encode_data($res);
	}
	public function get_languages($id=null,$type){
		echo encode_data($this->user_m->get_languages($id,$type));
	}
}