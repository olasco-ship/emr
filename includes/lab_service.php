<?php



class LabServices extends DatabaseObject {

    protected static $table_name = "lab_service";
    protected static $db_fields = array('id', 'sync', 'bill_id', 'test_request_id', 'ward_clinic', 'services', 'unit', 
     'status', 'date');



    public $id;
    public $sync;
    public $bill_id;
    public $test_request_id;
    public $ward_clinic;
    public $services;
    public $unit;
    public $status;
    public $date;

    public static function count_billed(){
        global $database;
        $sql = "SELECT COUNT(*) FROM " .static::$table_name . " WHERE status = 'billed' ";
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    public static function find_billed(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE status = 'billed' ORDER BY date DESC " );
    }

    public static function find_by_bill_id($id=0){
     //   global $database;
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE bill_id = $id " );
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function count_cleared(){
        global $database;
        $sql = "SELECT COUNT(*) FROM " .static::$table_name . " WHERE status = 'CLEARED' ";
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    public static function find_cleared(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE status = 'CLEARED' ORDER BY date DESC " );
    }




    public static function create_table(){
        $sql = 'CREATE TABLE IF NOT EXISTS ' . LabServices::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'bill_id INT(11) NOT NULL, ' .  
            'test_request_id INT(11) NOT NULL, ' .       
            'ward_clinic VARCHAR(100) NOT NULL, ' .      
            'services TEXT NOT NULL, ' . 
            'unit VARCHAR(50) NOT NULL, ' .
            'status VARCHAR(30) NOT NULL, ' .
            'date DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';
            LabServices::run_script($sql);
    }


}

LabServices::create_table();