<?php


if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

  header("Location: Warning.php");
  exit;

      header('HTTP/1.0 403 Forbiddden',TRUE,403);
      die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}


//CHECK REQUEST TO SEE IF THE REQUEST HAS BEEN ACCEPTED OR NOT IUST INCASE OF NETWORK ISSUES//


$dulictate ="SELECT * FROM Accept_request WHERE User_id ='$_SESSION[New_user]' AND Notify_id ='$notify'";


$dupli = $conn -> query($dulictate);

if ($dupli -> num_rows > 0){


$dup_result = $dupli -> fetch_assoc();


if ($dup_result["Notify_id"] == $notify){

$message_status ="Error,request has already been accepted.";

require_once __DIR__.("/Failed.php")
;
die();

}


}

?>