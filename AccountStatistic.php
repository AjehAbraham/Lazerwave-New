<?php 
require_once __DIR__.("/sessionPage.php");


if (!isset($_SESSION["New_user"])){
    header("location:login.php");
    exit;
}
echo "<title>Account statistics</title>";

require_once __DIR__.("/Network.php");

?>


<!DOCTYPE html>
<html lang="eng_US">
  <head>
    <link rel="stylesheet" href="AccountStatistic.css">
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
<title>Account statistics</title>




<!-- ajax and jquery link -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<script src= "https://code.jquery.com/jquery-3.5.0.js"></script>

<!-- end of ajax link -->


      </head>
   

         
         <a href="index.php">  <i class="fa fa-home" style="float:right;margin-top:2px;font-size:15px;color: rgb(0,0,180)"></i>
         </a> 
                   <span class="material-symbols-outlined" onclick="window.history.back()" style="color: rgb(0,0,180)">arrow_back</span>
        

<?php //require_once __DIR__.("/sessionPage.php"); ?>

         <div class="Account-statistic-container">

<h1>Account statistics <i class="fa fa-line-chart"></i></h1>

<h2>Numbers of transaction</h2>

<?php


include __DIR__.("/db_connection.php");

// select total numbers of transaction 

$select_total = "SELECT * FROM Transaction_history WHERE User_id = '$_SESSION[New_user]'";

$select_result = $conn -> query($select_total);

if ($select_result -> num_rows > 0){

    $total = mysqli_num_rows($select_result);
    
    echo "<h2>Total:" . " " .$total .".<h2>";


    // check tottal number of debit and credit
    $credit = "+ Credit";
    
   $credit_debit = "SELECT Remark FROM Transaction_history WHERE User_id = '$_SESSION[New_user]' AND Remark = '$credit'";

$credit_result = $conn -> query($credit_debit);

   if ($credit_result -> num_rows > 0){

    $credit_result_col = mysqli_num_rows($credit_result);

    $credit_no =  mysqli_num_rows($credit_result);

    $credit_result_col = floor( $credit_result_col + 50) ;

//check if no transaction found 

   }else{
    
    $credit_no = "0";

    $credit_result_col = 0;


   }

   $debit = "- Debit";

   $select_debit_col = "SELECT Remark FROM Transaction_history WHERE User_id ='$_SESSION[New_user]' AND Remark = '$debit'";


$debit_result = $conn -> query($select_debit_col);

if ($debit_result -> num_rows > 0){

    $debit_total = mysqli_num_rows($debit_result);

    $debit_no = mysqli_num_rows($debit_result);

    $debit_total =floor( $debit_total + 50  )  ;

//check if user have zero transaction




}else{
    
if ($debit_no == NULL){
    $debit_no = "0";
}

if ($debit_total == NULL){

    $debit_total = "0";
}
}
   



    echo "
    
<div class='flex-box'>


<p>
$credit_no
<br>
Credit<br> %
</p>
<p>$debit_no <br>Debit<br> %<br> </p>
    ";
  
  
}else{
    echo "<h2>Total: 0</h2>";
}


//CHECK TOTAL MONEY IN AND OUT FOR A MONTH//



$month ="SELECT *  FROM Transaction_history WHERE User_id='$_SESSION[New_user]' AND  Date_id >= (NOW() - INTERVAL 1 MONTH)";


$month_result = $conn -> query($month);

//var_dump($month_result);


//var_dump($month_result["Remark"]["-  Debit"]);


while($rr = $month_result -> fetch_assoc()){

//$amount +=$rr["Amount"];

//echo $amount;




//if($rr["Remark"] == "- Debit"){

    



//$amount += $rr["Amount"];

//echo $amount;

//var_dump($rr["Remark"]);

    
}
//}

?>

</h2>



<p> Generate Account Statement</p>



<p style="color:red">Note you will be charge a service fee of ₦10</p>

<form method="post" id="formId">
<label for="email"><b>Email:</b></label>
<br>

<input type="email" name="email" placeholder="Enter email...">

<br>



<p class="open-tarnsaction-btn">Validate</p>
       


    
       <div class="Transaction-pin-container-overlay">
  
  <div class="transaction-pin-container">
      <p class="close-transaction_pin"> <i class="fa fa-close"></i></p>
  
      <p>Enter your transaction pin</p>
  <input type="number" name="transaction-pin" placeholder="Enter your transaction pin..." inputmode="numeric" style="-webkit-text-security:disc;" maxlength="4">
  
  <br>

  <p class="error_message"></p>
  
  <input type="submit" id="submitButton" value="Generate">
  
  
  <div class="loader-overlay">
      <div class="loader-message"></div>
  </div>
  
  </div>
  </div>
</form>
        
  
  
  <script src="AccountStatisitc.js"></script>
  





         </div>


         




      </body>
      </html>