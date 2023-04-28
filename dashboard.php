<?php 

if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

  header("Location: Warning.php");
  exit;

      header('HTTP/1.0 403 Forbiddden',TRUE,403);
      die("<h3> 403 Access denied!The file you request for does not exist.</h3>");

}
/*

if($_SERVER["REQUEST_METHOD"] == "GET"){
    /*header("Location: index.php");
    exit;
}else{
    header("Location: index.php");
    exit;
}*/

//require_once __DIR__.("/sessionPage.php");
/*

if (!isset($_SESSION["New_user"])){
    header("location:login.php");
    exit;
}*/

include __DIR__.("/db_connection.php");

$select_dp = "SELECT * FROM Profile_picture WHERE User_id ='$_SESSION[New_user]' ORDER BY id DESC LIMIT 1 ";

$result = $conn -> query($select_dp);

if($result -> num_rows > 0){
    while($profile_picture = $result -> fetch_assoc()){

        $image = $profile_picture["Image_path"];
   
        $_SESSION["Profile_picture"] = "Uploads/".$image;

   
    }
}else{

    $_SESSION["Profile_picture"] = "Uploads" ."\\" ."null-profile.jpeg";
    
}



require_once __DIR__.("/Network.php");

?>




<!DOCTYPE html>
<html lang="eng_US">
  <head>
    <link rel="stylesheet"href="dashboard.css" >
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

<!--js  PDF LIBRARY -->
<script src="https://js/jsPDF/dist/jspdf.umd.js"></script>
<title>Dashboard</title>
      </head>
      <body>


<?php require_once "View picture.php";



?>
  <div class="dashboard-container">

<!--span class="material-symbols-outlined"onclick="window.history.back()">arrow_back</span>
<!--i class="fa fa-moon-o"></i-->


<?php 
//show greeting

$date = date("H");

if ($date < 12){
  $greet = "Good Morning";

}else if ($date > 12){
$greet = "Good Afternoon";

if ($date > 15){
  $greet = "Good Evening";
}


}


?>

<span class="nott" style="color: white;font-size: 12px"><?php


$ss="unseen";
require_once "db_connection.php";

$fetch_not ="SELECT * FROM Notification WHERE User_id ='$_SESSION[New_user]' AND Status ='$ss'";

$fetch_not_result = $conn -> query($fetch_not);

if($fetch_not_result -> num_rows > 0)
{
    
    $total_not = mysqli_num_rows($fetch_not_result);
    echo $total_not;
    
 /*   while($not_total_result =$fetch_not_result -> fetch_assoc()){
    
    var_dump($fetch_not_result);
    
   // mysql_num_rows($not_total_result);
    
   // echo $not_total_result;
    
    }*/
    
    
}else{
    
    echo "0";
    
    
}


?>

</span>

<style>
.Dark-mode .dashboard-container i{
    
    color: white;
}
.Dark-mode .dashboard-container img{
    border: 3px solid white;
}
    .nott{
        
        border-radius: 50%;
        width: 20px;
        height: 20px;
        background-color: red;
        color: white;
        float: right;
        font-size: 12px;
        text-align: center;
        margin-right: -5px;
    }
    .Dark-mode .quick{
        color: white;
    }
</style>
<i class="fa fa-bell" onclick="open_notification()"></i>
<img src="<?php echo  $_SESSION['Profile_picture']?>"width="120px" onclick="open_picture()"> 
<p>Hi <?php echo $user["Surname"] . ",". "<br>". $greet; ?>.</p>

        </div>
        
        
        <?php
        // require_once "Flag.php";
        
       // require_once __DIR__.("/New notification.php");
        
        
        ?>
        <!--i class="fa fa-eye-slash" id="hide-balance"></i-->

    

