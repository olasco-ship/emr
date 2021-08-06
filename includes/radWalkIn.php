<?php



class RadWalkIn extends DatabaseObject {

    protected static $table_name = "radWalkIn";
    protected static $db_fields = array('id', 'sync', 'first_name', 'last_name', 'gender', 'age', 'phone_number',
     'ward_clinic', 'services', 'prices', 'unit', 
     'status', 'date');



    public $id;
    public $sync;

    public $first_name;
    public $last_name;
    public $gender;
    public $age;
    public $phone_number;

    public $ward_clinic;
    public $services;
    public $prices;
    public $unit;
    public $status;
    public $date;



    public static function find_request(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE status = 'REQUEST' ORDER BY date DESC " );
    }

    public static function find_by_bill_id($id=0){
        global $database;
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE bill_id=".$database->escape_value($id));
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }


    public static function create_table(){
        $sql = 'CREATE TABLE IF NOT EXISTS ' . RadWalkIn::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .

            'first_name VARCHAR(50) NOT NULL, ' .
            'last_name VARCHAR(50) NOT NULL, ' .
            'gender VARCHAR(50) NOT NULL, ' .
            'age VARCHAR(50) NOT NULL, ' .
            'phone_number VARCHAR(50) NOT NULL, ' .
     
            'ward_clinic VARCHAR(100) NOT NULL, ' .      
            'services TEXT NOT NULL, ' . 
            'prices TEXT NOT NULL, ' . 
            'unit VARCHAR(50) NOT NULL, ' .
            'status VARCHAR(30) NOT NULL, ' .
            'date DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';
            RadWalkIn::run_script($sql);
    }


}

RadWalkIn::create_table();