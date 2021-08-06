<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 1/31/2019
 * Time: 5:15 PM
 */

//require_once("initialize.php");

class ReferAdmission extends DatabaseObject {

    protected static $table_name = "refer_admission";
    protected static $db_fields = array('id', 'sync', 'patient_id', 'waitList_id', 'Consultantdr', 'adm_date',  'location',
        'ward_no', 'room_no', 'bed_no', 'in_patient_id', 'nurse_id', 'discharge_doct', 'discharge_nurse',
        'm_s', 'adm_purpose', 'ipd_service', 'payment_type', 'add_wall_balance', 'wall_balance', 'remark', 'remark_nurse', 
        'pat_category', 'adm_type', 'created', "cancel_status", 'refer_status', 'discharge_date', 'settle_status', 'discount_status');


    public $id;
    public $sync;
    public $patient_id;
    public $waitList_id;
    public $in_patient_id;
    public $Consultantdr;
    public $nurse_id;
    public $discharge_doct;
    public $discharge_nurse;
    public $adm_date;
    public $location;
    public $ward_no;
    public $room_no;
    public $bed_no;
    public $m_s;
    public $adm_purpose;
    public $ipd_service;
    public $payment_type;
    public $add_wall_balance;
    public $wall_balance;
    public $remark;
    public $remark_nurse;
    public $pat_category;
    public $adm_type;
    public $created;
    public $cancel_status;
    public $refer_status;
    public $discharge_date;
    public $settle_status;
    public $discount_status;




