<?php

session_start();



//SHOW ADVERT BOX//

if(isset($_SESSION["New_user"])){

    require_once __DIR__.("/db_connection.php");

    $SQL = "SELECT * FROM Register_db WHERE id = '$_SESSION[New_user]' ";

 $result = $conn -> query($SQL);


 $user = $result -> fetch_assoc();
 
 
 require_once "Verfiy login.php";
 
 
 echo "<noscript>
 <div class='noscript'>
    <p >  Your browser doesn't support JavaScript or javascript appear to have been turn off,please go to your browser setting to turn javascript ON.</p>
    </div>
      <style>.noscript{background:black;color: white;
      
      position: fixed; 
      top: 0; 
      bottom: 0;
      left: 0;
      right: 0;
      text-align: center;
      font-size: 27px;
      width: 100%;
      height: 100%;
      z-index: 2;
          
          
      }</style>
      
    </noscript>
    <title>Home</title>
    
    ";



require_once __DIR__.("/include username.php");




}
// delect cookie just incase of maintance

/*
setcookie("userId","",time()- 8640 * 7);

setcookie("check_confirm_real","",time() - 8640 * 70);
*/



if(!isset($_SESSION["New_user"])){


if (isset($_COOKIE["userId"])){ 

    //echo $_COOKIE['userId'] ."<br>";

    //cho "Cookie already exist";
if (isset($_COOKIE["check_confirm_real"])){

    //echo $_COOKIE['check_confirm_real'];

   // echo "Cookie already exist";
require_once __DIR__.("/Last page.php");

     


   header("Location:Authentication.php");
   exit;

}
}
}
require_once __DIR__.("/Daily visitors.php");


//SHOW ADVERT //

require_once __DIR__.("/show addvert.php");






?>
<?php if(!isset($user)):?>

<?php require_once __DIR__.("/main page.php");?>

<?php endif;?>




<?php if(isset($user)):?>


<?php
require_once __DIR__.("/header.php");


//require_once "Flag.php";


 require_once __DIR__.("/dashboard.php"); ?>


<?php endif;?>



    



<?php require_once __DIR__.("/homePage.php"); ?>

<!--head>
<title>Home</title>
</head-->



<?php //require_once __DIR__.("/Daily visitors.php");


if(isset($_COOKIE["Cookie_consent"])){
    
    
    
}else{
    
    require_once "Cookie banner.php";
    
    
    
}
?>




<?php if(!isset($user)): ?>

<?php require_once __DIR__.("/footer.php"); ?>

<?php endif; ?>
