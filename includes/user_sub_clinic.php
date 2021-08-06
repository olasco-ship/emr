<?php


require_once("initialize.php");

class UserSubClinic extends DatabaseObject
{
    protected static $table_name = "user_sub_clinic";
    protected static $db_fields = array('id', 'sync', 'user_id', 'sub_clinic_id', 'clinic_id', 'department', 'date');
    public $id;
    public $sync;
    public $user_id;
    public $sub_clinic_id;
    public $clinic_id;
    public $department;
    public $date;


    public static function find_user_sub_clinic_id($user_id, $sub_clinic_id)
    {
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE user_id= $user_id AND sub_clinic_id = '$sub_clinic_id' " );
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }


    public static function find_by_clinic($clinic_id){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE clinic_id = '$clinic_id' ");
    }

    public static function find_by_user_id($user_id){
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE user_id= $user_id " );
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_by_users($user_id){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE user_id= $user_id " );
    }

    public static function find_by_user_clinic_id($user_id, $clinic_id){
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE user_id= $user_id AND clinic_id = '$clinic_id' " );
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_by_user_clinic_and_subClinic_id($user_id, $clinic_id, $subClinic_id){
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE user_id= $user_id AND clinic_id = '$clinic_id' AND sub_clinic_id != '$subClinic_id' " );
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function create_table()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS ' . UserSubClinic::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'user_id INT(11) NOT NULL, ' .
            'sub_clinic_id INT(11) NOT NULL, ' .
            'clinic_id INT(11) NOT NULL, ' .
            'department VARCHAR(50) NOT NULL, ' .
            'date DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';
        //    'UNIQUE KEY(revenue_code))';
        UserSubClinic::run_script($sql);
    }


}

UserSubClinic::create_table();




