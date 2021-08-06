<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 1/31/2019
 * Time: 5:15 PM
 */

//require_once("initialize.php");

class Patient extends DatabaseObject {

    protected static $table_name = "patients";
    protected static $db_fields = array('id', 'sync', 'folder_number', 'system_number', 'tracking_no', 'nhis_no',  'nhis_reg_date',
        'nhis_eligibility', 'title', 'first_name',
        'last_name', 'dob', 'place_origin', 'gender', 'blood_group', 'genotype', 'phone_number', 'email', 'address',  'occupation',
       'marital_status', 'nationality', 'other_nation', 'state', 'lga', 'religion', 'language', 'english', 'pidgin', 'hausa', 'yoruba',
        'igbo', 'other_lang',  'next_kin_surname', 'next_kin_other_names', 'next_kin_relationship', 'next_kin_phone',
     'next_kin_address', 'status', 'registered_by', 'date_registered' );


    public $id;
    public $sync;
    public $folder_number;
    public $system_number;
    public $tracking_no;
    public $nhis_no;
    public $nhis_reg_date;
    public $nhis_eligibility;
    public $title;
    public $first_name;
    public $last_name;
    public $dob;
    public $place_origin;
    public $gender;
    public $blood_group;
    public $genotype;
    public $phone_number;
    public $email;
    public $address;
    public $occupation;
    public $marital_status;
    public $nationality;
    public $other_nation;
    public $state;
    public $lga;
    public $religion;
    public $language;
    public $english;
    public $pidgin;
    public $hausa;
    public $yoruba;
    public $igbo;
    public $other_lang;
    public $next_kin_surname;
    public $next_kin_other_names;
    public $next_kin_relationship;
    public $next_kin_phone;
    public $next_kin_address;
    public $status;
    public $date_registered;
    public $registered_by;
    public $resultData;
    



    public static function find_reg_by_date($start_date, $end_date){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE date_registered BETWEEN '$start_date' AND '$end_date' ORDER BY date_registered DESC ");
    }

    public static function find_by_patient_id($patient_id){

      $result_array = static::find_by_sql(" SELECT * FROM " .static::$table_name . " WHERE id = ''");

         return !empty($result_array) ? array_shift($result_array) : FALSE;


    }

    public static function find_reg_by_user_date($user, $start_date, $end_date){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE registered_by = '$user' AND date_registered BETWEEN '$start_date' AND '$end_date' ORDER BY date_registered DESC ");
    }

