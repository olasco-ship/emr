<?php


//require_once("../../initialize.php");

class QuestionTable extends DatabaseObject
{
    protected static $table_name = "question";
    protected static $db_fields = array('id', 'body_part_id', 'gender', 'question', 'type', 
                                'answer_label', 'answer_value','status','used_status','created',
                                'total_marks', 'minimum_marks', 'body_part_symptom_id', 'options');
    public $id;
    public $body_part_id;
    public $body_part_symptom_id;
    public $gender;
    public $question;
    public $type;
    public $answer_label;
    public $answer_value;
    public $status;
    public $created;
    public $used_status;
    public $minimum_marks;
    public $total_marks;
    public $options;

    public static function find_by_body_part_id($body_prt_id){
        $sql = "SELECT * FROM " . static::$table_name . " WHERE body_part_id='{$body_prt_id}' and status=1";
        $result_array = QuestionTable::find_by_sql($sql);        
        return !empty($result_array) ? $result_array : FALSE;
    }

    public static function find_by_body_part_id_multiple_map($body_prt_id){
        $sql = "SELECT * FROM " . static::$table_name . " WHERE status=1";        
        $result_array = QuestionTable::find_by_sql($sql);        
        return !empty($result_array) ? $result_array : FALSE;
    }
    
    public static function find_question_by_id($ids){
        $sql = "SELECT * FROM " . static::$table_name . " WHERE id='{$ids}' and status=1";
        $result_array = QuestionTable::find_by_sql($sql);        
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }



    public function deleteBody(){
        global $database;
        $sql  = "DELETE FROM " .static::$table_name;
        $sql .= " WHERE id=" .$database->escape_value($this->id). " and used_status = 0";
        $sql .= " LIMIT 1";
        $database->query($sql);
        return ($database->affected_rows() == 1) ? TRUE : FALSE;
    }


    
    public static function find_by_id_question($body_part_id, $body_part_symptom_id, $ids){
        $sql = "SELECT * FROM " . static::$table_name . " WHERE  id='{$ids}' and status=1";        
        $result_array = QuestionTable::find_by_sql($sql);        
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }
   

    public static function create_table()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS ' . QuestionTable::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'gender VARCHAR(100) NOT NULL, ' .
            'body_part_id VARCHAR(200) NOT NULL, ' .
            'body_part_symptom_id VARCHAR(200) NOT NULL, ' .
            'minimum_marks VARCHAR(200) NOT NULL, ' .
            'total_marks VARCHAR(200) NOT NULL, ' .
            'question text NOT NULL, ' .
            'answer_label LONGTEXT NOT NULL, ' .
            'answer_value LONGTEXT NOT NULL, ' .
            'options LONGTEXT NOT NULL, ' .
            'type VARCHAR(100) NOT NULL, ' .
            'status TINYINT(2) DEFAULT 1 NULL, ' .
            'used_status TINYINT(2) DEFAULT 0 NULL, ' .
            'created DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';        
            QuestionTable::run_script($sql);
    }


}

QuestionTable::create_table();




