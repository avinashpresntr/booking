<?php
class Login_m extends DIP_Model{

	function __construct(){
		parent::__construct();
	}
	
	public function get_user($post){
		$where = "(BINARY username='".$post['username']."' AND BINARY password='".$post['password']."' AND status=1)";
		$u = new User();
		$u->where($where)->get();
		if($u->exists()){
			if (strpos($u->logs, '1') == false){
				$u->logs = $u->logs.'1';
				$u->save();
			}
			return (array)$u->stored;
		}else{
			return FALSE;
		}
	}
	/**
	 * login functionalities
	 * @return [type] [description]
	 */
	public function login($user){
		//it just set the user to session
		$user['loggedin'] = TRUE;
		$this->session->set_userdata($user);
	}
	public function logout(){
		$this->session->sess_destroy();
	}
	public function loggedin(){
		return (bool) $this->session->userdata('loggedin');
	}
	public function logtype(){
		return $this->session->userdata('type');
	}
}