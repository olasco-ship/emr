<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/16/2019
 * Time: 12:14 PM
 */



require_once("../includes/initialize.php");

//pre_d($_POST);die;

if (is_post()) {
    $patientDetail = Patient::find_by_id($_POST['patient_id_dis']);

    $refadmission = ReferAdmission::find_by_patient_id_refund($_POST['patient_id_dis']);

    
    // if($refadmission->wall_balance < 0){
    //     $refadmission->wall_balance = $refadmission->wall_balance + $_POST['discount'];
    // }else{
        $refadmission->wall_balance = $refadmission->wall_balance + $_POST['discount'];
    //}
    
    $refadmission->discount_status = 1;
   // pre_d($refadmission);die;
    $refadmission->save();

    // $last_bills = Bill::find_last_id();
    // $last_bill = 0;
    // foreach ($last_bills as $last_bill) {
    //     $last_bill->bill_number;
    // }
    // $last_date = substr($last_bill->bill_number, 0, 6);


    // $system_num = "01";
    // $bill_numb = 0;
    // $date = date("ymd");
    // if (empty($last_bill->bill_number)) {
    //     $n = 1;
    //     $n = sprintf('%04u', $n);
    //     $bill_numb = $date . $system_num . $n;
    // } else {
    //     if ($last_date != $date) {
    //         $n = 1;
    //         $n = sprintf('%04u', $n);
    //         $bill_numb = $date . $system_num . $n;
    //     } else {
    //         $last_bill->bill_number++;
    //         $bill_numb = $last_bill->bill_number;
    //     }
    // }


    // $bill = new Bill();
    // $bill->sync = "unsync";
    // $bill->bill_number = $bill_numb;
    // $bill->patient_id = $_POST['patient_id_dis'];
    // $bill->first_name = $patientDetail->first_name;
    // $bill->last_name = $patientDetail->last_name;
    // $bill->quantity = 1;
    // $bill->total_price = $_POST['amount_wall'];
    // $bill->actual_price = $_POST['amount_wall'];
    // $bill->consultant = $session->user_id;
    // $bill->revenue_officer = $session->user_id;
    // $bill->status = "Discount";    
    // //$bill->receipt = $_POST['receipt'];
    // $bill->dept = "Records";
    // $bill->date = strftime("%Y-%m-%d %H:%M:%S", time());
    // $bill->save();

    $settlement = new Discount();
    $settlement->amount = $_POST['discount'];
    $settlement->type = "Discount";
    $settlement->status = 1;
    $settlement->patient_id = $_POST['patient_id_dis'];
    $settlement->nurse_id = $session->user_id;
    $settlement->date_created = date("Y-m-d H:i:s");
    $settlement->save();

    

    $session->message("Success Discount amount");
    redirect_to('wards_dr.php?ward='.$_POST['ward_id']);
}
    
    
?>
