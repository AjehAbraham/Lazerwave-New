<?php

//require_once "sessionPage.php";

//session_start();


if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

  header("Location: Warning.php");
  exit;

      header('HTTP/1.0 403 Forbiddden',TRUE,403);
      die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}

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

<!ajax and jquery link -
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<script src= "https://code.jquery.com/jquery-3.5.0.js"></script>

<!-- end of ajax link 


<link href="https://fonts.googleapis.com/css2?family=Encode+Sans:wght@300&family=Island+Moments&family=Oswald:wght@200&family=PT+Serif:wght@700&family=Roboto+Mono:wght@100&display=swap" rel="stylesheet">

<title>Notification</title>
</head>
<body-->



<div class="Notification-container-overlay">


<div class="notification-header">
<i  class="fa fa-cancel" onclick="close_notification()"></i>

<!--i class="fa fa-envelope"></i-->

<div class="notification">

<?php 

require_once "db_connection.php";


$not = "SELECT * FROM Notification WHERE User_id ='$_SESSION[New_user]'";


$not_result = $conn -> query($not);


if($not_result -> num_rows > 0){

$total_not = mysqli_num_rows($not_result);



echo "<span>Inbox</span>
  <span class='badge'>$total_not</span></div>
  ";


}else{

echo ' <span>Inbox</span>
  <span class="badge">0</span></div>
  ';


}


?>

<br>
<br>

<h4 style="text-align: center; color: #666">Notifications <i class="fa fa-bell-o" style="color: skyblue"></i></h4>
  
  <p  onclick="alert('Failed to refresh')" class="refresh_notification">Refresh <i class="fa fa-refresh"></i></p>
  
</div>


<?php


require_once "db_connection.php";

$not_data = "SELECT * FROM Notification WHERE User_id ='$_SESSION[New_user]' ORDER BY id DESC";

$not_data_result = $conn -> query($not_data);


if($not_data_result -> num_rows > 0){
while($not_result = $not_data_result -> fetch_assoc()){
    
    if($not_result["Status"] == "seen"){
        
        $seen_unseen = "style='color: mediumseagreen'";
        
    }else if($not_result["Status"] == "unseen"){
        
        
        $seen_unseen = "style='color: red;'";
    }else{
        
        
        $seen_unseen = "style='color: grey;'";
    }
    
    
    if($not_result["Time"] > 12){
        
        $ante = "PM";
        
    }else{
        
        $ante = "AM";
    }
    

$not_date = date('F d Y',strtotime($not_result['Date'])) ."  ".  $not_result["Time"].$ante;

$bal  = "₦". number_format($user["Account_balance"]);



if ($not_result["Type"] == "Transfer"){
$not_amount = "₦". number_format($not_result["Amount"]) .".00";


echo "


<div class='notifications-container'>

<p>$not_date </p>

<p><i class='fa fa-circle' $seen_unseen></i> </p>
<p>Transfer successful</p>

<b style='text-align: center'>$not_amount </b>

<p>$not_result[Message].Your account balance is $bal</p>
<p><a href='View notification?notify=$not_result[Notify_id]'>View</a></p>

<br>
<br>
</div>
";


}else if ($not_result["Type"] == "Money Request"){
$not_amount = "₦". number_format($not_result["Amount"]) .".00";

echo "

<div class='notifications-container'>

<p>$not_date </p>

<p><i class='fa fa-circle' $seen_unseen></i> </p>

<p>Money Request</p>

<b style='text-align: center'>$not_amount </b>

<p>$not_result[Message]<br></p>
<p><a href='View notification?notify=$not_result[Notify_id]&/money-Request'>View</a></p>

<br>
<br>
</div>";

}else{

$not_amount = "₦". number_format($not_result["Amount"]) .".00";

if($not_result["Type"] == "Credit"){

echo "

<div class='notifications-container'>

<p>$not_date </p>

<p><i class='fa fa-circle'$seen_unseen></i> </p>
<p>Credit Top Up</p>

<b style='text-align: center'>$not_amount </b>

<p>$not_result[Message].<br>Your new balance $bal. </p>
<p><a href='View notification?notify=$not_result[Notify_id]'>View</a></p>

<br>
<br>
</div>";


}else if($not_result["Type"] == "Airtime"){
$not_amount = "₦". number_format($not_result["Amount"]) .".00";


echo "

<div class='notifications-container'>

<p>$not_date </p>

<p><i class='fa fa-circle' $seen_unseen></i> </p>
<p>Airtime Top Up <i class='fa fa-phone' style='color: skyblue'></i></p>

<b style='text-align: center'>$not_amount </b>

<p>$not_result[Message].<br>Your new balance $bal.00 . </p>
<p><a href='View notification?notify=$not_result[Notify_id]'>View</a></p>

<br>
<br>
</div>";

}else{

 if($not_result["Type"] == "Data"){

 $not_amount = "₦". number_format($not_result["Amount"]) .".00";
 
echo "

<div class='notifications-container'>

<p>$not_date </p>

<p><i class='fa fa-circle'$seen_unseen></i> </p>
<p>Data Purchase <i class='fa fa-wifi' style='color: skyblue'></i></p>

<b style='text-align: center'>$not_amount </b>

<p>$not_result[Message].<br>Your new account balance is $bal.00 . </p>
<p><a href='View notification?notify=$not_result[Notify_id]'>View</a></p>

<br>
<br>
</div>";






}else if($not_result["Type"] == "ACCOUNT STATEMENT"){

$not_amount = "₦". number_format($not_result["Amount"]) .".00";

echo "

<div class='notifications-container'>

<p>$not_date </p>

<p><i class='fa fa-circle'$seen_unseen></i> </p>
<p>ACCOUNT STATEMENT</p>

<b style='text-align: center'>$not_amount </b>

<p>$not_result[Message]<br>Your new balance $bal. </p>
<p><a href='View notification?notify=$not_result[Notify_id]'>View</a></p>

<br>
<br>
</div>";









}else{

if
($not_result["Type"] == "Referal" or "Bonus"){

$not_amount = "₦". number_format($not_result["Amount"]) .".00";

echo "

<div class='notifications-container'>

<p>$not_date </p>

<p><i class='fa fa-circle' $seen_unseen></i> </p>
<p>Cupon Bonus</p>

<b style='text-align: center'>$not_amount </b>

<p>$not_result[Message].<br>Your new balance $bal </p>
<p><a href='View notification?notify=$not_result[Notify_id]'>View</a></p>

<br>
<br>
</div>";

}else{


echo "

<div class='notifications-container'>

<p>$not_date </p>

<p><i class='fa fa-circle'$seen_unseen></i> </p>
<p>$not_result[Type]</p>

<b style='text-align: center'> </b>

<p>$not_result[Message]</p>
<p><a href='View notification?notify=$not_result[Notify_id]'>View</a></p>

<br>
<br>
</div>";
}





}






}





}}
    
}else{


echo "<br><p style='text-align: center;color: #666;'>No Notification</p>";


}

