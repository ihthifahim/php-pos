<?php



if(isset($_POST['submit'])){


  $productDesc = $_POST['productDesc'];
  $productSku = $_POST['productSKU'];
  $category = $_POST['category'];
  $retailPrice = $_POST['retailPrice'];
  $costPrice = $_POST['costPrice'];
  //$shipping = $_POST['profit'];
  $supplierID = $_POST['supplier'];

  $datetime = date("Y-m-d H:i:s");
  $product_id = $_POST['productID'];

  if(empty($_POST['manageInventory'])){
    $manageInventory = 0;
  } else {
      $manageInventory = 1;
  }

    require "dbconnection.php";


if($costPrice > $retailPrice){
header("Location: ../product-view.php?prodid=$product_id&PriceError");
} else {





      $stmt = $dbCon->prepare("UPDATE op_products SET PRODUCT_DESC=?,COST_PRICE=?,RETAIL_PRICE=?,CATEGORY_ID=?,SUPPLIER_ID=?,PRODUCT_SKU=?,MANAGE_STOCK=?,DATE_MODIFIED=? WHERE PRODUCT_ID=?");
      $stmt->bind_param("sssssssss",$productDesc,$costPrice,$retailPrice,$category,$supplierID,$productSku,$manageInventory,$datetime,$product_id);
      //$stmt->execute();

if($stmt->execute() == true){
$stmt->close();


if($manageInventory == 1){
  //When Product is added if manageInventory is true

    $sql = "SELECT * FROM op_product_stock where PRODUCT_ID='".$product_id."'";
    $data = mysqli_query($dbCon,$sql);

    if(mysqli_num_rows($data)>0){
          $dbCon->close();
      header("Location: ../product-view.php?prodid=$product_id&ProductUpdated");
    }else {

        $sqlAddStock = "INSERT INTO op_product_stock (PRODUCT_ID,STOCK_VALUE,DATE_MODIFIED) VALUES ('".$product_id."',0,'".$datetime."')";

        if($dbCon->query($sqlAddStock) === TRUE){
              $dbCon->close();
        header("Location: ../product-view.php?prodid=$product_id&ProductUpdated");
        }


    }



  } else {


    $sql = "SELECT * FROM op_product_stock where PRODUCT_ID='".$product_id."'";
    $data = mysqli_query($dbCon,$sql);

    if(mysqli_num_rows($data)<0){
          $dbCon->close();
    header("Location: ../product-view.php?prodid=$product_id&ProductUpdated");
    }else {

        $sqlAddStock = "DELETE FROM op_product_stock WHERE PRODUCT_ID='".$product_id."'";

        if($dbCon->query($sqlAddStock) === TRUE){
              $dbCon->close();
          header("Location: ../product-view.php?prodid=$product_id&ProductUpdated");
        }


    }



  }

}





}



}
















?>
