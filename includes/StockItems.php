<?php


class StockItems extends DatabaseObject
{

    public static $table_name = "stock_items";
    protected static $db_fields = array('id', 'sync', 'name', 'barcode', 'category_id', 'productType_id',  'description',
        'created', );

    public $id;
    public $sync;
    public $name;
    public $barcode;
    public $category_id;
    public $productType_id;
    public $description;
    public $created;


    public $category;
    public $product_type;



    public function fetch_category()
    {
        if (isset($this->category)) return $this->category;
        $this->category = StockCategory::find_by_id($this->category_id);
        return $this->category;
    }

    public function fetch_product_type()
    {
        if (isset($this->product_type)) return $this->product_type;
        $this->product_type = ProductType::find_by_id($this->productType_id);
        return $this->product_type;
    }

    public static function find_all_by_prod_name(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " ORDER BY name ASC ");
    }


    public static function find_by_prod_name($query){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE name LIKE '%$query%' " . " ORDER BY name ASC");
    }

    public static function find_by_name($name){
        //   global $database;
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE name= '$name' " );
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_by_barcode($barcode=0){
        global $database;
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE barcode=".$database->escape_value($barcode));
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_product($drug=0){
        global $database;
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE name=".$database->escape_value($drug));
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }


    public static function find_by_category_id($category_id=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE category_id = $category_id " . " ORDER BY name ASC" );
    }

    public static function find_all_by_date()
    {
        return static::find_by_sql("SELECT * FROM " . static::$table_name . " ORDER BY created DESC");
    }

    public static function find_all_by_test_id_for_drug($ids){
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE id = $ids");
        return !empty($result_array) ? array_shift($result_array) : FALSE;
        // return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE id = $ids" );
    }

    public static function create_table(){
        $sql = 'CREATE TABLE IF NOT EXISTS ' . StockItems::$table_name . '(' .
            'id INT(11) NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'name VARCHAR(100) NOT NULL, ' .
            'barcode VARCHAR(50) NOT NULL, ' .
            'category_id  INT(11) NOT NULL, ' .
            'productType_id  INT(11) NOT NULL, ' .
            'description TEXT NOT NULL, ' .
            'created  DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';


        StockItems::run_script($sql);
    }

}
StockItems::create_table();