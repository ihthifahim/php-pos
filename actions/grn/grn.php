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
    $grn_datetime = date("Y-m-d h:i:s");

    $cash = $_POST['cash'];
    $card = $_POST['card'];



    if($cash == ""){
      $cash = 0;
    }

    if($card == ""){
      $card = 0;
    }

    //tmp grn sale adding to grn_detail table

    $tmpgrn_sql = "select * from op_tmp_grn where GRN_NUMBER='".$grn_number."'";
    $tmpgrn_query = mysqli_query($dbCon,$tmpgrn_sql);

    while($tmpgrn_data = mysqli_fetch_array($tmpgrn_query)){
      $findproductID_sql = "select PRODUCT_ID from op_products where PRODUCT_DESC = '".$tmpgrn_data['PRODUCT_DESC']."'";
      $findproductID_query = mysqli_query($dbCon,$findproductID_sql);
      $findproductID_data = mysqli_fetch_array($findproductID_query);

      $insert_tmp_sql = "INSERT INTO op_grn_details (GRN_NUMBER,PRODUCT_DESC,PRODUCT_ID,QUANTITY,COST_PRICE,LINE_TOTAL) VALUES ('".$tmpgrn_data['GRN_NUMBER']."','".$tmpgrn_data['PRODUCT_DESC']."','".$findproductID_data['PRODUCT_ID']."','".$tmpgrn_data['QUANTITY']."','".$tmpgrn_data['COST_PRICE']."','".$tmpgrn_data['LINE_TOTAL']."')";
      $insert_tmp_query  = mysqli_query($dbCon,$insert_tmp_sql);

      $get_stock_value  = "select STOCK_VALUE from op_product_stock WHERE PRODUCT_ID = '".$findproductID_data['PRODUCT_ID']."'";
      $get_stock_query = mysqli_query($dbCon,$get_stock_value);
      $get_stock_data = mysqli_fetch_array($get_stock_query);

      $new_stock = $get_stock_data['STOCK_VALUE'] + $tmpgrn_data['QUANTITY'];

      $insert_new_stock = "UPDATE op_product_stock SET STOCK_VALUE='".$new_stock."',DATE_MODIFIED='".$grn_datetime."' WHERE PRODUCT_ID='".$findproductID_data['PRODUCT_ID']."'";
      $insert_new_stock_query = mysqli_query($dbCon,$insert_new_stock);
      echo mysqli_error($dbCon);


    }

    $truncate_tmpgrnSale_sql = "TRUNCATE op_tmp_grn";
    $truncate_tmpgrn_query = mysqli_query($dbCon,$truncate_tmpgrnSale_sql);


    $getTotal_grndetails_sql = "select SUM(LINE_TOTAL) as GRN_TOTAL from op_grn_details WHERE GRN_NUMBER='".$grn_number."'";
    $getTotal_query = mysqli_query($dbCon,$getTotal_grndetails_sql);
    $getTotal_data = mysqli_fetch_array($getTotal_query);

    $insert_grnmain_sql = "INSERT INTO op_grn (GRN_NUMBER,GRN_DATE,GRN_TOTAL,SUPPLIER_ID,PAYMENT_STATUS,PAYMENT_METHOD,USER_ID,DATE_CREATED,TOTAL_CARD,TOTAL_CASH,DATE_MODIFIED) VALUES ('".$grn_number."','".$grnDate."','".$getTotal_data['GRN_TOTAL']."','".$supplier_name."','".$paymentStatus."','".$paymentMethod."','".$user_id."','".$grn_datetime."','".$card."','".$cash."','".$grn_datetime."')";
    $insert_grnmain_query = mysqli_query($dbCon,$insert_grnmain_sql);

    if($insert_grnmain_query == TRUE){

      $insert_grn_comments_sql = "insert into op_grn_comments (GRN_NUMBER,COMMENT,USER_ID,DATE_CREATED) VALUES ('".$grn_number."','".$remarks."','".$user_id."','".$grn_datetime."')";
      $insert_grn_query = mysqli_query($dbCon,$insert_grn_comments_sql);

      header("Location: ../../final_grn.php?grn=".$grn_number."");
      unset($_SESSION["GRNNumber"]);
      exit();



    } else {
      echo mysqli_error($dbCon);
    }





}


?>
