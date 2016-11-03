<?php
class Partner_m extends DIP_Model{
	public $rules_master = array(
			'parent' =>  array(
					'field'=>'parent',
					'label'=>'Golf Group Name',
					'rules'=>'tream|xss_clean|integer'
			),
			'type' =>  array(
					'field'=>'type',
					'label'=>'Partner Category',
					'rules'=>'tream|xss_clean|integer'
			),
			'name' =>  array(
					'field'=>'name',
					'label'=>'Full Name',
					'rules'=>'xss_clean|required'
			),
			'username' =>  array(
					'field'=>'username',
					'label'=>'User Name',
					'rules'=>'trim|xss_clean|required|callback__unique_username'
			),
			'password' =>  array(
					'field'=>'password',
					'label'=>'Password',
					'rules'=>'trim|required'
			),
			'creation_date' =>  array(
					'field'=>'creation_date',
					'label'=>'Creation Date',
					'rules'=>'trim|xss_clean'
			),
			'renewal_date' =>  array(
					'field'=>'renewal_date',
					'label'=>'Creation Date',
					'rules'=>'trim|xss_clean'
			),
			'contact_person' =>  array(
					'field'=>'contact_person',
					'label'=>'Contact Person',
					'rules'=>'xss_clean'
			),
			'contact_email' =>  array(
					'field'=>'contact_email',
					'label'=>'Contact Email',
					'rules'=>'trim|xss_clean|valid_email'
			),
			'contact_phone' =>  array(
					'field'=>'contact_phone',
					'label'=>'Contact Phone',
					'rules'=>'xss_clean'
			),
			'push_note' =>  array(
					'field'=>'push_note',
					'label'=>'Push Notification',
					'rules'=>'trim|xss_clean|numeric'
			),
	);
	public $profile_rules = array(
			'email' =>  array(
					'field'=>'email',
					'label'=>'Email',
					'rules'=>'trim|xss_clean|valid_email|required'
			),
			'phone' =>  array(
					'field'=>'phone',
					'label'=>'Phone',
					'rules'=>'xss_clean|required'
			),
			'website' =>  array(
					'field'=>'website',
					'label'=>'Website',
					'rules'=>'xss_clean|prep_url'
			),
			'streetNo' => array(
						'field'=>'streetNo',
						'label'=> 'Street Number',
						'rules'=>'xss_clean'
			),
			'route' => array(
						'field'=>'route',
						'label'=> 'Route',
						'rules'=>'xss_clean'
			),
			'city' => array(
						'field'=>'city',
						'label'=> 'City',
						'rules'=>'xss_clean|required'
			),
			'state' => array(
						'field'=>'state',
						'label'=> 'State',
						'rules'=>'xss_clean'
			),
			'postalcode' => array(
						'field'=>'postalcode',
						'label'=> 'Postal Code',
						'rules'=>'xss_clean'
			),
			'country' => array(
						'field'=>'country',
						'label'=> 'Country',
						'rules'=>'xss_clean|required'
			),
			'address' =>  array(
					'field'=>'address',
					'label'=>'Address',
					'rules'=>'xss_clean'
			),
			'latitude' =>  array(
					'field'=>'latitude',
					'label'=>'Latitude',
					'rules'=>'xss_clean|numeric|required'
			),
			'longitude' =>  array(
					'field'=>'longitude',
					'label'=>'Longitude',
					'rules'=>'xss_clean|numeric|required'
			)
	);

	function __construct(){
		parent::__construct();
	}

	/**
	 * Full Details about a Golf Club
	 */
	public function get_full_details($input){
		$u = new Partner();
		if(is_numeric($input)){
			$u->include_related('user', array('name','username','password','parrent','type','level','creation_date','renewal_date'));
			$u->get_by_user_id($input);
		}

		// passing the useraccount details
		$u->stored->username = $u->user_username;
		$u->stored->password = $u->user_password;
		$u->stored->name = decode_ascii($u->user_name);
		$u->stored->type = $u->user_type;
		$u->stored->parrent = $u->user_parrent;
		$u->stored->creation_date = decode_date($u->user_creation_date);
		$u->stored->renewal_date = decode_date($u->user_renewal_date);
		
		$u->stored->title = decode_data($u->title);
		$u->stored->descr = decode_data($u->descr);
		$u->stored->pics = decode_data($u->pics);

		return $u->stored;
	}

	public function save($post,$id){
		if(isset($post['name'])){
			$u = new User();
			$u->get_by_id($id);
			$u->name = $post['name'];
			$u->save();
		}

		$nh = new Partner();
		$nh->where(array('user_id' => $id))->get();
		
		$nh->contact_person = $post['contact_person'];
		$nh->contact_email = $post['contact_email'];
		$nh->contact_phone = $post['contact_phone'];
		
		$nh->phone = $post['phone'];
		$nh->email = $post['email'];
		$nh->website = $post['website'];

		$nh->address = $post['address'];
		$nh->streetno = $post['streetNo'];
		$nh->route = $post['route'];
		$nh->city = $post['city'];
		$nh->state = $post['state'];
		$nh->postalcode = $post['postalcode'];
		$nh->country = $post['country'];
		$nh->latitude = $post['latitude'];
		$nh->longitude = $post['longitude'];
		
		$success = $nh->save();
		if(! $success)
		{
			$this->session->set_flashdata('error_msg', 'Sorry! Data is not saved');
			redirect(current_full_url());
		}else{
			$this->session->set_flashdata('success_msg', 'The Profile updated successfully');
			redirect(current_full_url());
		}
	}
	public function save_descr($post,$id){
		$nh = new Partner();
		$nh->where(array('user_id' => $id))->get();
		
		$nh->descr = encode_data($post['descr']);
		$success = $nh->save();
		if(!$success)
		{
			$this->session->set_flashdata('error_msg', 'Sorry! Data is not saved');
			redirect(current_full_url());
		}else{
			if(isset($post['previmage']) || isset($post['thumb'])){
				isset($post['previmage'])||$post['previmage']=null;
				isset($post['thumb'])||$post['thumb']=null;
				//if record saved is done i.e, record exists with an id
				$dzid = $nh->id;
				// get the record to change the image field
				$last = new Partner();
				$last->where('id',$dzid)->get();
				
				$upload_url = 'uploads/'.$this->data['user']['parrent'].'/'.strtolower($this->data['user_types'][$this->data['user']['type']]).'/'.$this->data['user']['id'].'/description/';
				$last->pics = get_uploaded_image_list($upload_url,$last->stored->pics,$post['previmage'],$post['thumb']);
				
				$last->save();
			}

			$this->session->set_flashdata('success_msg', 'Description updated successfully');
			redirect(current_full_url());
		}
	}
	public function reset_push_counter($id,$month){
		$nh = new Partner();
		$nh->select('id,user_id,push_counter,push_month');
		$nh->where(array('user_id' => $id))->get();
		$nh->push_counter = 0;
		$nh->push_month = $month;
		$nh->save();
	}
}