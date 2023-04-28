
  if(window.history.replaceState){
  
  window.history.replaceState(null,null,window.location.href);
  
  }




  
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
  var url = "Register proccess.php";

  $.ajax ({

    type: "POST",
    url: url,
    data: form.serialize(),
    dataType:"json",
    success: function(data){
      //  alert("success");

        console.log();
        
      /*  var reply = data.responseText

    document.querySelector(".error_message").innerHTML= reply;

*/
      //form has beeen submitted//

      document.querySelector(".loader-overlay").style.display = "none";


      document.querySelector(".form-status-message-overlay").style.display ="block";

//check if it is successull or it failed//

var res = document.querySelector(".error_message");

res.innerHTML= reply;


    },
    error: function(data){

        document.querySelector(".loader-overlay").style.display = "none";


        document.querySelector(".error_message").innerHTML = data.responseText;



document.querySelector(".form-status-message-overlay").style.display = "block";



if (data.responseText == "Registration successful! &#12819"){


  document.querySelector("$formId").reset();


}


      //alert("Invalid otp");
    }
  });
});

});




//END OF VERIFY OTP BTN




var x, i, j, l, ll, selElmnt, a, b, c;
/* Look for any elements with the class "custom-select": */
x = document.getElementsByClassName("custom-select");
l = x.length;
for (i = 0; i < l; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  ll = selElmnt.length;
  /* For each element, create a new DIV that will act as the selected item: */
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /* For each element, create a new DIV that will contain the option list: */
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < ll; j++) {
    /* For each option in the original select element,
    create a new DIV that will act as an option item: */
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /* When an item is clicked, update the original select box,
        and the selected item: */
        var y, i, k, s, h, sl, yl;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        sl = s.length;
        h = this.parentNode.previousSibling;
        for (i = 0; i < sl; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            yl = y.length;
            for (k = 0; k < yl; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
    /* When the select box is clicked, close any other select boxes,
    and open/close the current select box: */
    e.stopPropagation();
    closeAllSelect(this);
    this.nextSibling.classList.toggle("select-hide");
    this.classList.toggle("select-arrow-active");
  });
}

function closeAllSelect(elmnt) {
  /* A function that will close all select boxes in the document,
  except the current select box: */
  var x, y, i, xl, yl, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  xl = x.length;
  yl = y.length;
  for (i = 0; i < yl; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < xl; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}

/* If the user clicks anywhere outside the select box,
then close all select boxes: */
document.addEventListener("click", closeAllSelect);









  
