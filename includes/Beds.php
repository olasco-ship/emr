<?php


require_once("initialize.php");

class Beds extends DatabaseObject
{
    protected static $table_name = "bed";
    protected static $db_fields = array('id', 'sync', 'bed_location_id', 'ward_id', 'room_number', 'bed_no_to', 'bed_no_from', 'bed_no'
                    ,'occupied_status');
    public $id;
    public $sync;
    public $bed_location_id;
    public $ward_id;
    public $room_number;
    public $bed_no_to;
    public $bed_no_from;
    public $occupied_status;

    public static function find_by_room_no_forPatient($location_id, $ward_ids){
        $sql = "SELECT * FROM " . static::$table_name . " WHERE bed_location_id= '{$location_id}' and ward_id= '{$ward_ids}' and occupied_status='0'";
        $result_array = Beds::find_by_sql($sql);        
        return !empty($result_array) ? $result_array : FALSE;
    }


    public function find_by_ward_location_id($location_id, $ward_ids)
    {
        $sql = "SELECT * FROM " . static::$table_name . " WHERE bed_location_id= '{$location_id}' and ward_id = '{$ward_ids}'";
        $result_array = Beds::find_by_sql($sql);
        return !empty($result_array) ? $result_array : FALSE;
    }
    
    public function find_by_ward_id($ward_ids)
    {
        $sql = "SELECT * FROM " . static::$table_name . " WHERE ward_id = '{$ward_ids}'";
        $result_array = Beds::find_by_sql($sql);        
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }
    public function find_by_room_number($room_no)
    {
        $sql = "SELECT * FROM " . static::$table_name . " WHERE room_number = '{$room_no}'";
        //echo $sql;die;
        $result_array = Beds::find_by_sql($sql);        
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }
    
    public function find_bed_by_room_id($location_id, $ward_ids, $room_id)
    {
        $sql = "SELECT * FROM " . static::$table_name . " WHERE bed_location_id= '{$location_id}' and ward_id = '{$ward_ids}' and room_number = '{$room_id}' limit 1";
        $result_array = Beds::find_by_sql($sql);
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

   

    public static function create_table()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS ' . Beds::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'bed_location_id VARCHAR(250) NOT NULL, ' .
            'ward_id VARCHAR(250) NOT NULL, ' .
            'room_number VARCHAR(100) NOT NULL, ' .
            'bed_no_to VARCHAR(100) NOT NULL, ' .
            'bed_no_from VARCHAR(100) NOT NULL, ' .
            'occupied_status TINYINT(2) DEFAULT 0 NULL, ' .
            'PRIMARY KEY(id))';        
            Beds::run_script($sql);
    }


}

Beds::create_table();




