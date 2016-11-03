<?php 

function notEmpty($v){
	if(isset($v) && !empty($v))
		return true;
	else
		return false;
}
function isZero($v){
	if(isset($v) && $v==0 && $v!='')
		return true;
	else
		return false;
}


function escape_quote($data){
	return str_replace("\\\'","'",$data);
}


function encode_slug($data){
	$data = entities_to_ascii(ascii_to_entities($data));
	return str_replace("'","\'",strtolower(convert_accented_characters($data)));
}

function encode_ascii($data){
	return str_replace("'","\'",ascii_to_entities($data));
}
function decode_ascii($data){
	return str_replace("\'","'",entities_to_ascii($data));
}

function encode_data($data){
	return encode_ascii(json_encode($data,true));
}
function decode_data($data){
	return (array)json_decode(decode_ascii($data), true);
}
function decode_data_raw($data){
	return json_decode(decode_ascii($data), true);
}
function encode_date($data){
	if(empty($data)){
		return null;
	}else{
		return date('Y-m-d', strtotime($data));
	}
}
function decode_date($data){
	if($data==null){
		return '';
	}else{
		return date("d-m-Y", strtotime($data));
	}
	
}
function decode_file($data){
	$data = json_decode(utf8_decode($data), true);
	if(!empty($data))
		$data['url'] = site_url($data['url']);
	return $data;
}
function decode_img($data){
	$data = json_decode(utf8_decode($data), true);
	
	$return = array();
	if(!empty($data)){
		foreach($data as $key=>$item){
			$return[$key]['name'] = $item['name'];
			$return[$key]['url'] = site_url($item['url']);
		}
	}
	return $return;
}


function upload_img($image,$upload_dir,$file_name){

	$searchType = array('data:image/jpeg;base64,', 'data:image/png;base64,','data:image/jpg;base64,','data:image/gif;base64,');

	if (!is_dir($upload_dir)) {
	    mkdir($upload_dir, 0777, true);
	}

	
	$img1 = $image['data'];
	$img1 = str_replace($searchType, '', $img1);
	$img1 = str_replace(' ', '+', $img1);
	$data1 = base64_decode($img1);
	$name1 = $file_name . '.jpg';
	$file1 =  $upload_dir . $name1;
	$success1 = file_put_contents($file1, $data1);
	if(!$success1){
		return FALSE;
	}

	if(isset($image['original'])){
		$img2 = $image['original'];
		$img2 = str_replace($searchType, '', $img2);
		$img2 = str_replace(' ', '+', $img2);
		$data2 = base64_decode($img2);
		$name2 = $file_name . '_org.jpg';
		$file2 =  $upload_dir . $name2;
		$success2 = file_put_contents($file2, $data2);
		if(!$success2){
			unlink($file1);
			return FALSE;
		}
	}else{
		$name2 = $file_name . '_org.jpg';
	}

	// $imgObj = (object) $image;
	// $imgObj->data = $name1;
	// $imgObj->original = $name2;
	// $imgObj->path = $upload_dir;
	// $imgObj->url = $file1;
	
	$imgObj = new stdClass;
	$imgObj->name = $name1;
	$imgObj->original = $name2;
	$imgObj->path = $upload_dir;
	$imgObj->url = $file1;

	return $imgObj;
}
function delete_img($upload_dir,$file_name=''){
	$path = $upload_dir.$file_name;
	if(is_file("$path")) {
		unlink($path);
	}
}

function get_uploaded_image_list2($upload_url,$pic_json,$previmg=null,$newimg=null){

	$pics = decode_data($pic_json);

	//the new images with the remaining previous also
	$newpics = array();
	//delete old image from previous list
	if(isset($previmg)){
		foreach ($pics as $key => $value) {
			if(array_key_exists($key, $previmg)){
				// delete those pictures from the server
				delete_img($upload_url, $value['name']);
				$newpics[$key] = null;
			}else{
				$newpics[$key] = (array)$value;
			}
		}
	}else{
		$newpics = $pics;
	}
	

	// new images to be uploaded
	if(isset($newimg)){				
		foreach ($newimg as $key => $thumb) {	
			$image = decode_data($thumb);
			$pic = upload_img($image,$upload_url,uniqid());
			if($pic){
				$newpics[$key] = (array)$pic;
			}
		}
	}
	
	ksort($newpics);
	// // update the list in the database
	return encode_data(array_values($newpics));
}







