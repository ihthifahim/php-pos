
<?php
include "../dbconnection.php";

if(isset($_GET["query"]))
{
     $output = '';
     //$query = "SELECT * FROM customers WHERE '%".$_POST["query"]."%' IN(CUSTOMER_FIRSTNAME, CUSTOMER_LASTNAME)";
     $query = "SELECT * FROM op_customers WHERE EMAIL LIKE '%".$_GET["query"]."%' LIMIT 3";
     $result = mysqli_query($dbCon, $query);
     $output = '<ul class="list-unstyled">';
     if(mysqli_num_rows($result) > 0)
     {
          while($row = mysqli_fetch_array($result))
          {
               $output .= '<li class="customer">'.$row["EMAIL"].'</li>';
          }
     }
     else
     {

     }
     $output .= '</ul>';
     echo $output;
}







?>
