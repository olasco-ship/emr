<?php


//require_once("../../initialize.php");

class SymptomAnswerTable extends DatabaseObject
{
    protected static $table_name = "symptom_answer";
    protected static $db_fields = array('id', 'question_id', 'answer', 'user_id','status', 'gender','symptom_check_status','created');
    public $id;
    public $question_id;
    public $user_id;
    public $gender;
    public $symptom_check_status;
    public $answer;
    public $status;
    public $created;

    public static function find_by_user_id($user_id){
        $sql = "SELECT * FROM " . static::$table_name . " WHERE user_id='{$user_id}' and status=1 and symptom_check_status=1";        
        $result_array = SymptomAnswerTable::find_by_sql($sql);        
        return !empty($result_array) ? $result_array : FALSE;
    }

    public static function find_by_user_id_all($user_id){
        $sql = "SELECT * FROM " . static::$table_name . " WHERE user_id='{$user_id}' and status=1 and symptom_check_status=0";        
        $result_array = SymptomAnswerTable::find_by_sql($sql);        
        return !empty($result_array) ? $result_array : FALSE;
    }

    public static function create_table()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS ' . SymptomAnswerTable::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'question_id VARCHAR(250) NOT NULL, ' .
            'answer VARCHAR(250) NOT NULL, ' .
            'user_id VARCHAR(250) NOT NULL, ' .
            'gender VARCHAR(50) NOT NULL, ' .
            'status TINYINT(2) DEFAULT 1 NULL, ' .
            'symptom_check_status TINYINT(2) DEFAULT 1 NULL, ' .
            'created DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';        
            SymptomAnswerTable::run_script($sql);
    }


}

SymptomAnswerTable::create_table();




