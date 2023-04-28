<?php
session_start();

session_regenerate_id();


require_once __DIR__.("/Loader.php");



//session_destroy();
?>


<!DOCTYPE html>
<html lang="eng_US">
  <head>
    <link rel="stylesheet" href="Payment link.css">
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
<title>Payment</title>

<!-- ajax and jquery link -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<script src= "https://code.jquery.com/jquery-3.5.0.js"></script>

<!-- end of ajax link -->

      </head>
      <body>

      <?php 
 

 if($_SERVER["REQUEST_METHOD"] =="GET"){

if(!isset($_GET["id"])){


  $message_status = "Error processing link,link appear to be broken";


  require_once __DIR__.("/Failed.php");

die();


}


  

if(isset($_GET["name"]) || $_GET["id"]){

$name = htmlspecialchars($_GET["name"]);

$user_id = (int) filter_var($_GET["id"],FILTER_SANITIZE_STRING);

//CHECK IF USER ID AND NAME IS EMPTY TO AVOID THROWING ERROR


if(empty($name)){

  if (empty($user_id)){


    $message_status = "Error processing link";


    require_once __DIR__.("/Failed.php");

die();

  }



}

//END OF CHECKING IF THY ARE EMPTY


//NOW CHECK IF THE HASH LINK MATCH AND LINK IN DTATBASE//



require_once __DIR__.("/db_connection.php");

$verfiy_link = "SELECT * FROM Payment_link_table WHERE User_id ='$user_id' AND Hash_link = '$name'";

$link_result = $conn -> query($verfiy_link);




if (/*$link_result !== false &&*/ $link_result -> num_rows > 0){
//LIMK MATCH ONE IN DATABASE

$result = $link_result -> fetch_assoc();

//var_dump($result);

$check_link = "SELECT * FROM Register_db WHERE id ='$user_id'";


$user_details = $conn -> query($check_link);


if ($user_details -> num_rows > 0){

//FETCH USER DETAILS// 

$user_result = $user_details -> fetch_assoc();




}

$_SESSION["Surname"]  = $user_result["Surname"];


$_SESSION["Last_name"]  = $user_result["Last_name"];

$_SESSION["First_name"]  = $user_result["First_name"];

//THIS ID BELOW WILL BE USER LATER TO FETCH RECORD//
$_SESSION["payment_id"] = $user_result["id"];

$_SESSION["Account_no"] = $user_result["Account_no"];

//$account_no = $_SESSION["Account_no"];

$_SESSION["Account_balance"] = $user_result["Account_balance"];


//END OF ID//

$_SESSION["Full_name"] =  $_SESSION["Surname"] ." ". $_SESSION["Last_name"]." ". $_SESSION["First_name"];

$_SESSION["Amount"] = $result["Amount"];

$amount = $_SESSION["Amount"];






}else{

//HASH LINK DOES NOT MATCH ANYONE IN DTATBASE//

//JUST FETCH USER DETAILS AND STORE SO THAT YOU CAAN CREDIT THEM//

$check_link = "SELECT * FROM Register_db WHERE id ='$user_id'";


$user_details = $conn -> query($check_link);


if ($user_details -> num_rows > 0){

//FETCH USER DETAILS// 

$user_result = $user_details -> fetch_assoc();




}else{

  //LINK IS INVALID AND MUST HAVE BEEN BROKEN//
    $message_status = "Error processing link,link appear to be broken";
  
  
    require_once __DIR__.("/Failed.php");
  
  die();
  
  
  
  
  
  
  }


$_SESSION["Surname"]  = $user_result["Surname"];


$_SESSION["Last_name"]  = $user_result["Last_name"];

$_SESSION["First_name"]  = $user_result["First_name"];

//THIS ID BELOW WILL BE USER LATER TO FETCH RECORD//
$_SESSION["payment_id"] = $user_result["id"];

//END OF ID//



$_SESSION["Full_name"] =  $_SESSION["Surname"] ." ". $_SESSION["Last_name"]." ". $_SESSION["First_name"];

$_SESSION["Amount"] = 1000;

//$amount = $_SESSION["Amount"];


$_SESSION["Account_balance"] = $user_result["Account_balance"];



$_SESSION["Account_no"] = $user_result["Account_no"];


}




}else{

$message_status = "Invalid link or link has been broken";

require_once __DIR__.("/Failed.php");




}



  
 }


