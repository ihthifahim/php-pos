<?php

if(isset($_POST['delete'])){

$supplier_id = $_POST['supid'];


require "dbconnection.php";
$sql = "DELETE FROM op_suppliers WHERE SUPPLIER_ID='".$supplier_id."'";
if($dbCon->query($sql) == TRUE){

      header('location: ../suppliers.php?SupplierDeleted');
  } else {
    header('location: ../suppliers.php?SupplierDeleteFailed');
  }



}


 ?>
