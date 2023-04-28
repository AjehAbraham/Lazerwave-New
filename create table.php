<?php
/*
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

  header("Location: Warning.php");
  exit;

      header('HTTP/1.0 403 Forbiddden',TRUE,403);
      die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}
*/
include __DIR__.("/db_connection.php");

$alter ="ALTER TABLE Accept_request
RENAME COLUMN Notfiy_id  to Notify_id";

if($conn -> query($alter) == TRUE){
    
    echo "Table alter";
    
}

/*
$alter ="DROP TABLE Username";


if ($conn -> query($alter) == TRUE){
    
    
    echo "Table deleted";
}


$username ="CREATE TABLE Username(id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,User_id INT(20), Username TEXT,Date TIMESTAMP,Time TIME,ip_addr VARCHAR(35) )";

if ($conn -> query($username) == TRUE){
    echo "usernmae table created
    ";
}else{
    echo "Failed".$conn-> error;
}


/*

$note ="DROP TABLE Notification";

$note ="CREATE TABLE Notification(id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY, User_id INT(132),Amount INT(20),Message TEXT,Receiver_id INT(20),Notify_id VARCHAR(25),Type VARCHAR(50),Date TIMESTAMP, Time TIME,Ip_addr VARCHAR(30))";

if ($conn -> query($note) == TRUE){
    echo "Notification table create";
}else{
    echo "failed to create notification table". $conn -> error;
}

/*
$login_history ="CREATE TABLE Login_history(id INT(123) UNSIGNED AUTO_INCREMENT PRIMARY  KEY,User_id INT(20),Date TIMESTAMP, Time TIME, Ip_addr VARCHAR(35) ) ";
if($conn -> query($login_history) == TRUE){
    echo "Table created";
}else{
    
    echo "error".$conn -> error;
}


/*

$alter ="ALTER TABLE Payment_link_table MODIFY Ip_addr TEXT";
if($conn -> query($alter) == TRUE){
    echo "table alter";
}else{
    echo "failed";
}

/*

$sql = "CREATE TABLE  Register_db(
    
    id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    Surname VARCHAR(255) NOT NULL,
     Last_name VARCHAR(255),
     First_name  VARCHAR(255) NOT NULL,
     Country VARCHAR(255) NOT NULL,
     Email VARCHAR(255) UNIQUE NOT NULL,
     Password VARCHAR(255) ,
     Gender VARCHAR(10) NOT NULL,
     I_agree VARCHAR(8) NOT NULL,
     Account_no INT(10) NOT NULL,
     Account_balance INT(128) NOT NULL,
Date_reg TIMESTAMP,
Time_reg TIME

    )";

    

if ($conn -> query ($sql) == TRUE){
    echo "table created";
}else{
    die("fail");
}


$transac = "CREATE TABLE Transaction_history(
    
    id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,

User_id INT(128) NOT NULL,

Transaction_id VARCHAR(128) NOT NULL,
 Amount INT(128) NOT NULL,
 Type_name VARCHAR(128) NOT NULL,
 Remark  TEXT,
 Status_remark VARCHAR(128),
 Sender_account_no VARCHAR(12),
 Receiver_account_no VARCHAR(12),
 Date_id TIMESTAMP,
 Time_id TIME,
 Ip_addr VARCHAR(30)
 )";


if ($conn -> query($transac) == TRUE){
    echo "Transaction table created ";
}else{
    echo "Failed to create transaction table";
}





$account_balance = "CREATE TABLE Account_balance(
    
    id INT(128) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 User_id INT(20) NOT NULL,
  Amount INT(128) NOT NULL,
  Account_no INT(10) NOT NULL,
  Account_status VARCHAR(25) NOT NULL,
  Last_updated INT(25) NOT NULL
  )";


if ($conn -> query ($account_balance) == TRUE){
    echo "table created";
}else{
    die("fail");
}







$profile_picture = "CREATE TABLE Profile_picture(
    
    id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    User_id INT(20) NOT NULL,
    Image_path VARCHAR(255) NOT NULL,
    Date_id TIMESTAMP,
    Time_id TIME
    
    
    )";



if ($conn -> query ($profile_picture) == TRUE){
    echo "table created";
}else{
    die("fail");
}


$topUp = "CREATE TABLE Top_up(
    
    id INT(128) UNSIGNED AUTO_INCREMENT PRIMARY KEY,

 User_id INT(20) NOT NULL,

 Payment_type VARCHAR(30) NOT NULL,
  Card_no VARCHAR(255) NOT NULL,

Amount INT(128) NOT NULL,
  Status_id VARCHAR(30) NOT NULL,
  Date_id TIMESTAMP NOT NULL,
  Time_id TIME NOT NULL

    
    
    )";
    
if ($conn -> query($topUp) == TRUE){
    echo "table created";
}else{
    die("fail");
}
*/


