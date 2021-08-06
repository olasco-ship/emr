<?php


class StockNotification extends DatabaseObject
{

    protected static $table_name = "stock_notification";
    protected static $db_fields = array('id', 'sync', 'name', 'value', 'date');
    public $id;
    public $sync;
    public $name;
    public $value;
    public $date;

    public static function find_by_name($name){
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE name= '$name' " );
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function create_table()
    {

        $sql = 'CREATE TABLE IF NOT EXISTS ' . StockNotification::$table_name . '(' .
            'id INT(11) NOT NULL AUTO_INCREMENT, ' .
            'name VARCHAR(150) NOT NULL, ' .
            'value VARCHAR(80) NULL, ' .
            'date DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';

        StockNotification::run_script($sql);
    }

}

StockNotification::create_table();