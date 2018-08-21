<?php

$title = "New Sale";

include 'template/header.php';
include 'template/top_navbar.php';
include 'template/main_navbar.php';

?>
<script src="assets/js/invoice.js"></script>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">



      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">




        <div class="row">
            <div class="col-md-8">

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-9"><input class="form-control" type="text" placeholder="Product Description" name="ProductName" id="ProductName" autocomplete="off"></div>

                            <div class="col-md-2"><input class="form-control" type="number" placeholder="Quantity" id="qty"></div>



                            <div class="col-md-1"><button type="button" class="btn btn-block btn-navy btn-flat" onclick="ins()"><i class="fa fa-plus"></i></button></div>

<div id="ProductNameList"></div>


                        </div>
                        <br/>
                            <div class="row">
                            <div class="col-md-12">

                            <div class="card">

              <div class="card-body p-0">
                <table class="table">
                  <thead><tr>
                    <th>Product Description</th>
                    <th>Qty</th>

                    <th>Unit Price</th>
                      <th>Sub Total</th>
                  </tr>
                </thead>
                  <tbody id="SalesTable"></tbody>

                    </table>
              </div>
              <!-- /.card-body -->
            </div>

                            </div>


                        </div>



                    </div>

                </div><!-- end of left card div -->


            </div><!-- end of left div column 8 -->



            <div class="col-md-4">

<button type="button" name="resetInvoice" class="btn btn-block btn-danger btn-flat" onclick="resetInvoice()">RESET INVOICES</button><br/>
                <br/>
                <?php
                  if(!isset($_GET['error'])){

                  } else {
                    echo $_GET['error'];
                  }

                 ?>
<form action="actions/invoice/invoice.php" method="post" autocomplete="off">

                <div class="card">
              <div class="card-header">



              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <div class="row">
                    <label class="col-md-6">Invoice #</label>
                    <input type="text" class="form-control form-control-sm text-right col-md-6" id="invoiceNumber" disabled="">

                  </div>

                  <br/>

                  <div class="row">
                        <label class="col-md-6">Transaction Date</label>
                    <input type="text" class="form-control form-control-sm text-right col-md-6" placeholder="<?php echo date("Y-m-d"); ?>" disabled="">

                  </div>
                  <br/>
                   <div class="row">
                        <label class="col-md-6">Customer Email</label>
                       <div class="input-group input-group-sm col-md-6">
                  <input type="text" class="form-control" placeholder="" id="CustomerName" name="CustomerEmail" autocomplete="new-password">

                           <span class="input-group-append">
                    <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#CustomerDetails">Go!</button>
                  </span>

                  <div id="CustomerList"></div>
                </div>

                   <!-- <input class="form-control form-control-sm col-md-6 text-right" type="text" placeholder=""> -->

                  </div>
                  <br/>

                   <div class="row">
                        <label class="col-md-6">Discount</label>
                  <div class="input-group mb-3 col-md-6 input-group-sm">
                  <input type="text" class="form-control" placeholder="Total bill discount" id="discValue" onfocusout="disp_discountTotal()" name="totaldiscount">
                  <div class="input-group-append">
                    <span class="input-group-text">LKR</span>
                  </div>
                </div>

                  </div>

                   <div class="row">
                        <label class="col-md-6">Total Discount</label>
                 <div class="input-group input-group-sm col-md-6 mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">LKR</span>
                  </div>
                  <input type="text" class="form-control" id="totalDiscount" disabled="" value="0.00" >

                </div>
                  </div>

                    <div class="row">
                        <label class="col-md-6">Sub Total</label>
                 <div class="input-group input-group-sm col-md-6 mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">LKR</span>
                  </div>
                  <input type="text" class="form-control" id="subtotal" disabled="" value="0.00">
                </div>
                  </div>




                  <div class="row">

                    <div class="info-box mb-3 col-md-12">
              <span  class="info-box-icon bg-warning elevation-1 col-md-3"><h1 style="margin-bottom:-10px;">LKR</h1></span>

              <div class="info-box-content">
                <strong><h1 class="text-right text-success" id="total">0.00</h1></strong>
              </div>

            </div>


                  </div>








              </div>
              <!-- /.card-body -->

            </div>






                <button type="button" class="btn btn-block btn-success btn-flat" data-toggle="modal" data-target="#myModal"><h1 style="margin-bottom:-10px;"><strong>PAY</strong></h1></button>






            </div>







        </div>







                      <!-- Modal -->
