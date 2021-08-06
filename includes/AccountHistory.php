<?php



class AccountHistory extends DatabaseObject {

    protected static $table_name = "account_history";
    protected static $db_fields = array('id', 'sync', 'ref_admission_id', 'patient_id', 'wallet_balance', 'credit', 'debit',
     'services', 'receipt', 'officer', 'date');



    public $id;
    public $sync;
    public $ref_admission_id;
    public $patient_id;
    public $wallet_balance;
    public $credit;
    public $debit;
    public $services;
    public $receipt;
    public $officer;
    public $date;


    public static function find_last_id(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " ORDER BY id DESC LIMIT 1");
    }

    public static function find_ref_admission_id($ref_admission_id){
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE ref_admission_id = $ref_admission_id ORDER BY date DESC LIMIT 1 ");
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_by_ref_admission_id($ref_admission_id){
        return static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE ref_admission_id = $ref_admission_id " );
    }


    public static function create_table(){
        $sql = 'CREATE TABLE IF NOT EXISTS ' . AccountHistory::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'ref_admission_id INT(11) NOT NULL, ' .       
            'patient_id INT(11) NOT NULL, ' .      
            'wallet_balance VARCHAR(80) NOT NULL, ' . 
            'credit VARCHAR(50) NOT NULL, ' .
            'debit VARCHAR(50) NOT NULL, ' .  
            'services TEXT NOT NULL, ' .
            'receipt VARCHAR(50) NOT NULL, ' .
            'officer VARCHAR(50) NOT NULL, ' .
            'date DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';
            AccountHistory::run_script($sql);
    }


}

AccountHistory::create_table();