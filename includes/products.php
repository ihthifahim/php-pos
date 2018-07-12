<?php

require_once("database.php");


class Products {


  public function find_product($product_id){
      global $database;
  $result_set = $database->query("SELECT * FROM op_products WHERE PRODUCT_ID='".$product_id."'");
      return $result_set;

  }

  public function find_product_description($product_desc){
      global $database;
  $result_set = $database->query("SELECT * FROM op_products WHERE PRODUCT_DESC='".$product_desc."'");
      return $result_set;

  }

  public function find_product_category($category_id){
    global $database;
$result_set = $database->query("SELECT * FROM op_product_category WHERE CATEGORY_ID='".$category_id."'");
    return $result_set;
  }

  public function all_product_category(){
    global $database;
    $result_set = $database->query("SELECT * FROM op_product_category");
    return $result_set;
  }


  public function find_product_stock($product_id){
    global $database;
$result_set = $database->query("SELECT * FROM op_product_stock WHERE PRODUCT_ID='".$product_id."'");
    return $result_set;
  }




}

$products = new Products();


 ?>
