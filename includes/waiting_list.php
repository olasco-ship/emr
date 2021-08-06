<?php

//require_once("initialize.php");

class WaitingList extends DatabaseObject
{
    protected static $table_name = "waiting_list";
    protected static $db_fields = array('id', 'sync', 'patient_id', 'clinic_id', 'sub_clinic_id',
    'room_id', 'officer', 'dr_seen', 'vitals', 'wait_status', 'status', 'icd_status', 'date');
    public $id;
    public $sync;
    public $patient_id;
    public $wait_status;
    public $clinic_id;
    public $sub_clinic_id;
    public $room_id;
    public $officer;
    public $dr_seen;
    public $vitals;
    public $status;
    public $icd_status;
    public $date; 


    public static function find_all_by_vitals($start_date, $end_date){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE status != '' AND date BETWEEN '$start_date' AND '$end_date' ORDER BY date DESC ");
    }

    public static function find_all_waiting($start_date, $end_date){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE vitals != '' AND date BETWEEN '$start_date' AND '$end_date' ORDER BY date DESC ");
    }

    public static function count_all_waiting($start_date, $end_date){
        global $database;
        $sql = "SELECT COUNT(*) FROM " .static::$table_name . " WHERE vitals != '' AND date BETWEEN '$start_date' AND '$end_date' ORDER BY date DESC ";
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    public static function find_all_done_by_patient($patient_id)
    {
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE patient_id= $patient_id AND status = 'consultation done' ORDER BY date DESC LIMIT 20 " );
    }

    public static function find_all_done(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE status = 'consultation done' ORDER BY date DESC " );
    }

    public static function find_all_by_date($start_date, $end_date){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE date BETWEEN '$start_date' AND '$end_date' ORDER BY date DESC ");
    }

    public static function find_all_by_clinic_date($sub_clinic_id, $start_date, $end_date){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE sub_clinic_id = $sub_clinic_id AND date BETWEEN '$start_date' AND '$end_date' ORDER BY date DESC ");
    }

    public static function find_all_done_by_date($start_date, $end_date){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE status = 'consultation done' AND date BETWEEN '$start_date' AND '$end_date' ORDER BY date DESC ");
    }

    public static function find_all_not_done_by_date($start_date, $end_date){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE status != 'consultation done' AND date BETWEEN '$start_date' AND '$end_date' ORDER BY date DESC ");
    }

    public static function find_all_done_by_dr($dr, $start_date, $end_date){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE status = 'consultation done' AND dr_seen = '$dr' AND date BETWEEN '$start_date' AND '$end_date' ORDER BY date DESC ");
    }

    public static function find_all_done_by_clinic_date($sub_clinic_id, $start_date, $end_date){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE status = 'consultation done' AND sub_clinic_id = $sub_clinic_id AND date BETWEEN '$start_date' AND '$end_date' ORDER BY date DESC ");
    }

    public static function find_all_not_done_by_clinic_date($sub_clinic_id, $start_date, $end_date){ 
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE status != 'consultation done' AND sub_clinic_id = $sub_clinic_id AND date BETWEEN '$start_date' AND '$end_date' ORDER BY date DESC ");
    }

    public static function find_all_done_by_consultant($consultant, $start_date, $end_date){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE status = 'consultation done' AND dr_seen = '$consultant' AND date BETWEEN '$start_date' AND '$end_date' ORDER BY date DESC ");
    }

    public static function find_by_patient($patient_id)
    {
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE patient_id= '{$patient_id}' ORDER BY date DESC LIMIT 20 " );
    }

    public static function find_waiting($clinic_id,$start_date, $end_date){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE clinic_id = '$clinic_id' AND vitals = '' AND date BETWEEN '$start_date' AND '$end_date' ORDER BY date DESC ");
    }

    public static function find_all_pending_icd(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE status = 'consultation done' AND icd_status = 'not done' ORDER BY date DESC " );
    }

    public static function find_all_icd_done(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE status = 'consultation done' AND icd_status = 'coded' ORDER BY date DESC " );
    }

    public static function find_all_icd_done_by_date($startDate, $endDate){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE icd_status = 'coded' AND date BETWEEN '$startDate' AND '$endDate' ORDER BY date DESC " );
    }

    public static function find_all_icd_done_by_clinic_date($subClinic_id, $startDate, $endDate){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE icd_status = 'coded' AND sub_clinic_id = '$subClinic_id' AND date BETWEEN '$startDate' AND '$endDate' ORDER BY date DESC " );
    }

    public static function count_waiting($clinic_id,$start_date, $end_date){
        global $database;
        $sql = "SELECT COUNT(*) FROM " .static::$table_name . " WHERE clinic_id = '$clinic_id' AND vitals = '' AND date BETWEEN '$start_date' AND '$end_date' ";
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    public static function find_all_waiting_consultation($clinic_id){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE clinic_id = '$clinic_id' AND status = 'consultant' and wait_status=0");
    }
    public static function find_all_waiting_consultation_count($clinic_id){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE status = 'consultant' ");
    }

    public static function find_waiting_by_room($clinic_id, $room_id){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE clinic_id = '$clinic_id' AND status = 'consultant' AND room_id = '$room_id' ");
    }

    public static function count_waiting_consultation($clinic_id){
        global $database;
        $sql = "SELECT COUNT(*) FROM " .static::$table_name . " WHERE clinic_id = '$clinic_id' AND status = 'consultant' and wait_status=0";
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    public static function count_waiting_consultation_btw_date($clinic_id, $start_date, $end_date){
        global $database;
        $sql = "SELECT COUNT(*) FROM " .static::$table_name . " WHERE clinic_id = '$clinic_id' AND status = 'consultant' and wait_status=0 AND date BETWEEN '$start_date' AND '$end_date' ";
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    public static function find_all_waiting_consultation_by_date($clinic_id, $starDate, $endDate){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE clinic_id = '$clinic_id' AND status = 'consultant' 
        and wait_status=0 AND date BETWEEN '$starDate' AND '$endDate' ");
    }

    public static function find_all_sopd_waiting_consultation($clinic_id){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE clinic_id = '$clinic_id' AND status = 'consultant' 
        and wait_status=0 ");
    }


    public static function create_table()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS ' . WaitingList::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'patient_id INT(11) NOT NULL, ' .
            'wait_status TINYINT(2) NULL DEFAULT 0, ' .
            'clinic_id INT(11) NOT NULL, ' .
            'sub_clinic_id INT(11) NOT NULL, ' .
            'room_id INT(11) NOT NULL, ' .
            'officer VARCHAR(50) NOT NULL, ' .
            'dr_seen VARCHAR(50) NOT NULL, ' .
            'vitals VARCHAR(50) NOT NULL, ' .
            'status VARCHAR(50) NOT NULL, ' .
            'date DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';
        WaitingList::run_script($sql);
    }


}

WaitingList::create_table();




