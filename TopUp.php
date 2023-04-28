<?php

require_once __DIR__.("/sessionPage.php");


if (!isset($_SESSION["New_user"])){
    header("location:login.php");
    exit;
  }
require_once __DIR__.("/Network.php");


require_once __DIR__.("/db_connection.php");




if ($_SERVER["REQUEST_METHOD"] == "POST"){

$Amount = $_POST["amount"];

if(empty($Amount)){
    die("please enter an amount");
}else{

    $account_no = "3344444";
    $account_status = "hdhdhdh";
    $last_updated = 111111;

    $maths_rand = "Trdx". rand(9999,99999);
    require_once __DIR__.("/db_connection.php");


    $stmt = $conn -> prepare ("INSERT INTO Account_balance(
    User_id,Amount,Account_no,Account_status,Last_Updated
   )
   
   VALUES(?,?,?,?,?)
    ");

    $stmt -> bind_param("iiisi",$_SESSION["New_user"],$Amount,$account_no,$account_status,$last_updated);



/*
    $sql .= $conn -> prepare ("INSERT INTO Transaction_history(
    User_id,Transaction_id,Amount,Type_name,Status_remark,Date_id,Time_id
   )
   
   VALUES =(?,?,?,?,?,?,?)
    ");

    $stmt -> bind_param("isissii",$_SESSION["New_user"],$maths_rand,$ $Amount,$account_status,$last_updated,$last_updated,$last_updated);

*/




    $stmt -> execute();
}

if($stmt == TRUE){
    echo "succesffuly";
}else{
    echo "faild";
}


}






?>



<form method="post">

<input type="number" name="amount">
<br>
<input type="submit">


</form>