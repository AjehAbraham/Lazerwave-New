//OPEN SECURITY CONTAINER

document.querySelector(".open-security").addEventListener("click",openSecurity);

function openSecurity(){
    document.querySelector(".security-container").style.width = "100%";
    document.querySelector(".report-scam-container").style.width = "0%";
}



document.querySelector("#close-security-btn").addEventListener("click",closeSecurity);

function closeSecurity(){

    document.querySelector(".security-container").style.width = "0%";
}


// END OF SECURITY CONTAINER



//



//OPEN TRANSACTION PIN //


document.querySelector(".open-transaction-pin").addEventListener("click",openTransactionPin);

function openTransactionPin(){
    document.querySelector(".transaction-pin-container").style.width = "100%";
    document.querySelector(".report-scam-container").style.width = "0%";
}


//CLOSE TRANSACTION PIN//


document.querySelector("#close_transaction_container_rr").addEventListener("click",close_transaction_pin_container);

function close_transaction_pin_container(){

    document.querySelector(".transaction-pin-container").style.width = "0%";

}





//OPEN AND CLOSE CHNAGE PASSWORD//


document.querySelector(".open-change-password").addEventListener("click",openChangePaswword);

function openChangePaswword(){
    document.querySelector(".change-password-container").style.width = "100%";
    document.querySelector(".report-scam-container").style.width = "0%";
}


document.querySelector("#close-change-password-btn").addEventListener("click",closeChangePassword);

function closeChangePassword(){

    document.querySelector(".change-password-container").style.width = "0%";
}

//


// OPEN REPORT ACCOUNT//

document.querySelector(".open-report-container").addEventListener("click",openReport);

function openReport(){
    document.querySelector(".report-scam-container").style.width = "100%";

    document.querySelector(".change-password-container").style.width = "0%";

    document.querySelector(".transaction-pin-container").style.width = "0%";
}


//CLOSE REPORT ACCOUNT
document.querySelector("#close-report-container-btn").addEventListener("click",closeReport);

function closeReport(){

    document.querySelector(".report-scam-container").style.width = "0%";
}


if(window.history.replaceState){

        window.history.replaceState(null,null,window.location.href);

    }



    //COPY PAYMENT LINK///



    document.querySelector(".copy-payment-link").addEventListener("click",copy_Payment_link);

    function copy_Payment_link(){
        var payment_link = document.getElementById("payment-link");
    
      payment_link.select();
        navigator.clipboard.writeText(payment_link.value);
    
        alert("Payment link copied to clipboard");

        document.querySelector(".copy-payment-link").innerHTML = "Link Copied";
    
      /* document.querySelector(".copy-account-no").innerHTML ="Copied";*/
        
    }


///OPEN AND CLOSE PAYMENT LINK CONTAINER
function openPayment_link(){
    var link_contauner = document.querySelector(".Payment-link-container"). style.width = "100%";

    document.querySelector(".payment-link-overlay"). style.width = "100%";
   
  }

  function closePayment_link(){
     var link_contauner = document.querySelector(".Payment-link-container"). style.width = "0%";
     document.querySelector(".payment-link-overlay"). style.width = "0%";
  }



    //SHARE PAGE //


    document.querySelector(".share").addEventListener("click",sharePage);

    function sharePage(){

        if (navigator.share){
            navigator.share({
                title:'Lazerwave',
                url:'index.php',
            })
        }else{
            alert("opps your device does not support share");
        }
    }





function close_otp_message(){

document.querySelector(".form-status-message-overlay").style.display = "none";



}




   

$(() => {

    $("#Pin_submitButton").click(function(ev){
    //STOP PAGE FROM REFRESIN//
    
    (ev).preventDefault();
    
    
    //show laoder pending whne form submit//
    
    
      document.querySelector(".loader-overlay").style.display = "block";
     
    
      ////
    
      var form = $("#Pin_formId");
      var url = "Transaction pin.php";
    
      $.ajax ({
    
        type: "POST",
        url: url,
        data: form.serialize(),
        dataType:"json",
        success: function(data){
          //  alert("success");
    
            console.log();
          
          //form has beeen submitted//
    
          document.querySelector(".loader-overlay").style.display = "none";
    
    
          document.querySelector(".form-status-message-overlay").style.display ="block";
    
    //check if it is successull or it failed//
    
    var res = document.querySelector(".error_message");
    
    res.innerHTML= data.responseText;
    
    
        },
        error: function(data){
    
            document.querySelector(".loader-overlay").style.display = "none";
    
    
            document.querySelector(".error_message").innerHTML = data.responseText;
    
    
    
    
          //alert("Invalid otp");
        }
      });
    });
    
    });
    
    
    
    
    //END OF VERIFY OTP BTN
    

    

    //OPEN AND CLOSE ACCOUNT LIMIT//
    
    function Open_account_limit_pop_up(){


      document.querySelector(".account-limit-overlay-container").style.width ="100%";


      
    }



    function Close_account_limit_pop_up(){


document.querySelector(".account-limit-overlay-container").style.width="0%";


      
    }


   
    







