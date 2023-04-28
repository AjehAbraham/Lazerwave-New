<?php
//require_once __DIR__.("/Network.php");
/*
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

      header('HTTP/1.0 403 Forbiddden',TRUE,403);
      die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}*/

if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

  header("Location: Warning.php");
  exit;

      header('HTTP/1.0 403 Forbiddden',TRUE,403);
      die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}

?>



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
<title>Status</title>
      </head>
      <body>


      <div class="Confirmation-status-container">

     <h1><?php echo $logo_status ?></h1>

      <p><?php echo $message_status ?></p>

<p onclick="closeStatus()">OK</p>
</div>

<style>  
.Confirmation-status-container{
    position: fixed;
    z-index: 2;
width:  100%;
height: 100%;
left: 0;
right: 0;
top: 0;
bottom: 0;
background-color: white;
}
.Confirmation-status-container p{
text-align: center;

font-size: 30px;

}

.Confirmation-status-container p:last-child{
    text-align: center;
    padding: 10px 10px;
    border: 3px solid rgb(0,0,180);
    font-weight: lighter;
    width: 50%;
    margin-left: auto;
    margin-right: auto;
font-size: 20px;
border-radius: 2rem;
cursor: pointer;
background-color: lightblue;
color: white;

}
.Confirmation-status-container i{
    font-size: 40px;
    background-color: red;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    color: rgb(0,52,102);
    
}
.Confirmation-status-container h1{
    text-align: center;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    border: 5px solid rgb(0,0,180);
    margin-left: auto;
    margin-right: auto;
    animation: pre-loader-logo 1s ease-in-out alternate infinite;
}

@keyframes pre-loader-logo {
    100%{transform: scale(2);}
}

</style>

<script>
    function closeStatus(){
        document.querySelector(".Confirmation-status-container").style.display ="none";
    }
    </script>


</html>
</body>