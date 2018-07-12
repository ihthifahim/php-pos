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
            <h1 class="m-0 text-dark">Reports</h1>
          </div><!-- /.col -->
         
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

      
      
      
      
      
      <div class="container-fluid">
      <div class="row">
      
      
      <div class="col-md-12">
          
          
          <div class="card collapsed-card">
              <div class="card-header">
                <h5 class="card-title">Monthly Recap Report</h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-widget="collapse">
                    <i class="fa fa-minus"></i>
                  </button>
                  <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-wrench"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                      <a href="#" class="dropdown-item">Action</a>
                      <a href="#" class="dropdown-item">Another action</a>
                      <a href="#" class="dropdown-item">Something else here</a>
                      <a class="dropdown-divider"></a>
                      <a href="#" class="dropdown-item">Separated link</a>
                    </div>
                  </div>
               
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <p class="text-center">
                      <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
                    </p>

                    <div class="chart">
                      <!-- Sales Chart Canvas -->
                      <canvas id="salesChart" height="204" style="height: 204px; width: 475px;" width="475"></canvas>
                    </div>
                    <!-- /.chart-responsive -->
                  </div>
                  <!-- /.col -->
                
                </div>
                <!-- /.row -->
              </div>
              <!-- ./card-body -->
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-success"><i class="fa fa-caret-up"></i> 17%</span>
                      <h5 class="description-header">$35,210.43</h5>
                      <span class="description-text">TOTAL REVENUE</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-warning"><i class="fa fa-caret-left"></i> 0%</span>
                      <h5 class="description-header">$10,390.90</h5>
                      <span class="description-text">TOTAL COST</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-success"><i class="fa fa-caret-up"></i> 20%</span>
                      <h5 class="description-header">$24,813.53</h5>
                      <span class="description-text">TOTAL PROFIT</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block">
                      <span class="description-percentage text-danger"><i class="fa fa-caret-down"></i> 18%</span>
                      <h5 class="description-header">1200</h5>
                      <span class="description-text">GOAL COMPLETIONS</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-footer -->
            </div>
          
          </div>
      
      
      
      </div>
          
          
          
          
          <div class="row">
          
          <div class="col-md-6">
            
              <div class="card">
              <div class="card-header">
                <h3 class="card-title  text-info">Top 5 customers</h3>

              
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table">
                  <tbody><tr>
                    <th>Customer Name</th>
                    <th>Mobile Number</th>
                    <th>Total Sales</th>
                    <th>Actions</th>
                  </tr>
                      
                      <?php
                      include 'actions/dbconnection.php';
                      $top_customers_sql = "select SUM(INVOICE_TOTAL) as total, CUSTOMER_ID from op_invoice_main WHERE PAYMENT_STATUS='Paid' && CUSTOMER_ID != 12 GROUP BY CUSTOMER_ID ORDER BY sum(INVOICE_TOTAL) DESC LIMIT 5";
                      $top_customer_query = mysqli_query($dbCon,$top_customers_sql);
                      
                      while($top_customer = mysqli_fetch_array($top_customer_query)){
                          $find_customer = "select * from op_customers WHERE CUSTOMER_ID='".$top_customer['CUSTOMER_ID']."'";
                          $find_customer_query = mysqli_query($dbCon,$find_customer);
                          
                          while($customer = mysqli_fetch_array($find_customer_query)){
                              
                              echo "<tr>";
                              echo "<td>".$customer['FIRSTNAME']." ".$customer['LASTNAME']."</td>";
                              echo "<td>".$customer['MOBILE_NUMBER']."</td>";
                              echo "<td>".number_format($top_customer['total'],2)."</td>";
                              echo "<td><a href=customer-view.php?cusid=".$customer['CUSTOMER_ID'].">VIEW</a></td>";
                              echo "</tr>";
                              
                          }
                          
                      }
                      
                      
                      ?>
                      
                      
                      
               
                
               
                </tbody></table>
              </div>
              <!-- /.card-body -->
            </div>
              
              
            </div>
              
              
              
              
              <div class="col-md-6">
            
              <div class="card">
              <div class="card-header">
                <h3 class="card-title text-info">Top 5 Products sold</h3>

              
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table">
                  <tbody><tr>
                    <th>Product Name</th>
                    <th>Total Sold</th>
                    <th>Total Sales</th>
                    
                  </tr>
                      
                      <?php
                      
                      $top_products_sql = "select PRODUCT_DESC,COUNT(INVOICE_DETAIL_ID) as sold,SUM(UNIT_PRICE) as total FROM op_invoice_detail GROUP BY PRODUCT_DESC ORDER BY COUNT(INVOICE_DETAIL_ID) DESC LIMIT 5";
                      $top_products_query = mysqli_query($dbCon,$top_products_sql);
                      
                      while($top_products = mysqli_fetch_array($top_products_query)){
                          echo "<tr>";
                          echo "<td>".$top_products['PRODUCT_DESC']."</td>";
                          echo "<td>".$top_products['sold']."</td>";
                          echo "<td>".number_format($top_products['total'],2)."</td>";
                          echo "</tr>";
                          
                      }
                      
                      ?>
                      
             
                 
                
               
                </tbody></table>
              </div>
              <!-- /.card-body -->
            </div>
              
              
            </div>
          
          
          </div>
          
          
          
          
      
      </div>
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
    
  </div>
  <!-- /.content-wrapper -->

  

 <?php include 'template/footer.php';  ?>