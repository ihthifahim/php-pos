<?php 
session_start();
date_default_timezone_set("Asia/Colombo");
include "../dbconnection.php";

if(isset($_POST['saveGRN'])){
    $user_id = $_SESSION['user_id'];
    $grn_number = $_SESSION['GRNNumber'];
    $supplier_name = $_POST['supplierName'];
    $grnDate = date("Y-m-d");
    $paymentMethod = $_POST['paymentMethod'];
    $paymentStatus = $_POST['paymentStatus'];
    $remarks = $_POST['remarks'];

    $cash = $_POST['cash'];
    $card = $_POST['card'];
    
    
    //tmp grn sale adding to grn_detail table

    $tmpgrn_sql = "select * from op_tmp_grn where GRN_NUMBER='".$grn_number."'";
    $tmpgrn_query = mysqli_query($dbCon,$tmpgrn_sql);
    $tmpgrn_data = mysqli_fetch_array($tmpgrn_query);

    


}


?>