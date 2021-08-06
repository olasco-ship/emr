<?php
require_once "../includes/initialize.php";


$refAdd = new ReferAdmission;
$refAdDetail = $refAdd->find_all_by_ipd_status();
//pre_d($refAdDetail);die;
$status = true;
foreach($refAdDetail as $da){
    $jsondecodeData = json_decode($da->ipd_service);
    foreach($jsondecodeData as $decodeIpd){
        
        if($decodeIpd != NULL){
            
            $ipdServiceById = IPDServices::find_by_id($decodeIpd);
            
            if (isset($ipdServiceById)) {
               
                if ($da->wall_balance != "" && $da->wall_balance > $ipdServiceById->daily_charges) {
                    //$da->refer_status = 1;
                    $da->wall_balance = $da->wall_balance - $ipdServiceById->daily_charges;
                    
                    $da->save();
                } else {
                    $status =  false;
                }
            }
        }
        
    }
}

$session->message("Successfully collect IPD service charges");
redirect_to("index.php");
?>