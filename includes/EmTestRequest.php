<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/17/2019
 * Time: 10:46 AM
 */





class EmergencyTestRequest extends DatabaseObject
{
    public static $table_name = "em_test_request";
    protected static $db_fields = array('id', 'sync', 'emergency_id', 'bill_id', 'consultant', 'test_no', 
        'doc_com', 'status', 'receipt', 'date');


    public $id;
    public $sync;
    public $emergency_id;
    public $bill_id;
    public $consultant;
    public $test_no;
    public $doc_com;
    public $status;
    public $receipt;
    public $date;	




    public static function create_table(){
        $sql = 'CREATE TABLE IF NOT EXISTS ' . EmergencyTestRequest::$table_name . '(' .
            'id INT(11) NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'emergency_id INT(11) NOT NULL, ' .    
            'bill_id INT(11) NOT NULL, ' .
            'consultant  VARCHAR(50) NOT NULL, ' .
            'test_no INT(11) NOT NULL, ' .
            'doc_com TEXT NOT NULL, ' .
            'status VARCHAR(50) NOT NULL, ' .
            'receipt VARCHAR(50) NOT NULL, ' .
            'date DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';

        EmergencyTestRequest::run_script($sql);
    }


    // Common Database Methods in the Parent class(DatabaseObject)


}

EmergencyTestRequest::create_table();