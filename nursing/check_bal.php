<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/17/2019
 * Time: 8:43 AM
 */


require_once("../includes/initialize.php");


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $patient = $_SESSION['my_patient'];

    $services    = "Admission Deposit";
    $json        = json_encode($services);


    $newAccountHistory                   = new AccountHistory();
    $newAccountHistory->sync             =  "off";
    $newAccountHistory->ref_admission_id = $_GET['ref_adm_id'];
    $newAccountHistory->patient_id       = $_GET['id'];
    $newAccountHistory->wallet_balance   = $_GET['ref_adm_wallet'] + $_GET['add_wall_bal'];
    $newAccountHistory->credit           = $_GET['add_wall_bal'];
    $newAccountHistory->debit            = "";
    $newAccountHistory->services         = $json;
    $newAccountHistory->receipt          = $_GET['code'];
    $newAccountHistory->officer          = $_GET['officer'];
    $newAccountHistory->date             = strftime("%Y-%m-%d %H:%M:%S", time());

    $admission = ReferAdmission::find_by_id($_GET['ref_adm_id']);
    $admission->wall_balance = $admission->wall_balance + $_GET['add_wall_bal'];

     
    if ($newAccountHistory->save()) {
        $admission->save();
        $saveLastHistory = AccountHistory::find_last_id();
        $a = [
            'status' => "Done",
            'lastHistory' => $saveLastHistory[0]
        ];
        header('Content-Type:application/json');
        echo json_encode($a);
        exit;
    }else{
        echo "No";
        exit;
    }
    
}














