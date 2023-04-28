<?php

session_start();

session_regenerate_id();

?>
<!DOCTYPE html>
<html lang="eng_US">
  <head>
    <link rel="stylesheet" href="">
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width,initial-scale=1.0">
          <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
         
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.debug.js"></script>
<link rel="preconnect" href="https://fonts.googleapis.com"> 
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
<link href="https://fonts.googleapis.com/css2?family=Encode+Sans:wght@300&family=Island+Moments&family=Oswald:wght@200&family=PT+Serif:wght@700&family=Roboto+Mono:wght@100&display=swap" rel="stylesheet">


<script src="https://kit.fontawesome.com/958aace4f6.js" crossorigin="anonymous"></script>
<title>Status</title>
      </head>
      <body>


      <script>

     
        function Open_account_limit_pop_up(){


          document.querySelector(".account-limit-overlay-container").style.display ="block";


          
        }



        function Close_account_limit_pop_up(){


document.querySelector(".account-limit-overlay-container").style.display="none";


          
        }

        </script>






<p onclick="Open_account_limit_pop_up()">open limit</p>


      <div class="account-limit-overlay-container">

      <div class="account-limit-container">
<p onclick="Close_account_limit_pop_up()"><i class='fa fa-close'></i></p>

      <h1>Account limit </h1>
      
      </div>
      </div>
      </div>

<?php
require_once "db_connection.php";


/*
$mod = "ALTER TABLE Payment_link_table ADD  Time TIME ";
*/
/*
$hash = uniqid().rand(72636,83737).uniqid(). rand(62626,93736);


$id =2;
$mod = "UPDATE Credit_card SET Hash_key ='$hash' WHERE id='$id'";


if($conn -> query($mod) == TRUE){
    
    echo "success";
    
    
}else{
    
    $conn-> error;
}
*/

/*
$create = "CREATE TABLE Credit_card_history (

id INT(128) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
User_id INT(20),
Card_no INT(15),
Hash_link VARCHAR(255),
Ip_country TEXT,
Status TEXT,
Date TIMESTAMP,
Time TIME,
Ip_addr VARCHAR(40)
    
    )
    
    ";

if($conn -> query($create) == TRUE){
    
    echo "Table created";
    
    
}else{
    
    
    echo "Failed  ".$conn -> error;
}*/

/*
$modi ="ALTER TABLE Confirm_payment_link MODIFY Card_no VARCHAR(16)";

if($conn -> query($modi) == TRUE){
    
    echo "Table created";
    
}else{
    echo "Failed".$conn -> error;
    
    
}*/

/*

print_r(session_id());



/*

$filepath="images/Bolt.jpeg";


if(file_exists($filepath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filepath));
            flush(); // Flush system output buffer
          readfile($filepath);
            die();
        } else {
            http_response_code(404);
	        die();
        }






/*"/db_connection.php");


  $create ="CREATE TABLE Referal_record(id INT(123) UNSIGNED AUTO_INCREMENT PRIMARY KEY,User_id INT(20),Referal_code VARCHAR(30),Referred INT(15),Date TIMESTAMP,Time TIME,Ip_addr VARCHAR(30) )";
   
   
   if($conn -> query($create) == TRUE){
   
   echo "Table created";
   
   
   
   }else{
   
   echo "failed" ." ". $conn -> error;
   
   
   }



/*

require_once __DIR__.("/db_connection.php");

$ch ="ALTER TABLE Daily_visitors ADD COLUMN Active_session TEXT";

if ($conn -> query($ch) == TRUE){
    
    
    echo "Table altered";
}else{
    
    echo $conn-> error;
}

/*
      
//NOW SEND REQUEST TO GEOLOCATION/IP ADDRESS API//

$ip_addr =$_SERVER["REMOTE_ADDR"];

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

//var_dump($ipData);




echo "<p>Details</p>";

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





echo $ipData['country_name'];

*/

?>

<style>

  .account-limit-overlay-container{
position: fixed;
background-color: rgba(0,0,0,0.4);
left: 0;
right: 0;
top: 0;
bottom: 0;
z-index: 2;
overflow: scroll;
display: none;
  }
.account-limit-container{
background-color: white;
padding: 10px 10px;
margin-top: 10%;
margin-left: auto;
margin-right: auto;
width: 85%;
text-align: center;
margin-bottom: 10%;
}
.account-limit-container p{

  font-size: 23px;
}
.account-limit-container h1{
  color: rgb(0,0,180);
}
.Kyc1-container{
  padding: 12px 12px;
  background-color: mediumseagreen;
  border-radius: 2rem;
  color: white;
}

.Kyc2-container{
  padding: 12px 12px;
  background-color: mediumseagreen;
  border-radius: 2rem;
  color: white;
}

.Kyc3-container{
  padding: 12px 12px;
  background-color: mediumseagreen;
  border-radius: 2rem;
  color: white;
  margin-bottom: 10%;
}
i{
  cursor: pointer;
}
  </style>x

  

<label class="switch">
  <input type="checkbox">
  <span class="slider"></span>
</label>


<style>
.switch{
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;

}

.siwtch input{
  opacity: 0;
  width: 0;
  height: 0;
}
.slider{
  position: absolute;
  cursor: pointer;
  top: 0;
  right: 0;
  bottom:0;
background-color: #ccc;
-webkit-transition: .4s;
transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider{
  background-color:  #2196F3;
}
input:focus + .slider{

  box-shadow: 0 0 1px #2196F3;

}

input:checked + .slider:before{
  -webkit-transform: translateX(25px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

.slider.round{
  border-radius: 34px;
}

.slider.round:before{
  border-radius: 50%;
}

  </style>


