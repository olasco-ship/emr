<?php

/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/1/2019
 * Time: 12:18 PM
 */


require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$user = User::find_by_id($session->user_id);

$subClinic = SubClinic::find_by_id($user->sub_clinic_id);

$waiting = WaitingList::find_by_id($_GET['id']);

$patient = Patient::find_by_id($waiting->patient_id);


$message = "";
$done = FALSE;
$errMessage = "";
$first_name = $last_name = $username = $password = $created = $role = "";
$errFirstName = $errLastName = $errUserName = $errPassword = $errCreated = $errRole = "";


if (is_post()) {

    if (isset($_POST['save_vitals'])) {
        $pressure = test_input($_POST['pressure']);
        $temperature = test_input($_POST['temperature']);
        $weight = test_input($_POST['weight']);
        $height = test_input($_POST['height']);
        $respiration = test_input($_POST['respiration']);
        $heart_rate = test_input($_POST['heart_rate']);
        $pain = test_input($_POST['pain']);
        $bmi    = test_input($_POST['bmi']);
        $urinalysis = test_input($_POST['urinalysis']);
        $rbs = test_input($_POST['rbs']);
        $comment = test_input($_POST['comment']);


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
                case "PAEDIATRICS":
                    $foo = new StdClass();
                    $foo->ofc = test_input($_POST['ofc']);
                    $foo->midArmCircumferences = test_input($_POST['mid_arm']);

                    $json = json_encode($foo);
                    break;
                default:
                    echo "";
            }
        }

        //   echo $json; exit;

        if ((!$errMessage) and (empty($errMessage))) {
            $vitals = new Vitals();
            $vitals->sync = "off";
            $vitals->nurse = $user->full_name();   // current user
            $vitals->patient_id = $patient->id;
            $vitals->sub_clinic_id = $subClinic->id;
            $vitals->clinic_id = $_POST['clinic_id'];
            $vitals->waiting_list_id = $waiting->id;
            $vitals->ward_id = "0";
            $vitals->temperature = $temperature;
            $vitals->pulse = $heart_rate;
            $vitals->pressure = $pressure;
            $vitals->weight = $weight;
            $vitals->height = $height;
            $vitals->pain = $pain;
            $vitals->bmi = $bmi;
            $vitals->urinalysis = $urinalysis;
            $vitals->resp_rate = $respiration;
            $vitals->rbs = $rbs;
            $vitals->clinical_vitals = $json;
            $vitals->comment = $comment;

            $vitals->status = "waiting";
            $vitals->date = strftime("%Y-%m-%d %H:%M:%S", time());
            if ($vitals->save()) {
              //  $waiting->vitals = "DONE";
                $waiting->save();
                //   $patient->status = "open";
                //   $patient->save();
                $done = TRUE;
                $message = "Vitals have been saved for this Patient";
            }
        }
    }


    if (isset($_POST['save_history'])) {


        $nursing_intervention = $_POST['nursing_intervention'];
        $json = json_encode($history);

        $newHistory = new NurseHistory();
        $newHistory->sync = "off";
        $newHistory->patient_id = $patient->id;
        $newHistory->waiting_list_id = $waiting->id;
        $newHistory->ref_adm_id = 0;
        $newHistory->adm_id = 0;
        $newHistory->nursingDomain_id = $_POST['domain_id'];
        $newHistory->nursingClass_id = $_POST['classification_id'];
        $newHistory->nursingDiagnosis_id = $_POST['diagnosis_id'];
        $newHistory->nursingIntervention = json_encode($nursing_intervention);
        $newHistory->remark = "";
        $newHistory->date = strftime("%Y-%m-%d %H:%M:%S", time());
        $newHistory->save();
        $message = "Clinical history has been saved for this patient";

    }


    if (isset($_POST['save_to_room'])) {

        $clinic_id = $subClinic->clinic_id;
        $room_id = test_input($_POST['room_id']);
        $patient_id = $patient->id;

        $patientConsultingRoom = new PatientConsultingRooms();
        $patientConsultingRoom->patient_id = $patient_id;
        $patientConsultingRoom->room_id = $room_id;
        $patientConsultingRoom->clinic_id = $clinic_id;
        $patientConsultingRoom->waiting_list_id = $waiting->id;
        $patientConsultingRoom->date = strftime("%Y-%m-%d %H:%M:%S", time());
        if ($patientConsultingRoom->save()) {
            $waiting->status = 'consultant';
            $waiting->room_id = $room_id;
            $waiting->vitals = 'CLEARED';
            $waiting->save();
            $message = "Patient has been added to Consulting Room";
            redirect_to('waiting_list.php');
        }
    }
}


