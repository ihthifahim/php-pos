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
            <h1 class="m-0 text-dark">Users</h1>
          </div><!-- /.col -->
         
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">


      <div class="row">
      <div class="col-md-4"><div class="input-group input-group-sm">
                  <input type="text" class="form-control" placeholder="Search by username">
                  <span class="input-group-append">
                    <button type="button" class="btn btn-info btn-flat">Go!</button>
                  </span>
                </div>
                      </div>

            <div class="col-md-3"><p><strong>Total Number of Customers Registered : </strong><span class="badge bg-primary">2</span></p></div>
      <div class="col-md-5">
      <a href="user-add.php"><button type="button" class="pull-right btn btn-block btn-primary btn-flat col-md-3">     Add User</button></a>
      </div>
      
      </div>
      <br/>
        
      <div class="row">
          <div class="col-12">
            <div class="card">
              
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>User ID</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Mobile No</th>
                 <th>Actions</th>
                  </tr>
                      
                            <?php
                      include "actions/dbconnection.php";
                      $all_users_sql = "select * from op_users";
                      $all_users_query = mysqli_query($dbCon,$all_users_sql);
                      
                      while($users = mysqli_fetch_array($all_users_query)){
                         echo "<tr>";
                          echo "<td>".$users['USER_ID']."</td>";
                          echo "<td>".$users['FIRSTNAME']." ".$users['LASTNAME']."</td>";
                          echo "<td>".$users['USERNAME']."</td>";
                          echo "<td>".$users['MOBILE']."</td>";
                          echo "<td><a href=user-edit.php?user_id=".$users['USER_ID']."><span class='fa fa-edit'></span></a></td>";
                      }
                      
                      ?>
                      
                      
                      
              







                 
                </tbody></table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>



        
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  

 <?php include 'template/footer.php';  ?>