<?php

require_once __DIR__.("/db_connection.php");

//CHECK IF USERNAME EXIST OR NOT//


$username_test ="SELECT * FROM Username WHERE User_id='$_SESSION[New_user]'";

$username_result_check =$conn -> query($username_test);


if ($username_result_check -> num_rows > 0 ){

//DO NOTHING 



}else{

//No USERNAME FOUND SO SHOW POP UP//


require_once __DIR__.("/create username.php");



}


?>