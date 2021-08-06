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

                                <h4 style="text-align: center">OBAFEMI AWOLOWO UNIVERSITY TEACHING HOSPITALS COMPLEX</h4>
                                <h6 style="text-align: center">HAEMATOLOGY FORM</h6>


                                <form action="" method="post">


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