    public static function find_by_waiting_list($waiting_list, $patient_id){
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE waitList_id = $waiting_list AND patient_id = $patient_id " );
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_by_patient($patient_id){
        $result_array =  static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE patient_id = $patient_id" );
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }
	
	public static function find_by_bill_id_first($patient_id){
        
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE patient_id = $patient_id and discharge_doct=0 and discharge_nurse=0");
    }

    /* Add Status to the Table field to use this method
    public static function find_by_patient_admitted($patient_id){
        $result_array =  static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE patient_id = $patient_id AND status = 'OPEN' " );
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }
    */

    public static function find_all_by_ipd_status(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE refer_status=0 and discharge_nurse=0 and cancel_status=0" );
    }

    public static function find_by_bill_id($patient_id){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE patient_id = $patient_id" );
    }
    
    public static function find_by_bill_id_other($patient_id){
        $result_array =  static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE patient_id = $patient_id" );
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_by_dr_id($dr_id, $ward_number){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE Consultantdr = $dr_id and ward_no = $ward_number and nurse_id = '0' and cancel_status = 0");
    } 
    
    public static function find_by_dr_id_without_ward($ward_number){    
        //echo "SELECT * FROM " .static::$table_name. " WHERE ward_no = $ward_number and nurse_id =0 and cancel_status = 0";die;
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE ward_no = $ward_number and nurse_id =0 and cancel_status = 0");
    }
    
    public static function find_pending_admission(){    
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE nurse_id =0 and cancel_status = 0");
    }

    public static function find_pending_admission_by_date($start_date, $end_date){    
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE nurse_id =0 and cancel_status = 0 AND adm_date BETWEEN '$start_date' and '$end_date'  ");
    }

    public static function find_pending_admission_by_ward($ward, $start_date, $end_date){    
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE nurse_id =0 and cancel_status = 0 AND ward_no = '$ward' AND adm_date BETWEEN '$start_date' and '$end_date'  ");
    }

    public static function find_admitted(){    
        //echo "SELECT * FROM " .static::$table_name. " WHERE ward_no = $ward_number and nurse_id != '' and discharge_doct = 0 and discharge_nurse = 0 and cancel_status = 0";die;
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE nurse_id != '0' and discharge_doct = 0 and discharge_nurse = 0 and cancel_status = 0");
    }

    public static function find_admitted_by_date($start_date, $end_date){    
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE nurse_id != '0' and discharge_doct = 0 and discharge_nurse = 0 and cancel_status = 0 AND adm_date BETWEEN '$start_date' and '$end_date' ");
    }

    public static function find_admitted_by_ward_date($ward_no, $start_date, $end_date){    
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE nurse_id != '0' and discharge_doct = 0 and discharge_nurse = 0 and cancel_status = 0 AND ward_no = $ward_no AND adm_date BETWEEN '$start_date' and '$end_date' ");
    }

    public static function find_pending_discharge(){    
        //echo "SELECT * FROM " .static::$table_name. " WHERE ward_no = $ward_number and nurse_id != '' and discharge_doct = 1";die;
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE nurse_id != '' and discharge_doct = 1 and discharge_nurse = 0 and cancel_status = 0");
    }

    public static function find_pending_discharge_by_date($start_date, $end_date){    
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE nurse_id != '' and discharge_doct = 1 and discharge_nurse = 0 and cancel_status = 0 AND discharge_date BETWEEN '$start_date' and '$end_date' ");
    }

    public static function find_pending_discharge_by_ward($ward, $start_date, $end_date){    
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE nurse_id =0 and cancel_status = 0 AND ward_no = '$ward' AND discharge_date BETWEEN '$start_date' and '$end_date' ");
    }

    public static function find_discharge(){    
        //echo "SELECT * FROM " .static::$table_name. " WHERE ward_no = $ward_number and nurse_id != '' and discharge_doct = 1";die;
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE nurse_id != '' and discharge_doct = 1 and discharge_nurse = 1 and cancel_status = 0");
    }

    public static function find_discharge_by_date($start_date, $end_date){    
        //echo "SELECT * FROM " .static::$table_name. " WHERE ward_no = $ward_number and nurse_id != '' and discharge_doct = 1";die;
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE nurse_id != '' and discharge_doct = 1 and discharge_nurse = 1 and cancel_status = 0 AND discharge_date BETWEEN '$start_date' and '$end_date' ");
    }

    public static function find_discharge_by_ward($ward, $start_date, $end_date){   
        //echo "SELECT * FROM " .static::$table_name. " WHERE ward_no = $ward_number and nurse_id != '' and discharge_doct = 1";die;
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE nurse_id != '' and discharge_doct = 1 and discharge_nurse = 1 and cancel_status = 0 AND ward_no = '$ward' AND discharge_date BETWEEN '$start_date' and '$end_date' ");
    }

    public static function find_by_dr_id_with_admitted($dr_id, $ward_number){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE Consultantdr = $dr_id and ward_no = $ward_number and nurse_id is NULL and discharge_doct = 0 and discharge_nurse = 0 and cancel_status = 0");
    } 

    public static function find_by_dr_id_without_ward_with_admitted($ward_number){    
        //echo "SELECT * FROM " .static::$table_name. " WHERE ward_no = $ward_number and nurse_id != '' and discharge_doct = 0 and discharge_nurse = 0 and cancel_status = 0";die;
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE ward_no = $ward_number and nurse_id != '0' and discharge_doct = 0 and discharge_nurse = 0 and cancel_status = 0");
    }

    public static function find_by_dr_id_with_discharge_pending($dr_id, $ward_number){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE Consultantdr = $dr_id and ward_no = $ward_number and nurse_id != '' and discharge_doct = 1 and discharge_nurse = 0 and cancel_status = 0");
    } 

    public static function find_by_dr_id_without_ward_with_discharge_pending($ward_number){    
        //echo "SELECT * FROM " .static::$table_name. " WHERE ward_no = $ward_number and nurse_id != '' and discharge_doct = 1";die;
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE ward_no = $ward_number and nurse_id != '' and discharge_doct = 1 and discharge_nurse = 0 and cancel_status = 0");
    }

    public static function find_by_dr_id_with_discharge($dr_id, $ward_number){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE Consultantdr = $dr_id and ward_no = $ward_number and nurse_id != '' and discharge_doct = 1 and discharge_nurse = 1 and cancel_status = 0");
    }

    public static function find_by_dr_id_without_ward_with_discharge($ward_number){    
        //echo "SELECT * FROM " .static::$table_name. " WHERE ward_no = $ward_number and nurse_id != '' and discharge_doct = 1";die;
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE ward_no = $ward_number and nurse_id != '' and discharge_doct = 1 and discharge_nurse = 1 and cancel_status = 0");
    }

    public static function find_by_dr_id_with_cancel($dr_id, $ward_number){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE Consultantdr = $dr_id and ward_no = $ward_number and cancel_status = 1");
    }

    public static function find_by_dr_id_with_ward_with_cancel($ward_number){    
        //echo "SELECT * FROM " .static::$table_name. " WHERE ward_no = $ward_number and nurse_id != '' and discharge_doct = 1";die;
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE ward_no = $ward_number and cancel_status = 1");
    }



    
    //Nursing Data:-----------------------    
    public static function find_by_nurse_ward_id($dr_id, $ward_number){
        //echo "SELECT * FROM " .static::$table_name. " WHERE ward_no = $ward_number and nurse_id is NULL and cancel_status = 0";die;
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE ward_no = $ward_number and nurse_id = 0  and  cancel_status = 0");
    }

    public static function find_by_nurse_ward_id_without_ward($ward_number){    
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE ward_no = $ward_number and nurse_id =0 and cancel_status = 0 and discharge_doct = 0 and discharge_nurse = 0 and cancel_status = 0");
    }

    public static function find_by_nurse_id_with_admitted($dr_id, $ward_number){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE nurse_id = $dr_id and ward_no = $ward_number  and discharge_doct = 0 and discharge_nurse = 0 and cancel_status = 0");
    } 

    public static function find_by_nurse_id_without_ward_with_admitted($ward_number){    
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE ward_no = $ward_number and nurse_id > 0 and discharge_doct = 0 and discharge_nurse = 0 and cancel_status = 0");
    }

    public static function find_by_nurse_id_with_discharge($dr_id, $ward_number){
        //echo "SELECT * FROM " .static::$table_name. " WHERE nurse_id = $dr_id and ward_no = $ward_number and discharge_doct = 1 and discharge_nurse = 1 and cancel_status = 0";die;
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE nurse_id = $dr_id and ward_no = $ward_number and discharge_doct = 1 and discharge_nurse = 1 and cancel_status = 0");
    }

    public static function find_by_nurse_id_without_ward_with_discharge($ward_number){    
        //echo "SELECT * FROM " .static::$table_name. " WHERE ward_no = $ward_number and nurse_id != '' and discharge_doct = 1";die;
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE ward_no = $ward_number and discharge_doct = 1 and discharge_nurse = 1 and cancel_status = 0");
    }

    public static function find_by_nurse_id_with_cancel($dr_id, $ward_number){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE ward_no = $ward_number and cancel_status = 1");
    }

    public static function find_by_nurse_id_with_discharge_pending($dr_id, $ward_number){
        //echo "SELECT * FROM " .static::$table_name. " WHERE ward_no = $ward_number and discharge_doct = 1 and discharge_nurse = 0 and cancel_status = 0";die;
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE ward_no = $ward_number and discharge_doct = 1 and discharge_nurse = 0 and cancel_status = 0");
    }

    public static function find_by_nurse_id_without_ward_with_discharge_pending($ward_number){    
        //echo "SELECT * FROM " .static::$table_name. " WHERE ward_no = $ward_number and nurse_id != '' and discharge_doct = 1";die;
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE ward_no = $ward_number and discharge_doct = 1 and discharge_nurse = 0 and cancel_status = 0");
    }

    public static function find_by_patient_id_refund($patIds){
        $result_array = static::find_by_sql("SELECT * FROM  ".static::$table_name."  WHERE patient_id=".$patIds);
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }


    public static function count_for_pagination_pending($dr_id, $ward_number,$session_variable){    
        //echo "SELECT * FROM " .static::$table_name. " WHERE ward_no = $ward_number and nurse_id =0 and cancel_status = 0";die;
        //if($session_variable!='')
        //{
            //return static::count_data("SELECT COUNT(*) FROM " .static::$table_name. " WHERE Consultantdr = $dr_id and ward_no = $ward_number and nurse_id = '0' and cancel_status = 0");
       // }
        //else
        //{
            return static::count_data("SELECT COUNT(*) FROM " .static::$table_name. " WHERE ward_no = $ward_number and nurse_id =0 and cancel_status = 0");
       // }
    }
    
    public static function pagination_query($offset,$no_of_records_per_page,$ward_number,$session_variable,$dr_id){    
        //echo "SELECT * FROM " .static::$table_name. " WHERE ward_no = $ward_number and nurse_id =0 and cancel_status = 0";die;
        /*if($session_variable!='')
        {
            return static::count_data_limit("SELECT * FROM " .static::$table_name. " WHERE Consultantdr = $dr_id and ward_no = $ward_number and nurse_id = '0' and cancel_status = 0 LIMIT $offset , $no_of_records_per_page");
        }
        else
        {*/
            return static::count_data_limit("SELECT * FROM " .static::$table_name. " WHERE ward_no = $ward_number and nurse_id =0 and cancel_status = 0 LIMIT $offset , $no_of_records_per_page");
        //}
    }


    public static function count_admitted($dr_id, $ward_number,$session_variable){
        /*if($session_variable!='')
        {
            return static::count_data("SELECT COUNT(*) FROM " .static::$table_name. " WHERE Consultantdr = $dr_id and ward_no = $ward_number and nurse_id is NULL and discharge_doct = 0 and discharge_nurse = 0 and cancel_status = 0");
        }
        else{*/
            return static::count_data("SELECT COUNT(*) FROM " .static::$table_name. " WHERE ward_no = $ward_number and nurse_id != '0' and discharge_doct = 0 and discharge_nurse = 0 and cancel_status = 0");
       // }
        
    }
    public static function pagination_query_admitted($offset,$no_of_records_per_page,$ward_number,$session_variable,$dr_id){    
        //echo "SELECT * FROM " .static::$table_name. " WHERE ward_no = $ward_number and nurse_id =0 and cancel_status = 0";die;
       /* if($session_variable!='')
        {
            return static::count_data_limit("SELECT * FROM " .static::$table_name. " WHERE Consultantdr = $dr_id and ward_no = $ward_number and nurse_id is NULL and discharge_doct = 0 and discharge_nurse = 0 and cancel_status = 0 LIMIT $offset , $no_of_records_per_page");
        }
        else
        {*/
            return static::count_data_limit("SELECT * FROM " .static::$table_name. " WHERE ward_no = $ward_number and nurse_id != '0' and discharge_doct = 0 and discharge_nurse = 0 and cancel_status = 0 LIMIT $offset , $no_of_records_per_page");
       // }
       
    }

    public static function count_find_by_dr_id_without_ward_with_discharge_pending($ward_number){    
        //echo "SELECT * FROM " .static::$table_name. " WHERE ward_no = $ward_number and nurse_id != '' and discharge_doct = 1";die;
        return static::count_data("SELECT COUNT(*) FROM " .static::$table_name. " WHERE ward_no = $ward_number and nurse_id != '' and discharge_doct = 1 and discharge_nurse = 0 and cancel_status = 0");
    }
    public static function pagination_find_by_dr_id_without_ward_with_discharge_pending($offset,$no_of_records_per_page,$ward_number){    
        //echo "SELECT * FROM " .static::$table_name. " WHERE ward_no = $ward_number and nurse_id != '' and discharge_doct = 1";die;
        return static::count_data_limit("SELECT * FROM " .static::$table_name. " WHERE ward_no = $ward_number and nurse_id != '' and discharge_doct = 1 and discharge_nurse = 0 and cancel_status = 0 LIMIT $offset , $no_of_records_per_page");
    }
    public static function count_find_by_dr_id_without_ward_with_discharge($ward_number){    
        //echo "SELECT * FROM " .static::$table_name. " WHERE ward_no = $ward_number and nurse_id != '' and discharge_doct = 1";die;
        return static::count_data("SELECT COUNT(*) FROM " .static::$table_name. " WHERE ward_no = $ward_number and nurse_id != '' and discharge_doct = 1 and discharge_nurse = 1 and cancel_status = 0");
    }
    public static function pagination_find_by_dr_id_without_ward_with_discharge($offset,$no_of_records_per_page,$ward_number){    
        //echo "SELECT * FROM " .static::$table_name. " WHERE ward_no = $ward_number and nurse_id != '' and discharge_doct = 1";die;
        return static::count_data_limit("SELECT * FROM " .static::$table_name. " WHERE ward_no = $ward_number and nurse_id != '' and discharge_doct = 1 and discharge_nurse = 1 and cancel_status = 0 LIMIT $offset , $no_of_records_per_page");
    }
    public static function count_find_by_dr_id_with_ward_with_cancel($ward_number){    
        //echo "SELECT * FROM " .static::$table_name. " WHERE ward_no = $ward_number and nurse_id != '' and discharge_doct = 1";die;
        return static::count_data("SELECT COUNT(*) FROM " .static::$table_name. " WHERE ward_no = $ward_number and cancel_status = 1");
    }
    public static function pagination_find_by_dr_id_with_ward_with_cancel($offset,$no_of_records_per_page,$ward_number){    
        //echo "SELECT * FROM " .static::$table_name. " WHERE ward_no = $ward_number and nurse_id != '' and discharge_doct = 1";die;
        return static::count_data_limit("SELECT * FROM " .static::$table_name. " WHERE ward_no = $ward_number and cancel_status = 1 LIMIT $offset , $no_of_records_per_page");
    }
    //nursing
    public static function to_admit_count($ward_number,$session_variable,$role,$dr_id){
        //echo "SELECT * FROM " .static::$table_name. " WHERE ward_no = $ward_number and nurse_id is NULL and cancel_status = 0";die;
        if($session_variable == "Nursing" && $role!= "admin")
        {
            return static::count_data("SELECT COUNT(*) FROM " .static::$table_name. " WHERE ward_no = $ward_number and nurse_id = 0  and  cancel_status = 0");
        }
        else 
        {
            return static::count_data("SELECT COUNT(*) FROM " .static::$table_name. " WHERE ward_no = $ward_number and nurse_id =0 and cancel_status = 0 and discharge_doct = 0 and discharge_nurse = 0 and cancel_status = 0");
        }
    }
    public static function to_admit_pagination_query($offset,$no_of_records_per_page,$ward_number,$session_variable,$role,$dr_id){
        //echo "SELECT * FROM " .static::$table_name. " WHERE ward_no = $ward_number and nurse_id is NULL and cancel_status = 0";die;
        if($session_variable == "Nursing" && $role!= "admin")
        {
            return static::count_data_limit("SELECT * FROM " .static::$table_name. " WHERE ward_no = $ward_number and nurse_id = 0  and  cancel_status = 0 LIMIT $offset , $no_of_records_per_page");
        }
        else 
        {
            return static::count_data_limit("SELECT * FROM " .static::$table_name. " WHERE ward_no = $ward_number and nurse_id =0 and cancel_status = 0 and discharge_doct = 0 and discharge_nurse = 0 and cancel_status = 0 LIMIT $offset , $no_of_records_per_page");
        }
    }
    public static function to_admit_patient_count($ward_number,$session_variable,$role,$dr_id){
        if($session_variable == "Nursing" && $role!= "admin")
        {
            return static::count_data("SELECT COUNT(*) FROM " .static::$table_name. " WHERE nurse_id = $dr_id and ward_no = $ward_number  and discharge_doct = 0 and discharge_nurse = 0 and cancel_status = 0");
        }
        else 
        {
            return static::count_data("SELECT COUNT(*) FROM " .static::$table_name. " WHERE ward_no = $ward_number and nurse_id > 0 and discharge_doct = 0 and discharge_nurse = 0 and cancel_status = 0");
        }
        
    }
    public static function to_admit_patient_pagination_query($offset,$no_of_records_per_page,$ward_number,$session_variable,$role,$dr_id){
        //echo "SELECT * FROM " .static::$table_name. " WHERE ward_no = $ward_number and nurse_id is NULL and cancel_status = 0";die;
        if($session_variable == "Nursing" && $role!= "admin")
        {
            return static::count_data_limit("SELECT * FROM " .static::$table_name. " WHERE nurse_id = $dr_id and ward_no = $ward_number  and discharge_doct = 0 and discharge_nurse = 0 and cancel_status = 0 LIMIT $offset , $no_of_records_per_page");
        }
        else 
        {
            return static::count_data_limit("SELECT * FROM " .static::$table_name. " WHERE ward_no = $ward_number and nurse_id > 0 and discharge_doct = 0 and discharge_nurse = 0 and cancel_status = 0 LIMIT $offset , $no_of_records_per_page");
        }
    }
    public static function to_discharge_patient_count($ward_number,$session_variable,$role,$dr_id){
        //echo "SELECT * FROM " .static::$table_name. " WHERE ward_no = $ward_number and discharge_doct = 1 and discharge_nurse = 0 and cancel_status = 0";die;
        if($session_variable == "Nursing" && $role!= "admin")
        {
            return static::count_data("SELECT COUNT(*) FROM " .static::$table_name. " WHERE ward_no = $ward_number and discharge_doct = 1 and discharge_nurse = 0 and cancel_status = 0");
        }
        else 
        {
            return static::count_data("SELECT COUNT(*) FROM " .static::$table_name. " WHERE ward_no = $ward_number and discharge_doct = 1 and discharge_nurse = 0 and cancel_status = 0");
        }
        
    }
    public static function to_discharge_patient_pagination_query($offset,$no_of_records_per_page,$ward_number,$session_variable,$role,$dr_id){
        //echo "SELECT * FROM " .static::$table_name. " WHERE ward_no = $ward_number and discharge_doct = 1 and discharge_nurse = 0 and cancel_status = 0";die;
        if($session_variable == "Nursing" && $role!= "admin")
        {
            return static::count_data_limit("SELECT * FROM " .static::$table_name. " WHERE ward_no = $ward_number and discharge_doct = 1 and discharge_nurse = 0 and cancel_status = 0 LIMIT $offset , $no_of_records_per_page");
        }
        else 
        {
            return static::count_data_limit("SELECT * FROM " .static::$table_name. " WHERE ward_no = $ward_number and discharge_doct = 1 and discharge_nurse = 0 and cancel_status = 0 LIMIT $offset , $no_of_records_per_page");
        }
        
    }
    public static function discharge_patient_count($ward_number,$session_variable,$role,$dr_id){
        //echo "SELECT * FROM " .static::$table_name. " WHERE nurse_id = $dr_id and ward_no = $ward_number and discharge_doct = 1 and discharge_nurse = 1 and cancel_status = 0";die;
        if($session_variable == "Nursing" && $role!= "admin")
        {
            return static::count_data("SELECT COUNT(*) FROM " .static::$table_name. " WHERE nurse_id = $dr_id and ward_no = $ward_number and discharge_doct = 1 and discharge_nurse = 1 and cancel_status = 0");
        }
        else 
        {
            return static::count_data("SELECT COUNT(*) FROM " .static::$table_name. " WHERE ward_no = $ward_number and discharge_doct = 1 and discharge_nurse = 1 and cancel_status = 0");
        }
        
    }
    public static function discharge_patient_pagination_query($offset,$no_of_records_per_page,$ward_number,$session_variable,$role,$dr_id){
        //echo "SELECT * FROM " .static::$table_name. " WHERE nurse_id = $dr_id and ward_no = $ward_number and discharge_doct = 1 and discharge_nurse = 1 and cancel_status = 0";die;
        if($session_variable == "Nursing" && $role!= "admin")
        {
            return static::count_data_limit("SELECT * FROM " .static::$table_name. " WHERE nurse_id = $dr_id and ward_no = $ward_number and discharge_doct = 1 and discharge_nurse = 1 and cancel_status = 0 LIMIT $offset , $no_of_records_per_page");
        }
        else 
        {
            return static::count_data_limit("SELECT * FROM " .static::$table_name. " WHERE ward_no = $ward_number and discharge_doct = 1 and discharge_nurse = 1 and cancel_status = 0 LIMIT $offset , $no_of_records_per_page");
        }
        
    }
    public static function cancel_patient_count($ward_number,$session_variable,$role,$dr_id){
        if($session_variable == "Nursing" && $role!= "admin")
        {
            return static::count_data("SELECT COUNT(*) FROM " .static::$table_name. " WHERE ward_no = $ward_number and cancel_status = 1");
        }
        else 
        {
            return static::count_data("SELECT COUNT(*) FROM " .static::$table_name. " WHERE ward_no = $ward_number and cancel_status = 1");
        }
        
    }
    public static function cancel_patient_pagination_query($offset,$no_of_records_per_page,$ward_number,$session_variable,$role,$dr_id){
        if($session_variable == "Nursing" && $role!= "admin")
        {
            return static::count_data_limit("SELECT * FROM " .static::$table_name. " WHERE ward_no = $ward_number and cancel_status = 1 LIMIT $offset , $no_of_records_per_page");
        }
        else 
        {
            return static::count_data_limit("SELECT * FROM " .static::$table_name. " WHERE ward_no = $ward_number and cancel_status = 1 LIMIT $offset , $no_of_records_per_page");
        }
        
    }

    public static function create_table(){
        $sql = 'CREATE TABLE IF NOT EXISTS ' . ReferAdmission::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'patient_id VARCHAR(50) NOT NULL, ' .
            'in_patient_id VARCHAR(255) NOT NULL, ' .
            'waitList_id INT(11) NOT NULL, ' .
            'settle_status VARCHAR(255) NOT NULL, ' .
            'discount_status TINYINT(2) NULL DEFAULT 0, ' .
            'refer_status TINYINT(255) NULL DEFAULT 0, ' .
            'Consultantdr VARCHAR(50) NOT NULL, ' .
            'nurse_id VARCHAR(200) NOT NULL, ' .
            'discharge_doct TINYINT(2) NULL DEFAULT 0, ' .
            'discharge_nurse TINYINT(2) NULL DEFAULT 0, ' .
            'cancel_status TINYINT(2) NULL DEFAULT 0, ' .
            'adm_date VARCHAR(50) NOT NULL, ' .
            'location VARCHAR(50) NOT NULL ,' .
            'ward_no VARCHAR(50) NOT NULL, ' .
            'room_no VARCHAR(30) NOT NULL, ' .
            'bed_no VARCHAR(50) NOT NULL, ' .
            'm_s VARCHAR(80) NOT NULL, ' .
            'adm_purpose VARCHAR(80) NOT NULL, ' .
            'ipd_service VARCHAR(255) NOT NULL, ' .
            'payment_type VARCHAR(30) NOT NULL, ' .
            'add_wall_balance VARCHAR(30) NOT NULL, ' .
            'wall_balance VARCHAR(30) NOT NULL, ' .
            'remark text NOT NULL, ' .
            'remark_nurse text NOT NULL, ' .
            'pat_category VARCHAR(100) NOT NULL, ' .
            'adm_type VARCHAR(100) NOT NULL, ' .
            'discharge_date DATE NOT NULL, ' .
            'created DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';
            ReferAdmission::run_script($sql);

    }
}

ReferAdmission::create_table();



