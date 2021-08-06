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

$patient = Patient::find_by_id($_GET['id']);
$user = User::find_by_id($session->user_id);

if (is_post()) {

    $admission_date = new DateTime($_POST['admission_date']);
    $admission_date = date_format($admission_date, 'Y-m-d');

    $type_adm = $_POST['type_adm'];

    $admission                  = new Admission();
    $admission->patient_id      = $patient->id;
    $admission->in_patient_id   = "0000";
    $admission->adm_doct        = $_POST['provider'];
    $admission->adm_nurse       = "";
    $admission->adm_diagnosis   = $_POST['adm_diagnosis'];
    $admission->adm_purpose     = "";
    $admission->adm_date        = $admission_date;
    $admission->adm_type        = $_POST['type_adm'];
    $admission->discharge_doct  = "";
    $admission->discharge_nurse = "";
    $admission->discharge_date  = "";
    $admission->referral_source = $_POST['referral_source'];
    $admission->discharge_type  = "";
    $admission->discharge_outcome= "";
    $admission->disposition_mode = "";
    $admission->location         = "";
    $admission->ward_no          = $_POST['ward_id'];
    $admission->room_no          = "";
    $admission->bed_no           = "";
    $admission->m_s              = "";
    $admission->ipd_service      = "";
    $admission->deposit          = "";
    $admission->wall_balance     = "";
    $admission->remark_doct      = "";
    $admission->remark_nurse     = "";
    $admission->adm_status       = "Admitted";
    $admission->created          = strftime("%Y-%m-%d %H:%M:%S", time());
    $admission->save();


}



require('../layout/header.php');
?>


