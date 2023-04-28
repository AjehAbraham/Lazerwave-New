<?php

require_once __DIR__.("/sessionPage.php");


if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

  header("Location: Warning.php");
  exit;

      header('HTTP/1.0 403 Forbiddden',TRUE,403);
      die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}

/*
require_once __DIR__.("/db_connection.php");


$Create ="CREATE TABLE Refer_and_Earn(id INT(123) UNSIGNED AUTO_INCREMENT  PRIMARY KEY,User_id INT(20) ,Referal_code VARCHAR(255), Amount INT(10), Date TIMESTAMP ,Time TIME, Ip_addr VARCHAR(30) )";


if($conn -> query($Create) == TRUE){

echo "Table created";


}else{


echo "Failed to create table".$conn -> error;


}

*/




if($_SERVER["REQUEST_METHOD"] == "POST"){


require_once __DIR__.("/db_connection.php");




if(isset($_POST["refer"])){


$refer =htmlspecialchars($_POST["refer"]);


$refer= filter_var($refer,FILTER_SANITIZE_STRING);


if (empty($refer)){


$message_status ="Invalid request,please try again.";

require_once __DIR__.("/Failed.php");

die();

}else if($refer == "refer"){


//IS A VALID REUQEST//


$date =htmlspecialchars(date("Y-m-d H:i:s"));

$time =htmlspecialchars(date("H:i:s"));

$refer_code =rand(765,9846).uniqid() . rand(12,76);

$ip_addr =htmlspecialchars($_SERVER["REMOTE_ADDR"]);

$amount = 1000;

$insert ="INSERT INTO Refer_and_Earn(User_id,Referal_code,Amount,Date,Time,Ip_addr)

VALUES('$_SESSION[New_user]','$refer_code','$amount','$date','$time','$ip_addr')";

if($conn -> query($insert) == TRUE){
$message_status ="Link created,please refer page to view link.";

require_once __DIR__.("/success.php");


}else{

$message_status ="Error creating link,please try again.";

require_once __DIR__.("/Failed.php");
die();



}





}else{


$message_status ="Error reuqest,please try again.";

require_once __DIR__.("/Failed.php");



}





}else{


$message_status ="Server error,please try again.";

require_once __DIR__.("/Failed.php");







}




}

$conn -> close();

?>