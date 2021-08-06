<?php

require_once("initialize.php");

class NursingDomain extends DatabaseObject
{
    protected static $table_name = "nursingDomain";
    protected static $db_fields = array('id', 'sync', 'name', 'date');
    public $id;
    public $sync;
    public $name;
    public $date;

    public static function create_table()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS ' . NursingDomain::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'name VARCHAR(100) NOT NULL, ' .
            'date DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';
        //    'UNIQUE KEY(revenue_code))';
        NursingDomain::run_script($sql);
    }


}

NursingDomain::create_table();




