<?php
require_once("../includes/initialize.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient = $_SESSION['my_patient'];
    $product = Product::find_by_id($_GET['id']);
    $result = new ServiceResult();
    $dosage = $_GET['dosage'] ?: 1;
    $unit = $_GET['unit'] ?: 1;
    $overwrite = $_GET['overwrite'] ?: false;
    if (!$product)
        $result->message = "Revenue not found";

    else {
        $count = $_GET['action'] == 'delete' ?
            //      PatientBill::delete_from_bill($product->id) :
          PatientBill::decrease_bill_unit($product, $unit) :
            $_GET['action'] == 'put' ?
                PatientBill::decrease_bill_unit($product, $unit) :
                PatientBill::add_to_bill($product, $unit, $patient, $dosage, $overwrite);

        $result->message = "Successfully delete the revenue from the bill";
        $result->success = true;
        $result->bill = PatientBill::render_bill();
        $result->items_count = $count;
        $result->save_bill = PatientBill::save_page();
    }

    header('Content-Type:application/json');
    echo json_encode($result);
    exit;
}


echo PatientBill::render_bill();











