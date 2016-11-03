<?php

$host= "localhost";
$user= "absoluz2_glf_fed";
$password="astesalgerie268";
$database="absoluz2_appgolf_fe_dev";


// set up the curl resource

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://apilayer.net/api/live?access_key=f9bd94e7f1a726e8c5bac213daa4f502");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);

// execute the request

$output = curl_exec($ch);

$data = json_decode($output, true);



$res = $data['quotes'];

foreach($res as $x => $x_value) {
    $values[] = $x_value;
    //echo "<br>";
}


curl_close($ch);



  $db_conn = mysql_connect($host,$user,$password) or die(mysql_error());
  mysql_select_db($database, $db_conn) or die(mysql_error());

$sql = "SELECT new_rate FROM dip_exchangerate";
 
// echo $sql; exit;
 $result = mysql_query($sql) or die(mysql_error());

$result_list = array();
while($row = mysql_fetch_array($result)) {
   $result_list[] = $row;
}

foreach($result_list as $row) {

    $old_rate[] = array(
        'new_rate'  => $row['new_rate']
    );              
}

//print_r($old_rate); exit;
 
 //echo $old_rate[0][new_rate]; exit;
  
 for ($i=0; $i < 168; $i++) { 
 	$j = $i+1;
 	$eur_val = $values[$i]/$values[46];

 $sql_update = "UPDATE dip_exchangerate SET new_rate = " . $eur_val . " , old_rate = " . $old_rate[$i][new_rate] . " WHERE id = " . $j . "";

 //echo $sql_update; //exit;
  
 mysql_query($sql_update) or die(mysql_error());

 $eur_val = 0;


 } 

 
 
	
 

       