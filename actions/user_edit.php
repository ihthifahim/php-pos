<?php

include 'dbconnection.php';

if(isset($_POST['updateUser'])){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $access = $_POST['accessLevel'];
    $user_id = $_POST['user_id'];
    $datetime = date("Y-m-d H:i:s");
    $username = $_POST['username'];

    $update_sql = "UPDATE op_users SET FIRSTNAME='".$firstname."',LASTNAME='".$lastname."',EMAIL='".$email."',MOBILE='".$mobile."',USER_LEVEL='".$access."',DATE_MODIFIED='".$datetime."',USERNAME='".$username."' WHERE USER_ID='".$user_id."'";
    $update_query = mysqli_query($dbCon,$update_sql);

    if($update_query == TRUE){

        header('Location: ../user-edit.php?user_id='.$user_id.'&userUpdated');
    } else {
        echo mysqli_error($dbCon);
    }

}


if(isset($_POST['updatePassword'])){
    $user_id = $_POST['user_id'];
    $password = $_POST['password'];

    $update_pass_sql = "UPDATE op_users SET PASSWORD='".$password."' WHERE USER_ID='".$user_id."'";
    $update_pass_query = mysqli_query($dbCon,$update_pass_sql);

    if($update_pass_query == TRUE){
        header('Location: ../user-edit.php?user_id='.$user_id.'&passUpdated');
    } else {
        echo mysqli_error($dbCon);
    }
}








?>
