<?php require_once __DIR__.("/sessionPage.php");


/*
if (!isset($_SESSION["New_user"])){
    header("location:login.php");
    exit;
  }
//require_once __DIR__.("/Network.php");*/


if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

  header("Location: Warning.php");
  exit;

      header('HTTP/1.0 403 Forbiddden',TRUE,403);
      die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}



?>


<script>
     
if(window.history.replaceState){

window.history.replaceState(null,null,window.location.href);

}
    </script>


<?php




if ($_SERVER["REQUEST_METHOD"] == "POST"){


require_once "Check block account.php";

require_once "Check daily limit.php";



    $PIN = filter_var($_POST["pin"],FILTER_VALIDATE_INT);

if (empty($PIN)){

  //  $message_status = "Please enter your pin";


//    include __DIR__.("/Failed.php");

$_SESSION["Transaction_status"] = "Failed";

$_SESSION["Transaction_reponse"] = "Please enter your pin";

//header("Location: Transaction status.php");

echo "<script>
window.location.href='Transaction status.php' </script>

";

exit;


    //die();



}else{

    $str = 4;

    if (strlen($PIN) >= $str){             
        include __DIR__.("/db_connection.php");

        //check if transaction pin is valid/match

        $sql = "SELECT * FROM User_pin WHERE User_id = '$_SESSION[New_user]'";

        $result = $conn -> query($sql);

        if ($result -> num_rows > 0){
            while ($pin_result = $result -> fetch_assoc()){

                if (!password_verify($PIN, $pin_result["Pin"]) == "password_hash"){

                   
    $message_status = "Invalid Transaction pin";


    include __DIR__.("/Failed.php");

$_SESSION["Transaction_status"] = "Failed";

$_SESSION["Transaction_reponse"] = "Invalid Transaction pin";

//header("Location: Transaction status.php");

echo "<script>
window.location.href='Transaction status.php' </script>

";


exit;



   // die();
                   
                    
                }

                if (password_verify($PIN, $pin_result["Pin"]) == "password_hash"){

//insert beneficairy into datbase///
//FIRST CHECK IF USER WANT TO SAVE AS BENEFICIARY//
if(isset($_POST["beneficiary"])){

$beneficairy = filter_var($_POST["beneficiary"],FILTER_SANITIZE_STRING);

htmlspecialchars($beneficairy);

if (empty($beneficairy)){


    $save_beneficiary = "";
    //do nothin
}else if ($beneficairy == "save"){


//FIRST IF BENEFICIARY ALREADY EXIST//

$check_bene = "SELECT * FROM Beneficiary WHERE User_id = '$user[id]' AND Acct_no ='$_SESSION[Account_no]' ";

$beneficiary_result = $conn -> query($check_bene);


if ($beneficiary_result -> num_rows > 0){

//DONT SAVE THE USER ELSE SAVE THE USER

echo "<script>alert('Beneficiary Already exist')</script>";


}else{



    //  SAVE THE BENEFICIARY NOW

    $ip_addr = htmlspecialchars( $_SERVER["REMOTE_ADDR"]);
    $date = htmlspecialchars(date("Y-m-d h:i:s"));
    $time = htmlspecialchars(date("h:i:s"));

    $full_name =  $_SESSION["Surname"] . " ". $_SESSION["Last_name"]. " ". $_SESSION["First_name"];


$save_beneficiary = "INSERT INTO Beneficiary(User_id,Full_name,Acct_no,Date_id,Time_id,Ip_addr)
VALUES('$user[id]','$full_name','$_SESSION[Account_no]','$date','$time','$ip_addr')
";





if ($conn -> query($save_beneficiary) == TRUE){
    
    //SEND MESSAGE OR ALERT USER//

echo "<script>alert('Beneficiary saved')</script>";


}else{

    //ERRO HAS OCCUR//

   echo "<script>alert('Failed to save Beneficiary')</script>";
   
}




}

}

}





                    if ($user["Account_balance"] >= $_SESSION["AMOUNT"]){
             //check if account balance is sufficient//

           //  $_SESSION['AMOUNT'];
           include __DIR__.("/db_connection.php");

             $sender_account_balance = $user["Account_balance"] -   $_SESSION['AMOUNT']; 
             
       
//reciever account balance 

//check for user account balacne


$check_receiver_bal = "SELECT * FROM Register_db WHERE Account_no ='$_SESSION[Account_no]' ";

$accout_balance = $conn -> query($check_receiver_bal);

if ($accout_balance  -> num_rows > 0){
    while ($receiver_balance = $accout_balance -> fetch_assoc()){
        //save reciever account balance and name to print out for receipt
        $_SESSION["Receiver_balance"] = $receiver_balance["Account_balance"];

        $_SESSION["receiver_id"] = $receiver_balance["id"];
        
        $_SESSION["Email"] = $receiver_balance["Email"];
        
        $_SESSION["Surname"] =$receiver_balance["Surname"];

    }
}



$reciever_account_balance =   $_SESSION["Receiver_balance"] +   $_SESSION["AMOUNT"];


// update sender account balance
             
$update = "UPDATE Register_db  SET Account_balance ='$sender_account_balance' WHERE id ='$_SESSION[New_user]' ";


if ($conn -> query($update) == TRUE){
   // echo "sent successfully";


   //FIRST FETCH ACCOUNT LIMIT//


   $tf_limit = "SELECT * FROM Account_limit WHERE User_id ='$_SESSION[New_user]'";


$tf_limit_result = $conn -> query($tf_limit) -> fetch_assoc();

$limit = $tf_limit_result["Limit_amount"] + $_SESSION['AMOUNT'];




//NOW UPDATE USER ACCOUNT LIMIT 


$account_limit_update = "UPDATE Account_limit SET Limit_amount ='$limit' WHERE User_id='$_SESSION[New_user]'";


if ($conn -> query($account_limit_update) == TRUE){


//LIMIT HAS BEEN UPDATED//

//$message_status = "Limit updated";

//require_once __DIR__.("/success.php");







   // update reciever account balance
 $update_receiver = "UPDATE Register_db SET Account_balance
   ='$reciever_account_balance' WHERE Account_no ='$_SESSION[Account_no]'";



if ($conn -> query( $update_receiver) == TRUE){
    //echo "sent to receiver";

// insert into transaction history//

$ip_addr = $_SERVER["REMOTE_ADDR"];

$remark = "- Debit";

$from = $user["Account_no"];
$to = $_SESSION['Account_no'];

$transaction_id = uniqid() .rand();

$status= "Successful";

$date = date("Y-m-d H:i:s");

$time = date("H:i:s");

$type = "Transfer to ". $_SESSION["Surname"] ." ". $_SESSION["First_name"]. " Remark-". $_SESSION["remark"];


$typee = "Transfer";

$bank ="Lazerwave";


$update_account_history = "INSERT INTO Transaction_history(User_id,Transaction_id,Amount,Type_name,Remark,Status_remark,Sender_account_no,Receiver_account_no,Date_id,Time_id
,Ip_addr,Type,Bank

)
VALUES('$_SESSION[New_user]','$transaction_id','$_SESSION[AMOUNT]','$type','$remark','$status','$from','$to','$date','$time','$ip_addr','$typee','$bank')


";

if ($conn -> query($update_account_history) == TRUE){
    
    $Type="Transfer";

$message = $remark ." ". $type;

$amount = $_SESSION["AMOUNT"];

$receiever_id = 0;

require "Add notification.php";

    

   // echo "updated";
   //save to database with reciever id so that reciever can also have/see same tranction history
 
$remark = "+ Credit";

   $type = "+ CREDIT from " .$user['Surname'] . " ". $user['First_name']."  Remark ".$_SESSION["remark"];
   
   $status = "Successful";


    $update_receiver_history = "INSERT INTO Transaction_history(User_id,Transaction_id,Amount,Type_name,Remark,Status_remark,Sender_account_no,Receiver_account_no,Date_id,Time_id,
    Ip_addr,Type,Bank
    )
    VALUES('$_SESSION[receiver_id]','$transaction_id','$_SESSION[AMOUNT]','$type','$remark','$status','$from','$to','$date','$time','$ip_addr','$typee','$bank')
    
    
    ";

    if ($conn -> query ($update_receiver_history) == TRUE){
       /* echo "alert seen";*/
       
//SEND USER EMAIL FOR CREDIT AND DEBIT ALERT//

require_once __DIR__.("/Debit alert.php");

require_once __DIR__.("/credit alert.php");

$Type="Transfer";

$message =  $type;

$amount = $_SESSION["AMOUNT"];

$receiever_id = 0;

$_SESSION["New_user"] = $_SESSION["receiver_id"];


require "Add notification.php";

$_SESSION["Transaction_status"] = "Success";

$_SESSION["Transaction_reponse"] = "Success";

//header("Location: Transaction status.php");

echo "<script>
window.location.href='Transaction status.php' </script>

";


exit;



//END OF CREDIT AND DEBIT ALERT//


}
       
       
       
       
       
    }

}



}
}///

$_SESSION["Transaction_id"] = $transaction_id ;


$_SESSION["Type_remark"] = $type;


require_once __DIR__.("/Receipt.php");

}else{

                   
 //   $message_status = "insufficient fund";


   // include __DIR__.("/Failed.php");


  //  die();




    $ip_addr = $_SERVER["REMOTE_ADDR"];

    $remark = "Pending";
    $transaction_id = "TRXD".rand(999,9999);

    $status= "Failed";
    
    $date = date("Y-m-d H:i:s");
    
    $time = date("H:i:s");
    
    $type = "Transfer";
    
    
    
    $update_account_history = "INSERT INTO Transaction_history(User_id,Transaction_id,Amount,Type_name,Remark,Status_remark,Sender_account_no,Receiver_account_no,Date_id,Time_id,
    Ip_addr,Type,Bank
    
    )
    VALUES('$_SESSION[New_user]','$transaction_id','$_SESSION[AMOUNT]','$type','$remark','$status','$from','$to','$date','$time','$ip_addr','$typee','$bank')
    
    
    ";
    
    if ($conn -> query($update_account_history) == TRUE){

      //  header("location:dashboard.php");
        exit;
    
      /*  echo "updated";
    
    
    echo "Failed";}*/}
    
    
    
  //  require_once __DIR__.("/Debit alert.php");
    
    $_SESSION["Transaction_status"] = "Failed";

$_SESSION["Transaction_reponse"] = "Insufficient funds";

//header("Location: Transaction status.php");
echo "<script>
window.location.href='Transaction status.php' </script>

";



exit;
    
    
    
    
    
}







}
            }
        }else{
            //  ERROR IF NO PIN FOUNF; 
            
                           
   // $message_status = "Please create a transaction pin";


   // include __DIR__.("/Failed.php");


  //  die();
  $_SESSION["Transaction_status"] = "Failed";

$_SESSION["Transaction_reponse"] = "Please create  your pin";

header("Location: Transaction status.php");

exit;
  
  


        }
    }
}
}else{
    header("location:sendmoney.php");
    exit;
}

?>




