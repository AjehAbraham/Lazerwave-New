   
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
    var url = "Add card.php";
    
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

    
     
    