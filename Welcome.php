<?php 


 if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

  header("Location: Warning.php");
  exit;

      header('HTTP/1.0 403 Forbiddden',TRUE,403);
      die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}


$to = htmlspecialchars($_POST["email"]);
$from = 'Lazerwave';
$fromName = 'Lazerwavesupport'; 

$subject ="Welcome message from".$from;


$headers = "MIME-Version: 1.0" . "\r\n"; 
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
 
 
 
 $message ='<p style="padding: 8px 8px;color: white; margin: auto;text-align: center;background-color: rgb(0,0,100)">Lazerwave</p>';
 
 $message .='<h1 style="font-size: 15px;color: red;margin-left: 3px">Hello '. htmlspecialchars($_POST["surname"]) .',</h1>';
 
 
 $message .='<p style="text-align: center;font-size: 19px;">Welcome to lazerwave</p>';
 
 
 
   $message .='<p style="margin-right:3px">Welcome to lazerwave!We bring you lots of features that will improve your user experience as follows :<br>(1)Faster transactions with zero charges. <br>(2) Improved  UI/UX of our webite<br>(3) Created features that help you in sending and receving money through money request<br>(4) You can now create a username of your choice,which you can share with family and friends in other to send and receive money<br>(5) A live chat where you can ask question and get response instantly<br>(6) System uprade to improve our services to serve you better.Click <a href="https://lazerwave.000webhostapp.com/">here </a>to check it out.<p>';
    
    
    $message .='<p>Join us today!<p>';
    
    $message .='<h1 style="background-color: mediumseagreen;color: white;text-align: center;box-shadow: 0px 16px 8px 0px rgb(0,0,180); padding: 10px 10px;margin: auto; font-size: 18px;width: 90%;border-radius: 1rem">
    <p>Refer & Earn

</p>
    
    <p style="padding: 8px 8px;font-size: 23px;font-weight: bold;box-shadow: 0px 16px 8px 0px rgba(0,0,0,0.4)">₦1,000 bonus</p>
    
    <p>When you share with family and friends

<p>
    <p style="text-align: center;padding: 6px 6px;border-radius: 2rem;width: 70%;margin: auto;color: white;background-color: black;color: white;"><a href="https://lazerwave.000webhostapp.com/">Get started</a></p>
    </h1>';
    
 
 
 $mail = mail($to,$from,$message,$headers);
 
 
 if($mail == TRUE){
 
 //echo "mail sent succesfully";
 
 
 }else{
 
 echo "Failed";
 
 
 }
 ?>

     