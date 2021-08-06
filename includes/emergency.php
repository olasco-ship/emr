<?php

require_once("initialize.php");


class Emergency extends DatabaseObject
{
    public static $table_name = "emergency";
    protected static $db_fields = array('id', 'sync', 'folder', 'emergency_no', 'services', 'gender', 'officer', 'status',
    'dep', 'date');
        

    public $id;
    public $sync;
    public $folder;
    public $emergency_no;
    public $services;
    public $gender;
    public $officer;
    public $status;
    public $dept;
    public $date;

    public static function find_last_number(){
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name . " ORDER BY id DESC LIMIT 1 ");
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_last_number_by_dept($dept=0){
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE dept = $dept ORDER BY id DESC LIMIT 1 ");
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    /*
    public static function find_by_id($id=0){
        global $database;
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE id=".$database->escape_value($id));
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }
    */


    public static function create_table()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS ' . Emergency::$table_name . '(' .
            'id INT(11) NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'folder VARCHAR(50) NOT NULL, ' .
            'emergency_no VARCHAR(50) NOT NULL, ' .
            'services TEXT NOT NULL, ' .
            'gender VARCHAR(50) NOT NULL, ' .
            'officer VARCHAR(50) NOT NULL, ' .
            'status VARCHAR(50) NOT NULL, ' .
            'date DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';

            Emergency::run_script($sql);
    }


    // Common Database Methods in the Parent class(DatabaseObject)


}

Emergency::create_table();






