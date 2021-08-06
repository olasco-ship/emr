<?php

require_once("initialize.php");

class ReferenceRange extends DatabaseObject
{

    protected static $table_name = "reference_range";
    protected static $db_fields = array('id', 'sync', 'dept', 'rangeValue' );

    public $id;
    public $sync;
    public $dept;
    public $rangeValue;

    public static function find_by_dept($dept)
    {
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE dept = '$dept'" );
    }

    public static function create_table()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS ' . ReferenceRange::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'dept VARCHAR(50) NOT NULL, ' .
            'rangeValue TEXT NOT NULL, ' .
            'PRIMARY KEY(id))';
        ReferenceRange::run_script($sql);
    }
}

ReferenceRange::create_table();