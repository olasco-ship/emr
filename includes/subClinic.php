<?php

require_once("initialize.php");

class SubClinic extends DatabaseObject
{
    protected static $table_name = "sub_clinic";
    protected static $db_fields = array('id', 'sync', 'clinic_id', 'name', 'date');
    public $id;
    public $sync;
    public $clinic_id;
    public $name;
    public $date;

    public static function find_all_clinic_id($clinic_id = 0)
    {
        global $database;
        $result_array = static::find_by_sql("SELECT * FROM " . static::$table_name . " WHERE clinic_id=" . $database->escape_value($clinic_id));
        return $result_array;
    }

    public static function find_by_clinic_id($clinic_id = 0)
    {
        $result_array = static::find_by_sql("SELECT * FROM " . static::$table_name . " WHERE clinic_id= $clinic_id " );
        return $result_array;
    }

    public static function find_by_name($dept){

        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE name = '$dept' ORDER BY name ASC");
    }

    public static function create_table()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS ' . SubClinic::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'clinic_id VARCHAR(50) NOT NULL, ' .
            'name VARCHAR(80) NOT NULL, ' .
            'date DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';
        //    'UNIQUE KEY(revenue_code))';
        SubClinic::run_script($sql);
    }


}

SubClinic::create_table();




