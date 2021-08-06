<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 10/18/2017
 * Time: 2:23 PM
 */

defined('db_server') ? NULL : define('db_server', 'localhost');
defined('db_user') ? NULL : define('db_user', 'root');
defined('db_pass') ? NULL : define('db_pass', '');
defined('db_name') ? NULL : define('db_name', 'emr');

defined('service_url') ? NULL : define('service_url', 'http://196.46.20.5');
defined('service_port') ? NULL : define('service_port', '5555');



defined('emr_lucid') ? NULL : define('emr_lucid', '/emr');

date_default_timezone_set('Africa/Lagos');

error_reporting(E_ERROR | E_PARSE);






$conn = new mysqli(db_server, db_user, db_pass);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "CREATE DATABASE IF NOT EXISTS " . db_name;
$conn->query($sql);
$conn->close();