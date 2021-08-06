<?php
    
require_once("initialize.php");  

class Investigation extends DatabaseObject {

    protected static $table_name = "investigations";
    protected static $db_fields = array('id', 'sync', 'bill_id', 'revenueHead_id', 'revenueNames', 'unit', 'unit_price', 'total_price', 'date_generated');
    public $id;
    public $sync;
    public $bill_id;
    public $revenueHead_id;
    public $revenueNames;
    public $unit;
    public $unit_price;  
    public $total_price;  
    public $date_generated;

    public static function find_revenueHead_id_btw_date($revenueHead_id=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE revenueHead_id = $revenueHead_id ORDER BY revenue_desc ASC " );
    }

    public static function find_btw_date_by_revenue($revenue, $start_date,  $end_date){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE revenueNames = '$revenue' AND date_generated BETWEEN '$start_date' AND '$end_date' ORDER BY date_generated DESC");
    }

    public static function sum_all_by_revenue($revenue, $start_date,  $end_date){
        global $database;
        $sql = "SELECT SUM(total_price) FROM " .static::$table_name . " WHERE revenueNames = '$revenue' AND date_generated BETWEEN '$start_date' AND '$end_date' ORDER BY date_generated DESC" ;
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    public static function find_all_by_sync(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE sync = 'unsync' " );
    }

    public  function find_by_bill_id($bill_id){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE bill_id = $bill_id ORDER BY date_generated DESC" );
    }

    public  function find_by_revenueHead_id($revenueHead_id){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE revenueHead_id = $revenueHead_id ORDER BY date_generated DESC" );
    }

    public static function sum_all($start_date, $end_date){
        global $database;
        $sql = "SELECT SUM(total_price) FROM " .static::$table_name . " WHERE date_generated BETWEEN '$start_date' AND '$end_date' ORDER BY date_generated DESC";
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    public static function sum_all_by_revenueHead_id($revenueHead_id, $start_date,  $end_date){
        global $database;
        $sql = "SELECT SUM(total_price) FROM " .static::$table_name . " WHERE revenueHead_id = $revenueHead_id AND date_generated BETWEEN '$start_date' AND '$end_date' ORDER BY date_generated DESC" ;
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }



    public static function find_all_by_revenueHead_id($revenueHead_id, $start_date,  $end_date){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE revenueHead_id = $revenueHead_id AND date_generated BETWEEN '$start_date' AND '$end_date' ORDER BY date_generated DESC");
    }


    public static function create_table(){
        $sql = 'CREATE TABLE IF NOT EXISTS ' . Investigation::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'bill_id VARCHAR(50) NOT NULL, ' .
            'revenueHead_id VARCHAR(50) NOT NULL, ' .
            'revenueNames VARCHAR(80) NOT NULL, ' .
            'unit INT(11) NOT NULL, ' .
            'unit_price INT(11) NOT NULL, ' .   
            'total_price INT(11) NOT NULL, ' .       
            'date_generated DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';
        Investigation::run_script($sql);
        
    }
}

Investigation::create_table();



