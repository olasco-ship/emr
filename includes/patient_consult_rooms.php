<?php


require_once("initialize.php");

class PatientConsultingRooms extends DatabaseObject
{
    protected static $table_name = "patient_consult_rooms";
    protected static $db_fields = array('id', 'sync', 'patient_id', 'room_id', 'clinic_id', 'date');
    public $id;
    public $sync;
    public $patient_id;
    public $room_id;
    public $clinic_id;
    public $date;



    public static function count_patient_in_room($room_id){
        global $database;
        $sql = "SELECT COUNT(*) FROM " .static::$table_name . " WHERE room_id = '$room_id' ";
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    public static function find_patient_in_room($patient_id, $room_id){
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE patient_id = '$patient_id' AND room_id = '$room_id' " );
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }




    public static function create_table()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS ' . PatientConsultingRooms::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'patient_id INT(11) NOT NULL, ' .
            'room_id INT(11) NOT NULL, ' .
            'clinic_id INT(11) NOT NULL, ' .
            'date DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';
        //    'UNIQUE KEY(revenue_code))';
        PatientConsultingRooms::run_script($sql);
    }


}

PatientConsultingRooms::create_table();




