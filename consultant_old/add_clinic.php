<?php
require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}





$message = "";
$done = FALSE;
$errMessage = "";
$first_name = $last_name = $username = $password = $created = $role = "";
$errFirstName = $errLastName = $errUserName = $errPassword = $errCreated = $errRole = "";


if(is_post()){

    $user_id = test_input($_POST['user_id']);

    $clinic_id = test_input($_POST['clinic_id']);

    $sub_clinic_id = test_input($_POST['sub_clinic_id']);

    $currentClinic = UserSubClinic::find_user_sub_clinic_id($user_id, $sub_clinic_id);

    if (empty($currentClinic)){
        $userSubClinic                = new UserSubClinic();
        $userSubClinic->user_id       = $user_id;
        $userSubClinic->sub_clinic_id = $sub_clinic_id;
        $userSubClinic->clinic_id     = $clinic_id;
        $userSubClinic->date          = strftime("%Y-%m-%d %H:%M:%S", time());
        $userSubClinic->save();
        redirect_to("officers.php");
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

                </div>
            </div>

            <a style="font-size: larger" href="../consultant/index.php">&laquo;Back</a>
            <div class="row clearfix">
                <div class="col-md-6">
                    <div class="card">
                        <div class="header">
                            <h2> Create User </h2>
                        </div>

                        <div class="body">
                            <form id="basic-form" action="" method="post" novalidate>


                                <div class="form-group">
                                    <label> Consultant</label>
                                    <select class="form-control"  id="user_id" name="user_id" required>
                                        <!--<option value="">--Select Nurse--</option>-->
                                        <?php
                                        //  $department = "Nursing";
                                        $find = User::find_by_id($_GET['id']);
                                        /*foreach ($finds as $find) {*/
                                        ?>
                                        <option
                                            value="<?php echo $find->id; ?>"><?php echo $find->full_name(); ?></option>
                                        <!--                                            --><?php
                                        /*                                        }
                                                                                */?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Hospital Clinic</label>
                                    <select class="form-control"  id="clinic_id" name="clinic_id" required>
                                        <option value="">--Select Clinic--</option>
                                        <?php
                                        $finds = Clinic::find_all();
                                        foreach ($finds as $find) {
                                            ?>
                                            <option
                                                value="<?php echo $find->id; ?>"><?php echo $find->name; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label>Sub-Clinic</label>
                                    <div id="sub_clinic_id">

                                    </div>
                                </div>



                                <br/>
                                <button type="submit" class="btn btn-primary"> Add User </button>

                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>





<?php

require('../layout/footer.php');