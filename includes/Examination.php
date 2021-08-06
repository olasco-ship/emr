<?php


class Examination extends DatabaseObject
{

    protected static $table_name = "examinations";
    protected static $db_fields  = array('id', 'sync', 'name', 'examination_category_id', 'date');

    public $id;
    public $sync;
    public $name;
    public $examination_category_id;
    public $date;


    public static function find_by_exam_cat_id($exam_cat_id = 0)
    {
        $result_array = static::find_by_sql("SELECT * FROM " . static::$table_name . " WHERE examination_category_id= $exam_cat_id " );
        return $result_array;
    }

    public static function find_id_exam_cat($exam_cat_id = 0)
    {
        $result_array = static::find_by_sql("SELECT * FROM " . static::$table_name . " WHERE examination_category_id IN ('$exam_cat_id')" );
        return $result_array;
    }


    public static function create_table(){

        $sql = 'CREATE TABLE IF NOT EXISTS ' . Examination::$table_name . '(' .
            'id INT(11) NOT NULL AUTO_INCREMENT, '.
            'sync VARCHAR(20), ' .
            'name VARCHAR(50), ' .
            'examination_category_id INT(11) NOT NULL, ' .
            'date DATETIME NOT NULL, '.
            'PRIMARY KEY(id)) ';

        Examination::run_script($sql);

    }

}

Examination::create_table();