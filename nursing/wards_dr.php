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


if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
  } else {
    $pageno = 1;
  }
  $no_of_records_per_page = 20;
  $offset = ($pageno-1) * $no_of_records_per_page;
  $session_variable=$_SESSION['department'];
  $role=$user->role;

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

            </div>
        </div>



        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card patients-list">

                    <div class="body">
                        <h3> <?php echo $ward->ward_number  ?> </h3>
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

                                <div class="body">

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

                                            <div class="table-responsive mt-3 mb-4">
                                                <table class="table no-margin pagination-1">
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
                                                        //if ($_SESSION['department'] == "Nursing" && $user->role != "admin") {
                                                           // $drPatientAllData = $drPatientDetail->find_by_nurse_ward_id($_SESSION['user_id'], $_GET['ward']);
                                                        //} else {
                                                           // $drPatientAllData = $drPatientDetail->find_by_nurse_ward_id_without_ward($_GET['ward']);
                                                      //  }
                                                        
                                                        $total_rows = $drPatientDetail->to_admit_count($_GET['ward'],$session_variable,$role,$_SESSION['user_id']);
                                                        $total_pages = ceil($total_rows[0] / $no_of_records_per_page);
                                                        $getPagination = $drPatientDetail->to_admit_pagination_query($offset,$no_of_records_per_page,$_GET['ward'],$session_variable,$role,$_SESSION['user_id']);
                                                        // pre_d($getPagination);die;
                                                        if (!empty($getPagination)) { $key=1;
                                                            foreach ($getPagination as $k => $drData) {
                                                              //  print_r($drData);
                                                                $patData = Patient::find_by_id($drData->patient_id);
                                                                $wardData = Wards::find_by_id($drData->ward_no);
                                                        ?>
                                                                <tr>
                                                                    <td><?= $key  ?></td>
                                                                    <td> <a href="javascript:void(0)"> <?= date("d/m/Y", strtotime($drData->adm_date)) ?> </a></td>
                                                                    <td> <a href="patient_detail.php?id=<?=  $drData->id ?>"> <?= $patData->first_name . " " . $patData->last_name  ?> </a></td>
                                                                  <!--  <td> <a href="patient_detail.php?id=<?=  $patData->id ?>"> <?= $patData->first_name . " " . $patData->last_name  ?> </a></td>  -->
                                                                    <td> <a href="javascript:void(0)"> <?= $wardData->ward_number ?> </a></td>
                                                                </tr>
                                                        <?php
                                                           $key++; } ?>
                                                           <ul class="pagination ftr-pagin">
                                                          
                                                           <li>Total Records : <?php echo $total_rows[0];?></li>
                                                           <?php 
                                                                if(sizeof($getPagination) >= 20){
                                                             ?>
                                                             <!--<li><a href="?ward=<?php //echo $_GET['ward']; ?>&pageno=1">First</a></li>-->
                                                             <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
                                                                 <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?ward=".$_GET['ward']."&pageno=".($pageno - 1); } ?>">Prev</a>
                                                             </li>
                                                             <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                                                                 <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?ward=".$_GET['ward']."&pageno=".($pageno + 1); } ?>">Next</a>
                                                             </li>
                                                             <!--<li><a href="?ward=<?php //echo $_GET['ward']; ?>&pageno=<?php //echo $total_pages; ?>">Last</a></li>-->
                                                                <?php } ?>
                                                         </ul> 
                                                      <?php
                                                        
                                                        } 
                                                        else {

                                                            echo "<tr colspan='4'><td>No patient found</td></tr>";
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>


                                        </div>
                                        <div class="tab-pane" id="Admitted_Patient">
                                            <h6>Admitted Patient</h6>
                                            <div class="table-responsive mt-4 mb-4">
                                                <table class="table table-hover pagination-1">
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
                                                        /*if ($_SESSION['department'] == "Nursing" && $user->role != "admin") {
                                                            $drPatientAllData = $drPatientDetail->find_by_nurse_id_with_admitted($_SESSION['user_id'], $_GET['ward']);
                                                        } else {
                                                            $drPatientAllData = $drPatientDetail->find_by_nurse_id_without_ward_with_admitted($_GET['ward']);
                                                        }*/
                                                        $total_rows = $drPatientDetail->to_admit_patient_count($_GET['ward'],$session_variable,$role,$_SESSION['user_id']);
                                                        $total_pages = ceil($total_rows[0] / $no_of_records_per_page);
                                                        $getPagination = $drPatientDetail->to_admit_patient_pagination_query($offset,$no_of_records_per_page,$_GET['ward'],$session_variable,$role,$_SESSION['user_id']);
                                                        if (!empty($getPagination)) { $key=1;
                                                            foreach ($getPagination as $k => $drData) {
                                                                $patData = Patient::find_by_id($drData->patient_id);
                                                                $wardData = Wards::find_by_id($drData->ward_no);
                                                                $userConsult = User::find_by_id($drData->Consultantdr);
                                                                $locationPatient = Locations::find_by_id($drData->location);

                                                             //   print_r($total_rows);

                                                        ?>
                                                                <tr>
                                                                    <td><?= $key ?></td>
                                                                    <td> <a href="javascript:void(0)"> <?= $drData->bed_no ?> </a></td>
                                                                    <td> <a href="patient_detail_admitted.php?id=<?= $drData->id ?>"> <?= $patData->first_name . " " . $patData->last_name ?> </a></td>
                                                               <!--     <td> <a href="patient_detail.php?id=<?= $drData->id ?>"> <?= $patData->first_name . " " . $patData->last_name ?> </a></td> -->
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
                                                        <?php $key++;
                                                            } ?>
                                                            <ul class="pagination ftr-pagin">
                                                            <li>Total Records : <?php echo $total_rows[0];?></li>
                                                              <!--<li><a href="?ward=<?php //echo $_GET['ward']; ?>&pageno=1">First</a></li>-->
                                                              <?php 
                                                                if(sizeof($getPagination) >= 20){
                                                             ?>
                                                              <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
                                                                  <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?ward=".$_GET['ward']."&pageno=".($pageno - 1); } ?>">Prev</a>
                                                              </li>
                                                              <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                                                                  <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?ward=".$_GET['ward']."&pageno=".($pageno + 1); } ?>">Next</a>
                                                              </li>
                                                              <!--<li><a href="?ward=<?php //echo $_GET['ward']; ?>&pageno=<?php //echo $total_pages; ?>">Last</a></li>-->
                                                                <?php } ?>
                                                          </ul> 
                                                       <?php
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
                                            <div class="table-responsive mt-3 mb-4">
                                                <table class="table table-hover pagination-1">
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
                                                       /* if ($_SESSION['department'] == "Nursing" && $user->role != "admin") {
                                                            $drPatientAllData = $drPatientDetail->find_by_nurse_id_with_discharge_pending($_SESSION['user_id'], $_GET['ward']);
                                                        } else {
                                                            $drPatientAllData = $drPatientDetail->find_by_nurse_id_without_ward_with_discharge_pending($_GET['ward']);
                                                        }*/
                                                        $total_rows = $drPatientDetail->to_discharge_patient_count($_GET['ward'],$session_variable,$role,$_SESSION['user_id']);
                                                        $total_pages = ceil($total_rows[0] / $no_of_records_per_page);
                                                        $getPagination = $drPatientDetail->to_discharge_patient_pagination_query($offset,$no_of_records_per_page,$_GET['ward'],$session_variable,$role,$_SESSION['user_id']);
                                                        if (!empty($getPagination)) { $key=1;
                                                            foreach ($getPagination as $k => $drData) {
                                                                $patData = Patient::find_by_id($drData->patient_id);
                                                                $wardData = Wards::find_by_id($drData->ward_no);
                                                                $userConsult = User::find_by_id($drData->Consultantdr);
                                                                $locationPatient = Locations::find_by_id($drData->location);

                                                        ?>
                                                                <tr>
                                                                    <td><?= $key  ?></td>
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
                                                                </tr>
                                                        <?php $key++;
                                                            } ?>
                                                            <ul class="pagination ftr-pagin">
                                                            <li>Total Records : <?php echo $total_rows[0];?></li>
                                                              <!--<li><a href="?ward=<?php //echo $_GET['ward']; ?>&pageno=1">First</a></li>-->
                                                              <?php 
                                                                if(sizeof($getPagination) >= 20){
                                                             ?>
                                                              <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
                                                                  <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?ward=".$_GET['ward']."&pageno=".($pageno - 1); } ?>">Prev</a>
                                                              </li>
                                                              <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                                                                  <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?ward=".$_GET['ward']."&pageno=".($pageno + 1); } ?>">Next</a>
                                                              </li>
                                                              <!--<li><a href="?ward=<?php //echo $_GET['ward']; ?>&pageno=<?php //echo $total_pages; ?>">Last</a></li>-->
                                                                <?php } ?>
                                                          </ul> 
                                                       <?php
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
                                            <div class="table-responsive mt-3 mb-4">
                                                <table class="table table-hover pagination-1">
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
                                                        $total_rows = $drPatientDetail->discharge_patient_count($_GET['ward'],$session_variable,$role,$_SESSION['user_id']);
                                                        $total_pages = ceil($total_rows[0] / $no_of_records_per_page);
                                                        $getPagination = $drPatientDetail->discharge_patient_pagination_query($offset,$no_of_records_per_page,$_GET['ward'],$session_variable,$role,$_SESSION['user_id']);
                                                        if (!empty($getPagination)) { $key=1;
                                                            foreach ($getPagination as $k => $drData) {
                                                                $patData = Patient::find_by_id($drData->patient_id);
                                                                $wardData = Wards::find_by_id($drData->ward_no);
                                                                $userConsult = User::find_by_id($drData->Consultantdr);
                                                                $userNurse = User::find_by_id($drData->nurse_id);
                                                                $locationPatient = Locations::find_by_id($drData->location);

                                                        ?>
                                                                <tr>
                                                                    <td><?= $key ?></td>
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
                                                        <?php $key++;
                                                            } ?>
                                                            <ul class="pagination ftr-pagin">
                                                            <li>Total Records : <?php echo $total_rows[0];?></li>
                                                              <!--<li><a href="?ward=<?php //echo $_GET['ward']; ?>&pageno=1">First</a></li>-->
                                                              <?php 
                                                                if(sizeof($getPagination) >= 20){
                                                             ?>
                                                              <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
                                                                  <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?ward=".$_GET['ward']."&pageno=".($pageno - 1); } ?>">Prev</a>
                                                              </li>
                                                              <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                                                                  <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?ward=".$_GET['ward']."&pageno=".($pageno + 1); } ?>">Next</a>
                                                              </li>
                                                              <!--<li><a href="?ward=<?php //echo $_GET['ward']; ?>&pageno=<?php //echo $total_pages; ?>">Last</a></li>-->
                                                                <?php } ?>
                                                          </ul> 
                                                       <?php
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
                                            <div class="table-responsive mt-4 mb-4">
                                                <table class="table table-hover pagination-1">
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
                                                       /* if ($_SESSION['department'] == "Nursing" && $user->role != "admin") {
                                                            $drPatientAllData = $drPatientDetail->find_by_nurse_id_with_cancel($_SESSION['user_id'], $_GET['ward']);
                                                        } else {
                                                            $drPatientAllData = $drPatientDetail->find_by_dr_id_with_ward_with_cancel($_GET['ward']);
                                                        }*/
                                                        $total_rows = $drPatientDetail->cancel_patient_count($_GET['ward'],$session_variable,$role,$_SESSION['user_id']);
                                                        $total_pages = ceil($total_rows[0] / $no_of_records_per_page);
                                                        $getPagination = $drPatientDetail->cancel_patient_pagination_query($offset,$no_of_records_per_page,$_GET['ward'],$session_variable,$role,$_SESSION['user_id']);
                                                        // pre_d($drPatientAllData);die;
                                                        if (!empty($getPagination)) { $key=1;
                                                            foreach ($getPagination as $k => $drData) {
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
                                                                    <td><?= $key ?></td>
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
                                                        <?php $key++;
                                                            } ?>
                                                            <ul class="pagination ftr-pagin">
                                                            <?php 
                                                                if(sizeof($getPagination) >= 20){
                                                             ?>
                                                            <li>Total Records : <?php echo $total_rows[0];?></li>
                                                              <!--<li><a href="?ward=<?php //echo $_GET['ward']; ?>&pageno=1">First</a></li>-->
                                                              <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
                                                                  <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?ward=".$_GET['ward']."&pageno=".($pageno - 1); } ?>">Prev</a>
                                                              </li>
                                                              <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                                                                  <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?ward=".$_GET['ward']."&pageno=".($pageno + 1); } ?>">Next</a>
                                                              </li>
                                                              <!--<li><a href="?ward=<?php //echo $_GET['ward']; ?>&pageno=<?php //echo $total_pages; ?>">Last</a></li>-->
                                                                <?php } ?>
                                                          </ul> 
                                                       <?php
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
<style>
  .pagination-1{
position: relative;
  }
  .ftr-pagin{
    position: absolute;
    bottom: 0px;
    width: 100%;
    padding: 10px 0;
    min-height: 40px;
    margin-bottom: 0;
  }
  .ftr-pagin li:first-child{
    font-weight: 600;
    width: 80%;
  }
  .ftr-pagin li:nth-child(2), .ftr-pagin li:nth-child(3){
    font-weight: 600;
  }
  .ftr-pagin a{
    padding: 5px 5px;
    border: 1px solid #eee;
  }
</style>
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