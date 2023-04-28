<?php

session_start();



if (!isset($_SESSION['reset_pass_id'])){

  header("Location: Reset password.php");

  exit;

}
/*

if (!isset($_SESSION['reset_pass_email'])){


  header("Location: Reset password.php");

  exit;


}


if ($_SERVER["REQUEST_METHOD"] == "GET"){

  header("Location: Reset password.php");

  exit;


}*/


if ($_SERVER["REQUEST_METHOD"] == "POST"){


  $OTP = (int) filter_var($_POST["otp"],FILTER_SANITIZE_NUMBER_INT);

  
///CHECK IF OTP IS EMPTY

if (!empty($OTP)){  

  htmlspecialchars($OTP);



//now check if otp match//

require_once __DIR__.("/db_connection.php");

$check_otp = "SELECT * FROM Change_password_otp WHERE User_id ='
$_SESSION[reset_pass_id]' AND NOW() <= DATE_ADD(Date_id,INTERVAL 10 MINUTE) LIMIT 1";

$OTP_result = $conn -> query($check_otp) -> fetch_assoc();

//if ($OTP_result -> num_rows > 0){

  //var_dump($OTP_result);

  if ($OTP_result["Otp"] == $OTP){
    //CHANGE USER PASSWORD//

$hash = password_hash( $_SESSION["Confirm_password"],PASSWORD_DEFAULT);


$ip_add = $_SERVER["REMOTE_ADDR"];

$update_password  = "UPDATE Register_db SET Password ='$hash' WHERE id = '$_SESSION[reset_pass_id]' AND Email='$_SESSION[reset_pass_email]' ";

if ($conn -> query($update_password) == TRUE){


  $to = $_SESSION['reset_pass_email'];
  $subject = "Reset password";
  $headers = "From:Lazewave.com \r\n";
 // $headers .= "CC:".$_SESSION['reset_pass_email']. "\r\n";
  $headers .="MIME-Version:1.0\r\n";
  $headers .="Content-Type: text/html;charset=ISO-8859-1\r\n";
  
  
  $message ='<p style="background-color: rgb(0,0,100);padding: 10px 10px;color: white;margin:auto;">Lazerwave</p>';
  
  $message .='<p style="margin-left: 6px"> Hello '. $_SESSION["Surname"]. ',</p>';
  
  $message .='<p>Your password has been updated successfully</p>';
  
  $message .='<p>From ip address'. $ip_add.'</p>';
  
  $message .="<p>if you did not request for this please click <a href='https://lazwerwave.000webhostapp.com/Reset password'> here</a> to change your password </p>";
  
  
  mail($to,$subject,$message,$headers);


//REDIRECT USER TO DESTROY SESSION//16479


$message_status ="Password has been change successfully<br>
<a href='destroy otp.php'>Login</a>
";
require_once __DIR__.("/success.php");

//header("Location:destroy otp.php");
//exit;

  
  }else{

  $message_status = "An unknown error has occur,please try again</p>";


  require_once __DIR__.("/Failed..php");
   
  }



  }else{

//OTP IS INVALID//

//header("Location:destroy otp.php");


$message_status ="Invalid otp";

require_once __DIR__.("/Failed.php");


  }



}else{

//OTP IS EMPTY



$message_status = "Please enter your otp";
require_once __DIR__.("/Failed.php");


}









}




?>



<!DOCTYPE html>
<html lang="eng_US">
  <head>
    <link rel="stylesheet" href="Reset password.css">
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
<title>Verify otp</title>
      </head>
      <body>

      <span class="material-symbols-outlined" onclick="window.history.back()" style="color:rgb(0,0,180);">arrow_back</span>
      <a href="index.php"><i class="fa fa-home" style="color:rgb(0,0,180);cursor:pointer;float:right;margin-top:1px;font-size:20px;"></i></a>
    


      <div class="reset-password-container">

        <h1><i class="fa fa-cogs"></i> Reset Password  </h1>
        <form method="post">

        <label for="email"><b>Otp:</b></label>
        <br>

        <input type="number" name="otp" placeholder="Enter otp...">

        <br>

        <input type="submit" value="Validate">
</form>

        </div>






<div class="message-container">

<p>We just send you an otp.If you cannot find it please check your span folder.Note otp will expire in 10 minute.you can re-request in 10 mintues .</p>


<input type="hidden" value="re-send-otp">


          <p class="otp-button"><input type="submit" value="Resend otp"> </p>
        </div>

        <script>
          //show pop up after 10 minute so that user can request again for otp//
var timer = setTimeout(startTimer,100000);

function startTimer(){
  document.querySelector(".otp-button").style.display = "block";
}
          </script>