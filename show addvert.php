<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

  header("Location: Warning.php");
  exit;

      header('HTTP/1.0 403 Forbiddden',TRUE,403);
      die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}

//IF COOKIE IS NOT SET SHOW ADVERT//



if(!isset($_COOKIE["addvert_one"])){

require_once __DIR__.("/Addvert.php");


}else{
    
    if(!isset($_COOKIE["addvert_two"])){

//Check IF FILE NAME IS REQUEST MINEY TO AVOID SHOWING ADDVERT THERE//
/*if(!realpath(__FILE__)==
 "/Request money.php"){*/
 
require_once __DIR__.("/Addvert two.php");



    
    
}}

?>