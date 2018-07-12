<?php

require_once("database.php");

date_default_timezone_set("Asia/Colombo");


class Users{

public function find_user($user_id){
  global $database;
  $result_set = $database->query("SELECT * FROM op_users WHERE USER_ID='".$user_id."'");
  return $result_set;

}




}




$users = new Users();







 ?>
