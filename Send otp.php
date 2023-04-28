<?php


require_once __DIR__.("/sessionPage.php");


if(!isset($_SESSION["New_user"])){

header("Location: Login.php");
exit;


}



if($_SERVER["REQUEST_METHOD"] == "POST"){


    require_once __DIR__.("/db_connection.php");


    $date = date("Y-m-d H:i:s");

    $time = date("H:i:s");

    $otp = rand(38495,28349);


    $insert = "INSERT INTO  Change_password_otp(User_id,Otp,Time_id,Date_id)
    
    VALUES('$_SESSION[New_user]','$otp','$time','$date')
    ";


if ($conn -> query ($insert) == TRUE){


//SEND OTP TO EMAIL//

$to = $user["Email"]; 
$from = 'Lazerwave'; 
$fromName = 'Verification otp'; 
 
$subject = "Email verification otp"; 
 
$htmlContent = '
        <h1>Lazerwave</h1>';
        
        $htmlContent .='
        
        <p>Hello '. $user["Surname"]
        
        .',</p>';
    
    
    $htmlContent .='<p>Your otp is :'
.   ' '.$otp .'</p>';
 
 
 $htmlContent .='<p>Please do not share this code with anyone. <b>Note</b> Otp will expire in 10 minutes</p>';
 
// Set content-type header for sending HTML email 
$headers = "MIME-Version: 1.0" . "\r\n"; 
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
 
// Additional headers 
$headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 
//$headers .= 'Cc: welcome@example.com' . "\r\n"; 
//$headers .= 'Bcc: welcome2@example.com' . "\r\n"; 
 
// Send email 
if(mail($to, $subject, $htmlContent, $headers)){ 
    
    $message_status ="Otp has been sent successfully";
    
    require_once __DIR__.("/success.php");
    
   // echo 'Email has sent successfully.'; 
}else{ 
    
    $message_status ="Error,An unknown  error has occur,please try again later";
    
    require_once __DIR__.("/Failed.php");
  // echo 'Email sending failed.'; 
}





    //$message_status = "Otp has been sent,Please check oyur mail.";
    
    
        //require_once __DIR__.("/success.php");

    //echo json_decode($otp);
}
else{
    $message_status = "error has occur,Please try again later.";
    
    
    require_once __DIR__.("/Failed.php");



}




}/*else{


    echo "This page does not supprot get request";
}*/

?>
