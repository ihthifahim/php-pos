<?php
//Artworks of Scanhead   HNU 2017
include('../dbconnection.php'); // call db.class.php

if(isset($_GET["query"]))
{

$q = $_GET["query"];

$sql = "SELECT * FROM op_suppliers WHERE SUPPLIER_ID LIKE '%" . $q . "%' OR SUPPLIER_NAME LIKE '%".$q."%'
OR CONTACT_NAME LIKE '%".$q."%'
OR EMAIL LIKE '%".$q."%'
OR MOBILE LIKE '%".$q."%'
";


} else {

 $sql = "SELECT * FROM op_suppliers ";

}


$data = mysqli_query($dbCon,$sql);
if(mysqli_num_rows($data) > 0){


  while($record = mysqli_fetch_array($data))
  {
    echo "<tr>";
    echo "<td>".$record['SUPPLIER_ID']."</td>";
    echo "<td> <a href=supplier-view.php?supid=".$record['SUPPLIER_ID'].">".$record['SUPPLIER_NAME']." ".$record['LASTNAME']."</a></td>";
    echo "<td>".$record['CONTACT_NAME']."</td>";
    echo "<td>".$record['MOBILE']."</td>";
    echo "<td>".$record['EMAIL']."</td>";
    echo "<td><a href=supplier-view.php?supid=".$record['SUPPLIER_ID']."><span class='fa fa-edit'></span></a> </td>";
  }



}else {

  //echo "No records found";

  echo "<tr>";
  echo "<td colspan=6 align=center> <strong><h4>No Suppliers found</h4></strong> </td>";
  echo "</tr>";

}


?>
