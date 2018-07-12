<?php
include 'template/header.php';
include 'template/top_navbar.php';
include 'template/main_navbar.php';


  require "actions/dbconnection.php";
  $sql = "select * from op_customers";
  $data = mysqli_query($dbCon,$sql);


  $sqlCount = "select COUNT(CUSTOMER_ID) as count from op_customers";
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
            <h1 class="m-0 text-dark">Customers</h1>
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
                  <input type="text" class="form-control" placeholder="Search by Customer Name, Email or Mobile Number" id="search_text">
                  <span class="input-group-append">
                    <button type="button" class="btn btn-info btn-flat">Go!</button>
                  </span>
                </div>
                      </div>

            <div class="col-md-3"><p><strong>Total Number of Customers Registered : </strong><span class="badge bg-primary"><?php echo $count['count']; ?></span></p></div>
      <div class="col-md-5">
      <a href="customer-add.php"><button type="button" class="pull-right btn btn-sm btn-block btn-primary btn-flat col-md-4">     Add Customer</button></a>
      </div>

      </div>


      <div class="row">
          <div class="col-12">
            <div class="card" id="CustomerTable">

              <script>

              $(document).ready(function(){


               load_data();

               function load_data(query)
               {
                $.ajax({
                 url:"actions/validations/fetchCustomers.php?query",
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

              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead><tr>
                    <th>Customer ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Mobile No</th>

                    <th>Actions</th>
                  </tr>
                </thead>

                <tbody id="result">







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
