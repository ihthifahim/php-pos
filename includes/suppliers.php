<?php

require_once("database.php");


class Suppliers {


  public function find_supplier($supplier_id){
    global $database;
$result_set = $database->query("SELECT * FROM op_suppliers WHERE SUPPLIER_ID='".$supplier_id."'");
    return $result_set;
  }


  public function all_suppliers(){
    global $database;
    $result_set = $database->query("SELECT * FROM op_suppliers");
    return $result_set;
    
  }




}

$suppliers = new Suppliers();


 ?>
