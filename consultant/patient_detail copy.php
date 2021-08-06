<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 5/24/2019
 * Time: 9:19 AM
 */

require_once "../includes/initialize.php";

//For show List of room according to ward
if(!empty($_GET['ward_id_change_room'])){
    
    $bed = new Beds();
    $roomList = $bed->find_by_ward_location_id($_GET['location_id'] ,$_GET['ward_id_change_room']);
    if(!empty($roomList)){
        $roomListOption = "<option>-- Select Room --</option>";
        foreach($roomList as $roomListData){
            $roomListOption .= "<option value='".$roomListData->id."'>".$roomListData->room_number."</option>";
        }
    }else{
        $roomListOption = "<option>-- No Room Found --</option>";
    }
    echo $roomListOption;
    exit();
}

//For show List of room according to ward
if(!empty($_GET['room_no_id'])){
    
    $bed = new Beds();
    $bedList = $bed->find_bed_by_room_id($_GET['bed_location_id'] ,$_GET['bed_ward_id_change_room'], $_GET['room_no_id']);
    //pre_d($bedList);die;
    if(!empty($bedList)){
        $bedListOption = "<option>-- Select Room --</option>";
        for($iAjax = $bedList->bed_no_to; $iAjax <= $bedList->bed_no_from; $iAjax++){
            $bedListOption .=  "<option value='".$iAjax."'>".$iAjax."</option>";
        }
    }else{
        $bedListOption = "<option>-- No Room Found --</option>";
    }
    echo $bedListOption;
    exit();
}


$waiting_list = WaitingList::find_by_id($_GET['id']);
$cancelAdmission = new CancleAdmission();

$cancelAdmissionDetail = $cancelAdmission->find_by_pat_id($waiting_list->patient_id);

$patient = Patient::find_by_id($waiting_list->patient_id);
$refAdmissionDetail = ReferAdmission::find_by_bill_id($waiting_list->patient_id);
$allRefData = ReferAdmission::find_all();
$waitingConsultation = WaitingList::find_all_waiting_consultation_count($_GET['id']);
$countWaitPatient = count($waitingConsultation) + 1;
$countWaitPatient = count($allRefData) + 1; 
$refAdmissionDetail = $refAdmissionDetail[0];
$singleReferData = ReferAdmission::find_by_bill_id($waiting_list->patient_id);
$location = Locations::find_all();
$bedSlisting = new Beds();
$roomListData = $bedSlisting->find_by_ward_location_id($refAdmissionDetail->location ,$refAdmissionDetail->ward_no);


$bedNumberListStart = "0";
$bedNumberListEnd = "0";
foreach($roomListData as $RLD){
    //pre_d($RLD);
    if($RLD->id == $refAdmissionDetail->room_no){
        $bedNumberListStart = $RLD->bed_no_to;
        $bedNumberListEnd = $RLD->bed_no_from;
    }
}
// pre_d($bedNumberListStart);
// pre_d($bedNumberListEnd);
// die;


// For edit time show selected ward
    $wardDetail = new Wards();
    //pre_d($_GET);die;
    $wDetail = $wardDetail->find_by_location_id($refAdmissionDetail->location);
    
    if(!empty($wDetail)){        
        $sel = "";
        foreach($wDetail as $wdata){
            if($refAdmissionDetail->ward_no == $wdata->id){
                $sel = "selected='selected'";
            }else{
                $sel = "";
            }
            $dataWard .= "<option value='".$wdata->id."' ".$sel.">".$wdata->ward_number."</option>";
        }
        
    }else{
        $dataWard = "<option>-- No Ward found --</option>";
        
    }
    


$numPrint = "";
if($countWaitPatient < 10){
    $numPrint = "00".$countWaitPatient;
}else if($countWaitPatient > 10 && $countWaitPatient < 99){
    $numPrint = "0".$countWaitPatient;
}else if($countWaitPatient > 99 ){
    $numPrint = $countWaitPatient;
}
$user = User::find_by_id($session->user_id);

//$vital = Vitals::find_by_patient($patient->id);

