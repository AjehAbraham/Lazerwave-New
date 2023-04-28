<?php
require_once "sessionPage.php";




if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

  header("Location: Warning.php");
  exit;

      header('HTTP/1.0 403 Forbiddden',TRUE,403);
      die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    
    
    if(isset($_POST["amount"])){
        
        
        $amount = (int) filter_var($_POST["amount"],FILTER_VALIDATE_INT);
        
        $amount = htmlspecialchars($amount);
        
        if(empty($amount)){
            
            die("<b style='color: red;'>Please enter an amount</b>");
            
            
        }else{
            
            
            if($amount <= 49){
                
                
                die("<b style='color: red;'>Amount cannot be less than ₦50</b>");
                
                
                
            }else if($amount > $user["Account_balance"])
    {
                
                
                die("<b style='color: red;'>Insufficient funds</b>");
                
                
                
                
            }else{
                
                
                
                //CHECK KYC//
                
                
                $kyc = "SELECT * FROM More_information WHERE User_id ='$_SESSION[New_user]'";
                
                $kyc_result = $conn -> query($kyc);
                
                if($kyc_result -> num_rows > 0){
                    
                    //NOW CHECK IF USER HAS EXCEEDED DAILY LIMIT//
                    
                    $limit ="SELECT *  FROM Account_limit WHERE User_id='$_SESSION[New_user]'";
                    
                    $limit_result = $conn -> query($limit) -> fetch_assoc();
                    
                    $str = 50000;
                    
                    if($limit_result["Limit_amount"] > $str)
                    {
                        die("<b style='color: red;'>Daily limit exceeded,try again in 12hours</b>");
                        
                        
                    }
                    
                    
                    
                    
                    
                    if($amount > 50000){
                        
                        die("<b style='color: red;'>Your Daily limit is ₦50,000</b>");
                        
                        
                    }
                    
                    
                    die("<b style='color: white;padding: 10px 10px;border-radius: 2rem;background-color: rgb(0,0,52);width: 70%;'>₦". number_format($amount) .".00");
                    
                    
                    
                    
                }else{
                    
                    $limit ="SELECT *  FROM Account_limit WHERE User_id='$_SESSION[New_user]'";
                    
                    $limit_result = $conn -> query($limit) -> fetch_assoc();
                    
                    $str = 10000;
                    
                    if($limit_result["Limit_amount"] >= $str){
                        
                        
                        die("<b style='color: red;'>Daily limit exceeded,please upgrade to kyc2</b>");
                    }
                    
                    
                    
                    
                    
                    if($amount > 10000){
                        
                        die("<b style='color: red;'>Your Daily limit is ₦10,000,please upgrade to kyc2.<b>");
                        
                        
                    }
                    
                    
                    
                }
                
                
                
                
                
                die("<b style='color: white;padding: 10px 10px;border-radius: 2rem;background-color: rgb(0,0,52);width: 70%;'>₦". number_format($amount) .".00");
            }
            
            
            
            
            
        }
        
        
        
        
        
    }else{
        
        
        echo "Server error";
        
        
    }
    
    
    
    
    
}





?>
