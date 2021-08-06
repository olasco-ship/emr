<?php


require_once("initialize.php");

class ConsultingRooms extends DatabaseObject
{
    protected static $table_name = "rooms";
    protected static $db_fields = array('id', 'sync', 'room_no', 'clinic_id',  'date');
    public $id;
    public $sync;
    public $room_no;
    public $clinic_id;
   /* public $sub_clinic_id;*/
    public $date;


    public static function find_room_by_clinic($clinic_id){
        return static::find_by_sql("SELECT * FROM " .static::$table_name .  " WHERE clinic_id = $clinic_id " );
    }

    public static function count_room_by_clinic($clinic_id){
        global $database;
        $sql = "SELECT COUNT(*) FROM " .static::$table_name . " WHERE clinic_id = '$clinic_id' ";
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    public static function create_table()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS ' . ConsultingRooms::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'room_no VARCHAR(50) NOT NULL, ' .
            'clinic_id INT(11) NOT NULL, ' .
          /*  'sub_clinic_id INT(11) NOT NULL, ' .*/
            'date DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';
        //    'UNIQUE KEY(revenue_code))';
        ConsultingRooms::run_script($sql);
    }


}

ConsultingRooms::create_table();




