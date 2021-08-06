<?php

/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 5/24/2019
 * Time: 9:19 AM
 */


require_once("../includes/initialize.php");


$patient = Patient::find_by_id($_GET['id']);

if (empty($patient)){
    redirect_to("../consult/m_clinics.php");
}

$vital = Vitals::find_by_patient($patient->id);


PatientBill::clear_all_bill();
TestBill::clear_all_bill();


if (is_post()) {

    $appointment_date = new DateTime($_POST['appointment_date']);

    $appointment_date = date_format($appointment_date, 'Y-m-d');

    $appointment = new Appointment();
    $appointment->sync = "unsync";
    $appointment->next_app = $appointment_date;
    $appointment->patient_id = $patient->id;
    $appointment->patient_name = $patient->full_name();
    $appointment->patient_mobile = $patient->phone_number;
    $appointment->consultant = "Dr James";
    $appointment->date = strftime("%Y-%m-%d %H:%M:%S", time());
    $appointment->save();
    //pre_d($appointment);die;
    $message = "Next Appointment Date is {$appointment_date} ";
}


require('../layout/header.php');
?>


<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>
                        <?php  echo "Medical Dashboard - " . $patient->title . " " . $patient->full_name(); ?>
                    </h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Treatment</li>
                        <li class="breadcrumb-item active"> History</li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card">

                    <div class="body">

                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="body">

                                    <br />

                                    <?php
                                    if (!empty($message)) { ?>
                                        <div class="alert alert-success alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <?php echo output_message($message); ?>
                                        </div>
                                    <?php } ?>

                                    <ul class="nav nav-tabs-new">
                                        <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#Home-new">Patient's Profile</a></li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Profile-new">Patient History</a></li>

                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane show active" id="Home-new">
                                            <div class="profile-section">

                                            <?php include("../consult/patientDetails.php");  ?>

                                            </div>

                                        </div>

                                        <div class="tab-pane" id="Profile-new">

                                            <?php  include("../consult/patientHistory.php");  ?>

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




<?php
require('../layout/footer.php');
