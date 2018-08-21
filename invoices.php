<?php
$title = "Invoices";

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
            <h1 class="m-0 text-dark">Invoices</h1>
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
                  <input type="text" class="form-control" placeholder="Search by invoice number" id="search_text">
                  <span class="input-group-append">
                    <button type="button" class="btn btn-info btn-flat">Go!</button>
                  </span>
                </div>
                      </div>


      <div class="col-md-6">
          <div class="row">
          <div class="col-md-6">
              <form action="view_invoices.php" method="get">
                   <div class="row">

                    <label class="col-md-4">From Date:</label>
                    <input type="date" class="form-control col-md-7" id="datepicker" name="fromDate">

                  </div>

              </div>


              <div class="col-md-6">
                 <div class="row">

                    <label class="col-md-4">To Date:</label>
                    <input type="date" class="form-control col-md-7" id="datepicker" name="toDate">

                  </div>

              </div>

          </div>

      </div>

          <div class="col-md-2">
          <button type="submit" class="btn btn-primary btn-block" name="searchInvoice">Search</button>
              </form>
          </div>
          </div>

      </div>
      <br/>

      <div class="row">
          <div class="col-12">
            <div class="card">

              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead><tr>
                    <th>Invoice Number</th>
                    <th>Invoice Date</th>
                    <th>Customer Email</th>
                    <th>Invoice Total</th>
                      <th>Invoice User</th>
                      <th>Payment Method</th>
                      <th>Payment Status</th>
                    <th>Actions</th>
                  </tr>
                    </thead>

                      <script>

              $(document).ready(function(){


               load_data();

               function load_data(query)
               {
                $.ajax({
                 url:"actions/search/invoices.php?query",
                 method:"GET",
                 data:{query:query},
                 success:function(data)
                 {
                  $('#result').html(data);
                 }
                });
               }


               $('#search_text').keyup(function(){
                var search = $(this).val();
                if(search != '')
                {
                 load_data(search);
                }
                else
                {
                 load_data();
                }
               });


              });


              </script>




                    <tbody id="result">














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
