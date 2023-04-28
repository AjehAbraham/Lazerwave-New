<?php
require_once __DIR__.("/sessionPage.php");

  if($_SERVER["REQUEST_METHOD"] == "POST"){
  
  $username = htmlspecialchars($_POST["Request"])
  ;
  
  
  if(empty($username)){
  
  $message_status ="Please enter username or account number";
  
  require_once __DIR__.("/Failed.php");
  
  die();
  }
  
  $amount = (int) filter_var($_POST["amount"],FILTER_VALIDATE_INT);
  
  if (empty($amount)){
  
  $message_status ="Please enter a valid amount";
  require_once __DIR__.("/Failed.php");
  die();
  
  
  }
  
  //CHECK IF USERNAME OR ACCOUNT NUMBER IS SAME WITH CURRENT LOGIN USER TO AVOID ERROR//
  
  
  if ($user["Account_no"] == $username){
      
      $message_status =" Error,An unknown error has occur";
      require_once __DIR__.("/Failed.php");
      die();
  }
  
  
  
  //ITMES TO INSERT TO NOTIFICATION TABLE
  
  $ip_addr =htmlspecialchars($_SERVER["REMOTE_ADDR"]);
  $date =htmlspecialchars(date("Y-m-d H:i:s"));
  
  $time = htmlspecialchars(date("H:i:s"));
  
  $notify = rand(362829,627273). uniqid();
  
  $type= "Money Request";
  
  $message ="Money Request from"." " .$user['Surname']. ' '. $user['Last_name'].' '. $user['First_name'];
  
  
  //NOW CHECK USERNAME///
  
  
  require_once __DIR__.("/db_connection.php");
  
  
  $user_name ="SELECT * FROM Username WHERE Username='$username'
  ";
  
  $user_result = $conn -> query($user_name);
  
  if ($user_result -> num_rows > 0)
  {
  //FETCH RECORD BECAUSE USER WAS FOUND. 
  
  $result_name = $user_result -> fetch_assoc();
  
  
  //CHECK IS USERNAME IS SAME WITH CURRENT USER //
  
  strtolower($username);
  
  //convert first letter to uppercase//
  
/*
  if ($result_name["Username"] == $username){*/
  
  if($result_name["User_id"] == $_SESSION["New_user"]){
      
      
      $message_status="Error,you cannot send request to yourself,please check the username properly";
      require_once __DIR__.("/Failed.php");
      
      die();
  }
  
  
  //NOW INSERT TO NOTIFICATION TABLE//
  
  
  $st ="unseen";
  
  $insert ="INSERT INTO Notification(User_id,Amount,Message	,Receiver_id	,Notify_id	,Type	,Date	,Time	,Ip_addr,Status
)

VALUES('$result_name[User_id]','$amount','$message','$_SESSION[New_user]','$notify','$type','$date','$time','$ip_addr','$st')
";
  
  if($conn -> query($insert)== TRUE)
  {
  
  echo "<script>document.querySelector(#formId).reset()</script>";
  
  //NOTIFY USER THROUGH NOTIFICATION OR SOMETHINE ELSE
  
  
  $message_status ="Money Request has been sent";
  
  require_once __DIR__.("/success.php");
  die();
  
  }else{
  
  //echo $conn -> error;
  
  $message_status ="Errro,please try again later";
  
  require_once __DIR__.("/Failed.php");
  
  
  }
  
  
  
  
  }else{
  
  //NO RECORD WAS FOUND //
  
 // NOW CHECK JUST INCASE IT ACCOUNT NUMBER INSTEAD IF USERNAME//
  
  
  $account_no ="SELECT * FROM Register_db WHERE Account_no='$username'";
  
  $acct_result = $conn -> query($account_no);
  
  if ($acct_result -> num_rows > 0
  ){
  //A MATCH WAS FOUND FOR ACCOUNT NUMBER
  
  $result_name = $acct_result -> fetch_assoc();
  
  //INSERT INTO USER Notification//
  
  $st ="unseen";
    
  $insert ="INSERT INTO Notification(User_id,Amount,Message	,Receiver_id	,Notify_id	,Type	,Date	,Time	,Ip_addr,Status
)

VALUES('$result_name[id]','$amount','$message','$_SESSION[New_user]','$notify','$type','$date','$time','$ip_addr','$st')
";
  
  if($conn -> query($insert)== TRUE)
  {
  
  echo "<script> document.querySelector(#formId).reset()</script>";
  
  //NOTIFY USER THROUGH NOTIFICATION
 // OR SOMETHINE ELSE//
  
  
  $message_status ="Money Request has been sent";
  
  require_once __DIR__.("/success.php");
  die();
  
  }else{
  
  
  
  
  
  $message_status ="Errro,please try again later";
  
  require_once __DIR__.("/Failed.php");
  
  
  }
  
  
  
  
  
  
  
  }else{
  
  
  //ACCOUNT NUMBER WAS NOT FOUND //.
  
  
  $message_status ="Invalid username or account number";
  
  require_once __DIR__.("/Failed.php");
  die();
  
  
  }
  
  
  
  }
  
  
  
  
  
  
  
  }
  
  
  

?>