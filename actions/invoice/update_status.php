<?php
session_start();
date_default_timezone_set("Asia/Colombo");
require "../dbconnection.php";


if(isset($_POST['updatePayment'])){
    $paymentStatus = $_POST['paymentStatus'];
    $remarks = $_POST['remarks'];
    $invoiceNumber = $_POST['invoiceNumber'];
    $updateDate = date("Y-m-d h:i:s");
    
    $updatePaymentStatus_sql = "update op_invoice_main set PAYMENT_STATUS='".$paymentStatus."',DATE_MODIFIED='".$updateDate."' WHERE INVOICE_NUMBER='".$invoiceNumber."'";
    $updatePaymentQuery = mysqli_query($dbCon,$updatePaymentStatus_sql);
    
    if($remarks == ""){
         header("Location: ../../final-invoice.php?InvoiceNumber=".$invoiceNumber."");
    } else {
        
        $addRemarks = "insert into op_invoice_comments (INVOICE_NUMBER,COMMENT,DATE_CREATED,USER_ID) VALUES ('".$invoiceNumber."','".$remarks."','".$updateDate."','".$_SESSION['user_id']."')";
        
        $addRemarks_query = mysqli_query($dbCon,$addRemarks);
        
        if($addRemarks_query == TRUE){
            header("Location: ../../final-invoice.php?InvoiceNumber=".$invoiceNumber."");
        }
        
    }
    
}




if(isset($_POST['AddComment'])){
    $invoiceNumber = $_POST['invoiceNumber'];
    $comment = $_POST['comment'];
    $updateDate = date("Y-m-d h:i:s");
    $user_id = $_SESSION['user_id'];
    
    $insert_comment_sql = "insert into op_invoice_comments (INVOICE_NUMBER,COMMENT,USER_ID,DATE_CREATED) VALUES('".$invoiceNumber."','".$comment."','".$user_id."','".$updateDate."')";
    
    $invoice_comment_query = mysqli_query($dbCon,$insert_comment_sql);
    
    if($invoice_comment_query == TRUE){
        header("Location: ../../final-invoice.php?InvoiceNumber=".$invoiceNumber."#Comments");
    }
}



?>