<?php

//require_once __DIR__.("/sessionPage.php");

?>

<!--DOCTYPE html>
<html lang="eng_US">
  <head>
    <link rel="stylesheet" href="">
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width,initial-scale=1.0">
 <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
         

<script src="https://kit.fontawesome.com/958aace4f6.js" crossorigin="anonymous"></script>

<!-- ajax and jquery link -->
<!--script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<script src= "https://code.jquery.com/jquery-3.5.0.js"></script>

<!-- end of ajax link -->


<!--link href="https://fonts.googleapis.com/css2?family=Encode+Sans:wght@300&family=Island+Moments&family=Oswald:wght@200&family=PT+Serif:wght@700&family=Roboto+Mono:wght@100&display=swap" rel="stylesheet">

<title>Notification</title>
</head>
<body-->

<!--p onclick="openNotification()">Open notification</p-->
<div class="Notifications">

<div class="Notification-container">

<?php
/*
//CHECK TOTAL NUMBER OF NOTIFICATIONS

$select ="SELECT * FROM Notification WHERE User_id ='$_SESSION[New_user]'";


$notify = $conn -> query($select);



if ($notify -> num_rows > 0){

$_SESSION["total_notification"] = mysqli_num_rows($notify);

$result_notify = $notify -> fetch_assoc();



if($result_notify["Type"] == "Money Request"){


$_SESSION["Total_money_request"] = mysqli_num_rows($result_notify["Type"]);


}else{

$_SESSION["Total_money_request"] = 0;

}



}else{
$_SESSION["total_notification"]  = 0;


}
*/

?>

<p onclick="closeNotification()" style="color: red;margin-right: auto;margin-left: auto;display: block;text-align: center;padding :10px 10px;"><span class="material-symbols-outlined"style="color: red;margin-right: auto;margin-left: auto;display:block">close</i></p>

<!--p style="float: right;margin-left: auto;margin-right: auto;display: block;margin-bottom: 300px;">
    
<i class="fa fa-close"id="close-notification-btn"onclick="closeNotification()"style="margin-left:auto;margin-right: auto; display: block;"></i>
</p>
<br-->


<!--i class="fa fa-exchange"></i>
<?php //echo $_SESSION["Total_money_request"]; ?>



<i class="fa fa-envelope">
</i-->

</div>

<?php

$fetch_notification ="SELECT * FROM Notification WHERE User_id ='$_SESSION[New_user]' ORDER BY id DESC ";


$result_messages =$conn -> query($fetch_notification);



if($result_messages -> num_rows > 0)
{

while($messages = $result_messages -> fetch_assoc()){

//RECORD WAS FOUND NOW FETCH RECORD//


//NOW USE THE RECEIEVER ID TO SEARCH FOR USER NAME//

$Sender_details ="SELECT * FROM Register_db WHERE id='$messages[Receiver_id]'";

$sender_result = $conn -> query($Sender_details);

if($sender_result -> num_rows > 0){
//USER FOUND



while(
$sender = $sender_result -> fetch_assoc()){

//DISPLAY ALL THE DETAILS HERER//

$amount = number_format($messages["Amount"]);

echo "<div class='Notification-message'>

<a href='View notification.php?notify=$messages[Notify_id]'>
<p><b>$sender[Surname] $sender[Last_name] $sender[First_name]</b></p>

<p>$amount<br> $messages[Message]</p>
</a>
</div>";




}


}else{

//SENDER WAS NOT FOUND,NOW JUST DISPLAY WHATEVER NAME FOUND JUST INCASE ADMIN SEND USER A MESSAGE//

$sender = $messages["Receiver_id"];



}


}

//DISPLAY ALL THE RESULT FOUND ON DATABASE //








}else{


//NO MESSAGE/NOTIFICATION WAS FOUND//


echo "<p style='text-align:center;color:red'>No notification </p>";


}
?>





</div>

<style>
body{
    
    margin: 0;
    font-size: 15px;

    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    
    font-weight: lighter;
    background-color: #f1f1f1;
    
    
}
.Notifications{
width: 0%;
height: 100%;
position: fixed;
transition: 0.4s;
overflow-y: scroll;
transition: 0.4s;
background-color: #f1f1f1;
top: 0;
left: 0;
right: 0;
bottom: 0;
}
/*
.Notifications i{
font-size: 30px;
margin-left: 10px;
margin-top: 25px;
margin-bottom: 60px;
cursor: pointer;
color: red;

}*/

#close-notification-btn{
/*text-align: center;*/
color: red;
/*
margin-left: auto;
margin-right: auto;
display: block;*/
font-size: 22px;
cursor: pointer;
}
.Notification-message{
padding: 7px 7px;
background-color: rgba(255,0,0,0.1);
box-shadow: 0px 16px 8px 0px rgba(0,0,0,0.2);
border-top: 1px solid red;
margin-top: 10px;

}
.Notification-message p{
color: red;
}
.Notification-message p:nth-child(2){
font-size: 12px;
}
.Notification-message a:link{
text-decoration: none;
color: red;
}
.Notification-message a:visited{
color: red;
}

</style>


<script>
function openNotification(){

document.querySelector(".Notifications").style.width="100%";


}
function closeNotification(){

document.querySelector(".Notifications").style.width="0%";

}
</script>

</body>
</html>