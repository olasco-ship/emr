<?php
    
function strip_zeros_from_date($marked_string = ""){
    // first remove the marked zeros
    $no_zeros = str_replace('*0', '', $marked_string);
    //then remove any remaining marks
    $cleaned_string = str_replace('*','', $no_zeros);
    return $cleaned_string;
}

function pre_d($data)
{
    echo "<pre>";
    print_r($data);
}

function redirect_to($location = NULL){
    if ($location != NULL){
        header("Location: {$location}");
        exit;
    }
}

function output_message($message = ""){
    if (!empty($message)){
        return "<p class = \"message\">{$message}</p>";
    } else {
        return "";
    }
}

/*
function __autoload($class_name) {
    $class_name = strtolower($class_name);
   // $path = "../includes/{$class_name}.php";
    $path = LIB_PATH.DS."{$class_name}.php";
    if (file_exists($path)){
        require_once($path);
    } else {
        die("The file {$class_name}.php could not be found. ");
    }
}
*/



function include_layout_template($template= "") {
    include(SITE_ROOT.DS.'public'.DS.'layouts'.DS.$template);
}

function log_action($action, $message=""){
    $logfile = SITE_ROOT.DS.'logs'.DS.'log.txt';
 //   $new = file_exists($logfile) ? FALSE : TRUE;
    if($handle = fopen($logfile, 'a')){ // append
        $timestamp = strftime("%Y-%m-%d %H:%M:%S", time());
        $content = "{$timestamp} | {$action}: {$message}\n";
        fwrite($handle, $content);
        fclose($handle);
        //if ($new){ chmod($logfile, 0755); }
    } else {
        echo "Could not open log file for writing.";
    }
    
}


function datetime_to_text($datetime=""){
    $unixdatetime = strtotime($datetime);
    return strftime("%B %d %Y at %I:%M %p", $unixdatetime);
}

function date_only($datetime=""){
    $unixdatetime = strtotime($datetime);
    return strftime("%Y-%m-%d", $unixdatetime);
}

function date_only_in_number($datetime=""){
    $unixdatetime = strtotime($datetime);
    return strftime("%Y%m%d", $unixdatetime);
}

function date_to_text($datetime=""){
    $unixdatetime = strtotime($datetime);
    return strftime("%B %d %Y", $unixdatetime);
}

function time_to_text($datetime=""){
    $unixdatetime = strtotime($datetime);
    return strftime("%I:%M %p", $unixdatetime);
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function is_post(){
    return $_SERVER["REQUEST_METHOD"] == "POST";
}

function ensure_login($session){
        if (!isset($_SERVER['X_HTTP_ORIGINAL_URL']))
        $ReturnURL = $_SERVER['X_HTTP_ORIGINAL_URL'];
        else
            $ReturnURL = $_SERVER['REQUEST_URI'];
        $ReturnURL = $_SERVER['URL'];

        if (!$session->is_logged_in()) redirect_to('/auth/signin.php?returnurl'.$ReturnURL);
}

function send_as_json($msg = "", $data = null, $success = false, $name = 0)
{
    header('Content-Type:application/json');
    $resp = new ServiceResult();
    $resp->name = $name;
    $resp->success = $success;
    $resp->message = $msg;
    $resp->data = $data;
    echo json_encode($resp);
    exit;
}

function getAge($birthDate){
    $birthDate = date('m/d/Y', strtotime($birthDate));
 //   $birthDate = "1/27/1986";
    //explode the date to get month, day and year
    $birthDate = explode("/", $birthDate);
    //get age from date or birthdate
    $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
        ? ((date("Y") - $birthDate[2]) - 1)
        : (date("Y") - $birthDate[2]));
    return $age;
  //  echo "Age is:" . $age;
}

function calculateMonth($exp_date){
    $today = strftime("%Y-%m-%d", time());
    //     $exp_date = '2020-04-01 00:00:00';   //Remove this for real function
    $exp_date = date('Y-m-d', strtotime($exp_date));

    $ts1 = strtotime($today);
    $year1 = date('Y', $ts1);
    $month1 = date('m', $ts1);

    $ts2 = strtotime($exp_date);
    $year2 = date('Y', $ts2);
    $month2 = date('m', $ts2);
    $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
    return $diff;
}

function expiryPeriod($exp_date) {
  //  $exp_date = '2020-06-01 00:00:00';

    $name = 'expiryPeriod';
    $exp  = Notification::find_by_name($name);

    $monthLeft = calculateMonth($exp_date);
    if($monthLeft <= $exp->value ){
        return "<span style='color: orange'>$monthLeft month(s)</span>";
    }
}


function countExpiringDrugs() {
    $count = 0;
    $products = Product::find_all();
    $name = 'expiryPeriod';
    $exp = Notification::find_by_name($name);
    foreach ($products as $product) {
        $months = calculateMonth($product->exp_date);
        if ($months <= $exp->value) {
            $count++;
        }
    }
    if ($count <= 0){
        return "No";
    }else {
        return $count;
    }
}

function expiringDrugs() {
    $expiry = array();
    $products = Product::find_all();
    $name = 'expiryPeriod';
    $exp = Notification::find_by_name($name);
    foreach ($products as $product) {
        $months = calculateMonth($product->exp_date);
        if ($months <= $exp->value) {
            $expiry[] =$product;
        }
    }
    return $expiry;
}

function countReOrderLevel() {
    $name = 'reOrderLevel';
    $exp = Notification::find_by_name($name);

    $countLowDrugs = 0;
    $products = Product::find_all();
    foreach ($products as $product){
        if( $product->total_quantity <= $exp->value){
            //   echo 'Low Drug(s) => '. $product->name . "<br/>";
            $countLowDrugs++;
        }
    }
    return $countLowDrugs;
}

function reOrderLevel() {
    $level = array();
    $name = 'reOrderLevel';
    $exp = Notification::find_by_name($name);
    $products = Product::find_all();
    foreach ($products as $product){
        if( $product->total_quantity <= $exp->value){
            $level[] = $product;
        }
    }
    return $level;
}


function checkValidity($exp_date) {
    $cur_date = strftime("%Y-%m-%d %H:%M:%S", time());
    if($cur_date > $exp_date)
    {
        return 'Expired';
    } else {
        return 'Valid';
    }
    
    }

    function getSystemNumber($first_name, $last_name) {
        $first = substr($first_name, 0, 1);
        $last  = substr($last_name, 0, 1);  
        $rand_number = rand(1000, 9999);  
        $folder_number = $first . $last .$rand_number;
        return $folder_number;
    }




function sendJson($json)
{
    SendJsonData(service_url, service_port, $json);
}

function SendJsonData($url, $port, $json)
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_PORT => $port,
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $json,
        CURLOPT_HTTPHEADER => array(
            "Cache-Control: no-cache",
            "Content-Type: text/json"
        ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
        return null;
    }
    return $response;
}







