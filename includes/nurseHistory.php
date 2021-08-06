<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/17/2019
 * Time: 10:46 AM
 */

class NurseHistory extends DatabaseObject
{
    public static $table_name = "nurse_history";
    protected static $db_fields = array('id', 'sync', 'patient_id', 'waiting_list_id', 'ref_adm_id', 'adm_id',
        'resultData', 'notes', 'done_by', 'date');


    public $id;
    public $sync;
    public $patient_id;
    public $waiting_list_id;
    public $ref_adm_id;
    public $adm_id;
    public $resultData;
    public $notes;
    public $done_by;
    public $date;


    public static function find_by_ref_id($ref_adm_id=0){
        global $database;
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE ref_adm_id=".$database->escape_value($ref_adm_id));
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }


    public static function find_patient_histories($patient_id)
    {
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE patient_id= $patient_id ORDER BY date DESC LIMIT 20 " );
    }


    public static function create_table(){
        $sql = 'CREATE TABLE IF NOT EXISTS ' . NurseHistory::$table_name . '(' .
            'id INT(11) NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'patient_id INT(11) NOT NULL, ' .
            'waiting_list_id INT(11) NOT NULL, ' .    
            'ref_adm_id INT(11) NOT NULL, ' . 
            'adm_id INT(11) NOT NULL, ' .

            'resultData TEXT NOT NULL, ' .
            'notes TEXT NOT NULL, ' .
            'done_by VARCHAR(50) NOT NULL, ' .
            'date DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';

        NurseHistory::run_script($sql);
    }


    // Common Database Methods in the Parent class(DatabaseObject)


}

NurseHistory::create_table();