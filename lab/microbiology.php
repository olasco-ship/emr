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



    $salmo_d_o   = $_POST['salmo_d_o'];
    $salmo_d_h   = $_POST['salmo_d_h'];
    $salmo_a_o   = $_POST['salmo_a_o'];
    $salmo_a_h   = $_POST['salmo_a_h'];
    $salmo_b_o   = $_POST['salmo_b_o'];
    $salmo_b_h   = $_POST['salmo_b_h'];
    $salmo_c_o   = $_POST['salmo_c_o'];
    $salmo_c_h   = $_POST['salmo_c_h'];
    $ab_period   = $_POST['ab_period'];
    $mode_of_col = $_POST['mode_of_col'];
    $volume      = $_POST['volume'];
    $viscosity   = $_POST['viscosity'];
    $appearance  = $_POST['appearance'];
    $micro_pus_cell = $_POST['micro_pus_cell'];
    $micro_rbc      = $_POST['micro_rbc'];
    $micro_epith    = $_POST['micro_epith'];
    $micro_bacteria = $_POST['micro_bacteria'];
    $micro_s_haem   = $_POST['micro_s_haem'];
    $micro_t_v      = $_POST['micro_t_v'];
    $micro_yeast    = $_POST['micro_yeast'];
    $mot_fully_active = $_POST['mot_fully_active'];
    $mot_sli_active  = $_POST['mot_sli_active'];
    $mot_dead        = $_POST['mot_dead'];
    $mot_morphology  = $_POST['mot_morphology'];
    $mot_sperm_count = $_POST['mot_sperm_count'];
    $active          = $_POST['active'];
    $sluggish        = $_POST['sluggish'];
    $mot_culture     = $_POST['mot_culture'];
    $culture_isolate = $_POST['culture_isolate'];
    $pus_cell        = $_POST['pus_cell'];
    $rbc             = $_POST['rbc'];
    $s_haem          = $_POST['s_haem'];
    $casts           = $_POST['casts'];
    $crystals        = $_POST['crystals'];
    $yeast           = $_POST['yeast'];
    $bacteria        = $_POST['bacteria'];
    $t_vaginalis     = $_POST['t_vaginalis'];
    $epith_cell      = $_POST['epith_cell'];
    $others          = $_POST['others'];
    $colour          =  $_POST['colour'];
    $ph              = $_POST['ph'];
    $sg              = $_POST['sg'];
    $glucose         = $_POST['glucose'];
    $ketone          = $_POST['ketone'];
    $ascorbic_acid   = $_POST['ascorbic_acid'];
    $nitrite         = $_POST['nitrite'];
    $protein         = $_POST['protein'];
    $bilirubin       = $_POST['bilirubin'];
    $urobilnogen     = $_POST['urobilnogen'];
    $blood           = $_POST['blood'];
    $leucocytes      = $_POST['leucocytes'];
    $comment         = $_POST['comment'];
    $stool_analysis  = $_POST['stool_analysis'];
    $faecal_occult   =  $_POST['faecal_occult'];
    $skin_snip       = $_POST['skin_snip'];
    $mip             = $_POST['mip'];
    $cefri           = $_POST['ceftri'];
    $gent            = $_POST['gent'];
    $cot             = $_POST['cot'];
    $lev             = $_POST['lev'];
    $net             = $_POST['net'];
    $tet             = $_POST['tet'];
    $amo             = $_POST['amo'];
    $ofl             = $_POST['ofl'];
    $cip             = $_POST['cip'];
    $cefta           = $_POST['cefta'];
    $cefu            = $_POST['cefu'];
    $nitro           = $_POST['nitro'];
    $amp             = $_POST['amp'];
    $ery             = $_POST['ery'];
    $clo             = $_POST['clo'];
    $aug             = $_POST['aug'];
    $anti_one        = $_POST['anti_one'];
    $anti_one_res    = $_POST['anti_one_res'];
    $anti_two        = $_POST['anti_two'];
    $anti_two_res    = $_POST['anti_two_res'];
    $anti_three        = $_POST['anti_three'];
    $anti_three_res    = $_POST['anti_three_res'];

    $sputum        = $_POST['sputum'];
    $spu_others    =  $_POST['spu_others'];
    $spu_epith     =  $_POST['spu_epith'];
    $spu_pus_cells = $_POST['spu_pus_cells'];
    $spu_pos       = $_POST['spu_pos'];
    $spu_neg       = $_POST['spu_neg'];
    $spu_culture   = $_POST['spu_culture'];
    $normal        = $_POST['normal'];
    $abnormal      = $_POST['abnormal'];
    $prelim        = $_POST['prelim'];
    $final         = $_POST['final'];
    $mycology      = $_POST['mycology'];

    $mycology_culture    = $_POST['mycology_culture'];
    $urine_micro_culture = $_POST['urine_micro_culture'];
    $sperm_culture       = $_POST['sperm_culture'];
    $sperm_comment       = $_POST['sperm_comment'];
    $vdrl                = $_POST['vdrl'];
    $widal_comment       = $_POST['widal_comment'];
    $widal_others        = $_POST['widal_others'];
    $h_pylori            = $_POST['h_pylori'];
    $urine_pus_cell      = $_POST['urine_pus_cell'];
    $urine_cast          = $_POST['urine_cast'];
    $urine_crystals      = $_POST['urine_crystals'];
    $urine_organism      = $_POST['urine_organism'];
    $clue_cell           = $_POST['clue_cell'];
    $spu_yeast_cells     = $_POST['spu_yeast_cells'];
    $spu_pos_rod         = $_POST['spu_pos_rod'];
    $spu_neg_cocci       = $_POST['spu_neg_cocci'];

    $notes           = $_POST['notes'];

    $date_col = new DateTime($_POST['date_col']);
    $date_rec = new DateTime($_POST['date_rec']);
    $rev_date = new DateTime($_POST['rev_date']);


    $date_col = date_format($date_col, 'Y-m-d');
    $date_rec = date_format($date_rec, 'Y-m-d');
    $rev_date = date_format($rev_date, 'Y-m-d');


    $micro                = new StdClass();
    $micro->salmo_d_o     = $salmo_d_o;
    $micro->salmo_d_h     = $salmo_d_h;
    $micro->salmo_a_o     = $salmo_a_o;
    $micro->salmo_a_h     = $salmo_a_h;
    $micro->salmo_b_o     = $salmo_b_o;
    $micro->salmo_b_h     = $salmo_b_h;
    $micro->salmo_c_o     = $salmo_c_o;
    $micro->salmo_c_h     = $salmo_c_h;

    $micro->date_col      = $date_col;
    $micro->time_col      = $_POST['time_col'];
    $micro->time_rec      = $_POST['time_rec'];
    $micro->time_ex       = $_POST['time_ex'];

    $micro->ab_period     = $ab_period;
    $micro->mode_of_col   = $mode_of_col;
    $micro->volume        = $volume;
    $micro->viscosity     = $viscosity;
    $micro->appearance    = $appearance;
    $micro->micro_pus_cell = $micro_pus_cell;
    $micro->micro_rbc     = $micro_rbc;
    $micro->micro_epith   = $micro_epith;
    $micro->micro_bacteria = $micro_bacteria;
    $micro->micro_s_haem  = $micro_s_haem;
    $micro->micro_t_v     = $micro_t_v;
    $micro->micro_yeast   = $micro_yeast;
    $micro->mot_fully_active = $mot_fully_active;
    $micro->mot_sli_active  = $mot_sli_active;
    $micro->mot_dead        = $mot_dead;
    $micro->mot_morphology  = $mot_morphology;
    $micro->mot_sperm_count = $mot_sperm_count;
    $micro->active          = $active;
    $micro->sluggish        = $sluggish;
    $micro->mot_culture     = $mot_culture;
    $micro->culture_isolate = $culture_isolate;
    $micro->pus_cell        = $pus_cell;
    $micro->rbc             = $rbc;
    $micro->s_haem          = $s_haem;
    $micro->casts           = $casts;
    $micro->crystals        = $crystals;
    $micro->yeast           = $yeast;
    $micro->bacteria        = $bacteria;
    $micro->t_vaginalis     = $t_vaginalis;
    $micro->epith_cell      = $epith_cell;
    $micro->others          = $others;
    $micro->colour          = $colour;
    $micro->ph              = $ph;
    $micro->sg              = $sg;
    $micro->glucose         = $glucose;
    $micro->ketone          = $ketone;
    $micro->ascorbic_acid   = $ascorbic_acid;
    $micro->nitrite         = $nitrite;
    $micro->protein         = $protein;
    $micro->bilirubin       = $bilirubin;
    $micro->urobilnogen     = $urobilnogen;
    $micro->blood           = $blood;
    $micro->leucocytes      = $leucocytes;
    $micro->comment         = $comment;
    $micro->stool_analysis  = $stool_analysis;
    $micro->faecal_occult   = $faecal_occult;
    $micro->skin_snip       = $skin_snip;
    $micro->mip             = $mip;
    $micro->ceftri          = $cefri;
    $micro->gent            = $gent;
    $micro->cot             = $cot;
    $micro->lev             = $lev;
    $micro->net             = $net;
    $micro->tet             = $tet;
    $micro->amo             = $amo;
    $micro->ofl             = $ofl;
    $micro->cip             = $cip;
    $micro->cefta           = $cefta;
    $micro->cefu            = $cefu;
    $micro->nitro           = $nitro;
    $micro->amp             = $amp;
    $micro->ery             = $ery;
    $micro->clo             = $clo;
    $micro->aug             = $aug;
    $micro->anti_one        = $anti_one;
    $micro->anti_one_res    = $anti_one_res;
    $micro->anti_two        = $anti_two;
    $micro->anti_two_res    = $anti_two_res;
    $micro->anti_three      = $anti_three;
    $micro->anti_three_res  = $anti_three_res;
    $micro->notes           = $notes;

    $micro->sputum           = $sputum;
    $micro->spu_others       = $spu_others;
    $micro->spu_epith        = $spu_epith;
    $micro->spu_pus_cells    = $spu_pus_cells;
    $micro->spu_pos          = $spu_pos;
    $micro->spu_neg          = $spu_neg;
    $micro->spu_culture      = $spu_culture;
    $micro->normal           = $normal;
    $micro->abnormal         = $abnormal;
    $micro->prelim           = $prelim;
    $micro->final            = $final;
    $micro->mycology         = $mycology;

    $micro->mycology_culture    = $mycology_culture;
    $micro->urine_micro_culture = $urine_micro_culture;
    $micro->sperm_culture       = $sperm_culture;
    $micro->sperm_comment       = $sperm_comment;
    $micro->vdrl                = $vdrl;
    $micro->widal_comment       = $widal_comment;
    $micro->widal_others        = $widal_others;
    $micro->h_pylori            = $h_pylori;
    $micro->urine_crystals      = $urine_crystals;
    $micro->urine_pus_cell      = $urine_pus_cell;
    $micro->urine_cast          = $urine_cast;
    $micro->urine_organism      = $urine_organism;
    $micro->clue_cell           = $clue_cell;
    $micro->spu_yeast_cells     = $spu_yeast_cells;
    $micro->spu_pos_rod         = $spu_pos_rod;
    $micro->spu_neg_cocci       = $spu_neg_cocci;

    $json = json_encode($micro);
    //        echo $json; exit;
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
<!--                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>
                            Lab Request Forms </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Laboratory</li>
                            <li class="breadcrumb-item active">Forms</li>
                        </ul>
                    </div>-->

                </div>
            </div>



            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card patients-list">

                        <div class="body">
                            <div class="container">

                                <a href="../lab/sample_analysis.php">Back</a>

                                <h4 style="text-align: center">OBAFEMI AWOLOWO UNIVERSITY TEACHING HOSPITALS COMPLEX, ILE-IFE</h4>
                                <h6 style="text-align: center">DEPARTMENT OF MEDICAL MICROBIOLOGY AND PARASITOLOGY</h6>
                                <h6 style="text-align: center">MICROBIOLOGY FORM</h6>

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

                                <div class="body">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#Profile-withicon">
                                                Microbiology </a></li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Home-withicon">
                                                Parasitology </a></li>
                                    </ul>
                                    <div class="tab-content">

                                        <div class="tab-pane show active" id="Profile-withicon">

                                            <?php
                                            $result->resultData;
                                            $decode = json_decode($result->resultData);

                                            if (isset($result->resultData) and !empty($result->resultData)) {
                                                ?>

                                                <div class="card">
                                                    <div class="card-header">

                                                        Microbiology

                                                    </div>

                                                    <div class="card-body">

                                                        <div class="row">
                                                            <div class="col-md-5">

                                                                <table>


                                                                    <table class="table table-bordered">
                                                                        <tr>
                                                                            <td><b>WIDAL REACTION</b></td>
                                                                            <td colspan="2" style="text-align: center"><b>TITRE</b></td>

                                                                        </tr>

                                                                        <tr>
                                                                            <td><b></b></td>
                                                                            <td style="text-align: center"><b>O</b></td>
                                                                            <td style="text-align: center"><b>H</b></td>
                                                                        </tr>

                                                                        <?php
                                                                        $result->resultData;
                                                                        $decode = json_decode($result->resultData);
                                                                        ?>
                                                                        <tr>
                                                                            <td><b>Salmonella Typhi D</b></td>
                                                                            <?php
                                                                            foreach ($decode as $key => $value) {

                                                                                if (isset($key) and !empty($key)) {
                                                                                    if ($key == 'salmo_d_o') {
                                                                                        echo "<td style='text-align: center'><b><input class='form-control' name='salmo_d_o' value=$value ></b></td>";
                                                                                    }
                                                                                    if ($key == 'salmo_d_h') {
                                                                                        echo "<td style='text-align: center'><b><input class='form-control' name='salmo_d_h' value=$value ></b></td>";
                                                                                    }
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </tr>


                                                                        <tr>
                                                                            <td><b>Salmonella Paratyphi A</b></td>
                                                                            <?php
                                                                            foreach ($decode as $key => $value) {
                                                                                if (isset($key) and !empty($key)) {
                                                                                    if ($key == 'salmo_a_o') {
                                                                                        echo "<td style='text-align: center'><b><input class='form-control' name='salmo_a_o' value=$value ></b></td>";
                                                                                    }
                                                                                    if ($key == 'salmo_a_h') {
                                                                                        echo "<td style='text-align: center'><b><input class='form-control' name='salmo_a_h' value=$value ></b></td>";
                                                                                    }
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </tr>

                                                                        <tr>
                                                                            <td><b>Salmonella Paratyphi B</b></td>
                                                                            <?php
                                                                            foreach ($decode as $key => $value) {
                                                                                if (isset($key) and !empty($key)) {
                                                                                    if ($key == 'salmo_b_o') {
                                                                                        echo "<td style='text-align: center'><b><input class='form-control' name='salmo_b_o' value=$value ></b></td>";
                                                                                    }
                                                                                    if ($key == 'salmo_b_h') {
                                                                                        echo "<td style='text-align: center'><b><input class='form-control' name='salmo_b_h' value=$value ></b></td>";
                                                                                    }
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </tr>

                                                                        <tr>
                                                                            <td><b>Salmonella Paratyphi C</b></td>
                                                                            <?php
                                                                            foreach ($decode as $key => $value) {
                                                                                if (isset($key) and !empty($key)) {
                                                                                    if ($key == 'salmo_c_o') {
                                                                                        echo "<td style='text-align: center'><b><input class='form-control' name='salmo_c_o' value=$value ></b></td>";
                                                                                    }
                                                                                    if ($key == 'salmo_c_h') {
                                                                                        echo "<td style='text-align: center'><b><input class='form-control' name='salmo_c_h' value=$value ></b></td>";
                                                                                    }
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </tr>


                                                                        <tr>
                                                                            <td><b> Comment </b></td>
                                                                            <?php
                                                                            foreach ($decode as $key => $value) {
                                                                                if (isset($key) and !empty($key)) {
                                                                                    if ($key == 'widal_comment') {
                                                                                        echo "<td colspan='2' style='text-align: center'><b><textarea class='form-control' cols='4' rows='3' name='widal_comment' >$value</textarea></b></td>";
                                                                                    }
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </tr>

                                                                        <tr>
                                                                            <td><b> VDRL </b></td>
                                                                            <?php
                                                                            foreach ($decode as $key => $value) {
                                                                                if (isset($key) and !empty($key)) {
                                                                                    if ($key == 'vdrl') {
                                                                                        echo "<td colspan='2' style='text-align: center'><b><input class='form-control' name='vdrl' value=$value ></b></td>";
                                                                                    }
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </tr>


                                                                        <tr>
                                                                            <td><b> H . Pylori </b></td>
                                                                            <?php
                                                                            foreach ($decode as $key => $value) {
                                                                                if (isset($key) and !empty($key)) {
                                                                                    if ($key == 'h_pylori') {
                                                                                        echo "<td colspan='2' style='text-align: center'><b><input class='form-control' name='h_pylori' value=$value ></b></td>";
                                                                                    }
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </tr>


                                                                        <tr>
                                                                            <td><b> Others </b></td>
                                                                            <?php
                                                                            foreach ($decode as $key => $value) {
                                                                                if (isset($key) and !empty($key)) {
                                                                                    if ($key == 'widal_others') {
                                                                                        echo "<td colspan='2' style='text-align: center'><b><input class='form-control' name='widal_others' value=$value ></b></td>";
                                                                                    }
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </tr>


                                                                    </table>

                                                                </table>


                                                            </div>
                                                            <div class="col-md-7">

                                                                <table>


                                                                    <table class="table table-bordered">
                                                                        <tr>
                                                                            <td style="text-align: center"><b>SEMEN ANALYSIS M/C/S</b></td>
                                                                            <td style="text-align: center"><b>MICROSCOPY</b></td>
                                                                            <?php
                                                                            foreach ($decode as $key => $value) {
                                                                                if (isset($key) and !empty($key)) {
                                                                                    if ($key == 'mot_sperm_count') {  ?>
                                                                                        <td style="text-align: center"><b>Sperm Count/ml</b><input class="form-control" value="<?php echo $value; ?>" name="mot_sperm_count" /></td>
                                                                                    <?php }}} ?>

                                                                        </tr>

                                                                        <tr>
                                                                            <?php
                                                                            foreach ($decode as $key => $value) {
                                                                                if (isset($key) and !empty($key)) {
                                                                                    if ($key == 'date_col') {
                                                                                        echo "<td style='text-align: center'><b>Collection Date</b><input class='form-control' id='col_date' name='date_col' value=$value ></td>";
                                                                                    }
                                                                                    if ($key == 'micro_pus_cell') {
                                                                                        echo "<td style='text-align: center'><b>Pus Cell</b><input class='form-control' name='micro_pus_cell' value=$value ></td>";
                                                                                    }
                                                                                    if ($key == 'mot_fully_active') {
                                                                                        echo "<td style='text-align: center'><b> MOTILITY </b>";
                                                                                    }
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </tr>

                                                                        <tr>
                                                                            <?php

                                                                            foreach ($decode as $key => $value) {
                                                                                if (isset($key) and !empty($key)) {
                                                                                    if ($key == 'time_col') {
                                                                                        echo "<td style='text-align: center'><b> Time Collected </b><input class='form-control' id='col_time' name='time_col' value=$value ></td>";
                                                                                    }
                                                                                }
                                                                            }
                                                                            echo "<td style='text-align: center'></td>";
                                                                            foreach ($decode as $key => $value) {
                                                                                if (isset($key) and !empty($key)) {

                                                                                    if ($key == 'mot_fully_active') {
                                                                                        echo "<td style='text-align: center'><b> Motile <!-- % Fully Active --> </b><input class='form-control' name='mot_fully_active' value=$value ></td>";
                                                                                    }
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </tr>

                                                                        <tr>
                                                                            <?php

                                                                            foreach ($decode as $key => $value) {
                                                                                if (isset($key) and !empty($key)) {
                                                                                    if ($key == 'time_rec') {
                                                                                        echo "<td style='text-align: center'><b> Time Received </b><input class='form-control' id='rec_time' name='time_rec' value=$value ></td>";
                                                                                    }
                                                                                }
                                                                            }
                                                                            echo "<td style='text-align: center'></td>";
                                                                            foreach ($decode as $key => $value) {
                                                                                if (isset($key) and !empty($key)) {
                                                                                    if ($key == 'mot_dead') {
                                                                                        echo "<td style='text-align: center'><b> Non-motile </b><input class='form-control' name='mot_dead' value=$value ></td>";
                                                                                    }
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </tr>

                                                                        <tr>
                                                                            <?php
                                                                            foreach ($decode as $key => $value) {
                                                                                if (isset($key) and !empty($key)) {
                                                                                    if ($key == 'time_ex') {
                                                                                        echo "<td style='text-align: center'><b> Time Examined </b><input class='form-control' id='ex_time' name='time_ex' value=$value ></td>";
                                                                                    }
                                                                                }
                                                                            }
                                                                            echo "<td style='text-align: center'></td>";
                                                                            foreach ($decode as $key => $value) {
                                                                                if (isset($key) and !empty($key)) {

                                                                                    if ($key == 'mot_morphology') {
                                                                                        echo "<td style='text-align: center'><b> PROGRESSION </b></td>";
                                                                                    }
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </tr>


                                                                        <tr>
                                                                            <?php
                                                                            foreach ($decode as $key => $value) {
                                                                                if (isset($key) and !empty($key)) {
                                                                                    if ($key == 'ab_period') {
                                                                                        echo "<td style='text-align: center'><b> Abstinence Period </b><input class='form-control'  name='ab_period' value=$value ></td>";
                                                                                    }
                                                                                }
                                                                            }
                                                                            echo "<td style='text-align: center'></td>";
                                                                            foreach ($decode as $key => $value) {
                                                                                if (isset($key) and !empty($key)) {

                                                                                    if ($key == 'active') {
                                                                                        echo "<td style='text-align: center'><b> Active </b><input class='form-control' name='active' value=$value ></td>";
                                                                                    }
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </tr>

                                                                        <tr>
                                                                            <?php
                                                                            foreach ($decode as $key => $value) {
                                                                                if (isset($key) and !empty($key)) {
                                                                                    if ($key == 'mode_of_col') {
                                                                                        echo "<td style='text-align: center'><b> Mode of Collection </b><input class='form-control'  name='ab_period' value=$value ></td>";
                                                                                    }
                                                                                }
                                                                            }
                                                                            echo "<td style='text-align: center'></td>";
                                                                            foreach ($decode as $key => $value) {
                                                                                if (isset($key) and !empty($key)) {

                                                                                    if ($key == 'sluggish') {
                                                                                        echo "<td style='text-align: center'><b> Sluggish </b><input class='form-control' name='sluggish' value=$value ></td>";
                                                                                    }
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </tr>

                                                                        <tr>
                                                                            <?php
                                                                            foreach ($decode as $key => $value) {
                                                                                if (isset($key) and !empty($key)) {
                                                                                    if ($key == 'volume') {
                                                                                        echo "<td style='text-align: center'><b> Volume  </b><input class='form-control'  name='volume' value=$value ></td>";
                                                                                    }
                                                                                }
                                                                            }
                                                                            echo "<td style='text-align: center'></td>";
                                                                            foreach ($decode as $key => $value) {
                                                                                if (isset($key) and !empty($key)) {

                                                                                    if ($key == 'mot_morphology') {
                                                                                        echo "<td style='text-align: center'><b> MORPHOLOGY </b></td>";
                                                                                    }
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </tr>


                                                                        <tr>
                                                                            <?php
                                                                            foreach ($decode as $key => $value) {
                                                                                if (isset($key) and !empty($key)) {
                                                                                    if ($key == 'viscosity') {
                                                                                        echo "<td style='text-align: center'><b> Viscousity  </b><input class='form-control'  name='viscosity' value=$value ></td>";
                                                                                    }
                                                                                }
                                                                            }

                                                                            echo "<td style='text-align: center'></td>";
                                                                            foreach ($decode as $key => $value) {
                                                                                if (isset($key) and !empty($key)) {

                                                                                    if ($key == 'abnormal') {
                                                                                        echo "<td style='text-align: center'><b> Abnormal </b><input class='form-control' name='abnormal' value=$value ></td>";
                                                                                    }
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </tr>

                                                                        <tr>
                                                                            <?php
                                                                            foreach ($decode as $key => $value) {
                                                                                if (isset($key) and !empty($key)) {
                                                                                    if ($key == 'appearance') {
                                                                                        echo "<td style='text-align: center'><b> Appearance  </b><input class='form-control'  name='appearance' value=$value ></td>";
                                                                                    }
                                                                                }
                                                                            }
                                                                            echo "<td style='text-align: center'></td>";
                                                                            foreach ($decode as $key => $value) {
                                                                                if (isset($key) and !empty($key)) {

                                                                                    if ($key == 'normal') {
                                                                                        echo "<td style='text-align: center'><b> Normal </b><input class='form-control' name='normal' value=$value ></td>";
                                                                                    }
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </tr>

                                                                        <tr>
                                                                            <?php

                                                                            echo "<td style='text-align: center'></td>";
                                                                            echo "<td style='text-align: center'></td>";
                                                                            foreach ($decode as $key => $value) {
                                                                                if (isset($key) and !empty($key)) {

                                                                                    if ($key == 'sperm_culture') {
                                                                                        echo "<td style='text-align: center'><b> Culture </b><textarea class='form-control' cols='4' rows='3' name='sperm_culture'>$value</textarea></td>";
                                                                                    }
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </tr>


                                                                        <tr>
                                                                            <?php
                                                                            echo "<td style='text-align: center'></td>";
                                                                            echo "<td style='text-align: center'></td>";
                                                                            foreach ($decode as $key => $value) {
                                                                                if (isset($key) and !empty($key)) {

                                                                                    if ($key == 'sperm_comment') {
                                                                                        echo "<td style='text-align: center'><b> Comment </b><textarea class='form-control' cols='4' rows='3' name='sperm_comment'>$value</textarea></td>";
                                                                                    }
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </tr>



                                                                    </table>

                                                                </table>

                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6">

                                                                <table>


                                                                    <table class="table table-bordered">
                                                                        <tr>
                                                                            <td colspan="2" style="text-align: center"><b> URINE MICROSCOPY </b></td>
                                                                        </tr>

                                                                        <?php
                                                                        foreach ($decode as $key => $value) {

                                                                            if (isset($key) and !empty($key)) {
                                                                                if ($key == 'pus_cell') {   ?>
                                                                                    <tr>
                                                                                        <td><b> Pus Cell </b> </td>
                                                                                        <td><input class="form-control" value="<?php echo $value; ?>" name="pus_cell" /></td>
                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                            }


                                                                            if (isset($key) and !empty($key)) {
                                                                                if ($key == 'rbc') {   ?>
                                                                                    <tr>
                                                                                        <td><b> RBC </b> </td>
                                                                                        <td><input class="form-control" value="<?php echo $value; ?>" name="rbc" /></td>
                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                            }

                                                                            /*
                                                                            if (isset($key) and !empty($key)) {
                                                                                if ($key == 's_haem') {   ?>
                                                                                    <tr>
                                                                                        <td><b> S.Haematobium </b> </td>
                                                                                        <td><input class="form-control" value="<?php echo $value; ?>" name="s_haem" /></td>
                                                                                    </tr>
                                                                                <?php
                                                                                }
                                                                            }


                                                                            if (isset($key) and !empty($key)) {
                                                                                if ($key == 'casts') {   ?>
                                                                                    <tr>
                                                                                        <td><b> Casts </b> </td>
                                                                                        <td><input class="form-control" value="<?php echo $value; ?>" name="casts" /></td>
                                                                                    </tr>
                                                                                <?php
                                                                                }
                                                                            }
                                                                            */


                                                                            if (isset($key) and !empty($key)) {
                                                                                if ($key == 'crystals') {   ?>
                                                                                    <tr>
                                                                                        <td><b> Crystals </b> </td>
                                                                                        <td><input class="form-control" value="<?php echo $value; ?>" name="crystals" /></td>
                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                            }


                                                                            if (isset($key) and !empty($key)) {
                                                                                if ($key == 'yeast') {   ?>
                                                                                    <tr>
                                                                                        <td><b> Yeast </b> </td>
                                                                                        <td><input class="form-control" value="<?php echo $value; ?>" name="yeast" /></td>
                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                            }

                                                                            if (isset($key) and !empty($key)) {
                                                                                if ($key == 'bacteria') {   ?>
                                                                                    <tr>
                                                                                        <td><b> Bacteria </b> </td>
                                                                                        <td><input class="form-control" value="<?php echo $value; ?>" name="bacteria" /></td>
                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                            }


                                                                            if (isset($key) and !empty($key)) {
                                                                                if ($key == 't_vaginalis') {   ?>
                                                                                    <tr>
                                                                                        <td><b> T.Vaginalis </b> </td>
                                                                                        <td><input class="form-control" value="<?php echo $value; ?>" name="t_vaginalis" /></td>
                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                            }


                                                                            if (isset($key) and !empty($key)) {
                                                                                if ($key == 'epith_cell') {   ?>
                                                                                    <tr>
                                                                                        <td><b> Epithelia Cell </b> </td>
                                                                                        <td><input class="form-control" value="<?php echo $value; ?>" name="epith_cell" /></td>
                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                            }

                                                                            /*
                                                                            if (isset($key) and !empty($key)) {
                                                                                if ($key == 'clue_cell') {   ?>
                                                                                    <tr>
                                                                                        <td><b> Clue Cell </b> </td>
                                                                                        <td><input class="form-control" value="<?php echo $value; ?>" name="clue_cell" /></td>
                                                                                    </tr>
                                                                                <?php
                                                                                }
                                                                            }
                                                                            */

                                                                            if (isset($key) and !empty($key)) {
                                                                                if ($key == 'others') {   ?>
                                                                                    <tr>
                                                                                        <td><b> Others </b> </td>
                                                                                        <td><input class="form-control" value="<?php echo $value; ?>" name="others" /></td>
                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                            }
                                                                        }
                                                                        ?>


                                                                        <tr>
                                                                            <td colspan="2" style="text-align: center"><b> SWAB/MISCELLANEOUS </b></td>
                                                                        </tr>

                                                                        <?php
                                                                        foreach ($decode as $key => $value) {

                                                                            if (isset($key) and !empty($key)) {
                                                                                if ($key == 'sputum') {   ?>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <b> SPUTUM M/C/S
                                                                                            </b>
                                                                                        </td>
                                                                                        <td>

                                                                                            <select class="form-control" name="sputum">
                                                                                                <option value=""></option>
                                                                                                <option <?php echo ($value == 'ECS m/c/s') ? 'selected ="TRUE"' : ''; ?> value="ECS m/c/s">ECS m/c/s</option>
                                                                                                <option <?php echo ($value == 'Urethral Swab m/c/s') ? 'selected ="TRUE"' : ''; ?> value="Urethral Swab m/c/s">Urethral Swab m/c/s</option>
                                                                                                <option <?php echo ($value == 'Wound Swab m/c/s') ? 'selected ="TRUE"' : ''; ?> value="Wound Swab m/c/s">Wound Swab m/c/s</option>
                                                                                                <option <?php echo ($value == 'Sputum Swab m/c/s') ? 'selected ="TRUE"' : ''; ?> value="Sputum Swab m/c/s">Sputum Swab m/c/s</option>
                                                                                                <option <?php echo ($value == 'Ear Swab m/c/s') ? 'selected ="TRUE"' : ''; ?> value="Ear Swab m/c/s">Ear Swab m/c/s</option>
                                                                                                <option <?php echo ($value == 'Eye Swab m/c/s') ? 'selected ="TRUE"' : ''; ?> value="Eye Swab m/c/s">Eye Swab m/c/s</option>
                                                                                                <option <?php echo ($value == 'Aspirate m/c/s') ? 'selected ="TRUE"' : ''; ?> value="Aspirate m/c/s">Aspirate m/c/s</option>
                                                                                                <option <?php echo ($value == 'Thoracic Swab m/c/s') ? 'selected ="TRUE"' : ''; ?> value="Thoracic Swab m/c/s">Thoracic Swab m/c/s</option>
                                                                                                <option <?php echo ($value == 'Nasal Swab m/c/s') ? 'selected ="TRUE"' : ''; ?> value="Nasal Swab m/c/s">Nasal Swab m/c/s</option>
                                                                                                <option <?php echo ($value == 'Skin Swab m/c/s') ? 'selected ="TRUE"' : ''; ?> value="Skin Swab m/c/s">Skin Swab m/c/s</option>
                                                                                                <option <?php echo ($value == 'Pus m/c/s') ? 'selected ="TRUE"' : ''; ?> value="Pus m/c/s">Pus m/c/s</option>
                                                                                                <option <?php echo ($value == 'Mouth Swab m/c/s') ? 'selected ="TRUE"' : ''; ?> value="Mouth Swab m/c/s">Mouth Swab m/c/s</option>
                                                                                                <option <?php echo ($value == 'Catheter tip m/c/s') ? 'selected ="TRUE"' : ''; ?> value="Catheter tip m/c/s">Catheter tip m/c/s</option>
                                                                                                <option <?php echo ($value == 'IUD m/c/s') ? 'selected ="TRUE"' : ''; ?> value="IUD m/c/s">IUD m/c/s</option>
                                                                                                <option <?php echo ($value == 'Ulcer material m/c/s') ? 'selected ="TRUE"' : ''; ?> value="Ulcer material m/c/s">Ulcer material m/c/s</option>
                                                                                            </select>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                            }



                                                                            if (isset($key) and !empty($key)) {
                                                                                if ($key == 'spu_others') {   ?>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <b> Others
                                                                                            </b>
                                                                                        </td>
                                                                                        <td>
                                                                                            <input class="form-control" value="<?php echo $value; ?>" name="spu_others" />
                                                                                        </td>
                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                            }
                                                                        }  ?>

                                                                        <?php
                                                                        foreach ($decode as $key => $value) {

                                                                            if (isset($key) and !empty($key)) {
                                                                                if ($key == 'micro_rbc') {   ?>
                                                                                    <tr>
                                                                                        <td colspan="3"><b> Rbc </b><input class="form-control" value="<?php echo $value; ?>" name="micro_rbc" /></td>
                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                            }


                                                                            if (isset($key) and !empty($key)) {
                                                                                if ($key == 'micro_epith') {   ?>
                                                                                    <tr>
                                                                                        <td colspan="3"><b> Epith Cell </b><input class="form-control" value="<?php echo $value; ?>" name="micro_epith" /></td>
                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                            }

                                                                            if (isset($key) and !empty($key)) {
                                                                                if ($key == 'micro_bacteria') {   ?>
                                                                                    <tr>
                                                                                        <td colspan="3"><b> Bacteria </b><input class="form-control" value="<?php echo $value; ?>" name="micro_bacteria" /></td>
                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                            }

                                                                            if (isset($key) and !empty($key)) {
                                                                                if ($key == 'micro_s_haem') {   ?>
                                                                                    <tr>
                                                                                        <td colspan="3"><b> S.Haematolobium </b><input class="form-control" value="<?php echo $value; ?>" name="micro_s_haem" /></td>
                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                            }


                                                                            if (isset($key) and !empty($key)) {
                                                                                if ($key == 'micro_t_v') {   ?>
                                                                                    <tr>
                                                                                        <td colspan="3"><b> T.Vaginalis </b><input class="form-control" value="<?php echo $value; ?>" name="micro_t_v" /></td>
                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                            }


                                                                            if (isset($key) and !empty($key)) {
                                                                                if ($key == 'micro_yeast') {   ?>
                                                                                    <tr>
                                                                                        <td colspan="3"><b> Yeast </b><input class="form-control" value="<?php echo $value; ?>" name="micro_yeast" /></td>
                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                            }


                                                                            if (isset($key) and !empty($key)) {
                                                                                if ($key == 'urine_pus_cell') {   ?>
                                                                                    <tr>
                                                                                        <td colspan="3"><b> Pus Cell </b><input class="form-control" value="<?php echo $value; ?>" name="urine_pus_cell" /></td>
                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                            }


                                                                            if (isset($key) and !empty($key)) {
                                                                                if ($key == 'urine_cast') {   ?>
                                                                                    <tr>
                                                                                        <td colspan="3"><b> Cast </b><input class="form-control" value="<?php echo $value; ?>" name="urine_cast" /></td>
                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                            }


                                                                            if (isset($key) and !empty($key)) {
                                                                                if ($key == 'urine_crystals') {   ?>
                                                                                    <tr>
                                                                                        <td colspan="3"><b> Crystals </b><input class="form-control" value="<?php echo $value; ?>" name="urine_crystals" /></td>
                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                            }


                                                                            if (isset($key) and !empty($key)) {
                                                                                if ($key == 'urine_organism') {   ?>
                                                                                    <tr>
                                                                                        <td colspan="3"><b> Organisms </b><input class="form-control" value="<?php echo $value; ?>" name="urine_organism" /></td>
                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                            }

                                                                            if (isset($key) and !empty($key)) {
                                                                                if ($key == 'urine_micro_culture') {   ?>
                                                                                    <tr>
                                                                                        <td colspan="3"><b> Culture </b> <textarea class="form-control" cols="4" rows="3" name="urine_micro_culture"><?php echo $value; ?></textarea></td>
                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                            }
                                                                        } ?>





                                                                    </table>

                                                                </table>

                                                            </div>

                                                            <div class="col-md-6">

                                                                <table>


                                                                    <table class="table table-bordered">
                                                                        <tr>
                                                                            <td style="text-align: center"><b> SENSITIVITY </b></td>
                                                                            <td style="text-align: center"><b> RESULTS </b> </td>
                                                                        </tr>


                                                                        <?php
                                                                        foreach ($decode as $key => $value) {

                                                                            if (isset($key) and !empty($key)) {
                                                                                if ($key == 'mip') {   ?>
                                                                                    <tr>
                                                                                        <td><b> CEFIXIME </b> </td>
                                                                                        <td>
                                                                                            <select class="form-control" style="width: 250px;" name="mip">
                                                                                                <option value=""></option>
                                                                                                <option <?php echo ($value == 'Sensitive') ? 'selected ="TRUE"' : ''; ?> value="Sensitive">Sensitive</option>
                                                                                                <option <?php echo ($value == 'Intermediate') ? 'selected ="TRUE"' : ''; ?> value="Intermediate">Intermediate </option>
                                                                                                <option <?php echo ($value == 'Resistant') ? 'selected ="TRUE"' : ''; ?> value="Resistant">Resistant </option>

                                                                                            </select>
                                                                                        </td>

                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                            }


                                                                            if (isset($key) and !empty($key)) {
                                                                                if ($key == 'cefri') {   ?>
                                                                                    <tr>
                                                                                        <td><b> CEFTRIAXONE </b> </td>
                                                                                        <td>
                                                                                            <select class="form-control" style="width: 250px;" name="cefri">
                                                                                                <option value=""></option>
                                                                                                <option <?php echo ($value == 'Sensitive') ? 'selected ="TRUE"' : ''; ?> value="Sensitive">Sensitive</option>
                                                                                                <option <?php echo ($value == 'Intermediate') ? 'selected ="TRUE"' : ''; ?> value="Intermediate">Intermediate </option>
                                                                                                <option <?php echo ($value == 'Resistant') ? 'selected ="TRUE"' : ''; ?> value="Resistant">Resistant </option>

                                                                                            </select>
                                                                                        </td>

                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                            }



                                                                            if (isset($key) and !empty($key)) {
                                                                                if ($key == 'gent') {   ?>
                                                                                    <tr>
                                                                                        <td><b> GENTAMICIN </b> </td>
                                                                                        <td>
                                                                                            <select class="form-control" style="width: 250px;" name="gent">
                                                                                                <option value=""></option>
                                                                                                <option <?php echo ($value == 'Sensitive') ? 'selected ="TRUE"' : ''; ?> value="Sensitive">Sensitive</option>
                                                                                                <option <?php echo ($value == 'Intermediate') ? 'selected ="TRUE"' : ''; ?> value="Intermediate">Intermediate </option>
                                                                                                <option <?php echo ($value == 'Resistant') ? 'selected ="TRUE"' : ''; ?> value="Resistant">Resistant </option>

                                                                                            </select>
                                                                                        </td>

                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                            }


                                                                            if (isset($key) and !empty($key)) {
                                                                                if ($key == 'cot') {   ?>
                                                                                    <tr>
                                                                                        <td><b> CO-TRIMOXAZOLE </b> </td>
                                                                                        <td>
                                                                                            <select class="form-control" style="width: 250px;" name="cot">
                                                                                                <option value=""></option>
                                                                                                <option <?php echo ($value == 'Sensitive') ? 'selected ="TRUE"' : ''; ?> value="Sensitive">Sensitive</option>
                                                                                                <option <?php echo ($value == 'Intermediate') ? 'selected ="TRUE"' : ''; ?> value="Intermediate">Intermediate </option>
                                                                                                <option <?php echo ($value == 'Resistant') ? 'selected ="TRUE"' : ''; ?> value="Resistant">Resistant </option>

                                                                                            </select>
                                                                                        </td>

                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                            }


                                                                            if (isset($key) and !empty($key)) {
                                                                                if ($key == 'lev') {   ?>
                                                                                    <tr>
                                                                                        <td><b> LEVOFLOXACIN </b> </td>
                                                                                        <td>
                                                                                            <select class="form-control" style="width: 250px;" name="lev">
                                                                                                <option value=""></option>
                                                                                                <option <?php echo ($value == 'Sensitive') ? 'selected ="TRUE"' : ''; ?> value="Sensitive">Sensitive</option>
                                                                                                <option <?php echo ($value == 'Intermediate') ? 'selected ="TRUE"' : ''; ?> value="Intermediate">Intermediate </option>
                                                                                                <option <?php echo ($value == 'Resistant') ? 'selected ="TRUE"' : ''; ?> value="Resistant">Resistant </option>

                                                                                            </select>
                                                                                        </td>

                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                            }


                                                                            if (isset($key) and !empty($key)) {
                                                                                if ($key == 'net') {   ?>
                                                                                    <tr>
                                                                                        <td><b> NETILLIN </b> </td>
                                                                                        <td>
                                                                                            <select class="form-control" style="width: 250px;" name="net">
                                                                                                <option value=""></option>
                                                                                                <option <?php echo ($value == 'Sensitive') ? 'selected ="TRUE"' : ''; ?> value="Sensitive">Sensitive</option>
                                                                                                <option <?php echo ($value == 'Intermediate') ? 'selected ="TRUE"' : ''; ?> value="Intermediate">Intermediate </option>
                                                                                                <option <?php echo ($value == 'Resistant') ? 'selected ="TRUE"' : ''; ?> value="Resistant">Resistant </option>

                                                                                            </select>
                                                                                        </td>

                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                            }


                                                                            if (isset($key) and !empty($key)) {
                                                                                if ($key == 'tet') {   ?>
                                                                                    <tr>
                                                                                        <td><b> TETRACYCLINE </b> </td>
                                                                                        <td>
                                                                                            <select class="form-control" style="width: 250px;" name="tet">
                                                                                                <option value=""></option>
                                                                                                <option <?php echo ($value == 'Sensitive') ? 'selected ="TRUE"' : ''; ?> value="Sensitive">Sensitive</option>
                                                                                                <option <?php echo ($value == 'Intermediate') ? 'selected ="TRUE"' : ''; ?> value="Intermediate">Intermediate </option>
                                                                                                <option <?php echo ($value == 'Resistant') ? 'selected ="TRUE"' : ''; ?> value="Resistant">Resistant </option>

                                                                                            </select>
                                                                                        </td>

                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                            }


                                                                            if (isset($key) and !empty($key)) {
                                                                                if ($key == 'amo') {   ?>
                                                                                    <tr>
                                                                                        <td><b> AMOXYCLAV </b> </td>
                                                                                        <td>
                                                                                            <select class="form-control" style="width: 250px;" name="amo">
                                                                                                <option value=""></option>
                                                                                                <option <?php echo ($value == 'Sensitive') ? 'selected ="TRUE"' : ''; ?> value="Sensitive">Sensitive</option>
                                                                                                <option <?php echo ($value == 'Intermediate') ? 'selected ="TRUE"' : ''; ?> value="Intermediate">Intermediate </option>
                                                                                                <option <?php echo ($value == 'Resistant') ? 'selected ="TRUE"' : ''; ?> value="Resistant">Resistant </option>

                                                                                            </select>
                                                                                        </td>

                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                            }


                                                                            if (isset($key) and !empty($key)) {
                                                                                if ($key == 'ofl') {   ?>
                                                                                    <tr>
                                                                                        <td><b> OFLOXACIN </b> </td>
                                                                                        <td>
                                                                                            <select class="form-control" style="width: 250px;" name="ofl">
                                                                                                <option value=""></option>
                                                                                                <option <?php echo ($value == 'Sensitive') ? 'selected ="TRUE"' : ''; ?> value="Sensitive">Sensitive</option>
                                                                                                <option <?php echo ($value == 'Intermediate') ? 'selected ="TRUE"' : ''; ?> value="Intermediate">Intermediate </option>
                                                                                                <option <?php echo ($value == 'Resistant') ? 'selected ="TRUE"' : ''; ?> value="Resistant">Resistant </option>

                                                                                            </select>
                                                                                        </td>

                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                            }


                                                                            if (isset($key) and !empty($key)) {
                                                                                if ($key == 'cip') {   ?>
                                                                                    <tr>
                                                                                        <td><b> CIPROFLOXACIN </b> </td>
                                                                                        <td>
                                                                                            <select class="form-control" style="width: 250px;" name="cip">
                                                                                                <option value=""></option>
                                                                                                <option <?php echo ($value == 'Sensitive') ? 'selected ="TRUE"' : ''; ?> value="Sensitive">Sensitive</option>
                                                                                                <option <?php echo ($value == 'Intermediate') ? 'selected ="TRUE"' : ''; ?> value="Intermediate">Intermediate </option>
                                                                                                <option <?php echo ($value == 'Resistant') ? 'selected ="TRUE"' : ''; ?> value="Resistant">Resistant </option>

                                                                                            </select>
                                                                                        </td>

                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                            }


                                                                            if (isset($key) and !empty($key)) {
                                                                                if ($key == 'cefta') {   ?>
                                                                                    <tr>
                                                                                        <td><b> CEFTAZIDIME </b> </td>
                                                                                        <td>
                                                                                            <select class="form-control" style="width: 250px;" name="cefta">
                                                                                                <option value=""></option>
                                                                                                <option <?php echo ($value == 'Sensitive') ? 'selected ="TRUE"' : ''; ?> value="Sensitive">Sensitive</option>
                                                                                                <option <?php echo ($value == 'Intermediate') ? 'selected ="TRUE"' : ''; ?> value="Intermediate">Intermediate </option>
                                                                                                <option <?php echo ($value == 'Resistant') ? 'selected ="TRUE"' : ''; ?> value="Resistant">Resistant </option>

                                                                                            </select>
                                                                                        </td>

                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                            }


                                                                            if (isset($key) and !empty($key)) {
                                                                                if ($key == 'cefu') {   ?>
                                                                                    <tr>
                                                                                        <td><b> CEFUROXIME </b> </td>
                                                                                        <td>
                                                                                            <select class="form-control" style="width: 250px;" name="cefu">
                                                                                                <option value=""></option>
                                                                                                <option <?php echo ($value == 'Sensitive') ? 'selected ="TRUE"' : ''; ?> value="Sensitive">Sensitive</option>
                                                                                                <option <?php echo ($value == 'Intermediate') ? 'selected ="TRUE"' : ''; ?> value="Intermediate">Intermediate </option>
                                                                                                <option <?php echo ($value == 'Resistant') ? 'selected ="TRUE"' : ''; ?> value="Resistant">Resistant </option>

                                                                                            </select>
                                                                                        </td>

                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                            }


                                                                            if (isset($key) and !empty($key)) {
                                                                                if ($key == 'nitro') {   ?>
                                                                                    <tr>
                                                                                        <td><b> NITROFURANTOIN </b> </td>
                                                                                        <td>
                                                                                            <select class="form-control" style="width: 250px;" name="nitro">
                                                                                                <option value=""></option>
                                                                                                <option <?php echo ($value == 'Sensitive') ? 'selected ="TRUE"' : ''; ?> value="Sensitive">Sensitive</option>
                                                                                                <option <?php echo ($value == 'Intermediate') ? 'selected ="TRUE"' : ''; ?> value="Intermediate">Intermediate </option>
                                                                                                <option <?php echo ($value == 'Resistant') ? 'selected ="TRUE"' : ''; ?> value="Resistant">Resistant </option>

                                                                                            </select>
                                                                                        </td>

                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                            }


                                                                            if (isset($key) and !empty($key)) {
                                                                                if ($key == 'amp') {   ?>
                                                                                    <tr>
                                                                                        <td><b> AMPICILLIN </b> </td>
                                                                                        <td>
                                                                                            <select class="form-control" style="width: 250px;" name="amp">
                                                                                                <option value=""></option>
                                                                                                <option <?php echo ($value == 'Sensitive') ? 'selected ="TRUE"' : ''; ?> value="Sensitive">Sensitive</option>
                                                                                                <option <?php echo ($value == 'Intermediate') ? 'selected ="TRUE"' : ''; ?> value="Intermediate">Intermediate </option>
                                                                                                <option <?php echo ($value == 'Resistant') ? 'selected ="TRUE"' : ''; ?> value="Resistant">Resistant </option>

                                                                                            </select>
                                                                                        </td>

                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                            }



                                                                            if (isset($key) and !empty($key)) {
                                                                                if ($key == 'ery') {   ?>
                                                                                    <tr>
                                                                                        <td><b> ERYTHROMYCIN </b> </td>
                                                                                        <td>
                                                                                            <select class="form-control" style="width: 250px;" name="ery">
                                                                                                <option value=""></option>
                                                                                                <option <?php echo ($value == 'Sensitive') ? 'selected ="TRUE"' : ''; ?> value="Sensitive">Sensitive</option>
                                                                                                <option <?php echo ($value == 'Intermediate') ? 'selected ="TRUE"' : ''; ?> value="Intermediate">Intermediate </option>
                                                                                                <option <?php echo ($value == 'Resistant') ? 'selected ="TRUE"' : ''; ?> value="Resistant">Resistant </option>

                                                                                            </select>
                                                                                        </td>

                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                            }


                                                                            if (isset($key) and !empty($key)) {
                                                                                if ($key == 'clo') {   ?>
                                                                                    <tr>
                                                                                        <td><b> CLOXICILLIN </b> </td>
                                                                                        <td>
                                                                                            <select class="form-control" style="width: 250px;" name="clo">
                                                                                                <option value=""></option>
                                                                                                <option <?php echo ($value == 'Sensitive') ? 'selected ="TRUE"' : ''; ?> value="Sensitive">Sensitive</option>
                                                                                                <option <?php echo ($value == 'Intermediate') ? 'selected ="TRUE"' : ''; ?> value="Intermediate">Intermediate </option>
                                                                                                <option <?php echo ($value == 'Resistant') ? 'selected ="TRUE"' : ''; ?> value="Resistant">Resistant </option>

                                                                                            </select>
                                                                                        </td>

                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                            }


                                                                            if (isset($key) and !empty($key)) {
                                                                                if ($key == 'aug') {   ?>
                                                                                    <tr>
                                                                                        <td><b> AUGUMENTIN </b> </td>
                                                                                        <td>
                                                                                            <select class="form-control" style="width: 250px;" name="aug">
                                                                                                <option value=""></option>
                                                                                                <option <?php echo ($value == 'Sensitive') ? 'selected ="TRUE"' : ''; ?> value="Sensitive">Sensitive</option>
                                                                                                <option <?php echo ($value == 'Intermediate') ? 'selected ="TRUE"' : ''; ?> value="Intermediate">Intermediate </option>
                                                                                                <option <?php echo ($value == 'Resistant') ? 'selected ="TRUE"' : ''; ?> value="Resistant">Resistant </option>

                                                                                            </select>
                                                                                        </td>

                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                            }
                                                                        } ?>


                                                                        <tr>
                                                                            <td colspan="2" style="text-align: center"><b> EXTRA ANTIBIOTICS </b> </td>
                                                                        </tr>



                                                                        <tr>
                                                                            <td><b> <input class="form-control" value="<?php echo $anti_one; ?>" name="anti_one" /> </b> </td>
                                                                            <td>
                                                                                <select class="form-control" style="width: 250px;" name="anti_one_res">
                                                                                    <option value=""></option>
                                                                                    <option value="Sensitive">Sensitive</option>
                                                                                    <option value="Intermediate">Intermediate</option>
                                                                                    <option value="Resistant">Resistant</option>
                                                                                </select>

                                                                            </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td><b> <input class="form-control" value="<?php echo $anti_two; ?>" name="anti_two" /> </b> </td>
                                                                            <td>
                                                                                <select class="form-control" style="width: 250px;" name="anti_two_res">
                                                                                    <option value=""></option>
                                                                                    <option value="Sensitive">Sensitive</option>
                                                                                    <option value="Intermediate">Intermediate</option>
                                                                                    <option value="Resistant">Resistant</option>
                                                                                </select>

                                                                            </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td><b> <input class="form-control" value="<?php echo $anti_three; ?>" name="anti_three" /> </b> </td>
                                                                            <td>
                                                                                <select class="form-control" style="width: 250px;" name="anti_three_res">
                                                                                    <option value=""></option>
                                                                                    <option value="Sensitive">Sensitive</option>
                                                                                    <option value="Intermediate">Intermediate</option>
                                                                                    <option value="Resistant">Resistant</option>
                                                                                </select>

                                                                            </td>
                                                                        </tr>



                                                                    </table>

                                                                </table>




                                                            </div>

                                                        </div>
                                                        <?php
                                                        foreach ($decode as $key => $value) {

                                                            if (isset($key) and !empty($key)) {
                                                                if ($key == 'comment') {   ?>
                                                                    <b> Comment </b>
                                                                    <textarea class="form-control" cols="4" rows="2" name="comment"><?php echo $value; ?></textarea>
                                                                    <br />
                                                                    <?php
                                                                }
                                                            }

                                                            if (isset($key) and !empty($key)) {
                                                                if ($key == 'stool_analysis') {   ?>
                                                                    <b> STOOL ANALYSIS (MACROSCOPY) </b>
                                                                    <textarea class="form-control" cols="4" rows="2" name="stool_analysis"><?php echo $value; ?></textarea>
                                                                    <br />
                                                                    <?php
                                                                }
                                                            }
                                                        } ?>


                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <table>


                                                                    <table class="table table-bordered">








                                                                        <tr>
                                                                            <td colspan="2" style="text-align: center"><b> GRAM REACTION </b></td>
                                                                        </tr>

                                                                        <?php
                                                                        foreach ($decode as $key => $value) {

                                                                            if (isset($key) and !empty($key)) {
                                                                                if ($key == 'spu_pus_cells') {   ?>
                                                                                    <tr>
                                                                                        <td> <b> Pus Cell </b> </td>
                                                                                        <td>
                                                                                            <input class="form-control" value="<?php echo $value; ?>" name="spu_pus_cells" />
                                                                                        </td>
                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                            }


                                                                            if (isset($key) and !empty($key)) {
                                                                                if ($key == 'spu_yeast_cells') {   ?>
                                                                                    <tr>
                                                                                        <td> <b> Yeast Cell </b> </td>
                                                                                        <td>
                                                                                            <input class="form-control" value="<?php echo $value; ?>" name="spu_yeast_cells" />
                                                                                        </td>
                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                            }


                                                                            if (isset($key) and !empty($key)) {
                                                                                if ($key == 'spu_epith') {   ?>
                                                                                    <tr>
                                                                                        <td> <b> Epithelia Cell </b> </td>
                                                                                        <td>
                                                                                            <input class="form-control" value="<?php echo $value; ?>" name="spu_epith" />
                                                                                        </td>
                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                            }


                                                                            if (isset($key) and !empty($key)) {
                                                                                if ($key == 'spu_pos') {   ?>
                                                                                    <tr>
                                                                                        <td> <b> Gram Positive Cocci </b> </td>
                                                                                        <td>
                                                                                            <input class="form-control" value="<?php echo $value; ?>" name="spu_pos" />
                                                                                        </td>
                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                            }


                                                                            if (isset($key) and !empty($key)) {
                                                                                if ($key == 'spu_neg') {   ?>
                                                                                    <tr>
                                                                                        <td> <b> Gram Negative Baccili </b> </td>
                                                                                        <td>
                                                                                            <input class="form-control" value="<?php echo $value; ?>" name="spu_neg" />
                                                                                        </td>
                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                            }


                                                                            if (isset($key) and !empty($key)) {
                                                                                if ($key == 'spu_pos_rod') {   ?>
                                                                                    <tr>
                                                                                        <td> <b> Gram Positive Rod </b> </td>
                                                                                        <td>
                                                                                            <input class="form-control" value="<?php echo $value; ?>" name="spu_pos_rod" />
                                                                                        </td>
                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                            }


                                                                            if (isset($key) and !empty($key)) {
                                                                                if ($key == 'spu_neg_cocci') {   ?>
                                                                                    <tr>
                                                                                        <td> <b> Gram Negative Cocci </b> </td>
                                                                                        <td>
                                                                                            <input class="form-control" value="<?php echo $value; ?>" name="spu_neg_cocci" />
                                                                                        </td>
                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                            }


                                                                            if (isset($key) and !empty($key)) {
                                                                                if ($key == 'spu_culture') {   ?>
                                                                                    <tr>
                                                                                        <td> <b> Culture </b> </td>
                                                                                        <td>
                                                                                            <textarea class="form-control" cols="4" rows="3" name="spu_culture"><?php echo $value; ?></textarea>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                            }
                                                                        } ?>



                                                                    </table>
                                                                </table>

                                                            </div>
                                                            <div class="col-md-6">




                                                                <table>


                                                                    <table class="table table-bordered">


                                                                        <tr>
                                                                            <td colspan="2" style="text-align: center"><b> BLOOD CULTURE </b></td>
                                                                        </tr>

                                                                        <?php
                                                                        foreach ($decode as $key => $value) {

                                                                            if (isset($key) and !empty($key)) {
                                                                                if ($key == 'prelim') {   ?>
                                                                                    <tr>
                                                                                        <td> <b> Preliminary Result </b> </td>
                                                                                        <td>
                                                                                            <textarea class="form-control" cols="4" rows="3" name="prelim"><?php echo $value ?></textarea>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                            }

                                                                            if (isset($key) and !empty($key)) {
                                                                                if ($key == 'final') {   ?>
                                                                                    <tr>
                                                                                        <td> <b> Final Result </b> </td>
                                                                                        <td>
                                                                                            <textarea class="form-control" cols="4" rows="3" name="final"><?php echo $value ?></textarea>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                            }
                                                                        } ?>



                                                                        <tr>
                                                                            <td colspan="2" style="text-align: center"><b> MYCOLOGY </b> </td>

                                                                        </tr>

                                                                        <?php
                                                                        foreach ($decode as $key => $value) {

                                                                            if (isset($key) and !empty($key)) {
                                                                                if ($key == 'mycology') {   ?>
                                                                                    <tr>
                                                                                        <td> <b> Microscopy </b> </td>
                                                                                        <td>
                                                                                            <textarea class="form-control" cols="4" rows="3" name="mycology"><?php echo $value ?></textarea>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                            }

                                                                            if (isset($key) and !empty($key)) {
                                                                                if ($key == 'mycology_culture') {   ?>
                                                                                    <tr>
                                                                                        <td> <b> Culture </b> </td>
                                                                                        <td>
                                                                                            <textarea class="form-control" cols="4" rows="3" name="mycology_culture"><?php echo $value ?></textarea>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                            }
                                                                        } ?>


                                                                    </table>
                                                                </table>


                                                            </div>
                                                        </div>

                                                        <?php
                                                        foreach ($decode as $key => $value) {

                                                            if (isset($key) and !empty($key)) {
                                                                if ($key == 'notes') {   ?>

                                                                    <b> REMARK </b>
                                                                    <textarea class="form-control" cols="4" rows="3" name="notes"><?php echo $value ?></textarea>
                                                                    <br />

                                                                    <?php
                                                                }
                                                            }
                                                        } ?>


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

                                                <?php
                                            } else {
                                                ?>

                                                <div class="card">
                                                    <div class="card-header">

                                                        Microbiology

                                                    </div>

                                                    <div class="card-body">

                                                        <div class="row">
                                                            <div class="col-md-5">

                                                                <table>


                                                                    <table class="table table-bordered">
                                                                        <tr>
                                                                            <td><b>WIDAL REACTION</b></td>
                                                                            <td colspan="2" style="text-align: center"><b>TITRE</b></td>

                                                                        </tr>

                                                                        <tr>
                                                                            <td><b></b></td>
                                                                            <td style="text-align: center"><b>O</b></td>
                                                                            <td style="text-align: center"><b>H</b></td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td><b>Salmonella Typhi D</b></td>
                                                                            <td style="text-align: center"><b><input class="form-control" name="salmo_d_o" value="<?php echo $salmo_d_o; ?>" type="text"></b></td>
                                                                            <td style="text-align: center"><b><input class="form-control" name="salmo_d_h" value="<?php echo $salmo_d_h; ?>" type="text"></b></td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td><b>Salmonella Paratyphi A</b></td>
                                                                            <td style="text-align: center"><b><input class="form-control" name="salmo_a_o" value="<?php echo $salmo_a_o; ?>" type="text"></b></td>
                                                                            <td style="text-align: center"><b><input class="form-control" name="salmo_a_h" value="<?php echo $salmo_a_h; ?>" type="text"></b></td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td><b>Salmonella Paratyphi B</b></td>
                                                                            <td style="text-align: center"><b><input class="form-control" name="salmo_b_o" value="<?php echo $salmo_b_o; ?>" type="text"></b></td>
                                                                            <td style="text-align: center"><b><input class="form-control" name="salmo_b_h" value="<?php echo $salmo_b_h; ?>" type="text"></b></td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td><b>Salmonella Paratyphi C</b></td>
                                                                            <td style="text-align: center"><b><input class="form-control" name="salmo_c_o" value="<?php echo $salmo_c_o; ?>" type="text"></b></td>
                                                                            <td style="text-align: center"><b><input class="form-control" name="salmo_c_h" value="<?php echo $salmo_c_h; ?>" type="text"></b></td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td><b>Comment</b></td>
                                                                            <td colspan="2" style="text-align: center"><b><textarea class="form-control" cols="4" rows="3" name="widal_comment" <?php echo $widal_comment; ?>></textarea></b></td>

                                                                        </tr>

                                                                        <tr>
                                                                            <td><b>VDRL</b></td>
                                                                            <td colspan="2" style="text-align: center"><b><input class="form-control" name="vdrl" value="<?php echo $vdrl; ?>" type="text"></b></td>

                                                                        </tr>

                                                                        <tr>
                                                                            <td><b>H . Pylori</b></td>
                                                                            <td colspan="2" style="text-align: center"><b><input class="form-control" name="h_pylori" value="<?php echo $h_pylori; ?>" type="text"></b></td>

                                                                        </tr>

                                                                        <tr>
                                                                            <td><b> Others</b></td>
                                                                            <td colspan="2" style="text-align: center"><b><input class="form-control" name="widal_others" value="<?php echo $widal_others; ?>" type="text"></b></td>

                                                                        </tr>




                                                                    </table>

                                                                </table>


                                                            </div>
                                                            <div class="col-md-7">

                                                                <table>


                                                                    <table class="table table-bordered">
                                                                        <tr>
                                                                            <td style="text-align: center"><b>SEMEN ANALYSIS M/C/S</b></td>
                                                                            <td style="text-align: center"><b>MICROSCOPY</b></td>
                                                                            <td style="text-align: center"><b>Sperm Count/ml</b><input class="form-control" value="<?php echo $mot_sperm_count; ?>" name="mot_sperm_count" /></td>
                                                                            <!--  <td style="text-align: center"><b>MOTILITY</b></td>  -->

                                                                        </tr>

                                                                        <tr>
                                                                            <td><b>Collection Date</b><input class="form-control" id="col_date" value="<?php echo $date_col; ?>" name="date_col" /> </td>
                                                                            <td><b>Pus Cell</b><input class="form-control" value="<?php echo $micro_pus_cell; ?>" name="micro_pus_cell" /></td>
                                                                            <td style="text-align: center"><b>MOTILITY</b></td>
                                                                            <!-- <td style="text-align: center"><b>% Slightly Active</b><input class="form-control" value="<?php echo $mot_sli_active; ?>" name="mot_sli_active" /></td>
                                                                -->

                                                                        </tr>

                                                                        <!--
                                                                        <div class="col-lg-3 col-md-6">
                                                                            <b>Time (12 hour)</b>
                                                                            <div class="input-group mb-3">
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text"><i class="icon-clock"></i></span>
                                                                                </div>
                                                                                <input type="text" class="form-control time12" placeholder="Ex: 11:59 pm">
                                                                            </div>
                                                                        </div>
                                                                        -->

                                                                        <tr>
                                                                            <td><b> Time Collected</b><input class="form-control time12" placeholder="Ex: 11:59 pm" id="col_time" value="<?php echo $time_col; ?>" name="time_col" /> </td>
                                                                            <td> </td>
                                                                            <td style="text-align: center"><b>Motile
                                                                                    <!-- % Fully Active --></b><input class="form-control" value="<?php echo $mot_fully_active; ?>" name="mot_fully_active" /></td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td><b> Time Received</b><input class="form-control" id="rec_time" value="<?php echo $time_rec; ?>" name="time_rec" /> </td>
                                                                            <td></td>
                                                                            <td style="text-align: center"><b>Non-motile</b><input class="form-control" value="<?php echo $mot_dead; ?>" name="mot_dead" /></td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td><b> Time Examined</b><input class="form-control" id="ex_time" value="<?php echo $time_ex; ?>" name="time_ex" /> </td>
                                                                            <td></td>
                                                                            <td style="text-align: center"><b>PROGRESSION</b></td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td><b>Abstinence Period</b><input class="form-control" value="<?php echo $ab_period; ?>" name="ab_period" /> </td>
                                                                            <td></td>
                                                                            <td style="text-align: center"><b>Active</b><input class="form-control" value="<?php echo $abnormal; ?>" name="abnormal" /></td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td><b> Mode of Collection</b><input class="form-control" value="<?php echo $mode_of_col; ?>" name="mode_of_col" /> </td>
                                                                            <td></td>
                                                                            <td style="text-align: center"><b>Sluggish</b><input class="form-control" value="<?php echo $normal; ?>" name="normal" /></td>
                                                                        </tr>


                                                                        <tr>
                                                                            <td><b> Volume</b><input class="form-control" value="<?php echo $volume; ?>" name="volume" /></td>
                                                                            <td></td>
                                                                            <td style="text-align: center"><b> MORPHOLOGY </b> <!-- <input class="form-control" value="<?php echo $mot_morphology; ?>" name="mot_morphology" /> -->
                                                                            </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td><b> Viscousity</b><input class="form-control" value="<?php echo $viscosity; ?>" name="viscosity" /> </td>
                                                                            <td></td>
                                                                            <td style="text-align: center"><b>Abnormal</b><input class="form-control" value="<?php echo $abnormal; ?>" name="abnormal" /></td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td> <b> Appearance</b><input class="form-control" value="<?php echo $appearance; ?>" name="appearance" /> </td>
                                                                            <td></td>
                                                                            <td style="text-align: center"><b>Normal</b><input class="form-control" value="<?php echo $normal; ?>" name="normal" /></td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td style="text-align: center"><b> Culture</b><textarea class="form-control" cols="4" rows="3" name="sperm_culture" <?php echo $sperm_culture; ?>></textarea> </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td style="text-align: center"><b> Comment</b> <textarea class="form-control" cols="4" rows="3" name="sperm_comment" <?php echo $sperm_comment; ?>></textarea> </td>
                                                                        </tr>


                                                                    </table>

                                                                </table>

                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6">

                                                                <table>


                                                                    <table class="table table-bordered">
                                                                        <tr>
                                                                            <td colspan="2" style="text-align: center"><b> URINE MICROSCOPY </b></td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td><b> Pus Cell </b> </td>
                                                                            <td><input class="form-control" value="<?php echo $pus_cell; ?>" name="pus_cell" /></td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td><b> RBC </b> </td>
                                                                            <td><input class="form-control" value="<?php echo $rbc; ?>" name="rbc" /></td>
                                                                        </tr>

                                                                        <!--
                                                            <tr>
                                                                <td><b> S.Haematobium </b> </td>
                                                                <td><input class="form-control" value="<?php echo $s_haem; ?>" name="s_haem" /></td>
                                                            </tr>

                                                            <tr>
                                                                <td><b> Casts </b> </td>
                                                                <td><input class="form-control" value="<?php echo $casts; ?>" name="casts" /></td>
                                                            </tr>
                                                            -->

                                                                        <tr>
                                                                            <td><b> Crystals </b> </td>
                                                                            <td><input class="form-control" value="<?php echo $crystals; ?>" name="crystals" /></td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td><b> Yeast </b> </td>
                                                                            <td><input class="form-control" value="<?php echo $yeast; ?>" name="yeast" /></td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td><b> Bacteria </b> </td>
                                                                            <td><input class="form-control" value="<?php echo $bacteria; ?>" name="bacteria" /></td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td><b> T.Vaginalis </b> </td>
                                                                            <td><input class="form-control" value="<?php echo $t_vaginalis; ?>" name="t_vaginalis" /></td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td><b> Epithelia Cell </b> </td>
                                                                            <td><input class="form-control" value="<?php echo $epith_cell; ?>" name="epith_cell" /></td>
                                                                        </tr>

                                                                        <!--
                                                            <tr>
                                                                <td><b> Clue Cell </b> </td>
                                                                <td><input class="form-control" value="<?php echo $clue_cell; ?>" name="clue_cell" /></td>
                                                            </tr>
                                                            -->

                                                                        <tr>
                                                                            <td><b> Others </b> </td>
                                                                            <td><input class="form-control" value="<?php echo $others; ?>" name="others" /></td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td colspan="2" style="text-align: center"><b> SWAB/MISCELLANEOUS </b></td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td><b> SPUTUM M/C/S
                                                                                    <!-- WOUND, EYE, EAR  --> </b></td>
                                                                            <td>

                                                                                <select class="form-control" name="sputum">
                                                                                    <option value=""></option>
                                                                                    <option value="ECS m/c/s">ECS m/c/s</option>
                                                                                    <option value="Urethral Swab m/c/s">Urethral Swab m/c/s</option>
                                                                                    <option value="Wound Swab m/c/s">Wound Swab m/c/s</option>
                                                                                    <option value="Sputum Swab m/c/s">Sputum Swab m/c/s</option>
                                                                                    <option value="Ear Swab m/c/s">Ear Swab m/c/s</option>
                                                                                    <option value="Eye Swab m/c/s">Eye Swab m/c/s</option>
                                                                                    <option value="Aspirate m/c/s">Aspirate m/c/s</option>
                                                                                    <option value="Thoracic Swab m/c/s">Thoracic Swab m/c/s</option>
                                                                                    <option value="Nasal Swab m/c/s">Nasal Swab m/c/s</option>
                                                                                    <option value="Skin Swab m/c/s">Skin Swab m/c/s</option>
                                                                                    <option value="Pus m/c/s">Pus m/c/s</option>
                                                                                    <option value="Mouth Swab m/c/s">Mouth Swab m/c/s</option>
                                                                                    <option value="Catheter tip m/c/s">Catheter tip m/c/s</option>
                                                                                    <option value="IUD m/c/s">IUD m/c/s</option>
                                                                                    <option value="Ulcer material m/c/s">Ulcer material m/c/s</option>
                                                                                </select>

                                                                            </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td>
                                                                                <!--<input class="form-control" value="<?php echo $sputum; ?>" name="sputum"/> --> <b>Others</b></td>
                                                                            <td><input class="form-control" value="<?php echo $spu_others; ?>" name="spu_others" /></td>
                                                                        </tr>

                                                                        <tr>

                                                                            <td colspan="3"><b> Rbc </b><input class="form-control" value="<?php echo $micro_rbc; ?>" name="micro_rbc" /></td>

                                                                        </tr>

                                                                        <tr>

                                                                            <td colspan="3"><b> Epith Cell </b><input class="form-control" value="<?php echo $micro_epith; ?>" name="micro_epith" /></td>

                                                                        </tr>

                                                                        <tr>

                                                                            <td colspan="3"><b> Bacteria </b><input class="form-control" value="<?php echo $micro_bacteria; ?>" name="micro_bacteria" /></td>

                                                                        </tr>

                                                                        <tr>

                                                                            <td colspan="3"><b> S.Haematolobium </b><input class="form-control" value="<?php echo $micro_s_haem; ?>" name="micro_s_haem" /></td>

                                                                        </tr>

                                                                        <tr>

                                                                            <td colspan="3"><b> T.Vaginalis </b><input class="form-control" value="<?php echo $micro_t_v; ?>" name="micro_t_v" /></td>

                                                                        </tr>

                                                                        <tr>

                                                                            <td colspan="3"><b> Yeast </b><input class="form-control" value="<?php echo $micro_yeast; ?>" name="micro_yeast" /></td>

                                                                        </tr>



                                                                        <tr>
                                                                            <td colspan="3"><b> Pus Cell </b><input class="form-control" value="<?php echo $urine_pus_cell; ?>" name="urine_pus_cell" /></td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td colspan="3"><b> Cast </b><input class="form-control" value="<?php echo $urine_cast; ?>" name="urine_cast" /></td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td colspan="3"><b> Crystals </b><input class="form-control" value="<?php echo $urine_crystals; ?>" name="urine_crystals" /></td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td colspan="3"><b> Organisms </b><input class="form-control" value="<?php echo $urine_organism; ?>" name="urine_organism" /></td>
                                                                        </tr>




                                                                        <tr>
                                                                            <td colspan="3"><b> Culture </b> <textarea class="form-control" cols="4" rows="3" name="urine_micro_culture" <?php echo $urine_micro_culture; ?>></textarea></td>

                                                                        </tr>

                                                                    </table>

                                                                </table>

                                                            </div>

                                                            <div class="col-md-6">

                                                                <table>


                                                                    <table class="table table-bordered">
                                                                        <tr>
                                                                            <td style="text-align: center"><b> SENSITIVITY </b></td>
                                                                            <td style="text-align: center"><b> RESULTS </b> </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td><b> CEFIXIME </b> </td>
                                                                            <td>
                                                                                <!-- <input class="form-control" value="<?php echo $mip; ?>" name="mip"/> -->
                                                                                <select class="form-control" style="width: 250px;" name="mip">
                                                                                    <option value=""></option>
                                                                                    <option value="Sensitive">Sensitive</option>
                                                                                    <option value="Intermediate">Intermediate</option>
                                                                                    <option value="Resistant">Resistant</option>
                                                                                </select>

                                                                            </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td><b> CEFTRIAXONE </b> </td>
                                                                            <td>
                                                                                <!-- <input class="form-control" value="<?php echo $cefri; ?>" name="cefri"/>  -->

                                                                                <select class="form-control" style="width: 250px;" name="cefri">
                                                                                    <option value=""></option>
                                                                                    <option value="Sensitive">Sensitive</option>
                                                                                    <option value="Intermediate">Intermediate</option>
                                                                                    <option value="Resistant">Resistant</option>
                                                                                </select>

                                                                            </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td><b> GENTAMICIN </b> </td>
                                                                            <td>
                                                                                <!-- <input class="form-control" value="<?php echo $gent; ?>" name="gent"/> -->

                                                                                <select class="form-control" style="width: 250px;" name="gent">
                                                                                    <option value=""></option>
                                                                                    <option value="Sensitive">Sensitive</option>
                                                                                    <option value="Intermediate">Intermediate</option>
                                                                                    <option value="Resistant">Resistant</option>
                                                                                </select>

                                                                            </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td><b> CO-TRIMOXAZOLE </b> </td>
                                                                            <td>
                                                                                <!-- <input class="form-control" value="<?php echo $cot; ?>" name="cot"/>  -->

                                                                                <select class="form-control" style="width: 250px;" name="cot">
                                                                                    <option value=""></option>
                                                                                    <option value="Sensitive">Sensitive</option>
                                                                                    <option value="Intermediate">Intermediate</option>
                                                                                    <option value="Resistant">Resistant</option>
                                                                                </select>

                                                                            </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td><b> LEVOFLOXACIN </b> </td>
                                                                            <td>
                                                                                <!-- <input class="form-control" value="<?php echo $lev; ?>" name="lev"/>  -->

                                                                                <select class="form-control" style="width: 250px;" name="lev">
                                                                                    <option value=""></option>
                                                                                    <option value="Sensitive">Sensitive</option>
                                                                                    <option value="Intermediate">Intermediate</option>
                                                                                    <option value="Resistant">Resistant</option>
                                                                                </select>

                                                                            </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td><b> NETILLIN </b> </td>
                                                                            <td>
                                                                                <!-- <input class="form-control" value="<?php echo $net; ?>" name="net"/>  -->

                                                                                <select class="form-control" style="width: 250px;" name="net">
                                                                                    <option value=""></option>
                                                                                    <option value="Sensitive">Sensitive</option>
                                                                                    <option value="Intermediate">Intermediate</option>
                                                                                    <option value="Resistant">Resistant</option>
                                                                                </select>

                                                                            </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td><b> TETRACYCLINE </b> </td>
                                                                            <td>
                                                                                <!-- <input class="form-control" value="<?php echo $tet; ?>" name="tet"/>  -->

                                                                                <select class="form-control" style="width: 250px;" name="tet">
                                                                                    <option value=""></option>
                                                                                    <option value="Sensitive">Sensitive</option>
                                                                                    <option value="Intermediate">Intermediate</option>
                                                                                    <option value="Resistant">Resistant</option>
                                                                                </select>

                                                                            </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td><b> AMOXYCLAV </b> </td>
                                                                            <td>
                                                                                <!-- <input class="form-control" value="<?php echo $amo; ?>" name="amo"/>  -->

                                                                                <select class="form-control" style="width: 250px;" name="amo">
                                                                                    <option value=""></option>
                                                                                    <option value="Sensitive">Sensitive</option>
                                                                                    <option value="Intermediate">Intermediate</option>
                                                                                    <option value="Resistant">Resistant</option>
                                                                                </select>

                                                                            </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td><b> OFLOXACIN </b> </td>
                                                                            <td>
                                                                                <!-- <input class="form-control" value="<?php echo $ofl; ?>" name="ofl"/>  -->

                                                                                <select class="form-control" style="width: 250px;" name="ofl">
                                                                                    <option value=""></option>
                                                                                    <option value="Sensitive">Sensitive</option>
                                                                                    <option value="Intermediate">Intermediate</option>
                                                                                    <option value="Resistant">Resistant</option>
                                                                                </select>

                                                                            </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td><b> CIPROFLOXACIN </b> </td>
                                                                            <td>
                                                                                <!-- <input class="form-control" value="<?php echo $cip; ?>" name="cip"/>  -->

                                                                                <select class="form-control" style="width: 250px;" name="cip">
                                                                                    <option value=""></option>
                                                                                    <option value="Sensitive">Sensitive</option>
                                                                                    <option value="Intermediate">Intermediate</option>
                                                                                    <option value="Resistant">Resistant</option>
                                                                                </select>


                                                                            </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td><b> CEFTAZIDIME </b> </td>
                                                                            <td>
                                                                                <!-- <input class="form-control" value="<?php echo $cefta; ?>" name="cefta"/> -->

                                                                                <select class="form-control" style="width: 250px;" name="cefta">
                                                                                    <option value=""></option>
                                                                                    <option value="Sensitive">Sensitive</option>
                                                                                    <option value="Intermediate">Intermediate</option>
                                                                                    <option value="Resistant">Resistant</option>
                                                                                </select>

                                                                            </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td><b> CEFUROXIME </b> </td>
                                                                            <td>
                                                                                <!-- <input class="form-control" value="<?php echo $cefu; ?>" name="cefu"/>  -->

                                                                                <select class="form-control" style="width: 250px;" name="cefu">
                                                                                    <option value=""></option>
                                                                                    <option value="Sensitive">Sensitive</option>
                                                                                    <option value="Intermediate">Intermediate</option>
                                                                                    <option value="Resistant">Resistant</option>
                                                                                </select>

                                                                            </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td><b> NITROFURANTOIN </b> </td>
                                                                            <td>
                                                                                <!-- <input class="form-control" value="<?php echo $nitro; ?>" name="nitro"/>  -->

                                                                                <select class="form-control" style="width: 250px;" name="nitro">
                                                                                    <option value=""></option>
                                                                                    <option value="Sensitive">Sensitive</option>
                                                                                    <option value="Intermediate">Intermediate</option>
                                                                                    <option value="Resistant">Resistant</option>
                                                                                </select>

                                                                            </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td><b> AMPICILLIN </b> </td>
                                                                            <td>
                                                                                <!-- <input class="form-control" value="<?php echo $amp; ?>" name="amp"/> -->

                                                                                <select class="form-control" style="width: 250px;" name="amp">
                                                                                    <option value=""></option>
                                                                                    <option value="Sensitive">Sensitive</option>
                                                                                    <option value="Intermediate">Intermediate</option>
                                                                                    <option value="Resistant">Resistant</option>
                                                                                </select>

                                                                            </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td><b> ERYTHROMYCIN </b> </td>
                                                                            <td>
                                                                                <!-- <input class="form-control" value="<?php echo $ery; ?>" name="ery"/> -->

                                                                                <select class="form-control" style="width: 250px;" name="ery">
                                                                                    <option value=""></option>
                                                                                    <option value="Sensitive">Sensitive</option>
                                                                                    <option value="Intermediate">Intermediate</option>
                                                                                    <option value="Resistant">Resistant</option>
                                                                                </select>

                                                                            </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td><b> CLOXICILLIN </b> </td>
                                                                            <td>
                                                                                <!-- <input class="form-control" value="<?php echo $clo; ?>" name="clo"/>  -->

                                                                                <select class="form-control" style="width: 250px;" name="clo">
                                                                                    <option value=""></option>
                                                                                    <option value="Sensitive">Sensitive</option>
                                                                                    <option value="Intermediate">Intermediate</option>
                                                                                    <option value="Resistant">Resistant</option>
                                                                                </select>

                                                                            </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td><b> AUGUMENTIN </b> </td>
                                                                            <td>
                                                                                <!-- <input class="form-control" value="<?php echo $aug; ?>" name="aug"/>  -->

                                                                                <select class="form-control" style="width: 250px;" name="aug">
                                                                                    <option value=""></option>
                                                                                    <option value="Sensitive">Sensitive</option>
                                                                                    <option value="Intermediate">Intermediate</option>
                                                                                    <option value="Resistant">Resistant</option>
                                                                                </select>

                                                                            </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td colspan="2" style="text-align: center"><b> EXTRA ANTIBIOTICS </b> </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td><b> <input class="form-control" value="<?php echo $anti_one; ?>" name="anti_one" /> </b> </td>
                                                                            <td>
                                                                                <select class="form-control" style="width: 250px;" name="anti_one_res">
                                                                                    <option value=""></option>
                                                                                    <option value="Sensitive">Sensitive</option>
                                                                                    <option value="Intermediate">Intermediate</option>
                                                                                    <option value="Resistant">Resistant</option>
                                                                                </select>

                                                                            </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td><b> <input class="form-control" value="<?php echo $anti_two; ?>" name="anti_two" /> </b> </td>
                                                                            <td>
                                                                                <select class="form-control" style="width: 250px;" name="anti_two_res">
                                                                                    <option value=""></option>
                                                                                    <option value="Sensitive">Sensitive</option>
                                                                                    <option value="Intermediate">Intermediate</option>
                                                                                    <option value="Resistant">Resistant</option>
                                                                                </select>

                                                                            </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td><b> <input class="form-control" value="<?php echo $anti_three; ?>" name="anti_three" /> </b> </td>
                                                                            <td>
                                                                                <select class="form-control" style="width: 250px;" name="anti_three_res">
                                                                                    <option value=""></option>
                                                                                    <option value="Sensitive">Sensitive</option>
                                                                                    <option value="Intermediate">Intermediate</option>
                                                                                    <option value="Resistant">Resistant</option>
                                                                                </select>

                                                                            </td>
                                                                        </tr>



                                                                    </table>

                                                                </table>




                                                            </div>

                                                        </div>

                                                        <b>Comment </b>
                                                        <textarea class="form-control" cols="4" rows="2" name="comment" <?php echo $comment; ?>></textarea>
                                                        <br />
                                                        <b>STOOL ANALYSIS (MACROSCOPY) </b>
                                                        <textarea class="form-control" cols="4" rows="2" name="stool_analysis" <?php echo $stool_analysis; ?>></textarea>
                                                        <br />

                                                        <!--
                                            <b>Skin Snip for Oncho </b>
                                            <textarea class="form-control" cols="4" rows="2" name="skin_snip" <?php echo $skin_snip; ?>></textarea>
                                            <br />
                                            -->

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <table>


                                                                    <table class="table table-bordered">

                                                                        <!--
                                                            <tr>
                                                                <td><b> SPUTUM M/C/S
                                                                         </b></td>
                                                                <td>

                                                                    <select class="form-control" name="sputum">
                                                                        <option value=""></option>
                                                                        <option value="ECS m/c/s">ECS m/c/s</option>
                                                                        <option value="Urethral Swab m/c/s">Urethral Swab m/c/s</option>
                                                                        <option value="Wound Swab m/c/s">Wound Swab m/c/s</option>
                                                                        <option value="Sputum Swab m/c/s">Sputum Swab m/c/s</option>
                                                                        <option value="Ear Swab m/c/s">Ear Swab m/c/s</option>
                                                                        <option value="Eye Swab m/c/s">Eye Swab m/c/s</option>
                                                                        <option value="Aspirate m/c/s">Aspirate m/c/s</option>
                                                                        <option value="Thoracic Swab m/c/s">Thoracic Swab m/c/s</option>
                                                                        <option value="Nasal Swab m/c/s">Nasal Swab m/c/s</option>
                                                                        <option value="Skin Swab m/c/s">Skin Swab m/c/s</option>
                                                                        <option value="Pus m/c/s">Pus m/c/s</option>
                                                                        <option value="Mouth Swab m/c/s">Mouth Swab m/c/s</option>
                                                                        <option value="Catheter tip m/c/s">Catheter tip m/c/s</option>
                                                                        <option value="IUD m/c/s">IUD m/c/s</option>
                                                                        <option value="Ulcer material m/c/s">Ulcer material m/c/s</option>
                                                                    </select>

                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>
                                                                 <b>Others</b></td>
                                                                <td><input class="form-control" value="<?php echo $spu_others; ?>" name="spu_others" /></td>
                                                            </tr>
                                                            -->

                                                                        <tr>
                                                                            <td colspan="2" style="text-align: center"><b> GRAM REACTION </b></td>
                                                                        </tr>

                                                                        <!--
                                                                                <tr>
                                                                                    <td><b> INVESTIGATION</b> </td>
                                                                                    <td>
                                                                                        <select class="form-control"  name="sputum">
                                                                                            <option value=""></option>
                                                                                            <option value="ECS m/c/s">ECS m/c/s</option>
                                                                                            <option value="Urethral Swab m/c/s">Urethral Swab m/c/s</option>
                                                                                            <option  value="Wound Swab m/c/s">Wound Swab m/c/s</option>
                                                                                            <option value="Sputum Swab m/c/s">Sputum Swab m/c/s</option>
                                                                                            <option value="Ear Swab m/c/s">Ear Swab m/c/s</option>
                                                                                            <option  value="Eye Swab m/c/s">Eye Swab m/c/s</option>
                                                                                            <option value="Aspirate m/c/s">Aspirate m/c/s</option>
                                                                                            <option value="Thoracic Swab m/c/s">Thoracic Swab m/c/s</option>
                                                                                            <option  value="Nasal Swab m/c/s">Nasal Swab m/c/s</option>
                                                                                            <option  value="Skin Swab m/c/s">Skin Swab m/c/s</option>
                                                                                            <option value="Pus m/c/s">Pus m/c/s</option>
                                                                                            <option value="Mouth Swab m/c/s">Mouth Swab m/c/s</option>
                                                                                            <option  value="Catheter tip m/c/s">Catheter tip m/c/s</option>
                                                                                            <option value="IUD m/c/s">IUD m/c/s</option>
                                                                                            <option  value="Ulcer material m/c/s">Ulcer material m/c/s</option>
                                                                                        </select>
                                                                                    </td>
                                                                                </tr>  -->

                                                                        <tr>
                                                                            <td><b> Pus Cell </b> </td>
                                                                            <td><input class="form-control" value="<?php echo $spu_pus_cells; ?>" name="spu_pus_cells" /></td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td><b> Yeast Cell </b> </td>
                                                                            <td><input class="form-control" value="<?php echo $spu_yeast_cells; ?>" name="spu_yeast_cells" /></td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td><b> Epithelia Cell </b> </td>
                                                                            <td><input class="form-control" value="<?php echo $spu_epith; ?>" name="spu_epith" /></td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td><b> Gram Positive Cocci </b> </td>
                                                                            <td><input class="form-control" value="<?php echo $spu_pos; ?>" name="spu_pos" /></td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td><b> Gram Negative Baccili </b> </td>
                                                                            <td><input class="form-control" value="<?php echo $spu_neg; ?>" name="spu_neg" /></td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td><b> Gram Positive Rod </b> </td>
                                                                            <td><input class="form-control" value="<?php echo $spu_pos_rod; ?>" name="spu_pos_rod" /></td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td><b> Gram Negative Cocci </b> </td>
                                                                            <td><input class="form-control" value="<?php echo $spu_neg_cocci; ?>" name="spu_neg_cocci" /></td>
                                                                        </tr>


                                                                        <tr>
                                                                            <td><b> Culture</b> </td>
                                                                            <td>
                                                                                <!-- <input class="form-control" value="<?php // echo $spu_culture;
                                                                                ?>" name="spu_culture"/>  -->
                                                                                <textarea class="form-control" cols="4" rows="3" name="spu_culture" <?php echo $spu_culture; ?>></textarea>
                                                                            </td>
                                                                        </tr>



                                                                    </table>
                                                                </table>

                                                            </div>
                                                            <div class="col-md-6">




                                                                <table>


                                                                    <table class="table table-bordered">


                                                                        <tr>
                                                                            <td colspan="2" style="text-align: center"><b> BLOOD CULTURE </b></td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td><b> Preliminary Result </b> </td>
                                                                            <td>
                                                                                <!--  <input class="form-control" value="<?php // echo $prelim;
                                                                                ?>" name="prelim"/>  -->
                                                                                <textarea class="form-control" cols="4" rows="3" name="prelim" <?php echo $prelim; ?>></textarea>
                                                                            </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td><b> Final Result </b> </td>
                                                                            <td>
                                                                                <!-- <input class="form-control" value="<?php // echo $final;
                                                                                ?>" name="final"/>  -->
                                                                                <textarea class="form-control" cols="4" rows="3" name="final" <?php echo $final; ?>></textarea>
                                                                            </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td colspan="2" style="text-align: center"><b> MYCOLOGY </b> </td>

                                                                        </tr>

                                                                        <tr>
                                                                            <td><b> Microscopy </b> </td>
                                                                            <td><input class="form-control" value="<?php echo $mycology; ?>" name="mycology" /></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><b> Culture </b> </td>
                                                                            <td><textarea class="form-control" cols="4" rows="3" name="mycology_culture" <?php echo $mycology_culture; ?>></textarea></td>
                                                                        </tr>



                                                                    </table>
                                                                </table>


                                                            </div>
                                                        </div>

                                                        <b>REMARK </b>
                                                        <textarea class="form-control" cols="4" rows="6" name="notes" <?php echo $notes; ?>></textarea>
                                                        <br />


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


                                            <?php }  ?>


                                        </div>

                                        <div class="tab-pane" id="Home-withicon">


                                            <?php
                                            $result->resultData;
                                            $decode = json_decode($result->resultData);

                                            if (isset($result->resultData) and !empty($result->resultData)) {
                                                ?>
                                                <div class="card-body">

                                                    <div class="row">

                                                        <div class="col-md-6">

                                                            <table class="table ">
                                                                <thead>
                                                                <tr>
                                                                    <th>Stool Analysis </th>
                                                                    <th></th>

                                                                </tr>
                                                                </thead>
                                                                <tbody>

                                                                <?php
                                                                foreach ($decode as $key => $value) {

                                                                    if (isset($key) and !empty($key)) {
                                                                        if ($key == 'macroscopy') {   ?>
                                                                            <tr>
                                                                                <td>Macroscopy</td>
                                                                                <td> <input class="form-control" value="<?php echo $value; ?>" name="macroscopy" /> </td>
                                                                            </tr>
                                                                            <?php
                                                                        }
                                                                    }



                                                                    if (isset($key) and !empty($key)) {
                                                                        if ($key == 'microscopy') {   ?>
                                                                            <tr>
                                                                                <td> Microscopy </td>
                                                                                <td> <input class="form-control" value="<?php echo $value; ?>" name="microscopy" /> </td>
                                                                            </tr>
                                                                            <?php
                                                                        }
                                                                    }

                                                                }

                                                                foreach ($decode as $key => $value) {
                                                                    if (isset($key) and !empty($key)) {
                                                                        if ($key == 'others') {   ?>
                                                                            <tr>
                                                                                <td> Others </td>
                                                                                <td> <input class="form-control" value="<?php echo $value; ?>" name="others" /> </td>
                                                                            </tr>
                                                                            <?php
                                                                        }
                                                                    } }


                                                                ?>

                                                                </tbody>
                                                            </table>

                                                        </div>

                                                        <div class="col-md-6">

                                                            <table class="table ">
                                                                <thead>
                                                                <tr>

                                                                    <th>Blood Parasites </th>
                                                                    <th></th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>

                                                                <?php
                                                                foreach ($decode as $key => $value) {



                                                                    if (isset($key) and !empty($key)) {
                                                                        if ($key == 'mp') {   ?>
                                                                            <tr>
                                                                                <td>Malaria Parasite</td>
                                                                                <td> <input class="form-control" value="<?php echo $value; ?>" name="mp" /> </td>
                                                                            </tr>
                                                                            <?php
                                                                        }
                                                                    }



                                                                    if (isset($key) and !empty($key)) {
                                                                        if ($key == 'microfilaria') {   ?>
                                                                            <tr>
                                                                                <td> Microfilaria </td>
                                                                                <td> <input class="form-control" value="<?php echo $value; ?>" name="microfilaria" /> </td>
                                                                            </tr>
                                                                            <?php
                                                                        }
                                                                    }



                                                                    if (isset($key) and !empty($key)) {
                                                                        if ($key == 'Trypanosomes') {   ?>
                                                                            <tr>
                                                                                <td> Trypanosomes </td>
                                                                                <td> <input class="form-control" value="<?php echo $value; ?>" name="trypanosomes" /> </td>
                                                                            </tr>
                                                                            <?php
                                                                        }
                                                                    }


                                                                }





                                                                ?>

                                                                </tbody>
                                                            </table>

                                                        </div>

                                                    </div>





                                                    <div class="row">

                                                        <div class="col-md-12">

                                                            <table class="table ">

                                                                <tbody>

                                                                <?php
                                                                foreach ($decode as $key => $value) {

                                                                    if (isset($value) and !empty($value)) {
                                                                        if ($key == 'skin_snip') {
                                                                            echo "<tr>";
                                                                            echo "<td colspan='2'><b> Skin Snip </b></td>";
                                                                            echo "</tr>";
                                                                        }
                                                                    }


                                                                    if (isset($value) and !empty($value)) {
                                                                        if ($key == 'skin_snip') {
                                                                            echo "<tr>";
                                                                            echo "<td colspan='2'>$value</td>";
                                                                            echo "</tr>";
                                                                        }
                                                                    }


                                                                }  ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                                    <table class="table">

                                                        <thead>
                                                        <tr>
                                                            <td colspan="6" style="text-align: center"> <b>SPUTUM ANALYSIS</b> </td>
                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                        <?php
                                                        foreach ($decode as $key => $value) {

                                                            if (isset($key) and !empty($key)) {
                                                                if ($key == 'sputum_macro') {   ?>
                                                                    <tr>
                                                                        <td>Macroscopy</td>
                                                                        <td colspan="4"> <input class="form-control" value="<?php echo $value; ?>" name="sputum_macro" /> </td>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                            }


                                                            if (isset($key) and !empty($key)) {
                                                                if ($key == 'sputum_micro') {   ?>
                                                                    <tr>
                                                                        <td>Microscopy</td>
                                                                        <td colspan="4"> <input class="form-control" value="<?php echo $value; ?>" name="sputum_micro" /> </td>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                            }




                                                        }

                                                        foreach ($decode as $key => $value) {

                                                            if (isset($key) and !empty($key)) {
                                                                if ($key == 'notes') {   ?>
                                                                    <tr>
                                                                        <td colspan="6"><textarea class="form-control" cols="150" rows="6" name="notes" placeholder="Remarks"><?php echo $value ?></textarea></td>
                                                                        <!-- <td colspan="6"><textarea class="form-control" cols="50" rows="6" name="notes" placeholder="Note"><?php echo $value ?></textarea></td>-->
                                                                    </tr>
                                                                    <?php
                                                                }
                                                            }

                                                        }



                                                        ?>


                                                        </tbody>

                                                    </table>
                                                    <p class="margin-top-30">

                                                        <button type="submit" name="prelim_save" class="btn btn-lg btn-primary"> Preliminary Save</button> &nbsp;&nbsp;
                                                        <button type="submit" name="final_save" class="btn btn-lg btn-success">Final Save</button>
                                                    </p>

                                                </div>
                                                <?php
                                            } else {
                                                ?>
                                                <div class="card-body">

                                                    <table class="table ">
                                                        <thead>
                                                        <tr>
                                                            <th>Stool Analysis </th>
                                                            <th></th>
                                                            <th>Blood Parasites </th>
                                                            <th></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td>Macroscopy</td>
                                                            <td> <input class="form-control" value="<?php echo $macroscopy; ?>" name="macroscopy" /> </td>
                                                            <td>Malaria Parasite</td>
                                                            <td> <input class="form-control" value="<?php echo $mp; ?>" name="mp" /> </td>
                                                        </tr>


                                                        <tr>
                                                            <td>Microscopy</td>
                                                            <td> <input class="form-control" value="<?php echo $microscopy; ?>" name="microscopy" /> </td>
                                                            <td>Microfilaria</td>
                                                            <td> <input class="form-control" value="<?php echo $microfilaria; ?>" name="microfilaria" /> </td>
                                                        </tr>

                                                        <tr>
                                                            <td> Others </td>
                                                            <td> <input class="form-control" value="<?php echo $others; ?>" name="others" /> </td>
                                                            <td>Trypanosomes</td>
                                                            <td> <input class="form-control" value="<?php echo $trypanosomes; ?>" name="trypanosomes" /> </td>
                                                        </tr>

                                                        <thead>
                                                        <tr>
                                                            <td colspan="6" style="text-align: center"><b> SKIN SNIP </b> </td>
                                                        </tr>
                                                        </thead>

                                                        <tr>


                                                            <!-- <td>Skin snip</td>  -->
                                                            <td colspan="6"> <input class="form-control" value="<?php echo $skin_snip; ?>" name="skin_snip" /> </td>
                                                        </tr>

                                                        <tr>
                                                            <td>
                                                                <!-- <h4> Cysts  </h4> -->
                                                            </td>
                                                            <td>
                                                                <!-- <input class="form-control" value="<?php echo $cysts; ?>"  name="cysts"/> -->
                                                            </td>
                                                            <td><b></b></td>
                                                            <td></td>
                                                        </tr>

                                                        </tbody>
                                                    </table>


                                                    <table class="table">

                                                        <thead>
                                                        <tr>
                                                            <td colspan="6" style="text-align: center"> <b> SPUTUM ANALYSIS </b> </td>
                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                        <tr>
                                                            <td> Macroscopy </td>
                                                            <td> <input class="form-control" value="<?php echo $sputum_macro; ?>" name="sputum_macro" /> </td>
                                                            <td>Microscopy</td>
                                                            <td>
                                                            <td> <input class="form-control" value="<?php echo $sputum_micro; ?>" name="sputum_micro" /> </td>
                                                            </td>

                                                        </tr>


                                                        <tr>
                                                            <td colspan="4"><textarea class="form-control" cols="150" rows="6" name="notes" placeholder="Remarks"></textarea></td>
                                                        </tr>


                                                        </tbody>

                                                    </table>
                                                    <p class="margin-top-30">
                                                        <button type="submit" name="prelim_save" class="btn btn-lg btn-primary"> Preliminary Save</button> &nbsp;&nbsp;
                                                        <button type="submit" name="final_save" class="btn btn-lg btn-success">Final Save</button>
                                                    </p>

                                                </div>

                                            <?php }  ?>



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
    </div>











<?php

require('../layout/footer.php');
