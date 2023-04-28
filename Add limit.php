<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

  header("Location: Warning.php");
  exit;

      header('HTTP/1.0 403 Forbiddden',TRUE,403);
      die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}


$l_amount = "SELECT * FROM Account_limit WHERE User_id='$_SESSION[New_user]'";

$l_amunt = $conn -> query($l_amount) -> fetch_assoc();

//NOW UPDATE THE AMOUNT //

$lim = $l_amunt["Limit_amount"] + $amount;




$up_amunt = "UPDATE Account_limit SET Limit_amount ='$lim' WHERE User_id='$_SESSION[New_user]'";



if($conn -> query($up_amunt) == TRUE){
    
    
    //DO NOTHING
}else{
    
    $conn -> error;
    
    
}





?>

