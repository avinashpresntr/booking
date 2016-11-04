<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Frontend extends CI_Controller {	
   
	function __construct() {
		 parent::__construct();
		$this->load->library('layout');          // Load layout library     
		//$this->load->model('frontend','',TRUE);
		$this->load->library('session');
	}
	public function index()	{   
		$this->layout->title('Home');
		$this->layout->description('Home');   
		$this->layout->layout_view = 'frontend/layout.php';
		$this->layout->view('frontend/home', $data);
	}
	
}
?>