<?php
//Artworks of Scanhead   HNU 2017
include('../dbconnection.php'); // call db.class.php

if(isset($_GET["query"]))
{

$q = $_GET["query"];
$supid = $_GET['supplier_id'];


$sql = "SELECT * FROM op_grn WHERE SUPPLIER_ID='2' &
OR PAYMENT_STATUS LIKE '%".$q."%'
OR GRN_NUMBER LIKE '%".$q."%'

";


} else {

 $sql = "SELECT * FROM op_grn WHERE SUPPLIER_ID='".$supid."' ";

}


$data = mysqli_query($dbCon,$sql);
if(mysqli_num_rows($data) > 0){


  while($record = mysqli_fetch_array($data))
  {
    echo "<tr>";
    echo "<td>".$record['GRN_NUMBER']."</td>";
    echo "<td>".$record['GRN_DATE']."</td>";
    echo "<td>".$record['GRN_TOTAL']."</td>";
    echo "<td>".$record['USER_ID']."</td>";

    if($record['PAYMENT_STATUS'] == "Pending"){
      echo "<td><span class='badge bg-danger'>Pending</span></td>";
    } else {
      echo "<td><span class='badge bg-danger'>Paid</span></td>";
    }


    echo "<td><span class='fa fa-edit'></span> </td>";
  }



}else {

  //echo "No records found";

  echo "<tr>";
  echo "<td colspan=6 align=center> <strong><h4>No '".$supid."' Suppliers found</h4></strong> </td>";
  echo "</tr>";
  echo $supid;

}


?>
