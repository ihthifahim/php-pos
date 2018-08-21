  <?php

$title = "Products";

include 'template/header.php';
include 'template/top_navbar.php';
include 'template/main_navbar.php';


include 'actions/dbconnection.php';
$sqlCount = "select COUNT(PRODUCT_ID) as count from op_products";
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
            <h1 class="m-0 text-dark">Products</h1>
          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
       <section class="content">
        <div class="container-fluid">
          <div class="row">
          <div class="col-md-3 col-sm-3">
          <div class="input-group input-group-sm">
                  <input type="text" class="form-control" placeholder="Search by Product Name" id="search_text">
                  <span class="input-group-append">
                    <button type="button" class="btn btn-info btn-flat">Go!</button>
                  </span>
                </div>

          </div><!-- end of div search bar column -->

          <div class="col-md-3 col-sm-6"><p><strong>Total Number of Products : </strong><span class="badge bg-primary"><?php  echo $count['count']; ?></span></p></div>

              <?php if($_SESSION['user_level'] == 1){  ?>


<div class="col-md-6"><a href="product-add.php"><button type="button" class="btn btn-block btn-primary btn-sm pull-right col-md-4">Add New Product</button></a></div>  <?php } ?>

          </div><!-- end of div first row -->





        <script>

        $(document).ready(function(){

         load_data();


         function load_data(query1)
         {
          $.ajax({
           url:"actions/validations/fetchProducts.php?query1",
           method:"GET",
           data:{query:query1},
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








<div class="row">
<div class="col-md-12">

  <div class="card">

                <!-- /.card-header -->
                <div class="card-body p-0">
                  <table class="table">
                    <thead><tr>

                        <?php

                        if($_SESSION['user_level'] == 1){
                            ?>

                        <th>Product Description</th>
                      <th>Category</th>
                      <th>Product MRP</th>
                      <th>Product Cost Price</th>
                      <th>Quantity Available</th>
                      <th>Actions</th>

                        <?php
                        } else {
                            ?>

                        <th>Product Description</th>
                      <th>Category</th>
                      <th>Product MRP</th>

                      <th>Quantity Available</th>

                        <?php

                        }

                        ?>



                    </tr></thead>

                    <tbody id="result"></tbody>

                  </table>
                </div>
                <!-- /.card-body -->
              </div>


</div>

</div>


        </div><!--/. container-fluid -->
       </section>
       <!-- /.content -->
      </div>
    <!-- /.content-wrapper -->



 <?php include 'template/footer.php';  ?>
