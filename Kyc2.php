<?php 
require_once __DIR__.("/sessionPage.php");


if (!isset($_SESSION["New_user"])){
    header("location:login.php");
    exit;
}

include __DIR__.("/db_connection.php");
?>

<!DOCTYPE html>
<html lang="eng_US">
  <head>
    <link rel="stylesheet" href="kyc2.css">
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width,initial-scale=1.0">
          <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
         
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.debug.js"></script>
<!--link rel="preconnect" href="https://fonts.googleapis.com"> 
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
<link href="https://fonts.googleapis.com/css2?family=Encode+Sans:wght@300&family=Island+Moments&family=Oswald:wght@200&family=PT+Serif:wght@700&family=Roboto+Mono:wght@100&display=swap" rel="stylesheet">
-->

<script src="https://kit.fontawesome.com/958aace4f6.js" crossorigin="anonymous"></script>




<link rel="preconnect" href="https://fonts.googleapis.com"> 
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
<link href="https://fonts.googleapis.com/css2?family=Encode+Sans:wght@300&family=Island+Moments&family=Noto+Sans:ital,wght@1,200&family=Oswald:wght@200&family=Roboto+Mono:wght@100&display=swap" rel="stylesheet">


<!-- ajax and jquery link -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<script src= "https://code.jquery.com/jquery-3.5.0.js"></script>

<!-- end of ajax link -->




<title>KYC2</title>




      </head>
      <body>

        <span class="material-symbols-outlined" onclick="window.history.back()" style="color:rgb(0,0,180);">arrow_back</span>
        <a href="index.php"><i class="fa fa-home" style="color:rgb(0,0,180);cursor:pointer;float:right;margin-top:1px;font-size:15px;"></i></a>
      
  
        <?php 

require __DIR__.("/Network.php");


// cehck if user has already fill form 

$check_user_status = "SELECT * FROM More_information WHERE User_id = '$_SESSION[New_user]'";


$check_user_result = $conn -> query($check_user_status);

if ($check_user_result -> num_rows > 0){

  $message_status = "You have already fill this form,if you want to make some changes please contact admin.
  ";

  require_once  __DIR__.("/Failed.php");

  die();
}





        ?>



        <div class="form-container">

<h2><i class="fa fa-user-plus"></i> KYC2 upgrade(More information)</h2>

<p>Please make sure you fill in the appropraite information.</p>


            <form method="post"  id="formId">

<label for="DOB"><b>Date of birth:</b></label>
<br>
<input type="date" name = "DOB" value="<?php echo isset($_POST["DOB"]) ? $_POST["DOB"] : '' ?>">

<br>


<label for="State of origin"><b>State of origin:</b></label>
<br>
<input type="text" placeholder="State.." name="state" value="<?php echo isset($_POST["state"]) ? $_POST["state"] : '' ?>">

<br>
            
<label for="LGA"><b>Local goverment:</b></label>
<br>
<input type="text" placeholder="LGA...." name="LGA" value="<?php echo isset($_POST["LGA"]) ? $_POST["LGA"] : '' ?>">

<br>
     
<label for="Mother name"><b>Mother's name:</b></label>
<br>
<input type="text" placeholder="Mother's first name..." name="M_name" value="<?php echo isset($_POST["M_name"]) ? $_POST["M_name"] : '' ?>">
<br>


   
<label for="next of kin"><b>Next of kin(Full name):</b></label>
<br>
<input type="text" placeholder="Full name..." name ="N_kin" value="<?php echo isset($_POST["N_kin"]) ? $_POST["N_kin"] : '' ?>">

<br>
   
<label for="relationship"><b>Relationship(Next of kin):</b></label>
<br>
<input type="text" placeholder="Siblings,parent,relative...." name="status" value="<?php echo isset($_POST["status"]) ? $_POST["status"] : '' ?>">

<br>


                 
<label for="Job status"><b>Occupation(optional):</b></label>
<br>
<select name="Occupation" value="<?php echo isset($_POST["Occupation"]) ? $_POST["Occupation"] : '' ?>">
    <option></option>
    <option>Student</option>
    <option>Self employed</option>
    <option>Employed</option>
 <option>Retired</option>
</select>

<br>   
<br>

<input type="submit" value="Upgrade" id="submitButton">

</form>

<h6 class="error_message"> </h6>

</div>

<br>
<br>

<div class="loader-overlay">
  <div class="loader-message">
</div>
</div>












<script src ="Kyc2.js"></script>

</body>
</html>
