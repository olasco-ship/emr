<?php

require_once("initialize.php");


class Appointment extends DatabaseObject
{
    public static $table_name = "appointment";
    protected static $db_fields = array('id', 'sync', 'next_app', 'app_date', 'patient_id', 'waiting_list_id', 'ref_adm_id', 'sub_clinic_id',
          'next_sub_clinic_id', 'consultant', 'status', 'date');

    public $id;
    public $sync;
    public $next_app;
    public $app_date;
    public $patient_id;
    public $waiting_list_id;
    public $ref_adm_id;
    public $sub_clinic_id;
    public $next_sub_clinic_id;
    public $consultant;
    public $status;
    public $date;



    public static function find_by_waiting_list_id($id=0){
        global $database;
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE waiting_list_id=".$database->escape_value($id));
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_by_ref_adm_id($id=0){
        global $database;
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE ref_adm_id=".$database->escape_value($id));
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }


    public static function find_open_appointment($waiting_list, $patient_id){
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE waiting_list_id = $waiting_list AND patient_id = $patient_id AND status = 'OPEN' " );
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_patient_appointment($waiting_list, $patient_id){
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE waiting_list_id = $waiting_list AND patient_id = $patient_id " );
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_pending_appointment($waiting_list, $patient_id){
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE waiting_list_id = $waiting_list AND patient_id = $patient_id AND status = 'PENDING' " );
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_all_appointments(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " ORDER BY next_app ");
    }

    public static function find_all_confirmed_appointments(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE status = 'CONFIRMED' ORDER BY app_date  ");
    }

    public static function find_by_next_app($date){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE app_date = '$date' AND status = 'CONFIRMED' ");
    }

    public static function find_app_by_sub_clinic($sub_clinic_id, $date){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE sub_clinic_id = '$sub_clinic_id' AND app_date = '$date' AND status = 'CONFIRMED' ");
    }

    public static function find_patient_open_app($patient_id){
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE patient_id = $patient_id AND status = 'OPEN' " );
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_all_open_app(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE status = 'OPEN' ORDER BY date DESC ");
    }



    public static function create_table()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS ' . Appointment::$table_name . '(' .
            'id INT(11) NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'next_app VARCHAR(50) NOT NULL, ' .
            'app_date DATE NOT NULL, ' .
            'patient_id INT(11) NOT NULL, ' .
            'waiting_list_id INT(11) NOT NULL, ' .          
            'ref_adm_id INT(11) NOT NULL, ' . 
            'sub_clinic_id INT(11) NOT NULL, ' .
            'next_sub_clinic_id INT(11) NOT NULL, ' .
            'consultant VARCHAR(50) NOT NULL, ' .
            'status VARCHAR(50) NOT NULL, ' .
            'date DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';

        Appointment::run_script($sql);
    }


    // Common Database Methods in the Parent class(DatabaseObject)


}

Appointment::create_table();