<?php

/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/17/2019
 * Time: 4:43 PM
 */


require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}


$result = Result::find_by_id($_GET['id']);

$patient = Patient::find_by_id($result->patient_id);

$user = User::find_by_id($session->user_id);


if (is_post()) {


    $specimen_label  = $_POST['specimen_label'];
    $no_whole_blood  = $_POST['no_whole_blood'];
    $no_red_cell     = $_POST['no_red_cell'];
    $other_blood     = $_POST['other_blood'];
    $exchange        = $_POST['exchange'];
    $abo_rh          = $_POST['abo_rh'];
    $hep_c           = $_POST['hep_c'];
    $coombs_test     = $_POST['coombs_test'];
    $ind_coombs_test = $_POST['ind_coombs_test'];
    $anti_screening  = $_POST['anti_screening'];
    $hep_b           = $_POST['hep_b'];
    $hbs_ab          = $_POST['hbs_ab'];
    $hbe_ag          = $_POST['hbe_ag'];
    $hbe_ab          = $_POST['hbe_ab'];
    $hbc_ab          = $_POST['hbc_ab'];
    $hbc_ab_igm      = $_POST['hbc_ab_igm'];
    $hiv             = $_POST['hiv'];
    $syplius         = $_POST['syplius'];
    $time_sample_taken = $_POST['time_sample_taken'];
    $time_sample_arrive = $_POST['time_sample_arrive'];
    $type_crossmatch    = $_POST['type_crossmatch'];
    $normal             = $_POST['normal'];
    $emergency          = $_POST['emergency'];
    $other              = $_POST['other'];
    $rec_prev_tran      = $_POST['rec_prev_tran'];
    $group_one          = $_POST['group_one'];
    $group_two          = $_POST['group_two'];
    $group_three        = $_POST['group_three'];
    $group_four         = $_POST['group_four'];
    $notes              = $_POST['notes'];
    $rep_ser_inv        = $_POST['rep_ser_inv'];

    $rh_one = new DateTime($_POST['rh_one']);
    $rh_two = new DateTime($_POST['rh_two']);
    $rh_three = new DateTime($_POST['rh_three']);
    $rh_four = new DateTime($_POST['rh_four']);

    $rh_one       = date_format($rh_one, 'Y-m-d');
    $rh_two       = date_format($rh_two, 'Y-m-d');
    $rh_three     = date_format($rh_three, 'Y-m-d');
    $rh_four      = date_format($rh_four, 'Y-m-d');

    $date_col = new DateTime($_POST['date_col']);
    $date_rec = new DateTime($_POST['date_rec']);
    $rev_date = new DateTime($_POST['rev_date']);
    $date_prev_tran = new DateTime($_POST['date_prev_tran']);

    $date_col       = date_format($date_col, 'Y-m-d');
    $date_rec       = date_format($date_rec, 'Y-m-d');
    $rev_date       = date_format($rev_date, 'Y-m-d');
    $date_prev_tran = date_format($date_prev_tran, 'Y-m-d');


    $bt                   = new StdClass();
    $bt->specimen_label   = $specimen_label;
    $bt->no_whole_blood   = $no_whole_blood;
    $bt->no_red_cell      = $no_red_cell;
    $bt->other_blood      = $other_blood;
    $bt->exchange         = $exchange;
    $bt->abo_rh           = $abo_rh;
    $bt->hep_c            = $hep_c;
    $bt->coombs_test      = $coombs_test;
    $bt->ind_coombs_test  = $ind_coombs_test;
    $bt->anti_screening   = $anti_screening;
    $bt->hep_b            = $hep_b;
    $bt->hbs_ab           = $hbs_ab;
    $bt->hbe_ag           = $hbe_ag;
    $bt->hbe_ab           = $hbe_ab;
    $bt->hbc_ab           = $hbc_ab;
    $bt->hbc_ab_igm       = $hbc_ab_igm;
    $bt->hiv              = $hiv;
    $bt->syplius          = $syplius;
    $bt->time_sample_taken  = $time_sample_taken;
    $bt->time_sample_arrive = $time_sample_arrive;
    $bt->type_crossmatch    = $type_crossmatch;
    $bt->normal             = $normal;
    $bt->emergency          = $emergency;
    $bt->other              = $other;
    $bt->rec_prev_tran      = $rec_prev_tran;
    $bt->group_one          = $group_one;
    $bt->group_two          = $group_two;
    $bt->group_three        = $group_three;
    $bt->group_four         = $group_four;
    $bt->rh_one             = $rh_one;
    $bt->rh_two             = $rh_two;
    $bt->rh_three           = $rh_three;
    $bt->rh_four            = $rh_four;
    $bt->rep_ser_inv        = $rep_ser_inv;
    $bt->notes              = $notes;
    $bt->date               = strftime("%Y-%m-%d %H:%M:%S", time());

    $json = json_encode($bt);
    //  echo $json; exit;
    $result->sync           = "off";
    $result->lab_no         = $_POST['lab_no'];
    $result->scientist_note = $note;
    $result->resultData     = $json;
    $result->scientist      = $user->full_name();
    $result->qc_officer     = "";
    $result->date           = strftime("%Y-%m-%d %H:%M:%S", time());
    if (isset($_POST['prelim_save'])) {
        $result->status         = 'PRELIM';
        $result->save();
        $session->message("Result has been saved.");
        redirect_to('qc_check.php');
    }
    if (isset($_POST['final_save'])) {
        $result->status         = 'FINAL';
        $result->save();
        $session->message("Result has been sent to Doctor.");
        redirect_to('qc_check.php');
    }







}


