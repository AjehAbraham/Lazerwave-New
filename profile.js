
var loadFile = function(event){
    var image = document.querySelector("#output");
    image.src = URL.createObjectURL(event.target.files[0]);

};

            document.querySelector(".open-upload-btn").addEventListener("click",open_upload);
            function open_upload(){
                document.querySelector(".upload-option-overlay").style.width = "100%";
            }
document.querySelector("#close-upload-btn").addEventListener("click",close_upload);
            function close_upload(){
                document.querySelector(".upload-option-overlay").style.width= "0%";
            }
       

    document.querySelector(".copy-account-no").addEventListener("click",copyAcct_no);

function copyAcct_no(){
    var account_number = document.getElementById("account-number");

   account_number.select();
    navigator.clipboard.writeText(account_number.value);

    alert("Account Number copied to clipboard");

   document.querySelector(".copy-account-no").innerHTML ="Copied";
    
}


if(window.history.replaceState){

    window.history.replaceState(null,null,window.location.href);

}
//COPY USERNAME//

function copyUsername(){
var AccountNumber=
document.getElementById("Username");
AccountNumber.select();
/*
AccountNumber.setSelectionRange(0,99999);*/
navigator.clipboard.writeText(
AccountNumber.value);
alert("Username copied to clipboard");
/*
document.getElementById("copy").innerText="Copied";*/
}

//END COPY USERNAME



function see_more(){
  var see_more_info =  document.querySelector(".more-infromation");


  if (see_more_info.style.display == "none"){
    see_more_info.style.display = "block";
    document.querySelector(".More").innerHTML="See less";
    
  }else{
    see_more_info.style.display = "none";
    
    document.querySelector(".More").innerHTML="See more...";
    
  }

}



//CLOSE UPLOAD OVERLAY //

function close_uplaod_overlay(){


    document.querySelector(".upload-option-overlay").style.width = "0%";


}

function open_verify_email(){



document.querySelector(".verificastion-container-overlay").style.width = "100%";

}

function close_email_verify(){


document.querySelector(".verificastion-container-overlay").style.width = "0%";
}



   //REQUEST FOR OTP BTN TO SEND OTP//
    
    $(() => {
    
    $("#sendOtp_submitButton").click(function(ev){
        (ev).preventDefault();
    
   document.querySelector(".loader-overlay").style.display = "block";
    
    
    ////
    
    var form = $("#sendOtp_formId");
    var url = "Send otp.php";
    
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
    
       
        var error = document.querySelector(".otp_error_message");
    
    error.innerHTML = data.responseText;
    
      //  alert("Form submitted successfully");
    
      },
      error: function(data){
    document.querySelector(".loader-overlay").style.display = "none";
    
        var error = document.querySelector(".otp_error_message");
    
    error.innerHTML = data.responseText;
    
       
    
    }
    });
    });
    
    });
    
    
    
    
        //REQUEST FOR OTP BTN TO SEND OTP//
    
    $(() => {
    
    $("#verify_submitButton").click(function(ev){
        (ev).preventDefault();
    
   document.querySelector(".loader-overlay").style.display = "block";
    
    
    ////
    
    var form = $("#verify_formId");
    var url = "email verify otp.php";
    
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
    
      //  alert("Form submitted successfully");
    
      },
      error: function(data){
    document.querySelector(".loader-overlay").style.display = "none";
    
        var error = document.querySelector(".error_message");
    
    error.innerHTML = data.responseText;
    
       
    
    }
    });
    });
    
    });
    
function close_otp_message(){

document.querySelector(".form-status-message-overlay").style.display = "none";



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

    
    


