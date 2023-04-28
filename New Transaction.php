<?php

require_once "sessionPage.php";




?>
<!DOCTYPE html>
<html lang="eng_US">
  <head>
    <link rel="stylesheet" href="">
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width,initial-scale=1.0">
 <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
         

<script src="https://kit.fontawesome.com/958aace4f6.js" crossorigin="anonymous"></script>

<!--ajax and jquery link -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<script src= "https://code.jquery.com/jquery-3.5.0.js"></script>

<!-- end of ajax link--> 


<link href="https://fonts.googleapis.com/css2?family=Encode+Sans:wght@300&family=Island+Moments&family=Oswald:wght@200&family=PT+Serif:wght@700&family=Roboto+Mono:wght@100&display=swap" rel="stylesheet">

<title>Transaction History</title>
</head>
<body>
<?php

require_once "Network.php";

require_once "Loader.php";

?>


<div class="notification-header">
<i class="fa fa-cancel" onclick="window.history.back()"></i>


<!--i class="fa fa-envelope"></i-->

<div class="notification">

<?php 

require_once "db_connection.php";


$not = "SELECT * FROM Transaction_history WHERE User_id ='$_SESSION[New_user]'";


$not_result = $conn -> query($not);


if($not_result -> num_rows > 0){

$total_not = mysqli_num_rows($not_result);



echo "<span>Total</span>
  <span class='badge'>$total_not</span><br><br></div>
  ";


}else{

echo " <span>Total</span>
  <span class='badge'>0</span><br><br></div>
  ";


}


?>

<br>
<br>

<h4 style="text-align: center;color: #666">Transaction history <i class="fa fa-database" style="color: skyblue"></i></h4>

<p onclick="alert('Failed')" class="refresh_notification">Refresh 
<i class="fa fa-refresh" ></i></p>



  
</div>


<?php


require_once "db_connection.php";

$not_data = "SELECT * FROM Transaction_history WHERE User_id ='$_SESSION[New_user]' ORDER BY id DESC";

$not_data_result = $conn -> query($not_data);


