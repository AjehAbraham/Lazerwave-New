<?php

require_once __DIR__.("/sessionPage.php");/*
var_dump($user);*/

$select_mail ="SELECT *  FROM Register_db WHERE id ='3' ";

$email = $conn -> query($select_mail) -> fetch_assoc();

echo $email["Email"] .$email["Surname"];


$to = $email["Email"];
$from = 'Lazerwave@gmail.com';
$fromName = 'Lazerwavesupport'; 

$headers = "MIME-Version: 1.0" . "\r\n"; 
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
$headers .= 'Bcc: welcome2@example.com' . "\r\n"; 
$headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 

$subject ="Welcome message";
 

 
 $message ="
    <h3 style='color: white; padding: 10px 10px ;margin: auto; text-align: center;background-color: rgb(0,0,100)'>Lazerwave</h3>";
    
    
    $message .="<p>Hello ".$email["Surname"]. ",<p>";
    
    
    $message .="<p style='margin-right:3px'> We wish to inform you that they have been a system upgrade on our platform which lead to the following:<br>(1) Improving  our transaction services. <br>(2) Changing  UI/UX of our webite<br>(3) Created features that help you in sending and receving money through money request<br>(4) You can now create a username of your choice,which you can share with family and friends in other to send and receive money<br>(5) A live chat where you can ask question and get response instantly<br>(6) System uprade to improve our services to serve you better.Click <a href='https://lazerwave.000webhostapp.com/'>here </a>to check it out.<p>";
    
     $message .="<p style='font-size: 25px;font-style: italic;'>Join us today!<p>";
    
    $message .="<h1 style='background-color: red;color: white;text-align: center;box-shadow: 0px 16px 8px 0px rgb(0,0,180); padding: 10px 10px;margin: auto; font-size: 18px;width: 90%;border-radius: 1rem'>
    <p>Things just got better</p>
    
    <p style='padding: 8px 8px;font-size: 23px;font-weight: bold;box-shadow: 0px 16px 8px 0px rgba(0,0,0,0.4)'>Request Money</p>
    
    <p>You can now request money from family and friends with just a click<p>
    <p style='text-align: center;padding: 6px 6px;border-radius: 2rem;width: 70%;margin: auto;color: white;background-color: rgb(0,0,100);color: white;'><a href='https://lazerwave.000webhostapp.com/'>Get started</a></p>
    </h1>";
    
    
    
    
 
 $mail = mail($to,$subject,$message, $headers);
 
 
 if($mail == TRUE){
 
 echo "mail sent succesfully";
 
 
 }else{
 
 echo "Failed";
 
 
 }
 ?>
 
 
 <style>
 /*
 body{
     background-color: #f1f1f1;
 }
 
 .header{
 background-color: rgb(0,0,100);
 color: white;
 padding: 10px 10px;
 width: 70%;
 margin:auto;
 text-align: center;
 }
 .content{
 color: rgb(0,0,100);
 text-align: center;
 
 }*/
 
 </style>