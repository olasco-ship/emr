<?php

/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/16/2019
 * Time: 12:14 PM
 */



require_once("../includes/initialize.php");

$index = 1;


$finds = RevenueHead::find_all();
$index = 1;
$mainId = $_GET['ward'];
if (!empty($_GET['discharge_doct'])) {
    $bedLs = new BedsList();
    $oldBedAllots = $bedLs->find_by_bed_allot_status_change($_GET['patient_id']);
    $bedLs->occupied_bed_status = 0;
    $bedLs->patient_id = NULL;
    $bedLs->updateBedStatus('patient_id=NULL, occupied_bed_status=0', "where id=" . $oldBedAllots->id);
    //
    $ref = new ReferAdmission();
    $ref->id = $_GET['discharge_doct'];
    $ref->refer_status = 1;
    $ref->wall_balance = 0;
    $ref->discharge_nurse = 1;
    $ref->discharge_date = date('Y-m-d');
    $ref->updateRefer();
    $session->message("Successfully discharge patient");
    redirect_to('wards_dr.php?ward=' . $_GET['ward_ids']);
}


if (is_post()) {
    if ($_POST['revenue_name']) {
        if (empty($_POST['revenue_name'])) {
            $errorName = " Name Of RevenueHead is Required";
            $errorMessage .= $errorName . "<br/>";
        } else {
            $revenue_name = test_input($_POST['revenue_name']);
            //  if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
            //      $errorName = "Only letters and white space are allowed for Category Name";
            //      $errorMessage .= $errorName . "<br/>";
            //  }
        }
    }


    //   echo $revenue_name; exit;

    if ((!$errorMessage) and empty($errorMessage)) {
        $revenue_head                = new RevenueHead();
        $revenue_head->revenue_code  = "";
        $revenue_head->revenue_name  = $revenue_name;
        $revenue_head->date_created  = strftime("%Y-%m-%d %H:%M:%S", time());
        $revenue_head->date_modified = strftime("%Y-%m-%d %H:%M:%S", time());
        if ($revenue_head->create()) {
            $done = TRUE;
            $session->message("A new RevenueHead has been created.");
            redirect_to('index.php');
        } else {
            $done = FALSE;
            $session->message("Could not create a new RevenueHead.");
        }
    }
}

$user = User::find_by_id($session->user_id);
$ward = Wards::find_by_id($_GET['ward']);

require('../layout/header.php');
?>



<style type="text/css">
    .table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #dee2e6;
        word-break: keep-all;
        white-space: nowrap;
    }
</style>





