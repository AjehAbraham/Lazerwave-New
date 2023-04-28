

  
  function close_otp_message(){

document.querySelector(".form-status-message-overlay").style.display = "none";


}




$(() => {

$("#submitButton").click(function(ev){
//STOP PAGE FROM REFRESIN//

ev.preventDefault();


//show laoder pending whne form submit//


  document.querySelector(".loader-overlay").style.display = "block";
 

  ////

  var form = $("#formId");
  var url = "Kyc2 process.php";

  $.ajax ({

    type: "POST",
    url: url,
    data: form.serialize(),
    dataType:"json",
    success: function(data){
     // alert("success");

        console.log();
      
      //form has beeen submitted//

      document.querySelector(".loader-overlay").style.display = "none";


     // document.querySelector(".form-status-message-overlay").style.display ="block";

//check if it is successull or it failed//

var res = document.querySelector(".error_message");

res.innerHTML= responseText;


    },
    error: function(data){

      console.log();

        
//alert("Invalid otp");


document.querySelector(".loader-overlay").style.display = "none";


document.querySelector(".error_message").innerHTML = data.responseText;



 
    }
  });
});

});




//END OF VERIFY OTP BTN

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





