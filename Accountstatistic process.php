<?php

require_once __DIR__.("/sessionPage.php");


if ($_SERVER["REQUEST_METHOD"] == "POST"){


    $email = filter_var($_POST["email"],FILTER_VALIDATE_EMAIL);


    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){

        $message_status = "Invalid mail address";
    
      
        include __DIR__ .("/Failed.php");

        die();
    


    }else{
        htmlspecialchars($email);


  /*      
$ip_add = $_SERVER["REMOTE_ADDR"];

$remark = "- Pending";

$send_account_no = $user["Account_no"];

$re_account_no = "Lazerwave";
*/

//check transaction pin
$pin = (int) filter_var($_POST["transaction-pin"],FILTER_SANITIZE_NUMBER_INT);

htmlspecialchars($pin);


//search dtatabse table

$tran_pin = "SELECT * FROM User_pin WHERE User_id = '$_SESSION[New_user]'";

$result_pin = $conn -> query($tran_pin);

if ($result_pin -> num_rows > 0){


  while($pin_result = $result_pin -> fetch_assoc()){

//echo "pin found";

//now check if pin is correct


if (password_verify($pin,$pin_result["Pin"]) =="password_hash"){

//echo "pin is valid";


}else{

        $message_status = "invalid pin";
    
      
        include __DIR__ .("/Failed.php");

        die();
    





}



  }


}else{

    
    $message_status = "Please create a transaction pin";
    
      
    include __DIR__ .("/Failed.php");

    die();

}











$amount = 10;

        if ($amount > $user["Account_balance"]){



        $send_account_no = $user["Account_no"];
        $receiver_account_no = "Lazerwave";
        $ip_addr = $_SERVER["REMOTE_ADDR"];
        $remark = "Pending";

        $transaction_id = uniqid(). rand(999,9999);

        $type = "ACCOUNT STATEMENT";
        
        
        $date = date("Y/m/d H:i:s");
        
        $time = date("H:i:s");
        
        $amount = 10;
        
        $typee ="Account Statement";
        
        $bank ="";

            
            $status = "Failed";
    
            $failed_transaction = "INSERT INTO Transaction_history(User_id,Transaction_id,Amount,Type_name,Remark

            ,Status_remark,Sender_account_no,Receiver_account_no,Date_id,Time_id,Ip_addr,Type,Bank
            
            )
            VALUES('$_SESSION[New_user]','$transaction_id','$amount','$type','$remark','$status','$send_account_no','$receiver_account_no','$date','$time','$ip_addr','$typee','$bank')
            ";
            
            if ($conn -> query($failed_transaction) == TRUE){

                   
      $message_status = "Insuffient balance";
    
          include __DIR__ .("/Failed.php");
      
            
            }

            
            $message_status = "Insufficient balance";
    
            include __DIR__ .("/Failed.php");

         
      



        }




