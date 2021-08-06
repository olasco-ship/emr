<?php


class CodedDiagnosis extends DatabaseObject
{

    protected static $table_name = "codedDiagnosis";
    protected static $db_fields = array('id', 'sync', 'patient_id', 'icdCode_id', 'icdCode_name','coded_by', 'date', 'modified_by', 'date_modified' );
    public $id;
    public $sync;
    public $patient_id;
    public $icdCode_id;
    public $coded_by;
    public $icdCode_name;
    public $date;
    public $modified_by;
    public $date_modified;


    public static function find_all_by_date($startDate, $endDate){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE date BETWEEN '$startDate' AND '$endDate' ORDER BY date DESC ");
    }

    public static function find_by_date($icdCode_id, $startDate, $endDate){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE icdCode_id = '$icdCode_id' AND date BETWEEN '$startDate' AND '$endDate' ORDER BY date DESC ");
    }

    public static function find_code($icdCode_id=0){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE icdCode_id = $icdCode_id " . " ORDER BY date ASC" );
    }

    public static function count_used_icd($icdCode_id){
        global $database;
        $sql = "SELECT COUNT(*) FROM " .static::$table_name . " WHERE icdCode_id = '$icdCode_id' ";
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    public static function count_used_icd_by_date($icd_code, $startDate, $endDate){
        global $database;
        $sql = "SELECT COUNT(*) FROM " .static::$table_name . " WHERE icdCode_id = '$icd_code' AND date BETWEEN '$startDate' AND '$endDate' ";
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }



    public static function create_table()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS ' . CodedDiagnosis::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'patient_id INT(11) NOT NULL, ' .
            'icdCode_id INT(11) NOT NULL, ' .
            'icdCode_name VARCHAR(80) NOT NULL, ' .
            'coded_by VARCHAR(80) NOT NULL, ' .
            'date DATETIME NOT NULL, ' .
            'modified_by VARCHAR(80) NOT NULL, ' .
            'date_modified DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';
        CodedDiagnosis::run_script($sql);
    }

}
CodedDiagnosis::create_table();