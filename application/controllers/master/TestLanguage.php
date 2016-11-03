<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TestLanguage
 *
 * @author TIJANI
 */
class TestLanguage extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->lang->load("message", "english");
    }

    function index() {
        $data["language_msg"] = $this->lang->line("msg_hello_english");
        $this->load->view('language_view', $data);
    }

}
