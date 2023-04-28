<?php


if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

  header("Location: Warning.php");
  exit;

      header('HTTP/1.0 403 Forbiddden',TRUE,403);
      die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}

require_once "sessionPage.php";



if($_SERVER["REQUEST_METHOD"] == "POST"){


$pin=$reason="";




$pin = (int) filter_var($_POST["pin"],FILTER_SANITIZE_NUMBER_INT);


if(empty($pin)){



$message_status ="Please enter pin";

require_once "Failed.php";

die();




}else if (strlen($pin) < 4 or strlen($pin) >=5){



$message_status = "Pin nust be at least 4 digit";

require_once "Failed.php";

die();



}else{


$pin = htmlspecialchars($pin);



}


if(isset($_POST["status"])){

if(htmlspecialchars($_POST["status"]) == "Block"){

$reason = filter_var($_POST["reason"],FILTER_SANITIZE_STRING);


if(empty($reason)){

$message_status = "Invalid request parameter";

require_once "Failed.php";

die();




}else if($reason == "Disabled"){

$message_status = "Reason must be either Stolen or Lost.Reason ".$reason ." is no longer supported";

require_once "Failed.php";

die();





}else{



$reason = htmlspecialchars($reason);




}
}

}


//echo "300";




require_once "db_connection.php";



$user_pin ="SELECT * FROM User_pin WHERE User_id='$_SESSION[New_user]'
";

$results=$conn -> query($user_pin);


if($results -> num_rows > 0){


//CHECK IF PIN MATCH//

$pin_result = $results -> fetch_assoc();



if(password_verify($pin,$pin_result["Pin"]) == "password_hash"){


//PIN IS VALID//


//NOW CHECK USER CARD DETAILS AND EDIT IT//

$Card = "SELECT * FROM Credit_card WHERE User_id='$_SESSION[New_user]' AND Hash_key ='$_SESSION[Card_hash_key]'";

$card_result = $conn -> query($Card);

if($card_result -> num_rows > 0){

$card_results = $card_result -> fetch_assoc();

if($card_results["Status_r"] == "Block"){


$status ="UnBlock";



//UPDATE CARD DETAILS//


$update ="UPDATE Credit_card SET Status_r ='$status' WHERE User_id='$_SESSION[New_user]' AND Hash_key='$_SESSION[Card_hash_key]'";


if($conn -> query($update) == TRUE){


//echo "300";


//echo $card_results["Credit_card_no"];

$ip_country ="";

$insert ="INSERT INTO Credit_card_history(
User_id,Card_no,Hash_link,Ip_country,Status,Date,Time,Ip_addr)
VALUES('$_SESSION[New_user]','$card_results[Credit_card_no]','$card_results[Hash_key]','$ip_country','$status','$date','$time','$ip_addr')


";

if($conn -> query($insert) == TRUE){
    
    //DO NOTHING
    
    
    
$message_status ="Virtual card has been unblock successfully";
require_once "success.php";


    
    
}else{
    
    echo $conn -> error;
    
    
    
}





}else{

echo $conn -> error;




}




}else{


$status ="Block";

$update ="UPDATE Credit_card SET Status_r ='$status' WHERE User_id='$_SESSION[New_user]' AND Hash_key='$_SESSION[Card_hash_key]'";


if($conn -> query($update) == TRUE){


//echo "300";

//echo $card_results["Credit_card_no"];

$ip_addr = htmlspecialchars($_SERVER["REMOTE_ADDR"]);

$date = htmlspecialchars(date("Y/m/d H:i:s"));

$time = htmlspecialchars(date("H:i:s"));

$ip_country ="";


///INSERT INTO CREDIT CARD HISTORY//

$insert ="INSERT INTO Credit_card_history(
User_id,Card_no,Hash_link,Ip_country,Status,Date,Time,Ip_addr)
VALUES('$_SESSION[New_user]','$card_results[Credit_card_no]','$card_results[Hash_key]','$ip_country','$status','$date','$time','$ip_addr')


";

if($conn -> query($insert) == TRUE){
    
    
    //DO MOTJING//
    
    
$message_status ="Virtual card has been block successfully";
require_once "success.php";


    
    
    
}else{
    
    echo $conn -> error;
    
    
    
}





}else{

echo $conn -> error;




}




}




}else{

//MO RESULT FOR CARD FOUND//


$message_status = "Invalid card";;

require_once "Failed.php";

die();




}








}else{


//INVALID TRANSACTION PIN//

$message_status = "Invalid transaction pin";

require_once "Failed.php";

die();





}








}else{


$message_status = "Please create Transaction pin";

require_once "Failed.php";

die();






}














}