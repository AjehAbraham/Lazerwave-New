<?php
require_once __DIR__.("/Daily visitors.php");


$suggestion[] ="Our goals";
$suggestion[] ="Withdrawal limit";
$suggestion[] ="How to increase limit";
$suggestion[] ="Daily limit";
$suggestion[] ="Privacy policy";
$suggestion[] ="Terms and conditions";

$suggestion[] ="Failed transaction";

$suggestion[] ="Successful but not credited";

$suggestion[] ="Pending transaction";
$suggestion[] ="Receiving error message";

$suggestion[] ="I can't send money";

$suggestion[] ="I can't access my account";

$suggestion[] ="Forgot password";

$suggestion[] ="Lost phone number/email";


/*
require_once __DIR__.("/db_connection.php");


$fetch ="SELECT Title FROM Help_center";

$result = $conn -> query($fetch);


if($result -> num_rows > 0){
    
    while($suggestion = $result-> fetch_assoc()){
        var_dump($suggestion);
        
       $_SESSION["suggestion"] = $suggestion["Title"]."<br>";
    }
    
    
}
*/




$q = $_REQUEST["q"];

$hint = "";

// lookup all hints from array if $q is different from "" 
if ($q !== "") {
  $q = strtolower($q);
  $len=strlen($q);
  foreach($suggestion as $name) {
    if (stristr($q, substr($name, 0, $len))) {
      if ($hint === "") {
        $hint = $name;
      } else {
        $hint .= ", $name";
      }
    }
  }
}

// Output "no suggestion" if no hint was found or output correct values 
echo $hint === "" ? "no suggestion" : $hint;


?>