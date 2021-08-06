<?php


class UsedItem extends DatabaseObject
{
    protected static $table_name = "used_item";
    protected static $db_fields = array('id', 'sync', 'product_id', 'station_id', 'items', 'item_count', 'used_by', 'date');
    public $id;
    public $sync;
    public $product_id;
    public $station_id;
    public $items;
    public $item_count;
    public $used_by;
    public $date;


    public static function find_all_used_by_date($start_date, $end_date){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE date BETWEEN '$start_date' AND '$end_date' ORDER BY date DESC ");
    }






    public static function create_table()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS ' . UsedItem::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'product_id INT(11) NOT NULL, ' .
            'station_id INT(11) NOT NULL, ' .
            'items TEXT NOT NULL, ' .
            'item_count INT(11) NOT NULL, ' .
            'used_by VARCHAR(50) NOT NULL, ' .
            'date DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';
        UsedItem::run_script($sql);
    }

}
UsedItem::create_table();