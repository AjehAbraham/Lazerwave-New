<?php


require_once __DIR__.("/db_connection.php");

$date =htmlspecialchars(date("Y-m-d H:i:s"));

$time = htmlspecialchars(date("H:i:s"));

$ip_addr =htmlspecialchars($_SERVER["REMOTE_ADDR"]);


$login_his = "INSERT INTO Login_history(User_id,Date,Time,Ip_addr)

VALUES('$_SESSION[New_user]','$date','$time','$ip_addr')";

if($conn -> query($login_his) == TRUE){
    //DO NOTHING 
    
    
}else{
    
    ///No need to throw error,you can report error to you mail address//
    
    echo $conn -> error;
    
}



?>