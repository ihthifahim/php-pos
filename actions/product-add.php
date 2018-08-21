<?php


//include('../includes/init.php');

if(isset($_POST['submit'])){





  require "dbconnection.php";


    $productDesc = mysqli_real_escape_string($dbCon,$_POST['productDesc']);
    $productSku = mysqli_real_escape_string($dbCon,$_POST['supplierCode']);
    $category = mysqli_real_escape_string($dbCon,$_POST['category']);
    $retailPrice = mysqli_real_escape_string($dbCon,$_POST['retailPrice']);
    $costPrice = mysqli_real_escape_string($dbCon,$_POST['costPrice']);
    //$shipping = $_POST['profit'];
    $supplierID = mysqli_real_escape_string($dbCon,$_POST['supplier']);
    $manageInventory = mysqli_real_escape_string($dbCon,$_POST['manageInventory']);
    $datetime = date("Y-m-d H:i:s");

    if($category == "None"){
      $category = 0;
    }

    if($category == ""){
      $category = 0;
    }
    if($supplierID == "None"){
      $supplierID = 0;
    }
    if($supplierID == ""){
      $supplierID = 0;
    }




if($costPrice > $retailPrice){
  header('Location: ../product-add.php?failedtoadd');
} else {



  if($manageInventory == ''){
    $manageInventory = 0;
  }
        $insert_product_sql = "INSERT INTO op_products(PRODUCT_DESC,PRODUCT_SKU,CATEGORY_ID,RETAIL_PRICE,COST_PRICE,SUPPLIER_ID,MANAGE_STOCK,DATE_CREATED,DATE_MODIFIED) VALUES ('".$productDesc."','".$productSku."','".$category."','".$retailPrice."','".$costPrice."','".$supplierID."','".$manageInventory."','".$datetime."','".$datetime."')";
        $insert_product_query = mysqli_query($dbCon,$insert_product_sql);


  if($insert_product_query == true){



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
      //header('Location: ../products.php?ProductFailedAdd');
      echo mysqli_error($dbCon);
    }

  } else {


    $dbCon->close();
      header('Location: ../products.php?ProductAdded');

  }



}//when product statement is truee
else {
  echo mysqli_error($dbCon);
  $dbCon->close();

    //header('Location: ../products.php?ProductFailedAdd');
}




}



}

?>
