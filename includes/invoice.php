<?php


require_once("database.php");

class Invoices{
    
    
    
    // get max invoice id from a customer

    public function get_max_invoice_id($customer_id){
        global $database;

        $result_set = $database->query("select MAX(INVOICE_ID) as lastInvoiceID from op_invoice_main where CUSTOMER_ID='".$customer_id."'");
        return $result_set;
    }
    
    //get invoice number from invoice id
    public function get_invoice_number($invoice_id){
        
        global $database;

        $result_set = $database->query("select * from op_invoice_main where INVOICE_ID='".$invoice_id."'");
        return $result_set;
        
    }
    
    
    
    
    
    
}




$invoice = new Invoices();

?>