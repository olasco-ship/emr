<?php

require_once("initialize.php");


class EnrolleePatient extends DatabaseObject
{
    public static $table_name = "enrollee_patient";
    protected static $db_fields = array('id', 'sync', 'enrollee_id', 'patient_id', 'nhis_number', 'folder_number', 'date');
     
        
    public $id;
    public $sync;
    public $enrollee_id;
    public $patient_id;
    public $nhis_number;
    public $folder_number;
    public $date;

    public static function find_by_nhis_number($num)
    {
        $sql = "SELECT * FROM " . static::$table_name . " WHERE nhis_number= '{$num}' LIMIT 1";
        $result_array = EnrolleePatient::find_by_sql($sql);
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }



    public static function create_table()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS ' . EnrolleePatient::$table_name . '(' .
            'id INT(11) NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'enrollee_id INT(11) NOT NULL, ' .
            'patient_id INT(11) NOT NULL, ' .
            'nhis_number VARCHAR(50) NOT NULL, ' .
            'folder_number VARCHAR(50) NOT NULL, ' .
            'date DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';

            EnrolleePatient::run_script($sql);
    }


    // Common Database Methods in the Parent class(DatabaseObject)


}

EnrolleePatient::create_table();