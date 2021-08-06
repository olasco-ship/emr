<?php



class EachTest extends DatabaseObject
{
    public static $table_name = "eachTest";
    protected static $db_fields = array('id', 'sync', 'test_id', 'test_request_id', 'em_test_request_id', 'quantity', 'test_name', 'test_price', 'consultant', 'testResult', 'scientist',
        'pathologist', 'status', 'date', 'ipd_status', 'test_payment_status', 'test_payment_amount');

    public $id;
    public $sync;
    public $test_id;
    public $test_request_id;
    public $em_test_request_id;
    public $quantity;
    public $test_name;
    public $test_price;
    public $consultant;
    public $testResult;
    public $scientist;
    public $pathologist;
    public $status;
    public $date;
    public $ipd_status;
    public $test_payment_status;
    public $test_payment_amount;


    public static function find_by_name_and_request_id($test_name, $test_request_id){
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE test_name = '$test_name' AND test_request_id = $test_request_id " );
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_all_requests($test_request_id=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE test_request_id = $test_request_id " );
    }
    public static function find_all_requests_by_consultant($name){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE consultant = '$name' and ipd_status='1' and test_payment_status='1' " );
    }

    public static function find_all_requests_by_request_test_id($name){
        //$result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE test_request_id = '$name' and ipd_status='1' and test_payment_status='1' ");
        //return !empty($result_array) ? array_shift($result_array) : FALSE;
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE test_request_id = '$name' and ipd_status='1' and test_payment_status='1' " );
    }
    
    public static function find_all_requests_by_test_request_id($test_request_ids){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE test_request_id = '$test_request_ids' " );
    }


    public static function find_all_awaiting_requests($test_request_id=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE test_request_id = $test_request_id AND status = 'OPEN' " );
    }

    public static function find_all_costed($test_request_id=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE test_request_id = $test_request_id AND status = 'COSTED' " );
    }



    public static function create_table()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS ' . EachTest::$table_name . '(' .
            'id INT(11) NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'test_payment_amount INT(11) NOT NULL, ' .
            'test_id INT(11) NOT NULL, ' .    
            'test_request_id INT(11) NOT NULL, ' .
            'em_test_request_id INT(11) NOT NULL, ' .
            'quantity INT(11) NOT NULL, ' .
            'test_name VARCHAR(80) NOT NULL, ' .
            'test_price VARCHAR(30) NOT NULL, ' .
            'consultant  VARCHAR(50) NOT NULL, ' .
            'testResult TEXT NOT NULL, ' .
            'scientist VARCHAR(50) NOT NULL, ' .
            'pathologist VARCHAR(50) NOT NULL, ' .
            'status VARCHAR(50) NOT NULL, ' .
            'date DATETIME NOT NULL, ' .
            'ipd_status TINYINT(2) NULL DEFAULT 0, ' .
            'test_payment_status TINYINT(2) NULL DEFAULT 0, ' .
            'PRIMARY KEY(id))';

        EachTest::run_script($sql);
    }


    // Common Database Methods in the Parent class(DatabaseObject)


}

EachTest::create_table();