<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/17/2019
 * Time: 8:43 AM
 */


require_once("../includes/initialize.php");

$user = User::find_by_id($session->user_id);


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
        $result->bill = TestBill::render_bill();
        $result->items_count = $count;
        $result->save_bill = TestBill::save_page();
    }

    header('Content-Type:application/json');
    echo json_encode($result);
    exit;
}



if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $patient = $_SESSION['my_patient'];
    //$test    = Test::find_by_id($_GET['id']);
    $last_bills = Bill::find_last_id();
        $last_bill = 0;
        foreach ($last_bills as $last_bill) {
            $last_bill->bill_number;
        }


        $last_date = substr($last_bill->bill_number, 0, 6);

        $system_num = "01";
        $bill_numb = 0;
        $date = date("ymd");
        if (empty($last_bill->bill_number)) {
            $n = 1;
            $n = sprintf('%04u', $n);
            $bill_numb = $date . $system_num . $n;
        } else {
            if ($last_date != $date) {
                $n = 1;
                $n = sprintf('%04u', $n);
                $bill_numb = $date . $system_num . $n;
            } else {
                $last_bill->bill_number++;
                $bill_numb = $last_bill->bill_number;
            }
        }
    $bill                  = new Bill();
    $bill->sync            = "unsync";
    $bill->bill_number     = $bill_numb;
    // $bill->status     = "CLEARED";
    // $bill->dept     = "Records";
    $bill->revenue_officer    = $user->full_name();     // "admin user";
    // $bill->date_only     = date('Y-m-d');
    // $bill->date     = date('Y-m-d H:i:s');
    $bill->encounter_id    = 0;
    $bill->exempted_by     = "";
    $bill->payment_type    = "";
    $bill->patient_id      = $_GET['id'];
    $bill->first_name      = $_GET['first_name'];
    $bill->last_name      = $_GET['last_name'];
    
    
    if ($bill->save()) {
        $saveLastBill = Bill::find_last_id();
        $a = [
            'status' => "Done",
            'lastBill' => $saveLastBill[0]
        ];
        header('Content-Type:application/json');
        echo json_encode($a);
        exit;
    }else{
        echo "No";
        exit;
    }
    
}


echo TestBill::render_bill();











