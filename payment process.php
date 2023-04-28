<?php

session_start();

if(!isset($_SESSION["New_user"])){
    
    session_regenerate_id();
    
}

require_once "Daily visitors.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

  header("Location: Warning.php");
  exit;

      header('HTTP/1.0 403 Forbiddden',TRUE,403);
      die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}




if($_SERVER["REQUEST_METHOD"] == "POST"){


$card_no = $exp=$cvv=$pin="";



$card_no =(int) filter_var($_POST["card_no"],FILTER_VALIDATE_INT);


if(empty($card_no)){

$message_status ="Please enter card Number";

require_once "Failed.php";
die();




}else if(strlen($card_no) < 15){


$message_status ="Card number too short";

require_once "Failed.php";
die();


if(strlen($card_no) >=16){

$message_status ="Card number too long";

require_once "Failed.php";

die();



}






}else{


$card_no = htmlspecialchars($card_no);




}


$exp =(int) filter_var($_POST["Exp"],FILTER_VALIDATE_INT);


if(empty($exp)){

$message_status ="Please enter card Expiry date";

require_once "Failed.php";
die();




}else if(strlen($exp) < 4){


$message_status ="Invalid Expiry Year";

require_once "Failed.php";
die();


//CHECK IF DATE IS LESS THAN CURRENT DATE//

$less = date("Y");

if($less < $exp){


$message_status ="Date cannot be less than ".$less;

require_once "Failed.php";
die();


}




}else{


$exp = htmlspecialchars($exp);




}


$cvv =(int) filter_var($_POST["cvv"],FILTER_VALIDATE_INT);


if(empty($cvv)){

$message_status ="Please enter card  CVV";

require_once "Failed.php";
die();




}else if(strlen($cvv) < 3){


$message_status ="Card CVV too short";

require_once "Failed.php";
die();



if(strlen($cvv) >=4){


$message_status ="CVV too long";

require_once "Failed.php";

die();



}


}else{


$cvv = htmlspecialchars($cvv);




}


$pin =(int) filter_var($_POST["pin"],FILTER_VALIDATE_INT);


if(empty($pin)){

$message_status ="Please enter card  Pin";

require_once "Failed.php";
die();




}else if(strlen($pin) < 4){


$message_status ="Pin must be at least 4 digit";

require_once "Failed.php";
die();


}else{


$pin = htmlspecialchars($pin);




}

//AFTER VALIDATIONS NOW CHECK IF CARD DETAILS ARE CORRECT AND VALID//



require_once "db_connection.php";


//CHECK CARDS//

$card_details = "SELECT * FROM Credit_card WHERE Credit_card_no='$card_no'";

$card_result = $conn -> query($card_details);


if($card_result -> num_rows > 0){

//A MATCH FOR THIS CARD HAS BEEN FOUND AND WE NEED TO VALIDATE IT AND MAKE SURE EVERY DETAILS IS CORRECT//

$card_results = $card_result -> fetch_assoc();


if($card_results["Exp_date"] == $exp){

//CARD EXPIRY DATE IS VALID//



}else{

$message_status ="Invalid expiry date";

require_once "Failed.php";





}


//NO CHECK IF CVV MATCH//


if($card_results["Ccv"] == $cvv){


//CARD CVV MATCH AND IS VALID



}else{


//INVALID CCV/


$message_status ="Invalid card CCV";

require_once "Failed.php";

die();




}

//CHECK IF CARD IT BLOCK OF NOT//


if($card_results["Status_r"] =="Block"){

$message_status ="Card holder account has been deactivated,please contact your bank to resolve issues ";

require_once "Failed.php";

die();




}




//NOW CHECK CARD PIN //



if(password_verify($pin,$card_results["Pin"]) == "password_hash"){


//CARD PIN MATCH//

//NOW FETCH CARD HOLDER NAMES AND CHECK IF THEIR ACCOUNT BALANCE IS UP TO THE LINK AMOUNT//

$card_holder = "SELECT * FROM Register_db WHERE id='$card_results[User_id]'";

$card_user = $conn -> query($card_holder) -> fetch_assoc();



//NOW CHECK CHECK LINK HASH AND FIND A MATCH//



$hash_link ="SELECT * FROM Payment_link_table WHERE Hash_link='$_SESSION[Link_details]'";

$link_result = $conn -> query($hash_link) -> fetch_assoc();


//NOW FETCH RECEIVER/OWNER OF LINK DETAILS TO CREDIT THEM//



$link_owner = "SELECT * FROM Register_db WHERE id='$link_result[User_id]'";


$link_owner_details = $conn -> query($link_owner) -> fetch_assoc();

//CHECK IF CARD ONWER AND LINK OWNER IS THE SAME (STOP THE SCRIPT IF TRUE)



if($card_user["id"] == $link_owner_details["id"]){
    
    $message_status="Error,the link belongs to the card owner please use a diffrent card or payment method";
    
    
}else{
    
    //DO NOTNING
    
    
    
}



//NOW ALL THE DETAILS ARE PRESENT//


//NOW CHECK CARD HOLDER DAILY LIMIT//


//NOW CHECK IF CARD HOLDER ACCOUNT IS BLOCK OR NOT//


$block_status = "SELECT * FROM Block_account WHERE User_id='$card_user[id]'";

$block_result = $conn -> query($block_status);


if($block_result -> num_rows > 0){


$block_results = $block_result -> fetch_assoc();


if($block_results["Account_status"] =="Block"){

$message_status ="Your account is temporary Unavailable,please contact your bank";

require_once "Failed.php";

$message = $card_user["Surname"]." "
.$card_user["First_name"] ." ".$card_user["Last_name"];

$status ="Failed";
$ip_country ="";
$amount = $link_result["Amount"];
$hash = $_SESSION["Link_details"];
$id= $link_owner_details["id"];
$country =$card_user["Country"];



$insert_to_link_table= "INSERT INTO Confirm_payment_link(User_id,Hash_link,Amount,Country,Ip_country,Status,Date,Time,Ip_addr,Message,Card_no)

VALUES('$id','$hash','$amount','$country','$ip_country','$status','$date','$time','$ip_addr','$message','$card_no')

";

if($conn -> query($insert_to_link_table) == TRUE){


//DO NOTHING/:




}else{


echo $conn -> error;


}






//require_once "Failed.php";
die();


}



}else{

//USER HAS NEVER EVER BLOCK THEIR ACCOUNT//




}



//NOW WE CAN UPDATE USER ACCOUNT BALANCE//


//FIRST CHECK SENDER ACCOUNT BALANCE//


$transaction_id = rand(6363,94834). uniqid(). rand(736,8474);

$typee="Transfer";

$bank ="Lazerwave";

$type= $link_result["Title"]. " To ".$link_owner_details["Surname"]. " "
.$link_owner_details["Last_name"]." 
".$link_owner_details["First_name"];

$from =$card_user["Account_no"];

$to = $link_owner_details["Account_no"];

$date =htmlspecialchars(date("Y/m/d H:i:s"));

$time = htmlspecialchars(date("H:i:s"));

$ip_addr = htmlspecialchars($_SERVER["REMOTE_ADDR"]);


$new_balance = $card_user["Account_balance"] - $link_result["Amount"];





if($card_user["Account_balance"] < $_SESSION["Amount"]){

$remark = "Pending";
$status ="Failed";

//INSUFFICIENT FUNDS//

require_once "db_connection.php";


//INSERT INTO ACCOUNT HISTORY TO INFORM USER

$insert=

"INSERT INTO Transaction_history(User_id,Transaction_id,Amount,Type_name,Remark,Status_remark,Sender_account_no,Receiver_account_no,Date_id,Time_id
,Ip_addr,Type,Bank

)
VALUES('$card_user[id]','$transaction_id','$link_result[Amount]','$type','$remark','$status','$from','$to','$date','$time','$ip_addr','$typee','$bank')";



if($conn -> query($insert) == TRUE){

//DO NOTHING//

$message = $card_user["Surname"]." "
.$card_user["First_name"] ." ".$card_user["Last_name"];

$status ="Failed";
$ip_country ="";
$amount = $link_result["Amount"];
$hash = $_SESSION["Link_details"];
$id= $link_owner_details["id"];
$country =$card_user["Country"];

$insert_to_link_table= "INSERT INTO Confirm_payment_link(User_id,Hash_link,Amount,Country,Ip_country,Status,Date,Time,Ip_addr,Message,Card_no)

VALUES('$id','$hash','$amount','$country','$ip_country','$status','$date','$time','$ip_addr','$message','$card_no')

";


if($conn -> query($insert_to_link_table) == TRUE){


//DO NOTHING/:




}else{


echo $conn -> error;





}




$message_status="Insufficient funds";

require_once "Failed.php";

die();


}else{


echo $conn -> error;





}





}else{

//ACCOUNT BALANCE IS VALID AND GOOD TO GO//

require_once "db_connection.php";



$update_sender = "UPDATE Register_db SET Account_balance ='$new_balance' WHERE id='$card_user[id]'";



if($conn -> query($update_sender)== TRUE){
$remark = "- Debit";
$status ="Successful";




//INSERT INTO SENDER TRANSACTION HISTORY//

$insert=
"INSERT INTO Transaction_history(User_id,Transaction_id,Amount,Type_name,Remark,Status_remark,Sender_account_no,Receiver_account_no,Date_id,Time_id
,Ip_addr,Type,Bank

)
VALUES('$card_user[id]','$transaction_id','$link_result[Amount]','$type','$remark','$status','$from','$to','$date','$time','$ip_addr','$typee','$bank')";



if($conn -> query($insert) == TRUE){

//NOW UPDATE RECEIEVER ACCOUNT BALANCE//

$new_bal = $link_result["Amount"] + $link_owner_details["Account_balance"];

$update_r = "UPDATE Register_db SET Account_balance='$new_bal' WHERE id='$link_owner_details[id]'";



if($conn -> query($update_r) == TRUE){

$remark = "+ Credit";
$status ="Successful";

$type= $link_result["Title"]. " From ".$card_user["Surname"]. " "
.$card_user["Last_name"]." 
".$card_user["First_name"];

$insert_r=
"INSERT INTO Transaction_history(User_id,Transaction_id,Amount,Type_name,Remark,Status_remark,Sender_account_no,Receiver_account_no,Date_id,Time_id
,Ip_addr,Type,Bank

)
VALUES('$link_owner_details[id]','$transaction_id','$link_result[Amount]','$type','$remark','$status','$from','$to','$date','$time','$ip_addr','$typee','$bank')";



if($conn -> query($insert_r) == TRUE){


//INSERT INTO CONFIRM PAYMENT LINK TABLE//


$message = $card_user["Surname"]." "
.$card_user["First_name"] ." ".$card_user["Last_name"];

$status ="Successful";
$ip_country ="";
$amount = $link_result["Amount"];
$hash = $_SESSION["Link_details"];
$id= $link_owner_details["id"];
$country =$card_user["Country"];

$insert_to_link_table= "INSERT INTO Confirm_payment_link(User_id,Hash_link,Amount,Country,Ip_country,Status,Date,Time,Ip_addr,Message,Card_no)

VALUES('$id','$hash','$amount','$country','$ip_country','$status','$date','$time','$ip_addr','$message','$card_no')

";


if($conn -> query($insert_to_link_table) == TRUE){


//DO NOTHING/:




}else{


echo $conn -> error;





}


$message_status ="Payment successful,you will receieve email of your transaction shortly.";

require_once "success.php";

echo "<script>
document.querySelector('#formId').reset();
</script>

";


die();



//echo "300";

//NOW YOU CAN UPDATE RECEIEVR PAYMENT LINK HISTORY//YOU CAN ALSO SEND USER DEBIT ALERT/CREDIT ALERT AND ALSO UPDATE SENDER ACCOUNT LIMIT/DAILY LIMIT//




}else{


echo $conn -> error;




}






}else{


echo $conn -> error;



}






}else{

echo $conn-> error;



}









}else{


echo $conn -> error;




}








}



}else{



//INVALID CARD PIN//


$message_status="Invalid card pin";

require_once "Failed.php";

die();








}








}else{

//NO MATCH FOR CREDIT CARD FOUND//


$message_status ="Invalid card,only Lazerwave card are supported";


require_once "Failed.php";

die();




}












}