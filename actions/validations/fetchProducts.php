<?php
session_start();
include('../dbconnection.php');
//include('../../includes/init.php');

if(isset($_GET["query"]))
{

$q = $_GET["query"];
    

$sql = "SELECT * FROM op_products WHERE PRODUCT_DESC LIKE '%" . $q . "%'";


} else {

 $sql = "SELECT * FROM op_products  ";

}


$data = mysqli_query($dbCon,$sql);
if(mysqli_num_rows($data) > 0){

  while($record = mysqli_fetch_array($data))
  {
 
      
    $find_category_sql = "select * from op_product_category WHERE
    CATEGORY_ID = '".$record['CATEGORY_ID']."'";
    $find_category_query = mysqli_query($dbCon,$find_category_sql);
    $find_category_fetch = mysqli_fetch_array($find_category_query);
      
    $find_product_stock_sql = "select * from op_product_stock WHERE
    PRODUCT_ID='".$record['PRODUCT_ID']."'";
    $find_stock_query = mysqli_query($dbCon,$find_product_stock_sql);
    $product_stock_fetch = mysqli_fetch_array($find_stock_query);

if($_SESSION['user_level'] == 1){
    echo "<tr>";
    echo "<td>".$record['PRODUCT_DESC']."</td>";
    echo "<td>".$find_category_fetch['CATEGORY_NAME']."</td>";
    echo "<td>".number_format($record['RETAIL_PRICE'],2)."</td>";
    echo "<td>".number_format($record['COST_PRICE'],2)."</td>";
    if($product_stock_fetch['STOCK_VALUE'] == ""){
      echo "<td>Not Set</td>";
    } else {
      echo "<td>".$product_stock_fetch['STOCK_VALUE']."</td>";
    }

    echo "<td><a href=product-view.php?prodid=".$record['PRODUCT_ID']."><span class='fa fa-edit'></span></a> </td>";
    
} else {
    
    echo "<tr>";
    echo "<td>".$record['PRODUCT_DESC']."</td>";
    echo "<td>".$find_category_fetch['CATEGORY_NAME']."</td>";
    echo "<td>".number_format($record['RETAIL_PRICE'],2)."</td>";
    //echo "<td>".$record['COST_PRICE']."</td>";
    if($product_stock_fetch['STOCK_VALUE'] == ""){
      echo "<td>Not Set</td>";
    } else {
      echo "<td>".$product_stock_fetch['STOCK_VALUE']."</td>";
    }

    //echo "<td><a href=product-view.php?prodid=".$record['PRODUCT_ID']."><span class='fa fa-edit'></span></a> </td>";
}

  
  }


} else {

  //echo "No records found";

  echo "<tr>";
  echo "<td colspan=6 align=center> <strong><h4>No products found</h4></strong> </td>";
  echo "</tr>";

}






?>
