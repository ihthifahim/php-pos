<?php
include 'template/header.php';
include 'template/top_navbar.php';
include 'template/main_navbar.php';

include 'actions/dbconnection.php';

$date = date("Y-m-d");

$invoice_search_sql = "select SUM(INVOICE_TOTAL) as totalSales, SUM(TOTAL_CASH) as cash, SUM(TOTAL_CARD) as card,SUM(INVOICE_PROFIT) as profit from op_invoice_main WHERE INVOICE_DATE='".$date."'";

$invoice_search_query = mysqli_query($dbCon,$invoice_search_sql);
$sum = mysqli_fetch_array($invoice_search_query);


?>
 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
         
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo number_format($sum['totalSales'],2); ?></h3>

                <p>Total Sales</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo number_format($sum['cash'],2); ?></h3>

                <p>Total Cash Sales</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo number_format($sum['card'],2); ?></h3>

                <p>Total Card Sales</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
         
            </div>
          </div>
          <!-- ./col -->
            
            <?php 
                    
                    if($_SESSION["user_level"] == 1){
                       ?> 
                              
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo number_format($sum['profit'],2); ?></h3>

                <p>Total Profit</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
            
            </div>
          </div>
          <!-- ./col -->
                        
            <?php
                        
                    } 
                    
                   
                    
                    
                    
                    ?>
            
            
            
   
          <!-- ./col -->
        </div>

          
           </div>









<!-- beginning of sales table -->

<div class="card">
              <div class="card-header">
                <h3 class="card-title">Today's Sales Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table">
                  <tbody><tr>
                    <th>Invoice Number</th>
                    <th>Customer Email</th>
                    <th>Invoice Total</th>
                    <th>Invoice User</th>
                    <th>Payment Method</th>
                    <th>Payment Status</th>
                      <th>Actions</th>
                    
                  </tr>
                      
                      <?php 
                      include 'actions/dbconnection.php';
                      $date = date("Y-m-d");
                      $today_invoice_sql = "select * from op_invoice_main WHERE INVOICE_DATE='".$date."'";
                      $today_invoice_query = mysqli_query($dbCon,$today_invoice_sql);
                      
                      while($today_invoice = mysqli_fetch_array($today_invoice_query)){
                          $find_customer_sql = "select EMAIL from op_customers WHERE CUSTOMER_ID='".$today_invoice['CUSTOMER_ID']."'";
                          $find_customer_query = mysqli_query($dbCon,$find_customer_sql);
                          $find_customer = mysqli_fetch_array($find_customer_query);
                          
                          $find_user_sql = "select FIRSTNAME from op_users WHERE USER_ID='".$today_invoice['USER_ID']."'";
                          $find_user_query = mysqli_query($dbCon,$find_user_sql);
                          $find_user = mysqli_fetch_array($find_user_query);
                          
                          echo "<tr>";
                          echo "<td>".$today_invoice['INVOICE_NUMBER']."</td>";
                          echo "<td>".$find_customer['EMAIL']."</td>";
                          echo "<td>".number_format($today_invoice['INVOICE_TOTAL'],2)."</td>";
                          echo "<td>".$find_user['FIRSTNAME']."</td>";
                          echo "<td>".$today_invoice['PAYMENT_METHOD']."</td>";
                          
                             if($today_invoice['PAYMENT_STATUS'] == "Pending"){
                              echo "<td><span class='badge bg-danger'>".$today_invoice['PAYMENT_STATUS']."</span></td>";
                          } else {
                              echo "<td><span class='badge bg-success'>".$today_invoice['PAYMENT_STATUS']."</span></td>";
                          }
                          
                          
                          echo "<td><a href=final-invoice.php?InvoiceNumber=".$today_invoice['INVOICE_NUMBER']."><span class='fa fa-edit'></span></a></td>";
                          echo "</tr>";
                          
                      }
                      
                      
                      ?>
                      
             
              
                </tbody></table>
              </div>
              <!-- /.card-body -->
            </div>
        

<!-- end of sales table -->
        
  


<!-- beginning of Pending Invoices table -->

<div class="card card-default collapsed-card">
              <div class="card-header">
                <h3 class="card-title">Pending Invoices</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table">
                  <tbody><tr>
                    <th>Invoice Number</th>
                    <th>Customer Email</th>
                    <th>Invoice Total</th>
                    <th>Invoice User</th>
                    <th>Payment Method</th>
                    <th>Payment Status</th>
                    <th>Actions</th>
                    
                  </tr>
                   <?php 
                      include 'actions/dbconnection.php';
                      $date = date("Y-m-d");
                      $today_invoice_sql = "select * from op_invoice_main WHERE PAYMENT_STATUS='Pending'";
                      $today_invoice_query = mysqli_query($dbCon,$today_invoice_sql);
                      
                      while($today_invoice = mysqli_fetch_array($today_invoice_query)){
                          $find_customer_sql = "select EMAIL from op_customers WHERE CUSTOMER_ID='".$today_invoice['CUSTOMER_ID']."'";
                          $find_customer_query = mysqli_query($dbCon,$find_customer_sql);
                          $find_customer = mysqli_fetch_array($find_customer_query);
                          
                          $find_user_sql = "select FIRSTNAME from op_users WHERE USER_ID='".$today_invoice['USER_ID']."'";
                          $find_user_query = mysqli_query($dbCon,$find_user_sql);
                          $find_user = mysqli_fetch_array($find_user_query);
                          
                          echo "<tr>";
                          echo "<td>".$today_invoice['INVOICE_NUMBER']."</td>";
                          echo "<td>".$find_customer['EMAIL']."</td>";
                          echo "<td>".number_format($today_invoice['INVOICE_TOTAL'],2)."</td>";
                          echo "<td>".$find_user['FIRSTNAME']."</td>";
                          echo "<td>".$today_invoice['PAYMENT_METHOD']."</td>";
                          
                          if($today_invoice['PAYMENT_STATUS'] == "Pending"){
                              echo "<td><span class='badge bg-danger'>".$today_invoice['PAYMENT_STATUS']."</span></td>";
                          } else {
                              echo "<td><span class='badge bg-success'>".$today_invoice['PAYMENT_STATUS']."</span></td>";
                          }
                          
                          
                          echo "<td><a href=final-invoice.php?InvoiceNumber=".$today_invoice['INVOICE_NUMBER']."><span class='fa fa-edit'></span></a></td>";
                          echo "</tr>";
                          
                      }
                      
                      
                      ?>
                 
                </tbody></table>
              </div>
              <!-- /.card-body -->
            </div>

<!-- end of Pending Invoices table -->


    
        
        
        
        
        
         <!-- Modal -->
<div id="DailyNote" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">New Note</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
        
           <div class="form-group">
                    <label>Note</label>
                  <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                  </div>
          <br/>
       
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
           <button type="button" class="btn btn-navy">Save</button>
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