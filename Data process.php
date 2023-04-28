<?php
  
  require_once  __DIR__.("/sessionPage.php");

if ($_SERVER["REQUEST_METHOD"] == "POST"){

//  echo $_POST["plan"];

  

  $phone_no = (int) filter_var($_POST["phone-number"],FILTER_SANITIZE_NUMBER_INT);


if (empty($phone_no)){

    $message_status= "Phone number cannot be empty";

    include __DIR__ .("/Failed.php");

die();

}

$str = 9;

if (strlen($phone_no) <= $str){


    $message_status= "phone number too short";

    include __DIR__ .("/Failed.php");

die();


}else if(strlen($phone_no) >= 11){


    $message_status= "Phone number too long";

    include __DIR__ .("/Failed.php");

die();

}

$network = htmlspecialchars($_POST["netwok-provider"]);

if(empty($network)){

    $message_status= "Please select a network";

    include __DIR__ .("/Failed.php");

die();


}


$plan = htmlspecialchars($_POST["plan"]);

if (empty($plan)){

    
    $message_status= "Please select a plan";

    include __DIR__ .("/Failed.php");

die();

    
}


/*
if ($amount < $check){
  die("<p>Amount cannot be less than ₦50</p>");
}*/


$network = filter_var($_POST["netwok-provider"],FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH);


if (empty($network)){

    $message_status= "Please select a network provider";

    include __DIR__ .("/Failed.php");

die();



}else{

  htmlspecialchars($network);
}



//check transaction pin
$pin = (int) filter_var($_POST["transaction-pin"],FILTER_SANITIZE_NUMBER_INT);

htmlspecialchars($pin);


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

      
    $message_status= "invalid pin";

    include __DIR__ .("/Failed.php");

die();
}



  }


}else{

 
      
    $message_status= "
    Please create a transaction pin";

    include __DIR__ .("/Failed.php");

die();


}
require_once "Check block account.php";

require_once "Check daily limit.php";




//



//if user the amount is greater than balance failed transaction

if ($plan <= $user["Account_balance"]){

$ip_addr = $_SERVER["REMOTE_ADDR"];

$remark = "- Debit";

$re_account_no = htmlspecialchars( $_POST["phone-number"]);

$send_account_number = htmlspecialchars( $_POST["netwok-provider"]);


$transaction_id = uniqid(). rand(999,9999);

$type = "DATA-".$network. "-" .$plan ."-To ". $phone_no;

$status = "Successful";

$date = date("Y-m-d H:i:s");

$time = date("H:i:s");

$amount = $plan; 

$typee ="Data purchase";

$bank ="";


  include __DIR__.("/db_connection.php");

  //update user account-balance

$account_balance = $user["Account_balance"] - $plan;

// chnage the account balance 

$upadate_balance = "UPDATE Register_db SET Account_balance ='$account_balance' WHERE id ='$_SESSION[New_user]' ";


if ($conn -> query($upadate_balance) == TRUE){


  
  $status = "Successful";
  
    $success_transaction = "INSERT INTO Transaction_history(User_id,Transaction_id,Amount,Type_name,

    Remark,Status_remark,Sender_account_no,Receiver_account_no,Date_id,Time_id,Ip_addr,Type,Bank
    
    )
    VALUES('$_SESSION[New_user]','$transaction_id','$amount','$type','$remark','$status','$send_account_number','$re_account_no','$date','$time','$ip_addr','$typee','$bank')
    ";
    
    if ($conn -> query($success_transaction) == TRUE){
    
    
      $message_status = "Transaction Successful";

    include __DIR__ .("/success.php");
    
    
  $_SESSION["AMOUNT"] = $amount;
  
  require_once __DIR__.("/Debit alert.php");
  
  $Type ="Data";
  $receiver_id = 0;
  $amount = $amount;
  $message ="Data purchase to " .$phone_no ." " .$network. " ". $plan;
  
  require_once "Add notification.php";
  
  require_once "Add limit.php";
  
  


    }
  


  }else{
    /// do nothing



  }

  }else{
    
$ip_addr = $_SERVER["REMOTE_ADDR"];

$remark = "Pending";

$re_account_no =htmlspecialchars( $_POST["phone-number"]);

$send_account_number =htmlspecialchars( $_POST["netwok-provider"]);

$transaction_id = rand(525,8363) .uniqid();

$type = "Data " .$network. "-" .$plan ."-To ". $phone_no;

$status = "Failed";

$date = date("Y-m-d H:i:s");

$time = date("H:i:s");

$amount = $plan; 

  include __DIR__.("/db_connection.php");
  
    $status = "Failed";
    
      $failed_transaction = "INSERT INTO Transaction_history(User_id,Transaction_id,Amount,Type_name
     ,Remark,Status_remark,Sender_account_no,Receiver_account_no,Date_id,Time_id,Ip_addr,Type,Bank
      
      )
      VALUES('$_SESSION[New_user]','$transaction_id', '$amount','$type','$remark','$status','$send_account_number','$re_account_no','$date','$time','$ip_addr','$typee','$bank')
      ";
      
      if ($conn -> query($failed_transaction) == TRUE){
      
      
$message_status= "Insurficient Balance";

    include __DIR__ .("/Failed.php");



  $_SESSION["AMOUNT"] = $amount;
  
  require_once __DIR__.("/Debit alert.php");


    //echo "<p>Failed.please try agin later or check back soon</p>";
    


    }
  }
  $conn -> close();

}


?>

