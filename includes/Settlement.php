<?php

/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/16/2019
 * Time: 11:46 AM
 */

class Settlement extends DatabaseObject {

    protected static $table_name = "settlement";
    protected static $db_fields = array('id', 'sync', 'amount', 'patient_id', 'date_created', 'status', 'type');
    public $id;
    public $sync;
    public $amount;
    public $patient_id;
    public $date_created;
    public $status;
    public $type;


    public static function find_by_id($ids=0){
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE id = $ids");
        return !empty($result_array) ? array_shift($result_array) : FALSE;
       // return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE id = $ids" );
    }

    public static function create_table(){
        $sql = 'CREATE TABLE IF NOT EXISTS ' . Settlement::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'amount VARCHAR(200) NOT NULL, ' .
            'patient_id VARCHAR(200) NOT NULL, ' .            
            'type VARCHAR(200) NOT NULL, ' .            
            'status TINYINT(2) DEFAULT 0 NULL, ' .
            'date_created DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';
        //    'UNIQUE KEY(revenue_code))';
        Settlement::run_script($sql);
    }


}

Settlement::create_table();