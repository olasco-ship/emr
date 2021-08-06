<?php

require_once("initialize.php");

class PatientSubClinic extends DatabaseObject
{
    protected static $table_name = "patient_subClinic";
    protected static $db_fields = array('id', 'sync', 'patient_id', 'sub_clinic_id', 'clinic_id', 'clinic_number', 'date');
    public $id;
    public $sync;
    public $patient_id;
    public $sub_clinic_id;
    public $clinic_id;
    public $clinic_number;
    public $date;

    public static function find_pat_and_subclinic($patient_id, $sub_clinic_id){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE patient_id = $patient_id AND sub_clinic_id = $sub_clinic_id ");
    }

    public static function find_patient_clinics($patient_id){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE patient_id = '$patient_id' ");
    } 

    public static function find_by_patient_id($patient_id=0){
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE patient_id = '$patient_id'" );
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_by_clinic($clinic_id){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE clinic_id = '$clinic_id' ");
    }

    public static function count_clinic($clinic_id){
        global $database;
        $sql = "SELECT COUNT(*) FROM " .static::$table_name . " WHERE clinic_id = '$clinic_id' ";
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    public static function count_patient_clinics($patient_id){
        global $database;
        $sql = "SELECT COUNT(*) FROM " .static::$table_name . " WHERE patient_id = '$patient_id' ";
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }



    public static function create_table()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS ' . PatientSubClinic::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'patient_id INT(11) NOT NULL, ' .
            'sub_clinic_id INT(11) NOT NULL, ' .
            'clinic_id INT(11) NOT NULL, ' .
            'clinic_number VARCHAR(50) NOT NULL, ' .
            'date DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';
        //    'UNIQUE KEY(revenue_code))';
        PatientSubClinic::run_script($sql);
    }


}

PatientSubClinic::create_table();




