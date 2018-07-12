<?php
//Artworks of Scanhead   HNU 2017
include('../dbconnection.php'); // call db.class.php

if(isset($_GET["query"]))
{

$q = $_GET["query"];

$sql = "SELECT * FROM op_suppliers WHERE SUPPLIER_NAME LIKE '%" . $q . "%' LIMIT 1";
$data = mysqli_query($dbCon,$sql);

  while($record = mysqli_fetch_array($data))
  {
    echo "<div class='callout callout-danger'>";
          echo "<h5><strong>Supplier already exists!</strong></h5>";
    echo "<p>Supplier Name already exists</p>";
          echo "</div>";

  }


} else {

 //$sql = "SELECT * FROM op_suppliers LIMIT 1";


}









?>
