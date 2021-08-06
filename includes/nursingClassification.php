<?php


require_once("initialize.php");

class NursingClassification extends DatabaseObject
{
    protected static $table_name = "nursingClassification";
    protected static $db_fields = array('id', 'sync', 'nursingDomain_id', 'name', 'date');
    public $id;
    public $sync;
    public $nursingDomain_id;
    public $name;
    public $date;

    public static function find_by_domain_id($nursingDomain_id = 0)
    {
        $result_array = static::find_by_sql("SELECT * FROM " . static::$table_name . " WHERE nursingDomain_id= $nursingDomain_id " );
        return $result_array;
    }


    public static function create_table()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS ' . NursingClassification::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'nursingDomain_id INT(11) NOT NULL, ' .
            'name VARCHAR(80) NOT NULL, ' .
            'date DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';
        NursingClassification::run_script($sql);
    }


}

NursingClassification::create_table();




