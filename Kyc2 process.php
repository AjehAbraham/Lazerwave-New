<?php 


require_once __DIR__.("/sessionPage.php");


if (!isset($_SESSION["New_user"])){
  header("location:login.php");
  exit;
}



if ($_SERVER["REQUEST_METHOD"] == "POST"){

$DOB =  htmlspecialchars($_POST["DOB"]);

if (empty($DOB)){
    
    $message_status = "Please enter a date for date of birth";

    require_once __DIR__.("/Failed.php");


  die();


}else{


  htmlspecialchars($DOB);





}

/*
if (!validateDate($_POST['DOB']) == TRUE){
  die($error_message = "Please enter a valide date format.");
}else{
  htmlspecialchars($DOB);
}
*/

$state = filter_var($_POST["state"],FILTER_SANITIZE_STRING);

if (empty($state)){

 
    $message_status = "State cannot be blank";

    require_once __DIR__.("/Failed.php");

  die();


}else{

if (!preg_match("/^[a-zA-Z-']*$/",$state)){



    $message_status = "Only letters and white spaces is allowed for state";

    require_once __DIR__.("/Failed.php");


    die();



}




  htmlspecialchars($state);
}





$LGA = filter_var($_POST["LGA"],FILTER_SANITIZE_STRING);

if (empty($LGA)){


    $message_status = "Please enter a your  Local govermenmt.";

    require_once __DIR__.("/Failed.php");


    die();


}else{


if (!preg_match("/^[a-zA-Z-']*$/",$LGA)){



    $message_status = "Only letters and white spaces is allowed for LGA";

    require_once __DIR__.("/Failed.php");


    die();



}

  htmlspecialchars($LGA);


}




$M_name = filter_var($_POST["M_name"],FILTER_SANITIZE_STRING);

if (empty($M_name)){


    $message_status = "Please enter Mother's name .";
    
    require_once __DIR__.("/Failed.php");


    die();


}else{


   /* if (!preg_match("/^[a-zA-Z-']*$/",$M_name)){



        $message_status = "Only letters and white spaces is allowed for Mother's name";
    
        require_once __DIR__.("/Failed.php");
    
    
        die();
    
    
    
    }*/



  htmlspecialchars($M_name);
}




$N_kin= filter_var($_POST["N_kin"],FILTER_SANITIZE_STRING);

if (empty($N_kin)){


    $message_status = "Next of kin name cannot be blank.";

    
    require_once __DIR__.("/Failed.php");


    die();


}else{


  /*  if (!preg_match("/^[a-zA-Z-']*$/",$N_kin)){



        $message_status = "Only letters and white spaces is allowed for Next of kin";
    
        require_once __DIR__.("/Failed.php");
    
    
        die();
    
    
    
    }
*/


  htmlspecialchars($N_kin);
}




$Status = filter_var($_POST["status"],FILTER_SANITIZE_STRING);

if (empty($Status)){



    $message_status = "Please tell us your relationship status with your next of kin.";
    
    require_once __DIR__.("/Failed.php");


    die();


}else{

    
    if (!preg_match("/^[a-zA-Z-']*$/",$Status)){



        $message_status = "Only letters and white spaces is allowed for Relationship with Next of kin";
    
        require_once __DIR__.("/Failed.php");
    
    
        die();
    
    
    
    }


    


  htmlspecialchars($Status);
}





$occupation = filter_var($_POST["Occupation"],FILTER_SANITIZE_STRING);

if (empty($occupation)){


    $message_status = "Please tell us more about your job status.";
    
    require_once __DIR__.("/Failed.php");


    die();


}else{


  /*  if (!preg_match("/^[a-zA-Z-']*$/",$occupation)){



        $message_status = "Only letters and white spaces is allowed for Occupation";
    
        require_once __DIR__.("/Failed.php");
    
    
        die();
    
    
    
    }*/


//CHECK IF OCCUPATION IS A VALID ONE


if (!$occupation === "Student" || !$occupation === "Self employed" ||
!$occupation === "Employed" || !$occupation === "Retired"){


    $message_status = "Invalid occupation";
    
    require_once __DIR__.("/Failed.php");


    die();





}





  htmlspecialchars($occupation);


}

require_once __DIR__.("/db_connection.php");

$date =htmlspecialchars( date("Y-m-d  h:i:s") );

$ip_addr = htmlspecialchars( $_SERVER["REMOTE_ADDR"]);



$stmt  = $conn -> prepare("INSERT INTO More_information(User_id,DOB,State_origin	,LGA,Mother_name,
Next_kin,Relationship_kin,Occupation,Date_sub,Ip_add	)

VALUES(?,?,?,?,?,?,?,?,?,?)

");

$stmt -> bind_param("isssssssss",$_SESSION['New_user'],$DOB,$state,$LGA,$M_name,$N_kin,$state,$occupation,$date,$ip_addr);


if ($stmt == TRUE){

  $stmt -> execute();
  
  $message_status = "Updated Successfully";

  require_once __DIR__.("/success.php");


}else{
 
    $message_status = "An unknown error has occur,please try again later";
    
    require_once __DIR__.("/Failed.php");


    die();

}
$stmt -> close();

$conn -> close();





}


?>


