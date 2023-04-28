

var loadFile = function(event){
    var image = document.querySelector("#output");
    image.src = URL.createObjectURL(event.target.files[0]);

};


//JQUERY TO AUTO INCREASE TEXT AREA SIZE//


$("textarea").each(function () {
  this.setAttribute("style", "height:" + (this.scrollHeight) + "px;overflow-y:hidden;");
}).on("input", function () {
  this.style.height = 0;
  this.style.height = (this.scrollHeight) + "px";
});

//END OF JQUERY//


//Open and Close history//

document.querySelector(".close-btn").addEventListener("click",close_history);

function close_history(){

document.querySelector(".Payment-link-details-container").style.width="0%";

}



document.querySelector(".open-btn").addEventListener("click",Open_history);
function Open_history(){

document.querySelector(".Payment-link-details-container").style.width="100%";

}


function submit_form(event){

    event.preventDefault();
    
    document.querySelector(".loader-overlay").style.display = "block";
    
    
    ////
    
    var form = $("#formId");
    var url = "create payment link process.php";
    
    $.ajax ({
      type: "POST",
      url: url,
      data: form.serialize(),
    dataType:'json',
    encode: true,
    enctype: 'multipart/form-data',
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


}

function close_otp_message(){

  document.querySelector(".form-status-message-overlay").style.display = "none";
  
  
  }




function copy_link(){

var link=
document.querySelector("#link_value");
link.select();
/*
AccountNumber.setSelectionRange(0,99999);*/
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



