<?php

require_once __DIR__.("/sessionPage.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

  header("Location: Warning.php");
  exit;

      header('HTTP/1.0 403 Forbiddden',TRUE,403);
      die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}




if($_SERVER["REQUEST_METHOD"] == "POST"){

$username ="";


$username = htmlspecialchars($_POST["username"]);


if(empty($username)){


$message_status ="Please enter a username";

require_once __DIR__.("/Failed.php");
die();

}else{

//CHECK IF THERE IS SPECIAL CHARS IN THE USERNAME,BECASUEE USERNAME ONLY ACCEPT LETTER AND NUMBERS//


if(preg_match("/^(?=.*?[$&@?#%+=¥£€])$/",$username)){

$message_status ="
Only letters and numbers are allow";

require_once __DIR__.("/Failed.php");
die();


}else{



htmlspecialchars($username);


$username ="@".$username;
}




}
//CHECK IF USERNAME IS THERE OF NOT AVOILD DUPLICATE//


$name ="SELECT * FROM Username WHERE User_id ='$_SESSION[New_user]'";


$name_result = $conn -> query($name);


if($name_result -> num_rows > 0){


//USER ALREADY HAS A USERNAME//

$message_status ="You have already created a username";


require_once __DIR__.("/Failed.php")
;

die();



}else{


//USER NAME NOT FOUND




}








//NOW CHECK USERNAME IF IT EXIST IN DATABASE//



$if_exist ="SELECT * FROM Username WHERE Username ='$username'";


$exit_result =$conn -> query($if_exist);

if ($exit_result -> num_rows > 0){


//USERNAME ALREADY EXIST//


$message_status ="Username already taken,please choose another username or add numbers to the username above e.g" .$username. rand(123,321);

require_once __DIR__.("/Failed.php");
die();



}

//NOW INSERT USERNAME RECORD TO DATABASE //

$date =htmlspecialchars(date("Y-m-d H:i:s"));
$time = htmlspecialchars(date("H:i:s"));

$ip_addr =htmlspecialchars($_SERVER["REMOTE_ADDR"]);



$add_username ="INSERT INTO Username (User_id,Username,Date,Time,ip_addr)

VALUES('$_SESSION[New_user]','$username','$date','$time','$ip_addr')

";
if($conn -> query($add_username) == TRUE){


$message_status ="Username created";

require_once __DIR__.("/success.php");
die();



}else{


$message_status ="Error creating username,please try again";

require_once __DIR__.("/Failed.php");
die();





}





}


?>