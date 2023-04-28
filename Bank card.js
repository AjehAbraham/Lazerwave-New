/*

document.querySelector("#open-add-card-btn").addEventListener("click",opencontainer);

function opencontainer(){
    document.querySelector(".add-card-information").style.width = "100%";
}

document.querySelector("#close-btn").addEventListener("click",closeContainer);

function closeContainer(){
    document.querySelector(".add-card-information").style.width = "0%";
}
*/

if(window.history.replaceState){

    window.history.replaceState(null,null,window.location.href);

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




