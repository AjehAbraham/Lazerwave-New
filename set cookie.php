<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

  header("Location: Warning.php");
  exit;

      header('HTTP/1.0 403 Forbiddden',TRUE,403);
      die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}

if($_SERVER["REQUEST_METHOD"] == "POST"){

$cookie_one ="";


if (isset($_POST["addvert_one"])){

$cookie_one = htmlspecialchars($_POST["addvert_one"]);


if ($cookie_one == "addvert-one"){

$add_cookie_name ="addvert_one";

$add_cookie_value="addvert_one";

//SET COOKIE ONE DAY OR FOUR HOURS/:

setcookie($add_cookie_name,$add_cookie_value,time() + 14400);


}



}

//YOU CAN SET FOR ADDVERT TWO AND SO ON HERE SAME WAY//
if(isset($_POST["addvert_two"])){

$addvert_two = htmlspecialchars($_POST["addvert_two"]);



if($addvert_two == "addvert_two"){


//IS VALID REQUEST//


$add_two_cookie ="addvert_two";

$add_two_value ="addvert_two";


setcookie($add_two_cookie,$add_two_value, time() + 14400);



}

}







}
?>
