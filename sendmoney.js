
if(window.history.replaceState){
     
    window.history.replaceState(null,null,window.location.href);
    
    }


/*
document.querySelector("#open-container-btn").addEventListener("click",closeConfirm);
*/
function openConfirm(event){
    document.querySelector(".verifcation-box").style.width = "100%";
}


document.querySelector("#close-container-btn").addEventListener("click",closeConfirm);

function closeConfirm(){
    document.querySelector(".verifcation-box").style.width = "0%";
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
