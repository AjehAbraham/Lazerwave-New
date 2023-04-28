<?php require_once __DIR__.("/sessionPage.php");


if (!isset($_SESSION["New_user"])){
    header("location: Login.php");
    exit;
}

//require_once __DIR__.("/Network.php");



//create hash key for hidden field for payment link

$hash = rand(9999,99999) .uniqid();

?>


<!DOCTYPE html>
<html lang="eng_US">
  <head>
    <link rel="stylesheet" href="setting.css">
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
<title>settings</title>


<!-- ajax and jquery link -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<script src= "https://code.jquery.com/jquery-3.5.0.js"></script>

<!-- end of ajax link -->

      </head>
      <body>
          
          
          <?php require_once __DIR__.("/Network.php"); ?>
          
          
              

        <div class="setting-container">
           <a href="index"> <i class="fa fa-home" style="float:right;margin-top:1px;font-size:15px;"></i>
</a>
<span class="material-symbols-outlined" onclick="window.history.back()" style="color:rgb(0,0,180);">arrow_back</span>

            <!--h1><i class="fa fa-cogs"> </i> Settings</h1-->

         <a href="profile"><p><i class="fa fa-user-circle" ></i> Profile</p></a>
           <a href="New Transaction"> <p><i class="fa fa-book"></i> Transaction history</p></a>
    
           <a href="Bank card"> <p><i class="fa fa-credit-card-alt"></i> Bank card </p></a>

           <a href="AccountStatistic"> <p ><i class="fa fa-bar-chart"></i> Account statistic</p></a>

            
            <p class="open-security"><i class="fa fa-shield"></i>  Security</p>

           <a href="Verification"> <p><i class="fa fa-user-plus"></i> Verification</p></a>

            <p onclick=" openPayment_link()"><i class="fa fa-share-square-o"></i> Payment link</p>
            
             <a href="Refer and Earn"><p><i class="fa fa-money"></i>Refer and Earn</p></a>

            

            <p  onclick="Open_account_limit_pop_up()"><i class="fa fa-object-group"></i> Account Limit</p>


            <div class="account-limit-overlay-container">

<div class="account-limit-container">
<p onclick="Close_account_limit_pop_up()"><i class='fa fa-close'></i></p>

<h1>Account limit </h1>

<p>Kyc 1 </p>
      <div class='Kyc1-container'>₦10,000 daily</div>


      <p>Kyc 2 </p>
      <div class='Kyc2-container'>₦50,000</div>



      <p>Kyc 3 </p>
      <div class='Kyc3-container'>Unlimited</div>




</div>
</div>






            <input type="hidden" value="lazerwave.000webhostapp.com/payment?name=<?php echo $hash;?>&user<?php echo $user['Surname'] .$user['Last_name'].
            $user['First_name'] ?>&id=<?php echo $_SESSION['New_user'] ?>"id="payment-link">
          
            <p class="open-report-container"><i class="fa fa-exclamation-circle"></i> Report scam</p>
           
            <p class="delete-account" onclick="alert('Please send an email to customer care')"><i class="fa fa-user-times"></i> Delete Account</p>

            <p class="share"><i class="fa fa-share-alt"></i> Share</p>
            
            <p><i class="fa fa-globe"></i><label class="switch">
  <input type="checkbox" onclick="Darkmode()" id="theme">
  <span class="round slider"></span>
</label> Dark mode
</p>
            
            
            <br>
            <br>
            <br>
   
           
        </div>




<div class="payment-link-overlay">
        <div class="Payment-link-container">
            <i class="fa fa-close" onclick="closePayment_link()"></i>

        <div class="flex-box">
            <p class="copy-payment-link">Copy Link</p>
            <p><a href="create payment link">Create Link </a></p>

</div>
</div>
</div>



        
<div class="security-container">
    <span class="material-symbols-outlined" id="close-security-btn">close</span>
    <h1><i class="fa fa-gear"></i>Security</h1>

<p class="open-transaction-pin"><i class="fa fa-key"></i> Transaction pin </p>

<p class="open-change-password"><i class="fa fa-lock"></i> Change password </p>


<p><a href="Blockaccount"><i class="fa fa-user-times"></i> Block Account </a></p>

