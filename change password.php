<?php require_once __DIR__.("/sessionPage.php") ;


if (!isset($_SESSION["New_user"])){
  header("location:login.php");
  exit;
}




if ($_SERVER["REQUEST_METHOD"] == "POST"){

    //include __DIR__.("/Loader.php");

$old_password = $_POST["old-password"];

$new_password = $_POST["new-password"];

$confirm_password = $_POST["confirm-password"];


if (empty($old_password)){

$message_status ="Old password cannot be empty";

require_once __DIR__.("/Failed.php");


    die();

}

if (empty($new_password)){

    $message_status ="New password cannot be empty";

    require_once __DIR__.("/Failed.php");
    
    
        die();

}
if (empty($confirm_password)){


    $message_status ="please re-enter new password in confirm password";

    require_once __DIR__.("/Failed.php");
    
    
        die();


  //  die("<p style='color:red;text-align:center;'>Confrim password cannot be empty</p>");

}


 if ($confirm_password !== $new_password){

    $message_status ="New password and confirm password does not match";

    require_once __DIR__.("/Failed.php");
    
    
        die();


 }else{

    //CHECK IF PASSWORD CONTAIN ONE UPPERCASE ONE LOWER CASE AND ONE SPECAIL CHARACTER



if (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/",$confirm_password)){



    $message_status ="password must container at least one uppercase,one lowercase,one special character and 8 in length ";

    require_once __DIR__.("/Failed.php");
    
    
        die();





}else{

    //echo $user["Password"];

//CHECK IF OLD PASSWORD PASSWORD MATCH BEFORE YOU CHNAGE THE PASSWORD//

if (password_verify($old_password,$user["Password"]) == "password_hash"){

//NOW CCHECK IF NEW PASSWORD AND OLD PASSWORD IS THE SAME//


if(password_verify($confirm_password,$user["Password"]) == "password_hash"){



    $message_status ="Old password and new password cannot be thesame";
    
    require_once __DIR__.("/Failed.php");
    
    
        die();





}else{

//UPDATE PASSWORD HERE//


//$update = "UPDATE Register_db SET Password ="

$hash = password_hash($confirm_password,PASSWORD_DEFAULT);


//NOW INSERT//

require_once __DIR__.("/db_connection.php");


$update = "UPDATE Register_db SET Password ='$hash' WHERE id='$_SESSION[New_user]'";

if ($conn -> query($update) == TRUE){



    $message_status ="Password updated successfully";

    require_once __DIR__.("/success.php");
    
    
        die();

}else{

//ERROR HAS OCCUR AND PASSWORD FAIL TO CHNAGE//


$message_status ="Error,please try again later";

require_once __DIR__.("/Failed.php");


    die();




}







}






}else{




    $message_status ="Old password is incorect";
    
    require_once __DIR__.("/Failed.php");
    
    
        die();
    
    
    
    }






}





 }


$conn -> close();

 }else{
    header("location:setting.php");
    exit;
 }
 



