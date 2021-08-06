<?php

require_once("initialize.php");


class Referrals extends DatabaseObject
{
    public static $table_name = "referrals";
    protected static $db_fields = array('id', 'sync', 'patient_id', 'bill_id', 'waiting_list_id', 'ref_adm_id', 'current_sub_clinic_id', 'referred_sub_clinic_id',
        'consultant', 'referral_note', 'status', 'date');


    public $id;
    public $sync;
    public $patient_id;
    public $bill_id;
    public $waiting_list_id;
    public $ref_adm_id;
    public $current_sub_clinic_id;
    public $referred_sub_clinic_id;
    public $consultant;
    public $referral_note;
    public $status;
    public $date;

    public static function find_by_billed($bill_id=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE bill_id = $bill_id  AND status = 'BILLED' " );
    }

    public static function find_open_referrals($waiting_list, $patient_id){
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE waiting_list_id = $waiting_list AND patient_id = $patient_id AND status = 'OPEN' " );
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_patient_referral($waiting_list, $patient_id){
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE waiting_list_id = $waiting_list AND patient_id = $patient_id " );
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_pending_referrals($waiting_list, $patient_id){
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE waiting_list_id = $waiting_list AND patient_id = $patient_id AND status = 'PENDING' " );
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_by_open_referrals(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE status = 'OPEN' ORDER BY date ASC ");
    }

    public static function count_by_confirmation(){
        global $database;
        $sql = "SELECT COUNT(*) FROM " .static::$table_name . " WHERE status = 'CONFIRMATION'  " ;
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    public static function find_by_confirmation(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE status = 'CONFIRMATION' ORDER BY date ASC ");
    }

    public static function find_by_cleared_referrals(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE status = 'PAID' ORDER BY date DESC ");
    }

    public static function find_patient_open($patient_id){
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE patient_id = $patient_id AND status = 'OPEN' " );
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_by_waiting_list_id($id=0){
        global $database;
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE waiting_list_id=".$database->escape_value($id));
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_referred_sub_clinic($sub_clinic_id){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE status = 'OPEN' AND referred_sub_clinic_id = $sub_clinic_id ORDER BY date DESC ");
    }





    public static function create_table()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS ' . Referrals::$table_name . '(' .
            'id INT(11) NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'patient_id INT(11) NOT NULL, ' .     
            'bill_id INT(11) NOT NULL, ' .
            'waiting_list_id INT(11) NOT NULL, ' .
            'ref_adm_id INT(11) NOT NULL, ' .
            'current_sub_clinic_id INT(11) NOT NULL, ' .
            'referred_sub_clinic_id INT(11) NOT NULL, ' .
            'consultant  VARCHAR(50) NOT NULL, ' .
            'referral_note  TEXT NOT NULL, ' .
            'status VARCHAR(50) NOT NULL, ' .
            'date DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';

        Referrals::run_script($sql);
    }


    // Common Database Methods in the Parent class(DatabaseObject)


}

Referrals::create_table();