<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 1/31/2019
 * Time: 5:15 PM
 */

//require_once("initialize.php");

class ICDStandard extends DatabaseObject {

    protected static $table_name = "ICDStandard"; 
    protected static $db_fields = array('id', 'icd_code', 'icd_name', 'category', 'created' );


    public $id;
    public $icd_code;
    public $icd_name;
    public $category;     
    public $created;

    public static function find_by_diagnosis(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE category = 'Diagnosis' " );
    }


	

    public static function create_table(){
        $sql = 'CREATE TABLE IF NOT EXISTS ' . ICDStandard::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'icd_code VARCHAR(50) NOT NULL, ' .
            'icd_name VARCHAR(255) NOT NULL, ' .
            'category VARCHAR(50) NOT NULL ,' .
            'created DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';
            ICDStandard::run_script($sql);

    }
}

ICDStandard::create_table();



