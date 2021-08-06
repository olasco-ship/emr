<?php


require_once("initialize.php");

class UserMultiWards extends DatabaseObject
{
    protected static $table_name = "user_multi_ward";
    protected static $db_fields = array('id', 'sync', 'user_id', 'ward_id', 'ward_name', 'date');
    public $id;
    public $sync;
    public $user_id;
    public $ward_id;
    public $ward_name;
    public $date;
    

    public static function find_by_user_id($user_id){
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE user_id= $user_id" );
        return !empty($result_array) ? $result_array : FALSE;
    }

    public static function find_by_usr_id($user_id=0){
        global $database;
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE user_id=".$database->escape_value($user_id));
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function create_table()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS ' . UserMultiWards::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'user_id INT(11) NOT NULL, ' .
            'ward_id INT(11) NOT NULL, ' .
            'ward_name varchar(255) NOT NULL, ' .
            'date datetime NOT NULL, ' .
            'PRIMARY KEY(id))';
        //    'UNIQUE KEY(revenue_code))';
        UserMultiWards::run_script($sql);
    }


}

UserMultiWards::create_table();




