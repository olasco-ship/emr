<?php

/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 6/13/2017
 * Time: 5:11 PM
 */

require_once("initialize.php");

class Result extends DatabaseObject
{

    protected static $table_name = "result";
    protected static $db_fields = array('id', 'exempted_by', 'sync', 'lab_no', 'bill_id','patient_id', 'labWalkIn_id', 'waiting_list_id',
         'test_request_id', 'ward', 'clinic', 'doctor', 'consultant',  'test', 'specimen', 'specimen_condition', 'other_specimen', 'date_col',
        'date_rec', 'time_col', 'time_rec', 'sample_col_by', 'sample_rec_by', 'doctor_note', 'scientist_note', 'path_note',
        'dept', 'unit', 'resultData', 'refRangeUnit', 'anti_one', 'scientist', 'pathologist', 'qc', 'qc_officer', 'qc_date', 'status', 'date');


    public $id;
    public $exempted_by;
    public $sync;
    public $lab_no;
    public $bill_id;
    public $patient_id;
    public $labWalkIn_id;
    public $waiting_list_id;
    public $test_request_id;
    public $ward;
    public $clinic;
    public $doctor;
    public $consultant;
    public $test;
    public $specimen;
    public $specimen_condition;
    public $date_col;
    public $date_rec;
    public $time_col;
    public $time_rec;
    public $sample_col_by;
    public $sample_rec_by;
    public $doctor_note;
    public $scientist_note;
    public $path_note;
    public $dept;
    public $unit;
    public $resultData;
    public $refRangeUnit;
    public $anti_one;
    public $scientist;
    public $pathologist;
    public $qc;
    public $qc_officer;
    public $qc_date;
    public $status;
    public $date;



