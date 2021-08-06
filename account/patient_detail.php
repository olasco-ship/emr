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

        $referAdmission = new ReferAdmission();
        if (!empty($refAdmissionDetail->id)) {
            $referAdmission->id = $refAdmissionDetail->id;
        }



        //pre_d($bedListDa);die;

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
            $session->message("Save Refer/Admission");
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
        $urinalysis  = test_input($_POST['urinalysis']);
        $rbs         = test_input($_POST['rbs']);
        $comment     = test_input($_POST['comment']);


        $clinic_id = test_input($_POST['clinic_id']);
        $json = "";


        if ((!$errMessage) and (empty($errMessage))) {
            $vitals                  = new Vitals();
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




require('../layout/header.php');


?>


<input type="hidden" value="<?= $_GET['id'] ?>" id="pat_hide_id" />

<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>
                        <?php echo "Account Dashboard - " . $patient->title . " " . $patient->full_name(); ?>
                    </h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">In Patient Details</li>
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
        <input type="hidden" value="patient_detail.php" class="typeLogin" />

        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card">

                    <div class="body">

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
                                                    <li class="nav-item"><a class="nav-link nav-link-goto active show" data-toggle="tab" href="#Admit-pat"> Patient's Details </a></li>
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#WalletBalance">Patient's Wallet</a></li>
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

                                                                <!--
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
                                                                -->

                                                                <div class="row clearfix">
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label>Date Of Birth</label>
                                                                            <input type="text" class="form-control" name="dob" id="" placeholder="dd-mm-yyyy" value="<?php echo date("Y-m-d", strtotime($patient->dob)); ?>" required="" readonly>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label> Age </label>
                                                                            <input type="text" class="form-control" name="dob" id="" placeholder="dd-mm-yyyy" value="<?php echo getAge($patient->dob) . "years"; ?>" required="" readonly>
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
                                                                            <input type="date" class="form-control" id="adm_date" name="adm_date" value="<?php echo date("Y-m-d", strtotime($refAdmissionDetail->adm_date)); ?>" readonly />
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
                                                                            <select class="form-control room_no_nurse" name="room_no">
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
                                                                            <select class="form-control bed_no" name="bed_no">
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

                                                                <!--
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
                                                                -->

                                                                <div class="row clearfix">
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label>Payment Type</label>
                                                                            <input type="text" class="form-control" placeholder="Cash" id="" value="Cash" name="payment_type" readonly>
                                                                        </div>
                                                                    </div>

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

                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label class="control-label">Wallet Balance</label>
                                                                            <input type="text" class="form-control wallBalance" placeholder="" id="wall_balance" name="wall_balance" readonly value="<?= (!empty($refAdmissionDetail->wall_balance)) ? $refAdmissionDetail->wall_balance : '' ?>">
                                                                        </div>
                                                                    </div>





                                                                </div>

                                                                <!--
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
                                                                -->

                                                                <!--
                                                                <div class="form-group">
                                                                    <label> Remarks Doctor </label>
                                                                    <textarea class="form-control" name="remark" readonly rows="3" cols="10"><?= (!empty($refAdmissionDetail->remark)) ? $refAdmissionDetail->remark : '' ?></textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label> Remarks Nurse </label>
                                                                    <textarea class="form-control" name="remark_nurse" rows="3" cols="10"><?= (!empty($refAdmissionDetail->remark_nurse)) ? $refAdmissionDetail->remark_nurse : '' ?></textarea>
                                                                </div>
                                                                -->

                                                                <div class="form-group">
                                                                    <!--    <input type="submit" value="Save" class="btn btn-primary" /> -->
                                                                    <?php
                                                                    if (!empty($singleReferData)) {
                                                                    ?>
                                                                        <a href="pdfGenerate.php?id=<?= $_GET['id']; ?>" target="_blank" class="btn btn-primary">Print Patient's Statement</a>
                                                                    <?php
                                                                    } ?>
                                                                </div>

                                                            </div>




                                                        </form>
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
                                                                                <td><?php if ($h->credit != 0) {
                                                                                        echo "<span class='badge badge-success'>CREDIT</span>";
                                                                                    } else {
                                                                                        echo "<span class='badge badge-danger'>DEBIT</span>";
                                                                                    }
                                                                                    ?>
                                                                                </td>
                                                                                <!--  <td><span class="badge badge-success">STATUS</span></td> -->

                                                                            </tr>

                                                                        <?php }

                                                                        ?>

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