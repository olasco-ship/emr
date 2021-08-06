<?php


require_once("initialize.php");

class ReturnedServices extends DatabaseObject
{
    protected static $table_name = "returnedServices";
    protected static $db_fields = array('id', 'sync', 'drug_request_id', 'test_request_id', 'scan_request_id', 'returning_officer',
    'return_note', 'dept', 'date');

    public $id;
    public $sync;
    public $drug_request_id;
    public $test_request_id;
    public $scan_request_id;
    public $returning_officer;
    public $return_note;
    public $dept;
    public $date;


    public static function create_table()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS ' . ReturnedServices::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'drug_request_id INT(11) NOT NULL, ' .
            'test_request_id INT(11) NOT NULL, ' .
            'scan_request_id INT(11) NOT NULL, ' .
            'returning_officer VARCHAR(50) NOT NULL, ' .
            'return_note TEXT NOT NULL, ' .
            'dept VARCHAR(50) NOT NULL, ' .
            'date DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';
        //    'UNIQUE KEY(revenue_code))';
        ReturnedServices::run_script($sql);
    }


}

ReturnedServices::create_table();




