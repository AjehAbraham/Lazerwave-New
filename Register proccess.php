<?php
require_once __DIR__ .("/Daily visitors.php");


if ($_SERVER["REQUEST_METHOD"] == "POST"){

   $error = [];
   


$surname = filter_var($_POST["surname"],FILTER_SANITIZE_STRING);



//CHECK IF FIRST NAME IS EMPTY//
if (empty($surname)){


   // echo "Surname name cannot be blank";

    $message_status = "Surname cannot be blank";


    require_once __DIR__.("/Failed.php");

  // echo $error["Surname"] = "Name cannot be blank";
    
    die();



}else{


//  CHECK IF NAME ARE ALPHABET


if (!preg_match("/^[a-zA-Z-']*$/",$surname)){



    $message_status = "Only letters or alphabet is allowed for surname";


    require_once __DIR__.("/Failed.php");

    //$error["First_name"] = "Only letters or alphabet is allowed";
    



die();



}else{



//CHECK IF SPECIAL character IS IN THE FROM LIKE TO AVOID INJECTION


htmlspecialchars($surname);


}


//htmlspecialchars($first_name);


}



//NOW CHECK LAST NAME

//REMEBER LAST NAME IS OPTIONAL




$last_name = filter_var($_POST["last_name"],FILTER_SANITIZE_STRING);


//  CHECK IF NAME ARE ALPHABET




if (!empty($last_name)){


if (!preg_match("/^[a-zA-Z-']*$/",$last_name)){



    $message_status = "Only letters or alphabet is allowed for last name";


    require_once __DIR__.("/Failed.php");

  //  $error["First_name"] = "Only letters or alphabet is allowed";
    



die();



}else{



//CHECK IF SPECIAL CHRATER IS IN THE FORM  TO AVOID INJECTION


htmlspecialchars($last_name);


}

}






//NOW CHECK FIRST NAME



$first_name = filter_var($_POST["first_name"],FILTER_SANITIZE_STRING);



//CHECK IF FIRST NAME IS EMPTY//
if (empty($first_name)){

    $message_status = "First name cannot be blank";


    require_once __DIR__.("/Failed.php");

   // $error["First_name"] = "Name cannot be blank";
    
    die();



}else{


//  CHECK IF NAME ARE ALPHABET


if (!preg_match("/^[a-zA-Z-']*$/",$first_name)){



    $message_status = "Only letters or alphabet is allowed for first name";


    require_once __DIR__.("/Failed.php");

   // $error["First_name"] = "Only letters or alphabet is allowed";
    



die();



}else{



//CHECK IF SPECIAL CHRATER IS IN THE FORM  TO AVOID INJECTION


htmlspecialchars($first_name);


}

}







//NOW CHECK GENDER



$gender = filter_var($_POST["Gender"],FILTER_SANITIZE_STRING);



//CHECK IF FIRST NAME IS EMPTY//
if (empty($gender)){

    $message_status = "Please select a gender";


    require_once __DIR__.("/Failed.php");

   // $error["Gender"] = "please select a gender";
    
    die();



}else{


//  CHECK IF NAME ARE ALPHABET


if (!preg_match("/^[a-zA-Z-']*$/",$gender)){



    $message_status = "Invalid gender";


    require_once __DIR__.("/Failed.php");

    //$error["Gender"] = "Invalid gender";
    



die();



}else{

    //FIRST CHECK IF GENDER IS MALE OF FEMALE//


if (!$gender == "Male" || !$gender == "Female"){



    $message_status = "Invalid gender,please select male or female";


    require_once __DIR__.("/Failed.php");

  //  $error["Gender"] = "Invalid gender,please select male or female";
    



}else{






//CHECK IF SPECIAL CHRATER IS IN THE FORM  TO AVOID INJECTION


htmlspecialchars($gender);


}

}

}






//NOW CHECK COUNTRY 



$country = filter_var($_POST["Country"],FILTER_SANITIZE_STRING);



//CHECK IF FIRST NAME IS EMPTY//
if (empty($country)){

    $message_status = "Please select country";


    require_once __DIR__.("/Failed.php");

  //  $error["Gender"] = "please select country";
    
    die();



}else{

    //NOW CHECK IF IT MATCH EITHER NIGERIA OR GHANA//


    if ($country == "South Africa"){

        $message_status = "We are unavailable in your region ".$country;


        require_once __DIR__.("/Failed.php");
    
      //  $error["Gender"] = "We are unavaliable in your region";
        
        die();

    }


    if (!$country == "Nigeria" AND !$country == "Ghana"){

        $message_status = "We are unavaliable in your region";


        require_once __DIR__.("/Failed.php");
    
      //  $error["Gender"] = "We are unavaliable in your region";
        
        die();

    }


    htmlspecialchars($country);



}








//NOW CHECK Gmail



$email = filter_var($_POST["email"],FILTER_VALIDATE_EMAIL);



//CHECK IF FIRST NAME IS EMPTY//
if (empty($email)){

    $message_status = "Please enter your mail";


    require_once __DIR__.("/Failed.php");

   // $error["Email"] = "Please enter your mail";
    
    die();



}else{


//  CHECK IF  EMAIL IS VALID


if (!filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)){



    $message_status = "Please enter a valid mail";


    require_once __DIR__.("/Failed.php");

  //  $error["Email"] = "Please enter a valid mail";
    



die();



}else{



//CHECK IF SPECIAL CHRATER IS IN THE FORM  TO AVOID INJECTION


htmlspecialchars($email);


}

}







