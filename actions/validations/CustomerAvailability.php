<?php
//Artworks of Scanhead   HNU 2017
include('../dbconnection.php'); // call db.class.php

if(isset($_GET["query"]))
{

$q = $_GET["query"];

$sql = "SELECT * FROM op_customers WHERE EMAIL LIKE '%" . $q . "%' LIMIT 1";


} else {

 $sql = "SELECT * FROM op_customers LIMIT 1";


}




$data = mysqli_query($dbCon,$sql);

  while($record = mysqli_fetch_array($data))
  {
    echo "<div class='callout callout-danger'>";
          echo "<h5><strong>Customer already exists!</strong></h5>";
    echo "<p>Customer email already exists</p>";
          echo "</div>";

  }




?>
