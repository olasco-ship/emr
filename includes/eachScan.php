<?php


class EachScan extends DatabaseObject
{
    public static $table_name = "eachScan";
    protected static $db_fields = array('id', 'sync', 'scan_id', 'scan_request_id', 'quantity', 'scan_name', 'scan_price', 'consultant', 'scanResult', 'scientist',
        'radiologist', 'status', 'date', 'ipd_status','scan_payment_status', 'test_payment_amount');

    public $id;
    public $sync;
    public $scan_id;
    public $scan_request_id;
    public $quantity;
    public $scan_name;
    public $scan_price;
    public $consultant;
    public $scanResult;
    public $scientist;
    public $radiologist;
    public $status;
    public $date;
    public $ipd_status;
    public $scan_payment_status;
    public $test_payment_amount;

    public static function find_by_name_and_request_id($scan_name, $scan_request_id){
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE scan_name = '$scan_name' AND scan_request_id = $scan_request_id " );
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }


    public static function find_all_awaiting_requests($scan_request_id=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE scan_request_id = $scan_request_id AND status = 'OPEN' " );
    }

    public static function find_all_costed($scan_request_id=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE scan_request_id = $scan_request_id AND status = 'COSTED' " );
    }


    public static function find_all_requests_by_request_test_id_scan($name){
        //$result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE scan_request_id = '$name' and ipd_status='1' and scan_payment_status='1' ");
        //return !empty($result_array) ? array_shift($result_array) : FALSE;
       return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE scan_request_id = '$name' and ipd_status='1' and scan_payment_status='1' " );
    }

    public static function find_all_requests_by_test_request_id($scan_request_id){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE scan_request_id = '$scan_request_id' and status='REQUEST'" );
    }

    public static function find_all_requests($scan_request_id=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE scan_request_id = $scan_request_id " );
    }

    public static function find_all_requests_by_consultant_for_scan($name){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE consultant = '$name' and ipd_status='1' and scan_payment_status='1'" );
    }

    public static function find_all_requests_by_test_request_id_pdf($scan_request_id){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE scan_request_id = '$scan_request_id' " );
    }

    public static function create_table()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS ' . EachScan::$table_name . '(' .
            'id INT(11) NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'scan_id INT(11) NOT NULL, ' .
            'scan_request_id INT(11) NOT NULL, ' .
            'quantity INT(11) NOT NULL, ' .
            'scan_name VARCHAR(80) NOT NULL, ' .
            'scan_price INT(11) NOT NULL, ' .
            'consultant  VARCHAR(50) NOT NULL, ' .
            'scanResult TEXT NOT NULL, ' .
            'scientist VARCHAR(50) NOT NULL, ' .
            'radiologist VARCHAR(50) NOT NULL, ' .
            'test_payment_amount INT(11) NOT NULL, ' .
            'status VARCHAR(50) NOT NULL, ' .
            'date DATETIME NOT NULL, ' .
            'ipd_status TINYINT(2) NULL DEFAULT 0, ' .
            'scan_payment_status TINYINT(2) NULL DEFAULT 0, ' .
            'PRIMARY KEY(id))';

        EachScan::run_script($sql);
    }


    // Common Database Methods in the Parent class(DatabaseObject)


}

EachScan::create_table();