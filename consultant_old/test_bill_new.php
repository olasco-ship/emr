<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/17/2019
 * Time: 8:43 AM
 */
require_once("../includes/initialize.php");
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $patient = $_SESSION['my_patient'];
    //$test    = Test::find_by_id($_GET['id']);
    $bill                  = new Bill();
    //$bill->id            = $_GET['ids'];
    $bill->receipt     = $_GET['code'];
    $bill->total_price     = $_GET['total_price'];
    if ($bill->updateNew($_GET['ids'], $_GET['code'], $_GET['total_price'])) {
        header('Content-Type:application/json');
        $a = [
            'status' => true,
            'message' => 'Success'
        ];
        echo json_encode($a);
        exit;
    }else{
        $a = [
            'status' => false,
            'message' => 'Fail'
        ];
        echo json_encode($a);
        exit;
    }
    
}//echo TestBill::render_bill();