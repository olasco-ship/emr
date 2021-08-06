<?php


class EachDrug extends DatabaseObject
{
    public static $table_name = "eachDrug";
    protected static $db_fields = array('id', 'sync', 'product_id', 'drug_request_id', 'bill_id', 'product_name', 'quantity', 'dosage', 'duration', 'consultant',
        'pharmacy',  'status', 'date', 'test_payment_amount', 'drug_payment_status');


    public $id;
    public $sync;
    public $product_id;
    public $drug_request_id;
    public $bill_id;
    public $product_name;
    public $quantity;
    public $dosage;
    public $duration;
    public $consultant;
    public $pharmacy;
    public $status;
    public $date;
    public $test_payment_amount;
    public $drug_payment_status;


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

    public static function find_dispensed_by_date($pharmacist, $startDate, $endDate){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE pharmacy = '$pharmacist' AND date BETWEEN '$startDate' AND '$endDate' ORDER BY date DESC");
    }

    public static function find_all_awaiting_requests($drug_request_id=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE drug_request_id = $drug_request_id AND status = 'OPEN' " );
    }

    public static function find_all_awaiting_requests_for_edit($drug_request_id=0, $product_name){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE drug_request_id = $drug_request_id AND product_name = '$product_name' AND status = 'OPEN' " );
    }

    public static function find_all_awaiting_requests_for_edit_by_id($drug_request_id=0, $id=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE drug_request_id = $drug_request_id AND id = $id AND status = 'OPEN' " );
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
        $sql = 'CREATE TABLE IF NOT EXISTS ' . EachDrug::$table_name . '(' .
            'id INT(11) NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'product_id INT(11) NOT NULL, ' .
            'bill_id INT(11) NOT NULL, ' .
            'test_payment_amount INT(11) NOT NULL, ' .
            'drug_request_id INT(11) NOT NULL, ' .
            'product_name VARCHAR(100) NOT NULL, ' .
            'quantity  VARCHAR(50) NOT NULL, ' .
            'dosage VARCHAR(50) NOT NULL, ' .
            'duration VARCHAR(50) NOT NULL, ' .
            'consultant VARCHAR(50) NOT NULL, ' .
            'pharmacy VARCHAR(50) NOT NULL, ' .
            'status VARCHAR(50) NOT NULL, ' .
            'date DATETIME NOT NULL, ' .
            'drug_payment_status TINYINT(2) NULL DEFAULT 0, ' .
            'PRIMARY KEY(id))';

        EachDrug::run_script($sql);
    }


    // Common Database Methods in the Parent class(DatabaseObject)


}

EachDrug::create_table();