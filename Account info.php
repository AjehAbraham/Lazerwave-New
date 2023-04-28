<?php


require_once "sessionPage.php";


if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

  header("Location: Warning.php");
  exit;

      header('HTTP/1.0 403 Forbiddden',TRUE,403);
      die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
      
}


if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    if(isset($_POST["account-number"])){
        
        $account = htmlspecialchars($_POST["account-number"]);
        
        if(empty($account)){
            
            
            die("<b style='color: red;'>Please enter account number</b>");
            
            
        }else if (strlen($account) <= 8 ){
            
            die("<b style='color: red;'>Account number too short</b>");
            
          /*  if(strlen($account) >= 11){
                
                die("<b style='color: red;'>Account number too long</b>");
                
            }*/
            
            
            
        }else{
            
            if(strlen($account) >= 11){
                
                die("<b style='color: red;'>Account number too long</b>");
                
                
            }
            
            
            
            
            
            require_once "db_connection.php";
            
            $check = "SELECT * FROM Register_db WHERE Account_no ='$account'";
            
            
            $result = $conn -> query($check);
            
            
            if($result -> num_rows > 0)
            {
                
                $results = $result -> fetch_assoc();
                
                //CHECK IF THE ACCOUNT NUMBER IS USER OWN//
                
                if($results["id"] == $_SESSION["New_user"]){
                    
                    
                    die("<b style='color: red;'>Your account number is ".$account. "</b>");
                    
                    
                }
                
                
                
                $full_name = $results["Surname"]
                ." ". $results["Last_name"]. " ".$results["First_name"];
                
                
                echo "<b style='padding: 10px 10px;background-color: rgba(0,0,52);color: white;border-radius: 2rem;width: 95%'>" .$full_name ."<b>";
                
              //  echo $full_name;
                
                
                
            }else{
                
                
                die("<b style='color: red'>Invalid account number</b>");
                
                
            }
            
            
            
        }
        
        
        
    /*else if(isset($_POST["amount"])){
        
        
        $amount = (int) filter_var($_POST["amount"],VALIDATE_INT);
        
        if(empty($amount)){
            
            die("<b style='color: red;'>Amount cannot be empty</b>");
            
            
            
        }else{
            
            
        if($amount <= 49){
            
            
            
            die("<b style='color: red;'>Amount cannot be less than ₦50</b>");
            
        }else{
            
            
            htmlspecialchars($amount);
            
            echo "<b style='color: mediumseagreen'>".$amount ."</b>";
        }
            
            
            
            
            
        }
        */
        
        
        
    }else{
        
        
        die("Server error");
        
        
        
        
    }
    
    
    $conn -> close();
    
}







?>