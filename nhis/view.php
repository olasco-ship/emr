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

$index = 1;

$enrollee = Enrollee::find_by_id($_GET['id']);

// echo $patient->first_name;

if (is_post()) {

    if (isset($_POST['update_record'])){

        if (empty($_POST['first_name'])) {
            $errFirstName = "First Name is Required";
            $errMessage .= $errFirstName . "<br/>";
        } else {
            $first_name = test_input($_POST['first_name']);
            if (!preg_match("/^[a-zA-Z]*$/", $first_name)) {
                $errFirstName = "Only letters and white space are allowed for First Name";
                $errMessage .= $errFirstName . "<br/>";
            }
        }

        if (empty($_POST['last_name'])) {
            $errLastName = "Last Name is Required";
            $errMessage .= $errLastName . "<br/>";
        } else {
            $last_name = test_input($_POST['last_name']);
            if (!preg_match("/^[a-zA-Z]*$/", $last_name)) {
                $errLastName = "Only letters and white space are allowed for Last Name";
                $errMessage .= $errLastName . "<br/>";
            }
        }

        if (empty($_POST['nhis_number'])) {
            $errNhisNumber = "NHIS Number  is Required";
            $errMessage .= $errNhisNumber . "<br/>";
        } else {
            $nhis_number = test_input($_POST['nhis_number']);
            $stf = Enrollee::find_by_nhis_number($nhis_number);
            if (isset($stf) && !empty($stf)) {
                $errNhisNumber = "NHIS Number already already exists";
                $errMessage .= $errNhisNumber . "<br/>";
            } else {
                $nhis_number = test_input($_POST['nhis_number']);
            }
        }


        $hmo = test_input($_POST['hmo']);

        $dob = new DateTime($_POST['dob']);
        $dob = date_format($dob, 'Y-m-d');

        $reg_date = new DateTime($_POST['reg_date']);
        $reg_date = date_format($reg_date, 'Y-m-d');

        $plan_id = $_POST['plan_id'];

        if (empty($_POST['gender'])) {
            $errGender   = "Gender is Required";
            $errMessage .= $errGender . "<br/>";
        } else {
            $gender = test_input($_POST['gender']);
        }


        if (empty($_POST['address'])) {
            $errAddress = "Contact Address is Required";
            $errMessage .= $errAddress . "<br/>";
        } else {
            $address = test_input($_POST['address']);
        }

        if (empty($_POST['phone_number'])) {
            $errPhoneNumber = "Phone Number  is Required";
            $errMessage .= $errPhoneNumber . "<br/>";
        } else {
            $phone_number = test_input($_POST['phone_number']);
        }


    }

    if ((!$errMessage) and (empty($errMessage))) {
        $date_registered   = strftime("%Y-%m-%d %H:%M:%S", time());

        $enrollee->sync            = "off";
        $enrollee->first_name      = $first_name;
        $enrollee->last_name       = $last_name;
        $enrollee->nhis_number     = $nhis_number;
        $enrollee->gender          = $gender;
        $enrollee->dob             = $dob;
        $enrollee->phone_number    = $phone_number;
        $enrollee->contact_address = $address;
        $enrollee->hmo             = $hmo;
        $enrollee->plan_id         = $plan_id;
        $enrollee->reg_date        = $reg_date;
        $enrollee->status          = "off";
        $enrollee->date            = $date_registered;

        // echo   print_r($newEnrollee);  exit;

        if ($enrollee->save()) {
            $enrolleeSub = EnrolleeSubscription::find_by_id($_GET['id']);
            $enrolleeSub->sync        = "off";
            $enrolleeSub->enrollee_id = $enrollee->id;
            $enrolleeSub->start_date  = $reg_date;
            $enrolleeSub->status      = "off";
            $enrolleeSub->date        = $date_registered;
            $enrolleeSub->save();

            $done = TRUE;
            $session->message("Enrollee has been updated.");
            redirect_to('patients.php');
        }


    }

    if ($errMessage) {
        $panelClass = 'panel-danger';
        $panelHeader = '<div class="panel-heading"><h3 class="panel-title">Please correct the errors in the form<br></h3> class=
                          "panel-title alert alert-danger">' . $errMessage . '</h3> </div>';
    }

}