?>




<?php require_once __DIR__.("/logo.php"); ?>

<div class="payment-link-container">

  <i class="fa fa-user"></i>

  <form method="post"  onsubmit="openConfirm(event)">

    <h1><?php echo $_SESSION["Full_name"]; ?></h1>

    <p style="color:#222;font-size:25px;"><?php echo "₦" .number_format($_SESSION["Amount"]) .".00"; ?>  </p>


    <label for="Account-number"><b>Amount:</b></label>
    <br>
    <input type="text" value="<?php echo number_format ($_SESSION["Amount"]);?>"  name="amount"readonly>

    <br>


    <label for="full-name"><b>Name on card:</b></label>
    <br>

    <input type="text" name="Full-name" value="<?php echo isset($_POST['Full-name']) ? $_POST['Full-name'] : ''?>" autocomplete="off" >
    <br>

    <label for="card-number"><b>Card no:</b></label>
    <br>
    <input type="number"name="Card_no" value="<?php echo isset($_POST['Card_no']) ? $_POST['Card_no'] : ''?>" autocomplete="off">
    <br>

    <label for="ccvr"><b>Ccv:</b></label>
    <br>
    <input type="number" name="Ccv" value="<?php echo isset($_POST['Ccv']) ? $_POST['Ccv'] : ''?>" autocomplete="off"  >
    <br>

    <label for="expire-date"><b>Exp date:</b></label>
    <br>
    <input type="number" name="expire" value="<?php echo isset($_POST['expire']) ? $_POST['expire'] : ''?>" autocomplete="off">
    <br>


    <label for="Pin"><b>Pin:</b></label>
    <br>
    <input type="text"  name="Pin">
    <br>

    <input type="submit" value="Pay">
    <p>Click <a href="index.php" target="blank">here</a> to go back to home.</p>



    









