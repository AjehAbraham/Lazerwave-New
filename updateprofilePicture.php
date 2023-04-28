<?php
require_once __DIR__.("/sessionPage.php");



if (!isset($_SESSION["New_user"])){
      header("location:Login.php");
      exit;
}




if ($_SERVER["REQUEST_METHOD"] !== "POST"){
    header("location: profile.php");
exit("post method required");

}

if(empty($_FILES)){
    //header("location: profile.php");

    $message_status = "File is empty.
    <br> <b onclick='window.history.back(-2)'>Go back</b>";
    
    
    require_once __DIR__.("/Failed.php");


    exit();
  

}

if ($_FILES["image"]["size"] > 1200000){



    $message_status = "file too large max(12mb) <br> <b onclick='window.history.back(-2)'>Go back</b>";
    
    
    require_once __DIR__.("/Failed.php");



   // header("location: profile.php");
 die();
   
}
$finfo = new finfo(FILEINFO_MIME_TYPE);
$mime_type = $finfo -> file($_FILES["image"]["tmp_name"]);
$mime_types =["image/gif", "image/png", "image/jpeg"];
if(! in_array($_FILES["image"]["type"],$mime_types)){
 

    $message_status = "invalid file type,only Gif,Png,Jpeg supported <br> <b onclick='window.history.back(-2)'>Go back</b>";
    
    
    require_once __DIR__.("/Failed.php");
 die();
}

$random = $_SESSION["New_user"] . "." . "image". rand(999,9999). uniqid();

$pathinfo = pathinfo($_FILES["image"]["name"]);

$base = $pathinfo["filename"];

$base = preg_replace("/[^\w-]", "_", $base);

$filename =  
$random . $base . "." . $pathinfo["extension"];

$destination = __DIR__. "/Uploads/" . $filename;

$i = 1;

while (file_exists($destination)){
    
$random = $_SESSION["New_user"] . "image". rand() . uniqid();


$filename = $base . "($i)." .$pathinfo["extenstion"];
$destination  = __DIR__ . "/uploads/" . $filename;

$i++;

}
if (! move_uploaded_file($_FILES["image"]["tmp_name"],$destination)){



    $message_status = "Error in uploading your file,please try again <br> <b onclick='window.history.back(-2)'>Go back</b>";
    
    
    require_once __DIR__.("/Failed.php");


    die();
//header("location: profile.php");

}else{


    include __DIR__.("/db_connection.php");


/* $check_image = "SELECT * FROM Profile_picture WHERE User_id = '$_SESSION[New_user]' ";

 $result = $conn -> query($check_image);


 if ($result -> num_rows > 0){
    while($profile_picture = $result -> fetch_assoc()){

        $update_image_path = "UPDATE Profile_picture SET Image_path ='$filename'  WHERE User_id = '$_SESSION[New_user]'";

        if($conn -> query($update_image_path) == TRUE){
           
           
    $message_status = "Updated  <br> <b onclick='window.history.back(-2)'>Go back</b>";
    
    
    require_once __DIR__.("/success.php");


           // echo "<p>Updated successfully</p>";
           // header("location:profile.php");
        }


    }
 }else{*/

 



$date_up =htmlspecialchars( date("Y-m-d H:i:s"));
$time = date("H:i:s");

 $stmt= $conn -> prepare( "INSERT INTO Profile_picture (User_id,Image_path,Date_id,Time_id)
 
 VALUES(?,?,?,?)
 
 ");

 $stmt -> bind_param("isss",$_SESSION["New_user"],$filename,$date_up,$time);

 $stmt -> execute();
 

 if ($stmt== TRUE){
  
  

   // $message_status = "server error,please try again later <br> <b onclick='window.history.back(-2)'>Go back</b>";
   
   $message_status = "Profile picture uploaded successfully";
    
    
    require_once __DIR__.("/success.php");


    die();


  //  echo "Uploaded successfully";
   // header("location:profile.php");
   // exit;
 }else{
   


    $message_status = "error,fail to uplaod,please re-upload again <br> <b onclick='window.history.back(-2)'>Go back</b>";
    
    
    require_once __DIR__.("/Failed.php");


    die();


 }


$stmt -> close();
$conn -> close();
}

?>