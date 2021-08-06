<?php


class ICDCode extends DatabaseObject
{

    protected static $table_name = "icdCode";
    protected static $db_fields = array('id', 'sync', 'icdCategory_id', 'code', 'name', 'date', 'created_by', 'modified_by', 'date_modified' );
    public $id;
    public $sync;
    public $icdCategory_id;
    public $code;
    public $name;
    public $date;
    public $created_by;
    public $modified_by;
    public $date_modified;

    public static function find_by_domain_id($icdCategory_id = 0)
    {
        $result_array = static::find_by_sql("SELECT * FROM " . static::$table_name . " WHERE icdCategory_id= $icdCategory_id " );
        return $result_array;
    }

    public static function find_all_by_date($startDate, $endDate){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE date BETWEEN '$startDate' AND '$endDate' ");
    }

    public static function find_used_icd($code){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE code = '$code' ORDER BY date DESC");
    }


    public static function create_table()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS ' . ICDCode::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'icdCategory_id INT(11) NOT NULL, ' .
            'code VARCHAR(80) NOT NULL, ' .
            'name VARCHAR(80) NOT NULL, ' .
            'date DATETIME NOT NULL, ' .
            'created_by VARCHAR(80) NOT NULL, ' .
            'modified_by VARCHAR(80) NOT NULL, ' .
            'date_modified DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';
        ICDCode::run_script($sql);
    }

}
ICDCode::create_table();