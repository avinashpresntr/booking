<?php
class Golfgroup_m extends DIP_Model{
	public $rules_master = array(
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
			)
	);
	public $profile_rules = array(
			'booking_email' =>  array(
					'field'=>'booking_email',
					'label'=>'Booking Email',
					'rules'=>'trim|xss_clean|valid_email|required'
			),
			'booking_phone' =>  array(
					'field'=>'booking_phone',
					'label'=>'Booking Phone',
					'rules'=>'xss_clean|required'
			),
			'website' =>  array(
					'field'=>'website',
					'label'=>'Booking WebSite',
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
					'label'=>'Hotel Address',
					'rules'=>'xss_clean'
			),
			'latitude' =>  array(
					'field'=>'latitude',
					'label'=>'Hotel Latitude',
					'rules'=>'xss_clean|numeric|required'
			),
			'longitude' =>  array(
					'field'=>'longitude',
					'label'=>'Hotel Longitude',
					'rules'=>'xss_clean|numeric|required'
			),
	);

	function __construct(){
		parent::__construct();
	}
	public function get_full_details($input){
		$u = new Golfgroup();
		if(is_numeric($input)){
			$u->include_related('user', array('name','username','password','parrent','creation_date','renewal_date'));
			$u->get_by_user_id($input);
		}

		// passing the useraccount details
		$u->stored->username = $u->user_username;
		$u->stored->password = $u->user_password;
		$u->stored->name = decode_ascii($u->user_name);
		$u->stored->city = decode_ascii($u->city);
		$u->stored->parrent = $u->user_parrent;
		$u->stored->creation_date = decode_date($u->user_creation_date);
		$u->stored->renewal_date = decode_date($u->user_renewal_date);
		
		$u->stored->languages = decode_data($u->stored->languages);
		$u->stored->ios_status = decode_date($u->stored->ios_status);
		$u->stored->android_status = decode_date($u->stored->android_status);

		if (empty($u->stored->languages)) {
			$u->stored->languages = array('1');
		}

		if (empty($u->stored->default_language)) {
			$u->stored->default_language = '1';
		}
		return $u->stored;
	}
	public function get_related_hid($relation,$id){
		$h = new Golfgroup();
		$h->select('id');
		$h->where_related($relation, 'id', $id)->get();
		return $h->id;
	}
}