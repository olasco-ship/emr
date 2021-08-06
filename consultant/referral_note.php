<?php
require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$user = User::find_by_id($session->user_id);

$referral = Referrals::find_by_id($_GET['id']);

$patient = Patient::find_by_id($referral->patient_id);

$userSub = UserSubClinic::find_by_user_id($user->id);


if(is_post()) {
    if (isset($_POST['accept'])) {

        $referral->status = "OPEN";
        $referral->save();
        redirect_to("referral_confirmation.php");
    }

    if (isset($_POST['refer_patient'])) {

        $clinic_id = test_input($_POST['clinic_id']);

        $sub_clinic_id = test_input($_POST['sub_clinic_id']);

        $clinic_note = test_input($_POST['clinic_note']);

        $referral->status = "OPEN";
        $referral->save();

        $referrals = new Referrals();
        $referrals->sync = "off";
        $referrals->patient_id = $patient->id;
        $referrals->waiting_list_id = "";
        $referrals->ref_adm_id = 0;
        $referrals->current_sub_clinic_id = $userSub->sub_clinic_id;
        $referrals->referred_sub_clinic_id = $sub_clinic_id;
        $referrals->consultant = $user->full_name();
        $referrals->referral_note = $clinic_note;
        $referrals->status = "OPEN";
        $referrals->date = strftime("%Y-%m-%d %H:%M:%S", time());
        $referrals->save();
        $session->message("Patient has been referred!");
        redirect_to("referral_confirmation.php");
    }



}


require('../layout/header.php');
?>



    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> BILLING </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="home.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active">Bill Patient</li>
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

            <a href="referral_confirmation.php" style="font-size: large">&laquo; Back</a>

            <div class="row clearfix">
                <div class="col-lg-6 col-md-6 col-sm-6 ">
                    <div class="card">
                        <div class="header">
                            <h2>Referred Patient</h2>
                        </div>
                        <div class="body">
                            <form action="" method="post">
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="First Name"  name="first_name"
                                                   value="<?php echo $patient->first_name ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Surname" name="last_name"
                                                   value="<?php echo $patient->last_name ?>" readonly>
                                        </div>
                                    </div>


                                    <div class="col-sm-12">
                                        <div class="form-group">
                                           <textarea class="form-control" name="refNote"><?php echo $referral->referral_note?></textarea>

                                        </div>
                                    </div>


                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <button type="submit" name="accept" class="btn btn-outline-primary">Accept</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 ">
                    <div class="card">
                        <div class="header">
                            <h2>Refer to other clinic</h2>
                        </div>
                        <div class="body">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label>Hospital Clinic</label>
                                    <select class="form-control" id="clinic_id"
                                            name="clinic_id" required>
                                        <option value="">--Select Clinic--</option>
                                        <?php
                                        $finds = Clinic::find_all();
                                        foreach ($finds as $find) { ?>
                                            <option value="<?php echo $find->id; ?>"><?php echo $find->name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Sub-Clinic</label>
                                    <div id="sub_clinic_id">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Note to clinic</label>
                                    <textarea class='form-control' rows='5'
                                              cols='70' placeholder='Notes'
                                              name='clinic_note'></textarea>
                                </div>

                                <div class="form-group">
                                    <button type="submit" name="refer_patient"
                                            class="btn btn-success"> Refer Patient
                                    </button>
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