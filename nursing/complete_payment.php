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

    $accountHistory = AccountHistory::find_ref_admission_id($_GET['ref_adm_id']);
    $accountHistory->receipt          = $_GET['code'];
    if ($accountHistory->save()){
        header('Content-Type:application/json');
        $a = [
            'status' => true,
            'message' => 'Success'
        ];
        echo json_encode($a);
        exit;
    }else{
        $a = [
            'status' => false,
            'message' => 'Fail'
        ];
        echo json_encode($a);
        exit;
    }

    
    
}