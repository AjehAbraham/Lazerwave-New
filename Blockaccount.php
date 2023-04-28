<?php 
require_once __DIR__.("/sessionPage.php");


if (!isset($_SESSION["New_user"])){
    header("location:login.php");
    exit;
}
  // cehck block history
  require_once "db_connection.php";

  $check_status_record = "SELECT *  FROM Block_account WHERE User_id = '$_SESSION[New_user]'";

  $result_his = $conn -> query($check_status_record);
  
  if($result_his -> num_rows > 0){
      
  
  
  
  $results = $result_his -> fetch_assoc();
  
  //var_dump($results);
  
  
  
  if($results["Account_status"] == "Block"){

  $status = "Unblock";


}else{
    
    
    $status ="Block";
    
    
}
 

//require_once __DIR__.("/Network.php");
}else{



$status ="Block";


}
?>

<!DOCTYPE html>
<html lang="eng_US">
  <head>
    <link rel="stylesheet" href="Blockaccount.css">
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
<title>Block Account</title>


<!-- ajax and jquery link -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<script src= "https://code.jquery.com/jquery-3.5.0.js"></script>

<!-- end of ajax link -->

      </head>
      <body>



          <a href="index.php">  <i class="fa fa-home" style="float:right;margin-top:2px;font-size:15px;"></i>
</a> 
          <span class="material-symbols-outlined" onclick="window.history.back()">arrow_back</span>
          
          
          <?php
          
          require_once "Network.php";
          ?>

      
          <div class='block-account-container'>
            <h1>Block Account</h1>
            
<form method='post' id='FormId'>
    
    <label for='block-account'><b>Transaction pin:</b></label>
    <br>

    <input type="text" name="Pin_code"  placeholder='Enter your four digit transaction pin' inputmode="numeric" style="-webkit-text-security:disc;" maxlength="4">
    <br>


    <input type='submit' id="submitButton" value='<?php echo $status ?>' >
</form>

<p class="error_message"></p>

<div class="loader-overlay">
  <div class="loader-message">
</div>
</div>



<script src="Blockaccount.js"></script>

</body>
</html>