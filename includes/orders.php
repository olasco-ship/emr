<?php
    
require_once("initialize.php");

class Order extends DatabaseObject{

    protected static $table_name = "orders";
    protected static $db_fields = array('id', 'sync', 'order_number', 'user_id', 'salesperson', 'quantity', 'total_price',
        'payment_type', 'date' );
    public $id;
    public $sync;
    public $order_number;
    public $user_id;
    public $salesperson;
    public $quantity;
    public $total_price;
    public $payment_type;
    public $date;

    public $order_items;

    public static function find_btw_date($start_date, $end_date){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE date BETWEEN '$start_date' AND '$end_date' ORDER BY date DESC" );
    }

    public static function find_last_id(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " ORDER BY id DESC LIMIT 1");
    }

    public static function find_all_orders_by_user($user_id){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE user_id = $user_id ORDER BY order_date DESC" );
    }

    public static function find_all_orders(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " ORDER BY date DESC LIMIT 200" );
    }

    public static function create_table(){
        $sql = 'CREATE TABLE IF NOT EXISTS ' . Order::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'order_number VARCHAR(30) NOT NULL, ' .
            'user_id INT NOT NULL, ' .
            'salesperson VARCHAR(30) NULL, ' .
            'quantity INT NOT NULL, ' .
            'total_price INT NOT NULL, ' .
            'payment_type VARCHAR(30) NULL, ' .
            'date DATETIME NOT NULL, ' .
            'PRIMARY KEY(id), ' .
            'UNIQUE KEY(order_number))';
        Order::run_script($sql);
    }
}

Order::create_table();







