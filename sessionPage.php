<?php


session_start();

//session_regenerate_id();

if (isset($_SESSION["New_user"])){
    require_once __DIR__.("/db_connection.php");

    $SQL = "SELECT * FROM Register_db WHERE id = '$_SESSION[New_user]' ";

 $result = $conn -> query($SQL);


 $user = $result -> fetch_assoc();
 
 
 // CHECK USER LOGIN IF IT IS VALID OR NOT//
 require_once "Daily visitors.php";
 
 
 
 
 require_once "Verfiy login.php";
 

 
 /* 
 echo $_SERVER["http-self"];

 /*if ($result -> num_rows > 0){
    while ($user = $result -> fetch_assoc()){


    }
 }
*/
echo "<noscript>
<div class='noscript'>
    <p>  Your browser doesn't support JavaScript or javascript appear to have been turn off,please go to your browser setting to turn javascript ON.</p>
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
      
    </noscript>";


require_once __DIR__.("/show addvert.php");


require_once __DIR__.("/include username.php");

//DAILY VISITORS GET REQUEST//

require_once __DIR__.("/Daily visitors.php");

if(isset($_COOKIE["Cookie_consent"])){
    
    
    
}else{
    
    require_once "Cookie banner.php";
    
    
}




}else{

  
   
if (isset($_COOKIE["userId"])){

 if (isset($_COOKIE["check_confirm_real"])){
     
     require_once __DIR__.("/Last page.php");

     
     

   header("location:Authentication.php");
   exit;



 }else{

   // no need to redirect user
   /*
   header("location:login.php");
   exit;*/
 }

 

}else{
    
    require_once __DIR__.("/Last page.php");

  header("location: Login.php");
  exit;

}
}


//require_once __DIR__.("/Daily visitors.php");

?>

