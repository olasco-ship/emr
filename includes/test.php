<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/16/2019
 * Time: 11:59 AM
 */



require_once("initialize.php");

class Test extends DatabaseObject {
    protected static $table_name = "test";
    protected static $db_fields = array('id', 'sync', 'revenue_code', 'unit_id', 'revenueHead_id', 'name', 'price',
        'created_by', 'date_created', 'date_modified');
    public $id;
    public $sync;
    public $revenue_code;
    public $unit_id;
    public $revenueHead_id;
    public $name;
    public $price;
  /*  public $quantity;*/
    public $created_by;
    public $date_created;
    public $date_modified;

    public $rev_head;

    public static function find_by_revenueHead_id($revenueHead_id=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE revenueHead_id = $revenueHead_id ORDER BY name ASC " );
    }

    public static function find_revenueHead_id($revenueHead_id=0){
        global $database;
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE revenueHead_id=".$database->escape_value($revenueHead_id));
        return $result_array;
    }

    public static function find_all_by_unit_id($unit_id=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE unit_id = $unit_id ORDER BY name ASC" );
    }
    public static function find_all_by_test_id($ids){
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE id = $ids");
        return !empty($result_array) ? array_shift($result_array) : FALSE;
       // return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE id = $ids" );
    }

    public static function find_by_bill_id($bill_id=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE bill_id = $bill_id" );
    }

    public static function create_table(){
        $sql = 'CREATE TABLE IF NOT EXISTS ' . Test::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'revenue_code VARCHAR(50) NOT NULL, ' .
            'unit_id VARCHAR(50) NOT NULL, ' .
            'revenueHead_id  INT(11) NOT NULL, ' .
            'name VARCHAR(80) NOT NULL, ' .
            'price  INT(11) NOT NULL, ' .
         /*   'quantity  INT(11) NOT NULL, ' .*/
            'created_by VARCHAR(50) NOT NULL, ' .
            'date_created DATETIME NOT NULL, ' .
            'date_modified  DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';
        //      'UNIQUE KEY(revenue_code))';
        Test::run_script($sql);
    }


}

Test::create_table();