<p onclick="alert('Sorry for security reasons you cannot change this at the moment')"><i class="fa fa-lock"></i><label class="switch"><input type="checkbox" name="two-factor" value="2factor" checked disabled><span class="round slider"></span></label>Two factor  Authentication</p>

<br>
<br>
<br>
</div>



<div class="transaction-pin-container">
    <span class="material-symbols-outlined" id="close_transaction_container_rr">close</span>




    <?php
//CHECJ IF USER HAS CREATED PIN ALREADY


$pin_check = "SELECT * FROM User_pin WHERE User_id= '$_SESSION[New_user]'";


$pin_result = $conn -> query($pin_check);



if ($pin_result -> num_rows > 0){

//MEANS USER HAS ALREADY CREATED TRANSACTION PIN


//YOU NEED TO UPDATE THEIR PIN INSTEAD


echo "
<h1><i class='fa fa-key'></i> Change Transaction pin</h1>
<br>
<form method='post' id='Update_Pin_formId'>
<label for='old-pin'><b> pin</b></label>
<br>
<input type='number' name='new_pin'
inputmode='numeric' style='-webkit-text-security:disc;' maxlength='4' placeholder='Old pin...'>

<br>
<label for='new-pin'><b>New pin</b></label>
<br>
<input type='number'  inputmode=' numeric'name='password' style='-webkit-text-security:disc;' placeholder='Enter New pin'>
<br>



<input type='submit' id='Update_submitButton' value='change pin'>

<p class='error_message_update_pin'></p>

</form>";







}else{

//USER HAS NOT CREATED YET


echo "
<h1><i class='fa fa-key'></i> Create  Transaction pin</h1>
<br>
<form method='post' id='Pin_formId'>
<label for='old-pin'><b> pin</b></label>
<br>
<input type='number' name='new_pin'  inputmode='numeric' style='-webkit-text-security:disc;' placeholde='New pin..'>
<br>
<label for='new-pin'><b>Confirm pin</b></label>
<br>
<input type='number' name='confirm-pin' inputmode='numeric' style='-webkit-text-security:disc;' placeholder='Re-enter new pin...'>
<br>
<input type='submit' id='Pin_submitButton' value='change pin'>

<p class='error_message'></p>

</form>";






}


?>


</div>



<div class="change-password-container">

    <div class="loader-overlay">
        <div class="loader-message">
</div>
</div>



    <span class="material-symbols-outlined" id="close-change-password-btn">close</span>

<h1><i class="fa fa-lock"></i> Change password</h1>
<br>
<form method="post" id="formId" >
    <label for="old-password"><b>Old pasword</b></label>
    <br>
    <input type="password" name="old-password" placeholder="Old password...">
    <br>
    <label for="new-password"><b>New password</b></label>
    <br>
    <input type="password" name="new-password" placeholder="New password...">
    <br>
    <label for="confirm-password"><b>Confirm password</b></label>
    <br>
    <input type="password" name="confirm-password" placeholder="Re-enter new password...">
    <br>
    <input type="submit" id="submitButton" value="change password">
    </form>
    <p class="error_message_change_password"></p>

</div>









<div class="report-scam-container">
    <span class="material-symbols-outlined" id="close-report-container-btn">close</span>
    <h1><i class="fa fa-support"></i> Complain via</h1>

    <div class="support">
   <a href="mailto:ajehabraham51@gmail.com"> <i class="fa fa-google"></a></i>
   <a href="mailto:ajehabraham51@gmail.com"> <i class="fa fa-envelope"></a></i>
   
   <i class="fa fa-user-circle" onclick="alert('Live chat comming soon')"></i>
    </div>

</div>




<!---div class="Account-limit-overlay">

<div class="account-limit">

<h1>Acocunt Limit</h1>

tliokiku

<div class="Kyc1"></div>


<div class="kyc2"></div>

<div class="kyc3"></div>


<div>
</div>

<style>
.Account-limit-overlay{
   position: fixed;
    overflow-y: scroll;
background-color: rgba(255,255,0.6);
font-style: 25px;
}
.account-limit{

    background-color: white;
    color: rgb(0,0,180);
}
.kyc1{
    padding: 10px 10px;
border-radius: 2rem;
    background-color: mediumseagreen;
    color: white;


}
    </style-->




<script src="setting.js"></script>
        </body>
        </html>