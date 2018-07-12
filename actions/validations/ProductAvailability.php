<?php
//Artworks of Scanhead   HNU 2017
include('../dbconnection.php'); // call db.class.php

if(isset($_GET["query"]))
{

$q = $_GET["query"];

$sql = "SELECT * FROM op_products WHERE PRODUCT_DESC LIKE '%" . $q . "%' LIMIT 1";


} else {

 $sql = "SELECT * FROM op_products LIMIT 1";


}




$data = mysqli_query($dbCon,$sql);

  while($record = mysqli_fetch_array($data))
  {
    echo "<div class='callout callout-danger'>";
          echo "<h5><strong>Product already exists!</strong></h5>";
    echo "<p>Product already exists</p>";
          echo "</div>";

  }




?>
