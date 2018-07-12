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


$(document).ready(function getInvoiceNumber(){
    
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("GET","actions/grn/grn_js.php?status=grnNumber",false);
  xmlhttp.send(null);


  document.getElementById("GRN_NUMBER").value =  xmlhttp.responseText;
//disp_tmpsale();
  //  disp_subtotal()

});



function insGRN(){
  var pdesc=document.getElementById('ProductName').value;
  var qty=document.getElementById('qty').value;
  var grnNumber = document.getElementById("GRN_NUMBER").value;
    
  


  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("GET","actions/grn/grn_js.php?pdesc="+pdesc+"&qty="+qty+"&grn="+grnNumber+"&status=add",false);
  xmlhttp.send(null);

disp_tmpsale();
  disp_subtotal();
  


  document.getElementById('ProductName').value="";
  document.getElementById('qty').value = "";
  document.getElementById("ProductName").focus();

}





  function disp_tmpsale(){
      var grnNumber = document.getElementById("GRN_NUMBER").value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET","actions/grn/grn_js.php?&grn="+grnNumber+"&status=disp",false);
    xmlhttp.send(null);
    document.getElementById("grnTable").innerHTML=xmlhttp.responseText;


  }

function disp_subtotal(){
          var grnNumber = document.getElementById("GRN_NUMBER").value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET","actions/grn/grn_js.php?&grnNumber="+grnNumber+"&status=subtotal",false);
    xmlhttp.send(null);
    
    document.getElementById("subtotal").innerHTML=xmlhttp.responseText;
    document.getElementById("final_total").innerHTML=xmlhttp.responseText;


    
}

