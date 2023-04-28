<?php

/*
if($_SERVER["REQUEST_METHOD"] == "GET"){

header("Location: warning.php");
exit;

}else if ($_SERVER["REQUEST_METHOD"] == "POST"){



header("Location: warning.php");
exit;




}*/



//NOW CHECK IF THE COOKIE WE SET WHEN USER LOGIN IN PRESENT AND THE SESSION ID IS CORRECT WITH DATABASE ELSE SIGN THE USER OUT AND DESTROY COOKIE//

/*
if (!isset($_COOKIE["Login_check"]) {

 //if(!empty(COOKIE["Login_check]"){
 */
 //NOW CHECK IF ID MATCH//
 
 
 
 $fetch_log = "SELECT * FROM User_session_id WHERE User_id ='$_SESSION[New_user]' ORDER BY id DESC LIMIT 1";
 
 
 $log_result = $conn -> query($fetch_log);
 
 
 if ($log_result -> num_rows > 0){
 
 $log_details = $log_result -> fetch_assoc();
 
 //NOW COMPARE DETAILS OF THE CODE//
 
 if($log_details["Session_id"] === session_id()){
 
 //THE SESSION IS VALID //
 
 
 
 
 }else{
 
 
 //NOW CHECK IF COOKIE IS SET//
 
 
 unset($_SESSION["New_user"]);
 
 
 //INVALID SESSION LOG USER OUT//
 
 
 //CHEXK IF COOKIE IS SET TO REDIRECT USER BECAUSE USER HAS PROBALY LOGIN USING ANOTHER BROWSER OR DEVICE//
 
     
if (isset($_COOKIE["userId"])){

    if (isset($_COOKIE["check_confirm_real"])){
        
        
              
      $new_va = rand(3444,8373) .uniqid().rand(63637,833737);
      
      setcookie("Refresh_session", $new_va,time() + 36000);
      
      
      
      $new_va = password_hash($new_va,PASSWORD_DEFAULT);
      
      $_SESSION["Refresh_session"] = $new_va;
    
        
    
    
    
    
    header("Location: Authentication.php");
    
    exit;
    
    
}
 
 
 }
 
 
 
 }
 
 
 
 }else{
 
 
 //NO RESULT FOUND LOG THE USER OUT AND DESTROY ALL COOKIES 
 
 if (isset($_COOKIE["userId"])){

    if (isset($_COOKIE["check_confirm_real"])){
        
        
        
              
     $new_va = rand(3444,8373) .uniqid().rand(63637,833737);
      
     setcookie("Refresh_session", $new_va,time() + 36000);
      
      
      
      $new_va = password_hash($new_va,PASSWORD_DEFAULT);
      
      
    $_SESSION["Refresh_session"] = $new_va;
    
    
    
    header("Location: Authentication.php");
    
    exit;
    
    
}
 
 }
 
       
      $new_va = rand(3444,8373) .uniqid().rand(63637,833737);
      
      setcookie("Refresh_session", $new_va,time() - 36000);
      
      
      
    //  $new_va = password_hash($new_va,PASSWORD_DEFAULT);
      
      
 
 
 
 
 
 header("Location: logout.php");
 
 exit;
 
 
 
 
 
 }
 
 
 
 
 
 
 
 
 
 //}
   
   
   
   
   
   //}
   
   ?>