require('../layout/header.php');
?>


<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>
                        Lab Request Forms </h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Laboratory</li>
                        <li class="breadcrumb-item active">Forms</li>
                    </ul>
                </div>

            </div>
        </div>



        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card patients-list">

                    <div class="body">
                        <div class="container">

                            <a href="../lab/sample_analysis.php">Back</a>

                            <h4 style="text-align: center">OBAFEMI AWOLOWO UNIVERSITY TEACHING HOSPITALS COMPLEX</h4>
                            <h6 style="text-align: center">BLOOD TRANSFUSION FORM</h6>


                            <form action="" method="post">

                                <div class="row">
                                    <div class="col-md-6">


                                        <div class="table-responsive">
                                            <!--<h4><?php /*echo $patient->full_name() */ ?></h4>-->
                                            <table class="table table">
                                                <tbody>
                                                    <tr class="active">
                                                        <th>Patient</th>
                                                        <td> <?php
                                                                if (!empty($patient)) {
                                                                    echo $patient->full_name();
                                                                } else {
                                                                    $labWalkIn = LabWalkIn::find_by_id($result->labWalkIn_id);
                                                                    echo $labWalkIn->first_name . " " . $labWalkIn->last_name;
                                                                }
                                                                ?>
                                                        </td>
                                                    </tr>
                                                    <tr class="active">
                                                        <th>Clinical Details</th>
                                                        <td> <?php echo $result->doctor_note  ?></td>
                                                    </tr>

                                                    <tr class="active">
                                                        <th>Birthdate</th>
                                                        <td> <?php
                                                                if (!empty($patient)) {
                                                                    $d_date = date('d-M-Y', strtotime($patient->dob));
                                                                    echo $d_date;
                                                                } else {
                                                                    echo 'NA';
                                                                }
                                                                ?>
                                                        </td>
                                                    </tr>

                                                    <tr class="active">
                                                        <th>Age</th>
                                                        <td> <?php
                                                                if (!empty($patient)) {
                                                                    echo getAge($patient->dob) . 'years';
                                                                } else {
                                                                    $labWalkIn = LabWalkIn::find_by_id($result->labWalkIn_id);
                                                                    echo $labWalkIn->age . 'years';
                                                                }
                                                                ?>
                                                        </td>
                                                    </tr>
                                                    <tr class="active">
                                                        <th>Sex</th>
                                                        <td> <?php
                                                                if (!empty($patient)) {
                                                                    echo $patient->gender;
                                                                } else {
                                                                    $labWalkIn = LabWalkIn::find_by_id($result->labWalkIn_id);
                                                                    echo $labWalkIn->gender;
                                                                }
                                                                ?>
                                                        </td>
                                                    </tr>

                                                    <tr class="active">
                                                        <th>Specimen</th>
                                                        <td> <?php $decode = json_decode($result->specimen);
                                                                foreach ($decode as $item) {
                                                                    echo $item . ', ';
                                                                }
                                                                ?>
                                                        </td>
                                                    </tr>

                                                    <tr class="active">
                                                        <th>Test</th>
                                                        <td> <?php $decode = json_decode($result->test);
                                                                foreach ($decode as $item) {
                                                                    echo $item . ', ';
                                                                }
                                                                ?>
                                                        </td>
                                                    </tr>



                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <table class="table table">
                                            <tbody>
                                                <tr class="active">
                                                    <th>Lab No.</th>
                                                    <!--   <td> <input class="form-control"  style="width: 300px;" value="<?php isset($result->lab_no) ? $result->lab_no : $lab_no ?>" name="lab_no"/> </td>   -->
                                                    <td> <input class="form-control" style="width: 300px;" value="<?php echo $result->lab_no ?>" name="lab_no" /> </td>
                                                </tr>

                                                <tr class="active">
                                                    <th>Hospital No.</th>
                                                    <td> <?php
                                                            // echo $patient->folder_number;
                                                            if (!empty($patient)) {
                                                                echo $patient->folder_number;
                                                            } else {
                                                                echo 'NA';
                                                            }
                                                            ?>
                                                    </td>
                                                </tr>
                                                <tr class="active">
                                                    <th>Clinic </th>
                                                    <td> <?php
                                                            if (!empty($patient)) {
                                                                echo $result->clinic;
                                                            } else {
                                                                echo 'NA';
                                                            }
                                                            ?>
                                                    </td>
                                                </tr>
                                                <tr class="active">
                                                    <th> Doctor </th>
                                                    <td> <?php echo $result->doctor  ?> </td>
                                                </tr>
                                                <tr class="active">
                                                    <th>Date Sample Col.</th>
                                                    <td> <?php $d_date = date('d/M/Y', strtotime($result->date_col));
                                                            $time = date('h:i a', strtotime($result->time_col));
                                                            echo $d_date . " " . $time ?> </td>
                                                </tr>


                                            </tbody>
                                        </table>

                                    </div>
                                </div>


                                <div class="card">
                                    <div class="card-header">

                                        Blood Transfusion

                                    </div>


                                    <?php
                                    $result->resultData;
                                    $decode = json_decode($result->resultData);

                                    if (isset($result->resultData) and !empty($result->resultData)) {
                                    ?>


                                        <div class="card-body">

                                            <div class="row">

                                                <div class="col-md-12 col-sm-12 col-lg-12">

                                                    <table>


                                                        <table class="table table-bordered">

                                                            <?php
                                                            foreach ($decode as $key => $value) {

                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'no_whole_blood') {   ?>
                                                                        <tr>
                                                                            <td><b>Number of Unit of Whole Blood Required</b></td>
                                                                            <td><input class="form-control" name="no_whole_blood" value="<?php echo $value ?>"></td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                }

                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'no_red_cell') {   ?>
                                                                        <tr>
                                                                            <td><b>Number of Units of Red Cell Concentrate(packed red cells)</b></td>
                                                                            <td><input class="form-control" name="no_red_cell" value="<?php echo $value ?>"></td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                }

                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'other_blood') {   ?>
                                                                        <tr>
                                                                            <td><b>Other Blood Components(please state)</b></td>
                                                                            <td><input class="form-control" name="other_blood" value="<?php echo $value ?>"></td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                }

                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'exchange') {   ?>
                                                                        <tr>
                                                                            <td><b>Exchange Blood Transfusion</b></td>
                                                                            <td><input class="form-control" name="exchange" value="<?php echo $value ?>"></td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                }

                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'abo_rh') {   ?>
                                                                        <tr>
                                                                            <td><b>ABO and Rh Grouping Only</b></td>
                                                                            <td><input class="form-control" name="abo_rh" value="<?php echo $value ?>"></td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                }

                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'hep_c') {   ?>
                                                                        <tr>
                                                                            <td><b>Hepatitis 'C' Surface Ag Screening</b></td>
                                                                            <td><input class="form-control" name="hep_c" value="<?php echo $value ?>"></td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                }

                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'coombs_test') {   ?>
                                                                        <tr>
                                                                            <td><b>Direct Coombs' Test</b></td>
                                                                            <td><input class="form-control" name="coombs_test" value="<?php echo $value ?>"></td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                }

                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'ind_coombs_test') {   ?>
                                                                        <tr>
                                                                            <td><b>Indirect Coombs' Test</b></td>
                                                                            <td><input class="form-control" name="ind_coombs_test" value="<?php echo $value ?>"></td>
                                                                        </tr>
                                                                        <?php
                                                                    }
                                                                }

                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'anti_screening') {   ?>
                                                                        <tr>
                                                                            <td><b>Other Antibody Screening</b></td>
                                                                            <td><input class="form-control" name="anti_screening" value="<?php echo $value ?>"></td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                }

                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'hep_b') {   ?>
                                                                        <tr>
                                                                            <td><b>HBsAg </b></td>
                                                                            <td><!--<input class="form-control" name="hep_b" value="<?php /*echo $value */?>">-->
                                                                                <select class="form-control" name="hep_b">
                                                                                    <option <?php echo ($value == 'Positive') ? 'selected ="TRUE"' : ''; ?>value="Positive">Positive</option>
                                                                                    <option <?php echo ($value == 'Negative') ? 'selected ="TRUE"' : ''; ?>value="Negative">Negative</option>
                                                                                </select>

                                                                            </td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                }

                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'hbs_ab') {   ?>
                                                                        <tr>
                                                                            <td><b>HBsAb </b></td>
                                                                            <td><!--<input class="form-control" name="hep_b" value="<?php /*echo $value */?>">-->
                                                                                <select class="form-control" name="hbs_ab">
                                                                                    <option <?php echo ($value == 'Positive') ? 'selected ="TRUE"' : ''; ?>value="Positive">Positive</option>
                                                                                    <option <?php echo ($value == 'Negative') ? 'selected ="TRUE"' : ''; ?>value="Negative">Negative</option>
                                                                                </select>

                                                                            </td>
                                                                        </tr>
                                                                        <?php
                                                                    }
                                                                }

                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'hbe_ag') {   ?>
                                                                        <tr>
                                                                            <td><b>HBeAg </b></td>
                                                                            <td><!--<input class="form-control" name="hep_b" value="<?php /*echo $value */?>">-->
                                                                                <select class="form-control" name="hbe_ag">
                                                                                    <option <?php echo ($value == 'Positive') ? 'selected ="TRUE"' : ''; ?>value="Positive">Positive</option>
                                                                                    <option <?php echo ($value == 'Negative') ? 'selected ="TRUE"' : ''; ?>value="Negative">Negative</option>
                                                                                </select>

                                                                            </td>
                                                                        </tr>
                                                                        <?php
                                                                    }
                                                                }

                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'hbe_ab') {   ?>
                                                                        <tr>
                                                                            <td><b>HBeAb </b></td>
                                                                            <td><!--<input class="form-control" name="hep_b" value="<?php /*echo $value */?>">-->
                                                                                <select class="form-control" name="hbe_ab">
                                                                                    <option <?php echo ($value == 'Positive') ? 'selected ="TRUE"' : ''; ?>value="Positive">Positive</option>
                                                                                    <option <?php echo ($value == 'Negative') ? 'selected ="TRUE"' : ''; ?>value="Negative">Negative</option>
                                                                                </select>

                                                                            </td>
                                                                        </tr>
                                                                        <?php
                                                                    }
                                                                }

                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'hbc_ab') {   ?>
                                                                        <tr>
                                                                            <td><b> HBcAb(Total) </b></td>
                                                                            <td><!--<input class="form-control" name="hep_b" value="<?php /*echo $value */?>">-->
                                                                                <select class="form-control" name="hbc_ab">
                                                                                    <option <?php echo ($value == 'Positive') ? 'selected ="TRUE"' : ''; ?>value="Positive">Positive</option>
                                                                                    <option <?php echo ($value == 'Negative') ? 'selected ="TRUE"' : ''; ?>value="Negative">Negative</option>
                                                                                </select>

                                                                            </td>
                                                                        </tr>
                                                                        <?php
                                                                    }
                                                                }

                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'hbc_ab_igm') {   ?>
                                                                        <tr>
                                                                            <td><b> HBcAb(IgM) </b></td>
                                                                            <td><!--<input class="form-control" name="hep_b" value="<?php /*echo $value */?>">-->
                                                                                <select class="form-control" name="hbc_ab_igm">
                                                                                    <option <?php echo ($value == 'Positive') ? 'selected ="TRUE"' : ''; ?>value="Positive">Positive</option>
                                                                                    <option <?php echo ($value == 'Negative') ? 'selected ="TRUE"' : ''; ?>value="Negative">Negative</option>
                                                                                </select>

                                                                            </td>
                                                                        </tr>
                                                                        <?php
                                                                    }
                                                                }





                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'hiv') {   ?>
                                                                        <tr>
                                                                            <td><b>HIV Screening (I x II)</b></td>
                                                                            <td><input class="form-control" name="hiv" value="<?php echo $value ?>"></td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                }


                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'syplius') {   ?>
                                                                        <tr>
                                                                            <td><b>Syphilis Screening</b></td>
                                                                            <td><input class="form-control" name="syplius" value="<?php echo $value ?>"></td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                }

                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'type_crossmatch') {   ?>
                                                                        <tr>
                                                                            <td><b>Type of Cross Match Required</b></td>
                                                                            <td><input class="form-control" name="type_crossmatch" value="<?php echo $value ?>"></td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                }

                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'normal') {   ?>
                                                                        <tr>
                                                                            <td><b>Normal</b></td>
                                                                            <td><input class="form-control" name="normal" value="<?php echo $value ?>"></td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                }

                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'emergency') {   ?>
                                                                        <tr>
                                                                            <td><b>Emergency(15mins)</b></td>
                                                                            <td><input class="form-control" name="emergency" value="<?php echo $value ?>"></td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                }

                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'other') {   ?>
                                                                        <tr>
                                                                            <td><b>Others</b></td>
                                                                            <td><input class="form-control" name="other" value="<?php echo $value ?>"></td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                }


                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'rec_prev_tran') {   ?>
                                                                        <tr>
                                                                            <td><b>Record Of Previous Transfusion(Date and Time)</b></td>
                                                                            <td><input class="form-control" name="rec_prev_tran" value="<?php echo $value ?>"></td>
                                                                        </tr>
                                                            <?php
                                                                    }
                                                                }
                                                            } ?>

                                                        </table>

                                                    </table>

                                                </div>

                                            </div>

                                            <div class="row">

                                                <div class="col-md-6">
                                                    <h5>ABO/Rh</h5>
                                                    <dl class="dl-horizontal">

                                                        <?php
                                                        foreach ($decode as $key => $value) {

                                                            if (isset($key) and !empty($key)) {
                                                                if ($key == 'group_one') {   ?>
                                                                    <dt>Grp. </dt>
                                                                    <dd><input class="form-control" style="width: 70px;" value="<?php echo $value; ?>" name="group_one" /></dd>
                                                                <?php
                                                                }
                                                            }

                                                            if (isset($key) and !empty($key)) {
                                                                if ($key == 'group_two') {   ?>
                                                                    <dt>Grp. </dt>
                                                                    <dd><input class="form-control" style="width: 70px;" value="<?php echo $value; ?>" name="group_two" /></dd>
                                                                <?php
                                                                }
                                                            }

                                                            if (isset($key) and !empty($key)) {
                                                                if ($key == 'group_three') {   ?>
                                                                    <dt>Grp. </dt>
                                                                    <dd><input class="form-control" style="width: 70px;" value="<?php echo $value; ?>" name="group_three" /></dd>
                                                                <?php
                                                                }
                                                            }

                                                            if (isset($key) and !empty($key)) {
                                                                if ($key == 'group_four') {   ?>
                                                                    <dt>Grp. </dt>
                                                                    <dd><input class="form-control" style="width: 70px;" value="<?php echo $value; ?>" name="group_four" /></dd>
                                                        <?php
                                                                }
                                                            }
                                                        } ?>

                                                    </dl>
                                                </div>
                                                <div class="col-md-6">
                                                    <h5>Date/Time</h5>
                                                    <dl class="dl-horizontal">

                                                        <?php
                                                        foreach ($decode as $key => $value) {

                                                            if (isset($key) and !empty($key)) {
                                                                if ($key == 'rh_one') {   ?>
                                                                    <dt> </dt>
                                                                    <dd> <input class="form-control" style="width: 150px;" id="rh1" value="<?php echo $value; ?>" name="rh_one" /> </dd>
                                                                <?php
                                                                }
                                                            }

                                                            if (isset($key) and !empty($key)) {
                                                                if ($key == 'rh_two') {   ?>
                                                                    <dt> </dt>
                                                                    <dd> <input class="form-control" style="width: 150px;" id="rh2" value="<?php echo $value; ?>" name="rh_two" /> </dd>
                                                                <?php
                                                                }
                                                            }

                                                            if (isset($key) and !empty($key)) {
                                                                if ($key == 'rh_three') {   ?>
                                                                    <dt> </dt>
                                                                    <dd> <input class="form-control" style="width: 150px;" id="rh3" value="<?php echo $value; ?>" name="rh_three" /> </dd>
                                                                <?php
                                                                }
                                                            }

                                                            if (isset($key) and !empty($key)) {
                                                                if ($key == 'rh_four') {   ?>
                                                                    <dt> </dt>
                                                                    <dd> <input class="form-control" style="width: 150px;" id="rh4" value="<?php echo $value; ?>" name="rh_four" /> </dd>
                                                        <?php
                                                                }
                                                            }
                                                        } ?>

                                                    </dl>
                                                </div>

                                            </div>

                                            <div class="row">

                                                <div class="col-md-10">

                                                    <?php
                                                    foreach ($decode as $key => $value) {

                                                        if (isset($key) and !empty($key)) {
                                                            if ($key == 'rep_ser_inv') {   ?>
                                                                <div class="form-group">
                                                                    <label for="quantity" class="control-label col-md-4"> REPORT OF SEROLOGICAL INVESTIGATION:</label>
                                                                    <div class="col-md-8" style="width: 500px">
                                                                        <textarea class="form-control" name="rep_ser_inv"> <?php echo $value ?> </textarea>
                                                                    </div>
                                                                </div>
                                                    <?php
                                                            }
                                                        }
                                                    } ?>




                                                </div>
                                                <div class="col-md-2"></div>

                                            </div>

                                            <p class="margin-top-30">
                                                <!--
                                            <button type="submit" class="btn btn-lg btn-primary">Save Only</button> &nbsp;&nbsp;
                                            <button type="submit" name="save_and_send" class="btn btn-lg btn-success">Save And Send</button>
                                            -->
                                                <button type="submit" name="prelim_save" class="btn btn-lg btn-primary"> Preliminary Save</button> &nbsp;&nbsp;
                                                <button type="submit" name="final_save" class="btn btn-lg btn-success">Final Save</button>
                                            </p>

                                        </div>

                                    <?php
                                    } else {
                                    ?>

                                        <div class="card-body">

                                            <div class="row">

                                                <div class="col-md-12 col-sm-12 col-lg-12">

                                                    <table>


                                                        <table class="table table-bordered">

                                                            <tr>
                                                                <td><b>Number of Unit of Whole Blood Required</b></td>
                                                                <td><input class="form-control" name="no_whole_blood" value="<?php echo $no_whole_blood; ?>" type="text"></td>
                                                            </tr>

                                                            <tr>
                                                                <td><b>Number of Units of Red Cell Concentrate(packed red cells)</b></td>
                                                                <td><input class="form-control" name="no_red_cell" value="<?php echo $no_red_cell; ?>" type="text"></td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Other Blood Components(please state)</b></td>
                                                                <td><input class="form-control" name="other_blood" value="<?php echo $other_blood; ?>" type="text"></td>
                                                            </tr>

                                                            <tr>
                                                                <td><b>Exchange Blood Transfusion</b></td>
                                                                <td><input class="form-control" name="exchange" value="<?php echo $exchange; ?>" type="text"></td>
                                                            </tr>

                                                            <tr>
                                                                <td><b>ABO and Rh Grouping Only</b></td>
                                                                <td><input class="form-control" name="abo_rh" value="<?php echo $abo_rh; ?>" type="text"></td>
                                                            </tr>

                                                            <tr>
                                                                <td><b>Hepatitis 'C' Surface Ag Screening</b></td>
                                                                <td><input class="form-control" name="hep_c" value="<?php echo $hep_c; ?>" type="text">
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td><b>Direct Coombs' Test</b></td>
                                                                <td><input class="form-control" name="coombs_test" value="<?php echo $coombs_test; ?>" type="text"></td>
                                                            </tr>

                                                            <tr>
                                                                <td><b>Indirect Coombs' Test</b></td>
                                                                <td><input class="form-control" name="ind_coombs_test" value="<?php echo $ind_coombs_test; ?>" type="text"></td>
                                                            </tr>

                                                            <tr>
                                                                <td><b>Other Antibody Screening</b></td>
                                                                <td><input class="form-control" name="anti_screening" value="<?php echo $anti_screening; ?>" type="text"></td>

                                                            </tr>

                                                            <tr>
                                                                <td><b>HBsAg <!--Screening--></b></td>
                                                                <td><select class="form-control" name="hep_b">
                                                                        <option value=""></option>
                                                                        <option value="Positive">Positive</option>
                                                                        <option value="Negative">Negative</option>
                                                                    </select>
                                                                    <!--<input class="form-control" name="hep_b" value="<?php /*echo $hep_b; */?>" type="text">-->
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td><b>HBsAb</b></td>
                                                                <td><select class="form-control" name="hbs_ab">
                                                                        <option value=""></option>
                                                                        <option value="Positive">Positive</option>
                                                                        <option value="Negative">Negative</option>
                                                                    </select>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td><b>HBeAg</b></td>
                                                                <td><select class="form-control" name="hbe_ag">
                                                                        <option value=""></option>
                                                                        <option value="Positive">Positive</option>
                                                                        <option value="Negative">Negative</option>
                                                                    </select>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td><b>HBeAb</b></td>
                                                                <td><select class="form-control" name="hbe_ab">
                                                                        <option value=""></option>
                                                                        <option value="Positive">Positive</option>
                                                                        <option value="Negative">Negative</option>
                                                                    </select>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td><b>HBcAb(Total)</b></td>
                                                                <td><select class="form-control" name="hbc_ab">
                                                                        <option value=""></option>
                                                                        <option value="Positive">Positive</option>
                                                                        <option value="Negative">Negative</option>
                                                                    </select>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td><b>HBcAb(IgM)</b></td>
                                                                <td><select class="form-control" name="hbc_ab_igm">
                                                                        <option value=""></option>
                                                                        <option value="Positive">Positive</option>
                                                                        <option value="Negative">Negative</option>
                                                                    </select>
                                                                </td>
                                                            </tr>



                                                            <tr>
                                                                <td><b>HIV Screening (I x II)</b></td>
                                                                <td><input class="form-control" name="hiv" value="<?php echo $hiv; ?>" type="text"></td>

                                                            </tr>

                                                            <tr>
                                                                <td><b>Syphilis Screening</b></td>
                                                                <td><input class="form-control" name="syplius" value="<?php echo $syplius; ?>" type="text"></td>

                                                            </tr>

                                                            <tr>
                                                                <td><b>Type of Cross Match Required</b></td>
                                                                <td><input class="form-control" name="type_crossmatch" value="<?php echo $type_crossmatch; ?>" type="text"></td>

                                                            </tr>

                                                            <tr>
                                                                <td><b>Normal</b></td>
                                                                <td><input class="form-control" name="normal" value="<?php echo $normal; ?>" type="text"></td>

                                                            </tr>

                                                            <tr>
                                                                <td><b>Emergency(15mins)</b></td>
                                                                <td><input class="form-control" name="emergency" value="<?php echo $emergency; ?>" type="text">
                                                                </td>

                                                            </tr>

                                                            <tr>
                                                                <td><b>Others</b></td>
                                                                <td><input class="form-control" name="other" value="<?php echo $other; ?>" type="text"></td>

                                                            </tr>

                                                            <tr>
                                                                <td><b>Record Of Previous Transfusion(Date and Time)</b></td>
                                                                <td><input class="form-control" name="rec_prev_tran" value="<?php echo $rec_prev_tran; ?>" type="text"></td>

                                                            </tr>

                                                        </table>

                                                    </table>

                                                </div>

                                            </div>

                                            <div class="row">

                                                <div class="col-md-6">
                                                    <h5>ABO/Rh</h5>
                                                    <dl class="dl-horizontal">

                                                        <dt>
                                                            Grp.
                                                        </dt>
                                                        <dd>
                                                            <input class="form-control" style="width: 70px;" value="<?php echo $group_one; ?>" name="group_one" />

                                                        </dd>
                                                        <dt>
                                                            Grp.
                                                        </dt>
                                                        <dd>
                                                            <input class="form-control" style="width: 70px;" value="<?php echo $group_two; ?>" name="group_two" />

                                                        </dd>
                                                        <dt>
                                                            Grp.
                                                        </dt>
                                                        <dd>
                                                            <input class="form-control" style="width: 70px;" value="<?php echo $group_three; ?>" name="group_three" />

                                                        </dd>

                                                        <dt>
                                                            Grp.
                                                        </dt>
                                                        <dd>
                                                            <input class="form-control" style="width: 70px;" value="<?php echo $group_four; ?>" name="group_four" />

                                                        </dd>

                                                    </dl>
                                                </div>
                                                <div class="col-md-6">
                                                    <h5>Date/Time</h5>
                                                    <dl class="dl-horizontal">

                                                        <dt>

                                                        </dt>
                                                        <dd>
                                                            <input class="form-control" style="width: 150px;" id="rh1" value="<?php echo $rh_one; ?>" name="rh_one" />


                                                        </dd>
                                                        <dt>

                                                        </dt>
                                                        <dd>
                                                            <input class="form-control" style="width: 150px;" id="rh2" value="<?php echo $rh_two; ?>" name="rh_two" />


                                                        </dd>
                                                        <dt>

                                                        </dt>
                                                        <dd>
                                                            <input class="form-control" style="width: 150px;" id="rh3" value="<?php echo $rh_three; ?>" name="rh_three" />


                                                        </dd>

                                                        <dt>

                                                        </dt>
                                                        <dd>
                                                            <input class="form-control" style="width: 150px;" id="rh4" value="<?php echo $rh_four; ?>" name="rh_four" />


                                                        </dd>

                                                    </dl>
                                                </div>

                                            </div>

                                            <div class="row">

                                                <div class="col-md-10">


                                                    <div class="form-group">
                                                        <label for="quantity" class="control-label col-md-4"> REPORT OF SEROLOGICAL INVESTIGATION:</label>
                                                        <div class="col-md-8" style="width: 500px">
                                                            <textarea class="form-control" name="rep_ser_inv">  </textarea>


                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-md-2"></div>

                                            </div>

                                            <p class="margin-top-30">
                                                <!--
                                            <button type="submit" class="btn btn-lg btn-primary">Save Only</button> &nbsp;&nbsp;
                                            <button type="submit" name="save_and_send" class="btn btn-lg btn-success">Save And Send</button>
                                            -->
                                                <button type="submit" name="prelim_save" class="btn btn-lg btn-primary"> Preliminary Save</button> &nbsp;&nbsp;
                                                <button type="submit" name="final_save" class="btn btn-lg btn-success">Final Save</button>
                                            </p>

                                        </div>

                                    <?php }  ?>




                                </div>



                            </form>









                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>











<?php

require('../layout/footer.php');
