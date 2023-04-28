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

<link href="https://fonts.googleapis.com/css2?family=Tilt+Prism&display=swap" rel="stylesheet">


<title>Live chat</title>
</head>
<body>
    <?php

require_once __DIR__.("/Bolt.php");
?>

    
    
    
    
<div class="openLivechat-btn">


<i class="fa fa-message"onclick="Open_livechat()"></i>

</div>






<div class="live-chat-container">



<div class="live-chat-box">
<p>
<i class="fa fa-close"onclick="close_livechat()"></i></p>


<p>Help  Center <i class="fa fa-info-circle"></i> </p>




<p onclick="open_bolt_overlay()">Message us</p>


<form method=""  id="Livechat_formId">

<input type="search" placeholder="start typing...."size="30" id="fname" name="fname" onkeyup="showHint(this.value)">

<input type="submit" value="Search" id="Livechat_submitButton">

</form>

<p>Suggestions: <span id="txtHint"></span>

</div>



<div class="search-result-container" id="livechat_error_message">

</div>

</div>




<style>
body{
margin: 0;
font-size: 13px;
}
.openLivechat-btn{
border-radius: 50%;
width: 60px;
height: 60px;
background-color: rgb(0,0,100);
color: white;
float: right;
margin-right: 12px;
text-align: center;
position: sticky;
top: 0;
}
-webkit .openLivechat-btn{
position: sticky;
}

.openLivechat-btn i{
font-size: 48px;
margin: auto;
margin-top: 7px;

}
.live-chat-container{

width: 0%;
height: 100%;
background-color: #f1f1f1;
position: fixed;
top: 0;
bottom: 0;
left: 0;
right: 0;
transition: 0.3s;
overflow-y: scroll;
font-size: 13px;
}
.live-chat-box{
background-color: rgb(0,0,100);
color: white;
top: 0;
padding: 10px 10px;
}

.live-chat-box p:nth-child(1){
text-align: center;
font-size: 22px;
font-weight: bold;
padding: 7px 7px;
border-radius: 50%;
width: 28px;
height: 28px;
margin: auto;
background-color: rgba(255,0,0,0.4);

}
.live-chat-box p:nth-child(2){
text-align: center;
font-size: 13px;
font-weight: bold;

}
.live-chat-box p:nth-child(3){
background-color: red;
padding: 6px 6px;
margin-top: 12px;
margin-bottom: 12px;
text-align: center;
border-radius: 2rem;
width: 50%;
font-size: 13px;
font-weight: bold;
}
.live-chat-box p:nth-child(5){

font-size: 13px;
}
.live-chat-box input[type=search]{
padding: 10px 10px;
font-size: 18px;
outline: 0;
margin-top: 7px;
margin-bottom: 7px;
border-radius: 2rem;
}
.live-chat-box input[type=submit]{
padding: 10px 10px;
border: none;
background-color: mediumseagreen;
font-size: 20px;
color: white ;

border-radius: 2rem;
}
.search-result-container{
background-color: white;
text-align: center;
padding: 2px;
box-shadow: 0px 8px 8px 0px rgb(0,0,100);
margin-bottom: 13px;
}
.search-result-container h2{
color: rgb(0,0,180);
}
.search-result-container p{
color: #555;
font-weight: lighter;
}
</style>



<script>
function showHint(str) {
  if (str.length == 0) { 
    document.getElementById("txtHint").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET", "Text hint.php?q=" + str, true);
    xmlhttp.send();
  }
}

function Open_livechat(){
document.querySelector(".live-chat-container").style.width="100%";


}

function close_livechat(){

document.querySelector(".live-chat-container").style.width="0%";

}



$(() => {
    
    $("#Livechat_submitButton").click(function(ev){
        (ev).preventDefault();
    
    var form = $("#Livechat_formId");
    var url = "search response.php";
    
    $.ajax ({
      type: "POST",
      url: url,
      data: form.serialize(),
    dataType:'json',
    encode: true,
    success: function(data){
        //form has beeen submitted//
    
        console.log();
       
        var error = document.querySelector("#livechat_error_message");
    
    error.innerHTML = data.responseText;
    
      //  alert("Form submitted successfully");
    
      },
      error: function(data){
    
    document.querySelector("#Livechat_formId").reset();
        var error = document.querySelector("#livechat_error_message");
    
    error.innerHTML = data.responseText;
    
       
    
    }
    });
    });
    
    });
    
    
    
    //OPEN USERNAME //

</script>



</body>

</html>