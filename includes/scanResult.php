<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 6/13/2019
 * Time: 9:40 AM
 */




require_once("initialize.php");

class ScanResult extends DatabaseObject
{

    protected static $table_name = "scanResult";
    protected static $db_fields = array('id', 'exempted_by', 'sync', 'xray_no', 'bill_id', 'patient_id', 'waiting_list_id',
        'scan_request_id', 'ward', 'clinic', 'doctor', 'consultant', 'scan', 'date_ex', 'time_ex', 'doctor_note',
        'radiologist_note', 'resultData', 'clinical', 'diagnosis', 'radiology', 'ultrasound', 'radiologist',
        'dept', 'dept_id', 'status', 'date');

    public $id;
    public $exempted_by;
    public $sync;
    public $xray_no;
    public $bill_id;
    public $patient_id;
    public $waiting_list_id;
    public $scan_request_id;
    public $ward;
    public $clinic;
    public $doctor;
    public $consultant;
    public $scan;
    public $date_ex;
    public $time_ex;
    public $doctor_note;
    public $radiologist_note;
    public $resultData;
    public $clinical;
    public $diagnosis;
    public $radiology;
    public $ultrasound;
    public $radiologist;
    public $dept;
    public $dept_id;
    public $status;
    public $date;


    public static function find_by_waiting_list_id($waiting_list_id=0){
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE waiting_list_id= $waiting_list_id ");
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_by_scan_request($id=0){
        global $database;
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE scan_request_id=".$database->escape_value($id));
        return $result_array;
      //  return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_completed_results_by_scan_req($scan_request_id){
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE scan_request_id= $scan_request_id AND status = 'DONE' ORDER BY date DESC " );
        return $result_array;
    }

    public static function find_completed_results(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE status = 'DONE' ORDER BY date DESC " );
    }

    public static function find_completed_results_date($start_date, $end_date){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE status = 'DONE' AND date BETWEEN '$start_date' AND '$end_date' ORDER BY date DESC" );
    }


    public static function count_pending(){
        global $database;
        $sql = "SELECT COUNT(*) FROM " .static::$table_name . " WHERE status = 'REQUEST' ";
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    public static function count_result(){
        global $database;
        $sql = "SELECT COUNT(*) FROM " .static::$table_name . " WHERE status = 'DONE' ";
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }


    public static function find_by_encounter_id($encounter_id=0){
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE encounter_id= $encounter_id " );
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }


    public static function find_all_result_by_date($patient_id, $start_date, $end_date){
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE patient_id= $patient_id AND date BETWEEN '$start_date' AND '$end_date' ORDER BY date DESC ");
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_by_bill_id($bill_id){
        global $database;
        //  $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE bill_id=".$database->escape_value($bill_id));
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE bill_id= $bill_id ");
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_by_patient_id($patient_id){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE patient_id = $patient_id " );
    }

    public static function find_dept_btw_date($dept_id, $start_date,  $end_date){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE dept_id = $dept_id AND date BETWEEN '$start_date' AND '$end_date' ORDER BY date DESC");
    }

    public static function find_btw_date($start_date, $end_date){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE date BETWEEN '$start_date' AND '$end_date' ORDER BY date DESC" );
    }


    public static function count_by_patient($query){
        return static::find_by_sql("SELECT COUNT(*) FROM " .static::$table_name . " WHERE patient_name LIKE '%$query%' " . " ORDER BY date DESC");
    }

    public static function find_by_patient($query){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE patient_name LIKE '%$query%' " . " ORDER BY date DESC");
    }

    public static function find_by_patient_test_id($query){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE patient_name LIKE '%$query%' AND test_id " . " ORDER BY date DESC");
    }

    public static function find_by_patient_and_test_id($query, $test_id){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE patient_name LIKE '%$query%' AND test_id = $test_id " . " ORDER BY date DESC");
    }

    public static function count_all_by_dept($dept){
        global $database;
        $sql = "SELECT COUNT(*) FROM " .static::$table_name . " WHERE dept_id = $dept ";
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    public static function find_all_auto_sync(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE sync = 'unsync' LIMIT 200 " );
    }


    public static function find_all_by_sync(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE sync = 'unsync' " );
    }

    public static function find_all_by_sync_by_date($start_date, $end_date){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE sync = 'unsync' AND date BETWEEN '$start_date' AND '$end_date' LIMIT 200 " );
    }

    public static function find_all_by_date(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " ORDER BY date DESC LIMIT 500 ");
    }

    public static function find_last_id(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " ORDER BY id DESC LIMIT 1");
    }

    public static function find_all_by_dept($dept=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE dept_id = $dept ORDER BY date DESC ");
    }

    public static function find_all_by_test_id($test_id=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE test_id = $test_id ORDER BY date DESC ");
    }

    public static function find_last_id_by_dept($dept=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE dept_id = $dept ORDER BY id DESC LIMIT 1 ");
    }

    public static function find_last_date(){
        return static::find_by_sql("SELECT date FROM " .static::$table_name . " ORDER BY id DESC LIMIT 1");
    }

    public static function create_table(){
        $sql = 'CREATE TABLE IF NOT EXISTS ' . ScanResult::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'exempted_by VARCHAR(50) NOT NULL, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'xray_no VARCHAR(50) NOT NULL, ' .
            'bill_id INT(11) NOT NULL, ' .
            'patient_id INT(11) NOT NULL, ' .
            'waiting_list_id INT(11) NOT NULL, ' .        
            'scan_request_id INT(11) NOT NULL, ' .
            'ward VARCHAR(80) NOT NULL, ' .
            'clinic VARCHAR(80) NOT NULL, ' .
            'doctor VARCHAR(80) NOT NULL, ' .
            'consultant VARCHAR(80) NOT NULL, ' .
            'scan TEXT NOT NULL, ' .
            'date_ex DATETIME NOT NULL, ' .
            'time_ex TIME NOT NULL, ' .
            'doctor_note TEXT NOT NULL, ' .
            'radiologist_note TEXT NOT NULL, ' .
            'resultData TEXT NOT NULL, ' .
            'clinical TEXT NOT NULL, ' .
            'diagnosis TEXT NOT NULL, ' .
            'radiology VARCHAR(50) NOT NULL, ' .
            'ultrasound VARCHAR(50) NOT NULL, ' .
            'radiologist VARCHAR(80) NOT NULL, ' .
            'dept VARCHAR(80) NOT NULL, ' .
            'dept_id INT(11) NOT NULL, ' .
            'date DATETIME NOT NULL, ' .
            'status VARCHAR(50) NOT NULL, ' .
            //    'UNIQUE KEY(lab_code), ' .
            'PRIMARY KEY(id))';
        ScanResult::run_script($sql);
    }


}

ScanResult::create_table();