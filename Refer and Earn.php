<?php

require_once __DIR__.("/sessionPage.php");


echo "<title>Refer and Earn</title>"
;


require_once __DIR__.("/Network.php");


?>


<!DOCTYPE html>
<html lang="eng_US">
  <head>
    <link rel="stylesheet" href="Refer and earn.css">
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

<title>Refer and Earn</title>
</head>
<body>


<div class="top-nav-bar">
    <i class="fa fa-cancel" onclick="window.history.back()"></i>
<a href="index">
<i class="fa fa-home" style="float: right;"></i></a>

</div>


<div class="background-image-fluid"></div>

<div class="refer-container-fluid">

<h3>Generate Referal Link</h3>


<p>Refer and earn when the person you refer register and uses lazerwave</p>


<?php


$current_link = "SELECT * FROM Refer_and_Earn WHERE User_id='$_SESSION[New_user]' ORDER BY  id DESC LIMIT 1";
   
   
   $current_result = $conn -> query($current_link);
   
   
   
   if($current_result -> num_rows > 0){
   
   $link_result = $current_result -> fetch_assoc();
   
   
   //$_SESSION["Current_link"] = $link_result["Referal_code"];
   
   
   
   $_SESSION["Current_link"] = "https://lazerwave.000webhostapp.com/Register?referalcode=".$link_result["Referal_code"];
   
  if(empty($_SESSION["Current_link"])){
      
      $_SESSION["Current_link"] ="";
  }
   
   
   
   
   
   }else{
   
   
   //NO LINK FOUND//
   
   
   
   }
   
   
   
   //if(empty($_SESSION["Current_link"])){
       
      // $_SESSION[c]
       
       
 //  }


?>

<p class="referal_error_message"><?php if(isset($_SESSION["Current_link"])){

echo $_SESSION["Current_link"]; }?> </p>

<b>Note when you re-generate link the previous link will be invalid</b>
<input type="text" style="display:none" value="<?php if(isset($_SESSION["Current_link"])) {
echo $_SESSION['Current_link']; }?>" id="link">



<p onclick='CopyLink()'><i class='fa fa-copy'></i> Copy link</p>

<!--p onclick='share_link()'><i class='fa fa-share'></i> Share link</p-->


<form method="post" id="referal_formId">

<input type="hidden" value="refer" name="refer">



 
<?php 


//CHECK LINK STATUS //


$link = "SELECT * FROM Refer_and_Earn WHERE User_id ='$_SESSION[New_user]'";

$total_l =$conn -> query($link);



if ($total_l -> num_rows > 0){


echo '<input type="submit" value="Re-generate Link" id="referal_submitButton">';


}else{
    
    
echo '
<input type="submit" value="Generate Link" id="referal_submitButton">';





}



?>



</form>

<p class="view-referal">View history</p>

</div>



<div class="loader-overlay">
<div class="loader">
</div>
</div>

<div class="referal-history-container">

<i class="fa fa-cancel" id="close-history-btn"></i>


<p>Referal history</p-->



<?php


require_once __DIR__.("/db_connection.php");


//FETCH REFERAL INFO//


$refer ="SELECT * FROM Refer_and_Earn WHERE User_id ='$_SESSION[New_user]'";


$refer_result = $conn -> query($refer);

if($refer_result -> num_rows > 0){
    
    $Total_link = mysqli_num_rows($refer_result);

    
    
 while($referal_result = $refer_result -> fetch_assoc()){
    
    //var_dump($referalresult);
 //$sum = 0;

$sum =$sum + $referal_result["Amount"];

$Amount = number_format($sum);


if(empty($Amount)){
    
    $Amount =0.00;
    
    
}
}

//CHECK THE TOTAL NUMBER OF PEOPLE THEY REFFER//


$status_re ="SELECT * FROM Referal_record WHERE User_id ='$_SESSION[New_user]' ORDER BY id DESC LIMIT 1";


$status_results = $conn -> query($status_re) ;//-> fetch_assoc();

//var_dump($status_results);



if($status_results -> num_rows > 0){
    
    $users_re = $status_results -> fetch_assoc();
    
    
    $you_refered =$users_re["id"];
    
    
    
}else{
    
    
    ///NO RESULT FOUND
    
    $you_refered ="0";
    
    
    
    
}
  








echo "

<p>Total amount for link created<br> ₦$Amount</p>
<p>You referred: $you_refered users</p>


<p>Total Link created : $Total_link</p>

<p style='padding: 10px 10px;border: 3px solid rgb(0,0,100);text-align: center;'>Current link $_SESSION[Current_link]</p>


";








}else{


//NO RECORD WAS FOUND//
echo "<p>No record found</p>";

/*

echo "<p>Total amount earn <br> ₦0.00</p>
<p>You referred 0 users</p>


<p>Total Link created : 0 users</p>

<p>Total click : 0</p>
<p>Current link : none</p>";
*/



}




?>





</div>

<script src="Refer.js"></script>

</body>
</html>