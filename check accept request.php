<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

  header("Location: Warning.php");
  exit;

      header('HTTP/1.0 403 Forbiddden',TRUE,403);
      die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}
?>

<style>
    input[type=number]{
        
        padding: 6px 6px;
        background-color: #f1f1f1;
        margin: auto;
        width: 50%;
        font-size: 18px;
    }
</style>

<?php



//CHECK ACCEPT REQUEST STATUS TO KNOW IF REQUEST HAS BEEN ACCEPTED//

require_once __DIR__.("/db_connection.php");

//var_dump($result_notify);

$Accepted_re="SELECT * FROM Accept_request WHERE User_id ='$_SESSION[New_user]' AND Notify_id ='$result_notify[Notify_id]' ";


$ACCEPT_result = $conn -> query($Accepted_re);


if ($ACCEPT_result -> num_rows > 0){

$ACCEPTED = $ACCEPT_result -> fetch_assoc();


if ($ACCEPTED["Type"] == "Money Request"){

echo "<p style='text-align: center;color: white;padding: 10px 10px;width: 60%; margin: auto;background-color: mediumseagreen;font-size: 20px;'>Request Accepted</p>";


}

}else{


//DO NOTHIHIN 


echo "<form method='post'id='formId'>

<input type='hidden' name='Accept'
value='$result_notify[Receiver_id]'>

<input type='hidden'name='amount' value='$result_notify[Amount]'>

<input type='hidden' value='$result_notify[Notify_id]' name='notify'>


<p>Transaction pin<br><input type='number' inputmode='numeric' style='-webkit-text-security:disc;' maxlength='4' name='pin' placeholder='Enter pin...'>
</p>

<p style='background-color: transparent'><input type='submit' value='Accept'id='submitButton'></p>
</form>


<p style='background-color: transparent;padding: 2px'class='Reject'><input type='submit'  value='Rejected'></p>

";



}
?>