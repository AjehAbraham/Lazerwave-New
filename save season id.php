<?php





if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

  header("Location: Warning.php");
  exit;

      header('HTTP/1.0 403 Forbiddden',TRUE,403);
      die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}



//INSERT SESSION ID SO THAT USER CANNOT LOGIN WITH DIFFERENT DEVICE OR BROWERS AT THE SAME TIME//


/*
require_once "db_connection.php";

$create ="CREATE TABLE User_session_id(id INT(123) UNSIGNED AUTO_INCREMENT PRIMARY KEY,User_id INT(20) , Session_id VARCHAR(255),Hash_key VARCHAR(255),Date TIMESTAMP,Time TIME,Ip_addr VARCHAR(40) )";


if($conn -> query($create) == TRUE){


echo "Table created ";


}else{

echo "error creating table". $conn -> error;



}

*/

//INSERT VALUES TO TABLE//

$session_id = session_id();


$key_id = rand(). uniqid().rand();

//SET COOKIE FOR 5 MINUTES THAT WILL BE USESD TO CHECK EVERY FIVE ACTIVIES//
$log_cok_name = "Login_check";

$log_value = $key_id;

setcookie($log_cok_name,$log_value,time() + 18000);




//hash the key //
//$key_id = password_hash($key_id,PASSWORD_DEFAULT);



$ip = htmlspecialchars($_SERVER["REMOTE_ADDR"]);

$date = htmlspecialchars(date("Y/m/d H:i:s"));

$time = htmlspecialchars(date("H:i:s"));


//NOW INSERT VALUE TO DB//


$Log_activies = "INSERT INTO User_session_id(
User_id,Session_id,Hash_key,Date,Time,Ip_addr)


VALUES('$_SESSION[New_user]','$session_id','$key_id','$date','$time','$ip'

)";


if($conn -> query($Log_activies) == TRUE){


///DO NOTHING 



}else{


$conn -> error;


}
?>
