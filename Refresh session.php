<?php

session_start();

//session_regenerate_id();

if(isset($_SESSION["New_user"])){


unset($_SESSION["New_user"]);
session_destroy;

session_start();

//header("Location:index.php");
//exit;

}

$isvalid = "";


//CHECK IF YOU REDIECT USER OR IS A FAKE REDIRECT//

if(isset($_SESSION["Refresh_session"])){
//NOW CHECK SESSION COOKIE IF IT IS VALID //
if(isset($_COOKIE["Refresh_session"])){

//NOW CHECK IF COOKIE MATCH//

$refresh =
htmlspecialchars($_COOKIE["Refresh_session"]);



if(password_verify($refresh,$_SESSION["Refresh_session"]) == "password_hash"){


//LOGIN CREDIENTIAL IS VALID 


//NOW FETCH THE LOGIN DETAILS FROM COOKIE AND COMPARE TO DATABASE OWN//


if(isset($_COOKIE["userId"])){

if(isset($_COOKIE["check_confirm_real"])){

//FIND USER DETAILS FROM DB AND SIGN IN USER//


require_once "db_connection.php";


$cook = htmlspecialchars($_COOKIE["userId"]);


$check ="SELECT * FROM  Register_db WHERE id ='$cook'";

$result = $conn -> query($check);


if($result -> num_rows > 0){

$results = $result -> fetch_assoc();

//RESULT WAS FOUND//

$_SESSION["user"] = $results["id"];

$_SESSION["mail"] = $results["Email"];

$_SESSION["Name"] = $results["Surname"];







}else{


//USER HAS TEMEPER COOKIE WE NEED TO REDIRECT//


// session_destroy();


unset($_COOKIE["Refresh_session"]);


setcookie("Refresh_session","",time() -86400);


header("Location: logout.php");

exit;







}




}








}
}








}else{


session_destroy();

header("Location: index.php");

exit;



}







}else{

header("Location: index.php");
exit;


}






//}else{

//header("Location: index.php");
//exit;






//NOW FETCH PASSWORD AND CHECK//


if($_SERVER["REQUEST_METHOD"] == "POST"){




$password = htmlspecialchars($_POST["password"]);


if($password ==""){

//PLEASE ENTER YOUR PASSOWRD FOR GMAIL:/



}else{

//CHECK IF PASSOWORD IS VALID //

require_once __DIR__.("/db_connection.php");



//var_dump($_SESSION);

$verify = "SELECT * FROM Register_db WHERE id ='$_SESSION[user]'";
 
 $user_result = $conn -> query($verify) -> fetch_assoc();
 
 
 //var_dump($user_result);
 
 //NOW CHECK IF USER PASSOWRD MATCH OR MOT//
 
 
 if(password_verify($password,$user_result["Password"]) == "password_hash"){
 
 session_regenerate_id();
 
 $_SESSION["New_user"] = $user_result["id"];
 
 
 //PASSWORD IS VALID//
 
 //CHECK IF USER CLICK REMEBER ME TO SET COOKIE AND SAVE USER DETIALS//
 
 
 require_once "save season id.php";
 
 
 
 if(isset($_POST["Remember_me"])){
 
 
 $cookie_name = "check_confirm_real";


                             $cookie_value = uniqid(). rand(9999,99999) * 170 . uniqid();
    
                             // hash th cookie value for safety
    
    
                             setcookie($cookie_name,$cookie_value,time() + 86400 * 7);
          $cookie_two_name ="userId";


                             $cookie_two_vaLue = $_SESSION["New_user"];

                            

                             setcookie($cookie_two_name,$cookie_two_vaLue,time() + 86400 * 7);
                             
   $cookie_value = password_hash($cookie_value,PASSWORD_DEFAULT);

                             $cookie_two_vaLue = password_hash($cookie_two_vaLue,PASSWORD_DEFAULT);
                             
                   
                             


 
                                    $insert_record = "INSERT INTO Authentication_table(User_id,Hash_key,Date_created)
                                   VALUES('$_SESSION[New_user]','$cookie_value','$date')";
                                if($conn -> query($insert_record) == TRUE){
                                    
                                    
                                    //DO NOTHIN
                                }else{
                                    
                          $conn -> error;          
                                    
                                }
                                
                                
                                   
                                   
                                   }
                                   
                                   
                         //UNSET COOKIE
                         
                         
                         unset($_COOKIE["Refresh_session"]);
                         
                         $new_va = rand(3444,8373) .uniqid().rand(63637,833737);
      
      setcookie("Refresh_session", $new_va,time() - 36000);
      
      
                                   
                                   

                              
 
 header("Location: index.php");
 exit;
 
 
 
 
 }else{
 //INVALID LOGIN CREDIENTIALS:/
 
// echo "<p style='color: white'>inavlid</p>";
 
 $isvalid ="Invalid password &#128532";
 
 
 
 
 }
 
 
 
 




}






}








