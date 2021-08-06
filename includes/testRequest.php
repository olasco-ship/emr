<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/17/2019
 * Time: 10:46 AM
 */





class TestRequest extends DatabaseObject
{
    public static $table_name = "test_request";
    protected static $db_fields = array('id', 'sync', 'labWalkIn_id', 'waiting_list_id', 'sub_clinic_id', 'ref_adm_id', 'ward_id', 'bill_id', 'patient_id', 'consultant', 'test_no', 'not_done',
        'doc_com', 'lab_com', 'status', 'receipt', 'date');


    public $id;
    public $sync;
    public $labWalkIn_id;
    public $waiting_list_id;
    public $sub_clinic_id;
    public $ref_adm_id;
    public $ward_id;
    public $bill_id;
    public $patient_id;
    public $consultant;
    public $test_no;
    public $not_done;
    public $doc_com;
    public $lab_com;
    public $status;
    public $receipt;
    public $date;



	


    public static function find_awaiting_costing(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE status = 'awaiting_costing' ORDER BY date ASC" );
    }

    public static function count_awaiting_costing(){
        global $database;
        $sql = "SELECT COUNT(*) FROM " .static::$table_name . " WHERE status = 'awaiting_costing'  " ;
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }


    public static function find_returned_investigation(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE status = 'RETURNED' ORDER BY date DESC" );
    }

    public static function find_returned_investigation_by_subClinic($sub_clinic_id){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE status = 'RETURNED' AND sub_clinic_id = '$sub_clinic_id' ORDER BY date ASC" );
    }



    public static function find_by_waiting_list_id($id=0){
        global $database;
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE waiting_list_id=".$database->escape_value($id));
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }


    public static function find_requests($waiting_list, $patient_id){
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE waiting_list_id = $waiting_list AND patient_id = $patient_id " );
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }


    public static function find_by_encounter_id($encounter=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE encounter_id = $encounter" );
    }

    public static function find_unavailable(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE status = 'NA' ORDER BY date DESC" );
    }

    public  function find_by_bill_id_by_date($bill_id){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE bill_id = $bill_id ORDER BY date DESC" );
    }

    public static function find_by_bill_id($id=0){
        global $database;
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE bill_id=".$database->escape_value($id));
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_all_by_encounter_id($encounter=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE encounter_id = $encounter" );
    }

    public static function find_by_billed($bill_id=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE bill_id = $bill_id  AND status = 'billed' " );
    }

    public static function find_billed($bill_id=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE bill_id = $bill_id  " );
    }

    public static function find_costed_bill($encounter_id=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE encounter_id = $encounter_id AND status = 'COSTED' " );
    }

    public static function find_bill_by_cost($bill_id=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE bill_id = $bill_id AND status = 'COSTED' " );
    }

    public static function find_costed_bill_drug($encounter_id=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE dept = 'drug' AND encounter_id = $encounter_id  AND status = 'COSTED' " );
    }

    public static function find_costed_bill_lab($encounter_id=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE dept = 'lab' AND encounter_id = $encounter_id  AND status = 'COSTED' " );
    }

/*    public static function find_costed_bill_by_dept($bill_id=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE dept = 'lab' AND bill_id = $bill_id  AND status = 'COSTED' " );
    }*/

    public static function find_costed_bill_by_dept($bill_id=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE dept = 'lab' AND bill_id = $bill_id " );
    }

    public static function find_costed_bill_dept($bill_id=0){
        global $database;
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE bill_id =".$database->escape_value($bill_id));
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }



    public static function sum_all_billed($bill_id=0){
        global $database;
        $sql = "SELECT SUM(total_price) FROM " .static::$table_name . " WHERE bill_id = $bill_id AND status = 'billed' " ;
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    public static function find_paid_bill($encounter_id=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE encounter_id = $encounter_id AND status = 'PAID' " );
    }

    public static function find_cleared_results($encounter_id=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE encounter_id = $encounter_id AND status = 'CLEARED' " );
    }

    public static function find_by_patient_id_report($pat_id){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE patient_id = '$pat_id' " );
    }
	
	
	
    /*
    *   Mohit Work Start
    */
    public static function find_all_requests_by_id($ids){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE id = '$ids' " );
    }
    
   

    
    public static function find_requests_by_patientId( $patient_id){
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE patient_id = $patient_id  and status='REQUEST'" );
        return !empty($result_array) ? $result_array : FALSE;
    }

    public static function find_requests_by_patientIdForBilled( $patient_id){
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE patient_id = $patient_id  and status='billed'" );
        return !empty($result_array) ? $result_array : FALSE;
    }

    public static function count_returned_test($sub_clinic_id){
        global $database;
        $sql = "SELECT COUNT(*) FROM " .static::$table_name . " WHERE sub_clinic_id = '$sub_clinic_id' AND status = 'RETURNED'  " ;
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }




    public static function create_table(){
        $sql = 'CREATE TABLE IF NOT EXISTS ' . TestRequest::$table_name . '(' .
            'id INT(11) NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'labWalkIn_id INT(11) NOT NULL, ' .  
            'waiting_list_id INT(11) NOT NULL, ' .
            'sub_clinic_id INT(11) NOT NULL, ' .
            'ref_adm_id INT(11) NOT NULL, ' . 
            'ward_id INT(11) NOT NULL, ' .
            'bill_id INT(11) NOT NULL, ' .
            'patient_id INT(11) NOT NULL, ' .
            'consultant  VARCHAR(50) NOT NULL, ' .
            'test_no INT(11) NOT NULL, ' .
            'not_done INT(11) NOT NULL, ' .
            'doc_com TEXT NOT NULL, ' .
            'lab_com TEXT NOT NULL, ' .
            'status VARCHAR(50) NOT NULL, ' .
            'receipt VARCHAR(50) NOT NULL, ' .
            'date DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';

        TestRequest::run_script($sql);
    }


    // Common Database Methods in the Parent class(DatabaseObject)


}

TestRequest::create_table();