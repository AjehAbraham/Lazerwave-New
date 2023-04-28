<?php

session_start();
if(!isset($_SESSION["New_user"])){
    
    

session_regenerate_id();
}

require_once "Daily visitors.php";

?>



<!DOCTYPE html>
<html lang="eng_US">
  <head>
    <link rel="stylesheet" href="New payment.css">
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width,initial-scale=1.0">
 <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
         

<script src="https://kit.fontawesome.com/958aace4f6.js" crossorigin="anonymous"></script>

<!--ajax and jquery link -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<script src= "https://code.jquery.com/jquery-3.5.0.js"></script>

<!-- end of ajax link -->


<link href="https://fonts.googleapis.com/css2?family=Encode+Sans:wght@300&family=Island+Moments&family=Oswald:wght@200&family=PT+Serif:wght@700&family=Roboto+Mono:wght@100&display=swap" rel="stylesheet">


<link href="https://fonts.googleapis.com/css2?family=Tilt+Prism&display=swap" rel="stylesheet">




<title>Payment Gateway</title>
</head>
<body>
    
    
<noscript>

<div class="nonscript">

<p><i class="fa fa-cancel" style="color: red"></i> Javascript has been turn off,please enable javascript to enable cookies,javascript </p>
</div>

<style>
.nonscript{

background-color: black;
color: white;
position: fixed;
font-size: 22px;
left: 0;
top: 0;
bottom: 0;
right: 0;
text-align: center;
}
</style>
</noscript>


<?php

require_once "Loader.php";

require_once "Network.php";

//require_once "logo.php";

$name = $_GET["name"];


//echo $name;

