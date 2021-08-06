<?php

require_once ("initialize.php");


class NhisPlan extends DatabaseObject
{
    protected static $table_name = 'nhisplans';
    protected static $db_fields = array('id', 'sync', 'plan_name', 'validity_months', 'date_added');
    public $id;
    public $sync;
    public $plan_name;
    public $validity_months;
    public $date_added;

    public static function create_table(){
        $sql = 'CREATE TABLE IF NOT EXISTS '. NhisPlan::$table_name . '('.
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'plan_name VARCHAR(50) NOT NULL, ' .
            'validity_months INT NOT NULL, '.
            'date_added DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';

        NhisPlan::run_script($sql);

    }

}
NhisPlan::create_table();