require('../layout/header.php');

?>


    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                                        class="fa fa-arrow-left"></i></a> All Patient</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Patient</li>
                            <li class="breadcrumb-item active">All Patient</li>
                        </ul>
                    </div>

                </div>
            </div>


            <div class="row clearfix">
                <div class="col-md-12">

                        <div class="card">
                            <div class="body">
                                <a style="font-size: larger" href="waiting_list.php">&laquo;Back</a>
                                <h2 class="page-title"><?php echo $patient->title . " " . $patient->full_name(); ?></h2>
                                <ul class="nav nav-tabs">
                                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab"
                                                            href="#Profile-withicon"><i class="fa fa-user"></i> Basic
                                            Profile</a></li>
                                <!--    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Contact-withicon"><i
                                                    class="fa fa-vcard"></i> Previous Vitals</a></li>-->
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#ClinicalHistory"><i
                                                    class="fa fa-vcard"></i>Clinical History</a></li>
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#new-withicon"><i
                                                    class="fa fa-vcard"></i> New Vitals</a></li>
<!--                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#NursingHistory"><i
                                                    class="fa fa-vcard"></i>Nursing History</a></li>

                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#NursingIntevention"><i
                                                    class="fa fa-vcard"></i> Nursing Intervention </a></li>
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#NursingOutcome"><i
                                                    class="fa fa-vcard"></i>Nursing Outcome</a></li>
                                                    -->
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#consult-rooms"><i
                                                    class="fa fa-vcard"></i> Consulting Rooms </a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="Profile-withicon">
                                        <?php include("../consult/patientDetails.php"); ?>
                                    </div>

                                    <div class="tab-pane" id="Contact-withicon">

                                       <!-- <div class="container">
                                            <h5>Previous Vitals</h5>
                                            <div class="alert alert-info alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close"><span aria-hidden="true">&times;</span>
                                                </button>
                                                <i class="fa fa-info-circle"></i> Most recent Patient's vitals
                                            </div>

                                            <div id="accordion">
                                                <?php
/*                                                $vitals = Vitals::find_by_patient_vitals($patient->id);
                                                foreach ($vitals as $vital) {
                                                    */?>

                                                    <div class="card">
                                                        <div class="card-header">
                                                            <a class="card-link" data-toggle="collapse"
                                                               href="#collapse<?php /*echo $vital->id; */?>">
                                                                <?php /*$d_date = date('d/m/Y h:i a', strtotime($vital->date));
                                                                echo $d_date */?>
                                                            </a>
                                                        </div>
                                                        <div id="collapse<?php /*echo $vital->id; */?>" class="collapse"
                                                             data-parent="#accordion">
                                                            <div class="card-body">

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
/*                                                                                    if (isset($vital->temperature) and (!empty($vital->temperature))) {
                                                                                        echo "<th>Temperature</th>";
                                                                                        echo "<td> $vital->temperature</td>";
                                                                                    }
                                                                                    */?>
                                                                                </tr>
                                                                                <tr>
                                                                                    <?php
/*                                                                                    if (isset($vital->pulse) and (!empty($vital->pulse))) {
                                                                                        echo "<th> Heart Rate(Pulse) </th>";
                                                                                        echo "<td> $vital->pulse</td>";
                                                                                    }
                                                                                    */?>
                                                                                </tr>
                                                                                <tr>
                                                                                    <?php
/*                                                                                    if (isset($vital->resp_rate) and (!empty($vital->resp_rate))) {
                                                                                        echo "<th> Respiratory Rate </th>";
                                                                                        echo "<td> $vital->resp_rate</td>";
                                                                                    }
                                                                                    */?>
                                                                                </tr>
                                                                                <tr>
                                                                                    <?php
/*                                                                                    if (isset($vital->pressure) and (!empty($vital->pressure))) {
                                                                                        echo "<th>Blood Pressure</th>";
                                                                                        echo "<td> $vital->pressure</td>";
                                                                                    }
                                                                                    */?>
                                                                                </tr>
                                                                                <tr>
                                                                                    <?php
