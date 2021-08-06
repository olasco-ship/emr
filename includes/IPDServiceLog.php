<?php

/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 8/18/2017
 * Time: 10:33 PM
 */
class IPDServiceLog extends DatabaseObject
{
    public static $table_name = "ipd_service_log";
    protected static $db_fields = array('id', 'sync', 'amount', 'created', 'status', 'patient_id', 'ipd_service_id');
    public $id;
    public $sync;
    public $amount;
    public $created;
    public $status;
    public $patient_id;
    public $ipd_service_id;

    
    public static function find_by_patient_pdf($patient_ids)
    {
        return static::find_by_sql("SELECT * FROM " . static::$table_name ." WHERE patient_id = $patient_ids and status=1");
    }

    public static function find_all_by_test_id_for_drug($ids){
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE id = $ids");
        return !empty($result_array) ? array_shift($result_array) : FALSE;
       // return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE id = $ids" );
    }

    public static function create_table(){
        $sql = 'CREATE TABLE IF NOT EXISTS ' . IPDServiceLog::$table_name . '(' .
            'id INT(11) NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'amount VARCHAR(250) NOT NULL, ' .            
            'patient_id VARCHAR(250) NOT NULL, ' .            
            'ipd_service_id VARCHAR(250) NOT NULL, ' .            
            'status TINYINT(1) DEFAULT 0 NULL, ' .            
            'created  DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';

            IPDServiceLog::run_script($sql);
    }


    // Common Database Methods in the Parent class(DatabaseObject)


}

IPDServiceLog::create_table();

