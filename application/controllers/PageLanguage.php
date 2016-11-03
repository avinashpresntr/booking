<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class PageLanguage extends CI_Controller
{
    public function __construct() {
        parent::__construct();     
    }
 
  
    function switchLang($language = "") {
		//die("20");
        
        $language = ($language != "") ? $language : "english";
        $this->session->set_userdata('site_lang', $language);        
        redirect(base_url());
    }
	
    
}