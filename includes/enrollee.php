<?php

require_once("initialize.php");


class Enrollee extends DatabaseObject
{
    public static $table_name = "enrollee";
    protected static $db_fields = array('id', 'sync', 'first_name', 'last_name', 'nhis_number', 'gender', 'dob', 'phone_number',
        'contact_address', 'hmo', 'reg_date', 'plan_id', 'exp_date', 'status', 'date', 'fileName');



    public $id;
    public $sync;
    public $first_name;
    public $last_name;
    public $nhis_number;
    public $gender;
    public $dob;
    public $phone_number;
    public $contact_address;
    public $hmo;
    public $reg_date;
    public $plan_id;
    public $exp_date;
    public $status;
    public $date;
    public $fileName;

    protected $upload_dir = "\Images";


    public function full_name()
    {
        if (isset($this->first_name) && isset($this->last_name)) {
            return $this->first_name . " " . $this->last_name;
        } else {
            return "";
        }
    }

    public static function find_by_nhis_number($num)
    {
        $sql = "SELECT * FROM " . static::$table_name . " WHERE nhis_number= '{$num}' LIMIT 1";
        $result_array = Enrollee::find_by_sql($sql);
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public function image_path()
    {
        return $this->upload_dir . DS . $this->fileName;
    }



    public static function create_table()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS ' . Enrollee::$table_name . '(' .
            'id INT(11) NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'first_name VARCHAR(50) NOT NULL, ' .
            'last_name VARCHAR(50) NOT NULL, ' .
            'nhis_number VARCHAR(50) NOT NULL, ' .
            'gender VARCHAR(50) NOT NULL, ' .
            'dob DATETIME NOT NULL, ' .
            'phone_number VARCHAR(50) NOT NULL, ' .
            'contact_address TEXT NOT NULL, ' .
            'hmo VARCHAR(50) NOT NULL, ' .
            'reg_date DATETIME NOT NULL, ' .
            'plan_id INT(11) NOT NULL, '.
            'exp_date DATETIME NOT NULL, ' .
            'status VARCHAR(50) NOT NULL, ' .
            'date DATETIME NOT NULL, ' .
            'fileName VARCHAR(80) NOT NULL, ' .
            'PRIMARY KEY(id))';

        Enrollee::run_script($sql);
    }


    // Common Database Methods in the Parent class(DatabaseObject)


}

Enrollee::create_table();