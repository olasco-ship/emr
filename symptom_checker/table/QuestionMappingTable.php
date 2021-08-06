<?php


//require_once("../../initialize.php");

class QuestionMappingTable extends DatabaseObject
{
    protected static $table_name = "question_mapping";
    protected static $db_fields = array('id', 'gender', 'age_group_to', 'age_group_from', 'section_name',
                                        'body_part_id', 'question_id', 'question_map_id', 'another_question',
                                        'result_status','result_status_value', 'result_description', 'result_precaution',
                                        'result_remedies','status', 'created', 'body_part_id_symptom_id'
                                        );
    public $id;

    public $gender;
    public $age_group_to;
    public $age_group_from;
    public $section_name;
    public $body_part_id;
    public $body_part_id_symptom_id;
    public $question_id;
    public $question_map_id;
    public $another_question;
    public $result_status;
    public $result_status_value;
    public $result_description;
    public $result_precaution;
    public $result_remedies;
    public $status;
    public $created;    

    public static function find_by_body_part_id($body_prt_id){
        $sql = "SELECT * FROM " . static::$table_name . " WHERE body_part_id='{$body_prt_id}' and status=1";
        $result_array = QuestionTable::find_by_sql($sql);        
        return !empty($result_array) ? $result_array : FALSE;
    }



    public function deleteBody(){
        global $database;
        $sql  = "DELETE FROM " .static::$table_name;
        $sql .= " WHERE id=" .$database->escape_value($this->id);
        $sql .= " LIMIT 1";
        $database->query($sql);
        return ($database->affected_rows() == 1) ? TRUE : FALSE;
    }


    public static function find_question_first($body_part_id, $body_part_symptom_id, $age, $gender){
        $sql = "SELECT * FROM " . static::$table_name . " WHERE body_part_id='{$body_part_id}' and body_part_id_symptom_id='{$body_part_symptom_id}' and status=1 and ". trim($age, '"') ." BETWEEN age_group_to AND age_group_from and gender={$gender}";        
        $result_array = QuestionMappingTable::find_by_sql($sql);        
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }
    
    public static function find_by_conditions($genders, $body_part_ids, $body_part_symptom_ids){
        $sql = "SELECT * FROM " . static::$table_name . " WHERE body_part_id='{$body_part_ids}' and body_part_id_symptom_id='{$body_part_symptom_ids}' and gender='{$genders}' and status=1";
        $result_array = QuestionMappingTable::find_by_sql($sql);        
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

   

    public static function create_table()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS ' . QuestionMappingTable::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'gender VARCHAR(100) NOT NULL, ' .
            'age_group_to VARCHAR(200) NOT NULL, ' .
            'age_group_from VARCHAR(200) NOT NULL, ' .
            'section_name VARCHAR(200) NOT NULL, ' .
            'body_part_id VARCHAR(200) NOT NULL, ' .
            'body_part_id_symptom_id VARCHAR(200) NOT NULL, ' .
            'question_id LONGTEXT NOT NULL, ' .
            'another_question LONGTEXT NOT NULL, ' .
            'question_map_id LONGTEXT NOT NULL, ' .
            'result_status LONGTEXT NOT NULL, ' .
            'result_status_value LONGTEXT NOT NULL, ' .
            'result_description LONGTEXT NOT NULL, ' .
            'result_precaution LONGTEXT NOT NULL, ' .
            'result_remedies LONGTEXT NOT NULL, ' .
            'status TINYINT(2) DEFAULT 1 NULL, ' .            
            'created DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';        
            QuestionMappingTable::run_script($sql);
    }


}

QuestionMappingTable::create_table();




