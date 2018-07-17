<?php
require "dbconnection.php";


if(isset($_POST['mailInvoice'])){
 $invoice_number =  $_POST['invoiceNumber'];


$find_invoice_detail_sql = "select * from op_invoice_main WHERE INVOICE_NUMBER='".$invoice_number."'";
$find_invoice_detail_query = mysqli_query($dbCon,$find_invoice_detail_sql);
$invoice_detail_data = mysqli_fetch_array($find_invoice_detail_query);

$find_customer_sql = "SELECT * FROM op_customers where CUSTOMER_ID = '".$invoice_detail_data['CUSTOMER_ID']."'";
$find_customer_query = mysqli_query($dbCon,$find_customer_sql);
$customer_data = mysqli_fetch_array($find_customer_query);

$find_points_sql = "select * from op_customer_points WHERE CUSTOMER_ID='".$invoice_detail_data['CUSTOMER_ID']."'";
$find_points_query = mysqli_query($dbCon,$find_points_sql);
$points_data = mysqli_fetch_array($find_points_query);




$to = $customer_data['EMAIL'] ;




$subject = "Thank you for your purchase at FITNESSISLAND";

$message = "

<html>
<body>
Dear ".$customer_data['FIRSTNAME'] .' '. $customer_data['LASTNAME'].",

<br/><br/>

Great Purchase! Following is your order summary
<br/><br/>

<table width=300 cellspacing=0>
  <tr>
    <td height=29 bgcolor=#CCCCCC > Billing Information</td>
  </tr>
  <tr>
    <td><br/>".$customer_data['FIRSTNAME'] .' '. $customer_data['LASTNAME']."</td>
  </tr>
  <tr>
    <td height=25>".$customer_data['EMAIL']."</td>
  </tr>
  <tr>
    <td height=29>".$customer_data['MOBILE_NUMBER']."</td>
  </tr>
</table>

<br/>
<strong><h3>Invoice Number : ".$invoice_number." <br/>


Invoice Date : ".$invoice_detail_data['INVOICE_DATE']."</h3></strong><br/>
<table width=732 border=1 cellpadding=5 cellspacing=0>
  <tr>
    <th width=228 align=center valign=middle>Product Description</th>
    <th width=77 align=center valign=middle>Quantity</th>
    <th width=113 align=center valign=middle>Unit Price</th>
    <th width=108 align=center valign=middle>Discount</th>
    <th width=117 align=center valign=middle>Line Total</th>
  </tr>


";
$sql = "select * from op_invoice_detail WHERE INVOICE_NUMBER='".$invoice_number."'";
$data = mysqli_query($dbCon,$sql);


while($record = mysqli_fetch_array($data)){

$message .=  '<tr>';
$message .=  '<td>'.$record['PRODUCT_DESC'].'</td>';
$message .= '<td>'.$record['QUANTITY']. '</td>';
$message .=  '<td>'.$record['UNIT_PRICE'].'</td>';
$message .=  '<td>'.$record['DISCOUNT'].'</td>';
$message .=  '<td>'.$record['LINE_TOTAL'].'</td>';
$message .=   '</tr>';

}



$message .= "  <tr>
    <td>&nbsp;</td>
    <td align=center>&nbsp;</td>
    <td align=center>&nbsp;</td>
    <td align=center>&nbsp;</td>
    <td align=center>&nbsp;</td>
  </tr>
    <tr>

  <td colspan=4 align=right>Subtotal</td>
    <td align=center>".number_format($invoice_detail_data['INVOICE_SUBTOTAL'],2)."</td>
  </tr>
    <tr>
    <td colspan=4 align=right>Total Discount</td>
    <td align=center>".number_format($invoice_detail_data['INVOICE_TOTAL_DISCOUNTS'],2)."</td>
  </tr>
      <tr>
    <td colspan=4 align=right>Points Redeemed</td>
    <td align=center>".number_format($invoice_detail_data['REDEEMED_POINTS'],2)."</td>
  </tr>
       <tr>
    <td colspan=4 align=right><strong>Bill Total</strong></td>
    <td align=center><strong>".number_format($invoice_detail_data['INVOICE_TOTAL'],2)."</strong></td>
  </tr>
</table>

<h3>Points Earned : ".$invoice_detail_data['EARNED_POINTS']."</h3>

<h2>Total Loyalty Points Earned : ".$points_data['CUSTOMER_POINTS']."</h2>

<br/><br/><br/>

We hope that you are very happy with your purchase!<br/>
For any queries regarding your order, please contact us on info@fitnessisland.lk.<br/>
Thanks for shopping with Fitness Island and we do hope to see you shopping with us again!<br/>

<br/>
Thank you,<br/>
Team Fitness Island<br/>

<br/><br/><br/>

Powered by <a href=http://octagensolutions.com/>Octapay</a>




</body>

</html>

";




// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: info@fitnessisland.lk' . "\r\n";
$headers .= 'Cc: ihthishaam@octagensolutions.com , store@fitnessisland.lk' . "\r\n";



if(mail($to,$subject,$message,$headers) == true){

  header('location: ../final-invoice.php?InvoiceNumber='.$invoice_number.'&mail=true');

}

else{

  echo 'ERROR';
}


}

 ?>
