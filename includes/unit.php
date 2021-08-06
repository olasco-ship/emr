<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/16/2019
 * Time: 1:45 PM
 */


require_once("initialize.php");

class Unit extends DatabaseObject {
    protected static $table_name = "unit";
    protected static $db_fields = array('id', 'sync', 'revenueHead_id', 'name', 'date');
    public $id;
    public $sync;
    public $revenueHead_id;
    public $name;
    public $date;


    public static function find_by_revenueHead_id($revenueHead_id=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE revenueHead_id = $revenueHead_id ORDER BY name ASC " );
    }

    public static function find_revenueHead_id($revenueHead_id=0){
        global $database;
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE revenueHead_id=".$database->escape_value($revenueHead_id));
        return $result_array;
    }

    public static function create_table(){
        $sql = 'CREATE TABLE IF NOT EXISTS ' . Unit::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'revenueHead_id VARCHAR(50) NOT NULL, ' .
            'name VARCHAR(80) NOT NULL, ' .
            'date DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';
        //    'UNIQUE KEY(revenue_code))';
        Unit::run_script($sql);
    }


}

Unit::create_table();




