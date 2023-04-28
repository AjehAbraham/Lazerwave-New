<?php



$is_valid = "";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    
   /* 
    if(empty($_POST["Email"])){
        
        
        $message_status ="Please enter your email or username";
        require_once __DIR__.("/Failed.php");
    }*/


    if (isset($_POST["remember-me"]))
    {
     $remeber_me = filter_var($_POST["remember-me"],FILTER_SANITIZE_STRING);

     $remeber_me = htmlspecialchars($remeber_me);
    }else{

     $remeber_me = NULL;

    }

     require_once __DIR__.("/db_connection.php");

    $conn -> real_escape_string($_POST["email"]);

$sql =  "SELECT * FROM Register_db WHERE Email = '$_POST[email]' ";

$result = $conn -> query($sql);

if ($result -> num_rows > 0){
     while($new_user = $result -> fetch_assoc()){
           if($new_user){
                 if (password_verify( htmlspecialchars($_POST["password"]), $new_user["Password"]) == "password_hash"){
                       
            
               session_start();
                session_regenerate_id();


                $_SESSION["New_user"] = $new_user["id"];

require_once "save season id.php";



//ADD DAILY VISITIRS//



                //CHECK IF REMEMBER ME IS NULL

                if ($remeber_me == NULL){


                 //header("location:index.php");
      
      
      
                // exit;



                }

                        // set cookie to remember user for 7days/one week

                        // first check if the cookie already exist or has not expire/


                        if (isset($_COOKIE["userId"])){

                          // cookie exist//

                          //check if cookie match 

                          //if(isset($_COOKIE["userId"]) == $_SESSION["New_user"]);



                        }else{
                             //check if remenber me is null or user did not check remember me


                             if(!$remeber_me == NULL){

                             $cookie_name = "check_confirm_real";


                             $cookie_value = rand(9999,99999) * 170 . uniqid();
    
                             // hash th cookie value for safety
    
    
                             setcookie($cookie_name,$cookie_value,time() + 86400 * 7);

                             //set another cookie to save user id to avoid conflit

                             $cookie_two_name ="userId";


                             $cookie_two_vaLue = $_SESSION["New_user"];

                            

                             setcookie($cookie_two_name,$cookie_two_vaLue,time() + 86400 * 7);


           

                             $cookie_value = password_hash($cookie_value,PASSWORD_DEFAULT);

                             $cookie_two_vaLue = password_hash($cookie_two_vaLue,PASSWORD_DEFAULT);
                             

                             require_once __DIR__.("/db_connection.php");

                             //first check if user has created one before

                            // $check = "SELECT * FROM Authentication_table WHERE User_id = '$_SESSION[New_user]'";


                        //     $result = $conn -> query($check);

                           //  if ($result -> num_rows > 0){
                                   //while($user_result = $result -> fetch_assoc()){

                                     

                                         // update if found//

                                        // $update_table = "UPDATE Authentication_table SET Hash_key = '$cookie_value'  WHERE User_id = '$_SESSION[New_user]'";


                                         //if ($conn -> query($update_table) == TRUE){
                                               //NO NEED TO INFORM USER
                                         }

                               //    //}
                            // }else{
                                   $date = date("Y-m-d H:i:s");

                                   
                                   $insert_record = "INSERT INTO Authentication_table(User_id,Hash_key,Date_created)
                                   VALUES('$_SESSION[New_user]','$cookie_value','$date')

                                  
                                   ";

                                   if ($conn -> query($insert_record) == TRUE){
                                         // no need to inform the user
                                   }else{
                                         //no need to throw error messsage to user
                                   }
                             }




                             //insert cookie vallues so you can check if it is fake or real





                             //}

                       // }


               
           

                        require_once __DIR__.("/Account limit.php");



//UPDATE LOGIN HISTORY ANYTIME USER LOGINS IN//


require_once __DIR__.("/login history.php");

//Check for last page before session expire with three days//

if (isset($_COOKIE["Lazer_wave_last_visited_page"])){
    //CHECKING IF COOKIE IS NOT ENPTY TO MAKE SURE NO ERRIR OCCUR
    
    if(!empty($_COOKIE["Lazer_wave_last_visited_page"])){
        
        //REDIRECT USER TO THE LAST VISITED PAGE//
        $page = $_COOKIE["Lazer_wave_last_visited_page"];
        
        
        //UNSET THE COOKIE  SO TO AVOID LOGING THE USER IN TO THAT SAME PAGE
        
        $last_page= "Lazer_wave_last_visited_page";
        
        setcookie($last_page,"",time() - 8640 * 7);
        
        header("Location: $page");
        exit;
        
        
    }else{
        
        //COOKIE IS EMPTY YOI CAN ALSO REDIRECT USER TO MAIN PAGE/INDEX.php
        
        //UNSET COOKIE TO AVOID ERROR AND REDIRECT
        
        $name_unset ="Lazer_wave_last_visited_page";
        
        setcookie($name_unset,"",time() -36400);
        
        
        
        header("Location:index.php");
        
        exit;
        
    }
    
    
}

                        header("location:index.php");
      
      
      
                        exit;


                 }else{

                   $message_status = "Invalid username or password &#128532;";
require_once __DIR__.("/Failed.php");

                       $is_valid = "Invalid username or password &#128532;";
                 }
           }
     }
}else{
   // require_once __DIR__.("/Daily visitors.php");
    
     header("location: Register.php");
     exit;
     
}



}



?>
<!DOCTYPE html>
<html lang="eng_US">
  <head>
    <link rel="stylesheet" href="login.css">
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
<title>Login</title>



<!-- ajax and jquery link -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<script src= "https://code.jquery.com/jquery-3.5.0.js"></script>

<!-- end of ajax link -->


      </head>
      <body>


      <script>
      
      if(window.history.replaceState){
      
      window.history.replaceState(null,null,window.location.href);
      
      }
      </script>

<?php 


require_once __DIR__.("/logo.php") ?>







      <div class="form-container">

<h1>Login</h1>

<h2>Hi,welcome back</h2>

<p style="color: red;"><?php echo $is_valid;  ?></p>

<form method="post">


<label for="email"><b>Email:</b></label>
    <br>
    <input type="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''?>" autocomplete="off" name="email" placeholder="Email...">
    <br>

<label for="password"><b>Password:</b></label>
    <br>
    <input type="password" autocomplete="off" name="password" placeholder="password...">
    <br>

    <p><input type="checkbox" name="remember-me"> Remember me</p>
   
    <div class="login">
<input type="submit" value="Login"  >
</div>

</form>

<br>


<div class="sign-in">
<a href="Register"><input type="submit" value="Sign in" ></a></div>


<p style="color: rgb(0,0,180);text-align:center"><a href="Reset password.php">Forgot password ?</a></p>

</div>

</div>


<?php

if(isset($_COOKIE["Cookie_consent"])){
    
    
    
}else{
    
    require_once "Cookie banner.php";
    
    
}


?>





</body>
</html>