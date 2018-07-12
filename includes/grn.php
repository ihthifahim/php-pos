<?php


require_once("database.php");

class grn{

 public function supplier_grn($supplier_id){
   global $database;
   $result_set = $database->query("SELECT * FROM op_grn WHERE SUPPLIER_ID='".$supplier_id."'");
       return $result_set;

 }


}

$grn = new grn();




 ?>