<?php

  if($_SERVER["REQUEST_METHOD"] == "POST"){


$card_full_name = filter_var($_POST["Full-name"],FILTER_SANITIZE_STRING);

//echo $card_full_name;

if (empty($card_full_name)){


  $message_status = "Enter card full name";

  require_once __DIR__.("/Failed.php");

die();

}else{




  htmlspecialchars($card_full_name);

}


$card_no = (int) filter_var($_POST["Card_no"],FILTER_SANITIZE_NUMBER_INT);


$str = 14;

if (empty($card_no)){

  $message_status = "please provide  credit/virtual card no";

  require_once __DIR__.("/Failed.php");

die();



} else if (strlen($card_no) < $str){

  $message_status = "Card number too short";

  require_once __DIR__.("/Failed.php");

die();





}else{



  htmlspecialchars($card_no);

}


$ccv = (int) filter_var($_POST["Ccv"],FILTER_SANITIZE_NUMBER_INT);

$str_2 = 3;

if(empty($ccv)){

  $message_status = "please card ccv";

  require_once __DIR__.("/Failed.php");

die();

}else if(strlen($ccv) < $str_2){

  $message_status = "ccv too short must be at least 3 digit";

  require_once __DIR__.("/Failed.php");

die();





}else{




  htmlspecialchars($ccv);
}


$expire_date = (int) filter_var($_POST["expire"],FILTER_SANITIZE_NUMBER_INT);


if(empty($expire_date)){

  $message_status = "Enter expiry date on card";

  require_once __DIR__.("/Failed.php");

die();





}/*else if($expire < 2022){


  $message_status = "Enter expiry date cannot be in the past";

  require_once __DIR__.("/Failed.php");

die();





}*/else{


  htmlspecialchars($expire_date);
}



$pin = (int) filter_var($_POST["Pin"],FILTER_SANITIZE_NUMBER_INT);

if(empty($pin)){


  
  $message_status = "Enter card pin";

  require_once __DIR__.("/Failed.php");

die();


}

//NOW CHECK DTATBASE FOR CREDIT CARD RECORD//

require_once __DIR__.("/db_connection.php");

$credit_card ="SELECT * FROM Credit_card WHERE Credit_card_no ='$card_no'";


$credit_result = $conn -> query($credit_card);


if ($credit_result -> num_rows > 0){

//CREDIT CARD IS VALID AND A MATCH WAS FOUND//

$result = $credit_result -> fetch_assoc();

//NOW CHECK IF NAME.PIN,CCV,EPIRE DATE MATCH//

/*
if ($card_full_name == $result["Full_name"]){

//Name MATCH

echo $card_full_name;
//echo "namer match";




}else{

//NAME DOES NOT MATCH

echo "name does not match";



}

*/



//CHECK IF CARD CCV MATCH//



if ($result["Ccv"] == $ccv){

//DO NOTHING//




}else{
  
  $message_status = "incorrect ccv";

  require_once __DIR__.("/Failed.php");

die();
}

//NOW CHECK IF EXPIRY DATE MACTH//


if ( $result["Exp_date"] == $expire_date){

  //DO NOTHING//

  
  } else{
    
    $message_status = "incorrect expiry date";
  
    require_once __DIR__.("/Failed.php");
  
  die();
  }


  //NOW CHECK IF PIN MATCH

if (password_verify($pin,$result["Pin"]) == "password_hash"){


//CARD PIN MATCH //

//FIRST CHECK IF CARD STATUS IF BLOCK//

if ($result["Status_r"] == "Block"){

  
  $message_status = "Payment was rejected by your bank";
  
  require_once __DIR__.("/Failed.php");

die();



}

//NOW CHECK IF ACCOUNT IS BLOCK//








//NOW FETCH RECORD AND CHECK IF USER HAS SUFFICENT BALANCE//


$check_balance = "SELECT * FROM Register_db WHERE id='$result[User_id]' ";


$balance_result = $conn -> query($check_balance) -> fetch_assoc();


if ($_SESSION["Amount"] > $balance_result["Account_balance"]){

//BALANCE NOT SUFFICIENT//

$message_status = "insufficient balance";
  
require_once __DIR__.("/Failed.php");

die();



}else{


//CHECK IF USER IS TRYIN TO CREDIT THE DEBIT CARD ACCOUNT NUMBER//



if ($result["User_id"] == $_SESSION["payment_id"]){

//THORW ERROR FOR TRYING TO CREDIT THEIR OWN ACCOUNT

$message_status = "error please check your link<br>Payment was rejected by your bank";
  
require_once __DIR__.("/Failed.php");

die();


}






//BALANCE IS SUFFICIENT YOUR CAN DEBIT USER//

//DEBIT USER//



$sender_balance = $balance_result["Account_balance"] - $_SESSION["Amount"];





$debit_user = "UPDATE Register_db SET Account_balance ='$sender_balance' WHERE id='$balance_result[id]' ";


if ($conn -> query($debit_user) == TRUE){

//NOW INSERT TO DEBIT USER TRANSACTION HISTROY//

$ip_add = $_SERVER["REMOTE_ADDR"];

$remark = "- Debit";

$send_account_no =substr($card_no,5) . substr($card_no,-4);

$re_account_no = $_SESSION["Account_no"];




$transaction_id =  rand(999,9999).uniqid();

$type = "Transfer-"."-To-".  $_SESSION["Full_name"]. " via card topup";

$status = "Successful";

$date = date("Y-m-d H:i:s");

$time = date("H:i:s");

$typee="Top up";

$bank ="Lazerwave";


$insert_tra = "INSERT INTO Transaction_history(User_id,Transaction_id,Amount,Type_name
,Remark,Status_remark,Sender_account_no,Receiver_account_no,Date_id,Time_id,Ip_addr,Type,Bank

)
VALUES('$result[User_id]','$transaction_id','$_SESSION[Amount]','$type','$remark','$status','$send_account_no','$re_account_no','$date','$time','$ip_add','$typee','$bank')
";

if ($conn -> query($insert_tra) == TRUE){


  
$message_status = "Transaction successful";
  
require_once __DIR__.("/success.php");

//require_once __DIR__.("/Receipt.php");




 // echo "inserted";

 //NOW CREDIT RECIEVER ACCOUNT BALANCE

$new_balance = $_SESSION["Account_balance"] + $_SESSION["Amount"];




$credit ="UPDATE Register_db SET Account_balance ='$new_balance' WHERE id='$_SESSION[payment_id]'";


if ($conn -> query($credit) ==TRUE){

//NOW INSERT TO RECEIVER TRANSACTION HISTROY//

$remark = "+ Credit";



$tra = "INSERT INTO Transaction_history(User_id,Transaction_id,Amount,Type_name
,Remark,Status_remark,Sender_account_no,Receiver_account_no,Date_id,Time_id,Ip_addr

)
VALUES('$_SESSION[payment_id]','$transaction_id','$_SESSION[Amount]','$type','$remark','$status','$send_account_no','$re_account_no','$date','$time','$ip_add','$typee','$bank')
";


if($conn -> query($tra) == TRUE){


//DO NOTHING




}else{
//STILL DO NOTHING//





}



}




}







}






}






}else{



  //CARD PIN DOES NOT MATCH//


//RECORD AS FAILED TRANSACTION//


//INSERT INTO ACCOUNT  TRANSACTION HISTORY AND SEND MAIL TO USER

$ip_add = $_SERVER["REMOTE_ADDR"];

$remark = "Pending";

$send_account_no =substr($card_no,5) . substr($card_no,-4);

$re_account_no = $_SESSION["Account_no"];




$transaction_id = rand(999,9999).uniqid();

$type = "Transfer-"."-To-".  $_SESSION["Full_name"]. " via card topup";

$status = "Failed";

$date = date("Y-m-d H:i:s");

$time = date("H:i:s");






$insert_failed = "INSERT INTO Transaction_history(User_id,Transaction_id,Amount,Type_name
,Remark,Status_remark,Sender_account_no,Receiver_account_no,Date_id,Time_id,Ip_addr,Type,Bank

)
VALUES('$result[User_id]','$transaction_id','$_SESSION[Amount]','$type','$remark','$status','$send_account_no','$re_account_no','$date','$time','$ip_add','$typee','$bank')
";

