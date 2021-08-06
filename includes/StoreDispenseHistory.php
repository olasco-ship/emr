<?php


class StoreDispenseHistory extends DatabaseObject
{

    protected static $table_name = "storeDispenseHistory";
    protected static $db_fields = array('id', 'sync', 'items', 'item_count', 'dispenser', 'dispense_to', 'station_id',
        'date');


    public $id;
    public $sync;
    public $items;
    public $item_count;
    public $dispenser;
    public $dispense_to;
    public $station_id;
    public $date;


    public static function find_all_by_date(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " ORDER BY date DESC ");
    }

    public static function find_all_assigned_by_date($start_date, $end_date){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE date BETWEEN '$start_date' AND '$end_date' ORDER BY date DESC ");
    }


    public static function create_table()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS ' . StoreDispenseHistory::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'items TEXT NOT NULL, ' .
            'item_count INT(11) NOT NULL, ' .
            'dispenser VARCHAR(80) NOT NULL, ' .
            'dispense_to VARCHAR(80) NOT NULL, ' .
            'station_id  INT(11) NOT NULL, ' .
            'date DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';
        StoreDispenseHistory::run_script($sql);

    }

}

StoreDispenseHistory::create_table();