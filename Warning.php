<?php

require_once __DIR__.("/Daily visitors.php");

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
<title>VirtualCard</title>
      </head>
      <body>

<?php require_once __DIR__.("/logo.php"); ?>


      <div class="warning-container">

      <p style='text-align: center;'>The page your are looking for does not exisit or has been moved  &#128532;.please click home to go back to main page</p>
      
      <br>
      <p><a href="index"><i class="fa fa-home"></i> Home</a></p>
      
      </div>
      
      <style>
      body{
          margin: 0;
          background-color: rgba(255,0,0,0.4);
          font-size: 18px;
          color: rgb(0,0,100);
          text-align: center;
      }
         .warning-container  p:nth-child(3){
             padding: 10px 10px;
             width: 65%;
             background-color: rgb(0,9,100);
             color: white;
             text-align: center;
             margin: auto;
             
         }
         a:link{
             color: white;
             text-decoration: none;
         }
         a:visited{
             color: white;
         }
      </style>
      

</body>
</html>