
<?php
//Customer notifications
if(isset($_GET['CustomerAdded'])){ ?>

  <script>
  $(document).ready(function(){
    swal("Good job!", "Customer Succussfully Added!", "success");

  });
  </script>

<?php } ?>




<?php
//===================================================================================================
if(isset($_GET['CustomerFailedAdd'])){ ?>

  <script>
  $(document).ready(function(){
    swal("Oopss", "Customer Failed to Add! Please try again.", "error");

  });
  </script>

<?php } ?>



<?php
//===================================================================================================
if(isset($_GET['CustomerUpdated'])){ ?>

  <script>
  $(document).ready(function(){
    swal("Good job!", "Customer Succussfully Updated!", "success");

  });
  </script>

<?php } ?>



<?php
//===================================================================================================
if(isset($_GET['CustomerUpdateFailed'])){ ?>

  <script>
  $(document).ready(function(){
      swal("Oopss", "Customer Failed to Update! Please try again.", "error");

  });
  </script>

<?php } ?>


<?php
//===================================================================================================
if(isset($_GET['CustomerDeleted'])){ ?>

  <script>
  $(document).ready(function(){
      swal("Good Job", "Customer Successfully Deleted", "success");

  });
  </script>

<?php } ?>







<?php
//Products Notification
//===================================================================================================
if(isset($_GET['ProductCategoryAdded'])){ ?>

  <script>
  $(document).ready(function(){
      swal("Good job!", "Product Category Succussfully Added", "success");

  });
  </script>

<?php } ?>




<?php

//===================================================================================================
if(isset($_GET['ProductAdded'])){ ?>

  <script>
  $(document).ready(function(){
      swal("Good job!", "Product Succussfully Added", "success");

  });
  </script>

<?php } ?>



<?php

//===================================================================================================
if(isset($_GET['ProductFailedAdd'])){ ?>

  <script>
  $(document).ready(function(){
      swal("Oopss", "Product Failed to add! Please try again.", "error");

  });
  </script>

<?php } ?>






<?php

//===================================================================================================
if(isset($_GET['PriceError'])){ ?>

  <script>
  $(document).ready(function(){
      swal("Oopss", "Product Failed to Update! Cost Price is more than the Retail Price.", "error");

  });
  </script>

<?php } ?>




<?php

//===================================================================================================
if(isset($_GET['ProductUpdated'])){ ?>

  <script>
  $(document).ready(function(){
      swal("Good Job", "Product Successfully Updated", "success");

  });
  </script>

<?php } ?>



<?php

//===================================================================================================
if(isset($_GET['ProductDeleted'])){ ?>

  <script>
  $(document).ready(function(){
      swal("Good Job", "Product Successfully Deleted", "success");

  });
  </script>

<?php } ?>








<?php
//SUPPLIERS NOTIFICATIONS
//===================================================================================================
if(isset($_GET['SupplierAdded'])){ ?>

  <script>
  $(document).ready(function(){
      swal("Good Job", "Supplier Successfully Deleted", "success");

  });
  </script>

<?php } ?>



<?php

//===================================================================================================
if(isset($_GET['SupplierUpdated'])){ ?>

  <script>
  $(document).ready(function(){
      swal("Good Job", "Supplier Successfully Updated", "success");

  });
  </script>

<?php } ?>



<?php

//===================================================================================================
if(isset($_GET['SupplierDeleted'])){ ?>

  <script>
  $(document).ready(function(){
      swal("Good Job", "Supplier Successfully Deleted", "success");

  });
  </script>

<?php } ?>


<?php

//===================================================================================================
if(isset($_GET['userUpdated'])){ ?>

  <script>
  $(document).ready(function(){
      swal("Good Job", "User Successfully Updated", "success");

  });
  </script>

<?php } ?>




<?php

//===================================================================================================
if(isset($_GET['passUpdated'])){ ?>

  <script>
  $(document).ready(function(){
      swal("Good Job", "Password Successfully Updated", "success");

  });
  </script>

<?php } ?>

<?php

//===================================================================================================
if(isset($_GET['mail'])){ ?>

  <script>
  $(document).ready(function(){
      swal("Mail Sent", "Mail successfully sent to the customer", "success");

  });
  </script>

<?php } ?>
