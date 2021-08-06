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
        $services    = "Admission Settlement";
        $json        = json_encode($services);

        $newAccountHistory                   = new AccountHistory();
        $newAccountHistory->sync             =  "off";
        $newAccountHistory->ref_admission_id =  $refadmission->id;
        $newAccountHistory->patient_id       =  $_POST['patient_id'];
        $newAccountHistory->wallet_balance   = $refadmission->wall_balance + $_POST['paid_amount'];
        $newAccountHistory->credit           = $_POST['paid_amount'];
        $newAccountHistory->debit            = "";
        $newAccountHistory->services         = $json;
        $newAccountHistory->receipt          = $_POST['receipt'];
        $newAccountHistory->date             = strftime("%Y-%m-%d %H:%M:%S", time());
        $newAccountHistory->save();

        $refadmission->wall_balance = $refadmission->wall_balance + $_POST['paid_amount'];
        $refadmission->save();
        $session->message("Successfully Settle amount");
            
    }else if($refadmission->wall_balance > 0){
        $services    = "Admission Refund";
        $json        = json_encode($services);

        $newAccountHistory                   = new AccountHistory();
        $newAccountHistory->sync             =  "off";
        $newAccountHistory->ref_admission_id =  $refadmission->id;
        $newAccountHistory->patient_id       =  $_POST['patient_id'];
        $newAccountHistory->wallet_balance   = $refadmission->wall_balance - $_POST['paid_amount'];
        $newAccountHistory->credit           = "";  
        $newAccountHistory->debit            = $_POST['paid_amount'];
        $newAccountHistory->services         = $json;
        $newAccountHistory->receipt          = $_POST['receipt'];
        $newAccountHistory->date             = strftime("%Y-%m-%d %H:%M:%S", time());
        $newAccountHistory->save();

        $refadmission->wall_balance = $refadmission->wall_balance - $_POST['paid_amount'];
        $refadmission->save();
        $session->message("Successfully Refund amount");
                     
    }


 
    redirect_to('wards_dr.php?ward='.$_POST['ward_id']);


}
?>