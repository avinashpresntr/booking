<?php
class Golfclub_m extends DIP_Model{
	public $rules_master = array(
			'parrent' =>  array(
					'field'=>'parrent',
					'label'=>'Golf Group Name',
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
			'ios_status' =>  array(
					'field'=>'ios_status',
					'label'=>'Ios Status',
					'rules'=>'trim|xss_clean'
			),
			'android_status' =>  array(
					'field'=>'android_status',
					'label'=>'Android Status',
					'rules'=>'trim|xss_clean'
			),
			'ios_url' =>  array(
					'field'=>'ios_url',
					'label'=>'IOS Url',
					'rules'=>'trim|xss_clean|prep_url'
			),
			'android_url' =>  array(
					'field'=>'android_url',
					'label'=>'Andoird Url',
					'rules'=>'trim|xss_clean|prep_url'
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
					'label'=>'Booking Email',
					'rules'=>'trim|xss_clean|valid_email|required'
			),
			'phone' =>  array(
					'field'=>'phone',
					'label'=>'Booking Phone',
					'rules'=>'xss_clean|required'
			),
			'website' =>  array(
					'field'=>'website',
					'label'=>'Booking WebSite',
					'rules'=>'xss_clean|prep_url'
					
			),
			'book_online' =>  array(
					'field'=>'book_online',
					'label'=>'Book_online',
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
					'label'=>'Golf Club Address',
					'rules'=>'xss_clean'
			),
			'latitude' =>  array(
					'field'=>'latitude',
					'label'=>'Golf Club Latitude',
					'rules'=>'xss_clean|numeric|required'
			),
			'longitude' =>  array(
					'field'=>'longitude',
					'label'=>'Golf Club Longitude',
					'rules'=>'xss_clean|numeric|required'
			),
	);

	function __construct(){
		parent::__construct();
	}

	/**
	 * Full Details about a Golf Club
	 */
	public function get_full_details($input){
		$u = new Golfclub();
		if(is_numeric($input)){
			$u->include_related('user', array('name','username','password','parrent','level','creation_date','renewal_date'));
			$u->get_by_user_id($input);
		}

		// passing the useraccount details
		$u->stored->username = $u->user_username;
		$u->stored->password = $u->user_password;
		$u->stored->name = decode_ascii($u->user_name);
		$u->stored->level = $u->user_level;
		$u->stored->parrent = $u->user_parrent;
		$u->stored->creation_date = decode_date($u->user_creation_date);
		$u->stored->renewal_date = decode_date($u->user_renewal_date);
		
		$u->stored->descr = decode_ascii($u->descr);
		$u->stored->address = decode_ascii($u->address);
		$u->stored->city = decode_ascii($u->city);
		$u->stored->state = decode_ascii($u->state);

		$u->stored->languages = decode_data($u->stored->languages);
		$u->stored->ios_status = decode_date($u->stored->ios_status);
		$u->stored->android_status = decode_date($u->stored->android_status);

		// golf group name if exists
		if($u->user_parrent != 0){
			$hg = $this->user_m->getuser($u->user_parrent);
			if(!empty($hg['id'])){
				$u->stored->group = $hg['name'];
			}else{
				$u->stored->group = 'Missing';
			}			
		}else{
			$u->stored->group = 'Individual';
		}
		return $u->stored;
	}
	public function save($post,$id){
		$nh = new Golfclub();
		$nh->where(array('user_id' => $id))->get();
		
		$nh->contact_person = $post['contact_person'];
		$nh->contact_email = $post['contact_email'];
		$nh->contact_phone = $post['contact_phone'];
		
		$nh->phone = $post['phone'];
		$nh->email = $post['email'];
		$nh->website = $post['website'];
		$nh->book_online = $post['book_online'];

		$nh->address = encode_ascii($post['address']);
		$nh->streetno = $post['streetNo'];
		$nh->route = $post['route'];
		$nh->city = encode_ascii($post['city']);
		$nh->state = encode_ascii($post['state']);
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
			return true;
		}
	}
	public function reset_push_counter($id,$month){
		$nh = new Golfclub();
		$nh->select('id,user_id,push_counter,push_month');
		$nh->where(array('user_id' => $id))->get();
		$nh->push_counter = 0;
		$nh->nt_push_counter = 0;
		$nh->push_month = $month;
		$nh->save();
	}
}