<?php


//require_once("../../initialize.php");

class BodyPart extends DatabaseObject
{
    protected static $table_name = "body_part";
    protected static $db_fields = array('id', 'name', 'status', 'used_status','created');
    public $id;
    public $name;
    public $status;
    public $created;
    public $used_status;

    public static function findByBodyType($location_id, $ward_ids){
        $sql = "SELECT * FROM " . static::$table_name . " WHERE bed_location_id= '{$location_id}' and ward_id= '{$ward_ids}' and occupied_status='0'";
        $result_array = BodyPart::find_by_sql($sql);        
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
        $sql = 'CREATE TABLE IF NOT EXISTS ' . BodyPart::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'name VARCHAR(250) NOT NULL, ' .
            'status TINYINT(2) DEFAULT 0 NULL, ' .
            'used_status TINYINT(2) DEFAULT 0 NULL, ' .
            'created DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';        
            BodyPart::run_script($sql);
    }


}

BodyPart::create_table();




