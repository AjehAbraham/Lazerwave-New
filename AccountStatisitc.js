
     
     if(window.history.replaceState){
     
        window.history.replaceState(null,null,window.location.href);
        
        } 
     
     
     
     
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
  
  
  }
  
  


  
    //REQUEST FOR OTP BTN TO SEND OTP//
    
    $(() => {
    
        $("#submitButton").click(function(ev){
        
        //show laoder pending whne form submit//
        
        (ev).preventDefault();
        
        document.querySelector(".loader-overlay").style.display = "block";
        
        
        ////
        
        var form = $("#formId");
        var url = "Accountstatistic process.php";
        
        $.ajax ({
          type: "POST",
          url: url,
          data: form.serialize(),
        dataType:'json',
        encode: true,
          success: function(data){
            //form has beeen submitted//
        
            console.log();
        
            //document.querySelector(".verificastion-container-overlay").style.width = "0%";
            
            document.querySelector(".loader-overlay").style.display = "none";
        

            var error = document.querySelector(".error_message");
        
        error.innerHTML = data.responseText;


          //  alert("Form submitted successfully");
        
          },
          error: function(data){
        
        
            var error = document.querySelector(".error_message");
        
        error.innerHTML = data.responseText;
        
         //   document.querySelector(".verificastion-container-overlay").style.width = "0%";
           
            
            document.querySelector(".loader-overlay").style.display = "none";
          
        document.querySelector("#formId").reset();
        
        }
        });
        });
        
        });
        
        //END OF OTP BTN//