//UPDATE TRANSACTION PIN SUNMIT


$(() => {

  $("#Update_submitButton").click(function(ev){
  //STOP PAGE FROM REFRESIN//
  
  (ev).preventDefault();
  
  
  //show laoder pending whne form submit//
  
  
    document.querySelector(".loader-overlay").style.display = "block";
   
  
    ////
  
    var form = $("#Update_Pin_formId");
    var url = "Update transaction pin.php";
  
    $.ajax ({
  
      type: "POST",
      url: url,
      data: form.serialize(),
      dataType:"json",
      encode: true,
      success: function(data){
        //  alert("success");
  
          console.log();
        
        //form has beeen submitted//
  
        document.querySelector(".loader-overlay").style.display = "none";
  
  
        document.querySelector(".form-status-message-overlay").style.display ="block";
  
  //check if it is successull or it failed//
  
  var res = document.querySelector(".error_message_update_pin");
  
  res.innerHTML= data.responseText;
  
  
      },
      error: function(data){
  
          document.querySelector(".loader-overlay").style.display = "none";
  
  
          document.querySelector(".error_message_update_pin").innerHTML = data.responseText;
  
  
  
  
        //alert("Invalid otp");
      }
    });
  });
  
  });
  
  
  
  
  //END OF TRANSACTION PIN SUBMIT
  
  
    //CHANGE PASSWORD SUBMIT FORM//


///CHANGE PASSWORD SUBMIT FORM

$(() => {

  $("#submitButton").click(function(ev){
  //STOP PAGE FROM REFRESIN//
  
  (ev).preventDefault();
  
  
  //show laoder pending whne form submit//
  
  
    document.querySelector(".loader-overlay").style.display = "block";
   
  
    ////
  
    var form = $("#formId");
    var url = "change password.php";
  
    $.ajax ({
  
      type: "POST",
      url: url,
      data: form.serialize(),
      dataType:"json",
      encode: true,
      success: function(data){
        //  alert("success");
  
          console.log();
        
        //form has beeen submitted//
  
        document.querySelector(".loader-overlay").style.display = "none";
  
  
        document.querySelector(".form-status-message-overlay").style.display ="block";
  
  //check if it is successull or it failed//
  
  var res = document.querySelector(".error_message_change_password");
  
  res.innerHTML= data.responseText;
  
  
      },
      error: function(data){
  
          document.querySelector(".loader-overlay").style.display = "none";
  
  
          document.querySelector(".error_message_change_password").innerHTML = data.responseText;
  
  
  
  document.querySelector(".form-status-message-overlay").style.display = "block";
  
  
  
  if (data.responseText == "Registration successful! &#12819"){
  
  
    document.querySelector("#formId").reset();
  
  
  }
  
  
        //alert("Invalid otp");
      }
    });
  });
  
  });
  
  
  
  
  
  
      //END OF CHANGE PASSWORD SUBMIT
  
  //DARK-MODE//
  

function Darkmode(){

var darkmode = document.body;


darkmode.classList.toggle("Dark-mode"  || "Light-mode");



/*

localStorage.setItem("Theme", "Dark-mode");*/


var Theme = localStorage.getItem("Theme");


if(Theme  == "Dark-mode"){


localStorage.setItem("Theme","Light-mode");


var body = document.body;



body.classList.add("Light-mode");

document.querySelector("#theme").checked=false;



}else{


localStorage.setItem("Theme","Dark-mode");

var body = document.body;



body.classList.add("Dark-mode");

document.querySelector("#theme").checked=true;


}





}

function Checkmode(){

var current_mode = localStorage.getItem("Theme");

if(current_mode == "Dark-mode"){


var dark = document.body;

dark.classList.add("Dark-mode");


document.querySelector("#theme").checked= true;


}else{

var dark = document.body;

dark.classList.add("Light-mode");

document.querySelector("#theme").checked= false;




}


}

var mode = Checkmode();
  
  
  
  
  
  