<?php require_once __DIR__.("/sessionPage.php");



if (!isset($_SESSION["New_user"])){
  header("location:login.php");
  exit;
}
echo "<title>Transaction Receipt</title>";

require_once __DIR__.("/Network.php");

?>


<!DOCTYPE html>
<html lang="eng_US">
  <head>
    <link rel="stylesheet" href="ViewTransaction.css">
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
<title>Transaction history</title>
      </head>
      <body>

        <div class="transaction-history-container">

            <a href="index.php"> <i class="fa fa-home" style="font-size: 15px;float: right;"></a></i>
            <span class="material-symbols-outlined" id="back" onclick="window.history.back()">arrow_back</span>
            <h1><i class="fa fa-exchange"></i> Transaction Receipt </h1>
        </div>



       
     <?php
     
    // echo session_id();
     
     
    // require_once "logo.php";
     
     echo "<br>";

     if ($_SERVER["REQUEST_METHOD"] == "POST"){
      die("<p style=color: red;text-align: center;'>This page does not support post request</p>");
     }else{

if ($_SERVER["REQUEST_METHOD"] == "GET"){

$transaction_id = htmlspecialchars($_GET["transaction"]);

if ($transaction_id == NULL){
  die("<p style='color: red;text-align: center;'>Your link appears to be invalid or broken </p>");
}else{

  require_once __DIR__.("/db_connection.php");


  htmlspecialchars($transaction_id);

  $fetch_record = "SELECT * FROM Transaction_history WHERE User_id = '$_SESSION[New_user]' AND Transaction_id = '$transaction_id'";


  $result_fetch = $conn -> query($fetch_record);

  if ($result_fetch -> num_rows > 0){
    while($transaction_result = $result_fetch -> fetch_assoc()){


      $amount = number_format($transaction_result['Amount']) . ".00";

// show color for trasaction remark

if ($transaction_result['Remark'] ==  "+ Credit"){

  $remark_color = "color: mediumseagreen";
}else if ($transaction_result['Remark'] == "- Debit"){
  $remark_color = "color: red";
}else{
  $remark_color = "color: orange";
}

//show text color for status message;

if ($transaction_result['Status_remark'] == "Successful"){

  $status_color ="color: mediumseagreen";
}else{
  $status_color = "color: red";

}

//NOW CHECK FROM AND TO ACCOUNT NAME TO DISPLAUY NAME INSTEAD OF ACCOUNT NO


$from_record = "SELECT * FROM Register_db WHERE Account_no ='$transaction_result[Sender_account_no]'";

$sender_name = $conn -> query($from_record) -> fetch_assoc();

if($sender_name == NULL){
  $sender_name = $transaction_result['Sender_account_no'];
}else{
 $sender_name = $sender_name['Surname']. " ". $sender_name['Last_name'] 
 ." " .$sender_name['First_name'];
}


// select receiver name

$to_name = "SELECT * FROM Register_db WHERE Account_no = '$transaction_result[Receiver_account_no]'";


$to_name_result = $conn -> query ($to_name) -> fetch_assoc();


if ($to_name_result == NULL){

  $to_name_result = $transaction_result['Receiver_account_no'];
}else{
  $to_name_result =  $to_name_result['Surname'] ." ". $to_name_result['Last_name'] 
 ." ". $to_name_result['First_name'];
}

$date = date('F d Y',strtotime($transaction_result['Date_id']));
$time = $transaction_result["Time_id"];

//$time = date('a',$timee);

//$time = strtotime($time);

//$day =$date->format('g:i a');

//echo $day;



if($time >= 12){
    
    
    $time =$time."PM";
}else{
    
    
    $time =$time."AM";
}

$tel =(int) filter_var($transaction_result['Type_name']);


echo "<style> 
b{
    
    font-weight: lighter
    }
    {
        font-weight: bold;
    }
    h1{
        font-weight: lighter;
        font-size: 18px;
    }
    </style>";
    
    
 $text ="<input type='text' value='$transaction_result[Transaction_id]' id='tran_id' style='display: none'>";

echo $text;


if($transaction_result["Status_remark"] == "Successful"){
    
    
    $process= '<style>
    .Confirmation-status{
color: mediumseagreen;
margin-left: auto;
margin-right: auto;
display: inline;
text-decoration: line-through;
width: 100%;
text-align: center;
font-size: 30px;

}
.Confirmation-status b{
text-decoration: line-through;
font-weight: bold;
margin: 45px 45px;
text-align: center;

}
.Confirmation-status p{

text-decoration: line-through;
color: ;

}

@media only screen and (min-width: 600px){
.Confirmation-status b{

margin: 100px 100px

}

}
 



.confirmation-message{
color: #444;
margin-left: auto;
margin-right: auto;
width: 100%;
display: flex;
text-align: center;
}
.confirmation-message p{
font-size: 13px;
text-align: center;
margin: auto;
}

</style>

<div class="Confirmation-status">

<p>

<b><i class="fa fa-check-circle"></i></b>
<b><i class="fa fa-check-circle"></i></b>
<b><i class="fa fa-check-circle"></i></b>

</p>
</div>
<div class="confirmation-message">

<p>Payment <br>Successful</p><p>Proccess<br>by bank</p> <p>Receieve <br>by Bank</p>
</div><br><br>';
    
    
}else{
    
    
    
    $process ='
    <style>
    
    .Confirmation-status{
color: red;
margin-left: auto;
margin-right: auto;
display: inline;
text-decoration: line-through;
width: 100%;
text-align: center;
font-size: 30px;

}
.Confirmation-status b{
text-decoration: line-through;
font-weight: bold;
margin: 45px 45px;
text-align: center;

}
.Confirmation-status p{

text-decoration: line-through;
color: ;

}

@media only screen and (min-width: 600px){
.Confirmation-status b{

margin: 100px 100px

}

}
 



.confirmation-message{
color: #444;
margin-left: auto;
margin-right: auto;
width: 100%;
display: flex;
text-align: center;
}
.confirmation-message p{
font-size: 13px;
text-align: center;
margin: auto;

}

</style>

<div class="Confirmation-status">

<p>

<b><i class="fa fa-check-circle"></i></b>
<b><i class="fa fa-check-circle"></i></b>
<b><i class="fa fa-check-circle"></i></b>

</p>
</div>
<div class="confirmation-message">

<p>Payment <br>Successful</p><p>Proccess<br>by bank</p> <p>Receieve <br>by Bank</p>
</div>
<br>
<br>
    ';
    
    
    
    
}





echo $process ."<br>
<p style='font-family: Arial;font-size: 23px;
text-align: center;color: rgb(0,0,52);'>
Lazerwave

<i class='fa fa-flash' style='color: red;'></i></p>

";

 

//DISTINGUISH TRANSACTION TYPE//

if($transaction_result["Type"] == "Data purchase" or $transaction_result["Type"] == "Airtime purchase"){
    
    if($transaction_result["Sender_account_no"] == "MTN"){
        
        $network_image = "/images/Mtn.jpeg";
        
    }else if ($transaction_result["Sender_account_no"] == "AIRTEL"){
        
        $network_image = "/images/Airtel.jpeg";
    }else{
        if($transaction_result["Sender_account_no"] == "GLO"){
            
            $network_image ="/images/Glo.jpeg";
            
            
        }else if ($transaction_result["Sender_account_no"] == "9MOBILE"){
            $network_image ="/images/9mobile.jpeg";
            
            
        }else{
            
            $network_image ="";
            
        }
        
        
        
        
    }
    
    
    
    
    
echo "
    
    <div class='Reciept-container'>

      <p style='color: rgb(0,0,100);font-size: 20px;'>Transaction Details</p>
      
      
      <p style='font-size: 13px'>$date $time</p>
      
      <p style='$remark_color;'>$transaction_result[Remark]<br>₦$amount</p>
      
      
      <p style='text-align: center;'><img src='$network_image' width='90px'></p>


    <p>Amount <b style='float:right'>₦$amount</b></p>
    
    <p> Provider <b style='float:right'>$transaction_result[Sender_account_no]</b></p>
    
    <p> Phone no <b style='float:right'>$transaction_result[Receiver_account_no]</b></p>
    
    <p>Status <b style='float:right; $status_color;'>$transaction_result[Status_remark]</b></p>
    
    <p>Type <b style='float: right;'>$transaction_result[Type]</b></p>
    
    <p>Transaction ID <b style='float:right'>$transaction_result[Transaction_id] <i class='fa fa-copy'  style='cursor: pointer' onclick='copy()'></i></b></p>
    
    
    
          <p class='open-share-receipt-container'>Share Reciept</p>
    
    
    <p class='report'> <i class='fa fa-user-times'style='color: white' ></i> Report</p>
    
    </div>
    
    
    ";
    
    
    
    
    
}else if($transaction_result["Type"] == "Referal" ){
    
    
    
 echo"      <div class='Reciept-container'>

      <p style='color: rgb(0,0,100);font-size: 20px;'>Transaction Details</p>
      
      
      <p style='font-size: 13px'>$date $time</p>
      
      <p style='$remark_color;'>$transaction_result[Remark]<br>₦$amount</p>
      


    <p>Amount <b style='float:right'>₦$amount</b></p>
    
    
    <p>Type <b>$transaction_result[Type]</b></p>
    
    
    <p> Remark <b style='color: #e6e600'> Cupon Bonus  <i class='fa fa-trophy'></i></b></p>
    
     <p>Status <b style='float:right; $status_color;'>$transaction_result[Status_remark]</b></p>
    
    
    <p>Transaction ID <b>$transaction_result[Transaction_id] <i class='fa fa-copy' style='cursor: pointer' onclick='copy()'></i></b></p>
    
    
                <p class='open-share-receipt-container'>Share Reciept</p>
    
    
    <p class='report'> <i class='fa fa-user-times' style='color: white'></i> Report</p>
    
    </div>

    ";
    
    
    
}else{
    
    
    if($transaction_result["Type"] == "Account Statement"){
        
        
       echo " <div class='Reciept-container'>

      <p>Transaction Details</p>

      <p style='font-size: 13px'>$date   $time</p>

      <p style=' $remark_color'>$transaction_result[Remark]<br>₦$amount</p>
      
      
      <p>Amount <b>₦$amount</b></p>
      
      <p>Type <b>$transaction_result[Type]
     </b></p>
     
     <p>Remark <b>$transaction_result[Type_name] <i class='fa fa-line-chart' style='cursor:pointer'></i></b></p>
     
     <p>Status <b style='
    $status_color' >$transaction_result[Status_remark]
     </b></p>
     
     <p>Transaction ID <b>$transaction_result[Transaction_id]   <i class='fa fa-copy' style='cursor: pointer' onclick='copy()'></i>
     </b></p>
     
     
            <p class='open-share-receipt-container'>Share Reciept</p>
      
      <p class='report'><i class='fa fa-user-times' style='color:white'></i> Report</p>
      
      
      
      </div>
      
      
      ";

        
        
        
        
        
    }else{




      echo "
      <div class='Reciept-container'>

      <p>Transaction Details</p>

      <p style='font-size: 13px'>$date   $time</p>

      <p style=' $remark_color'>$transaction_result[Remark]<br>₦$amount</p>

      <p>Payment Amount <b>₦$amount</b> </p>


      <p>Recipient Name<b> $to_name_result
      </b></p>
      
            <p>Account Number<b>$transaction_result[Receiver_account_no]</b></p>

      
            <p>From <b>$sender_name </b></p>

      

      <p>Status <b style='$status_color'>$transaction_result[Status_remark]</b></p>
      

      
      <p>Payment Type<b style='float:right'>$transaction_result[Type]</b></p>
      
      <p>Recipient Bank <b style='float:right'>$transaction_result[Bank]</b></p>
      
      <p>Transaction ID<b style='font-size: 13px'>$transaction_result[Transaction_id] <i class='fa fa-copy' style='cursor: pointer' onclick='copy()'></i></b></p>
      

      <p>Remark <b style='font-size: 13px'>$transaction_result[Type_name]</b></p>
      
      


      <p class='open-share-receipt-container'>Share Reciept</p>
      
      <p class='report'><i class='fa fa-user-times' style='color:white'></i> Report</p>
      
      </div>
    
      ";
    }
    }
    }
    
    
  }else{
    echo "<p style='color: red;text-align: center;'>Invalid link or link appear to have been broken</p>";
  }


}

}


     }
     ?>
     </div>
    

