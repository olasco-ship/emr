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
$index = 1;

if (is_post()) {
    $app_date = trim($_POST['app_date']);
    $app_date = date("Y-m-d", strtotime($app_date));

    $start_sec = "00:00:00";
    $end_sec = "23:59:59";

    $start_date = $app_date . " " . $start_sec;
    $end_date   = $app_date . " " . $end_sec;

    $waiiting = WaitingList::find_all_done_by_date($start_date, $end_date);

    //  print_r($waiiting);
    //  exit;
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
                        <li class="breadcrumb-item">Hospital Visit</li>
                        <li class="breadcrumb-item active">Today's Visit</li>
                    </ul>
                </div>

            </div>
        </div>



        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card patients-list">
                    <div class="body">

                        <a style="font-size: larger" href="../consultant/index.php">&laquo;Back</a>

                        <ul class="nav nav-tabs-new2">
                            <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#PendingAdmission"> Today's Visit </a></li>
                        </ul>


                        <div class="tab-content m-t-10 padding-0">

                            <div class="tab-pane table-responsive active show" id="PendingAdmission">
                                <table class="table m-b-0 table-hover">
                                    <thead class="thead-primary">
                                        <tr>
                                            <th>S/No.</th>
                                            <th>Folder No.</th>
                                            <th>Patient Name</th>
                                            <th> Sub Clinic </th>
                                            <th>Consultant Seen</th>
                                            <th> Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                       
                                            $allVisit = WaitingList::find_all_done();

                                            $start_sec = "00:00:00";
                                            $end_sec = "23:59:59";

                                            $today = strftime("%Y-%m-%d", time());

                                            $start_date = $today . " " . $start_sec;
                                            $end_date   = $today . " " . $end_sec;
                                          //  $todayVisit = WaitingList::find_all_done_by_date($start_date, $end_date);

                                            $todayVisit = WaitingList::find_all_done_by_dr($user->full_name(), $start_date, $end_date);

                                            foreach ($todayVisit as $visit) {
                                          //  foreach ($allVisit as $visit) {
                                                $patient     = Patient::find_by_id($visit->patient_id);
                                                $subClinic   = SubClinic::find_by_id($visit->sub_clinic_id);
                                                ?>
                                                <tr>
                                                    <td><?php echo $index++; ?></td>
                                                    <td><a href='visit_detail.php?id=<?php echo $visit->id ?>'><?php echo $patient->folder_number ?></a></td>
                                                    <td><?php echo $patient->full_name()  ?></td>
                                                    <td><?php echo $subClinic->name ?></td>
                                                    <td><?php echo $visit->dr_seen  ?> </td>
                                                    <td><?php $d_date = date('d/m/Y', strtotime($visit->date));
                                                        echo $d_date ?></td>
                                                </tr>

                                        <?php  }
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





<?php

require('../layout/footer.php');
