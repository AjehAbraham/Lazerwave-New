<?php

require_once __DIR__.("/sessionPage.php");

//require_once __DIR__.("/Network.php");


?>


<!DOCTYPE html>
<html lang="eng_US">
  <head>
    <link rel="stylesheet" href="setting.css">
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width,initial-scale=1.0">
 <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
         

<script src="https://kit.fontawesome.com/958aace4f6.js" crossorigin="anonymous"></script>

<!-- ajax and jquery link -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<script src= "https://code.jquery.com/jquery-3.5.0.js"></script>

<!-- end of ajax link -->


<link href="https://fonts.googleapis.com/css2?family=Encode+Sans:wght@300&family=Island+Moments&family=Oswald:wght@200&family=PT+Serif:wght@700&family=Roboto+Mono:wght@100&display=swap" rel="stylesheet">

<title>Request Money</title>
</head>
<body>
    
    
    <?php require_once __DIR__.("/Network.php");
    ?>
<div class="top-nav">

<span class="material-symbols-outlined"onclick="window.history.back()">arrow_back</span>

<a href="index.php">
<i class="fa fa-home"></i></a>

</div>

<div class="form-container-fluid">

<h1><i class="fa fa-money"></i>Send Request</h1>

<p>Note you can send money request  by using
either the username or account number of who you want to send request.</p>

<form id="formId">

<label for="username"><b>Username/Acct no
</lable>
<br>

<input type="text"placeholder="Username or Acct no..." name="Request">

<br>

<input type="number" placeholder="Amount..."name="amount" inputmode="numeric">
<br>
<input type="submit" id="submitButton"value="Request
">
</form>


</div>


<p class="error_message"></p>
<style>
body{
    
    margin: 0;
    font-size: 15px;

    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    
    font-weight: lighter;
    
    
    
}
.top-nav {
padding: 5px 5px;
}
.top-nav i{
margin-top: 5px;
float: right;
color: rgb(0,0,180);
}
.top-nav span{
color: rgb(0,0,180);
}
.top-nav a:link{
color: rgb(0,0,180);
text-decoration: none;
}
.top-nav a:visited{
color: rgb(0,0,180);
}
.Dark-mode {
    background-color: black;
    color: white;
}
.Dark-mode .form-container{
    background-color: black;
    color: white;
}
.Dark-mode input[type=text]{
    background-color: #f1f1f1;
}
.Dark-mode .top-nav a:link,a:visited,span,i{
    color: white;
}
.Dark-mode label{
    color: white;
}
.form-container-fluid{
margin:auto;
width: 90%;
padding: 5px 5px;
text-align: center;
}
.form-container-fluid i{
margin-right: 10px;
color: rgb(0,0,180);
}
.form-container-fluid h1{
color: red;
border-bottom: 10px solid rgb(0,0,100);
font-size: 20px;
}
.form-container-fluid p{
text-align: justify;
}
.form-container-fluid input[type=text]{
padding: 8px 8px;
outline: none;
border: 2px solid #ccc;
font-size: 18px;
width: 90%;
margin-top: 10px;
margin-bottom: 10px;
}
.form-container-fluid input[type=number]{
padding: 8px 8px;
outline: none;
border: 2px solid #ccc;
font-size: 18px;
width: 90%;
margin-top: 10px;
margin-bottom: 10px;
}


.form-container-fluid input[type=submit]{
padding: 8px 8px;
width: 65%;
background-color: rgb(0,0,56);
border: none;
color: white;
font-size: 18px;
	
}

.loader-overlay{
background-color: rgba(255,255,255,0.8);
position: fixed;
width: 100%;
height: 100%;
left: 0;
right: 0;
top: 0;
bottom: 0;
display: none;
}
.loader{
border-radius: 50%;
width: 100px;
height: 100px;
border: 10px solid #f1f1f1;
border-top: 10px solid rgb(0,0,100);
margin: -70px 0 0 -70px;
left: 50%;
top: 50%;
position: absolute;
animation: spin 2s linear infinite;
}
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

</style>

<div class="loader-overlay">
<div class="loader">
</div>
</div>

<script>

function close_otp_message(){

  document.querySelector(".form-status-message-overlay").style.display = "none";
  
  
  }
    
    //REQUEST FOR OTP BTN TO SEND OTP//
    
    $(() => {
    
    $("#submitButton").click(function(ev){
        (ev).preventDefault();
    
    document.querySelector(".loader-overlay").style.display = "block";
    
    
    ////
    
    var form = $("#formId");
    var url = "Request process.php";
    
    $.ajax ({
      type: "POST",
      url: url,
      data: form.serialize(),
    dataType:'json',
    encode: true,
    success: function(data){
        //form has beeen submitted//
    
        console.log();
    
        document.querySelector(".loader-overlay").style.display = "none";
    
       
        var error = document.querySelector(".error_message");
    
    error.innerHTML = data.responseText;
    
      //  alert("Form submitted successfully");
    
      },
      error: function(data){
    document.querySelector(".loader-overlay").style.display = "none";
    
        var error = document.querySelector(".error_message");
    
    error.innerHTML = data.responseText;
    
        
        //document.querySelector(".mmm").innerHTML=JSON.stringify(data);
        
    
    
    }
    });
    });
    
    });
    
    //END OF OTP BTN//
    
    function Checkmode(){

var current_mode = localStorage.getItem("Theme");

if(current_mode == "Dark-mode"){


var dark = document.body;

dark.classList.add("Dark-mode");


document.querySelector("#theme").checked= true;


}else{

var dark = document.body;

dark.classList.add("Light-mode");

document.querySelector("#theme").checked= false;




}


}

var mode = Checkmode();

    
</script>



</body>
</html>