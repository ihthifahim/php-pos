<?php




if(isset($_POST['submit'])){

    $supplierName = $_POST['SupplierName'];
    $contactName = $_POST['ContactName'];
    $email = $_POST['Email'];
    $mobile = $_POST['Mobile'];
    $address = $_POST['Address'];
    $datetime = date("Y-m-d H:i:s");

      require "dbconnection.php";

      $stmt = $dbCon->prepare("INSERT INTO op_suppliers(SUPPLIER_NAME,CONTACT_NAME,EMAIL,MOBILE,ADDRESS,DATE_CREATED,DATE_MODIFIED) VALUES(?,?,?,?,?,?,?)");
      $stmt->bind_param("sssssss",$supplierName,$contactName,$email,$mobile,$address,$datetime,$datetime);
      //$stmt->execute();

if($stmt->execute() == true){
$stmt->close();
$dbCon->close();
header('Location: ../suppliers.php?SupplierAdded');

}



}


?>
