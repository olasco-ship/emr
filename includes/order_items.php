<?php
    
require_once("initialize.php");

class OrderItems extends DatabaseObject{

    protected static $table_name = "orderItems";
    protected static $db_fields = array('id', 'sync', 'order_id', 'category_id', 'product_type_id', 'product_name', 'quantity', 'cost_price', 'unit_price','total_price', 'date');
    public $id;
    public $sync;
    public $order_id;
    public $category_id;
    public $product_type_id;
    public $product_name;
    public $quantity;
    public $cost_price;
    public $unit_price;
    public $total_price;
    public $date;

    public static function find_all_by_category_id($category_id, $start_date,  $end_date){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE category_id = $category_id AND date BETWEEN '$start_date' AND '$end_date' ORDER BY date DESC");
    }

    public static function sum_all_by_category_id($category_id, $start_date,  $end_date){
        global $database;
        $sql = "SELECT SUM(total_price) FROM " .static::$table_name . " WHERE category_id = $category_id AND date BETWEEN '$start_date' AND '$end_date' ORDER BY date DESC" ;
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    public static function sum_all_by_product_type_id($product_type_id, $start_date,  $end_date){
        global $database;
        $sql = "SELECT SUM(unit_price) FROM " .static::$table_name . " WHERE product_type_id = $product_type_id AND date BETWEEN '$start_date' AND '$end_date' ORDER BY date DESC" ;
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    public static function sum_all($start_date, $end_date){
        global $database;
        $sql = "SELECT SUM(unit_price) FROM " .static::$table_name . " WHERE date BETWEEN '$start_date' AND '$end_date' ORDER BY date DESC";
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    public static function sum_all_total_price($start_date, $end_date){
        global $database;
        $sql = "SELECT SUM(total_price) FROM " .static::$table_name . " WHERE date BETWEEN '$start_date' AND '$end_date' ORDER BY date DESC";
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    public static function sum_all_selling_price($start_date, $end_date){
        global $database;
        $sql = "SELECT SUM(unit_price) FROM " .static::$table_name . " WHERE date BETWEEN '$start_date' AND '$end_date' ORDER BY date DESC" ;
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    public static function sum_all_cost_price($start_date, $end_date){
        global $database;
        $sql = "SELECT SUM(cost_price) FROM " .static::$table_name . " WHERE date BETWEEN '$start_date' AND '$end_date' ORDER BY date DESC" ;
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    public  function find_by_order_id($order_id){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE order_id = $order_id ORDER BY date DESC" );
    }

    public  function find_by_product_name($product_name){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE product_name = $product_name ORDER BY date DESC" );
    }

    public static function find_btw_date($start_date, $end_date){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE date BETWEEN '$start_date' AND '$end_date' ORDER BY date DESC" );
    }

    public static function create_table(){
        $sql = 'CREATE TABLE IF NOT EXISTS ' . OrderItems::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'order_id INT NOT NULL, ' .
            'category_id INT NOT NULL, ' .
            'product_type_id INT NOT NULL, ' .
            'product_name VARCHAR(50) NOT NULL, ' .
            'quantity INT NOT NULL, ' .
            'cost_price INT NOT NULL, ' .
            'unit_price INT NOT NULL, ' .
            'total_price INT NOT NULL, ' .
            'date DATETIME NOT NULL, ' .
            'PRIMARY KEY(id)) ';
        OrderItems::run_script($sql);
    }
}

OrderItems::create_table();





