$(document).ready(function(){

     $('#ProductName').keyup(function(){
          var query = $(this).val();
          if(query != '')
          {
               $.ajax({
                    url:"actions/search/saleProductSearch.php?query",
                    method:"GET",
                    data:{query:query},
                    success:function(data)
                    {
                         $('#ProductNameList').fadeIn();
                         $('#ProductNameList').html(data);
                    }
               });
          }
     });

     $('#ProductName').focusout(function(){
                               $('#ProductNameList').fadeOut();
                             });

     $(document).on('click', '.product', function(){
       $('#ProductName').val($(this).text());
         $('#ProductNameList').fadeOut();
         document.getElementById("qty").focus();
     });
});

function fadeout(){
 $('#ProductNameList').fadeout();
}



function delProduct(){

  var prodid = document.getElementById('delproduct').value;
  console.log($('#delproduct').val());
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("GET","actions/invoice/invoice_js.php?prodid="+prodid+"&status=del",false);
  xmlhttp.send(null);
  console.log($('#delproduct').val());

disp_tmpsale();

}

function resetInvoice(){
    var invoiceNumber = document.getElementById("invoiceNumber").value;
     var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("GET","actions/invoice/invoice_js.php?inv="+invoiceNumber+"&status=reset",false);
  xmlhttp.send(null);
    
    location.reload();
    
}


function ins(){
  var pdesc=document.getElementById('ProductName').value;
  var qty=document.getElementById('qty').value;
  var invoiceNumber = document.getElementById("invoiceNumber").value;
    
  


  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("GET","actions/invoice/invoice_js.php?pdesc="+pdesc+"&qty="+qty+"&inv="+invoiceNumber+"&status=add",false);
  xmlhttp.send(null);

disp_tmpsale();
    disp_subtotal();
  


  document.getElementById('ProductName').value="";
  document.getElementById('qty').value = "";
  document.getElementById("ProductName").focus();

}





  function disp_tmpsale(){
      var invoiceNumber = document.getElementById("invoiceNumber").value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET","actions/invoice/display_tmpsale.php?&inv="+invoiceNumber+"&status=disp",false);
    xmlhttp.send(null);
    document.getElementById("SalesTable").innerHTML=xmlhttp.responseText;


  }


function disp_subtotal(){
          var invoiceNumber = document.getElementById("invoiceNumber").value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET","actions/invoice/invoice_js.php?&inv="+invoiceNumber+"&status=subtotal",false);
    xmlhttp.send(null);
    
    document.getElementById("subtotal").value=xmlhttp.responseText;
    document.getElementById("total").innerHTML=xmlhttp.responseText;
document.getElementById("totalFinal").innerHTML=xmlhttp.responseText;

    
}


function disp_discountTotal(){
    if(document.getElementById("discValue").value == ""){
        
        var invoiceNumber = document.getElementById("invoiceNumber").value;
    var discountValue = document.getElementById("discValue").value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET","actions/invoice/invoice_js.php?&discountValue="+discountValue+"&inv="+invoiceNumber+"&status=Nodisc",false);
    xmlhttp.send(null);
    document.getElementById("totalDiscount").value=discountValue;
    document.getElementById("total").innerHTML= xmlhttp.responseText;
    document.getElementById("totalFinal").innerHTML=xmlhttp.responseText;
        
    }else {
        
           var invoiceNumber = document.getElementById("invoiceNumber").value;
    var discountValue = document.getElementById("discValue").value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET","actions/invoice/invoice_js.php?&discountValue="+discountValue+"&inv="+invoiceNumber+"&status=disc",false);
    xmlhttp.send(null);
    document.getElementById("totalDiscount").value=discountValue;
    document.getElementById("total").innerHTML= xmlhttp.responseText;
    document.getElementById("totalFinal").innerHTML=xmlhttp.responseText;
    
    
    }
    
 
    
}


