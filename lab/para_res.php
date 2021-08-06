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

    if (isset($_POST['save_only'])) {

        $pus_cells       = $_POST['pus_cells'];
        $red_blood_cells = $_POST['red_blood_cells'];
        $starch_granules = $_POST['starch_granules'];
        $ova             = $_POST['ova'];
        $cysts           = $_POST['cysts'];
        $plasmodium      = $_POST['plasmodium'];
        $microfilaria    = $_POST['microfilaria'];
        $trypanosomes    = $_POST['trypanosomes'];
        $macroscopy_clear= $_POST['macroscopy_clear'];
        $colourless      = $_POST['colourless'];
        $turbid          = $_POST['turbid'];
        $ph              = $_POST['ph'];
        $reducing_sub    = $_POST['reducing_sub'];
        $albumin         = $_POST['albumin'];
        $pus_cell_hpf    = $_POST['pus_cell_hpf'];
        $rbes_hpf        = $_POST['rbes_hpf'];
        $epith_cells_hpf = $_POST['epith_cells_hpf'];
        $yeast_cells     = $_POST['yeast_cells'];
        $bacteria        = $_POST['bacteria'];
        $xtals           = $_POST['xtals'];
        $hyaline         = $_POST['hyaline'];
        $granular        = $_POST['granular'];
        $cellular        = $_POST['cellular'];
        $parasites       = $_POST['parasites'];
        $wbes            = $_POST['wbes'];
        $polymorphs      = $_POST['polymorphs'];
        $lymphocytes     = $_POST['lymphocytes'];
        $notes           = $_POST['notes'];
    
        $macroscopy      = $_POST['macroscopy'];
        $microscopy      = $_POST['microscopy'];
        $others          = $_POST['others'];
        $mp              = $_POST['mp'];
        $skin_snip       = $_POST['skin_snip'];
        $sputum_macro    = $_POST['sputum_macro'];
        $sputum_micro    = $_POST['sputum_micro'];


        $para                       = new stdClass();
        $para->PusCells             = $pus_cells;
        $para->RedBloodCells        = $red_blood_cells;
        $para->StarchGranules       = $starch_granules;
        $para->Ova                  = $ova;
        $para->Cysts                = $cysts;
        $para->Plasmodium           = $plasmodium;
        $para->Microfilaria         = $microfilaria;
        $para->Trypanosomes         = $trypanosomes;
        $para->MacroscopyClear      = $macroscopy_clear;
        $para->Colourless           = $colourless;
        $para->Turbid               = $turbid;
        $para->PH                   = $ph;
        $para->ReducingSubstance    = $reducing_sub;
        $para->Albumin              = $albumin;
        $para->PusCellHpf           = $pus_cell_hpf;
        $para->RbesHpf              = $rbes_hpf;
        $para->EpithCellsHpf        = $epith_cells_hpf;
        $para->YeastCells           = $yeast_cells;
        $para->Bacteria             = $bacteria;
        $para->xtals                = $xtals;
        $para->Hyaline              = $hyaline;
        $para->Granular             = $granular;
        $para->Cellular             = $cellular;
        $para->Parasites            = $parasites;
        $para->Wbes                 = $wbes;
        $para->Polymorphs           = $polymorphs;
        $para->lymphocytes          = $lymphocytes;
        $para->notes                = $notes;
        $para->others               = $others;
        $para->macroscopy           = $macroscopy;
        $para->microscopy           = $microscopy;
        $para->mp                   = $mp;
        $para->skin_snip            = $skin_snip;
        $para->sputum_macro         = $sputum_macro;
        $para->sputum_micro         = $sputum_micro;

        $json = json_encode($para);
        echo $json; exit;


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

                                <a href="../lab/results.php">Back</a>

                                <?php // include("../labResults/para_res.php");
                                include("../labResults/para.php");
                                ?>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>











<?php

require('../layout/footer.php');