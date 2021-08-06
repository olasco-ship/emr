<?php

/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/16/2019
 * Time: 12:14 PM
 */



require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
  redirect_to(emr_lucid . "/index.php");
}

$index = 1;

$finds = RevenueHead::find_all();
$index = 1;
$mainId = $_GET['ward'];
if (!empty($_GET['discharge_doct'])) {
  $ref = new ReferAdmission();
  $ref->id = $_GET['discharge_doct'];
  $ref->discharge_doct = 1;
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
$ward = Wards::find_by_id($_GET['ward']);

if (isset($_GET['pageno'])) {
  $pageno = $_GET['pageno'];
} else {
  $pageno = 1;
}
$no_of_records_per_page = 20;
$offset = ($pageno - 1) * $no_of_records_per_page;
$paginationDetail = new ReferAdmission();
$session_variable = $_SESSION['department'] == "Consultancy";


$total_rows = $paginationDetail->count_for_pagination_pending($_SESSION['user_id'], $_GET['ward'], $session_variable);

$total_rows_admitted = $paginationDetail->count_admitted($_SESSION['user_id'], $_GET['ward'], $session_variable);
$total_rows_pending_discharge = $paginationDetail->count_find_by_dr_id_without_ward_with_discharge_pending($_GET['ward']);
$total_rows_discharge = $paginationDetail->count_find_by_dr_id_without_ward_with_discharge($_GET['ward']);
$total_rows_cancel = $paginationDetail->count_find_by_dr_id_with_ward_with_cancel($_GET['ward']);
//echo "<pre>";print_r($total_rows);die;
$total_pages = ceil($total_rows[0] / $no_of_records_per_page);
$total_pages_admitted = ceil($total_rows_admitted[0] / $no_of_records_per_page);
$total_pages_pending_discharge = ceil($total_rows_pending_discharge[0] / $no_of_records_per_page);
$total_pages_discharge = ceil($total_rows_discharge[0] / $no_of_records_per_page);
$total_pages_cancel = ceil($total_rows_cancel[0] / $no_of_records_per_page);
$getPagination = $paginationDetail->pagination_query($offset, $no_of_records_per_page, $_GET['ward'], $session_variable, $_SESSION['user_id']);
$getPagination_admitted = $paginationDetail->pagination_query_admitted($offset, $no_of_records_per_page, $_GET['ward'], $session_variable, $_SESSION['user_id']);
$getPagination_pending_discharge = $paginationDetail->pagination_find_by_dr_id_without_ward_with_discharge_pending($offset, $no_of_records_per_page, $_GET['ward']);
$getPagination_discharge = $paginationDetail->pagination_find_by_dr_id_without_ward_with_discharge($offset, $no_of_records_per_page, $_GET['ward']);
$getPagination_cancel = $paginationDetail->pagination_find_by_dr_id_with_ward_with_cancel($offset, $no_of_records_per_page, $_GET['ward']);
//echo "<pre>";print_r($getPagination);die;

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
            <div class="col-lg-12 col-md-12">
              <div class="card">

                <div class="body">

                  <h3> <?php echo $ward->ward_number  ?> </h3>
                  <a style="font-size: larger" href="ipd_dash.php">&laquo;Back</a> <br />
                  <ul class="nav nav-tabs-new">
                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#To_Admit">Pending Admission</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Admitted_Patient">Admitted Patient</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#To_Discharge">Pending Discharge</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Discharged">Discharged</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Cancelled_Admission">Cancelled Admission</a></li>
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane show active" id="To_Admit">
                      <h6>Pending Admission</h6>

                      <div class="table-responsive mt-3 mb-4">
                        <table class="table no-margin pagination-1" id="pending">
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
                            // if($_SESSION['department'] == "Consultancy"){
                            //     $drPatientAllData = $drPatientDetail->find_by_dr_id($_SESSION['user_id'], $_GET['ward']);
                            // }else{
                            $drPatientAllData = $drPatientDetail->find_by_dr_id_without_ward($_GET['ward']);
                            //}
                            //pre_d($drPatientAllData);die;
                            if (!empty($getPagination)) {
                              $key = 1;
                              foreach ($getPagination as $k => $drData) {
                                $patData = Patient::find_by_id($drData->patient_id);
                                $wardData = Wards::find_by_id($drData->ward_no);
                            ?>
                                <tr>
                                  <td><?= $key ?></td>
                                  <td> <a href="javascript:void(0)"> <?= date("d/m/Y", strtotime($drData->adm_date)) ?> </a></td>
                                  <td> <a href="javascript:void(0)"> <?= $patData->first_name . " " . $patData->last_name ?> </a></td>
                                  <td> <a href="javascript:void(0)"> <?= $wardData->ward_number ?> </a></td>
                                </tr>

                              <?php
                                $key++;
                              } ?>
                              <ul class="pagination ftr-pagin">

                                <li>Total Records : <?php echo $total_rows[0]; ?></li>
                                <?php
                                if (sizeof($getPagination) >= 20) {
                                ?>
                                  <!--<li><a href="?ward=<?php //echo $_GET['ward']; 
                                                          ?>&pageno=1">First</a></li>-->
                                  <li class="<?php if ($pageno <= 1) {
                                                echo 'disabled';
                                              } ?>">
                                    <a href="<?php if ($pageno <= 1) {
                                                echo '#';
                                              } else {
                                                echo "?ward=" . $_GET['ward'] . "&pageno=" . ($pageno - 1);
                                              } ?>">Prev</a>
                                  </li>
                                  <li class="<?php if ($pageno >= $total_pages) {
                                                echo 'disabled';
                                              } ?>">
                                    <a href="<?php if ($pageno >= $total_pages) {
                                                echo '#';
                                              } else {
                                                echo "?ward=" . $_GET['ward'] . "&pageno=" . ($pageno + 1);
                                              } ?>">Next</a>
                                  </li>
                                  <!--<li><a href="?ward=<?php //echo $_GET['ward']; 
                                                          ?>&pageno=<?php //echo $total_pages; 
                                                                    ?>">Last</a></li>-->
                                <?php } ?>
                              </ul>
                            <?php } else {

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
                              <th>Operation</th>
                            </tr>
                          </thead>
                          <tbody>

                            <?php
                            $drPatientDetail = new ReferAdmission();
                            // if($_SESSION['department'] == "Consultancy"){
                            //     $drPatientAllData = $drPatientDetail->find_by_dr_id_with_admitted($_SESSION['user_id'], $_GET['ward']);
                            // }else{
                            $drPatientAllData = $drPatientDetail->find_by_dr_id_without_ward_with_admitted($_GET['ward']);
                            //}
                            if (!empty($getPagination_admitted)) {
                              $k = 1;
                              foreach ($getPagination_admitted as $k => $drData) {
                                $patData = Patient::find_by_id($drData->patient_id);
                                $wardData = Wards::find_by_id($drData->ward_no);
                                $userConsult = User::find_by_id($drData->Consultantdr);
                                $locationPatient = Locations::find_by_id($drData->location);

                            ?>
                                <tr>

                                  <?php // echo $_GET['ward'];  ?>
                                  <td><?= $k + 1 ?></td>
                                  <!-- <td> <a href="javascript:void(0)"> <? //= $patData->first_name." ".$patData->last_name 
                                                                          ?> </a></td>               -->
                                  <td> <a href="javascript:void(0)"> <?= $drData->bed_no ?> </a></td>
                                  <td> <a href="patient_detail_admitted.php?id=<?= $drData->id ?>"> <?= $patData->first_name . " " . $patData->last_name ?> </a></td>
                               <!--   <td> <a href="patient_detail.php?id=<?= $drData->id ?>"> <?= $patData->first_name . " " . $patData->last_name ?> </a></td> -->
                                  <td> <a href="javascript:void(0)"> <?= date("d/m/Y", strtotime($drData->adm_date)) ?> </a></td>
                                  <td> <a href="javascript:void(0)"> <?= $patData->phone_number ?> </a></td>
                                  <td> <a href="javascript:void(0)"> <?= getAge($patData->dob) ?> </a></td>
                                  <td> <a href="javascript:void(0)"> <?= $patData->gender ?> </a></td>
                                  <td> <a href="javascript:void(0)"> <?= $userConsult->first_name . " " . $userConsult->last_name ?> </a></td>
                                  <td> <a href="javascript:void(0)"> <?= $drData->pat_category ?> </a></td>
                                  <td> <a href="javascript:void(0)"> <?= $locationPatient->location_name ?> </a></td>
                                  <td> <a href="javascript:void(0)"> <?= $wardData->ward_number ?> </a></td>
                                  <td> <a href="javascript:void(0)"> <?= $drData->adm_purpose ?> </a></td>
                                  <td> <a href="wards_dr.php?discharge_doct=<?= $drData->id ?>&ward_ids=<?= $drData->ward_no ?>" title="Discharge Patient" onclick="return confirm('Are you sure you want to discharge the patient?')"> <i class="icon-logout"></i> </a></td>

                                </tr>
                              <?php
                                $k++;
                              } ?>

                              <ul class="pagination ftr-pagin">
                                <li>Total Records : <?php echo $total_rows_admitted[0]; ?></li>
                                <!--<li><a href="?ward=<?php //echo $_GET['ward']; 
                                                        ?>&pageno=1">First</a></li>-->
                                <?php
                                if (sizeof($getPagination_admitted) >= 20) {
                                ?>
                                  <li class="<?php if ($pageno <= 1) {
                                                echo 'disabled';
                                              } ?>">
                                    <a href="<?php if ($pageno <= 1) {
                                                echo '#';
                                              } else {
                                                echo "?ward=" . $_GET['ward'] . "&pageno=" . ($pageno - 1);
                                              } ?>">Prev</a>
                                  </li>
                                  <li class="<?php if ($pageno >= $total_pages_admitted) {
                                                echo 'disabled';
                                              } ?>">
                                    <a href="<?php if ($pageno >= $total_pages_admitted) {
                                                echo '#';
                                              } else {
                                                echo "?ward=" . $_GET['ward'] . "&pageno=" . ($pageno + 1);
                                              } ?>">Next</a>
                                  </li>
                                  <!--<li><a href="?ward=<?php //echo $_GET['ward']; 
                                                          ?>&pageno=<?php //echo $total_pages_admitted; 
                                                                    ?>">Last</a></li>-->
                                <?php } ?>
                              </ul>

                            <?php } else {

                              echo "<tr colspan='4'><td>No patient found</td></tr>";
                            }
                            ?>

                          </tbody>
                        </table>
                      </div>


                    </div>
                    <div class="tab-pane" id="To_Discharge">
                      <h6>Pending Discharge</h6>
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

                            </tr>
                          </thead>
                          <tbody>

                            <?php
                            $drPatientDetail = new ReferAdmission();
                            // if($_SESSION['department'] == "Consultancy"){
                            //     $drPatientAllData = $drPatientDetail->find_by_dr_id_with_discharge_pending($_SESSION['user_id'], $_GET['ward']);
                            // }else{
                            $drPatientAllData = $drPatientDetail->find_by_dr_id_without_ward_with_discharge_pending($_GET['ward']);
                            //}
                            if (!empty($getPagination_pending_discharge)) {
                              foreach ($getPagination_pending_discharge as $k => $drData) {
                                $patData = Patient::find_by_id($drData->patient_id);
                                $wardData = Wards::find_by_id($drData->ward_no);
                                $userConsult = User::find_by_id($drData->Consultantdr);
                                $locationPatient = Locations::find_by_id($drData->location);

                            ?>
                                <tr>
                                  <td><?= $k + 1 ?></td>
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


                                </tr>
                              <?php
                              } ?>
                              <ul class="pagination ftr-pagin">
                                <li>Total Records : <?php echo $total_rows_pending_discharge[0]; ?></li>
                                <!--<li><a href="?ward=<?php //echo $_GET['ward']; 
                                                        ?>&pageno=1">First</a></li>-->
                                <?php
                                if (sizeof($getPagination_pending_discharge) >= 20) {
                                ?>
                                  <li class="<?php if ($pageno <= 1) {
                                                echo 'disabled';
                                              } ?>">
                                    <a href="<?php if ($pageno <= 1) {
                                                echo '#';
                                              } else {
                                                echo "?ward=" . $_GET['ward'] . "&pageno=" . ($pageno - 1);
                                              } ?>">Prev</a>
                                  </li>
                                  <li class="<?php if ($pageno >= $total_pages_pending_discharge) {
                                                echo 'disabled';
                                              } ?>">
                                    <a href="<?php if ($pageno >= $total_pages_pending_discharge) {
                                                echo '#';
                                              } else {
                                                echo "?ward=" . $_GET['ward'] . "&pageno=" . ($pageno + 1);
                                              } ?>">Next</a>
                                  </li>
                                  <!--<li><a href="?ward=<?php //echo $_GET['ward']; 
                                                          ?>&pageno=<?php //echo $total_pages_pending_discharge; 
                                                                    ?>">Last</a></li>-->
                                <?php } ?>
                              </ul>
                            <?php } else {

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
                            // if($_SESSION['department'] == "Consultancy"){
                            //     $drPatientAllData = $drPatientDetail->find_by_dr_id_with_discharge($_SESSION['user_id'], $_GET['ward']);
                            // }else{
                            $drPatientAllData = $drPatientDetail->find_by_dr_id_without_ward_with_discharge($_GET['ward']);
                            //}
                            if (!empty($getPagination_discharge)) {
                              foreach ($getPagination_discharge as $k => $drData) {
                                $patData = Patient::find_by_id($drData->patient_id);
                                $wardData = Wards::find_by_id($drData->ward_no);
                                $userConsult = User::find_by_id($drData->Consultantdr);
                                $userNurse = User::find_by_id($drData->nurse_id);
                                $locationPatient = Locations::find_by_id($drData->location);

                            ?>
                                <tr>
                                  <td><?= $k + 1 ?></td>
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
                              } ?>
                              <ul class="pagination ftr-pagin">
                                <li>Total Records : <?php echo $total_rows_discharge[0]; ?></li>
                                <!--<li><a href="?ward=<?php //echo $_GET['ward']; 
                                                        ?>&pageno=1">First</a></li>-->
                                <?php
                                if (sizeof($getPagination_discharge) >= 20) {
                                ?>
                                  <li class="<?php if ($pageno <= 1) {
                                                echo 'disabled';
                                              } ?>">
                                    <a href="<?php if ($pageno <= 1) {
                                                echo '#';
                                              } else {
                                                echo "?ward=" . $_GET['ward'] . "&pageno=" . ($pageno - 1);
                                              } ?>">Prev</a>
                                  </li>
                                  <li class="<?php if ($pageno >= $total_pages_discharge) {
                                                echo 'disabled';
                                              } ?>">
                                    <a href="<?php if ($pageno >= $total_pages_discharge) {
                                                echo '#';
                                              } else {
                                                echo "?ward=" . $_GET['ward'] . "&pageno=" . ($pageno + 1);
                                              } ?>">Next</a>
                                  </li>
                                  <!--<li><a href="?ward=<?php //echo $_GET['ward']; 
                                                          ?>&pageno=<?php //echo $total_pages_discharge; 
                                                                    ?>">Last</a></li>-->
                                <?php } ?>
                              </ul>
                            <?php } else {

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
                            // if($_SESSION['department'] == "Consultancy"){
                            //     $drPatientAllData = $drPatientDetail->find_by_dr_id_with_cancel($_SESSION['user_id'], $_GET['ward']);
                            // }else{
                            $drPatientAllData = $drPatientDetail->find_by_dr_id_with_ward_with_cancel($_GET['ward']);
                            //}
                            if (!empty($getPagination_cancel)) {
                              foreach ($getPagination_cancel as $k => $drData) {
                                $patData = Patient::find_by_id($drData->patient_id);
                                $wardData = Wards::find_by_id($drData->ward_no);
                                $roomData = Beds::find_by_id($drData->room_no);
                                $userConsult = User::find_by_id($drData->Consultantdr);
                                $userNurse = User::find_by_id($drData->nurse_id);
                                $locationPatient = Locations::find_by_id($drData->location);
                                $cancelDetail = CancleAdmission::find_by_pat_id($drData->patient_id);
                                $cancelDetail = $cancelDetail[0];
                            ?>
                                <tr>
                                  <td><?= $key + 1 ?></td>
                                  <td> <a href="javascript:void(0)"> <?= $drData->bed_no ?> </a></td>
                                  <td> <a href="javascript:void(0)"> <?= $patData->first_name . " " . $patData->last_name ?> </a></td>
                                  <td> <a href="javascript:void(0)"> <?= date("d/m/Y", strtotime($drData->adm_date)) ?> </a></td>
                                  <td> <a href="javascript:void(0)"> <?= $patData->phone_number ?> </a></td>
                                  <td> <a href="javascript:void(0)"> <?= $userConsult->first_name . " " . $userConsult->last_name ?> </a></td>
                                  <td> <a href="javascript:void(0)"> <?= $roomData->room_number ?> </a></td>
                                  <td> <a href="javascript:void(0)"> <?= "Doctor" ?> </a></td>
                                  <td> <a href="javascript:void(0)"> <?= date("d/m/Y", strtotime($cancelDetail->created)); ?> </a></td>
                                  <td> <a href="javascript:void(0)"> <?= $cancelDetail->reason ?> </a></td>

                                </tr>
                              <?php
                              } ?>
                              <ul class="pagination ftr-pagin">
                                <li>Total Records : <?php echo $total_rows_cancel[0]; ?></li>
                                <!--<li><a href="?ward=<?php //echo $_GET['ward']; 
                                                        ?>&pageno=1">First</a></li>-->
                                <?php
                                if (sizeof($getPagination_cancel) >= 20) {
                                ?>
                                  <li class="<?php if ($pageno <= 1) {
                                                echo 'disabled';
                                              } ?>">
                                    <a href="<?php if ($pageno <= 1) {
                                                echo '#';
                                              } else {
                                                echo "?ward=" . $_GET['ward'] . "&pageno=" . ($pageno - 1);
                                              } ?>">Prev</a>
                                  </li>
                                  <li class="<?php if ($pageno >= $total_pages_cancel) {
                                                echo 'disabled';
                                              } ?>">
                                    <a href="<?php if ($pageno >= $total_pages_cancel) {
                                                echo '#';
                                              } else {
                                                echo "?ward=" . $_GET['ward'] . "&pageno=" . ($pageno + 1);
                                              } ?>">Next</a>
                                  </li>
                                  <!--<li><a href="?ward=<?php //echo $_GET['ward']; 
                                                          ?>&pageno=<?php //echo $total_pages_cancel; 
                                                                    ?>">Last</a></li>-->
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



<style>
  .pagination-1 {
    position: relative;
  }

  .ftr-pagin {
    position: absolute;
    bottom: 0px;
    width: 100%;
    padding: 10px 0;
    min-height: 40px;
    margin-bottom: 0;
  }

  .ftr-pagin li:first-child {
    font-weight: 600;
    width: 80%;
  }

  .ftr-pagin li:nth-child(2),
  .ftr-pagin li:nth-child(3) {
    font-weight: 600;
  }

  .ftr-pagin a {
    padding: 5px 5px;
    border: 1px solid #eee;
  }
</style>



<?php

require('../layout/footer.php');
