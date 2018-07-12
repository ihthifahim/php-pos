<?php
//Artworks of Scanhead   HNU 2017
include('../dbconnection.php'); // call db.class.php

if(isset($_GET["query"]))
{

$q = $_GET["query"];

$sql = "SELECT * FROM op_customers WHERE CUSTOMER_ID LIKE '%" . $q . "%' OR FIRSTNAME LIKE '%".$q."%'
OR LASTNAME LIKE '%".$q."%'
OR EMAIL LIKE '%".$q."%'
OR MOBILE_NUMBER LIKE '%".$q."%'
";


} else {

 $sql = "SELECT * FROM op_customers ";

}


$data = mysqli_query($dbCon,$sql);
if(mysqli_num_rows($data) > 0){



  while($record = mysqli_fetch_array($data))
  {
    echo "<tr>";
    echo "<td>".$record['CUSTOMER_ID']."</td>";
    echo "<td> <a href=customer-view.php?cusid=".$record['CUSTOMER_ID'].">".$record['FIRSTNAME']." ".$record['LASTNAME']."</a></td>";
    echo "<td>".$record['EMAIL']."</td>";
    echo "<td>".$record['MOBILE_NUMBER']."</td>";
    echo "<td><a href=customer-view.php?cusid=".$record['CUSTOMER_ID']."><span class='fa fa-edit'></span></a> </td>";
  }



} else {

  //echo "No records found";

  echo "<tr>";
  echo "<td colspan=6 align=center> <strong><h4>No Customers found</h4></strong> </td>";
  echo "</tr>";

}

?>
