<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/11/2019
 * Time: 9:48 AM
 */


require_once("../includes/initialize.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];


    $product = StockItems::find_by_name($name);
    $result = new StockServiceResult();
    $unit = $_GET['unit'] ?: 1;
  //  $dosage = $_GET['dosage'];
  //  $dosage = $_GET['dosage'] ?: 1;
    $overwrite = $_GET['overwrite'] ?: false;

    if (!$product){
        $result->message = "Product not found";

        $result->success     = false;
        $result->bill        = StockBill::render_bill();
        $result->items_count = $count;
        $result->save_bill   = StockBill::save_page();
        $result->flow        = StockBill::storage_page();
        $result->stock       = StockBill::stocking_page();

        }

    else {
        $count = $_GET['action'] == 'delete' ?
            //    PatientBill::delete_from_bill($product->id) :
                StockBill::decrease_bill_unit($product, $unit) :
            $_GET['action'] == 'put' ?
                StockBill::decrease_bill_unit($product, $unit) :
                StockBill::add_to_bill($product, $unit, $patient, $overwrite);

        $result->message     = "Successfully delete the revenue from the bill";
        $result->success     = true;
        $result->bill        = StockBill::render_bill();
        $result->items_count = $count;
        $result->save_bill   = StockBill::save_page();
        $result->flow        = StockBill::storage_page();
        $result->stock       = StockBill::stocking_page();

    }

    header('Content-Type:application/json');
    echo json_encode($result);
    exit;


}

//echo PatientBill::render_bill();

echo StockBill::save_page();




