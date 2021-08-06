<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/12/2019
 * Time: 9:47 AM
 */

class Prescription extends DatabaseObject
{
    public static $table_name = "prescription";
    protected static $db_fields = array('id', 'sync', 'prescription_no', 'patient_id', 'no_drugs', 'total_price', 'consultant', 'status', 'receipt', 'date');
    public $id;
    public $sync;
    public $prescription_no;
    public $patient_id;
    public $no_drugs;
    public $total_price;
    public $consultant;
    public $status;
    public $receipt;
    public $date;




    public static function find_all_by_patient($patient_id=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE patient_id = '$patient_id' ");
    }

    public static function count_pending_bills(){
        global $database;
        $sql = "SELECT COUNT(*) FROM " .static::$table_name . " WHERE status = 'prescribed' ";
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    public static function count_billed(){
        global $database;
        $sql = "SELECT COUNT(*) FROM " .static::$table_name . " WHERE status = 'billed' ";
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    public static function count_cleared_bill(){
        global $database;
        $sql = "SELECT COUNT(*) FROM " .static::$table_name . " WHERE status = 'PAID' ";
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    public static function find_by_status(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE status = 'prescribed' " );
    }

    public static function find_billed(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE status = 'billed' " );
    }

    public static function find_cleared(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE status = 'PAID' " );
    }


    public static function find_last_id(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " ORDER BY id DESC LIMIT 1");
    }

    public static function create_table(){
        $sql = 'CREATE TABLE IF NOT EXISTS ' . Prescription::$table_name . '(' .
            'id INT(11) NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'prescription_no VARCHAR(50) NOT NULL, ' .
            'patient_id INT(11) NOT NULL, ' .
            'no_drugs  VARCHAR(50) NOT NULL, ' .
            'total_price VARCHAR(50) NOT NULL, ' .
            'consultant VARCHAR(50) NOT NULL, ' .
            'status VARCHAR(50) NOT NULL, ' .
            'receipt VARCHAR(50) NOT NULL, ' .
            'date DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';

        Prescription::run_script($sql);
    }


    // Common Database Methods in the Parent class(DatabaseObject)


}

Prescription::create_table();