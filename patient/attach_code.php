<?php

/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/25/2019
 * Time: 1:55 PM
 */

require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$user = User::find_by_id($session->user_id);


$waitList  = WaitingList::find_by_id($_GET['id']);
$patient   = Patient::find_by_id($waitList->patient_id);
$subClinic = SubClinic::find_by_id($waitList->sub_clinic_id);

if (is_post()){

    if ($_POST['icdCode_id']) {
        if (empty($_POST['icdCode_id'])) {
            $errorName= "ICD CODE is Required";
            $errorMessage .= $errorName . "<br/>";
        } else {
            $icdCode_id = test_input($_POST['icdCode_id']);
        }
    }


    $icd = ICDCode::find_by_id($icdCode_id);

    if (empty($errorMessage)){
        $waitList->icd_status = "coded";
        if ($waitList->save()){
            $cd                 = new CodedDiagnosis();
            $cd->sync           = "off";
            $cd->patient_id     = $patient->id;
            $cd->icdCode_id     = $icdCode_id;
            $cd->icdCode_name   = $icd->name;
            $cd->coded_by       = $user->full_name();
            $cd->date           = strftime("%Y-%m-%d %H:%M:%S", time());
            $cd->modified_by    = "";
            $cd->date_modified  = "";

            if ($cd->save()){
                redirect_to('coding.php');
            }
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
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>
                        GP Consultation </h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Patient Visit</li>
                        <li class="breadcrumb-item active">Today's Visit</li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card patients-list">
                    <div class="body">


                        <div class="card">
                            <div class="body">
                                <a style="font-size: larger" href="coding.php">&laquo;Back</a>
                                <div class="tab-content">

                                    <div class="tab-pane show active" id="PatientDetails">

                                        <!--  <div style="font-size:20px; text-align:center; background-color:gray;"><b>Patient Details</b></div>-->
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item active" aria-current="page" ><b> PATIENT DETAILS
                                                    </b></li>
                                            </ol>
                                        </nav>
                                        <table border="1" cellspacing="0" cellpadding="5" style="margin-top:0px;font-size:16px; width: 100%;">
                                            <tr>
                                                <th>Title </th>
                                                <td> <?php echo $patient->title ?></td>
                                            </tr>
                                            <tr>
                                                <th>First Name</th>
                                                <td><?php echo $patient->first_name ?></td>
                                            </tr>
                                            <tr>
                                                <th>Last Name</th>
                                                <td><?php echo $patient->last_name ?></td>
                                            </tr>
                                            <tr>
                                                <th>Birth Date</th>
                                                <td><?php echo date('d-m-Y', strtotime($patient->dob)) ?></td>
                                            </tr>
                                            <tr>
                                                <th>Age</th>
                                                <td><?php echo getAge($patient->dob) . 'year(s)'; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Gender</th>
                                                <td><?php echo $patient->gender ?> </td>
                                            </tr>
                                            <tr>
                                                <th>Phone Number</th>
                                                <td><?php echo $patient->phone_number ?> </td>
                                            </tr>
                                            <tr>
                                                <th>Contact Address</th>
                                                <td><?php echo $patient->address ?> </td>
                                            </tr>
                                            <tr>
                                                <th>Marital Status</th>
                                                <td><?php echo $patient->marital_status ?> </td>
                                            </tr>
                                            <tr>
                                                <th>Email Address </th>
                                                <td><?php echo $patient->email ?> </td>
                                            </tr>
                                            <tr>
                                                <th>Occupation</th>
                                                <td><?php echo $patient->occupation ?> </td>
                                            </tr>
                                            <tr>
                                                <th>Nationality</th>
                                                <td><?php echo $patient->nationality ?> </td>
                                            </tr>
                                            <tr>
                                                <th>State</th>
                                                <td><?php echo $patient->state ?> </td>
                                            </tr>
                                            <tr>
                                                <th>LGA</th>
                                                <td><?php echo $patient->lga ?></td>
                                            </tr>
                                            <tr>
                                                <th>Religion</th>
                                                <td><?php echo $patient->religion ?></td>
                                            </tr>
                                            <tr>
                                                <th>Language(s)</th>
                                                <td> </td>
                                            </tr>

                                        </table>
                                        <br />

                                        <?php include("../consult/patientVisitHistory.php");  ?>

                                        <form method="post" action="">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <select class="form-control" style="width: 350px" id="icdCode_id" name="icdCode_id">
                                                            <option value="">--Select ICD CODE--</option>
                                                            <?php
                                                            $finds = ICDCode::find_all();
                                                            foreach ($finds as $find) {
                                                                ?>
                                                                <option
                                                                    value="<?php echo $find->id; ?>"><?php echo $find->name; ?>-<?php echo $find->code; ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <button type="submit" class="btn btn-primary">Attach Code</button>
                                                    </div>
                                                </div>
                                        </form>
                                        <!--
                                        <div style="font-size:20px; text-align:center; background-color:gray;"><b>Patient Vitals</b></div>
                                        <?php /* $waitList  = WaitingList::find_by_id($_GET['id']);
                                        $vitals    = Vitals::find_by_waiting_list($waitList->id);
                                        foreach ($vitals as $vital) {
                                        ?>
                                            <br>
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


                                                        $subClinic = SubClinic::find_by_id($vital->sub_clinic_id);

                                                        $clinic = Clinic::find_by_id($subClinic->clinic_id);
                                                        ?>
                                                        <h5> Clinical Vital Signs </h5>
                                                        <?php
                                                        $decoded = $vital->clinical_vitals;
                                                        $array = json_decode($decoded);
                                                        ?>
                                                        <table class="table table-bordered">
                                                            <tbody>
                                                                <tr>
                                                                    <th>CLINIC</th>
                                                                    <th><?php echo $clinic->name ?></th>
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
                                        <?php }  ?>


                                        <?php
                                        if (!empty(CaseNote::find_open_case_note($waitList->id, $patient->id))) {
                                        ?>
                                            <br />
                                            <div style="font-size:20px; text-align:center; background-color:gray;"><b>Clinical Notes</b></div>
                                            <ul style="font-size: medium">
                                                <?php
                                                $case_note = CaseNote::find_open_case_note($waitList->id, $patient->id);
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
                                                ?>
                                            </ul>
                                        <?php } ?>


                                        <?php
                                        if (!empty(TestRequest::find_requests($waitList->id, $patient->id))) {
                                        ?>
                                            <div style="font-size:20px; text-align:center; background-color:gray;"><b>Laboratory Test Request</b></div>
                                            <ul style="font-size: large">
                                                <?php
                                                $t_Request = TestRequest::find_requests($waitList->id, $patient->id);
                                                if (empty($t_Request)) {
                                                    echo "<h5>No Lab Investigation selected</h5>";
                                                } else {
                                                    $e_Test = EachTest::find_all_requests($t_Request->id);

                                                    $result = Result::find_checked_test_request($t_Request->id);
                                                    if (empty($result)) {

                                                    } else {

                                                    }
                                                    foreach ($e_Test as $e) {
                                                        echo "<li> $e->test_name</li>";
                                                    }
                                                    echo " Requesting Doctor: " .  $t_Request->consultant . "<br/>";
                                                    if (!empty($t_Request->doc_com))
                                                        echo " Request Note: " .  $t_Request->doc_com . "<br/>";
                                                }
                                                ?>
                                            </ul>
                                            <?php
                                            $results = Result::find_checked_test_request($t_Request->id);
                                            if (empty($results)) {
                                                echo "Test Result Not Available yet";
                                            } else {

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
                                            ?>
                                        <?php }  ?>


                                        <?php
                                        if (!empty(ScanRequest::find_requests($waitList->id, $patient->id))) {
                                        ?>
                                            <br /><br />
                                            <div style="font-size:20px; text-align:center; background-color:gray;"><b>Radiology & Ultrasound Request</b></div>
                                            <ul style="font-size: large">
                                                <?php
                                                $s_Request = ScanRequest::find_requests($waitList->id, $patient->id);
                                                if (empty($s_Request)) {
                                                    echo "<h5>No Xray/Ultrasound selected</h5>";
                                                } else {
                                                    $e_Scan = EachScan::find_all_requests($s_Request->id);

                                                    foreach ($e_Scan as $scan) {
                                                        echo "<li> $scan->scan_name</li>";
                                                    }
                                                }
                                                ?>
                                            </ul>
                                            <?php
                                            if (!empty($s_Request->consultant))
                                                echo " Request Doctor: " .  $s_Request->consultant . "<br/>";
                                            if (!empty($s_Request->doc_com))
                                                echo "<b>Note: </b>" .  $s_Request->doc_com . "<br/>";
                                            ?>
                                        <?php }  ?>

                                        <?php
                                        if (!empty(DrugRequest::find_requests($waitList->id, $patient->id))) {
                                        ?>
                                            <br />
                                            <div style="font-size:20px; text-align:center; background-color:gray;"><b> Prescription </b></div>
                                            <ul style="font-size: large">
                                                <?php
                                                $d_Request = DrugRequest::find_requests($waitList->id, $patient->id);

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
                                                ?>
                                            </ul>
                                        <?php } ?>

                                        <?php
                                        if (!empty(Referrals::find_pending_referrals($waitList->id, $patient->id))) {
                                        ?>
                                            <br />
                                            <div style="font-size:20px; text-align:center; background-color:gray;"><b> Clinic Referrals </b></div>


                                            <h5> <u>Patient's Referral</u> </h5>
                                            <ul style="font-size: medium">

                                                <?php
                                                $referral    = Referrals::find_pending_referrals($waitList->id, $patient->id);
                                                if (!empty($referral)) {
                                                    $sub_clinic = SubClinic::find_by_id($referral->referred_sub_clinic_id);
                                                }
                                                ?>
                                                <table>
                                                    <tr>
                                                        <th>Referred Clinic:</th>
                                                        <td style="padding-left: 50px"><?php echo $sub_clinic->name ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Referral Note:</th>
                                                        <td style="padding-left: 50px"><?php echo $referral->referral_note ?></td>
                                                    </tr>
                                                </table>

                                            </ul>

                                        <?php }  ?>

                                        <?php
                                        if (!empty(Appointment::find_pending_appointment($waitList->id, $patient->id))) {
                                        ?>
                                            <br />
                                            <div style="font-size:20px; text-align:center; background-color:gray;"><b> Appointment </b></div>
                                            <h5> <u>Next Appointment</u> </h5>
                                            <ul style="font-size: large">
                                                <?php
                                                $appointment = Appointment::find_pending_appointment($waitList->id, $patient->id);
                                                if (empty($appointment)) {
                                                    echo "No Appointment";
                                                } else {
                                                    echo $appointment->next_app;
                                                }

                                                ?>
                                            </ul>
                                        <?php } */?>

                                        <div style="font-size:20px; text-align:center; background-color:gray;"><b> Admission </b></div>
                                        <br />

                                -->



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
