<?php
include 'template/header.php';
include 'template/top_navbar.php';
include 'template/main_navbar.php';




$customer_id = $_GET['cusid'];



//$view_points = $customers->get_points($customer_id);
//$customer_points = mysqli_fetch_array($view_points);

//$total_sales = $customers->count_sales($customer_id);
//$customer_sales = mysqli_fetch_array($total_sales);

//$total_profit = $customers->count_profit($customer_id);
//$customer_profit = mysqli_fetch_array($total_profit);

include('actions/dbconnection.php');

$find_customer_sql = "select * from op_customers where CUSTOMER_ID='".$customer_id."'";
$find_customer_query = mysqli_query($dbCon,$find_customer_sql);
$customer = mysqli_fetch_array($find_customer_query);

$view_points_sql = "select * from op_customer_points WHERE CUSTOMER_ID='".$customer_id."'";
$view_points_query = mysqli_query($dbCon,$view_points_sql);
$customer_points = mysqli_fetch_array($view_points_query);

$total_sales_sql = "select SUM(INVOICE_TOTAL) as totalsales from op_invoice_main WHERE CUSTOMER_ID='".$customer_id."'";
$total_sales_query = mysqli_query($dbCon,$total_sales_sql);
$customer_sales = mysqli_fetch_array($total_sales_query);

$total_profit_sql = "select SUM(INVOICE_PROFIT) as totalprofit from op_invoice_main WHERE CUSTOMER_ID='".$customer_id."'";
$total_profit_query = mysqli_query($dbCon,$total_profit_sql);
$customer_profit = mysqli_fetch_array($total_profit_query);



?>

<?php include "template/notifications.php"; ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Customer Report</h1>
          </div><!-- /.col -->



        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">






<div class="row">

<div class="col-md-3">


<div class="card card-primary card-outline">
  <div class="card-body box-profile">
    <div class="text-center">

    </div>

<input type="hidden" id="cusemail" value="<?php echo $customer['EMAIL']; ?>" />
                  <script>

          $(document).ready(function(){

  var email = document.getElementById('cusemail').value;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("GET","actions/invoice/customer_lastvisit.php?status=cusLastvisit&email="+email,false);
  xmlhttp.send();
  document.getElementById("cusLastVisit").innerHTML=xmlhttp.responseText;


          });



      </script>



      <h3 class="profile-username text-center"><strong><?php echo "".$customer['FIRSTNAME']." ".$customer['LASTNAME'].""; ?></strong></h3>



      <p class="text-muted text-center">Last visited :

          <?php


          ?>
          <span id="cusLastVisit"></span></p>




    <ul class="list-group list-group-unbordered mb-3">
      <li class="list-group-item">
        <b>Total Points</b> <a class="float-right"><?php echo $customer_points['CUSTOMER_POINTS']; ?></a>
      </li>
      <?php
        if($_SESSION['user_level'] == 1){
          ?>

      <li class="list-group-item">
        <b>Total Sales</b> <a class="float-right"><?php  echo number_format($customer_sales['totalsales'],2); ?></a>
      </li>
      <li class="list-group-item">
        <b>Total Profit</b> <a class="float-right"><?php echo number_format($customer_profit['totalprofit'],2)  ?></a>
      </li>

    <?php } ?>
    </ul>


  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->

<!-- About Me Box -->
<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">Customer Details</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <strong><i class="fa fa-book mr-1"></i> Mobile Number</strong>

    <p class="text-muted">
     <?php echo $customer['MOBILE_NUMBER']; ?>
    </p>

    <hr>

    <strong><i class="fa fa-map-marker mr-1"></i> Email Address</strong>

    <p class="text-muted"><?php echo $customer['EMAIL']; ?></p>

    <hr>

    <strong><i class="fa fa-pencil mr-1"></i> Shipping Address</strong>

   <p class="text-muted"><?php echo $customer['DELIVERY_ADDRESS']; ?></p>

    <hr>

    <a href="customer-edit.php?cusid=<?php echo $customer['CUSTOMER_ID']; ?>" class="btn btn-primary btn-block"><b>Edit details</b></a>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->
</div>













<div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active show" href="#invoices" data-toggle="tab">Invoices</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active show" id="invoices">

<div class="row">
<div class="col-md-8"> <h3>Invoices</h3></div>
<div class="col-md-4">

<div class="input-group input-group-sm pull-right">
                  <input type="text" class="form-control" placeholder="Search by Invoice Number">
                  <span class="input-group-append">
                    <button type="button" class="btn btn-info btn-flat">Go!</button>
                  </span>
                </div>

</div>


</div>



                <table class="table table-hover">
                  <tbody><tr>
                    <th>Invoice Number</th>
                    <th>Points Redeemed</th>
                    <th>Invoice Total</th>
                    <th>Invoice User</th>
                    <th>Payment Method</th>
                    <th>Payment Status</th>
                    <th>Actions</th>


                  </tr>

<?php

//$view_invoices = $customers->get_customer_invoices($customer_id);
$view_invocies_sql = "select * from op_invoice_main WHERE CUSTOMER_ID='".$customer_id."'";
$view_invoices_query = mysqli_query($dbCon,$view_invocies_sql);

while($customer_invoices = mysqli_fetch_array($view_invoices_query)){

    $view_user_sql = "select * from op_users WHERE USER_ID='".$customer_invoices['USER_ID']."'";
    $view_user_query = mysqli_query($dbCon,$view_user_sql);
    $user = mysqli_fetch_array($view_user_query);


echo "<tr>";
  echo "<td>".$customer_invoices['INVOICE_NUMBER']."</td>";
  echo "<td>".$customer_invoices['REDEEMED_POINTS']."</td>";
  echo "<td>".number_format($customer_invoices['INVOICE_TOTAL'],2)."</td>";
  echo "<td>".$user['FIRSTNAME']."</td>";
  echo "<td>".$customer_invoices['PAYMENT_METHOD']."</td>";

        if($customer_invoices['PAYMENT_STATUS'] == "Paid"){
           echo "<td><span class='badge bg-success'>".$customer_invoices['PAYMENT_STATUS']."</span></td>";
      } else {
          echo "<td><span class='badge bg-danger'>".$customer_invoices['PAYMENT_STATUS']."</span></td>";
      }




  echo "<td><a href=final-invoice.php?InvoiceNumber=".$customer_invoices['INVOICE_NUMBER']."><span class='fa fa-edit'></span></a></td>";
  echo "</tr>";


}


 ?>










                </tbody></table>




                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">

                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">

                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>














</div><!-- end of div main row -->

<br/>


      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



 <?php include 'template/footer.php';  ?>
