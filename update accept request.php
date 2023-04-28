<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

  header("Location: Warning.php");
  exit;

      header('HTTP/1.0 403 Forbiddden',TRUE,403);
      die("<h3> 403 Access denied!The file you request for does not exist.</h3>");

}

/*
require_once __DIR__.("/db_connection.php");


$create = "CREATE TABLE Accept_request(id INT(123) UNSIGNED AUTO_INCREMENT PRIMARY KEY,User_id INT(20),Notfiy_id VARCHAR(30),Type TEXT,Date TIMESTAMP,Time TIME,Ip_addr VARCHAR(30) )";


if($conn -> query($create) == TRUE){
echo "Table created";

}else{
echo "failed".$conn -> error;

}


*/



//UPDATE ACCEPT REQUEST//


$date =htmlspecialchars(date("Y-m-d H:i:s"));

$time =htmlspecialchars(date("H:i:s"));

$type= "Money Request";


$ip_addr =htmlspecialchars($_SERVER["REMOTE_ADDR"]);



$accept_request ="INSERT INTO Accept_request(User_id,Notify_id,Type,Date,Time,Ip_addr)

VALUES('$_SESSION[New_user]','$notify','$type','$date','$time','$ip_addr')";


if($conn -> query($accept_request) == TRUE){


//DO NOTHING 
}else{

//DO NOTHING OR MAYBE INFOM ADMIN THROUGH ///

}





?>