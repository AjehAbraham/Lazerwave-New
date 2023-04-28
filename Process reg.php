

<?php

/*
$Account_no = "30308 ". rand(999,99999);
echo $Account_no;

*/
if ($_SERVER["REQUEST_METHOD"] == "POST"){

  $surname_error_message = $last_name_error_message = $first_name_error_mesage 

  =$gender_error_message = $country_error_message = $email_error_message = $password_error_message
  = $reg_success_message = $failed_reg_message = $terms_error_message = "";

  $surname = filter_var($_POST["surname"],FILTER_SANITIZE_STRING);

  if(empty($surname)){

    die($surname_error_message = "Name cannot be blank");

  }else{

    htmlspecialchars($surname);
  }


  $last_name = filter_var($_POST["last_name"],FILTER_SANITIZE_STRING);

  if(empty($last_name)){
    $last_name ="";
  }else{

    htmlspecialchars($last_name);
  }



$first_name =filter_var($_POST["first_name"],FILTER_SANITIZE_STRING);

if(empty($first_name)){
  die($first_name_error_mesage = "Name cannot be blank");
}else{

htmlspecialchars($first_name);

}




$gender =  filter_var($_POST["gender"],FILTER_SANITIZE_STRING);
if(empty($gender)){

  die($gender_error_message = "Please select a gender");

}else{

if ($gender == "Male" or "Female"){

    htmlspecialchars($gender);

}else{

die($gender_error_message = "invalid gender");

}



  
}






$country =  filter_var($_POST["country"],FILTER_SANITIZE_STRING);
if(empty($country)){
  die($country_error_message = "Please select country");
} else{

if ($country == "Nigeria" || $country == "Ghana"){

htmlspecialchars($country);


}else{

die($country_error_message = "We are currently not avaaliable in your region,please select another region.");


}



}


$email = filter_var($_POST["email"],FILTER_VALIDATE_EMAIL);

if (!filter_var($_POST["email"],FILTER_VALIDATE_EMAIL) == TRUE){

    die($email_error_message = "Invalid email");
}else{

htmlspecialchars($email);

}






$password = htmlspecialchars ($_POST["password"]);
if(empty($password)){
  die($password_error_message = "Password cannot be empty");

} else{

$str = 8;

if (strlen($password) >= $str){


  $hash = password_hash($password,PASSWORD_DEFAULT);

  htmlspecialchars($hash);

}else{

die($password_error_message = "Password must be at least 8 in length");

}



}




$terms =  filter_var($_POST["terms"],FILTER_SANITIZE_STRING);
if(empty($terms)){
  die($terms_error_message = "Please accept out terms and conditions");

}else{


    if ($terms == "yes"){

        htmlspecialchars($terms);


    }else{

die($terms_error_message = "Invalid terms,Please select a valid terms");


    }


}

/// TRIM AND REMOVE BACKLASH FROM INPUT//


trim($first_name);
trim($last_name);
trim($surname);
trim($country);
trim($gender);
trim($terms);

//NOW REMOVE BACKLASH//

stripcslashes($first_name);
stripcslashes($last_name);
stripcslashes($surname);
stripcslashes($country);
stripcslashes($gender);
stripcslashes($terms);

//NOW CHECK IF NAME IS LETTERS OR FAKE//
if (!preg_match("/^[a-zA-Z-']*$/",$first_name)){


    die($first_name_error_mesage = "only letters and white spaces are allowed");

}


if (!preg_match("/^[a-zA-Z-']*$/",$last_name)){


    die($last_name_error_message = "only letters and white spaces are allowed");

}

if (!preg_match("/^[a-zA-Z-']*$/",$surname)){


    die($surname_error_message = "only letters and white spaces are allowed");

}





//NOW CHECK IF EMAIL ALREADY EXIST IN DATABASE TO AVOID DUPLICATE ENTERY//

  
    require_once __DIR__ .("/db_connection.php");
  
  
    $sql = "SELECT * FROM Register_db WHERE Email = '$email'";
  
  
    $result = $conn -> query ($sql);
  
    if ($result -> num_rows > 0){
      
        die($email_error_message = "User already exist");
    
      
    }else{

      $date = date("Y/m/d");
      $time = date("h:i:sa");


      $NO = rand(222,987658);

      $Account_no = "3030". $NO;

       
      $account_balance = 95000;
      
  
  $stmt=  $conn -> prepare ("INSERT INTO Register_db(Surname,Last_name,First_name,Country,
  Email,Password,Gender,I_agree,Account_no,Account_balance,Date_reg,Time_reg)
  
  VALUES(?,?,?,?,?,?,?,?,?,?,?,?)
  
  ");
  
  
  $stmt -> bind_param("ssssssssiiii",$surname,$last_name,$first_name,$country,$email,$hash,$gender,$terms,$Account_no,$account_balance,$date,$time);
  
  $stmt -> execute();
  
if ($stmt == TRUE){

    $reg_success_message = "Registration successful";

}else{

    die($failed_reg_message = "Failed,Please try again");



}

  
  $stmt -> close();
  $conn -> close();



/*
  header("location:destroySession.php");*/
 
  
    }
  

  }
?>  
