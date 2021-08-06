<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 1/31/2019
 * Time: 5:15 PM
 */

//require_once("initialize.php");

class Admission extends DatabaseObject {

    protected static $table_name = "admission"; 
    protected static $db_fields = array('id', 'sync', 'patient_id', 'in_patient_id', 'adm_doct', 'adm_nurse', 'adm_diagnosis',
     'adm_purpose', 'adm_date', 'adm_type', 'discharge_doct', 'discharge_nurse', 'discharge_date', 'referral_source',
     'discharge_type', 'discharge_outcome', 'disposition_mode',
     'location', 'ward_no', 'room_no', 'bed_no', 'm_s', 'ipd_service', 'deposit', 'wall_balance', 'remark_doctor',
     'remark_nurse', 'adm_status', 'created' );


    public $id;
    public $sync;
    public $patient_id;
    public $in_patient_id;

    public $adm_doct;
    public $adm_nurse;
    public $adm_diagnosis;
    public $adm_purpose;
    public $adm_date;
    public $adm_type;

    public $discharge_doct;
    public $discharge_nurse;
    public $discharge_date;
    public $referral_source;

    public $discharge_type;
    public $discharge_outcome;
    public $disposition_mode;

    public $location;
    public $ward_no;
    public $room_no;
    public $bed_no;
    public $m_s;
    public $ipd_service;
    public $deposit;
    public $wall_balance;
    public $remark_doct;
    public $remark_nurse;
    public $adm_status;
    public $created;


    public static function find_all_adm_by_patient($patient_id){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE patient_id = $patient_id ORDER BY adm_date DESC " );
    }

    public static function find_admitted_by_patient_id($patient_id){
        $result_array =  static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE patient_id = $patient_id AND adm_status = 'Admitted' " );
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_admitted_by_date($start_date, $end_date){    
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE adm_date BETWEEN '$start_date' and '$end_date' ");
    }
	

    public static function create_table(){
        $sql = 'CREATE TABLE IF NOT EXISTS ' . Admission::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'patient_id VARCHAR(50) NOT NULL, ' .
            'in_patient_id VARCHAR(255) NOT NULL, ' .


            'adm_doct VARCHAR(80) NOT NULL, ' .
            'adm_nurse VARCHAR(80) NOT NULL, ' .
            'adm_diagnosis VARCHAR(100) NOT NULL, ' .
            'adm_purpose VARCHAR(100) NOT NULL, ' .
            'adm_date DATETIME NOT NULL, ' .
            'adm_type VARCHAR(50) NOT NULL, ' .
            
            'discharge_doct VARCHAR(100) NOT NULL, ' .
            'discharge_nurse VARCHAR(100) NOT NULL, ' .
            'discharge_date DATETIME NOT NULL, ' .
            'referral_source VARCHAR(50) NOT NULL, ' .

            'discharge_type VARCHAR(100) NOT NULL, ' .
            'discharge_outcome VARCHAR(100) NOT NULL, ' .
            'disposition_mode VARCHAR(100) NOT NULL, ' .

            'location VARCHAR(50) NOT NULL ,' .
            'ward_no VARCHAR(50) NOT NULL, ' .
            'room_no VARCHAR(30) NOT NULL, ' .
            'bed_no VARCHAR(50) NOT NULL, ' .
            'm_s VARCHAR(80) NOT NULL, ' .
            'ipd_service VARCHAR(255) NOT NULL, ' .
            'deposit VARCHAR(30) NOT NULL, ' .
            'wall_balance VARCHAR(30) NOT NULL, ' .
            'remark_doct text NOT NULL, ' .
            'remark_nurse text NOT NULL, ' .
            'adm_status VARCHAR(50) NOT NULL, ' .
            'created DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';
            Admission::run_script($sql);

    }
}

Admission::create_table();



