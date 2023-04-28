<?php

//require_once __DIR__.("/sessionPage.php");
$to = $_SESSION["Email"];
$from = 'Lazerwave@gmail.com';
$fromName = 'Lazerwavesupport'; 

$headers = "MIME-Version: 1.0" . "\r\n"; 
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
$headers .= 'Bcc: lazerwave@gmail.com' . "\r\n"; 
$headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 

$subject ="Credit alert";


//$_SESSION["AMOUNT"] =
//number_format($_SESSION["AMOUNT"]) .".00";

//$_SESSIOM["Receiver_balance"] =
//number_format($_SESSION["Receiver_balance"]) .".00";


 
 $message ='<p style="background-color: rgb(0,0,100); color: white; text-align: center; padding: 7px 7px; font-size: 20px;margin: auto; width: 70%;">Lazerwave</p>';
 
 $message .='<h1 style="
 color: rgb(0,0,180); text-align: center; padding: 12px 12px; font-size: 25px;margin: auto; width: 90%;">Transaction Receipt
 
 </h1>
 
 <p style="text-align: center; color: green; font-size: 20px"> + Credit<p>
 
 <p style="text-align: center; color: green; font-size: 20px">₦'.number_format($_SESSION["AMOUNT"]).'.00</p>
 
 
 <p style="margin-left: 6px">Hello '. $_SESSION["Surname"].' ,<br>Here is the details of your transaction</p>';
 
 
 
 $message .='
 <div style="background-color: rgb(0,0,100); color: white; padding: 12px 12px; font-size: 18px;margin: auto; width: 95%;">
 
 <p style="text-align: center;margin-bottom: 10px;">Transaction Details</p>
 
 <p>Transaction ID <b style="float: right; font-weight: lighter">'. $transaction_id .'</b></p>
 <p>Date <b style="float: right; font-weight: lighter">'. $date.'</b>
 </p>
 
 <p>Time <b style="float: right; font-weight: lighter">'. $time .'</b></p>
 
 <p>Amount <b style="float: right; font-weight: lighter">₦'.number_format($_SESSION["AMOUNT"]) .'.00</b></p>
 <p>Available Balance	 <b style="float: right; font-weight: lighter">₦'.number_format($_SESSION["Receiver_balance"])
   .'.00</b></p>
   
   
   <p>Status<b style="float: right; font-weight: lighter;">'.$status.'</b></p>
 
 <p>Ip Address <b style="float: right; font-weight: lighter;">'. $ip_addr .'</b></p>';
 
 
$message .='</div>
 
 <p style="margin-left: 6px">If you have any question about this transaction,please send us an email through <a href="mailto:ajehabraham51@gamil.com">here</a> to send us a direct mail</p>';
 

 
 
 
 $mail = mail($to,$subject,$message,$headers);
 
 
 if($mail == TRUE){
 
 //echo "mail sent succesfully";
 
 
 }else{
 
 echo "Failed";
 
 
 }


?>

