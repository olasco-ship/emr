<?php


class StockDispensed extends DatabaseObject
{

    protected static $table_name = "stock_dispensed";
    protected static $db_fields = array('id', 'sync', 'storage_id', 'product_id', 'product_name', 'unit', 'status', 'date');


    public $id;
    public $sync;
    public $storage_id;
    public $product_id;
    public $drugName;
    public $unit;
    public $total_price;
    public $status;
    public $date;


    public static function find_by_product_id($product_id=0){
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE product_id = $product_id ");
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_drugs_pharmacy($id=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE pharm_id = '$id' AND status = 'ACTIVE' " );
    }

    public static function count_drugs_pharmacy($id){
        global $database;
        $sql = "SELECT COUNT(*) FROM " .static::$table_name . " WHERE pharm_id = '$id' AND status = 'ACTIVE'  ";
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    public static function find_by_storage_id($id=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE storage_id = '$id' AND status = 'ACTIVE' " );
    }

    public static function count_all_by_dept($dept){
        global $database;
        $sql = "SELECT COUNT(*) FROM " .static::$table_name . " WHERE pharm_id = '$dept' AND status = 'ACTIVE'  ";
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    public static function create_table()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS ' . StockDispensed::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'storage_id INT(11) NOT NULL, ' .
            'pharm_id INT(11) NOT NULL, ' .
            'pharm VARCHAR(80) NOT NULL, ' .
            'product_id INT(11) NOT NULL, ' .
            'drugName VARCHAR(80) NOT NULL, ' .
            'unit INT(11) NOT NULL, ' .
            'unit_price INT(11) NULL, ' .
            'total_price INT(11) NULL, ' .
            'status VARCHAR(50) NOT NULL, ' .
            'date DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';
        StockDispensed::run_script($sql);

    }

}

StockDispensed::create_table();