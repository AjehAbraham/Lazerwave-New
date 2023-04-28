<?php
require_once __DIR__.("/Network.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

      header('HTTP/1.0 403 Forbiddden',TRUE,403);
      die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}

?>


<!DOCTYPE html>
<html lang="eng_US">
  <head>
    <link rel="stylesheet" href="header.css">
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


<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Tilt+Prism&display=swap" rel="stylesheet">


<title>Home</title>

      </head>
      <body>

    <div class="sidebar-container">
        <i class="fa fa-close" id="close-btn" style="font-size: 21px;color: white;"></i>

       <?php if (isset($user)): ?>

<?php  require_once "Flag.php";?>


<style>
    .sidebar-container{
        
        background-color: rgb(0,0,36);
        color: white;
    }
    .sidebar-container p{
        border: 0px solid white;
        border-bottom: 3px solid white;
        border-radius: 2rem;
        font-size: 15px;
        
    }
    .sidebar-container p a:link{
        
        color: white;
    }
    .sidebar-container p:hover{
        background-color: red;
    }
    .sidebar-container p a:active{
       background-color: red;
    }
    .sidebar-container p a:visited{
        color: white;
    }
    
    .header-container{
        background-color: rgb(0,0,36);
    }
 
</style>

        
        
    <!--div class="profile-link">
      <i class="fa fa-user"></i>
      
    </div-->


  <h3 style="text-align:center;">Hi,<?php echo $user["Surname"] ?> welcome back.</h3>



<div class="top-nav">
       <a href="index"><p><i class="fa fa-home"></i>Home</a></a> </p>

       

      
       
       
        <a href="profile"><p><i class="fa fa-user-plus"></i>Profile</a></p>





          
            <a href="saved beneficiary"> <p><i class="fa fa-send"></i>Send Money</a></p>


          

         
            <a href="setting"> <p><i class="fa fa-cogs"></i>Settings</a></p>





       <a href="About" target='blank'><p><i class="fa fa-book"></i>About</a></p>



<?php endif; ?>


<?php if(isset($user)) :?>
  <a href="logout"> <p><i class="fa fa-sign-out"></i>Logout</a></p>


<?php else: ?>

  <a href="Login"><p><i class="fa fa-sign-in"></i>Login</a></p>

    <?php endif;?>

</div>

    <!--a href="6"><i class="fa fa-facebook"></i></a
    <a href="https://wa.me/+2349074220985"><i class="fa fa-whatsapp"></i></a>
    <a href="https://www.twitter.com/AbrahamAjeh"><i class="fa fa-twitter"></i></a>
    <a href="mailto:Ajehabraham51@gmail.com"><i class="fa fa-google"></i></a-->
 </div>


 <div class="header-container">
    <p style=" font-family: 'Tilt Prism', cursive;">LazerWave<i class="fa fa-flash"></i></p>

    <i class="fa fa-bars" id="open-btn"></i>
 </div>

</div>
 
 <script src="header.js"></script>

</html>
      </body>