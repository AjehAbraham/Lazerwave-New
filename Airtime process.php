<?php 
require_once __DIR__.("/sessionPage.php");

if ($_SERVER["REQUEST_METHOD"] == "POST"){

$phone_no = (int)  filter_var($_POST["phone-number"],FILTER_SANITIZE_NUMBER_INT);




if (empty($phone_no)){
 
    $message_status = "Please enter a phone number";
      
    include __DIR__ .("/Failed.php");


die();

}else{
  $str = 9;
  if (strlen($phone_no) <= $str){
 
    $message_status = "Invalid phone number";
      
    include __DIR__ .("/Failed.php");


die();

  }
}

if(strlen($phone_no) >= 11){

 
    $message_status = "Phone number too long.Must be 10 digit as in 9073220984";
      
    include __DIR__ .("/Failed.php");


die();

}

htmlspecialchars($phone_no);


$amount = (int) filter_var($_POST["amount"],FILTER_SANITIZE_NUMBER_INT);


if (empty($amount)){

 
    $message_status = "Enter amount";
      
    include __DIR__ .("/Failed.php");


die();

}
htmlspecialchars($amount);

$check = 50;



if ($amount < $check){

 
    $message_status = "Amount cannot be less than ₦50";
      
    include __DIR__ .("/Failed.php");


die();



  
}


$network = filter_var($_POST["netwok-provider"],FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH);


if (empty($network)){

 
    $message_status = "Please select a network provider";
      
    include __DIR__ .("/Failed.php");


die();

}

htmlspecialchars($network);



//check transaction pin
$pin = (int) filter_var($_POST["transaction-pin"],FILTER_SANITIZE_NUMBER_INT);

htmlspecialchars($pin);


//CHECK IF USER ACCOUNT IS BLOCK OR NOT //


require_once __DIR__.("/Check block account.php");

require_once "Check daily limit.php";



//search dtatabse table

$tran_pin = "SELECT * FROM User_pin WHERE User_id = '$user[id]'";

$result_pin = $conn -> query($tran_pin);

if ($result_pin -> num_rows > 0){


  while($pin_result = $result_pin -> fetch_assoc()){

//echo "pin found";

//now check if pin is correct


if (password_verify($pin,$pin_result["Pin"]) =="password_hash"){

//echo "pin is valid";


}else{

 
    $message_status = "invalid trnsaction pin";
      
    include __DIR__ .("/Failed.php");


die();


}



  }


}else{

        
    $message_status = "Please create a transaction pin";
      
    include __DIR__ .("/Failed.php");


die();


}


$ip_add = $_SERVER["REMOTE_ADDR"];

$remark = "Pending";

$send_account_no = htmlspecialchars($_POST["netwok-provider"]);

$re_account_no = htmlspecialchars($_POST["phone-number"]);




$transaction_id =rand(1237,8363) . uniqid().rand(999,9999);

$type = "AIRTIME-".$network . "-To-". $phone_no;

$status = "Failed";

$date = date("Y-m-d H:i:s");

$time = date("H:i:s");

$typee="Airtime purchase";

$bank ="";



if ( $amount > $user['Account_balance']){


  include __DIR__.("/db_connection.php");
  
    $status = "Failed";
    
      $failed_transaction = "INSERT INTO Transaction_history(User_id,Transaction_id,Amount,Type_name
      ,Remark,Status_remark,Sender_account_no,Receiver_account_no,Date_id,Time_id,Ip_addr,Type,Bank
      
      )
      VALUES('$_SESSION[New_user]','$transaction_id','$amount','$type','$remark','$status','$send_account_no','$re_account_no','$date','$time','$ip_add','$typee','$bank')
      ";
      
      if ($conn -> query($failed_transaction) == TRUE){

        ///

        
      $message_status = "Insuffient balance";
      
          include __DIR__ .("/Failed.php");
      
      
      }
    
    
  $message_status = "Insufficient funds";


  include __DIR__ .("/Failed.php");
  
  
  $_SESSION["AMOUNT"] = $amount;
  
  require_once __DIR__.("/Debit alert.php");

die();


}else if ($amount <= $user["Account_balance"]){

  
$ip_add = $_SERVER["REMOTE_ADDR"];

$remark = "- Debit";

$send_account_no = htmlspecialchars($_POST["netwok-provider"]);

$re_account_no = htmlspecialchars($_POST["phone-number"]);


  include __DIR__.("/db_connection.php");
  
$status = "Successful";

  $balance = $user["Account_balance"] - $amount;


  $update_balance  = "UPDATE Register_db SET Account_balance ='$balance'  WHERE id ='$_SESSION[New_user]' ";


  if ($conn -> query($update_balance) == TRUE){



$update_transaction = "INSERT INTO Transaction_history(User_id,Transaction_id,Amount,Type_name
,Remark,Status_remark,Sender_account_no,Receiver_account_no,Date_id,Time_id,Ip_addr,Type,Bank

)
VALUES('$_SESSION[New_user]','$transaction_id', '$amount','$type','$remark','$status','$send_account_no','$re_account_no','$date','$time','$ip_add','$typee','$bank')
";

if ($conn -> query($update_transaction) == TRUE){
 
  
  $message_status = "Transaction Successful";

  include __DIR__ .("/success.php");
  
  $_SESSION["AMOUNT"] = $amount;
  
  require_once __DIR__.("/Debit alert.php");
  
  $message="Airtime Top Up to " . $send_account_no." ".$phone_no;
   $Type="Airtime";
   
   $amount = $amount;
   
   require_once "Add notification.php";
   
   require_once "Add limit.php";
   
   
  

}


  }


}else{
    
    $status ="Failed";
    
    $_SESSION["AMOUNT"] =$amount;
    
    require_once __DIR__.("/Debit alert.php");


  $message_status = "An unkwnon error has occur";


      include __DIR__ .("/Failed.php");

      die();
  

}



/*
$mtn = "MTN";
$mobile = "9MOBILE";
$airtel ="AIRTEL";
$glo = "GLO";


if (!$network == $mtn || $network == $mobile || $network == $airtel || $network == $glo){
  die("<p>Invalid network provider</p>");
}*/






}


?>

