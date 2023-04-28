<?php
if(isset($_COOKIE["Ip_user_id"])){
    
    
    $user_id = $_COOKIE["Ip_user_id"];
    
    
}else{

if(isset($user)){

$user_id = $_SESSION["New_user"];


}else{

$user_id =uniqid(). rand();

}

//NOW SET COOKIE FOR THE USER ID//

$ip_user_id ="Ip_user_id";
$ip_value =$user_id;

setcookie($ip_user_id,$ip_value,time() + 86400);




}


//ADD IF THERES ACTIVE LOGIN SESSION OR NOT//

if(isset($user)){
    
    $active ="Active userid(".$user["id"].")";

}else{
    
    
    $active ="Not Active";
}



//CHECK IF SESSION HAS STARTED ELSE START SESSION AND STORE DETAILS
/*
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
*/
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

  header("Location: Warning.php");
  exit;

      header('HTTP/1.0 403 Forbiddden',TRUE,403);
      die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}

//CHECK THE REQUEST METHOD//




//DATAS TO INSERT FOR DAILY GET AND POST REQUEST TO KNOW THE NUMBERS OF DAILY VISITORS AND ALL THE PAGES THEY VISIT//
//echo $_SERVER["HTTP_USER_AGENT"];


//CHECK IF USER IS LOGIN OR MOT //
 
 //SET COOKIE DAILY USER SO THAT IT USER ID WILL HE UNIQUE THROUGHOUT THAT DAY SO YOU WILL KNOW ALL THE PAGE THAT PARTICULAR USER VISISTED IN A DAY //
/*
if(isset($_COOKIE["Ip_user_id"])){
    
    
    $user_id = $_COOKIE["Ip_user_id"];
    
    
}else{

if(isset($user)){

$user_id = $_SESSION["New_user"];


}else{

$user_id =uniqid(). rand();

}
//NOW SET COOKIE FOR THE USER ID//

$ip_user_id ="Ip_user_id";
$ip_value =$user_id;

setcookie($ip_user_id,$ip_value,time() + 86400);




}

/*
require_once __DIR__.("/db_connection.php");

$select ="ALTER TABLE Daily_visitors MODIFY COLUMN Zip_code TEXT";

if($conn -> query($select) == TRUE){

echo "ADDED";

}else{

echo "failed". $conn -> error;

}
*/

$ip_addr = htmlspecialchars($_SERVER["REMOTE_ADDR"]);
$date =htmlspecialchars(date("Y-m-d H:i:s"));

$time =htmlspecialchars(date("H:i:s"));

$file_name =$_SERVER["SCRIPT_NAME"];

$device_name =$_SERVER["HTTP_USER_AGENT"];












