<?php //require_once __DIR__.("/sessionPage.php");

//if (!isset($_SESSION["New_user"])){
  //  header("location: Login.php");
   // exit;
 // }

//require_once __DIR__.("/Network.php");

if ($_SERVER["REQUEST_METHOD"] == "GET"){
    header("Location:index");
    exit;
}


require_once "sessionPage.php";

?>



<!DOCTYPE html>
<html lang="eng_US">
  <head>
    <link rel="stylesheet" href="">
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width,initial-scale=1.0">
          <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
         
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.debug.js"></script>
<link rel="preconnect" href="https://fonts.googleapis.com"> 
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
<link href="https://fonts.googleapis.com/css2?family=Encode+Sans:wght@300&family=Island+Moments&family=Oswald:wght@200&family=PT+Serif:wght@700&family=Roboto+Mono:wght@100&display=swap" rel="stylesheet">


<script src="https://kit.fontawesome.com/958aace4f6.js" crossorigin="anonymous"></script>
<title>Confirm payment</title>
      </head>
      <body>
        
<script>
     
     if(window.history.replaceState){
     
     window.history.replaceState(null,null,window.location.href);
     
     }
         </script>
   
        <!--span class="material-symbols-outlined" onclick="window.history.back()">arrow_back</span>
         
        <a href="index.php"><i class="fa fa-home"style="float:right;font-size:20px;margin-top:1px"></i>
         </a-->


         <?php 
        // require_once __DIR__.("/logo.php");
         
         require_once "Network.php";
?>      

<?php 

//INCLUDE LOADER FOR 1S

require_once __DIR__.("/Loader.php");



if ($_SERVER["REQUEST_METHOD"] == "POST"){

   

$acccount_no = filter_var($_POST["account-number"],FILTER_VALIDATE_INT);

$amount = filter_var($_POST["amount"],FILTER_VALIDATE_INT);



if (empty($acccount_no)){

    $message_status = "Please enter account number";


    include __DIR__.("/Failed.php");


    die();
}

if (empty($amount)){

    $message_status = "Please enter amount";


    include __DIR__.("/Failed.php");


    die();



}else{
    
    require_once __DIR__.("/db_connection.php");

    $sql = "SELECT * FROM Register_db WHERE Account_no = '$acccount_no'";


    $result = $conn -> query($sql);

if ($result -> num_rows > 0){
    while ($result_acct = $result -> fetch_assoc()){

        if ($amount < 50){

            $message_status = "Amount cannot be less than ₦50 &#128532";


            include __DIR__.("/Failed.php");
        
        
            die();



        }

        //FIRST CHECK IF USER HAS UPDGRADED TO KYC 2//


       $select_kyc2 = "SELECT * FROM More_information WHERE User_id='$_SESSION[New_user]'";
       
       
       $kyc3_result = $conn -> query($select_kyc2);


       if ($kyc3_result -> num_rows > 0){


//MEANS THE USER HAS UPGRADED TO KYC2 SO THEY HAVE NOT LIMIT



$limit_check = "SELECT * FROM Account_limit WHERE User_id ='$_SESSION[New_user]'";

$limit_result = $conn -> query($limit_check) -> fetch_assoc();


$limit =50000;

$kyc2_amount = htmlspecialchars($_POST["amount"]) + $limit_result["Limit_amount"];

//NOW CHECK IF LIMIT IS MORE THAN 50K//

if ($kyc2_amount > $limit){
    
   

    $message_status = "Daily limit exceeded &#128532.Your limit is ₦50,000 daily,please upgrade to kyc3 ";


    include __DIR__.("/Failed.php");


    die(); 
    
    
    
    
}







       }else{

//RETRCIT THE USER FROM CARRYING OUT TRANSACTION MORE THAN 20,000 DAILY


//NOW CHECK IF USER HAS EXCEED THER ACCOUNT LIMIT//


$limti_check = "SELECT * FROM Account_limit WHERE User_id ='$_SESSION[New_user]'";


$limit_result = $conn -> query($limti_check);


if ($limit_result -> num_rows > 0){


    $check_limit = $limit_result -> fetch_assoc();



    $limit_1 = 10000;

    $limit_2 = (int) filter_var($_POST["amount"],FILTER_VALIDATE_INT);


    htmlspecialchars($limit_2);

//NOW CHECK IF USER HAS EXCCEEDED THE DAILY LIMIT//
if ($check_limit["Limit_amount"] > $limit_1){



    $message_status = "Daily limit exceeded &#128532.Your limit is ₦10,000 daily,please upgrade to kyc2 ";


    include __DIR__.("/Failed.php");


    die();




}else{



    //CEHCK IF THE AMOUNT WHEN SUM UP WITH THE PREVOIUS LIMIT WILL BE MORE THAN 20,000


$limit_3 = $limit_2 + $check_limit["Limit_amount"];


    if ($limit_3 > $limit_1){

//DAILY LIMIT HAS BEEN EXCEEDED//

$message_status = "Daily limit exceeded &#128532.Your limit is ₦10,000 daily,please upgrade to kyc2 ";


include __DIR__.("/Failed.php");


die();



    }




}



}




       }



        $_SESSION["Account_no"] = $result_acct["Account_no"];

        $_SESSION["Surname"] =   $result_acct["Surname"];

        $_SESSION["First_name"] =   $result_acct["First_name"];
        $_SESSION["Last_name"] = $result_acct["Last_name"];


       $_SESSION["Account_balance"] = $result_acct["Account_balance"] - $amount;

       $_SESSION["Account_balance"];

$_SESSION["AMOUNT"] = $amount;


$_SESSION["New_bal"] = $user["Account_balance"] - $_SESSION["AMOUNT"];

$_SESSION["remark"] = htmlspecialchars($_POST["remark"]);


substr($_SESSION["remark"],0,12);

    }

}else{


    $message_status = "Invalid account number &#128532";


    include __DIR__.("/Failed.php");


    die();


   
}





}

//CHECK IF USER ACCOUNT BALANCE IS SUFFICEINT

if ($amount > $user["Account_balance"]){



    $message_status = "Insufficient balance";


    include __DIR__.("/Failed.php");


    die();




}







}else{
    header("location: index.php");
    exit;
}

