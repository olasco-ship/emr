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


//$ref             = ReferAdmission::find_by_patient($_GET['id']);
$ref          = ReferAdmission::find_by_id($_GET['id']);
// $waiting_list = WaitingList::find_by_id($_GET['id']);
$cancelAdmission = new CancleAdmission();

//echo $ref->patient_id;  echo gettype($ref->patient_id);
$ref->patient_id = (int) $ref->patient_id;
$x = (int) $ref->patient_id;
//echo gettype($x); exit;


$cancelAdmissionDetail = $cancelAdmission->find_by_patient($x);
//$cancelAdmissionDetail = $cancelAdmission->find_by_pat_id($waiting_list->patient_id);


$usersNew = User::find_by_id($session->user_id);
//pre_d($usersNew);die;
if ($usersNew->sub_clinic_id != 0) {
    $subClinic = SubClinic::find_by_id($usersNew->sub_clinic_id);
} else {
    $subClinic = [];
}



$patient = Patient::find_by_id($x);

$refAdmissionDetail = ReferAdmission::find_by_bill_id_first($x);
//$refAdmissionDetail = ReferAdmission::find_by_bill_id_first($ref->patient_id);

$allRefData = ReferAdmission::find_all();
//$waitingConsultation = WaitingList::find_all_waiting_consultation_count($_GET['id']);
//$countWaitPatient = count($waitingConsultation) + 1;
//$countWaitPatient = count($allRefData) + 1;
$refAdmissionDetail = $refAdmissionDetail[0];
$singleReferData = ReferAdmission::find_by_bill_id_first($x);
//$singleReferData = ReferAdmission::find_by_bill_id_first($ref->patient_id);
$location = Locations::find_all();
$bedSlisting = new Beds();
$roomListData = $bedSlisting->find_by_ward_location_id($refAdmissionDetail->location, $refAdmissionDetail->ward_no);
$ipService = IPDServices::find_all();

$diff = (date('Y') - date('Y', strtotime($patient->dob)));

$bedNumberListStart = "0";
$bedNumberListEnd = "0";
foreach ($roomListData as $RLD) {
    //pre_d($RLD);
    if ($RLD->id == $refAdmissionDetail->room_no) {
        $bedNumberListStart = $RLD->bed_no_to;
        $bedNumberListEnd = $RLD->bed_no_from;
    }
}



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

