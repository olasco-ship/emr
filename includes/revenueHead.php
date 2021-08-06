<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/16/2019
 * Time: 11:46 AM
 */





require_once("initialize.php");

class RevenueHead extends DatabaseObject {
    protected static $table_name = "revenueheads";
    protected static $db_fields = array('id', 'sync', 'revenue_code', 'revenue_name', 'created_by', 'date_created', 'date_modified');
    public $id;
    public $sync;
    public $revenue_code;
    public $revenue_name;
    public $created_by;
    public $date_created;
    public $date_modified;

    public static function find_by_rev_code($code)
    {
        $sql = "SELECT * FROM " . static::$table_name . " WHERE revenue_code= '{$code}' LIMIT 1";
        $result_array = RevenueHead::find_by_sql($sql);
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_by_revenue_code_except_current_id($code, $id){
        $sql = "SELECT * FROM " . static::$table_name . " WHERE revenue_code= '{$code}'  AND id <> '{$id}'";
        $result_array = RevenueHead::find_by_sql($sql);
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }


    public static function create_table(){
        $sql = 'CREATE TABLE IF NOT EXISTS ' . RevenueHead::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'revenue_code VARCHAR(50) NOT NULL, ' .
            'revenue_name VARCHAR(80) NOT NULL, ' .
            'created_by VARCHAR(50) NOT NULL, ' .
            'date_created DATETIME NOT NULL, ' .
            'date_modified  DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';
        //    'UNIQUE KEY(revenue_code))';
        RevenueHead::run_script($sql);
    }


}

RevenueHead::create_table();




