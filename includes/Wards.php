<?php


require_once("initialize.php");

class Wards extends DatabaseObject
{
    protected static $table_name = "ward";
    protected static $db_fields = array('id', 'sync', 'location_id', 'ward_number', 'gender', 'ward_status', 'ward_assign_status');
    public $id;
    public $sync;
    public $location_id;
    public $ward_number;
    public $gender;
    public $ward_status;
    public $ward_assign_status;

    public function uniqueName($name)
    {
        $sql = "SELECT * FROM " . static::$table_name . " WHERE ward_number= '{$name}' LIMIT 1";
        $result_array = Wards::find_by_sql($sql);
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }


    public static function find_by_location_id($id){
        $sql = "SELECT * FROM " . static::$table_name . " WHERE location_id= '{$id}' and ward_status='0'";
        //echo $sql;die;
        $result_array = Wards::find_by_sql($sql);        
        return !empty($result_array) ? $result_array : FALSE;
    }
    
    public static function find_by_location_id_for_edit($id){
        $sql = "SELECT * FROM " . static::$table_name . " WHERE id= '{$id}'";
        //echo $sql;die;
        $result_array = Wards::find_by_sql($sql);        
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_by_location_id_pat_admit($id){
        $sql = "SELECT * FROM " . static::$table_name . " WHERE location_id= '{$id}'";
        //echo $sql;die;
        $result_array = Wards::find_by_sql($sql);        
        return !empty($result_array) ? $result_array : FALSE;
    }
    
    public static function find_by_location_id_selected($id){   
        $sql = "SELECT * FROM " . static::$table_name . " WHERE location_id= '{$id}' and ward_status='1'";
        //echo $sql;die;
        $result_array = Wards::find_by_sql($sql);        
        return !empty($result_array) ? $result_array : FALSE;
    }
    
    public static function find_by_location_id_forPatient($id){
        $sql = "SELECT * FROM " . static::$table_name . " WHERE location_id= '{$id}' and ward_status='1' and ward_assign_status='0'";
        $result_array = Wards::find_by_sql($sql);        
        return !empty($result_array) ? $result_array : FALSE;
    }

    public static function create_table()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS ' . Wards::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'location_id VARCHAR(250) NOT NULL, ' .
            'ward_number VARCHAR(250) NOT NULL, ' .
            'gender VARCHAR(50) NOT NULL, ' .
            'ward_status TINYINT(2) DEFAULT 0 NULL, ' .
            'ward_assign_status TINYINT(2) DEFAULT 0 NULL, ' .
            'PRIMARY KEY(id))';        
        Wards::run_script($sql);
    }


}

Wards::create_table();




