<?php


require_once("initialize.php");

class BedsList extends DatabaseObject
{
    protected static $table_name = "bed_list";
    protected static $db_fields = array('id', 'sync', 'bed_location_id', 'ward_id', 'room_number', 'bed_no',
     'bed_id', 'occupied_bed_status', 'patient_id');
    public $id;
    public $sync;
    public $bed_location_id;
    public $ward_id;
    public $room_number;
    public $bed_no;
    public $bed_id;
    public $occupied_bed_status;
    public $patient_id;
	
	public function find_by_bed_id_for_edit($bed_ids)
    {
        $sql = "SELECT * FROM " . static::$table_name . " WHERE bed_id= '{$bed_ids}'";
        $result_array = BedsList::find_by_sql($sql);
        return !empty($result_array) ? $result_array : FALSE;
    }

    public function find_by_bed_id($bed_ids)
    {
        $sql = "SELECT * FROM " . static::$table_name . " WHERE bed_id= '{$bed_ids}' and occupied_bed_status = '0'";
        $result_array = BedsList::find_by_sql($sql);
        return !empty($result_array) ? $result_array : FALSE;
    }
    
    public function find_by_ward_id($ward_ids, $bed_no, $pat_id)
    {
        $sql = "SELECT * FROM " . static::$table_name . " WHERE ward_id= '{$ward_ids}' and bed_no='{$bed_no}' and patient_id='{$pat_id}'";
        //echo $sql;die;
        $result_array = BedsList::find_by_sql($sql);
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public function find_by_ward_id_set($ward_ids, $bed_no)
    {
        $sql = "SELECT * FROM " . static::$table_name . " WHERE ward_id= '{$ward_ids}' and bed_no='{$bed_no}'";
        //echo $sql;die;
        $result_array = BedsList::find_by_sql($sql);
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }
    
    public function find_by_bed_allot_status_change($pat_id)
    {
        $sql = "SELECT * FROM " . static::$table_name . " WHERE patient_id='{$pat_id}'";
        //echo $sql;die;
        $result_array = BedsList::find_by_sql($sql);
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public function find_by_bed_id_count($bed_ids)
    {
        $sql = "SELECT * FROM " . static::$table_name . " WHERE bed_id= '{$bed_ids}' and occupied_bed_status = '1'";
       // echo $sql;die;
        $result_array = BedsList::find_by_sql($sql);    
        return !empty($result_array) ? count($result_array) : 0;
    }

    public function find_by_bed_id_count_vacant($bed_ids)
    {
        $sql = "SELECT * FROM " . static::$table_name . " WHERE bed_id= '{$bed_ids}' and occupied_bed_status = '0'";
       // echo $sql;die;
        $result_array = BedsList::find_by_sql($sql);    
        return !empty($result_array) ? count($result_array) : 0;
    }

    public function find_by_bed_id_list($bed_ids, $bed_no)
    {
        $sql = "SELECT * FROM " . static::$table_name . " WHERE bed_id= '{$bed_ids}' and bed_no='{$bed_no}' and occupied_bed_status = '1'";
        //echo $sql;
        $result_array = BedsList::find_by_sql($sql);    
        return !empty($result_array) ? array_shift($result_array) : 0;
    }


    public function find_bed_by_room_id_selected_bed($location_id, $ward_ids, $bedId)
    {
        $sql = "SELECT * FROM " . static::$table_name . " WHERE bed_location_id= '{$location_id}' and ward_id = '{$ward_ids}'";
       //echo $sql;die;
        $result_array = BedsList::find_by_sql($sql);
        return !empty($result_array) ? ($result_array) : FALSE;
    }

    public static function create_table()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS ' . BedsList::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'bed_location_id VARCHAR(250) NOT NULL, ' .
            'ward_id VARCHAR(250) NOT NULL, ' .
            'room_number VARCHAR(100) NOT NULL, ' .
            'bed_no VARCHAR(100) NOT NULL, ' .            
            'bed_id VARCHAR(100) NOT NULL, ' .            
            'patient_id VARCHAR(100) NOT NULL, ' .            
            'occupied_bed_status TINYINT(2) DEFAULT 0 NOT NULL,' .            
            'PRIMARY KEY(id))';        
            BedsList::run_script($sql);
    }


}

BedsList::create_table();