if ($conn -> query($insert_failed) == TRUE){


 // echo "inserted";



}else{
    
    
    //echo $conn -> error;
}





$message_status = "incorrect pin";
  
require_once __DIR__.("/Failed.php");

die();





}








}else{

//CREDIT CARD NOT FOUND//


$message_status = "Invalid credit card,please check card number";

require_once __DIR__.("/Failed.php");

die();



}









/*

//INSERT INTO ACCOUNT  TRANSACTION HISTORY AND SEND MAIL TO USER

$ip_add = $_SERVER["REMOTE_ADDR"];

$remark = "- Debit";

$send_account_no = htmlspecialchars($search_user_result["Account_no"]);

$re_account_no = htmlspecialchars($_SESSION["Account_no"]);




$transaction_id = "AGFR" . rand(999,9999);

$type = "Transfer-"."-To-".  $_SESSION["Details_name"];

$status = "Successful";

$date = date("Y/m/d h:i:sa");

$time = date("h:i:sa");






$inser_sender_debit = "INSERT INTO Transaction_history(User_id,Transaction_id,Amount,Type_name
,Remark,Status_remark,Sender_account_no,Receiver_account_no,Date_id,Time_id,Ip_addr

)
VALUES('$search_user_result[id]','$transaction_id','$amount','$type','$remark','$status','$send_account_no','$re_account_no','$date','$time','$ip_add')
";



*/


}
?>


</div>





<p><i class='fa fa-credit-card'></i> Supported card </p>
<p><i>LazerWave </i> <i class='fa fa-fire' style='color:red'></i></p>

      


</body>
</html>
    