/*                                                                                    if (isset($vital->weight) and (!empty($vital->weight))) {
                                                                                        echo "<th> Weight </th>";
                                                                                        echo "<td> $vital->weight</td>";
                                                                                    }
                                                                                    */?>
                                                                                </tr>
                                                                                <tr>
                                                                                    <?php
/*                                                                                    if (isset($vital->height) and (!empty($vital->height))) {
                                                                                        echo "<th> Height </th>";
                                                                                        echo "<td> $vital->height</td>";
                                                                                    }
                                                                                    */?>
                                                                                </tr>
                                                                                <tr>
                                                                                    <?php
/*                                                                                    if (isset($vital->pain) and (!empty($vital->pain))) {
                                                                                        echo "<th> Pain </th>";
                                                                                        echo "<td> $vital->pain</td>";
                                                                                    }
                                                                                    */?>
                                                                                </tr>
                                                                                <tr>
                                                                                    <?php
/*                                                                                    if (isset($vital->urinalysis) and (!empty($vital->urinalysis))) {
                                                                                        echo "<th> Urinalysis </th>";
                                                                                        echo "<td> $vital->urinalysis</td>";
                                                                                    }
                                                                                    */?>
                                                                                </tr>

                                                                                <tr>
                                                                                    <?php
/*                                                                                    if (isset($vital->rbs) and (!empty($vital->rbs))) {
                                                                                        echo "<th> RBS </th>";
                                                                                        echo "<td> $vital->rbs</td>";
                                                                                    }
                                                                                    */?>
                                                                                </tr>

                                                                                </tbody>
                                                                            </table>
                                                                            <?php
/*                                                                            if (isset($vital->comment) and (!empty($vital->comment)))
                                                                                echo $vital->comment;
                                                                            */?>
                                                                            <p class="text-info"
                                                                               style="font-size: larger"><code></code>
                                                                                Vitals Done
                                                                                By <?php /*echo $vital->nurse */?>
                                                                            </p>


                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="table-responsive">
                                                                            <?php
/*                                                                            $clinic = Clinic::find_by_id($subClinic->clinic_id);
                                                                            */?>
                                                                            <h5> Clinical Vital Signs </h5>
                                                                            <?php
/*                                                                            $decoded = $vital->clinical_vitals;
                                                                            $array = json_decode($decoded);
                                                                            */?>
                                                                            <table class="table table-bordered">
                                                                                <tbody>
                                                                                <tr>
                                                                                    <th>CLINIC</th>
                                                                                    <th><?php /*echo $clinic->name */?></th>
                                                                                </tr>
                                                                                <?php
