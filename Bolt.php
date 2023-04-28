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

<!--p onclick="open_bolt_overlay()">open</p-->

<div class="Bolt-container-overlay">




<div class="Bolt-container">
<i class="fa fa-cancel"></i>
<span class="material-symbols-outlined" onclick="close_bolt_overlay()">arrow_back</span>
<p>Chat with bolt</p>
</div>

<div class="open-bolt-message">
<p onclick="alert('Coming soon')">Start a conversation</p>
</div>




<div class="Bolt-message-container-fluid">
<div class="Bolt-message-reply">
<!--i class="fa fa-cancel"></i-->
<span class="material-symbols-outlined" onclick="close_bolt()">arrow_back</span><br>

<img src="images/Bolt.jpeg">

<p>Zee Bolt</p>

</div>


<p class="auto-message">Hello i'm dera,i'm currently Unavailable at the moment.You can send your complains by clicking  <a href="mailto:Ajehabraham51@yahoo.com"> here</a> or send a direct message to our customer care agent.Thanks for choosing lazerwave.</p>

</div>





</div>



<style>

body{
margin: 0;
background-color: #f1f1f1;
font-size: 15px;
}

.Bolt-container-overlay{

left: 0;
top: 0;
bottom: 0;
right: 0;
position: fixed;
overflow: hidden;
background-color: white;
width:  0%;
transition: 0.3s;
z-index: 1;
}
.Bolt-container{
background-color: rgb(0,0,100);
color: white;
padding: 8px 8px;
}
.Bolt-container i:nth-child(1){
float: right;
color:  white;
margin-top: 7px;
font-size: 20px;

}
.Bolt-container p{
font-size: 20px;
font-weight: bold;
text-align: center;
}


.open-bolt-message{
margin-top: -20px;
padding: 10px 10px;
background-color: white;
width: 90%;
border-radius: 1rem;
z-index: 1;
margin-left: auto;
margin-right: auto;
display: block;
text-align: center;
box-shadow: 0px 8px 8px 0px rgba(0,0,0,0.5);
color: rgb(0,0,100);
font-size: 20px;
font-weight: bold;
}
.open-bolt-message:active,.open-bolt-message:hover{
background-color: red;
color: white;
}

.Bolt-message-container-fluid{

left: 0;
top: 0;
bottom: 0;
right: 0;
position: fixed;
overflow: hidden;
background-color: #f1f1f1;
width: 0%;
transition: 0.2s;

}
.Bolt-message-container-fluid img{
width: 60px;
height: 60px;
border-radius: 50%;
margin-left:auto;
margin-right: auto;
display: block;

}

.Bolt-message-reply{
padding: 10px 10px;

background-color: red;
color: white;
}

.Bolt-message-reply i{
float: right;
margin-top: 6px;

}
.Bolt-message-reply p{
text-align: center;
font-size: 20px;
font-weight: bold;

}
.auto-message{
background-color: white;
border-radius: 2rem;
padding: 10px 10px;
text-align: center;
width: 60%;
margin-right: 5px;
color: #666;
}

.auto-message a:link{
font-weight: bold;
color: black;
}

</style>




<script>

function open_bolt_overlay(){
document.querySelector(".Bolt-container-overlay").style.width="100%";

}

function close_bolt_overlay(){

document.querySelector(".Bolt-container-overlay").style.width="0%";
}

function open_bolt(){

document.querySelector(".Bolt-message-container-fluid").style.width="100%";

}

function close_bolt(){
document.querySelector(".Bolt-message-container-fluid").style.width="0%";

}


</script>

</body>
</html>