     //Cash card hiding input values on sales sheet

              function scheduleA(event) {
                  var cash = document.getElementById("Cash");
                   var card = document.getElementById("Card");
                  var shopbox = document.getElementById("Shopbox");
                  var aramex = document.getElementById("Aramex");
                  
                  if(this.options[this.selectedIndex].text === "Cash"){
                      
                      cash.style.display = "";
                      card.style.display = "none";
                      shopbox.style.display="none";
                      aramex.style.display="none";
                      
                  } else if(this.options[this.selectedIndex].text === "Card"){
                   
                      cash.style.display="none";
                      card.style.display = "";
                      shopbox.style.display="none";
                      aramex.style.display="none";
                      
                  } else if(this.options[this.selectedIndex].text === "Cash and Card"){
                      cash.style.display="";
                      card.style.display = "";
                      shopbox.style.display="none";
                      aramex.style.display="none";
                      
                  } else if(this.options[this.selectedIndex].text === "Shopbox"){
                      cash.style.display="none";
                      card.style.display = "none";
                      shopbox.style.display="";
                      aramex.style.display="";
                      
                  } else if(this.options[this.selectedIndex].text === "Aramex"){
                      cash.style.display="none";
                      card.style.display = "none";
                      shopbox.style.display="none";
                      aramex.style.display="";
                      
                  } else if(this.options[this.selectedIndex].text === "Bank Transfer"){
                      cash.style.display="none";
                      card.style.display = "none";
                      shopbox.style.display="none";
                      aramex.style.display="none";
                      
                  } else if(this.options[this.selectedIndex].text === "Please Select"){
                      cash.style.display="none";
                      card.style.display = "none";
                      shopbox.style.display="none";
                      aramex.style.display="none";
                      
                  } 
                  
                   
                  
   
 
}



           