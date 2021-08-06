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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> All Referrals</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Referrals</li>
                            <li class="breadcrumb-item active">View Referrals </li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card patients-list">

                        <div class="body">
                            <a href="ref.php" style="font-size: large">&laquo; Back</a>

                            <?php
                            if (!empty($message)) { ?>
                                <div id="success" class="alert alert-success alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                    <?php echo output_message($message); ?>
                                </div>
                            <?php }
                            ?>

                            <div href="#" class="right">
                                <form class="form-inline" id="basic-form" action="" method="post">
                                    <div class="form-group">
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
                                        <button type="submit" name="clinic_search"  class="btn btn-outline-primary">Search Clinic</button>
                                        <button type="button" name="search" onClick="location.href=location.href"  class="btn btn-outline-warning">Refresh</button>
                                    </div>
                                </form>
                                <form class="form-inline" id="basic-form" action="" method="post">
                                    <div class="form-group">
                                        <input type="text"  class="form-control" placeholder="Folder Number"
                                               name="folder_number" required>
                                        <button type="submit" name="patient_search" class="btn btn-outline-danger">Search Patient</button>
                                    </div>
                                </form>

                            </div>

                            <ul class="nav nav-tabs-new2">
                                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#All">Cleared Referrals</a></li>
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
                                            <!--                                            <th>Clinic</th>
                                                                                        <th>Sub Clinic</th>-->

                                            <th>Clinic Visited</th>
                                            <th>Referred Clinic</th>
                                            <th> Date</th>
                                            <th>Add To Clinic</th>



                                        </tr>

                                        </thead>
                                        <tbody>

                                        <?php
                                        $referrals = Referrals::find_by_cleared_referrals();
                                        foreach ($referrals as $app)
                                        { ?>
                                            <tr>
                                                <td><?php echo $index++ ?></td>
                                                <td><?php  $patient = Patient::find_by_id($app->patient_id);
                                                    echo $patient->full_name() ?></td>
                                                <td><?php echo $app->consultant ?></td>
                                                <!--  <td><?php /* $sub = SubClinic::find_by_id($app->current_sub_clinic_id);
                                                        $clinic = Clinic::find_by_id($sub->clinic_id); echo $clinic->name;
                                                        */?></td>-->

                                                <td><?php   $sub = SubClinic::find_by_id($app->current_sub_clinic_id); echo $sub->name ?></td>
                                                <td><?php   $sub = SubClinic::find_by_id($app->referred_sub_clinic_id); echo $sub->name ?></td>

                                                <td><?php $unixdatetime = strtotime($app->date);
                                                    $unixdatetime = strftime("%B %d %Y", $unixdatetime);
                                                    echo $unixdatetime ?>
                                                </td>
                                                <td><a href="add_clinic.php?id=<?php echo $app->id ?>">Add To  Waiting List</a> </td>

                                            </tr>

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











<?php

require('../layout/footer.php');























