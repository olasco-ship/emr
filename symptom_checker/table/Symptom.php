<?php


//require_once("../../initialize.php");

class Symptom extends DatabaseObject
{
    protected static $table_name = "symptom";
    protected static $db_fields = array('id', 'name', 'status', 'body_part_id', 'body_part_name','used_status','created');
    public $id;
    public $name;
    public $body_part_id;
    public $body_part_name;
    public $status;
    public $created;
    public $used_status;

    public static function find_by_body_part_id($body_prt_id){
        $sql = "SELECT * FROM " . static::$table_name . " WHERE body_part_id='{$body_prt_id}' and status=1";
        $result_array = Symptom::find_by_sql($sql);        
        return !empty($result_array) ? $result_array : FALSE;
    }
    
    public static function find_by_body_part_id_multiple($body_prt_id){
        $sql = "SELECT * FROM " . static::$table_name . " WHERE body_part_id IN ({$body_prt_id}) and status=1";
        $result_array = Symptom::find_by_sql($sql);        
        return !empty($result_array) ? $result_array : FALSE;
    }



    public function deleteBody(){
        global $database;
        $sql  = "DELETE FROM " .static::$table_name;
        $sql .= " WHERE id=" .$database->escape_value($this->id). " and used_status = 0";
        $sql .= " LIMIT 1";
        $database->query($sql);
        return ($database->affected_rows() == 1) ? TRUE : FALSE;
    }

   

    public static function create_table()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS ' . Symptom::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'name VARCHAR(250) NOT NULL, ' .
            'body_part_id VARCHAR(200) NOT NULL, ' .
            'body_part_name VARCHAR(200) NOT NULL, ' .
            'status TINYINT(2) DEFAULT 0 NULL, ' .
            'used_status TINYINT(2) DEFAULT 0 NULL, ' .
            'created DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';        
            Symptom::run_script($sql);
    }


}

Symptom::create_table();




