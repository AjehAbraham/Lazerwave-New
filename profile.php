<?php 
require_once __DIR__.("/sessionPage.php");


if (!isset($_SESSION["New_user"])){
    header("location: Login.php");
    exit;
}



include __DIR__.("/db_connection.php");

$select_dp = "SELECT * FROM Profile_picture WHERE User_id ='$_SESSION[New_user]'  ORDER BY id DESC LIMIT 1";

$result_p = $conn -> query($select_dp);

if($result_p -> num_rows > 0){
    while($profile_picture = $result_p -> fetch_assoc()){

        $image = $profile_picture["Image_path"];
   
        $_SESSION["Profile_picture"] = "Uploads/".$image;

   
    }
}else{

    $_SESSION["Profile_picture"] = "Uploads" ."\\" ."null-profile.jpeg";
    
}


$extra_info = "SELECT * FROM Extra_info WHERE User_id ='$_SESSION[New_user]'";


$extra_info_result = $conn -> query($extra_info);

if ($extra_info_result -> num_rows > 0){

    while ($extra_details = $extra_info_result -> fetch_assoc()){

        $_SESSION["State"] = $extra_details["State"];

        $_SESSION["Tel"] = $extra_details["Tel"];

        $_SESSION["Address"] = $extra_details["Address"];
    }
}else{
    $_SESSION["Address"] = "";
    $_SESSION["Tel"] ="";
    $_SESSION["State"] ="";
}



?>


<!DOCTYPE html>
<html lang="eng_US">
  <head>
    <link rel="stylesheet" href="profile.css">
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

<!-- ajax and jquery link -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<script src= "https://code.jquery.com/jquery-3.5.0.js"></script>

<!-- end of ajax link -->


<title>Profile</title>
      </head>
      <body>

    <?php require_once __DIR__.("/Network.php");?>

      <span class="material-symbols-outlined" onclick="window.history.back()" style="color:rgb(0,0,180);">arrow_back</span>
      <a href="index.php"><i class="fa fa-home" style="color:rgb(0,0,180);cursor:pointer;float:right;margin-top:1px;font-size:15px;"></i></a>


        <div class="profile-picture-container">
            
            
            <?php require_once "View picture.php"; ?>
            

            <img src="<?php echo $_SESSION["Profile_picture"] ;?> " width="120px"  onclick="open_picture()" id="output">
         
          
            <p style="color:white" class="open-upload-btn"><i class="fa fa-upload"></i> Upload  picture</p>
        </div>

        <div class="upload-option-overlay">
            <!--label for="file"style="cursor: pointer;">WOW</label-->
            <form method="post"  action="updateprofilePicture.php" enctype="multipart/form-data">
            <input type="file" name="image"  onchange ="loadFile(event)"style="display:none;" id="file" accept="image">


            <span class="material-symbols-outlined" id="close-upload-btn">close</span>
            <p  style="cursor: pointer;"><label for="file"> <i class="fa fa-photo"></i>Gallary</p>
            <p  style="cursor: pointer;"><i class="fa fa-camera"></i>Camera </p>
          
            <input type="submit" onclick="close_uplaod_overlay()" id="prof_submitButton" value="upload">
</form>
            </div>
        </div>


   
     
        <div class="form-container">
            <h1>Account Details</h1>

            
            <a href="EditProfile"><h3 class="edit-profile"><i class="fa fa-user-plus"></i>Edit</a></h3>
            
            
            <?php

   
   $fetch_username ="SELECT * FROM Username WHERE User_id ='$_SESSION[New_user]'";
   $username_result = $conn -> query($fetch_username);
   
   if ($username_result -> num_rows > 0){
   
   
   $username = $username_result -> fetch_assoc();
   
   
   
   echo "
   <style>
   body{
       background-color: #f1f1f1;
   }
   </style>
   
   <label for='username'><b>Username</b></label>
   
   <br>
   <input type='text' value='$username[Username]' id='Username'readonly>
   
   <br>
   <b style='margin-bottom: 20px'><i class='fa fa-copy' onclick='copyUsername()'style='margin-right: 10px'></i>Copy</b><br><br>";
   
   }else{
   
   //DO NOTHING 
   
   //echo "<input type='text' placeholder='johnDoe...'><br>"
   
   
   }

