<?php


require_once __DIR__.("/db_connection.php");

$limit = "SELECT * FROM Account_limit WHERE User_id ='$_SESSION[New_user]'";



$limit_result = $conn -> query($limit);

if ($limit_result -> num_rows > 0){


    //USER ACCOUNT RECORD WAS FOUND

    while($account_limit = $limit_result -> fetch_assoc()){

//NOW UPDATE THE LIMIT DAILY TO RESET USER DAILY LIMIT//

$Limit = 0;

$update_limit = "UPDATE Account_limit SET Limit_amount ='$Limit' WHERE User_id = '$_SESSION[New_user]'

AND  NOW() >= DATE_ADD(Date_id,INTERVAL 12 HOUR)";


if ($conn -> query($update_limit) == TRUE){

//DO NOTHING BECAUSE USER IS NOT SUPPOSE TO BE AWARE OF LIMIT




}else{

    //DO NOTHING




}


    }


}else{

    //NO RECORD WAS FOUND SO WE NEED TO INSERT USER DETAILS INTO ACCOUNT LIMIT..


$limit_ammount = 0;
$date = date("Y-m-d H:i:s");
$time = date("H:i:s");

$insert = "INSERT INTO Account_limit(User_id,Limit_amount,Time_id,Date_id)

VALUES('$_SESSION[New_user]','$limit_ammount','$time','$date')
";

if ($conn -> query($insert) == TRUE){

//DO NOTHING//






}else{


//DO NOHOING IF IT FAILED//



}





}
?>