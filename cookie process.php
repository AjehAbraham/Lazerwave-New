<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

  header("Location: Warning.php");
  exit;

      header('HTTP/1.0 403 Forbiddden',TRUE,403);
      die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}

if($_SERVER["REQUEST_METHOD"] == "POST"){


if(isset($_POST["set_cookie"])){


$cookie = filter_var($_POST["set_cookie"],FILTER_SANITIZE_STRING);

if(empty($cookie)){

die("<b style='color: red;'>Error request</b>");
}

if(!$cookie == "Accept"){

die("<b style='color: red;'>Invalid request type</b>");

}




$cookie = htmlspecialchars($cookie);



$cookie_name = "Cookie_consent";

$cookie_value = $cookie;


setcookie($cookie_name,$cookie_value,time() + 86400 * 5);



}else{


echo "<b style='color: red;'>Server error</b>";


}



}







?>