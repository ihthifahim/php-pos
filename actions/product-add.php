<?php


//include('../includes/init.php');

if(isset($_POST['submit'])){

    $productDesc = $_POST['productDesc'];
    $productSku = $_POST['supplierCode'];
    $category = $_POST['category'];
    $retailPrice = $_POST['retailPrice'];
    $costPrice = $_POST['costPrice'];
    //$shipping = $_POST['profit'];
    $supplierID = $_POST['supplier'];
    $manageInventory = $_POST['manageInventory'];
    $datetime = date("Y-m-d H:i:s");

      require "dbconnection.php";


if($costPrice > $retailPrice){
  header('Location: ../product-add.php?failedtoadd');
} else {



  if($manageInventory == ''){
    $manageInventory = "";
  }

        $stmt = $dbCon->prepare("INSERT INTO op_products(PRODUCT_DESC,PRODUCT_SKU,CATEGORY_ID,RETAIL_PRICE,COST_PRICE,SUPPLIER_ID,MANAGE_STOCK,DATE_CREATED,DATE_MODIFIED) VALUES(?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssssss",$productDesc,$productSku,$category,$retailPrice,$costPrice,$supplierID,$manageInventory,$datetime,$datetime);
        //$stmt->execute();

  if($stmt->execute() == true){
  $stmt->close();


  if($manageInventory == 1){
    //When Product is added if manageInventory is true
    $last_id = $dbCon->insert_id;
    $sql = "INSERT INTO op_product_stock (PRODUCT_ID,STOCK_VALUE,DATE_MODIFIED) VALUES ('".$last_id."','0','".$datetime."')";

    if ($dbCon->query($sql) === TRUE) {
    $dbCon->close();
    header('Location: ../products.php?ProductAdded');

    } else {

      //When Customer couldnt be added to the points table the customer is deleted
      $sqlRollbackProduct = "DELETE FROM op_products WHERE PRODUCT_ID='".$last_id."'";
      $dbCon->query($sqlRollbackProduct);
      $dbCon->close();
      header('Location: ../products.php?ProductFailedAdd');

    }

  } else {


    $dbCon->close();
      header('Location: ../products.php?ProductAdded');

  }



}//when product statement is truee
else {
  $dbCon->close();
    header('Location: ../products.php?ProductFailedAdd');
}




}



}

?>