require('../layout/header.php');

?>




    <div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Medical Records</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active">NHIS</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row clearfix">

            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="body">


                        <a style="font-size: larger" href="../nhis/patients.php">&laquo;Back</a>
                        <div class="body">

                            <ul class="nav nav-tabs-new2">
                                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#details">Enrollee Details</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#modify">Modify Enrollee's Details</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#subHistory">Subscription History</a></li>
                            </ul>

                            <div class="tab-content mt-3">

                                <div class="tab-pane active" id="details">

                                    <div class="col-lg-12 col-md-12">
                                        <div class="table-responsive">
                                            <table border="1" cellspacing="0" cellpadding="5" style="margin-top:0px;font-size:16px; width: 100%;">
                                                <tr>
                                                    <th>First Name</th>
                                                    <td><?php echo $enrollee->first_name ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Last Name</th>
                                                    <td><?php echo $enrollee->last_name ?></td>
                                                </tr>
                                                <tr>
                                                    <th>NHIS Number</th>
                                                    <td><?php echo $enrollee->nhis_number ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Gender</th>
                                                    <td><?php echo $enrollee->gender ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Date of Birth</th>
                                                    <td><?php echo $enrollee->dob ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Phone Number</th>
                                                    <td><?php echo $enrollee->contact_address ?></td>
                                                </tr>
                                                <tr>
                                                    <th>HMO </th>
                                                    <td><?php echo $enrollee->hmo ?></td>
                                                </tr>
                                                <tr>
                                                    <th>PLAN NAME</th>
                                                    <td><?php $enrolled = NhisPlan::find_by_id($enrollee->plan_id);
                                                        echo $enrolled->plan_name;  ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Registration Date</th>
                                                    <td><?php echo $enrollee->reg_date ?></td>
                                                </tr>
