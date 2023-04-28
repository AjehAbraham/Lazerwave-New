<?php 

require_once __DIR__.("/sessionPage.php");


if (!isset($_SESSION["New_user"])){
  header("location: Login.php");
  exit;
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
         
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.debug.js"></script>
<link rel="preconnect" href="https://fonts.googleapis.com"> 
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
<link href="https://fonts.googleapis.com/css2?family=Encode+Sans:wght@300&family=Island+Moments&family=Oswald:wght@200&family=PT+Serif:wght@700&family=Roboto+Mono:wght@100&display=swap" rel="stylesheet">


<script src="https://kit.fontawesome.com/958aace4f6.js" crossorigin="anonymous"></script>
<title>Saved beneficiary</title>
      </head>
      <body>

      <?php
        
        require_once __DIR__.("/Network.php");
        ?>
              
                <span class="material-symbols-outlined" onclick="window.history.back()">arrow_back</span>
                 
                <a href="index.php"><i class="fa fa-home"style="float:right;font-size:15px;margin-top:1px;"></i>
                 </a> 



<style>
    body{
      

font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;

font-weight: lighter;
    margin: 0;
    font-size: 15px;  
    }
i{
  cursor: pointer;
}
span{
  cursor: pointer;
}
    .save-beneficairy-container{
       /* overflow-y: scroll;*/
    }

    .save-beneficairy-container h1{

text-align: center;
font-size: 18px;
color: rgba(255,0,0,0.4);
padding: 5px 5px;
/*
padding: 10px 10px;
background-color: mediumseagreen;
color: white;*/

    }
.save-beneficairy-container p{
color: white;
padding: 5px 5px;
/*border: 2px solid rgb(0,0,100);*/
text-align: center;
margin: auto;
width: 90%;
background-color: rgba(0,0,100);
}

.save-beneficairy-container p a:link{
    
    text-decoration: none;
    color: white;
}

.save-beneficairy-container    p:hover{
    
    
    background-color: red;
}
p:active{
    background-color: red;
}
.save-beneficairy-container p input[type=radio]{

    float: left;
}


.save-beneficairy-container  input[type=submit]{
margin-top: 12px;
background-color: mediumseagreen;
color: white;
margin-right: auto;
display: block;
margin-left: auto;
width: 70%;
border: none;
padding: 10px 10px;
font-size: 20px;
border-radius: 2rem;
}
.Dark-mode {
    background-color: black;
    color: white;
}
.Dark-mode i{
    color: white;
}
.Dark-mode a:link{
    color: white;
}
.Dark-mode a:visited{
    color: white;
}
.Dark-mode h1{
    color: white;
}
    </style>



<div class='save-beneficairy-container'>

<h1>Saved Beneficiary</h1>

<form method="post" action="sendmoney.php">


<?php

//check for save beneficiary

require_once __DIR__.("/db_connection.php");

$select_bene = "SELECT * FROM Beneficiary WHERE User_id = '$user[id]'";


$bene_result = $conn -> query($select_bene);


if ($bene_result -> num_rows > 0){

    while($saved_result = $bene_result -> fetch_assoc()){


  echo "
  <p> <input type='radio' value='$saved_result[Acct_no]' name='saved_beneficiary'>$saved_result[Full_name] <br> $saved_result[Acct_no]</p>
<br>";

    }


}else{

  echo "<p style='text-align: cneter;'>No beneficiary found,click continue to procced</p>";
}


?>


<input type="submit" value="continue">
</form>

</div>


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