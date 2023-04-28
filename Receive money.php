<?php

require_once __DIR__.("/sessionPage.php");


echo "<title>Account top up</title>";

require_once __DIR__.("/Network.php");

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

<title>Receive money</title>
</head>
<body>


<div class="header">
<span class="material-symbols-outlined" onclick="window.history.back()">arrow_back</span>

<a href="index.php">
<i class="fa fa-home"></i></a>

</div>


<div class="send-money-container-fluid">

<p onclick="show_acct_no()"><i class="fa fa-bank"></i> Bank Transfer 
</p>

<h3 class="acct_no">
    Account name: <?php echo $user["Surname"] ." " .$user["Last_name"]. " ".$user["First_name"]; ?>
    
    <br>
    
Account no: <?php echo  $user['Account_no'] ?><br> 
Bank: Lazerwave
<br>

<i class="fa fa-copy" style="color: white;cursor: pointer;" onclick="copyNo()"></i>copy</h3>

<input type="text" style="display:none" value="<?php echo $user['Account_no']?>"  id="myInput">






<p><i class="fa fa-credit-card"></i>
 <a href="Top up">Card top up</a></p>


<p><i class="fa fa-money"></i>  <a href="Request money">Request money</a></p>

<p><i class="fa fa-link"></i> <a href="create payment link">Create payment link</a></p>

<p onclick="alert('coming shortly')"><i class="fa fa-qrcode"></i> Scan QR code</p>
 

</div>


<style>
body{
    
    margin: 0;
    font-size: 15px;

    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    
    font-weight: lighter;
    
    
}
.header{
padding: 5px 5px;
color: rgb(0,0,180);

}
/*.header span{
color: ;

}*/
.header i{
margin-top: 5px;
float: right;
}
.header a:link{
text-decoration: none;
color: rgb(0,0,180);
}
.header a:visited{
color: rgb(0,0,180);
}

.Dark-mode .send-money-container-fluid p{
    background-color: black;
    color: white;
    box-shadow: 0px 16px 8px 0px #ccc;
}
.Dark-mode .send-money-container i{
    color: white;
}
.Dark-mode {
    background-color: black;
    color: white;
}
.Dark-mode .send-money-container-fluid  a:link{
    color: white;
}
.Dark-mode .send-money-container-fluid  a:visited{
    color: white;
}
.Dark-mode .send-money-container-fluid  i{
    color: white;
}
.send-money-container-fluid{
padding: 5px;
margin-top: 10px;
}
.send-money-container-fluid p{
padding: 18px 18px;
background-color: white;
box-shadow: 0px 16px 8px 0px rgba(0,0,0,0.2);

	}
  .acct_no{
  display: none;
  }

  .send-money-container-fluid i{
  color: rgb(0,0,180);
  margin-right: 7px;
  }
  .send-money-container-fluid a:link{
  text-decoration: none;
  color: black;
  }
  .send-money-container-fluid a:visited{
  color: black;
  }
  
    .acct_no a:link{
      color: white;
  }
  .acct_no a:visited{
      color: white;
  }
  
  h3{
      border-radius: 1rem ;
      font-weight: lighter;
      padding: 9px 9px;
      color: white;
      margin: auto;
      width: 90%;
      text-align: center;
      background-color: rgb(0,0,52);
  }
  h3 i{
      color: black;
  }
  h3  a:link{
      color: white;
      text-decoration: none;
  }
  h3 a:visited{
      color: white;
  }
  @media screen only(max-height:600px){
      
      h3{
          
          width: 60%;
      }
  }
</style>


<script>
function show_acct_no(){
var acct =document.querySelector(".acct_no");


if(acct.style.display == "none"){

acct.style.display= "block";
}else{
acct.style.display= "none";
}


}


function copyNo(){
var AccountNumber=
document.getElementById("myInput");
AccountNumber.select();
AccountNumber.setSelectionRange(0,99999);
navigator.clipboard.writeText(
AccountNumber.value);
alert("Account Number copied to Clipboard");
/*
document.getElementById("copy").innerText="Copied";*/
}
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
