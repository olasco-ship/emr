<?php


//require_once("../../initialize.php");

class SymptomResultTable extends DatabaseObject
{
    protected static $table_name = "symptom_result";
    protected static $db_fields = array('id',  'user_id','status', 
                                'result_status_value', 'result_status', 'result_desc',
                                 'result_precau', 'result_remedies','created');
    public $id;
    public $user_id;
    public $status;
    public $result_status_value;
    public $result_status;
    public $result_desc;
    public $result_precau;
    public $result_remedies;
    public $created;

    public static function find_by_user_id($user_id){
        $sql = "SELECT * FROM " . static::$table_name . " WHERE user_id='{$user_id}' and status=1";        
        $result_array = SymptomResultTable::find_by_sql($sql);        
        return !empty($result_array) ? ($result_array) : FALSE;
    }


    public static function create_table()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS ' . SymptomResultTable::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'user_id VARCHAR(250) NOT NULL, ' .
            'result_status_value VARCHAR(250) NOT NULL, ' .
            'result_status VARCHAR(250) NOT NULL, ' .
            'result_desc text NOT NULL,' .
            'result_precau text NOT NULL,' .
            'result_remedies text NOT NULL,' .
            'status tinyint(2) DEFAULT 1 NULL,' .
            'created DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';        
            SymptomResultTable::run_script($sql);
    }


}

SymptomResultTable::create_table();




