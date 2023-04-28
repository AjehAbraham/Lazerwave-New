<?php

//require_once "sessionPage.php";


if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

  header("Location: Warning.php");
  exit;

      header('HTTP/1.0 403 Forbiddden',TRUE,403);
      die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}


require_once "db_connection.php";


$not_id= rand(342,2345). uniqid().rand(6262,9393);
$reciever_id =0;

$date =htmlspecialchars(date("Y/m/d H:i:s"));
$time = htmlspecialchars(date("H:i:s"));
$ip_addr = htmlspecialchars($_SERVER["REMOTE_ADDR"]);

$status="unseen";

/*
$amount = 0;

$Type= "Airtime";
$message ="Null";
$re_id = 0;*/



$add_not = "INSERT INTO  Notification (User_id,Amount,Message,Receiver_id,Notify_id,Type,Date,Time,Ip_addr,Status)

VALUES('$_SESSION[New_user]','$amount','$message','$reciever_id','$not_id','$Type','$date','$time','$ip_addr','$status')";

/*$mod ="ALTER Notification MODIFY Notify_id VARCHAR(255)";*/

if($conn -> query($add_not) == TRUE){

//DO NOTHING


}else{

echo $conn -> error;

}


?>