<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Admit Patient </h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Patient</li>
                        <li class="breadcrumb-item active">Admission</li>
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

                    <div class="body">


                        <form id="basic-form" method="post" action="">
                            <div class="card">
                                <div class="header">
                                    <h2>Patient Information </h2>
                                </div>
                                <div class="body">
                                    <div class="row clearfix">

                                        <div class="col-sm-3">
                                            <?php
                                            $mr = "";
                                            $mrs = "";
                                            $master = "";
                                            $miss = "";
                                            $titl = "";
                                            if ($patient->title == "Mr") {
                                                $mr = "checked='checked'";
                                                $mrs = "";
                                                $master = "";
                                                $miss = "";
                                                $titl = "";
                                            } else if ($patient->title == "Mrs") {
                                                $mrs = "checked='checked'";
                                            } else if ($patient->title == "Master") {
                                                $master = "checked='checked'";
                                            } else if ($patient->title == "Miss") {
                                                $miss = "checked='checked'";
                                            }
                                            ?>
                                            <div class="form-group">
                                                <label> Title </label>
                                                <br>
                                                <label class="fancy-radio">
                                                    <input type="radio" name="title" value="Mr" readonly data-parsley-errors-container="#error-radio" <?= $mr ?>>
                                                    <span><i></i>Mr</span>
                                                </label>
                                                <label class="fancy-radio">
                                                    <input type="radio" name="title" value="Mrs" readonly <?= $mrs ?>>
                                                    <span><i></i>Mrs</span>
                                                </label>
                                                <label class="fancy-radio">
                                                    <input type="radio" name="title" value="Master" readonly <?= $master ?>>
                                                    <span><i></i>Master</span>
                                                </label>
                                                <label class="fancy-radio">
                                                    <input type="radio" name="title" value="Miss" readonly <?= $miss ?>>
                                                    <span><i></i>Miss</span>
                                                </label>
                                                <p id="error-radio"></p>
                                            </div>

                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" class="form-control" name="first_name" value="<?php echo $patient->first_name ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" class="form-control" name="last_name" value="<?php echo $patient->last_name ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Hospital Number (Old)</label>
                                                <input type="text" class="form-control" name="hosp_number" value="<?php echo $patient->folder_number ?>" readonly>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Date Of Birth</label>
                                                <input type="text" class="form-control" name="dob" placeholder="dd-mm-yyyy" value="<?php echo date_to_text($patient->dob) ?>" readonly>
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label> Gender </label>
                                                <br>
                                                <label class="fancy-radio">
                                                    <input type="radio" name="gender" value="Male" readonly data-parsley-errors-container="#error-radio" <?= ($patient->gender == "Male") ? "checked='checked'" : '' ?> />
                                                    <span><i></i>Male</span>
                                                </label>
                                                <label class="fancy-radio">
                                                    <input type="radio" name="gender" value="Female" <?= ($patient->gender == "Female") ? "checked='checked'" : '' ?> readonly />
                                                    <span><i></i>Female</span>
                                                </label>
                                                <p id="error-radio"></p>
                                            </div>
                                        </div>


                                        <div class="col-sm-5">

                                            <div class="form-group">
                                                <label> Marital Status </label>
                                                <br />
                                                <label class="fancy-radio">
                                                    <input type="radio" name="marital_status" value="Single" required="" data-parsley-errors-container="#error-radio" <?= ($patient->marital_status == "Single") ? "checked='checked'" : '' ?> />
                                                    <span><i></i>Single</span>
                                                </label>
                                                <label class="fancy-radio">
                                                    <input type="radio" name="marital_status" value="Married" <?= ($patient->marital_status == "Married") ? "checked='checked'" : '' ?> />
                                                    <span><i></i>Married</span>
                                                </label>
                                                <label class="fancy-radio">
                                                    <input type="radio" name="marital_status" value="Separated" <?= ($patient->marital_status == "Separated") ? "checked='checked'" : '' ?> />
                                                    <span><i></i>Separated</span>
                                                </label>
                                                <label class="fancy-radio">
                                                    <input type="radio" name="marital_status" value="Divorced" <?= ($patient->marital_status == "Divorced") ? "checked='checked'" : '' ?> />
                                                    <span><i></i>Divorced</span>
                                                </label>
                                                <p id="error-radio"></p>
                                            </div>
                                        </div>
                                    </div>




                                    <ul class="nav nav-tabs">
                                        <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#Home">Admission</a></li>

                                    </ul>
                                    <div class="tab-content">

                                        <div class="tab-pane show active" id="Home">


                                            <div class="row">
                                                <div class="col-md-6">

                                                    <?php if ($done == TRUE) { ?>
                                                        <div class="alert alert-success alert-dismissible" role="alert">
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            Product uploaded successfully.
                                                        </div>
                                                    <?php } else if (empty($errMessage) == FALSE and isset($errMessage)) {
                                                    ?>
                                                        <div class="alert alert-warning alert-dismissible" role="alert">
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <?php echo $errMessage; ?>
                                                        </div>
                                                    <?php
                                                    } ?>

                                                    <div class="form-group">
                                                        <label>Date Of Admission</label>
                                                        <input type="text" class="form-control" id="reg_date" name="admission_date" placeholder="Admission Date" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Type Of Admission</label>
                                                        <select class="form-control" name="type_adm">
                                                            <option value=""></option>
                                                            <option value="From Outside">From Outside</option>
                                                            <option value="Transfer from other unit">Transfer from other unit</option>
                                                            <option value="Waiting List">Waiting List</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Ward Location</label>
                                                        <?php $wards = Wards::find_all(); ?>
                                                        <select class="form-control" name="ward_id" required>
                                                            <option value="">--Select Ward--</option>
                                                            <?php
                                                            foreach ($wards as $ward) { ?>
                                                                <option value="<?php echo $ward->id; ?>"><?php echo $ward->ward_number; ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Admitting Diagnosis</label>
                                                        <input type="text" class="form-control" name="adm_diagnosis" placeholder="Admitting Diagnosis" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Provider</label>
                                                        <input type="text" class="form-control" id="provider" name="provider" placeholder="Provider" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Source Of Referral</label>
                                                        <select class="form-control" name="referral_source">
                                                            <option value=""></option>
                                                            <option value="Government Hospital/Clinic">Government Hospital/Clinic</option>
                                                            <option value="Health Centre">Health Centre</option>
                                                            <option value="Police/Prison/Court">Police/Prison/Court</option>
                                                            <option value="Private Hospital/Clinic">Private Hospital/Clinic</option>
                                                            <option value="Religious Institution">Religious Institution</option>
                                                            <option value="Traditional Healer">Traditional Healer</option>
                                                            <option value="Other">Other</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Deposit</label>
                                                        <input type="text" class="form-control" id="deposit" name="deposit" placeholder="Deposit" required>
                                                    </div>


                                                    <div class="form-group">
                                                        <input type="submit" name="save_admission" value="Save Admission" class="btn btn-primary" />
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                </div>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>

    </div>
</div>





<?php

require('../layout/footer.php');
?>


<script>
    $(function() {

        /*

            $('#registration_search')
                .on('submit', function($ev) {
                    $ev.preventDefault();
                    let patient = $('#registration_search input#folder_number').val();
                    $.post('search.php', {
                        folder_number: patient
                    }, function(data) {
                        $('#registration').html(data.trim());
                    });
                });

        */



    });
</script>