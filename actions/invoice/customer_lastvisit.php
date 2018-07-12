<?php

include('../dbconnection.php');

$status = $_GET['status'];
$customer_email = $_GET['email'];

$get_customer_sql = "select * from op_customers WHERE EMAIL='".$customer_email."'";

$get_customer_query = mysqli_query($dbCon,$get_customer_sql);
$customer = mysqli_fetch_array($get_customer_query);
$customer_id = $customer['CUSTOMER_ID'];




if($status = 'cusLastvisit'){
    
//    $customer_id = $customer['CUSTOMER_ID'];
//    $result_maxID = $invoice->get_max_invoice_id($customer_id);
//    $maxID = mysqli_fetch_array($result_maxID);
    
    $get_maxid_sql = "select MAX(INVOICE_ID) as lastInvoiceID from op_invoice_main where CUSTOMER_ID='".$customer_id."'";
    $get_maxid_query = mysqli_query($dbCon,$get_maxid_sql);
    $maxid = mysqli_fetch_array($get_maxid_query);
    
    $invoice_id = $maxid['lastInvoiceID'];
    
    $get_invoice_sql = "select * from op_invoice_main where INVOICE_ID='".$invoice_id."'";
    
    $get_invoice_query = mysqli_query($dbCon,$get_invoice_sql);
    $invoice_number = mysqli_fetch_array($get_invoice_query);
    
    
    echo $invoice_number['INVOICE_DATE'];
    
    
}




?>