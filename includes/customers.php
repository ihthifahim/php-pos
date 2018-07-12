<?php

require_once("database.php");

date_default_timezone_set("Asia/Colombo");





class Customers{

public $firstname;
public $lastname;
public $dob;
public $email;
public $delivery_address;
public $mobile_number;
public $last_visited;
public $date_created;
public $date_modified;



    public function get_all_customers(){
    global $database;

    $result_set = $database->query("SELECT * FROM op_customers");

        return $result_set;


    }

    public function count_all_customers(){
        global $database;

        $result_set = $database->query("select COUNT(CUSTOMER_ID) as count from op_customers");
        return $result_set;
    }


    public function find_customer($customer_id){
        global $database;
    $result_set = $database->query("SELECT * FROM op_customers WHERE CUSTOMER_ID='".$customer_id."'");
        return $result_set;

    }

    public function get_points($customer_id){
      global $database;
      $result_set = $database->query("SELECT * FROM op_customer_points WHERE CUSTOMER_ID='".$customer_id."'");
      return $result_set;
    }
    
    public function get_customer_id($customer_email){
      global $database;
      $result_set = $database->query("SELECT * FROM op_customers WHERE EMAIL='".$customer_email."'");
      return $result_set;
    }


    public function get_customer_invoices($customer_id){
      global $database;

      $result_set = $database->query("SELECT * FROM op_invoice_main WHERE CUSTOMER_ID='".$customer_id."'");
      return $result_set;
    }

    public function count_sales($customer_id){
      global $database;

      $result_set = $database->query("SELECT SUM(INVOICE_TOTAL) as totalsales FROM op_invoice_main WHERE CUSTOMER_ID='".$customer_id."'");
      return $result_set;
    }

    public function count_profit($customer_id){
      global $database;

      $result_set = $database->query("SELECT SUM(INVOICE_PROFIT) as totalprofit FROM op_invoice_main WHERE CUSTOMER_ID='".$customer_id."'");
      return $result_set;
    }










}// End of customer class


$customers = new Customers();








?>