if ($amount <= $user["Account_balance"]){
    
    
    $amount =10;
    
    $status ="unseen";
    $Type = "ACOUNT STATEMENT";
    $message ="ACCOUNT STATEMENT";
    
    require_once "Add notification.php";
    
    
    require_once "Check block account.php";
    
    require_once "Check daily limit.php";
    
    

        $status = "Successful";
        

        $send_account_no = $user["Account_no"];
        $receiver_account_no = "Lazerwave";
        $ip_addr = $_SERVER["REMOTE_ADDR"];
        $remark = "- Debit";


        $transaction_id =rand(999,9999) . uniqid();

        $type = "ACCOUNT STATEMENT";
        
        
        $date = date("Y-m-d H:i:s");
        
        $time = date("H:i:s");
        
        $amount = 10;
    
    $typee="Account Statement";
    
    $bank ="";
    
        $failed_transaction = "INSERT INTO Transaction_history(User_id,Transaction_id,Amount,Type_name,Remark


        ,Status_remark,Sender_account_no,Receiver_account_no,Date_id,Time_id,Ip_addr,Type,Bank
        
        )
        VALUES('$_SESSION[New_user]','$transaction_id', '$amount','$type','$remark','$status','$send_account_no','$receiver_account_no','$date','$time','$ip_addr','$typee','$bank')
        ";
        
        if ($conn -> query($failed_transaction) == TRUE){


            $new_balance = $user["Account_balance"] - $amount;

            $update_balance = "UPDATE Register_db SET Account_balance ='$new_balance' WHERE id = '$_SESSION[New_user]' ";

            if ($conn -> query($update_balance) == TRUE){
                
                require_once "Add limit.php";

                   
     // $message_status = "Transaction Successful";
   
      
        //  include __DIR__ .("/success.php");
      
                
            }



        
        }



        include __DIR__.("/db_connection.php");

        $check = "SELECT * FROM Transaction_history WHERE User_id ='$_SESSION[New_user]'";

        $result = $conn -> query($check);

        if ($result -> num_rows > 0){


$to = $_POST["email"];
$from = 'Lazerwave@gmail.com';
$fromName = 'Lazerwavesupport'; 

$headers = "MIME-Version: 1.0" . "\r\n"; 
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
$headers .= 'Bcc: lazerwave@gmail.com' . "\r\n"; 
$headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 

$subject ="ACCOUNT STATEMENT";


$ammt = number_format($user["Account_balance"]);

        //  $user['Account_balance'] =  number_format($user["Account_balance"]);
        
        $message ="Hello ".$user['Surname'] .",";
        
        
        
        $message .="<p style='color: white;background-color: rgb(0,0,100); font-size: 18px;padding: 10px 10px;margin:auto;width: 65%; border-radius: 2rem; text-align: center;color: white;'>Lazerwave</p>"
    ;
            $message .="
            <table>
                <tr style='text-align: center'>
                    <th>Account name</th>
                    <th>Account number</th>
                    <th>Account balance</th>
                </tr>
           
           
    <tr>
    <td>$user[Surname]  $user[First_name]   $user[Last_name]  </td>

    <td>$user[Account_no]</td>
<td>₦$ammt</td>
</tr>

<tr>
    
</table> " ;


//SELECT TRANSACTION HISTORY AND SHOW ALL MESSAGE//


require_once "db_connection.php";

$hist ="SELECT * FROM Transaction_history WHERE User_id ='$_SESSION[New_user]'";

$result_h =$conn -> query($hist);

if($result_h -> num_rows > 0){
    
    $message .= "<table style='font-size: 12px;text-align: center'>
        
        <tr style='font-weight: bold; border: 2px solid rgb(0,0,100);text-align: center;'>
        <th>Account No </th>
        
        <th>Date</th>
        
        <th>Transaction ID</th>
        <th>Amount </th>
        <th>Type </th>
        <th>Remark</th>
        
        <th>Status</th>
        
        </tr>
        ";
    
    
    
    while($hist_result = $result_h -> fetch_assoc()){
        
        
        
        
      //  $total += "₦" . number_format( $hist_result["Amount"]). ".00";
        
       $amm ="₦".number_format( $hist_result["Amount"]);
        
        
    $message .= "
        
        <tr style='color: 2px solid rgba(255,0,0,0.4);font-size: 13px'>
        
        <td> $hist_result[Sender_account_no]</td>
        
        <td>$hist_result[Date_id]</td>
        
        
        <td>$hist_result[Transaction_id]</td> 
        
        <td>$amm</td>
        
        <td> $hist_result[Type]</td>
        <td>$hist_result[Type_name]
        </td>
        
        <td> $hist_result[Status_remark]</td>
        </tr>
        </table>
        

        "
        ;
        
        
        
    }
    
    
    
    //$message .= "<table> <tr>
    
    //<th>Total $total</th>
  //  </tr>
    //</table>
    //";
    
}else{
    
    $message .= "<p> No record found</p>";
    
    
    
    
}







$message .="<p>Please ignore if you did not request for this message</p>";



 $mail = mail($to,$subject,$message,$headers);
 
 
 if($mail == TRUE){
     
     $message_status ="Mail sent to "
     ."<br>".$_POST["email"];
     
     require_once "success.php";
     
     
     $_SESSION["AMOUNT"] = $amount;
     
     require_once "Debit alert.php";
     
     
     
 }else{
     
     
     $message_status ="error sending mail to "
     ."<br>". $_POST["email"];
     
     require_once "Failed.php";
     
     
     
 }
 


            while ($trans_result = $result -> fetch_assoc()){

echo  "


";

            }
        }

    }else{
           
      $message_status = "An unknown error has occur";
    
      
          include __DIR__ .("/Failed.php");

          die();
      
    }


}



}

?>



