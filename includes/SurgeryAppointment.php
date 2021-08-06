<?php


class SurgeryAppointment extends DatabaseObject
{

    public static $table_name = "sur_appointment";
    protected static $db_fields = array('id', 'sync', 'app_date', 'patient_id', 'waiting_list_id', 'ref_adm_id', 'sub_clinic_id',
         'consultant', 'status', 'date');

    public $id;
    public $sync;
    public $app_date;
    public $patient_id;
    public $waiting_list_id;
    public $ref_adm_id;
    public $sub_clinic_id;
    public $consultant;
    public $status;
    public $date;


    public static function find_by_waiting_list_id($id=0){
        global $database;
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE waiting_list_id=".$database->escape_value($id));
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_pending_appointment($waiting_list, $patient_id){
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE waiting_list_id = $waiting_list AND patient_id = $patient_id AND status = 'PENDING' " );
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }


    public static function create_table()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS ' . SurgeryAppointment::$table_name . '(' .
            'id INT(11) NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'app_date DATE NOT NULL, ' .
            'patient_id INT(11) NOT NULL, ' .
            'waiting_list_id INT(11) NOT NULL, ' .
            'ref_adm_id INT(11) NOT NULL, ' .
            'sub_clinic_id INT(11) NOT NULL, ' .
            'consultant VARCHAR(50) NOT NULL, ' .
            'status VARCHAR(50) NOT NULL, ' .
            'date DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';

        SurgeryAppointment::run_script($sql);
    }

}

SurgeryAppointment::create_table();