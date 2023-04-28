<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

  header("Location: Warning.php");
  exit;

      header('HTTP/1.0 403 Forbiddden',TRUE,403);
      die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}
?>


<!DOCTYPE html>
<html lang="eng_US">
  <head>
    <link rel="stylesheet" href="">
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

<title>Addvert</title>
</head>
<body>

<div class="addvert-container-fluid">

<div class="addvert-one-container">

<p>Refer & Earn</p>


<p>₦1,000 bonus</p>

<p>When you share with family and friends </p>



<?php if(!isset($_SESSION["New_user"])):?>

<p class="get-started-add"><a href="Login">Get started</a></p>


<?php endif;?>


<?php if(isset($_SESSION["New_user"])) :?>



<p class="get-started-add"><a href="Refer and Earn">Get started</a></p>

<?php endif; ?>


</div>


 <form method="post" id="setaddForm">
 
<input type="hidden"name="addvert_one" value="addvert-one">


<i class="fa fa-close" id="setAddButton" ></i>


</form>

<p style="text-align: center;color: red" class="add_error_message"></p>



</div>



<style>
/*
body{
    
    margin: 0;
    font-size: 15px;

    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    
    font-weight: lighter;
    background-color: #f1f1f1;
    
   
    
}*/
.addvert-container-fluid{
position: fixed;
left: 0;
bottom: 0;
right: 0;
top: 0;
background-color: rgba(0,0,0,0.3);
display: none;
z-index: 1;
transition: 0.3s;
overflow-y: scroll;
}
/*
.addvert-container-fluid img{
margin-left: auto;
margin-right: auto;
display: block;
width: 30%;
}*/
.addvert-one-container{
background-color: black;
color: white;
margin: auto;
text-align: center;
width: 80%;
border-radius: 1rem;
padding: 10px 10px;
font-size: 18px;
box-shadow: 0px 16px 8px 0px rgb(0,0,100);
margin-top: 2%;

}
.addvert-container-fluid i{
border-radius: 50%;
width: 25px;
height: 25px;
font-size: 22px;
color: white;
margin-left: auto;
margin-right: auto;
display: block;
margin-top: 20px;
background-color: rgba(255,0,0,0.4);
text-align: center;
}
@media only screen and (min-width: 600px){
.addvert-one-container
{
    margin-top: 2%;

width: 70%;

}

}
/*
FOR MOBILE*/
@media only screen and (min-width: 768px) {
.addvert-one-container{
margin-top: 6%;
width: 90%;
}
}

.addvert-one-container p:nth-child(1)
{
font-weight: bold;

}
.addvert-one-container p:nth-child(2)
{
font-weight: bold;
font-size: 26px;
box-shadow: 0px 16px 8px 0px rgba(0,0,0,0.5);


text-shadow: 8px 16px rgba(255,0,0,0);
padding: 5px 5px;

}

.addvert-one-container p:nth-child(3)
{
font-weight: bold;
font-size: 16px;


}
/*
.addvert-one-container p:nth-child(4)*/
.get-started-add

{
width: 62%;
padding: 7px 7px;
background-color: rgb(0,0,100);
color: white;
margin: auto;
border-radius: 2rem;
margin-bottom: 30px;
margin-top: 30px;
font-size: 20px;
font-weight: bold;
}
.get-started-add a:link{
    text-decoration: none;
    color: white;
}
.get-started-add a:visited{
    color: white;
}
</style>



<script>

$(() => {
    
    $("#setAddButton").click(function(ev){
        (ev).preventDefault();
        
        
        document.querySelector(".addvert-container-fluid").style.display="none";
    
    var form = $("#setaddForm");
    var url = "set cookie.php";
    
    $.ajax ({
      type: "POST",
      url: url,
      data: form.serialize(),
    dataType:'json',
    encode: true,
    success: function(data){
        //form has beeen submitted//
    
        console.log();
    
        
        var error = document.querySelector(".add_error_message");
    
    error.innerHTML = data.responseText;
    
      //  alert("Form submitted successfully");
    
      },
      error: function(data){
   
        var error = document.querySelector(".error_message");
    
    error.innerHTML = data.responseText;
    
       
    
    }
    });
    });
    
    });
    
    //END OF OTP BTN//
    
    function ShowAddvert(){
    
    document.querySelector(".addvert-container-fluid").style.display="block";
    
    }
    window.onload= setTimeout(ShowAddvert,4000);
    
    
    
    </script>