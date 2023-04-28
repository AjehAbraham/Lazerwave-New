<?php


if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

      header('HTTP/1.0 403 Forbiddden',TRUE,403);
      die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}?>

<!DOCTYPE html>
<html lang="eng_US">
  <head>
    <link rel="stylesheet" href="">
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
<title>Error</title>
      </head>
      <body>



      <div class="erro-message-container">

<h3><?php echo $erro ?> </h3>


<p class="close-message-btn">Ok</p>

</div>


<style>
.erro-message-container{
    margin-top: 25px;
    padding: 20px 20px;
    background-color: white;
    box-shadow: 0px 16px 8px 0px rgba(0,0,0,0.2);
    text-align:center;
    border-top: 2px solid rgb(0,0,180);
    margin-left:auto;
    margin-right: auto;
    width: 70%;
    transition: 0.8s;
    overflow:hidden;
    
}
.erro-message-container p{
    padding:10px 10px;
    text-align:center;
    background-color: #f1f1f1;
    color:rgb(0,0,180);
    border: 3px solid rgb(0,0,180);
    margin-left:auto;
    margin-right: auto;
    display: block;
}
.erro-message-container h3{
    text-align: center;
    color: rgb(0,52,102);
}
    </style>
    <script>

document.querySelector(".close-message-btn").addEventListener("click",closePop_up);

function closePop_up(){
    document.querySelector(".erro-message-container").style.width ="0%";
    document.querySelector(".erro-message-container").style.height ="0%";
    document.querySelector(".erro-message-container").style.left ="0%";
    document.querySelector(".erro-message-container").style.right ="0%";
    document.querySelector(".erro-message-container").style.top ="0%";
    document.querySelector(".erro-message-container").style.bottom ="0%";

}

        </script>