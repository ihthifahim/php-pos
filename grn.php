<?php
include 'template/header.php';
include 'template/top_navbar.php';
include 'template/main_navbar.php';

?>
  <script src="assets/js/grn.js"></script>
    

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
       
          
          
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
     



        <div class="row">
            <div class="col-md-8">
            
                <div class="card">
                    <div class="card-body">
                       <div class="row">
                            <div class="col-md-9"><input class="form-control" type="text" placeholder="Product Description" name="ProductName" id="ProductName" autocomplete="off"></div>
                            
                            <div class="col-md-2"><input class="form-control" type="number" placeholder="Quantity" id="qty"></div>
                            
                            
                            
                            <div class="col-md-1"><button type="button" class="btn btn-block btn-navy btn-flat" onclick="insGRN()"><i class="fa fa-plus"></i></button></div>

<div id="ProductNameList"></div>


                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-md-12">
                            
                            <div class="card">
              
              <div class="card-body p-0">
                <table class="table">
                  <thead><tr>
                    <th>Product Description</th>
                    <th>Qty</th>
                    
                    <th>Cost Price</th>
                      <th>Total</th>
                      <th></th>
                  </tr></thead>
                  
                  
                  <tbody id="grnTable"></tbody>
                  
                  
                  </table>
              </div>
              <!-- /.card-body -->
            </div>
                            
                            </div>
                        
                        
                        </div>
                        
                    
                    
                    </div>
                
                </div><!-- end of left card div -->
            
            
            </div><!-- end of left div column 8 -->
            
            
            
            <div class="col-md-4">
            
                
            
            
                <div class="card">
              <div class="card-header">
             
                  
             <form method="post" action="actions/grn/grn.php">      
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <div class="row">
                    <label class="col-md-6">GRN #</label>
                    <input type="text" class="form-control form-control-sm text-right col-md-6" id="GRN_NUMBER" disabled="">
                  </div>
                  <br/>
                  
                  <div class="row">
                        <label class="col-md-6">Date Transaction</label>
                    <input type="text" class="form-control form-control-sm text-right col-md-6" value="<?php echo date("Y-m-d") ?>" disabled="">
                      
                  </div>
                  <br/>
                   <div class="row">
                        <label class="col-md-6">Supplier</label>
                      <select class="form-control form-control-sm col-md-6" name="supplierName">
                          <?php 
                                include 'actions/dbconnection.php';
                            $list_suppliers_sql = "select * from op_suppliers";
                           $list_suppliers_query = mysqli_query ($dbCon,$list_suppliers_sql);
                           while($list_suppliers = mysqli_fetch_array($list_suppliers_query)){
                               echo "<option value=".$list_suppliers['SUPPLIER_ID'].">".$list_suppliers['SUPPLIER_NAME']."</option>";
                           }
    
    ?>
                          
                     
                       </select>
                   <!-- <input class="form-control form-control-sm col-md-6 text-right" type="text" placeholder=""> -->
                      
                  </div>
                  <br/>
                  
          
                  <div class="row">
                  
                  
                  <div class="info-box mb-3 col-md-12">
              <span class="info-box-icon bg-warning elevation-1 col-md-3"><h1>LKR</h1></span>

              <div class="info-box-content">
                <strong><h1 class="text-right text-success" id="subtotal">0.00</h1></strong>
              </div>
              <!-- /.info-box-content -->
            </div>
                  
                  
                  </div>  
      
              </div>
              <!-- /.card-body -->
             
            </div>
                 

                
                <button type="button" class="btn btn-block btn-success btn-flat" data-toggle="modal" data-target="#myModal">Save GRN</button>
                
 
            </div>
        

        </div>
   <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Process Payment</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
     
        <div class="modal-body">
            

            
             <div class="row">
                    <label class="col-md-6">Payment Method</label>
                    
                 
                    <select class="form-control form-control-sm col-md-6" onchange="scheduleA.call(this, event)" name="paymentMethod">
                        <option value="none">Please Select</option>
                        <option value="Cash">Cash</option>
                      <option value="Cash and Card">Cash and Card</option>
                      <option value="Card">Card</option>
                      <option value="Bank Transfer">Bank Transfer</option>
                    </select>
                  
                 
                 
                  </div>
                  <br/>
            

          
                  <div class="row" id="Cash" style="display:none;margin-bottom:15px">
                        <label class="col-md-6">Cash</label>
                    <input type="text" class="form-control form-control-sm col-md-6"  name="cash">
                     
                  </div>
            
             <div class="row" id="Card" style="display:none;margin-bottom:15px">
                 <br/>
                        <label class="col-md-6">Card</label>
                    <input type="text" class="form-control form-control-sm col-md-6"  name="card">
                      
                  </div>
            
     
            
             <div class="row">
                   
                    <label class="col-md-6">Payment Status</label>
                    
                 
                    <select class="form-control form-control-sm col-md-6" name="paymentStatus">
                      <option value="Pending">Pending</option>
                      <option value="Paid">Paid</option>
                   
                    </select>
                  
                 
                 
                  </div>
           <hr>
                  
                 
                  
               
            
            <div class="row">
                
                <div class="form-group col-md-12">
                    <label>Remarks</label>
                    <textarea class="form-control" rows="3" name="remarks"></textarea>
                  </div>
                
                
            </div>
                  
                  
                  
                  <div class="row">
                  
                  
                  <div class="info-box mb-3 col-md-12">
              <span class="info-box-icon bg-warning elevation-1 col-md-3"><h1>LKR</h1></span>

              <div class="info-box-content">
                <strong><h1 class="text-right text-success" id="final_total">0.00</h1></strong>
              </div>
              <!-- /.info-box-content -->
            </div>
                  
                  
                  </div>  
                  

        </div>
        
        
        
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-navy" name="saveGRN">SAVE GRN</button>
      </div>
    </div>

  </div>
</div>
        <!-- end of modal -->
        
        
            </form>
        
        
        
        
        
        
        
        
         <!-- Modal -->
<div id="DeleteProduct" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
   
        <div class="modal-body">
            
            
<h2 class="text-center">Are you sure you want delete this product?</h2>
            
            
            
        </div>
        
        
        
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">No</button>
          <button type="button" class="btn btn-navy" >YES</button>
      </div>
    </div>

  </div>
</div>
        <!-- end of modal -->






  





       
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  

 <?php include 'template/footer.php';  ?>