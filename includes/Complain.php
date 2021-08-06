<?php

require_once('initialize.php');


class Complain extends DatabaseObject
{

    public static $table_name = "complains";
    protected static $db_fields  = array('id', 'sync', 'name', 'date');

    public $id;
    public $sync;
    public $name;
    public $date;

    public static function create_table(){
        $sql = 'CREATE TABLE IF NOT EXISTS ' . Complain::$table_name . '(' .
            'id INT(11) NOT NULL AUTO_INCREMENT, '.
            'sync VARCHAR(20) NOT NULL, '.
            'name VARCHAR(50) NOT NULL, '.
            'date DATETIME NOT NULL, '.
            'PRIMARY KEY(id), '.
            'UNIQUE KEY(name))';

        Complain::run_script($sql);

    }
}

Complain::create_table();