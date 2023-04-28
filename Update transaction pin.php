<?php
require_once __DIR__.("/sessionPage.php");



if($_SERVER["REQUEST_METHOD"] == "POST"){


$pin = (int) filter_var($_POST["new_pin"],FILTER_VALIDATE_INT);


$str = 4;

if(empty($pin)){


$message_status = "Please enter pin";

require_once __DIR__.("/Failed.php");
die();


}else if(strlen($pin) < $str){



    $message_status = "Pin cannot be less than 4";

    require_once __DIR__.("/Failed.php");
    
die();


}





$password = htmlspecialchars($_POST["password"]);



if(empty($password)){


    $message_status = "Please enter your password";
    
    require_once __DIR__.("/Failed.php");
    die();
    
    
    }else{

//CHECK IF USER PASSWoRD IS CORRECT//


if (password_verify($password,$user["Password"]) == "password_hash"){

//UPDATE USER PIN//


$hash = password_hash($pin,PASSWORD_DEFAULT);


$update = "UPDATE User_pin SET Pin ='$hash' WHERE User_id ='$_SESSION[New_user]'";



if ($conn -> query($update) == TRUE){


    if(empty($pin)){


        $message_status = "Transaction pin has been updated successfully";
        
        require_once __DIR__.("/success.php");
        
        
        }




}else{

//faield \\



    $message_status = "error,please try again";
    
    require_once __DIR__.("/Failed.php");
    
    
    




}




}else{


//PASSWORD IS NOT VALID//

if(empty($pin)){


    $message_status = "incorrect password";
    
    require_once __DIR__.("/Failed.php");
    
    
    }



}






    }





}

?>