<?php


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
<title></title>
      </head>
      <body>


<div class="Network-container-overlay">
        <div class="Network-container">
            <h1><i class="fa fa-wifi"></i> Opps! &#128549; no Internet  connection</h1>
        </div>
</div>
        <style>
          
         .Network-container-overlay{
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            
             background-color: rgba(0,0,0,0.2);
              display: none;
              z-index: 1;
          }
       /*   .Network-container-overlay{
             margin-left: auto;
             margin-right: auto;
             display: block;
             width: 85%;
             background-color: white;
         *
          }*/
          .Network-container h1{
              background-color: rgb(0,0,52);
              padding: 20px 20px;
              width: 70%;
              margin-left: auto;
              margin-right: auto;
              display: block;
              color: white;
              text-align: center;
              top: 60%;
              font-size: 18px;
              border-radius: 2rem;
          }
          @keyframes load-network {
              0%{transform: translate3d(0,-100px,0);}
              100%{transform: translate3d(0,0,0);}
          }
          </style>


        <script>
            
            window.addEventListener('offline', (e) => {console.log('offline');
            document.querySelector(".Network-container-overlay").style.display = "block";
            
            });
            
            window.addEventListener('online',(e) => {
                console.log('online');
                document.querySelector(".Network-container-overlay").style.display = "none";
            
            
            })
        </script> 
       