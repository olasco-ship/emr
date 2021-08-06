<?php

/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 5/24/2019
 * Time: 9:19 AM
 */

require_once "../includes/initialize.php";
require_once("../symptom_checker/table/SymptomResultTable.php");
//For search ward according to location
if (!empty($_GET['ward_id'])) {

    $wardDetail = new Wards();
    $wDetail = $wardDetail->find_by_location_id_pat_admit($_GET['ward_id']);
    if (!empty($wDetail)) {
        $data = "<option>-- Select Ward --</option>";
        foreach ($wDetail as $wdata) {
            $data .= "<option value='" . $wdata->id . "'>" . $wdata->ward_number . "</option>";
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
    $roomList = $bed->find_by_ward_location_id($_GET['location_id'], $_GET['ward_id_change_room']);
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
        $bedListOption = "<option>-- Select Room --</option>";
        for ($iAjax = $bedList->bed_no_to; $iAjax <= $bedList->bed_no_from; $iAjax++) {
            $bedListOption .=  "<option value='" . $iAjax . "'>" . $iAjax . "</option>";
        }
    } else {
        $bedListOption = "<option>-- No Room Found --</option>";
    }
    echo $bedListOption;
    exit();
}

$emergency = Emergency::find_by_id($_GET['id']);

//$waiting_list = WaitingList::find_by_id($_GET['id']);
//$cancelAdmission = new CancleAdmission();




$user = User::find_by_id($session->user_id);


if (is_post()) {
 

    if (isset($_POST['save_test'])) {

        $items = TestBill::get_bill();
        $item = $items[0];
     //     print_r($items);
     //     echo "<br/>";
     //     echo count($items);
     //    exit;
	

        $testRequest                  = new EmergencyTestRequest();
        $testRequest->sync            = "off";
        $testRequest->emergency_id    = $emergency->id;      
        $testRequest->bill_id         = 0;
        $testRequest->consultant      = $user->full_name();
        $testRequest->test_no         = count($items);
        $testRequest->doc_com         = $_POST['doc_com'];
        $testRequest->status          = "OPEN";
        $testRequest->receipt         = "";
        $testRequest->date            = strftime("%Y-%m-%d %H:%M:%S", time());
        if ($testRequest->save()) {
            foreach ($items as $item) {
                $test = Test::find_by_id($item->id);

                $eachTest                     = new EachTest();
                $eachTest->test_id            = $test->id;
                $eachTest->em_test_request_id = $testRequest->id;
                $eachTest->test_request_id    = 0;
                $eachTest->quantity           = 1;
                $eachTest->sync               = "off";
                $eachTest->test_name          = $test->name;
                $eachTest->consultant         = $user->full_name();
                $eachTest->testResult         = "";
                $eachTest->scientist          = "";
                $eachTest->pathologist        = "";
                $eachTest->status             = "REQUEST";
                $eachTest->date               = strftime("%Y-%m-%d %H:%M:%S", time());
                $eachTest->save();
            }
            $session->message("Lab Investigations has been requested for this patient");
            redirect_to("em_dash.php?id=$emergency->id");
            // redirect_to();
        }
    }

    if (isset($_POST['save_scan'])) {

        //   $items = TestBill::get_bill();
        $items = ScanBill::get_bill();
        $item = $items[0];

        $scanRequest = new ScanRequest();
        $scanRequest->waiting_list_id = $waiting_list->id;
        $scanRequest->ref_adm_id      = 0;
        $scanRequest->patient_id      = $patient->id;
        $scanRequest->bill_id         = 0;
        $scanRequest->consultant = $user->full_name();
        $scanRequest->scan_no    = count($items);
        $scanRequest->not_done   = count($items);
        $scanRequest->doc_com = $_POST['doc_com'];
        $scanRequest->scan_com = "";
        $scanRequest->status = "OPEN";
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
                $eachScan->scientist = "";
                $eachScan->radiologist = "";
                $eachScan->status = "REQUEST";
                $eachScan->date = strftime("%Y-%m-%d %H:%M:%S", time());
                $eachScan->save();
            }
            $session->message("Investigations has been requested for this patient");
            redirect_to("dashboard.php?id=$waiting_list->id");
        }
    }

    if (isset($_POST['save_drug'])) {
        //   $items = TestBill::get_bill();
        $items = PatientBill::get_bill();
        $item = $items[0];

        $drugRequest = new DrugRequest();
        $drugRequest->waiting_list_id = $waiting_list->id;
        $drugRequest->ref_adm_id      = 0;
        $drugRequest->patient_id      = $patient->id;
        $drugRequest->bill_id         = 0;
        $drugRequest->consultant      = $user->full_name();
        $drugRequest->drugs_no        = count($items);
        $drugRequest->not_available   = count($items);
        $drugRequest->doc_com         = $_POST['doc_com'];
        $drugRequest->pharm_com       = "";
        $drugRequest->status          = "OPEN";
        $drugRequest->receipt         = "";
        $drugRequest->date            = strftime("%Y-%m-%d %H:%M:%S", time());

        if ($drugRequest->save()) {
            //   foreach ($items as $item) {
            foreach ($items as $keys => $item) {
                $product = Product::find_by_id($item->id);

                $eachDrug = new EachDrug();
                $eachDrug->sync = "";
                $eachDrug->drug_request_id = $drugRequest->id;
                $eachDrug->product_id = $product->id;
                $eachDrug->product_name = $product->name;
                //   $eachDrug->quantity   = $_POST['quantity'][$keys];
                //   $eachDrug->dosage     = $_POST['dosage'][$keys];
                $eachDrug->quantity   = $item->quantity;
                $eachDrug->dosage     = $item->dosage;
                $eachDrug->consultant = $user->full_name();
                $eachDrug->pharmacy   = "";
                $eachDrug->status     = "REQUEST";
                $eachDrug->date      = strftime("%Y-%m-%d %H:%M:%S", time());
                $eachDrug->save();
            }
            $session->message("Prescription has been done for this patient");
            redirect_to("dashboard.php?id=$waiting_list->id");
            // redirect_to();
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
        $appointment->ref_adm_id      = 0;
        $appointment->sub_clinic_id   = $waiting_list->sub_clinic_id;
        $appointment->consultant      = $user->full_name();
        $appointment->status          = "PENDING";
        $appointment->date            = strftime("%Y-%m-%d %H:%M:%S", time());
        $appointment->save();
        $session->message("Appointment has been booked for this patient");
        redirect_to("dashboard.php?id=$waiting_list->id");
    }

    if (isset($_POST['refer_patient'])) {

        $clinic_id    = test_input($_POST['clinic_id']);

        $sub_clinic_id = test_input($_POST['sub_clinic_id']);

        $clinic_note  = test_input($_POST['clinic_note']);

        $referral                         = new Referrals();
        $referral->sync                   = "off";
        $referral->patient_id             = $patient->id;
        $referral->waiting_list_id        = $waiting_list->id;
        $referral->ref_adm_id             = 0;
        $referral->current_sub_clinic_id  = $waiting_list->sub_clinic_id;
        $referral->referred_sub_clinic_id = $sub_clinic_id;
        $referral->consultant             = $user->full_name();
        $referral->referral_note          = $clinic_note;
        $referral->status                 = "PENDING";
        $referral->date                   = strftime("%Y-%m-%d %H:%M:%S", time());
        $referral->save();
        $session->message("Patient has been referred!");
        redirect_to("dashboard.php?id=$waiting_list->id");
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
        $caseNote->ref_adm_id      = 0;
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
        redirect_to("dashboard.php?id=$waiting_list->id");
    }

    if (isset($_POST['final_review'])) {

        //   echo "final";  // exit;

        $waitList = WaitingList::find_by_id($waiting_list->id);

        //   $patConRoom = PatientConsultingRooms::find_all();

        $patConRoom = PatientConsultingRooms::find_patient_in_room($waitList->patient_id, $waitList->room_id);
        if (!empty($patConRoom)) {
            $patConRoom->delete();
        }


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
            redirect_to("clinic.php?id=$waiting_list->clinic_id");
          //  redirect_to("dashboard.php?id=$waiting_list->id");
        }
    }
}

