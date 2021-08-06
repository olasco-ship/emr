<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/17/2019
 * Time: 8:43 AM
 */


require_once("../includes/initialize.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $drug    = EachItem::find_by_id($_GET['id']);
    $patient = $_SESSION['my_patient'];
  //  $dispense = Dispensed::find_by_id($_GET['id']);
  //  $result = new ServiceResult();
    $unit = $_GET['unit'] ?: 1;
    $overwrite = $_GET['overwrite'] ?: false;
    if (!$drug)
        $result->message = "Drug not found";
    else {
        $count = $_GET['action'] == 'delete' ?

            StockBill::decrease_each_bill_unit($drug, $unit) :
            $_GET['action'] == 'put' ?
                StockBill::decrease_each_bill_unit($drug, $unit) :
                StockBill::add_to_each_drug_bill($drug, $unit, $patient, $overwrite);


        $result->message = "Successfully delete the test from the bill";
        $result->success = true;
        $result->bill = StockBill::drug_page();
        $result->items_count = $count;
        $result->save_bill = StockBill::save_dispense_page();


    }

    header('Content-Type:application/json');
    echo json_encode($result);
    exit;
}


echo StockBill::render_dispense();











