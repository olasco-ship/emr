<?php

require_once ('initialize.php');

class ExaminationCategory extends DatabaseObject
{

    protected static $table_name = "examination_category";
    protected static $db_fields  = array('id', 'sync', 'name', 'date');

    public $id;
    public $sync;
    public $name;
    public $date;


    public static function find_by_name($name){
        //   global $database;
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE name = '$name' " );
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }



    public static function create_table(){

        $sql = 'CREATE TABLE IF NOT EXISTS ' . ExaminationCategory::$table_name . '(' .
            'id INT(11) NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, '.
            'name VARCHAR(50) NOT NULL, '.
            'date DATETIME NOT NULL, '.
            'PRIMARY KEY(id))';

        ExaminationCategory::run_script($sql);

    }

}

ExaminationCategory::create_table();
