<?php


if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

  header("Location: Warning");
  exit;

      header('HTTP/1.0 403 Forbiddden',TRUE,403);
      die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}

?>




<!DOCTYPE html>
<html lang="eng_US">
  <head>
    <link rel="stylesheet" href="main page.css">
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

<link href="https://fonts.googleapis.com/css2?family=Tilt+Prism&display=swap" rel="stylesheet">


<title>Home</title>
</head>
<body>
    
    
<div class="main-page-header">

  <div class="main-page-top-nav">

     
     <b><a href="index">Home</a></b>
     <b class="showAbout">About</b>
      <b><a href="Login">Login</b></a>
      
     <b><a href="Register.php">Get started</b></a>
    </div>
    </div>
     

<?php// require_once "Flag.php"; ?>


   <div class="main-page-logo-container">
    <b>LazerWave<i class="fa fa-flash"></i></b>
    </div>
    
    
    
    
    
    
    
      <div class="main-page-image"></div>
      
      <div class="welcome-container">
      <p>Welcome to lazerWave!</p>
      
      <p>The bank of Africa</p>
      </div>
      
      
      
      
    
      <div class="main-page-message-box">
    
    <p>We provide services in the following </p>
    <p>Account opening</p>

<p>Internet Banking</p>
<p>
Mobile Banking</p>

<p>Business Account</p>


<p>Online Payment Link</p>
<p>
Loans and Grants</p>

<p>Cross border Transfer(10+ countries)</p>


</div>


<?php if(!isset($user)): 

    
    require_once __DIR__.("/Livechat.php"); 
    
  endif;?>
    

    
    <div class="main-page-get-started-container">
    
    
    <div class="flex-box-container">
    
    <div class="container-fluid-box">
    <p><a href="saved beneficiary">Send Money
    <i class="fa fa-send"></i></a></p>
    
    </div>
    
     <div class="container-fluid-box">
    <p><a href="Top up">Receive Money
    <i class="fa fa-exchange"></i></a></p>
 </div>
 
 </div>
 
 
 
 <div class="flex-box-container">
 
 
  <div class="container-fluid-box">
    <p><a href="Airtime">Airtime/Data
    <i class="fa fa-phone"></i></a></p>
    
    </div>
    
     <div class="container-fluid-box">
    <p><a href="Create payment link">
    Payment Link
    <i class="fa fa-link"></i></a></p>
 </div>
 
 </div>
    
    
    
    <p><a href="Login">Get started</a></p>
    
    
    </div>
    
   <div class="second-image-container">
   
   </div>
   
   <div class="customer-care-container">
   <p>24/7 customer care service.</p>
   
   </div>
   
   
   
   <div class="third-image-container">
   </div>
   
   <div class="social-container-overlay">
   <p>Follow us on social media <i class="fa fa-sort-down" onclick="ShowSocialMedia()"></i></p>
   
   
   <div class="display-flex">
   
   
   <div class="follow-social-media-container">
   <div class="social-media-dropdown">
   <i class="fa fa-twitter"></i>
   <i class="fa fa-instagram"></i>
   <i class="fa fa-whatsapp"></i></div>
   
   </div>
   </div>
   </div>
   
   <script>
   function ShowSocialMedia(){
   document.querySelector(".social-media-dropdown").style.display="block";
   
   }
   </script>
   
   
   
   
    
    
    
    
  
    <div class="main-page-text">
    
    <div class="main-page-about-container">
    <p>ABOUT</p>
    
    <p>Lazerwave is a multi-international comapny founded by young Nigerian business enterprenur,who has a very good Knowledge in banking and finanace sector.Our goal is to make internet banking easier,faster and closer to you.Looking for the best internet banking? we got you covered!.Enjoy exciting offers and free transfer to all other local bank in Nigeria,Ghana and South Africa.We have highly trained business expert that can manage your business and bring alot of growth,buiness ideas,improve buiness planning and evaluation.We can also help you with business ideas that suits you best,so what are you waiting for? choose lazerwave today because,we're starting a journey together with seamsless and fast banking.</p>
    
    
    </div>
    
    
            <!--div class="back-to-top">
<span class="material-symbols-outlined" style="font-size:30px;cursor:pointer;" id="back-to-top">keyboard_double_arrow_up</span>

        </div-->
    
    </div>
    
    
   
    
    
    
    
  
    
    
    



<script>



document.querySelector(".showAbout").addEventListener("click",showAbout);
function showAbout(){

      document.querySelector(".main-page-about-container").scrollIntoView({
            behavior:'smooth'
})
}



</script>

</body>
</html>