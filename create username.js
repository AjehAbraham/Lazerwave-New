

function close_otp_message(){

  document.querySelector(".form-status-message-overlay").style.display = "none";
  
  
  }
    
    //REQUEST FOR OTP BTN TO SEND OTP//
    
    $(() => {
    
    $("#username_submitButton").click(function(ev){
        (ev).preventDefault();
    
    document.querySelector(".createuser-loader-overlay").style.display = "block";
    
    
    ////
    
    var form = $("#username_formId");
    var url = "create username process .php";
    
    $.ajax ({
      type: "POST",
      url: url,
      data: form.serialize(),
    dataType:'json',
    encode: true,
    success: function(data){
        //form has beeen submitted//
    
        console.log();
    
        document.querySelector(".createuser-loader-overlay").style.display = "none";
    
       
        var error = document.querySelector(".username_error_message");
    
    error.innerHTML = data.responseText;
    
      //  alert("Form submitted successfully");
    
      },
      error: function(data){
    document.querySelector(".createuser-loader-overlay").style.display = "none";
    
        var error = document.querySelector(".username_error_message");
    
    error.innerHTML = data.responseText;
    
       
    
    }
    });
    });
    
    });
    
    
    
    //OPEN USERNAME //
    
    
    
    function openUsername(){
    
    document.querySelector(".notification-overlay").style.width="100%";
    
    
    }
    window.onload = setTimeout(openUsername,7000);
    
    
    function closeUsername(){
    document.querySelector(".notification-overlay").style.width="0%";
    
    }
