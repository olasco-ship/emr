<?php


require_once("initialize.php");

class Locations extends DatabaseObject
{
    protected static $table_name = "location";
    protected static $db_fields = array('id', 'sync', 'location_name');
    public $id;
    public $sync;
    public $location_name;

    public static function create_table()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS ' . Locations::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'location_name VARCHAR(250) NOT NULL, ' .
            'PRIMARY KEY(id))';        
        Locations::run_script($sql);
    }


}

Locations::create_table();




