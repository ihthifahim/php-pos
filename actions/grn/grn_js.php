<?php
session_start();
require "../dbconnection.php";
$status = $_GET['status'];


if($status == 'grnNumber'){
    
    if(isset($_SESSION["GRNNumber"])){
         echo $_SESSION["GRNNumber"];
         
    
        
    } else {
        //$sqlLastID = "select MAX(INVOICE_ID) as lastid from op_invoice_main";
    //$queryLastID = mysqli_query($dbCon,$sqlLastID);
    //$LastIDfetch = mysqli_fetch_array($queryLastID);
    
    $grn = "GRN";
    
    //$newNumber = 10000 + $LastIDfetch['lastid'] + 1; 
    $newNumber = substr(md5(rand()), 0, 3);
    $grnNumber = $grn."-".$newNumber;
    //echo $invoiceNumber;
    $_SESSION["GRNNumber"] = $grnNumber ;
    echo $_SESSION["GRNNumber"];
    
    }

  

}




if($status == 'add'){

$pdesc = $_GET['pdesc'];
$qty = $_GET['qty'];
$grn = $_GET['grn'];


$sqluPrice = "select * from op_products WHERE PRODUCT_DESC='".$pdesc."'";
$datauPrice = mysqli_query($dbCon,$sqluPrice);
while($recorduPrice = mysqli_fetch_array($datauPrice)){

$linetotal = $recorduPrice['COST_PRICE'] * $qty;

  $sql = "INSERT INTO op_tmp_grn (GRN_NUMBER,PRODUCT_DESC,QUANTITY,COST_PRICE,LINE_TOTAL) VALUES ('".$grn."','".$pdesc."','".$qty."','".$recorduPrice['COST_PRICE'] ."','".$linetotal."')";
  $data = mysqli_query($dbCon,$sql);

}

}





if($status == 'disp'){
    $grn = $_GET['grn'];

require "../dbconnection.php";
$sql = "select * from op_tmp_grn WHERE GRN_NUMBER='".$grn."'";
$data = mysqli_query($dbCon,$sql);


while($record = mysqli_fetch_array($data)){
echo "<tr>";
echo "<td>".$record['PRODUCT_DESC']."</td>";
echo "<td>".$record['QUANTITY']."</td>";
//echo "<td>".$record['DISCOUNT']."</td>";
echo "<td>".number_format($record['COST_PRICE'],2)."</td>";
echo "<td>".number_format($record['LINE_TOTAL'],2)."</td>";
echo "</tr>";

}

}


if($status == 'subtotal'){
    $grn = $_GET['grnNumber'];
    
    $fetch_linetotal_sql = "select SUM(LINE_TOTAL) as subtotal from op_tmp_grn WHERE GRN_NUMBER='".$grn."'";
    
    $fetch_linetotal_query = mysqli_query($dbCon,$fetch_linetotal_sql);
    $subtotal_fetch = mysqli_fetch_array($fetch_linetotal_query);
    
    echo number_format($subtotal_fetch['subtotal'],2);
    
    
    
    
}





?>