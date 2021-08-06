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

//$subClinic = SubClinic::find_by_id($user->sub_clinic_id);

$patient = Patient::find_by_id($_GET['id']);

//$patient = Patient::find_by_id($waiting->patient_id);



require('../layout/header.php');

?>


<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> All Patient</h2>
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
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">

                            <a style="font-size: larger" href="clinic_patients.php">&laquo;Back</a>

                            <h2 class="page-title"><?php echo $patient->title . " " . $patient->full_name(); ?></h2>
                        </div>
                        <div class="body">
                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#Profile-withicon"><i class="fa fa-user"></i> Basic
                                        Profile</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Home-withicon"><i class="fa fa-vcard"></i>Clinical History</a></li>
                                
                                <!--    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#add-withicon"><i class="fa fa-vcard"></i>Add Clinical History </a></li> -->
                                <!--   <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#new-withicon"><i class="fa fa-vcard"></i> New Vitals</a></li>  
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#consult-rooms"><i class="fa fa-vcard"></i> Consulting Rooms </a></li>  -->
                            </ul>
                            <div class="tab-content">

                                <div class="tab-pane show active" id="Profile-withicon">

                                    <?php include("../consult/patientDetails.php");  ?>


                                </div>

                                <div class="tab-pane" id="Home-withicon">


                                    <?php include("../consult/patientHistory.php");  ?>



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
