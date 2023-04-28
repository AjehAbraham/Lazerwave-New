<?php require_once __DIR__.("/sessionPage.php");



if (!isset($_SESSION["New_user"])){
      header("location: Login.php");
      exit;
    }
require_once __DIR__.("/Network.php");

?>

<script>
     
if(window.history.replaceState){

window.history.replaceState(null,null,window.location.href);

}
    </script>

<!DOCTYPE html>
<html lang="eng_US">
  <head>
    <link rel="stylesheet" href="VirtualCard.css">
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width,initial-scale=1.0">
          <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
         
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.debug.js"></script>
<link rel="preconnect" href="https://fonts.googleapis.com"> 
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
<link href="https://fonts.googleapis.com/css2?family=Encode+Sans:wght@300&family=Island+Moments&family=Oswald:wght@200&family=PT+Serif:wght@700&family=Roboto+Mono:wght@100&display=swap" rel="stylesheet">


<script src="https://kit.fontawesome.com/958aace4f6.js" crossorigin="anonymous"></script>
<title>VirtualCard</title>


<!-- ajax and jquery link -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<script src= "https://code.jquery.com/jquery-3.5.0.js"></script>

<!-- end of ajax link -->


      </head>
      <body>
      
          
        <span class="material-symbols-outlined" onclick="window.history.back()">arrow_back</span>
         
        <a href="index.php"><i class="fa fa-home"style="float:right;font-size:15px;margin-top:1px"></i>
         </a> 

         <?php 
         require_once __DIR__.("/logo.php")
?>         

      <div class="virtual-card-container">

<h1>Virtual Card</h1>


<p>Please enter a 4 digit secret pin for your virtual card</p>

<label for="pin">Pin</label>
<br>

<form method="post" id="formId">
<input type="number" name="pin"
inputmode="numeric" style="-webkit-text-security:disc;" maxlength="4">

<p>Note you will be charge a fee of ₦1,000 for this service.</p>


<p class="open-tarnsaction-btn" >Validate</p>


    
<div class="Transaction-pin-container-overlay">

<div class="transaction-pin-container">
    <p class="close-transaction_pin"> <i class="fa fa-close"></i></p>

    <p>Enter your transaction pin</p>
<input type="number" name="transaction-pin" placeholder="Enter your transaction pin..."
inputmode="numeric" style="-webkit-text-security:disc;" maxlength="4">

<br>


<p class="error_message"></p>

<input type="submit" id="submitButton" value="Request">


<div class="loader-overlay">
<div class="loader-message">
</div>
</div>




</div>
</div>


<script src="VirtualCard.js"></script>

</body>
</html>



