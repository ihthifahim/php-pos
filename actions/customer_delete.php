<?php

if(isset($_POST['delete'])){

$customer_id = $_POST['cusid'];


require "dbconnection.php";
$sql = "DELETE FROM op_customers WHERE CUSTOMER_ID='".$customer_id."'";
if($dbCon->query($sql) == TRUE){
  $sqlStock = "DELETE FROM op_customer_points WHERE CUSTOMER_ID='".$customer_id."'";

  if($dbCon->query($sqlStock) == TRUE){
      header('location: ../customers.php?CustomerDeleted');
  }

} else {
  header('location: ../products.php?ErrorDeletingProduct');
}

}


 ?>
