<?php

$status = $_GET['status'];
$customer_email = $_GET['email'];

require "../dbconnection.php";
$find_customer_sql = "SELECT * FROM op_customers WHERE EMAIL='".$customer_email."'";
$find_customer_query = mysqli_query($dbCon,$find_customer_sql);
$customer = mysqli_fetch_array($find_customer_query);





if($status = 'cusMobile'){
    
    $customer_id = $customer['CUSTOMER_ID'];
    
    $fetch_points_sql = "select * from op_customer_points WHERE CUSTOMER_ID='".$customer_id."'";
    $fetch_points_query = mysqli_query($dbCon,$fetch_points_sql);
    $pointsBalance = mysqli_fetch_array($fetch_points_query);
    
    echo $pointsBalance['CUSTOMER_POINTS'];
    
    
}




?>