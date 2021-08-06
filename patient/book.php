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


if (is_post()) {


    $folder = trim($_POST['folder_number']);

    $patient = Patient::find_by_number($folder);

  //     print_r($patient); exit;

 //   $appointments = Appointment::find_patient_open_app($patient->id);


}






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





                        <div class="body">

                            <?php
                            if (is_post()) {
                                $folder = trim($_POST['folder_number']);

                                $patient = Patient::find_by_number($folder);

                                //   print_r($patient); exit;

                                //    $appointments = Appointment::find_patient_open_app($patient->id);
                                if (empty($patient)){
                                    ?>
                                    <div id="success" class="alert alert-info alert-dismissible" role="alert" style="width: 800px">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                    aria-hidden="true">&times;</span></button>
                                        <p> Folder Number <?php echo $folder ?> not found! </p>
                                        <!-- <p> No appointment scheduled for this  <?php /*echo $patient->first_name */?> </p>-->
                                    </div>
                                <?php } else {
                                    $appointments = Appointment::find_patient_open_app($patient->id);
                                    if (empty($appointments)){  ?>
                                        <div id="success" class="alert alert-info alert-dismissible" role="alert" style="width: 800px">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                        aria-hidden="true">&times;</span></button>
                                            <p> No appointment scheduled for this patient  <?php echo $patient->full_name()  ?> </p>
                                        </div>
                                    <?php      }
                                }
                            }
                            ?>


                            <div href="#" class="right">
                                <a href="app.php" style="font-size: large">&laquo; Back</a>
                                <form class="form-inline" id="basic-form" action="" method="post">
                                    <div class="form-group">

                                        <input type="text" class="form-control" placeholder="Folder(Hospital) Number"
                                               name="folder_number" required>
                                        <button type="submit" class="btn btn-outline-primary">Search</button>
                                        <button type="button" name="search" onClick="location.href=location.href"  class="btn btn-outline-warning">Refresh</button>
                                    </div>
                                </form>

                            </div>

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
                                            <th>Clinic/Ward</th>
                                        <!--    <th>Sub Clinic</th> -->
                                            <th> Last Appointment</th>
                                            <th> Next Appointment</th>
                                            <th></th>
                                            <!--<th> Last Appointment</th>-->
                                        </tr>

                                        </thead>
                                        <tbody>

                                        <?php

                                        if (is_post()) {
                                            $folder = trim($_POST['folder_number']);
                                            $patient = Patient::find_by_number($folder);
                                            if (!empty($patient)){
                                                $appointments = Appointment::find_patient_open_app($patient->id);
                                                foreach ($appointments as $app) { ?>
                                                    <tr>
                                                        <td><?php echo $index++ ?></td>
                                                        <td><?php $patient = Patient::find_by_id($app->patient_id);
                                                            echo $patient->full_name() ?></td>
                                                        <td><?php echo $app->consultant ?></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td><span class="label label-success">
                                                            <?php $unixdatetime = strtotime($app->next_app);
                                                            $unixdatetime = strftime("%B %d %Y", $unixdatetime);
                                                            echo $unixdatetime ?>
                                                            </span>
                                                        </td>
                                                        <td></td>
<!--                                                        <td>
                                                            <?php /*$unixdatetime = strtotime($app->date);
                                                            $unixdatetime = strftime("%B %d %Y", $unixdatetime);
                                                            echo $unixdatetime */?>
                                                        </td>-->

                                                    </tr>
                                                <?php }


                                            }



                                        } else {
                                                 $appointments = Appointment::find_all_open_app();
                                            foreach ($appointments as $app)
                                              //  $sub = SubClinic::find_by_id($app->sub_clinic_id);
                                              //  $clin = Clinic::find_by_id($sub->clinic_id);

                                            { ?>
                                                <tr>
                                                    <td><?php echo $index++ ?></td>
                                                    <td> <?php $patient = Patient::find_by_id($app->patient_id); echo $patient->full_name()  ?>
                                                    </td>
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
                                               <!--     <td><?php //  echo $sub->name ?></td>   -->
                                                    <td><?php $d_date = date('d/m/Y h:i a', strtotime($app->date)); echo $d_date ?></td>
                                                    <td><?php echo $app->next_app ?></td>
                                                    <td><a href="confirm_appointment.php?id=<?php echo $app->id ?>">Confirm</a></td>

<!--                                                    <td><?php /*$unixdatetime = strtotime($app->date);
                                                        $unixdatetime = strftime("%B %d %Y", $unixdatetime);
                                                        echo $unixdatetime */?>
                                                    </td>-->

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























