<?php


session_start();

session_regenerate_id();

//var_dump($_SESSION);

//var_dump($_COOKIE);

//exit;

if (isset($_SESSION["New_user"])){

  // IF USER HAS ALREADY SIGN IN REDIRECT THEM TO HOME PAGE TO AVOID RE-WRITTING COOKIE 

unset($_SESSION["New_user"]);


//header("location:index.php");
   //exit;
}




    // CHHECK IF THE COOKIE IS SET
    
if (isset($_COOKIE["userId"])){

    if (isset($_COOKIE["check_confirm_real"])){

      (int) filter_var($_COOKIE["userId"],FILTER_VALIDATE_INT);


      htmlspecialchars($_COOKIE["userId"]);

      htmlspecialchars($_COOKIE["check_confirm_real"]);

   
   //CHECK IF THE COOKIE IS VALID WITH THE COOKIE IN DATABASE  
   
   require_once __DIR__.("/db_connection.php");
   
   
   $id_m = htmlspecialchars($_COOKIE["userId"]);



   $check = "SELECT * FROM  Authentication_table WHERE User_id ='$_COOKIE[userId]' ORDER BY id DESC LIMIT 1";


   $result = $conn -> query($check);

   if ($result -> num_rows > 0){
    while($real_result = $result -> fetch_assoc()){


//var_dump($real_result);

        // now check if the hash_link match so that we can log the user in

       if (password_verify(htmlspecialchars($_COOKIE["check_confirm_real"]),$real_result["Hash_key"]) == "password_hash"){


       // session_start();

       // session_regenerate_id();
$_SESSION["New_user"] = $real_result["User_id"];


require_once __DIR__.("/save season id.php");



require_once __DIR__.("/Account limit.php");


require_once __DIR__.("/login history.php");



//CHECK IF LAST VISITED PAGE IS SET//

if(isset($_COOKIE["Lazer_wave_last_visited_page"])){
    
    //CHECK IF COOKIE IS EMPTY 
    //
    
    if(!empty($_COOKIE["Lazer_wave_last_visited_page"])){
    
    $page =htmlspecialchars($_COOKIE["Lazer_wave_last_visited_page"]);
    
    //SET COOKIE TO PAST TO AVOID REDIRECTING TO  PAGE ANYTIME USER LOGINS
    
    $last_page = $_COOKIE["Lazer_wave_last_visited_page"];
    
    unset($_COOKIE["Lazer_wave_last_visited_page"]);
    
   setcookie("Lazer_wave_last_visited_page","",time() - 8640);
        
        header("Location:$page");
        exit;
        
    }
    
}


header("location:index.php");
   exit;

       }else{
      //redirect user to home page is cookie is false
      ///UNSET COOKIE JUST INCASE USER LOGINS IN WITH ANOTHER BORWESR TO AVOID SO MANY REDIRECT 
      
      //REDIRED USER TO AUTHENTICATION FOR USER TO LOGIN AGAIN//
      
      $new_va = rand(3444,8373) .uniqid().rand(63637,833737);
      
      setcookie("Refresh_session", $new_va,time() + 36000);
      
      
      
      $new_va = password_hash($new_va,PASSWORD_DEFAULT);
      
      
      
      $_SESSION["Refresh_session"]= $new_va;
      
      
      
      //REDIRECT USER TO REFRESSH THEIR SESSION//
      
      header("Location: Refresh session.php");
      
      
     // require_once __DIR__.("/Refresh session.php");
      exit;
      
      
      if(isset($_COOKIE["userId"])){
      
      unset($_COOKIE["userId"]);
      if (isset($_COOKIE["check_ confrim_real"])){
      unset($_COOKIE["check_confirm_real"]);
      
      setcookie("check_confirm_real",'',time() - 3600);
      }
      setcookie("userId", '',time() -3600);
      }

       //header("location:index.php");
      // exit;
       }



    }
   }


   
    }else{
        
        
     //   echo "error";
        
        
        
    header("location:index.php");
 exit;
    }
   
    
   
   }else{
       //echo "erorr";
   
   header("location:index.php");
   exit;
   
   }



?>