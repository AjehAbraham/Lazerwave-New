

<?php 
 $is_valid = "";

if ($_SERVER["REQUEST_METHOD"] == "POST"){


     if (isset($_POST["remember-me"]))
     {
      $remeber_me = filter_var($_POST["remember-me"],FILTER_SANITIZE_STRING);

      $remeber_me = htmlspecialchars($remeber_me);
     }else{

      $remeber_me = NULL;

     }

      require_once __DIR__.("/db_connection.php");

     $conn -> real_escape_string($_POST["email"]);

$sql =  "SELECT * FROM Register_db WHERE Email = '$_POST[email]' ";

$result = $conn -> query($sql);

if ($result -> num_rows > 0){
      while($new_user = $result -> fetch_assoc()){
            if($new_user){
                  if (password_verify( htmlspecialchars($_POST["password"]), $new_user["Password"]) == "password_hash"){
                        
             
                 session_start();
                 session_regenerate_id();


                 $_SESSION["New_user"] = $new_user["id"];

                         // set cookie to remember user for 7days/one week

                         // first check if the cookie already exist or has not expire/


                         if (isset($_COOKIE["userId"])){

                           // cookie exist//

                           //check if cookie match 

                           //if(isset($_COOKIE["userId"]) == $_SESSION["New_user"]);



                         }else{
                              //check if remenber me is null or user did not check remember me


                              if(!$remeber_me == NULL){

                              $cookie_name = "check_confirm_real";


                              $cookie_value = rand(9999,99999) * 170;
     
                              // hash th cookie value for safety
     
     
                              setcookie($cookie_name,$cookie_value,time() + 86400 * 7);

                              //set another cookie to save user id to avoid conflit

                              $cookie_two_name ="userId";


                              $cookie_two_vaLue = $_SESSION["New_user"];

                             

                              setcookie($cookie_two_name,$cookie_two_vaLue,time() + 86400 * 7);


            

                              $cookie_value = password_hash($cookie_value,PASSWORD_DEFAULT);

                              $cookie_two_vaLue = password_hash($cookie_two_vaLue,PASSWORD_DEFAULT);
                              


                              require_once __DIR__.("/db_connection.php");

                              //first check if user has created one before

                              $check = "SELECT * FROM Authentication_table WHERE User_id = '$_SESSION[New_user]'";


                              $result = $conn -> query($check);

                              if ($result -> num_rows > 0){
                                    while($user_result = $result -> fetch_assoc()){

                                      

                                          // update if found//

                                          $update_table = "UPDATE Authentication_table SET Hash_key = '$cookie_value'  WHERE User_id = '$_SESSION[New_user]'";


                                          if ($conn -> query($update_table) == TRUE){
                                                //NO NEED TO INFORM USER
                                          }

                                    }
                              }else{
                                    $date = date("Y/m/d h:i:sa");

                                    
                                    $insert_record = "INSERT INTO Authentication_table(User_id,Hash_key,Date_created)
                                    VALUES('$_SESSION[New_user]','$cookie_value','$date')

                                   
                                    ";

                                    if ($conn -> query($insert_record) == TRUE){
                                          // no need to inform the user
                                    }else{
                                          //no need to throw error messsage to user
                                    }
                              }




                              //insert cookie vallues so you can check if it is fake or real





                              }

                         }


                  
                 if(isset($_SESSION["last_page"])){
                  //Log user in but open last visitted page before login

                  header("location:$_SESSION[last_page]");
                  exit;
                 }else{
                  header("location:index.php");
                  exit;
                 }


                  }else{

                    $status_message = "Invalid username or password &#128532;";
require_once __DIR__.("/Failed.php");

                       /* $is_valid = "Invalid username or password &#128532;";*/ 
                  }
            }
      }
}else{
      header("location:Register.php");
      exit;
      
}



}




?>