if (is_post()) {

    if (isset($_POST['patient_id'])) {
        
        $referAdmission = new ReferAdmission();
        if(!empty($refAdmissionDetail->id)){
            $referAdmission->id = $refAdmissionDetail->id;
        }
        
        $datetime = $_POST['adm_date']." ".$_POST['usr_time'].":00";
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
        $referAdmission->created = date("Y-m-d h:i:s");
        if($_SESSION['department'] == "Nursing"){
            $referAdmission->nurse_id = $_SESSION['user_id'];
        }
        $a = $referAdmission->save();
        if ($a) {
            $session->message("Save Refer/Admission");
            redirect_to("patient_detail.php?id=$waiting_list->id");
        } else {
            $session->message("Not Save");
            redirect_to("patient_detail.php?id=$waiting_list->id");
        }
    }


    if(isset($_POST['reason'])){
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
        //pre_d($cancelAdmission);die;
        $canc = $cancelAdmission->save();
        if($canc){
            $session->message("Successfully cancel admission");
            redirect_to("patient_detail.php?id=$waiting_list->id");
        }else{
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

        $testRequest = new TestRequest();
        $testRequest->waiting_list_id = $waiting_list->id;
        $testRequest->patient_id = $patient->id;
        $testRequest->consultant = $user->full_name();
        $testRequest->test_no = count($items);
        $testRequest->doc_com = $_POST['doc_com'];
        $testRequest->lab_com = "";
        $testRequest->status = "";
        $testRequest->receipt = "";
        $testRequest->date = strftime("%Y-%m-%d %H:%M:%S", time());
        if ($testRequest->save()) {
            foreach ($items as $item) {
                $test = Test::find_by_id($item->id);

                $eachTest = new EachTest();
                $eachTest->test_id = $test->id;
                $eachTest->test_request_id = $testRequest->id;
                $eachTest->sync = "off";
                $eachTest->test_name = $test->name;
                $eachTest->consultant = $user->full_name();
                $eachTest->testResult = "";
                $eachTest->scientist = "";
                $eachTest->pathologist = "";
                $eachTest->status = "REQUEST";
                $eachTest->date = strftime("%Y-%m-%d %H:%M:%S", time());
                $eachTest->save();
            }
            $session->message("Lab Investigations has been requested for this patient");
            redirect_to("dashboard.php?id=$waiting_list->id");
            // redirect_to();
        }

    }

    if (isset($_POST['save_scan'])) {

        //   $items = TestBill::get_bill();
        $items = ScanBill::get_bill();
        $item = $items[0];

        $scanRequest = new ScanRequest();
        $scanRequest->waiting_list_id = $waiting_list->id;
        $scanRequest->patient_id = $patient->id;
        $scanRequest->consultant = $user->full_name();
        $scanRequest->scan_no = count($items);
        $scanRequest->doc_com = $_POST['doc_com'];
        $scanRequest->scan_com = "";
        $scanRequest->status = "";
        $scanRequest->receipt = "";
        $scanRequest->date = strftime("%Y-%m-%d %H:%M:%S", time());
        if ($scanRequest->save()) {
            foreach ($items as $item) {
                $test = Test::find_by_id($item->id);

                $eachScan = new EachScan();
                $eachScan->scan_id = $test->id;
                $eachScan->scan_request_id = $scanRequest->id;
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
        $drugRequest->patient_id = $patient->id;
        $drugRequest->consultant = $user->full_name();
        $drugRequest->drugs_no = count($items);
        $drugRequest->doc_com = $_POST['doc_com'];
        $drugRequest->pharm_com = "";
        $drugRequest->status = "";
        $drugRequest->receipt = "";
        $drugRequest->date = strftime("%Y-%m-%d %H:%M:%S", time());

        if ($drugRequest->save()) {
            foreach ($items as $item) {
                $product = Product::find_by_id($item->id);

                $eachDrug = new EachDrug();
                $eachDrug->sync = "";
                $eachDrug->drug_request_id = $drugRequest->id;
                $eachDrug->product_id = $product->id;
                $eachDrug->product_name = $product->name;
                $eachDrug->quantity = $product->quantity;
                $eachDrug->dosage = $product->dosage;
                $eachDrug->consultant = $user->full_name();
                $eachDrug->pharmacy = "";
                $eachDrug->status = "REQUEST";
                $eachDrug->date = strftime("%Y-%m-%d %H:%M:%S", time());
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
        $appointment->sub_clinic_id   = $waiting_list->sub_clinic_id;
        $appointment->consultant      = $user->full_name();
        $appointment->status          = "PENDING";
        $appointment->date            = strftime("%Y-%m-%d %H:%M:%S", time());
        $appointment->save();
        $session->message("Appointment has been booked for this patient");
        redirect_to("dashboard.php?id=$waiting_list->id");

    }

    if (isset($_POST['refer_patient'])){

        $clinic_id    = test_input($_POST['clinic_id']);

        $sub_clinic_id = test_input($_POST['sub_clinic_id']);

        $clinic_note  = test_input($_POST['clinic_note']);

        $referral                         = new Referrals();
        $referral->sync                   = "off";
        $referral->patient_id             = $patient->id;
        $referral->waiting_list_id        = $waiting_list->id;
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

    if (isset($_POST['save_note'])){

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
        redirect_to("dashboard.php?id=$waiting_list->id");



    }

    if (isset($_POST['final_review'])) {

     //   echo "final";  // exit;

        $waitList = WaitingList::find_by_id($waiting_list->id);

    //    echo $waitList->id;   exit;

        $waitList->status = "consultation done";
        if ($waitList->save()){
            if (!empty(TestRequest::find_by_waiting_list_id($waitList->id))){
                $tRequest = TestRequest::find_by_waiting_list_id($waitList->id);
                $tRequest->status = "awaiting_costing";
                
              //  $tRequest->save();
                if ($tRequest->save()){
                    $eT = EachTest::find_all_requests($tRequest->id);
                    foreach ($eT as $e){
                        $e->status = "OPEN";
                        $e->save();
                    }

                }

            }
            if (!empty(ScanRequest::find_by_waiting_list_id($waitList->id))){
                $sRequest = ScanRequest::find_by_waiting_list_id($waitList->id);
                $sRequest->status = "awaiting_costing";
              //  $sRequest->save();
                if ($sRequest->save()){
                    $eS = EachScan::find_all_requests($sRequest->id);
                    foreach ($eS as $e){
                        $e->status = "OPEN";
                        $e->save();
                    }
                }
            }
            if (!empty(DrugRequest::find_by_waiting_list_id($waitList->id))){
                $dRequest = DrugRequest::find_by_waiting_list_id($waitList->id);
                $dRequest->status = "awaiting_costing";
             //   $dRequest->save();
                if ($dRequest->save()){
                    $eD = EachDrug::find_all_requests($dRequest->id);
                    foreach ($eD as $e){
                        $e->status = "OPEN";
                        $e->save();
                    }
                }
            }
            if (!empty(Appointment::find_by_waiting_list_id($waitList->id))){
                $aRequest = Appointment::find_by_waiting_list_id($waitList->id);
                $aRequest->status = "OPEN";
                $aRequest->save();
            }
            if (!empty(Referrals::find_by_waiting_list_id($waitList->id))){
                $rRequest = Referrals::find_by_waiting_list_id($waitList->id);
                $rRequest->status = "OPEN";
                $rRequest->save();
            }
            $session->message("Patient's treatment has been completed!");
            redirect_to("dashboard.php?id=$waiting_list->id");



        }





    }

}

PatientBill::clear_all_bill();
ScanBill::clear_all_bill();
TestBill::clear_all_bill();

require '../layout/header.php';
?>

                
<input type="hidden" value="<?= $_GET['id'] ?>" id="pat_hide_id"/>
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                                    class="fa fa-arrow-left"></i></a>
                            <?php echo "Medical Dashboard - " . $patient->title . " " . $patient->full_name(); ?>
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

            <input type="hidden" value="../revenue/beds.php" class="urlWard"/>
            <input type="hidden" value="patient_detail.php" class="typeLogin"/>
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">

                        <div class="body">

                            <div class="col-lg-12 col-md-12">
                        <div class="card">
                                    <div class="body">

                                        <?php
if (!empty($message)) {?>
                                            <div id="success" class="alert alert-success alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                        aria-hidden="true">&times;</span></button>
                                                <?php echo output_message($message); ?>
                                            </div>
                                        <?php }
?>



                                                        <div class="tab-pane show active" id="Admission">
                                                             <div class="tab-pane" id="Admission_sub">


                                                            <div class="row">


                                                                    <ul class="nav nav-tabs-new2">
                                                                        <li class="nav-item"><a class="nav-link nav-link-goto active show" data-toggle="tab" href="#Admit-pat">Admit Patient</a></li>
                                                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#update-pat"> Modify Patient info</a></li>
                                                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#cancle-admission"> Cancel Admission</a></li>
                                                                        <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#LaboratorySecond">Laboratory</a></li>
                                                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#RadiologySecond">Radiology/Ultrasound</a></li>
                                                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#DrugSecond">Drug Prescription</a></li>
                                                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#LabHistory">Clinical History</a></li>
                                                                     <!--     <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Profile-new2"> Ultrasound Scan </a></li> -->
                                                                    </ul>
                                                                    <div class="tab-content">
                                                                        <div class="tab-pane show active" id="Admit-pat">
                                                                        <form id="" method="post" action="">

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
<input type="radio" name="title" value="Mr" required="" data-parsley-errors-container="#error-radio" <?=$mr?> disabled>
<span><i></i>Mr</span>
</label>
<label class="fancy-radio">
<input type="radio" name="title" value="Mrs" <?=$mrs?> disabled>
<span><i></i>Mrs</span>
</label>
<label class="fancy-radio">
<input type="radio" name="title" value="Master" <?=$master?> disabled>
<span><i></i>Master</span>
</label>
<label class="fancy-radio">
<input type="radio" name="title" value="Miss" <?=$miss?> disabled>
<span><i></i>Miss</span>
</label>
<p id="error-radio"></p>
</div>


<!--                                    <div class="form-group">
<label class="control-label">Title</label>
<select class="form-control" name="title" required>
<option value=""></option>
<option value="Mr">Mr</option>
<option value="Mrs">Mrs</option>
<option value="Master">Master</option>
<option value="Miss">Miss</option>
</select>
</div>-->
</div>
<div class="col-sm-4">
<div class="form-group">
<label>First Name</label>
<input type="text" class="form-control" name="first_name" id="first_name" value="<?=$patient->first_name?>" required="" readonly>
</div>
</div>
<div class="col-sm-4">
<div class="form-group">
<label>Last Name</label>
<input type="text" class="form-control" name="last_name" id="last_name" value="<?=$patient->last_name?>" required="" readonly>
</div>
</div>
</div>

<div class="row clearfix">
<?php 
    $inPat = "";
    if(!empty($refAdmissionDetail->in_patient_id)){
        $inPat = $refAdmissionDetail->in_patient_id;
    }else{
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
<input type="text" class="form-control" name="hospital_number" value="<?=$patient->folder_number?>" required="" readonly>
</div>
</div>


<div class="col-sm-4">
<div class="form-group">
<label>Hospital Clinic</label>
<select class="form-control" id="clinic_id"  required="" disabled>
<option value="">-- Select Clinic --</option>
<?php
$patientSubClinics = PatientSubClinic::find_by_id($patient->id);
$finds = Clinic::find_all();
$sub_clinic = SubClinic::find_by_id($patientSubClinics->sub_clinic_id);
foreach ($finds as $clinic) {
    ?>
<option value="<?php echo $clinic->id; ?>" <?=$patientSubClinics->clinic_id == $clinic->id ? "selected='selected'" : ''?>><?php echo $clinic->name; ?></option>
<?php }?>
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
<input type="text" class="form-control" name="sub_clinic_id" value="<?php echo $sub_clinic->name; ?>" readonly/>
</div>
</div>
</div>

<div class="col-sm-4">
<div class="form-group">
<label>Clinic Number</label>
<input type="text" class="form-control"  name="clinic_number" value="<?php echo $patientSubClinics->clinic_number; ?>" required="" readonly>
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
<label> Gender  </label>
<br>
<label class="fancy-radio">
<input type="radio" name="gender" value="Male" required="" data-parsley-errors-container="#error-radio" <?=($patient->gender == "Male") ? "checked='checked'" : ''?> disabled />
<span><i></i>Male</span>
</label>
<label class="fancy-radio">
<input type="radio" name="gender" value="Female" <?=($patient->gender == "Female") ? "checked='checked'" : ''?> disabled />
<span><i></i>Female</span>
</label>
<p id="error-radio"></p>
</div>
</div>


</div>
</div>



<div id="editinfo">
<input type="hidden" value="<?php echo $patient->id; ?>" name="patient_id"/>
<div class="row clearfix">
<div class="col-sm-4">
<div class="form-group">
<label>Consultant Dr.</label>
<?php
$userConsult = User::find_by_department("Consultancy");
?>
<select class="form-control" name="Consultantdr" required>
<option value="">-- Select Consultant --</option>
<?php
$selec = "";
foreach ($userConsult as $co) {
    if($co->id == $refAdmissionDetail->Consultantdr){
        $selec = "selected='selected'";
    }else{
        $selec = "";
    }   
    echo "<option value='" . $co->id . "' ".$selec."> " . $co->first_name . " " . $co->last_name . " </option>";
}
?>
</select>
</div>
</div>

<div class="col-sm-4">
<div class="form-group">
<label>Adm. Date & Time </label>
<!-- <input type="text" id="stage_five" name="appointment_date" value="" class="form-control"> -->
<!-- value="<?php //echo date("d/m/Y", strtotime($refAdmissionDetail->adm_date)); ?>" -->
<input type="time" name="usr_time" value="<?php echo date("H:m", strtotime($refAdmissionDetail->adm_date)); ?>">
<input type="date" class="form-control" id="adm_date" name="adm_date" value="<?php echo date("Y-m-d", strtotime($refAdmissionDetail->adm_date)); ?>"/>
<!-- <input id="input-datetime-local" type="datetime-local" value="2014-10-31T00:00:01"> -->

</div>
</div>

<div class="col-sm-4">
<div class="form-group">
<label class="control-label">Location</label>
<!-- <input type="text" class="form-control" name="location" value="<?//= (!empty($refAdmissionDetail->location)) ? $refAdmissionDetail->location : "" ?>"/> -->
<select class="form-control bed_location_id" name="location">
    <option value="">-- Select Location --</option>
    <!-- <option value="Building1" <?//= (!empty($refAdmissionDetail->location) && $refAdmissionDetail->location == "Building1") ? "selected='selected'" : "" ?> >Building 1</option> -->
    <?php 
        if(!empty($location)){
            foreach($location as $locData){
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
<select class="form-control ward_id ward_change" name="ward_no" required >
    <option value="">-- Select Ward --</option>
    <!-- <option value="General Ward" <?//= (!empty($refAdmissionDetail->ward_no) && ($refAdmissionDetail->ward_no == "General Ward")) ? "selected='selected'" : "" ?>>General Ward</option> -->
    <?= $dataWard ?>
</select>
</div>
</div>

<div class="col-sm-4">
<div class="form-group">
<label>Room No.</label>
<select class="form-control room_no" name="room_no" required>
<option value="">-- Select Room --</option>
<!-- <option value="1" <?//= (!empty($refAdmissionDetail->room_no) && ($refAdmissionDetail->room_no == "1")) ? "selected='selected'" : "" ?>>1</option> -->
<?php 
        if(!empty($roomListData)){
            foreach($roomListData as $roomListDataData){
    ?>
                <option value="<?= $roomListDataData->id ?>" <?= (!empty($refAdmissionDetail->room_no) && $refAdmissionDetail->room_no == $roomListDataData->id) ? "selected='selected'" : "" ?>><?= ucfirst($roomListDataData->room_number) ?></option>
    <?php
            }
        }
    ?>
<!-- <option value="3" <?//= (!empty($refAdmissionDetail->room_no) && ($refAdmissionDetail->room_no == "3")) ? "selected='selected'" : "" ?>>3</option> -->
</select>
</div>
</div>

<div class="col-sm-4">
<div class="form-group">
<label class="control-label">Bed No.</label>
<select class="form-control bed_no" name="bed_no" >
<option value="">-- Select Bed No --</option>
<!-- <option value="1" <?//= (!empty($refAdmissionDetail->bed_no) && ($refAdmissionDetail->bed_no == "1")) ? "selected='selected'" : "" ?>>1</option> -->
<?php 
    $bedSelected = "";
    for($i = $bedNumberListStart; $i<=$bedNumberListEnd; $i++){
        if($i == $refAdmissionDetail->bed_no){
            $bedSelected = "selected='selected'";
        }else{
            $bedSelected = "";
        }
        echo "<option value='".$i."' ".$bedSelected.">".$i."</option>";
    }
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
<label class="fancy-checkbox">
<input type="checkbox" name="ipd_service[]" value="Diet"  data-parsley-errors-container="#error-checkbox" >
<span>Diet</span>
</label>
<label class="fancy-checkbox">
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
</label>

</div>
</div>

</div>

<div class="row clearfix">
<div class="col-sm-4">
<div class="form-group">
<label>Payment Type</label>
<input type="text" class="form-control" placeholder="Cash" id="" value="Cash" name="payment_type" readonly >
</div>
</div>

<div class="col-sm-4">
<div class="form-group">
<label>Add Wallet Balance </label>

<div class="input-group mb-3">
                     <input type="text" class="form-control" placeholder="" id="add_wall_balance" name="add_wall_balance" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="addBut btn btn-outline-secondary" type="button">Add</button>
                                </div>
                            </div>

<!-- <input type="text" class="form-control" placeholder="" id="add_wall_balance" name="add_wall_balance" >
<div class="addBut btn btn-primary">Add</div> -->
</div>
</div>

<div class="col-sm-4">
<div class="form-group">
<label class="control-label">Wallet Balance</label>
<input type="text" class="form-control" placeholder="" id="wall_balance" name="wall_balance" readonly value="<?= (!empty($refAdmissionDetail->wall_balance)) ? $refAdmissionDetail->wall_balance : '' ?>" >
</div>
</div>
</div>
<div class="row clearfix">
<div class="col-sm-4">
<div class="form-group">
<label class="control-label">Patient Category </label>
<select class="form-control" name="pat_category" >
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
<textarea class="form-control" name="remark" rows="3" cols="10"><?= (!empty($refAdmissionDetail->remark)) ? $refAdmissionDetail->remark : '' ?></textarea>
</div>

<div class="form-group">
<input type="submit" value="Save" class="btn btn-primary"/>
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



                                                                        
                                <div class="tab-pane table-responsive" id="update-pat">


                                <table class="table m-b-0 table-hover">
                                        <thead class="thead-dark">
                                        <tr>
                                            <th>Name</th>
                                            <th>Clinic Number</th>
                                            <th>Gender</th>
                                            <th>In-patient id</th>
                                            <th>Modify Details</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td> <?= $patient->first_name. " ". $patient->last_name ?> </td>
                                                <td> <?= $patientSubClinics->clinic_number ?> </td>
                                                <td> <?= $patient->gender ?> </td>
                                                <td> <?= $refAdmissionDetail->in_patient_id ?> </td>
                                                <td class="text-center">  <a href="#Admit-pat" class="btn btn-default gotoEdit" title="edit"><span class="sr-only">edit</span> <i class="fa fa-edit"></i> </a></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>


                                <div class="tab-pane" id="cancle-admission">


                       
                                <table class="table m-b-0 table-hover">
                                        <thead class="thead-dark">
                                        <tr>
                                            <th>Name</th>
                                            <th>Clinic Number</th>
                                            <th>Gender</th>
                                            <th>In-patient id</th>
                                            <th>Cancel Admission</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td> <?= $patient->first_name. " ". $patient->last_name ?> </td>
                                                <td> <?= $patientSubClinics->clinic_number ?> </td>
                                                <td> <?= $patient->gender ?> </td>
                                                <td> <?= $refAdmissionDetail->in_patient_id ?> </td>
                                                <td class="text-center">  
                                                    <?php 
                                                        if(!empty($cancelAdmissionDetail)){
                                                    ?>
                                                        <!-- <a href="#"  class="btn btn-default" style="background-color: red;color: white;" title="Cancel Admission"><span class="sr-only">Cancel Admission</span> <i class="icon-ban"></i></a> -->
                                                        <a href="#myModalCancel" style="background-color: red;color: white;" class="btn btn-default" data-toggle="modal" data-target="#myModalCancel"><span class="sr-only">Cancel Admission</span> <i class="icon-close"></i></a>
                                                    <?php
                                                        }else{
                                                            if (!empty($singleReferData)) {
                                                                ?>
                                                        <a href="#canceltModal"  class="btn btn-default" data-toggle="modal" data-target="#myModal"><span class="sr-only">cancel</span> <i class="icon-close"></i></a>
                                                    <?php
                                                            }else{
                                                    ?>
                                                        <a href="javascript:void(0)"  class="btn btn-default" ><span class="sr-only">cancel</span> <i class="icon-close"></i></a>
                                                    <?php 
                                                            }
                                                        }
                                                    ?>
                                                    
                                                    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                                    Open modal
                                                    </button> -->
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane" id="LaboratorySecond">


                                                            <div class="row">
                                                                <div class="col-md-12">

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
foreach ($revs as $rev) {?>
                                                                                        <tr data-id="<?php echo $rev->revenueHead_id; ?>">
                                                                                            <td>
                                                                                                <div class="checkbox">
                                                                                                    <label>
                                                                                                        <input type="checkbox"
                                                                                                               class="add_to_bill_second_consultant" value=""
                                                                                                               data-id="<?php echo $rev->id; ?>"><?php echo $rev->name; ?>
                                                                                                    </label>
                                                                                                </div>

                                                                                            </td>
                                                                                           <!-- <td><?php /*echo $rev->reference */?></td>-->
                                                                                        </tr>
                                                                                    <?php }?>
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
foreach ($revs as $rev) {?>
                                                                                        <tr data-id="<?php echo $rev->revenueHead_id; ?>">
                                                                                            <td>
                                                                                                <div class="checkbox"><label><input type="checkbox"
                                                                                                                                    class="add_to_bill_second_consultant" value=""
                                                                                                                                    data-id="<?php echo $rev->id; ?>"><?php echo $rev->name; ?>
                                                                                                    </label>
                                                                                                </div>

                                                                                            </td>
                                                                                          <!--  <td><?php /*echo $rev->reference */?></td>-->
                                                                                        </tr>
                                                                                    <?php }?>
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
foreach ($revs as $rev) {?>
                                                                                        <tr data-id="<?php echo $rev->revenueHead_id; ?>">
                                                                                            <td>
                                                                                                <div class="checkbox"><label><input type="checkbox"
                                                                                                                                    class="add_to_bill_second_consultant" value=""
                                                                                                                                    data-id="<?php echo $rev->id; ?>"><?php echo $rev->name; ?>
                                                                                                    </label>
                                                                                                </div>

                                                                                            </td>

                                                                                        </tr>
                                                                                    <?php }?>
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
    <div class="col-md-12">

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
foreach ($revs as $rev) {?>
                            <tr data-id="<?php echo $rev->revenueHead_id; ?>">
                                <td>
                                    <div class="checkbox"><label><input type="checkbox"
                                                                        class="add_to_bill_consultant" value=""
                                                                        data-id="<?php echo $rev->id; ?>"><?php echo $rev->name; ?>
                                        </label>
                                    </div>

                                </td>

                            </tr>
                        <?php }?>
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
foreach ($revs as $rev) {?>
                            <tr data-id="<?php echo $rev->revenueHead_id; ?>">
                                <td>
                                    <div class="checkbox"><label><input type="checkbox"
                                                                        class="add_to_bill_consultant" value=""
                                                                        data-id="<?php echo $rev->id; ?>"><?php echo $rev->name; ?>
                                        </label>
                                    </div>

                                </td>

                            </tr>
                        <?php }?>
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


<!--       <div class="body">-->

           <div class="row clearfix">

               <div class="col-sm-5" >
                   <h5> Prescribe Drugs For Patient </h5>
                   <form  id="formSearch"">
                   <div class="form-group">
                       <input type="text" placeholder="Name Of Drug" name="txtProduct"
                              id="txtProduct" autocomplete="off" class="typeahead"/>
                       <!--                                            <input type="text" class="form-control" id="bill_number" name="bill_number" required >
                                                                   <br/>-->
                       <button type="submit" id="submit" class="btn btn-lg btn-info"
                               data-loading-text="Searching...">Search
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

      <!-- </div>-->


   </div>
   <div class="tab-pane" id="LabHistory">

<?php include('clinic_history.php') ?>


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
            <div class="modal-body"><form id="basic-form">
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
            <div class="modal-body"><form id="basic-form">
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
            <div class="modal-body"><form id="basic-form">
              <input type="text" class="form-control" placeholder="Give 6 digit CODE" maxlength="6" id="codeFour"/>
             <!--  <button type="submit" class="btn btn-primary">Validate</button> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary ClosePayment">Submit</button>
                <button type="button" class="btn btn-primary" id="closeBut" data-dismiss="modal" style="display:none;">CLOSE</button>
                </form>  
            </div>
      
    </div>
  </div>
<input type="hidden" id="lastPaymentId"/>

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
    $(document).ready(function(){
        //$('#datetimepicker4').datetimepicker();
        //$('#adm_date').datetimepicker();
        $(".addBut").click(function(){
            if($("#add_wall_balance").val() > 0){
                $("#myModal2").modal({backdrop: "static"});
            //    var totBalance = ($("#wall_balance").val() != "") ? $("#wall_balance").val() : 0;
            //    var tot = 0;
            //    var addWall = ($("#add_wall_balance").val() != "") ? $("#add_wall_balance").val() : 0;
            //    tot = parseInt(totBalance) + parseInt(addWall);
            //    $("#wall_balance").val(tot);
            //    $("#add_wall_balance").val(0);

                $.ajax({
                    url: '../consultant/test_bill.php',
                    data: { id : $("#pat_hide_id").val(), first_name: $("#first_name").val(), last_name: $("#last_name").val() },
                    type: "GET",
                    success: function(data){
                        console.log(data.lastBill.id);
                        if(data.status == "Done"){
                            $("#lastPaymentId").val(data.lastBill.id);
                        }
                    }
                });
            }else{
                alert("Please fill amount to be paid!!");
                return false;
            }
        });

        $(".ClosePayment").click(function(){
                //alert($("#add_wall_balance").val());
                $(".page-loader-wrapper").show();
                $.ajax({
                    url: '../consultant/test_bill_new.php',
                    data: { ids : $("#lastPaymentId").val(), code: $("#codeFour").val(), total_price: $("#add_wall_balance").val() },
                    type: "GET",
                    success: function(data){
                        //$("#closeBut").trigger("click");
                        if(data.status){
                            var totBalance = ($("#wall_balance").val() != "") ? $("#wall_balance").val() : 0;
                            var tot = 0;
                            var addWall = ($("#add_wall_balance").val() != "") ? $("#add_wall_balance").val() : 0;
                            tot = parseInt(totBalance) + parseInt(addWall);
                            $("#wall_balance").val(tot);
                            $("#add_wall_balance").val(0);
                            $(".page-loader-wrapper").hide();
                        }else{
                            alert("No success due to error!!");
                            $(".page-loader-wrapper").hide();
                        }
                    }
                });
                $("#myModal2").modal('toggle');
            });

        $(".nav-link-goto").click(function(){
            $(".titleData").show();
        });

        $(".gotoEdit").click(function(){
            $(".nav-link-goto").trigger("click");
            $(".titleData").hide();
        });

        $('#testItems').on('click', '.add_to_bill_second_consultant', function () {
            var id = $(this).data('id');
            $.post('../consultant/test_bill.php?id=' + id + ($(this)[0].checked ? '' : '&action=delete'), { id: id })
                .done(function (data) {
                    $("#testCheck").html(data.bill);
                    //   $("#bill_count").html(data.items_count);
                });
        });

        $('#testItemsSecond').on('click', '.add_to_bill_second_consultant', function () {
            var id = $(this).data('id');
            $.post('../consultant/test_bill.php?id=' + id + ($(this)[0].checked ? '' : '&action=delete'), { id: id })
                .done(function (data) {
                    $("#testCheckSecond").html(data.bill);
                    //   $("#bill_count").html(data.items_count);
                });
        });

        $('#radioItems').on('click', '.add_to_bill_consultant', function () {
            var id = $(this).data('id');
            $.post('../consultant/scan_bill.php?id=' + id + ($(this)[0].checked ? '' : '&action=delete'), { id: id })
                .done(function (data) {
                    $("#scanCheck").html(data.bill);
                    //   $("#bill_count").html(data.items_count);
                });
        });
        
        $('#scanItems').on('click', '.add_to_bill_consultant', function () {
            var id = $(this).data('id');
            $.post('../consultant/scan_bill.php?id=' + id + ($(this)[0].checked ? '' : '&action=delete'), { id: id })
                .done(function (data) {
                    $("#scanCheck").html(data.bill);
                    //   $("#bill_count").html(data.items_count);
                });
        });

        $('#chemItemsSecond').on('click', '.add_to_bill_second_consultant', function () {
            var id = $(this).data('id');
            $.post('../consultant/test_bill.php?id=' + id + ($(this)[0].checked ? '' : '&action=delete'), { id: id })
                .done(function (data) {
                    $("#testCheckSecond").html(data.bill);
                    //   $("#bill_count").html(data.items_count);
                });
        });

        $('#microItemsSecond').on('click', '.add_to_bill_second_consultant', function () {
            var id = $(this).data('id');
            $.post('../consultant/test_bill.php?id=' + id + ($(this)[0].checked ? '' : '&action=delete'), { id: id })
                .done(function (data) {
                    $("#testCheckSecond").html(data.bill);
                    //   $("#bill_count").html(data.items_count);
                });
        });

    });
</script>


