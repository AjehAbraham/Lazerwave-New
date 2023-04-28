<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

  header("Location: Warning.php");
  exit;

      header('HTTP/1.0 403 Forbiddden',TRUE,403);
      die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}

require_once "sessionPage.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){

if(isset($_POST["Message"])){

$message = htmlspecialchars($_POST["Message"]);





}else{

$nessage ="";



}




//TITLE//

$title = filter_var($_POST["Link_title"],FILTER_SANITIZE_STRING);


if(empty($title)){


$message_status ="Please enter description/title";

require_once "Failed.php";


die();



}else{



$title = htmlspecialchars($title);


}


$amount = (int) filter_var($_POST["Amount"],FILTER_VALIDATE_INT);

if(empty($amount)){


$message_status ="Please enter amount";

require_once "Failed.php";

die();


}else{


if($amount < 1000){


$message_status="Amount cannot be less than ₦1,000";

require_once "Failed.php";
die();




}else{



$amount = htmlspecialchars($amount);



}





}

//echo $message.$title,$amount;





$terms = filter_var($_POST["terms"],FILTER_SANITIZE_STRING);

//echo $terms;

if(empty($terms)){


$message_status ="Please accept our terms";

require_once "Failed.php";

die();


}else if(!$terms == "Yes"){


$message_status = "Invalid Terms";

require_once "Failed.php";



}else{


$terms = htmlspecialchars($terms);



}




if(empty($_FILES["image"]["name"])){

$image_path ="";

}else{
    
    
    
    echo $_FILES["image"]["name"];

if($_FILES["image"]["size"] > 120000){


$message_status ="File too large";

require_once "Failed.php";
die();



}else{

//FILE SIZE IS VERY OK//


$mime_type =  new finfo(FILEINFO_MIME_TYPE);


$mime_type= $finfo -> file ($_FILES["image"]["Type"]);

$mime_types = ["image/jpeg","image/gif","image/png"];

//CHECK IF IMAGE IS FAKE OR REAl


if(! in_array(
["image"]["Type"],$mime_types)){


$message_status ="Invalid image type,only jpeg,png,gif files types are supported";
require_once "Failed.php";

die();


}


$random = "(". $_SESSION["New_user"]. ")".images. uniqid().rand(34541,93733);

$pathinfo = pathinfo($_FILES["image"]["name"]);

$base = pathinfo["filename"];



//$base = preg_replace("/[^\w-]", "_", $base);


$filename = $random.$base .$pathinfo["extenstion"];


//Image path//

$image_path = $filename;


$destination = __DIR__. "/Link images/".$filename;


while(file_exist($destination)){


$destination = __DIR__. "/Link images/".$filename;



if(! move_uploaded_file($_FILES["image"]["tmp_name"],$destination)){


$message_status ="Error uploading your file ". $filename;


require_once "Failed.php";

die();



}else{
    
    
    echo "file uploaded";
}




}

}
//END OF IMAGE UPLOAD//







}





//die();


//INSERT DATAS TO PAYMENT LINK TABLE//


$date = htmlspecialchars(date("Y/m/d H:i:s"));
$time = htmlspecialchars(date("H:i:s"));


$ip_addr = htmlspecialchars($_SERVER["REMOTE_ADDR"]);

$hash_link = rand(72636,83737). uniqid().rand(6363,6363).uniqid();

$status ="Active";

require_once "db_connection.php";

$insert ="INSERT INTO Payment_link_table(User_id,Amount,Hash_link,Date_created,Ip_addr,Image_path,Link_message,Time,Title,I_agree,Status)



VALUES('$_SESSION[New_user]','$amount','$hash_link','$date','$ip_addr','$image_path','$message','$time','$title','$terms','$status')

";



if($conn -> query($insert) == TRUE){


$hash_link = "lazerwave.000webhostapp.com/New payment.php?name=$hash_link&user=$user[Surname]$user[Last_name]$user[First_name]&Card_top=$user[id]";


echo "<div class='Link_generated'>

<p>$hash_link </p>


<p onlick='copy_link()'><i class='fa  fa-link'></i> Copy link</p>

<p onclick='window.location.reload()'><i class='fa fa-refresh'> </i> Recreate link</p>


<input type='hidden' value='$hash_link' id='link_value'>

</div>
";



}else{



$message_status ="Error creating link,please try again." .$conn -> error;

require_once "Failed.php";


}







}




?>