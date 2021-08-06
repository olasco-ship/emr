<?php

require_once("initialize.php");


class EnrolleeSubscription extends DatabaseObject
{
    public static $table_name = "enrollee_sub";
    protected static $db_fields = array('id', 'sync', 'enrollee_id', 'start_date', 'end_date', 'status', 'date');
        


    public $id;
    public $sync;
    public $enrollee_id;
    public $start_date;
    public $end_date;
    public $status;
    public $date;

    public static function find_all_by_enrollee_id($id=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE enrollee_id = '$id' ORDER BY date DESC " );
    }




    public static function create_table()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS ' . EnrolleeSubscription::$table_name . '(' .
            'id INT(11) NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'enrollee_id INT(11) NOT NULL, ' .
            'start_date DATETIME NOT NULL, ' .
            'end_date DATETIME NOT NULL, ' .
            'status VARCHAR(50) NOT NULL, ' .
            'date DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';

            EnrolleeSubscription::run_script($sql);
    }


    // Common Database Methods in the Parent class(DatabaseObject)


}

EnrolleeSubscription::create_table();