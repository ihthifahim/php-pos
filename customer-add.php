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
            <h1 class="m-0 text-dark">Add Customers</h1>
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
                <h3 class="card-title">Customer Details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="actions/customers-add.php">
                <div class="card-body">
                  <div class="form-group">
                    <label>First Name</label>
                    <input type="text" class="form-control" name="firstname" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" class="form-control" name="lastname" required>
                  </div>
                  <div class="form-group">
                    <label>Email Address</label>
                    <input type="text" class="form-control" name="email" id="email" required>
                  </div>
                  <div class="form-group">
                    <label>Mobile Number</label>
                    <input type="number" class="form-control" name="mobile" required>
                  </div>
                  <div class="form-group">
                    <label>Shipping Address</label>
                    <input type="text" class="form-control" name="shipping">
                  </div>


                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="submit">Add Customer</button>
                  <a href="customers.php"><button type="button" class="btn btn-default">Back</button></a>
                </div>
              </form>
            </div>


</div>

<script>

$(document).ready(function(){

 //load_data();

 function load_data(query)
 {
  $.ajax({
   url:"actions/validations/CustomerAvailability.php?query",
   method:"GET",
   data:{query:query},
   success:function(data)
   {
    $('#result').html(data);
   }
  });
 }


 $('#email').keyup(function(){
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

<div class="col-md-5">

<div id="result"></div>
    
    <?php 
    
    if(isset($_GET['CustomerAdded'])){
        echo "CUSTOMER ADDED";
    }
    
    ?>

</div>




</div><!-- end of div row -->



      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



 <?php include 'template/footer.php';  ?>
