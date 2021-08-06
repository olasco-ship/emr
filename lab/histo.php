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



    $histo                       = new stdClass();
    $histo->Processing           = $_POST['Processing'];
    $histo->Microtomy            = $_POST['Microtomy'];
    $histo->HE                   = $_POST['H&E'];
    $histo->SpecialStain         = $_POST['SpecialStain'];
    $histo->CytoStaining         = $_POST['CytoStaining'];
    $histo->CytoProcessing       = $_POST['CytoProcessing'];
    $histo->FrozenSection        = $_POST['FrozenSection'];
    $histo->ER                   = $_POST['ER'];
    $histo->PR                   = $_POST['PR'];
    $histo->HER                  = $_POST['HER-2'];
    $histo->BreastOthers         = $_POST['breast_others'];
    $histo->CD3                  = $_POST['CD3'];
    $histo->CD20                 = $_POST['CD20'];
    $histo->CD15                 = $_POST['CD15'];
    $histo->CD10                 = $_POST['CD10'];
    $histo->CD45                 = $_POST['CD45'];
    $histo->CD117                = $_POST['CD117'];
    $histo->Ki67                 = $_POST['Ki67'];
    $histo->lymph_others         = $_POST['lymph_others'];
    $histo->WTI                  = $_POST['WTI'];
    $histo->EMA                  = $_POST['EMA'];
    $histo->CEA                  = $_POST['CEA'];
    $histo->soft_others          = $_POST['soft_others'];
    $histo->C3C                  = $_POST['C3C'];
    $histo->IgA                  = $_POST['IgA'];
    $histo->IgG                  = $_POST['IgG'];
    $histo->IgM                  = $_POST['IgM'];
    $histo->fluo_others          = $_POST['fluo_others'];
    $histo->Decalafication       = $_POST['Decalafication'];
    $histo->Cassettes            = $_POST['Cassettes'];
    $histo->macroscopy_note      = $_POST['macroscopy_note'];

    $json = json_encode($histo);
    // echo $json; exit;
    $result->sync           = "off";
    $result->lab_no         = $_POST['lab_no'];
    $result->scientist_note = $_POST['macroscopy_note'];
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
                            <h6 style="text-align: center">HISTOLOGY FORM</h6>


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
                                        Histology
                                    </div>

                                    <div class="card-body">

                                        <?php
                                        $result->resultData;
                                        $decode = json_decode($result->resultData);

                                        if (isset($result->resultData) and !empty($result->resultData)) {
                                            //  foreach ($decode as $key => $value) {
                                        ?>

                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="form-group">
                                                        <label>HISTOPATHOLOGY</label>
                                                        <br />
                                                        <?php foreach ($decode as $key => $value) {
                                                            if ($key == 'Processing') {
                                                        ?>
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="Processing" value="Processing" <?= ($value == "Processing") ? "checked='checked'" : "" ?>>
                                                                    <span>Processing</span>
                                                                </label>
                                                        <?php  }
                                                        }
                                                        ?>
                                                        <br />

                                                        <?php foreach ($decode as $key => $value) {
                                                            if ($key == 'Microtomy') {
                                                        ?>
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="Microtomy" value="Microtomy" <?= ($value == "Microtomy") ? "checked='checked'" : "" ?>>
                                                                    <span>Microtomy</span>
                                                                </label>
                                                        <?php  }
                                                        }
                                                        ?>
                                                        <br />

                                                        <?php foreach ($decode as $key => $value) {
                                                            if ($key == 'HE') {
                                                        ?>
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="H&E" value="H&E" <?= ($value == "H&E") ? "checked='checked'" : "" ?>>
                                                                    <span>H & E</span>
                                                                </label>
                                                        <?php  }
                                                        }
                                                        ?>
                                                        <br />

                                                        <?php foreach ($decode as $key => $value) {
                                                            if ($key == 'SpecialStain') {
                                                        ?>
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="SpecialStain" value="SpecialStain" <?= ($value == "SpecialStain") ? "checked='checked'" : "" ?>>
                                                                    <span>Special Stain</span>
                                                                </label>
                                                        <?php  }
                                                        }
                                                        ?>
                                                        <br />

                                                        <p id="error-checkbox"></p>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>CYTOPATHOLOGY</label>
                                                        <br />
                                                        <?php foreach ($decode as $key => $value) {
                                                            if ($key == 'CytoProcessing') {
                                                        ?>
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="CytoProcessing" value="CytoProcessing" <?= ($value == "CytoProcessing") ? "checked='checked'" : "" ?>>
                                                                    <span> Processing </span>
                                                                </label>
                                                        <?php  }
                                                        }
                                                        ?> <br />

                                                        <?php foreach ($decode as $key => $value) {
                                                            if ($key == 'CytoStaining') {
                                                        ?>
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="CytoStaining" value="CytoStaining" <?= ($value == "CytoStaining") ? "checked='checked'" : "" ?>>
                                                                    <span> Staining </span>
                                                                </label>
                                                        <?php  }
                                                        }
                                                        ?> <br />

                                                        <p id="error-checkbox"></p>
                                                    </div>

                                                    <div class="form-group">

                                                        <?php foreach ($decode as $key => $value) {
                                                            if ($key == 'FrozenSection') {
                                                        ?>
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="FrozenSection" value="FrozenSection" <?= ($value == "FrozenSection") ? "checked='checked'" : "" ?>>
                                                                    <span>FROZEN SECTION</span>
                                                                </label>
                                                        <?php  }
                                                        }
                                                        ?> <br />

                                                        <p id="error-checkbox"></p>
                                                    </div>


                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>IMMUNOHISTOCHEMISTRY</label>
                                                                <br /> <br />
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="Breast Panel" value="Breast Panel">
                                                                    <!--  <span>Breast Panel</span> -->
                                                                    <label><b> Breast Panel </b></label>
                                                                </label>

                                                                <br />

                                                                <?php foreach ($decode as $key => $value) {
                                                                    if ($key == 'ER') {
                                                                ?>
                                                                        <label class="fancy-checkbox">
                                                                            <input type="checkbox" name="ER" value="ER" <?= ($value == "ER") ? "checked='checked'" : "" ?>>
                                                                            <span>ER</span>
                                                                        </label>
                                                                <?php  }
                                                                }
                                                                ?>
                                                                <br />

                                                                <?php foreach ($decode as $key => $value) {
                                                                    if ($key == 'PR') {
                                                                ?>
                                                                        <label class="fancy-checkbox">
                                                                            <input type="checkbox" name="PR" value="PR" <?= ($value == "PR") ? "checked='checked'" : "" ?>>
                                                                            <span>PR</span>
                                                                        </label>
                                                                <?php  }
                                                                }
                                                                ?>
                                                                <br />

                                                                <?php foreach ($decode as $key => $value) {
                                                                    if ($key == 'HER') {
                                                                ?>
                                                                        <label class="fancy-checkbox">
                                                                            <input type="checkbox" name="HER-2" value="HER-2" <?= ($value == "HER-2") ? "checked='checked'" : "" ?>>
                                                                            <span>HER-2</span>
                                                                        </label>
                                                                <?php  }
                                                                }
                                                                ?>
                                                                <br />

                                                                <?php foreach ($decode as $key => $value) {
                                                                    if ($key == 'BreastOthers') {
                                                                ?>
                                                                        <label class="fancy-checkbox">
                                                                            <input type="checkbox" name="breast_others" value="breast_others" <?= ($value == "breast_others") ? "checked='checked'" : "" ?>>
                                                                            <span>Others</span>
                                                                        </label>
                                                                <?php  }
                                                                }
                                                                ?>
                                                                <br />


                                                                <p id="error-checkbox"></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">

                                                                <br /><br />
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="Lymphoma" value="Lymphoma">
                                                                    <label><b> Lymphoma </b></label>
                                                                </label>

                                                                <?php foreach ($decode as $key => $value) {
                                                                    if ($key == 'CD3') {
                                                                ?>
                                                                        <label class="fancy-checkbox">
                                                                            <input type="checkbox" name="CD3" value="CD3" <?= ($value == "CD3") ? "checked='checked'" : "" ?>>
                                                                            <span>CD3</span>
                                                                        </label>
                                                                <?php  }
                                                                }
                                                                ?><br />

                                                                <?php foreach ($decode as $key => $value) {
                                                                    if ($key == 'CD20') {
                                                                ?>
                                                                        <label class="fancy-checkbox">
                                                                            <input type="checkbox" name="CD20" value="CD20" <?= ($value == "CD20") ? "checked='checked'" : "" ?>>
                                                                            <span>CD20</span>
                                                                        </label>
                                                                <?php  }
                                                                }
                                                                ?><br />

                                                                <?php foreach ($decode as $key => $value) {
                                                                    if ($key == 'CD15') {
                                                                ?>
                                                                        <label class="fancy-checkbox">
                                                                            <input type="checkbox" name="CD15" value="CD15" <?= ($value == "CD15") ? "checked='checked'" : "" ?>>
                                                                            <span>CD15</span>
                                                                        </label>
                                                                <?php  }
                                                                }
                                                                ?><br />

                                                                <?php foreach ($decode as $key => $value) {
                                                                    if ($key == 'CD10') {
                                                                ?>
                                                                        <label class="fancy-checkbox">
                                                                            <input type="checkbox" name="CD10" value="CD10" <?= ($value == "CD10") ? "checked='checked'" : "" ?>>
                                                                            <span>CD10</span>
                                                                        </label>
                                                                <?php  }
                                                                }
                                                                ?><br />

                                                                <?php foreach ($decode as $key => $value) {
                                                                    if ($key == 'CD45') {
                                                                ?>
                                                                        <label class="fancy-checkbox">
                                                                            <input type="checkbox" name="CD45" value="CD45" <?= ($value == "CD45") ? "checked='checked'" : "" ?>>
                                                                            <span>CD45</span>
                                                                        </label>
                                                                <?php  }
                                                                }
                                                                ?><br />

                                                                <?php foreach ($decode as $key => $value) {
                                                                    if ($key == 'CD117') {
                                                                ?>
                                                                        <label class="fancy-checkbox">
                                                                            <input type="checkbox" name="CD117" value="CD117" <?= ($value == "CD117") ? "checked='checked'" : "" ?>>
                                                                            <span>CD117</span>
                                                                        </label>
                                                                <?php  }
                                                                }
                                                                ?><br />

                                                                <?php foreach ($decode as $key => $value) {
                                                                    if ($key == 'Ki67') {
                                                                ?>
                                                                        <label class="fancy-checkbox">
                                                                            <input type="checkbox" name="Ki67" value="Ki67" <?= ($value == "Ki67") ? "checked='checked'" : "" ?>>
                                                                            <span>Ki67</span>
                                                                        </label>
                                                                <?php  }
                                                                }
                                                                ?><br />

                                                                <?php foreach ($decode as $key => $value) {
                                                                    if ($key == 'lymph_others') {
                                                                ?>
                                                                        <label class="fancy-checkbox">
                                                                            <input type="checkbox" name="lymph_others" value="lymph_others" <?= ($value == "lymph_others") ? "checked='checked'" : "" ?>>
                                                                            <span>Others</span>
                                                                        </label>
                                                                <?php  }
                                                                }
                                                                ?><br />

                                                                <p id="error-checkbox"></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">

                                                                <br /><br />
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="Soft Tissue" value="Soft Tissue">
                                                                    <!--  <span>Soft Tissue</span> -->
                                                                    <label><b> Soft Tissue </b></label>
                                                                </label> <br />

                                                                <?php foreach ($decode as $key => $value) {
                                                                    if ($key == 'WTI') {
                                                                ?>
                                                                        <label class="fancy-checkbox">
                                                                            <input type="checkbox" name="WTI" value="WTI" <?= ($value == "WTI") ? "checked='checked'" : "" ?>>
                                                                            <span>WTI</span>
                                                                        </label>
                                                                <?php  }
                                                                }
                                                                ?><br />

                                                                <?php foreach ($decode as $key => $value) {
                                                                    if ($key == 'EMA') {
                                                                ?>
                                                                        <label class="fancy-checkbox">
                                                                            <input type="checkbox" name="EMA" value="EMA" <?= ($value == "EMA") ? "checked='checked'" : "" ?>>
                                                                            <span>EMA</span>
                                                                        </label>
                                                                <?php  }
                                                                }
                                                                ?><br />

                                                                <?php foreach ($decode as $key => $value) {
                                                                    if ($key == 'CEA') {
                                                                ?>
                                                                        <label class="fancy-checkbox">
                                                                            <input type="checkbox" name="CEA" value="CEA" <?= ($value == "CEA") ? "checked='checked'" : "" ?>>
                                                                            <span>CEA</span>
                                                                        </label>
                                                                <?php  }
                                                                }
                                                                ?><br />

                                                                <?php foreach ($decode as $key => $value) {
                                                                    if ($key == 'soft_others') {
                                                                ?>
                                                                        <label class="fancy-checkbox">
                                                                            <input type="checkbox" name="soft_others" value="soft_others" <?= ($value == "soft_others") ? "checked='checked'" : "" ?>>
                                                                            <span>Others</span>
                                                                        </label>
                                                                <?php  }
                                                                }
                                                                ?><br />

                                                                <p id="error-checkbox"></p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>IMMUNOFLOURESCENCE</label>
                                                                <br /> <br />

                                                                <?php foreach ($decode as $key => $value) {
                                                                    if ($key == 'C3C') {
                                                                ?>
                                                                        <label class="fancy-checkbox">
                                                                            <input type="checkbox" name="C3C" value="C3C" <?= ($value == "C3C") ? "checked='checked'" : "" ?>>
                                                                            <span>C3C</span>
                                                                        </label>
                                                                <?php  }
                                                                }
                                                                ?><br />

                                                                <?php foreach ($decode as $key => $value) {
                                                                    if ($key == 'IgA') {
                                                                ?>
                                                                        <label class="fancy-checkbox">
                                                                            <input type="checkbox" name="IgA" value="IgA" <?= ($value == "IgA") ? "checked='checked'" : "" ?>>
                                                                            <span>IgA</span>
                                                                        </label>
                                                                <?php  }
                                                                }
                                                                ?><br />

                                                                <?php foreach ($decode as $key => $value) {
                                                                    if ($key == 'IgG') {
                                                                ?>
                                                                        <label class="fancy-checkbox">
                                                                            <input type="checkbox" name="IgG" value="IgG" <?= ($value == "IgG") ? "checked='checked'" : "" ?>>
                                                                            <span>IgG</span>
                                                                        </label>
                                                                <?php  }
                                                                }
                                                                ?><br />

                                                                <?php foreach ($decode as $key => $value) {
                                                                    if ($key == 'IgM') {
                                                                ?>
                                                                        <label class="fancy-checkbox">
                                                                            <input type="checkbox" name="IgM" value="IgM" <?= ($value == "IgM") ? "checked='checked'" : "" ?>>
                                                                            <span>IgM</span>
                                                                        </label>
                                                                <?php  }
                                                                }
                                                                ?><br />

                                                                <?php foreach ($decode as $key => $value) {
                                                                    if ($key == 'fluo_others') {
                                                                ?>
                                                                        <label class="fancy-checkbox">
                                                                            <input type="checkbox" name="fluo_others" value="fluo_others" <?= ($value == "fluo_others") ? "checked='checked'" : "" ?>>
                                                                            <span>Others</span>
                                                                        </label>
                                                                <?php  }
                                                                }
                                                                ?><br />

                                                                <p id="error-checkbox"></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">

                                                        </div>
                                                        <div class="col-md-4">

                                                        </div>
                                                    </div>



                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label> CUT-UP </label>
                                                        <br />
                                                        <?php foreach ($decode as $key => $value) {
                                                            if ($key == 'Decalafication') {
                                                        ?>
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="Decalafication" value="Decalafication" <?= ($value == "Decalafication") ? "checked='checked'" : "" ?>>
                                                                    <span>For Decalafication</span>
                                                                </label>
                                                        <?php  }
                                                        }
                                                        ?><br />

                                                        <?php foreach ($decode as $key => $value) {
                                                            if ($key == 'Cassettes') {
                                                        ?>
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="Cassettes" value="Cassettes" <?= ($value == "Cassettes") ? "checked='checked'" : "" ?>>
                                                                    <span>No Of Cassettes</span>
                                                                </label>
                                                        <?php  }
                                                        }
                                                        ?><br />


                                                    </div>

                                                    <?php foreach ($decode as $key => $value) {
                                                        if ($key == 'macroscopy_note') {
                                                    ?>
                                                    <div class="form-group">
                                                        <b>MACROSCOPY </b>
                                                        <textarea rows="35" cols="50" class="form-control" name="macroscopy_note">
                                                                    <?php echo $value; ?>
                                                                </textarea>
                                                    </div>
                                                            
                                                    <?php  }
                                                    }
                                                    ?>

                                                    
                                                    <p class="margin-top-30">
                                                        <button type="submit" name="prelim_save" class="btn btn-lg btn-primary">Save Result</button> &nbsp;&nbsp;
                                                        <!--  <button type="submit" name="save_only" class="btn btn-lg btn-success">Save And Send</button>  -->
                                                    </p>
                                                </div>
                                            </div>


                                        <?php
                                        } else {
                                        ?>


                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="form-group">
                                                        <label>HISTOPATHOLOGY</label>
                                                        <br />
                                                        <label class="fancy-checkbox">
                                                            <input type="checkbox" name="Processing" value="Processing">
                                                            <span>Processing</span>
                                                        </label> <br />
                                                        <label class="fancy-checkbox">
                                                            <input type="checkbox" name="Microtomy" value="Microtomy">
                                                            <span>Microtomy</span>
                                                        </label> <br />
                                                        <label class="fancy-checkbox">
                                                            <input type="checkbox" name="H&E" value="H&E">
                                                            <span>H & E</span>
                                                        </label> <br />
                                                        <label class="fancy-checkbox">
                                                            <input type="checkbox" name="SpecialStain" value="SpecialStain">
                                                            <span>Special Stain</span>
                                                        </label> <br />
                                                        <p id="error-checkbox"></p>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>CYTOPATHOLOGY</label>
                                                        <br />
                                                        <label class="fancy-checkbox">
                                                            <input type="checkbox" name="CytoProcessing" value="CytoProcessing">
                                                            <span>Processing</span>
                                                        </label> <br />
                                                        <label class="fancy-checkbox">
                                                            <input type="checkbox" name="CytoStaining" value="CytoStaining">
                                                            <span>Staining</span>
                                                        </label> <br />
                                                        <p id="error-checkbox"></p>
                                                    </div>

                                                    <div class="form-group">

                                                        <label class="fancy-checkbox">
                                                            <input type="checkbox" name="FrozenSection" value="FrozenSection">
                                                            <!--   <span>Processing</span>--> <span>FROZEN SECTION</span>
                                                        </label> <br />

                                                        <p id="error-checkbox"></p>
                                                    </div>


                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>IMMUNOHISTOCHEMISTRY</label>
                                                                <br /> <br />
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="Breast Panel" value="Breast Panel">
                                                                    <!--  <span>Breast Panel</span> -->
                                                                    <label><b> Breast Panel </b></label>
                                                                </label> <br />
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="ER" value="ER">
                                                                    <span>ER</span>
                                                                </label> <br />
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="PR" value="PR">
                                                                    <span>PR</span>
                                                                </label> <br />
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="HER-2" value="HER-2">
                                                                    <span>HER-2</span>
                                                                </label> <br />
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="breast_others" value="breast_others">
                                                                    <span>Others</span>
                                                                </label>
                                                                <p id="error-checkbox"></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">

                                                                <br /><br />
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="Lymphoma" value="Lymphoma">
                                                                    <!-- <span>Lymphoma</span> -->
                                                                    <label><b> Lymphoma </b></label>
                                                                </label> <br />
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="CD3" value="CD3">
                                                                    <span>CD3</span>
                                                                </label> <br />
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="CD20" value="CD20">
                                                                    <span>CD20</span>
                                                                </label> <br />
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="CD15" value="CD15">
                                                                    <span>CD15</span>
                                                                </label> <br />
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="CD10" value="CD10">
                                                                    <span>CD10</span>
                                                                </label> <br />
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="CD45" value="CD45">
                                                                    <span>CD45</span>
                                                                </label> <br />
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="CD117" value="CD117">
                                                                    <span>CD117</span>
                                                                </label> <br />
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="Ki67" value="Ki67">
                                                                    <span>Ki67</span>
                                                                </label> <br />
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="lymph_others" value="lymph_others">
                                                                    <span>Others</span>
                                                                </label>
                                                                <p id="error-checkbox"></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">

                                                                <br /><br />
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="Soft Tissue" value="Soft Tissue">
                                                                    <!--  <span>Soft Tissue</span> -->
                                                                    <label><b> Soft Tissue </b></label>
                                                                </label> <br />
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="WTI" value="WTI">
                                                                    <span>WTI</span>
                                                                </label> <br />
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="EMA" value="EMA">
                                                                    <span>EMA</span>
                                                                </label> <br />
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="CEA" value="CEA">
                                                                    <span>CEA</span>
                                                                </label> <br />
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="soft_others" value="soft_others">
                                                                    <span>Others</span>
                                                                </label>
                                                                <p id="error-checkbox"></p>
                                                            </div>
                                                        </div>
                                                    </div>




                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>IMMUNOFLOURESCENCE</label>
                                                                <br /> <br />
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="C3C" value="C3C">
                                                                    <span>C3C</span>
                                                                </label> <br />
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="IgA" value="IgA">
                                                                    <span>IgA</span>
                                                                </label> <br />
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="IgG" value="IgG">
                                                                    <span>IgG</span>
                                                                </label> <br />
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="IgM" value="IgM">
                                                                    <span>IgM</span>
                                                                </label> <br />
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="fluo_others" value="fluo_others">
                                                                    <span>Others</span>
                                                                </label>
                                                                <p id="error-checkbox"></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">

                                                        </div>
                                                        <div class="col-md-4">

                                                        </div>
                                                    </div>



                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label> CUT-UP </label>
                                                        <br />
                                                        <label class="fancy-checkbox">
                                                            <input type="checkbox" name="Decalafication" value="Decalafication">
                                                            <span>For Decalafication</span>
                                                        </label> <br />
                                                        <label class="fancy-checkbox">
                                                            <input type="checkbox" name="Cassettes" value="Cassettes">
                                                            <span>No Of Cassettes</span>
                                                        </label>
                                                    </div>

                                                    <div class="form-group">
                                                        <b>MACROSCOPY </b>
                                                        <textarea rows="35" cols="50" class="form-control" name="macroscopy_note">
                                                                    <?php echo $macroscopy_note; ?>
                                                                </textarea>
                                                    </div>


                                                    <p class="margin-top-30">
                                                        <button type="submit" name="prelim_save" class="btn btn-lg btn-primary">Save Result</button> &nbsp;&nbsp;
                                                        <!--  <button type="submit" name="save_only" class="btn btn-lg btn-success">Save And Send</button>  -->
                                                    </p>
                                                </div>
                                            </div>


                                    </div>

                                </div>

                            </form>









                        </div>
                    </div>

                <?php }  ?>

                </div>
            </div>
        </div>
    </div>
</div>











<?php

require('../layout/footer.php');
