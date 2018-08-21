<?php
date_default_timezone_set("Asia/Colombo");

if(isset($_POST['adduser'])){

  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $email = $_POST['email'];
  $mobile = $_POST['mobile'];
  $datetime = date("Y-m-d H:i:s");

  $username = $_POST['username'];
  $password = $_POST['password'];
  $access = $_POST['access'];

  require 'dbconnection.php';

  $insert_sql = "INSERT INTO op_users (FIRSTNAME,LASTNAME,EMAIL,MOBILE,USERNAME,PASSWORD,USER_LEVEL,DATE_CREATED) VALUES ('".$firstname."','".$lastname."','".$email."','".$mobile."','".$username."','".$password."','".$access."','".$datetime."')";
  $insert_query = mysqli_query($dbCon,$insert_sql);

  if($insert_query == true){
    header('Location: ../users.php?useradded');
  }


}



 ?>
