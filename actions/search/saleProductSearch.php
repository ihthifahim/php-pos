
<?php
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);

include "../dbconnection.php";
if(isset($_GET["query"]))
{
     $output = '';
     $query = "SELECT * FROM op_products WHERE PRODUCT_DESC LIKE '%".$_GET["query"]."%' LIMIT 10";
     $result = mysqli_query($dbCon, $query);
     $output = '<ul class="list-unstyled">';
     if(mysqli_num_rows($result) > 0)
     {
          while($row = mysqli_fetch_array($result))
          {
               //$output .= '<li class="product" value='.$row["PRODUCT_MRP"].' >'.$row["PRODUCT_DESC"].'</li>';
               $output .= "<li class=product>".$row["PRODUCT_DESC"]."</td>";

          }
     }
     else
     {

     }
     $output .= '</ul>';
     echo $output;
}





?>