<style>


   .dashboard-menu-container{
        
        background-color: rgb(0,0,56);
    }
    .dashboard-container i{
        color: rgb(0,0,56);
        font-size: 28px;
    }
    </style>
    
    
    
    <p  class="ball" style="display:none"><i class='fa fa-asterisk' ></i>   <i class='fa fa-asterisk'></i> <i class='fa fa-asterisk'></i> <i class='fa fa-asterisk' ></i></p>
    
    
    <p class="hide_ball" style="display: none"> <?php echo 
    
   '₦' .number_format(  $user["Account_balance"]) .".00"; ?></p>
    
    
    
    <script>
        function Hide_bal(){
            
            
            var bal= document.querySelector(".ball").innerHTML;
            
            
            var bal_r =            
            document.querySelector(".Account-balance-p").innerHTML = bal;
            
    document.querySelector(".close-btn").innerHTML ="<i class='fa fa-eye-slash' onclick= 'hide_acct_bal()'></i>";
            
            
        }
        
        
        function hide_acct_bal(){
            
         var new_bal= document.querySelector(".hide_ball").innerHTML;
            
            
            document.querySelector(".Account-balance-p").innerHTML = new_bal;
            
            document.querySelector(".close-btn").innerHTML ="<i class='fa fa-eye' onclick='Hide_bal()'></i>";
            
        }
        
        
    </script>
        <div class="dashboard-menu-container">

            <p>Total balance 
           <b class="close-btn"> <i class="fa fa-eye" onclick="Hide_bal()" ></i></b></p>
            
<div class="account-balance">
<p style="font-size:25px;"class="Account-balance-p" >
<?php 
 echo '₦' .number_format ($user["Account_balance"]). ".00" ?>

<p class="replace-balance">
<?php   $user["Account_balance"] ;?></p>

<h3  style="font-size: 15px;font-weight: lighter" class="hide-account-balance">
    Cashback <b style="float:right">
         ₦0.00
    </b>
    
    
<!--i class="fa fa-asterisk">  </i>
                <i class="fa fa-asterisk"></i>
                <i class="fa fa-asterisk"></i-->
</h3>

                

<h5 style="margin:0; float:right;padding-bottom: 20px"><a href="New Transaction">Transaction history</a></h5>

</div>

</div>







<div class="options-container">
<div class="Send-cash">
<a href="saved beneficiary.php">
<i class="fa fa-send"></i>
Send money</a>
</div>

<div class="Top-up">
<a href="Receive money.php">
<i class="fa fa-plus"></i>
Add money
</a>
</div>

</div>

<?php require_once "Livechat.php";
?>





        <p class="quick" style="margin-left: 10px;color:rgb(0,0,180);font-size:30px;">Quick actions</p>

<div class="flex">
   
<div class="quick-actions-container">
<a href="Airtime.php"><p>Airtime</p>
<i class="fa fa-phone-square"></i></a>
</div>
<div class="quick-actions-container">
  <a href="Data.php">
<p>Data</p>
<i class="fa fa-rss"></i></a>

</div>
<div class="quick-actions-container">
        <p>Electricity</p>
<i class="fa fa-flash"></i>
</div>
<div class="quick-actions-container">
<p>Tv</p>
<i class="fa fa-television"></i>
</div>


</div>


<div class="flex">
        <div class="quick-actions-container">
        <p>Internet</p>
        <i class="fa fa-wifi"></i>
        </div>
        <div class="quick-actions-container">
        <p>Shop</p>
        <i class="fa  fa-cart-plus"></i>
        </div>
        <div class="quick-actions-container">
        <p>Betting</p>
        <i class="fa fa-soccer-ball-o"></i>
        </div>
        <div class="quick-actions-container">
                <p>Fees</p>
                <i class="fa fa-university"></i>
        
        </div>
        
        </div>
        
        
    
      
        
        <?php 
        
        require_once "New notification.php";
        
        
        if(isset($user)): 

    
    require_once __DIR__.("/Livechat.php"); 
    
  endif;?>
    
        
        
<script>
    function Checkmode(){

var current_mode = localStorage.getItem("Theme");

if(current_mode == "Dark-mode"){


var dark = document.body;

dark.classList.add("Dark-mode");


document.querySelector("#theme").checked= true;


}else{

var dark = document.body;

dark.classList.add("Light-mode");

document.querySelector("#theme").checked= false;




}


}

var mode = Checkmode();

</script>


<script src="dashboard.js"></script>

        </body>
        </html>