<?php

require_once __DIR__.("/Daily visitors.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

  header("Location: Warning.php");
  exit;

      header('HTTP/1.0 403 Forbiddden',TRUE,403);
      die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}









if($_SERVER["REQUEST_METHOD"] == "POST"){

$fname ="";


if(isset($_POST["fname"])){

$fname =htmlspecialchars($_POST["fname"]);


$fname  =filter_var($fname,FILTER_SANITIZE_STRING);


if(empty($fname)){
    
    echo"<p> search is empty,please enter a keyword</p>";
    die();
}


if(!empty($fname)){


require_once __DIR__.("/db_connection.php");


$search ="SELECT * FROM Help_center WHERE Title LIKE '%$fname%'";

$search_result = $conn -> query($search);


if($search_result -> num_rows > 0){

//RESULT WAS FOUND MOW DISPLAY TO USER//

while($display_search = $search_result -> fetch_assoc()){

echo "<h2 style='padding: 10px 10px;background-color: rgba(255,0,0,0.4);font-size: 18px; color: white'>".$display_search["Title"]
."<h2>

<p style='font-size: 15px;color: #555'>".$display_search["Message"]."</p>";




}




}else{


echo "<p> No search result found";



}






}else{

echo "<p>Search is empty</p>";


}





}






}



?>