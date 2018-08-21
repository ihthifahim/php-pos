<?php

$title = "Edit User";
include 'template/header.php';
include 'template/top_navbar.php';
include 'template/main_navbar.php';
include 'actions/dbconnection.php';
include "template/notifications.php";

$user_id = $_GET['user_id'];

$find_user_sql = "select * from op_users WHERE USER_ID='".$user_id."'";
$find_user_query = mysqli_query($dbCon,$find_user_sql);
$user = mysqli_fetch_array($find_user_query);


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
              <form method="post" action="actions/user_edit.php">
                  <input type="hidden" name="user_id" value="<?php echo $user['USER_ID']; ?>">
                <div class="card-body">
                  <div class="form-group">
                    <label>First Name</label>
                    <input type="text" class="form-control" name="firstname" value="<?php echo $user['FIRSTNAME']; ?>">
                  </div>
                  <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" class="form-control" name="lastname" value="<?php echo $user['LASTNAME']; ?>">
                  </div>
                  <div class="form-group">
                    <label>Email Address</label>
                    <input type="text" class="form-control" name="email" value="<?php echo $user['EMAIL']; ?>">
                  </div>
                  <div class="form-group">
                    <label>Mobile Number</label>
                    <input type="text" class="form-control" name="mobile" value="<?php echo $user['MOBILE']; ?>">
                  </div>
<br/>
                  <hr>
                  <h4>Login Details</h4>



                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" value="<?php echo $user['USERNAME']; ?>">
                  </div>

                    <div class="form-group">
                    <label>Access Level</label>
                    <select class="form-control" name="accessLevel">

                        <option value="1" <?php if($user['USER_LEVEL']=="1") echo "selected=\"selected\""; ?>><?php echo "Administrator"; ?></option>
                        <option value="2" <?php if($user['USER_LEVEL']=="2") echo "selected=\"selected\""; ?>><?php echo "Cashier"; ?></option>


                    </select>
                  </div>


                </div>
                <!-- /.card-body -->

                <div class="card-footer">

                  <button type="submit" class="btn btn-primary" name="updateUser">Update User</button>
                     <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#passwordChange">Update Password</button>
                  <a href="users.php"><button type="button" class="btn btn-default">Back</button></a>
                </div>
              </form>
            </div>


</div>







                <!-- Modal -->
<div id="passwordChange" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Change password</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>

      </div>
        <form action="actions/user_edit.php" method="post">
            <input type="hidden" name="user_id" value="<?php echo $user['USER_ID'];?>">
      <div class="modal-body">

           <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password">
                  </div>
          <br/>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="updatePassword">Update Password</button>
      </div>
        </form>
    </div>

  </div>
</div>
        <!-- end of modal -->
















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