/*                                                                                foreach ($array as $key => $value) { */?>
                                                                                    <tr>
                                                                                        <th><?php /*echo $key */?></th>
                                                                                        <td><?php /*echo $value */?></td>
                                                                                    </tr>
                                                                                <?php /*} */?>

                                                                            </table>
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php /*} */?>

                                            </div>
                                        </div>-->

                                    </div>

                                    <div class="tab-pane" id="ClinicalHistory">

                                        <?php include("../consult/patientHistory.php");  ?>

                                    </div>

                                    <div class="tab-pane" id="new-withicon">
                                        <!--<h6>New Vitals</h6>-->
                                        <form action="" method="post">
                                            <div class="row">

                                                <div class="col-md-5">

                                                    <h4><u> General Vitals</u></h4>


                                                    <div class="table-responsive">
                                                        <table>
                                                            <tr>
                                                                <th>Temperature</th>
                                                                <td style='padding-left: 30px'><input type="text"
                                                                                                      name="temperature"
                                                                                                      required
                                                                                                      class="form-control">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Heart Rate(Pulse)</th>
                                                                <td style='padding-left: 30px'><input type="text"
                                                                                                      name="heart_rate"
                                                                                                      class="form-control">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Respiratory Rate</th>
                                                                <td style='padding-left: 30px'><input type="text"
                                                                                                      name="respiration"
                                                                                                      class="form-control">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Blood Pressure</th>
                                                                <td style='padding-left: 30px'><input type="text"
                                                                                                      name="pressure"
                                                                                                      required
                                                                                                      class="form-control">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Weight</th>
                                                                <td style='padding-left: 30px'><input type="text"
                                                                                                      name="weight"
                                                                                                      required
                                                                                                      class="form-control">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Height</th>
                                                                <td style='padding-left: 30px'><input type="text"
                                                                                                      name="height"
                                                                                                      class="form-control">
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <th> BMI</th>
                                                                <td style='padding-left: 30px'><input type="text" name="bmi" class="form-control">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Pain</th>
                                                                <td style='padding-left: 30px'><input type="text"
                                                                                                      name="pain"
                                                                                                      class="form-control">
                                                                </td>
                                                            </tr>
                                                            <!--<tr>
                                                                <th>Urinalysis</th>
                                                                <td style='padding-left: 30px'><input type="text"
                                                                                                      name="urinalysis"
                                                                                                      class="form-control">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>RBS</th>
                                                                <td style='padding-left: 30px'><input type="text"
                                                                                                      name="rbs"
                                                                                                      class="form-control">
                                                                </td>
                                                            </tr>-->

                                                            <tr>
                                                                <td colspan="2">
                                                                    <label> Comments </label>
                                                                    <textarea class="form-control" name="comment"
                                                                              rows="5" cols="30"></textarea>
                                                                </td>
                                                            </tr>


                                                            <tr>
                                                                <th>
                                                                    <button type="submit" name="save_vitals"
                                                                            class="btn btn-primary">Save Vitals
                                                                    </button>

                                                                </th>
                                                                <td style='padding-left: 30px'>

                                                                </td>
                                                            </tr>
                                                        </table>

                                                    </div>


                                                </div>
                                                <div class="col-md-7">
                                                    <h4><u> Clinic Vitals</u></h4>
                                                    <!--    <form action="" method="post">-->

                                                    <div class="table-responsive">
                                                        <table>
                                                            <tr>
                                                                <th> Select Clinic</th>
                                                                <td style='padding-left: 30px'>
                                                                    <select class="form-control" id="clinic_vitals"
                                                                            name="clinic_id" required>
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

                                    <div class="tab-pane" id="NursingHistory">

                                        <h5><u>NURSING HISTORY</u></h5>

                                        <h6><b>PAST</b></h6>
                                        <div class="row clearfix">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label> History Of Hospitalization </label>
                                                    <br/>
                                                    <label class="fancy-radio">
                                                        <input type="radio" name="history_hosp" value="Yes" required
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
                                                        <input type="radio" name="any_surgery" value="Yes" required
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
                                                    <input type="text" class="form-control" name="hosp_where" value="" >
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row clearfix">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label> History of blood transfusion </label>
                                                    <br/>
                                                    <label class="fancy-radio">
                                                        <input type="radio" name="blood_trans" value="Yes" required
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
                                                        <input type="radio" name="med_surg_hist" value="Yes" required
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
                                                        <input type="radio" name="rout_drug" value="Yes" required
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
                                                        <input type="radio" name="nut_inc" value="Yes" required
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
                                                        <input type="radio" name="nut_dec" value="Yes" required
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
                                                        <input type="radio" name="nut_norm" value="Yes" required
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
                                                        <input type="radio" name="food_allergy" value="Yes" required
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
                                                        <input type="radio" name="food_pref" value="Yes" required
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
                                                        <input type="radio" name="food_tab" value="Yes" required
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
                                                    <select class="form-control" id="urinate_night" name="exercise_type" >
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
                                                        <input type="radio" name="sight[]" value="Yes"
                                                               data-parsley-errors-container="#error-check">
                                                        <span><i></i>Yes</span>
                                                    </label>
                                                    <label class="fancy-radio">
                                                        <input type="radio" name="sight[]" value="No">
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
                                                        <input type="radio" name="hearing[]" value="Yes"
                                                               data-parsley-errors-container="#error-check">
                                                        <span><i></i>Yes</span>
                                                    </label>
                                                    <label class="fancy-radio">
                                                        <input type="radio" name="hearing[]" value="No">
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
                                                        <input type="radio" name="taste[]" value="Yes"
                                                               data-parsley-errors-container="#error-check">
                                                        <span><i></i>Yes</span>
                                                    </label>
                                                    <label class="fancy-radio">
                                                        <input type="radio" name="taste[]" value="No">
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
                                                        <input type="radio" name="odour[]" value="Yes"
                                                               data-parsley-errors-container="#error-check">
                                                        <span><i></i>Yes</span>
                                                    </label>
                                                    <label class="fancy-radio">
                                                        <input type="radio" name="odour[]" value="No">
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
                                                        <input type="radio" name="self[]" value="Yes"
                                                               data-parsley-errors-container="#error-check">
                                                        <span><i></i>Yes</span>
                                                    </label>
                                                    <label class="fancy-radio">
                                                        <input type="radio" name="self[]" value="No">
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
                                                        <input type="radio" name="disturb[]" value="Yes"
                                                               data-parsley-errors-container="#error-radio">
                                                        <span><i></i>Yes</span>
                                                    </label>
                                                    <label class="fancy-radio">
                                                        <input type="radio" name="disturb[]" value="No">
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
                                                        <input type="radio" name="optimism[]" value="Yes"
                                                               data-parsley-errors-container="#error-radio">
                                                        <span><i></i>Yes</span>
                                                    </label>
                                                    <label class="fancy-radio">
                                                        <input type="radio" name="optimism[]" value="No">
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
                                                        <input type="radio" name="depressed[]" value="Yes"
                                                               data-parsley-errors-container="#error-radio">
                                                        <span><i></i>Yes</span>
                                                    </label>
                                                    <label class="fancy-radio">
                                                        <input type="radio" name="depressed[]" value="No">
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
                                                        <input type="radio" name="relate[]" value="Yes"
                                                               data-parsley-errors-container="#error-radio">
                                                        <span><i></i>Yes</span>
                                                    </label>
                                                    <label class="fancy-radio">
                                                        <input type="radio" name="relate[]" value="No">
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
                                                        <input type="radio" name="sexually[]" value="Yes"
                                                               data-parsley-errors-container="#error-radio">
                                                        <span><i></i>Yes</span>
                                                    </label>
                                                    <label class="fancy-radio">
                                                        <input type="radio" name="sexually[]" value="No">
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
                                                        <input type="radio" name="married[]" value="Yes"
                                                               data-parsley-errors-container="#error-radio">
                                                        <span><i></i>Yes</span>
                                                    </label>
                                                    <label class="fancy-radio">
                                                        <input type="radio" name="married[]" value="No">
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
                                                        <option value="Agitated">Read</option>
                                                        <option value="Anxious">Discuss</option>

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
                                                        <input type="radio" name="smoke[]" value="Yes"
                                                               data-parsley-errors-container="#error-check">
                                                        <span><i></i>Yes</span>
                                                    </label>
                                                    <label class="fancy-radio">
                                                        <input type="radio" name="smoke[]" value="No">
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
                                                        <input type="radio" name="alcohol[]" value="Yes"
                                                               data-parsley-errors-container="#error-check">
                                                        <span><i></i>Yes</span>
                                                    </label>
                                                    <label class="fancy-radio">
                                                        <input type="radio" name="alcohol[]" value="No">
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
                                                        <input type="radio" name="hard_drugs[]" value="Yes"
                                                               data-parsley-errors-container="#error-check">
                                                        <span><i></i>Yes</span>
                                                    </label>
                                                    <label class="fancy-radio">
                                                        <input type="radio" name="hard_drugs[]" value="No">
                                                        <span><i></i>No</span>
                                                    </label>
                                                    <p id="error-radio"></p>
                                                </div>
                                            </div>


                                        </div>



                                    </div>

                                    <div class="tab-pane" id="NursingOutcome">

                                        <h5>Nursing Outcome</h5>

