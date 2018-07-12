<?php

require_once("database.php");

date_default_timezone_set("Asia/Colombo");

class Logs{

  public $comment;
  public $userid;
  public $level;
  public $datetime;

public function writeLog($comment,$level,$datetime){

global $database;

$sql = "INSERT INTO op_logs (COMMENT,CRITICAL_LEVEL,DATE_CREATED) VALUES ('".$comment."','".$level."','".$datetime."')";

if($database->query($sql)){
    return true;
} else {
    return false;
}

}


}

$log = new Logs();

 ?>
