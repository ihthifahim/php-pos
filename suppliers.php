<?php
$title = "Suppliers";
include 'template/header.php';
include 'template/top_navbar.php';
include 'template/main_navbar.php';


  require "actions/dbconnection.php";
$sqlCount = "select COUNT(SUPPLIER_ID) as count from op_suppliers";
$dataCount = mysqli_query($dbCon,$sqlCount);
$count = mysqli_fetch_array($dataCount);



?>

<?php include "template/notifications.php"; ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Suppliers</h1>
          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">


      <div class="row">
      <div class="col-md-4"><div class="input-group input-group-sm">
                  <input type="text" class="form-control" placeholder="Search by Supplier Name" id="search_text">
                  <span class="input-group-append">
                    <button type="button" class="btn btn-info btn-flat">Go!</button>
                  </span>
                </div>
                      </div>

            <div class="col-md-3"><p><strong>Total Number of Suppliers Registered : </strong><span class="badge bg-primary"><?php echo $count['count'];  ?></span></p></div>
      <div class="col-md-5">
      <a href="supplier-add.php"><button type="button" class="pull-right btn btn-block btn-primary btn-flat col-md-3">     Add Supplier</button></a>
      </div>

      </div>
      <br/>

      <div class="row">
          <div class="col-12">
            <div class="card">

              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead><tr>
                    <th>Supplier ID</th>
                    <th>Supplier Name</th>
                    <th>Contact Name</th>
                    <th>Mobile Number</th>
                      <th>Email</th>
                    <th>Actions</th>
                  </tr>
                </thead>

                <script>

                $(document).ready(function(){

                 load_data();

                 function load_data(query)
                 {
                  $.ajax({
                   url:"actions/validations/fetchSuppliers.php?query",
                   method:"GET",
                   data:{query:query},
                   success:function(data)
                   {
                    $('#result').html(data);
                   }
                  });
                 }


                 $('#search_text').keyup(function(){
                  var search = $(this).val();
                  if(search != '')
                  {
                   load_data(search);
                  }
                  else
                  {
                   load_data();
                  }
                 });
                });


                </script>

<tbody id="result"></tbody>











                </tbody></table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>




      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



 <?php include 'template/footer.php';  ?>
