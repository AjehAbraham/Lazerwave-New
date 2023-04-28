
<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

      header('HTTP/1.0 403 Forbiddden',TRUE,403);
      die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}
?>





<!DOCTYPE html>
<html lang="eng_US">
  <head>
    <link rel="stylesheet" href="footer.css">
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

      </head>
      <body>

        <!--div class="back-to-top">
<span class="material-symbols-outlined" style="font-size:30px;cursor:pointer;" id="back-to-top">keyboard_double_arrow_up</span>

        </div-->

        <div class="footer-container">

            <div class="sub-footer-container">
                <p>Blog</p>
                <p>News</p>
                <p>Cookie policy</p>
                <p>Developer</p>
                <p>About</p>
                <p>License</p>
                <p>Promotion</p>
                <p>Terms and conditions</p>
                <p>Privacy policy</p>
            </div>

            <P>Contact: <a href="tel:09074220984">09074220984</a></P>
            <p>Address:<i>opposite city mart,gwagwalada,Abuja.</i></p>

            <div class="flex">
            <div class="footer-social-container">
                <!--a href="6"><i class="fa fa-facebook"></i></a-->

           
                <a href="https://wa.me/+2349074220984"><i class="fa fa-whatsapp"></i></a>

            
                <a href="https://www.twitter.com/AbrahamAjeh"><i class="fa fa-twitter"></i></a>
                
             
                <a href="mailto:ajehabraham51@yahoo.com"><i class="fa fa-google"></i></a>
        
</div>
            </div>
            <br>
            
            <p style="text-align: center;font-family: 'Tilt Prism', cursive;">Powered by LazerTech <b><span class="material-symbols-outlined" style="color: red;font-weight:bold;">filter_list</span></b></p>
            <br>

     <p style="text-align: center;">©2022 -<?php echo date("Y")  ?> </p>
            <h1><i>All Right Reserve</i></h1>
            
            
        </div>

    
        <script src ="footer.js"></script>
        </body>
        </html>