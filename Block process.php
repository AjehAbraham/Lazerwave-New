<?php

require_once __DIR__.("/sessionPage.php");


if (!isset($_SESSION["New_user"])){
    header("location:login.php");
    exit;
}





if($_SERVER["REQUEST_METHOD"] == "POST"){

  //$transaction_pin = (int) filter_var($_POST["Pin"],FILTER_VALIDATE_INT);

  $transaction_pin = $_POST["Pin_code"];


  if (empty($transaction_pin)){

    $message_status = "Please enter pin.";


    include __DIR__.("/Failed.php");


   // echo "Please enter your four digit transaction pin";

    die();

  }else{
    htmlspecialchars($transaction_pin);
  }


  /*if (!(int) filter_var($_POST["Pin"],FILTER_VALIDATE_INT) == TRUE){
    die("<p style='color: red;'>Pin must be a number</p>");
  }*/

//check if transaction pin match or is valid

$check_pin = "SELECT * FROM User_pin WHERE User_id = '$_SESSION[New_user]'";

$check_pin_result = $conn -> query($check_pin) -> fetch_assoc();

//check if password/pin match

if ($check_pin_result == NULL){

  $message_status = "Please create a transaction pin .";


    include __DIR__.("/Failed.php");

  die();
}


if (password_verify($transaction_pin,$check_pin_result["Pin"]) == "Password_hash"){

///


}else{
  

$message_status = "Invalid pin.";


include __DIR__.("/Failed.php");
//echo "Invalid transaction pin";
  die();
}


  require_once __DIR__.("/db_connection.php");

  
$block = "Block";
$unblock = "Unblock";
$date = date("Y-m-d h:i:s");
$ip_addr = $_SERVER["REMOTE_ADDR"];

  // checking if user account hass been block or if user have never block account

  $check_status = "SELECT * FROM Block_account WHERE User_id = '$_SESSION[New_user]'";

  $check_result = $conn -> query($check_status);


  if ($check_result -> num_rows > 0){
    while($final_result = $check_result -> fetch_assoc()){
/// update account status if account is block

if ($final_result['Account_status'] == 'Unblock'){

$UPADTE_record = "UPDATE Block_account SET Account_status ='$block' WHERE User_id = '$_SESSION[New_user]'";
  
if ($conn -> query ($UPADTE_record) == TRUE){


  $message_status = "Account has been Blocked successfully";


include __DIR__.("/success.php");


  //$logo_status = "<i class ='fa fa-check'></i>";



  $insert_record = "INSERT INTO Block_account_history(User_id,Account_status,Date,Ip_addr)
  
  VALUES('$_SESSION[New_user]','$block','$date','$ip_addr')
  
  ";

if ($conn -> query ($insert_record) == TRUE){

  ///succesffully but do not display any message
}else{
  //failed but do not display any message
}


}else{
  



$message_status = "Failed. An unknown error has occur.";


  include __DIR__.("/Failed.php");
}

  
}else{


  //IF IT ALREADY EXIST

$Update_status = "UPDATE Block_account SET Account_status ='$unblock' WHERE User_id = '$_SESSION[New_user]'";


if ($conn -> query ($Update_status) == TRUE){


  $message_status = "Account has been Unblocked successfully";



  include __DIR__. ("/success.php");



  $insert_history = "INSERT INTO Block_account_history(User_id,Account_status,Date,Ip_addr)

  VALUES('$_SESSION[New_user]','$unblock','$date','$ip_addr')
  
  ";
  
  if ($conn -> query ($insert_history) == TRUE){
    // no need to print message
  }else{
    // no need to print error message
  }
  

}else{


$message_status = " An unknown error has occur.";



  include __DIR__.("/Failed.php");

 
}

    } }///////
    
  }else{

 //insert if no record exit. meaning if user has never ever block their account before

 $Insert = "INSERT INTO Block_account(User_id,Account_status,Date,Ip_addr)
 VALUES('$_SESSION[New_user]','$block','$date','$ip_addr')

 ";

 if ($conn -> query ($Insert) == TRUE){

  $message_status = "Account has been blocked successfully";

//echo "Account has been blocked successfully";



include __DIR__.("/success.php");

  

//Now insert to history table so that you can lnow how many times user block or unblock their acoount



$insert_history = "INSERT INTO Block_account_history(User_id,Account_status,Date,Ip_addr)

VALUES('$_SESSION[New_user]','$block','$date','$ip_addr')

";

if ($conn -> query ($insert_history) == TRUE){
  // no need to print message
}else{
  // no need to print error message
}


 }else{

//echo "Failed. An unknown error has occur.";

  $message_status = "Failed. An unknown error has occur.";
  

include __DIR__.("/Failed.php");


 }



  }


}

?>


          </div>
