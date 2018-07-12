<?php
//Artworks of Scanhead   HNU 2017
include('../dbconnection.php'); // call db.class.php

if(isset($_POST["productCategory"]))
{

$q = $_POST["productCategory"];

$sql = "SELECT * FROM op_product_category WHERE CATEGORY_NAME LIKE '%" . $q . "%' LIMIT 1";


} else {

 $sql = "SELECT * FROM op_product_category LIMIT 1";


}




$data = mysqli_query($dbCon,$sql);

  while($record = mysqli_fetch_array($data))
  {
          echo "<div class='alert alert-warning alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>";
          echo "<h5><i class='icon fa fa-warning'></i> <strong>Alert!</strong></h5>Product Desctiption already exists!</div>";

  }




?>
