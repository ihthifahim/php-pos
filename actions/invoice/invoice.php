<?php
session_start();
date_default_timezone_set("Asia/Colombo");




if(isset($_POST['submitPayment'])){
    include "../dbconnection.php";
    $user_id = $_SESSION['user_id'];
    $invoice_number = $_SESSION['InvoiceNumber'];
    $customer_email = $_POST['CustomerEmail'];
    $total_discount = $_POST['totaldiscount'];
    $payment_method = $_POST['paymentMethod'];
    $payment_status = $_POST['paymentStatus'];
    $redeem_points = $_POST['redeempoints'];
    $remarks = $_POST['remarks'];
    $invoice_date = date("Y-m-d");
    $invoice_datetime = date("Y-m-d h:i:s");
    $invoice_user = $_SESSION['user_firstname'];
    
    $cash = $_POST['cash'];
    $card = $_POST['card'];
    $shopboxID = $_POST['shopboxID'];
    $waybillID = $_POST['waybillID'];

    
    include "invoice_validation.php";
    
    
    //tmp sale adding to invoice_detail table
    
    $tmpsale_sql = "select * from op_tmp_sale WHERE INVOICE_NUMBER='".$invoice_number."'";
    $tmpsale_query = mysqli_query($dbCon,$tmpsale_sql);
    

    
    while($tmpsale_data = mysqli_fetch_array($tmpsale_query)){
        $tmpsale_productid_sql = "SELECT PRODUCT_ID,PRODUCT_DESC from op_products WHERE PRODUCT_DESC ='".$tmpsale_data['PRODUCT_DESC']."'";
        $tmpsale_productid_query = mysqli_query($dbCon,$tmpsale_productid_sql);
        
        while($tmpsale_productid_data = mysqli_fetch_array($tmpsale_productid_query)){
            
            if($tmpsale_data['DISCOUNT'] == ""){
                $discount = 0;
            } 
            
                    
            $insert_tmpsale_sql = "INSERT INTO op_invoice_detail (INVOICE_NUMBER,PRODUCT_DESC,PRODUCT_ID,QUANTITY,UNIT_PRICE,LINE_PROFIT,LINE_TOTAL)
            VALUES ('".$tmpsale_data['INVOICE_NUMBER']."','".$tmpsale_productid_data['PRODUCT_DESC']."','".$tmpsale_productid_data['PRODUCT_ID']."','".$tmpsale_data['QUANTITY']."','".$tmpsale_data['UNIT_PRICE']."','".$tmpsale_data['LINE_PROFIT']."','".$tmpsale_data['LINE_TOTAL']."')";
            
            if(mysqli_query($dbCon,$insert_tmpsale_sql) != TRUE){
            
                header("Location: ../../sale.php?error='".mysqli_error($dbCon)."'");
            
            }
            
        }  
        
    } // end of tmp sale adding to invoice_detail table
    
    
    
    
    //ADD INVOICE TO OP_INVOICE_MAIN TABLE
    
    //get number of products for the invoice
   

    
    $invoice_main_sql = "select SUM(LINE_PROFIT) as TOTAL_PROFIT,SUM(LINE_TOTAL) as TOTAL from op_invoice_detail where INVOICE_NUMBER='".$invoice_number."'";
    $invoice_main_query = mysqli_query($dbCon,$invoice_main_sql);
    $invoice_main_data = mysqli_fetch_array($invoice_main_query);
    
    
    $final_profit = $invoice_main_data['TOTAL_PROFIT'] - $total_discount;
    $final_total = $invoice_main_data['TOTAL'] - $total_discount ;
    $total_points_earned = $invoice_main_data['TOTAL']*1/100;
    
    $invoice_sql = "INSERT INTO op_invoice_main (INVOICE_NUMBER,INVOICE_DATE,USER_ID,PAYMENT_METHOD,PAYMENT_STATUS,INVOICE_TOTAL,INVOICE_SUBTOTAL,INVOICE_PROFIT,INVOICE_TOTAL_DISCOUNTS,REDEEMED_POINTS,EARNED_POINTS,CUSTOMER_ID,WAYBILL_ID,SHOPBOX_ID,TOTAL_CASH,TOTAL_CARD,DATE_CREATED,DATE_MODIFIED) VALUES('".$invoice_number."','".$invoice_date."','".$user_id."','".$payment_method."','".$payment_status."','".$final_total."','".$invoice_main_data['TOTAL']."','".$final_profit."','".$total_discount."','".$redeem_points."','".$total_points_earned."','".$customer_id."','".$waybillID."','".$shopboxID."','".$cash."','".$card."','".$invoice_datetime."','".$invoice_datetime."')";
    $invoice_sql_query = mysqli_query($dbCon,$invoice_sql);
    
    
    if($invoice_sql_query == TRUE){
        
        
        if($remarks != ""){
            $invoice_remarks_sql = "insert into op_invoice_comments (INVOICE_NUMBER,COMMENT,USER_ID,DATE_CREATED) VALUES ('".$invoice_number."','".$remarks."','".$user_id."','".$invoice_datetime."')";
        mysqli_query($dbCon,$invoice_remarks_sql);            
        }
        
        
        $get_prod_qty_sql = "SELECT * FROM op_invoice_detail where INVOICE_NUMBER='".$invoice_number."'";
        $get_prod_qty_query = mysqli_query($dbCon,$get_prod_qty_sql);
        
        while($get_prod_qty_data = mysqli_fetch_array($get_prod_qty_query)){
           
            $check_manage_status = "select MANAGE_STOCK from op_products WHERE PRODUCT_ID='".$get_prod_qty_data['PRODUCT_ID']."'";
            $check_manage_status_query = mysqli_query($dbCon,$check_manage_status);
            $check_manage_data = mysqli_fetch_array($check_manage_status_query);
            
            if($check_manage_data['MANAGE_STOCK'] == 1){
                
                $get_stock_sql = "SELECT * from op_product_stock WHERE PRODUCT_ID='".$get_prod_qty_data['PRODUCT_ID']."'";
                $get_stock_query = mysqli_query($dbCon,$get_stock_sql);
                $get_stock_data = mysqli_fetch_array($get_stock_query);
                
                $new_stock_value = $get_stock_data['STOCK_VALUE'] - $get_prod_qty_data['QUANTITY'];
                
                $add_new_stock_sql = "UPDATE op_product_stock SET STOCK_VALUE='".$new_stock_value."',DATE_MODIFIED='".$invoice_datetime."' WHERE PRODUCT_ID='".$get_prod_qty_data['PRODUCT_ID']."'";
                $add_new_stock_query = mysqli_query($dbCon,$add_new_stock_sql);
                
            }
            
        }
        
        
        $get_cusid_invoice_sql = "SELECT * from op_invoice_main WHERE INVOICE_NUMBER='".$invoice_number."'";
        $get_cusid_invoice_query = mysqli_query($dbCon,$get_cusid_invoice_sql);
        $get_cusid_invoice_data = mysqli_fetch_array($get_cusid_invoice_query);
        
        if($get_cusid_invoice_data['CUSTOMER_ID'] == 0){
            
        } else {
            
            $get_current_points_sql = "select * from op_customer_points WHERE CUSTOMER_ID='".$get_cusid_invoice_data['CUSTOMER_ID']."'";
        $get_current_points_query = mysqli_query($dbCon,$get_current_points_sql);
        $get_current_points_data = mysqli_fetch_array($get_current_points_query);
        
        $new_points_value = $get_current_points_data['CUSTOMER_POINTS'] + $get_cusid_invoice_data['EARNED_POINTS'];
        
        $add_points_sql = "UPDATE op_customer_points set CUSTOMER_POINTS='".$new_points_value."' WHERE CUSTOMER_ID='".$get_cusid_invoice_data['CUSTOMER_ID']."'";
        $add_points_query = mysqli_query($dbCon,$add_points_sql);
            
        }
        
       if($redeem_points != ""){
            $get_current_points_sql = "select * from op_customer_points WHERE CUSTOMER_ID='".$get_cusid_invoice_data['CUSTOMER_ID']."'";
        $get_current_points_query = mysqli_query($dbCon,$get_current_points_sql);
        $get_current_points_data = mysqli_fetch_array($get_current_points_query);
           
             $minus_points_value = $get_current_points_data['CUSTOMER_POINTS'] - $redeem_points;
           
           $add_newredeempoints_sql = "UPDATE op_customer_points set CUSTOMER_POINTS='".$minus_points_value."' WHERE CUSTOMER_ID='".$get_cusid_invoice_data['CUSTOMER_ID']."'";
           
           $add_newredeempoints_query = mysqli_query($dbCon,$add_newredeempoints_sql);
           
       }
    
      
        header("Location: ../../final-invoice.php?InvoiceNumber=".$invoice_number.""); 
        unset($_SESSION['InvoiceNumber']);
        exit();
    
        
    } else {
        echo mysqli_error($dbCon);
    }
    
    
    
    
    
    
    
    //END OF INVOICE TO OP_INVOICE_MAIN_TABLE
    
    
    
    
    
    
    
    
    
    
} else {
 header("location: ../../dashboard.php");   
    
}// end of submit payment




?>