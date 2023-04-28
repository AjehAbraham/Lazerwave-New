<?php

require_once "sessionPage.php";



?>
<!DOCTYPE html>
<html lang="eng_US">
  <head>
    <link rel="stylesheet" href="create payment link.css">
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width,initial-scale=1.0">
 <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
         

<script src="https://kit.fontawesome.com/958aace4f6.js" crossorigin="anonymous"></script>

<!--ajax and jquery link -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<script src= "https://code.jquery.com/jquery-3.5.0.js"></script>

<!-- end of ajax link -->


<link href="https://fonts.googleapis.com/css2?family=Encode+Sans:wght@300&family=Island+Moments&family=Oswald:wght@200&family=PT+Serif:wght@700&family=Roboto+Mono:wght@100&display=swap" rel="stylesheet">


<link href="https://fonts.googleapis.com/css2?family=Tilt+Prism&display=swap" rel="stylesheet">


<!-- AUTO INCREASE TEXT AREAS SIZE-->
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.6.3.min.js"></script>

<!--END OF TEXT AREA -->


<title>Create payment link</title>
</head>
<body>
<?php 
require_once "Network.php";

//require_once "logo.php";

?>

<div class="form-container">

<p><i class="fa fa-cancel" onclick="window.history.back()"></i>
<a href="index">
<i class="fa fa-home" style="float: right;"></a></i>
</p>
<?php// require_once "logo.php"; ?>
<h2>Create payment link</h2>


 <form method="post"  enctype="multipart/form-data" id="formId">


 <input type="file" name="image"  onchange ="loadFile(event)"style="display:none;" id="file" accept="image">

<p><img id="output">  </p>


<p>Add image(optional)</p>




<p>

<label for="file">Upload</lable>
        
        </p>


<p>Link Message(optional)</p>

<textarea placeholder="Type, paste, cut text here..."name="Message"></textarea>

<p>Title</p>

<input type="text" name="Link_title" placeholder="What's this for? e.g donation,rent,fees">


<p>Amount(₦1,000 and above)</p>

<input type="number" name="Amount" inputmode="numeric" placeholder="e.g 1000">
<br>
<p><b>I agree to terms and conditions.</br> <a href="#">Terms and condtions</a></b>
 <label class="switch">
  <input type="checkbox" name="terms" value="Yes">
  <span class="slider round"></span>
</label>
</p>

<br>

<input type="submit" value="Generate Link" onclick="submit_form(event)">


<br>
<br>
</form>


<p class="open-btn">Payment link history</p>

<p class="error_message"></p>



</div>


<div class="loader-overlay">
<div class="loader-message">
</div></div>


<div class='All-link-container'>


<p>All Links Created</p>


<?php


require_once "db_connection.php";


$fetch_links = "SELECT * FROM Payment_link_table WHERE User_id='$_SESSION[New_user]' ORDER BY id DESC";


$fetch_result = $conn -> query($fetch_links);


if($fetch_result -> num_rows > 0){
while($fetch_results = $fetch_result -> fetch_assoc()){


$total_amount  +=$fetch_results["Amount"];

//$total_amount = number_format($total_amount).".00";


//echo $total_amount;

$dates = date("F d Y",strtotime($fetch_results["Date_created"])) ." ".$fetch_results["Time"];

$amounts = "₦".number_format($fetch_results["Amount"]).".00";

if($fetch_results["Status"] == "Active"){

$status = "Active";

$status_color ="style='color: mediumseagreen'";



}else{

$status = "InActive";

$status_color ="style='color: red;'";


}



echo "<p class='links_border'>$fetch_results[Title] </p>

<p>$amounts</p>

<p style='font-size: 12px; overflow:hidden'>https://lazerwave.000webhostapp.com/payment?name=$fetch_results[Hash_link]&user=$user[Surname]$user[Last_name]$user[First_name]&id=$user[id]&Payment_gateway</p>
<p>$dates</p>
<p class='links_border2'>Status: $status <i class='fa fa-circle'$status_color></i></p>
<p><a href='Block-link?$fetch_results[Hash_link]'>Block link</a></p>
<br>
";




}


}else{

echo "<p>No link found</p>";



}



?>

</div>





<div class="Payment-link-details-container">


<p class="close-btn">

<i class="fa fa-close"></i></p>

<div class="View-options-container">

<p>All Time <i class="fa fa-clock"></i></p>

<p onclick="alert('coming soon')">This month <i class="fa fa-clock"></i></p>
</div>


<div class='Payment-link-container'>

<h3>Payment Links History</h3>




<?php

$total_amount =number_format($total_amount);

require_once "db_connection.php";
echo "
<p><i class='fa fa-link'></i> Total Amount generated </p>

<p> <i class='fa fa-money'></i> Total Amount ₦$total_amount</p>


</div>";






//FETCH LINKS//


$link = "SELECT * FROM Confirm_payment_link WHERE User_id='$_SESSION[New_user]' ORDER BY id DESC";

$link_result = $conn -> query($link);

if ($link_result -> num_rows > 0){

while($results_link = $link_result -> fetch_assoc()){
    

$amount = "₦". number_format($results_link["Amount"]). ".00";

$dates =date("F d Y",strtotime($results_link["Date"]));
  
if ($results_link["Time"] > 12){


$dates =$dates. " ". $results_link["Time"]. "PM";

}else{
$dates =$dates. " ".$results_link["Time"]. "AM";

}

$total_amount += $results_link["Amount"];

$total_amount = number_format($total_amount). ".00";


if($results_link["Card_no"] == ""){
    
    $card_no = "";
    
    
}else{
    
    $first_four = substr($results_link["Card_no"],-5);
    
    $last_four = substr($results_link["Card_no"],-10);
    
    //$card_no = $first_four."******". $last_four;
    
    
}


$card_no  = "";// subtr(0,-5,$results_link["Card_no"]);



if($results_link["Status"] == "Successful"){

$status_color = "style='color: mediumseagreen'";

$amount_color = "style='color: mediumseagreen;'";

//$total_generated +=$results_link["Amount"];


//$total_generated = "₦". number_format($total_generated). ".00";


}else{
    
    $status_color = "style='color: red;'";
    $amount_color= "style='color: red;'";
    
}

if($results_link["Country"] == "Nigeria"){
    
    $country_flag ="🇳🇬";
    
    
}else{
    
    $country_flag="🇬🇭";
    
    
    
}


$card_first_four = substr($results_link["Card_no"],-5);

$last_four = substr($results_link["Card_no"],-5);
$card_val = $card_first_four ."*****".$last_four;




echo "

<div class='Links-details'>

<p>Link: $results_link[Hash_link]<br>$dates</p>

<p>$results_link[Message]</p>

<p $amount_color>$amount</p>

<p>$card_val <i class='fa fa-flash' style='color: red'></i></p>

<b>$results_link[Country] $country_flag</b>
<b $status_color>$results_link[Status]</b>

<br>



</div>
";


}


}else{


echo "<p style='text-align: center;'> No Transaction History</p>
";



}

?>


</div>

<script src="create payment link.js"></script>

</body>
</html>
