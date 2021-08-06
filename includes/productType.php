<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 1/25/2019
 * Time: 12:40 PM
 */

class ProductType extends DatabaseObject
{

    protected static $table_name = "productType";
    protected static $db_fields= array('id', 'sync','name','created');
    public $id;
    public $sync;
    public $name;
    public $created;




    public static function find_all_order_by_name(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " ORDER BY name" );
    }

    public static function get_brand(){
        $finds = self::find_all();
        foreach($finds as $find){
            echo $find->name. "<br/>";
        }
    }


    public static function create_table(){
        $sql = 'CREATE TABLE IF NOT EXISTS ' . ProductType::$table_name . '(' .
            'id INT(11) NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'name VARCHAR(50) NOT NULL, ' .
            'created  DATETIME NOT NULL, ' .
            'PRIMARY KEY(id), ' .
            'UNIQUE KEY(name))';

        ProductType::run_script($sql);
    }


    // Common Database Methods in the Parent class(DatabaseObject)

}

ProductType::create_table();
