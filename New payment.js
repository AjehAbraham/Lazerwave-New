
function validate_form(event){


   event.preventDefault();
    
    document.querySelector(".loader-overlay").style.display = "block";
    
    
    ////
    
    var form = $("#formId");
    var url = "payment process.php";
    
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
    
    if(data.responseText === 300){
            
            document.querySelector(".formId").reset();
            
            
            window.location.href ='Transaction successful.php';
            
        }
        
    
    
    
      //  alert("Form submitted successfully");
    
      },
      error: function(data){
    document.querySelector(".loader-overlay").style.display = "none";
    
        var error = document.querySelector(".error_message");
    
    error.innerHTML = data.responseText;
    
        //ocument.querySelector("#referal_formId").reset();
        if(data.responseText === 300){
            
            document.querySelector(".formId").reset();
            
            
            window.location.href ='Transaction successful.php';
            
        }
        
        
    
    }
    });
    
    }
    
    function close_otp_message(){

  document.querySelector(".form-status-message-overlay").style.display = "none";
  
  
  }
  
  function validate_card_no(){


document.querySelector(".card_error_message").innerHTML ="please wait...";


var form = $("#formId");
    var url = "Card info.php";
    
    $.ajax ({
      type: "POST",
      url: url,
      data: form.serialize(),
    dataType:'json',
    encode: true,
    success: function(data){
        //form has beeen submitted//
    
        console.log();
    
        
       
        var error = document.querySelector(".card_error_message");
    
    error.innerHTML = data.responseText;
    
      //  alert("Form submitted successfully");
    
      },
      error: function(data){
    
        var error = document.querySelector(".card_error_message");
    
    error.innerHTML = data.responseText;
    
        
    
    }
    });






}
  
  
  
    
    
