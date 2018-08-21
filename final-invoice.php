<?php


include 'actions/dbconnection.php';
//Get Invoice Details
$invoice_number = $_GET["InvoiceNumber"];
$get_invoice_sql = "select * from op_invoice_main WHERE INVOICE_NUMBER='".$invoice_number."'";
$get_invoice_query = mysqli_query($dbCon,$get_invoice_sql);
$invoice_data = mysqli_fetch_array($get_invoice_query);

if($invoice_data['CUSTOMER_ID'] == 0){
    $customer = "Walk-in Customer";
    $customer_mobile = "";
    $customer_email = "";
} else {
    $get_customer_sql = "select * from op_customers WHERE CUSTOMER_ID='".$invoice_data['CUSTOMER_ID']."'";
$get_customer_query = mysqli_query($dbCon,$get_customer_sql);
$customer_data = mysqli_fetch_array($get_customer_query);

    $customer = $customer_data['FIRSTNAME']." ".$customer_data['LASTNAME'];
    $customer_mobile = $customer_data['MOBILE_NUMBER'];
    $customer_email = $customer_data['EMAIL'];

}




$get_invoice_detail_sql = "select * from op_invoice_detail WHERE INVOICE_NUMBER='".$invoice_number."'";
$get_invoice_detail_query = mysqli_query($dbCon,$get_invoice_detail_sql);


















$title = $invoice_data['INVOICE_NUMBER']." | Invoice";

include 'template/header.php';
include 'template/top_navbar.php';
include 'template/main_navbar.php';




?>
<?php include "template/notifications.php"; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->






       <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Invoice</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Invoice</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">



            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fa fa-globe"></i> Fitness Island Store
                    <small class="float-right">Date: <?php echo $invoice_data['INVOICE_DATE']; ?></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  From
                  <address>
                    <strong>Fitness Island Store</strong><br>
                   29/9 Stratford Avenue,<br>
                    Colombo 06, Sri Lanka<br>
                    Phone: +94 77 6676 720<br>
                    Email: info@fitnessisland.lk
                  </address>
                </div>
                <!-- /.col -->







                <div class="col-sm-4 invoice-col">
                  To
                  <address>
                    <strong><?php echo $customer; ?></strong><br>
                    Phone: <?php echo $customer_mobile; ?><br>
                    Email: <?php echo $customer_email; ?>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Invoice <?php echo $invoice_data['INVOICE_NUMBER']; ?></b><br>
                  <br>

                    <?php

                    if($invoice_data['SHOPBOX_ID'] == "0"){
                        $shopboxID = "N/A";
                    } else {
                        $shopboxID = $invoice_data['SHOPBOX_ID'];
                    }

                    if($invoice_data['WAYBILL_ID'] == "0"){
                        $waybillID = "N/A";
                    } else {
                        $waybillID = $invoice_data['WAYBILL_ID'];
                    }


                    $find_user_sql = "select * from op_users WHERE USER_ID='".$invoice_data['USER_ID']."'";
                    $find_user_query = mysqli_query($dbCon,$find_user_sql);
                    $user_data = mysqli_fetch_array($find_user_query);
                    ?>

                  <b>Order ID:</b> <?php echo $shopboxID; ?><br>
                  <b>Waybill ID:</b> <?php echo $waybillID; ?><br>
                    <b>Invoice User:</b> <?php echo $user_data['FIRSTNAME']; ?><br>

                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-hover">
                    <thead>
                    <tr>
                      <th>Product Description</th>
                      <th>Quantity</th>
                      <th>Unit Price</th>
                      <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                   <?php

                        while($invoice_detail_data = mysqli_fetch_array($get_invoice_detail_query)){
                            $find_product_sql = "select PRODUCT_DESC from op_products WHERE PRODUCT_DESC='".$invoice_detail_data['PRODUCT_DESC']."'";
                            $find_product_query = mysqli_query($dbCon,$find_product_sql);
                            $product_desc = mysqli_fetch_array($find_product_query);

                            echo "<tr>";
                            echo "<td>".$product_desc['PRODUCT_DESC']."</td>";
                            echo "<td>".$invoice_detail_data['QUANTITY']."</td>";
                            echo "<td>".number_format($invoice_detail_data['UNIT_PRICE'],2)."</td>";
                            echo "<td>".number_format($invoice_detail_data['LINE_TOTAL'],2)."</td>";
                            echo "</tr>";

                        }


                        ?>

                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">Payment Methods: <strong><?php echo $invoice_data['PAYMENT_METHOD']; ?></strong></p>

                  <p class="text-success"><strong>Points Earned : <?php echo $invoice_data['EARNED_POINTS']; ?></strong></p>


                </div>
                <!-- /.col -->
                <div class="col-6">
                  <p class="lead">Payment Status: <strong><?php echo $invoice_data['PAYMENT_STATUS']; ?></strong></p>

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Subtotal:</th>
                        <td><?php echo number_format($invoice_data['INVOICE_SUBTOTAL'],2); ?></td>
                      </tr>
                      <tr>
                        <th>Discount</th>
                        <td><?php echo $invoice_data['INVOICE_TOTAL_DISCOUNTS']; ?></td>
                      </tr>
                      <tr>
                        <th>Points Redeemed</th>
                        <td><?php echo $invoice_data['REDEEMED_POINTS']; ?></td>
                      </tr>
                      <tr>
                        <th>Total:</th>
                        <td><?php echo number_format($invoice_data['INVOICE_TOTAL'],2); ?></td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <form method="post" action="actions/mailInvoice.php">
                    <input type="hidden" name="invoiceNumber" value="<?php echo $invoice_number; ?>">
                  <button type="submit" name="mailInvoice" class="btn btn-navy"><i class="fa fa-print"></i> Mail Invoice</button>
                </form>

                  <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#myModal"><i class="fa fa-credit-card"></i> Update
                    Payment
                  </button>
                      <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#Comments" style="margin-right: 5px;">
                    <i class="fa fa-download"></i> Comments
                  </button>

                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->












              <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Process Payment</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>

      </div>

        <div class="modal-body">