if($not_data_result -> num_rows > 0){
while($not_result = $not_data_result -> fetch_assoc()){

//$date ="";




if($not_result["Remark"] == "+ Credit"){

$remark = "style='color:mediumseagreen;'";


}else if($not_result["Remark"] == "- Debit"){

$remark ="style='color:red'";


}else{

$remark = "style='color: grey'";



}


if($not_result["Status_remark"] == "Successful"){


//$gggg= "";
$remark_color ="style='float: left; color: mediumseagreen'";


}else{


$remark_color ="style='float: left
;color: red'";


}


if($not_result["Sender_account_no"] == "MTN"){
    
    $network_image = "/images/Mtn.jpeg";
    
}else if ($not_result["Sender_account_no"] == "AIRTEL"){
    
    
    $network_image = "/images/Airtel.jpeg";
}else{
    
    if($not_result["Sender_account_no"] == "GLO"){
        
        
        $network_image = "/images/Glo.jpeg";
    }else  if($not_result["Sender_account_no"] == "9MOBILE"){
            
            $network_image ="/images/9mobile.jpeg";
        }else{
            
            $network_image ="";
        }
        
    
    
    
    
}



if($not_result["Time_id"] > 12){
    
    $time = " ". $not_result["Time_id"] ."PM";
    
    
}else{
    
    $time =" ".$not_result["Time_id"]. "AM";
}




$not_date = date("F d Y",strtotime($not_result["Date_id"])).$time;




if ($not_result["Type"] == "Transfer"){
$not_amount = "₦". number_format($not_result["Amount"]) .".00";


echo "


<div class='notifications-container'>

<p>$not_date </p>

<p><i class='fa fa-circle'$remark></i> </p>
<p>Transfer to $not_result[Bank] <i class='fa fa-bank'></i></p>

<b $remark> <br>$not_result[Remark]<br>$not_amount </b>


<p>$not_result[Type]<br>$not_result[Type_name]</p>

<b $remark_color>$not_result[Status_remark]</b>

<p><a href='ViewTransaction?transaction=$not_result[Transaction_id]'>View</a></p>

<br>
<br>
</div>
";


}else if ($not_result["Type"] == "Money Request"){
$not_amount = "₦". number_format($not_result["Amount"]) .".00";

echo "


<div class='notifications-container'>

<p>$not_date </p>

<p><i class='fa fa-circle'$remark></i> </p>
<p>Money Request <i class='fa fa-money'></i></p>

<b $remark> <br>$not_result[Remark]<br>$not_amount </b>


<p>$not_result[Type]<br>$not_result[Type_name]</p>

<b $remark_color>$not_result[Status_remark]</b>

<p><a href='ViewTransaction?transaction=$not_result[Transaction_id]'>View</a></p>

<br>
<br>
</div>
";


}else{
/*
$not_amount = "₦". number_format($not_result["Amount"]) .".00";

if($not_result["Type"] == "Credit"){

echo "


<div class='notifications-container'>

<p>$not_date </p>

<p><i class='fa fa-circle'$remark></i> </p>
<p>Transfer to $not_result['Bank'] <br> Money Request</p>

<b $remark> <br>$not_result["Remark"]<br>$not_amount </b>


<p>$not_result["Type"]<br>$not_result['Type_name']</p>

<b $remark_color>$not_type["Status_remark"]</b>

<p><a href='View notification?id=$not_result[id]'>View</a></p>

<br>
<br>
</div>
";
*/


if($not_result["Type"] == "Airtime purchase"){
    
$not_amount = "₦". number_format($not_result["Amount"]) .".00";


echo "


<div class='notifications-container'>

<p>$not_date </p>

<p><i class='fa fa-circle'$remark></i> </p>
<p>Airtime Top Up $not_result[Sender_account_no] <i class='fa fa-phone' style='color: skyblue'></i></p>

<b $remark> <br>$not_result[Remark]<br>$not_amount </b>


<p><img src='$network_image' width='70px'><br>$not_result[Type_name]</p>

<b $remark_color>$not_result[Status_remark]</b>

<p><a href='ViewTransaction?transaction=$not_result[Transaction_id]'>View</a></p>

<br>
<br>
</div>
";


}else if
($not_result["Type"] == "Data purchase"){

 $not_amount = "₦". number_format($not_result["Amount"]) .".00";
 
echo "


<div class='notifications-container'>

<p>$not_date </p>

<p><i class='fa fa-circle'$remark></i> </p>
<p>Data purchase $not_result[Sender_account_no] <i class='fa fa-wifi' style='color: skyblue'></i> </p>

<b $remark> <br>$not_result[Remark]<br>$not_amount </b>


<p><img src='$network_image' width='70px'><br>$not_result[Type_name]</p>

<b $remark_color>$not_result[Status_remark]</b>

<p><a href='ViewTransaction?transaction=$not_result[Transaction_id]'>View</a></p>

<br>
<br>
</div>
";







}else{
    
    
if($not_result["Type"] == "Account Statement"){

$not_amount = "₦". number_format($not_result["Amount"]) .".00";

echo "


<div class='notifications-container'>

<p>$not_date </p>

<p><i class='fa fa-circle'$remark></i> </p>
<p>ACCOUNT STATEMENT</p>

<b $remark> <br>$not_result[Remark]<br>$not_amount </b>


<p>$not_result[Type]<br>$not_result[Type_name]</p>

<b $remark_color>$not_result[Status_remark]</b>

<p><a href='ViewTransaction?transaction=$not_result[Transaction_id]'>View</a></p>

<br>
<br>
</div>
";










}else 
if
($not_result["Type"] == "Referal"){

$not_amount = "₦". number_format($not_result["Amount"]) .".00";

echo "


<div class='notifications-container'>

<p>$not_date </p>

<p><i class='fa fa-circle'$remark></i> </p>
<p>Referal Bonus <i class='fa fa-trophy' style='color: gold;'></i></p>

<b $remark> <br>$not_result[Remark]<br>$not_amount </b>


<p>$not_result[Type]<br>$not_result[Type_name]</p>

<b $remark_color>$not_result[Status_remark]</b>

<p><a href='ViewTransaction?transaction=$not_result[Transaction_id]'>View</a></p>

<br>
<br>
</div>
";


}else{


echo "


<div class='notifications-container'>

<p>$not_date </p>

<p><i class='fa fa-circle'$remark></i> </p>
<p>Transfer to Bank <i class='fa fa-bank'></i></p>

<b $remark> <br>$not_result[Remark]<br>$not_amount </b>


<p>$not_result[Type]<br>$not_result[Type_name]</p>

<b $remark_color>$not_type[Status_remark]</b>

<p><a href='ViewTransaction?transaction=$not_result[Transaction_id]'>View</a></p>

<br>
<br>
</div>
";

}





}






}}



}else{


echo "<br><p style='text-align: center;color: #666;'>No Transaction</p>";


}

?>

</div>

</div>





<style>
body {
 /* font-family: Arial, Helvetica, sans-serif;*/
  font-size: 15px;
  background-color: white;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    
    font-weight: lighter;
  
}
.notification-header{

padding: 12px 12px;
margin-bottom: 29px;

}
/*
.Notification-container-overlay{

position: fixed;
width: 0%;
height: 100%;

overflow-y: scroll;
left: 0;
right: 0;
top: 0;
bottom: 0;
background-color: pink;
}*/

.notification-header i{

font-size: 20px;
margin-top: 7px;

}

.refresh_notification {
  padding: 10px 10px;
  margin: auto;
  text-align: center;
  color: white;
  background-color: skyblue;
  width: 30%;
  border-radius: 2rem;
  font-size: 15px;
  margin-top: 15px;
  }
  .refresh_notification i{
  font-size: 15px;
  
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

.Dark-mode{
    color: white;
    
    background-color: black;
}
.Dark-mode .notification{
    background-color: black;
    color: white;
}
.Dark-mode .notifications-container p:nth-child(1){
    
    color: white;
    background-color: rgb(0,0,56);
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
font-size: 20px;
}

.notifications-container p:nth-child(5) a:link{
    text-decoration: none;
    color: #555;
}
.notifications-container p:nth-child(5){
text-align: center;
color: #666;

}
.notifications-container p:nth-child(7){
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


function Checkmode(){

var current_mode = localStorage.getItem("Theme");

if(current_mode == "Dark-mode"){


var dark = document.body;

dark.classList.add("Dark-mode");


document.querySelector("#theme").checked= true;


}else{

var dark = document.body;

dark.classList.add("Light-mode");

document.querySelector("#theme").checked= false;




}


}

var mode = Checkmode();


</script>