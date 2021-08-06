<?php


class EachItem extends DatabaseObject
{
    public static $table_name = "eachItem";
    protected static $db_fields = array('id', 'sync', 'product_id', 'drug_request_id', 'product_name', 'quantity', 'nurse',
        'store',  'status', 'date');


    public $id;
    public $sync;
    public $product_id;
    public $drug_request_id;
    public $product_name;
    public $quantity;
    public $nurse;
    public $store;
    public $status;
    public $date;



    public static function find_by_name_and_request_id($product_name, $drug_request_id){
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE product_name = '$product_name' AND drug_request_id = $drug_request_id " );
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_by_name_and_request($product_name, $drug_request_id){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE product_name = '$product_name' AND drug_request_id = $drug_request_id " );
        //  return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_all_costed($drug_request_id=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE drug_request_id = $drug_request_id AND status = 'COSTED' " );
    }

    public static function find_all_dispensed($drug_request_id=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE drug_request_id = $drug_request_id AND status = 'DISPENSED' " );
    }


    public static function find_all_awaiting_requests($drug_request_id=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE drug_request_id = $drug_request_id AND status = 'OPEN' " );
    }


    public static function find_all_requests_by_request_test_id_drug($name){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE drug_request_id = '$name' and drug_payment_status='1' " );
    }


    public static function find_all_requests($drug_request_id=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE drug_request_id = $drug_request_id " );
    }

    public static function find_by_encounter_id($encounter=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE encounter_id = $encounter" );
    }

    public static function find_by_drug_request_id($drug_request_ids){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE drug_request_id = $drug_request_ids");
        // /return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_all_requests_by_test_request_id_for_drug($test_request_ids){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE drug_request_id = '$test_request_ids' " );
    }


    public static function find_all_requests_by_consultant_for_scan_for_drug($name){
        // echo "SELECT * FROM " .static::$table_name. " WHERE drug_request_id = '$name' and drug_payment_status='1'";die;
        //$result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE drug_request_id = '$name' and drug_payment_status='1'");

        //return !empty($result_array) ? array_shift($result_array) : FALSE;
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE drug_request_id = '$name' and drug_payment_status='1'" );
    }


    public static function create_table()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS ' . EachItem::$table_name . '(' .
            'id INT(11) NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'product_id INT(11) NOT NULL, ' .
            'drug_request_id INT(11) NOT NULL, ' .
            'product_name VARCHAR(100) NOT NULL, ' .
            'quantity  VARCHAR(50) NOT NULL, ' .
            'nurse VARCHAR(50) NOT NULL, ' .
            'store VARCHAR(50) NOT NULL, ' .
            'status VARCHAR(50) NOT NULL, ' .
            'date DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';

        EachItem::run_script($sql);
    }

}

EachItem::create_table();