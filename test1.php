<?php
include('includes/init.php');




if($status == 'add'){

$pdesc = $_GET['pdesc'];
$dsc = $_GET['dsc'];



require "dbconnection.php";

$sqluPrice = "select * from op_products WHERE PRODUCT_DESC='".$pdesc."'";
$datauPrice = mysqli_query($dbCon,$sqluPrice);
while($recorduPrice = mysqli_fetch_array($datauPrice)){



  $linetotal = $recorduPrice['RETAIL_PRICE'] * $qty;
 $lineDiscount = $linetotal - $dsc;
 $lineprofit = $recorduPrice['RETAIL_PRICE'] * $qty - $recorduPrice['COST_PRICE'] * $qty - $dsc;



  $sql = "INSERT INTO tmp_sale (INVOICE_NUMBER,PRODUCT_DESC,QUANTITY,UNIT_PRICE,DISCOUNT,SUB_TOTAL,LINE_PROFIT,LINE_TOTAL) VALUES ('0','".$pdesc."','".$qty."','".$dsc."','".$recorduPrice['RETAIL_PRICE'] ."','".$lineDiscount."','".$lineprofit."','".$linetotal."')";
  $data = mysqli_query($dbCon,$sql);

}




}










 ?>
