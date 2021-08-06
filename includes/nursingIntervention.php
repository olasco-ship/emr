<?php

class NursingIntervention extends DatabaseObject
{
    public static $table_name = "nursing_intervention";
    protected static $db_fields = array('id', 'sync', 'patient_id', 'waiting_list_id', 'ref_adm_id', 'nursingDomain_id',
        'nursingClassification_id', 'nursingDiagnosis_id', 'remarks', 'done_by', 'date');

    public $id;
    public $sync;
    public $patient_id;
    public $waiting_list_id;
    public $ref_adm_id;
    public $nursingDomain_id;
    public $nursingClassification_id;
    public $nursingDiagnosis_id;
    public $remarks;
    public $done_by;
    public $date;


    public static function find_all_by_patient($patient_id)
    {
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE patient_id= $patient_id ORDER BY date DESC " );
    }




    public static function create_table()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS ' . NursingIntervention::$table_name . '(' .
            'id INT(11) NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'patient_id INT(11) NOT NULL, ' .
            'waiting_list_id INT(11) NOT NULL, ' .
            'ref_adm_id INT(11) NOT NULL, ' .
            'nursingDomain_id INT(11) NOT NULL, ' .
            'nursingClassification_id INT(11) NOT NULL, ' .
            'nursingDiagnosis_id INT(11) NOT NULL, ' .
            'remarks TEXT NOT NULL, ' .
            'done_by VARCHAR(50) NOT NULL, ' .
            'date DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';

        NursingIntervention::run_script($sql);
    }


    // Common Database Methods in the Parent class(DatabaseObject)


}

NursingIntervention::create_table();