    public static function find_by_waiting_list_id($waiting_list_id=0){
     //   return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE waiting_list_id = $waiting_list_id  " );
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE waiting_list_id= $waiting_list_id ");
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_by_test_request_id($test_request_id=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE test_request_id = $test_request_id  " );
    }

 public static function find_patient_test($patient_id, $dept){
        $sql = "SELECT * FROM " .static::$table_name. " WHERE patient_id = $patient_id AND dept = '$dept' ORDER BY date DESC LIMIT 1";
        $result_array = Result::find_by_sql($sql);
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }


   


    

    public static function find_by_test_request($id=0){
        global $database;
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE test_request_id=".$database->escape_value($id));
        return $result_array;
      //  return !empty($result_array) ? array_shift($result_array) : FALSE;
    }


    public static function count_pending(){
        global $database;
        $sql = "SELECT COUNT(*) FROM " .static::$table_name . " WHERE status = 'REQUEST' ";
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    public static function count_all_done(){
        global $database;
        $sql = "SELECT COUNT(*) FROM " .static::$table_name . " WHERE status = 'DONE' ";
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    public static function count_all_checked(){
        global $database;
        $sql = "SELECT COUNT(*) FROM " .static::$table_name . " WHERE qc_officer != '' ";
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    public static function find_all_checked(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE  qc_officer != '' ORDER BY date DESC " );
    }

    public static function find_all_checked_by_date($start_date, $end_date){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE  qc_officer != '' AND date BETWEEN '$start_date' AND '$end_date' ORDER BY date DESC " );
    }

    public static function find_all_checked_by_dept_date($dept,$start_date, $end_date){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE  qc_officer != '' AND dept = '$dept' AND date BETWEEN '$start_date' AND '$end_date' ORDER BY date DESC " );
    }

    public static function find_checked_test_request($test_request_id){
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE test_request_id= $test_request_id AND qc_officer != '' ORDER BY date DESC " );
        return $result_array;
    }

    public static function find_all_prelim_checked(){  
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE  qc_officer != '' AND status = 'PRELIM' ORDER BY date DESC " );
    }

    public static function find_all_prelim_checked_by_dept($dept){  
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE  qc_officer != '' AND status = 'PRELIM' AND dept = '$dept' ORDER BY date DESC " );
    }

    public static function count_all_prelim_checked(){
        global $database;
        $sql = "SELECT COUNT(*) FROM " .static::$table_name . " WHERE qc_officer != '' AND status = 'PRELIM' ORDER BY date DESC ";
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    public static function count_all_final_checked(){
        global $database;
        $sql = "SELECT COUNT(*) FROM " .static::$table_name . " WHERE qc_officer != '' AND status = 'FINAL' ORDER BY date DESC ";
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    public static function find_all_final_checked(){  
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE  qc_officer != '' AND status = 'FINAL' ORDER BY date DESC " );
    }

    public static function find_all_final_checked_by_dept($dept){  
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE  qc_officer != '' AND status = 'FINAL' AND dept = '$dept' ORDER BY date DESC " );
    }

    public static function find_all_checked_by_dept($dept){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE  qc_officer != '' AND dept = '$dept' ORDER BY date DESC " );
    }

    public static function find_all_pending_qc(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE (status = 'PRELIM' OR status = 'FINAL') AND qc_officer = '' ORDER BY date DESC " );
    }

    public static function count_all_pending_qc(){
        global $database;
        $sql = "SELECT COUNT(*) FROM " .static::$table_name . " WHERE (status = 'PRELIM' OR status = 'FINAL') AND qc_officer = '' ";
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }



    public static function find_all_pending_qc_by_dept($dept){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE (status = 'PRELIM' OR status = 'FINAL') AND qc_officer = '' AND dept = '$dept' ORDER BY date DESC " );
    }

    public static function find_all_by_status($status){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE status = '$status' ORDER BY date DESC " );
    }

    public static function find_all_by_status_and_dept($status, $dept){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE status = '$status' AND dept = '$dept' ORDER BY date DESC " );
    }

    public static function find_all_by_request(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE status = 'REQUEST' ORDER BY date DESC " );
    }

    public static function find_all_by_request_and_dept($dept){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE status = 'REQUEST' AND dept = '$dept' ORDER BY date DESC " );
    }

    public static function find_all_by_request_and_unit($unit){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE status = 'REQUEST' AND unit = '$unit' ORDER BY date DESC " );
    }


    public static function create_table(){
        $sql = 'CREATE TABLE IF NOT EXISTS ' . Result::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'exempted_by VARCHAR(50) NOT NULL, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'lab_no VARCHAR(50) NOT NULL, ' .
            'bill_id INT(11) NOT NULL, ' .
            'patient_id INT(11) NOT NULL, ' .  
            'labWalkIn_id INT(11) NOT NULL, ' .  
            'waiting_list_id INT(11) NOT NULL, ' .
            'test_request_id INT(11) NOT NULL, ' .
            'ward VARCHAR(50) NOT NULL, ' .
            'clinic VARCHAR(50) NOT NULL, ' .
            'doctor VARCHAR(50) NOT NULL, ' .
            'consultant VARCHAR(50) NOT NULL, ' .
            'test TEXT NOT NULL, ' .
            'specimen TEXT NOT NULL, ' .
            'specimen_condition VARCHAR(250) NOT NULL, ' .
            'date_col DATETIME NOT NULL, ' .
            'date_rec DATETIME NOT NULL, ' .
            'time_col TIME NOT NULL, ' .
            'time_rec TIME NOT NULL, ' .
            'sample_col_by VARCHAR(50) NOT NULL, ' .
            'sample_rec_by VARCHAR(50) NOT NULL, ' .
            'doctor_note TEXT NOT NULL, ' .
            'scientist_note TEXT NOT NULL, ' .
            'path_note TEXT NOT NULL, ' .
            'dept VARCHAR(50) NOT NULL, ' .
            'unit VARCHAR(50) NOT NULL, ' .
            'resultData TEXT NOT NULL, ' .
            'refRangeUnit TEXT NOT NULL, ' .
            'anti_one TEXT, ' .
            'scientist VARCHAR(50) NOT NULL, ' .
            'pathologist VARCHAR(50) NOT NULL, ' .
            'qc TEXT NOT NULL, ' .
            'qc_officer VARCHAR(50) NOT NULL, ' .
            'qc_date DATETIME NOT NULL, ' .
            'status VARCHAR(50) NOT NULL, ' .
            'date DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';
        Result::run_script($sql);
    }


}

Result::create_table();