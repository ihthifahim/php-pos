<?php



$status = $_GET['status'];
$customer_email = $_GET['email'];



require "../dbconnection.php";
$find_customer_sql = "SELECT * FROM op_customers WHERE EMAIL='".$customer_email."'";
$find_customer_query = mysqli_query($dbCon,$find_customer_sql);
$customer = mysqli_fetch_array($find_customer_query);



if($status = 'visits'){
    
    require "../dbconnection.php";
    
$sql = "select COUNT(CUSTOMER_ID) as NumberofVisits from op_invoice_main where CUSTOMER_ID = '".$customer['CUSTOMER_ID']."'";
    
$data = mysqli_query($dbCon,$sql);




while($record = mysqli_fetch_array($data)){

echo $record['NumberofVisits'];

}
    
}







?>