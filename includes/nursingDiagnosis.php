<?php

require_once("initialize.php");

class NursingDiagnosis extends DatabaseObject
{
    protected static $table_name = "nursingDiagnosis";
    protected static $db_fields = array('id', 'sync', 'nursingClassification_id', 'name', 'date');
    public $id;
    public $sync;
    public $nursingClassification_id;
    public $name;
    public $date;


    public static function find_by_class_id($nursingClassification_id = 0)
    {
        $result_array = static::find_by_sql("SELECT * FROM " . static::$table_name . " WHERE nursingClassification_id= $nursingClassification_id " );
        return $result_array;
    }


    public static function create_table()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS ' . NursingDiagnosis::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'nursingClassification_id INT(11) NOT NULL, ' .
            'name VARCHAR(80) NOT NULL, ' .
            'date DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';
        NursingDiagnosis::run_script($sql);
    }


}

NursingDiagnosis::create_table();