?>

</div>

</div>



<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  font-size: 15px;
}
.notification-header{

padding: 12px 12px;
margin-bottom: 29px;

}
  .Dark-mode {
      
      background-color: black;
      color: white;
      }
    .Dark-mode .Notification-container-overlay{
    
    background-color: black;
    color: white;
    
    }
    .Dark-mode .notification-header i{
        color: white;
    }
    .Dark-mode .notifications-container p:nth-child(1){
        background-color: black;
        color: white;
        border-top: 3px solid rgb(0,9,56);
    }
.Notification-container-overlay{

position: fixed;
width: 0%;
height: 100%;

overflow-y: scroll;
left: 0;
right: 0;
top: 0;
bottom: 0;
background-color: white;
transition: 0.3s;
}

.notification-header i{

font-size: 20px;
margin-top: 7px;

}

.notification {
  background-color: #555;
  color: white;
  text-decoration: none;
  padding: 15px 15px;
  position: relative;
  display: inline-block;
  border-radius: 2px;
  float: right;
}

.notification:hover {
  background: red;
}

.notification .badge {
  position: absolute;
  top: -10px;
  right: -10px;
  padding: 5px 10px;
  border-radius: 50%;
  background-color: red;
  color: white;
}
  
  .refresh_notification {
  
  padding: 10px 10px;
  margin: auto;
text-align: center;
  color: white;
  background-color: skyblue;
  width: 30%;
  border-radius: 2rem;
  margin-top: 10px;
  font-size: 15px;
  }
  .refresh_notification i{
  
 font-size: 15px;
  }

.notifications-container{

padding: 10px 10px;/*
background-color: rgb(0,0,52);
color: white;*/
}


@media only screen and (min-width: 600px){
.notifications-container{
margin: auto;
width: 68%;
}
}
.notifications-container p:nth-child(5) a:link{
    
    text-decoration: none;
    color: #555;
}
.notifications-container p:nth-child(5) a:visited{
    color: #555;
}
.notifications-container a:link{

color: white;
text-decoration: none;
}
.notifications-container a:visited{

color: white;
text-decoration: none;
}

.notifications-container p:nth-child(1){
background-color: #f1f1f1;
color: #333;
padding: 10px 10px;
text-align: center;
}
.notifications-container p:nth-child(2){
/*
color: mediumseagreen;*/
font-size: 18px;
}

.notifications-container p:nth-child(3){
text-align: center;
}
.notifications-container b{
text-align: center;
margin-left: auto;
margin-right: auto;
display: block;
color: mediumseagreen;
}


.notifications-container p:nth-child(5){
text-align: center;
color: #555;

}
.notifications-container p:nth-child(6){
width: 45%;
padding: 10px 10px;
background-color: rgb(0,0,52);
color: white;
text-align: center;
float: right;
border-radius: 2rem;

}
.notifications-container  a:hover p:nth-child(6) {
background-color: red;
}

</style>

<script>

function open_notification(){


document.querySelector(".Notification-container-overlay").style.width="100%";


}

function close_notification(){


document.querySelector(".Notification-container-overlay").style.width="0%";


}
</script>