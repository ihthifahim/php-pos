<?php
session_start();
if($_SESSION['auth'] == 1){
    header('Location: dashboard.php');
} else {
    header('Location: login.php');
}






?>