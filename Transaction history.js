document.querySelector("#relaod-page").addEventListener("click",reload_page);

function reload_page(){
    window.location.reload();
}

document.querySelector("#back").addEventListener("click",Goback);

function Goback(){
    window.history.back();
}