PatientBill::clear_all_bill();
ScanBill::clear_all_bill();
TestBill::clear_all_bill();


require '../layout/header.php';


?>


<input type="hidden" value="<?= $_GET['id'] ?>" id="pat_hide_id" />
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>
                        <?php  echo "Medical Dashboard - " . $emergency->emergency_no  ?>
                    </h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Treatment</li>
                        <li class="breadcrumb-item active"> History</li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-4 col-sm-12 text-right">
                    <div class="bh_chart hidden-xs">
                        <div class="float-left m-r-15">
                            <small>Visitors</small>
                            <h6 class="mb-0 mt-1"><i class="icon-user"></i> 1,784</h6>
                        </div>
                        <span class="bh_visitors float-right">2,5,1,8,3,6,7,5</span>
                    </div>
                    <div class="bh_chart hidden-sm">
                        <div class="float-left m-r-15">
                            <small>Visits</small>
                            <h6 class="mb-0 mt-1"><i class="icon-globe"></i> 325</h6>
                        </div>
                        <span class="bh_visits float-right">10,8,9,3,5,8,5</span>
                    </div>
                    <div class="bh_chart hidden-sm">
                        <div class="float-left m-r-15">
                            <small>Chats</small>
                            <h6 class="mb-0 mt-1"><i class="icon-bubbles"></i> 13</h6>
                        </div>
                        <span class="bh_chats float-right">1,8,5,6,2,4,3,2</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Button to Open the Modal -->

        <input type="hidden" value="../revenue/beds.php" class="urlWard" />
        <input type="hidden" value="dashboard.php" class="typeLogin" />
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card">

                    <div class="body">

                        <div class="col-lg-12 col-md-12">


                            <ul class="nav nav-tabs-new2">
                                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#new_treatment">New Treatment</a></li>
                              <!--  <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#patient_profile">Patient's Profile</a></li>  -->
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#clinical_history">Clinical History</a></li>

                            </ul>

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

                                    <div class="tab-content">

                                        <div class="tab-pane show active" id="new_treatment">


                                            <div class="body">
                                                <ul class="nav nav-tabs-new" style="border-bottom: 1px solid #01b2c6;">
                                                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#Laboratory">Laboratory</a></li>
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Radiology">Radiology/Ultrasound</a></li>
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Drug">Drug Prescription</a></li>
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#SOAP">SOAP</a></li>
                                                    <!--
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#SymptomChecker">Symptom Checker</a></li>
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Appointment">Book Appointment</a></li>
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Refer">Refer </a></li>
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Admission">Admission </a></li>                                              
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Review">Final Review </a></li>
                                                    -->

                                                </ul>
                                                <div class="tab-content">

                                                    <div class="tab-pane show active" id="Laboratory">

                                                        <div class="row">
                                                            <div class="col-md-7">

                                                                <ul class="nav nav-tabs-new2">
                                                                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#Haematology">Haematology</a></li>
                                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Chemical">Chemical Pathology</a></li>
                                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Microbiology">Microbiology</a></li>
                                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Histology">Histology</a></li>
                                                                </ul>
                                                                <div class="tab-content">
                                                                    <div class="tab-pane show active" id="Haematology">

                                                                        <h5>Haematology</h5>
                                                                        <div class="table-responsive">
                                                                            <table class="table table-striped">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Name Of Investigation</th>
                                                                                        <!--  <th>Reference</th>-->
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody id="testItems">
                                                                                    <?php // $revs = Test::find_all();
                                                                                    $revs = Test::find_all_by_unit_id(1);
                                                                                    foreach ($revs as $rev) { ?>
                                                                                        <tr data-id="<?php echo $rev->revenueHead_id; ?>">
                                                                                            <td>
                                                                                                <div class="checkbox">
                                                                                                    <label>
                                                                                                        <input type="checkbox" class="add_to_bill" value="" data-id="<?php echo $rev->id; ?>"><?php echo $rev->name; ?>
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
                                                                    <div class="tab-pane" id="Chemical">

                                                                        <h5>Chemical Pathology</h5>
                                                                        <div class="table-responsive">
                                                                            <table class="table table-striped">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Name Of Investigation</th>
                                                                                        <!-- <th>Reference</th>-->
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody id="chemItems">
                                                                                    <?php // $revs = Test::find_all();
                                                                                    $revs = Test::find_all_by_unit_id(2);
                                                                                    foreach ($revs as $rev) { ?>
                                                                                        <tr data-id="<?php echo $rev->revenueHead_id; ?>">
                                                                                            <td>
                                                                                                <div class="checkbox"><label><input type="checkbox" class="add_to_bill" value="" data-id="<?php echo $rev->id; ?>"><?php echo $rev->name; ?>
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
                                                                    <div class="tab-pane" id="Microbiology">

                                                                        <h5> Microbiology </h5>
                                                                        <div class="table-responsive">
                                                                            <table class="table table-striped">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Name Of Investigation</th>

                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody id="microItems">
                                                                                    <?php // $revs = Test::find_all();
                                                                                    $revs = Test::find_all_by_unit_id(3);
                                                                                    foreach ($revs as $rev) { ?>
                                                                                        <tr data-id="<?php echo $rev->revenueHead_id; ?>">
                                                                                            <td>
                                                                                                <div class="checkbox"><label><input type="checkbox" class="add_to_bill" value="" data-id="<?php echo $rev->id; ?>"><?php echo $rev->name; ?>
                                                                                                    </label>
                                                                                                </div>

                                                                                            </td>

                                                                                        </tr>
                                                                                    <?php } ?>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>

                                                                    </div>
                                                                    <div class="tab-pane" id="Histology">

                                                                        <h5> Histology </h5>


                                                                    </div>

                                                                </div>


                                                            </div>
                                                            <div class="col-md-5 bill" id="testCheck">

                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="tab-pane" id="Radiology">

                                                        <div class="row">
                                                            <div class="col-md-7">

                                                                <ul class="nav nav-tabs-new2">
                                                                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#Home-new2">Radiology</a></li>
                                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Profile-new2"> Ultrasound Scan </a></li>
                                                                </ul>
                                                                <div class="tab-content">
                                                                    <div class="tab-pane show active" id="Home-new2">

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
                                                                                                <div class="checkbox"><label><input type="checkbox" class="add_to_bill" value="" data-id="<?php echo $rev->id; ?>"><?php echo $rev->name; ?>
                                                                                                    </label>
                                                                                                </div>

                                                                                            </td>

                                                                                        </tr>
                                                                                    <?php } ?>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>

                                                                    </div>
                                                                    <div class="tab-pane" id="Profile-new2">

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
                                                                                                <div class="checkbox"><label><input type="checkbox" class="add_to_bill" value="" data-id="<?php echo $rev->id; ?>"><?php echo $rev->name; ?>
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

                                                    <div class="tab-pane" id="Drug">




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
                                                                echo PatientBill::save_page();
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

                                                    <div class="tab-pane" id="Admission">


                                                     


                                                    </div>


                                                    <div class="tab-pane" id="SOAP">
                                                        <h6>SOAP</h6>

                                                        <form action="" method="post">

                                                            <!--<textarea id="markdown-editor"  name="case_note" data-provide="markdown" rows="10" cols="100"></textarea>-->
                                                            <h5>Subjective</h5>
                                                            <textarea class="form-control" name="subjective" rows="5"></textarea>

                                                            <h5>Objective</h5>
                                                            <textarea class="form-control" name="objective" rows="5"></textarea>

                                                            <h5>Assessment</h5>
                                                            <textarea class="form-control" name="assessment" rows="5"></textarea>

                                                            <h5>Plan</h5>
                                                            <textarea class="form-control" name="plan" rows="5"></textarea>

                                                            <input type="submit" name="save_note" value="Save Note" class="btn-lg btn-success" />

                                                        </form>



                                                    </div>

                                                    <div class="tab-pane" id="SymptomChecker">
                                                        <?php include("symptom_checker.php"); ?>
                                                    </div>

                                                    <div class="tab-pane" id="Review">
                                                        <h4>Final Review </h4>




                                                    </div>





                                                </div>




                                            </div>



                                        </div>


                                        <div class="tab-pane" id="clinical_history">



                                            <div class="container">
                                                <h5>Symptom Result</h5>
                                                <div class="row">
                                                    <div class="col-md-12">

                                                        <div class="table-responsive">
                                                            <table class="table table-striped">
                                                                <thead>
                                                                    <tr>
                                                                        <!-- <th>Question</th> -->
                                                                        <th>Result Description</th>
                                                                        <th>Result Precaution</th>
                                                                        <th>Result Remedies</th>
                                                                        <th>Result Status</th>
                                                                        <th>Date</th>
                                                                    </tr>
                                                                </thead>
                                                                <?php
                                                                $symptomResultData = SymptomResultTable::find_by_user_id($patient->id);

                                                                //$symptomAnswer = SymptomAnswerTable::find_by_user_id_all($patient->id)  ;
                                                                if (!empty($symptomResultData)) {
                                                                    foreach ($symptomResultData as $k => $rev) {
                                                                        //$questionName = QuestionTable::find_by_id($rev->question_id);

                                                                        // $answervalue = json_decode(($questionName->answer_value));
                                                                        // $answerLabel = json_decode(($questionName->answer_label));
                                                                        // $optAnswerValue = json_decode(($rev->answer));
                                                                        // $optKety = "";

                                                                        //pre_d($optKety);
                                                                ?>
                                                                        <tr>

                                                                            <td><?= $rev->result_desc ?></td>
                                                                            <td><?= $rev->result_precau ?></td>
                                                                            <td><?= $rev->result_remedies ?></td>
                                                                            <td><?= $rev->result_status ?></td>
                                                                            <td><?= date("m-d-Y", strtotime($rev->created)) ?></td>
                                                                        </tr>
                                                                <?php
                                                                    }
                                                                } ?>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>



                                    </div>



                                </div>








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
                    url: 'test_bill.php',
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
                url: 'test_bill_new.php',
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


        // Search Ward according to location
        $(".bed_location_id_doctors").change(function() {
            var urls = $(".urlWard").val();
            //'../revenue/beds.php',
            $.ajax({
                url: "dashboard.php",
                data: {
                    ward_id: $(this).val()
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