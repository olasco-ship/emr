<?php


class ServiceBooking extends DatabaseObject
{
    public static $table_name = "serviceBooking";
    protected static $db_fields = array('id', 'sync', 'dept', 'testRequest_id', 'scanRequest_id', 'booked_by', 'booked_date',
     'reasons', 'booking_status', 'date');
       

    public $id;
    public $sync;
    public $dept;
    public $testRequest_id;
    public $scanRequest_id;
    public $booked_by;
    public $booked_date;
    public $reasons;
    public $booking_status;
    public $date;

    public static function find_by_scanRequest_id($id=0){
        global $database;
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE scanRequest_id=".$database->escape_value($id));
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function create_table(){
        $sql = 'CREATE TABLE IF NOT EXISTS ' . ServiceBooking::$table_name . '(' .
            'id INT(11) NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'dept VARCHAR(50) NOT NULL, ' .
            'testRequest_id INT(11) NOT NULL, ' .     
            'scanRequest_id INT(11) NOT NULL, ' . 
            'booked_by  VARCHAR(50) NOT NULL, ' .
            'booked_date DATETIME NOT NULL, ' .
            'reasons TEXT NOT NULL, ' .
            'booking_status VARCHAR(50) NOT NULL, ' .
            'date DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';

            ServiceBooking::run_script($sql);
    }


    // Common Database Methods in the Parent class(DatabaseObject)


}

ServiceBooking::create_table();