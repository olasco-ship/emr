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


$user = User::find_by_id($session->user_id);

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/auth/signin.php");
}

if (is_post()) {

    /*    $folder_number = $_POST['folder_number'];
        $patient = Patient::find_by_number($folder_number);
    */


    if (isset($_POST['waiting'])) {

        $subClinic = SubClinic::find_by_id($_POST['sub_clinic_id']);

        $patient_id         = test_input($_POST['patient_id']);
        $waiting_list       = test_input($_POST['waiting']);

        $patient            = Patient::find_by_id($patient_id);

        $wait_list                = new WaitingList();
        $wait_list->patient_id    = $patient->id;
        $wait_list->clinic_id     = $subClinic->clinic_id;
        $wait_list->sub_clinic_id = $_POST['sub_clinic_id'];
        $wait_list->room_id       = 0;
        $wait_list->officer       = $user->full_name();
        $wait_list->vitals        = 'NIL';
        $wait_list->status        = 'nurse';
        $wait_list->date          = strftime("%Y-%m-%d %H:%M:%S", time());
        $wait_list->save();
        $session->message("Patient has been added to clinic's waiting list.");
        redirect_to('index.php');
    }



}


require('../layout/header.php');
?>


<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Re-visit </h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Patient</li>
                        <li class="breadcrumb-item active"> Re-visit</li>
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

                <div class="card">
                    <div class="header">
                        <a href="home.php" style="font-size: large">&laquo; Back</a>
                        <h2> Re-visit </h2>
                    </div>
                    <div class="body">
                        <div class="row clearfix">


                            <div class="col-sm-12">
                                <!-- --><?php /*echo output_message($message); */ ?>


                                <?php if (isset($_POST['waiting'])) { ?>

                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        Patient has been added to the Clinic's Waiting List
                                    </div>

                                <?php } ?>


                                <form method="post" action="">
                                    <div class="form-group">
                                        <label>Enter Payment Reference to add Patient to Clinic Waiting List</label>
                                        <input type="text" class="form-control" id="auth_code" name="auth_code" style="width: 300px" placeholder="Payment Reference" required>
                                        <br />
                                        <button type="submit" class="btn btn-primary" data-loading-text="Searching...">Search Record
                                        </button>
                                    </div>
                                </form>

                                <?php
                                if (is_post() and (!isset($_POST['waiting']))) {

                                    $auth_code = $_POST['auth_code'];

                                    $bill = Bill::find_by_auth_code($auth_code);

                                    if (empty($bill)) {  ?>
                                        <div>
                                            <div class="alert alert-warning alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                Payment Reference Not Found In Database!
                                            </div>
                                        </div>

                                    <?php
                                    } else if ($bill->status == "CLEARED") {   ?>
                                        <div>
                                            <div class="alert alert-warning alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                Payment Reference has been previously used!
                                            </div>
                                        </div>
                                    <?php    } else {
                                        $patient = Patient::find_by_id($bill->patient_id);
                                        $patient_clinics = PatientSubClinic::count_patient_clinics($patient->id);
                                    ?>

                                        <div class="row">

                                            <div class="col-md-6">

                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <tr class="table-info">
                                                            <th>Hospital Number</th>
                                                            <td><?php echo $patient->folder_number ?></td>
                                                        </tr>
                                                        <tr class="table-success">
                                                            <th> Number Of Clinics</th>
                                                            <td><?php echo $patient_clinics ?></td>
                                                        </tr>
                                                        <tr class="table-danger">
                                                            <th> Clinic(s)</th>
                                                            <td><?php
                                                                $clinics = PatientSubClinic::find_patient_clinics($patient->id);
                                                                foreach ($clinics as $clinic) {
                                                                    $sub_clinic = SubClinic::find_by_id($clinic->sub_clinic_id);
                                                                    echo $sub_clinic->name . "<br/>";
                                                                }

                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <?php if (isset($patient->nhis_no) and (!empty($patient->nhis_no))) { ?>
                                                                <th>NHIS Number</th>
                                                                <td><?php echo $patient->nhis_no ?></td>
                                                            <?php  }  ?>
                                                        </tr>
                                                        <tr>
                                                            <?php if (isset($patient->nhis_no) and (!empty($patient->nhis_no))) { ?>
                                                                <th>NHIS Eligibility</th>
                                                                <td><?php echo $patient->nhis_eligibility ?></td>
                                                            <?php  }  ?>
                                                        </tr>
                                                        <tr>
                                                            <th>Title </th>
                                                            <td><?php echo $patient->title ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>First Name</th>
                                                            <td><?php echo $patient->first_name ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Last Name</th>
                                                            <td><?php echo $patient->last_name ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Birth Date</th>
                                                            <td><?php echo date('d/m/Y', strtotime($patient->dob))  ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Age</th>
                                                            <td><?php echo getAge($patient->dob) . 'year(s)' ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Gender</th>
                                                            <td><?php echo $patient->gender  ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Blood Group</th>
                                                            <td><?php echo $patient->blood_group  ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th> Genotype </th>
                                                            <td><?php echo $patient->genotype  ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th> Phone Number </th>
                                                            <td><?php echo $patient->phone_number  ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th> Contact Address </th>
                                                            <td><?php echo $patient->address  ?></td>
                                                        </tr>
                                                        <!--                                                                    <tr>
                                                                        <th> Email Address </th>
                                                                        <td><?php /*echo $patient->email  */ ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th> Marital Status </th>
                                                                        <td><?php /*echo $patient->marital_status  */ ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th> Occupation </th>
                                                                        <td><?php /*echo $patient->occupation  */ ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th> Nationality </th>
                                                                        <td><?php /*echo $patient->nationality  */ ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th> State </th>
                                                                        <td><?php /*echo $patient->state  */ ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th> LGA </th>
                                                                        <td><?php /*echo $patient->lga  */ ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th> Religion </th>
                                                                        <td><?php /*echo $patient->religion  */ ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th> Language(s) </th>
                                                                        <td><?php
                                                                            /*                                                                            if (isset($patient->english))
                                                                                echo $patient->english . ", ";
                                                                            if (isset($patient->pidgin))
                                                                                echo $patient->pidgin . ", ";
                                                                            if (isset($patient->hausa))
                                                                                echo $patient->hausa . ", ";
                                                                            if (isset($patient->yoruba))
                                                                                echo $patient->yoruba . ", ";
                                                                            if (isset($patient->igbo))
                                                                                echo $patient->igbo ;
                                                                            */ ?>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th> Next Of Kin </th>
                                                                        <td><?php /*echo $patient->next_kin_surname  */ ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th> Relationship with Next Of Kin </th>
                                                                        <td><?php /*echo $patient->next_kin_relationship  */ ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th> Phone No. Of Next Of Kin </th>
                                                                        <td><?php /*echo $patient->next_kin_phone  */ ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th> Address Of Next Of Kin </th>
                                                                        <td><?php /*echo $patient->next_kin_address  */ ?></td>
                                                                    </tr>
                                                            -->

                                                    </table>
                                                </div>

                                            </div>

                                            <div class="col-md-6">
                                                <form action="" method="post">


                                                    <div class="form-group">
                                                        <label>Hospital Sub Clinic</label>
                                                        <select class="form-control" id="sub_clinic_id" name="sub_clinic_id" required>
                                                            <option value="">--Select Sub-Clinic--</option>
                                                            <?php $patientCL = PatientSubClinic::find_patient_clinics($patient->id);

                                                            foreach ($patientCL as $patientC) {
                                                                $find = SubClinic::find_by_id($patientC->sub_clinic_id);
                                                            ?>
                                                                <option value="<?php echo $find->id; ?>"><?php echo $find->name; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                        <input type="text" class="form-control" name="patient_id" value="<?php echo $patient->id ?>" hidden>
                                                    </div>


                                                    <!--
                                                    <div class="form-group">
                                                        <label>Hospital Clinic</label>
                                                        <select class="form-control" id="clinic_id" name="clinic_id" required>
                                                            <option value="">--Select Clinic--</option>
                                                            <?php
                                                            $finds = Clinic::find_all();
                                                            foreach ($finds as $find) {
                                                            ?>
                                                                <option value="<?php echo $find->id; ?>"><?php echo $find->name; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                        <input type="text" class="form-control" name="patient_id" value="<?php echo $patient->id ?>" hidden>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Sub-Clinic</label>
                                                        <div id="sub_clinic_id">

                                                        </div>
                                                    </div>
                                                    -->



                                                    <button type="submit" name="waiting" class="btn btn-success">Submit</button>
                                                </form>
                                            </div>


                                        </div>

                                <?php }
                                }
                                ?>



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
