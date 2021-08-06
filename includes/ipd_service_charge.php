<?php
require_once "initialize.php";


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
                if ($da->wall_balance != "") {

                    $newAccountHistory                   = new AccountHistory();
                    $newAccountHistory->sync             =  "off";
                    $newAccountHistory->ref_admission_id = $da->id;
                    $newAccountHistory->patient_id       = $da->patient_id;
                    $newAccountHistory->wallet_balance   = $da->wall_balance - $ipdServiceById->daily_charges;
                    $newAccountHistory->credit           = "";
                    $newAccountHistory->debit            = $ipdServiceById->daily_charges;
                    $newAccountHistory->services         = json_encode($ipdServiceById->service_name);
                    $newAccountHistory->date             = strftime("%Y-%m-%d %H:%M:%S", time());
                    $newAccountHistory->save();

                    $ipdServiceLog = new IPDServiceLog();
                    $da->wall_balance = $da->wall_balance - $ipdServiceById->daily_charges;                    
                    $da->save();
                    $ipdServiceLog->amount =  $da->wall_balance ;
                    $ipdServiceLog->patient_id =  $da->patient_id;
                    $ipdServiceLog->ipd_service_id =  $decodeIpd ;
                    $ipdServiceLog->status = "1";
                    $ipdServiceLog->created = date("Y-m-d, H:i:s");
                    $ipdServiceLog->save();
                } else {
                    $status =  true;
                }
            }
        }
        
    }
}

return true;
?>