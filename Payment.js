    
         if(window.history.replaceState){
     
            window.history.replaceState(null,null,window.location.href);
            
            } 
        
        
        document.querySelector(".open-share-receipt-container").addEventListener("click",openReceipt);
        
            function openReceipt(){
        
                document.querySelector(".share-receipt-container").style.width = "100%";
                document.querySelector(".share-box").style.width = "100%";
            }
        
        
            document.querySelector(".close-share-container-btn").addEventListener("click",closeReceipt);
        
        function closeReceipt(){
        
            document.querySelector(".share-receipt-container").style.width = "0%";
                document.querySelector(".share-box").style.width = "0%";
        
        }
        