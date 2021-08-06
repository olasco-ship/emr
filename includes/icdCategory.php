<?php


class ICDCategory extends DatabaseObject
{

    protected static $table_name = "icdCategory";
    protected static $db_fields = array('id', 'sync', 'code', 'name', 'date');
    public $id;
    public $sync;
    public $code;
    public $name;
    public $date;

    public static function create_table()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS ' . ICDCategory::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'code VARCHAR(20) NOT NULL, ' .
            'name VARCHAR(100) NOT NULL, ' .
            'date DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';
        //    'UNIQUE KEY(revenue_code))';
        ICDCategory::run_script($sql);
    }

}
ICDCategory::create_table();