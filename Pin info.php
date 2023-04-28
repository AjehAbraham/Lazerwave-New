<?php
require_once __DIR__.("/sessionPage.php");


if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

  header("Location: Warning.php");
  exit;

      header('HTTP/1.0 403 Forbiddden',TRUE,403);
      die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}


if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    if(isset($_POST["pin"])){
        
        
    $pin = (int) filter_var($_POST["pin"],FILTER_VALIDATE_INT);
    
    if(empty($pin)){
        
        die("<b style='color: red;'>Please enter pin</b>");
        
    }
    
    
    
    
        
        if(strlen($pin) <= 3){
            
            
            die("<b style='color: red'>Pin too short</b>");
            
            
            
        }else if(strlen($pin) == 4){
            
            require_once "db_connection.php";
            
            
            
            $check = "SELECT * FROM User_pin WHERE User_id ='$_SESSION[New_user]'";
            
            
            
            $pin_result = $conn -> query($check);
            
            
            if($pin_result -> num_rows > 0){
                
                
                $results = $pin_result -> fetch_assoc();
                
                
                
                if(password_verify($pin,$results["Pin"]) == "password_hash"){
                    
                    //header("Location: index.php");
                   // exit;
                    
                    //die("<b style='color: mediumseagreen'>Valid</b>");
                    
                    
                    
                    
                }else{
                    
                    
                    die("<b style='color: red;'>Invalid pin</b>");
                    
                    
                }
                
                
                
                
                
                
                
            }else{
                
                die("<b style='color: red'>No pin found,please create pin</b>");
                
                
                
            }
            
            
            
            
            
        }else{
            
            
            if(strlen($pin) >= 5){
                
                
                die("<b style='color: red;'>Pin too long</b>");
                
                
            }
            
            
            
            
        }
        
        
        
        
        
        
        
    }else{
        
        echo "<b style='color: red;'>Server error</b>";
        
        
        
        
    }
    
    
    
    
    
    
    
    
}








?>