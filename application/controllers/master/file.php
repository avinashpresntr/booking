<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class File extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        error_reporting(E_ALL | E_STRICT);
        $this->load->library("UploadHandler");
    }
}