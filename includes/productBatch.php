<?php


class ProductBatch extends DatabaseObject
{
    public static $table_name = "productBatch";
    protected static $db_fields = array('id', 'sync', 'product_id', 'cost_price','quantity', 'markup', 'selling_price',
        'batch_no', 'man_date', 'exp_date', 'created', );

    public $id;
    public $sync;
    public $product_id;
    public $cost_price;
    public $quantity;
    public $markup;
    public $selling_price;
    public $batch_no;
    public $man_date;
    public $exp_date;
    public $created;

    public static function find_by_id($id=0){
        global $database;
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE id=".$database->escape_value($id));
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_product_expiring($product_id=0){
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE product_id = $product_id " . " ORDER BY exp_date LIMIT 1" );
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_products($product_id=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE product_id = $product_id " . " ORDER BY exp_date ASC" );
    }

    public static function countProductBatches($product_id){
        global $database;
        $sql = "SELECT COUNT(*) FROM " .static::$table_name . " WHERE product_id = $product_id ";
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    public static function sumProductQuantity($product_id){
        global $database;
        $sql = "SELECT SUM(quantity) FROM " .static::$table_name . " WHERE product_id = $product_id ";
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }



    public static function create_table(){
        $sql = 'CREATE TABLE IF NOT EXISTS ' . ProductBatch::$table_name . '(' .
            'id INT(11) NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'product_id  INT(11) NOT NULL, ' .
            'cost_price VARCHAR(50) NOT NULL, ' .
            'quantity INT(11) NOT NULL, ' .
            'markup VARCHAR(50) NOT NULL, ' .
            'selling_price VARCHAR(50) NOT NULL, ' .
            'batch_no VARCHAR(50) NOT NULL, ' .
            'man_date DATE NOT NULL, ' .
            'exp_date DATE NOT NULL, ' .
            'created  DATETIME NOT NULL, ' .
            'UNIQUE KEY(batch_no), ' .
            'PRIMARY KEY(id))';

        ProductBatch::run_script($sql);
    }


    // Common Database Methods in the Parent class(DatabaseObject)


}

ProductBatch::create_table();

