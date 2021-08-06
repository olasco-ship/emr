<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/11/2019
 * Time: 1:30 PM
 */

require_once("../includes/initialize.php");





if ($_SERVER["REQUEST_METHOD"] == 'POST') {

    $items = PatientBill::get_bill();
    $item = $items[0];
//print_r($items); exit;


    $last_orders = Order::find_last_id();
    $last_order = 0;
    foreach ($last_orders as $last_order) {
        $last_order->order_number;
    }
    $last_date = substr($last_order->order_number, 0, 6);





    $system_num = "01";
    $order_numb = 0;
    $date = date("ymd");
    if (empty($last_order->order_number)) {
        $n = 1;
        $n = sprintf('%04u', $n);
        $order_numb = $date . $system_num . $n;
    } else {
        if ($last_date != $date) {
            $n = 1;
            $n = sprintf('%04u', $n);
            $order_numb = $date . $system_num . $n;
        } else {
            $last_order->order_number++;
            $order_numb = $last_order->order_number;
        }

    }

    $payment_type = test_input($_POST['payment_type']);


    $order               = new Order();
    $order->order_number = $order_numb;
    $order->user_id      = $user->id;
    $order->salesperson  = $user->full_name();
    $order->quantity     = PatientBill::total_unit();
    $order->total_price  = PatientBill::total_price();
    $order->payment_type = $payment_type;
    $order->date         = strftime("%Y-%m-%d %H:%M:%S", time());

    if ($order->save()) {

        foreach ($items as $item) {
            $product = Product::find_by_id($item->id);

            $orderItem                     = new OrderItems();
            $orderItem->order_id           = $order->id;
            $orderItem->category_id        = $product->category_id;
            $orderItem->product_type_id    = $product->productType_id;
            $orderItem->product_name       = $product->name;
            $orderItem->quantity           = $item->quantity;
            $orderItem->cost_price         = $product->cost_price;
            $orderItem->unit_price         = $product->price;
            $orderItem->total_price        = $orderItem->unit_price * $orderItem->quantity;
            $orderItem->date               = $order->date;
            $orderItem->save();

            if ($item->id == $product->id) {
                $product->quantity = $product->quantity - $item->quantity;
            }
            $product->save();

        }
        PatientBill::clear_all_bill();
     //   redirect_to("print_page1.php?id=$order->id");
    }

}