<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

  header("Location: Warning");
  exit;

      header('HTTP/1.0 403 Forbiddden',TRUE,403);
      die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}

$servername = "localhost";
/*
$db_username = "id19788732_lazertrigger";

$db_password = "Lazerwaveajeh821203$";
$db_name = "id19788732_lazerwave";
*/

$db_username ="u891769756_elIr4";
$db_password ="Lazerwaveajeh821203$";
$db_name ="u891769756_cJ4EQ";

$conn = mysqli_connect($servername,$db_username,$db_password,$db_name);


if ($conn == TRUE){

 //echo "connected";

}else{
    
    
  echo "db created". $conn -> error;
  
}

/*
$delete_db = "CREATE DATABASE Lazer_wave_db";


if ($conn -> query($delete_db) == TRUE){



    echo "database deleted";
}
*/
