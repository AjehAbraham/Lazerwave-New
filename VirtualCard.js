
    
    document.querySelector(".open-tarnsaction-btn").addEventListener("click",open_tran_pin);

    function open_tran_pin(){

        document.querySelector(".Transaction-pin-container-overlay").style.width = "100%";
        document.querySelector(".transaction-pin-container").style.width = "100%";
    }


    document.querySelector(".close-transaction_pin").addEventListener("click",close_tran_pin);

function close_tran_pin(){

    document.querySelector(".Transaction-pin-container-overlay").style.width = "0%";
        document.querySelector(".transaction-pin-container").style.width = "0%";

}

function close_otp_message(){

    document.querySelector(".form-status-message-overlay").style.display = "none";
    
  //  window.history.reload();
    
    
    }
 
   /*function close_email_verify(){


        document.querySelector(".verificastion-container-overlay").style.width = "0%";
        }
        */
        
        //REQUEST FOR OTP BTN TO SEND OTP//
        
        $(() => {
        
        $("#submitButton").click(function(ev){
        
        //show laoder pending whne form submit//
        
        (ev).preventDefault();
        
        document.querySelector(".loader-overlay").style.display = "block";
        
        
        ////
        
        var form = $("#formId");
        var url = "Virtualcard process.php";
        
        $.ajax ({
        
          type: "POST",
          url: url,
          data: form.serialize(),
        dataType:'json',
        encode: true,
          success: function(data){
            //form has beeen submitted//
        
            console.log();
        
         //   document.querySelector(".verificastion-container-overlay").style.width = "0%";
            
            document.querySelector(".loader-overlay").style.display = "none";
        
          //  alert("Form submitted successfully");
        
          },
          error: function(data){
        
        
            var error = document.querySelector(".error_message");
        
        error.innerHTML = data.responseText;
        
           // document.querySelector(".verificastion-container-overlay").style.width = "0%";
           
            
            document.querySelector(".loader-overlay").style.display = "none";
          
        document.querySelector("#formId").reset();
        
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

        