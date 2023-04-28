

function close_otp_message(){

  document.querySelector(".form-status-message-overlay").style.display = "none";
  
  
  }
    
    //REQUEST FOR OTP BTN TO SEND OTP//
    
    $(() => {
    
    $("#submitButton").click(function(ev){
        (ev).preventDefault();
    
    document.querySelector(".loader-overlay").style.display = "block";
    
    
    ////
    
    var form = $("#formId");
    var url = "Accept Request.php";
    
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
    
    //END OF OTP BTN//
    
    

document.querySelector(".report-message").addEventListener("click",report_message);


function report_message(){
    
    
    alert("Not supported");
    
    
    
}

document.querySelector(".reply-message").addEventListener("click",share_message);

function share_message(){
    
    alert("Replying message not supported");
}
    
    