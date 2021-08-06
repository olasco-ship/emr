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


$pcv = $hb = $rbc = $rbe_count = $retics = $mchc = $mcv = $mch = $esr = $sickling_test = $hb_genotype = $prothrombin_time = $bone_marrow = $g6pd =
    $others = $retroviral_screen = $wbc = $differential = $myeloblast = $promyelocyte = $metamyelocyte = $band_forms = $lymphoblast = $normo = $bleeding_time =
    $neutophils = $lymphocytes = $monocytes = $eosinophlis = $basophils = $platelets = $blood_film =  $pt = $ptt = $aptt =  $hcv =  $rvs_screening = "";

$hbsagb = $hbsagc = $vdrl = $blood_group =  $clotting_time =  $malaria_parasite = $coombs_test = $ind_coombs_test =  $cd4 = "";




if (is_post()) {

    /*
        $hb             = $_POST['hb'];
        $pcv            = $_POST['pcv'];
        $rbc            = $_POST['rbc'];
        $mcv            = $_POST['mcv'];
        $mch            = $_POST['mch'];
        $mchc           = $_POST['mchc'];
        $wbc            = $_POST['wbc'];
        $platelets      = $_POST['platelets'];
        $retics         = $_POST['retics'];
        $esr            = $_POST['esr'];
        $neutophils     = $_POST['neutophils'];
        $lymphocytes    = $_POST['lymphocytes'];
        $monocytes      = $_POST['monocytes'];
        $eosinophlis    = $_POST['eosinophlis'];
        $basophils      = $_POST['basophils'];
        $normo          = $_POST['normo'];
        $bleeding_time  = $_POST['bleeding_time'];
        $clotting_time  = $_POST['clotting_time'];
        $hbsagb         = $_POST['hbsagb'];
        $hcv            = $_POST['hcv'];
        $rvs_screening  = $_POST['rvs_screening'];
        $vdrl           = $_POST['vdrl'];
        $malaria_parasite= $_POST['malaria_parasite'];
        $others         = $_POST['others'];
        $pt             = $_POST['pt'];
        $ptt            = $_POST['ptt'];
        $aptt           = $_POST['aptt'];
        $coombs_test    = $_POST['coombs_test'];
        $cd4            = $_POST['cd4'];
        $blood_group    = $_POST['blood_group'];
        $hb_genotype    = $_POST['hb_genotype'];
        $bone_marrow    = $_POST['bone_marrow'];
        $notes          = $_POST['notes'];

    */

    $foo               = new StdClass();
    $foo->Hb           = $_POST['hb'];
    $foo->PCV          = $_POST['pcv'];
    $foo->RBC          = $_POST['rbc'];
    $foo->MCV          = $_POST['mcv'];
    $foo->MCH          = $_POST['mch'];
    $foo->MCHC         = $_POST['mchc'];
    $foo->WBC          = $_POST['wbc'];
    $foo->Platelets    = $_POST['platelets'];
    $foo->Retics       = $_POST['retics'];
    $foo->ESR          = $_POST['esr'];
    $foo->NEUT         = $_POST['neutophils'];
    $foo->LYMPH        = $_POST['lymphocytes'];
    $foo->MONO         = $_POST['monocytes'];
    $foo->Eosino       = $_POST['eosinophlis'];
    $foo->BASO         = $_POST['basophils'];
    $foo->Normo        = $_POST['normo'];
    $foo->BleedingTime = $_POST['bleeding_time'];
    $foo->ClottingTime = $_POST['clotting_time'];
    $foo->PT           = $_POST['pt'];
    $foo->PTT          = $_POST['ptt'];
    $foo->APTT         = $_POST['aptt'];
    $foo->HBsAg        = $_POST['hbsagb'];
    $foo->HCV          = $_POST['hcv'];
    $foo->RvsScreening = $_POST['rvs_screening'];
    $foo->VDRL         = $_POST['vdrl'];
    $foo->MP           = $_POST['malaria_parasite'];
    $foo->Others       = $_POST['others'];
    $foo->CoombsTest   = $_POST['coombs_test'];
    $foo->IndCoombsTest   = $_POST['ind_coombs_test'];
    $foo->CD4          = $_POST['cd4'];
    $foo->BloodGroup   = $_POST['blood_group'];
    $foo->HbGenotype   = $_POST['hb_genotype'];
    $foo->G6PD         = $_POST['g6pd'];
    $foo->BoneMarrow   = $_POST['bone_marrow'];
    $foo->Notes        = $_POST['notes'];

    $json = json_encode($foo);
    // echo $json; exit;

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
   // $result->save();
   // $session->message("Result has been saved.");
    // print_r($result); exit;



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
                            <h6 style="text-align: center">HAEMATOLOGY FORM</h6>


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
                                                        <th>Condition of specimen</th>
                                                        <td> <?php echo $result->specimen_condition
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

                                        Haematology

                                    </div>

                                    <div class="card-body">

                                        <div class="row">

                                            <div class="col-md-7">




                                                <div class="table-responsive">


                                                    <table class="table table-bordered">


                                                        <tr>
                                                            <td></td>
                                                            <td style="text-align: center"><b>UNIT</b></td>
                                                            <td style="text-align: center"><b>RESULT</b></td>
                                                            <td style="text-align: center"><b>NORMAL</b></td>
                                                        </tr>

                                                        <?php

                                                        $result->resultData;
                                                        $decode = json_decode($result->resultData);

                                                        if (isset($result->resultData) and !empty($result->resultData)) {

                                                            foreach ($decode as $key => $value) {

                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'Hb') {   ?>
                                                                        <tr>
                                                                            <td>Hb</td>
                                                                            <td>%</td>
                                                                            <td><input class="form-control" name="hb" value="<?php echo $value; ?>" type="text"></td>
                                                                            <td>40 - 54</td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                }


                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'PCV') {   ?>
                                                                        <tr>
                                                                            <td>PCV/HCT</td>
                                                                            <td>%</td>
                                                                            <td><input class="form-control" name="pcv" value="<?php echo $value; ?>" type="text"></td>
                                                                            <td>40 - 54</td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                }


                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'RBC') {   ?>
                                                                        <tr>
                                                                            <td>RBC</td>
                                                                            <td>x10^12/L</td>
                                                                            <td><input class="form-control" name="rbc" value="<?php echo $value; ?>" type="text"></td>
                                                                            <td>4.5 - 5.5</td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                }


                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'MCV') {   ?>
                                                                        <tr>
                                                                            <td>MCV</td>
                                                                            <td>fl</td>
                                                                            <td><input class="form-control" name="mcv" value="<?php echo $value; ?>" type="text"></td>
                                                                            <td>76 - 93</td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                }


                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'MCH') {   ?>
                                                                        <tr>
                                                                            <td>MCH</td>
                                                                            <td>pg</td>
                                                                            <td><input class="form-control" name="mch" value="<?php echo $value; ?>" type="text"></td>
                                                                            <td>27 - 31</td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                }



                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'MCHC') {   ?>
                                                                        <tr>
                                                                            <td>MCHC</td>
                                                                            <td>g/dl</td>
                                                                            <td><input class="form-control" name="mchc" value="<?php echo $value; ?>" type="text"></td>
                                                                            <td>31 - 35</td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                }


                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'WBC') {   ?>
                                                                        <tr>
                                                                            <td>WBC</td>
                                                                            <td>x10^9/L</td>
                                                                            <td><input class="form-control" name="wbc" value="<?php echo $value; ?>" type="text"></td>
                                                                            <td>4.8 - 10.8</td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                }


                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'Platelets') {   ?>
                                                                        <tr>
                                                                            <td>PLATELETS</td>
                                                                            <td>x10^9/L</td>
                                                                            <td><input class="form-control" name="platelets" value="<?php echo $value; ?>" type="text"></td>
                                                                            <td>140 - 400</td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                }



                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'Retics') {   ?>
                                                                        <tr>
                                                                            <td>RETICS</td>
                                                                            <td>%</td>
                                                                            <td><input class="form-control" name="retics" value="<?php echo $value; ?>" type="text"></td>
                                                                            <td>0.2 - 2.0</td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                }


                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'ESR') {   ?>
                                                                        <tr>
                                                                            <td>WESTERGREN ESR</td>
                                                                            <td>mm/Hr</td>
                                                                            <td><input class="form-control" name="esr" value="<?php echo $value; ?>" type="text"></td>
                                                                            <td>5 - 7</td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                }


                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'NEUT') {   ?>
                                                                        <tr>
                                                                            <td>NEUT</td>
                                                                            <td>%</td>
                                                                            <td><input class="form-control" name="neutophils" value="<?php echo $value; ?>" type="text"></td>
                                                                            <td>40 - 75</td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                }

                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'LYMPH') {   ?>
                                                                        <tr>
                                                                            <td>LYMPH</td>
                                                                            <td>%</td>
                                                                            <td><input class="form-control" name="lymphocytes" value="<?php echo $value; ?>" type="text"></td>
                                                                            <td>20 - 45</td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                }

                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'MONO') {   ?>
                                                                        <tr>
                                                                            <td>MONO</td>
                                                                            <td>%</td>
                                                                            <td><input class="form-control" name="monocytes" value="<?php echo $value; ?>" type="text"></td>
                                                                            <td>2 - 10</td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                }

                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'Eosino') {   ?>
                                                                        <tr>
                                                                            <td>Eosino </td>
                                                                            <td>%</td>
                                                                            <td><input class="form-control" name="eosinophlis" value="<?php echo $value; ?>" type="text"></td>
                                                                            <td>1 - 6</td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                }

                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'BASO') {   ?>
                                                                        <tr>
                                                                            <td>BASO </td>
                                                                            <td>%</td>
                                                                            <td><input class="form-control" name="basophils" value="<?php echo $value; ?>" type="text"></td>
                                                                            <td></td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                }

                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'Normo') {   ?>
                                                                        <tr>
                                                                            <td colspan="2">Normo </td>
                                                                            <td><input class="form-control" name="normo" value="<?php echo $value; ?>" type="text"></td>
                                                                            <td>NIL</td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                }

                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'BleedingTime') {   ?>
                                                                        <tr>
                                                                            <td colspan="2">Bleeding Time </td>
                                                                            <td><input class="form-control" name="bleeding_time" value="<?php echo $value; ?>" type="text"></td>
                                                                            <td>(1-5)min</td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                }


                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'ClottingTime') {   ?>
                                                                        <tr>
                                                                            <td colspan="2">Clotting Time </td>
                                                                            <td><input class="form-control" name="clotting_time" value="<?php echo $value; ?>" type="text"></td>
                                                                            <td>(1-5)min</td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                }


                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'PT') {   ?>
                                                                        <tr>
                                                                            <td colspan="2">P.T. </td>
                                                                            <td colspan="2"><input class="form-control" name="pt" value="<?php echo $value; ?>" type="text"></td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                }


                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'PTT') {   ?>
                                                                        <tr>
                                                                            <td colspan="2">P.T.T. </td>
                                                                            <td colspan="2"><input class="form-control" name="ptt" value="<?php echo $value; ?>" type="text"></td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                }


                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'APTT') {   ?>
                                                                        <tr>
                                                                            <td colspan="2"> APTT </td>
                                                                            <td colspan="2"><input class="form-control" name="aptt" value="<?php echo $value; ?>" type="text"></td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                }

                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'HBsAg') {   ?>
                                                                        <tr>
                                                                            <td colspan="2"> HBsAg </td>
                                                                            <td><input class="form-control" name="hbsagb" value="<?php echo $value; ?>" type="text"></td>
                                                                            <td></td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                }

                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'HCV') {   ?>
                                                                        <tr>
                                                                            <td colspan="2"> HCV </td>
                                                                            <td><input class="form-control" name="hcv" value="<?php echo $value; ?>" type="text"></td>
                                                                            <td></td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                }


                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'RvsScreening') {   ?>
                                                                        <tr>
                                                                            <td colspan="2">RVS Screening </td>
                                                                            <td><input class="form-control" name="rvs_screening" value="<?php echo $value; ?>" type="text"></td>
                                                                            <td></td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                }


                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'VDRL') {   ?>
                                                                        <tr>
                                                                            <td colspan="2"> VDRL </td>
                                                                            <td><input class="form-control" name="vdrl" value="<?php echo $value; ?>" type="text"></td>
                                                                            <td></td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                }


                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'MP') {   ?>
                                                                        <tr>
                                                                            <td colspan="2">Malaria Parasite </td>
                                                                            <td><input class="form-control" name="malaria_parasite" value="<?php echo $value; ?>" type="text"></td>
                                                                            <td></td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                }

                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'Others') {   ?>
                                                                        <tr>
                                                                            <td colspan="2"> OTHERS </td>
                                                                            <td><input class="form-control" name="others" value="<?php echo $value; ?>" type="text"></td>
                                                                            <td></td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                }

                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'CoombsTest') {   ?>
                                                                        <tr>
                                                                            <td colspan="2">Direct Coombs' Test </td>
                                                                            <td colspan="2"><input class="form-control" name="coombs_test" value="<?php echo $value; ?>" type="text"></td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                }

                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'IndCoombsTest') {   ?>
                                                                        <tr>
                                                                            <td colspan="2">Indirect Coombs' Test </td>
                                                                            <td colspan="2"><input class="form-control" name="ind_coombs_test" value="<?php echo $value; ?>" type="text"></td>
                                                                        </tr>
                                                                        <?php
                                                                    }
                                                                }

                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'CD4') {   ?>
                                                                        <tr>
                                                                            <td colspan="2">CD 4 Lymphocyte Count </td>
                                                                            <td colspan="2"><input class="form-control" name="cd4" value="<?php echo $value; ?>" type="text"></td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                }


                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'BloodGroup') {   ?>
                                                                        <tr>
                                                                            <td colspan="2">Blood Group </td>
                                                                            <td colspan="2"><input class="form-control" name="blood_group" value="<?php echo $value; ?>" type="text"></td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                }


                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'HbGenotype') {   ?>
                                                                        <tr>
                                                                            <td colspan="2"> Hb Genotype </td>
                                                                            <td colspan="2"><input class="form-control" name="hb_genotype" value="<?php echo $value; ?>" type="text"></td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                }

                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'G6PD') {   ?>
                                                                        <tr>
                                                                            <td colspan="2"> G6PD </td>
                                                                            <td colspan="2"><input class="form-control" name="g6pd" value="<?php echo $value; ?>" type="text"></td>
                                                                        </tr>
                                                                        <?php
                                                                    }
                                                                }


                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'comment') {   ?>
                                                                        <tr>
                                                                            <td> Scientist Comment </td>
                                                                            <td colspan="3"><input class="form-control" name="comment" value="<?php echo $value; ?>" type="text"></td>
                                                                        </tr>
                                                            <?php
                                                                    }
                                                                }

                                                                /*
                                                                            if (isset($key) and !empty($key)) { 
                                                                                if ($key == 'Notes') {   ?>
                                                                                    <tr>
                                                                                        <td > Scientist's Note        </td>
                                                                                        <td colspan="3"><input class="form-control" name="notes" value="<?php echo $value; ?>" type="text"></td>
                                                                                    </tr>
                                                                                <?php
                                                                                }                             
                                                                            }
                                                                            */
                                                            }
                                                        } else {  ?>

                                                            <tr>
                                                                <td>Hb</td>
                                                                <td>g/dl</td>
                                                                <td><input class="form-control" name="hb" value="<?php echo $hb; ?>" type="text"></td>
                                                                <td>13 - 18</td>

                                                            </tr>

                                                            <tr>
                                                                <td>PCV/HCT</td>
                                                                <td>%</td>
                                                                <td><input class="form-control" name="pcv" value="<?php echo $pcv; ?>" type="text"></td>
                                                                <td>40 - 54</td>
                                                            </tr>

                                                            <tr>
                                                                <td>RBC</td>
                                                                <td>x10^12/L</td>
                                                                <td><input class="form-control" name="rbc" value="<?php echo $rbc; ?>" type="text"></td>
                                                                <td>4.5 - 5.5</td>
                                                            </tr>

                                                            <tr>
                                                                <td>MCV</td>
                                                                <td>fl</td>
                                                                <td><input class="form-control" name="mcv" value="<?php echo $mcv; ?>" type="text"></td>
                                                                <td>76 - 93</td>
                                                            </tr>

                                                            <tr>
                                                                <td>MCH</td>
                                                                <td>pg</td>
                                                                <td><input class="form-control" name="mch" value="<?php echo $mch; ?>" type="text"></td>
                                                                <td>27 - 31</td>
                                                            </tr>

                                                            <tr>
                                                                <td>MCHC</td>
                                                                <td>g/dl</td>
                                                                <td><input class="form-control" name="mchc" value="<?php echo $mchc; ?>" type="text"></td>
                                                                <td>31 - 35</td>
                                                            </tr>

                                                            <tr>

                                                            <tr>
                                                                <td>WBC</td>
                                                                <td>x10^9/L</td>
                                                                <td><input class="form-control" name="wbc" value="<?php echo $wbc; ?>" type="text"></td>
                                                                <td>4.8 - 10.8</td>
                                                            </tr>

                                                            <tr>
                                                                <td>PLATELETS</td>
                                                                <td>x10^9/L</td>
                                                                <td><input class="form-control" name="platelets" value="<?php echo $platelets; ?>" type="text"></td>
                                                                <td>140 - 400</td>
                                                            </tr>


                                                            <tr>
                                                                <td>RETICS</td>
                                                                <td>%</td>
                                                                <td><input class="form-control" name="retics" value="<?php echo $retics; ?>" type="text"></td>
                                                                <td>0.2 - 2.0</td>
                                                            </tr>

                                                            <tr>
                                                                <td>WESTERGREN ESR</td>
                                                                <td>mm/Hr</td>
                                                                <td><input class="form-control" name="esr" value="<?php echo $esr; ?>" type="text"></td>
                                                                <td>5 - 7</td>
                                                            </tr>

                                                            <tr>
                                                                <td>NEUT</td>
                                                                <td>%</td>
                                                                <td><input class="form-control" name="neutophils" value="<?php echo $neutophils; ?>" type="text"></td>
                                                                <td>40 - 75</td>
                                                            </tr>

                                                            <tr>
                                                                <td>LYMPH</td>
                                                                <td>%</td>
                                                                <td><input class="form-control" name="lymphocytes" value="<?php echo $lymphocytes; ?>" type="text"></td>
                                                                <td>20 - 45</td>
                                                            </tr>

                                                            <tr>
                                                                <td>MONO</td>
                                                                <td>%</td>
                                                                <td><input class="form-control" name="monocytes" value="<?php echo $monocytes; ?>" type="text"></td>
                                                                <td>2 - 10</td>
                                                            </tr>

                                                            <tr>
                                                                <td>Eosino </td>
                                                                <td>%</td>
                                                                <td><input class="form-control" name="eosinophlis" value="<?php echo $eosinophlis; ?>" type="text"></td>
                                                                <td>1 - 6</td>
                                                            </tr>

                                                            <tr>
                                                                <td>BASO </td>
                                                                <td>%</td>
                                                                <td><input class="form-control" name="basophils" value="<?php echo $basophils; ?>" type="text"></td>
                                                                <td></td>
                                                            </tr>

                                                            <tr>
                                                                <td colspan="2">Normo </td>
                                                                <td><input class="form-control" name="normo" value="<?php echo $normo; ?>" type="text"></td>
                                                                <td>NIL</td>
                                                            </tr>

                                                            <tr>
                                                                <td colspan="2">Bleeding Time </td>
                                                                <td><input class="form-control" name="bleeding_time" value="<?php echo $bleeding_time; ?>" type="text"></td>
                                                                <td>(1-5)min</td>
                                                            </tr>

                                                            <tr>
                                                                <td colspan="2">Clotting Time </td>
                                                                <td><input class="form-control" name="clotting_time" value="<?php echo $clotting_time; ?>" type="text"></td>
                                                                <td>(1-5)min</td>
                                                            </tr>

                                                            <tr>
                                                                <td colspan="2">P.T. </td>
                                                                <td colspan="2"><input class="form-control" name="pt" value="<?php echo $pt; ?>" type="text"></td>
                                                            </tr>

                                                            <tr>
                                                                <td colspan="2">P.T.T. </td>
                                                                <td colspan="2"><input class="form-control" name="ptt" value="<?php echo $ptt; ?>" type="text"></td>
                                                            </tr>

                                                            <tr>
                                                                <td colspan="2">APTT </td>
                                                                <td colspan="2"><input class="form-control" name="aptt" value="<?php echo $aptt; ?>" type="text"></td>
                                                            </tr>

                                                            <tr>
                                                                <td colspan="2">HBsAg </td>
                                                                <td><input class="form-control" name="hbsagb" value="<?php echo $hbsagb; ?>" type="text"></td>
                                                                <td></td>
                                                            </tr>

                                                            <tr>
                                                                <td colspan="2">HCV </td>
                                                                <td><input class="form-control" name="hcv" value="<?php echo $hcv; ?>" type="text"></td>
                                                                <td></td>
                                                            </tr>

                                                            <tr>
                                                                <td colspan="2">RVS Screening </td>
                                                                <td><input class="form-control" name="rvs_screening" value="<?php echo $rvs_screening; ?>" type="text"></td>
                                                                <td></td>
                                                            </tr>

                                                            <tr>
                                                                <td colspan="2">VDRL </td>
                                                                <td><input class="form-control" name="vdrl" value="<?php echo $vdrl; ?>" type="text"></td>
                                                                <td></td>
                                                            </tr>

                                                            <tr>
                                                                <td colspan="2">Malaria Parasite </td>
                                                                <td><input class="form-control" name="malaria_parasite" value="<?php echo $malaria_parasite; ?>" type="text"></td>
                                                                <td></td>
                                                            </tr>

                                                            <tr>
                                                                <td colspan="2">OTHERS </td>
                                                                <td><input class="form-control" name="others" value="<?php echo $others; ?>" type="text"></td>
                                                                <td></td>
                                                            </tr>


                                                            <tr>
                                                                <td colspan="2">Direct Coombs' Test </td>
                                                                <td colspan="2"><input class="form-control" name="coombs_test" value="<?php echo $coombs_test; ?>" type="text"></td>
                                                            </tr>

                                                            <tr>
                                                                <td colspan="2">Indirect Coombs' Test </td>
                                                                <td colspan="2"><input class="form-control" name="ind_coombs_test" value="<?php echo $ind_coombs_test; ?>" type="text"></td>
                                                            </tr>

                                                            <tr>
                                                                <td colspan="2">CD 4 Lymphocyte Count </td>
                                                                <td colspan="2"><input class="form-control" name="cd4" value="<?php echo $cd4; ?>" type="text"></td>
                                                            </tr>

                                                            <tr>
                                                                <td colspan="2">Blood Group </td>
                                                                <td colspan="2"><input class="form-control" name="blood_group" value="<?php echo $blood_group; ?>" type="text"></td>
                                                            </tr>

                                                            <tr>
                                                                <td colspan="2">Hb Genotype </td>
                                                                <td colspan="2"><input class="form-control" name="hb_genotype" value="<?php echo $hb_genotype; ?>" type="text"></td>
                                                            </tr>

                                                            <tr>
                                                                <td colspan="2"> G6PD </td>
                                                                <td colspan="2"><input class="form-control" name="g6pd" value="<?php echo $g6pd; ?>" type="text"></td>
                                                            </tr>





                                                        <?php  }   ?>






                                                    </table>

                                                </div>

                                            </div>

                                            <?php

                                            $result->resultData;
                                            $decode = json_decode($result->resultData);

                                            if (isset($result->resultData) and !empty($result->resultData)) {

                                                foreach ($decode as $key => $value) {

                                                    if (isset($key) and !empty($key)) {
                                                        if ($key == 'Notes') {   ?>
                                                            <div class="col-md-5">
                                                                <b>SCIENTIST NOTE </b><textarea rows="60" cols="50" class="form-control" name="notes"><?php echo $value; ?></textarea>
                                                            </div>
                                                <?php
                                                        }
                                                    }
                                                }
                                            } else {  ?>

                                                <div class="col-md-5">
                                                    <b>SCIENTIST NOTE </b><textarea rows="60" cols="50" class="form-control" name="notes"><?php echo $notes; ?></textarea>
                                                </div>

                                            <?php
                                            }

                                            ?>




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
