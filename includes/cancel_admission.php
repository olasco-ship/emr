<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 1/31/2019
 * Time: 5:15 PM
 */

//require_once("initialize.php");

class CancleAdmission extends DatabaseObject {

    protected static $table_name = "cancle_admission";
    protected static $db_fields = array('id', 'sync', 'patient_id', 'reason', 'cancel_by_id','created' );


    public $id;
    public $sync;
    public $patient_id;
    public $reason;
    public $cancel_by_id;
    public $created;
    

    public static function find_by_pat_id($patient_id){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE patient_id = $patient_id" );
    }

    public static function find_by_patient($patient_id){
        $result_array =  static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE patient_id = $patient_id " );
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }


    public static function create_table(){
        $sql = 'CREATE TABLE IF NOT EXISTS ' . CancleAdmission::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'patient_id VARCHAR(50) NOT NULL, ' .
            'cancel_by_id VARCHAR(50) NOT NULL, ' .
            'reason text NOT NULL, ' .
            'created DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';
            CancleAdmission::run_script($sql);

    }
}

CancleAdmission::create_table();



