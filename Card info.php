<?php

session_start();
session_regenerate_id();

if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

  header("Location: Warning.php");
  exit;

      header('HTTP/1.0 403 Forbiddden',TRUE,403);
      die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}



if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $card_no = (int) filter_var($_POST["card_no"],FILTER_VALIDATE_INT);
    
    
  //  echo $card_no;
    
    if(empty($card_no)){


echo "<b style='color: red;'> please enter card number</b>";

die();




}else if(strlen($card_no) < 15){

echo "
<b style='color: red;'> Card number too short</b>";


die();

}else{


if(strlen($card_no) > 15){


echo "<b style='color: red;'> number too long</b>";

die();




}else{




$card_no = htmlspecialchars($card_no);



require_once "db_connection.php";



$fetch_card = "SELECT * FROM Credit_card WHERE Credit_card_no='$card_no'";


$result = $conn -> query($fetch_card);


if($result -> num_rows > 0){

$results = $result -> fetch_assoc();

//NOW USE USER ID TO FETCH USER FULL NAME//



$user_details = "SELECT * FROM Register_db WHERE id='$results[User_id]'";

$user_result = $conn -> query($user_details) -> fetch_assoc();


$full_name = $user_result["Surname"]." ". $user_result["Last_name"]." ".$user_result["First_name"];

//cho $full_name;

//die();

echo "<br><b style='color: white;padding: 10px 10px;border-radius: 2rem; width: 90%;text-align: center;background-color: rgb(0,0,56);'>". $full_name." <i class='fa fa-flash' style='color: red;'></i></b><br>";










}else{




echo "<p style='color: red;'>Invalid card</b>";

die();




}







}




}


    
    
    
    
}









?>