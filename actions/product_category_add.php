<?php

if(isset($_POST['productCategory'])){

  $productCategory = $_POST['product_category'];

  require "dbconnection.php";

  $stmt = $dbCon->prepare("INSERT INTO op_product_category(CATEGORY_NAME) VALUES(?)");
  $stmt->bind_param("s",$productCategory);

  if($stmt->execute() == true){
  $stmt->close();
  $dbCon->close();
  header('Location: ../products.php?ProductCategoryAdded');



}

}



 ?>
