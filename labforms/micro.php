<?php

/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/17/2019
 * Time: 4:43 PM
 */


require_once("../includes/initialize.php");





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

                                <h4 style="text-align: center">OBAFEMI AWOLOWO UNIVERSITY TEACHING HOSPITALS COMPLEX, ILE-IFE</h4>
                                <h6 style="text-align: center">DEPARTMENT OF MEDICAL MICROBIOLOGY AND PARASITOLOGY</h6>
                                <h6 style="text-align: center">MICROBIOLOGY FORM</h6>


                                <form action="" method="post">


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
                                                                    <td colspan="3" style="text-align: center"><b>SEROLOGY</b></td>
                                                                </tr>
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
                                                                    <td><b> <i>T.vaginalis</i>  </b> </td>
                                                                    <td><input class="form-control" value="<?php echo $t_vaginalis; ?>" name="t_vaginalis" /></td>
                                                                </tr>

                                                                <tr>
                                                                    <td><b> Epithelia Cell </b> </td>
                                                                    <td><input class="form-control" value="<?php echo $epith_cell; ?>" name="epith_cell" /></td>
                                                                </tr>

                                                                <tr>
                                                                    <td><b> Cast </b> </td>
                                                                    <td><input class="form-control" value="<?php echo $urine_cast; ?>" name="urine_cast" /></td>
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

                                                                    <td colspan="3"><b> <i>S.haematobium</i>  </b><input class="form-control" value="<?php echo $micro_s_haem; ?>" name="micro_s_haem" /></td>

                                                                </tr>

                                                                <tr>

                                                                    <td colspan="3"><b> <i>T.vaginalis</i>  </b><input class="form-control" value="<?php echo $micro_t_v; ?>" name="micro_t_v" /></td>

                                                                </tr>

                                                                <tr>

                                                                    <td colspan="3"><b> Yeast </b><input class="form-control" value="<?php echo $micro_yeast; ?>" name="micro_yeast" /></td>

                                                                </tr>



                                                                <tr>
                                                                    <td colspan="3"><b> Pus Cell </b><input class="form-control" value="<?php echo $urine_pus_cell; ?>" name="urine_pus_cell" /></td>
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
