<?php
require_once __DIR__.("/sessionPage.php");







if ($_SERVER["REQUEST_METHOD"] == "POST"){

require_once "Check block account.php";

require_once "Check daily limit.php";


require_once "db_connection.php";


$pin = (int) filter_var($_POST["pin"],FILTER_VALIDATE_INT);


if(empty($pin)){
    
    $message_status ="Please enter pin";
    
    
    die();
    
    
}else{
    
    $pin = htmlspecialchars($pin);
}


$tran_pin ="SELECT * FROM User_pin WHERE User_id='$_SESSION[New_user]'";


$user_result = $conn -> query($tran_pin);


if($user_result -> num_rows > 0){
    
    
    $user_pin = $user_result -> fetch_assoc();
    
    
    if(password_verify($pin,$user_pin["Pin"]) == "password_hash"){
        
        
        
    }else{
        
        $message_status="Invalid transaction pin";
        
        
        require_once "Failed.php";
        
        die();
        
        
    }
    
    
    
    
    
    
    
}else{
    
    
    $message_status="No transaction pin found,please create transaction pin.";
    
    require_once "Failed.php";
    
    die();
    
    
}






$Accept = (int) filter_var($_POST["Accept"],FILTER_VALIDATE_INT);


if (empty($Accept)){
$message_status ="Invalid request type";

require_once __DIR__.("/Failed.php");

die();



}else{
htmlspecialchars($Accept);


}




$amount = (int) filter_var($_POST["amount"],FILTER_VALIDATE_INT);


if (empty($amount)){
$message_status ="Invalid request type";


require_once __DIR__.("/Failed.php");

die();



}else{
htmlspecialchars($amount);


}

$notify =htmlspecialchars($_POST["notify"]);

if(empty($notify)){
    
    $message_status ="Server error";
    
    require_once __DIR__.("/Failed.php");
    die();
    
    
}

require_once __DIR__.("/prevent money request.php");



 //FIRST FETCH RECEIVER CURRENT BALANCE
   
   $fetch_bal ="SELECT * FROM Register_db WHERE id='$Accept'";
   
   $fetch_result = $conn -> query($fetch_bal) -> fetch_assoc();
   



//NOW CHECK IF USER HAVE SUFFICIENT BALANCE THEN CREDIT AND DEBIT//


if ($amount <= $user["Account_balance"])

{

//NOW CHECK IF USER ACCOUNT IS BLOCK OR NOT

require_once "Check block account.php";

require_once "Check daily limit.php";




//NOW CREDIT USER AND DEBIT SENDER //

$new_balance =  $user["Account_balance"] - $amount;


$update_balance = "UPDATE Register_db SET Account_balance ='$new_balance' WHERE id='$_SESSION[New_user]'";


if ($conn -> query($update_balance) == TRUE){


//NOW INSERT INTO USER TRANSACTION HISTORY//

$ip_add = $_SERVER["REMOTE_ADDR"];

$remark = "- Debit";

$send_account_no =$user["Account_no"];

$re_account_no = $fetch_result["Account_no"];


$transaction_id =  rand(999,9999) .uniqid().rand(9262,72626);

$type ="Money Request";

$status = "Successful";

$date = date("Y-m-d H:i:s");

$time = date("H:i:s");


$typee ="Transfer";
$bank ="Lazerwave";



$insert_history = "INSERT INTO Transaction_history(User_id,Transaction_id,Amount,Type_name
      ,Remark,Status_remark,Sender_account_no,Receiver_account_no,Date_id,Time_id,Ip_addr,Type,Bank)
      
   VALUES('$_SESSION[New_user]','$transaction_id','$amount','$type','$remark','$status','$send_account_no','$re_account_no','$date','$time','$ip_add','$typee','$bank')";
   
   
   
   if($conn -> query($insert_history) == TRUE){
   
   
  $message_status ="Money Request Accepted,user has been credited";


require_once __DIR__.("/success.php");


require_once "Add limit.php";

   
   
   
   $credit_balance = $amount + $fetch_result["Account_balance"];
   
   
   //NOW UPDATE RECEIEVER ACCOUNT BALANCE 
   $update_bal = "UPDATE Register_db SET Account_balance ='$credit_balance' WHERE id = '$fetch_result[id]'";
   
   
   if($conn -> query($update_bal) == TRUE){
   
   //UPDATE ACCEPT REQUEST TABLE
   
   
   require_once __DIR__.("/update accept request.php");
   
   
   //INSERT INTO TRANSACTION HISTORU//
   
   $remark ="+ Credit";
   $transaction_id =rand(7363,8373) .uniqid();
   ;
  $inser =" INSERT INTO Transaction_history(User_id,Transaction_id,Amount,Type_name
      ,Remark,Status_remark,Sender_account_no,Receiver_account_no,Date_id,Time_id,Ip_addr,Type,Bank)
      
   VALUES('$fetch_result[id]','$transaction_id','$amount','$type','$remark','$status','$send_account_no','$re_account_no','$date','$time','$ip_add','$typee','$bank')";
   
   if($conn -> query($inser) == TRUE){

//DO NOTHING

//INSERT INTO RECEIEVER NOTIFICATION TO INFORM THEM THAT MONEY WAS SENT TO THEM OR YOU CAN INFORM THEM THROUGH EMAIL//


$_SESSION["AMOUNT"] = $amount;
   
   
   require_once __DIR__.("/Debit alert.php");
   
   
   require_once "Add limit.php";
   
   
   }
   
   
   
   
   
   }




}


}



}else{


//INSUFFICIENT BALANCE//

$status ="Failed";
$remark ="Pending";

$transaction_id = uniqid() . rand(999,9999);

$type ="Money Request";


$date = date("Y-m-d h:i:s");

$time = date("h:i:s");
$ip_add = $_SERVER["REMOTE_ADDR"];


$send_account_no =$user["Account_no"];

$re_account_no = $fetch_result["Account_no"];




$inser = "INSERT INTO Transaction_history(User_id,Transaction_id,Amount,Type_name
      ,Remark,Status_remark,Sender_account_no,Receiver_account_no,Date_id,Time_id,Ip_addr,Type,Bank)
      
   VALUES('$_SESSION[New_user]','$transaction_id','$amount','$type','$remark','$status','$send_account_no','$re_account_no','$date','$time','$ip_add','$typee','$bank')";
   
   if($conn -> query($inser) == TRUE){

$message_status ="Insufficient balance";


require_once __DIR__.("/Failed.php");

die();
}else{
//FAILED TO INSERT RECORD//

$message_status ="Insufficient balance,server error" .$conn-> error;


require_once __DIR__.("/Failed.php");



  $_SESSION["AMOUNT"] = $amount;
  
  require_once __DIR__.("/Debit alert.php");


die();


}





}






}

?>