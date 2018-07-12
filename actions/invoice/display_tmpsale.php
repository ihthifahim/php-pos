<script src="../../assets/js/invoice.js"></script>
<?php
$status=$_GET['status'];
$inv = $_GET['inv'];
session_start();
if($status == 'disp'){

require "../dbconnection.php";
$sql = "select * from op_tmp_sale WHERE INVOICE_NUMBER='".$inv."'";
$data = mysqli_query($dbCon,$sql);


while($record = mysqli_fetch_array($data)){
echo "<tr>";
echo "<td>".$record['PRODUCT_DESC']."</td>";
echo "<td>".$record['QUANTITY']."</td>";
//echo "<td>".$record['DISCOUNT']."</td>";
echo "<td>".number_format($record['UNIT_PRICE'],2)."</td>";
echo "<td>".number_format($record['LINE_TOTAL'],2)."</td>";
echo "</tr>";

}

}




?>
