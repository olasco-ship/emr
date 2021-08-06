<?php
//require_once("initialize.php");  

class DatabaseObject{

    protected static $table_name;
    protected static $db_fields = array();

    // Common Database Methods

    public static function find_all(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name);
    }

    public static function find_offline(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE sync = 'off' LIMIT 200 ");
    }
    
    public static function find_all_with_join($column_name,$joinType, $table ,$joinCondition, $orderBy){
        return static::findWithJoin("SELECT $column_name FROM " .static::$table_name, $joinType, $table ,$joinCondition, $orderBy);
    }
    public static function find_all_with_join_multiple($column_name, $joinType = [], $table = [] ,$joinCondition = [], $orderBy){
        return static::findWithJoinMultiple("SELECT $column_name FROM " .static::$table_name, $joinType, $table ,$joinCondition, $orderBy);
    }

    public static function find_by_id($id=0){
        global $database;
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE id=".$database->escape_value($id));
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_by_patient_id($id=0){
        global $database;
        $result_array = static::find_by_sql("SELECT * FROM  patient_subclinic WHERE patient_id=".$database->escape_value($id));
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_by_sql($sql =""){
        global $database;
        $result_set = $database->query($sql);
        $object_array = array();
        while ($row = $database->fetch_array($result_set)){
            $object_array[] = static::instantiate($row);
        }
        return $object_array;
    }

    public function findWithJoin($sql, $joinType, $table ,$joinCondition,$orderBy)
    {
        global $database;
        $qur = $sql ." ". $joinType . ' join '. $table ."  on ". $joinCondition. " order by ".$orderBy. " desc";;
        $result_set = $database->query($qur);
        $object_array = array();
        while ($row = $database->fetch_array($result_set)){
            
            $object_array[] = static::instantiateJoin($row);
        }
        
        return $object_array;
    }
    public function findWithJoinMultiple($sql, $joinType, $table ,$joinCondition, $orderBy)
    {
        // pre_d($joinType);
        // pre_d($table);
        // pre_d($joinCondition);
        
        global $database;
        $qur = $sql ." ";
        //$qur = $sql ." ". $joinType . ' join '. $table ."  on ". $joinCondition;
        try{
            if(!empty($joinType)){
                $typeJoin = "";
                foreach($joinType as $k => $joinTypeData){
                    $typeJoin .= $joinTypeData. " join ". $table[$k]. " on ". $joinCondition[$k]. " ";
                }
                $qur .=  $typeJoin. " order by ".$orderBy. " desc";
            }
            $result_set = $database->query($qur);
            $object_array = array();
            while ($row = $database->fetch_array($result_set)){
                
                $object_array[] = static::instantiateJoin($row);
            }
            //die;
        }catch(Exception $e){
            echo $e;
        }
        
        
        return $object_array;
    }

    private static function instantiateJoin($record){
        $class_name = get_called_class();
        $object = new $class_name;
       // $object = new self(); .
       
        foreach($record as $attribute=>$value){
     //       if($object->has_attribute_join($attribute)){
                $object->$attribute = $value;
       //     }
        }
        return $object;
    }

    public static function count_all(){
        global $database;
        $sql = "SELECT COUNT(*) FROM " .static::$table_name;
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    private static function instantiate($record){
        $class_name = get_called_class();
        $object = new $class_name;
       // $object = new self();    
        foreach($record as $attribute=>$value){
            if($object->has_attribute($attribute)){
                $object->$attribute = $value;
        }
        }
        return $object;
    }

    private function has_attribute($attribute){
        $object_vars = get_object_vars($this);
        return array_key_exists($attribute, $object_vars);
    }

    protected function attributes(){
        $attributes = array();
        foreach(static::$db_fields as $field){
            if(property_exists($this, $field)){
                $attributes[$field] = $this->$field;
            }
        }
        return $attributes;
    }

    protected function sanitized_attributes() {

        global $database;
        $clean_attributes = array();

        foreach($this->attributes() as $key => $value){
            $clean_attributes[$key] = $database->escape_value($value);
        }
        return $clean_attributes;
    }

    public function save(){
        
        return isset($this->id) ? $this->update() : $this->create();
    }

    public function create(){

        global $database;
        $attributes = $this->sanitized_attributes();
//        print_r($attributes);

        $sql  = "INSERT INTO " .static::$table_name ." (";
        $sql .= join(", ", array_keys($attributes));
        $sql .= ") VALUES ('";
        $sql .= join("', '", array_values($attributes));
        $sql .= "')";

        if($database->query($sql)){
            $this->id = $database->insert_id();
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function createBed(){

        global $database;
        $attributes = $this->sanitized_attributes();
//        print_r($attributes);

        $sql  = "INSERT INTO " .static::$table_name ." (";
        $sql .= join(", ", array_keys($attributes));
        $sql .= ") VALUES ('";
        $sql .= join("', '", array_values($attributes));
        $sql .= "')";

        if($database->query($sql)){
            $this->id = $database->insert_id();
            return $this->id;
        } else {
            return FALSE;
        }
    }

    public function update(){
        global $database;
        $attributes = $this->sanitized_attributes();
        $attribute_pairs = array();
        foreach($attributes as $key => $value){
            $attribute_pairs[] = "{$key} = '{$value}'";
        }
        $sql  = "UPDATE " .static::$table_name ." SET ";
        $sql .= join(", ", $attribute_pairs);
        $sql .= " WHERE id=". $database->escape_value($this->id);
        
        $database->query($sql);
        return ($database->affected_rows() == 1) ? TRUE : FALSE;
    }

    public function updateRefer(){
        global $database;
        
        $attributes = $this->sanitized_attributes();
        
        $attribute_pairs = array();
        foreach($attributes as $key => $value){
            if(!empty($value)){
                $attribute_pairs[] = "{$key} = '{$value}'";
            }            
        }
        $sql  = "UPDATE " .static::$table_name ." SET ";
        $sql .= join(", ", $attribute_pairs);
        $sql .= " WHERE id=". $database->escape_value($this->id);  
        $database->query($sql);
        return ($database->affected_rows() == 1) ? TRUE : FALSE;
    }

        public function updateReferId($whereCondition){
            global $database;
            
            $attributes = $this->sanitized_attributes();
            
            $attribute_pairs = array();
            foreach($attributes as $key => $value){
                if(!empty($value)){
                    $attribute_pairs[] = "{$key} = '{$value}'";
                }            
            }
            $sql  = "UPDATE " .static::$table_name ." SET ";
            $sql .= join(", ", $attribute_pairs);
            $sql .= " ".$whereCondition;
            //echo $sql;die;  
            $database->query($sql);
            return ($database->affected_rows() == 1) ? TRUE : FALSE;
        }

        public function updateBedStatus($colums ,$whereCondition){
            global $database;
            
            // $attributes = $this->sanitized_attributes();
            
            // $attribute_pairs = array();
            // foreach($attributes as $key => $value){
            //     if(!empty($value)){
            //         $attribute_pairs[] = "{$key} = '{$value}'";
            //     }            
            // }
            $sql  = "UPDATE " .static::$table_name ." SET ";
            $sql .= $colums;
            $sql .= " ".$whereCondition;
            //echo $sql;die;  
            $database->query($sql);
            return ($database->affected_rows() == 1) ? TRUE : FALSE;
        }

    public function updateNew($id, $code, $amount){
        global $database;
        $attributes = $this->sanitized_attributes();
        $attribute_pairs = array();
        foreach($attributes as $key => $value){
            $attribute_pairs[] = "{$key} = '{$value}'";
        }
        unset($attribute_pairs[0]);
        $date_only =  date('Y-m-d');
        $d = date("Y-m-d H:i:s");
        $sql  = "UPDATE bills set receipt='".$code."', total_price=".$amount.", quantity=1, date='".$d."', date_only='".$date_only."', status='CLEARED', dept='Records' where id=".$id;
        $b = $database->query($sql);
        //echo $b;
        //echo $sql;die;  
        return 1;
        //return ($database->affected_rows() == 1) ? TRUE : FALSE;
    }

    public function delete(){
        global $database;
        $sql  = "DELETE FROM " .static::$table_name;
        $sql .= " WHERE id=" .$database->escape_value($this->id);
        $sql .= " LIMIT 1";
        $database->query($sql);
        return ($database->affected_rows() == 1) ? TRUE : FALSE;
    }

    public static function run_script($sql){
        global $database;
        $database->query($sql);
    }



    public static function count_data($sql =""){
        global $database;
        $result_set = $database->query($sql);
        $object_array = $database->fetch_array($result_set);
        
        return $object_array;
    }
    public static function count_data_limit($sql =""){
        //echo "<pre>";print_r($sql);die;
        global $database;
        $result_set = $database->query($sql);
        $object_array = array();
        while ($row = $database->fetch_array($result_set)){
            $object_array[] = static::instantiate($row);
        }
        return $object_array;
    }


}



