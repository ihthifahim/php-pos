<nav class="main-header navbar navbar-expand navbar-light border-bottom" style="background-color:#522C7A;font-color:#ffffff;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>


    </ul>



    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <!-- Notifications Dropdown Menu -->
       <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">

             <div class="info">
         <span class="d-block" style="color:#ffffff;">Logged in as <?php echo $_SESSION['user_firstname']; ?> <span class="right fa fa-angle-down"></span></span>
        </div>

        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

          
          <a href="actions/login.php?logout" class="dropdown-item dropdown-footer">Log out</a>
        </div>
      </li>

    </ul>
  </nav>
  <!-- /.navbar -->
