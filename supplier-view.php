<?php



$supplier_id = $_GET['supid'];



include('actions/dbconnection.php');
$find_supplier_sql = "select * from op_suppliers WHERE SUPPLIER_ID='".$supplier_id."'";
$supplier_query = mysqli_query($dbCon,$find_supplier_sql);
$supplier = mysqli_fetch_array($supplier_query);

$find_grn_sql = "select * from op_grn WHERE SUPPLIER_ID='".$supplier_id."'";
$grn_query = mysqli_query($dbCon,$find_grn_sql);










$title = $supplier['SUPPLIER_NAME']." | View Supplier";
include 'template/header.php';
include 'template/top_navbar.php';
include 'template/main_navbar.php';



?>

<?php include "template/notifications.php"; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Supplier Report</h1>
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

    <h3 class="profile-username text-center"><strong><?php echo $supplier['SUPPLIER_NAME']; ?></strong></h3>

    <p class="text-muted text-center">Last GRN : 21/05/2018</p>

    <ul class="list-group list-group-unbordered mb-3">
      <li class="list-group-item">
        <b>Total Stock Value</b> <a class="float-right">2,878,983.00</a>
      </li>

    </ul>


  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->

<!-- About Me Box -->
<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">Supplier Details</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <strong><i class="fa fa-book mr-1"></i> Mobile Number</strong>

    <p class="text-muted">
     <?php  echo $supplier['MOBILE']; ?>
    </p>

    <hr>

    <strong><i class="fa fa-map-marker mr-1"></i> Email Address</strong>

    <p class="text-muted"><?php echo $supplier['EMAIL'];  ?></p>

    <hr>

    <strong><i class="fa fa-pencil mr-1"></i> Shipping Address</strong>

   <p class="text-muted"><?php echo $supplier['ADDRESS'];  ?></p>

    <hr>

    <a href="supplier-edit.php?supid=<?php echo $supplier['SUPPLIER_ID']; ?>" class="btn btn-primary btn-block"><b>Edit details</b></a>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->
</div>












<div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active show" href="#invoices" data-toggle="tab">GRN</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Products</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active show" id="invoices">

<div class="row">
<div class="col-md-7"> <h3>Goods Recieve Note</h3></div>

<div class="col-md-5">

<div class="input-group input-group-sm pull-right">
                  <input type="hidden" value="<?php echo $supplier['SUPPLIER_ID'];  ?>" id="supid">
                  <input type="text" class="form-control" placeholder="Search by GRN Number">
                  <span class="input-group-append">
                    <button type="button" class="btn btn-info btn-flat">Go!</button>
                  </span>
                </div>

</div>


</div>



                <table class="table table-hover">
                  <thead><tr>
                    <th>GRN Number</th>
                    <th>Date</th>
                    <th>Invoice Total</th>
                      <th>User</th>
                      <th>Payment Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>


                <tbody>

                  <?php
                    while($sup_grn = mysqli_fetch_array($grn_query)){
                      echo "<tr>";
                      echo "<td>".$sup_grn['GRN_NUMBER']."</td>";
                      echo "<td>".$sup_grn['GRN_DATE']."</td>";
                      echo "<td>".$sup_grn['GRN_TOTAL']."</td>";
                      echo "<td>".$sup_grn['USER_ID']."</td>";
                      echo "<td>".$sup_grn['PAYMENT_STATUS']."</td>";
                      echo "<td><a href=final_grn.php?grn=".$sup_grn['GRN_NUMBER']."><span class='fa fa-edit'></span></a></td>";
                      echo "<tr>";
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
