<?php


if($customer_email == ""){
    $customer_id = 0;
} else {
    $get_customer_id_sql = "select CUSTOMER_ID from op_customers WHERE EMAIL = '".$customer_email."'";
      $get_customer_id_query = mysqli_query($dbCon,$get_customer_id_sql);
      $customer_id_data = mysqli_fetch_array($get_customer_id_query);
      $customer_id = $customer_id_data['CUSTOMER_ID'];
}

if($cash == ""){
    $cash = 0;
}

if($card == ""){
    $card = 0;
}

if($shopboxID == ""){
    $shopboxID = 0;
}

if($waybillID == ""){
    $waybillID = 0;
}

if($redeem_points == ""){
    $redeem_points = 0;
}

if($total_discount == ""){
    $total_discount = 0;
}




?>