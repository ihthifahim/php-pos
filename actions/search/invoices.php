<?php
//Artworks of Scanhead   HNU 2017
include('../dbconnection.php'); // call db.class.php

if(isset($_GET["query"]))
{

$q = $_GET["query"];

$sql = "SELECT * FROM op_invoice_main WHERE INVOICE_NUMBER LIKE '%" . $q . "%' OR INVOICE_DATE LIKE '%".$q."%'
OR PAYMENT_STATUS LIKE '%".$q."%'
ORDER BY INVOICE_ID DESC
";


} else {

 $sql = "SELECT * FROM op_invoice_main ORDER BY INVOICE_ID DESC";

}


$data = mysqli_query($dbCon,$sql);
if(mysqli_num_rows($data) > 0){



  while($record = mysqli_fetch_array($data))
  {
      $find_user_sql = "select FIRSTNAME from op_users WHERE USER_ID='".$record['USER_ID']."'";
      $find_user_query = mysqli_query($dbCon,$find_user_sql);
      $find_user_data = mysqli_fetch_array($find_user_query);
      
      $find_customer_sql = "select EMAIL from op_customers WHERE CUSTOMER_ID='".$record['CUSTOMER_ID']."'";
      $find_customer_query = mysqli_query($dbCon,$find_customer_sql);
      $find_customer_data = mysqli_fetch_array($find_customer_query);
      
      
    echo "<tr>";
    echo "<td>".$record['INVOICE_NUMBER']."</td>";
    echo "<td>".$record['INVOICE_DATE']."</td>";
    echo "<td>".$find_customer_data['EMAIL']."</td>";
    echo "<td>".number_format($record['INVOICE_TOTAL'],2)."</td>";
      echo "<td>".$find_user_data["FIRSTNAME"]."</td>";
    echo "<td>".$record['PAYMENT_METHOD']."</td>";
      
      if($record['PAYMENT_STATUS'] == "Paid"){
           echo "<td><span class='badge bg-success'>".$record['PAYMENT_STATUS']."</span></td>";
      } else {
          echo "<td><span class='badge bg-danger'>".$record['PAYMENT_STATUS']."</span></td>";
      }
      
     
      
      
      
      echo "<td><a href=final-invoice.php?InvoiceNumber=".$record['INVOICE_NUMBER']."><span class='fa fa-edit'></span></a></td>";
      echo "</tr>";
  }


 
    
    

} else {

  //echo "No records found";

  echo "<tr>";
  echo "<td colspan=6 align=center> <strong><h4>No Invoices found</h4></strong> </td>";
  echo "</tr>";

}

?>