if (!empty($wDetail)) {
    $sel = "";
    foreach ($wDetail as $wdata) {
        if ($refAdmissionDetail->ward_no == $wdata->id) {
            $sel = "selected='selected'";
        } else {
            $sel = "";
        }
        $dataWard .= "<option value='" . $wdata->id . "' " . $sel . ">" . $wdata->ward_number . "</option>";
    }
} else {
    $dataWard = "<option>-- No Ward found --</option>";
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

        $referAdmission = new ReferAdmission();
        if (!empty($refAdmissionDetail->id)) {
            $referAdmission->id = $refAdmissionDetail->id;
        }
        $referAdmission->sync   = "off";
        $datetime = $_POST['adm_date'] . " " . $_POST['usr_time'] . ":00";
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
        $referAdmission->pat_category = $_POST['pat_category'];
        $referAdmission->settle_status = NULL;
        $referAdmission->created = date("Y-m-d h:i:s");

        if ($_SESSION['department'] == "Nursing") {
            $referAdmission->nurse_id = $_SESSION['user_id'];
        } else {
            $referAdmission->nurse_id = $_POST['nurse_id'];
        }

        $a = $referAdmission->save();
        //pre_d($referAdmission);die;
        //Bed Status
        // $bedL = new BedsList();
        // $bedListDa = $bedL->find_by_ward_id($_POST['ward_no'], $_POST['bed_no'], $_POST['patient_id']);
        // $bedL->occupied_bed_status = '1';
        // $bedL->updateReferId("where id=".$bedListDa->id);  
        $bedL = new BedsList();
        $bedListDa = $bedL->find_by_ward_id($_POST['ward_no'], $_POST['bed_no'], $_POST['patient_id']);
        $oldBedAllot = $bedL->find_by_bed_allot_status_change($_POST['patient_id']);
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
            $session->message("Save Refer/Admission");
            redirect_to("patient_detail.php?id=$waiting_list->id");
        } else {
            $session->message("Not Save");
            redirect_to("patient_detail.php?id=$waiting_list->id");
        }
    }

    if (isset($_POST['reason'])) {
        $findreferDetailSingle = new ReferAdmission();
        $findReferData = $findreferDetailSingle->find_by_bill_id($waiting_list->patient_id);
        $findReferData = $findReferData[0];
        $findReferData->cancel_status = 1;
        $findReferData->id = $findReferData->id;
        $findReferData->updateRefer();
        //pre_d($findReferData);die;
        $cancelAdmission->reason = $_POST['reason'];
        $cancelAdmission->cancel_by_id = $_SESSION['user_id'];
        $cancelAdmission->patient_id = $waiting_list->patient_id;
        $cancelAdmission->created = date("Y-m-d h:i:s");

        $canc = $cancelAdmission->save();

        // For Release Bed after cancel admission
        $bedLs = new BedsList();
        //   $oldBedAllotss = $bedLs->find_by_bed_allot_status_change($ref->patient_id);
        $oldBedAllotss = $bedLs->find_by_bed_allot_status_change($x);
        $bedLs->occupied_bed_status = 0;
        $bedLs->patient_id = NULL;
        $bedLs->updateBedStatus('patient_id=NULL, occupied_bed_status=0', "where id=" . $oldBedAllotss->id);

        if ($canc) {
            $session->message("Successfully cancel admission");
            redirect_to("patient_detail.php?id=$waiting_list->id");
        } else {
            $session->message("Not cancel admission");
            redirect_to("patient_detail.php?id=$waiting_list->id");
        }
    }

    if (isset($_POST['save_test'])) {

        $items = TestBill::get_bill();
        $item = $items[0];
        //  print_r($items);
        //  echo "<br/>";
        //  echo count($items);
        // exit;
        $encounterReCreate = new Encounter();
        $encreate = $encounterReCreate->find_all_by_patient($patient->id);
        if (empty($encreate)) {
            $today = date_only(strftime("%Y-%m-%d %H:%M:%S", time()));
            $encounter                   = new Encounter();
            $encounter->sync             = "unsync";
            $encounter->patient_id       = $patient->id;
            $encounter->consultant       = $user->full_name();
            $encounter->status           = "OPEN";
            $encounter->lab              = "REQUEST";
            $encounter->date_only        = $today;
            $encounter->date             = strftime("%Y-%m-%d %H:%M:%S", time());
            $encounter->save();
            $lastEncounterId = $encounterReCreate->findLastEncounterByPatientId($patient->id);
        } else {
            $encounterReCreate->lab = "REQUEST";
            $encounterReCreate->updateReferId("WHERE patient_id=" . $patient->id);
            $lastEncounterId = $encreate['0']->id;
        }

        $testRequest                  = new TestRequest();
        $testRequest->sync            = "off";
        $testRequest->waiting_list_id = $waiting_list->id;
        $testRequest->ref_adm_id      = $refAdmissionDetail->id;
        $testRequest->ward_id         = $refAdmissionDetail->ward_no;
        $testRequest->patient_id      = $patient->id;
        $testRequest->bill_id         = 0;
        $testRequest->encounter_id    = $lastEncounterId;
        $testRequest->consultant      = $user->full_name();
        $testRequest->test_no         = count($items);
        $testRequest->not_done         = count($items);
        $testRequest->doc_com         = $_POST['doc_com'];
        $testRequest->lab_com         = "";
        $testRequest->status          = "awaiting_costing";
        //$testRequest->status = "";
        $testRequest->receipt = "";
        $testRequest->date = strftime("%Y-%m-%d %H:%M:%S", time());
        if ($testRequest->save()) {
            foreach ($items as $item) {
                $test = Test::find_by_id($item->id);

                $eachTest                  = new EachTest();
                $eachTest->test_id         = $test->id;
                $eachTest->test_request_id = $testRequest->id;
                $eachTest->quantity        = 1;
                $eachTest->sync            = "off";
                $eachTest->test_name       = $test->name;
                $eachTest->test_price      = $item->price;
                $eachTest->consultant      = $user->full_name();
                $eachTest->testResult      = "";
                $eachTest->ipd_status      = '1';
                $eachTest->scientist       = "";
                $eachTest->pathologist     = "";
                $eachTest->status          = "OPEN";
                $eachTest->date            = strftime("%Y-%m-%d %H:%M:%S", time());
                $eachTest->save();
            }

            $session->message("Lab Investigations has been requested for this patient");
            redirect_to("patient_detail_admitted.php?id=$ref->id");
           // redirect_to("patient_detail.php?id=$ref->id");

        }
    }

    if (isset($_POST['save_scan'])) {

        $encounterReCreate = new Encounter();
        $encreate = $encounterReCreate->find_all_by_patient($patient->id);

        if (empty($encreate)) {
            $today = date_only(strftime("%Y-%m-%d %H:%M:%S", time()));
            $encounter                   = new Encounter();
            $encounter->sync             = "unsync";
            $encounter->patient_id       = $patient->id;
            $encounter->consultant       = $user->full_name();
            $encounter->status           = "OPEN";
            $encounter->scan             = "REQUEST";
            $encounter->date_only        = $today;
            $encounter->date             = strftime("%Y-%m-%d %H:%M:%S", time());
            $encounter->save();
            $lastEncounterId = $encounterReCreate->findLastEncounterByPatientId($patient->id);
        } else {
            $encounterReCreate->scan = "REQUEST";
            $encounterReCreate->updateReferId("WHERE patient_id=" . $patient->id);
            $lastEncounterId = $encreate['0']->id;
        }

        //   $items = TestBill::get_bill();
        $items = ScanBill::get_bill();
        $item = $items[0];

        $scanRequest                  = new ScanRequest();
        $scanRequest->sync            = "off";
        $scanRequest->waiting_list_id = $waiting_list->id;
        $scanRequest->ref_adm_id      = $refAdmissionDetail->id;
        $scanRequest->ward_id         = $refAdmissionDetail->ward_no;
        $scanRequest->encounter_id    = $lastEncounterId->id;
        $scanRequest->patient_id      = $patient->id;
        $scanRequest->bill_id         = 0;
        $scanRequest->status          = "awaiting_costing";
        $scanRequest->consultant = $user->full_name();
        $scanRequest->scan_no    = count($items);
        $scanRequest->not_done   = count($items);
        $scanRequest->doc_com    = $_POST['doc_com'];
        $scanRequest->scan_com = "";
        //$scanRequest->status = "";
        $scanRequest->receipt = "";
        $scanRequest->date = strftime("%Y-%m-%d %H:%M:%S", time());
        if ($scanRequest->save()) {
            foreach ($items as $item) {
                $test = Test::find_by_id($item->id);

                $eachScan = new EachScan();
                $eachScan->scan_id = $test->id;
                $eachScan->scan_request_id = $scanRequest->id;
                $eachScan->quantity        = 1;
                $eachScan->sync = "off";
                $eachScan->scan_name = $test->name;
                $eachScan->consultant = $user->full_name();
                $eachScan->scanResult = "";
                $eachScan->ipd_status = '1';
                $eachScan->scientist = "";
                $eachScan->radiologist = "";
                $eachScan->status = "OPEN";
                $eachScan->date = strftime("%Y-%m-%d %H:%M:%S", time());
                $eachScan->save();
            }
            $session->message("Investigations has been requested for this patient");
            redirect_to("patient_detail_admitted.php?id=$ref->id");
          //  redirect_to("patient_detail.php?id=$ref->id");
        }
    }

    if (isset($_POST['save_drug'])) {

        $items = PatientBill::get_bill();
        $item = $items[0];

        redirect_to("drugboard_inp.php?id=$ref->id");

        //pre_d($_POST);die;
        $encounterReCreate = new Encounter();
        $encreate = $encounterReCreate->find_all_by_patient($patient->id);

        if (empty($encreate)) {
            $today = date_only(strftime("%Y-%m-%d %H:%M:%S", time()));
            $encounter                   = new Encounter();
            $encounter->sync             = "unsync";
            $encounter->patient_id       = $patient->id;
            $encounter->consultant       = $user->full_name();
            $encounter->status           = "OPEN";
            $encounter->drug         = "REQUEST";
            $encounter->date_only        = $today;
            $encounter->date             = strftime("%Y-%m-%d %H:%M:%S", time());
            $encounter->save();
            $lastEncounterId = $encounterReCreate->findLastEncounterByPatientId($patient->id);
        } else {
            $encounterReCreate->drug = "REQUEST";
            $encounterReCreate->updateReferId("WHERE patient_id=" . $patient->id);
            $lastEncounterId = $encreate['0']->id;
        }

        //   $items = TestBill::get_bill();
        $items = PatientBill::get_bill();
        $item = $items[0];


        $drugRequest                  = new DrugRequest();
        $drugRequest->sync            = "off";
        $drugRequest->waiting_list_id = $waiting_list->id;
        $drugRequest->ward_id         = $refAdmissionDetail->ward_no;
        $drugRequest->patient_id      = $patient->id;
        $drugRequest->bill_id         = 0;
        $drugRequest->consultant      = $user->full_name();
        $drugRequest->status          = "awaiting_costing";
        $drugRequest->drugs_no        = count($items);
        $drugRequest->not_available   = count($items);
        $drugRequest->encounter_id = $lastEncounterId;
        $drugRequest->doc_com = $_POST['doc_com'];
        $drugRequest->pharm_com = "";
        //$drugRequest->status = "";
        $drugRequest->receipt = "";
        $drugRequest->date = strftime("%Y-%m-%d %H:%M:%S", time());

        if ($drugRequest->save()) {
            foreach ($items as $keys => $item) {
                $product = Product::find_by_id($item->id);

                $eachDrug = new EachDrug();
                $eachDrug->sync = "off";
                $eachDrug->drug_request_id = $drugRequest->id;
                $eachDrug->product_id = $product->id;
                $eachDrug->product_name = $product->name;
                //    $eachDrug->quantity = $_POST['qyt'][$keys];
                $eachDrug->quantity = $item->quantity;
                //    $eachDrug->dosage = $_POST['dosage'][$keys];
                $eachDrug->dosage = $item->dosage;
                $eachDrug->consultant = $user->full_name();
                $eachDrug->pharmacy = "";
                $eachDrug->status = "OPEN";
                $eachDrug->date = strftime("%Y-%m-%d %H:%M:%S", time());
                //pre_d($eachDrug);
                $eachDrug->save();
            }
            $session->message("Prescription has been done for this patient");
            redirect_to("patient_detail_admitted.php?id=$ref->id");
           // redirect_to("patient_detail.php?id=$ref->id");
        }
    }

    if (isset($_POST['save_appointment'])) {

        $next_app                     = test_input($_POST['next_app']);

        $appointment                  = new Appointment();
        $appointment->sync            = "off";
        $appointment->next_app        = $next_app;
        $appointment->app_date        = "";
        $appointment->patient_id      = $patient->id;
        $appointment->waiting_list_id = $waiting_list->id;
        $appointment->ref_adm_id      = $refAdmissionDetail->id;
        $appointment->sub_clinic_id   = 0;
        $appointment->next_sub_clinic_id = $waiting_list->sub_clinic_id;
        $appointment->consultant      = $user->full_name();
        $appointment->status          = "OPEN";
        $appointment->date            = strftime("%Y-%m-%d %H:%M:%S", time());
        $appointment->save();
        $session->message("Appointment has been booked for this patient");
        redirect_to("patient_detail_admitted.php?id=$ref->id");
      //  redirect_to("patient_detail.php?id=$ref->id");
    }

    if (isset($_POST['refer_patient'])) {

        $clinic_id    = test_input($_POST['clinic_id']);

        $sub_clinic_id = test_input($_POST['sub_clinic_id']);

        $clinic_note  = test_input($_POST['clinic_note']);

        $referral                         = new Referrals();
        $referral->sync                   = "off";
        $referral->patient_id             = $patient->id;
        $referral->waiting_list_id        = $waiting_list->id;
        $referral->ref_adm_id             = $refAdmissionDetail->id;
        $referral->current_sub_clinic_id  = 0;
        $referral->referred_sub_clinic_id = $sub_clinic_id;
        $referral->consultant             = $user->full_name();
        $referral->referral_note          = $clinic_note;
        $referral->status                 = "PENDING";
        $referral->date                   = strftime("%Y-%m-%d %H:%M:%S", time());
        $referral->save();
        $session->message("Patient has been referred!");
        redirect_to("patient_detail_admitted.php?id=$ref->id");
        //   redirect_to("dashboard.php?id=$patient->id");
    }

    if (isset($_POST['save_note'])) {

        $caseNote                  = new CaseNote();
        $caseNote->sync            = "off";
        $caseNote->patient_id      = $patient->id;
        $caseNote->waiting_list_id = $waiting_list->id;
        $caseNote->ref_adm_id      = $refAdmissionDetail->id;
        $caseNote->sub_clinic_id   = 0;
        $caseNote->complains       = json_encode($_POST['complain']);
        $caseNote->hpc             = $_POST['hpc'];
        $caseNote->duration        = json_encode($_POST['complain_duration']);
        $caseNote->sys_review      = $_POST['system_review'];
        $caseNote->examination     = json_encode($_POST['general']);
        $caseNote->diagnosis       = $_POST['diagnosis'];
        $caseNote->differentials   = $_POST['differentials'];
        $caseNote->note            = $_POST['examNote'];
        $caseNote->consultant      = $user->full_name();
        $caseNote->status          = "OPEN";
        $caseNote->date            = strftime("%Y-%m-%d %H:%M:%S", time());
        $caseNote->save();
        $session->message("Patient's note has been generated!");
        //    redirect_to("dashboard.php?id=$patient->id");
        redirect_to("patient_detail_admitted.php?id=$ref->id");
    }

    if (isset($_POST['final_review'])) {

        //   echo "final";  // exit;

        $waitList = WaitingList::find_by_id($waiting_list->id);

        //    echo $waitList->id;   exit;

        $waitList->status = "consultation done";
        if ($waitList->save()) {
            if (!empty(TestRequest::find_by_waiting_list_id($waitList->id))) {
                $tRequest = TestRequest::find_by_waiting_list_id($waitList->id);
                $tRequest->status = "awaiting_costing";

                //  $tRequest->save();
                if ($tRequest->save()) {
                    $eT = EachTest::find_all_requests($tRequest->id);
                    foreach ($eT as $e) {
                        $e->status = "OPEN";
                        $e->save();
                    }
                }
            }
            if (!empty(ScanRequest::find_by_waiting_list_id($waitList->id))) {
                $sRequest = ScanRequest::find_by_waiting_list_id($waitList->id);
                $sRequest->status = "awaiting_costing";
                //  $sRequest->save();
                if ($sRequest->save()) {
                    $eS = EachScan::find_all_requests($sRequest->id);
                    foreach ($eS as $e) {
                        $e->status = "OPEN";
                        $e->save();
                    }
                }
            }
            if (!empty(DrugRequest::find_by_waiting_list_id($waitList->id))) {
                $dRequest = DrugRequest::find_by_waiting_list_id($waitList->id);
                $dRequest->status = "awaiting_costing";
                //   $dRequest->save();
                if ($dRequest->save()) {
                    $eD = EachDrug::find_all_requests($dRequest->id);
                    foreach ($eD as $e) {
                        $e->status = "OPEN";
                        $e->save();
                    }
                }
            }
            if (!empty(Appointment::find_by_waiting_list_id($waitList->id))) {
                $aRequest = Appointment::find_by_waiting_list_id($waitList->id);
                $aRequest->status = "OPEN";
                $aRequest->save();
            }
            if (!empty(Referrals::find_by_waiting_list_id($waitList->id))) {
                $rRequest = Referrals::find_by_waiting_list_id($waitList->id);
                $rRequest->status = "OPEN";
                $rRequest->save();
            }
            $session->message("Patient's treatment has been completed!");
            redirect_to("dashboard.php?id=$waiting_list->id");
        }
    }

    if (isset($_POST['save_vitals'])) {
        $pressure    = test_input($_POST['pressure']);
        $temperature = test_input($_POST['temperature']);
        $weight      = test_input($_POST['weight']);
        $height      = test_input($_POST['height']);
        $respiration = test_input($_POST['respiration']);
        $heart_rate  = test_input($_POST['heart_rate']);
        $pain        = test_input($_POST['pain']);
        $urinalysis  = test_input($_POST['urinalysis']);
        $rbs         = test_input($_POST['rbs']);
        $comment     = test_input($_POST['comment']);


        $clinic_id = test_input($_POST['clinic_id']);
        $json = "";

        //   echo $clinic_id; exit;

        // if (isset($clinic_id)) {
        //     $clinic = Clinic::find_by_id($clinic_id);
        //     $clinic->name;

        //     switch ($clinic->name) {
        //         case "MOPD":
        //             $foo = new StdClass();
        //             $foo->HeadCircumference = test_input($_POST['head_cir']);
        //             $foo->ArmCircumference = test_input($_POST['arm_cir']);
        //             $foo->AbdominalGirth = test_input($_POST['abd_girth']);
        //             $foo->Waist = test_input($_POST['waist']);
        //             $foo->HipMeasurement = test_input($_POST['hip_measure']);
        //             $foo->ChestCircumference = test_input($_POST['chest_cir']);
        //             $foo->Hemodialysis = test_input($_POST['hd']);
        //             $foo->Hemodiafiltrion = test_input($_POST['hdf']);
        //             $foo->SeizureChart = test_input($_POST['seizure']);
        //             $foo->SuicideMonitoringChart = test_input($_POST['suicide']);

        //             $json = json_encode($foo);
        //             //  echo $json; exit;
        //             break;
        //         case "FAMILY PLANNING":
        //             $foo = new StdClass();
        //             $foo->UterineDepth = test_input($_POST['uterine_depth']);
        //             $foo->CervicalAppearance = test_input($_POST['cerv_app']);

        //             $json = json_encode($foo);
        //             //  echo $json; exit;
        //             break;
        //         case "OPHTHALMOLOGY":
        //             $foo = new StdClass();
        //             $foo->VisualAcuity = test_input($_POST['visual_acuity']);
        //             $foo->Endoscopy = test_input($_POST['endoscopy']);
        //             $foo->IntraocularPressure = test_input($_POST['intra_pressure']);
        //             $foo->InstillationChart = test_input($_POST['instil']);

        //             $json = json_encode($foo);
        //             // echo $json; exit;
        //             break;
        //         case "ENT":
        //             $foo = new StdClass();
        //             $foo->Audiometry = test_input($_POST['audio']);
        //             $foo->Tympanometry = test_input($_POST['tympa']);

        //             $json = json_encode($foo);
        //             //  echo $json; exit;
        //             break;
        //         case "ANTENATAL &amp; POS-NATAL":
        //             $foo = new StdClass();
        //             $foo->EstimatedGestationalAge = test_input($_POST['estimated']);
        //             $foo->FundalHeight = test_input($_POST['fundal']);
        //             $foo->PelvicPalpation = test_input($_POST['pelvic']);
        //             $foo->FetalHeartRate = test_input($_POST['fetal_heart']);
        //             $foo->FetalAndLieAndPosition = test_input($_POST['fetal_lie']);
        //             $foo->Presentation = test_input($_POST['presentation']);

        //             $json = json_encode($foo);
        //             // echo $json; exit;
        //             break;
        //         default:
        //             echo "";
        //     }
        // }

        if ((!$errMessage) and (empty($errMessage))) {
            $vitals                  = new Vitals();
            $vitals->sync            = "off";
            $vitals->nurse           = $user->full_name();   // current user
            $vitals->patient_id      = $patient->id;
            $vitals->sub_clinic_id   = $subClinic->id;
            $vitals->waiting_list_id = $waiting->id;
            $vitals->ward_id         = "0";
            $vitals->temperature     = $temperature;
            $vitals->pulse           = $heart_rate;
            $vitals->pressure        = $pressure;
            $vitals->weight          = $weight;
            $vitals->height          = $height;
            $vitals->pain            = $pain;
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
        redirect_to("patient_detail.php?id=$patient->id");
    }

}