if($_SERVER["REQUEST_METHOD"] == "GET"){

$request ="GET";

require_once __DIR__.("/db_connection.php");



//NOW SEND REQUEST TO GEOLOCATION/IP ADDRESS API//


$apiKey="b969aee71e454a76bee15d80110dd10a";

$url =  "https://api.ipgeolocation.io/ipgeo?apiKey=".$apiKey."&ip=".$ip_addr;
        

$ch = curl_init($url); 
 
// Return response instead of outputting 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
 
// Execute API request 
$apiResponse = curl_exec($ch); 
 
// Close cURL resource 
curl_close($ch); 
 
// Retrieve IP data from API response 
$ipData = json_decode($apiResponse, true); 

//var_dump($ipData)


if(!empty($ipData)){




$country_name = $ipData['country_name']; 
    $region_code = $ipData['country_code2']; 
    
    $region_name = $ipData['continent_code']; 
    $city = $ipData['city']; 
    $zip_code = $ipData['zipcode']; 
    $latitude = $ipData['latitude']; 
    $longitude = $ipData['longitude']; 
    $time_zone = $ipData['time_zone']['current_time']." ". $ipData['time_zone']['name'];
    ;
$network =$ipData['organization'];

$network_details = $ipData['isp'];


//$allinfo =implode(" , ",$ipData);


//$allinfo =implode($ipData);
//var_dump($ipData);

$allinfo ="calling-code". $ipData["calling_code"] ." geoname ".$ipData["geoname_id"] ." languagues ".$ipData["languages"] ." countrytld". $ipData["country_tld"] ."  geoname_id".$ipData["geoname_id"]." country_tld".$ipData["country_tld"] ." country_flag ==".$ipData["country_flag"]. "ip address=".$_SERVER["REMOTE_ADDR"];



//NOW WE CAN INSERT ALL RECORD TO DATABASE//


$ip_details ="INSERT INTO Daily_visitors(User_id,Country,City,Date,Time,Request,User_Agent,File_name,Longitude,Latitude,Time_zone,Region_name,Zip_code,Network,Network_details,All_info,Active_session)

VALUES('$user_id','$country_name','$city','$date','$time','$request','$device_name','$file_name',' $longitude','$latitude','$time_zone','$region_name','$zip_code','$network','$network_details','$allinfo','$active')";

if($conn -> query($ip_details) == TRUE){
//NO MEED TO INFORM ISER//
//$message_status ="User infomation added succesfull";

//require_once __DIR__.("/success.php");


}else{

//NO NEED TO INFOM USER


//$message_status ="Failed to insert user information".$conn -> error;

//require_once __DIR__.("/Failed.php");





}




}else{



//GEOLOCATIJ FAILED//
//YOU CAN CREATE TABEL TO STORE INFO THAT PHP CAN HELP YOU GET




}
 






}else if($_SERVER["REQUEST_METHOD"] == "POST"){

$request ="POST";

//NOW SEND REQUEST TO GEOLOCATION/IP ADDRESS API//

// API end URL 



//NOW SEND REQUEST TO GEOLOCATION/IP ADDRESS API//


$apiKey="b969aee71e454a76bee15d80110dd10a";

$url =  "https://api.ipgeolocation.io/ipgeo?apiKey=".$apiKey."&ip=".$ip_addr;
        

$ch = curl_init($url); 
 
// Return response instead of outputting 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
 
// Execute API request 
$apiResponse = curl_exec($ch); 
 
// Close cURL resource 
curl_close($ch); 
 
// Retrieve IP data from API response 
$ipData = json_decode($apiResponse, true); 

//var_dump($ipData)


if(!empty($ipData)){




$country_name = $ipData['country_name']; 
    $region_code = $ipData['country_code2']; 
    
    $region_name = $ipData['continent_code']; 
    $city = $ipData['city']; 
    $zip_code = $ipData['zipcode']; 
    $latitude = $ipData['latitude']; 
    $longitude = $ipData['longitude']; 
    $time_zone = $ipData['time_zone']['current_time']." ". $ipData['time_zone']['name'];
    ;
$network =$ipData['organization'];

$network_details = $ipData['isp'];


$allinfo ="calling-code". $ipData["calling_code"] ." geoname ".$ipData["geoname_id"] ." languagues ".$ipData["languages"] ." countrytld". $ipData["country_tld"] ."  geoname_id".$ipData["geoname_id"]." country_tld".$ipData["country_tld"] ." country_flag ==".$ipData["country_flag"] ."ip address".$_SERVER["REMOTE_ADDR"];


//var_dump($ipData);


//NOW WE CAN INSERT ALL RECORD TO DATABASE//
require_once __DIR__.("/db_connection.php");


$ip_details ="INSERT INTO Daily_visitors(User_id,Country,City,Date,Time,Request,User_Agent,File_name,Longitude,Latitude,Time_zone,Region_name,Zip_code,Network,Network_details,All_info,Active_session)

VALUES('$user_id','$country_name','$city','$date','$time','$request','$device_name','$file_name',' $longitude','$latitude','$time_zone','$region_name','$zip_code','$network','$network_details','$allinfo','$active')";

if($conn -> query($ip_details) == TRUE){
//NO MEED TO INFORM ISER//
//$message_status ="User infomation added succesfull";

//require_once __DIR__.("/success.php");


}else{

//NO NEED TO INFOM USER


$message_status ="Failed to insert user information".$conn -> error;

require_once __DIR__.("/Failed.php");





}

    
    


}else{

//GEOLOCATION FAILED//
//YOU CAN CREATE TABEL TO STORE INFO THAT PHP CAN HELP YOU GET





}
 





}else{

//ERROR REUQEST TYPE//


$message_staus ="SERVER ERROR REUQEST TYPE";

require_once __DIR__.("/Failed.php");




}

?>