<?php


require_once "sessionPage.php";


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

<title>Transaction status</title>
</head>
<body>

<?php

require_once "Loader.php";

//var_dump($_SESSION);
if($_SESSION["Transaction_status"] == "Failed"){
    
    
echo "
<div class='Transaction-status-container'>

<h4>Transaction Failed </h4>


<p><i class='fa fa-warning'></i>
</p>

<p> $_SESSION[Transaction_reponse]</p>


<p> <a href='index'>Home</a></p>

<p><a href='sendmoney'>Retry</a></p>


</div>
";
}else{


//if($_SESSION["Transaction_status"] == "Success"){
    
    
    $amount = "₦" .number_format($_SESSION["AMOUNT"]). ".00";
    
    
echo "

<div class='success-transaction-container'>

<h4>Transaction Successful </h4>


<p><i class='fa fa-check'></i>
</p>$amount </p>


<p> <a href='index'>Home</a></p>

<p onclick=alert('Coming shortly,please check back soon')'> View Receipt</p>



</div>";



}/*else{
    
  //  header("Location: index.php");
    
  //  exit;
    
}*/

?>

<style>
body{

margin: 0;
font-size: 20px;
font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;

}


a:link{
color: white;
text-decoration: none;
}
a:visited{
    color: white;
}
.Transaction-status-container{


background-color: white;
text-align: center;

}
.Transaction-status-container h4{
color: red;
margin-bottom: 57px;

}
.Transaction-status-container p:nth-child(2){

background-color: red;
color: white;
border-radius: 50%;
width: 52px;
height: 52px;
margin: auto;
margin-bottom: 50px;

}
.Transaction-status-container i{
font-size: 40px;
text-align: center;
margin: auto;

}
.Transaction-status-container p:nth-child(3){
color: red;

}
.Transaction-status-container p:nth-child(4){

background-color: red;
color: white;
width: 50%;
margin: auto;
margin-top: 40px;
margin-bottom: 6px;
border-radius: 2rem;
padding: 6px 6px;

}
.Transaction-status-container p:nth-child(5){

background-color: red;
color: white;
width: 50%;
margin: auto;
margin-top: 40px;
margin-bottom: 6px;
border-radius: 2rem;
padding: 6px 6px;


}
.success-transaction-container{
background-color: white;
text-align: center;

}

.success-transaction-container h4{
color: mediumseagreen;
margin-bottom: 57px;


}

.success-transaction-container p:nth-child(2){

background-color: mediumseagreen;
color: white;
border-radius: 50%;
width: 50px;
height: 50px;
margin: auto;
margin-bottom: 50px;

}

.success-transaction-container i{
font-size: 40px;
text-align: center;
margin: auto;

}
.success-transaction-container p:nth-child(3){
color: mediumseagreen;
font-weight: lighter;

}
.success-transaction-container p:nth-child(4){

background-color: mediumseagreen;
color: white;
width: 50%;
margin: auto;
margin-top: 40px;
margin-bottom: 6px;
border-radius: 2rem;
padding: 6px 6px;

}
.success-transaction-container p:nth-child(5){

background-color: mediumseagreen;
color: white;
width: 50%;
margin: auto;
margin-top: 40px;
margin-bottom: 6px;
border-radius: 2rem;
padding: 6px 6px;


}

</style>




