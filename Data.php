<?php 
require_once __DIR__.("/sessionPage.php");


if (!isset($_SESSION["New_user"])){
    header("location:login.php");
    exit;
}

echo "<title>Data Purchase</title>";


require_once __DIR__.("/Network.php");

?>


<!DOCTYPE html>
<html lang="eng_US">
  <head>
    <link rel="stylesheet" href="Data.css">
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
<title>Data purchase</title>



<!-- ajax and jquery link -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<script src= "https://code.jquery.com/jquery-3.5.0.js"></script>

<!-- end of ajax link -->


      </head>
      <body>
 

         
      <span class="material-symbols-outlined" onclick="window.history.back(-3)">arrow_back</span>
         
      <a href="index.php"><i class="fa fa-home"style="float:right;font-size:15px;margin-top:1px"></i>
       </a> 


     <?php include __DIR__.("/logo.php"); ?>


       


<div class="data-container">
<span class="material-symbols-outlined">done</span>

<h1>Data Purchase</h1>


<form method="post"  id="formId">
 <label for="phone-number"><b>Phone number:</b></label>
 <br>
 <input type="tel" name="phone-number" pattern="[7-9]{1}[0-9]{9}" value="<?php echo isset($_POST['phone-number']) ?  $_POST['phone-number'] : '' ?>">

 <br>

 <label for="provider"><b>Network:</b></label>
 <br>
 <select name="netwok-provider"  >
     <option><?php echo isset($_POST['netwok-provider']) ? $_POST['netwok-provider'] : '' ?></option>

     <option>MTN</option>
     
     <option>AIRTEL</option>
     
     <option>GLO</option>
     
     <option>9MOBILE</option>


     </select>

<br>
     <label for="plan"><b>Plan:</b></label>
     <br>
     <select name="plan" >
     <option><?php/* echo  isset($_POST['plan']) ? $_POST['plan'] : ''*/?></option>
     <option value="50">₦50(40Mb)1day</option>
      <option value="100">₦100(10Mb)1day</option>
       <option value="300">₦300(350Mb)1day</option>
        <option value="350">₦350(1Gb)1day</option>
         <option value="500">₦500(2.5Gb)2days</option>
          <option value="500">₦500(750Mb)1week</option>
          <option value="1500">₦1,500(6Gb)1week</option>
           <option value="1000">₦1,000(1Gb)1month</option>
            <option value="1200">₦1,200(1.5Gb)1month</option>
             <option value="1500">₦1,500(2Gb)1month</option>
              <option value="2000">₦2,000(6Gb)1month</option>
              
<!--option>₦3,500(10Gb)1month</option>
<option>₦5,000(15Gb)1month</option>
<option>₦10,000(32Gb)1month</option>
<option>₦15,000(45Gb)2month</option>
<option>₦100,000(100Gb)2month</option-->
       </select>

       <br>


     <p class="open-tarnsaction-btn">Validate</p>
       


    
     <div class="Transaction-pin-container-overlay">

<div class="transaction-pin-container">
    <p class="close-transaction_pin"> <i class="fa fa-close"></i></p>

    <p>Enter your transaction pin</p>
<input type="number" name="transaction-pin" placeholder="Enter your transaction pin..."
inputmode="numeric" style="-webkit-text-security:disc;" maxlength="4">

<br>

<p class="error_message"></p>

<input type="submit" id="submitButton" value="Pay">

<div class="loader-overlay">
<div class="loader-message">
</div>
</div>






</div>
</div>

       </form>
  </div>

      <script src="Data.js"></script>
    
  </body>
  </html>