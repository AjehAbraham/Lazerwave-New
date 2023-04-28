<?php



if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

  header("Location: Warning.php");
  exit;

      header('HTTP/1.0 403 Forbiddden',TRUE,403);
      die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}


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


if(!empty($ipData)){
    
    //var_dump($ipData);

$flag_link =$ipData["country_flag"];


echo "<div class='flag-container'>

<img src='$flag_link'
>

</div>
";

//echo $flag_link;




}else{

//DO NOTHING//




}







?>


<style>
.flag-container{
border-radius: 50%;
width: 100px;
height: 100px;

border: 2px solid white;
margin-top: 14px;
margin-bottom: 14px;
margin-left: auto;
margin-right: auto;



}
.flag-container img{

border-radius: 50%;
width: 100px;
height: 100px;



}
</style>