?>

 <div class="confirm-payment-container">
  
  <br>
  <br>
  
  <p><i class="fa fa-check-circle"></i> Confirm Payment</p>
  
  
   <p>Recipient <b style="float:right;"><?php echo $_SESSION["Surname"] . " ". $_SESSION["Last_name"]. " ". $_SESSION["First_name"];?></b></p>
  
  
  
  
  
  <p>Amount <b style="float:right;"><?php echo "₦".number_format($_SESSION["AMOUNT"]);?></b></p>
  
  
   <p>Charge <b style="float:right;">₦0.00</b></p>
   
    <p>Tax <b style="float:right;">₦0.00</b></p>
  
  
  <p>Remark <b style="float: right;"><?php echo $_SESSION["remark"] ?></b></p>
  
  
  <p>Cashback <b style="float:right">₦0.00</b></p>
  
   <p>Avaliable balance <b style="float:right;"><?php echo "₦".number_format($user["Account_balance"]);?></b></p>
  
   
   <p>New balance <b style="float:right;"><?php echo "₦". number_format ($_SESSION["New_bal"]);?></b></p>
  
  
  <p>Please validate the details properly as transfer are Irreversible.</p>
  
  
  <form method ='post' action="checkout.php" id="formId">
  
  <label class="switch">
  <input type="checkbox" name="beneficiary" value="save">
  <span class="slider round"></span>
</label>


    <p style="font-size: 18px
    ">Save Beneficiary
  </p>





<p  class="opentBtn" onclick="openPin(event)">Validate</p>

<p class="Cancel"><a href="index">Cancel</a></p>

</div>
<?php include __DIR__.("/EnterPin.php"); ?>

  
  
  <style>
  
  body{
    
    margin: 0;
    font-size: 15px;

    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    
    font-weight: lighter;
    background-color: #f1f1f1;
    
   
    
}
  
  .confirm-payment-container{
  margin: auto;
  width: 90%;
  background-color: ;
  color: rgb(0,0,100);
  
  }
  @media only screen and (min-width: 600px){
.confirm-payment-container{
width: 70%;


}
}
  
  .confirm-payment-container p:nth-child(3){
  
  text-align: center;
  font-size: 25px;
  color: white;
  background-color: rgb(0,0,52);
  padding: 6px 6px;
 
  border-radius: 2rem;
  
  }
  .confirm-payment-container b{
  color: grey;
  }
  
   .confirm-payment-container p:nth-child(12){
  color: red;
  font-size: 13px;
  }
  
  .opentBtn{
  
  background-color: mediumseagreen;
  text-align: center;
  margin: auto;
  width: 72%;
  color: white;
  padding: 7px 7px;
  font-size: 20px;
  border-radius: 2rem;
  margin-top: 33px;
  
  }
  .Cancel{
  background-color: red;
  text-align: center;
  margin: auto;
  width: 72%;
  color: white;
  padding: 7px 7px;
  font-size: 20px;
  border-radius: 2rem;
  margin-top: 33px;
  
  }
  .Cancel a:link{
  color: white;
  text-decoration: none;
  }
  .Cancel a:visited{
  color: white;
  }
  input[type=submit]{
      padding: 10px 10px;
      font-size: 23px;
      color: white;
      text-align: center;
      background-color: rgb(0,0,52);
      width: 70%;
      border-radius: 2rem;
  }
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
  float: right;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}
input:checked + .slider {
  background-color: rgb(0,0,56);
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
.dark-mode{
background-color:black;
color:white;
}
</style>


  
  
  
  
  
  </div>
           






           </body>
           </html>