<?php
$title = "Edit Customer";
include 'template/header.php';
include 'template/top_navbar.php';
include 'template/main_navbar.php';


$customer_id = $_GET['cusid'];

include('actions/dbconnection.php');


$find_customer_sql = "select * from op_customers WHERE CUSTOMER_ID='".$customer_id."'";
$customer_query = mysqli_query($dbCon,$find_customer_sql);
$customer = mysqli_fetch_array($customer_query);

?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Customer</h1>
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
              <form role="form" action="actions/customer-edit.php" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label>First Name</label>
                    <input type="hidden" value="<?php echo $customer['CUSTOMER_ID']; ?>" name="cusid" >
                    <input type="text" class="form-control" value="<?php echo $customer['FIRSTNAME']; ?>" name="firstname">
                  </div>
                  <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" class="form-control" value="<?php echo $customer['LASTNAME']; ?>" name="lastname">
                  </div>
                  <div class="form-group">
                    <label>Email Address</label>
                    <input type="text" class="form-control" value="<?php echo $customer['EMAIL']; ?>" name="email" id="email">
                  </div>
                  <div class="form-group">
                    <label>Mobile Number</label>
                    <input type="text" class="form-control" value="<?php echo $customer['MOBILE_NUMBER']; ?>" name="mobile">
                  </div>
                  <div class="form-group">
                    <label>Shipping Address</label>
                    <input type="text" class="form-control"value="<?php echo $customer['DELIVERY_ADDRESS']; ?>" name="shipping">
                  </div>
                  <div class="form-group">
                    <label>Date of Birth</label>
                    <input type="date"  class="form-control" value="<?php echo $customer['DOB']; ?>" name="dob">

                  </div>


                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="submit">Update Customer</button>
                  <a href="customer-view.php?cusid=<?php echo $customer['CUSTOMER_ID']; ?>"><button type="button" class="btn btn-default">Back</button></a>
                  <button type="button" class="btn btn-danger pull-right" data-toggle="modal" data-target="#DeleteCustomer"><i class="fa fa-trash-o"></i></button>
                </div>
              </form>
            </div>





                     <!-- Modal -->
            <div id="DeleteCustomer" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">

                    <div class="modal-body">


            <h2 class="text-center">Are you sure you want delete this Customer?</h2>



                    </div>


            <form action="actions/customer_delete.php" method="post">
                  <div class="modal-footer">
                    <input type="hidden" value="<?php echo $_GET['cusid'] ?>" name="cusid" />
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">No</button>
                      <button type="submit" class="btn btn-navy" name="delete" >YES</button>
                  </div>
                </div>
            </form>
              </div>
            </div>
                    <!-- end of modal -->






</div>

<script>

$(document).ready(function(){

 //load_data();

 function load_data(query)
 {
  $.ajax({
   url:"actions/validations/CustomerAvailability.php",
   method:"POST",
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

</div>




</div><!-- end of div row -->



      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



 <?php include 'template/footer.php';  ?>
