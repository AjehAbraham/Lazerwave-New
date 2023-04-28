<?php 
require_once __DIR__.("/sessionPage.php");


if (!isset($_SESSION["New_user"])){
    header("location:login.php");
    exit;
}


//require_once __DIR__.("/Network.php");


// check if user has fill form so we can show previous data

$check_found  = "SELECT * FROM Extra_info WHERE User_id = '$_SESSION[New_user]'";

$check_result = $conn -> query($check_found) -> fetch_assoc();



if (isset($check_result["Tel"])){

$Tel = $check_result["Tel"];

}else{

    $Tel = "";
}




if (isset($check_result["Address"])){

    $address= $check_result["Address"];
    
    }else{
    
        $address = "";
    }
    



    if (isset($check_result["State"])){

        $state = $check_result["State"];
        
        }else{
        
            $state = "";
        }
        


//var_dump($check_if_found_result);

?>


<!DOCTYPE html>
<html lang="eng_US">
  <head>
    <link rel="stylesheet" href="EditProfile.css">
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
<title>Edit profile</title>



<!-- ajax and jquery link -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<script src= "https://code.jquery.com/jquery-3.5.0.js"></script>

<!-- end of ajax link -->


      </head>
      <body>
        
<script>
     
     if(window.history.replaceState){
     
     window.history.replaceState(null,null,window.location.href);
     
     }
         </script>

         <span class="material-symbols-outlined" onclick="window.history.back(-3)">arrow_back</span>
         
         <a href="index.php"><i class="fa fa-home"style="float:right;font-size:15px;margin-top:1px"></i>
          </a> 
   
<?php 
require_once "Network.php";

//require_once __DIR__.("/logo.php"); ?>



<div class="edit-profile-container">


    <form method="post" id="FormId">
<h1>Edit profile</h1>

        <label for="phone-number"><b>Phone number:</b></label>
        <br>
        <input type="tel" name="phone-number" value="<?php echo $Tel ?>"inputmode="numeric">
    
        <br>
    
        <label for="amount"><b>Address:</b></label>
        <br>
        <input type="text" name="address"  value="<?php   echo $address; ?>">
        <br>


        <label for="State"><b>State:</b></label>
        <br>
        <input type="text"  name="state"  value="<?php echo $state;?>">
        <br>

        <p class="error_message"></p>

        <div class="loader-overlay">
    <div class="loader-message">
    </div>
    </div>


<input type="submit" id="submitButton" value="Save change">
</form>
</div>


    <script src="Editprofile.js"></script>

</body>
</html>