?>



<!DOCTYPE html>
<html lang="eng_US">
  <head>
    <link rel="stylesheet" href="">
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width,initial-scale=1.0">
 <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
         

<script src="https://kit.fontawesome.com/958aace4f6.js" crossorigin="anonymous"></script>

<!-- ajax and jquery link -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<script src= "https://code.jquery.com/jquery-3.5.0.js"></script>

<!-- end of ajax link -->


<link href="https://fonts.googleapis.com/css2?family=Encode+Sans:wght@300&family=Island+Moments&family=Oswald:wght@200&family=PT+Serif:wght@700&family=Roboto+Mono:wght@100&display=swap" rel="stylesheet">

<title>Refresh session</title>
</head>
<body>

<div class="refresh-session-container">

<p>Your session has expired.</p>

<p>Hello <?php echo $_SESSION["Name"]?>,Welcome back.</p>

<p>Continue using <?php echo $_SESSION["mail"]?></p>


<p>  <?php echo  $isvalid; ?> </p>

<form method="post">

<label for="password"><b>Password</b></label>
<br>
<br>

<input type="password" name="password" placeholder="Your password">

<p>
<input type="checkbox" value="Remember_me" name="Remember_me"> Remember me</p>



<input type="submit" value="Login">
</form>


<a href="logout">
    <button>Home</button>
</a>



<p><a href="Reset password">Forgot password?</a></p>

<p><a href="Login">Login  in with diffrent account</a></p>

<p>New to Lazerwave? <a href="Register">sign in</a></p>


</div>




<style>
body{
margin: 0;
background-color: rgb(0,0,50);
color: white;
font-size: 15px;
font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    
    font-weight: lighter;

}
.refresh-session-container{

margin: auto;
text-align: center;
width: 95%;
background-color: white;
color: #666;
padding: 6px 6px;
margin-top: 3%;
}

@media only screen and (min-width: 600px){
.refresh-session-container{

width: 70%;

}

}
 


.refresh-session-container input[type=password]{

margin: auto;
width: 95%;
padding: 6px 6px;
font-size: 18px;
border: 2px solid #666;
outline: none;
}
.refresh-session-container input[type=submit]{

margin: auto;
width: 70%;
padding: 6px 6px;
font-size: 18px;
border: none;
text-align: center;
background-color: mediumseagreen;
}

.refresh-session-container  p:nth-child(1){
padding: 6px 6px;

background-color: rgba(255,0,0,0.4);
color: red;

}
.refresh-session-container  p:nth-child(2){
color: rgb(0,52,102);
font-size: 20px;
font-weight: bold;

}

.refresh-session-container  p:nth-child(4){
color: red;
font-weight: bold;

}

.refresh-session-container  p:nth-child(5){
color: rgb(0,52,102);
font-weight: bold;

}


.refresh-session-container  p:last-child{

font-weight: bold;

}




.refresh-session-container  a:link{
color: rgb(0,52,102);
text-decoration: none;
font-weight: bold;

}
.refresh-session-container  a:visited{
color: rgb(0,52,102);

}
button{

margin: auto;
width: 70%;
padding: 6px 6px;
font-size: 18px;
border: none;
text-align: center;
background-color: red;
border-radius: 2rem;
color: white;
margin-top: 12px;

}
button a:link{
text-decoration: none;
color: white;

}



</style>






