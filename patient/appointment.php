<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/1/2019
 * Time: 9:25 AM
 */
require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}


$index = 1;


require('../layout/header.php');
?>


    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> All Appointments</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Appointments</li>
                            <li class="breadcrumb-item active">View Appointments </li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card patients-list">
                        <div class="header">

                            <?php
                            if (is_post()) {
                                $app_date = trim($_POST['app_date']);
                                $app_date = date("Y-m-d", strtotime($app_date));
                                $appointments = Appointment::find_by_next_app($app_date);
                                if (empty($appointments)){
                                    ?>

                                    <div id="success" class="alert alert-info alert-dismissible" role="alert" style="width: 800px">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                        <p>No appointment scheduled for this date <?php $unixdatetime = strtotime($app_date); echo $unixdatetime = strftime("%B %d %Y", $unixdatetime); ?> </p>
                                    </div>
                                <?php }
                            }
                            ?>

                            <a href="app.php" style="font-size: large">&laquo; Back</a>

                            <div href="#" class="right">
                                <form class="form-inline" id="basic-form" action="" method="post">
                                    <div class="form-group">
<!--                                        <input type="text" id="app_date" class="form-control" placeholder="Appointment Date"
                                               name="app_date" required>-->
                                     <?php   $subClinic = SubClinic::find_all(); ?>
                                        <select class="form-control" id="sub_clinic_id" name="sub_clinic_id" required>
                                            <option value="">--Select Sub-Clinic--</option>
                                            <?php
                                            foreach ($subClinic as $clinic) { ?>
                                                <option
                                                        value="<?php echo $clinic->id; ?>"><?php echo $clinic->name; ?>
                                                </option>
                                            <?php } ?>
                                        </select>

                                        <input type="text" id="app_date" class="form-control" placeholder="Appointment Date"
                                               name="app_date" required>
                                        <button type="submit" class="btn btn-outline-primary">Search By Date</button>
<!--                                        <input type="button" class="btn btn-warning" value="Refresh"
                                               onClick="location.href=location.href">-->
                                        <button type="button" name="search" onClick="location.href=location.href"  class="btn btn-outline-warning">Refresh</button>
                                    </div>
                                </form>

                            </div>


                        </div>
                        <div class="body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs-new2">
                                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#All">Appointments</a></li>
                                <!--                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#USA">USA</a></li>
                                                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#India">India</a></li>-->
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content m-t-10 padding-0">
                                <div class="tab-pane table-responsive active show" id="All">
                                    <table class="table m-b-0 table-hover">
                                        <thead class="thead-primary">

                                        <tr>

                                            <th>S/No.</th>
                                            <th>Patient Name</th>
                                            <th>Consultant</th>
                                            <th>Ward/Clinic</th>
                                      <!--      <th>Sub Clinic</th>  -->
                                            <th> Last Appointment</th>
                                            <th> Next Appointment</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php

                                        if (is_post()) {

                                            $app_date      = trim($_POST['app_date']);
                                            $sub_clinic_id = trim($_POST['sub_clinic_id']);
                                            $app_date = date("Y-m-d", strtotime($app_date));
                                            $appointments = Appointment::find_app_by_sub_clinic($sub_clinic_id, $app_date);

                                            foreach ($appointments as $app) { ?>
                                                <tr>
                                                    <td><?php echo $index++ ?></td>
                                                    <td><?php $patient = Patient::find_by_id($app->patient_id);
                                                        echo $patient->full_name() ?></td>
                                                    <td><?php echo $app->consultant ?></td>
                                                    <td><?php $sub = SubClinic::find_by_id($app->sub_clinic_id);
                                                        $clinic = Clinic::find_by_id($sub->clinic_id); echo $clinic->name;
                                                    ?></td>
                                                    <td><?php  echo $sub->name ?></td>
                                                    <td><?php $unixdatetime = strtotime($app->date);
                                                        $unixdatetime = strftime("%B %d %Y", $unixdatetime);
                                                        echo $unixdatetime ?>
                                                    </td>
                                                    <td>
                                                        <span class="label label-success">
                                                          <?php $unixdatetime = strtotime($app->app_date);
                                                          $unixdatetime = strftime("%B %d %Y", $unixdatetime);
                                                          echo $unixdatetime
                                                          ?>
                                                        </span>
                                                    </td>
                                                </tr>
                                            <?php }
                                        } else {
                                            $appointments = Appointment::find_all_confirmed_appointments();
                                            foreach ($appointments as $app)
                                                //  $patient = Patient::find_by_id($app->patient_id);
                                            { ?>
                                                <tr>
                                                    <td><?php echo $index++ ?></td>
                                                    <td><?php $patient = Patient::find_by_id($app->patient_id);
                                                        echo $patient->full_name() ?></td>
                                                    <td><?php echo $app->consultant ?></td>
                                                    <td><?php
                                                        if (!empty(SubClinic::find_by_id($app->sub_clinic_id))){
                                                            $sub = SubClinic::find_by_id($app->sub_clinic_id);
                                                            $clin = Clinic::find_by_id($sub->clinic_id);
                                                             echo $clin->name ."/".  $sub->name ;
                                                        } else {
                                                            $ref  = ReferAdmission::find_by_id($app->ref_adm_id);
                                                            $ward = Wards::find_by_id($ref->ward_no);
                                                            echo $ward->ward_number;
                                                        }
                                                        ?> </td>
                                                    <!--
                                                    <td><?php // $sub = SubClinic::find_by_id($app->sub_clinic_id);
                                                      //  $clinic = Clinic::find_by_id($sub->clinic_id); echo $clinic->name;
                                                        ?></td>
                                                        -->
                                              <!--      <td><?php // $sub = SubClinic::find_by_id($app->sub_clinic_id); echo $sub->name ?></td>  -->
                                                    <td><?php $unixdatetime = strtotime($app->date);
                                                        $unixdatetime = strftime("%B %d %Y", $unixdatetime);
                                                        echo $unixdatetime ?>
                                                    </td>
                                                    <td>
                                                        <span class="label label-success">
                                                          <?php $unixdatetime = strtotime($app->app_date);
                                                            $unixdatetime = strftime("%B %d %Y", $unixdatetime);
                                                            echo $unixdatetime
                                                          ?>
                                                        </span>
                                                    </td>
                                                </tr>

                                            <?php }
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











<?php

require('../layout/footer.php');























