<?php

require_once("initialize.php");


class Storage extends DatabaseObject
{

    protected static $table_name = "storage";
    protected static $db_fields = array('id', 'sync', 'dispenser', 'reliever', 'pharm_id', 'pharm', 'no_of_drug', 'time_dis', 'time_relieved',
        'status', 'date');

    public $id;
    public $sync;
    public $dispenser;
    public $reliever;
    public $pharm_id;
    public $pharm;
    public $no_of_drug;
    public $time_dis;
    public $time_relieved;
    public $status;
    public $date;





    public static function find_active_pharmacist($id=0){
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE pharm_id = '$id' AND status = 'ACTIVE' ");
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function create_table()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS ' . Storage::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'dispenser VARCHAR(50) NOT NULL, ' .
            'reliever VARCHAR(50) NOT NULL, ' .
            'pharm_id INT(11) NOT NULL, ' .
            'pharm VARCHAR(80) NOT NULL, ' .
            'no_of_drug VARCHAR(50) NOT NULL, ' .
            'time_dis TIME NOT NULL, ' .
            'time_relieved TIME NOT NULL, ' .
            'status VARCHAR(50) NOT NULL, ' .
            'date DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';
        Storage::run_script($sql);

    }
}

Storage::create_table();