/*
$User_pin ="CREATE TABLE User_pin(
    
  id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,

  User_id INT(20) UNIQUE NOT NULL,

  Pin VARCHAR(255),

  Date_id TIMESTAMP
    
    )";

    
if ($conn -> query($User_pin) == TRUE){
    
    echo "table created". $conn -> error;
    
}else{
    die("fail");
}



$credit_card = "CREATE TABLE Credit_card(
    
    id INT(128) UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    User_id INT(20) NOT NULL,

    Credit_card_no VARCHAR(255) NOT NULL,
    
    Full_name VARCHAR(255) NOT NULL,

    Ccv VARCHAR(255) NOT NULL,

    Pin VARCHAR(255) NOT NULL,
    
    Exp_date INT(10),

    Status_r VARCHAR(15) NOT NULL,
    Date_created TIMESTAMP,
    Time_id TIME
    
    
    )";
       
if ($conn -> query($credit_card) == TRUE){
    echo "table created";
}else{
    die("fail");
}



$addition_info = "CREATE TABLE Extra_info(
    
    id INT(20)  UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    User_id INT(20) NOT NULL,

    Tel INT(10) NOT NULL,

    State VARCHAR(255) NOT NULL,
    Address TEXT,
    Date TIMESTAMP NOT NULL,
    Ip_addr VARCHAR(40) NOT NULL
    
    )";


       
if ($conn -> query ($addition_info) == TRUE){
    echo "table created";
}else{
    die("fail");
}



$extra_information = "CREATE TABLE More_information(
    id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    User_id INT(20)  NOT NULL,
    DOB DATE NOT NULL,
    State_origin TEXT NOT NULL,
    LGA TEXT NOT NULL,
    Mother_name TEXT NOT NULL,
    Next_kin TEXT NOT NULL,
    Relationship_kin TEXT NOT NULL,
    Occupation TEXT,
 Date_sub TIMESTAMP NOT NULL,
 Ip_add VARCHAR(30) NOT NULL
)";

if ($conn -> query($extra_information) == TRUE){
    echo "extra table cretated";
}else{
    echo "failed to crreate extra";
}


$payment_link_table = "CREATE TABLE Payment_link_table(

    id INT(100) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    User_id INT(20) NOT NULL,
    Amount INT(20) NOT NULL,
    Hash_link VARCHAR(255),
    Date_created  TIMESTAMP NOT NULL,
    Ip_addr INT(20) NOT NULL
)";

if ($conn -> query($payment_link_table) == TRUE){
    echo "Payment link table created .";
}else{
    echo "failed to create payment link table";
}



$block_account = "CREATE TABLE Block_account(
id INT(100) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
User_id INT(20) NOT NULL,
Account_status TEXT NOT NULL,
Date TIMESTAMP NOT NULL,
Ip_addr VARCHAR(30)
)";

if ($conn -> query($block_account) == TRUE){
    echo "Block account table created";
}else{
    echo "Failed to cretae block aaccount table";
}


$block_account_histroy = "CREATE TABLE Block_account_history(
    id INT(100) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    User_id INT(20) NOT NULL,
    Account_status TEXT NOT NULL,
    Date TIMESTAMP NOT NULL,
    Ip_addr VARCHAR(30)
    )";

if ($conn -> query($block_account_histroy) == TRUE){
    echo "block account history table created";
}else{
    echo "failed to cerated block account history table";
}


$create_authentication = "CREATE TABLE Authentication_table (
    
    id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    User_id INT(20) NOT NULL,
    Hash_key VARCHAR(255) NOT NULL,
    Date_created TIMESTAMP
    )
    ";

   if ($conn -> query($create_authentication) == TRUE){
        echo "Authentication table created";

    }else{

        echo "fail to create table";

    }


    $change_password_history = "CREATE TABLE Change_password_history(
        
        id INT(128) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        User_id INT(20),
        Date_id TIMESTAMP,
        Ip_addr VARCHAR(30),
        Device_name VARCHAR(20),
        Time_id TEXT
        
        )";


        if ($conn -> query($change_password_history) == TRUE){

            echo "change password history table created";
        }else{


            echo "failed to create change password table";
        }

       $Change_otp_table = "CREATE TABLE Change_password_otp(

id INT(128) UNSIGNED AUTO_INCREMENT PRIMARY KEY,

User_id INT(20),
Otp INT(6),
Time_id TIME,
Date_id TIMESTAMP
 )";

 if ($conn -> query($Change_otp_table) == TRUE){

    echo "otp table created ";
 }else{
    echo "fail to create opt table";
 }
 $verfiy_ermai = "CREATE TABLE Email_verification(

id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
User_id INT(20),
Status VARCHAR(20),
Date TIMESTAMP,
Time TIME

 )";

 if ($conn -> query($verfiy_ermai ) == TRUE){

    echo "email verification table created";

 }else{

    echo "fail to create email verification table";
 }


 $save_beneficary = "CREATE TABLE Beneficiary(
id INT(128) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
User_id INT(20),
Full_name TEXT,
Acct_no INT(12),
Date_id  TIMESTAMP,
Time_id TIME,
Ip_addr VARCHAR(30)

 )";

 if ($conn -> query($save_beneficary) == TRUE){

echo "Beneficairy table created ";

 }else{
    echo "fail to create beneficiary tale";
 }



/*

$create = "CREATE TABLE Account_limit(

    id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    User_id INT(20),
    Limit_amount INT(123),
    Time_id TIME,
    Date_id TIMESTAMP
)";

if ($conn -> query($create) ==TRUE){

    echo "table created";
}else{

echo "failed to create table";

}*/
