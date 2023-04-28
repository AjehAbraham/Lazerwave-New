<?php require_once __DIR__.("/sessionPage.php");



if (!isset($_SESSION["New_user"])){
  header("location:login.php");
  exit;
}


echo "<title>Transaction History</title>";

require_once __DIR__.("/Network.php");

?>


<!DOCTYPE html>
<html lang="eng_US">
  <head>
    <link rel="stylesheet" href="Transaction history.css">
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
            <span class="material-symbols-outlined" id="back">arrow_back</span>
            <h1><i class="fa fa-book"></i> Transaction history       <i class="fa fa-refresh" id="relaod-page"></i></h1>
<!--p style="color:white">Search for transaction using DD/MM/YY format.</p>
           <form method="post"> <input type="search"></form>
            <br-->


        </div>


<?php

require_once __DIR__.("/db_connection.php");

$SQL = "SELECT * FROM Transaction_history WHERE User_id = '$_SESSION[New_user]' ORDER BY id DESC";

$result = $conn -> query ($SQL);


if ($result -> num_rows > 0){
  
  while($transact_result = $result -> fetch_assoc()){

   $amount = number_format($transact_result["Amount"]);

   ///check if the trnsaction failed to show red then green fro successfull trnsaction

if ($transact_result['Status_remark'] == "Successful"){
  $color = "color: mediumseagreen";
}else{
  $color = "color: red";
}


// credit color: green; pending 

if ($transact_result['Remark'] == "+ Credit"){
  $remark_color = "color: mediumseagreen";
}else if ($transact_result['Remark'] == "- Debit"){
  $remark_color ="color: red";
}else{
  $remark_color = "color: orange";
}


$date = $transact_result["Date_id"];

$date = date("F d y",strtotime($date));



$time =$transact_result["Time_id"];

if($time <= 11){
    
    $time = $time."AM";
    
    
}else{
    
    
    $time =$time ."PM";
}

$bank = $transact_result["Bank"];


if($bank == ""){
    
    $bank ="";
    
    
}else{
    
    $bank = "to ". $bank;
    
    
    
}



if($transact_result["Type"] == "Referal"){
    
    $color_r="style='color: #cccc00;'";
    $cup ="<i class='fa fa-trophy'></i>";
    
    
    
}else if($transact_result["Type"] == "Transfer"){
    
    $color_r = "style='color: gray'";
    
    $cup = "<i class='fa fa-bank'></i> ";
    
    
    
}


else{
    
    $color_r="style='color: grey;'";
    
    $cup ="";
    
}



if($transact_result["Type"] == "Airtime purchase"){
    
    
    $cup = "<i class='fa fa-phone'></i>";
}else if($transact_result["Type"]== "Data purchase"){
    
    
    $cup ="<i class='fa fa-rss'></i> ";
    
    
    
}else{
    
    if($transact_result["Type"] == "Card"){
        
        
        $cup = "<i class='fa fa-credit-card'></i> ";
        
        
    }else if($transact_result["Type"] == "Top up"){
        
        
        $cup ="<i class='fa fa-credit-card-alt'></i> ";
    }else{
        
        
        if($transact_result["Type"] =="Account Statement"){
            
            $cup ="<i class='fa fa-line-chart'></i> "
            ;
            
        }
        
        
        
    }
    
    
    
    
    
}

echo "<style>.transactions-box{
background-color: #f1f1f1;
}
</style>
    ";




    echo "
    <div class='transactions-box'>
    
    <p  style='font-size: 15px'><li $color_r style='color: gray'>   $cup $transact_result[Type] $bank</li>
    
   <b style='$remark_color'>$transact_result[Remark] ₦$amount</b></p>

  <p style='color: gray'> <li style='color: gray'> $date $time</li>
     <li style='$color'>Transaction $transact_result[Status_remark]</li></p>
     
     
     <b  style='padding: 7px 7px;width: 44% ;text-align: center;background-color: rgb(0,0,100);border-radius: 2rem;'><a  href='ViewTransaction.php?transaction=$transact_result[Transaction_id]'>View</a></b>
        </a>
    </div>";

  }
}else{
  echo "<h2 style='text-align:center'> No transaction history</h3>";
}


?>




        <script src="Transaction history.js"></script>


        </body>
        </html>