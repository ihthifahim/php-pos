<?php
date_default_timezone_set("Asia/Colombo");
session_start();


if(isset($_POST['submit'])){
    $cusid = $_POST['cusid'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $shipping = $_POST['shipping'];
    $datetime = date("Y-m-d H:i:s");
    $userid = $_SESSION['user_id'];
    $customerDOB = $_POST['dob'];


    require "dbconnection.php";
    $sql = "UPDATE op_customers SET FIRSTNAME = '".$firstname."'
    ,LASTNAME = '".$lastname."',EMAIL='".$email."'
    ,DELIVERY_ADDRESS='".$shipping."',MOBILE_NUMBER='".$mobile."'
    ,DATE_MODIFIED = '".$datetime."',DOB='".$customerDOB."' WHERE CUSTOMER_ID='".$cusid."'";

    if ($dbCon->query($sql) === TRUE) {

     header('Location: ../customer-view.php?cusid='.$cusid.'&CustomerUpdated');

   } else {
     header('Location: ../customers.php?CustomerUpdateFailed');
   }

}


?>
