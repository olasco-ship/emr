<?php

/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 5/24/2019
 * Time: 9:19 AM
 */

require_once "../includes/initialize.php";
if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$user = User::find_by_id($session->user_id);

$wall_balance = "";
$errWalletBalance = "";
$errMessage = "";
$done = FALSE;


// For edit time show selected ward
if (!empty($_GET['ward_id_edits'])) {

    $wardDetail = new Wards();
    //pre_d($_GET);die;
    $wDetail = $wardDetail->find_by_location_id_forPatient($_GET['ward_id_edits']);
    if (!empty($wDetail)) {
        $data = "<option>-- Select Ward --</option>";
        $sel = "";
        foreach ($wDetail as $wdata) {
            if ($_GET['ward_id_selected'] == $wdata->id) {
                $sel = "selected='selected'";
            } else {
                $sel = "";
            }
            $data .= "<option value='" . $wdata->id . "' " . $sel . ">" . $wdata->ward_number . "</option>";
        }
        echo $data;
        exit();
    } else {
        $data = "<option>-- No Ward found --</option>";
        echo $data;
        exit();
    }
}



//For show List of room according to ward
if (!empty($_GET['ward_id_change_room'])) {

    $bed = new Beds();
    $roomList = $bed->find_by_room_no_forPatient($_GET['location_id'], $_GET['ward_id_change_room']);
    if (!empty($roomList)) {
        $roomListOption = "<option>-- Select Room --</option>";
        foreach ($roomList as $roomListData) {
            $roomListOption .= "<option value='" . $roomListData->id . "'>" . $roomListData->room_number . "</option>";
        }
    } else {
        $roomListOption = "<option>-- No Room Found --</option>";
    }
    echo $roomListOption;
    exit();
}

//For show List of room according to ward
if (!empty($_GET['room_no_id'])) {

    $bed = new Beds();
    $bedList = $bed->find_bed_by_room_id($_GET['bed_location_id'], $_GET['bed_ward_id_change_room'], $_GET['room_no_id']);

    if (!empty($bedList)) {
        $bedListOption = "<option>-- Select Bed --</option>";
        // for($iAjax = $bedList->bed_no_to; $iAjax <= $bedList->bed_no_from; $iAjax++){
        //     $bedListOption .=  "<option value='".$iAjax."'>".$iAjax."</option>";
        // }
        $bedListData = BedsList::find_by_bed_id($bedList->id);
        foreach ($bedListData as $bedListd) {
            $bedListOption .=  "<option value='" . $bedListd->bed_no . "'>" . $bedListd->bed_no . "</option>";
        }
    } else {
        $bedListOption = "<option>-- No Bed Found --</option>";
    }
    echo $bedListOption;
    exit();
}

//echo $_GET['id']; exit;

//$ref          = ReferAdmission::find_by_patient($_GET['id']);
$ref          = ReferAdmission::find_by_id($_GET['id']);

//echo $ref->id; exit;
//$waiting_list = WaitingList::find_by_id($_GET['id']);
$cancelAdmission = new CancleAdmission();

$ref->patient_id = (int) $ref->patient_id;
$x = (int) $ref->patient_id;


//$cancelAdmissionDetail = $cancelAdmission->find_by_pat_id($waiting_list->patient_id);
$cancelAdmissionDetail = $cancelAdmission->find_by_patient($x);


$usersNew = User::find_by_id($session->user_id);
//pre_d($usersNew);die;
if ($usersNew->sub_clinic_id != 0) {
    $subClinic = SubClinic::find_by_id($usersNew->sub_clinic_id);
} else {
    $subClinic = [];
}

$patient = Patient::find_by_id($x);
$refAdmissionDetail = ReferAdmission::find_by_bill_id_first($x);
$allRefData = ReferAdmission::find_all();
//$waitingConsultation = WaitingList::find_all_waiting_consultation_count($_GET['id']);
//$countWaitPatient = count($waitingConsultation) + 1;
//$countWaitPatient = count($allRefData) + 1;
$refAdmissionDetail = $refAdmissionDetail[0];
$singleReferData = ReferAdmission::find_by_bill_id_first($x);
$location = Locations::find_all();
$bedSlisting = new Beds();
$roomListData = $bedSlisting->find_by_ward_location_id($refAdmissionDetail->location, $refAdmissionDetail->ward_no);
$ipService = IPDServices::find_all();

$bedNumberListStart = "0";
$bedNumberListEnd = "0";
foreach ($roomListData as $RLD) {
    //pre_d($RLD);
    if ($RLD->id == $refAdmissionDetail->room_no) {
        $bedNumberListStart = $RLD->bed_no_to;
        $bedNumberListEnd = $RLD->bed_no_from;
    }
}

$diff = (date('Y') - date('Y', strtotime($patient->dob)));

$bed = new BedsList();
$bedList = $bed->find_bed_by_room_id_selected_bed($refAdmissionDetail->location, $refAdmissionDetail->ward_no, $refAdmissionDetail->room_no);
//pre_d($bedList);die;
if (isset($bedList)) {

    // for($iAjax = $bedList->bed_no_to; $iAjax <= $bedList->bed_no_from; $iAjax++){
    //     $bedListOption .=  "<option value='".$iAjax."'>".$iAjax."</option>";
    // }
    //$bedListData = BedsList::find_by_bed_id($bedList->id);

    foreach ($bedList as $bedListd) {

        if ($bedListd->occupied_bed_status == 0 || $refAdmissionDetail->bed_no == $bedListd->bed_no) {
            //pre_d($bedListd->occupied_bed_status);
            if ($refAdmissionDetail->bed_no == $bedListd->bed_no) {
                $slBed = "selected='selected'";
            } else {
                $slBed = "";
            }
            $bedListOptions .=  "<option value='" . $bedListd->bed_no . "' " . $slBed . ">" . $bedListd->bed_no . "</option>";
        }
    } //die;
} else {
    $bedListOptions = "<option>-- No Bed Found --</option>";
}
// pre_d($bedNumberListStart);
// pre_d($bedNumberListEnd);
// die;

// For edit time show selected ward
$wardDetail = new Wards();
//pre_d($_GET);die;
$wDetail = $wardDetail->find_by_location_id_selected($refAdmissionDetail->location);

// if(!empty($wDetail)){        
//     $sel = "";
//     foreach($wDetail as $wdata){
//         if($refAdmissionDetail->ward_no == $wdata->id){
//             $sel = "selected='selected'";
//         }else{
//             $sel = "";
//         }
//         $dataWard .= "<option value='".$wdata->id."' ".$sel.">".$wdata->ward_number."</option>";
//     }

// }else{
//     $dataWard = "<option>-- No Ward found --</option>";

// }


if (!empty($wDetail)) {
    $sel = "";
    foreach ($wDetail as $wdata) {
        if ($refAdmissionDetail->ward_no == $wdata->id) {
            $dataWard = "
                    <input type='hidden' name='ward_no' value='" . $refAdmissionDetail->ward_no . "' class='ward_change_nurse'/>
                    <input type='text' class='form-control' value='" . $wdata->ward_number . "' readonly/>";
        } else {
            $sel = "";
        }
    }
} else {
    //$dataWard = "<option>-- No Ward found --</option>";

}





$numPrint = "";
if ($countWaitPatient < 10) {
    $numPrint = "00" . $countWaitPatient;
} else if ($countWaitPatient > 10 && $countWaitPatient < 99) {
    $numPrint = "0" . $countWaitPatient;
} else if ($countWaitPatient > 99) {
    $numPrint = $countWaitPatient;
}
$user = User::find_by_id($session->user_id);

//$vital = Vitals::find_by_patient($patient->id);

if (is_post()) {

    if (isset($_POST['patient_id'])) {

        if (empty($_POST['wall_balance'])) {
            $session->message("Wallet Balance cannot be empty, Please make deposit.");
            redirect_to("patient_detail.php?id=$ref->id");
        }


        $referAdmission = new ReferAdmission();
        if (!empty($refAdmissionDetail->id)) {
            $referAdmission->id = $refAdmissionDetail->id;
        }

        $datetime = $_POST['adm_date'] . " " . $_POST['usr_time'];
        $referAdmission->patient_id = $_POST['patient_id'];
        $referAdmission->Consultantdr = $_POST['Consultantdr'];
        $referAdmission->in_patient_id = $_POST['in_patient_id'];
        $referAdmission->adm_date = $datetime;
        $referAdmission->location = $_POST['location'];
        $referAdmission->ward_no = $_POST['ward_no'];
        $referAdmission->room_no = $_POST['room_no'];
        $referAdmission->bed_no = $_POST['bed_no'];
        $referAdmission->m_s = $_POST['m_s'];
        $referAdmission->adm_purpose = $_POST['adm_purpose'];
        $referAdmission->ipd_service = json_encode($_POST['ipd_service']);
        $referAdmission->payment_type = $_POST['payment_type'];
        $referAdmission->add_wall_balance = $_POST['add_wall_balance'];
        $referAdmission->wall_balance = $_POST['wall_balance'];
        $referAdmission->remark = $_POST['remark'];
        $referAdmission->remark_nurse = $_POST['remark_nurse'];
        $referAdmission->pat_category = $_POST['pat_category'];
        $referAdmission->settle_status = NULL;
        $referAdmission->created = date("Y-m-d h:i:s");

        if ($_SESSION['department'] == "Nursing") {
            $referAdmission->nurse_id = $_SESSION['user_id'];
        } else {
            $referAdmission->nurse_id = $_POST['nurse_id'];
        }

        $a = $referAdmission->save();

        //Bed Status
        $bedL = new BedsList();
        $bedListDa = $bedL->find_by_ward_id($_POST['ward_no'], $_POST['bed_no'], $_POST['patient_id']);
        $oldBedAllot = $bedL->find_by_bed_allot_status_change($_POST['patient_id']);
        //pre_d($oldBedAllot);die;
        if (!isset($oldBedAllot)) {
            $bedL->updateBedStatus('patient_id=NULL, occupied_bed_status=0', "where id=" . $oldBedAllot->id);
        } else {
            $bedL->updateBedStatus('patient_id=NULL, occupied_bed_status=0', "where patient_id=" . $_POST['patient_id']);
        }

        if (!empty($bedListDa)) {

            $bedL->occupied_bed_status = '1';
            $bedL->patient_id = $_POST['patient_id'];
            $bedL->updateReferId("where id=" . $bedListDa->id);
        } else {
            $bedListData = $bedL->find_by_ward_id_set($_POST['ward_no'], $_POST['bed_no']);

            $bedL->occupied_bed_status = '1';
            $bedL->patient_id = $_POST['patient_id'];
            $bedL->updateReferId("where id=" . $bedListData->id);
        }

        if ($a) {
            $session->message("Patient has been admitted");
            redirect_to("patient_detail.php?id=$ref->id");
        } else {
            $session->message("Not Save");
            redirect_to("patient_detail.php?id=$ref->id");
        }
    }


    if (isset($_POST['reason'])) {
        $findreferDetailSingle = new ReferAdmission();
        $findReferData = $findreferDetailSingle->find_by_bill_id($ref->patient_id);
        $findReferData = $findReferData[0];
        $findReferData->cancel_status = 1;
        $findReferData->id = $findReferData->id;
        $findReferData->updateRefer();
        //pre_d($findReferData);die;
        $cancelAdmission->reason = $_POST['reason'];
        $cancelAdmission->cancel_by_id = $_SESSION['user_id'];
        $cancelAdmission->patient_id = $ref->patient_id;
        $cancelAdmission->created = date("Y-m-d h:i:s");
        //pre_d($cancelAdmission);die;
        $canc = $cancelAdmission->save();

        // For Release Bed after cancel admission
        $bedLs = new BedsList();
        $oldBedAllotss = $bedLs->find_by_bed_allot_status_change($ref->patient_id);
        $bedLs->occupied_bed_status = 0;
        $bedLs->patient_id = NULL;
        $bedLs->updateBedStatus('patient_id=NULL, occupied_bed_status=0', "where id=" . $oldBedAllotss->id);

        if ($canc) {
            $session->message("Successfully cancel admission");
            redirect_to("patient_detail.php?id=$ref->id");
        } else {
            $session->message("Not cancel admission");
            redirect_to("patient_detail.php?id=$ref->id");
        }
    }


    if (isset($_POST['save_note'])) {

        $subjective  = test_input($_POST['subjective']);
        $objective   = test_input($_POST['objective']);
        $assessment  = test_input($_POST['assessment']);
        $plan        = test_input($_POST['plan']);

        $caseNote                  = new CaseNote();
        $caseNote->sync            = "off";
        $caseNote->patient_id      = $patient->id;
        $caseNote->waiting_list_id = $waiting_list->id;
        $caseNote->sub_clinic_id   = $waiting_list->sub_clinic_id;
        $caseNote->subjective      = $subjective;
        $caseNote->objective       = $objective;
        $caseNote->assessment      = $assessment;
        $caseNote->plan            = $plan;
        $caseNote->consultant      = $user->full_name();
        $caseNote->status          = "OPEN";
        $caseNote->date            = strftime("%Y-%m-%d %H:%M:%S", time());
        $caseNote->save();
        $session->message("Patient's note has been generated!");
        redirect_to("patient_detail.php?id=$patient->id");
    }

    //Save Vital Data
    if (isset($_POST['save_vitals'])) {
        $pressure    = test_input($_POST['pressure']);
        $temperature = test_input($_POST['temperature']);
        $weight      = test_input($_POST['weight']);
        $height      = test_input($_POST['height']);
        $respiration = test_input($_POST['respiration']);
        $heart_rate  = test_input($_POST['heart_rate']);
        $pain        = test_input($_POST['pain']);
        $bmi         = test_input($_POST['bmi']);
        $urinalysis  = test_input($_POST['urinalysis']);
        $rbs         = test_input($_POST['rbs']);
        $comment     = test_input($_POST['comment']);


        $clinic_id = test_input($_POST['clinic_id']);
        $json = "";

        //   echo $clinic_id; exit;

        if (isset($clinic_id)) {
            $clinic = Clinic::find_by_id($clinic_id);
            $clinic->name;

            switch ($clinic->name) {
                case "MOPD":
                    $foo = new StdClass();
                    $foo->HeadCircumference = test_input($_POST['head_cir']);
                    $foo->ArmCircumference = test_input($_POST['arm_cir']);
                    $foo->AbdominalGirth = test_input($_POST['abd_girth']);
                    $foo->Waist = test_input($_POST['waist']);
                    $foo->HipMeasurement = test_input($_POST['hip_measure']);
                    $foo->ChestCircumference = test_input($_POST['chest_cir']);
                    $foo->Hemodialysis = test_input($_POST['hd']);
                    $foo->Hemodiafiltrion = test_input($_POST['hdf']);
                    $foo->SeizureChart = test_input($_POST['seizure']);
                    $foo->SuicideMonitoringChart = test_input($_POST['suicide']);

                    $json = json_encode($foo);
                    //  echo $json; exit;
                    break;
                case "FAMILY PLANNING":
                    $foo = new StdClass();
                    $foo->UterineDepth = test_input($_POST['uterine_depth']);
                    $foo->CervicalAppearance = test_input($_POST['cerv_app']);

                    $json = json_encode($foo);
                    //  echo $json; exit;
                    break;
                case "OPHTHALMOLOGY":
                    $foo = new StdClass();
                    $foo->VisualAcuity = test_input($_POST['visual_acuity']);
                    $foo->Endoscopy = test_input($_POST['endoscopy']);
                    $foo->IntraocularPressure = test_input($_POST['intra_pressure']);
                    $foo->InstillationChart = test_input($_POST['instil']);

                    $json = json_encode($foo);
                    // echo $json; exit;
                    break;
                case "ENT":
                    $foo = new StdClass();
                    $foo->Audiometry = test_input($_POST['audio']);
                    $foo->Tympanometry = test_input($_POST['tympa']);

                    $json = json_encode($foo);
                    //  echo $json; exit;
                    break;
                case "ANTENATAL &amp; POS-NATAL":
                    $foo = new StdClass();
                    $foo->EstimatedGestationalAge = test_input($_POST['estimated']);
                    $foo->FundalHeight = test_input($_POST['fundal']);
                    $foo->PelvicPalpation = test_input($_POST['pelvic']);
                    $foo->FetalHeartRate = test_input($_POST['fetal_heart']);
                    $foo->FetalAndLieAndPosition = test_input($_POST['fetal_lie']);
                    $foo->Presentation = test_input($_POST['presentation']);

                    $json = json_encode($foo);
                    // echo $json; exit;
                    break;
                default:
                    echo "";
            }
        }

        if ((!$errMessage) and (empty($errMessage))) {
            $vitals                  = new Vitals();
            $vitals->nurse           = $user->full_name();   // current user
            $vitals->patient_id      = $patient->id;
            $vitals->sub_clinic_id   = $subClinic->id;
            $vitals->clinic_id       = $_POST['clinic_id'];
            $vitals->waiting_list_id = $waiting->id;
            $vitals->ref_adm_id      = $ref->id;
            $vitals->ward_id         = "0";
            $vitals->temperature     = $temperature;
            $vitals->pulse           = $heart_rate;
            $vitals->pressure        = $pressure;
            $vitals->weight          = $weight;
            $vitals->height          = $height;
            $vitals->pain            = $pain;
            $vitals->bmi             = $bmi;
            $vitals->urinalysis      = $urinalysis;
            $vitals->clinical_vitals = $json;
            $vitals->comment         = $comment;

            $vitals->status = "waiting";
            $vitals->date = strftime("%Y-%m-%d %H:%M:%S", time());
            if ($vitals->save()) {
                // $waiting->vitals = "DONE";
                // $waiting->save();
                //   $patient->status = "open";
                //   $patient->save();
                $done = TRUE;
                $message = "Vitals have been saved for this Patient";
            }
        }

        $session->message("Vitals has been done for this patient");
        redirect_to("patient_detail_admitted.php?id=$ref->id");
    }

    if (isset($_POST['nursing_history'])) {

        $foo                     = new StdClass();
        $foo->history_hosp       = $_POST['history_hosp'];
        $foo->history_hosp_r     = $_POST['hosp_where'];
        $foo->any_surgery        = $_POST['any_surgery'];
        $foo->surgery_type       = $_POST['surgery_type'];
        $foo->surgery_where      = $_POST['surgery_where'];
        $foo->blood_trans        = $_POST['blood_trans'];
        $foo->med_surg_hist      = $_POST['med_surg_hist'];
        $foo->med_surg_hist_type = $_POST['med_surg_hist_type'];
        $foo->rout_drug          = $_POST['rout_drug'];
        $foo->rout_drug_name     = $_POST['rout_drug_name'];
        $foo->present            = $_POST['present'];

        $foo->nut_inc            = $_POST['nut_inc'];
        $foo->nut_dec            = $_POST['nut_dec'];
        $foo->nut_norm           = $_POST['nut_norm'];
        $foo->food_allergy       = $_POST['food_allergy'];
        $foo->food_allergies     = $_POST['food_allergies'];
        $foo->food_pref          = $_POST['food_pref'];
        $foo->food_preferences   = $_POST['food_preferences'];
        $foo->food_tab           = $_POST['food_tab'];
        $foo->food_taboo         = $_POST['food_taboo'];
        $foo->food_freq          = $_POST['food_freq'];
        $foo->food_comp          = json_encode($_POST['food_comp']);
        $foo->defecate           = $_POST['defecate'];
        $foo->urinate            = $_POST['urinate'];
        $foo->urinate_nite       = $_POST['urinate_nite'];
        $foo->urinate_night      = $_POST['urinate_night'];
        $foo->urinate_dep        = $_POST['urinate_dep'];

        $foo->exercise           = $_POST['exercise'];
        $foo->exercise_type      = $_POST['exercise_type'];
        $foo->exercise_others    = $_POST['exercise_others'];

        $foo->sleep_time         = $_POST['sleep_time'];
        $foo->siesta             = $_POST['siesta'];
        $foo->siesta_time         = $_POST['siesta_time'];
        $foo->sleep_aid          = $_POST['sleep_aid'];
        $foo->sleep_aid_type     = $_POST['sleep_aid_type'];

        $foo->lang               = json_encode($_POST['lang']);
        $foo->other_lang         = $_POST['other_lang'];
        $foo->sight              = $_POST['sight'];
        $foo->hearing            = $_POST['hearing'];
        $foo->taste              = $_POST['taste'];
        $foo->odour              = $_POST['odour'];

        $foo->self               = $_POST['self'];
        $foo->disturb            = $_POST['disturb'];
        $foo->optimism           = $_POST['optimism'];
        $foo->depressed          = $_POST['depressed'];
        $foo->other_feeling      = $_POST['other_feeling'];
        $foo->marital            = $_POST['marital'];
        $foo->family             = $_POST['family'];
        $foo->relate             = $_POST['relate'];
        $foo->sexually           = $_POST['sexually'];
        $foo->married            = $_POST['married'];
        $foo->children           = $_POST['children'];
        $foo->parity             = $_POST['parity'];
        $foo->gravida            = $_POST['gravida'];
        $foo->menache            = $_POST['menache'];
        $foo->menopause          = $_POST['menopause'];
        $foo->stress             = $_POST['stress'];
        $foo->stress_coping      = $_POST['stress_coping'];
        $foo->value              = $_POST['value'];
        $foo->belief             = $_POST['belief'];
        $foo->habits             = $_POST['habits'];
        $foo->smoke              = $_POST['smoke'];
        $foo->alcohol            = $_POST['alcohol'];
        $foo->hard_drugs         = $_POST['hard_drugs'];

        $data                          = json_encode($foo);

        $nurseHistory                  = new NurseHistory();
        $nurseHistory->sync            =  "off";
        $nurseHistory->patient_id      = $patient->id;
        $nurseHistory->waiting_list_id = $waiting->id;
        $nurseHistory->ref_adm_id      = $ref->id;
        $nurseHistory->adm_id          = "";
        $nurseHistory->resultData      = $data;
        $nurseHistory->done_by         = $user->full_name();
        $nurseHistory->date            = strftime("%Y-%m-%d %H:%M:%S", time());
        if ($nurseHistory->save()) {
            $done = TRUE;
            $message = "Nursing History has been added for this patient";
            $session->message("Nursing History has been added for this patient");
            redirect_to("patient_detail_admitted.php?id=$ref->id");
        }

    }

    if (isset($_POST['nursing_intervention'])){

        $nursingIntervention                            = new NursingIntervention();
        $nursingIntervention->sync                      =  "off";
        $nursingIntervention->patient_id                = $patient->id;
        $nursingIntervention->waiting_list_id           = $waiting->id;
        $nursingIntervention->ref_adm_id                = $ref->id;
        $nursingIntervention->nursingDomain_id          = $_POST['domain_id'];
        $nursingIntervention->nursingClassification_id  = $_POST['classification_id'];
        $nursingIntervention->nursingDiagnosis_id       = $_POST['diagnosis_id'];
        $nursingIntervention->remarks                   = $_POST['remarks'];
        $nursingIntervention->done_by                   = $user->full_name();
        $nursingIntervention->date                      = strftime("%Y-%m-%d %H:%M:%S", time());
        if ($nursingIntervention->save()) {
            $done = TRUE;
            $message = "Nursing Intervention has been added for this patient";
            $session->message("Nursing Intervention has been added for this patient");
            redirect_to("patient_detail_admitted.php?id=$ref->id");
        }
      //  echo "let's go";  exit;

    }



}




