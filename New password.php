<?php

session_start();


if (!isset($_SESSION['reset_pass_id'])){
  if (!isset($_SESSION['reset_pass_email'])){

  header("Location: Reset password.php");

  exit;

  }
}


if($_SERVER["REQUEST_METHOD"] == "POST"){


  $new_password = htmlspecialchars( $_POST["New_password"]);

  $confirm_password = htmlspecialchars($_POST["Confirm_password"]);


//CHECK IF PASSWORD IS EMPTY OR NOT 
if (!empty($new_password || $confirm_password)){

if (preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/" ,$new_password)) 
{


if ($new_password === $confirm_password){


 /* $str = 8;

  if (strlen($new_password)   >= $str || strlen($confirm_password) >= $str){
*/

      //password is 8 in length

 /*if (preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/" ,$confirm_password)) 
{*/

   //CHECK IF NEW PASSWORD AND CONFIRM PASSWORD IS THE SAME //

  $_SESSION["Confirm_password"] = $confirm_password;

//now insert otp to otp table


require_once __DIR__.("/db_connection.php");

$otp = rand(9999,99999);
$date = date("Y-m-d h:i:s");

$time = date("h:i:s");



$OTP_table = "INSERT INTO Change_password_otp(User_id,Otp,Time_id,Date_id)

VALUES('$_SESSION[reset_pass_id]','$otp','$time','$date')

";

if ($conn -> query($OTP_table) == TRUE){
//do nothin or maybe just alert the user //


//SEND OTP TO USER//

$to = $_SESSION['reset_pass_email'];
$subject = "Reset password";
$headers = "From:Lazewave.com \r\n";
//$headers .= "CC:".$_SESSION['reset_pass_email']. "\r\n";
$headers .="MIME-Version:1.0\r\n";
$headers .="Content-Type: text/html;charset=ISO-8859-1\r\n";

$message ='<p style="text-align: center;background-color: rgb(0,0,180);padding: 10px 10px;color: white;margin:auto;text-align: center">Lazerwave</p>';
$message .='<p style="margin-left: 6px"> Hello ' . $_SESSION["Surname"]. ',</p>';


$message .='<h1>Your otp is:</h1>';


$message .='<p style="background-color: rgb(0,0,52);text-align:center;font-size: 23px;color: white; padding: 10px 10px;">'.$otp .'</p>';

$message .='<p>if you did not request for this, please ignore </p>';



mail($to,$subject,$message,$headers);

//$message_status = "Otp has been sent successfully";
  
  
//require_once __DIR__.("/success.php");

//INCLUDE OTP PAGE SO THAT USER CAN VERIFY AND CHANGE THEIR PASSWORD//

header("Location:Verify otp.php");
die();


//require_once __DIR__.("/Verify otp.php");


}else{

//OTP FAILED TO INSERT TO DB//



}


}else{


//NEW PASSOWRD AND CONFRIM PASSWORD ARE NOT THE SAME //



$message_status ="New password and confirm password mismatch,note new password and old passowrd must be thesame";


require_once __DIR__.("/Failed.php");





}





}else{

//PASSWORD FAIL TO CONTAINE ALL THE SPECIAL CHARACTES




$message_status ="Password must contain one uppercase,one lowercase,one special character and must be 8 in length";


require_once __DIR__.("/Failed.php");






}


}else{

//PASSWORD IS EMPTY


$message_status ="Password cannot be empty";

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
<title>Reset Password</title>
      </head>
      <body>

    
<script>
     
     if(window.history.replaceState){
     
     window.history.replaceState(null,null,window.location.href);
     
     }

  
function close_otp_message(){

document.querySelector(".form-status-message-overlay").style.display = "none";



}


</script>




      <span class="material-symbols-outlined" onclick="window.history.back()" style="color:rgb(0,0,180);">arrow_back</span>
      <a href="index.php"><i class="fa fa-home" style="color:rgb(0,0,180);cursor:pointer;float:right;margin-top:1px;font-size:20px;"></i></a>
    


      <p class="error_message"></p>

      <div class="reset-password-container">

        <h1><i class="fa fa-cogs"></i> Reset Password  </h1>


        <form method="post" >

        <label for="email"><b>New password:</b></label>
        <br>

        <input type="password" name="New_password" value="<?php echo isset($_POST["New_password"]) ? $_POST["New_password"] :'' ?>" placeholder="New password...">

        <br>

        <label for="confirm"><b>Confirm password:</b></label>
        <br>

        <input type="password" name="Confirm_password" value="<?php echo isset($_POST["Confirm_password"]) ? $_POST["Confirm_password"] : '' ?>" placeholder="Confirm password...">

        <br>


        <input type="submit"  value="Change password">
</form>


        </div>

   





</html>
</body>