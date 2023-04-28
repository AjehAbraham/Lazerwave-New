<?php


if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

  header("Location: Warning.php");
  exit;

      header('HTTP/1.0 403 Forbiddden',TRUE,403);
      die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}

//CHECK BLOCK HISTORY TO STOP USER FROM CARRYING OUT TRANSFER WHEN THEIR ACCOUNT IS BLOCK//
 require_once __DIR__.("/db_connection.php");

$prevent_user ="SELECT * FROM Block_account WHERE User_id='$_SESSION[New_user]'";

$prevent = $conn -> query($prevent_user);


if ($prevent -> num_rows > 0){

$prevent_result = $prevent -> fetch_assoc();

//NOW CHECK IF THE STATUS IS BLOCK OR NOT //
 if($prevent_result["Account_status"] == "Block"){
 
$message_status ="Your account has been deactivated,please contact customer care to help fix your account";


require_once __DIR__.("/Failed.php");
die();
 
 }

}else{

//DO NOTHING 



}
?>