PatientBill::clear_all_bill();
ScanBill::clear_all_bill();
TestBill::clear_all_bill();



require '../layout/header.php';

//echo "moon"; exit;

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


        <input type="hidden" value="../revenue/beds.php" class="urlWard" />
        <input type="hidden" value="patient_detail.php" class="typeLogin" />
        <div class="row clearfix">



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
                                                    <li class="nav-item"><a class="nav-link nav-link-goto active show" data-toggle="tab" href="#Admit-pat"> Patient Details</a></li>
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#VitalHistory">Vital History</a></li>
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#SOAP">SOAP</a></li>
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#SOAPHistory">SOAP History</a></li>
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#ClinicalHistory">Clinical History</a></li>
                                                    <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#LaboratorySecond">Laboratory</a></li>
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#RadiologySecond">Radiology/Ultrasound</a></li>
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#DrugSecond">Drug Prescription</a></li>
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Appointment">Book Appointment</a></li>
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Refer">Refer </a></li>
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#SymptomChecker">Symptom Checker</a></li>
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#DischargePatient">Discharge Patient</a></li>

                                                    <!--
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#update-pat"> Modify Patient info</a></li>
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#cancle-admission"> Cancel Admission</a></li>
                                                    -->

                                                <!--    <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#VitalHistory"> Vital History</a></li>
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#LabHistoryTwo">Clinical History Two</a></li>


                                                    -->


                                                </ul>
                                                <div class="tab-content">

                                                    <div class="tab-pane show active" id="Admit-pat">

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

                                                                            <!--  <input type="time" name="usr_time" value="<?php // echo date("H:m", strtotime($refAdmissionDetail->adm_date)); 
                                                                                                                            ?>">  -->
                                                                            <input type="date" class="form-control" readonly id="adm_date" name="adm_date" value="<?php echo date("Y-m-d", strtotime($refAdmissionDetail->adm_date)); ?>" />

                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label class="control-label">Location</label>

                                                                            <select class="form-control bed_location_id_doctor" name="location" readonly>
                                                                                <option value="">-- Select Location --</option>

                                                                                <?php
                                                                                if (!empty($location)) {
                                                                                    foreach ($location as $locData) {
                                                                                ?>
                                                                                        <option value="<?= $locData->id ?>" <?= (!empty($refAdmissionDetail->location) && $refAdmissionDetail->location == $locData->id) ? "selected='selected'" : "" ?>><?= ucfirst($locData->location_name) ?></option>
                                                                                <?php
                                                                                    }
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row clearfix">
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label>Ward</label>
                                                                            <select class="form-control ward_id ward_change_doctor" name="ward_no" required>
                                                                                <option value="">-- Select Ward --</option>

                                                                                <?= $dataWard ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label>Room No.</label>
                                                                            <select class="form-control room_no" name="room_no" required>
                                                                                <option value="">-- Select Room --</option>

                                                                                <?php
                                                                                if (!empty($roomListData)) {
                                                                                    foreach ($roomListData as $roomListDataData) {
                                                                                ?>
                                                                                        <option value="<?= $roomListDataData->id ?>" <?= (!empty($refAdmissionDetail->room_no) && $refAdmissionDetail->room_no == $roomListDataData->id) ? "selected='selected'" : "" ?>><?= ucfirst($roomListDataData->room_number) ?></option>
                                                                                <?php
                                                                                    }
                                                                                }
                                                                                ?>

                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label class="control-label">Bed No.</label>
                                                                            <select class="form-control bed_no" name="bed_no" readonly>
                                                                                <option value="">-- Select Bed No --</option>

                                                                                <?php

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
                                                                            <!--    <br>  -->
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

                                                                    <div class="col-sm-4" style="display:none;">
                                                                        <div class="form-group">
                                                                            <label>Add Wallet Balance </label>

                                                                            <div class="input-group mb-3">
                                                                                <input type="text" class="form-control" placeholder="" id="add_wall_balance" name="add_wall_balance" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                                                                <div class="input-group-append">
                                                                                    <button class="addBut btn btn-outline-secondary" type="button">Add</button>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label class="control-label">Wallet Balance</label>
                                                                            <input type="text" class="form-control" placeholder="" id="wall_balance" name="wall_balance" readonly value="<?= (!empty($refAdmissionDetail->wall_balance)) ? $refAdmissionDetail->wall_balance : '' ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row clearfix">
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label class="control-label">Patient Category </label>
                                                                            <select class="form-control" name="pat_category" readonly>
                                                                                <option value="">-- Select Patient Category --</option>
                                                                                <option value="General" <?= (!empty($refAdmissionDetail->pat_category) && ($refAdmissionDetail->pat_category == "General")) ? "selected='selected'" : "" ?>>General</option>
                                                                                <option value="VIP" <?= (!empty($refAdmissionDetail->pat_category) && ($refAdmissionDetail->pat_category == "VIP")) ? "selected='selected'" : "" ?>>VIP</option>
                                                                                <option value="Veteran" <?= (!empty($refAdmissionDetail->pat_category) && ($refAdmissionDetail->pat_category == "Veteran")) ? "selected='selected'" : "" ?>>Veteran</option>

                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label> Remarks </label>
                                                                    <textarea class="form-control" readonly name="remark" rows="3" cols="10"><?= (!empty($refAdmissionDetail->remark)) ? $refAdmissionDetail->remark : '' ?></textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label> Remarks Nurse </label>
                                                                    <textarea class="form-control" readonly name="remark_nurse" rows="3" cols="10"><?= (!empty($refAdmissionDetail->remark_nurse)) ? $refAdmissionDetail->remark_nurse : '' ?></textarea>
                                                                </div>

                                                                <div class="form-group">
                                                                    <!--   <input type="submit" value="Save" class="btn btn-primary" />    -->
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

                                                    <div class="tab-pane" id="SOAP">

                                                        <h5>SOAP</h5>

                                                        <form action="" method="post">


                                                            <nav aria-label="breadcrumb">
                                                                <ol class="breadcrumb">
                                                                    <li class="breadcrumb-item active" aria-current="page"><b>PRESENTING
                                                                            COMPLAIN</b></li>
                                                                </ol>
                                                            </nav>

                                                            <div class="form-group row">
                                                                <div class="offset-sm-1 col-sm-3">
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <strong>COMPLAINS</strong>
                                                                    <input name="waitList_id" value="{{ $waitList->id }}" hidden>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <strong>DURATION</strong>
                                                                </div>

                                                            </div>

                                                            <div class="form-group row">
                                                                <div class="offset-sm-1 col-sm-3">
                                                                    <label> Presenting Complain <span class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <select class="form-control complain_label" id="complain"
                                                                            name="complain[]" multiple="multiple">
                                                                        <?php
                                                                        $complains = Complain::find_all();
                                                                        foreach($complains as $complain) {
                                                                            ?>
                                                                            <option value="<?php echo $complain->name ?>"><?php echo $complain->name ?></option>
                                                                        <?php } ?>
                                                                    </select>

                                                                </div>

                                                                <div class="col-sm-3">
                                                                    <input type="text" class="form-control" name="complain_duration">

                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <div class="offset-sm-1 col-sm-3">
                                                                    <label> History Of Complain <span class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-sm-5">
                                                        <textarea class="form-control" name="hpc">

                                                        </textarea>
                                                                </div>
                                                                <div class="col-sm-3">

                                                                </div>
                                                            </div>

                                                            <nav aria-label="breadcrumb">
                                                                <ol class="breadcrumb">
                                                                    <li class="breadcrumb-item active" aria-current="page"><b>SYSTEMIC
                                                                            REVIEW</b></li>
                                                                </ol>
                                                            </nav>
                                                            <div class="form-group row">
                                                                <div class="offset-sm-1 col-sm-3">
                                                                    <label> Systemic Review <span class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-sm-8">

                                                                <textarea class="form-control" name="system_review">

                                                                </textarea>

                                                                </div>
                                                            </div>


                                                            <nav aria-label="breadcrumb">
                                                                <ol class="breadcrumb">
                                                                    <li class="breadcrumb-item active" aria-current="page"><b>PHYSICAL
                                                                            EXAMINATION</b></li>

                                                                    <!-- <li style="margin-left: auto"
                                                                         class="breadcrumb-item active dropdown-toggle"
                                                                         data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                                         aria-current="page"><b>Select Options</b>
                                                                         <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                                             <a id="selGeneral" class="dropdown-item" href="#">General
                                                                                 Examination</a>
                                                                             <a id="selCns" class="dropdown-item" href="#">Central Nervous
                                                                                 System</a>
                                                                             <a id="selResp" class="dropdown-item" href="#">Respiratory
                                                                                 System</a>
                                                                             <a id="selCad" class="dropdown-item"
                                                                                href="#">Cardio-Vascular</a>
                                                                             <a id="selAbd" class="dropdown-item" href="#">Abdominal</a>
                                                                             <a id="selUroF" class="dropdown-item" href="#">Urogenital
                                                                                 Female</a>
                                                                             <a id="selUroM" class="dropdown-item" href="#">Urogenital
                                                                                 Male</a>
                                                                             <a id="selNeuro" class="dropdown-item" href="#">Neurologic</a>
                                                                             <a id="selGas" class="dropdown-item" href="#">Gastrointestinal
                                                                                 Tract</a>
                                                                             <a id="selExamNote" class="dropdown-item" href="#"> Add Note </a>
                                                                         </div>
                                                                     </li>-->

                                                                </ol>
                                                            </nav>

                                                            <div class="form-group row" id="general">
                                                                <div class="offset-sm-1 col-sm-3">
                                                                    <label> General Examination <span class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <select class="form-control gen_exam" id="gen_exam"
                                                                            name="general[]" multiple="multiple">
                                                                        <?php
                                                                        $examinations = Examination::find_all();
                                                                        foreach($examinations as $examination) {
                                                                            ?>
                                                                            <option value="<?php echo $examination->name ?>"><?php echo $examination->name ?></option>
                                                                        <?php } ?>

                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <!--                                     <div class="form-group row" id="cns">
                                                                                                     <div class="offset-sm-1 col-sm-3">
                                                                                                         <label> Central Nervous System <span
                                                                                                                     class="text-danger">*</span></label>
                                                                                                     </div>
                                                                                                     <div class="col-sm-8">
                                                                                                         <select class="form-control cns" id="cns"
                                                                                                                 name="cns[]" multiple="multiple">

                                                                                                             @foreach($cnsExams as $exam)
                                                                                                             <option
                                                                                                                     value="{{ $exam->name }}">{{ $exam->name }}</option>
                                                                                                             @endforeach
                                                                                                         </select>
                                                                                                     </div>
                                                                                                 </div>
                                                                                                 <div class="form-group row" id="resp">
                                                                                                     <div class="offset-sm-1 col-sm-3">
                                                                                                         <label> Respiratory System <span class="text-danger">*</span></label>
                                                                                                     </div>
                                                                                                     <div class="col-sm-8">
                                                                                                         <select class="form-control resp" id="resp"
                                                                                                                 name="resp[]" multiple="multiple">

                                                                                                             @foreach($respExams as $exam)
                                                                                                             <option
                                                                                                                     value="{{ $exam->name }}">{{ $exam->name }}</option>
                                                                                                             @endforeach
                                                                                                         </select>
                                                                                                     </div>
                                                                                                 </div>
                                                                                                 <div class="form-group row" id="cad">
                                                                                                     <div class="offset-sm-1 col-sm-3">
                                                                                                         <label> Cardio-Vascular <span class="text-danger">*</span></label>
                                                                                                     </div>
                                                                                                     <div class="col-sm-8">
                                                                                                         <select class="form-control cad" id="cad"
                                                                                                                 name="cad[]" multiple="multiple">

                                                                                                             @foreach($cadExams as $exam)
                                                                                                             <option
                                                                                                                     value="{{ $exam->name }}">{{ $exam->name }}</option>
                                                                                                             @endforeach
                                                                                                         </select>
                                                                                                     </div>
                                                                                                 </div>
                                                                                                 <div class="form-group row" id="abd">
                                                                                                     <div class="offset-sm-1 col-sm-3">
                                                                                                         <label> Abdominal <span class="text-danger">*</span></label>
                                                                                                     </div>
                                                                                                     <div class="col-sm-8">
                                                                                                         <select class="form-control abd" id="abd"
                                                                                                                 name="abd[]" multiple="multiple">

                                                                                                             @foreach($abdExams as $exam)
                                                                                                             <option
                                                                                                                     value="{{ $exam->name }}">{{ $exam->name }}</option>
                                                                                                             @endforeach
                                                                                                         </select>
                                                                                                     </div>
                                                                                                 </div>
                                                                                                 <div class="form-group row" id="uroF">
                                                                                                     <div class="offset-sm-1 col-sm-3">
                                                                                                         <label> Urogenital Female <span class="text-danger">*</span></label>
                                                                                                     </div>
                                                                                                     <div class="col-sm-8">
                                                                                                         <select class="form-control uroF" id="uroF"
                                                                                                                 name="uroF[]" multiple="multiple">

                                                                                                             @foreach($uroFemale as $exam)
                                                                                                             <option
                                                                                                                     value="{{ $exam->name }}">{{ $exam->name }}</option>
                                                                                                             @endforeach
                                                                                                         </select>
                                                                                                     </div>
                                                                                                 </div>
                                                                                                 <div class="form-group row" id="uroM">
                                                                                                     <div class="offset-sm-1 col-sm-3">
                                                                                                         <label> Urogenital Male <span class="text-danger">*</span></label>
                                                                                                     </div>
                                                                                                     <div class="col-sm-8">
                                                                                                         <select class="form-control uroM" id="uroM"
                                                                                                                 name="uroM[]" multiple="multiple">

                                                                                                             @foreach($uroMale as $exam)
                                                                                                             <option
                                                                                                                     value="{{ $exam->name }}">{{ $exam->name }}</option>
                                                                                                             @endforeach
                                                                                                         </select>
                                                                                                     </div>
                                                                                                 </div>
                                                                                                 <div class="form-group row" id="neuro">
                                                                                                     <div class="offset-sm-1 col-sm-3">
                                                                                                         <label> Neurologic <span class="text-danger">*</span></label>
                                                                                                     </div>
                                                                                                     <div class="col-sm-8">
                                                                                                         <select class="form-control neuro" id="neuro"
                                                                                                                 name="neuro[]" multiple="multiple">

                                                                                                             @foreach($neuroExams as $exam)
                                                                                                             <option
                                                                                                                     value="{{ $exam->name }}">{{ $exam->name }}</option>
                                                                                                             @endforeach
                                                                                                         </select>
                                                                                                     </div>
                                                                                                 </div>
                                                                                                 <div class="form-group row" id="gas">
                                                                                                     <div class="offset-sm-1 col-sm-3">
                                                                                                         <label> Gastrointestinal Tract <span
                                                                                                                     class="text-danger">*</span></label>
                                                                                                     </div>
                                                                                                     <div class="col-sm-8">
                                                                                                         <select class="form-control gas" id="gas"
                                                                                                                 name="gas[]" multiple="multiple">

                                                                                                             @foreach($gastroExams as $exam)
                                                                                                             <option
                                                                                                                     value="{{ $exam->name }}">{{ $exam->name }}</option>
                                                                                                             @endforeach
                                                                                                         </select>
                                                                                                     </div>
                                                                                                 </div>-->


                                                            <nav aria-label="breadcrumb">
                                                                <ol class="breadcrumb">
                                                                    <li class="breadcrumb-item active" aria-current="page"><b>DIAGNOSIS</b>
                                                                    </li>
                                                                </ol>
                                                            </nav>

                                                            <div class="form-group row">
                                                                <div class="offset-sm-1 col-sm-3">
                                                                    <label> Diagnosis <span class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text" name="diagnosis" class="form-control"/>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <div class="offset-sm-1 col-sm-3">
                                                                    <label> Differentials <span class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text" name="differentials" class="form-control"/>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row" >
                                                                <div class="offset-sm-1 col-sm-3">
                                                                    <label> Add Note <span class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-sm-8">

                                                                    <textarea name="examNote" class="form-control" >
                                                                     </textarea>

                                                                </div>

                                                            </div>



                                                            <!--      <h5>Subjective</h5>
                                                                  <textarea class="form-control" name="subjective" rows="5"></textarea>

                                                                  <h5>Objective</h5>
                                                                  <textarea class="form-control" name="objective" rows="5"></textarea>

                                                                  <h5>Assessment</h5>
                                                                  <textarea class="form-control" name="assessment" rows="5"></textarea>

                                                                  <h5>Plan</h5>
                                                                  <textarea class="form-control" name="plan" rows="5"></textarea>-->

                                                            <input type="submit" name="save_note" value="Save " class="btn-lg btn-success" />

                                                        </form>



                                                    </div>

                                                    <div class="tab-pane" id="SOAPHistory">

                                                        <h5>SOAP History</h5>

                                                        <div class="alert alert-info alert-dismissible" role="alert">
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                                                            </button>
                                                            <i class="fa fa-info-circle"></i> Most recent Patient's Medical History
                                                        </div>

                                                        <div id="accordion">
                                                            <?php
                                                            $vitals = Vitals::find_by_patient_vitals($patient->id);
                                                            $caseNotes = CaseNote::find_patient_case_note($patient->id);
                                                            foreach ($caseNotes as $caseNote) {
                                                                ?>

                                                                <div class="card">
                                                                    <div class="card-header">
                                                                        <a class="card-link" data-toggle="collapse" href="#collapse<?php echo $caseNote->id; ?>">
                                                                            <?php $d_date = date('d/m/Y h:i a', strtotime($caseNote->date));
                                                                            echo $d_date ?>
                                                                        </a>
                                                                    </div>
                                                                    <div id="collapse<?php echo $caseNote->id; ?>" class="collapse" data-parent="#accordion">
                                                                        <div class="card-body">

                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="table-responsive">

                                                                                        <div class="form-group row">

                                                                                            <div class="offset-sm-1 col-sm-11">

                                                                                                <table>
                                                                                                    <tr>
                                                                                                        <th>Complains</th>
                                                                                                        <td style="padding-left: 100px"><?php $decoded = json_decode($caseNote->complains);
                                                                                                            foreach ($decoded as $d){
                                                                                                                echo $d . ", ";
                                                                                                            }
                                                                                                            ?>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th>History Of Presenting Complains</th>
                                                                                                        <td style="padding-left: 100px"><?php echo $caseNote->hpc ?></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th>Duration</th>
                                                                                                        <td style="padding-left: 100px"><?php echo $caseNote->duration ?></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th>Systemic Review</th>
                                                                                                        <td style="padding-left: 100px"><?php echo $caseNote->sys_review ?></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th>Examinations</th>
                                                                                                        <td style="padding-left: 100px"><?php $decoded = json_decode($caseNote->examination);
                                                                                                            foreach ($decoded as $d){
                                                                                                                echo $d . ", ";
                                                                                                            }
                                                                                                            ?>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th> Diagnosis </th>
                                                                                                        <td style="padding-left: 100px"><?php echo $caseNote->diagnosis ?></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th> Differentials </th>
                                                                                                        <td style="padding-left: 100px"><?php echo $caseNote->differentials ?></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th> Notes </th>
                                                                                                        <td style="padding-left: 100px"><?php echo $caseNote->note ?></td>
                                                                                                    </tr>
                                                                                                </table>

                                                                                            </div>

                                                                                        </div>

                                                                                        <p class="text-info" style="font-size: larger"><code></code>
                                                                                            Done
                                                                                            By <?php echo $caseNote->consultant ?>
                                                                                        </p>

                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php } ?>

                                                        </div>



                                                    </div>

                                                    <div class="tab-pane" id="ClinicalHistory">

                                                        <?php include("../consult/patientHistory.php"); ?>

                                                    </div>

                                                    <div class="tab-pane" id="LaboratorySecond">


                                                        <div class="row">
                                                            <div class="col-md-7">

                                                                <ul class="nav nav-tabs-new2">
                                                                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#HaematologySecond">Haematology</a></li>
                                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#ChemicalSecond">Chemical Pathology</a></li>
                                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#MicrobiologySecond">Microbiology</a></li>
                                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#HistologySecond">Histology</a></li>
                                                                </ul>
                                                                <div class="tab-content">
                                                                    <div class="tab-pane show active" id="HaematologySecond">

                                                                        <h5>Haematology</h5>
                                                                        <div class="table-responsive">
                                                                            <table class="table table-striped">
                                                                                <thead>
                                                                                <tr>
                                                                                    <th>Name Of Investigation</th>
                                                                                    <!--  <th>Reference</th>-->
                                                                                </tr>
                                                                                </thead>
                                                                                <tbody id="testItemsSecond">
                                                                                <?php // $revs = Test::find_all();
                                                                                $revs = Test::find_all_by_unit_id(1);
                                                                                foreach ($revs as $rev) { ?>
                                                                                    <tr data-id="<?php echo $rev->revenueHead_id; ?>">
                                                                                        <td>
                                                                                            <div class="checkbox">
                                                                                                <label>
                                                                                                    <input type="checkbox" class="add_to_bill_second_consultant" value="" data-id="<?php echo $rev->id; ?>"><?php echo $rev->name; ?>
                                                                                                </label>
                                                                                            </div>

                                                                                        </td>
                                                                                        <!-- <td><?php /*echo $rev->reference */ ?></td>-->
                                                                                    </tr>
                                                                                <?php } ?>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>

                                                                    </div>
                                                                    <div class="tab-pane" id="ChemicalSecond">

                                                                        <h5>Chemical Pathology</h5>
                                                                        <div class="table-responsive">
                                                                            <table class="table table-striped">
                                                                                <thead>
                                                                                <tr>
                                                                                    <th>Name Of Investigation</th>
                                                                                    <!-- <th>Reference</th>-->
                                                                                </tr>
                                                                                </thead>
                                                                                <tbody id="chemItemsSecond">
                                                                                <?php // $revs = Test::find_all();
                                                                                $revs = Test::find_all_by_unit_id(2);
                                                                                foreach ($revs as $rev) { ?>
                                                                                    <tr data-id="<?php echo $rev->revenueHead_id; ?>">
                                                                                        <td>
                                                                                            <div class="checkbox"><label><input type="checkbox" class="add_to_bill_second_consultant" value="" data-id="<?php echo $rev->id; ?>"><?php echo $rev->name; ?>
                                                                                                </label>
                                                                                            </div>

                                                                                        </td>
                                                                                        <!--  <td><?php /*echo $rev->reference */ ?></td>-->
                                                                                    </tr>
                                                                                <?php } ?>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>

                                                                    </div>
                                                                    <div class="tab-pane" id="MicrobiologySecond">

                                                                        <h5> Microbiology </h5>
                                                                        <div class="table-responsive">
                                                                            <table class="table table-striped">
                                                                                <thead>
                                                                                <tr>
                                                                                    <th>Name Of Investigation</th>

                                                                                </tr>
                                                                                </thead>
                                                                                <tbody id="microItemsSecond">
                                                                                <?php // $revs = Test::find_all();
                                                                                $revs = Test::find_all_by_unit_id(3);
                                                                                foreach ($revs as $rev) { ?>
                                                                                    <tr data-id="<?php echo $rev->revenueHead_id; ?>">
                                                                                        <td>
                                                                                            <div class="checkbox"><label><input type="checkbox" class="add_to_bill_second_consultant" value="" data-id="<?php echo $rev->id; ?>"><?php echo $rev->name; ?>
                                                                                                </label>
                                                                                            </div>

                                                                                        </td>

                                                                                    </tr>
                                                                                <?php } ?>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>

                                                                    </div>
                                                                    <div class="tab-pane" id="HistologySecond">

                                                                        <h5> Histology </h5>


                                                                    </div>

                                                                </div>


                                                            </div>
                                                            <div class="col-md-5 bill" id="testCheckSecond">

                                                            </div>
                                                        </div>


                                                    </div>

                                                    <div class="tab-pane" id="RadiologySecond">


                                                        <div class="row">
                                                            <div class="col-md-7">

                                                                <ul class="nav nav-tabs-new2">
                                                                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#Home-new2Second">Radiology</a></li>
                                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Profile-new2Second"> Ultrasound Scan </a></li>
                                                                </ul>
                                                                <div class="tab-content">
                                                                    <div class="tab-pane show active" id="Home-new2Second">

                                                                        <h5>Radiology</h5>
                                                                        <div class="table-responsive">
                                                                            <table class="table table-striped">
                                                                                <thead>
                                                                                <tr>
                                                                                    <th>Name Of Investigation</th>

                                                                                </tr>
                                                                                </thead>
                                                                                <tbody id="radioItems">
                                                                                <?php // $revs = Test::find_all();
                                                                                $revs = Test::find_all_by_unit_id(4);
                                                                                foreach ($revs as $rev) { ?>
                                                                                    <tr data-id="<?php echo $rev->revenueHead_id; ?>">
                                                                                        <td>
                                                                                            <div class="checkbox"><label><input type="checkbox" class="add_to_bill_consultant" value="" data-id="<?php echo $rev->id; ?>"><?php echo $rev->name; ?>
                                                                                                </label>
                                                                                            </div>

                                                                                        </td>

                                                                                    </tr>
                                                                                <?php } ?>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>

                                                                    </div>
                                                                    <div class="tab-pane" id="Profile-new2Second">

                                                                        <h5> Ultrasound Scan </h5>
                                                                        <div class="table-responsive">
                                                                            <table class="table table-striped">
                                                                                <thead>
                                                                                <tr>
                                                                                    <th>Name Of Investigation</th>

                                                                                </tr>
                                                                                </thead>
                                                                                <tbody id="scanItems">
                                                                                <?php // $revs = Test::find_all();
                                                                                $revs = Test::find_all_by_unit_id(5);
                                                                                foreach ($revs as $rev) { ?>
                                                                                    <tr data-id="<?php echo $rev->revenueHead_id; ?>">
                                                                                        <td>
                                                                                            <div class="checkbox"><label><input type="checkbox" class="add_to_bill_consultant" value="" data-id="<?php echo $rev->id; ?>"><?php echo $rev->name; ?>
                                                                                                </label>
                                                                                            </div>

                                                                                        </td>

                                                                                    </tr>
                                                                                <?php } ?>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>

                                                                    </div>
                                                                </div>


                                                            </div>
                                                            <div class="col-md-5 bill" id="scanCheck">

                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="tab-pane" id="DrugSecond">

                                                        <div class="row clearfix">

                                                            <div class="col-sm-5">
                                                                <h5> Prescribe Drugs For Patient </h5>
                                                                <form id="formSearch">
                                                                    <div class=" form-group">
                                                                        <input type="text" placeholder="Name Of Drug" name="txtProduct" id="txtProduct" autocomplete="off" class="typeahead" />

                                                                        <button type="submit" id="submit" class="btn btn-lg btn-info" data-loading-text="Searching...">Search
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>

                                                            <div class="col-sm-7" id="save_page">
                                                                <?php
                                                                //  echo PatientBill::save_page();
                                                                ?>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="tab-pane" id="Appointment">
                                                        <h6>Book Appointment</h6>

                                                        <div class="row clearfix">

                                                            <div class="col-sm-6">

                                                                <form action="" method="post">
                                                                    <div class="form-group">
                                                                        <!-- <label>Select Date</label>-->
                                                                        <div class="input-group ">
                                                                            <span class="input-group-addon"></span>
                                                                            <input type="text" name="next_app" value="" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Hospital Clinic</label>
                                                                        <select class="form-control" id="clinic_id" name="clinic_id" required>
                                                                            <option value="">--Select Clinic--</option>
                                                                            <?php
                                                                            $finds = Clinic::find_all();
                                                                            foreach ($finds as $find) { ?>
                                                                                <option value="<?php echo $find->id; ?>"><?php echo $find->name; ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Sub-Clinic</label>
                                                                        <div id="sub_clinic_id">

                                                                        </div>
                                                                    </div>
                                                                    <button type="submit" name="save_appointment" class="btn btn-lg btn-primary">Save Appointment</button>
                                                                </form>

                                                            </div>

                                                            <div class="col-sm-6">
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="tab-pane" id="Refer">
                                                        <h5>Refer To Other Clinic</h5>

                                                        <div class="row clearfix">
                                                            <div class="col-lg-6 col-md-6 col-sm-6 ">
                                                                <!--   <h6>Refer patient to Other Clinics</h6>  -->

                                                                <form action="" method="post">
                                                                    <div class="form-group">
                                                                        <label>Hospital Clinic</label>
                                                                        <select class="form-control" id="clinic_id" name="clinic_id" required>
                                                                            <option value="">--Select Clinic--</option>
                                                                            <?php
                                                                            $finds = Clinic::find_all();
                                                                            foreach ($finds as $find) { ?>
                                                                                <option value="<?php echo $find->id; ?>"><?php echo $find->name; ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Sub-Clinic</label>
                                                                        <div id="sub_clinic_id">

                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Note to clinic</label>
                                                                        <textarea class='form-control' rows='5' cols='70' placeholder='Notes' name='clinic_note'></textarea>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <button type="submit" name="refer_patient" class="btn btn-success"> Refer Patient </button>
                                                                    </div>

                                                                </form>


                                                            </div>

                                                            <div class="col-lg-6 col-md-6 col-sm-6 ">
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="tab-pane" id="SymptomChecker">
                                                        <?php  include("symptom_checker.php"); ?>
                                                    </div>

                                                    <div class="tab-pane" id="DischargePatient">
                                                        <h5>Discharge Patient</h5>
                                                    </div>






                                                    <div class="tab-pane table-responsive" id="VitalHistory">

                                                    </div>

                                                    <div class="tab-pane" id="LabHistoryTwo">
                                                        <h2>Clinical History 2</h2>
                                                        <?php include('clinic_history.php')
                                                        ?>

                                                    </div>











                                                </div>





                                            </div>

                                        </div>





                                    </div>

                                </div>
                            </div>
                        </div>



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
                            <input type="text" class="form-control" placeholder="Give 6 digit CODE" maxlength="6" id="codeFour" />
                            <!--  <button type="submit" class="btn btn-primary">Validate</button> -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary ClosePayment">Submit</button>
                        <button type="button" class="btn btn-primary" id="closeBut" data-dismiss="modal" style="display:none;">CLOSE</button>
                </form>
            </div>

        </div>
    </div>
    <input type="hidden" id="lastPaymentId" />

    <?php
    require '../layout/footer.php';
    ?>


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

            $('#testItems').on('click', '.add_to_bill_second_consultant', function() {
                var id = $(this).data('id');
                $.post('../consultant/test_bill.php?id=' + id + ($(this)[0].checked ? '' : '&action=delete'), {
                        id: id
                    })
                    .done(function(data) {
                        $("#testCheck").html(data.bill);
                        //   $("#bill_count").html(data.items_count);
                    });
            });

            $('#testItemsSecond').on('click', '.add_to_bill_second_consultant', function() {
                var id = $(this).data('id');
                $.post('../consultant/test_bill.php?id=' + id + ($(this)[0].checked ? '' : '&action=delete'), {
                        id: id
                    })
                    .done(function(data) {
                        $("#testCheckSecond").html(data.bill);
                        //   $("#bill_count").html(data.items_count);
                    });
            });

            $('#radioItems').on('click', '.add_to_bill_consultant', function() {
                var id = $(this).data('id');
                $.post('../consultant/scan_bill.php?id=' + id + ($(this)[0].checked ? '' : '&action=delete'), {
                        id: id
                    })
                    .done(function(data) {
                        $("#scanCheck").html(data.bill);
                        //   $("#bill_count").html(data.items_count);
                    });
            });

            $('#scanItems').on('click', '.add_to_bill_consultant', function() {
                var id = $(this).data('id');
                $.post('../consultant/scan_bill.php?id=' + id + ($(this)[0].checked ? '' : '&action=delete'), {
                        id: id
                    })
                    .done(function(data) {
                        $("#scanCheck").html(data.bill);
                        //   $("#bill_count").html(data.items_count);
                    });
            });

            $('#chemItemsSecond').on('click', '.add_to_bill_second_consultant', function() {
                var id = $(this).data('id');
                $.post('../consultant/test_bill.php?id=' + id + ($(this)[0].checked ? '' : '&action=delete'), {
                        id: id
                    })
                    .done(function(data) {
                        $("#testCheckSecond").html(data.bill);
                        //   $("#bill_count").html(data.items_count);
                    });
            });

            $('#microItemsSecond').on('click', '.add_to_bill_second_consultant', function() {
                var id = $(this).data('id');
                $.post('../consultant/test_bill.php?id=' + id + ($(this)[0].checked ? '' : '&action=delete'), {
                        id: id
                    })
                    .done(function(data) {
                        $("#testCheckSecond").html(data.bill);
                        //   $("#bill_count").html(data.items_count);
                    });
            });


            $(".bed_location_id_doctor").change(function() {
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

            $(".ward_change_doctor").change(function() {
                $.ajax({
                    url: 'patient_detail.php',
                    data: {
                        location_id: $(".bed_location_id_doctor").val(),
                        ward_id_change_room: $(this).val()
                    },
                    type: "GET",
                    success: function(data) {
                        $(".room_no").empty();
                        $(".room_no").html(data);

                    },
                    error: function(error) {
                        alert("Error in connection");
                    }
                });
            });


            // Room number according to bed jquery
            $(".room_no").change(function() {
                //alert($(this).children("option:selected").html());
                var typeLog = $(".typeLogin").val();
                var patId = $("#pat_hide_id").val();
                $.ajax({
                    url: 'patient_detail.php',
                    data: {
                        bed_location_id: $(".bed_location_id_doctor").val(),
                        bed_ward_id_change_room: $(".ward_change_doctor").val(),
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
                $.post('test_bill.php?' + (param || '') + 'id=' + id, {
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
                                            location.reload(true);
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
                                location.reload(true);
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
                                location.reload(true);
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