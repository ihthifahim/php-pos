<?php



$status = $_GET['status'];
$customer_email = $_GET['email'];

require "../dbconnection.php";
$find_customer_sql = "SELECT * FROM op_customers WHERE EMAIL='".$customer_email."'";
$find_customer_query = mysqli_query($dbCon,$find_customer_sql);
$customer = mysqli_fetch_array($find_customer_query);





if($status = 'cusMobile'){
    
    echo $customer['MOBILE_NUMBER'];
    
    
}




?>