?>

        

    <label for="surname-name"><b>Surname:</b></label>
    <br>
    <input type="text" value="<?php echo $user['Surname'] ?>"readonly>
    <br>

    <label for="last-name"><b>Lastname:</b></label>
    <br>
    <input type="text" value="<?php if(isset($user["Last_name"])) echo $user['Last_name'] ?>" readonly>
    <br>

    <label for="First-name"><b>Firstname:</b></label>
    <br>
    <input type="text"value="<?php echo $user['First_name'] ?>" readonly>
    <br>

    <label for="gender"><b>Gender:</b></label>

    <?php if($user["Gender"] == "Male"): ?>
        <input type="radio" checked>  Male
    
<br>
    <?php else: ?>
        <input type="radio"checked>  Female
  
    <br>
<?php endif;?>
<br>

    <label for="E-mail"><b>E-mail:</b></label>
 


    <input type="email"value="<?php echo $user['Email'] ?>" readonly>
   
<?php 

//CHECK IF EMAIL IS VERIFY OF NOT//

$email_verfiy = "SELECT * FROM Email_verification WHERE User_id ='$_SESSION[New_user]'";

$email_verfiy_result = $conn -> query($email_verfiy);

if ($email_verfiy_result -> num_rows > 0){

    $email_status = $email_verfiy_result -> fetch_assoc();

    //NOW CHECK IF THE STATUS HAS BEEN VERIFY //
    
  

    if ($email_status["Status"] == "Verify"){

echo "
<p class='verify-email' style='background-color:mediumseagreen;margin-bottom: 25px;width: 40%'>Verified <i class='fa fa-check-circle'></i></p>



";

    }else{
// IF EMAIL IS NOT VEFIRY

echo "
<p class='verify-email'  style='background-color: rgba(255,0,0,0.5);margin-bottom: 25px;width: 40%'> Unverified <i class='fa fa-exclamation'></i></p>

";



    }


}else{

echo "
<p class='verify-email' onclick='open_verify_email()' style='cursor: pointer;background-color: rgba(255,0,0,0.5);margin-bottom:25px;width: 40%'> Unverified <i class='fa fa-warning'></i></p>

";


}


?>
 <br>
 <br>







<div class="verificastion-container-overlay">



<!-- loader -->
<div class="loader-overlay">
<div class="loader-message">
</div>
</div>
<!-- end of laoder -->

<?php 

$usr_n ="SELECT * FROM Email_verification WHERE User_id ='$_SESSION[New_user]'";

$usr_result = $conn -> query($usr_n);

if ($usr_result -> num_rows > 0){
    
    //THE USER HAS BEEN VERIFY//
    

    /*
    
    echo '




<div class="verification-container">

<h5 onclick="close_email_verify()"><i class="fa fa-close"></i></h5>

<h5>Verify email</h5>



<form nethod="post" id="sendOtp_formId" >
 <input type="hidden" name="otp"  value="otp" autofocus="off" class="otp-message">

<h5 class="request_top_btn" id="sendOtp_submitButton" >Request for otp</h5>

<h3 class="otp_error_message"></h3>

</form>


<form method ="post" id="verify_formId" >

<input type="number" autofocus="off" name="otp_no"  id="reset_number" placeholder="enter otp" inputmode="numeric" size="20">
<br>



<h3 class="error_message"></h3>

<input type="submit" id="verify_submitButton" value="verify">
</form>


<h5>Enter otp sent to the email address: <b><?php echo $user["Email"] ?></b> .</h5>

</div>




';
*/
}else{
    
    ////
    
    echo '
    
    
<div class="verification-container">

<h5 onclick="close_email_verify()"><i class="fa fa-close"></i></h5>

<h5>Verify email</h5>



<form nethod="post" id="sendOtp_formId" >
 <input type="hidden" name="otp"  value="otp" autofocus="off" class="otp-message">

<h5 class="request_top_btn" id="sendOtp_submitButton" >Request for otp</h5>

<h3 class="otp_error_message"></h3>

</form>

<form method ="post" id="verify_formId" >

<input type="number" autofocus="off" name="otp_no"  id="reset_number" placeholder="enter otp" inputmode="numeric" size="30">
<br>



<h3 class="error_message"></h3>

<input type="submit" id="verify_submitButton" value="verify">
</form>

<h5>Enter otp sent to the email address: <b>'.$user["Email"] .'</b> .</h5>

</div>

';
    
    
    
    
    
    
}