<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> consultant Department</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">consultant</li>
                        <!--<li class="breadcrumb-item active">All Patient</li>-->
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



        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card patients-list">
                    <div class="header">





                        <ul class="header-dropdown">
                            <li><a class="tab_btn" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Weekly">W</a></li>
                            <li><a class="tab_btn" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Monthly">M</a></li>
                            <li><a class="tab_btn active" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Yearly">Y</a></li>
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another Action</a></li>
                                    <li><a href="javascript:void(0);">Something else</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">

                        <?php
                        if (!empty($message)) { ?>
                            <div id="success" class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <?php echo output_message($message); ?>
                            </div>
                        <?php }
                        ?>
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <!--                                    <div class="header">
                                        <h2>Example Tab 2 <small><code class="highlighter-rouge">.nav-tabs-new</code></small></h2>
                                    </div>-->
                                <div class="body">

                                <h3> <?php echo $ward->ward_number  ?> </h3>
                                <a style="font-size: larger" href="ipd_dash.php">&laquo;Back</a> <br/>
                                    <ul class="nav nav-tabs-new">
                                        <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#To_Admit">To Admit</a></li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Admitted_Patient">Admitted Patient</a></li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#To_Discharge">To Discharge</a></li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Discharged">Discharged</a></li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Cancelled_Admission">Cancelled Admission</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane show active" id="To_Admit">
                                            <h6>To Admit</h6>

                                            <div class="table-responsive mt-3">
                                                <table class="table no-margin">
                                                    <thead>
                                                        <tr>
                                                            <th>S.N.</th>
                                                            <th>Admit Date</th>
                                                            <th>Patient Name </th>
                                                            <th>Ward Name </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $drPatientDetail = new ReferAdmission();
                                                        if ($_SESSION['department'] == "Nursing" && $user->role != "admin") {
                                                            $drPatientAllData = $drPatientDetail->find_by_nurse_ward_id($_SESSION['user_id'], $_GET['ward']);
                                                        } else {
                                                            $drPatientAllData = $drPatientDetail->find_by_nurse_ward_id_without_ward($_GET['ward']);
                                                        }
                                                        // pre_d($drPatientAllData);die;
                                                        if (!empty($drPatientAllData)) {
                                                            foreach ($drPatientAllData as $k => $drData) {
                                                              //  print_r($drData);
                                                                $patData = Patient::find_by_id($drData->patient_id);
                                                                $wardData = Wards::find_by_id($drData->ward_no);
                                                        ?>
                                                                <tr>
                                                                    <td><?= $key + 1 ?></td>
                                                                    <td> <a href="javascript:void(0)"> <?= date("d/m/Y", strtotime($drData->adm_date)) ?> </a></td>
                                                                    <td> <a href="patient_detail.php?id=<?=  $drData->id ?>"> <?= $patData->first_name . " " . $patData->last_name  ?> </a></td>
                                                                  <!--  <td> <a href="patient_detail.php?id=<?=  $patData->id ?>"> <?= $patData->first_name . " " . $patData->last_name  ?> </a></td>  -->
                                                                    <td> <a href="javascript:void(0)"> <?= $wardData->ward_number ?> </a></td>
                                                                </tr>
                                                        <?php
                                                            }
                                                        } else {

                                                            echo "<tr colspan='4'><td>No patient found</td></tr>";
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>


                                        </div>
                                        <div class="tab-pane" id="Admitted_Patient">
                                            <h6>Admitted Patient</h6>
                                            <div class="table-responsive mt-4">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>S.N.</th>
                                                            <th>Bed No</th>
                                                            <th>Name</th>
                                                            <th>Adm Date</th>
                                                            <th>Mobile No.</th>
                                                            <th>Age</th>
                                                            <th>Gender</th>
                                                            <th>Admitted By</th>
                                                            <th>Category</th>
                                                            <th>Location</th>
                                                            <th>Ward Name</th>
                                                            <th>Admission Purpose</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php
                                                        $drPatientDetail = new ReferAdmission();
                                                        if ($_SESSION['department'] == "Nursing" && $user->role != "admin") {
                                                            $drPatientAllData = $drPatientDetail->find_by_nurse_id_with_admitted($_SESSION['user_id'], $_GET['ward']);
                                                        } else {
                                                            $drPatientAllData = $drPatientDetail->find_by_nurse_id_without_ward_with_admitted($_GET['ward']);
                                                        }
                                                        if (!empty($drPatientAllData)) {
                                                            foreach ($drPatientAllData as $k => $drData) {
                                                                $patData = Patient::find_by_id($drData->patient_id);
                                                                $wardData = Wards::find_by_id($drData->ward_no);
                                                                $userConsult = User::find_by_id($drData->Consultantdr);
                                                                $locationPatient = Locations::find_by_id($drData->location);

                                                        ?>
                                                                <tr>
                                                                    <td><?= $k + 1 ?></td>
                                                                    <td> <a href="javascript:void(0)"> <?= $drData->bed_no ?> </a></td>
                                                                    <td> <a href="patient_detail.php?id=<?= $drData->id ?>"> <?= $patData->first_name . " " . $patData->last_name ?> </a></td>
                                                                    <td> <a href="javascript:void(0)"> <?= date("d/m/Y", strtotime($drData->adm_date)) ?> </a></td>
                                                                    <td> <a href="javascript:void(0)"> <?= $patData->phone_number ?> </a></td>
                                                                    <td> <a href="javascript:void(0)"> <?= getAge($patData->dob) ?> </a></td>
                                                                    <td> <a href="javascript:void(0)"> <?= $patData->gender ?> </a></td>
                                                                    <td> <a href="javascript:void(0)"> <?= $userConsult->first_name . " " . $userConsult->last_name ?> </a></td>
                                                                    <td> <a href="javascript:void(0)"> <?= $drData->pat_category ?> </a></td>
                                                                    <td> <a href="javascript:void(0)"> <?= $locationPatient->location_name ?> </a></td>
                                                                    <td> <a href="javascript:void(0)"> <?= $wardData->ward_number ?> </a></td>
                                                                    <td> <a href="javascript:void(0)"> <?= $drData->adm_purpose ?> </a></td>


                                                                </tr>
                                                        <?php
                                                            }
                                                        } else {

                                                            echo "<tr colspan='4'><td>No patient found</td></tr>";
                                                        }
                                                        ?>

                                                    </tbody>
                                                </table>
                                            </div>


                                        </div>
                                        <div class="tab-pane" id="To_Discharge">
                                            <h6>To Discharge</h6>
                                            <div class="table-responsive mt-3">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>S.N.</th>
                                                            <th>Bed No</th>
                                                            <th>Name</th>
                                                            <th>Adm Date</th>
                                                            <th>Mobile No.</th>
                                                            <th>Age</th>
                                                            <th>Gender</th>
                                                            <th>Admitted By</th>
                                                            <th>Category</th>
                                                            <th>Location</th>
                                                            <th>Ward Name</th>
                                                            <th>Admission Purpose</th>
                                                            <th>Operation</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php
                                                        $drPatientDetail = new ReferAdmission();
                                                        if ($_SESSION['department'] == "Nursing" && $user->role != "admin") {
                                                            $drPatientAllData = $drPatientDetail->find_by_nurse_id_with_discharge_pending($_SESSION['user_id'], $_GET['ward']);
                                                        } else {
                                                            $drPatientAllData = $drPatientDetail->find_by_nurse_id_without_ward_with_discharge_pending($_GET['ward']);
                                                        }
                                                        if (!empty($drPatientAllData)) {
                                                            foreach ($drPatientAllData as $k => $drData) {
                                                                $patData = Patient::find_by_id($drData->patient_id);
                                                                $wardData = Wards::find_by_id($drData->ward_no);
                                                                $userConsult = User::find_by_id($drData->Consultantdr);
                                                                $locationPatient = Locations::find_by_id($drData->location);

                                                        ?>
                                                                <tr>
                                                                    <td><?= $key + 1 ?></td>
                                                                    <td> <a href="javascript:void(0)"> <?= $drData->bed_no ?> </a></td>
                                                                    <td> <a href="javascript:void(0)"> <?= $patData->first_name . " " . $patData->last_name ?> </a></td>
                                                                    <td> <a href="javascript:void(0)"> <?= date("d/m/Y", strtotime($drData->adm_date)) ?> </a></td>
                                                                    <td> <a href="javascript:void(0)"> <?= $patData->phone_number ?> </a></td>
                                                                    <td> <a href="javascript:void(0)"> <?= getAge($patData->dob) ?> </a></td>
                                                                    <td> <a href="javascript:void(0)"> <?= $patData->gender ?> </a></td>
                                                                    <td> <a href="javascript:void(0)"> <?= $userConsult->first_name . " " . $userConsult->last_name ?> </a></td>
                                                                    <td> <a href="javascript:void(0)"> <?= $drData->pat_category ?> </a></td>
                                                                    <td> <a href="javascript:void(0)"> <?= $locationPatient->location_name ?> </a></td>
                                                                    <td> <a href="javascript:void(0)"> <?= $wardData->ward_number ?> </a></td>
                                                                    <td> <a href="javascript:void(0)"> <?= $drData->adm_purpose ?> </a></td>

                                                                    <td>
                                                                        &nbsp;&nbsp;&nbsp;<a href="discharge_sheet.php?patient_id=<?= $patData->id ?>" target="_blank" title="Discharge Sheet"> <i class="icon-arrow-down"></i> </a>
                                                                        <?php
                                                                        
                                                                            if ($drData->wall_balance > 0) {
                                                                        ?>
                                                                                &nbsp;&nbsp;&nbsp;<a href="javascript:void()" title="Refund Amount" data-toggle="modal" data-target="#myModal" onclick="sattelment('<?= $patData->id ?>', '<?= $drData->wall_balance ?>')"><i class="fa fa-dollar"></i></a>
                                                                            <?php
                                                                            } else if ($drData->wall_balance < 0)  {
                                                                            ?>
                                                                                &nbsp;&nbsp;&nbsp;<a href="javascript:void()" title="Settle Amount" data-toggle="modal" data-target="#myModal" onclick="sattelment('<?= $patData->id ?>', '<?= $drData->wall_balance ?>')"><i class="icon-reload"></i></a>
                                                                            <?php
                                                                            }  else if ($drData->wall_balance == 0) {                                    
                                                                            ?>
                                                                            &nbsp;&nbsp;&nbsp;<a href="wards_dr.php?discharge_doct=<?= $drData->id ?>&ward_ids=<?= $drData->ward_no ?>&patient_id=<?php echo $drData->patient_id ?>" title="Discharge Patient" onclick="return confirm('Are you sure you want to discharge the patient?')"> <i class="icon-logout"></i> </a>
                                                                        <?php
                                                                        }

                                                                        if ($_SESSION['department'] == "Nursing" && $user->role == "admin") {
                                                                        ?>
                                                                            &nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" title="Discount Patient" data-toggle="modal" data-target="#myModalDiscount" onclick="discount('<?= $patData->id ?>', '<?= $drData->wall_balance ?>')"> <i class="fa fa-strikethrough"></i> </a>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </td>

                                                                    <!--
                                                                    <td>
                                                                        &nbsp;&nbsp;&nbsp;<a href="discharge_sheet.php?patient_id=<?= $patData->id ?>" target="_blank" title="Discharge Sheet"> <i class="icon-arrow-down"></i> </a>
                                                                        <?php
                                                                        if (!isset($drData->settle_status) || $drData->settle_status == 'NULL' || empty($drData->settle_status)) {
                                                                            if ($drData->wall_balance > 0) {
                                                                        ?>
                                                                                &nbsp;&nbsp;&nbsp;<a href="javascript:void()" title="Refund Amount" data-toggle="modal" data-target="#myModal" onclick="sattelment('<?= $patData->id ?>', '<?= $drData->wall_balance ?>')"><i class="fa fa-dollar"></i></a>
                                                                            <?php
                                                                            } else {
                                                                            ?>
                                                                                &nbsp;&nbsp;&nbsp;<a href="javascript:void()" title="Settle Amount" data-toggle="modal" data-target="#myModal" onclick="sattelment('<?= $patData->id ?>', '<?= $drData->wall_balance ?>')"><i class="icon-reload"></i></a>
                                                                            <?php
                                                                            }
                                                                        } else {
                                                                            ?>
                                                                            &nbsp;&nbsp;&nbsp;<a href="wards_dr.php?discharge_doct=<?= $drData->id ?>&ward_ids=<?= $drData->ward_no ?>&patient_id=<?php echo $drData->patient_id ?>" title="Discharge Patient" onclick="return confirm('Are you sure you want to discharge the patient?')"> <i class="icon-logout"></i> </a>
                                                                        <?php
                                                                        }

                                                                        if ($_SESSION['department'] == "Nursing" && $user->role == "admin") {
                                                                        ?>
                                                                            &nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" title="Discount Patient" data-toggle="modal" data-target="#myModalDiscount" onclick="discount('<?= $patData->id ?>', '<?= $drData->wall_balance ?>')"> <i class="fa fa-strikethrough"></i> </a>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    -->

                                                                </tr>
                                                        <?php
                                                            }
                                                        } else {

                                                            echo "<tr colspan='4'><td>No patient found</td></tr>";
                                                        }
                                                        ?>

                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                        <div class="tab-pane" id="Discharged">
                                            <h6> Discharged </h6>
                                            <div class="table-responsive mt-3">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>S.N.</th>
                                                            <th>Bed No</th>
                                                            <th>Name</th>
                                                            <th>Adm Date</th>
                                                            <th>Mobile No.</th>
                                                            <th>Age</th>
                                                            <th>Gender</th>
                                                            <th>Discharged By(Consultant)</th>
                                                            <th>Discharged By(Nurse)</th>
                                                            <th>Discharged Date</th>
                                                            <th>Category</th>
                                                            <th>Location</th>
                                                            <th>Ward Name</th>
                                                            <th>Admission Purpose</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php
                                                        $drPatientDetail = new ReferAdmission();
                                                        if ($_SESSION['department'] == "Nursing" && $user->role != "admin") {
                                                            $drPatientAllData = $drPatientDetail->find_by_nurse_id_with_discharge($_SESSION['user_id'], $_GET['ward']);
                                                        } else {
                                                            $drPatientAllData = $drPatientDetail->find_by_nurse_id_without_ward_with_discharge($_GET['ward']);
                                                        }

                                                        if (!empty($drPatientAllData)) {
                                                            foreach ($drPatientAllData as $k => $drData) {
                                                                $patData = Patient::find_by_id($drData->patient_id);
                                                                $wardData = Wards::find_by_id($drData->ward_no);
                                                                $userConsult = User::find_by_id($drData->Consultantdr);
                                                                $userNurse = User::find_by_id($drData->nurse_id);
                                                                $locationPatient = Locations::find_by_id($drData->location);

                                                        ?>
                                                                <tr>
                                                                    <td><?= $key + 1 ?></td>
                                                                    <td> <a href="javascript:void(0)"> <?= $drData->bed_no ?> </a></td>
                                                                    <td> <a href="javascript:void(0)"> <?= $patData->first_name ?> </a></td>
                                                                    <td> <a href="javascript:void(0)"> <?= date("d/m/Y", strtotime($drData->adm_date)) ?> </a></td>
                                                                    <td> <a href="javascript:void(0)"> <?= $patData->phone_number ?> </a></td>
                                                                    <td> <a href="javascript:void(0)"> <?= getAge($patData->dob) ?> </a></td>
                                                                    <td> <a href="javascript:void(0)"> <?= $patData->gender ?> </a></td>
                                                                    <td> <a href="javascript:void(0)"> <?= $userConsult->first_name . " " . $userConsult->last_name ?> </a></td>
                                                                    <td> <a href="javascript:void(0)"> <?= $userNurse->first_name . " " . $userNurse->last_name ?> </a></td>
                                                                    <td> <a href="javascript:void(0)"> <?= date("m/d/Y", strtotime($drData->discharge_date)) ?> </a></td>
                                                                    <td> <a href="javascript:void(0)"> <?= $drData->pat_category ?> </a></td>
                                                                    <td> <a href="javascript:void(0)"> <?= $locationPatient->location_name ?> </a></td>
                                                                    <td> <a href="javascript:void(0)"> <?= $wardData->ward_number ?> </a></td>
                                                                    <td> <a href="javascript:void(0)"> <?= $drData->adm_purpose ?> </a></td>


                                                                </tr>
                                                        <?php
                                                            }
                                                        } else {

                                                            echo "<tr colspan='4'><td>No patient found</td></tr>";
                                                        }
                                                        ?>

                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                        <div class="tab-pane" id="Cancelled_Admission">
                                            <h6>Cancelled Admission</h6>
                                            <div class="table-responsive mt-4">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>S.N.</th>
                                                            <th>Bed No.</th>
                                                            <th>Patient Name</th>
                                                            <th>Adm. Date</th>
                                                            <th>Mobile No.</th>
                                                            <th>Consultant Dr. </th>
                                                            <th>Room</th>
                                                            <th>Cancel By </th>
                                                            <th>Cancellation Date</th>
                                                            <th>Reason for Cancellation</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $drPatientDetail = new ReferAdmission();
                                                        if ($_SESSION['department'] == "Nursing" && $user->role != "admin") {
                                                            $drPatientAllData = $drPatientDetail->find_by_nurse_id_with_cancel($_SESSION['user_id'], $_GET['ward']);
                                                        } else {
                                                            $drPatientAllData = $drPatientDetail->find_by_dr_id_with_ward_with_cancel($_GET['ward']);
                                                        }
                                                        // pre_d($drPatientAllData);die;
                                                        if (!empty($drPatientAllData)) {
                                                            foreach ($drPatientAllData as $k => $drData) {
                                                                $patData = Patient::find_by_id($drData->patient_id);
                                                                $wardData = Wards::find_by_id($drData->ward_no);
                                                                $roomData = Beds::find_by_id($drData->room_no);
                                                                $userConsult = User::find_by_id($drData->Consultantdr);

                                                                $locationPatient = Locations::find_by_id($drData->location);
                                                                $cancelDetail = CancleAdmission::find_by_pat_id($drData->patient_id);

                                                                $cancelDetail = $cancelDetail[0];
                                                                $userNurse = User::find_by_id($cancelDetail->cancel_by_id);
                                                        ?>
                                                                <tr>
                                                                    <td><?= $key + 1 ?></td>
                                                                    <td> <a href="javascript:void(0)"> <?= $drData->bed_no ?> </a></td>
                                                                    <td> <a href="javascript:void(0)"> <?= $patData->first_name . " " . $patData->last_name ?> </a></td>
                                                                    <td> <a href="javascript:void(0)"> <?= date("d/m/Y", strtotime($drData->adm_date)) ?> </a></td>
                                                                    <td> <a href="javascript:void(0)"> <?= $patData->phone_number ?> </a></td>
                                                                    <td> <a href="javascript:void(0)"> <?= $userConsult->first_name . " " . $userConsult->last_name ?> </a></td>
                                                                    <td> <a href="javascript:void(0)"> <?= $roomData->room_number ?> </a></td>
                                                                    <td> <a href="javascript:void(0)"> <?= $userNurse->first_name . " " . $userNurse->last_name ?> </a></td>
                                                                    <td> <a href="javascript:void(0)"> <?= date("d/m/Y", strtotime($cancelDetail->created)); ?> </a></td>
                                                                    <td> <a href="javascript:void(0)"> <?= $cancelDetail->reason ?> </a></td>

                                                                </tr>
                                                        <?php
                                                            }
                                                        } ?>
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






<!-- Modal -->
<div class="modal" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title text-center" id="defaultModalLabel"> Payment Model </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="post" action="" id="formActionPaid">
                <input type="hidden" id="paidType" name="type" />
                <input type="hidden" id="patient_id" name="patient_id" />
                <input type="hidden" id="ward_id" name="ward_id" value="<?php echo $_GET['ward'] ?>" />
                <div class="modal-body">
                    <input type="text" class="form-control" placeholder="Amount" name="amount" required id="paidAmount" readonly />
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" placeholder="Paid/Receive" required id="prAmount" name="paid_amount" />
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" placeholder="Give 6 digit CODE" maxlength="6" id="codeFour" name="receipt" required />
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary ClosePayment">Submit</button>
                    <button type="button" class="btn btn-primary" id="closeBut" data-dismiss="modal" style="display:none;">CLOSE</button>
                </div>
            </form>

        </div>
    </div>
</div>



<!-- Discount POPUP -->
<div class="modal" id="myModalDiscount" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title text-center" id="defaultModalLabel"> Discount </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="post" action="" id="formActionDiscount">

                <input type="hidden" id="patient_id_dis" name="patient_id_dis" />
                <input type="hidden" id="ward_id" name="ward_id" value="<?php echo $_GET['ward'] ?>" />
                <div class="modal-body">
                    <input type="text" class="form-control" placeholder="Amount" name="amount_wall" required id="amount_wall" readonly />
                </div>
                <!-- <div class="modal-body">
                    <input type="text" class="form-control" placeholder="Paid/Receive" required id="prAmount"/>
                </div> -->
                <div class="modal-body">
                    <input type="text" class="form-control" id="discount" name="discount" required />
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary ClosePayment">Submit</button>
                    <button type="button" class="btn btn-primary" id="closeBut" data-dismiss="modal" style="display:none;">CLOSE</button>
                </div>
            </form>

        </div>
    </div>
</div>
<?php

require('../layout/footer.php');
?>
<script>
    function sattelment(patId, amount) {
        if (amount > 0) {
            $("#paidType").val("REFUND");
        } else {
            $("#paidType").val("SETTLE");
        }
        $("#patient_id").val(patId);
        $("#paidAmount").val(amount);
        $("#formActionPaid").attr("action", "settle.php?patient_id=" + patId);
      //  $("#formActionPaid").attr("action", "settlement.php?patient_id=" + patId);
    }

    function discount(patId, amount) {
        $("#amount_wall").val(amount);
        $("#patient_id_dis").val(patId);
        $("#paidAmount").val(amount);
        $("#formActionDiscount").attr("action", "discount.php?patient_id=" + patId);
    }

    $(document).ready(function() {
        $(".close").click(function() {
            $("#paidType").val("");
            $("#patient_id").val();
            $("#paidAmount").val();
            $("#codeFour").val();
            $("#formActionPaid").attr("action", "");
        });
    });
</script>