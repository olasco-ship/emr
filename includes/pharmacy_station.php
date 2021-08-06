<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 1/25/2019
 * Time: 12:40 PM
 */

class PharmacyStation extends DatabaseObject
{

    protected static $table_name = "pharmacy_station";
    protected static $db_fields= array('id', 'sync', 'name','created');
    public $id;
    public $sync;
    public $name;
    public $created;


    public static function find_station_by_name($name){
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE name= '$name' " );
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_all_station_by_name(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " ORDER BY name" );
    }

    public static function get_station(){
        $finds = self::find_all();
        foreach($finds as $find){
            echo $find->name. "<br/>";
        }
    }






    public static function create_table(){
        $sql = 'CREATE TABLE IF NOT EXISTS ' . PharmacyStation::$table_name . '(' .
            'id INT(11) NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'name VARCHAR(50) NOT NULL, ' .
            'created  DATETIME NOT NULL, ' .
            'PRIMARY KEY(id), ' .
            'UNIQUE KEY(name))';

        PharmacyStation::run_script($sql);
    }


    // Common Database Methods in the Parent class(DatabaseObject)

}

PharmacyStation::create_table();
