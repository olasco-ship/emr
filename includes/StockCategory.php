<?php


class StockCategory extends DatabaseObject
{
    protected static $table_name = "stock_category";
    protected static $db_fields= array('id', 'sync', 'name','created');
    public $id;
    public $sync;
    public $name;
    public $created;

    public $products;



    public static function find_all_order_by_name(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " ORDER BY name" );
    }

    public static function get_category(){
        $finds = self::find_all();
        foreach($finds as $find){
            echo $find->name. "<br/>";
        }
    }

    public function get_products(){
        if(isset($this->products))return $this->products;
        $this->products = StockItems::find_by_sql("SELECT * FROM " .StockItems::$table_name. " WHERE category_id = {$this->id} " );
        return $this->products;
    }

    public static function get_products_for_category($id = 0){
        $prcs =  StockItems::find_by_sql("SELECT * FROM " .StockItems::$table_name.  " WHERE category_id = {$id} "." ORDER BY created DESC" );
        return $prcs;
        //"SELECT * FROM " .static::$table_name. " ORDER BY created DESC"
    }

    public static function create_table(){
        $sql = 'CREATE TABLE IF NOT EXISTS ' . StockCategory::$table_name . '(' .
            'id INT(11) NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'name VARCHAR(50) NOT NULL, ' .
            'created  DATETIME NOT NULL, ' .
            'PRIMARY KEY(id), ' .
            'UNIQUE KEY(name))';

        StockCategory::run_script($sql);
    }

}

StockCategory::create_table();