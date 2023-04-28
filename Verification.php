<?php require_once __DIR__.("/sessionPage.php") ;


if (!isset($_SESSION["New_user"])){
  header("location:login.php");
  exit;
}

//require_once __DIR__.("/Network.php");

?>


<!DOCTYPE html>
<html lang="eng_US">
  <head>
    <link rel="stylesheet" href="Verification.css">
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
<title>Verification</title>
      </head>
      <body>

        <div class="verification-container">
<span class="material-symbols-outlined" onclick="window.history.back()">arrow_back</span>
<a href="index">
<i class="fa fa-home"style="float:right;font-size:15px;margin-top:1px"></i></a>


<?php require_once "Network.php";
?>

<!--p onclick="alert('opp!,we are still working on this')"><i class="fa fa-id-card"></i> NIN verification <i class="fa fa-times-circle" style="color:red;margin-left:10px;margin-right:0px"></i></p-->

<p onclick="alert('opp!,we are still working on this')"><i class="fa fa-user-plus"></i>KYC 3 upgrade <i class="fa fa-times-circle" style="color: red;margin-left:10px;margin-right:0px"></i></p>


<p ><a href="Kyc2"><i class="fa fa-user-circle"></i> KYC 2 upgrade<i class="fa fa-times-circle" style="color:red;margin-left:10px;margin-right:0px"></i></a></p>




        </div>
        
        
        
        <script>
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
        
        
        
        