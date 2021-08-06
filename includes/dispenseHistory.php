<?php


require_once("initialize.php");


class DispenseHistory extends DatabaseObject
{

    protected static $table_name = "dispenseHistory";
    protected static $db_fields = array('id', 'sync', 'items', 'item_count', 'dispenser', 'dispense_to', 'pharmacy_station_id',
         'date');


    public $id;
    public $sync;
    public $items;
    public $item_count;
    public $dispenser;
    public $dispense_to;
    public $pharmacy_station_id;
    public $date;


    public static function find_all_by_date(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " ORDER BY date DESC ");
    }


    public static function create_table()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS ' . DispenseHistory::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'items TEXT NOT NULL, ' .
            'item_count INT(11) NOT NULL, ' .
            'dispenser VARCHAR(80) NOT NULL, ' .
            'dispense_to VARCHAR(80) NOT NULL, ' .
            'pharmacy_station_id  INT(11) NOT NULL, ' .
            'date DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';
            DispenseHistory::run_script($sql);

    }
}

DispenseHistory::create_table();



