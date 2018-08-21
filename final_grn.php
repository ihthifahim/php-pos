<?php
include 'actions/dbconnection.php';
$grn_number = $_GET['grn'];

$grn_details_sql = "select * from op_grn WHERE GRN_NUMBER='".$grn_number."'";
$grn_details_query = mysqli_query($dbCon,$grn_details_sql);
$grn_details_data = mysqli_fetch_array($grn_details_query);

//get grn user
$grn_user_sql = "select FIRSTNAME from op_users WHERE USER_ID='".$grn_details_data['USER_ID']."'";
$grn_user_query = mysqli_query ($dbCon,$grn_user_sql);
$grn_user_data = mysqli_fetch_array($grn_user_query);



$title = $grn_details_data['GRN_NUMBER']." | GRN";
include 'template/header.php';
include 'template/top_navbar.php';
include 'template/main_navbar.php';





?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->






       <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Goods Receive Note</h1>
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
                    <small class="float-right">Date: <?php echo $grn_details_data['GRN_DATE']; ?></small>
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


<?php
//Supplier Details
$get_supplier_sql = "select * from op_suppliers WHERE SUPPLIER_ID='".$grn_details_data['SUPPLIER_ID']."'";
$get_supplier_query = mysqli_query($dbCon,$get_supplier_sql);
$get_supplier_data = mysqli_fetch_array($get_supplier_query);

 ?>




                <div class="col-sm-4 invoice-col">
                  Supplier Name
                  <address>
                    <strong><?php echo $get_supplier_data['SUPPLIER_NAME']; ?></strong><br>
                    Phone: <?php echo $get_supplier_data['MOBILE']; ?><br>
                    Email: <?php echo $get_supplier_data['EMAIL']; ?>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Invoice <?php echo $grn_details_data['GRN_NUMBER']; ?></b><br>
                  <br>

                    <b>GRN User:</b> <?php echo $grn_user_data['FIRSTNAME']; ?><br>

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

                        $get_grn_details_sql = "select * from op_grn_details WHERE GRN_NUMBER='".$grn_number."'";
                        $get_grn_details_query = mysqli_query($dbCon,$get_grn_details_sql);


                        while($get_grn_data = mysqli_fetch_array($get_grn_details_query)){

                            echo "<tr>";
                            echo "<td>".$get_grn_data['PRODUCT_DESC']."</td>";
                            echo "<td>".$get_grn_data['QUANTITY']."</td>";
                            echo "<td>".number_format($get_grn_data['COST_PRICE'],2)."</td>";
                            echo "<td>".number_format($get_grn_data['LINE_TOTAL'],2)."</td>";
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
                  <p class="lead">Payment Methods: <strong><?php echo $grn_details_data['PAYMENT_METHOD']; ?></strong></p>




                </div>
                <!-- /.col -->
                <div class="col-6">
                  <p class="lead">Payment Status: <strong><?php echo $grn_details_data['PAYMENT_STATUS']; ?></strong></p>

                  <div class="table-responsive">
                    <table class="table">



                      <tr>
                        <th>Total:</th>
                        <td><?php echo number_format($grn_details_data['GRN_TOTAL'],2); ?></td>
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
                  <a href="invoice-print.html" target="_blank" class="btn btn-navy"><i class="fa fa-print"></i> Mail Invoice</a>

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
