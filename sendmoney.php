<?php require_once __DIR__.("/sessionPage.php");


if (!isset($_SESSION["New_user"])){
  header("location:login.php");
  exit;
}
?>






<!DOCTYPE html>
<html lang="eng_US">
  <head>
    <link rel="stylesheet" href="sendmoney.css">
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
<title>sendmoney</title>
      </head>
      <body>
          
          
          <script>
              
if(window.history.replaceState){
     
    window.history.replaceState(null,null,window.location.href);
    
    }


          </script>

  
      <script>
     
     if(window.history.replaceState){
     
     window.history.replaceState(null,null,window.location.href);
     
     }
         </script>



        <?php
        
require_once __DIR__.("/Network.php");
?>
      
        <span class="material-symbols-outlined"style="color: rgb(0,0,180);" onclick="window.history.back()">arrow_back</span>
         
        <a href="index.php"><i class="fa fa-home"style="float:right;font-size:15px;margin-top:1px;color: rgb(0,0,180);"></i>
         </a> 

         
<?php require_once __DIR__.("/logo.php");
?>


         <div class="sendmoney-container">
     
<h1>Send Money</h1>

<p class="message">To Lazerwave only</p>


<?php
//AUTO FILL ACCOUNT NO WITH AUTO BENEFICAIRY//


if ($_SERVER["REQUEST_METHOD"] == "POST"){


$save_beneficiary = "";

if (isset($_POST["saved_beneficiary"])){

$save_beneficiary = (int) filter_var($_POST["saved_beneficiary"],FILTER_VALIDATE_INT);

htmlspecialchars($save_beneficiary);

require_once "db_connection.php";


$acct ="SELECT * FROM  Register_db WHERE Account_no ='$save_beneficiary'";

$acct_result = $conn -> query($acct);


if($acct_result -> num_rows > 0){
    
    
    $results = $acct_result -> fetch_assoc();
    
    
    $isvalid = $results["Surname"]. " ".$results["Last_name"]. " ".$results["First_name"];
    
    
    $isvalid = "<b style='padding: 10px 10px;background-color: rgb(0,0,52);color: white;width: 95%;border-radius: 2rem;'>".$isvalid ."</b>";
    
    
}else{
    
    
    $isvalid ="";
    
    
}




}else{


$save_beneficiary = "";


}


}


?>


<form method="post" id="formId" action="confirm.php" onsubmit="openConfirm(event)">
<label for="Account-number"><b>Account number:</b></label>
<br>
<input type="number" value="<?php echo isset($_POST['saved_beneficiary']) ? $_POST['saved_beneficiary'] : '' ?>" name="account-number" placeholder="Enter Account number..." inputmode="numeric" oninput="check_acct_no(event)" id="Account_no">
<br>
<!--p style="display: none" id="load">...</p-->
<p class="error_message" ><?php echo $isvalid ?></p>

<br>


<label for="number"><b>Amount:</b></label>
<br>

<input type="number" name="amount" placeholder="Enter amount..." inputmode="numeric" oninput="Verify_amount()">
<br>

<p class="amount_error_message"></p>

<label for="remark"><b>Remark optional:</b></label>
<br>

<input type="text" name="remark" placeholder="Remark(e.g fees,rent)...">
<br>
<input type="submit" value="Validate" >

</div>
</form>


         </div>
         
         
         <script>
             function check_acct_no(event){
                 
                // document.getElementById("load").style.display="block";
                 
                 document.querySelector(".error_message").innerHTML ="please wait...";
                 
                 //var strL = 11;
                 var Account_no = document.getElementById("Account_no");
                 
                 
                 //if(Account_no.length  <= 11){
                 //    alert("too short");
                     
                     
                //SEND REQUEST TO BRING ACCOUNT NUMBER DETAILS      
                 
                // alert("seen");
                 
                // event.preventDefault();
                
                var form = $("#formId");
    var url = "Account info.php";
                
                
                
                
                 
                $.ajax ({
      type: "POST",
      url: url,
      data: form.serialize(),
    dataType:'json',
    encode: true,
    success: function(data){
        //form has beeen submitted//
    
        console.log();
    
        
        var error = document.querySelector(".error_message");
    
    error.innerHTML = data.responseText;
    
      alert("Form submitted successfully");
    
      },
      error: function(data){
          
          //document.getElementById("load").style.display="none";
          
          
          //alert("sent");
   
        var error = document.querySelector(".error_message");
    
    error.innerHTML = data.responseText;
    
       
    
    }
    });
               //  }else{
                     
                     
                    // alert("Too //short");
                     
                     
                     
                     
               //  }
                 
                 
                 
                 
             }
             
             
           function Verify_amount()  {
               
               
               document.querySelector(".amount_error_message").innerHTML ="please wait...";
               
               
               
               var form = $("#formId");
    var url = "Amount info.php";
    
    $.ajax ({
      type: "POST",
      url: url,
      data: form.serialize(),
    dataType:'json',
    encode: true,
    success: function(data){
        //form has beeen submitted//
    
        console.log();
    
        
        var error = document.querySelector(".amount_error_message");
    
    error.innerHTML = data.responseText;
    
      //  alert("Form submitted successfully");
    
      },
      error: function(data){
   
        var error = document.querySelector(".amount_error_message");
    
    error.innerHTML = data.responseText;
    
    /*if(data.responseText ===  "undefined"){
        
        alert("Server error");
        
    }*/
    
    
    
       
    
    }
    });
               
               
           }
             
             
             
             
         </script>
         
         <!--p  style="color: red" class="error_message"></p-->

        
      

      </body>
      </html>