<form action="actions/invoice/update_status.php" method="post">
<input type="hidden" name="invoiceNumber" value="<?php echo $invoice_number; ?>" />

    <?php

    $get_payment_status_sql = "select PAYMENT_STATUS from op_invoice_main where INVOICE_NUMBER='".$invoice_number."'";
    $get_payment_status_query = mysqli_query($dbCon,$get_payment_status_sql);

    ?>


             <div class="row">

                    <label class="col-md-6">Payment Status</label>


                    <select class="form-control form-control-sm col-md-6" name="paymentStatus">

                        <?php
                        $payment_status = mysqli_fetch_array($get_payment_status_query);
                            ?>

                        <option value="Paid" <?php if($payment_status['PAYMENT_STATUS']=="Paid") echo "selected=\"selected\""; ?>><?php echo "Paid"; ?></option>
                        <option value="Pending" <?php if($payment_status['PAYMENT_STATUS']=="Pending") echo "selected=\"selected\""; ?>><?php echo "Pending"; ?></option>


                    </select>



                  </div>
<br/>



            <div class="row">

                <div class="form-group col-md-12">
                    <label>Remarks</label>
                    <textarea class="form-control" rows="3" name="remarks"></textarea>
                  </div>


            </div>


      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-navy" name="updatePayment">UPDATE PAYMENT</button>
      </div>
    </div>

  </div>
</div>
        <!-- end of modal -->


      </form>



      </div>



  </div>
  <!-- /.content-wrapper -->













              <!-- Modal -->
<div id="Comments" class="modal fade" role="dialog">
  <div class="modal-dialog large_modal">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Invoice Comments</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>

      </div>

        <div class="modal-body">
<div class="container">
            <div class="row">
            <div class="col-md-12">
                 <form action="actions/invoice/update_status.php" method="post">
                 <input type="text" name="comment" placeholder="Enter new Invoice Comment" autocomplete="off" class="form-control"><br/>

                <table class="table table-bordered">
                  <tbody>
                <tr>
                    <th>Comment</th>
                    <th>User</th>
                    <th>Date</th>
                  </tr>

                      <?php


                $view_comments_sql ="select * from op_invoice_comments WHERE INVOICE_NUMBER='".$invoice_number."'";
                $view_comments_query = mysqli_query($dbCon,$view_comments_sql);

                      while($invoice_comments = mysqli_fetch_array($view_comments_query)){
                          $find_user_comments_sql = "select FIRSTNAME from op_users WHERE USER_ID='".$invoice_comments['USER_ID']."'";
                          $find_user_query = mysqli_query($dbCon,$find_user_comments_sql);
                          $user_firstname = mysqli_fetch_array($find_user_query);

                          echo "<tr>";
                          echo "<td>".$invoice_comments['COMMENT']."</td>";
                          echo "<td>".$user_firstname['FIRSTNAME']."</td>";
                          echo "<td>".$invoice_comments['DATE_CREATED']."</td>";
                          echo "</tr>";


                      }


                      ?>






                </tbody></table>

                </div>


            </div>
            </div>


      <div class="modal-footer">


<input type="hidden" name="invoiceNumber" value="<?php echo $invoice_number;?>">
                   <button type="button" class="btn btn-default pull-left" style="margin-right:5px;" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-navy" name="AddComment">ADD COMMENT</button>





              </form>
      </div>
    </div>

  </div>
</div>
</div>
        <!-- end of modal -->













<script>

$(document).ready(function() {

  if(window.location.href.indexOf('#Comments') != -1) {
    $('#Comments').modal('show');
  }

});


</script>














 <?php include 'template/footer.php';  ?>
