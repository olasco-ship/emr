<?php

//require_once ("initialize.php");

class ItemStoreStation extends DatabaseObject
{
    protected static $table_name = "item_store_station";
    protected static $db_fields = array('id', 'sync', 'product_id', 'station_id', 'selling_price', 'name', 'quantity', 'date');
    public $id;
    public $sync;
    public $product_id;
    public $station_id;
    public $selling_price;
    public $name;
    public $quantity;
    public $date;


    public static function find_all_by_product_id($station_id){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE station_id = $station_id " );
    }

    public static function find_available_drugs($pharmacy_station_id){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE station_id = $pharmacy_station_id AND quantity != 0 " );
    }

    public static function find_by_product_and_station($product_id, $station_id){
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE product_id= $product_id AND station_id = $station_id " );
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_available_product_and_station($product_id, $station_id){
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE product_id= $product_id AND station_id = $station_id AND quantity != 0  " );
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_available_product_by_name_and_station($product_name, $station_id){
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE name = '$product_name' AND station_id = $station_id AND quantity != 0  " );
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function count_items_by_clinic($clinic_id){
        global $database;
        $sql = "SELECT COUNT(*) FROM " .static::$table_name . " WHERE station_id = '$clinic_id' ";
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    public static function find_by_name($name){
        //   global $database;
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE name= '$name' " );
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }


    public static function create_table()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS ' . ItemStoreStation::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'product_id INT(11) NOT NULL, ' .
            'station_id INT(11) NOT NULL, ' .
            'selling_price VARCHAR(50) NOT NULL, ' .
            'name VARCHAR(50) NOT NULL, ' .
            'quantity INT(11) NOT NULL, ' .
            'date DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';
        ItemStoreStation::run_script($sql);
    }

}

ItemStoreStation::create_table();