<div id="CustomerDetails" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Customer Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>

      </div>

        <div class="modal-body">


            <div class="row">
                       <div class="col-md-6">
                       <label class="">Customer Name</label><br/>
                    <span id="cusName"></span>

                       </div>
                        <div class="col-md-6">
                       <label class="">Mobile Number</label><br/>
                            <span id="cusNumber"></span>


                       </div>

                  </div>
            <br/>

            <div class="row">
                       <div class="col-md-6">
                       <label class="">Last Visited</label><br/>
                    <span id="cusLastVisit"></span>

                       </div>
                        <div class="col-md-6">
                            <label class="">No of Visits</label><br/>
                            <span id="cusVisits"></span>


                       </div>

                  </div>
            <br/>
            <div class="row">

                       <label class="col-md-6">Total Points Balance</label>
                   <input type="text" class="form-control col-md-6 form-control-sm" placeholder="" disabled="" id="cusTotalPoints">



                  </div>



        </div>



      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>

      </div>
    </div>

  </div>
</div>
        <!-- end of modal -->





















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







             <div class="row">
                    <label class="col-md-6">Payment Method</label>


                    <select class="form-control form-control-sm col-md-6" onchange="scheduleA.call(this, event)" name="paymentMethod">
                        <option value="none">Please Select</option>
                        <option value="Cash">Cash</option>
                      <option value="Cash & Card">Cash and Card</option>
                      <option value="Card">Card</option>
                      <option value="Aramex">Aramex</option>
                      <option value="Shopbox">Shopbox</option>
                      <option value="Bank Transfer">Bank Transfer</option>
                    </select>



                  </div>
                  <br/>







                  <div class="row" id="Cash" style="display:none;margin-bottom:15px">
                        <label class="col-md-6">Cash</label>
                    <input type="text" class="form-control form-control-sm col-md-6" name="cash" >

                  </div>

             <div class="row" id="Card" style="display:none;margin-bottom:15px">
                 <br/>
                        <label class="col-md-6">Card</label>
                    <input type="text" class="form-control form-control-sm col-md-6"  name="card">

                  </div>


            <div class="row" id="Shopbox" style="display:none;margin-bottom:15px">
                 <br/>
                        <label class="col-md-6">Shopbox ID</label>
                    <input type="text" class="form-control form-control-sm col-md-6"  name="shopboxID">

                  </div>


             <div class="row" id="Aramex" style="display:none;margin-bottom:15px">
                 <br/>
                        <label class="col-md-6">Wabill ID</label>
                    <input type="text" class="form-control form-control-sm col-md-6" name="waybillID">

                  </div>








             <div class="row">

                    <label class="col-md-6">Payment Status</label>


                    <select class="form-control form-control-sm col-md-6" name="paymentStatus">
                        <option value="Paid">Paid</option>
                      <option value="Pending">Pending</option>


                    </select>



                  </div>
           <hr>



                   <div class="row">
                       <div class="col-md-6">
                       <label class="">Points to Redeem</label>
                    <input type="text" class="form-control form-control-sm"   id="redeemPoints" onfocusout="redeem_points_disc();redeem_points();" name="redeempoints">

                       </div>
                        <div class="col-md-6">
                       <label class="">Points available</label>
                    <input type="text" class="form-control form-control-sm" disabled="" id="cusTotalPointsFinal">

                       </div>

                  </div>
           <hr>

            <div class="row">

                <div class="form-group col-md-12">
                    <label>Remarks</label>
                    <textarea class="form-control" rows="3" name="remarks"></textarea>
                  </div>


            </div>



                  <div class="row">


                  <div class="info-box mb-3 col-md-12">
              <span class="info-box-icon bg-warning elevation-1 col-md-3"><h1>LKR</h1></span>

              <div class="info-box-content">
                <strong><h1 class="text-right text-success" id="totalFinal">0.00</h1></strong>
              </div>
              <!-- /.info-box-content -->
            </div>


                  </div>





















        </div>



      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-navy" name="submitPayment">SUBMIT PAYMENT</button>
      </div>
    </div>

  </div>
</div>
        <!-- end of modal -->

            </form>






















      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



 <?php include 'template/footer.php';  ?>
