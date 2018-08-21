<?php
$title = "Edit Supplier";
include 'template/header.php';
include 'template/top_navbar.php';
include 'template/main_navbar.php';



$supplier_id = $_GET['supid'];

include('actions/dbconnection.php');

$find_supplier_sql = "select * from op_suppliers WHERE SUPPLIER_ID='".$supplier_id."'";
$supplier_query = mysqli_query($dbCon,$find_supplier_sql);
$supplier = mysqli_fetch_array($supplier_query);

?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Update Suppliers</h1>
          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">


<div class="row">

<div class="col-md-7">
<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Supplier Details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="actions/supplier_edit.php">
                <div class="card-body">
                  <div class="form-group">
                    <label>Supplier Name</label>
                    <input type="text" class="form-control" name="SupplierName" value="<?php echo $supplier['SUPPLIER_NAME'] ?>">
                    <input type="hidden" name="supid" value="<?php echo $supplier['SUPPLIER_ID']; ?>">
                  </div>
                  <div class="form-group">
                    <label>Contact Name</label>
                    <input type="text" class="form-control" name="ContactName" value="<?php echo $supplier['CONTACT_NAME'] ?>">
                  </div>
                  <div class="form-group">
                    <label>Email Address</label>
                    <input type="text" class="form-control" name="Email" value="<?php echo $supplier['EMAIL'] ?>">
                  </div>
                  <div class="form-group">
                    <label>Mobile Number</label>
                    <input type="text" class="form-control" name="Mobile" value="<?php echo $supplier['MOBILE'] ?>">
                  </div>
                  <div class="form-group">
                    <label>Address</label>
                    <input type="text" class="form-control" name="Address" value="<?php echo $supplier['ADDRESS'] ?>">
                  </div>


                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="submit">Update Supplier</button>
                  <a href="suppliers.php"><button type="button" class="btn btn-default">Back</button></a>
                  <button type="button" class="btn btn-danger pull-right" data-toggle="modal" data-target="#DeleteSupplier"><i class="fa fa-trash-o"></i></button>
                </div>
              </form>
            </div>





                                 <!-- Modal -->
                        <div id="DeleteSupplier" class="modal fade" role="dialog">
                          <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">

                                <div class="modal-body">


                        <h2 class="text-center">Are you sure you want delete this Supplier?</h2>



                                </div>


                        <form action="actions/supplier_delete.php" method="post">
                              <div class="modal-footer">
                                <input type="hidden" value="<?php echo $_GET['supid'] ?>" name="supid" />
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">No</button>
                                  <button type="submit" class="btn btn-navy" name="delete" >YES</button>
                              </div>
                            </div>
                        </form>
                          </div>
                        </div>
                                <!-- end of modal -->







</div>



<div class="col-md-5">

<div class="callout callout-danger">
                  <h5><strong>Supplier already exists!</strong></h5>

                  <p>Supplier Name already exists</p>
                </div>

</div>




</div><!-- end of div row -->



      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



 <?php include 'template/footer.php';  ?>