<!--                                                <tr>
                                                    <th>Registered By</th>
                                                    <td><?php /*echo $enrollee->registered_by */?></td>
                                                </tr>
                                                <tr>
                                                    <th>Modified By</th>
                                                    <td><?php /*echo $enrollee->modified_by */?></td>
                                                </tr>-->

                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="modify">

                                    <form id="basic-form" method="post" action="">
                                        <div class="card">
                                            <h2>Basic Information</h2>
                                        </div>
                                        <div class="body">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="First Name"
                                                       name="first_name" style="..." value="<?php echo $enrollee->first_name ?>" required>
                                            </div>

                                            <div class="form-group">
                                                <!--<label>Last Name</label>-->
                                                <input type="text" class="form-control" placeholder="Last Name"
                                                       name="last_name" style="..." value="<?php echo $enrollee->last_name ?>" required>
                                            </div>

                                            <div class="form-group">
                                                <!-- <label>Folder Number</label>-->
                                                <input type="text" class="form-control" placeholder="NHIS Number" id="nhis_number"
                                                       name="nhis_number" style="..." value="<?php echo $enrollee->nhis_number ?>" required>
                                            </div>

                                            <div class="form-group">
                                                <!-- <label>Folder Number</label>-->
                                                <input type="text" class="form-control" placeholder="HMO"
                                                       name="hmo" style="..." value="<?php echo $enrollee->hmo ?>" >
                                            </div>

                                            <!--<div class="form-group">
                                                 <label>Date Of Birth</label>
                                                <input type="text" class="form-control" placeholder="Registration Date"
                                                       name="reg_date" id="reg_date" style="..."
                                                       value="<?php /*$d_date = date('d/m/Y', strtotime($enrollee->reg_date));
                                                echo $d_date */?>" required>
                                            </div>-->

                                            <div class="form-group">
                                                <select class="form-control"  id="plan_name" name="plan_id" style="..." required>
                                                    <option value="">--Select Plan Name--</option>
                                                    <?php
                                                    $finds = NhisPlan::find_all();
                                                    foreach ($finds as $find) { ?>
                                                        <option <?php echo $find->id == $enrollee->plan_id ?
                                                            'selected' : ''; ?> value="<?php echo $find->id; ?>">
                                                            <?php echo $find->plan_name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <!--
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Expiry Date" name="exp_date" id="exp_date" value="<?php echo $exp_date ?>" required>
                                            </div>
                                            -->

                                            <div class="form-group">
                                                <!--  <label class="control-label">Gender</label>-->
                                                <select class="form-control" name="gender" style="..." required>
                                                    <option value="<?php echo $enrollee->gender ?>"><?php echo $enrollee->gender ?></option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <!-- <label>Date Of Birth</label>-->
                                                <input type="text" class="form-control" placeholder="Date Of Birth"
                                                       name="dob" id="dob" style="..." value="<?php echo $enrollee->dob ?>" required>
                                            </div>

                                            <div class="form-group">
                                                <!--<label>Contact Address</label>-->
                                                <textarea class="form-control" placeholder="Contact Address" name="address"
                                                          rows="2" cols="10" style="..." required><?php echo $enrollee->contact_address ?></textarea>
                                            </div>

                                            <div class="form-group">
                                                <!--   <label>Phone Number</label>-->
                                                <input type="text" class="form-control" placeholder="Phone Number" name="phone_number" style="..." required value="<?php echo $enrollee->phone_number ?>">
                                            </div>

                                            <br />

                                            <button type="submit" class="btn btn-primary" name="update_record">Update Record</button>

                                            <br>

                                        </div>
                                </div>

                                <div class="tab-pane" id="subHistory">

<!--                                            <ul class="nav nav-tabs-new2">
                                                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#All"> Subscription History </a></li>
                                            </ul>
                                            <div class="tab-content m-t-10 padding-0">
                                                <div class="tab-pane table-responsive active show" id="All">
                                                    <table class="table m-b-0 table-hover">
                                                        <thead class="thead-purple">
                                                        <tr>

                                                            <th>NHIS No.</th>
                                                            <th>Enrollee Name</th>
                                                            <th>Age</th>
                                                            <th>Gender</th>
                                                            <th>Start Date </th>
                                                            <th>End Date</th>
                                                            <th>Validity</th>

                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                        <?php
/*                                                        if (is_post()) {
                                                            $query = trim($_POST['search']);
                                                            $patients = Patient::find_patient_by_num_or_name($query);
                                                            foreach ($patients as $patient) {   */?>
                                                                <tr>
                                                                    <td><?php /*echo $patient->folder_number */?></td>
                                                                    <td><?php /*echo $patient->full_name() */?></td>
                                                                    <td><?php /*echo $bill->consultant */?></td>
                                                                    <td><?php /*echo $patient->gender */?></td>
                                                                    <td><?php /*$d_date = date('d/m/Y h:i:a', strtotime($bill->date));
                                                                        echo $d_date */?></td>
                                                                    <td><a href='index.php?id=<?php /*echo $bill->id */?>'>Cost</a></td>

                                                                </tr>
                                                            <?php /*}
                                                        } else {

                                                            $enSub = EnrolleeSubscription::find_all_by_enrollee_id($enrollee->id);
                                                            foreach ($enSub as $en) {
                                                                */?>
                                                                <tr>

                                                                    <td><a href='view.php?id=<?php /*echo $enrollee->id */?>'><?php /*echo $enrollee->nhis_number */?></a></td>
                                                                    <td><?php /*echo $enrollee->full_name() */?></td>
                                                                    <td><?php /*echo getAge($enrollee->dob) . "years" */?></td>
                                                                    <td><?php /*echo $enrollee->gender */?></td>
                                                                    <td><?php /*$d_date = date('d/m/Y', strtotime($enrollee->reg_date));
                                                                        echo $d_date */?></td>
                                                                    <td><?php /*$d_date = date('d/m/Y', strtotime($enrollee->exp_date));
                                                                        echo $d_date */?></td>

                                                                    <td>
                                                                        <?php
/*                                                                        $eligibility = checkValidity($enrollee->exp_date);
                                                                        if ($eligibility == 'Valid'){
                                                                            echo "<span class='badge badge-success'>$eligibility</span>";
                                                                        } else if ($eligibility == 'Expired'){
                                                                            echo "<span class='badge badge-danger'>$eligibility</span>";
                                                                        }

                                                                        */?>

                                                                    </td>
                                                                </tr>

                                                            <?php /*}
                                                        }
                                                        */?>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>-->

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
