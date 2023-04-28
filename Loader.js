function closeLoader(){
    var loader = document.querySelector(".loader-container");

    loader.style.display = "none";
}

VarTimer = setTimeout(closeLoader,3000)