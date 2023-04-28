<?php

session_start();

session_regenerate_id();

/*
session_start();

if (isset($_SESSION["Email"])){

}else{
  header("location:checkReg.php");
  exit;
}
*/
require_once __DIR__.("/Daily visitors.php");

require __DIR__.("/Network.php");


?>

<!DOCTYPE html>
<html lang="eng_US">
  <head>
    <link rel="stylesheet" href="Register.css">
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
<title>Register</title>



<!-- ajax and jquery link -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<script src= "https://code.jquery.com/jquery-3.5.0.js"></script>

<!-- end of ajax link -->

      </head>
      <body>
          
          
          <p class="home"><a href="index">

<i class="fa fa-home"></i> Home
</a></p>


<?php require_once __DIR__.("/logo.php"); ?>





<div class="container-image">
    

<div class="form-container-fluid">

<h2>Register</h2>

<form method ="post"id="formId">

<label for="Surname">Surname</label>
<br>

<input type="text" name="surname" placeholder="Your surname...." onkeyup="this.value = this.value.toUpperCase();">

<br>



<label for="last-name">Lastname(optional)</label>
<br>

<input type="text" name="last_name" placeholder="Your Last name...." onkeyup="this.value = this.value.toUpperCase();">

<br>


<label for="First-name">Firstname</label>
<br>

<input type="text" name="first_name" placeholder="Your First name...." onkeyup="this.value = this.value.toUpperCase();">

<br>


<label for="Gender">Gender</label>
<br>
Male
<input type="radio" name="Gender"
value="Male" value="Male">
Female

<input type="radio"name="Gender" value="Female" value="Female">

<br>
<div class="custom-select" style="width:70%;">
<p>Country</p>

<select name="Country">

<option> </option>
<option>Ghana</option>
<option>South Africa</option>
<option>Nigeria</option>

</select>

</div>

<br>

<label for="email">Email</label>
<br>

<input type="email" name="email" placeholder="Your email address....">

<br>

<label for="Password">Password</label>
<br>

<input type="password" name="Password" placeholder="Enter  8 digit password....">

<br>

<?php


//FIRST CHECK IF LINK IS PRESENT

if($_SERVER["REQUEST_METHOD"] == "GET"){

if(isset($_GET["referalcode"])){
    
    
    $referal_code =htmlspecialchars($_GET["referalcode"]);
    
    if(!empty($referal_code)){



require_once __DIR__.("/db_connection.php");

//FETCH REFERAL LINK //


$select ="SELECT * FROM Refer_and_Earn WHERE Referal_code ='$referal_code'";

$result = $conn -> query($select);


if($result -> num_rows > 0){
    
    
    //CODE MATCH ONE IN DATABASE//
    
    
    $code_result = $result -> fetch_assoc();
    
   /* echo "<label for='Refer-code'>Referal code</label>
    <br>
    <input type='text' value='$code_result[Referal_code]'   name='referal_code'  disabled> 
    
    
    <br>
    ";
    */
    
    
    $details = '<label for="Refer-code">Referal code</label>
    <br>
     
    
<input type="text" name="code" value='.$code_result['Referal_code'].' readonly>


    
    <br>'
;
    
    
    
    
    
}else{
    
    //NO CODE MATCH
    
    
    
    
    
}





}



}




}

//if(isset($details)){
    
    //echo $details;
    
//}


?>

<?php if(isset($details)){
    
    echo $details;
    
}
?>



<p>
<input type="checkbox"name="terms" value="yes"> i have agree to the terms and conditions. </p>

<p><a href="#">
Privacy policy </a></p>
<p><a href="#">
Cookie policy </a></p>
<p><a href="#">
Terms and conditions</a></p>



<input type="submit" value="Register" id="submitButton">
<br>

</form>
<p class="error_message"></p>
<p class="Login"><a href="Login">Login</a></p>


</div>
    </div>


<div class="loader-overlay">

<div class="loader-message">
</div>
</div>



<?php require_once __DIR__.("/show addvert.php"); ?>
          

<script src="Register.js"></script>


<?php


if(isset($_COOKIE["Cookie_consent"])){
    
    
    
}else{
    
    
    require_once "Cookie banner.php";
    
}
?>

    </body>
    </html>


  <?php require_once __DIR__.("/footer.php") ?>


