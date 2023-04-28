<?php


if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

  header("Location: Warning.php");
  exit;

      header('HTTP/1.0 403 Forbiddden',TRUE,403);
      die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}




if(isset($_POST["code"])){


$referal_code  = htmlspecialchars($_POST["code"]);


//$message_status = $referal_code;


//require __DIR__.("/Failed.php");



if(!empty($referal_code)){
    



require_once __DIR__.("/db_connection.php");

$Check_code ="SELECT * FROM Refer_and_Earn WHERE Referal_code='$referal_code '";


$result = $conn -> query($Check_code);


if($result -> num_rows > 0){

//CODE MATCH ONE IN DATABASE//


$code_result = $result -> fetch_assoc();


//FIRST FETCH THE REFERAL ACCOUNT BALANCE//



$balance = "SELECT * FROM Register_db WHERE id='$code_result[User_id]'";


$result_bal = $conn -> query($balance) -> fetch_assoc();


//var_dump($result_bal);
//echo $result_bal["Account_balance"];


$amount= 1000;

$new_bal =(int)$result_bal["Account_balance"];

//echo gettype($new_bal);

$new_bal = $amount + $new_bal;




//UPDATE REFERAL ACCOUNT BALANCE//

$update ="UPDATE Register_db SET Account_balance='$new_bal' WHERE id='$result_bal[id]'";


if($conn -> query($update) == TRUE){


$transaction_id = rand(766,927) . uniqid();


$amount = 1000;

$new_bal = $result_bal["Account_balance"] + $amount;

$type= "Referal bonus from ".$surname . " ". $last_name." ".$first_name;

$remark = "+ Credit";
$status = "Successful";

$re_account_no = $result_bal["Account_no"];



$send_account_no = "Lazerwave referal bonus";


$date =htmlspecialchars(date("Y-m-d H:i:s"));

$time = htmlspecialchars(date("H:i:s"));


$ip_addr =htmlspecialchars($_SERVER["REMOTE_ADDR"]);


$typee ="Referal";
$bank ="Lazerwave";


$insert_history = "INSERT INTO Transaction_history(User_id,Transaction_id,Amount,Type_name
      ,Remark,Status_remark,Sender_account_no,Receiver_account_no,Date_id,Time_id,Ip_addr,Type,Bank)
      
   VALUES('$result_bal[id]','$transaction_id','$amount','$type','$remark','$status','$send_account_no','$re_account_no','$date','$time','$ip_addr','$typee','$bank')";
   
   
   if($conn -> query($insert_history) == TRUE){
   
   //DO NOTHING
   
   //INSERT INTO REFERAL RECORD TO KEEP PROOF OF TRANSACTION//
   
   
   
   /*
   $create ="CREATE TABLE Referal_record(id INT(123) UNSIGNED AUTO_INCREMENT PRIMARY KEY,User_id INT(20),Referal_code VARCHAR(30),Referred INT(15),Date TIMESTAMP,Time TIME,Ip_addr VARCHAR(30) )";
   
   
   if($conn -> query($create) == TRUE){
   
   echo "Table created";
   
   
   
   }else{
   
   echo "failed" ." ". $conn -> error;
   
   
   }
   */
   
   
   $record ="INSERT INTO Referal_record(User_id,Referal_code,Referred,Date,Time,Ip_addr)
   
   
   VALUES('$result_bal[id]','$referal_code','$account_no','$date','$time','$ip_addr')";
   
   if($conn -> query($record) == TRUE){
   
   //DO NOTHING //
   
   
   
   }else{
   
   
   //DO MOTHING
   
echo  $conn -> error;
   
   
   }
   
   
   
   
   
   
   
   }else{
   
   //DO NOTHING 
   
   
   //echo $conn -> error;
   
   }
   
   
   
   
   }else{
   
   
   //DO NOTHING
   
  // echo $conn -> error;
   
   
   
   }








}else{

//CODE DOES NOT MATCH CODE IN DATABASE//





}





}else{



//CODE IS EMPTY



}





}


?>