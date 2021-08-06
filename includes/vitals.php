<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/1/2019
 * Time: 5:33 PM
 */

class Vitals extends DatabaseObject
{
    public static $table_name = "vitals";
    protected static $db_fields = array('id', 'sync', 'nurse', 'patient_id', 'sub_clinic_id', 'clinic_id', 'waiting_list_id',
     'ref_adm_id', 'emergency_id', 'ward_id', 'temperature',
    'pulse', 'resp_rate', 'pressure', 'weight', 'height', 'pain', 'urinalysis', 'rbs', 'bmi', 'clinical_vitals', 'comment',
        'status', 'date');
    public $id;
    public $sync;
    public $nurse;
    public $patient_id;
    public $sub_clinic_id;
    public $clinic_id;
    public $waiting_list_id;
    public $ref_adm_id;
    public $emergency_id;
    public $ward_id;

    public $temperature;
    public $pulse;
    public $resp_rate;
    public $pressure;
    public $weight;
    public $height;
    public $pain;
    public $urinalysis;
    public $rbs;
    public $bmi;
    public $clinical_vitals;
    public $comment;

/*    public $head_cir;
    public $arm_cir;
    public $abd_girth;
    public $waist;
    public $hip_measure;
    public $chest_cir;
    public $physical_exam;
    public $ant_clinic;
    public $eye_clinic;
    public $family_plan;
    public $ent;
    public $mental_health;
    public $dialysis;*/

    public $status;
    public $date;

    public static function find_by_patient($patient_id)
    {
        $sql = "SELECT * FROM " . static::$table_name . " WHERE patient_id= '{$patient_id}' AND status= 'waiting' ORDER BY date DESC LIMIT 1 ";
        $result_array = Vitals::find_by_sql($sql);
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_by_patient_vitals($patient_id)
    {
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE patient_id= '{$patient_id}' ORDER BY date DESC LIMIT 20 " );
    }

    public static function find_vitals_by_waiting($waiting_list_id)
    {
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE waiting_list_id= '{$waiting_list_id}' ORDER BY date DESC LIMIT 20 " );
    }

    public static function find_by_waiting_list($id)
    {
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE waiting_list_id= '{$id}' ORDER BY date DESC LIMIT 20 " );
    }






    public static function create_table(){
        $sql = 'CREATE TABLE IF NOT EXISTS ' . Vitals::$table_name . '(' .
            'id INT(11) NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'nurse VARCHAR(50) NOT NULL, ' .
            'patient_id INT(11) NOT NULL, ' .
            'sub_clinic_id INT(11) NOT NULL, ' .
            'clinic_id INT(11) NOT NULL, ' .
            'waiting_list_id INT(11) NOT NULL, ' .
            'ref_adm_id INT(11) NOT NULL, ' .
            'emergency_id INT(11) NOT NULL, ' .
            'ward_id INT(11) NOT NULL, ' .

            'temperature  VARCHAR(50) NOT NULL, ' .
            'pulse VARCHAR(50) NOT NULL, ' .
            'resp_rate VARCHAR(50) NOT NULL, ' .
            'pressure  VARCHAR(50) NOT NULL, ' .
            'weight VARCHAR(50) NOT NULL, ' .
            'height VARCHAR(50) NOT NULL, ' .

            'pain  VARCHAR(80) NOT NULL, ' .
            'urinalysis VARCHAR(80) NOT NULL, ' .
            'rbs  VARCHAR(80) NOT NULL, ' .
            'bmi VARCHAR(80) NOT NULL, ' .
            'clinical_vitals TEXT NOT NULL, ' .
            'comment TEXT NOT NULL, ' .


            'status VARCHAR(50) NOT NULL, ' .
            'date DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';

        Vitals::run_script($sql);
    }


    // Common Database Methods in the Parent class(DatabaseObject)


}

Vitals::create_table();