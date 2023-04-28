<?php
require_once __DIR__.("/sessionPage.php");

if ($_SERVER["REQUEST_METHOD"] == "POST"){

 $amount = (int)  filter_var($_POST["payment_link_amount"],FILTER_SANITIZE_NUMBER_INT);


 if (empty($amount)){

    $message_status = "Please enter a valid amount";

    require_once __DIR__.("/Failed.php");



    die();
 }

 if ($amount <= 999){


    $message_status = "Amount cannot be less than ₦1000";

    require_once __DIR__.("/Failed.php");



    die();

 }else{

    
 htmlspecialchars($amount);


 require_once __DIR__.("/db_connection.php");

 //insert the amount so you can retrieve it when they click on the link


 $hash_link = rand() .uniqid() .rand(0636,63726);
 
 $name = $user["Surname"]  .$user["Last_name"]. $user["First_name"];



 $date =date("Y-m-d h:i:s");

 $ip_addr =htmlspecialchars( $_SERVER["REMOTE_ADDR"]);   


 $insert = "INSERT INTO Payment_link_table(User_id,Amount,Hash_link,Date_created,Ip_addr)

 VALUES('$_SESSION[New_user]','$amount','$hash_link','$date','$ip_addr'
 )";


if ($conn -> query($insert) == TRUE){
    echo "
    
<div class='message-status'>
<h1 style='color: green'>Link created successfully</h1>

<p>https://lazerwave.000webhostapp.com/Payment.php?name=$hash_link&user=$user[Surname]$user[First_name]$user[Last_name]&id=$user[id]</p>


<p onclick='copyPayment_link()' class='copy_link_url'><i class='fa fa-copy'></i> Copy link</p>

<p onclick='shareLink()'><i class='fa fa-share'></i>Share link</p>

<p><a href='index.php'><i class='fa fa-home'></i> Home</a></p>


<p onclick='window.location.reload()'><i class='fa fa-refresh'></i> Re-create new link</p>


</div>


<input type='hidden' value='lazerwave.000webhostapp.com/Payment.php?name=$hash_link&user=$user[Surname]$user[Last_name]$user[First_name]&id=$user[id]' id ='payment_link'>



    ";
}else{


    $message_status = "An unknown eror has occur,please try again".$conn -> error;

    require_once __DIR__.("/Failed.php");



    die();

}


 }



}

?>