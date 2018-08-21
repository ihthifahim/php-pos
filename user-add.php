<?php

$title = "Add New User";

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
            <h1 class="m-0 text-dark">Add Users</h1>
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
              <form action="actions/user_add.php" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label>First Name</label>
                    <input type="text" class="form-control" name="firstname">
                  </div>
                  <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" class="form-control" name="lastname">
                  </div>
                  <div class="form-group">
                    <label>Email Address</label>
                    <input type="text" class="form-control" name="email">
                  </div>
                  <div class="form-group">
                    <label>Mobile Number</label>
                    <input type="text" class="form-control" name="mobile">
                  </div>
                  <hr><br/>
                  <h4>Login Details</h4>
                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username">
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password">
                  </div>

                    <div class="form-group">
                    <label>Access Level</label>
                    <select class="form-control" name="access">
                    <option value="1">Administrator</option>
                        <option value="2">Cashier</option>

                    </select>
                  </div>


                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="adduser">Add User</button>
                  <a href="users.php"><button type="button" class="btn btn-default">Back</button></a>
                </div>
              </form>
            </div>


</div>



<div class="col-md-5">

<div class="callout callout-danger">
                  <h5><strong>Username already exists!</strong></h5>

                  <p>Username already exists</p>
                </div>

</div>




</div><!-- end of div row -->



      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



 <?php include 'template/footer.php';  ?>
