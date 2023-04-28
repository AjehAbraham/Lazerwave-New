
<!-- message/loader -->

<div class="form-status-message-overlay">
    <div class="message-response">
        
      <h3 class="icon"><i class="fa fa-check"></i></h3>

<h3 class="message-body">Successful.<br><?php echo 
$message_status; ?></h3>

<h3 class="close-response-btn" onclick="close_otp_message()">Done</h3>

</div>
</div>

<script>
function close_otp_message(){

document.querySelector(".form-status-message-overlay").style.display = "none";

window.history.reload();


}


    </script>

<!-- end of message-->


<style>
    
    .Dark-mode .message-response{
        color: #666;
        background-color: rgb(0,0,56);
    }
.form-status-message-overlay{
  
    width: 100%;
height: 100%;
background-color: rgba(0,0,0,0.3);
position: fixed;
left: 0;
top: 0;
bottom" 0;
right:0;
font-size: 17px;
z-index: 1;
font-weight: lighter;

}
.message-response{
    
    margin-left: auto;
    margin-right: auto;
    display: block;
    background-color: white;
    text-align: center;
    width: 90%;
    padding: 10px 10px;
   margin-top: 5%;
   z-index: 2;
   color: mediumseagreen;
}
.message-response i{
    margin-top: 8px;
    background-color: mediumseagreen;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    font-size: 25px;
    animation: message-loader 3s infinite;
    color: white;
}
@keyframes message-loader {
    100%{transform: scale(2)}

}
.close-response-btn{
    margin-left: auto;
    margin-right: auto;
    display: block;
    width: 50%;
    background-color: mediumseagreen;
    color: white;
    padding: 8px 8px;
    border-radius: 2rem;
cursor: pointer;
}
    </style>