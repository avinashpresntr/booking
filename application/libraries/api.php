<?php
/**
 *
 * @package Api Response Object
 * @copyright (c) 2012 DipenduD3v <dipendu.d3v@gmail.com>
 * Description: PHP Codeigniter Restful Api Response object Library
 * License: BSD
 */

class Api{
	public $data;
	
	public function __construct(){
		$ci =& get_instance();
		$this->data = array();
		$this->data['success'] = 0;
		$this->data['tag'] = null;
	}
	public function add_data($field,$value){
		$this->data[$field] = $value;
	}
	public function set_title($value){
		$this->data['tag'] = $value;
	}

	public function set_paging($total,$results,$page=null,$draw=null,$order=null){
		$paging = new stdClass;
		$paging->total = (int) $total;
		$paging->results = (int) $results;

		if($page && $draw){
			$paging->page = (int) $page;
			$paging->draw = (int) $draw;
		}else{
			$paging->page = 1;
			$paging->draw = $paging->total;
		}
		$paging->order = ($order?$order:'asc');
		
		//check if query is valid or not
		if($page>1 && $draw >= $total){
			$this->error(404);
		}

		$this->data['paging'] = $paging;
	}
	
	public function error($code,$msg=null,$show=true){

		// predefined errors as code => message
		$errorList = array(

			100 => 'The Client Id is not defind.',
			101 => 'The Client Id does not exists or The Client Id is currently inactive.',
			102 => 'The Language Id does not exists.',
			103 => 'The Language is not available for this User.',

			// changed or moved
			300 => 'This request and future requests for the same operation have to be sent to the URL specified in the Location header of this response instead of to the URL to which this request was sent.',
			
			// badRequest / invalidQuery
			400 => 'The API request is invalid. Please, Check the API documentation to determine what parameters are supported for the request.',
			401 => 'The user is not authorized to make the request.',
			403 => 'The requested operation is forbidden and cannot be completed.',
			404 => 'Sorry A resource associated with the request could not be found.',
			405 => 'The HTTP method associated with the request is not supported.',
			409 => 'The API request cannot be completed because the requested operation is conflicting.',
			410 => 'The request failed because the resource associated with the request has been deleted.',
			417 => 'A client expectation cannot be met by the server.',
			
			// server errors
			500 => 'The request failed due to an internal error.',
			501 => 'The requested operation has not been implemented.',
			503 => 'The API server is not ready to accept requests.',			
		);

		if(isset($code)){
			$this->error = array();
			$this->error['code'] = $code;
			$this->error['message'] = ( array_key_exists($code,  $errorList) ? $errorList[$code] : 'An unknown error occurred.');
			if($msg!=null){$this->error['message'] = $msg;}
		}

		if($show==true){$this->response();}
	}
	public function response(){
		$response = new stdclass;

		if(isset($this->error)){
			$response->error = (object)$this->error;
		}elseif(empty($this->data)){
			$this->error(404);
		}else{
			$this->data['success'] = 1;
			$response = (object)$this->data;
		}
		echo json_encode($response);
		exit();
	}
}