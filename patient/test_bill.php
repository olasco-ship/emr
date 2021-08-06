<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/17/2019
 * Time: 8:43 AM
 */


require_once("../includes/initialize.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient = $_SESSION['my_patient'];
    $test    = Test::find_by_id($_GET['id']);
    $result = new ServiceResult();
    $unit = $_GET['unit'] ?: 1;
    $overwrite = $_GET['overwrite'] ?: false;
    if (!$test)
        $result->message = "Investigation not found";
    else {
        $count = $_GET['action'] == 'delete' ?
            //      PatientBill::delete_from_bill($product->id) :
            TestBill::decrease_bill_unit($test, $unit) :
            $_GET['action'] == 'put' ?
                TestBill::decrease_bill_unit($test, $unit) :
                TestBill::add_to_bill($test, $unit, $patient, $overwrite);

        $result->message = "Successfully delete the test from the bill";
        $result->success = true;
        $result->bill = TestBill::medical_bill();
        $result->items_count = $count;
        $result->save_bill = TestBill::save_page();
    }

    header('Content-Type:application/json');
    echo json_encode($result);
    exit;
}


echo TestBill::render_bill();











