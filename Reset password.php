<?php


if ($_SERVER["REQUEST_METHOD"] == "POST"){


$email = filter_var($_POST["email"],FILTER_VALIDATE_EMAIL);


if (!filter_var($_POST["email"],FILTER_VALIDATE_EMAIL) == TRUE){

    $email_error = "invalied email";


  die("<p style='color:red;text-align: center;'>Invalid email</p>");



}else{


  htmlspecialchars($email);


  //Check if user exit or user is fake

  require_once __DIR__.("/db_connection.php");


  $check_user = "SELECT * FROM Register_db WHERE Email ='$email' ";


  $user_result = $conn -> query($check_user);




  if ($user_result -> num_rows > 0){

    while($result_details = $user_result -> fetch_assoc()){

 //send user otp and redirect user to change password

//var_dump($result_details);

      session_start();

    session_regenerate_id();


    $_SESSION["reset_pass_id"] = $result_details["id"];

    $_SESSION["reset_pass_email"] = $result_details["Email"];

    $_SESSION["Surname"] = $result_details["Surname"];
    

    header("location:New password.php");
exit;



    }

  }else{

   
  //throw erro if user does not exisat

$message_status = "<p>User does not exist</p>";


require_once __DIR__.("/Failed.php");



  }



}






}


?>



<!DOCTYPE html>
<html lang="eng_US">
  <head>
    <link rel="stylesheet" href="Reset password.css">
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
<title>Reset Password</title>
      </head>
      <body>

    
<script>
     
     if(window.history.replaceState){
     
     window.history.replaceState(null,null,window.location.href);
     
     }
         </script>

      <span class="material-symbols-outlined" onclick="window.history.back()" style="color:rgb(0,0,180);">arrow_back</span>
      <a href="index.php"><i class="fa fa-home" style="color:rgb(0,0,180);cursor:pointer;float:right;margin-top:1px;font-size:20px;"></i></a>
    


      <div class="reset-password-container">

        <h1><i class="fa fa-cogs"></i> Reset Password  </h1>
        <form method="post" >

        <label for="email"><b>E-mail:</b></label>
        <br>

        <input type="email" name="email"id="email"  value="<?php echo isset($_POST["email"]) ? $_POST["email"] : ''?>" placeholder="Enter your email...">

        <br>

        <input type="submit" value="Validate" onclick="submit_form(event)">
</form>

