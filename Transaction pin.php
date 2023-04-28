<?php
require_once __DIR__.("/sessionPage.php");


if (!isset($_SESSION["New_user"])){
    header("location:login.php");
    exit;
}



//require_once __DIR__.("/Network.php");



if ($_SERVER["REQUEST_METHOD"] == "POST"){

$pin =htmlspecialchars( $_POST["confirm-pin"]);


if(empty($pin)){
   
    $message_status = "Transaction pin cannot be empty";

    require_once __DIR__.("/Failed.php");

die();


}else if (!$pin >= 4){

    $message_status = "Pin must be four digit";

    require_once __DIR__.("/Failed.php");

die();

}else{

if ($_POST["new_pin"] == $pin){


$pin = password_hash($pin,PASSWORD_DEFAULT);

$Date = date("Y-m-d  h:i:s");

    require_once __DIR__.("/db_connection.php");



$Check_if_pin_exist = "SELECT * FROM User_pin WHERE User_id = '$_SESSION[New_user]'";


$result = $conn -> query($Check_if_pin_exist);


if ($result -> num_rows > 0){

    while($verify_pin_exist = $result -> fetch_assoc()){

        $update = "UPDATE User_pin SET Pin = '$pin' WHERE User_id = '$_SESSION[New_user]' ";

        if ($conn -> query ($update) == TRUE){

            $message_status = "Pin updated successfully";

require_once __DIR__.("/success.php");

        
        
        }else{
            
        }
    }

}else{
    
    $stmt  = $conn -> prepare("INSERT INTO User_pin(User_id,Pin,Date_id)
        
        VALUES(?,?,?)
        
        ");

$stmt -> bind_param("iss",$_SESSION["New_user"],$pin,$Date);

$stmt -> execute();


if ($stmt== TRUE){


    $message_status = "Pin created successfully";

    require_once __DIR__.("/success.php");
    

}else{


    $message_status = "An unknown error has occur";

    require_once __DIR__.("/Failed.php");

die();
}
}




}else{


    $message_status = "Pin mismatch";

    require_once __DIR__.("/Failed.php");

die();

}



}


}else{
    header("location:setting.php");
    exit;
}