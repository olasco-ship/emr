<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 5/22/2019
 * Time: 2:42 PM
 */




require_once("initialize.php");

class Encounter extends DatabaseObject {

    protected static $table_name = "encounter";
    protected static $db_fields = array('id', 'sync', 'patient_id', 'consultant', 'case_note', 'next_appointment', 'status', 'drug', 'lab',
       'scan', 'date_only', 'date');
    public $id;
    public $sync;
    public $patient_id;
    public $consultant;
    public $case_note;
    public $next_appointment;
    public $status;
    public $drug;
    public $lab;
    public $scan;
    public $date_only;
    public $date;

    public static function findLastEncounterByPatientId($patient_id){
        global $database;
        $sql = "SELECT * FROM " .static::$table_name. " WHERE patient_id = $patient_id ORDER BY id DESC limit 1" ;
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
        //return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE patient_id = $patient_id ORDER BY id DESC limit 1" );
    }

    public static function find_all_by_patient($patient_id){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE patient_id = $patient_id ORDER BY date DESC " );
    }

    public static function find_all_radio_request(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE scan = 'REQUEST' ORDER BY date  " );
    }

    public static function find_all_lab_request(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE lab = 'REQUEST' ORDER BY date  " );
    }

    public static function find_all_prescribed_drugs(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE drug = 'REQUEST' ORDER BY date " );
    }

    public static function find_costed_drug($encounter_id=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE encounter_id = $encounter_id AND drug = 'COSTED' " );
    }

    public static function count_prescribed(){
        global $database;
        $sql = "SELECT COUNT(*) FROM " .static::$table_name . " WHERE drug = 'REQUEST' " ;
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    public static function count_lab_request(){
        global $database;
        $sql = "SELECT COUNT(*) FROM " .static::$table_name . " WHERE lab = 'REQUEST' " ;
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    public static function count_scan_request(){
        global $database;
        $sql = "SELECT COUNT(*) FROM " .static::$table_name . " WHERE scan = 'REQUEST' " ;
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }


    public static function find_btw_date($start_date, $end_date){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE date BETWEEN '$start_date' AND '$end_date' ORDER BY date DESC" );
    }




    public static function create_table(){
        $sql = 'CREATE TABLE IF NOT EXISTS ' . Encounter::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'patient_id  INT(11) NOT NULL, ' .
            'consultant VARCHAR(50) NOT NULL, ' .
            'case_note TEXT NOT NULL, ' .
            'next_appointment VARCHAR(80) NOT NULL, ' .
            'status VARCHAR(50) NOT NULL, ' .
            'drug VARCHAR(50) NOT NULL, ' .
            'lab VARCHAR(50) NOT NULL, ' .
            'scan VARCHAR(50) NOT NULL, ' .
            'date_only DATE NOT NULL, ' .
            'date DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';
        Encounter::run_script($sql);

    }
}

Encounter::create_table();



