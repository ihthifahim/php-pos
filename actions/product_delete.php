<?php

if(isset($_POST['delete'])){

$product_id = $_POST['prodid'];


require "dbconnection.php";
$sql = "DELETE FROM op_products WHERE PRODUCT_ID='".$product_id."'";
if($dbCon->query($sql) == TRUE){
  $sqlStock = "DELETE FROM op_product_stock WHERE PRODUCT_ID='".$product_id."'";

  if($dbCon->query($sqlStock) == TRUE){
      header('location: ../products.php?ProductDeleted');
  }

} else {
  header('location: ../products.php?ErrorDeletingProduct');
}

}


 ?>
