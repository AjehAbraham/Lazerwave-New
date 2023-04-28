<?php 
require_once __DIR__.("/sessionPage.php");


if (!isset($_SESSION["New_user"])){
    header("location:login.php");
    exit;
}


?>

<!DOCTYPE html>
<html lang="eng_US">
  <head>
    <link rel="stylesheet" href="Receipt.css">
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
<title>Transaction Receipt</title>


<!-- JS PDF LIBARY -->

<script src ="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.debug.js"></script>


<!-- END OF JS PDF LIBARY=-->



      </head>
      <body>

      <?php
      
include __DIR__.("/Loader.php");

require_once __DIR__.("/Network.php");?>

      
      <div class="Reciept-container">
<p>lazerwave <i class="fa fa-fire"></i></p>


<p><i class="fa fa-check"></i></p>
<p>Transaction Successful</p>

<p style="font-size: 13px"><?php echo date("F d Y"); echo date("H:i:sa"); ?> </p>

<p></p>

<p>Amount<b>₦<?php echo number_format ($_SESSION['AMOUNT']) . ".00" ?>
</b></p>

<p>Sender<b><?php echo $user["Surname"] ." " .$user["Last_name"]. " ". $user["First_name"] ?></b></p>
<p>Recipient<b><?php echo   $_SESSION["Surname"] . " ".$_SESSION["Last_name"] . " ".  $_SESSION["First_name"] ; ?></b></p>
<p>Transaction ID<b style="font-size: 13px"><?php echo
$_SESSION["Transaction_id"] ?></b></p>

<p>Remark<b><?php echo /*$_SESSION["Type_remark"] . "-" .*/($_SESSION["remark"] ); ?></b></p>
<p class="open-share-receipt-container">Share receipt</p>
<p><a href="index.php">Go to Dashboard</a></p>

        </div>



</div>


<div class="share-receipt-container">
          
          <div class="share-box">
         <p class="close-share-container-btn"> <i class="fa fa-close"></i></p>
  
              <p>Share Receipt as:</p>
              <p><i class="fa fa-image" style="margin-right: 10px;"></i> Image</p>
              <p class="pdf_convert"><i class=" fa fa-folder"style="margin-right: 10px;"></i> PDF</p>
  </div>
  </div>
  
  <script>

document.querySelector(".pdf_convert").addEventListener("click",convert_to_pdf);
  

function convert_to_pdf(){

var Receipt = document.querySelector(".Reciept-container");

      const doc = new jsPDF();

      doc.html(Receipt)
    //  doc.text = (b,10,10);

      doc.save('Receipt.pdf');


window.open('Receipt.pdf');




}

      </script>


<script src="Receipt.js"></script>
    

</html>
</body>

