<?php
require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$user = User::find_by_id($session->user_id);

$referral = Referrals::find_by_id($_GET['id']);

$patient = Patient::find_by_id($referral->patient_id);

$sub = SubClinic::find_by_id($referral->current_sub_clinic_id);

$ref = SubClinic::find_by_id($referral->referred_sub_clinic_id);

$ref_clinic = Clinic::find_by_id($ref->clinic_id);


if(is_post()){


        $clinic_number = $_POST['clinic_number'];


        $patientSubClinic                = new PatientSubClinic();
        $patientSubClinic->sync          = "off";
        $patientSubClinic->patient_id    = $patient->id;
        $patientSubClinic->sub_clinic_id = $ref->id;
        $patientSubClinic->clinic_id     = $ref->clinic_id;
        $patientSubClinic->clinic_number = $clinic_number;
        $patientSubClinic->date          = strftime("%Y-%m-%d %H:%M:%S", time());
        if ($patientSubClinic->save()){
            $wait_list                = new WaitingList();
            $wait_list->sync          = "off";
            $wait_list->patient_id    = $patient->id;
            $wait_list->clinic_id     = $ref->clinic_id;
            $wait_list->sub_clinic_id = $ref->id;
            $wait_list->room_id       = 0;
            $wait_list->officer       = $user->full_name();
            $wait_list->vitals        = '';
            $wait_list->status        = 'nurse';
            $wait_list->date          = strftime("%Y-%m-%d %H:%M:%S", time());
            if ($wait_list->save()){
                $Ref         = Referrals::find_by_id($referral->id);
                $Ref->sync   = "off";
                $Ref->status = "DONE";
                $Ref->save();
                $done = TRUE;
                $session->message("Patient has been sent to the clinic/waiting list.");
                redirect_to('cleared_referrals.php');
            }



        }




}



require('../layout/header.php');

?>


    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Consultant  </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo emr_lucid ?>/home.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Clinics</li>
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
                <div class="col-md-6">
                    <a href="cleared_referrals.php" style="font-size: large">&laquo; Back</a>
                    <div class="card">
                        <div class="header">
                            <h2> Add Patient To Clinic/Waiting List </h2>
                        </div>

                        <div class="body">
                            <form id="basic-form" action="" method="post" novalidate>


                                <div class="form-group">
                                    <label> Patient Name</label>
                                    <input class="form-control" type="text" value="<?php echo $patient->full_name() ?>" readonly >
                                </div>

                                <div class="form-group">
                                    <label> Current Sub-Clinic </label>
                                    <input class="form-control" type="text" value="<?php echo $sub->name ?>" readonly >
                                </div>

                                <div class="form-group">
                                    <label> Referred Clinic </label>
                                    <input class="form-control" type="text"  value="<?php echo $ref_clinic->name ?>" readonly >
                                </div>

                                <div class="form-group">
                                    <label> Referred Sub-Clinic </label>
                                    <input class="form-control" type="text"  value="<?php echo $ref->name ?>" readonly >
                                </div>

                                <div class="form-group">
                                    <label>  Clinic Number </label>
                                    <input class="form-control" type="text" name="clinic_number"  value="<?php echo $clinic_number ?>" required >
                                </div>


                                <br/>
                                <button type="submit" class="btn btn-primary"> Add To Clinic </button>

                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>





<?php

require('../layout/footer.php');