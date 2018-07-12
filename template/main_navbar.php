 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="assets/img/logo.png" alt="Octapay Logo" class="brand-image"
           style="opacity: .8">
      <span class="brand-text font-weight-light">OCTAPAY</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         
            
            <?php  if($_SESSION['user_level'] == 1){ ?>
            
            
          <li class="nav-item">
            <a href="dashboard.php" class="nav-link">
              <i class="nav-icon fa fa-dashboard"></i>
              <p>Dashboard</p>
            </a>
           
          </li>

           <li class="nav-item">
            <a href="customers.php" class="nav-link">
              <i class="nav-icon fa fa-user"></i>
              <p>Customers</p>
            </a>
           
          </li>



          <li class="nav-item">
            <a href="products.php" class="nav-link">
              <i class="nav-icon fa fa-server"></i>
              <p>Products</p>
            </a>
           
          </li>
              <li class="nav-item">
            <a href="suppliers.php" class="nav-link">
              <i class="nav-icon fa fa-truck"></i>
              <p>Suppliers</p>
            </a>
           
          </li>
            
  
            <li class="nav-item">
            <a href="sale.php" class="nav-link">
              <i class="nav-icon fa fa-barcode"></i>
              <p>Sale</p>
            </a>
           
          </li>
            
            
              <li class="nav-item">
            <a href="invoices.php" class="nav-link">
              <i class="nav-icon fa fa-newspaper-o"></i>
              <p>Invoices</p>
            </a>
           
          </li>
            
            
                    <li class="nav-item">
            <a href="users.php" class="nav-link">
              <i class="nav-icon fa fa-users"></i>
              <p>Users</p>
            </a>
           
          </li>
            
            
            
                      <li class="nav-item">
            <a href="reports.php" class="nav-link">
              <i class="nav-icon fa  fa-signal"></i>
              <p>Reports</p>
            </a>
           
          </li>
            
            
            
                           <li class="nav-item">
            <a href="grn.php" class="nav-link">
              <i class="nav-icon fa fa-sticky-note"></i>
              <p>Good Receive Note</p>
            </a>
           
          </li>
            
            <?php } else {  ?>
            
            
            <li class="nav-item">
            <a href="dashboard.php" class="nav-link">
              <i class="nav-icon fa fa-dashboard"></i>
              <p>Dashboard</p>
            </a>
           
          </li>

           <li class="nav-item">
            <a href="customers.php" class="nav-link">
              <i class="nav-icon fa fa-user"></i>
              <p>Customers</p>
            </a>
           
          </li>



          <li class="nav-item">
            <a href="products.php" class="nav-link">
              <i class="nav-icon fa fa-server"></i>
              <p>Products</p>
            </a>
           
          </li>
            
             <li class="nav-item">
            <a href="sale.php" class="nav-link">
              <i class="nav-icon fa fa-barcode"></i>
              <p>Sale</p>
            </a>
           
          </li>
            
            <?php } ?>
            
        
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>