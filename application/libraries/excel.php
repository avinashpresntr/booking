<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* 
 *  ======================================= 
 *  Author     : Muhammad Surya Ikhsanudin 
 *  License    : Protected 
 *  Email      : mutofiyah@gmail.com 
 *   
 *  Dilarang merubah, mengganti dan mendistribusikan 
 *  ulang tanpa sepengetahuan Author 
 *  ======================================= 
 */  
require_once APPPATH."/third_party/php-excel-reader/excel_reader2.php";
require_once APPPATH."/third_party/php-excel-reader/SpreadsheetReader.php";
 
class Excel { 
    // public function __construct() { 
    //     parent::__construct(); 
    // }
    public function read($file) { 
       return new SpreadsheetReader($file);
    }
}