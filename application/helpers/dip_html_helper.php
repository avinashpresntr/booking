<?php

//escaping non html scripts from data
function e($string){
	return htmlentities($string);
}
function show($data){
	echo '<pre>'.print_r($data,true).'</pre>';
}
function get_sidebar($nav,$active,$ut,$st){
	$html = '';
	$html .= '<ul class="dip-sidebar">';
	foreach ($nav as $item) {
		$a = '';
		if($active == $item['slug']){
			$a = 'active';
		}

		$ia = '';
		if(isset($item['class'])){
			$ia = $item['class'];
		}

		$query = '';
		if($_SERVER['QUERY_STRING']){
			$query = '?'.$_SERVER['QUERY_STRING'];
		}

		if($item['slug'] == 'logout' && $ut != $st){
			//do nothing
		}else{
			$html .= '<li class="'.$a.'"><a class="'.$a.' '.$ia.'" href="'.site_url($item['url']).$query.'">'.$item['icon'].' '.$item['title'].'</a></li>';
		}
	}
	$html .='</ul>';
	return $html;
}
function get_subnav($nav){
	$html = '';
	$html .= '<div class="dip-subnav">';
	foreach ($nav as $item) {
		$html .= '<a href="'.$item['url'].'" class="btn '.($item['active'] ? 'active' : '').' '.($item['disabled'] ? 'disabled' : '').'" >'.$item['title'].'</a>';
	}
	$html .= '</div>';
	return $html;
}
function get_msg($url=null){
	$CI =& get_instance();

	$rstr = '';
    if(validation_errors()){
      $rstr .= '<div class="alert alert-danger alert-dismissible" role="alert">'.validation_errors().'</div>';
    }
    if($CI->session->flashdata('success_msg')){
    	if (isset($url)) {
			$rstr .= '<a href="'.site_full_url($url).'" style="margin-bottom:10px;" class="btn btn-info">< Go back</a><br/>';
		}
		$rstr .= '<div class="alert alert-success alert-dismissible" role="alert">'.$CI->session->flashdata('success_msg').'</div>';
	}
	if($CI->session->flashdata('success_msg_push')){
		$rstr .= '<div class="alert alert-success alert-dismissible" role="alert">'.$CI->session->flashdata('success_msg_push').'</div>';
	}
	
	if($CI->session->flashdata('error_msg')){
      $rstr .= '<div class="alert alert-danger alert-dismissible" role="alert">'.$CI->session->flashdata('error_msg').'</div>';
    }
    return $rstr;
}
function get_alerts($url='',$page){

	$CI =& get_instance();

    if(validation_errors()){
      return '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.validation_errors().'</div>';
    }

    if($CI->session->flashdata('success_msg')){
		$rstr = '<script>jQuery(document).ready(function ($) {';
      	$rstr .= 'alertify.confirm("'.$CI->session->flashdata('success_msg').'").set({';
      	$rstr .= "'labels':{ok:'Yes', cancel:'No'},'title': '".$CI->session->flashdata('success_msg')."', 'message': 'Do You want to add a new $page ?','onok': function(){},'oncancel': function(){ ";
      	$rstr .= 'window.location = "'.site_full_url($url).'";';
      	$rstr .= '} });});</script>';
		return $rstr;
    }
    if($CI->session->flashdata('error_msg')){
      return '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$CI->session->flashdata('error_msg').'</div>';
    }
}