?>


</div>

<h5></h5>



<label for="Account-no"><b>Account no:</b></label>

  
    <br>
    <input type="number"value="<?php echo $user['Account_no'] ?>"  readonly id="account-number">
    <br>
    <!--h4 class="copy-account-number-message">Copy Account Number</h3-->
    
    <b class="copy-account-no"><i class="fa fa-copy"></i> Copy</b>
 
  <br>
  <br>
   
    <label for="tel"><b>Phone Number:</b></label>
    <br>
    <input type="tel" value="<?php echo  $_SESSION["Tel"] ?>" readonly>
    <br>

    <label for="address"><b>Address:</b></label>
    <br>
    <input type="text" value="<?php echo  $_SESSION["Address"] ?>" readonly>
    <br>

    <label for="country"><b>Country:</b></label>
    <br>
    <input type="text" value="<?php echo $user['Country'] ?>" readonly>
    <br>
    <label for="state" ><b>State:</b></label>
    <br>
    <input type="text" value="<?php echo  $_SESSION["State"] ?>" readonly>
    <br>

    <h4 class=" More" onclick='see_more()' style="cursor:pointer;background-color: rgb(0,0,52);">See more...</h4>

<div class="more-infromation">

<?php

// checking to see user kyc status //


require_once __DIR__.("/db_connection.php");


$check_kyc2 = "SELECT * FROM More_information WHERE User_id = '$_SESSION[New_user]'";

$kyc_result = $conn -> query ($check_kyc2);

if ($kyc_result -> num_rows > 0 ){
   // echo 
   // "<h4 onclick='see_more()'>See more...</h4>";

    while($get_kyc_result = $kyc_result -> fetch_assoc()){



$DOB = date("F d Y" ,strtotime($get_kyc_result["DOB"]));

//echo $DOB;


    echo " 
    <label for='DOB'><b>Date of birth:</b></label>
    <br>
    <input type ='text' value='$DOB'  disabled>


    <label for='DOB'><b>State of origin:</b></label>
    <br>
    <input type ='text' value='$get_kyc_result[State_origin]'  disabled>

    
    <label for='DOB'><b>LGA:</b></label>
    <br>
    <input type ='text' value='$get_kyc_result[LGA]' disabled>


    
    <label for='DOB'><b>Mother's first name:</b></label>
    <br>
    <input type ='text' value='$get_kyc_result[Mother_name]'  disabled>


    <label for='DOB'><b>Next of Kin:</b></label>
    <br>
    <input type ='text' value='$get_kyc_result[Next_kin]'  disabled>
    
    <br>
    
    <label for='occupation'><b>Occupation</label>
    <br>
    <input type='text' value='$get_kyc_result[Occupation]' disabled>

    ";

    }
   
}else{
    echo "<h3 style='text-align: center;color: red;'>Please upgrade to KYC2</h3>";
}



?>

</div>

</div>

<div class="additional-informaton"><p>
<a href="Verification.php">Upgrade to KYC 2</a></p>
<p onclick="alert('comming soon')">Upgrade to KYC 3</p>

</div>




<script src="profile.js"></script>
</body>
</html>