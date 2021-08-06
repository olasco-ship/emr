<?php


require_once("initialize.php");

class ProductPharmacyStation extends DatabaseObject
{
    protected static $table_name = "product_pharmacy_station";
    protected static $db_fields = array('id', 'sync', 'product_id', 'pharmacy_station_id', 'selling_price', 'quantity', 'date');
    public $id;
    public $sync;
    public $product_id;
    public $pharmacy_station_id;
    public $selling_price;
    public $quantity;
    public $date;


    public static function find_all_by_product_id($station_id){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE pharmacy_station_id = $station_id " );
    }

    public static function find_available_drugs($pharmacy_station_id){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE pharmacy_station_id = $pharmacy_station_id AND quantity != 0 " );
    }

    public static function find_by_product_and_station($product_id, $station_id){
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE product_id= $product_id AND pharmacy_station_id = $station_id " );
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_available_product_and_station($product_id, $station_id){
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE product_id= $product_id AND pharmacy_station_id = $station_id AND quantity != 0  " );
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }






    public static function create_table()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS ' . ProductPharmacyStation::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'product_id INT(11) NOT NULL, ' .
            'pharmacy_station_id INT(11) NOT NULL, ' .
            'selling_price VARCHAR(50) NOT NULL, ' .
            'quantity INT(11) NOT NULL, ' .
            'date DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';
        ProductPharmacyStation::run_script($sql);
    }


}

ProductPharmacyStation::create_table();




