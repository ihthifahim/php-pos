<?php
include 'template/header.php';
include 'template/top_navbar.php';
include 'template/main_navbar.php';



?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Add Suppliers</h1>
          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <script>

        $(document).ready(function(){

         //load_data();

         function load_data(query)
         {
          $.ajax({
           url:"actions/validations/SupplierAvailability.php?query",
           method:"GET",
           data:{query:query},
           success:function(data)
           {
            $('#result').html(data);
           }
          });
         }


         $('#SupplierName').keyup(function(){
          var search = $(this).val();
          if(search != '')
          {
           load_data(search);
          }
          else
          {
          // load_data();
          }
         });
        });


        </script>



<div class="row">

<div class="col-md-7">
<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Supplier Details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="actions/supplier_add.php">
                <div class="card-body">
                  <div class="form-group">
                    <label>Supplier Name</label>
                    <input type="text" class="form-control" id="SupplierName" name="SupplierName" required>
                  </div>
                  <div class="form-group">
                    <label>Contact Name</label>
                    <input type="text" class="form-control" name="ContactName">
                  </div>
                  <div class="form-group">
                    <label>Email Address</label>
                    <input type="text" class="form-control" name="Email" required>
                  </div>
                  <div class="form-group">
                    <label>Mobile Number</label>
                    <input type="text" class="form-control" name="Mobile">
                  </div>
                  <div class="form-group">
                    <label>Address</label>
                    <input type="text" class="form-control" name="Address">
                  </div>


                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="submit">Add Supplier</button>
                  <a href="suppliers.php"><button type="button" class="btn btn-default">Back</button></a>
                </div>
              </form>
            </div>


</div>



<div class="col-md-5">
<div id="result"></div>



</div>




</div><!-- end of div row -->



      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



 <?php include 'template/footer.php';  ?>
