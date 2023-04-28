<?php

require_once __DIR__.("/sessionPage.php");

require_once __DIR__.("/Network.php");

?>

<!DOCTYPE html>
<html lang="eng_US">
  <head>
    <link rel="stylesheet" href="Top up.css">
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width,initial-scale=1.0">
 <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
         

<script src="https://kit.fontawesome.com/958aace4f6.js" crossorigin="anonymous"></script>

<!-- ajax and jquery link -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<script src= "https://code.jquery.com/jquery-3.5.0.js"></script>

<!-- end of ajax link -->


<link href="https://fonts.googleapis.com/css2?family=Encode+Sans:wght@300&family=Island+Moments&family=Oswald:wght@200&family=PT+Serif:wght@700&family=Roboto+Mono:wght@100&display=swap" rel="stylesheet">

<title>Card top up</title>
</head>
<body>

<div class="top-nav">

<span class="material-symbols-outlined"onclick="window.history.back()" >arrow_back</span>

<a href="index">
<i class="fa fa-home"></i></a>

</div>



<div class="form-container">

<h1>Add credit card</h1>
<br>

<form id="formId" method="post">

<label="card no">Card number </label>
<br>

<input type="number" name="card_no" placeholder="XXXXXXXXXXXXXXX" inputmode="numeric">
<br>


<label="card no">Expiry date </label>
<br>

<input type="text" name="Exp" placeholder="XXXX" inputmode="numeric" maxlength="4">
<br>

<label="card no">Cvv </label>
<br>

<input type="text" name="cvv" placeholder="XXX"inputmode="numeric" style="-webkit-text-security:disc;" maxlength="3">
<br>

<label="card no">Pin </label>
<br>

<input type="text" name="Pin" placeholder="****" inputmode="numeric" style="-webkit-text-security:disc;" maxlength="4">
<br>

<input type="submit" id="submitButton"value="Add card">

</form>


</div>

<p class="error_message"></p>

<p style="text-align: center">Supported cards <i class="fa fa-flash" style="color: red"></i></p>

<div class="loader-overlay">
<div class="loader">
</div>
</div>


<script src="Top up.js"></script>

   



</body>
</html>
