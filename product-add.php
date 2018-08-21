<?php
$title = "Add new product";

include 'template/header.php';
include 'template/top_navbar.php';
include 'template/main_navbar.php';


//$fetch_supplier = $suppliers->all_suppliers();
//$fetch_product_category = $products->all_product_category();

include('actions/dbconnection.php');
$fetch_supplier_sql = "select * from op_suppliers";
$fetch_supplier_query = mysqli_query($dbCon,$fetch_supplier_sql);

$fetch_product_category_sql = "select * from op_product_category";
$fetch_product_category_query = mysqli_query($dbCon,$fetch_product_category_sql);



?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Add Product</h1>
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
                <h3 class="card-title">Product Details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="actions/product-add.php" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label>Product Description</label>
                    <input type="text" class="form-control" name="productDesc" id="productDesc" required>
                  </div>
                  <div class="form-group">
                    <label>Supplier Code</label>
                    <input type="text" class="form-control" name="supplierCode">
                  </div>
                  <div class="form-group">
                    <label>Category</label>
                        <select class="form-control" name="category">
                            <option>None</option>

                            <?php

                              while($CategoryName = mysqli_fetch_array($fetch_product_category_query)){
                                echo "<option value=".$CategoryName['CATEGORY_ID'].">".$CategoryName['CATEGORY_NAME']."</option>";
                              }


                             ?>
                        </select>
                  </div>

                    <div class="row">
                  <div class="form-group col-md-4">
                    <label>Retail Price</label>
                    <input type="text" class="form-control" name="retailPrice" id="retail" onblur="calculate()" required>
                  </div>
                  <div class="form-group col-md-4">
                    <label>Cost Price</label>
                    <input type="text" class="form-control" name="costPrice" id="cost" onblur="calculate()" onblur="price_validation()" required>
                  </div>

                  <div class="form-group col-md-4">
                    <label>Profit</label>
                    <input type="text" class="form-control" disabled="" name="profit" value="" id="profit">
                  </div>

                    </div>
                     <div class="form-group">
                    <label>Supplier Name</label>
                        <select class="form-control" name="supplier"><option>None</option>
                          <?php

                          while ($supplierName = mysqli_fetch_array($fetch_supplier_query)){
                            echo "<option value=".$supplierName['SUPPLIER_ID'].">".$supplierName['SUPPLIER_NAME']."";
                          }

                           ?>


                        </select>
                  </div>


<script>

$(document).ready(function(){


 //load_data();

 function load_data(query)
 {
  $.ajax({
   url:"actions/validations/ProductAvailability.php?query",
   method:"GET",
   data:{query:query},
   success:function(data)
   {
    $('#result').html(data);
   }
  });
 }


 $('#productDesc').keyup(function(){
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


function calculate(){

  var retail = document.getElementById('retail').value;
  var cost = document.getElementById('cost').value;
  document.getElementById('profit').value = parseFloat(retail) - parseFloat(cost);

}

</script>



                     <div class="form-group">
    <label for="exampleFormControlFile1">Product Image</label>
    <input type="file" class="form-control-file" id="exampleFormControlFile1">
  </div>

                    <div class="form-group">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="1" name="manageInventory">
                      <label class="form-check-label">Manage Inventory</label>
                    </div>
                  </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="submit">Add Product</button>
                  <a href="products.php"><button type="button" class="btn btn-default">Back</button></a>

                     <button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#myModal">Add New Product Category</button>
                </div>
              </form>
            </div>


</div>



<div class="col-md-5">

<div id="result"></div>

<?php
if(isset($_GET['failedtoadd'])){
  echo "<div class='callout callout-danger'>";
        echo "<h5><strong>Product failed to add!</strong></h5>";
  echo "<p>Cost Price is over the Retail Price</p>";
        echo "</div>";
}
?>

</div>




</div><!-- end of div row -->


            <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Add Product Category</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>

      </div>
      <div class="modal-body">
<form action="actions/product_category_add.php" method="post">
           <div class="form-group">
                    <label>Product Category</label>
                    <input type="text" class="form-control" name="product_category" id="productCategory">
                  </div>
          <br/>

        <div id="warning"></div>


      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-navy" name="productCategory">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
</form>
  </div>
</div>
        <!-- end of modal -->

      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



 <?php include 'template/footer.php';  ?>