PatientBill::clear_all_bill();
ScanBill::clear_all_bill();
TestBill::clear_all_bill();




require('../layout/header.php');

//echo "noppw"; exit;

?>


<input type="hidden" value="<?= $_GET['id'] ?>" id="pat_hide_id" />

<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>
                        <?php echo "Medical Dashboard - " . $patient->title . " " . $patient->full_name(); ?>
                    </h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Treatment</li>
                        <li class="breadcrumb-item active"> History</li>
                    </ul>
                </div>

            </div>
        </div>
        <!-- Button to Open the Modal -->

        <input type="hidden" value="../revenue/beds.php" class="urlWard" />
        <input type="hidden" value="patient_detail.php" class="typeLogin" />



                <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="body">

                                    <?php
                                    if (!empty($message)) { ?>
                                        <div id="success" class="alert alert-success alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <?php echo output_message($message); ?>
                                        </div>
                                    <?php }
                                    ?>


                                    <div class="tab-pane show active" id="Admission">
                                        <div class="tab-pane" id="Admission_sub">


                                            <div class="body">


                                                <ul class="nav nav-tabs-new2">
                                                    <li class="nav-item"><a class="nav-link nav-link-goto active show" data-toggle="tab" href="#patDetails"> Patient Details</a></li>
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#VitalHistory">Vital History</a></li>
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#NewVitals">New Vitals</a></li>
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#NursingHistory">Nursing History</a></li>
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#NursingIntervention">Nursing Intervention</a></li>
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#NursingOutcome">Nursing Outcome</a></li>
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#ClinicalHistory">Clinical History</a></li>
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#WalletBalance">Patient's Wallet</a></li>

                         <!--                           <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#LabHistoryTwo">Clinical History Two</a></li>
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#SymptomChecker">Symptom Checker</a></li>-->



                                                </ul>
                                                <div class="tab-content">

                                                    <div class="tab-pane show active" id="patDetails">
                                                        <form id="" method="post" action="">
                                                            <input type="hidden" name="nurse_id" value="<?php echo isset($refAdmissionDetail->nurse_id) ? $refAdmissionDetail->nurse_id : NULL ?>" />

                                                            <div class="titleData">
                                                                <div class="row clearfix">

                                                                    <div class="col-sm-4">
                                                                        <?php
                                                                        $mr = "";
                                                                        $mrs = "";
                                                                        $master = "";
                                                                        $miss = "";
                                                                        $titl = "";
                                                                        if ($patient->title == "Mr") {
                                                                            $mr = "checked='checked'";
                                                                            $mrs = "";
                                                                            $master = "";
                                                                            $miss = "";
                                                                            $titl = "";
                                                                        } else if ($patient->title == "Mrs") {
                                                                            $mrs = "checked='checked'";
                                                                        } else if ($patient->title == "Master") {
                                                                            $master = "checked='checked'";
                                                                        } else if ($patient->title == "Miss") {
                                                                            $miss = "checked='checked'";
                                                                        }
                                                                        ?>
                                                                        <div class="form-group">
                                                                            <label> Title </label>
                                                                            <br>
                                                                            <label class="fancy-radio">
                                                                                <input type="radio" name="title" value="Mr" required="" data-parsley-errors-container="#error-radio" <?= $mr ?> disabled>
                                                                                <span><i></i>Mr</span>
                                                                            </label>
                                                                            <label class="fancy-radio">
                                                                                <input type="radio" name="title" value="Mrs" <?= $mrs ?> disabled>
                                                                                <span><i></i>Mrs</span>
                                                                            </label>
                                                                            <label class="fancy-radio">
                                                                                <input type="radio" name="title" value="Master" <?= $master ?> disabled>
                                                                                <span><i></i>Master</span>
                                                                            </label>
                                                                            <label class="fancy-radio">
                                                                                <input type="radio" name="title" value="Miss" <?= $miss ?> disabled>
                                                                                <span><i></i>Miss</span>
                                                                            </label>
                                                                            <p id="error-radio"></p>
                                                                        </div>

                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label>First Name</label>
                                                                            <input type="text" class="form-control" name="first_name" id="first_name" value="<?= $patient->first_name ?>" required="" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label>Last Name</label>
                                                                            <input type="text" class="form-control" name="last_name" id="last_name" value="<?= $patient->last_name ?>" required="" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row clearfix">
                                                                    <?php
                                                                    $inPat = "";
                                                                    if (!empty($refAdmissionDetail->in_patient_id)) {
                                                                        $inPat = $refAdmissionDetail->in_patient_id;
                                                                    } else {
                                                                        $inPat = $numPrint;
                                                                    }
                                                                    ?>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label>In-patient id</label>
                                                                            <input type="text" class="form-control" name="in_patient_id" value="<?= $inPat ?>" required="" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label>Hospital Number</label>
                                                                            <input type="text" class="form-control" name="hospital_number" value="<?= $patient->folder_number ?>" required="" readonly>
                                                                        </div>
                                                                    </div>


                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label>Hospital Clinic</label>
                                                                            <select class="form-control" id="clinic_id" required="" disabled>
                                                                                <option value="">-- Select Clinic --</option>
                                                                                <?php
                                                                                $patientSubClinics = PatientSubClinic::find_by_patient_id($patient->id);
                                                                                //  $patientSubClinics = PatientSubClinic::find_by_id($patient->id);
                                                                                $finds = Clinic::find_all();
                                                                                $sub_clinic = SubClinic::find_by_id($patientSubClinics->sub_clinic_id);
                                                                                foreach ($finds as $clinic) {
                                                                                ?>
                                                                                    <option value="<?php echo $clinic->id; ?>" <?= $patientSubClinics->clinic_id == $clinic->id ? "selected='selected'" : '' ?>><?php echo $clinic->name; ?></option>
                                                                                <?php } ?>
                                                                            </select>
                                                                            <input type="hidden" name="clinic_id" value="<?php echo $patientSubClinics->clinic_id; ?>" />
                                                                        </div>
                                                                    </div>


                                                                </div>

                                                                <div class="row clearfix">


                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label>Sub-Clinic</label>
                                                                            <div id="sub_clinic_id">
                                                                                <input type="text" class="form-control" name="sub_clinic_id" value="<?php echo $sub_clinic->name; ?>" readonly />
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label>Clinic Number</label>
                                                                            <input type="text" class="form-control" name="clinic_number" value="<?php echo $patientSubClinics->clinic_number; ?>" required="" readonly>
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                                <div class="row clearfix">
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label>Date Of Birth</label>
                                                                            <input type="text" class="form-control" name="dob" id="" placeholder="dd-mm-yyyy" value="<?php echo date("Y-m-d", strtotime($patient->dob)); ?>" required="" readonly>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label> Gender </label>
                                                                            <br>
                                                                            <label class="fancy-radio">
                                                                                <input type="radio" name="gender" value="Male" required="" data-parsley-errors-container="#error-radio" <?= ($patient->gender == "Male") ? "checked='checked'" : '' ?> disabled />
                                                                                <span><i></i>Male</span>
                                                                            </label>
                                                                            <label class="fancy-radio">
                                                                                <input type="radio" name="gender" value="Female" <?= ($patient->gender == "Female") ? "checked='checked'" : '' ?> disabled />
                                                                                <span><i></i>Female</span>
                                                                            </label>
                                                                            <p id="error-radio"></p>
                                                                        </div>
                                                                    </div>


                                                                </div>
                                                            </div>



                                                            <div id="editinfo">
                                                                <input type="hidden" value="<?php echo $patient->id; ?>" name="patient_id" />
                                                                <div class="row clearfix">
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label>Consultant Dr.</label>
                                                                            <?php
                                                                            $userConsult = User::find_by_department("Consultancy");
                                                                            ?>
                                                                            <!-- <select class="form-control" name="Consultantdr" required>
                                                                                                <option value="">-- Select Consultant --</option> -->
                                                                            <?php
                                                                            $selec = "";
                                                                            foreach ($userConsult as $co) {
                                                                                if (!empty($refAdmissionDetail->Consultantdr)) {
                                                                                    echo "<input type='hidden' name='Consultantdr' value='" . $refAdmissionDetail->Consultantdr . "'/>";
                                                                                    if ($co->id == $refAdmissionDetail->Consultantdr) {
                                                                                        $selec = "selected='selected'";
                                                                                    } else {
                                                                                        $selec = "";
                                                                                    }
                                                                                    echo "<input type='text' name='' class='form-control' value='" . $co->first_name . ' ' . $co->last_name . "' readonly/>";
                                                                                    break;
                                                                                } else {
                                                                                    echo "<input type='hidden' name='Consultantdr' value='" . $user->id . "'/>";
                                                                                    if ($co->id == $user->id) {
                                                                                        $selec = "selected='selected'";
                                                                                    } else {
                                                                                        $selec = "";
                                                                                    }
                                                                                    echo "<input type='text' name='' class='form-control' value='" . $co->first_name . ' ' . $co->last_name . "' readonly/>";
                                                                                    break;
                                                                                }

                                                                                //echo "<input  value='" . $co->id . "' " . $selec . "> " . $co->first_name . " " . $co->last_name . " </option>";
                                                                            }
                                                                            ?>
                                                                            <!-- </select> -->
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label>Adm. Date & Time </label>
                                                                            <!--   <input type="time" name="usr_time" value="<?php echo date("H:m", strtotime($refAdmissionDetail->adm_date)); ?>">  -->
                                                                            <input type="date" class="form-control" readonly id="adm_date" name="adm_date" value="<?php echo date("Y-m-d", strtotime($refAdmissionDetail->adm_date)); ?>" />
                                                                            <!-- <input id="input-datetime-local" type="datetime-local" value="2014-10-31T00:00:01"> -->

                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label class="control-label">Location</label>
                                                                            <input type="hidden" name="location" class="bed_location_id_nurse" value="<?= (!empty($refAdmissionDetail->location)) ? $refAdmissionDetail->location : '' ?>" />
                                                                            <?php
                                                                            if (!empty($location)) {
                                                                                foreach ($location as $locData) {
                                                                                    if (!empty($refAdmissionDetail->location) && $refAdmissionDetail->location == $locData->id) {
                                                                            ?>
                                                                                        <input type="text" class="form-control" value="<?= ucfirst($locData->location_name) ?>" readonly />
                                                                            <?php
                                                                                    }
                                                                                }
                                                                            }
                                                                            ?>

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row clearfix">
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label>Ward</label>

                                                                            <?= $dataWard ?>

                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label>Room No.</label>
                                                                            <select class="form-control room_no_nurse" name="room_no" readonly>
                                                                                <option value="">-- Select Room --</option>
                                                                                <!-- <option value="1" <? //= (!empty($refAdmissionDetail->room_no) && ($refAdmissionDetail->room_no == "1")) ? "selected='selected'" : "" 
                                                                                                        ?>>1</option> -->
                                                                                <?php
                                                                                if (!empty($roomListData)) {
                                                                                    foreach ($roomListData as $roomListDataData) {
                                                                                ?>
                                                                                        <option value="<?= $roomListDataData->id ?>" <?= (!empty($refAdmissionDetail->room_no) && $refAdmissionDetail->room_no == $roomListDataData->id) ? "selected='selected'" : "" ?>><?= ucfirst($roomListDataData->room_number) ?></option>
                                                                                <?php
                                                                                    }
                                                                                }
                                                                                ?>
                                                                                <!-- <option value="3" <? //= (!empty($refAdmissionDetail->room_no) && ($refAdmissionDetail->room_no == "3")) ? "selected='selected'" : "" 
                                                                                                        ?>>3</option> -->
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label class="control-label">Bed No.</label>
                                                                            <select class="form-control bed_no" name="bed_no" readonly>
                                                                                <option value="">-- Select Bed No --</option>
                                                                                <!-- <option value="1" <? //= (!empty($refAdmissionDetail->bed_no) && ($refAdmissionDetail->bed_no == "1")) ? "selected='selected'" : "" 
                                                                                                        ?>>1</option> -->
                                                                                <?php
                                                                                // $bedSelected = "";
                                                                                // for($i = $bedNumberListStart; $i<=$bedNumberListEnd; $i++){
                                                                                //     if($i == $refAdmissionDetail->bed_no){
                                                                                //         $bedSelected = "selected='selected'";
                                                                                //     }else{
                                                                                //         $bedSelected = "";
                                                                                //     }
                                                                                //     echo "<option value='".$i."' ".$bedSelected.">".$i."</option>";
                                                                                // }
                                                                                echo $bedListOptions;
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row clearfix">
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label>Medical / Surgical</label>
                                                                            <br>
                                                                            <label class="fancy-radio">
                                                                                <input type="radio" name="m_s" value="Surgical" required="" data-parsley-errors-container="#error-radio" <?= (!empty($refAdmissionDetail->m_s) && ($refAdmissionDetail->m_s == "Surgical")) ? "checked='checked'" : "" ?>>
                                                                                <span><i></i>Surgical</span>
                                                                            </label>
                                                                            <label class="fancy-radio">
                                                                                <input type="radio" name="m_s" value="Non-Surgical" <?= (!empty($refAdmissionDetail->m_s) && ($refAdmissionDetail->m_s == "Non-Surgical")) ? "checked='checked'" : "" ?>>
                                                                                <span><i></i>Non-Surgical</span>
                                                                            </label>

                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label>Admission Purpose</label>
                                                                            <br>
                                                                            <label class="fancy-radio">
                                                                                <input type="radio" name="adm_purpose" value="General" required="" data-parsley-errors-container="#error-radio" <?= (!empty($refAdmissionDetail->adm_purpose) && ($refAdmissionDetail->adm_purpose == "General")) ? "checked='checked'" : "" ?>>
                                                                                <span><i></i> General</span>
                                                                            </label>
                                                                            <label class="fancy-radio">
                                                                                <input type="radio" name="adm_purpose" value="Observation" data-parsley-errors-container="#error-radio" <?= (!empty($refAdmissionDetail->adm_purpose) && ($refAdmissionDetail->adm_purpose == "Observation")) ? "checked='checked'" : "" ?>>
                                                                                <span><i></i> Observation</span>
                                                                            </label>
                                                                            <label class="fancy-radio">
                                                                                <input type="radio" name="adm_purpose" value="Surgery" data-parsley-errors-container="#error-radio" <?= (!empty($refAdmissionDetail->adm_purpose) && ($refAdmissionDetail->adm_purpose == "Surgery")) ? "checked='checked'" : "" ?>>
                                                                                <span><i></i>Surgery</span>
                                                                            </label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label class="control-label">IPD Services </label>
                                                                            <br>
                                                                            <?php
                                                                            if (isset($ipService)) {
                                                                                $selectedIpd = isset($refAdmissionDetail->ipd_service) ? $refAdmissionDetail->ipd_service : '';
                                                                                $encodeIpd = [];
                                                                                if (isset($selectedIpd)) {
                                                                                    $encodeIpd = json_decode($selectedIpd);
                                                                                }
                                                                                //pre_d($encodeIpd);die;
                                                                                foreach ($ipService as $ipdServices) {
                                                                                    $selIpd = "";
                                                                                    if (in_array($ipdServices->id, $encodeIpd)) {
                                                                                        $selIpd = "checked='checked'";
                                                                                    } else {
                                                                                        $selIpd = "";
                                                                                    }
                                                                            ?>
                                                                                    <label class="fancy-checkbox">
                                                                                        <input type="checkbox" name="ipd_service[]" value="<?php echo $ipdServices->id ?>" data-parsley-errors-container="#error-checkbox" <?= $selIpd ?>>
                                                                                        <span><?php echo $ipdServices->service_name ?></span>
                                                                                    </label>
                                                                            <?php
                                                                                }
                                                                            }
                                                                            ?>

                                                                            <!-- <label class="fancy-checkbox">
                                                                                <input type="checkbox" name="ipd_service[]" value="Accommodation"  data-parsley-errors-container="#error-checkbox">
                                                                                <span>Accommodation</span>
                                                                                </label>
                                                                                <label class="fancy-checkbox">
                                                                                <input type="checkbox" name="ipd_service[]" value="Nursing Care"  data-parsley-errors-container="#error-checkbox">
                                                                                <span>Nursing Care</span>
                                                                                </label>
                                                                                <label class="fancy-checkbox">
                                                                                <input type="checkbox" name="ipd_service[]" value="Drug Administration"  data-parsley-errors-container="#error-checkbox">
                                                                                <span>Drug Administration</span>
                                                                                </label> -->

                                                                        </div>
                                                                    </div>

                                                                </div>

                                                                <div class="row clearfix">
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label>Payment Type</label>
                                                                            <input type="text" class="form-control" placeholder="Cash" id="" value="Cash" name="payment_type" readonly>
                                                                        </div>
                                                                    </div>

                                                                    <!--
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label>Add Wallet Balance </label>
                                                                            <div class="input-group mb-3">
                                                                                <input type="text" class="form-control" placeholder="" id="add_wall_bal" name="add_wall_bal" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                                                                <div class="input-group-append">
                                                                                    <button class="addBalance btn btn-outline-secondary" type="button">Add </button>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                    -->


                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label class="control-label">Wallet Balance(₦)</label>
                                                                            <input type="text" class="form-control wallBalance" placeholder="" id="wall_balance" name="wall_balance" readonly value="<?= (!empty($refAdmissionDetail->wall_balance)) ? $refAdmissionDetail->wall_balance : '' ?>">
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="row clearfix">
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label class="control-label">Patient Category </label>
                                                                            <select class="form-control" name="pat_category">
                                                                                <option value="">-- Select Patient Category --</option>
                                                                                <option value="General" <?= (!empty($refAdmissionDetail->pat_category) && ($refAdmissionDetail->pat_category == "General")) ? "selected='selected'" : "" ?>>General</option>
                                                                                <option value="VIP" <?= (!empty($refAdmissionDetail->pat_category) && ($refAdmissionDetail->pat_category == "VIP")) ? "selected='selected'" : "" ?>>VIP</option>
                                                                                <option value="Veteran" <?= (!empty($refAdmissionDetail->pat_category) && ($refAdmissionDetail->pat_category == "Veteran")) ? "selected='selected'" : "" ?>>Veteran</option>

                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label> Doctor's Remark </label>
                                                                    <textarea class="form-control" name="remark" readonly rows="3" cols="10"><?= (!empty($refAdmissionDetail->remark)) ? $refAdmissionDetail->remark : '' ?></textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label> Nurse's Remark </label>
                                                                    <textarea class="form-control" name="remark_nurse" readonly rows="3" cols="10"><?= (!empty($refAdmissionDetail->remark_nurse)) ? $refAdmissionDetail->remark_nurse : '' ?></textarea>
                                                                </div>

                                                                <div class="form-group">
                                                                    <!--  <input type="submit" value="Save" class="btn btn-primary" />  -->
                                                                    <?php
                                                                    if (!empty($singleReferData)) {
                                                                    ?>
                                                                        <a href="pdfGenerate.php?id=<?= $_GET['id']; ?>" target="_blank" class="btn btn-primary">Print PDF</a>
                                                                    <?php
                                                                    } ?>
                                                                </div>

                                                            </div>




                                                        </form>
                                                    </div>

                                                    <div class="tab-pane" id="NewVitals">

                                                        <form action="" method="post">
                                                            <div class="row">

                                                                <div class="col-md-5">

                                                                    <h4><u> General Vitals</u></h4>


                                                                    <div class="table-responsive">
                                                                        <table>
                                                                            <tr>
                                                                                <th>Temperature</th>
                                                                                <td style='padding-left: 30px'><input type="text" name="temperature" required class="form-control">
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Heart Rate(Pulse)</th>
                                                                                <td style='padding-left: 30px'><input type="text" name="heart_rate" class="form-control">
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Respiratory Rate</th>
                                                                                <td style='padding-left: 30px'><input type="text" name="respiration" class="form-control">
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Blood Pressure</th>
                                                                                <td style='padding-left: 30px'><input type="text" name="pressure" required class="form-control">
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Weight</th>
                                                                                <td style='padding-left: 30px'><input type="text" name="weight" required class="form-control">
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Height</th>
                                                                                <td style='padding-left: 30px'><input type="text" name="height" class="form-control">
                                                                                </td>
                                                                            </tr>


                                                                            <tr>
                                                                                <th>Pain</th>
                                                                                <td style='padding-left: 30px'><input type="text" name="pain" class="form-control">
                                                                                </td>
                                                                            </tr>

                                                                            <tr>
                                                                                <th>BMI</th>
                                                                                <td style='padding-left: 30px'><input type="text" name="bmi" class="form-control">
                                                                                </td>
                                                                            </tr>
                                                                            <!--<tr>
                                                                                <th>Urinalysis</th>
                                                                                <td style='padding-left: 30px'><input type="text" name="urinalysis" class="form-control">
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>RBS</th>
                                                                                <td style='padding-left: 30px'><input type="text" name="rbs" class="form-control">
                                                                                </td>
                                                                            </tr>-->

                                                                            <tr>
                                                                                <td colspan="2">
                                                                                    <label> Comments </label>
                                                                                    <textarea class="form-control" name="comment" rows="5" cols="30"></textarea>
                                                                                </td>
                                                                            </tr>


                                                                            <tr>
                                                                                <th>
                                                                                    <button type="submit" name="save_vitals" class="btn btn-primary">Save Vitals
                                                                                    </button>

                                                                                </th>
                                                                                <td style='padding-left: 30px'>

                                                                                </td>
                                                                            </tr>
                                                                        </table>

                                                                    </div>


                                                                </div>
                                                                <div class="col-md-7">
                                                                    <h4><u> Clinic/Ward Vitals</u></h4>
                                                                    <!--    <form action="" method="post">-->

                                                                    <div class="table-responsive">
                                                                        <table>
                                                                            <tr>
                                                                                <th> Select Clinic</th>
                                                                                <td style='padding-left: 30px'>
                                                                                    <select class="form-control" id="clinic_vitals" name="clinic_id" required>
                                                                                        <option value="">--Select Clinic--</option>
                                                                                        <?php
                                                                                        $finds = Clinic::find_all();
                                                                                        foreach ($finds as $find) { ?>
                                                                                            <option value="<?php echo $find->id; ?>"><?php echo $find->name; ?></option>
                                                                                        <?php } ?>
                                                                                    </select>
                                                                                </td>
                                                                            </tr>

                                                                        </table>
                                                                        <div id="clin_vitals">

                                                                        </div>



                                                                    </div>


                                                                </div>

                                                            </div>
                                                        </form>

                                                    </div>

                                                    <div class="tab-pane table-responsive" id="VitalHistory">

                                                        <div class="container">
                                                            <h5>Previous Vitals</h5>

                                                            <div class="alert alert-info alert-dismissible" role="alert">
                                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                                                                </button>
                                                                <i class="fa fa-info-circle"></i> Most recent Patient's vitals
                                                            </div>


                                                            <div id="accordion">
                                                                <?php
                                                                $vitals = Vitals::find_by_patient_vitals($patient->id);
                                                                foreach ($vitals as $vital) {
                                                                    ?>

                                                                    <div class="card">
                                                                        <div class="card-header">
                                                                            <a class="card-link" data-toggle="collapse" href="#collapse<?php echo $vital->id; ?>">
                                                                                <?php $d_date = date('d/m/Y h:i a', strtotime($vital->date));
                                                                                echo $d_date ?>
                                                                            </a>
                                                                        </div>
                                                                        <div id="collapse<?php echo $vital->id; ?>" class="collapse" data-parent="#accordion">
                                                                            <div class="card-body">

                                                                                <div class="row">
                                                                                    <div class="col-md-6">
                                                                                        <div class="table-responsive">
                                                                                            <h5> Vital Signs as
                                                                                                at <?php $d_date = date('d/m/Y h:i a', strtotime($vital->date));
                                                                                                echo $d_date ?></h5>
                                                                                            <table class="table table-bordered">
                                                                                                <tbody>
                                                                                                <tr>
                                                                                                    <?php
                                                                                                    if (isset($vital->temperature) and (!empty($vital->temperature))) {
                                                                                                        echo "<th>Temperature</th>";
                                                                                                        echo "<td> $vital->temperature</td>";
                                                                                                    }
                                                                                                    ?>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <?php
                                                                                                    if (isset($vital->pulse) and (!empty($vital->pulse))) {
                                                                                                        echo "<th> Heart Rate(Pulse) </th>";
                                                                                                        echo "<td> $vital->pulse</td>";
                                                                                                    }
                                                                                                    ?>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <?php
                                                                                                    if (isset($vital->resp_rate) and (!empty($vital->resp_rate))) {
                                                                                                        echo "<th> Respiratory Rate </th>";
                                                                                                        echo "<td> $vital->resp_rate</td>";
                                                                                                    }
                                                                                                    ?>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <?php
                                                                                                    if (isset($vital->pressure) and (!empty($vital->pressure))) {
                                                                                                        echo "<th>Blood Pressure</th>";
                                                                                                        echo "<td> $vital->pressure</td>";
                                                                                                    }
                                                                                                    ?>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <?php
                                                                                                    if (isset($vital->weight) and (!empty($vital->weight))) {
                                                                                                        echo "<th> Weight </th>";
                                                                                                        echo "<td> $vital->weight</td>";
                                                                                                    }
                                                                                                    ?>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <?php
                                                                                                    if (isset($vital->height) and (!empty($vital->height))) {
                                                                                                        echo "<th> Height </th>";
                                                                                                        echo "<td> $vital->height</td>";
                                                                                                    }
                                                                                                    ?>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <?php
                                                                                                    if (isset($vital->pain) and (!empty($vital->pain))) {
                                                                                                        echo "<th> Pain </th>";
                                                                                                        echo "<td> $vital->pain</td>";
                                                                                                    }
                                                                                                    ?>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <?php
                                                                                                    if (isset($vital->urinalysis) and (!empty($vital->urinalysis))) {
                                                                                                        echo "<th> Urinalysis </th>";
                                                                                                        echo "<td> $vital->urinalysis</td>";
                                                                                                    }
                                                                                                    ?>
                                                                                                </tr>

                                                                                                <tr>
                                                                                                    <?php
                                                                                                    if (isset($vital->rbs) and (!empty($vital->rbs))) {
                                                                                                        echo "<th> RBS </th>";
                                                                                                        echo "<td> $vital->rbs</td>";
                                                                                                    }
                                                                                                    ?>
                                                                                                </tr>

                                                                                                <tr>
                                                                                                    <?php
                                                                                                    if (isset($vital->bmi) and (!empty($vital->rbs))) {
                                                                                                        echo "<th> BODY MASS INDEX(BMI) </th>";
                                                                                                        echo "<td> $vital->bmi</td>";
                                                                                                    }
                                                                                                    ?>
                                                                                                </tr>

                                                                                                </tbody>
                                                                                            </table>
                                                                                            <?php
                                                                                            if (isset($vital->comment) and (!empty($vital->comment)))
                                                                                                echo $vital->comment;
                                                                                            ?>
                                                                                            <p class="text-info" style="font-size: larger"><code></code>
                                                                                                Vitals Done
                                                                                                By <?php echo $vital->nurse ?>
                                                                                            </p>


                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="table-responsive">
                                                                                            <?php


                                                                                            //  $subClinic = SubClinic::find_by_id($vital->sub_clinic_id);

                                                                                            //  $clinic = Clinic::find_by_id($subClinic->clinic_id);
                                                                                            ?>
                                                                                            <h5> Clinical/Ward Vital Signs </h5>
                                                                                            <?php
                                                                                            $decoded = $vital->clinical_vitals;
                                                                                            $array = json_decode($decoded);
                                                                                            ?>
                                                                                            <table class="table table-bordered">
                                                                                                <tbody>
                                                                                                <tr>
                                                                                                    <th>CLINIC/WARD</th>
                                                                                                    <td><?php /* echo $clinic->name */ ?></td>
                                                                                                </tr>
                                                                                                <?php
                                                                                                foreach ($array as $key => $value) { ?>
                                                                                                    <tr>
                                                                                                        <th><?php echo $key ?></th>
                                                                                                        <td><?php echo $value ?></td>
                                                                                                    </tr>
                                                                                                <?php } ?>

                                                                                            </table>
                                                                                        </div>
                                                                                    </div>

                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php } ?>

                                                            </div>


                                                        </div>

                                                    </div>

                                                    <div class="tab-pane" id="NursingHistory">
                                                        <h5>Nursing History </h5>

                                                        <?php
                                                            $nHistory = NurseHistory::find_by_ref_id($ref->id);
                                                            if (!empty($nHistory)){
                                                                $data = json_decode($nHistory->resultData);
                                                             //   print_r($data);

                                                        ?>
                                                                <form method="post" action="">

                                                                    <h6><b>  PAST</b></h6>
                                                                    <div class="row clearfix">

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> History Of Hospitalization </label>
                                                                                <br/>
                                                                                <?php
                                                                             foreach($data as $key => $value) {
                                                                                if ($key == 'history_hosp') {
                                                                                    //  echo $key;
                                                                                    $yes = "";
                                                                                    $no = "";
                                                                                    if ($value == "Yes") {
                                                                                        $yes = "checked='checked'";
                                                                                        $no = "";
                                                                                    } else if ($value == "No") {
                                                                                        $no = "checked='checked'";
                                                                                    }
                                                                                }
                                                                              }
                                                                                ?>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="history_hosp" value="Yes" <?= $yes ?>
                                                                                           data-parsley-errors-container="#error-radio">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="history_hosp" value="No" <?= $no ?> >
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label>If Yes, Where and When</label>
                                                                            <?php
                                                                            foreach($data as $key => $value) {
                                                                                if ($key == 'history_hosp_r') {
                                                                                    echo "<input type='text' class='form-control' name=hosp_where value=$value >";
                                                                                }
                                                                            }
                                                                            ?>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4"></div>

                                                                    </div>

                                                                    <div class="row clearfix">
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Any Surgery </label>
                                                                                <br/>
                                                                                <?php
                                                                                foreach($data as $key => $value) {
                                                                                if ($key == 'any_surgery') {
                                                                                //  echo $key;
                                                                                $yes = "";
                                                                                $no = "";
                                                                                if ($value == "Yes") {
                                                                                $yes = "checked='checked'";
                                                                                $no = "";
                                                                                } else if ($value == "No") {
                                                                                $no = "checked='checked'";
                                                                                }
                                                                                }
                                                                                }
                                                                                ?>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="any_surgery" value="Yes" <?= $yes ?>
                                                                                           data-parsley-errors-container="#error-radio">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="any_surgery" value="No" <?= $no ?> >
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label>If Yes, What type of surgery</label>
                                                                                <?php
                                                                                foreach($data as $key => $value) {
                                                                                    if ($key == 'surgery_type') {
                                                                                        echo "<input type='text' class='form-control'  value=$value >";
                                                                                    }
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label>If Yes, Where and When</label>
                                                                                <?php
                                                                                foreach($data as $key => $value) {
                                                                                    if ($key == 'surgery_where') {
                                                                                        echo "<input type='text' class='form-control'  value=$value >";
                                                                                    }
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                        </div>

                                                                    </div>

                                                                    <div class="row clearfix">
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> History of blood transfusion </label>
                                                                                <?php
                                                                                foreach($data as $key => $value) {
                                                                                    if ($key == 'blood_trans') {
                                                                                        $yes = "";
                                                                                        $no = "";
                                                                                        if ($value == "Yes") {
                                                                                            $yes = "checked='checked'";
                                                                                            $no = "";
                                                                                        } else if ($value == "No") {
                                                                                            $no = "checked='checked'";
                                                                                        }
                                                                                    }
                                                                                }
                                                                                ?>
                                                                                <br/>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="blood_trans" value="Yes" <?= $yes ?>
                                                                                           data-parsley-errors-container="#error-radio">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="blood_trans" value="No" <?= $no ?> >
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                        </div>

                                                                    </div>

                                                                    <div class="row clearfix">
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Any Underlying Medical and Surgical History </label>
                                                                                <?php
                                                                                foreach($data as $key => $value) {
                                                                                    if ($key == 'med_surg_hist') {
                                                                                        $yes = "";
                                                                                        $no = "";
                                                                                        if ($value == "Yes") {
                                                                                            $yes = "checked='checked'";
                                                                                            $no = "";
                                                                                        } else if ($value == "No") {
                                                                                            $no = "checked='checked'";
                                                                                        }
                                                                                    }
                                                                                }
                                                                                ?>
                                                                                <br/>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio"  value="Yes" <?= $yes ?>
                                                                                           data-parsley-errors-container="#error-radio">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio"  value="No" <?= $no ?> >
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label>If Yes, What type</label>
                                                                                <?php
                                                                                foreach($data as $key => $value) {
                                                                                    if ($key == 'med_surg_hist_type') {
                                                                                        echo "<input type='text' class='form-control'  value=$value >";
                                                                                    }
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                        </div>

                                                                    </div>

                                                                    <div class="row clearfix">
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> On any routine drug </label>
                                                                                <?php
                                                                                foreach($data as $key => $value) {
                                                                                    if ($key == 'rout_drug') {
                                                                                        $yes = "";
                                                                                        $no = "";
                                                                                        if ($value == "Yes") {
                                                                                            $yes = "checked='checked'";
                                                                                            $no = "";
                                                                                        } else if ($value == "No") {
                                                                                            $no = "checked='checked'";
                                                                                        }
                                                                                    }
                                                                                }
                                                                                ?>
                                                                                <br/>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio"  value="Yes" <?= $yes ?>
                                                                                           data-parsley-errors-container="#error-radio">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio"  value="No" <?= $no ?> >
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label>If Yes, name them</label>
                                                                                <?php
                                                                                foreach($data as $key => $value) {
                                                                                    if ($key == 'rout_drug_name') {
                                                                                        echo "<input type='text' class='form-control'  value=$value >";
                                                                                    }
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                        </div>
                                                                    </div>

                                                                    <hr/>
                                                                    <h6><b>PRESENT</b></h6>
                                                                    <?php
                                                                    foreach($data as $key => $value) {
                                                                        if ($key == 'present') {
                                                                            echo "<textarea class='form-control' >$value</textarea>";
                                                                        }
                                                                    }
                                                                    ?>

                                                                    <hr/>
                                                                    <h6><b>NUTRITION</b></h6>

                                                                    <div class="row clearfix">
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label>Nutritional Pattern - Increased </label>
                                                                                <br/>
                                                                                <?php
                                                                                foreach($data as $key => $value) {
                                                                                    if ($key == 'nut_inc') {
                                                                                        $yes = "";
                                                                                        $no = "";
                                                                                        if ($value == "Yes") {
                                                                                            $yes = "checked='checked'";
                                                                                            $no = "";
                                                                                        } else if ($value == "No") {
                                                                                            $no = "checked='checked'";
                                                                                        }
                                                                                    }
                                                                                }
                                                                                ?>
                                                                                <br/>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio"  value="Yes" <?= $yes ?>
                                                                                           data-parsley-errors-container="#error-radio">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio"  value="No" <?= $no ?> >
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Decreased </label>
                                                                                <br/>
                                                                                <?php
                                                                                foreach($data as $key => $value) {
                                                                                    if ($key == 'nut_dec') {
                                                                                        $yes = "";
                                                                                        $no = "";
                                                                                        if ($value == "Yes") {
                                                                                            $yes = "checked='checked'";
                                                                                            $no = "";
                                                                                        } else if ($value == "No") {
                                                                                            $no = "checked='checked'";
                                                                                        }
                                                                                    }
                                                                                }
                                                                                ?>
                                                                                <br/>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio"  value="Yes" <?= $yes ?>
                                                                                           data-parsley-errors-container="#error-radio">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio"  value="No" <?= $no ?> >
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Normal </label>
                                                                                <br/>
                                                                                <?php
                                                                                foreach($data as $key => $value) {
                                                                                    if ($key == 'nut_norm') {
                                                                                        $yes = "";
                                                                                        $no = "";
                                                                                        if ($value == "Yes") {
                                                                                            $yes = "checked='checked'";
                                                                                            $no = "";
                                                                                        } else if ($value == "No") {
                                                                                            $no = "checked='checked'";
                                                                                        }
                                                                                    }
                                                                                }
                                                                                ?>
                                                                                <br/>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio"  value="Yes" <?= $yes ?>
                                                                                           data-parsley-errors-container="#error-radio">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio"  value="No" <?= $no ?> >
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row clearfix">
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Any Food Allergy</label>
                                                                                <br/>
                                                                                <?php
                                                                                foreach($data as $key => $value) {
                                                                                    if ($key == 'food_allergy') {
                                                                                        $yes = "";
                                                                                        $no = "";
                                                                                        if ($value == "Yes") {
                                                                                            $yes = "checked='checked'";
                                                                                            $no = "";
                                                                                        } else if ($value == "No") {
                                                                                            $no = "checked='checked'";
                                                                                        }
                                                                                    }
                                                                                }
                                                                                ?>
                                                                                <br/>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio"  value="Yes" <?= $yes ?>
                                                                                           data-parsley-errors-container="#error-radio">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio"  value="No" <?= $no ?> >
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label>If Yes, supply</label>
                                                                                <?php
                                                                                foreach($data as $key => $value) {
                                                                                    if ($key == 'food_allergies') {
                                                                                        echo "<input type='text' class='form-control'  value=$value >";
                                                                                    }
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                        </div>

                                                                    </div>

                                                                    <div class="row clearfix">
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Any Food Preference</label>
                                                                                <?php
                                                                                foreach($data as $key => $value) {
                                                                                    if ($key == 'food_pref') {
                                                                                        $yes = "";
                                                                                        $no = "";
                                                                                        if ($value == "Yes") {
                                                                                            $yes = "checked='checked'";
                                                                                            $no = "";
                                                                                        } else if ($value == "No") {
                                                                                            $no = "checked='checked'";
                                                                                        }
                                                                                    }
                                                                                }
                                                                                ?>
                                                                                <br/>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio"  value="Yes" <?= $yes ?>
                                                                                           data-parsley-errors-container="#error-radio">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio"  value="No" <?= $no ?> >
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label>If Yes, supply</label>
                                                                                <?php
                                                                                foreach($data as $key => $value) {
                                                                                    if ($key == 'food_preferences') {
                                                                                        echo "<input type='text' class='form-control'  value=$value >";
                                                                                    }
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                        </div>

                                                                    </div>

                                                                    <div class="row clearfix">
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Any Food taboo</label>
                                                                                <br/>
                                                                                <?php
                                                                                foreach($data as $key => $value) {
                                                                                    if ($key == 'food_tab') {
                                                                                        $yes = "";
                                                                                        $no = "";
                                                                                        if ($value == "Yes") {
                                                                                            $yes = "checked='checked'";
                                                                                            $no = "";
                                                                                        } else if ($value == "No") {
                                                                                            $no = "checked='checked'";
                                                                                        }
                                                                                    }
                                                                                }
                                                                                ?>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio"  value="Yes" <?= $yes ?>
                                                                                           data-parsley-errors-container="#error-radio">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio"  value="No" <?= $no ?> >
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label>If Yes, supply</label>
                                                                                <?php
                                                                                foreach($data as $key => $value) {
                                                                                    if ($key == 'food_taboo') {
                                                                                        echo "<input type='text' class='form-control'  value=$value >";
                                                                                    }
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label>How many times do you eat in a day?</label>
                                                                                <select class="form-control" id="food_freq" name="food_freq" >
                                                                                    <option value=""></option>
                                                                                <?php
                                                                                foreach($data as $key => $value) {
                                                                                    if ($key == 'food_freq') { ?>
                                                                                        <option <?php echo ($value == '6') ? 'selected ="TRUE"' : ''; ?>value="6">6</option>
                                                                                        <option <?php echo ($value == '5') ? 'selected ="TRUE"' : ''; ?>value="5">5</option>
                                                                                        <option <?php echo ($value == '4') ? 'selected ="TRUE"' : ''; ?>value="4">4</option>
                                                                                        <option <?php echo ($value == '3') ? 'selected ="TRUE"' : ''; ?>value="3">3</option>
                                                                                        <option <?php echo ($value == '2') ? 'selected ="TRUE"' : ''; ?>value="2">2</option>
                                                                                        <option <?php echo ($value == '1') ? 'selected ="TRUE"' : ''; ?>value="1">1</option>
                                                                                 <?php }
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                    </div>

                                                                    <div class="row clearfix">
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group">
                                                                                <label> What are the composition of your food</label>
                                                                                <br/>
                                                                                <?php
                                                                                foreach($data as $key => $value) {
                                                                                    if ($key == 'food_comp') {
                                                                                        $decoded = json_decode($value);
                                                                                        foreach ($decoded as $item) {
                                                                                            $sel = "";
                                                                                            if (in_array($item, $decoded)) {
                                                                                                $sel = "checked='checked'";
                                                                                            } else {
                                                                                                $sel = "";
                                                                                            }
                                                                                            ?>
                                                                                            <label class="fancy-checkbox">
                                                                                                <input type="checkbox" name="ipd_service[]" value="<?php echo $item ?>" data-parsley-errors-container="#error-checkbox" <?= $sel ?>>
                                                                                                <span><?php echo $item ?></span>
                                                                                            </label>
                                                                                            <?php
                                                                                        }

                                                                                    }
                                                                                }
                                                                                ?>
                                                                                <p id="error-checkbox"></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>



                                                                    <hr/>
                                                                    <h6><b>ELIMINATION</b></h6>

                                                                    <div class="row clearfix">

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> How often do you defecate daily </label>
                                                                                <select class="form-control" id="defecate" name="defecate" >
                                                                                    <option value=""></option>
                                                                                    <?php
                                                                                    foreach($data as $key => $value) {
                                                                                        if ($key == 'defecate') { ?>
                                                                                            <option <?php echo ($value == '6') ? 'selected ="TRUE"' : ''; ?>value="6">6</option>
                                                                                            <option <?php echo ($value == '5') ? 'selected ="TRUE"' : ''; ?>value="5">5</option>
                                                                                            <option <?php echo ($value == '4') ? 'selected ="TRUE"' : ''; ?>value="4">4</option>
                                                                                            <option <?php echo ($value == '3') ? 'selected ="TRUE"' : ''; ?>value="3">3</option>
                                                                                            <option <?php echo ($value == '2') ? 'selected ="TRUE"' : ''; ?>value="2">2</option>
                                                                                            <option <?php echo ($value == '1') ? 'selected ="TRUE"' : ''; ?>value="1">1</option>
                                                                                        <?php }
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> How often do you urinate daily </label>
                                                                                <select class="form-control" id="urinate" name="urinate" >
                                                                                    <option value=""></option>
                                                                                    <?php
                                                                                    foreach($data as $key => $value) {
                                                                                        if ($key == 'urinate') { ?>
                                                                                            <option <?php echo ($value == '6') ? 'selected ="TRUE"' : ''; ?>value="6">6</option>
                                                                                            <option <?php echo ($value == '5') ? 'selected ="TRUE"' : ''; ?>value="5">5</option>
                                                                                            <option <?php echo ($value == '4') ? 'selected ="TRUE"' : ''; ?>value="4">4</option>
                                                                                            <option <?php echo ($value == '3') ? 'selected ="TRUE"' : ''; ?>value="3">3</option>
                                                                                            <option <?php echo ($value == '2') ? 'selected ="TRUE"' : ''; ?>value="2">2</option>
                                                                                            <option <?php echo ($value == '1') ? 'selected ="TRUE"' : ''; ?>value="1">1</option>
                                                                                        <?php }
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">

                                                                        </div>
                                                                    </div>

                                                                    <div class="row clearfix">
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Do you urinate at night? </label>
                                                                                <br/>
                                                                                <?php
                                                                                foreach($data as $key => $value) {
                                                                                    if ($key == 'urinate_nite') {
                                                                                        $yes = "";
                                                                                        $no = "";
                                                                                        if ($value == "Yes") {
                                                                                            $yes = "checked='checked'";
                                                                                            $no = "";
                                                                                        } else if ($value == "No") {
                                                                                            $no = "checked='checked'";
                                                                                        }
                                                                                    }
                                                                                }
                                                                                ?>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio"  value="Yes" <?= $yes ?>
                                                                                           data-parsley-errors-container="#error-radio">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio"  value="No" <?= $no ?> >
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label>If yes, how many times?</label>
                                                                                <select class="form-control" id="urinate_times" name="urinate_times" >
                                                                                    <option value=""></option>
                                                                                    <?php
                                                                                    foreach($data as $key => $value) {
                                                                                        if ($key == 'urinate_times') { ?>
                                                                                            <option <?php echo ($value == '6') ? 'selected ="TRUE"' : ''; ?>value="6">6</option>
                                                                                            <option <?php echo ($value == '5') ? 'selected ="TRUE"' : ''; ?>value="5">5</option>
                                                                                            <option <?php echo ($value == '4') ? 'selected ="TRUE"' : ''; ?>value="4">4</option>
                                                                                            <option <?php echo ($value == '3') ? 'selected ="TRUE"' : ''; ?>value="3">3</option>
                                                                                            <option <?php echo ($value == '2') ? 'selected ="TRUE"' : ''; ?>value="2">2</option>
                                                                                            <option <?php echo ($value == '1') ? 'selected ="TRUE"' : ''; ?>value="1">1</option>
                                                                                        <?php }
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label> Is it dependent on diet? </label>
                                                                            <br/>
                                                                            <?php
                                                                            foreach($data as $key => $value) {
                                                                                if ($key == 'urinate_dep') {
                                                                                    $yes = "";
                                                                                    $no = "";
                                                                                    if ($value == "Yes") {
                                                                                        $yes = "checked='checked'";
                                                                                        $no = "";
                                                                                    } else if ($value == "No") {
                                                                                        $no = "checked='checked'";
                                                                                    }
                                                                                }
                                                                            }
                                                                            ?>
                                                                            <label class="fancy-radio">
                                                                                <input type="radio"  value="Yes" <?= $yes ?>
                                                                                       data-parsley-errors-container="#error-radio">
                                                                                <span><i></i>Yes</span>
                                                                            </label>
                                                                            <label class="fancy-radio">
                                                                                <input type="radio"  value="No" <?= $no ?> >
                                                                                <span><i></i>No</span>
                                                                            </label>
                                                                            <p id="error-radio"></p>
                                                                        </div>
                                                                    </div>

                                                                    <hr/>
                                                                    <h6><b>ACTIVITY/EXERCISE</b></h6>

                                                                    <div class="row clearfix">
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Do you engage in active exercise? </label>
                                                                                <br/>
                                                                                <?php
                                                                                foreach($data as $key => $value) {
                                                                                    if ($key == 'exercise') {
                                                                                        $yes = "";
                                                                                        $no = "";
                                                                                        if ($value == "Yes") {
                                                                                            $yes = "checked='checked'";
                                                                                            $no = "";
                                                                                        } else if ($value == "No") {
                                                                                            $no = "checked='checked'";
                                                                                        }
                                                                                    }
                                                                                }
                                                                                ?>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio"  value="Yes" <?= $yes ?>
                                                                                           data-parsley-errors-container="#error-radio">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio"  value="No" <?= $no ?> >
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label>If yes, what type?</label>
                                                                                <select class="form-control" id="urinate_times" name="urinate_times" >
                                                                                    <option value=""></option>
                                                                                    <?php
                                                                                    foreach($data as $key => $value) {
                                                                                        if ($key == 'exercise_type') { ?>
                                                                                            <option <?php echo ($value == 'Early morning walk') ? 'selected ="TRUE"' : ''; ?>value="Early morning walk">Early morning walk</option>
                                                                                            <option <?php echo ($value == 'Jogging around the house of far a distance') ? 'selected ="TRUE"' : ''; ?>value="Jogging around the house of far a distance">Jogging around the house of far a distance</option>
                                                                                            <option <?php echo ($value == 'Running') ? 'selected ="TRUE"' : ''; ?>value="Running">Running</option>
                                                                                            <option <?php echo ($value == 'weights') ? 'selected ="TRUE"' : ''; ?>value="weights">weights</option>
                                                                                        <?php }
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label>If Yes, supply</label>
                                                                                <?php
                                                                                foreach($data as $key => $value) {
                                                                                    if ($key == 'exercise_others') {
                                                                                        echo "<input type='text' class='form-control'  value=$value >";
                                                                                    }
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                        </div>


                                                                    </div>

                                                                    <hr/>
                                                                    <h6><b>SLEEP & REST</b></h6>

                                                                    <div class="row clearfix">
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> How many hours do you sleep at night? </label>
                                                                                <select class="form-control" id="sleep_time" name="sleep_time" >
                                                                                    <option value=""></option>
                                                                                    <?php
                                                                                    foreach($data as $key => $value) {
                                                                                        if ($key == 'sleep_time') { ?>
                                                                                            <option <?php echo ($value == '14') ? 'selected ="TRUE"' : ''; ?>value="14">14</option>
                                                                                            <option <?php echo ($value == '13') ? 'selected ="TRUE"' : ''; ?>value="13">13</option>
                                                                                            <option <?php echo ($value == '12') ? 'selected ="TRUE"' : ''; ?>value="12">12</option>
                                                                                            <option <?php echo ($value == '11') ? 'selected ="TRUE"' : ''; ?>value="11">11</option>
                                                                                            <option <?php echo ($value == '10') ? 'selected ="TRUE"' : ''; ?>value="10">10</option>
                                                                                            <option <?php echo ($value == '9') ? 'selected ="TRUE"' : ''; ?>value="9">9</option>
                                                                                            <option <?php echo ($value == '8') ? 'selected ="TRUE"' : ''; ?>value="8">8</option>
                                                                                            <option <?php echo ($value == '7') ? 'selected ="TRUE"' : ''; ?>value="7">7</option>
                                                                                            <option <?php echo ($value == '6') ? 'selected ="TRUE"' : ''; ?>value="6">6</option>
                                                                                            <option <?php echo ($value == '5') ? 'selected ="TRUE"' : ''; ?>value="5">5</option>
                                                                                            <option <?php echo ($value == '4') ? 'selected ="TRUE"' : ''; ?>value="4">4</option>
                                                                                            <option <?php echo ($value == '3') ? 'selected ="TRUE"' : ''; ?>value="3">3</option>
                                                                                            <option <?php echo ($value == '2') ? 'selected ="TRUE"' : ''; ?>value="2">2</option>
                                                                                            <option <?php echo ($value == '1') ? 'selected ="TRUE"' : ''; ?>value="1">1</option>
                                                                                        <?php }
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Do you observe siesta? </label>
                                                                                <br/>
                                                                                <?php
                                                                                foreach($data as $key => $value) {
                                                                                    if ($key == 'siesta') {
                                                                                        $yes = "";
                                                                                        $no = "";
                                                                                        if ($value == "Yes") {
                                                                                            $yes = "checked='checked'";
                                                                                            $no = "";
                                                                                        } else if ($value == "No") {
                                                                                            $no = "checked='checked'";
                                                                                        }
                                                                                    }
                                                                                }
                                                                                ?>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio"  value="Yes" <?= $yes ?>
                                                                                           data-parsley-errors-container="#error-radio">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio"  value="No" <?= $no ?> >
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> If yes, how long in a day? </label>
                                                                                <select class="form-control" id="siesta_time" name="siesta_time" >
                                                                                    <option value=""></option>
                                                                                    <?php
                                                                                    foreach($data as $key => $value) {
                                                                                        if ($key == 'siesta_time') { ?>
                                                                                            <option <?php echo ($value == '10') ? 'selected ="TRUE"' : ''; ?>value="10">10</option>
                                                                                            <option <?php echo ($value == '9') ? 'selected ="TRUE"' : ''; ?>value="9">9</option>
                                                                                            <option <?php echo ($value == '8') ? 'selected ="TRUE"' : ''; ?>value="8">8</option>
                                                                                            <option <?php echo ($value == '7') ? 'selected ="TRUE"' : ''; ?>value="7">7</option>
                                                                                            <option <?php echo ($value == '6') ? 'selected ="TRUE"' : ''; ?>value="6">6</option>
                                                                                            <option <?php echo ($value == '5') ? 'selected ="TRUE"' : ''; ?>value="5">5</option>
                                                                                            <option <?php echo ($value == '4') ? 'selected ="TRUE"' : ''; ?>value="4">4</option>
                                                                                            <option <?php echo ($value == '3') ? 'selected ="TRUE"' : ''; ?>value="3">3</option>
                                                                                            <option <?php echo ($value == '2') ? 'selected ="TRUE"' : ''; ?>value="2">2</option>
                                                                                            <option <?php echo ($value == '1') ? 'selected ="TRUE"' : ''; ?>value="1">1</option>
                                                                                        <?php }
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row clearfix">
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Do you use any sleeping aid? </label>
                                                                                <br/>
                                                                                <?php
                                                                                foreach($data as $key => $value) {
                                                                                    if ($key == 'sleep_aid') {
                                                                                        $yes = "";
                                                                                        $no = "";
                                                                                        if ($value == "Yes") {
                                                                                            $yes = "checked='checked'";
                                                                                            $no = "";
                                                                                        } else if ($value == "No") {
                                                                                            $no = "checked='checked'";
                                                                                        }
                                                                                    }
                                                                                }
                                                                                ?>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio"  value="Yes" <?= $yes ?>
                                                                                           data-parsley-errors-container="#error-radio">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio"  value="No" <?= $no ?> >
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label>If Yes, supply</label>
                                                                                <?php
                                                                                foreach($data as $key => $value) {
                                                                                    if ($key == 'sleep_aid_type') {
                                                                                        echo "<input type='text' class='form-control'  value=$value >";
                                                                                    }
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4"></div>

                                                                    </div>

                                                                    <hr/>
                                                                    <h6><b>COMMUNICATION/SPECIAL SENSES</b></h6>

                                                                    <div class="row clearfix">
                                                                        <div class="col-sm-8">

                                                                            <div class="form-group">
                                                                                <label> What languages do you communicate with people with fluently?</label>
                                                                                <br/>
                                                                                <?php
                                                                                foreach($data as $key => $value) {
                                                                                    if ($key == 'lang') {
                                                                                        $decoded = json_decode($value);
                                                                                        foreach ($decoded as $item) {
                                                                                            $sel = "";
                                                                                            if (in_array($item, $decoded)) {
                                                                                                $sel = "checked='checked'";
                                                                                            } else {
                                                                                                $sel = "";
                                                                                            }
                                                                                            ?>
                                                                                            <label class="fancy-checkbox">
                                                                                                <input type="checkbox"  value="<?php echo $item ?>" data-parsley-errors-container="#error-checkbox" <?= $sel ?>>
                                                                                                <span><?php echo $item ?></span>
                                                                                            </label>
                                                                                            <?php
                                                                                        }

                                                                                    }
                                                                                }
                                                                                ?>
                                                                                <p id="error-checkbox"></p>
                                                                            </div>

                                                                        </div>
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label>Other languages, specify</label>
                                                                                <?php
                                                                                foreach($data as $key => $value) {
                                                                                    if ($key == 'other_lang') {
                                                                                        echo "<input type='text' class='form-control'  value=$value >";
                                                                                    }
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row clearfix">
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Do you use a pair of glasses for sight?</label>
                                                                                <br/>
                                                                                <?php
                                                                                foreach($data as $key => $value) {
                                                                                    if ($key == 'sight') {
                                                                                        $yes = "";
                                                                                        $no = "";
                                                                                        if ($value == "Yes") {
                                                                                            $yes = "checked='checked'";
                                                                                            $no = "";
                                                                                        } else if ($value == "No") {
                                                                                            $no = "checked='checked'";
                                                                                        }
                                                                                    }
                                                                                }
                                                                                ?>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio"  value="Yes" <?= $yes ?>
                                                                                           data-parsley-errors-container="#error-radio">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio"  value="No" <?= $no ?> >
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Any use of hearing aid?</label>
                                                                                <br/>
                                                                                <?php
                                                                                foreach($data as $key => $value) {
                                                                                    if ($key == 'hearing') {
                                                                                        $yes = "";
                                                                                        $no = "";
                                                                                        if ($value == "Yes") {
                                                                                            $yes = "checked='checked'";
                                                                                            $no = "";
                                                                                        } else if ($value == "No") {
                                                                                            $no = "checked='checked'";
                                                                                        }
                                                                                    }
                                                                                }
                                                                                ?>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio"  value="Yes" <?= $yes ?>
                                                                                           data-parsley-errors-container="#error-radio">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio"  value="No" <?= $no ?> >
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Do you have sense of taste?</label>
                                                                                <br/>
                                                                                <?php
                                                                                foreach($data as $key => $value) {
                                                                                    if ($key == 'taste') {
                                                                                        $yes = "";
                                                                                        $no = "";
                                                                                        if ($value == "Yes") {
                                                                                            $yes = "checked='checked'";
                                                                                            $no = "";
                                                                                        } else if ($value == "No") {
                                                                                            $no = "checked='checked'";
                                                                                        }
                                                                                    }
                                                                                }
                                                                                ?>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio"  value="Yes" <?= $yes ?>
                                                                                           data-parsley-errors-container="#error-radio">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio"  value="No" <?= $no ?> >
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row clearfix">
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Do you perceive odour?</label>
                                                                                <br/>
                                                                                <?php
                                                                                foreach($data as $key => $value) {
                                                                                    if ($key == 'odour') {
                                                                                        $yes = "";
                                                                                        $no = "";
                                                                                        if ($value == "Yes") {
                                                                                            $yes = "checked='checked'";
                                                                                            $no = "";
                                                                                        } else if ($value == "No") {
                                                                                            $no = "checked='checked'";
                                                                                        }
                                                                                    }
                                                                                }
                                                                                ?>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio"  value="Yes" <?= $yes ?>
                                                                                           data-parsley-errors-container="#error-radio">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio"  value="No" <?= $no ?> >
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>

                                                                    </div>

                                                                    <hr/>
                                                                    <h6><b>FEELING ABOUT SELF/IMAGE</b></h6>

                                                                    <div class="row clearfix">
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Do you feel bad about yourself or illness ?</label>
                                                                                <br/>
                                                                                <?php
                                                                                foreach($data as $key => $value) {
                                                                                    if ($key == 'self') {
                                                                                        $yes = "";
                                                                                        $no = "";
                                                                                        if ($value == "Yes") {
                                                                                            $yes = "checked='checked'";
                                                                                            $no = "";
                                                                                        } else if ($value == "No") {
                                                                                            $no = "checked='checked'";
                                                                                        }
                                                                                    }
                                                                                }
                                                                                ?>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio"  value="Yes" <?= $yes ?>
                                                                                           data-parsley-errors-container="#error-radio">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio"  value="No" <?= $no ?> >
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label>Do you feel disturbed about yourself or illness ?</label>
                                                                                <br/>
                                                                                <?php
                                                                                foreach($data as $key => $value) {
                                                                                    if ($key == 'disturb') {
                                                                                        $yes = "";
                                                                                        $no = "";
                                                                                        if ($value == "Yes") {
                                                                                            $yes = "checked='checked'";
                                                                                            $no = "";
                                                                                        } else if ($value == "No") {
                                                                                            $no = "checked='checked'";
                                                                                        }
                                                                                    }
                                                                                }
                                                                                ?>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio"  value="Yes" <?= $yes ?>
                                                                                           data-parsley-errors-container="#error-radio">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio"  value="No" <?= $no ?> >
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Do you feel optimistic about your state of health?</label>
                                                                                <br/>
                                                                                <?php
                                                                                foreach($data as $key => $value) {
                                                                                    if ($key == 'optimism') {
                                                                                        $yes = "";
                                                                                        $no = "";
                                                                                        if ($value == "Yes") {
                                                                                            $yes = "checked='checked'";
                                                                                            $no = "";
                                                                                        } else if ($value == "No") {
                                                                                            $no = "checked='checked'";
                                                                                        }
                                                                                    }
                                                                                }
                                                                                ?>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio"  value="Yes" <?= $yes ?>
                                                                                           data-parsley-errors-container="#error-radio">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio"  value="No" <?= $no ?> >
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row clearfix">
                                                                        <div class="col-sm-8">
                                                                            <div class="form-group">
                                                                                <label> Do you feel depressed about your present health condition?</label>
                                                                                <br/>
                                                                                <?php
                                                                                foreach($data as $key => $value) {
                                                                                    if ($key == 'depressed') {
                                                                                        $yes = "";
                                                                                        $no = "";
                                                                                        if ($value == "Yes") {
                                                                                            $yes = "checked='checked'";
                                                                                            $no = "";
                                                                                        } else if ($value == "No") {
                                                                                            $no = "checked='checked'";
                                                                                        }
                                                                                    }
                                                                                }
                                                                                ?>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio"  value="Yes" <?= $yes ?>
                                                                                           data-parsley-errors-container="#error-radio">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio"  value="No" <?= $no ?> >
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label>Others, specify</label>
                                                                                <?php
                                                                                foreach($data as $key => $value) {
                                                                                    if ($key == 'other_feeling') {
                                                                                        echo "<input type='text' class='form-control'  value=$value >";
                                                                                    }
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                        </div>


                                                                    </div>

                                                                    <hr/>
                                                                    <h6><b>FAMILY /SOCIAL RELATIONSHIP</b></h6>

                                                                    <div class="row clearfix">
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Marital Status </label>
                                                                                <select class="form-control" id="marital" name="marital" >
                                                                                    <option value=""></option>
                                                                                    <?php
                                                                                    foreach($data as $key => $value) {
                                                                                        if ($key == 'marital') { ?>
                                                                                            <option <?php echo ($value == 'Single') ? 'selected ="TRUE"' : ''; ?>value="Single">Single</option>
                                                                                            <option <?php echo ($value == 'Married') ? 'selected ="TRUE"' : ''; ?>value="Married">Married</option>
                                                                                            <option <?php echo ($value == 'Widow/Widower') ? 'selected ="TRUE"' : ''; ?>value="Widow/Widower">Widow/Widower</option>
                                                                                            <option <?php echo ($value == 'Separated') ? 'selected ="TRUE"' : ''; ?>value="Separated">Separated</option>
                                                                                            <option <?php echo ($value == 'Divorced') ? 'selected ="TRUE"' : ''; ?>value="Divorced">Divorced</option>
                                                                                            <option <?php echo ($value == 'Single Parent') ? 'selected ="TRUE"' : ''; ?>value="Single Parent">Single Parent</option>
                                                                                        <?php }
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Type Of Family </label>
                                                                                <select class="form-control" id="family" name="family" >
                                                                                    <option value=""></option>
                                                                                    <?php
                                                                                    foreach($data as $key => $value) {
                                                                                        if ($key == 'family') { ?>
                                                                                            <option <?php echo ($value == 'Nuclear') ? 'selected ="TRUE"' : ''; ?>value="Nuclear">Nuclear</option>
                                                                                            <option <?php echo ($value == 'Extend') ? 'selected ="TRUE"' : ''; ?>value="Extend">Extend</option>
                                                                                            <option <?php echo ($value == 'Monogamous') ? 'selected ="TRUE"' : ''; ?>value="Monogamous">Monogamous</option>
                                                                                            <option <?php echo ($value == 'Polygamous') ? 'selected ="TRUE"' : ''; ?>value="Polygamous">Polygamous</option>
                                                                                        <?php }
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Do you relate well with siblings, friends, family members and at work?</label>
                                                                                <br/>
                                                                                <?php
                                                                                foreach($data as $key => $value) {
                                                                                    if ($key == 'relate') {
                                                                                        $yes = "";
                                                                                        $no = "";
                                                                                        if ($value == "Yes") {
                                                                                            $yes = "checked='checked'";
                                                                                            $no = "";
                                                                                        } else if ($value == "No") {
                                                                                            $no = "checked='checked'";
                                                                                        }
                                                                                    }
                                                                                }
                                                                                ?>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio"  value="Yes" <?= $yes ?>
                                                                                           data-parsley-errors-container="#error-radio">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio"  value="No" <?= $no ?> >
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>

                                                                    </div>

                                                                    <hr/>
                                                                    <h6><b>SEXUALITY/REPRODUCTION</b></h6>

                                                                    <div class="row clearfix">

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Are you sexually active?</label>
                                                                                <br/>
                                                                                <?php
                                                                                foreach($data as $key => $value) {
                                                                                    if ($key == 'sexually') {
                                                                                        $yes = "";
                                                                                        $no = "";
                                                                                        if ($value == "Yes") {
                                                                                            $yes = "checked='checked'";
                                                                                            $no = "";
                                                                                        } else if ($value == "No") {
                                                                                            $no = "checked='checked'";
                                                                                        }
                                                                                    }
                                                                                }
                                                                                ?>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio"  value="Yes" <?= $yes ?>
                                                                                           data-parsley-errors-container="#error-radio">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio"  value="No" <?= $no ?> >
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Married with children?</label>
                                                                                <br/>
                                                                                <?php
                                                                                foreach($data as $key => $value) {
                                                                                    if ($key == 'married') {
                                                                                        $yes = "";
                                                                                        $no = "";
                                                                                        if ($value == "Yes") {
                                                                                            $yes = "checked='checked'";
                                                                                            $no = "";
                                                                                        } else if ($value == "No") {
                                                                                            $no = "checked='checked'";
                                                                                        }
                                                                                    }
                                                                                }
                                                                                ?>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio"  value="Yes" <?= $yes ?>
                                                                                           data-parsley-errors-container="#error-radio">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio"  value="No" <?= $no ?> >
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> How many children </label>
                                                                                <select class="form-control" id="children" name="children" >
                                                                                    <option value=""></option>
                                                                                    <?php
                                                                                    foreach($data as $key => $value) {
                                                                                        if ($key == 'children') { ?>
                                                                                            <option <?php echo ($value == '10') ? 'selected ="TRUE"' : ''; ?>value="10">10</option>
                                                                                            <option <?php echo ($value == '9') ? 'selected ="TRUE"' : ''; ?>value="9">9</option>
                                                                                            <option <?php echo ($value == '8') ? 'selected ="TRUE"' : ''; ?>value="8">8</option>
                                                                                            <option <?php echo ($value == '7') ? 'selected ="TRUE"' : ''; ?>value="7">7</option>
                                                                                            <option <?php echo ($value == '6') ? 'selected ="TRUE"' : ''; ?>value="6">6</option>
                                                                                            <option <?php echo ($value == '5') ? 'selected ="TRUE"' : ''; ?>value="5">5</option>
                                                                                            <option <?php echo ($value == '4') ? 'selected ="TRUE"' : ''; ?>value="4">4</option>
                                                                                            <option <?php echo ($value == '3') ? 'selected ="TRUE"' : ''; ?>value="3">3</option>
                                                                                            <option <?php echo ($value == '2') ? 'selected ="TRUE"' : ''; ?>value="2">2</option>
                                                                                            <option <?php echo ($value == '1') ? 'selected ="TRUE"' : ''; ?>value="1">1</option>
                                                                                        <?php }
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                    </div>

                                                                    <div class="row clearfix">
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Parity </label>
                                                                                <select class="form-control" id="parity" name="parity" >
                                                                                    <option value=""></option>
                                                                                    <?php
                                                                                    foreach($data as $key => $value) {
                                                                                        if ($key == 'parity') { ?>
                                                                                            <option <?php echo ($value == '10') ? 'selected ="TRUE"' : ''; ?>value="10">10</option>
                                                                                            <option <?php echo ($value == '9') ? 'selected ="TRUE"' : ''; ?>value="9">9</option>
                                                                                            <option <?php echo ($value == '8') ? 'selected ="TRUE"' : ''; ?>value="8">8</option>
                                                                                            <option <?php echo ($value == '7') ? 'selected ="TRUE"' : ''; ?>value="7">7</option>
                                                                                            <option <?php echo ($value == '6') ? 'selected ="TRUE"' : ''; ?>value="6">6</option>
                                                                                            <option <?php echo ($value == '5') ? 'selected ="TRUE"' : ''; ?>value="5">5</option>
                                                                                            <option <?php echo ($value == '4') ? 'selected ="TRUE"' : ''; ?>value="4">4</option>
                                                                                            <option <?php echo ($value == '3') ? 'selected ="TRUE"' : ''; ?>value="3">3</option>
                                                                                            <option <?php echo ($value == '2') ? 'selected ="TRUE"' : ''; ?>value="2">2</option>
                                                                                            <option <?php echo ($value == '1') ? 'selected ="TRUE"' : ''; ?>value="1">1</option>
                                                                                        <?php }
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Gravida </label>
                                                                                <select class="form-control" id="gravida" name="gravida" >
                                                                                    <option value=""></option>
                                                                                    <?php
                                                                                    foreach($data as $key => $value) {
                                                                                        if ($key == 'gravida') { ?>
                                                                                            <option <?php echo ($value == '10') ? 'selected ="TRUE"' : ''; ?>value="10">10</option>
                                                                                            <option <?php echo ($value == '9') ? 'selected ="TRUE"' : ''; ?>value="9">9</option>
                                                                                            <option <?php echo ($value == '8') ? 'selected ="TRUE"' : ''; ?>value="8">8</option>
                                                                                            <option <?php echo ($value == '7') ? 'selected ="TRUE"' : ''; ?>value="7">7</option>
                                                                                            <option <?php echo ($value == '6') ? 'selected ="TRUE"' : ''; ?>value="6">6</option>
                                                                                            <option <?php echo ($value == '5') ? 'selected ="TRUE"' : ''; ?>value="5">5</option>
                                                                                            <option <?php echo ($value == '4') ? 'selected ="TRUE"' : ''; ?>value="4">4</option>
                                                                                            <option <?php echo ($value == '3') ? 'selected ="TRUE"' : ''; ?>value="3">3</option>
                                                                                            <option <?php echo ($value == '2') ? 'selected ="TRUE"' : ''; ?>value="2">2</option>
                                                                                            <option <?php echo ($value == '1') ? 'selected ="TRUE"' : ''; ?>value="1">1</option>
                                                                                        <?php }
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                    </div>

                                                                    <div class="row clearfix">
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label>For Females, Age at Menarche</label>
                                                                                <?php
                                                                                foreach($data as $key => $value) {
                                                                                    if ($key == 'menache') {
                                                                                        echo "<input type='text' class='form-control'  value=$value >";
                                                                                    }
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label>Age at Menopause</label>
                                                                                <?php
                                                                                foreach($data as $key => $value) {
                                                                                    if ($key == 'menopause') {
                                                                                        echo "<input type='text' class='form-control'  value=$value >";
                                                                                    }
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                        </div>

                                                                    </div>

                                                                    <hr/>
                                                                    <h6><b>COPING WITH STRESS</b></h6>

                                                                    <div class="row clearfix">

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label>When stressed, how do you react? </label>
                                                                                <select class="form-control" id="stress" name="stress" >
                                                                                    <option value=""></option>
                                                                                    <?php
                                                                                    foreach($data as $key => $value) {
                                                                                        if ($key == 'stress') { ?>
                                                                                            <option <?php echo ($value == 'Agitated') ? 'selected ="TRUE"' : ''; ?>value="Agitated">Agitated</option>
                                                                                            <option <?php echo ($value == 'Anxious') ? 'selected ="TRUE"' : ''; ?>value="Anxious">Anxious</option>
                                                                                            <option <?php echo ($value == 'Demanding') ? 'selected ="TRUE"' : ''; ?>value="Demanding">Demanding</option>
                                                                                            <option <?php echo ($value == 'Calm') ? 'selected ="TRUE"' : ''; ?>value="Calm">Calm</option>
                                                                                            <option <?php echo ($value == 'Withdrawn') ? 'selected ="TRUE"' : ''; ?>value="Withdrawn">Withdrawn</option>
                                                                                            <option <?php echo ($value == 'Irritable') ? 'selected ="TRUE"' : ''; ?>value="Irritable">Irritable</option>
                                                                                            <option <?php echo ($value == 'Fearful') ? 'selected ="TRUE"' : ''; ?>value="Fearful">Fearful</option>
                                                                                            <option <?php echo ($value == 'Sleeps') ? 'selected ="TRUE"' : ''; ?>value="Sleeps">Sleeps</option>
                                                                                            <option <?php echo ($value == 'Cries') ? 'selected ="TRUE"' : ''; ?>value="Cries">Cries</option>
                                                                                            <option <?php echo ($value == 'Speak Out') ? 'selected ="TRUE"' : ''; ?>value="Speak Out">Speak Out</option>
                                                                                            <option <?php echo ($value == 'Shout') ? 'selected ="TRUE"' : ''; ?>value="Shout">Shout</option>
                                                                                            <option <?php echo ($value == 'Murmur') ? 'selected ="TRUE"' : ''; ?>value="Murmur">Murmur</option>
                                                                                        <?php }
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> How do you cope with stress? </label>
                                                                                <select class="form-control" id="stress_coping" name="stress_coping" >
                                                                                    <option value=""></option>
                                                                                    <?php
                                                                                    foreach($data as $key => $value) {
                                                                                        if ($key == 'stress_coping') { ?>
                                                                                            <option <?php echo ($value == 'Sleeps') ? 'selected ="TRUE"' : ''; ?>value="Sleeps">Sleeps</option>
                                                                                            <option <?php echo ($value == 'Eats') ? 'selected ="TRUE"' : ''; ?>value="Eats">Eats</option>
                                                                                            <option <?php echo ($value == 'Listen to music') ? 'selected ="TRUE"' : ''; ?>value="Listen to music">Listen to music</option>
                                                                                            <option <?php echo ($value == 'Pray') ? 'selected ="TRUE"' : ''; ?>value="Pray">Pray</option>
                                                                                            <option <?php echo ($value == 'Take a walk') ? 'selected ="TRUE"' : ''; ?>value="Take a walk">Take a walk</option>
                                                                                            <option <?php echo ($value == 'Read') ? 'selected ="TRUE"' : ''; ?>value="Read">Read</option>
                                                                                            <option <?php echo ($value == 'Discuss') ? 'selected ="TRUE"' : ''; ?>value="Discuss">Discuss</option>
                                                                                        <?php }
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <hr/>
                                                                    <h6><b>VALUES AND BELIEF</b></h6>
                                                                    <div class="row clearfix">
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label>What do you value?</label>
                                                                                <?php
                                                                                foreach($data as $key => $value) {
                                                                                    if ($key == 'value') {
                                                                                        echo "<input type='text' class='form-control'  value=$value >";
                                                                                    }
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label>What do you belief(your religion)?</label>
                                                                                <?php
                                                                                foreach($data as $key => $value) {
                                                                                    if ($key == 'belief') {
                                                                                        echo "<input type='text' class='form-control'  value=$value >";
                                                                                    }
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                        </div>

                                                                    </div>

                                                                    <hr/>
                                                                    <h6><b>OTHER INFORMATION</b></h6>
                                                                    <div class="row clearfix">

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label>Habits</label>
                                                                                <?php
                                                                                foreach($data as $key => $value) {
                                                                                    if ($key == 'habits') {
                                                                                        echo "<input type='text' class='form-control'  value=$value >";
                                                                                    }
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Do you smoke?</label>
                                                                                <br/>
                                                                                <?php
                                                                                foreach($data as $key => $value) {
                                                                                    if ($key == 'smoke') {
                                                                                        $yes = "";
                                                                                        $no = "";
                                                                                        if ($value == "Yes") {
                                                                                            $yes = "checked='checked'";
                                                                                            $no = "";
                                                                                        } else if ($value == "No") {
                                                                                            $no = "checked='checked'";
                                                                                        }
                                                                                    }
                                                                                }
                                                                                ?>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio"  value="Yes" <?= $yes ?>
                                                                                           data-parsley-errors-container="#error-radio">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio"  value="No" <?= $no ?> >
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Do you drink alcohol?</label>
                                                                                <br/>
                                                                                <?php
                                                                                foreach($data as $key => $value) {
                                                                                    if ($key == 'alcohol') {
                                                                                        $yes = "";
                                                                                        $no = "";
                                                                                        if ($value == "Yes") {
                                                                                            $yes = "checked='checked'";
                                                                                            $no = "";
                                                                                        } else if ($value == "No") {
                                                                                            $no = "checked='checked'";
                                                                                        }
                                                                                    }
                                                                                }
                                                                                ?>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio"  value="Yes" <?= $yes ?>
                                                                                           data-parsley-errors-container="#error-radio">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio"  value="No" <?= $no ?> >
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>




                                                                    </div>

                                                                    <div class="row clearfix">
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Do you take hard drugs?</label>
                                                                                <br/>
                                                                                <?php
                                                                                foreach($data as $key => $value) {
                                                                                    if ($key == 'hard_drugs') {
                                                                                        $yes = "";
                                                                                        $no = "";
                                                                                        if ($value == "Yes") {
                                                                                            $yes = "checked='checked'";
                                                                                            $no = "";
                                                                                        } else if ($value == "No") {
                                                                                            $no = "checked='checked'";
                                                                                        }
                                                                                    }
                                                                                }
                                                                                ?>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio"  value="Yes" <?= $yes ?>
                                                                                           data-parsley-errors-container="#error-radio">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio"  value="No" <?= $no ?> >
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>


                                                                    </div>

                                                                    <h5>Nursing History done by <?php echo $nHistory->done_by ?></h5>
                                                                 <!--   <button type="submit" name="nursing_history" class="btn btn-primary">Save Nursing History
                                                                    </button>-->

                                                                </form>

                                                            <?php  } else {  ?>
                                                                <form method="post" action="">


                                                                    <h6><b>PAST</b></h6>
                                                                    <div class="row clearfix">
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> History Of Hospitalization </label>
                                                                                <br/>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="history_hosp" value="Yes"
                                                                                           data-parsley-errors-container="#error-radio">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="history_hosp" value="No">
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label>If Yes, Where and When</label>
                                                                                <input type="text" class="form-control" name="hosp_where" value="" >
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4"></div>

                                                                    </div>

                                                                    <div class="row clearfix">
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Any Surgery </label>
                                                                                <br/>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="any_surgery" value="Yes"
                                                                                           data-parsley-errors-container="#error-radio">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="any_surgery" value="No">
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label>If Yes, What type of surgery</label>
                                                                                <input type="text" class="form-control" name="surgery_type" value="" >
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label>If Yes, Where and When</label>
                                                                                <input type="text" class="form-control" name="surgery_where" value="" >
                                                                            </div>
                                                                        </div>

                                                                    </div>

                                                                    <div class="row clearfix">
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> History of blood transfusion </label>
                                                                                <br/>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="blood_trans" value="Yes"
                                                                                           data-parsley-errors-container="#error-radio">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="blood_trans" value="No">
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                        </div>

                                                                    </div>

                                                                    <div class="row clearfix">
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Any Underlying Medical and Surgical History </label>
                                                                                <br/>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="med_surg_hist" value="Yes"
                                                                                           data-parsley-errors-container="#error-radio">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="med_surg_hist" value="No">
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label>If Yes, What type</label>
                                                                                <input type="text" class="form-control" name="med_surg_hist_type" value="" >
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                        </div>

                                                                    </div>

                                                                    <div class="row clearfix">
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> On any routine drug </label>
                                                                                <br/>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="rout_drug" value="Yes"
                                                                                           data-parsley-errors-container="#error-radio">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="rout_drug" value="No">
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label>If Yes, name them</label>
                                                                                <input type="text" class="form-control" name="rout_drug_name" value="" >
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                        </div>
                                                                    </div>

                                                                    <hr/>
                                                                    <h6><b>PRESENT</b></h6>

                                                                    <textarea class="form-control" name="present"
                                                                              rows="7" cols="60"></textarea>

                                                                    <hr/>
                                                                    <h6><b>NUTRITION</b></h6>

                                                                    <div class="row clearfix">
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label>Nutritional Pattern - Increased </label>
                                                                                <br/>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="nut_inc" value="Yes"
                                                                                           data-parsley-errors-container="#error-radio">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="nut_inc" value="No">
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Decreased </label>
                                                                                <br/>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="nut_dec" value="Yes"
                                                                                           data-parsley-errors-container="#error-radio">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="nut_dec" value="No">
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Normal </label>
                                                                                <br/>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="nut_norm" value="Yes"
                                                                                           data-parsley-errors-container="#error-radio">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="nut_norm" value="No">
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row clearfix">
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Any Food Allergy</label>
                                                                                <br/>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="food_allergy" value="Yes"
                                                                                           data-parsley-errors-container="#error-radio">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="food_allergy" value="No">
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label>If Yes, supply</label>
                                                                                <input type="text" class="form-control" name="food_allergies" value="" >
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                        </div>

                                                                    </div>

                                                                    <div class="row clearfix">
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Any Food Preference</label>
                                                                                <br/>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="food_pref" value="Yes"
                                                                                           data-parsley-errors-container="#error-radio">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="food_pref" value="No">
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label>If Yes, supply</label>
                                                                                <input type="text" class="form-control" name="food_preferences" value="" >
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                        </div>

                                                                    </div>

                                                                    <div class="row clearfix">
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Any Food taboo</label>
                                                                                <br/>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="food_tab" value="Yes"
                                                                                           data-parsley-errors-container="#error-radio">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="food_tab" value="No">
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label>If Yes, supply</label>
                                                                                <input type="text" class="form-control" name="food_taboo" value="" >
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label>How many times do you eat in a day?</label>
                                                                                <select class="form-control" id="food_freq" name="food_freq" >
                                                                                    <option value="">--Select--</option>
                                                                                    <option value="6">6</option>
                                                                                    <option value="5">5</option>
                                                                                    <option value="4">4</option>
                                                                                    <option value="3">3</option>
                                                                                    <option value="2">2</option>
                                                                                    <option value="1">1</option>

                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                    </div>

                                                                    <div class="row clearfix">
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group">
                                                                                <label> What are the composition of your food</label>
                                                                                <br/>
                                                                                <label class="fancy-checkbox">
                                                                                    <input type="checkbox" name="food_comp[]" value="Carbohydrate"
                                                                                           data-parsley-errors-container="#error-radio">
                                                                                    <span><i></i>Carbohydrate</span>
                                                                                </label>
                                                                                <label class="fancy-checkbox">
                                                                                    <input type="checkbox" name="food_comp[]" value="Protein">
                                                                                    <span><i></i>Protein</span>
                                                                                </label>
                                                                                <label class="fancy-checkbox">
                                                                                    <input type="checkbox" name="food_comp[]" value="Minerals">
                                                                                    <span><i></i>Minerals</span>
                                                                                </label>
                                                                                <label class="fancy-checkbox">
                                                                                    <input type="checkbox" name="food_comp[]" value="Vitamins">
                                                                                    <span><i></i>Vitamins</span>
                                                                                </label>
                                                                                <label class="fancy-checkbox">
                                                                                    <input type="checkbox" name="food_comp[]" value="Fruits">
                                                                                    <span><i></i>Fruits</span>
                                                                                </label>
                                                                                <label class="fancy-checkbox">
                                                                                    <input type="checkbox" name="food_comp[]" value="Balanced Diet">
                                                                                    <span><i></i>Balanced Diet</span>
                                                                                </label>
                                                                                <p id="error-checkbox"></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <hr/>
                                                                    <h6><b>ELIMINATION</b></h6>

                                                                    <div class="row clearfix">
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> How often do you defecate daily </label>
                                                                                <select class="form-control" id="defecate" name="defecate" >
                                                                                    <option value="">--Select--</option>
                                                                                    <option value="6">6</option>
                                                                                    <option value="5">5</option>
                                                                                    <option value="4">4</option>
                                                                                    <option value="3">3</option>
                                                                                    <option value="2">2</option>
                                                                                    <option value="1">1</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> How often do you urinate daily </label>
                                                                                <select class="form-control" id="urinate" name="urinate" >
                                                                                    <option value="">--Select--</option>
                                                                                    <option value="6">6</option>
                                                                                    <option value="5">5</option>
                                                                                    <option value="4">4</option>
                                                                                    <option value="3">3</option>
                                                                                    <option value="2">2</option>
                                                                                    <option value="1">1</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">

                                                                        </div>
                                                                    </div>

                                                                    <div class="row clearfix">
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Do you urinate at night? </label>
                                                                                <br/>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="urinate_nite" value="Yes"
                                                                                           data-parsley-errors-container="#error-radio">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="urinate_nite" value="No">
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label>If yes, how many times?</label>
                                                                                <select class="form-control" id="urinate_night" name="urinate_times" >
                                                                                    <option value="">--Select--</option>
                                                                                    <option value="6">6</option>
                                                                                    <option value="5">5</option>
                                                                                    <option value="4">4</option>
                                                                                    <option value="3">3</option>
                                                                                    <option value="2">2</option>
                                                                                    <option value="1">1</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label> Is it dependent on diet? </label>
                                                                            <br/>
                                                                            <label class="fancy-radio">
                                                                                <input type="radio" name="urinate_dep" value="Yes"
                                                                                       data-parsley-errors-container="#error-radio">
                                                                                <span><i></i>Yes</span>
                                                                            </label>
                                                                            <label class="fancy-radio">
                                                                                <input type="radio" name="urinate_dep" value="No">
                                                                                <span><i></i>No</span>
                                                                            </label>
                                                                            <p id="error-radio"></p>
                                                                        </div>
                                                                    </div>

                                                                    <hr/>
                                                                    <h6><b>ACTIVITY/EXERCISE</b></h6>

                                                                    <div class="row clearfix">
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Do you engage in active exercise? </label>
                                                                                <br/>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="exercise" value="Yes"
                                                                                           data-parsley-errors-container="#error-radio">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="exercise" value="No">
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label>If yes, what type?</label>
                                                                                <select class="form-control" id="exercise_type" name="exercise_type" >
                                                                                    <option value="">--Select--</option>
                                                                                    <option value="Early morning walk">Early morning walk</option>
                                                                                    <option value="Jogging around the house of far a distance">Jogging around the house of far a distance</option>
                                                                                    <option value="Running">Running</option>
                                                                                    <option value="Lifts weights">Lifts weights</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label>Others, specify</label>
                                                                                <input type="text" class="form-control" name="exercise_others" value="" >
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <hr/>
                                                                    <h6><b>SLEEP & REST</b></h6>

                                                                    <div class="row clearfix">
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> How many hours do you sleep at night? </label>
                                                                                <select class="form-control" id="sleep_time" name="sleep_time" >
                                                                                    <option value="">--Select--</option>
                                                                                    <option value="14">14</option>
                                                                                    <option value="13">13</option>
                                                                                    <option value="12">12</option>
                                                                                    <option value="11">11</option>
                                                                                    <option value="10">10</option>
                                                                                    <option value="9">9</option>
                                                                                    <option value="8">8</option>
                                                                                    <option value="7">7</option>
                                                                                    <option value="6">6</option>
                                                                                    <option value="5">5</option>
                                                                                    <option value="4">4</option>
                                                                                    <option value="3">3</option>
                                                                                    <option value="2">2</option>
                                                                                    <option value="1">1</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Do you observe siesta? </label>
                                                                                <br/>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="siesta" value="Yes"
                                                                                           data-parsley-errors-container="#error-radio">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="siesta" value="No">
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> If yes, how long in a day? </label>
                                                                                <select class="form-control" id="sleep_time" name="siesta_time" >
                                                                                    <option value="">--Select--</option>
                                                                                    <option value="10">10</option>
                                                                                    <option value="9">9</option>
                                                                                    <option value="8">8</option>
                                                                                    <option value="7">7</option>
                                                                                    <option value="6">6</option>
                                                                                    <option value="5">5</option>
                                                                                    <option value="4">4</option>
                                                                                    <option value="3">3</option>
                                                                                    <option value="2">2</option>
                                                                                    <option value="1">1</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row clearfix">
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Do you use any sleeping aid? </label>
                                                                                <br/>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="sleep_aid" value="Yes"
                                                                                           data-parsley-errors-container="#error-radio">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="sleep_aid" value="No">
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label>If yes, specify</label>
                                                                                <input type="text" class="form-control" name="sleep_aid_type" value="" >
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-4"></div>

                                                                    </div>

                                                                    <hr/>
                                                                    <h6><b>COMMUNICATION/SPECIAL SENSES</b></h6>

                                                                    <div class="row clearfix">
                                                                        <div class="col-sm-8">
                                                                            <div class="form-group">
                                                                                <label> What languages do you communicate with people with fluently?</label>
                                                                                <br/>
                                                                                <label class="fancy-checkbox">
                                                                                    <input type="checkbox" name="lang[]" value="English"
                                                                                           data-parsley-errors-container="#error-check">
                                                                                    <span><i></i>English</span>
                                                                                </label>
                                                                                <label class="fancy-checkbox">
                                                                                    <input type="checkbox" name="lang[]" value="Yoruba">
                                                                                    <span><i></i>Yoruba</span>
                                                                                </label>
                                                                                <label class="fancy-checkbox">
                                                                                    <input type="checkbox" name="lang[]" value="Hausa">
                                                                                    <span><i></i>Hausa</span>
                                                                                </label>
                                                                                <label class="fancy-checkbox">
                                                                                    <input type="checkbox" name="lang[]" value="Igbo">
                                                                                    <span><i></i>Igbo</span>
                                                                                </label>
                                                                                <p id="error-checkbox"></p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label>Other languages, specify</label>
                                                                                <input type="text" class="form-control" name="other_lang" value="" >
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row clearfix">
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Do you use a pair of glasses for sight?</label>
                                                                                <br/>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="sight" value="Yes"
                                                                                           data-parsley-errors-container="#error-check">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="sight" value="No">
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Any use of hearing aid?</label>
                                                                                <br/>
                                                                                <label class="fancy-checkbox">
                                                                                    <input type="radio" name="hearing" value="Yes"
                                                                                           data-parsley-errors-container="#error-check">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="hearing" value="No">
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Do you have sense of taste?</label>
                                                                                <br/>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="taste" value="Yes"
                                                                                           data-parsley-errors-container="#error-check">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="taste" value="No">
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row clearfix">
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Do you perceive odour?</label>
                                                                                <br/>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="odour" value="Yes"
                                                                                           data-parsley-errors-container="#error-check">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="odour" value="No">
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>

                                                                    </div>

                                                                    <hr/>
                                                                    <h6><b>FEELING ABOUT SELF/IMAGE</b></h6>

                                                                    <div class="row clearfix">
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Do you feel bad about yourself or illness ?</label>
                                                                                <br/>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="self" value="Yes"
                                                                                           data-parsley-errors-container="#error-check">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="self" value="No">
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label>Do you feel disturbed about yourself or illness ?</label>
                                                                                <br/>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="disturb" value="Yes"
                                                                                           data-parsley-errors-container="#error-radio">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="disturb" value="No">
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Do you feel optimistic about your state of health?</label>
                                                                                <br/>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="optimism" value="Yes"
                                                                                           data-parsley-errors-container="#error-radio">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="optimism" value="No">
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row clearfix">
                                                                        <div class="col-sm-8">
                                                                            <div class="form-group">
                                                                                <label> Do you feel depressed about your present health condition?</label>
                                                                                <br/>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="depressed" value="Yes"
                                                                                           data-parsley-errors-container="#error-radio">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="depressed" value="No">
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label>Others, specify</label>
                                                                                <input type="text" class="form-control" name="other_feeling" value="" >
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>

                                                                    </div>

                                                                    <hr/>
                                                                    <h6><b>FAMILY /SOCIAL RELATIONSHIP</b></h6>

                                                                    <div class="row clearfix">
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Marital Status </label>
                                                                                <select class="form-control" id="marital" name="marital" >
                                                                                    <option value="">--Select--</option>
                                                                                    <option value="Single">Single</option>
                                                                                    <option value="Married">Married</option>
                                                                                    <option value="Widow/Widower">Widow/Widower</option>
                                                                                    <option value="Separated">Separated</option>
                                                                                    <option value="Divorced">Divorced</option>
                                                                                    <option value="Single Parent">Single Parent</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Type Of Family </label>
                                                                                <select class="form-control" id="urinate" name="family" >
                                                                                    <option value="">--Select--</option>
                                                                                    <option value="Nuclear">Nuclear</option>
                                                                                    <option value="Extend">Extend</option>
                                                                                    <option value="Monogamous">Monogamous</option>
                                                                                    <option value="Polygamous">Polygamous</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Do you relate well with siblings, friends, family members and at work?</label>
                                                                                <br/>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="relate" value="Yes"
                                                                                           data-parsley-errors-container="#error-radio">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="relate" value="No">
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>

                                                                    </div>

                                                                    <hr/>
                                                                    <h6><b>SEXUALITY/REPRODUCTION</b></h6>

                                                                    <div class="row clearfix">

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Are you sexually active?</label>
                                                                                <br/>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="sexually" value="Yes"
                                                                                           data-parsley-errors-container="#error-radio">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="sexually" value="No">
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Married with children?</label>
                                                                                <br/>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="married" value="Yes"
                                                                                           data-parsley-errors-container="#error-radio">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="married" value="No">
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> How many children </label>
                                                                                <select class="form-control" id="children" name="children" >
                                                                                    <option value="">--Select--</option>
                                                                                    <option value="10">10</option>
                                                                                    <option value="9">9</option>
                                                                                    <option value="8">8</option>
                                                                                    <option value="7">7</option>
                                                                                    <option value="6">6</option>
                                                                                    <option value="5">5</option>
                                                                                    <option value="4">4</option>
                                                                                    <option value="3">3</option>
                                                                                    <option value="2">2</option>
                                                                                    <option value="1">1</option>
                                                                                    <option value="0">0</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                    </div>

                                                                    <div class="row clearfix">
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Parity </label>
                                                                                <select class="form-control" id="parity" name="parity" >
                                                                                    <option value="">--Select--</option>
                                                                                    <option value="10">10</option>
                                                                                    <option value="9">9</option>
                                                                                    <option value="8">8</option>
                                                                                    <option value="7">7</option>
                                                                                    <option value="6">6</option>
                                                                                    <option value="5">5</option>
                                                                                    <option value="4">4</option>
                                                                                    <option value="3">3</option>
                                                                                    <option value="2">2</option>
                                                                                    <option value="1">1</option>
                                                                                    <option value="0">0</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Gravida </label>
                                                                                <select class="form-control" id="gravida" name="gravida" >
                                                                                    <option value="">--Select--</option>
                                                                                    <option value="10">10</option>
                                                                                    <option value="9">9</option>
                                                                                    <option value="8">8</option>
                                                                                    <option value="7">7</option>
                                                                                    <option value="6">6</option>
                                                                                    <option value="5">5</option>
                                                                                    <option value="4">4</option>
                                                                                    <option value="3">3</option>
                                                                                    <option value="2">2</option>
                                                                                    <option value="1">1</option>
                                                                                    <option value="0">0</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                    </div>

                                                                    <div class="row clearfix">
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label>For Females, Age at Menarche</label>
                                                                                <input type="text" class="form-control" name="menache" value="" >
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label>Age at Menopause</label>
                                                                                <input type="text" class="form-control" name="menopause" value="" >
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>

                                                                    </div>

                                                                    <hr/>
                                                                    <h6><b>COPING WITH STRESS</b></h6>

                                                                    <div class="row clearfix">

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label>When stressed, how do you react? </label>
                                                                                <select class="form-control" id="stress" name="stress" >
                                                                                    <option value="">--Select--</option>
                                                                                    <option value="Agitated">Agitated</option>
                                                                                    <option value="Anxious">Anxious</option>
                                                                                    <option value="Demanding">Demanding</option>
                                                                                    <option value="Calm">Calm</option>
                                                                                    <option value="Withdrawn">Withdrawn</option>
                                                                                    <option value="Irritable">Irritable</option>
                                                                                    <option value="Fearful">Fearful</option>
                                                                                    <option value="Sleeps">Sleeps</option>
                                                                                    <option value="Cries">Cries</option>
                                                                                    <option value="Speak Out">Speak Out</option>
                                                                                    <option value="Shout">Shout</option>
                                                                                    <option value="Murmur">Murmur</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> How do you cope with stress? </label>
                                                                                <select class="form-control" id="stress_coping" name="stress_coping" >
                                                                                    <option value="">--Select--</option>
                                                                                    <option value="Sleeps">Sleeps</option>
                                                                                    <option value="Eats">Eats</option>
                                                                                    <option value="Listen to music">Listen to music</option>
                                                                                    <option value="Pray">Pray</option>
                                                                                    <option value="Take a walk">Take a walk</option>
                                                                                    <option value="Read">Read</option>
                                                                                    <option value="Discuss">Discuss</option>

                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <hr/>
                                                                    <h6><b>VALUES AND BELIEF</b></h6>
                                                                    <div class="row clearfix">
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label>What do you value?</label>
                                                                                <input type="text" class="form-control" name="value" value="" >
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label>What do you belief(your religion)?</label>
                                                                                <input type="text" class="form-control" name="belief" value="" >
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>

                                                                    </div>

                                                                    <hr/>
                                                                    <h6><b>OTHER INFORMATION</b></h6>
                                                                    <div class="row clearfix">
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label>Habits</label>
                                                                                <input type="text" class="form-control" name="habits" value="" >
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Do you smoke?</label>
                                                                                <br/>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="smoke" value="Yes"
                                                                                           data-parsley-errors-container="#error-check">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="smoke" value="No">
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Do you drink alcohol?</label>
                                                                                <br/>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="alcohol" value="Yes"
                                                                                           data-parsley-errors-container="#error-check">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="alcohol" value="No">
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>




                                                                    </div>

                                                                    <div class="row clearfix">
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label> Do you take hard drugs?</label>
                                                                                <br/>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="hard_drugs" value="Yes"
                                                                                           data-parsley-errors-container="#error-check">
                                                                                    <span><i></i>Yes</span>
                                                                                </label>
                                                                                <label class="fancy-radio">
                                                                                    <input type="radio" name="hard_drugs" value="No">
                                                                                    <span><i></i>No</span>
                                                                                </label>
                                                                                <p id="error-radio"></p>
                                                                            </div>
                                                                        </div>


                                                                    </div>

                                                                    <button type="submit" name="nursing_history" class="btn btn-primary">Save Nursing History
                                                                    </button>

                                                                </form>
                                                     <?php   }    ?>

                                                    </div>

                                                    <div class="tab-pane" id="NursingIntervention">

                                                        <form action="" method="post">
                                                                <h5> Nursing Intervention </h5>

                                                                <div class="form-group">
                                                                    <label>Domain</label>
                                                                    <select class="form-control" id="domain_id" name="domain_id"
                                                                            required>
                                                                        <option value="">--Select Domain--</option>
                                                                        <?php
                                                                        $finds = NursingDomain::find_all();
                                                                        foreach ($finds as $find) { ?>
                                                                            <option value="<?php echo $find->id ?>"><?php echo $find->name; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Classification</label>
                                                                    <div id="classification_id">

                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Diagnosis Label</label>
                                                                    <div id="diagnosis_id">

                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Remark</label>
                                                                    <textarea class="summernote" name="remarks"></textarea>
                                                                </div>


                                                                <button type="submit" name="nursing_intervention" class="btn btn-primary">Save
                                                                    Intervention
                                                                </button>
                                                            </form>

                                                        <h5>Nursing Intervention</h5>
                                                        <div class="table-responsive">
                                                            <table class="table-bordered">

                                                                    <tr>
                                                                        <th>Date</th>
                                                                        <th> Domain </th>
                                                                        <th> Class </th>
                                                                        <th> Diagnosis </th>
                                                                        <th> Remarks </th>
                                                                        <th> Done By </th>
                                                                    </tr>
                                                                    <?php
                                                                      //  $interventions = NursingIntervention::find_all();
                                                                        $interventions = NursingIntervention::find_all_by_patient($patient->id);
                                                                        foreach ($interventions as $intervention) {
                                                                                $domain    = NursingDomain::find_by_id($intervention->nursingDomain_id);
                                                                                $classif   = NursingClassification::find_by_id($intervention->nursingClassification_id);
                                                                                $diagnosis = NursingDiagnosis::find_by_id($intervention->nursingDiagnosis_id);
                                                                            ?>
                                                                            <tr>
                                                                                <td><?php echo date('d/m/Y h:i a', strtotime($intervention->date)); ?></td>
                                                                                <td><?php echo $domain->name ?></td>
                                                                                <td><?php echo $classif->name ?></td>
                                                                                <td><?php echo $diagnosis->name ?></td>
                                                                                <td><?php echo $intervention->remarks ?></td>
                                                                                <td><?php echo $intervention->done_by ?></td>
                                                                            </tr>
                                                                            <?php
                                                                        }
                                                                ?>
                                                                </table>
                                                        </div>

                                                    </div>

                                                    <div class="tab-pane" id="NursingOutcome">

                                                        <h2>Nursing Outcome</h2>

                                                    </div>

                                                    <div class="tab-pane" id="ClinicalHistory">
                                                        <h2>Clinical History </h2>


                                                    </div>

                                                   <!-- <div class="tab-pane" id="LabHistory">

                                                        <h5>Clinical History</h5>

                                                        <div class="alert alert-info alert-dismissible" role="alert">
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                                                            </button>
                                                            <i class="fa fa-info-circle"></i> Most recent Patient's history
                                                        </div>

                                                        <div id="accordion">
                                                            <?php
/*                                                            $waitingList = WaitingList::find_all_done_by_patient($patient->id);
                                                            foreach ($waitingList as $waitList) {
                                                                $subClinic = SubClinic::find_by_id($waitList->sub_clinic_id);
                                                            */?>

                                                                <div class="card">
                                                                    <div class="card-header">
                                                                        <a class="card-link" data-toggle="collapse" href="#collapse<?php /*echo $waitList->id; */?>">
                                                                            <?php /*echo datetime_to_text($waitList->date)  */?>
                                                                        </a> <span style="float:right"> Clinic: <?php /*echo $subClinic->name */?> </span>
                                                                    </div>
                                                                    <div id="collapse<?php /*echo $waitList->id; */?>" class="collapse" data-parent="#accordion">
                                                                        <div class="card-body">



                                                                            <div class="tab-pane show active" id="PatientDetails">

                                                                                <div style="font-size:20px; text-align:center; background-color:gray;"><b>Patient Vitals</b></div>
                                                                                <?php /*// $waitList  = WaitingList::find_by_id($_GET['id']);
                                                                                $vitals    = Vitals::find_by_waiting_list($waitList->id);
                                                                                foreach ($vitals as $vital) {
                                                                                */?>
                                                                                    <br>
                                                                                    <div class="row">
                                                                                        <div class="col-md-6">
                                                                                            <div class="table-responsive">
                                                                                                <h5> Vital Signs as
                                                                                                    at <?php /*$d_date = date('d/m/Y h:i a', strtotime($vital->date));
                                                                                                        echo $d_date */?></h5>
                                                                                                <table class="table table-bordered">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <?php
/*                                                                                                            if (isset($vital->temperature) and (!empty($vital->temperature))) {
                                                                                                                echo "<th>Temperature</th>";
                                                                                                                echo "<td> $vital->temperature</td>";
                                                                                                            }
                                                                                                            */?>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <?php
/*                                                                                                            if (isset($vital->pulse) and (!empty($vital->pulse))) {
                                                                                                                echo "<th> Heart Rate(Pulse) </th>";
                                                                                                                echo "<td> $vital->pulse</td>";
                                                                                                            }
                                                                                                            */?>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <?php
/*                                                                                                            if (isset($vital->resp_rate) and (!empty($vital->resp_rate))) {
                                                                                                                echo "<th> Respiratory Rate </th>";
                                                                                                                echo "<td> $vital->resp_rate</td>";
                                                                                                            }
                                                                                                            */?>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <?php
/*                                                                                                            if (isset($vital->pressure) and (!empty($vital->pressure))) {
                                                                                                                echo "<th>Blood Pressure</th>";
                                                                                                                echo "<td> $vital->pressure</td>";
                                                                                                            }
                                                                                                            */?>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <?php
/*                                                                                                            if (isset($vital->weight) and (!empty($vital->weight))) {
                                                                                                                echo "<th> Weight </th>";
                                                                                                                echo "<td> $vital->weight</td>";
                                                                                                            }
                                                                                                            */?>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <?php
/*                                                                                                            if (isset($vital->height) and (!empty($vital->height))) {
                                                                                                                echo "<th> Height </th>";
                                                                                                                echo "<td> $vital->height</td>";
                                                                                                            }
                                                                                                            */?>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <?php
/*                                                                                                            if (isset($vital->pain) and (!empty($vital->pain))) {
                                                                                                                echo "<th> Pain </th>";
                                                                                                                echo "<td> $vital->pain</td>";
                                                                                                            }
                                                                                                            */?>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <?php
/*                                                                                                            if (isset($vital->urinalysis) and (!empty($vital->urinalysis))) {
                                                                                                                echo "<th> Urinalysis </th>";
                                                                                                                echo "<td> $vital->urinalysis</td>";
                                                                                                            }
                                                                                                            */?>
                                                                                                        </tr>

                                                                                                        <tr>
                                                                                                            <?php
/*                                                                                                            if (isset($vital->rbs) and (!empty($vital->rbs))) {
                                                                                                                echo "<th> RBS </th>";
                                                                                                                echo "<td> $vital->rbs</td>";
                                                                                                            }
                                                                                                            */?>
                                                                                                        </tr>

                                                                                                    </tbody>
                                                                                                </table>
                                                                                                <?php
/*                                                                                                if (isset($vital->comment) and (!empty($vital->comment)))
                                                                                                    echo $vital->comment;
                                                                                                */?>
                                                                                                <p class="text-info" style="font-size: larger"><code></code>
                                                                                                    Vitals Done
                                                                                                    By <?php /*echo $vital->nurse */?>
                                                                                                </p>


                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <div class="table-responsive">
                                                                                                <?php
/*

                                                                                                $subClinic = SubClinic::find_by_id($vital->sub_clinic_id);

                                                                                                $clinic = Clinic::find_by_id($subClinic->clinic_id);
                                                                                                */?>
                                                                                                <h5> Clinical Vital Signs </h5>
                                                                                                <?php
/*                                                                                                $decoded = $vital->clinical_vitals;
                                                                                                $array = json_decode($decoded);
                                                                                                */?>
                                                                                                <table class="table table-bordered">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <th>CLINIC</th>
                                                                                                            <th><?php /*echo $clinic->name */?></th>
                                                                                                        </tr>
                                                                                                        <?php
/*                                                                                                        foreach ($array as $key => $value) { */?>
                                                                                                            <tr>
                                                                                                                <th><?php /*echo $key */?></th>
                                                                                                                <td><?php /*echo $value */?></td>
                                                                                                            </tr>
                                                                                                        <?php /*} */?>

                                                                                                </table>
                                                                                            </div>
                                                                                        </div>

                                                                                    </div>
                                                                                <?php /*}  */?>


                                                                                <?php
/*                                                                                if (!empty(CaseNote::find_open_case_note($waitList->id, $patient->id))) {
                                                                                */?>
                                                                                    <br />
                                                                                    <div style="font-size:20px; text-align:center; background-color:gray;"><b>Clinical Notes</b></div>
                                                                                    <ul style="font-size: medium">
                                                                                        <?php
/*                                                                                        $case_note = CaseNote::find_open_case_note($waitList->id, $patient->id);
                                                                                        if (!empty($case_note)) {
                                                                                            echo "<h5><u>Subjective</u></h5>";
                                                                                            echo "<p>  $case_note->subjective </p>";

                                                                                            echo "<h5><u>Objective</u></h5>";
                                                                                            echo "<p>  $case_note->objective </p>";

                                                                                            echo "<h5><u>Assessment</u></h5>";
                                                                                            echo "<p>  $case_note->assessment </p>";

                                                                                            echo "<h5><u>Plan</u></h5>";
                                                                                            echo "<p>  $case_note->plan </p>";
                                                                                        }
                                                                                        */?>
                                                                                    </ul>
                                                                                <?php /*} */?>



                                                                                <?php
/*                                                                                if (!empty(TestRequest::find_requests($waitList->id, $patient->id))) {
                                                                                */?>
                                                                                    <div style="font-size:20px; text-align:center; background-color:gray;"><b>Laboratory Test Request</b></div>
                                                                                    <ul style="font-size: large">
                                                                                        <?php
/*                                                                                        $t_Request = TestRequest::find_requests($waitList->id, $patient->id);
                                                                                        if (empty($t_Request)) {
                                                                                            echo "<h5>No Lab Investigation selected</h5>";
                                                                                        } else {
                                                                                            $e_Test = EachTest::find_all_requests($t_Request->id);

                                                                                            $result = Result::find_checked_test_request($t_Request->id);
                                                                                            if (empty($result)) {
                                                                                                // echo "Test Result Not Available yet";
                                                                                            } else {
                                                                                                //  print_r($result);
                                                                                            }
                                                                                            foreach ($e_Test as $e) {
                                                                                                echo "<li> $e->test_name</li>";
                                                                                            }
                                                                                            echo " Requesting Doctor: " .  $t_Request->consultant . "<br/>";
                                                                                            if (!empty($t_Request->doc_com))
                                                                                                echo " Request Note: " .  $t_Request->doc_com . "<br/>";
                                                                                        }
                                                                                        */?>
                                                                                    </ul>
                                                                                    <?php
/*                                                                                    $results = Result::find_checked_test_request($t_Request->id);
                                                                                    if (empty($results)) {
                                                                                        echo "Test Result Not Available yet";
                                                                                    } else {
                                                                                        // print_r($results);
                                                                                        foreach ($results as $result) {
                                                                                            if ($result->dept = 'Microbiology') {
                                                                                                include("../labResults/micro_res.php");
                                                                                            } else if ($result->dept = 'Haematology') {
                                                                                                include("../labResults/haem_res.php");
                                                                                            } else if ($result->dept = 'Chemical Pathology') {
                                                                                                include("../labResults/chem_res.php");
                                                                                            } else if ($result->dept = 'Parasitology') {
                                                                                                include("../labResults/para_res.php");
                                                                                            } else if ($result->dept = 'Histology') {
                                                                                                include("../labResults/histo_res.php");
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                    */?>
                                                                                <?php /*}  */?>


                                                                                <?php
/*                                                                                if (!empty(ScanRequest::find_requests($waitList->id, $patient->id))) {
                                                                                */?>
                                                                                    <br /><br />
                                                                                    <div style="font-size:20px; text-align:center; background-color:gray;"><b>Radiology & Ultrasound Request</b></div>
                                                                                    <ul style="font-size: large">
                                                                                        <?php
/*                                                                                        $s_Request = ScanRequest::find_requests($waitList->id, $patient->id);
                                                                                        if (empty($s_Request)) {
                                                                                            echo "<h5>No Xray/Ultrasound selected</h5>";
                                                                                        } else {
                                                                                            $e_Scan = EachScan::find_all_requests($s_Request->id);
                                                                                            //   print_r($e_Scan);
                                                                                            foreach ($e_Scan as $scan) {
                                                                                                echo "<li> $scan->scan_name</li>";
                                                                                            }
                                                                                        }
                                                                                        */?>
                                                                                    </ul>
                                                                                    <?php
/*                                                                                    if (!empty($s_Request->consultant))
                                                                                        echo " Request Doctor: " .  $s_Request->consultant . "<br/>";
                                                                                    if (!empty($s_Request->doc_com))
                                                                                        echo "<b>Note: </b>" .  $s_Request->doc_com . "<br/>";
                                                                                    */?>
                                                                                <?php /*}  */?>

                                                                                <?php
/*                                                                                if (!empty(DrugRequest::find_requests($waitList->id, $patient->id))) {
                                                                                */?>
                                                                                    <br />
                                                                                    <div style="font-size:20px; text-align:center; background-color:gray;"><b> Prescription </b></div>
                                                                                    <ul style="font-size: large">
                                                                                        <?php
/*                                                                                        $d_Request = DrugRequest::find_requests($waitList->id, $patient->id);

                                                                                        if (empty($d_Request)) {
                                                                                            echo "<h5>No drugs selected</h5>";
                                                                                        } else {
                                                                                            $e_Drug = EachDrug::find_all_requests($d_Request->id);

                                                                                            $table = "                                                       
                                                                                                            <table class='table table-bordered table-condensed table-hove'>
                                                                                                                <thead>
                                                                                                                    <tr>
                                                                                                                        <th>Drug(s)</th>
                                                                                                                        <th>Duration</th>
                                                                                                                        <th>Dosage</th>
                                                                                                                    </tr>
                                                                                                                </thead>                                          
                                                                                                                <tbody>";
                                                                                            foreach ($e_Drug as $drug) {
                                                                                                $table .=
                                                                                                    "<tr><td>$drug->product_name</td>
                                                                                                                        <td>$drug->duration </td>
                                                                                                                        <td>$drug->dosage</td>
                                                                                                                </tr>
                                                                                                    
                                                                                                            ";
                                                                                            }
                                                                                            $table .= "</tbody>
                                                                                                        </table> ";
                                                                                            echo $table;
                                                                                        }
                                                                                        */?>
                                                                                    </ul>
                                                                                <?php /*} */?>

                                                                                <?php
/*                                                                                if (!empty(Referrals::find_pending_referrals($waitList->id, $patient->id))) {
                                                                                */?>
                                                                                    <br />
                                                                                    <div style="font-size:20px; text-align:center; background-color:gray;"><b> Clinic Referrals </b></div>


                                                                                    <h5> <u>Patient's Referral</u> </h5>
                                                                                    <ul style="font-size: medium">

                                                                                        <?php
/*                                                                                        $referral    = Referrals::find_pending_referrals($waitList->id, $patient->id);
                                                                                        if (!empty($referral)) {
                                                                                            $sub_clinic = SubClinic::find_by_id($referral->referred_sub_clinic_id);
                                                                                        }
                                                                                        */?>
                                                                                        <table>
                                                                                            <tr>
                                                                                                <th>Referred Clinic:</th>
                                                                                                <td style="padding-left: 50px"><?php /*echo $sub_clinic->name */?></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <th>Referral Note:</th>
                                                                                                <td style="padding-left: 50px"><?php /*echo $referral->referral_note */?></td>
                                                                                            </tr>
                                                                                        </table>

                                                                                    </ul>

                                                                                <?php /*}  */?>

                                                                                <?php
/*                                                                                if (!empty(Appointment::find_pending_appointment($waitList->id, $patient->id))) {
                                                                                */?>
                                                                                    <br />
                                                                                    <div style="font-size:20px; text-align:center; background-color:gray;"><b> Appointment </b></div>
                                                                                    <h5> <u>Next Appointment</u> </h5>
                                                                                    <ul style="font-size: large">
                                                                                        <?php
/*                                                                                        $appointment = Appointment::find_pending_appointment($waitList->id, $patient->id);
                                                                                        if (empty($appointment)) {
                                                                                            echo "No Appointment";
                                                                                        } else {
                                                                                            echo $appointment->next_app;
                                                                                        }

                                                                                        */?>
                                                                                    </ul>
                                                                                <?php /*} */?>

                                                                                <div style="font-size:20px; text-align:center; background-color:gray;"><b> Admission </b></div>
                                                                                <br />

                                                                            </div>



                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php /*} */?>

                                                        </div>


                                                    </div>-->

                                                    <div class="tab-pane" id="LabHistoryTwo">
                                                        <h2>Clinical History 2</h2>
                                                        <?php // include('clinic_history.php')
                                                        ?>

                                                    </div>





                                                    <div class="tab-pane" id="WalletBalance">

                                                        <h2>Patient's Statement</h2>

                                                        <div class="tab-content m-t-10 padding-0">
                                                            <div class="tab-pane table-responsive active show" id="All">
                                                                <table class="table m-b-0 table-hover">
                                                                    <thead class="thead-purple">

                                                                        <tr>

                                                                            <th>Date</th>
                                                                            <th>Description</th>
                                                                            <th>Credit</th>
                                                                            <th>Debit</th>
                                                                            <th>Balance After</th>
                                                                            <th>Status</th>

                                                                        </tr>

                                                                    </thead>
                                                                    <tbody>

                                                                        <?php
                                                                        $history = AccountHistory::find_by_ref_admission_id($ref->id);
                                                                        foreach ($history as $h) {   ?>
                                                                            <tr>
                                                                                <td><?php $d_date = date('d/m/Y h:i a', strtotime($h->date));
                                                                                    echo $d_date ?></td>
                                                                                <td><?php $decode = json_decode($h->services);
                                                                                    if (is_array($decode)) {
                                                                                        foreach ($decode as $item) {
                                                                                            echo $item . ", ";
                                                                                        }
                                                                                    } else {
                                                                                        echo $decode;
                                                                                    }
                                                                                    ?></td>
                                                                                <td><?php echo $h->credit == 0 ? "" : "₦$h->credit"; ?></td>
                                                                                <td><?php echo $h->debit == 0 ? "" : "₦$h->debit"; ?></td>
                                                                                <td><?php echo "₦$h->wallet_balance"; ?></td>

                                                                                <td><span class="badge badge-success">STATUS</span></td>

                                                                            </tr>

                                                                        <?php }

                                                                        ?>

                                                                    </tbody>
                                                                </table>
                                                            </div>

                                                        </div>



                                                    </div>




                                                    <div class="tab-pane" id="SymptomChecker">
                                                        <?php include("symptom_checker.php"); ?>
                                                    </div>

                                                    <div class="tab-pane" id="PaymentHistory">
                                                        <h2>Payment History</h2>


                                                        <table class="table table-bordered table-responsive">
                                                            <thead>
                                                                <tr>
                                                                    <th>Date</th>
                                                                    <th>Account Number</th>
                                                                    <th>Credit</th>
                                                                    <th>Debit</th>
                                                                    <th>Balance After</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach (AccountHistory::find_by_ref_admission_id($ref->id) as $tran) { ?>
                                                                    <tr>
                                                                        <td><?php echo $tran->date; ?></td>
                                                                        <td><?php echo $tran->patient_id; ?></td>
                                                                        <td><?php echo $tran->credit == 0 ? "" : "₦$tran->credit"; ?></td>
                                                                        <td><?php echo $tran->debit == 0 ? "" : "₦$tran->debit"; ?></td>
                                                                        <td><?php echo "₦$tran->wallet_balance"; ?></td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>


                                                    </div>

                                                </div>




                                            </div>





                                        </div>

                                    </div>





                                </div>

                            </div>
                        </div>







        <!-- Modal Dialogs ========= -->
        <!-- Default Size -->
        <!-- <div class="modal fade" id="canceltModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title text-center" id="defaultModalLabel"> Reason for cancellation </h4>
            </div>
            <div class="modal-body"><form id="basic-form"><textarea class="form-control" rows="5" cols="30" required></textarea>

              <button type="submit" class="btn btn-primary">Validate</button> 
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">SAVE CHANGES</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
                </form>  
            </div>
        </div>
    </div>
</div> -->

        <!-- The Modal -->

        <div class="modal" id="myModal" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="title text-center" id="defaultModalLabel"> Reason for cancellation </h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form method="post" action="">
                        <div class="modal-body">
                            <form id="basic-form">
                                <textarea class="form-control" name="reason" rows="5" cols="30" required></textarea>
                                <!--  <button type="submit" class="btn btn-primary">Validate</button> -->
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">SAVE CHANGES</button>
                            <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button> -->
                    </form>
                </div>
            </div>
        </div>




    </div>


    <div class="modal" id="myModalCancel" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title text-center" id="defaultModalLabel"> Cancel Admission </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="post" action="">
                    <div class="modal-body">
                        <form id="basic-form">
                            Admission Cancelled
                            <!--  <button type="submit" class="btn btn-primary">Validate</button> -->
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-primary">Close</button> -->
                        <button type="button" class="btn btn-primary" data-dismiss="modal">CLOSE</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal" id="myModal2" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title text-center" id="defaultModalLabel"> Payment Model </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="post" action="">
                <div class="modal-body">
                    <form id="basic-form">
                        <input type="text" class="form-control" placeholder="Give 6 digit CODE" maxlength="6" id="codeFour" required />
                        <!--  <button type="submit" class="btn btn-primary">Validate</button> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary SavePayment">Submit</button>
                    <!--   <button type="button" class="btn btn-primary ClosePayment">Submit</button>  -->
                    <button type="button" class="btn btn-primary" id="closeBut" data-dismiss="modal" style="display:none;">CLOSE</button>
            </form>
        </div>

    </div>
</div>
<input type="hidden" id="lastPaymentId" />
<input type="hidden" value="<?= $ref->id ?>" id="ref_adm_id" name="ref_adm_id" />
<input type="hidden" value="<?= $ref->wall_balance ?>" id="ref_adm_wallet" name="ref_adm_wallet" />


<?php
require '../layout/footer.php';
?>
<!-- <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> 
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/js/bootstrap-datetimepicker.min.js"></script> -->
<!-- <script>
    $(function() {
        // validation needs name of the element
        $('#food').multiselect();

        // initialize after multiselect
        $('#basic-form').parsley();
    });
    </script> -->

<script>
    $(document).ready(function() {
        //$('#datetimepicker4').datetimepicker();
        //$('#adm_date').datetimepicker();
        $(".addBut").click(function() {
            if ($("#add_wall_balance").val() > 0) {
                $("#myModal2").modal({
                    backdrop: "static"
                });
                //    var totBalance = ($("#wall_balance").val() != "") ? $("#wall_balance").val() : 0;
                //    var tot = 0;
                //    var addWall = ($("#add_wall_balance").val() != "") ? $("#add_wall_balance").val() : 0;
                //    tot = parseInt(totBalance) + parseInt(addWall);
                //    $("#wall_balance").val(tot);
                //    $("#add_wall_balance").val(0);

                $.ajax({
                    url: '../consultant/test_bill.php',
                    data: {
                        id: $("#pat_hide_id").val(),
                        first_name: $("#first_name").val(),
                        last_name: $("#last_name").val()
                    },
                    type: "GET",
                    success: function(data) {
                        console.log(data.lastBill.id);
                        if (data.status == "Done") {
                            $("#lastPaymentId").val(data.lastBill.id);
                        }
                    }
                });
            } else {
                alert("Please fill amount to be paid!!");
                return false;
            }
        });


        $(".addBalance").click(function() {
            if ($("#add_wall_bal").val() > 0) {
                $("#myModal2").modal({
                    backdrop: "static"
                });
                /*
                $.ajax({
                    url: '../nursing/check_bal.php',
                    data: {
                        id             : $("#pat_hide_id").val(),
                        ref_adm_id     : $("#ref_adm_id").val(),
                        ref_adm_wallet : $("#ref_adm_wallet").val(),
                        add_wall_bal   : $("#add_wall_bal").val()  
                    },
                    type: "GET",
                    success: function(data) {
                        console.log(data.lastHistory.id);
                        if (data.status == "Done") {
                          //  $("#lastPaymentId").val(data.lastHistory.id);
                        }
                    }
                });  */
            } else {
                alert("Please fill amount to be paid!!");
                return false;
            }
        });

        $(".SavePayment").click(function() {
            //alert($("#add_wall_balance").val());
            //    $(".page-loader-wrapper").show();
            var authCode = $("#codeFour").val();
            if (authCode) {
                $.ajax({
                    url: '../nursing/check_bal.php',
                    data: {
                        id: $("#pat_hide_id").val(),
                        ref_adm_id: $("#ref_adm_id").val(),
                        code: $("#codeFour").val(),
                        ref_adm_wallet: $("#ref_adm_wallet").val(),
                        add_wall_bal: $("#add_wall_bal").val()
                    },
                    type: "GET",
                    success: function(data) {
                        if (data.status) {
                            var totBalance = ($(".wallBalance").val() != "") ? $(".wallBalance").val() : 0;
                            var tot = 0;
                            var addWall = ($("#add_wall_bal").val() != "") ? $("#add_wall_bal").val() : 0;
                            tot = parseInt(totBalance) + parseInt(addWall);
                            $(".wallBalance").val(tot);
                            $("#add_wall_bal").val(0);
                            $(".page-loader-wrapper").hide();
                        } else {
                            alert("No success due to error!!");
                            $(".page-loader-wrapper").hide();
                        }
                    }
                });
            } else {
                alert("Please fill the receipt number to proceed!!");
                return false;
                //   alert("No success due to error!!");
                //  $(".page-loader-wrapper").hide();
            }

            $("#myModal2").modal('toggle');
        });


        /*
        $(".SavePayment").click(function() {
            //alert($("#add_wall_balance").val());
            $(".page-loader-wrapper").show();
            $.ajax({
                url: '../nursing/complete_payment.php',
                data: {
                    ref_adm_id     : $("#ref_adm_id").val(),
                    code           : $("#codeFour").val(),
                },
                type: "GET",
                success: function(data) {
                    if (data.status) {
                        var totBalance = ($(".wallBalance").val() != "") ? $(".wallBalance").val() : 0;
                        var tot = 0;
                        var addWall = ($("#add_wall_bal").val() != "") ? $("#add_wall_bal").val() : 0;
                        tot = parseInt(totBalance) + parseInt(addWall);
                        $(".wallBalance").val(tot);
                        $("#add_wall_bal").val(0);
                        $(".page-loader-wrapper").hide();
                    } else {
                        alert("No success due to error!!");
                        $(".page-loader-wrapper").hide();
                    }
                }
            });
            $("#myModal2").modal('toggle');
        });
        */





        $(".ClosePayment").click(function() {
            //alert($("#add_wall_balance").val());
            $(".page-loader-wrapper").show();
            $.ajax({
                url: '../consultant/test_bill_new.php',
                data: {
                    ids: $("#lastPaymentId").val(),
                    code: $("#codeFour").val(),
                    total_price: $("#add_wall_balance").val()
                },
                type: "GET",
                success: function(data) {
                    //$("#closeBut").trigger("click");
                    if (data.status) {
                        var totBalance = ($("#wall_balance").val() != "") ? $("#wall_balance").val() : 0;
                        var tot = 0;
                        var addWall = ($("#add_wall_balance").val() != "") ? $("#add_wall_balance").val() : 0;
                        tot = parseInt(totBalance) + parseInt(addWall);
                        $("#wall_balance").val(tot);
                        $("#add_wall_balance").val(0);
                        $(".page-loader-wrapper").hide();
                    } else {
                        alert("No success due to error!!");
                        $(".page-loader-wrapper").hide();
                    }
                }
            });
            $("#myModal2").modal('toggle');
        });




        $(".nav-link-goto").click(function() {
            $(".titleData").show();
        });

        $(".gotoEdit").click(function() {
            $(".nav-link-goto").trigger("click");
            $(".titleData").hide();
        });

        $('#testItems').on('click', '.add_to_bill_second_nurse', function() {
            var id = $(this).data('id');
            $.post('../consultant/test_bill.php?id=' + id + ($(this)[0].checked ? '' : '&action=delete'), {
                    id: id
                })
                .done(function(data) {
                    $("#testCheck").html(data.bill);
                    //   $("#bill_count").html(data.items_count);
                });
        });

        $('#testItemsSecond').on('click', '.add_to_bill_second_nurse', function() {
            var id = $(this).data('id');
            ///alert($(this).attr("id"));
            $.post('../consultant/test_bill.php?id=' + id + ($(this)[0].checked ? '' : '&action=delete'), {
                    id: id
                })
                .done(function(data) {
                    $("#testCheckSecond").html(data.bill);
                    //   $("#bill_count").html(data.items_count);
                });
        });

        $('#radioItems').on('click', '.add_to_bill_nurse', function() {
            var id = $(this).data('id');
            $.post('../consultant/scan_bill.php?id=' + id + ($(this)[0].checked ? '' : '&action=delete'), {
                    id: id
                })
                .done(function(data) {
                    $("#scanCheck").html(data.bill);
                    //   $("#bill_count").html(data.items_count);
                });
        });

        $('#scanItems').on('click', '.add_to_bill_nurse', function() {
            var id = $(this).data('id');
            $.post('../consultant/scan_bill.php?id=' + id + ($(this)[0].checked ? '' : '&action=delete'), {
                    id: id
                })
                .done(function(data) {
                    $("#scanCheck").html(data.bill);
                    //   $("#bill_count").html(data.items_count);
                });
        });

        $('#chemItemsSecond').on('click', '.add_to_bill_second_nurse', function() {
            var id = $(this).data('id');
            $.post('../consultant/test_bill.php?id=' + id + ($(this)[0].checked ? '' : '&action=delete'), {
                    id: id
                })
                .done(function(data) {
                    $("#testCheckSecond").html(data.bill);
                    //   $("#bill_count").html(data.items_count);
                });
        });

        $('#microItemsSecond').on('click', '.add_to_bill_second_nurse', function() {
            var id = $(this).data('id');
            $.post('../consultant/test_bill.php?id=' + id + ($(this)[0].checked ? '' : '&action=delete'), {
                    id: id
                })
                .done(function(data) {
                    $("#testCheckSecond").html(data.bill);
                    //   $("#bill_count").html(data.items_count);
                });
        });


        $(".bed_location_id_nurse").change(function() {
            $.ajax({
                url: 'patient_detail.php',
                data: {
                    ward_id_edits: $(this).val()
                },
                type: "GET",
                success: function(data) {
                    $(".ward_id").empty();
                    $(".ward_id").html(data);

                },
                error: function(error) {
                    alert("Error in connection");
                }
            });
        });

        $(".ward_change_nurse").change(function() {
            $.ajax({
                url: 'patient_detail.php',
                data: {
                    location_id: $(".bed_location_id_nurse").val(),
                    ward_id_change_room: $(this).val()
                },
                type: "GET",
                success: function(data) {
                    $(".room_no_nurse").empty();
                    $(".room_no_nurse").html(data);

                },
                error: function(error) {
                    alert("Error in connection");
                }
            });
        });


        // Room number according to bed jquery
        $(".room_no_nurse").change(function() {
            //alert($(this).children("option:selected").html());
            var typeLog = $(".typeLogin").val();
            var patId = $("#pat_hide_id").val();
            $.ajax({
                url: 'patient_detail.php',
                data: {
                    bed_location_id: $(".bed_location_id_nurse").val(),
                    bed_ward_id_change_room: $(".ward_change_nurse").val(),
                    room_no_id: $(this).children("option:selected").html(),
                    patientId: patId,
                    room_no_main_id: $(this).children("option:selected").val()
                },
                type: "GET",
                success: function(data) {
                    $(".bed_no").empty();
                    $(".bed_no").html(data);

                },
                error: function(error) {
                    alert("Error in connection");
                }
            });
        });


        $('#testCheckSecond').on("click", '.decrease_bill', function() {
            var id = $(this).data('id');
            //alert(id);
            modify_tests(id, 'action=put&');
        });

        $('#scanCheckSecond').on("click", '.decrease_bill', function() {
            var id = $(this).data('id');
            modify_scans(id, 'action=put&');
        });

        $('#checkSecond').on("click", '.decrease_bill', function() {
            var id = $(this).data('id');
            modify_cart(id, 'action=put&');
        });



        function modify_tests(id, param, element) {
            $.post('../consultant/test_bill.php?' + (param || '') + 'id=' + id, {
                    id: id
                })
                .done(function(data) {
                    $("#cart_count").html(data.items_count);
                    $("#testCheckSecond").html(data.bill);
                    $("#save_page").html(data.save_bill);
                    //   $("#scanCheck").html(data.bill);
                    //element && $(element).focus().setCursorToEnd();
                    // set_events();
                })
        }

        function modify_scans(id, param, element) {
            $.post('scan_bill.php?' + (param || '') + 'id=' + id, {
                    id: id
                })
                .done(function(data) {
                    $("#scanCheck").html(data.bill);
                    //element && $(element).focus().setCursorToEnd();
                    // set_events();
                })
        }



        function modify_cart(id, param, element) {
            $.post('my_bill.php?' + (param || '') + 'id=' + id, {
                    id: id
                })
                .done(function(data) {
                    $("#cart_count").html(data.items_count);
                    $("#check").html(data.bill);
                    $("#save_page").html(data.save_bill);
                    $("#flow_one").html(data.flow);
                    //element && $(element).focus().setCursorToEnd();
                    // set_events();
                })
        }

    });
</script>


<!-- Symptom Checker JS Start  -->



<script src="../symptom_checker/js/bootstrap.min.js"></script>
<script src="../symptom_checker/js/select2.min.js"></script>

<script type="text/javascript">
    var anotherQuestionMap = "";
    var QuestionMapId = "";
    var questionCounting = 0;

    var last = "no";
    var totalQuestion = 0;
    var currentQuestionCounter = 0;
    var counterQues = 0;
    var nextQuestionId = 0;
    var mapQuestionCount = 0;
    var mapQuestionSelected = "";
    var currentQuestionId = {};
    $("document").ready(function() {
        $(".slider").rangeslider();
        $(".body_part_id_question").change(function() {
            $("#nextBtn").removeAttr("disabled");
            $.ajax({
                url: "../symptom_checker/model/symptommodel.php",
                data: {
                    body_part_id: $(".body_part_id_question").val()
                },
                type: "get",
                success: function(data) {
                    $(".body_part_id_symptom_id").empty();
                    $(".body_part_id_symptom_id").html(data);
                },
                error: function(err) {
                    alert("network issue");
                }
            });
        });


        $('.body_part_id_question').select2({
            tags: true,
            templateResult: hideSelected,
            placeholder: "Select Body Part",
        });
        $('.body_part_id_symptom_id').select2({
            tags: true,
            templateResult: hideSelected,
            placeholder: "Select Symptom",
        });
    });

    function hideSelected(value) {
        if (value && !value.selected) {
            return $('<span>' + value.text + '</span>');
        }
    }
    $.fn.rangeslider = function(options) {
        var obj = this;
        var defautValue = obj.attr("value");
        obj.wrap("<span class='range-slider'></span>");
        obj.after("<span class='slider-container'><span class='bar'><span></span></span><span class='bar-btn'><span>0</span></span></span>");
        obj.attr("oninput", "updateSlider(this)");
        updateSlider(this);
        return obj;
    };

    function updateSlider(passObj) {
        var obj = $(passObj);
        var value = obj.val();
        var min = obj.attr("min");
        var max = obj.attr("max");
        var range = Math.round(max - min);
        var percentage = Math.round((value - min) * 100 / range);
        var nextObj = obj.next();
        nextObj.find("span.bar-btn").css("left", percentage + "%");
        nextObj.find("span.bar > span").css("width", percentage + "%");
        nextObj.find("span.bar-btn > span").text(percentage);
    };
</script>
<script>
    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab
    var questionList = "";

    function showTab(n) {



        // This function will display the specified tab of the form...
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        //... and fix the Previous/Next buttons:
        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
            document.getElementById("nextBtn").disabled = false;
        } else {
            document.getElementById("prevBtn").style.display = "inline";
            document.getElementById("nextBtn").disabled = false;
        }
        if (n == (x.length - 1)) {
            document.getElementById("nextBtn").innerHTML = "Next";
        } else {
            document.getElementById("nextBtn").innerHTML = "Next";
        }
        //alert($("#serviceTerm").attr("style"));
        //alert($("#symptomStart").attr("style"));
        // if($("#symptomStart").attr("style") == ''){
        //if($("#symptomStart").attr("style") == "display: block;" || $("#symptomStart").attr("style") == "undefined"){
        if ($("#serviceTerm").attr("style") == "display: none;") {
            document.getElementById("nextBtn").disabled = true;
            if ($("input[name='terms']").prop("checked") == true &&
                $("input[name='gender']").prop("checked") == true
            ) {
                document.getElementById("nextBtn").disabled = false;
            }
            if ($("#normalQuestion").attr("style") == "display: block;") {
                document.getElementById("nextBtn").disabled = true;
                if ($("input[name='overweight']").is(":checked") &&
                    $("input[name='cigrattes']").is(":checked") &&
                    $("input[name='injured']").is(":checked") &&
                    $("input[name='cholestrol']").is(":checked") &&
                    $("input[name='cholestrol']").is(":checked") &&
                    $("input[name='hypertension']").is(":checked") &&
                    $("input[name='diabetes']").is(":checked")
                ) {
                    document.getElementById("nextBtn").disabled = false;
                }
            }
        } else {

            // if($("#normalQuestion").attr("style") == "display: none;"){
            //     document.getElementById("nextBtn").disabled = true;
            // }else{
            document.getElementById("nextBtn").disabled = false;
            // }

        }
        //}
        // }
        if ($("#symptomStart").attr("style") == "display: block;") {
            document.getElementById("nextBtn").disabled = true;
        }



        //if($("#genderSlectedNext").attr("style") == "display: none;")
        //... and run a function that will display the correct step indicator:
        //fixStepIndicator(n)
    }

    function nextPrev(n, nextQuestion) {
        if (typeof nextQuestion === "undefined") {
            var obtValues = {};
            $("input[name='answer_response" + parseInt(counterQues - 1) + "']:checked").each(function(i, e) {
                obtValues[i] = $(this).val();
            });
            // console.log("Question Answer:---", obtValues);
            // console.log("Question Id:---", currentQuestionId);
            $(".page-loader-wrapper").fadeIn();

            var obtValue = {};
            $("input[name='answer_response" + parseInt(counterQues - 1) + "']:checked").each(function(i, e) {
                obtValue[i] = $(this).val();
            });
            //For Save Question Response
            $.ajax({
                url: "../symptom_checker/API.php",
                method: "POST",
                data: {
                    "method": "save",
                    question_id: currentQuestionId,
                    optionValue: obtValue,
                    user_id: $(".user_id").val(),
                    gender: $(".gender").val(),
                    age: $(".age").val()
                },
                success: function() {
                    $(".page-loader-wrapper").fadeOut();
                    $("#nextQuestionCounter" + parseInt(counterQues - 1)).attr("style", "display:none;");
                    $("#nextQuestionCounter" + parseInt(counterQues - 1)).after($(".resultDataShow").clone());
                    ///alert($("#regForm").last("div:nth-child(2)").html());
                    $(".next-btn").empty();
                    $(".resultDataShow").attr("style", "display:block;");
                    $(".blockResult").empty();

                    //@Result data show API call
                    $.ajax({
                        url: "../symptom_checker/API.php",
                        method: "POST",
                        data: {
                            "method": "Result",
                            user_id: $(".user_id").val(),
                            gender: $(".gender").val(),
                            "body_part_id": $(".body_part_id_question").val(),
                            "symptom_id": $(".body_part_id_symptom_id").val()
                        },
                        success: function(data) {
                            console.log(data);
                            var parseResult = JSON.parse(data);
                            if (parseResult.status == true) {
                                $(".symptomStatus").html(parseResult.data.status);
                                $(".symptomDecription").html(parseResult.data.dscription);
                                $(".symptomPrecaution").html(parseResult.data.precaution);
                                $(".symptomRemedies").html(parseResult.data.remedies);
                            }
                        },
                        error: function(error) {}
                    });
                },
                error: function(error) {
                    alert("Network Issue");
                    return false;
                }
            });

            return false;
        }

        //alert($("#symptomStart").attr("style"));
        //if(currentTab <= 5){
        var x = document.getElementsByClassName("tab");
        // alert(currentTab);
        // console.log(x);
        // console.log(currentTab);
        // console.log(x[currentTab]);
        //alert($("#symptomStart").attr("style"));
        // Exit the function if any field in the current tab is invalid:
        //if (n == 1 && !validateForm()) return false;
        // Hide the current tab:


        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = parseInt(currentTab) + n;
        // if you have reached the end of the form...

        if (n < 0) {
            //$("#nextBtn").attr("onclick", "nextPrev(1, )");
            if (questionCounting > 0) {
                questionCounting = parseInt(questionCounting) - 1;

            }
            if (mapQuestionCount > 0) {
                mapQuestionCount = parseInt(mapQuestionCount) - 1;
            }
            //$("#regForm:last-child").remove();
            if (nextQuestion > 0) {
                counterQues = parseInt(counterQues) - 1;
            }
            $('#nextQuestionCounter' + nextQuestion).remove();
            //alert(mapQuestionCount);
            // alert(questionCounting);
            //counterQues = parseInt(counterQues) - 1;
        }
        //alert(currentTab);
        //alert(x.length);

        if (currentTab >= x.length) {
            // ... the form gets submitted:
            //document.getElementById("regForm").submit();
            //alert(counterQues);
            if (counterQues == 0) {
                $(".page-loader-wrapper").fadeIn();
                //Call first Question 
                $.ajax({
                    url: "../symptom_checker/API.php",
                    data: {
                        "method": "checkQuestion",
                        "body_part_id": $(".body_part_id_question").val(),
                        "symptom_id": $(".body_part_id_symptom_id").val(),
                        age: $(".age").val(),
                        gender: $(".gender").val()
                    },
                    method: "post",
                    success: function(data) {
                        var parse = JSON.parse(data);
                        // console.log(parse.status);

                        if (parse.status == true) {
                            currentQuestionCounter = parseInt(currentQuestionCounter) + 1;
                            $("#currentQuestion").val(currentQuestionCounter);
                            questionList = JSON.parse(parse.data.question_id);
                            //console.log("Quesion lIst:--", questionList);
                            anotherQuestionMap = JSON.parse(parse.data.another_question);
                            QuestionMapId = JSON.parse(parse.data.question_map_id);
                            //console.log("Another Question Map:--", anotherQuestionMap);
                            totalQuestion = parseInt(questionList.length + QuestionMapId.length);
                            $("#totalQuestion").val(totalQuestion);
                            $.ajax({
                                url: "../symptom_checker/API.php",
                                method: "get",
                                data: {
                                    "question": questionList[0],
                                    "initiate": "questionStart",
                                    "body_part_id": $(".body_part_id_question").val(),
                                    "symptom_id": $(".body_part_id_symptom_id").val(),
                                    age: $(".age").val(),
                                    gender: $(".gender").val()
                                },
                                success: function(dataQuestion) {
                                    $(".page-loader-wrapper").fadeOut();
                                    var parFirstQuestion = JSON.parse(dataQuestion);
                                    //parseInt(questionCounting) += 1;
                                    currentQuestionId = parFirstQuestion.data.id;
                                    $("#questionId").val(parFirstQuestion.data.id);
                                    if (parFirstQuestion.status) {
                                        //console.log("ParseOption", parFirstQuestion.data.answer_label);
                                        //console.log("ParseOption----", JSON.parse(parFirstQuestion.data.answer_label));
                                        var div = document.createElement("div");
                                        div.setAttribute("class", "tab min-hight");
                                        div.setAttribute("id", "nextQuestionCounter" + counterQues);
                                        div.style.display = "block";
                                        var divChild = document.createElement("div");
                                        divChild.setAttribute("class", "stepper-gander");

                                        //Question Name
                                        var createh3 = document.createElement("h3");
                                        createh3.innerHTML = parFirstQuestion.data.question;
                                        createh3.setAttribute("class", "text-center");
                                        divChild.appendChild(createh3);

                                        //Option Listing
                                        var optionJsonLable = JSON.parse(parFirstQuestion.data.answer_label);
                                        var optionJsonLableValue = JSON.parse(parFirstQuestion.data.answer_value);


                                        for (var i = 0; i < optionJsonLable.length; i++) {
                                            console.log("Lable", optionJsonLable[i]);
                                            console.log("Value", optionJsonLableValue[i]);
                                            var optionList = document.createElement("div");
                                            optionList.setAttribute("class", "checkbox");
                                            var checkBox = document.createElement("input");
                                            checkBox.setAttribute("type", parFirstQuestion.data.type);
                                            checkBox.setAttribute("name", "answer_response" + counterQues);
                                            checkBox.setAttribute("onclick", "nextQuestion('" + optionJsonLable[i] + "', '" + counterQues + "', '" + parFirstQuestion.data.type + "')");


                                            checkBox.value = optionJsonLableValue[i];
                                            var labelCheckbox = document.createElement("label");
                                            labelCheckbox.setAttribute("for", "optinosCheckbox1");
                                            labelCheckbox.innerHTML = optionJsonLable[i];
                                            console.log(checkBox);
                                            console.log(labelCheckbox);
                                            optionList.appendChild(checkBox);
                                            optionList.appendChild(labelCheckbox);
                                            divChild.appendChild(optionList);
                                        }


                                        counterQues = parseInt(counterQues) + 1;
                                        div.appendChild(divChild);
                                        //questionList.shift();
                                        //anotherQuestionMap.shift();
                                        console.log("Quesion lIst:--", questionList);
                                        //console.log("Another Question Map:--", anotherQuestionMap);
                                        //console.log(div);

                                        // if(anotherQuestionMap[0] == $("#"+anotherQuestionMap[0]).val()){
                                        //     $("#nextBtn").attr("onclick", "nextQuestion('"+questionList[0]+"')")
                                        // }else{
                                        //     $("#nextBtn").attr("onclick", "nextQuestion('"+questionList[0]+"')")
                                        // }

                                        $("#symptomStart").after(div);
                                        $("#nextBtn").attr("disabled", true);
                                        //questionCounting = parseInt(questionCounting) + 1;
                                        if (mapQuestionSelected == "notmap") {
                                            mapQuestionCount = parseInt(mapQuestionCount) + 1;

                                        } else {
                                            questionCounting = parseInt(questionCounting) + 1;
                                        }
                                    } else {
                                        alert("No data found");
                                        return false;
                                    }
                                },
                                error: function(error) {
                                    alert("Error To found question");
                                    return false;
                                }
                            });
                        } else {
                            alert("No data found");
                            return false;
                        }
                    },
                    error: function(error) {
                        alert("Network issue");
                        return false;
                    }
                });
            } else {

                //@save Question answer to DB

                $(".page-loader-wrapper").fadeIn();
                var obtValue = {};
                $("input[name='answer_response" + parseInt(counterQues - 1) + "']:checked").each(function(i, e) {
                    obtValue[i] = $(this).val();
                });
                console.log("Question Answer:---", obtValue);
                console.log("Question Id:---", currentQuestionId);
                //For Save Question Response
                $.ajax({
                    url: "../symptom_checker/API.php",
                    method: "POST",
                    data: {
                        "method": "save",
                        question_id: currentQuestionId,
                        optionValue: obtValue,
                        user_id: $(".user_id").val(),
                        gender: $(".gender").val(),
                        age: $(".age").val()
                    },
                    success: function() {

                    },
                    error: function(error) {
                        alert("Network Issue");
                        return false;
                    }
                });
                $.ajax({
                    url: "../symptom_checker/API.php",
                    method: "get",
                    data: {
                        "question": nextQuestionId,
                        "initiate": "questionListing",
                        "body_part_id": $(".body_part_id_question").val(),
                        "symptom_id": $(".body_part_id_symptom_id").val(),
                        age: $(".age").val()
                    },
                    success: function(dataQuestion) {
                        $(".page-loader-wrapper").fadeOut();
                        //alert(parseInt(counterQues) - 1);
                        //alert($("#nextQuestionCounter"+parseInt(counterQues) - 1).children("input[name='answer_response']").val());
                        var parFirstQuestion = JSON.parse(dataQuestion);
                        currentQuestionId = parFirstQuestion.data.id;
                        $("#questionId").val(parFirstQuestion.data.id);




                        if (parFirstQuestion.status) {
                            //console.log("ParseOption", parFirstQuestion.data.answer_label);
                            //console.log("ParseOption----", JSON.parse(parFirstQuestion.data.answer_label));
                            var div = document.createElement("div");
                            div.setAttribute("class", "tab min-hight");
                            div.setAttribute("id", "nextQuestionCounter" + counterQues);
                            div.style.display = "block";
                            var divChild = document.createElement("div");
                            divChild.setAttribute("class", "stepper-gander");

                            //Question Name
                            var createh3 = document.createElement("h3");
                            createh3.innerHTML = parFirstQuestion.data.question;
                            createh3.setAttribute("class", "text-center");
                            divChild.appendChild(createh3);

                            //Option Listing
                            var optionJsonLable = JSON.parse(parFirstQuestion.data.answer_label);
                            var optionJsonLableValue = JSON.parse(parFirstQuestion.data.answer_value);
                            // alert(QuestionMapId[mapQuestionCount]);
                            //                 alert(questionList[questionCounting]);
                            if (typeof questionList[questionCounting] == "undefined") {
                                last = "last";
                            } else {
                                last = "no";
                            }

                            for (var i = 0; i < optionJsonLable.length; i++) {
                                console.log("Lable", optionJsonLable[i]);
                                console.log("Value", optionJsonLableValue[i]);
                                var optionList = document.createElement("div");
                                optionList.setAttribute("class", "checkbox");
                                var checkBox = document.createElement("input");
                                checkBox.setAttribute("type", parFirstQuestion.data.type);
                                if (parFirstQuestion.data.type == "checkbox") {

                                    checkBox.setAttribute("data-value", optionJsonLable[i]);
                                }
                                checkBox.setAttribute("name", "answer_response" + counterQues);

                                checkBox.setAttribute("onclick", "nextQuestion('" + optionJsonLable[i] + "','" + counterQues + "', '" + parFirstQuestion.data.type + "')");


                                checkBox.value = optionJsonLableValue[i];
                                var labelCheckbox = document.createElement("label");
                                labelCheckbox.setAttribute("for", "optinosCheckbox1");
                                labelCheckbox.innerHTML = optionJsonLable[i];
                                console.log(checkBox);
                                console.log(labelCheckbox);
                                optionList.appendChild(checkBox);
                                optionList.appendChild(labelCheckbox);
                                divChild.appendChild(optionList);
                            }




                            div.appendChild(divChild);
                            // counterQues = parseInt(counterQues) + 1;
                            //questionList.shift();
                            //anotherQuestionMap.shift();
                            console.log("Quesion lIst:--", questionList);
                            //console.log("Another Question Map:--", anotherQuestionMap);
                            //console.log(div);

                            // if(anotherQuestionMap[0] == $("#"+anotherQuestionMap[0]).val()){
                            //     $("#nextBtn").attr("onclick", "nextQuestion('"+questionList[0]+"')")
                            // }else{
                            //     $("#nextBtn").attr("onclick", "nextQuestion('"+questionList[0]+"')")
                            // }

                            $("#nextQuestionCounter" + parseInt(counterQues - 1)).after(div);
                            $("#prevBtn").attr("onclick", "nextPrev(-1, " + questionCounting + ")");
                            counterQues = parseInt(counterQues) + 1;
                            $("#nextBtn").attr("disabled", true);
                            if (mapQuestionSelected == "notmap") {
                                questionCounting = parseInt(questionCounting) + 1;
                            } else {
                                mapQuestionCount = parseInt(mapQuestionCount) + 1;
                            }
                            currentQuestionCounter = parseInt(currentQuestionCounter) + 1;
                            $("#currentQuestion").val(currentQuestionCounter);
                        } else {
                            alert("No data found");
                            return false;
                        }
                    },
                    error: function(error) {
                        alert("Error To found question");
                        return false;
                    }
                });
            }
            return false;

        }
        // Otherwise, display the correct tab:
        showTab(currentTab);
        if (n == "-1") {
            //alert($("input[name='gender']").prop("checked"));
            if ($("input[name='terms']").prop("checked") == true ||
                $("input[name='gender']").prop("checked") == true ||
                $("input[name='overweight']").prop("checked") == true
            ) {
                document.getElementById("nextBtn").disabled = false;
            }
        }
        //alert($("#serviceTerm").attr("style"));
        // if($("#serviceTerm").attr("style") == "display: none;" || $("input[name='terms']").prop("checked") == true){
        //     document.getElementById("nextBtn").disabled = false;
        // }else{
        //     document.getElementById("nextBtn").disabled = true;
        // }

        //alert($("input[name='overweight']:checked").val());
        // This function will figure out which tab to display
        // }else{

        // }
    }

    function validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tab");
        y = x[currentTab].getElementsByTagName("");
        // A loop that checks every input field in the current tab:
        for (i = 0; i < y.length; i++) {
            // If a field is empty...
            if (y[i].value == "") {
                // add an "invalid" class to the field:
                y[i].className += " invalid";
                // and set the current valid status to false
                valid = false;
            }
        }
        // If the valid status is true, mark the step as finished and valid:
        // if (valid) {
        //     document.getElementsByClassName("step")[currentTab].className += " finish";
        // }
        return valid; // return the valid status
    }

    function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class on the current step:
        x[n].className += " active";
    }
</script>


<script type="text/javascript">
    var col, el;

    $("input[type=radio]").click(function() {
        el = $(this);
        col = el.data("col");
        $("input[data-col=" + col + "]").prop("checked", false);
        el.prop("checked", true);
    });

    $("input[name='terms']").click(function() {
        if ($(this).prop("checked")) {
            $("#nextBtn").removeAttr("disabled");
        }
    });

    $("input[name='gender']").click(function() {
        if ($(this).prop("checked")) {
            $("#nextBtn").removeAttr("disabled");
        } else {
            $("#nextBtn").attr("disabled");
        }
    });



    function normalQuestionSubmitDisable(className) {

        if ($("input[name='overweight']").is(":checked") &&
            $("input[name='cigrattes']").is(":checked") &&
            $("input[name='injured']").is(":checked") &&
            $("input[name='cholestrol']").is(":checked") &&
            $("input[name='cholestrol']").is(":checked") &&
            $("input[name='hypertension']").is(":checked") &&
            $("input[name='diabetes']").is(":checked")
        ) {
            //if($("input[name='cigrattes']").is(":checked")){
            $("#nextBtn").removeAttr("disabled");
            //}
        }

    }



    function nextQuestion(id, co, type) {
        // alert(anotherQuestionMap[mapQuestionCount]);
        // alert(id);
        if (type == "checkbox") {
            var favorite = [];
            $.each($('input[name="answer_response' + co + '"]:checked'), function() {
                favorite.push($(this).val());
            });
            console.log(favorite);
        }
        // alert(questionCounting);
        // alert(mapQuestionCount);
        // alert(QuestionMapId[mapQuestionCount]);
        // alert(questionList[questionCounting]);
        // alert($('input[name="answer_response'+co+'"]').val());
        // alert($("input[name='answer_response"+co+"']").attr("type"));
        $("#nextBtn").removeAttr("disabled");
        //alert(last);
        //mapQuestionCount = parseInt(mapQuestionCount) + 1;
        if (anotherQuestionMap[mapQuestionCount] == id) {
            //@for mapping question
            if (type == "checkbox" && typeof QuestionMapId[mapQuestionCount] == "undefined") {
                nextQuestionId = questionList[questionCounting];
                $("#nextBtn").attr("onclick", "nextPrev(1, " + questionList[questionCounting] + ")");
            } else {
                nextQuestionId = QuestionMapId[mapQuestionCount];
                $("#nextBtn").attr("onclick", "nextPrev(1, " + QuestionMapId[mapQuestionCount] + ")");
            }

            if (last == "last") {
                nextQuestionId = "undefined";
                $("#nextBtn").attr("onclick", "nextPrev(1, undefined)");
            }

            mapQuestionSelected = "map";
        } else {
            //@for not mapping question
            if (typeof questionList[questionCounting] == "undefined") {
                nextQuestionId = QuestionMapId[mapQuestionCount];
                $("#nextBtn").attr("onclick", "nextPrev(1, " + QuestionMapId[mapQuestionCount] + ")");
            } else {
                nextQuestionId = questionList[questionCounting];
                $("#nextBtn").attr("onclick", "nextPrev(1, " + questionList[questionCounting] + ")");
            }

            if (last == "last") {
                nextQuestionId = "undefined";
                $("#nextBtn").attr("onclick", "nextPrev(1, undefined)");
            }

            mapQuestionSelected = "notmap";

        }

    }
</script>


<!-- Symptom Checker JS End  -->