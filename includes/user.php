<?php

///require_once("initialize.php");

class User extends DatabaseObject
{

    protected static $table_name = "users";
    protected static $db_fields = array('id', 'sync', 'first_name', 'last_name', 'username', 'password', 'department', 'unit', 'sub_clinic_id',
        'ward_id', 'ward_name','role', 'date');

    public $id;
    public $sync;
    public $first_name;
    public $last_name;
    public $username;
    public $password;
    public $department;
    public $unit;
    public $sub_clinic_id;
    public $ward_id;
    public $ward_name;
    public $role;
    public $date;

    public function full_name()
    {
        if (isset($this->first_name) && isset($this->last_name)) {
            return $this->first_name . " " . $this->last_name;
        } else {
            return "";
        }
    }


    public static function find_by_username_except_current_id($username, $id){
        $sql = "SELECT * FROM " . static::$table_name . " WHERE username= '{$username}'  AND id <> '{$id}'";
        $result_array = User::find_by_sql($sql);
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_by_dept_clinic($clinic_id, $department){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE sub_clinic_id = $clinic_id AND department = '$department' ");
    }

    public static function count_by_dept_clinic($clinic_id, $department){
        global $database;
        $sql = "SELECT COUNT(*) FROM " .static::$table_name . " WHERE sub_clinic_id = $clinic_id AND department = '$department' ";
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    public static function find_by_department($department){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE department = '$department' ");
    }

    public static function find_by_department_and_unit($department, $unit){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE department = '$department' AND unit = '$unit' ");
    }

    public static function count_by_department($department){
        global $database;
        $sql = "SELECT COUNT(*) FROM " .static::$table_name . " WHERE department = '$department' ";
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    public static function find_by_department_profession($department, $profession){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE department = '$department' AND profession = '$profession' ");
    }

    public static function find_by_username($name)
    {
        $sql = "SELECT * FROM " . static::$table_name . " WHERE username= '{$name}' LIMIT 1";
        $result_array = User::find_by_sql($sql);
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }


    public static function authenticate($username = "", $password = "")
    {
        global $database;
        $username = $database->escape_value($username);
        $password = $database->escape_value($password);

        $sql = "SELECT * FROM users ";
        $sql .= "WHERE username = '{$username}' ";
        $sql .= "AND password = '{$password}' ";
        $sql .= "LIMIT 1";

        $result_array = self::find_by_sql($sql);
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function create_table()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS ' . User::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'first_name VARCHAR(100) NOT NULL, ' .
            'last_name  VARCHAR(100) NOT NULL, ' .
            'username VARCHAR(80) NOT NULL, ' .
            'password VARCHAR(50) NOT NULL, ' .
            'department VARCHAR(80) NOT NULL, ' .
            'unit VARCHAR(80) NOT NULL, ' .
            'sub_clinic_id INT(11) NOT NULL, ' .
            'ward_id varchar(100) NOT NULL, ' .
            'ward_name varchar(255) NOT NULL, ' .
            'role VARCHAR(80) NOT NULL, ' .
            'date  DATETIME NOT NULL, ' .
            'PRIMARY KEY(id), ' .
            'UNIQUE KEY(username))';
        User::run_script($sql);
        User::default_user();
    }

    public static function default_user()
    {
        $user = new User();
        $user->first_name      = "admin";
        $user->last_name       = "user";
        $user->password        = "password1!";
        $user->username        = "admin";
        $user->department      = "ICT";
       $user->sub_clinic_id        = 0;
  /*       $user->phone_no        = "08025357059";*/
        $user->role            = "Super Admin";
        $user->date            = strftime("%Y-%m-%d %H:%M:%S", time());
        $sql = "SELECT * FROM " . static::$table_name . " WHERE username= '{$user->username}' LIMIT 1";
        if (!User::find_by_sql($sql)) $user->save();
    }

    // Common Database Methods in the Parent class(DatabaseObject)

}

User::create_table();




