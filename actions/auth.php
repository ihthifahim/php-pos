<?php

session_start();



if($_SESSION['auth'] == "" && $_SESSION['user_level'] == ""){
    header('Location: login.php?sessiondestroyed');
}

?>