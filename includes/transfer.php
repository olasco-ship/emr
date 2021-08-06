<?php


class Transfer extends DatabaseObject
{
    protected static $table_name = "transfers";
    protected static $db_fields = array('id', 'sync', 'product_id', 'station_id', 'assign_by', 'receive_by', 'quantity', 'date');
    public $id;
    public $sync;
    public $product_id;
    public $station_id;
    public $assign_by;
    public $receive_by;
    public $quantity;
    public $date;

    public static function find_by_product_and_station($product_id, $station_id){
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE product_id= $product_id AND station_id = $station_id " );
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function create_table()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS ' . Transfer::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'product_id INT(11) NOT NULL, ' .
            'station_id INT(11) NOT NULL, ' .
            'assign_by VARCHAR(50) NOT NULL, '.
            'receive_by VARCHAR(50) NOT NULL, '.
            'quantity INT(11) NOT NULL, ' .
            'date DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';
        Transfer::run_script($sql);
    }

}
Transfer::create_table();