<?php
    
    
    if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

  header("Location: Warning.php");
  exit;

      header('HTTP/1.0 403 Forbiddden',TRUE,403);
      die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}

?>
    
    
    <div class="Profile-picture_container-fluid" onclick="close_picture()">
    
    <div class="picture"><img src="<?php echo   $_SESSION["Profile_picture"] ?>"></div>
    
    
    
    </div>
    
    
    
    <script>
    
    function open_picture(){
    
    document.querySelector(".Profile-picture_container-fluid").style.display="block";
    
    
    }
    
    
    
    function close_picture(){
    
    document.querySelector(".Profile-picture_container-fluid").style.display="none";
    
    
    }
    
    </script>
    
    
    
    <style>
    .Profile-picture_container-fluid{
    
    background-color: black;
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    display: none;
    }
    .picture{
    
    border: 2px solid white;
    border-radius: 50%;
    width: 300px;
    height: 300px;
    margin: auto;
 
 
    
    }
    .picture img{
    border-radius: 50%;
    width: 300px;
    height: 300px;
    
    }
    
    </style>
    
    
    
 