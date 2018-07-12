<?php

error_reporting(E_ALL);

//include('includes/init.php');
include('actions/auth.php');




?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>OCTAPAY</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css">
    <script src="dist/js/jquery.js"></script>
    
  
    
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.css">
    <link rel="stylesheet" href="assets/css/custom.css">


<script src="assets/js/sweetalert/sweetalert.min.js"></script>



        
   



            <style>
 .popup-box
            {
                display: block;
                position: fixed;
                bottom: 0px;
                right: 10px;
                height: 360px;
                background-color: rgb(237, 239, 244);
                width: 300px;
                border: 1px solid rgba(29, 49, 91, .3);
            }




              #ProductNameList{
                position: absolute;
                z-index: 1;
                margin-top:43px;
                margin-left: 12px;


              }
              #ProductNameList ul{
                background-color:#3c8dbc;
                cursor:pointer;
              }
              #ProductNameList li{
                  padding:12px;
                  font-size: 18px;
                  color: white;
              }

                
                #CustomerList{
                position: absolute;
                z-index: 1;
                margin-top:40px;
                margin-left: 0px;
                width: 180px;
                height: 400px;


              }
              #CustomerList ul{
                background-color:#3c8dbc;
                cursor:pointer;
                  
              }
              #CustomerList li{
                  padding:5px;
                  font-size: 14px;
                  color: white;
              }




            </style>










</head>

<body class="hold-transition sidebar-mini sidebar-collapse">

<div class="wrapper">