function get_uploaded_image_list($upload_url,$pic_json,$previmg=null,$newimg=null){

	$pics = decode_data($pic_json);

	//the new images with the remaining previous also
	$newpics = array();
	//delete old image from previous list
	if(isset($previmg)){
		foreach ($pics as $key => $value) {
			if(array_key_exists($key, $previmg)){
				// delete those pictures from the server
				delete_img($upload_url, $value['name']);
			}else{
				$newpics[$key] = (array)$value;
			}
		}
	}else{
		$newpics = $pics;
	}
	

	// new images to be uploaded
	if(isset($newimg)){				
		foreach ($newimg as $key => $thumb) {	
			$image = decode_data($thumb);
			$pic = upload_img($image,$upload_url,uniqid());
			if($pic){
				$newpics[$key] = (array)$pic;
			}
		}
	}
	
	ksort($newpics);
	// // update the list in the database
	return encode_data(array_values($newpics));
}
function get_timee($country,$city){
	$country = str_replace(' ', '', $country);
	$city = str_replace(' ', '', $city);
	$geocode_stats = file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?address=$city+$country,&sensor=false");
	$output_deals = json_decode($geocode_stats);
	if(!isset($output_deals->results) || empty($output_deals->results)){
		return date('Y-m-d');
	}
	$latLng = $output_deals->results[0]->geometry->location;
	$lat = $latLng->lat;
	$lng = $latLng->lng;
	$google_time = file_get_contents("https://maps.googleapis.com/maps/api/timezone/json?location=$lat,$lng&timestamp=1331161200&key=AIzaSyBZgAknSnLsRGm_LshCpsPMygt5MKG2ci0");
	$timez = json_decode($google_time);
	if(isset($timez->timeZoneId)){
		$d = new DateTime("now", new DateTimeZone($timez->timeZoneId));
		return  $d->format('Y-m-d');
	}else{
		return date('Y-m-d');
	}

}


function currencyConverter($currency_from,$currency_to,$currency_input){
    $yql_base_url = "http://query.yahooapis.com/v1/public/yql";
    $yql_query = 'select * from yahoo.finance.xchange where pair in ("'.$currency_from.$currency_to.'")';
    $yql_query_url = $yql_base_url . "?q=" . urlencode($yql_query);
    $yql_query_url .= "&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys";
    $yql_session = curl_init($yql_query_url);
    curl_setopt($yql_session, CURLOPT_RETURNTRANSFER,true);
    $yqlexec = curl_exec($yql_session);
    $yql_json =  json_decode($yqlexec,true);
    $currency_output = (float) $currency_input*$yql_json['query']['results']['rate']['Rate'];

    return $currency_output;
}

function deleteFolder($directory, $empty = false) { 
    if(substr($directory,-1) == "/") { 
        $directory = substr($directory,0,-1); 
    }
     // $directory = site_url( $directory );
     // return $directory;

    if(!file_exists($directory) || !is_dir($directory)) { 
        return false; 
    } elseif(!is_readable($directory)) { 
        return false; 
    } else { 
    	
        $directoryHandle = opendir($directory); 
        
        while ($contents = readdir($directoryHandle)) { 
            if($contents != '.' && $contents != '..') { 
                $path = $directory . "/" . $contents; 
                
                if(is_dir($path)) { 
                    deleteFolder($path); 
                } else { 
                    unlink($path); 
                } 
            } 
        } 
        
        closedir($directoryHandle); 

        if($empty == false) { 
            if(!rmdir($directory)) { 
                return false; 
            } 
        } 
        
        return true; 
    } 
} 