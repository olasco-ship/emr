<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/17/2019
 * Time: 11:45 AM
 */

require_once("../includes/initialize.php");


if (is_post()) {

  //  echo "no";
  //  exit;

    $items = PatientBill::get_bill();
    $item = $items[0];

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


    $bill = new Bill();
    $bill->sync = "unsync";
    $bill->bill_number = $bill_numb;
    $bill->exempted_by = "";
    $bill->payment_type = "";
    $bill->patient_id = $patient->id;
    $bill->quantity = PatientBill::total_unit();
    $bill->total_price = PatientBill::total_price();
    $bill->actual_price = "";
    $bill->consultant = "somebody";
    $bill->status = "prescribed";
    $bill->receipt = "";
    $bill->revenue_officer = "";
    $bill->date = strftime("%Y-%m-%d %H:%M:%S", time());

    if ($bill->save()) {
        foreach ($items as $item) {
            $product = Product::find_by_id($item->id);

            $prescribed = new Prescribed();
            $prescribed->bill_id = $bill->id;
            $prescribed->product_id = $product->id;
            $prescribed->product_name = $product->name;
            $prescribed->unit = $item->quantity;
            $prescribed->cost_price = "";
            $prescribed->unit_price = $product->price;
            $prescribed->total_price = $item->quantity * $product->price;
            $prescribed->dosage = "";
            $prescribed->period = "";
            $prescribed->status = "bill";
            $prescribed->receipt = "";
            $prescribed->date = strftime("%Y-%m-%d %H:%M:%S", time());
            $prescribed->save();
            /*
            if ($item->id == $product->id) {
                $product->quantity = $product->quantity - $item->quantity;
            }
            $product->save();
            */
        }
        PatientBill::clear_all_bill();
        TestBill::clear_all_bill();
        redirect_to('view.php');
    }

}