<div class="share-receipt-container">
          
          <div class="share-box">
         <p class="close-share-container-btn"> <i class="fa fa-close"></i></p>
  
              <p>Share Receipt as:</p>
              <p><i class="fa fa-image" style="margin-right: 10px;"></i> Image</p>
              <p><i class=" fa fa-folder"style="margin-right: 10px;"></i> PDF</p>
  </div>
  </div>
  <script>
      
      document.querySelector(".open-share-receipt-container").addEventListener("click",openReceipt);
  
      function openReceipt(){
  
          document.querySelector(".share-receipt-container").style.width = "100%";
          document.querySelector(".share-box").style.width = "100%";
      }
  
  
      document.querySelector(".close-share-container-btn").addEventListener("click",closeReceipt);
  
  function closeReceipt(){
  
      document.querySelector(".share-receipt-container").style.width = "0%";
          document.querySelector(".share-box").style.width = "0%";
  
  }
  
  function copy(){
      
      var tran_id=
document.querySelector("#tran_id");
tran_id.select();
tran_id.setSelectionRange(0,99999);
navigator.clipboard.writeText(
tran_id.value);
alert("Transaction Id  copied to clipboard");

}
      
      document.querySelector(".report").addEventListener("click",alert_f);
      
      function alert_f(){
          
          alert("unavaliable,please report manually");
          
          
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
  



