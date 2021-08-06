<?php

require_once("initialize.php");

class Bill extends DatabaseObject {

    protected static $table_name = "bills";
    protected static $db_fields = array('id', 'sync', 'bill_number', 'exempted_by', 'payment_type', 'patient_id',
        'first_name', 'last_name', 'revenues', 'total_price', 'consultant', 'quantity','cost_by','revenue_officer',
        'payment_officer', 'status', 'receipt', 'dept', 'date_only', 'date');
       

    public $id;
    public $sync;
    public $bill_number;
    public $exempted_by;
    public $payment_type;
    public $patient_id;
    public $first_name;
    public $last_name;
    public $revenues;
    public $total_price;
    public $consultant;
    public $quantity;
    public $cost_by;
    public $revenue_officer;
    public $payment_officer;
    public $status;
    public $receipt;
    public $dept;
    public $date_only;
    public $date;


    public static function find_by_waiting_registration($bill_number){
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE revenues = 'Folder' AND dept = 'Records' AND status = 'PAID' AND bill_number = '$bill_number' ORDER BY date DESC " );
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_by_waiting_ref_registration($bill_number){
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE revenues = 'Ref-Folder' AND dept = 'Records' AND status = 'PAID' AND bill_number = '$bill_number' ORDER BY date DESC " );
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_by_waiting_consultation($bill_number){
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE revenues = 'Consultation' AND dept = 'Records' AND status = 'PAID' AND bill_number = '$bill_number' ORDER BY date DESC " );
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_waiting_registration(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE revenues = 'Folder' AND dept = 'Records' AND status = 'PAID' ORDER BY date DESC " );
    }

    public static function find_waiting_ref_registration(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE revenues = 'Ref-Folder' AND dept = 'Records' AND status = 'PAID' ORDER BY date DESC " );
    }

    public static function find_waiting_consultation(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE revenues = 'Consultation' AND dept = 'Records' AND status = 'PAID' ORDER BY date DESC " );
    }

    public static function find_by_auth_code($id=0){
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE receipt= '$id' ");
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

/*    public static function find_by_auth_code_by_status($id=0){
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE receipt= '$id' AND status != 'CLEARED' ");
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }*/

    public static function find_by_encounter_id($id=0){
        global $database;
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE status = 'COSTED' AND encounter_id=".$database->escape_value($id));
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_by_date_only($patient_id){
        return static::find_by_sql("SELECT DISTINCT date_only FROM " .static::$table_name. " WHERE patient_id = $patient_id " );
    }


    public static function find_by_patient_id($patient_id){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE patient_id = $patient_id " );
    }

    public static function find_all_requested($dept){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE dept = '$dept' AND status = 'REQUESTED' ORDER BY date DESC " );
    }

    public static function find_all_lab_request(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE lab = 'REQUEST' ORDER BY date DESC " );
    }


    public static function find_all_by_dept($dept){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE dept = '$dept' ORDER BY date DESC " );
    }

    public static function count_all_by_dept($dept){
        global $database;
        $sql = "SELECT COUNT(*) FROM " .static::$table_name . " WHERE dept = '$dept' LIMIT 500 ";
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    public static function count_all_by_dept_and_paid($dept){
        global $database;
        $sql = "SELECT COUNT(*) FROM " .static::$table_name . " WHERE dept = '$dept' AND status = 'PAID' ";
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    public static function find_all_by_dept_and_paid($dept){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE dept = '$dept' AND status = 'PAID' ORDER BY date DESC " );
    }

    public static function find_dispensed_drugs($dept){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE dept = '$dept' AND status = 'DISPENSED' ORDER BY date DESC " );
    }

    public static function count_dispensed_drugs($dept){
        global $database;
        $sql = "SELECT COUNT(*) FROM " .static::$table_name . " WHERE dept = '$dept' AND status = 'DISPENSED' ";
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    public static function count_pending_bills(){
        global $database;
        $sql = "SELECT COUNT(*) FROM " .static::$table_name . " WHERE status = 'COSTED' ";
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

/*    public static function count_billed(){
        global $database;
        $sql = "SELECT COUNT(*) FROM " .static::$table_name . " WHERE status = 'billed' ";
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }*/

    public static function count_billed($dept){
        global $database;
        $sql = "SELECT COUNT(*) FROM " .static::$table_name . " WHERE status = 'billed' AND dept = '$dept'  ";
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

/*    public static function count_billed_scan(){
        global $database;
        $sql = "SELECT COUNT(*) FROM " .static::$table_name . " WHERE status = 'billed' AND dept = 'scan'  ";
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    public static function count_billed_drug(){
        global $database;
        $sql = "SELECT COUNT(*) FROM " .static::$table_name . " WHERE status = 'billed' AND dept = 'drug'  ";
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }*/

    public static function count_paid_bill(){
        global $database;
        $sql = "SELECT COUNT(*) FROM " .static::$table_name . " WHERE status = 'PAID' ";
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    public static function count_paid($dept){
        global $database;
        $sql = "SELECT COUNT(*) FROM " .static::$table_name . " WHERE status = 'PAID' AND dept = '$dept' ";
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

        public static function count_cleared_bill(){
        global $database;
        $sql = "SELECT COUNT(*) FROM " .static::$table_name . " WHERE status = 'CLEARED' ";
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }




    public static function find_all_by_date(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " ORDER BY date DESC " );
    }

    public static function find_by_status(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE status = 'COSTED' ORDER BY date DESC " );
    }

    public static function find_billed(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE status = 'billed' ORDER BY date DESC " );
    }

    public static function find_billed_drug(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE status = 'billed' AND dept = 'drug' ORDER BY date DESC " );
    }

    public static function find_billed_lab(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE status = 'billed' AND dept = 'lab' ORDER BY date DESC " );
    }

    public static function find_billed_scan(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE status = 'billed' AND dept = 'scan' ORDER BY date DESC " );
    }

    public static function find_cleared(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE status = 'CLEARED' ORDER BY date DESC " );
    }

    public static function find_paid(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE status = 'PAID' ORDER BY date DESC " );
    }


    public static function find_by_price_exception_only($start_date, $end_date){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE total_price != actual_price AND exempted_by != '' AND date_generated BETWEEN '$start_date' AND '$end_date' ORDER BY date_generated DESC" );
    }

    public static function find_by_outstanding($start_date, $end_date){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE total_price != actual_price AND payment_type != '' AND date_generated BETWEEN '$start_date' AND '$end_date' ORDER BY date_generated DESC" );
    }

    public static function find_btw_date_by_officer($officer, $start_date,  $end_date){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE revenue_officer = '$officer' AND date_generated BETWEEN '$start_date' AND '$end_date' ORDER BY date_generated DESC");
    }

    public static function find_by_bill_number($bill_number=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE bill_number = $bill_number " . " ORDER BY date_generated DESC");
    }

    public static function find_bill_number($bill_number)
    {
        $sql = "SELECT * FROM " . static::$table_name . " WHERE bill_number= '{$bill_number}' LIMIT 1";
        $result_array = Bill::find_by_sql($sql);
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_unused_bill_number($bill_number)
    {
        $sql = "SELECT * FROM " . static::$table_name . " WHERE bill_number= '{$bill_number}' LIMIT 1";
        $result_array = Bill::find_by_sql($sql);
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }


    public static function find_by_bill_or_patient($query){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE bill_number LIKE '%$query%' OR patient_name LIKE '%$query%' " . " ORDER BY date_generated DESC");
    }

    public static function find_all_by_sync(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE sync = 'unsync' " );
    }

    public static function find_by_price_exception($start_date, $end_date){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE total_price != actual_price AND date_generated BETWEEN '$start_date' AND '$end_date' ORDER BY date_generated DESC" );
    }

    public static function sum_all_standard_price($start_date, $end_date){
        global $database;
        $sql = "SELECT SUM(total_price) FROM " .static::$table_name . " WHERE date_generated BETWEEN '$start_date' AND '$end_date' ORDER BY date_generated DESC" ;
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    public static function sum_all_actual_price($start_date, $end_date){
        global $database;
        $sql = "SELECT SUM(actual_price) FROM " .static::$table_name . " WHERE date_generated BETWEEN '$start_date' AND '$end_date' ORDER BY date_generated DESC" ;
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    public static function find_btw_date($start_date, $end_date){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE date BETWEEN '$start_date' AND '$end_date' ORDER BY date DESC" );
    } 

    public static function find_unpaid_bills_btw_date($start_date, $end_date){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE status = 'billed' AND date BETWEEN '$start_date' AND '$end_date' ORDER BY date DESC" );
    }     

    public static function find_unpaid_bills_dept_btw_date($dept, $start_date, $end_date){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE status = 'billed' AND dept = '$dept' AND date BETWEEN '$start_date' AND '$end_date' ORDER BY date DESC" );
    }

    public static function find_paid_bills_btw_date($start_date, $end_date){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE receipt != '' AND date BETWEEN '$start_date' AND '$end_date' ORDER BY date DESC" );
    }

    public static function find_paid_bills_dept_btw_date($dept, $start_date, $end_date){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE receipt != '' AND dept = '$dept' AND date BETWEEN '$start_date' AND '$end_date' ORDER BY date DESC" );
    }

    public static function find_btw_date_by_dept($dept, $start_date, $end_date){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE dept = '$dept' AND date BETWEEN '$start_date' AND '$end_date' ORDER BY date DESC" );
    }

    public static function find_all_order_by_date(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " ORDER BY date_generated DESC LIMIT 500 ");
    }

    public static function find_last_id(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " ORDER BY id DESC LIMIT 1");
    }

    public static function create_table(){
        $sql = 'CREATE TABLE IF NOT EXISTS ' . Bill::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'bill_number VARCHAR(50) NOT NULL, ' .
            'exempted_by VARCHAR(50) NOT NULL, ' .
            'payment_type VARCHAR(50) NOT NULL, ' .
            'patient_id  INT(11) NOT NULL, ' .
            'first_name VARCHAR(80) NOT NULL, ' .
            'last_name VARCHAR(80) NOT NULL, ' .
            'revenues TEXT NOT NULL, ' .
            'total_price INT(11) NOT NULL, ' .
            'consultant VARCHAR(80) NOT NULL, ' .
            'quantity INT(11) NOT NULL, ' .
            'cost_by VARCHAR(50) NOT NULL, ' .
            'revenue_officer VARCHAR(50) NOT NULL, ' .
            'payment_officer VARCHAR(50) NOT NULL, ' .
            'status VARCHAR(50) NOT NULL, ' .
            'receipt VARCHAR(50) NOT NULL, ' .
            'dept VARCHAR(50) NOT NULL, ' .
            'date_only DATE NOT NULL, ' .
            'date DATETIME NOT NULL, ' .
            'PRIMARY KEY(id), ' .
            'UNIQUE KEY(bill_number))';
        Bill::run_script($sql);
    }
}

Bill::create_table();



