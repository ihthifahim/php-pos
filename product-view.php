<?php
include 'template/header.php';
include 'template/top_navbar.php';
include 'template/main_navbar.php';

$product_id = $_GET['prodid'];



include 'actions/dbconnection.php';

$find_product_sql = "select * from op_products WHERE PRODUCT_ID='".$product_id."'";
$find_product_query = mysqli_query($dbCon,$find_product_sql);
$product = mysqli_fetch_array($find_product_query);

$prodCatList_sql = "select * from op_product_category";
$prodcatlist_query = mysqli_query($dbCon,$prodCatList_sql);

$supplierlist = "select * from op_suppliers";
$supplierlist_query = mysqli_query($dbCon,$supplierlist);

//$prodCatList = $products->all_product_category();
//$supplierList = $suppliers->all_suppliers();

//$get_stock = $products->find_product_stock($product_id);
//$stock_value = mysqli_fetch_array($get_stock);

$get_stock_sql = "select * from op_product_stock WHERE PRODUCT_ID='".$product_id."'";
$get_stock_query = mysqli_query($dbCon,$get_stock_sql);
$stock_value = mysqli_fetch_array($get_stock_query);

?>
<?php include "template/notifications.php"; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?php echo $product['PRODUCT_DESC']; ?></h1>
          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">


<div class="row">

<div class="col-md-6">
<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Product Details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="actions/product_edit.php">
                <div class="card-body">
                  <div class="form-group">
                    <input type="hidden" name="productID" value="<?php echo $product_id; ?>" >
                    <label>Product Description</label>
                    <input type="text" class="form-control" name="productDesc" value="<?php echo $product['PRODUCT_DESC']; ?>">
                  </div>
                  <div class="form-group">
                    <label>Supplier Code</label>
                    <input type="text" class="form-control" name="productSKU" value="<?php echo $product['PRODUCT_SKU']; ?>">
                  </div>
                  <div class="form-group">
                    <label>Category</label>
                        <select class="form-control" name="category">
                          <?php
                            while($prodcat = mysqli_fetch_array($prodcatlist_query)){

                              ?>
                                <option value="<?php echo $prodcat['CATEGORY_ID'];?>" <?php if($prodcat['CATEGORY_ID']==$product['CATEGORY_ID']) echo "selected=\"selected\""; ?>><?php echo $prodcat['CATEGORY_NAME']; ?></option>
                              <?php
                            }


                            ?>



                        </select>
                  </div>

                    <div class="row">
                  <div class="form-group col-md-6">
                    <label>Retail Price</label>
                    <input type="text" class="form-control" name="retailPrice" value="<?php echo $product['RETAIL_PRICE']; ?>">
                  </div>
                  <div class="form-group col-md-6">
                    <label>Cost Price</label>
                    <input type="text" class="form-control" name="costPrice" value="<?php echo $product['COST_PRICE']; ?>">
                  </div>



                    </div>
                     <div class="form-group">
                    <label>Supplier Name</label>
                        <select class="form-control" name="supplier">

                          <?php
                            while($supplier = mysqli_fetch_array($supplierlist_query)){

                              ?>
                                <option value="<?php echo $supplier['SUPPLIER_ID'];?>" <?php if($supplier['SUPPLIER_ID']==$product['SUPPLIER_ID']) echo "selected=\"selected\""; ?>><?php echo $supplier['SUPPLIER_NAME']; ?></option>
                              <?php
                            }


                            ?>



                        </select>
                  </div>


                     <div class="form-group">
    <label for="exampleFormControlFile1">Product Image</label>
    <input type="file" class="form-control-file" id="exampleFormControlFile1">
  </div>


                     <div class="form-group">
                    <div class="form-check">

              <input class="form-check-input" type="checkbox" value="1" name="manageInventory" <?php if($product['MANAGE_STOCK']==1) echo "checked=\"checked\""; ?>>
              <label class="form-check-label">Manage Inventory</label>
                    </div>
                  </div>



                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="submit">Update Product</button>
                    
                  <a href="products.php"><button type="button" class="btn btn-default">Back</button></a>
                    
                  <button type="button" class="btn btn-danger pull-right" data-toggle="modal" data-target="#DeleteProduct"><i class="fa fa-trash-o"></i></button>
                    
                </div>
              </form>
            </div>


</div>

         <!-- Modal -->
<div id="DeleteProduct" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

        <div class="modal-body">


<h2 class="text-center">Are you sure you want delete this product?</h2>



        </div>


<form action="actions/product_delete.php" method="post">
      <div class="modal-footer">
        <input type="hidden" value="<?php echo $_GET['prodid'] ?>" name="prodid" />
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">No</button>
          <button type="submit" class="btn btn-navy" name="delete" >YES</button>
      </div>
    </div>
</form>
  </div>
</div>
        <!-- end of modal -->





<div class="col-md-5">

<div class="row">
<div class="col-md-6">

              <div class="small-box bg-aqua">
                    <div class="inner">
                    <h3>
                      <?php

                      if($stock_value['STOCK_VALUE'] == ""){
                        echo "Not Set";
                      } else {
                        echo $stock_value['STOCK_VALUE'];
                      }

                       ?></h3>
                    <p>Available Stock</p>
                    </div>
                    <div class="icon">
                    <i class="ion ion-bag"></i>
                    </div>
                  </div>
</div>
<div class="col-md-6">




  <?php
$TotalValue = $stock_value['STOCK_VALUE'] * $product['COST_PRICE'];

   ?>

              <div class="small-box bg-aqua">
                    <div class="inner">
                    <h3><?php  echo number_format($TotalValue,0); ?></h3>
                    <p>Total Stock Value</p>
                    </div>
                    <div class="icon">
                    <i class="ion ion-bag"></i>
                    </div>
                  </div>
</div>



<div class="col-md-12">

    <div class="card">
              <div class="card-header">
                <h3 class="card-title">Customers Interested in this product</h3>


              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table">
                  <tbody>


                      <tr>
                      <td>Ihthishaam Fahim</td>
                          <td>2</td>
                          <td>2018/05/28</td>
                      </tr>




                </tbody></table>
              </div>
              <!-- /.card-body -->
            </div>


    </div>



</div>

</div>





</div><!-- end of div row -->



      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



 <?php include 'template/footer.php';  ?>
