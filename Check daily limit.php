<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

  header("Location: Warning.php");
  exit;

      header('HTTP/1.0 403 Forbiddden',TRUE,403);
      die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}


require_once "db_connection.php";


$v_v ="SELECT * FROM More_information  WHERE User_id='$_SESSION[New_user]'";

$vv_result = $conn -> query($v_v);

if($vv_result -> num_rows > 0){
    
    
    
    //CHECK IF LIMIT JAS EXCEEDED 50,000//
    
    
    
    $l_v = "SELECT * FROM  Account_limit  WHERE User_id='$_SESSION[New_user]'";
    
    $l_l = $conn -> query($l_v) -> fetch_assoc();
    
    
    if($l_l["Limit_amount"] >= 50000){
        
        $message_status ="Daily limit exceeded,please try again tomorrow";
        
        require_once "Failed.php";
        
        
        die();
        
    }
    
    
    
    
}else{
    
    
    //DAILY LIMIT IS 10,0000
    
        
    $l_v = "SELECT * FROM  Account_limit  WHERE User_id='$_SESSION[New_user]'";
    
    $l_l = $conn -> query($l_v) -> fetch_assoc();
    
    
    if($l_l["Limit_amount"] >= 10000){
        
        $message_status ="Daily limit exceeded,please upgrade to Kyc2";
        
        require_once "Failed.php";
        
        
        die();
        
        
    }
    
    
    
}






?>