if($_SERVER["REQUEST_METHOD"] == "GET"){
    
    //echo $_GET["name"];
    
  //  echo $_GET["id"];
  //  die();



$link_hash = $id ="";
 
 if(isset($_GET["name"])){
     
  //   $_SESSION["Link_details"] = //$_GET["name"];
 
 if(isset($_GET["id"])){
 
 
 
 $link_hash = htmlspecialchars($_GET["name"]);
 
 $id = (int) filter_var($_GET["id"],FILTER_VALIDATE_INT);
 
 $id = htmlspecialchars($id);
 
 
 if(empty($id)){
 
 
 
 $message_status ="Error proccessing your link.";
 
 require_once "Failed.php";
 
 die();
 
 
 
 }
 
 
 
 require_once "db_connection.php";
 
 //NOW CHECK FOR LINK AND SEE IF IT A VALID LINK OR NOT//
 
 //CHECK IF ID IS PRESENT TO SEE IF LINK WILL MATCH ESLE TRY THE OTHER METJOD//
 
 
 
 $link ="SELECT * FROM Payment_link_table WHERE Hash_link='$link_hash' AND User_id='$id'";
 
 
 $result = $conn -> query($link);
 
 
 if($result -> num_rows > 0){
 
 //RESULT WAS FOUND //
 
 
  $link_result = $result -> fetch_assoc();
  
  
  $_SESSION["Link_details"] = $link_result["Hash_link"];
  
 
// $link_result = $result -> fetch_assoc();
 
 
 
 //NOW USE LINK USE LINK DETAILS TO FETCH USER NAME//
 
 
 $user_details = "SELECT * FROM Register_db WHERE id ='$link_result[User_id]'";
 
 
 $details = $conn -> query($user_details) -> fetch_assoc();
 
 if(empty($link_result["Image_path"])){
 
 
 $link_image = "/Uploads/null-profile.jpeg";
 
 
 
 }else{
 
 
 $link_image = "/Link images/".$link_result["Image_path"];
 
 }
 
 
 $_SESSION["AMOUNT"] = $link_result["Amount"];
 
 $_SESSION["Amount"] = $link_result["Amount"];
 
 
 $amount = "₦". number_format($link_result["Amount"]). ".00";
 
 $full_name = $details["Surname"]. " ". $details["Last_name"]. " ". $details["First_name"];
 
 
 echo "


<div class='form-container'>
<p>
<a href='index'>

<i class='fa fa-home'></i></a></p>

";
/*
require_once "Network.php";

require_once "logo.php";*/

echo "



<h2>Payment Gateway</h2>

<p>$full_name </p>


<p>$amount</p>

<p><img src='$link_image'></p>

<p><b>$link_result[Title]</b><br>$link_result[Link_message]</p>

<form method='post' id='formId'>

<label for='name'><b>Amount</b>
</label>
<br>

<input type='text'inputmode='numeric' maxlength='15 'value='$amount' name='Amount' disabled>
<br>

<label for='name'><b>Card number</b>

</label>

<br>
<input type='text'inputmode='numeric' maxlength='15' name='card_no' oninput='validate_card_no()' placeholder='XXXXXXXXXXXXXX'>
<b style='color: #666;' class='card_error_message'></b><br>

<br>

<label for='name'><b>Expiry Date</b>

</label>

<br>
<input type='text'inputmode='numeric' maxlength='4' name='Exp'placeholder='Expiry year e.g(2023)'>

<br>


<label for='name'><b>CVV</b>

</label>

<br>
<input type='text'inputmode='numeric' maxlength='3' name='cvv' autofocus='off'placeholder='XXX'>

<br>

<label for='name'><b>Card Pin</b>

</label>

<br>
<input type='text'inputmode='numeric' maxlength='4' name='pin' style='-webkit-text-security:disc;' placeholder='XXXX'>

<br>

<input type='submit' value='Validate' onclick='validate_form(event)'>
<p class='error_message'></p>

<br>


</form>

<p>Supported card <i class='fa fa-flash'></i>

<p>Powered by <span class='material-symbols-outlined'> filter_list</span></p>


</div>
 
 
 ";
 
   
 
 
 
 
 }else{
 
 
 //NO RESULT WAS FOUND
 
 
 
 $message_status ="No match found for link";
 
 require_once "Failed.php";
 
 die();
 
 
 
 }
 
 
 
 
 
 }else{
 
 
 
 $link_hash = htmlspecialchars($_GET["name"]);
 
 
 
 require_once "db_connection.php";
 
 //NOW CHECK FOR LINK AND SEE IF IT A VALID LINK OR NOT//
 
 
 
 $link ="SELECT * FROM Payment_link_table WHERE Hash_link='$link_hash'";
 
 
 $result = $conn -> query($link);
 
 
 if($result -> num_rows > 0){
 
 //RESULT WAS FOUND //
 
 $link_result = $result -> fetch_assoc();
 
 $_SESSION["Link_details"] = $link_result["Hash_link"];
 
 
 //NOW USE LINK USE LINK DETAILS TO FETCH USER NAME//
 
 
 $user_details = "SELECT * FROM Register_db WHERE id ='$link_result[User_id]'";
 
 
 $details = $conn -> query($user_details) -> fetch_assoc();
 
 if(empty($link_result["Image_path"])){
 
 
 $link_image = "/Uploads/null-profile.jpeg";
 
 
 
 }else{
 
 
 $link_image = "/Link Images/".$link_result["Image_path"];
 
 }
 
 
 $_SESSION["AMOUNT"] = $link_result["Amount"];
 
 $_SESSION["Amount"] = $link_result["Amount"];
 
 
 $amount = "₦". number_format($link_result["Amount"]). ".00";
 
 $full_name = $details["Surname"]. " ". $details["Last_name"]. " ". $details["First_name"];
 
 
 echo "


<div class='form-container'>
<p>
<a href='index'>

<i class='fa fa-home'></i></a></p>


";
/*

require_once "Network.php";

require_once "logo.php";*/

//require_once "Livechat.php";

echo "



<h2>Payment Gateway</h2>

<p>$full_name </p>


<p>$amount</p>

<p><img src='$link_image'></p>

<p><b>$link_result[Title]</b><br>$link_result[Link_message]</p>

<form method='post' id='formId'>

<label for='name'><b>Amount</b>
</label>
<br>

<input type='text'inputmode='numeric' maxlength='15 'value='$amount' name='Amount' disabled>
<br>

<label for='name'><b>Card number</b>

</label>

<br>
<input type='text'inputmode='numeric' maxlength='15' name='card_no' oninput='validate_card_no()' placeholder='XXXXXXXXXXXXXXX'>
<b style='color: #666' class='card_error_message'></b><br>

<br>

<label for='name'><b>Expiry Date</b>

</label>

<br>
<input type='text'inputmode='numeric' maxlength='4' name='Exp' placeholder='Expiry year e.g(2023)'>

<br>


<label for='name'><b>CVV</b>

</label>

<br>
<input type='text'inputmode='numeric' maxlength='3' name='cvv' autofocus='off' placeholder='XXX'>

<br>

<label for='name'><b>Card Pin</b>

</label>

<br>
<input type='text'inputmode='numeric' maxlength='4' name='pin' style='-webkit-text-security:disc;' placeholder='XXXX'>

<br>

<input type='submit' value='Validate' onclick='validate_form(event)'>

<p class='error_message'></p>


</form>

<p>Supported card <i class='fa fa-flash'></i>

<p>Powered by <span class='material-symbols-outlined'> filter_list</span></p>


</div>
 
 
 ";
 
 
 
 
 
 
 
 }else{
 
 
 //NO RESULT WAS FOUND
 
 $message_status ="No match found for link";
 
 require_once "Failed.php";
 
 die();
 
 
 
 }
 
 
 
 
 
 
 
 
 }
 
 
 
 
 
 
 
 }else{
     
     //NOW CHECK IF LINK IS AUTO GENERATED//
 
 
 $message_status ="Invalid link,link appear to have beem broken";
 
 require_once "Failed.php";
 die();
 
 
 
 }







}

//require_once "Livechat.php";

echo "<br><br>"


?>



<div class="loader-overlay">
<div class="loader-message"></div>
</div>




<script src="New payment.js"></script>

<?php

//require_once "Bolt.php";


//require_once "Livechat.php";

require_once "footer.php"

?>