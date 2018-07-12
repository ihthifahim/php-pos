<?php




if(isset($_POST['submit'])){
    $supid = $_POST['supid'];
    $supplierName = $_POST['SupplierName'];
    $contactName = $_POST['ContactName'];
    $email = $_POST['Email'];
    $mobile = $_POST['Mobile'];
    $shipping = $_POST['Address'];
    $datetime = date("Y-m-d H:i:s");
    //$userid = 1;

    require "dbconnection.php";
    $sql = "UPDATE op_suppliers SET SUPPLIER_NAME = '".$supplierName."'
    ,CONTACT_NAME = '".$contactName."',EMAIL='".$email."'
    ,MOBILE='".$mobile."',ADDRESS='".$shipping."'
    ,DATE_MODIFIED = '".$datetime."' WHERE SUPPLIER_ID='".$supid."'";

    if ($dbCon->query($sql) === TRUE) {

     header("Location: ../supplier-view.php?supid=$supid&SupplierUpdated");

   } else {
     header('Location: ../customers.php?CustomerFailed');
   }

}


?>
