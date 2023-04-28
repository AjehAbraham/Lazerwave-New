<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

  header("Location: Warning.php");
  exit;

      header('HTTP/1.0 403 Forbiddden',TRUE,403);
      die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}





?>


<div class="cookie-container-box-overlay">


 <div class="cookie-container-box">
  
  <br>
  <p>This website use cookies to make your experience better.We use cookies to personalise content and ads to analyse our traffic.Note All your data are safe and are not shared with a third party. <a href="#" target="blank">Policy</a>
  <p>
  
 
  <form method="post" id="cookie_formId">
  
  <input type="text" style="display:none" 
  name="set_cookie" value="Accept">
  <br>
  
  <p style="color: red;" class="cookie_error_message"></p>
  
 
 
  <p class="button" onclick="iAccept()">I Accept</p>
  
  
  </form>
  
  </div>
  
  
  </div>
  <style>
  .cookie-container-box-overlay{
  transition: 0.4s;
  position: fixed;
  width: 100%;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
  z-index: 1;
  }
  
  
  .cookie-container-box{
  background-color: rgb(0,0,52);
  position: absolute;
  top:60%;
  font-size: 18px;
  color: grey;
  bottom: 0;
  left: 0;
  right: 0;
  overflow-y: scroll;
  animation: cookie-box 3s 1 ease-out;

  
  }
  @keyframes cookie-box{
  0%{transform: translate3d(0,100px,0)}
    100%{transform:translate3d(0,0,0)}
}
    
  .cookie-container-box p{
  color:white;
  font-size: 14px;
  text-align:justify;
  margin-top: 10px;
  margin: auto;
  width: 95%;
  }
  .cookie-container-box p:last-child{
  background-color: white;
  text-align:center;
  padding: 10px 10px;
  border-radius: 2rem;
  margin-top: 10px;
  margin-bottom: 3px;
  color: rgb(0,0,52);
  font-size 18px;
  font-weight: bold;
  margin:auto;
  width: 60%;
  }
  .cookie-container-box .hide{
  opacity: 0;
  pointer-events: none;
  transform: scale(0.8);
  transition: all 0.3s ease;
}
  </style>
  
  
  <script>
  
  
  function iAccept(){
  
  
  
  document.querySelector(".cookie-container-box-overlay").style.width="0%";
  
  
  
  var form = $("#cookie_formId");
    var url = "cookie process.php";
    
    $.ajax ({
      type: "POST",
      url: url,
      data: form.serialize(),
    dataType:'json',
    encode: true,
    success: function(data){
        //form has beeen submitted//
    
        console.log();
    
        document.querySelector(".loader-overlay").style.display = "none";
    
       
        var error = document.querySelector(".error_message");
    
    error.innerHTML = data.responseText;
    
     
      },
      error: function(data){
    
        var error = document.querySelector(".cookie_error_message");
    
    error.innerHTML = data.responseText;
    
       
    
    }
    });
  
  
  
  }

</script>