function redeem_points(){
    
    if(document.getElementById("discValue").value == ""){
        
    
    var invoiceNumber = document.getElementById("invoiceNumber").value;
    var pointsRedeem = document.getElementById("redeemPoints").value;
    var customer = document.getElementById("CustomerName").value;
   
    var xmlhttp = new XMLHttpRequest();
    
    xmlhttp.open("GET","actions/invoice/invoice_js.php?&pointsredeem="+pointsRedeem+"&customer="+customer+"&inv="+invoiceNumber+"&discValue="+discValue+"&status=redeemPointsNoDisc",false);
    
    xmlhttp.send(null);
    
     document.getElementById("totalFinal").innerHTML    
    =xmlhttp.responseText;
        document.getElementById("total").innerHTML    
    =xmlhttp.responseText;
        
    } else {
        
    }
    
}


    function redeem_points_disc(){
        
       
     if(document.getElementById("redeemPoints").value == ""){
         
    var discValue = document.getElementById("discValue").value;
    var invoiceNumber = document.getElementById("invoiceNumber").value;
    
    var xmlhttp = new XMLHttpRequest();
    
    xmlhttp.open("GET","actions/invoice/invoice_js.php?&pointsredeem="+pointsRedeem+"&customer="+customer+"&inv="+invoiceNumber+"&discValue="+discValue+"&status=Nopointsredeem",false);
    
    xmlhttp.send(null);
    
     document.getElementById("totalFinal").innerHTML    
    =xmlhttp.responseText;
        document.getElementById("total").innerHTML    
    =xmlhttp.responseText;
            
         
     } else {
         
    var discValue = document.getElementById("discValue").value;
    var invoiceNumber = document.getElementById("invoiceNumber").value;
    var pointsRedeem = document.getElementById("redeemPoints").value;
    var customer = document.getElementById("CustomerName").value;
   
    var xmlhttp = new XMLHttpRequest();
    
    xmlhttp.open("GET","actions/invoice/invoice_js.php?&pointsredeem="+pointsRedeem+"&customer="+customer+"&inv="+invoiceNumber+"&discValue="+discValue+"&status=pointsredeem",false);
    
    xmlhttp.send(null);
    
     document.getElementById("totalFinal").innerHTML    
    =xmlhttp.responseText;
        document.getElementById("total").innerHTML    
    =xmlhttp.responseText;
            
        
         
     }
            

 
  

        
        
    }



$(document).ready(function getInvoiceNumber(){
    
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("GET","actions/invoice/invoice_js.php?status=invoice",false);
  xmlhttp.send(null);


  document.getElementById("invoiceNumber").value =  xmlhttp.responseText;
disp_tmpsale();
    disp_subtotal()

});



    $(document).ready(function(){
         $('#CustomerName').keyup(function(){

        var query = $(this).val();
        if(query != '')
                          {
         $.ajax({
         url:"actions/search/saleCustomerSearch.php?query",
         method:"GET",
         data:{query:query},
         success:function(data)
                 {
         $('#CustomerList').fadeIn();
        $('#CustomerList').html(data);
                        }
                     });
                          }
                     });
        
         $('#CustomerName').focusout(function(){
                    $('#CustomerList').fadeOut();
         });
        
        
        
     $(document).on('click', '.customer', function(){
         $('#CustomerName').val($(this).text());
         $('#CustomerList').fadeOut();
         
  
         
     
  var email = document.getElementById('CustomerName').value
  var xmlhttp_visits = new XMLHttpRequest();
  xmlhttp_visits.open("GET","actions/invoice/customer_visits.php?status=visits&email="+email,false);
  xmlhttp_visits.send();
  document.getElementById("cusVisits").innerHTML=xmlhttp_visits.responseText;
       
  
         
   var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("GET","actions/invoice/customer_lastvisit.php?status=cusLastvisit&email="+email,false);
  xmlhttp.send();
  document.getElementById("cusLastVisit").innerHTML=xmlhttp.responseText;

         
         
   var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("GET","actions/invoice/customer_points.php?status=cusPointsBalance&email="+email,false);
  xmlhttp.send();
  document.getElementById("cusTotalPoints").placeholder=xmlhttp.responseText;
         document.getElementById("cusTotalPointsFinal").placeholder=xmlhttp.responseText;
         
         
         
         
         
         

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("GET","actions/invoice/customer_name.php?status=cusName&email="+email,false);
  xmlhttp.send();
  document.getElementById("cusName").innerHTML=xmlhttp.responseText;
         
         
          var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("GET","actions/invoice/customer_mobile.php?status=cusMobile&email="+email,false);
  xmlhttp.send();
  document.getElementById("cusNumber").innerHTML=xmlhttp.responseText;
      


      




                     });
                });
                function fadeout(){
                 $('#CustomerList').fadeout();
                }


