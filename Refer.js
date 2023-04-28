function close_otp_message(){

  document.querySelector(".form-status-message-overlay").style.display = "none";
  
  
  }
    
    //REQUEST FOR OTP BTN TO SEND OTP//
    
    $(() => {
    
    $("#referal_submitButton").click(function(ev){
        (ev).preventDefault();
    
    document.querySelector(".loader-overlay").style.display = "block";
    
    
    ////
    
    var form = $("#referal_formId");
    var url = "Refer process.php";
    
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
    
       
        var error = document.querySelector(".referal_error_message");
    
    error.innerHTML = data.responseText;
    
      //  alert("Form submitted successfully");
    
      },
      error: function(data){
    document.querySelector(".loader-overlay").style.display = "none";
    
        var error = document.querySelector(".referal_error_message");
    
    error.innerHTML = data.responseText;
    
        document.querySelector("#referal_formId").reset();
    
    }
    });
    });
    
    });
    
    //END OF OTP BTN//
    
    
    
    document.querySelector(".view-referal").addEventListener("click",openHistory);

function openHistory(){

document.querySelector(".referal-history-container").style.width="100%";

}

document.querySelector("#close-history-btn").addEventListener("click",CloseHistory);

function CloseHistory(){
document.querySelector(".referal-history-container").style.width="0%";


}



    
    
    
    
    
function CopyLink(){
var link=
document.querySelector("#link");
link.select();
link.setSelectionRange(0,99999);
navigator.clipboard.writeText(
link.value);
alert("Link copied to clipboard");

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




