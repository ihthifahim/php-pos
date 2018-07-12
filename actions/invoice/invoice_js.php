<?php
session_start();
require "../dbconnection.php";
$status = $_GET['status'];

if($status == 'del'){

$prodid = $_GET['prodid'];
$sqlDeleteProduct = "DELETE FROM op_tmp_sale WHERE LINE_ID=".$prodid."";
$data = mysqli_query($dbCon,$sqlDeleteProduct);


}

if($status == 'invoice'){
    
    if(isset($_SESSION["InvoiceNumber"])){
         echo $_SESSION["InvoiceNumber"];
         
    
        
    } else {
        //$sqlLastID = "select MAX(INVOICE_ID) as lastid from op_invoice_main";
    //$queryLastID = mysqli_query($dbCon,$sqlLastID);
    //$LastIDfetch = mysqli_fetch_array($queryLastID);
    
    $invoicedate = date("Ymd");
    
    //$newNumber = 10000 + $LastIDfetch['lastid'] + 1; 
    $newNumber = substr(md5(rand()), 0, 3);
    $invoiceNumber = $invoicedate."-".$newNumber;
    //echo $invoiceNumber;
    $_SESSION["InvoiceNumber"] = $invoiceNumber ;
    echo $_SESSION["InvoiceNumber"];
    
    }

  

}



if($status == 'add'){
require "../dbconnection.php";
$pdesc = $_GET['pdesc'];
$qty = $_GET['qty'];
$inv = $_GET['inv'];




$sqluPrice = "select * from op_products WHERE PRODUCT_DESC='".$pdesc."'";
$datauPrice = mysqli_query($dbCon,$sqluPrice);
while($recorduPrice = mysqli_fetch_array($datauPrice)){

$linetotal = $recorduPrice['RETAIL_PRICE'] * $qty;
    $costprice_total = $recorduPrice['COST_PRICE'] * $qty;
    
$lineprofit = $linetotal - $costprice_total;



  $sql = "INSERT INTO op_tmp_sale (INVOICE_NUMBER,PRODUCT_DESC,QUANTITY,UNIT_PRICE,LINE_TOTAL,LINE_PROFIT) VALUES ('".$inv."','".$pdesc."','".$qty."','".$recorduPrice['RETAIL_PRICE'] ."','".$linetotal."','".$lineprofit."')";
  $data = mysqli_query($dbCon,$sql);

}

}



if($status == 'subtotal'){
    $inv = $_GET['inv'];
    
    $fetch_linetotal_sql = "select SUM(LINE_TOTAL) as subtotal from op_tmp_sale WHERE INVOICE_NUMBER='".$inv."'";
    
    $fetch_linetotal_query = mysqli_query($dbCon,$fetch_linetotal_sql);
    $subtotal_fetch = mysqli_fetch_array($fetch_linetotal_query);
    
    echo number_format($subtotal_fetch['subtotal'],2);
    
    
    
    
}

if($status == 'disc'){
    $discountValue = $_GET['discountValue'];
    $inv = $_GET['inv'];
    

    
     $fetch_linetotal_sql = "select SUM(LINE_TOTAL) as subtotal from op_tmp_sale WHERE INVOICE_NUMBER='".$inv."'";
    
    $fetch_linetotal_query = mysqli_query($dbCon,$fetch_linetotal_sql);
    $subtotal_fetch = mysqli_fetch_array($fetch_linetotal_query);
    
    //$total_afterdiscount =  $subtotal_fetch['subtotal'] - $discountValue;
   
    $a = $subtotal_fetch['subtotal'];
    $b = $discountValue;
    $c = $a - $b;
    echo number_format($c,2);
    
    //$total_afterdiscount =  $subtotal_fetch['subtotal'] - $discountValue;
    
    //echo number_format($total_afterdiscount,2);

    
   
    
}

if($status == 'Nodisc'){
    $discountValue = $_GET['discountValue'];
    $inv = $_GET['inv'];
    

    
     $fetch_linetotal_sql = "select SUM(LINE_TOTAL) as subtotal from op_tmp_sale WHERE INVOICE_NUMBER='".$inv."'";
    
    $fetch_linetotal_query = mysqli_query($dbCon,$fetch_linetotal_sql);
    $subtotal_fetch = mysqli_fetch_array($fetch_linetotal_query);
    
    //$total_afterdiscount =  $subtotal_fetch['subtotal'] - $discountValue;
   
    $a = $subtotal_fetch['subtotal'];
   
    echo number_format($a,2);
    
    //$total_afterdiscount =  $subtotal_fetch['subtotal'] - $discountValue;
    
    //echo number_format($total_afterdiscount,2);

    
   
    
}

if($status == 'pointsredeem'){
    $pointsValue = $_GET['pointsredeem'];
    $customer = $_GET['customer'];
    $inv = $_GET['inv'];
    $discValue = $_GET['discValue'];

    
     $fetch_linetotal_sql = "select SUM(LINE_TOTAL) as subtotal from op_tmp_sale WHERE INVOICE_NUMBER='".$inv."'";
    
    $fetch_linetotal_query = mysqli_query($dbCon,$fetch_linetotal_sql);
    $subtotal_fetch = mysqli_fetch_array($fetch_linetotal_query);
        
       
    $a = $subtotal_fetch['subtotal'];
    $final = $a - $pointsValue - $discValue;
    
    echo number_format($final,2);
    

    
    
   
    
}

if($status == 'Nopointsredeem'){
    $pointsValue = $_GET['pointsredeem'];
    $customer = $_GET['customer'];
    $inv = $_GET['inv'];
    $discValue = $_GET['discValue'];

    
     $fetch_linetotal_sql = "select SUM(LINE_TOTAL) as subtotal from op_tmp_sale WHERE INVOICE_NUMBER='".$inv."'";
    
    $fetch_linetotal_query = mysqli_query($dbCon,$fetch_linetotal_sql);
    $subtotal_fetch = mysqli_fetch_array($fetch_linetotal_query);
    

    if($discValue == ""){
        //$discValue=0;
        $a = $subtotal_fetch['subtotal'];
        echo number_format($a,2);
    } else {
        $a = $subtotal_fetch['subtotal'];
        $b = $discValue;
        $c = $a - $b;
        echo number_format($c,2);
    }
   
    
    
    


    
   
    
}


if($status == 'redeemPointsNoDisc'){
    $pointsValue = $_GET['pointsredeem'];
    $customer = $_GET['customer'];
    $inv = $_GET['inv'];
    //$discValue = $_GET['discValue'];

    
     $fetch_linetotal_sql = "select SUM(LINE_TOTAL) as subtotal from op_tmp_sale WHERE INVOICE_NUMBER='".$inv."'";
    
    $fetch_linetotal_query = mysqli_query($dbCon,$fetch_linetotal_sql);
    $subtotal_fetch = mysqli_fetch_array($fetch_linetotal_query);
    

    $a = $subtotal_fetch['subtotal'];
    $b = $a - $pointsValue;
    echo number_format($b,2);
   
    
    
    


    
   
    
}

if($status == 'reset'){
    $inv = $_GET['inv'];
    
    $delete_sql = "DELETE FROM op_tmp_sale where INVOICE_NUMBER='".$inv."'";
    $delete_query = mysqli_query($dbCon,$delete_sql);
    
    if($delete_query == TRUE){
        unset($_SESSION['InvoiceNumber']);
    }
    
}















 ?>