<!--                                        <div class="alert alert-info alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <i class="fa fa-info-circle"></i> Most recent Patient's history
                                        </div>

                                        <div class="container">
                                            <div id="accordion">
                                                <?php
/*
                                                $nursingHistories = NurseHistory::find_patient_histories($patient->id);

                                                $vitals = Vitals::find_by_patient_vitals($patient->id);
                                                foreach ($nursingHistories as $nursingHistory) {
                                                    */?>

                                                    <div class="card">
                                                        <div class="card-header">
                                                            <a class="card-link" data-toggle="collapse"
                                                               href="#collapse<?php /*echo $nursingHistory->id; */?>">
                                                                <?php /*$d_date = date('d/m/Y h:i a', strtotime($nursingHistory->date));
                                                                echo $d_date */?>
                                                            </a>
                                                        </div>
                                                        <div id="collapse<?php /*echo $nursingHistory->id; */?>"
                                                             class="collapse" data-parent="#accordion">
                                                            <div class="card-body">

                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-bordered">

                                                                                <tbody>

                                                                                <tr>
                                                                                    <th>Nursing Diagnosis Domain</th>
                                                                                    <td><?php /*$domain = NursingDomain::find_by_id($nursingHistory->nursingDomain_id);
                                                                                        echo $domain->name */?></td>
                                                                                </tr>

                                                                                <tr>
                                                                                    <th>Class</th>
                                                                                    <td><?php /*$classification = NursingClassification::find_by_id($nursingHistory->nursingClass_id);
                                                                                        echo $classification->name */?></td>
                                                                                </tr>

                                                                                <tr>
                                                                                    <th> Diagnosis</th>
                                                                                    <td><?php /*$diag = NursingDiagnosis::find_by_id($nursingHistory->nursingDiagnosis_id);
                                                                                        echo $diag->name */?></td>
                                                                                </tr>

                                                                                <tr>
                                                                                    <th> Nursing Intervention</th>
                                                                                    <td><?php /*echo json_decode($nursingHistory->nursingIntervention) */?></td>
                                                                                </tr>

                                                                                </tbody>

                                                                            </table>


                                                                        </div>
                                                                    </div>

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>




                                                <?php /*} */?>

                                            </div>


                                        </div>-->

                                    </div>


                                    <div class="tab-pane" id="NursingIntevention">

                                        <div class="body">
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
                                                    <textarea class="summernote" name="nursing_intervention"></textarea>
                                                </div>


                                                <button type="submit" name="save_history" class="btn btn-primary">Save
                                                    History
                                                </button>
                                            </form>

                                        </div>

                                    </div>


                                    <div class="tab-pane" id="consult-rooms">

                                        <div class="row">

                                            <div class="col-md-7">
                                                <h6> Consulting Rooms </h6>

                                                <div class="body">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <?php
                                                                $rooms = ConsultingRooms::find_room_by_clinic($subClinic->clinic_id);
                                                                foreach ($rooms as $r) { ?>
                                                                    <th><?php echo $r->room_no ?></th>
                                                                <?php }
                                                                ?>
                                                            </tr>

                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <th>Waiting</th>
                                                                <?php
                                                                $rooms = ConsultingRooms::find_room_by_clinic($subClinic->clinic_id);
                                                                foreach ($rooms as $r) {
                                                                    $count_waiting = PatientConsultingRooms::count_patient_in_room($r->id);
                                                                    ?>
                                                                    <td><?php echo $count_waiting ?></td>
                                                                <?php }
                                                                ?>
                                                            </tr>
                                                            <tr>
                                                                <th>Engaged</th>
                                                                <?php
                                                                $rooms = ConsultingRooms::find_room_by_clinic($subClinic->clinic_id);
                                                                foreach ($rooms as $r) { ?>
                                                                    <td><?php echo $r->room_no ?></td>
                                                                <?php }
                                                                ?>
                                                            </tr>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-md-5">

                                            <!--    --><?php
/*                                                if ($waiting->vitals == 'DONE') { */?>

                                                    <div class="body">
                                                        <form id="basic-form" method="post" novalidate>


                                                            <div class="form-group">
                                                                <label>Select Consulting Rooms</label>
                                                                <select class="form-control" id="room_id" name="room_id"
                                                                        required>
                                                                    <option value="">--Select Consulting Rooms--
                                                                    </option>
                                                                    <?php
                                                                    $rooms = ConsultingRooms::find_room_by_clinic($subClinic->clinic_id);
                                                                    foreach ($rooms as $r) {
                                                                        ?>
                                                                        <option value="<?php echo $r->id; ?>"><?php echo $r->room_no; ?></option>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>

                                                            <button type="submit" name="save_to_room"
                                                                    class="btn btn-primary"> Send Patient To Consulting
                                                                Room
                                                            </button>

                                                        </form>
                                                    </div>

                                             <!--   --><?php /*} */?>


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


<?php

require('../layout/footer.php');
