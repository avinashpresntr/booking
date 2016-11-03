<?php

$host= "localhost";
$user= "absoluz2_glf_fed";
$password="astesalgerie268";
$database="absoluz2_appgolf_fe_dev";


// set up the curl resource

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://download.finance.yahoo.com/d/quotes.csv?e=.csv&f=c4l1&s=INREUR=X,USDEUR=X");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);

// execute the request

$output = curl_exec($ch);
echo $output;

curl_close($ch);

$rates = explode(",",$output);

//print_r($rates[1]);

//$arr = array();

for ($i=1; $i < 3; $i++) { 
	$arr[$i] = substr($rates[$i],0,7);
}

	
	


//print_r($arr);



  $db_conn = mysql_connect($host,$user,$password) or die(mysql_error());
  mysql_select_db($database, $db_conn) or die(mysql_error());

$sql = "SELECT new_rate FROM dip_exchangerate";
 
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

//print_r($old_rate);
 
 //echo $old_rate[1][new_rate]; //exit;
  
 for ($i=1; $i < 3; $i++) { 

 $sql_update = "UPDATE dip_exchangerate SET new_rate = " . $arr[$i] . " , old_rate = " . $old_rate[$i-1][new_rate] . " WHERE id = " . $i . "";
  
 mysql_query($sql_update) or die(mysql_error());


 } 
 
	
 

       