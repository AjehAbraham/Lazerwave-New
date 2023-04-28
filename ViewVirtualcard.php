<?php
require_once __DIR__.("/sessionPage.php");



?>




<!DOCTYPE html>
<html lang="eng_US">
  <head>
    <link rel="stylesheet" href="ViewVirtualcard.css">
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
<title>View virtual card</title>


<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Tilt+Prism&display=swap" rel="stylesheet">

      </head>
      <body>
         

      <div class="virtail-card-container">
      <span class="material-symbols-outlined" onclick="window.history.back()" >arrow_back</span>
      <a href="index.php"><i class="fa fa-home" style="float:right;margin-top:1px;font-size:15px;"></i></a>

<p>View Card Details</p>
    </div>



    <?php

require_once "Network.php";



    if ($_SERVER["REQUEST_METHOD"] == "GET"){


if(!isset($_GET["Ray_id"])){


    $message_status = "Error processing your link,invalid link";

    require_once __DIR__.("/Failed.php");
    die();


}

       // echo $_GET["card_no"];

if ($_GET["Ray_id"] == Null){
//THRWO ERROR BECAUSE IT AN INVALID LINK//

$message_status = "Error processing your link,invalid link";

require_once __DIR__.("/Failed.php");
die();

}else{

//LINK IS VALID//
//$card_no = (int) filter_var($_GET["Ray_id"],FILTER_SANITIZE_NUMBER_INT);

$card_no = $_GET["Ray_id"];

$card_no = htmlspecialchars($card_no);


//STILL CHECK AGAIN TO AVOID ERROR

if (empty($card_no)){


    $message_status = "Error processing your link,invalid link";

    require_once __DIR__.("/Failed.php");
    die();


}
//echo $card_no;

//NOW SEARCH FOR CARD NO AND FETCH RESULT//

$card = "SELECT * FROM Credit_card WHERE User_id ='$_SESSION[New_user]' AND Hash_key='$card_no'";

$card_result = $conn -> query($card);

if ($card_result -> num_rows > 0){

//NOW RESULT WAS FOUND//

$card_details = $card_result -> fetch_assoc();


//var_dump($card_details);

/*$_SESSION["view_card"] = $card_details["Credit_card_no"];

$_SESSION["CCv"] = $card_details["Ccv"];


$_SESSION["Exp"] = $card_details["Exp_date"];

$_SESSION["Full_name"] = $card_details["Full_name"];*/


$_SESSION["Card_hash_key"] = $card_details["Hash_key"];

}else{



    $message_status = "Error,card not found";

    require_once __DIR__.("/Failed.php");
    die();





}





}



    }

    ?>



<div class="front-debit-card-fliud">

<?php //require_once __DIR__.("/logo.php"); ?>

<p><i class="fa fa-flash" style="color: white;font-size: 18px" style="float: right"></i><i class="fa fa-flash" style="color: red;float: right;font-size: 18px"></i></p>

<p class="card-no"> <?php echo 
$card_details["Credit_card_no"]; ?></p>
<p class="name"><?php echo $card_details["Full_name"] ;?></p>
<p class="exp">Exp <?php echo $card_details["Exp_date"];?></p>
<i class="fa fa-barcode" style="color: gold;margin-left: 19px;font-size: 30px"></i>


<?php

if($card_details["Status_r"] == "UnBlock"){
    
echo '
<b style="float: right">Active <i class="fa fa-circle" style="color:mediumseagreen"></i></b>
';
}else{
    
    echo '
    <b style="float: right">InActive <i class="fa fa-circle" style="color:red;"></i></b>
    ';
    
    
}
?>


<p><i class="fa fa-flash"style="font-size: 18px;color: white;float: right"></i><i class="fa fa-flash" style="color: red;font-size: 18px" style="float: right"></i></p>
</div>


<div class="back-card-container">
    <p><i class="fa fa-flash" style="color: red;font-size: 18px" style="float: "></i><i class="fa fa-flash" style="color: white;float: right;font-size: 18px"></i></p>
    
<div class="black-spot"><?php echo $card_details["Ccv"];?></div>



<p>Please do not share your card details with anyone,always ensure to keep it safe.Report any suspicious activity</p>

<i class="fa fa-qrcode" style="margin-left: 19px;font-size: 30px"></i>

<!--p>please report any suspicous or unauthorise use of your card</p>
<p>ajehabraham51@gmail.com</p>
<p>call: 09074220984</p-->
<p><i class="fa fa-flash" style="color: white;font-size: 18px" style="float: right"></i><i class="fa fa-flash" style="color: red;float: right;font-size: 18px"></i></p>




</div>

<div class="Block-card-container">
    <form method="post" id="formId">
       
       
       <?php 
       if($card_details["Status_r"] == "UnBlock"){
       
       echo '
       
       <b>Block Card</b>
        <label class="switch">
  <input type="checkbox" name="status" value="Block" onclick="Open_pin()"id="check">
  <span class="round slider"></span>
</label>
';


}else{
    echo '
    
    <b>UnBlock Card</b>
     <label class="switch">
  <input type="checkbox" name="status" value="Unblock" checked onclick="Open_pin()" id="check">
  <span class="round slider"></span>
</label>
';

    
    
}
       
       ?>
        
        <div class="Transaction-pin">
        
        <p>Transaction pin
        <br>
        <input type='text' inputmode="numeric" style="-webkit-text-security: disc" maxlenhth="4" name="pin"
       > </p>
        <?php
        
       /// var_dump($card_details);
       
       if($card_details["Status_r"] == "UnBlock"){
       
    echo '
        
        
        <p>Tell us why(reason)<br>
        <select name="reason">
            
            <option></option>
            <option>Lost</option>
            <option>Stolen</option>
            <option>Disabled</option>
        </select></p>
    
    <p class="submitForm" onclick="submit_form(event)">De-Activate card</p>
    </form>
    ';
    
    
       }else{
           
         echo "<p class='submitForm' onclick='submit_form(event)'>Activate Card</p></form>";  
           
           
           
       }
       ?>
       
       </div>
       <br>
       <br>
    
    <p class="error_message"></p>
    <br>
    <br>
    
</div>

<div class="loader-overlay">
    <div class="loader-message"></div>
</div>

<script>
    function submit_form(event){

    event.preventDefault();
    
    document.querySelector(".loader-overlay").style.display = "block";
    
    
    ////
    
    var form = $("#formId");
    var url = "Block card";
    
    $.ajax ({
      type: "POST",
      url: url,
      data: form.serialize(),
    dataType:'json',
    encode: true,
    success: function(data){
        //form has beeen submitted//
    
        console.log();
    
        document.querySelector(".loader-overlay").style.display = "none";
    
       
        var error = document.querySelector(".error_message");
    
    error.innerHTML = data.responseText;
    
      //  alert("Form submitted successfully");
    
      },
      error: function(data){
    document.querySelector(".loader-overlay").style.display = "none";
    
        var error = document.querySelector(".error_message");
    
    error.innerHTML = data.responseText;
    
    
    if(data.responseText ==""){
        
        alert("Done");
        
        
    }
    
       
    
    }
    });


}

function close_otp_message(){

  document.querySelector(".form-status-message-overlay").style.display = "none";
  
  
  }
  
  function Open_pin(){
      
   var transation_box=   document.querySelector(".Transaction-pin");
   
   
   if(transation_box.style.width=="0%"){
       
       transation_box.style.width= "100%";
       
       document.querySelector("#check").checked=true;
   }else{
       
       transation_box.style.width="0%";
       document.querySelector("#check").checked = false;
   }
      
      
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