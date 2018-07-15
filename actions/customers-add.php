<?php
date_default_timezone_set("Asia/Colombo");

//include('../includes/init.php');

if(isset($_POST['submit'])){

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $shipping = $_POST['shipping'];
    $datetime = date("Y-m-d H:i:s");
    $customerDOB = $_POST['dob'];

    if($customerDOB == ""){
      $customerDOB = "0000-00-00";
    }

      require "dbconnection.php";

      $stmt = $dbCon->prepare("INSERT INTO op_customers(FIRSTNAME,LASTNAME,EMAIL,DELIVERY_ADDRESS,MOBILE_NUMBER,DATE_CREATED,DATE_MODIFIED,DOB) VALUES(?,?,?,?,?,?,?,?)");
      $stmt->bind_param("sssssss",$firstname,$lastname,$email,$shipping,$mobile,$datetime,$datetime,$customerDOB);
      //$stmt->execute();

if($stmt->execute() == true){
$stmt->close();

//When Customer insert is done, customer is added to the points table
$last_id = $dbCon->insert_id;
$sql = "INSERT INTO op_customer_points (CUSTOMER_ID,CUSTOMER_POINTS,DATE_MODIFIED) VALUES ('".$last_id."','0','".$datetime."')";

if ($dbCon->query($sql) === TRUE) {
$dbCon->close();
header('Location: ../customers.php?CustomerAdded');

} else {

  //When Customer couldnt be added to the points table the customer is deleted
  $sqlRollbackCustomer = "DELETE FROM op_customers WHERE CUSTOMER_ID='".$last_id."'";
  $dbCon->query($sqlRollbackCustomer);
  $dbCon->close();
  header('Location: ../customers.php?CustomerFailedAdd123');

}

} else {
$dbCon->close();
  header('Location: ../customers.php?CustomerFailedAdd');
}


}


?>
