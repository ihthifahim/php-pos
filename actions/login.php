<?php
session_start();
//include('../includes/init.php');

if(isset($_POST['login'])){
    require "dbconnection.php";
    $datetime = date("Y-m-d H:i:s");
    $username = mysqli_escape_string($dbCon,$_POST['username']);
    $password = mysqli_escape_string($dbCon,$_POST['password']);
    
    $sql = "select * from op_users where USERNAME='".$username."' && PASSWORD = '".$password."'";

$result = mysqli_query($dbCon, $sql);
$fetchresult = mysqli_fetch_array($result);
$resultcheck = mysqli_num_rows($result);

if($resultcheck > 0){
    $_SESSION['user_id'] = $fetchresult['USER_ID'];
    $_SESSION['user_firstname'] = $fetchresult['FIRSTNAME'];
    $_SESSION['user_lastname'] = $fetchresult['LASTNAME'];
    $_SESSION['auth'] = 1;
    $_SESSION["user_level"] = $fetchresult['USER_LEVEL'];
    
    $sqlLog = "INSERT INTO op_logs (COMMENT,LOG_CAT,DATE_CREATED) VALUES ('Logged in as ".$_SESSION['user_firstname']."',1,'".$datetime."')";
    mysqli_query($dbCon, $sqlLog);  
    
    header('Location: ../dashboard.php');
    exit();
    
} else {
    $_SESSION['user_firstname'] = "";
    $_SESSION['user_lastname'] = "";
    $_SESSION['auth'] = 0;
    $_SESSION['user_level'] = "";
    $_SESSION['user_id'] = "";
    
    header('Location: ../login.php?l2');
}

    
}



if(isset($_GET['logout'])){
    session_destroy();
    header('Location: ../login.php?logout');
    exit();
}


//need to change
if(isset($_GET['sessiondestroyed'])){
    session_destroy();
    header('Location: ../login.php?sessiondestroyed');
    exit();
}






?>