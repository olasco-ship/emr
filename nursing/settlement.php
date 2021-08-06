<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/16/2019
 * Time: 12:14 PM
 */



require_once("../includes/initialize.php");

if(is_post()){
    
    $patientDetail = Patient::find_by_id($_POST['patient_id']);

    $refadmission = ReferAdmission::find_by_patient_id_refund($_POST['patient_id']);
   
    if($refadmission->wall_balance < 0){
        //echo "sdf";
        if(abs($refadmission->wall_balance) == $_POST['paid_amount']){
            $refadmission->settle_status = $_POST['type'];
        }else{
            $refadmission->settle_status = "NULL";
        }
        $refadmission->wall_balance = $refadmission->wall_balance + $_POST['paid_amount'];
       
    }else{
        if($refadmission->wall_balance == $_POST['paid_amount']){
            $refadmission->settle_status = $_POST['type'];
        }else{
            $refadmission->settle_status = "NULL";
        }
        $refadmission->wall_balance = $refadmission->wall_balance - $_POST['paid_amount'] ;
        
        
    }
   // pre_d($refadmission);die;
    
    $refadmission->save();

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
    $bill->patient_id = $_POST['patient_id'];
    $bill->first_name = $patientDetail->first_name;
    $bill->last_name = $patientDetail->last_name;
    $bill->quantity = 1;
    $bill->total_price = $_POST['amount'];
    $bill->actual_price = $_POST['amount'];
    $bill->consultant = $session->user_id;
    $bill->revenue_officer = $session->user_id;
    $bill->status = $_POST['type'];    
    $bill->receipt = $_POST['receipt'];
    $bill->dept = "Records";
    $bill->date = strftime("%Y-%m-%d %H:%M:%S", time());
    $bill->save();

    $settlement = new Settlement();
    $settlement->amount = $_POST['amount'];
    $settlement->type = $_POST['type'];
    $settlement->status = 1;
    $settlement->patient_id = $_POST['patient_id'];
    $settlement->date_created = date("Y-m-d H:i:s");
    $settlement->save();

    

    $session->message("Success Settle amount");
    redirect_to('wards_dr.php?ward='.$_POST['ward_id']);
}
?>