//NOW CHECK FOR PASSWORD



$password = htmlspecialchars($_POST["Password"]);


if (empty($password)){


    $message_status = "Password cannot be empty";


    require_once __DIR__.("/Failed.php");

   // $error["Password"] = "Password cannot be empty";
    

    die();




}else{

//CHECK THE LENGTH OF PASSWORD IF IT IS UP TO 8

$str = 8;


if (strlen($password) < $str){



    $message_status = "Password Must be at least 8 in length";


    require_once __DIR__.("/Failed.php");

   // $error["Password"] = "Password Must be at least 8 in length";
    

die();



}else{


//CHECK IF PASSWORD IS AT LEAST ONE UPPERCASE ONE LOWER CASE AND ONE SPECIAL CHARACTER



if (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/",$password)){



    $message_status = "Password Must contain at least one uppercase one lowercase 
    and one special charcter";


    require_once __DIR__.("/Failed.php");

   // $error["Password"] = "Password Must contain at least one uppercase one 
   // lowercase and one special charcter";
    

die();




}else{


   // echo "passwword match";

   $hash = password_hash($password,PASSWORD_DEFAULT);

    htmlspecialchars($password);
}




}




}



//CHECK IF USER ACCEPT THE TERMS AND CONDITION

$terms = filter_var($_POST["terms"],FILTER_SANITIZE_STRING);

    if (empty($terms)){


        $message_status = "Please accept our terms";
    
    
        require_once __DIR__.("/Failed.php");
    
       // $error["Password"] = "Please accept out terms";
        

        die();



    }else{



            if (!$terms =="yes"){
                
            $message_status = "error,please accept our terms";
    
    
            require_once __DIR__.("/Failed.php");
        
           // $error["Password"] = "Please accept out terms";
            

die();


            }



        }



htmlspecialchars($terms);


//CHECK IF USER ALREADY EXIST//



require_once __DIR__.("/db_connection.php");


$check = "SELECT * FROM Register_db WHERE Email = '$email'";


$result = $conn -> query($check);


if ($result -> num_rows > 0){

//USER ALREADY EXIST


$message_status = "User already exist &#128532;,Please use a different email";
    
    
require_once __DIR__.("/Failed.php");



die();



}





//NOW INSERT TO REGISTER DB //


$date = htmlspecialchars(date("Y-m-d  H:i:s"));

$time = htmlspecialchars(date("H:i:s"));


$account_no =rand(12535,56277) . rand(21565,10566);
//CHECK IF ACCOUNT NO IS ALREADY IN DATABASE

require_once "db_connection.php";

$check_dup ="SELECT * FROM Register_db WHERE Account_no = '$account_no'";

$dup_result = $conn -> query($check_dup);

if($dup_result -> num_rows > 0){
    
    //DUPLICATE ACCOUNT NO REGENEATE NEW ACCOUNT NUMBER//
    
    
    $account_no =rand(72636,82525). rand(16483,97363);
    
    
    
    
}else{
    
    
    //echo "non found";
    
    
}






//$message_status =$account_no;

//require_once "Failed.php";

$account_bal = 90000;

$ip_addr =htmlspecialchars($_SERVER["REMOTE_ADDR"]);



require_once __DIR__.("/db_connection.php");


$insert_record = "INSERT INTO Register_db 


(
Surname,Last_name,First_name,Country,Email,Password,
Gender,I_agree,Account_no,Account_balance,Date_reg,	
Time_reg,Ip_addr)

VALUES(
'$surname','$last_name','$first_name','$country',
'$email','$hash','$gender','$terms','$account_no','$account_bal','$date',
'$time','$ip_addr')
";

if ($conn -> query($insert_record) == TRUE){

//INSERTED SUCCESSFULLY
//echo $_POST["code"];




require_once __DIR__.("/Redeem code.php");




$message_status = "Registration successful! &#128540 <br> <a href='Login.php'>Login</a>";
    
    
require_once __DIR__.("/success.php");

require_once __DIR__.("/Welcome.php");

header("Location: Login.php");


die();


}else{


    //FAILED TO INSERT TO REGISTER DB

    $message_status = "Registration failed,please try again  &#128532;";
    
    
    require_once __DIR__.("/Failed.php");
    die();


}


$conn -> close();












}else{
//REDIRECT IF IT IS A GET REQUEST TO AVOID ERRORS //



header("Location:Warning.php");
exit;



}
