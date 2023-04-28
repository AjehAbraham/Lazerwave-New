<?php

require_once __DIR__.("/sessionPage.php");

?>

<!DOCTYPE html>
<html lang="eng_US">
  <head>
    <link rel="stylesheet" href="View notification.css">
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

<title>Notification</title>
</head>
<body>

<div class="view-notification">

<span class='material-symbols-outlined'onclick="window.history.back()">close</span>



<?php

if($_SERVER["REQUEST_METHOD"] == "GET"){

if (isset($_GET["notify"])){
$notify_id = htmlspecialchars($_GET["notify"]);

if (empty($notify_id)){

$message_status ="Error processing you request";

require_once __DIR__.("/Failed.php")
;
die();


}else{
//NOW FETCH ALL THE NECCASSRY RECORDS//


$select ="SELECT * FROM Notification WHERE User_id ='$_SESSION[New_user]' AND Notify_id ='$notify_id'";


$notify = $conn -> query($select);


if ($notify -> num_rows > 0){

$result_notify = $notify -> fetch_assoc();


//NOW CHECK REGISTER Db FOR USER DETAILS;

$user ="SELECT * FROM Register_db WHERE id ='$result_notify[Receiver_id]'";


$user_name = $conn -> query($user) -> fetch_assoc();


//UPDATE STATUS TO SEEN//


$up = "UPDATE Notification SET Status ='seen' WHERE User_id ='$_SESSION[New_user]' AND Notify_id='$notify_id' ";


if($conn -> query($up) == TRUE){
    
    
}else{
    
    $conn -> error;
    
}

if($result_notify["Time"] > 12){
    
    
    $time = $result_notify["Time"] . "PM";
}else{
    
    $time = $result_notify["Time"]. "AM";
}





$date = date(" F d Y",strtotime($result_notify["Date"])) ." ".$time;



$amount = number_format($result_notify["Amount"]);
if(!$amount == NULL){
    
    $amount = "₦" .$amount;
}


echo "<p>$user_name[Surname]   $user_name[Last_name]   $user_name[First_name]<br> $date</p>

<p>$amount</p>

<p>$result_notify[Message]</p>




";


echo "<p style='padding: 10px 10px;border-radius: 2rem;color: white;background-color: rgb(0,0,56);text-align: center;margin:auto;width: 55%;'>$result_notify[Type]</p><br><br>";





if($result_notify["Type"] == "Money Request"){


require_once __DIR__.("/check accept request.php");



echo "
<p class='reply-message'><i class='fa fa-reply'></i></p>


<p class='report-message'> <i class='fa fa-user-times'></i>
Report</p>";


}else{
echo "

<p class='reply-message'><i class='fa fa-reply'></i></p>


<p class='report-message'> <i class='fa fa-user-times'></i>
Report</p>";



}



}else{


//NO NOTIFICATIOM WAS FOUND//


$message_status ="server error,please try again later";


require_once __DIR__.("/Failed.php");

die();


}}


}else{

$message_status ="Invalid link,please check the link";


require_once __DIR__.("/Failed.php");

die();


}
//END OF CHECKING IF LINK IS VALID




}




?>




</div>

<p class="error_message"></p>


<div class="loader-overlay">
<div class="loader">

</div>
</div>


    <script src="View notification.js"></script>




  </body>
</html>