    public static function count_all_by_status(){
        global $database;
        $sql = "SELECT COUNT(*) FROM " .static::$table_name . " WHERE status = 'open' ";
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    public static function waiting_list(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE status = 'open' ");
    }

    public static function count_waiting(){
        global $database;
        $sql = "SELECT COUNT(*) FROM " .static::$table_name. " WHERE status = 'open' " ;
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    public static function find_nhis_patient(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE nhis_tracking != '' ORDER BY date_registered ");
    }

    public static function count_nhis_patient(){
        global $database;
        $sql = "SELECT COUNT(*) FROM " .static::$table_name. " WHERE nhis_tracking != '' " ;
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    public function full_name()
    {
        if (isset($this->first_name) && isset($this->last_name)) {
            return $this->first_name . " " . $this->last_name;
        } else {
            return "";
        }
    }

    public static function find_by_tracking_no($id=0){
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE nhis_tracking= '$id' ");
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_patient_by_card_type($card_id){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE card_id= {$card_id} ");
    }


    public static function find_patient_by_num_or_name($query){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE status = 'open' AND folder_number LIKE '%$query%' OR first_name LIKE '%$query%' " . " ORDER BY date_registered DESC");
    }

    public static function find_by_number_except_current_id($num, $id){
        $sql = "SELECT * FROM " . static::$table_name . " WHERE folder_number= '{$num}'  AND id <> '{$id}'";
        $result_array = Patient::find_by_sql($sql);
        return !empty($ressult_array) ? array_shift($result_array) : FALSE;
    }


     public static function find_by_number_and_result($num)
    {
        $sql = "SELECT * FROM patients p left join result r on r.patient_id = p.id WHERE folder_number= '{$num}' LIMIT 2";
       // var_dump($sql);exit;
        $result_array = Patient::find_by_sql($sql);
       //var_dump($result_array);exit;
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

   

    public static function find_by_number($num)
    {
        $sql = "SELECT * FROM " . static::$table_name . " 
        WHERE folder_number= '{$num}' LIMIT 1";
        //var_dump($sql);exit;
        $result_array = Patient::find_by_sql($sql);
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_nhis_number($id=0){
        global $database;
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE id=($id) AND nhis_no != '' ");
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_by_hosp_number($num)
    {
        $sql = "SELECT * FROM " . static::$table_name . " WHERE hosp_number= '{$num}' LIMIT 1";
        $result_array = Patient::find_by_sql($sql);
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_last_id(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " ORDER BY id DESC LIMIT 1");
    }

    public static function find_by_patient($query){
        return static::find_by_sql("SELECT * FROM " .static::$table_name .
            " WHERE folder_number LIKE '%$query%' OR first_name LIKE '%$query%' 
            OR last_name LIKE '%$query%'  " . " ORDER BY date_registered DESC ");
    }

    public static function find_by_id_pdf($id){
        global $database;
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE id=".$database->escape_value($id));
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }
    public function findWithJoinResult($num){
        $sql = "SELECT patients. *, result. * FROM patients JOIN result ON patients.id = result.patient_id AND folder_number = '{$num}'";
         $result_array = Patient::find_by_sql($sql);
        return !empty($result_array) ? array_shift($result_array) : FALSE;
        //return static::find_by_sql("SELECT patients.folder_number, result.clinic FROM patients JOIN result ON patients.id = result.patient_id AND folder_number='{$num}'");

    }



    public static function create_table(){
        $sql = 'CREATE TABLE IF NOT EXISTS ' . Patient::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'folder_number VARCHAR(50) NOT NULL, ' .
            'system_number VARCHAR(50) NOT NULL, ' .
            'tracking_no VARCHAR(50) NOT NULL, ' .
            'nhis_no VARCHAR(50) NOT NULL, ' .
            'nhis_reg_date DATETIME NOT NULL ,' .
            'nhis_eligibility VARCHAR(50) NOT NULL, ' .
            'title VARCHAR(30) NOT NULL, ' .
            'first_name VARCHAR(50) NOT NULL, ' .
            'last_name VARCHAR(80) NOT NULL, ' .
            'dob DATETIME NOT NULL, ' .
            'place_origin VARCHAR(50) NOT NULL, ' .
            'gender VARCHAR(30) NOT NULL, ' .
            'blood_group VARCHAR(30) NOT NULL, ' .
            'genotype VARCHAR(30) NOT NULL, ' .
            'phone_number VARCHAR(30) NOT NULL, ' .
            'email VARCHAR(50) NOT NULL, ' .
            'address VARCHAR(180) NOT NULL, ' .
            'occupation VARCHAR(50) NOT NULL, ' .
            'marital_status VARCHAR(50) NOT NULL, ' .
            'nationality VARCHAR(50) NOT NULL, ' .
            'other_nation VARCHAR(50) NOT NULL, ' .
            'state VARCHAR(50) NOT NULL, ' .
            'lga VARCHAR(50) NOT NULL, ' .
            'religion VARCHAR(50) NOT NULL, ' .
            'language VARCHAR(50) NOT NULL, ' .
            'english VARCHAR(50) NOT NULL, ' .
            'pidgin VARCHAR(50) NOT NULL, ' .
            'hausa VARCHAR(50) NOT NULL, ' .
            'yoruba VARCHAR(50) NOT NULL, ' .
            'igbo VARCHAR(50) NOT NULL, ' .
            'other_lang VARCHAR(50) NOT NULL, ' .

            'next_kin_surname VARCHAR(50) NOT NULL, ' .
            'next_kin_other_names VARCHAR(80) NOT NULL, ' .
            'next_kin_relationship VARCHAR(50) NOT NULL, ' .
            'next_kin_phone VARCHAR(50) NOT NULL, ' .
            'next_kin_address VARCHAR(180) NOT NULL, ' .
            'status VARCHAR(50) NOT NULL, ' .
            'registered_by VARCHAR(50) NOT NULL, ' .
            'date_registered DATETIME NOT NULL, ' .
            'UNIQUE KEY(system_number), ' .
            'PRIMARY KEY(id))';
        Patient::run_script($sql);

    }
}

Patient::create_table();



