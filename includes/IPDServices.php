<?php

/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/16/2019
 * Time: 11:46 AM
 */

class IPDServices extends DatabaseObject {

    protected static $table_name = "ipd_service";
    protected static $db_fields = array('id', 'sync', 'service_name', 'daily_charges', 'date_created');
    public $id;
    public $sync;
    public $service_name;
    public $daily_charges;
    public $date_created;


    public static function find_by_id($ids){
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE id = $ids");
        return !empty($result_array) ? array_shift($result_array) : FALSE;
       // return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE id = $ids" );
    }

    public static function create_table(){
        $sql = 'CREATE TABLE IF NOT EXISTS ' . IPDServices::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'service_name VARCHAR(200) NOT NULL, ' .
            'daily_charges VARCHAR(200) NOT NULL, ' .            
            'date_created DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';
        //    'UNIQUE KEY(revenue_code))';
        IPDServices::run_script($sql);
    }


}

IPDServices::create_table();