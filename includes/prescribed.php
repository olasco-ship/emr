<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/12/2019
 * Time: 9:59 AM
 */


class Prescribed extends DatabaseObject
{
    public static $table_name = "prescribed";
    protected static $db_fields = array('id', 'sync', 'encounter_id', 'bill_id', 'product_id', 'product_name', 'unit', 'cost_price',
        'unit_price', 'total_price', 'dosage', 'period', 'dept', 'status', 'receipt', 'date');

    public $id;
    public $sync;
    public $encounter_id;
    public $bill_id;
    public $product_id;
    public $product_name;
    public $unit;
    public $cost_price;
    public $unit_price;
    public $total_price;
    public $dosage;
    public $period;
    public $dept;
    public $status;
    public $receipt;
    public $date;


    public static function find_by_encounter_id($encounter=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE encounter_id = $encounter" );
    }

    public  function find_by_bill_id_by_date($bill_id){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE bill_id = $bill_id ORDER BY date DESC" );
    }

    public static function find_by_bill_id($bill_id=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE bill_id = $bill_id" );
    }

    public static function find_by_billed($bill_id=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE bill_id = $bill_id  AND status = 'billed' " );
    }

    public static function find_costed_bill($encounter_id=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE encounter_id = $encounter_id AND status = 'COSTED' " );
    }

    public static function find_bill_by_cost($bill_id=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE bill_id = $bill_id AND status = 'COSTED' " );
    }

    public static function find_paid_bill($encounter_id=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE encounter_id = $encounter_id AND status = 'PAID' " );
    }


    public static function find_costed_bill_drug($encounter_id=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE dept = 'drug' AND encounter_id = $encounter_id  AND status = 'COSTED' " );
    }

    public static function find_costed_bill_lab($encounter_id=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE dept = 'lab' AND encounter_id = $encounter_id  AND status = 'COSTED' " );
    }

/*    public static function find_costed_bill_by_dept($bill_id=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE dept = 'drug' AND  bill_id = $bill_id  AND status = 'COSTED' " );
    }*/

    public static function find_costed_bill_by_dept($bill_id=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE dept = 'drug' AND  bill_id = $bill_id " );
    }

    public static function sum_all_billed($bill_id=0){
        global $database;
        $sql = "SELECT SUM(total_price) FROM " .static::$table_name . " WHERE bill_id = $bill_id AND status = 'billed' " ;
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }


    public static function create_table(){
        $sql = 'CREATE TABLE IF NOT EXISTS ' . Prescribed::$table_name . '(' .
            'id INT(11) NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'encounter_id INT(11) NOT NULL, ' .
            'bill_id INT(11) NOT NULL, ' .
            'product_id INT(11) NOT NULL, ' .
            'product_name  VARCHAR(100) NOT NULL, ' .
            'unit INT(11) NOT NULL, ' .
            'cost_price VARCHAR(50) NOT NULL, ' .
            'unit_price VARCHAR(50) NOT NULL, ' .
            'total_price VARCHAR(50) NOT NULL, ' .
            'dosage VARCHAR(50) NOT NULL, ' .
            'period VARCHAR(50) NOT NULL, ' .
            'dept VARCHAR(50) NOT NULL, ' .
            'status VARCHAR(50) NOT NULL, ' .
            'receipt VARCHAR(50) NOT NULL, ' .
            'date DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';

        Prescribed::run_script($sql);
    }


    // Common Database Methods in the Parent class(DatabaseObject)


}

Prescribed::create_table();