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
                                <h6 style="text-align: center">CHEMICAL PATHOLOGY FORM</h6>


                                <form action="" method="post">

                                        <div class="card">
                                            <div class="card-header">

                                                Chemical Pathology

                                            </div>

                                            <div class="card-body">

                                                <div class="row">

                                                    <div class="col-md-7">

                                                        <div class="table-responsive">

                                                            <table class="table table-bordered">
                                                                <tr>
                                                                    <td><b>Blood Investigation</b></td>
                                                                    <td><b>Result</b></td>
                                                                    <td><b>Unit</b></td>
                                                                    <td><b>Reference</b></td>
                                                                </tr>

                                                                <tr>
                                                                    <td><b>Electrolyte</b></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Sodium</td>
                                                                    <td><input class="form-control" name="sodium" value="<?php echo $sodium; ?>" type="text">
                                                                    </td>
                                                                    <td>mmol/l</td>
                                                                    <td>136 - 145</td>

                                                                </tr>

                                                                <tr>
                                                                    <td>Potassium</td>
                                                                    <td><input class="form-control" name="potassium" value="<?php echo $potassium; ?>" type="text"></td>
                                                                    <td>mmol/l</td>
                                                                    <td>3.0 - 5.0</td>
                                                                </tr>


                                                                <tr>
                                                                    <td>Chloride</td>
                                                                    <td><input class="form-control" name="chloride" value="<?php echo $chloride; ?>" type="text"></td>
                                                                    <td>mmol/l</td>
                                                                    <td>95 - 110</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Lithium</td>
                                                                    <td><input class="form-control" name="lithium" value="<?php echo $lithium; ?>" type="text"></td>
                                                                    <td>mmol/l</td>
                                                                    <td>1</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Bicarbonate</td>
                                                                    <td><input class="form-control" name="bicarbonate" value="<?php echo $bicarbonate; ?>" type="text"></td>
                                                                    <td>mmol/l</td>
                                                                    <td>20 - 30</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Ionized Calcium</td>
                                                                    <td><input class="form-control" name="ionized_calcium" value="<?php echo $ionized_calcium; ?>" type="text"></td>
                                                                    <td>mmol/l</td>
                                                                    <td>0.11 - 1.23</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Inorganic Phos</td>
                                                                    <td><input class="form-control" name="inorganic_phos" value="<?php echo $inorganic_phos; ?>" type="text"></td>
                                                                    <td>mmol/l</td>
                                                                    <td>0.80 - 1.60</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Phosphorus</td>
                                                                    <td><input class="form-control" name="phosphorus" value="<?php echo $phosphorus; ?>" type="text"></td>
                                                                    <td>mg/dll</td>
                                                                    <td>0.3 - 1.5</td>
                                                                </tr>

                                                                <tr>
                                                                    <td><b>Renal Function Test</b></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Urea</td>
                                                                    <td><input class="form-control" name="urea" type="text"></td>
                                                                    <td>mmol/l</td>
                                                                    <td>2.5 - 5.8</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Creatinine</td>
                                                                    <td><input class="form-control" name="creatinine" value="<?php echo $creatinine; ?>" type="text"></td>
                                                                    <td>µmol/l</td>
                                                                    <td>44 - 132</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Uric Acid</td>
                                                                    <td><input class="form-control" name="uric_acid" value="<?php echo $uric_acid; ?>" type="text"></td>
                                                                    <td>mmol/l</td>
                                                                    <td>M(202-416) F(142-330)</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Calcium</td>
                                                                    <td><input class="form-control" name="calcium" value="<?php echo $calcium; ?>" type="text">
                                                                    </td>
                                                                    <td>mmol/l</td>
                                                                    <td>2.2 - 2.7</td>
                                                                </tr>

                                                                <tr>
                                                                    <td><b>Liver Function Test</b></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Total Bilirubin</td>
                                                                    <td><input class="form-control" name="total_bilirubin" value="<?php echo $total_bilirubin; ?>" type="text"></td>
                                                                    <td>µmol/L</td>
                                                                    <td>1.71 - 17.1</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Conj. Bilirubin</td>
                                                                    <td><input class="form-control" name="conj_bilirubin" value="<?php echo $conj_bilirubin; ?>" type="text"></td>
                                                                    <td>µmol/L</td>
                                                                    <td>1.7 - 8.5</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>ALK. Phosphatase</td>
                                                                    <td><input class="form-control" name="alk_phosphate" value="<?php echo $alk_phosphate; ?>" type="text"></td>
                                                                    <td>IU/L</td>
                                                                    <td>98 - 279</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>AST. (SGOT)</td>
                                                                    <td><input class="form-control" name="ast" value="<?php echo $ast; ?>" type="text"></td>
                                                                    <td>IU/L</td>
                                                                    <td>0 - 40</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>ALT. (SGPT)</td>
                                                                    <td><input class="form-control" name="alt" value="<?php echo $alt; ?>" type="text"></td>
                                                                    <td>IU/L</td>
                                                                    <td>0 - 40</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Gamma-GT</td>
                                                                    <td><input class="form-control" name="gamma_gt" value="<?php echo $gamma_gt; ?>" type="text"></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Total Protein</td>
                                                                    <td><input class="form-control" name="total_protein" value="<?php echo $total_protein; ?>" type="text"></td>
                                                                    <td>g/dl</td>
                                                                    <td>58 - 80</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Albumin</td>
                                                                    <td><input class="form-control" name="albumin" value="<?php echo $albumin; ?>" type="text">
                                                                    </td>
                                                                    <td>mg/dll</td>
                                                                    <td>35 - 50</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Globulin</td>
                                                                    <td><input class="form-control" name="globulin" value="<?php echo $globulin; ?>" type="text">
                                                                    </td>
                                                                    <td>g/l</td>
                                                                    <td>20 - 45</td>
                                                                </tr>

                                                                <tr>
                                                                    <td><b> Enzymes Markers </b></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Total Acid Phosphatase</td>
                                                                    <td><input class="form-control" name="acid_phosphate" value="<?php echo $acid_phosphate; ?>" type="text"></td>
                                                                    <td>IU/L</td>
                                                                    <td>0 - 11</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Prostatic Acid Phosphatase</td>
                                                                    <td><input class="form-control" name="prostatic" value="<?php echo $prostatic; ?>" type="text"></td>
                                                                    <td>IU/L</td>
                                                                    <td>0 - 0.4</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Amylase</td>
                                                                    <td><input class="form-control" name="amylase" value="<?php echo $amylase; ?>" type="text">
                                                                    </td>
                                                                    <td>IU/L</td>
                                                                    <td></td>
                                                                </tr>

                                                                <tr>
                                                                    <td><b>Cardiac Function Test</b></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>CPK</td>
                                                                    <td><input class="form-control" name="cpk" value="<?php echo $cpk; ?>" type="text"></td>
                                                                    <td>IU/L</td>
                                                                    <td></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>CKMB</td>
                                                                    <td><input class="form-control" name="ck_mb" value="<?php echo $ck_mb; ?>" type="text"></td>
                                                                    <td>U/L</td>
                                                                    <td></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>LDH</td>
                                                                    <td><input class="form-control" name="ldh" value="<?php echo $ldh; ?>" type="text"></td>
                                                                    <td>U/L</td>
                                                                    <td></td>
                                                                </tr>

                                                                <tr>
                                                                    <td><b>Lipid Profile</b></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Total Cholesterol</td>
                                                                    <td><input class="form-control" name="total_cholesterol" value="<?php echo $total_cholesterol; ?>" type="text"></td>
                                                                    <td>mmol/l</td>
                                                                    <td>2.5 - 5.0</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Triglycerides</td>
                                                                    <td><input class="form-control" name="triglycerides" value="<?php echo $triglycerides; ?>" type="text"></td>
                                                                    <td>mmol/L</td>
                                                                    <td>
                                                                        <1.71</td> </tr> <tr>
                                                                    <td>HDL-Cholesterol</td>
                                                                    <td><input class="form-control" name="hdl_cholesterol" value="<?php echo $hdl_cholesterol; ?>" type="text"></td>
                                                                    <td>mmol/L</td>
                                                                    <td>1.06 - 1.52</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>LDL-CHOLESTEROL</td>
                                                                    <td><input class="form-control" name="ldl_cholesterol" value="<?php echo $ldl_cholesterol; ?>" type="text"></td>
                                                                    <td>mmol/L</td>
                                                                    <td>
                                                                        <3.9</td> </tr> <tr>
                                                                    <td><b>Glucose</b></td>
                                                                    <td> </td>

                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Fasting Glucose</td>
                                                                    <td><input class="form-control" name="fasting_glucose" value="<?php echo $fasting_glucose; ?>" type="text"></td>
                                                                    <td>mmol/L</td>
                                                                    <td>2.5 - 5.6</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Glucose (2HPP)</td>
                                                                    <td><input class="form-control" name="hpp" value="<?php echo $hpp; ?>" type="text"></td>
                                                                    <td>mmol/L</td>
                                                                    <td></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Random Glucose</td>
                                                                    <td><input class="form-control" name="random_glucose" value="<?php echo $random_glucose; ?>" type="text"></td>
                                                                    <td>mmol/L</td>
                                                                    <td></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>GLYCATED HAEMOGLOBIN(hbA)</td>
                                                                    <td><input class="form-control" name="hba" value="<?php echo $hbA; ?>" type="text"></td>
                                                                    <td>6-8.3%</td>
                                                                </tr>



                                                                <tr>
                                                                    <td>TIBC</td>
                                                                    <td><input class="form-control" name="tibc" value="<?php echo $tibc; ?>" type="text"></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>G6PD</td>
                                                                    <td><input class="form-control" name="g6pd" value="<?php echo $g6pd; ?>" type="text"></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Lipase</td>
                                                                    <td><input class="form-control" name="lipase" value="<?php echo $lipase; ?>" type="text">
                                                                    </td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>OTHERS (indicate)</td>
                                                                    <td><input class="form-control" name="others" value="<?php echo $others; ?>" type="text">
                                                                    </td>
                                                                    <td></td>
                                                                </tr>

                                                            </table>

                                                        </div>


                                                    </div>

                                                    <div class="col-md-5">

                                                        <div class="table-responsive">

                                                            <table class="table table-bordered">
                                                                <tr>
                                                                    <td colspan="3" style="text-align: center"><b>HORMONAL ASSAY</b></td>

                                                                </tr>

                                                         <!--       <tr>
                                                                    <td>PSA</td>
                                                                    <td colspan="2"><input class="form-control" name="psa" value="<?php /*echo $psa; */?>" type="text"></td>
                                                                </tr>-->


                                                                <tr>
                                                                    <td>T3</td>
                                                                    <td colspan="2"><input class="form-control" name="t3" value="<?php echo $t3; ?>" type="text"></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>T4</td>
                                                                    <td colspan="2"><input class="form-control" name="t4" value="<?php echo $t4; ?>" type="text"></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>fT3</td>
                                                                    <td colspan="2"><input class="form-control" name="t3" value="<?php echo $t3; ?>" type="text"></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>fT4</td>
                                                                    <td colspan="2"><input class="form-control" name="t4" value="<?php echo $t4; ?>" type="text"></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>TSH</td>
                                                                    <td colspan="2"><input class="form-control" name="tsh" value="<?php echo $tsh; ?>" type="text"></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>E2</td>
                                                                    <td colspan="2"><input class="form-control" name="e2" value="<?php echo $e2; ?>" type="text"></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>LH</td>
                                                                    <td colspan="2"><input class="form-control" name="lh" value="<?php echo $lh; ?>" type="text"></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>FSH</td>
                                                                    <td colspan="2"><input class="form-control" name="fsh" value="<?php echo $fsh; ?>" type="text"></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Prolactin</td>
                                                                    <td colspan="2"><input class="form-control" name="prolactin" value="<?php echo $prolactin; ?>" type="text"></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Progesterone</td>
                                                                    <td colspan="2"><input class="form-control" name="progesterone" value="<?php echo $progesterone; ?>" type="text"></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Testosterone</td>
                                                                    <td colspan="2"><input class="form-control" name="testosterone" value="<?php echo $testosterone; ?>" type="text"></td>
                                                                </tr>

                                                                <tr>
                                                                    <td colspan="3" style="text-align: center"><b>TUMOUR MARKERS</b></td>

                                                                </tr>

                                                                <tr>
                                                                    <td>PSA</td>
                                                                    <td colspan="2"><input class="form-control" name="psa" value="<?php echo $psa; ?>" type="text"></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>AFP</td>
                                                                    <td colspan="2"><input class="form-control" name="afp" value="<?php echo $afp; ?>" type="text"></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Beta HCG</td>
                                                                    <td colspan="2"><input class="form-control" name="beta_hcg" value="<?php echo $beta_hcg; ?>" type="text"></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>CEA</td>
                                                                    <td colspan="2"><input class="form-control" name="beta_hcg" value="<?php echo $beta_hcg; ?>" type="text"></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>CRP</td>
                                                                    <td colspan="2"><input class="form-control" name="beta_hcg" value="<?php echo $beta_hcg; ?>" type="text"></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>CORTISOL</td>
                                                                    <td colspan="2"><input class="form-control" name="beta_hcg" value="<?php echo $beta_hcg; ?>" type="text"></td>
                                                                </tr>


                                                                <tr>
                                                                    <td colspan="3" style="text-align: center"><b>URINALYSIS</b></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Protein</td>
                                                                    <td colspan="2"><input class="form-control" name="urine_protein" value="<?php echo $urine_protein; ?>" type="text"></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Glucose</td>
                                                                    <td colspan="2"><input class="form-control" name="urine_glucose" value="<?php echo $urine_glucose; ?>" type="text"></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Blood</td>
                                                                    <td colspan="2"><input class="form-control" name="urine_blood" value="<?php echo $urine_blood; ?>" type="text"></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Bilirubin</td>
                                                                    <td colspan="2"><input class="form-control" name="urine_bilirubin" value="<?php echo $urine_bilirubin; ?>" type="text"></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Urobilinogen</td>
                                                                    <td colspan="2"><input class="form-control" name="urine_urobilinogen" value="<?php echo $urine_urobilinogen; ?>" type="text"></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Ketones</td>
                                                                    <td colspan="2"><input class="form-control" name="urine_ketones" value="<?php echo $urine_ketones; ?>" type="text"></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Ascorbic Acid</td>
                                                                    <td colspan="2"><input class="form-control" name="urine_ascorbic_acid" value="<?php echo $urine_ascorbic_acid; ?>" type="text"></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Nitrite</td>
                                                                    <td colspan="2"><input class="form-control" name="urine_nitrite" value="<?php echo $urine_nitrite; ?>" type="text"></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>pH</td>
                                                                    <td colspan="2"><input class="form-control" name="urine_ph" value="<?php echo $urine_ph; ?>" type="text"></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Sp Gravity</td>
                                                                    <td colspan="2"><input class="form-control" name="urine_sp_gravity" value="<?php echo $urine_sp_gravity; ?>" type="text"></td>
                                                                </tr>

                                                                <tr>
                                                                    <td colspan="3" style="text-align: center"><b>24HRS URINE PROFILE</b></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Sodium</td>
                                                                    <td><input class="form-control" name="sodium" value="<?php echo $sodium; ?>" type="text">
                                                                    </td>
                                                                    <td>136 - 145</td>

                                                                </tr>

                                                                <tr>
                                                                    <td>Potassium</td>
                                                                    <td><input class="form-control" name="potassium" value="<?php echo $potassium; ?>" type="text"></td>
                                                                    <td>3.0 - 5.0</td>
                                                                </tr>


                                                                <tr>
                                                                    <td>Chloride</td>
                                                                    <td><input class="form-control" name="chloride" value="<?php echo $chloride; ?>" type="text"></td>
                                                                    <td>95 - 110</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Lithium</td>
                                                                    <td><input class="form-control" name="lithium" value="<?php echo $lithium; ?>" type="text"></td>
                                                                    <td>1</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Bicarbonate</td>
                                                                    <td><input class="form-control" name="bicarbonate" value="<?php echo $bicarbonate; ?>" type="text"></td>
                                                                    <td>20 - 30</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Ionized Calcium</td>
                                                                    <td><input class="form-control" name="ionized_calcium" value="<?php echo $ionized_calcium; ?>" type="text"></td>
                                                                    <td>0.11 - 1.23</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Inorganic Phos</td>
                                                                    <td><input class="form-control" name="inorganic_phos" value="<?php echo $inorganic_phos; ?>" type="text"></td>
                                                                    <td>0.80 - 1.60</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Phosphorus</td>
                                                                    <td><input class="form-control" name="phosphorus" value="<?php echo $phosphorus; ?>" type="text"></td>
                                                                    <td>0.3 - 1.5</td>
                                                                </tr>

                                                                <tr>
                                                                    <td style="text-align: center"><b>CSF/ECF/ASPIRATES</b></td>
                                                                    <td colspan="2" style="text-align: center"><b>REF. RANGE</b></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Protein</td>
                                                                    <td><input class="form-control" name="csf_protein" value="<?php echo $csf_protein; ?>" type="text"></td>
                                                                    <td>(15-45)mg/dl</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Chloride</td>
                                                                    <td><input class="form-control" name="csf_chloride" value="<?php echo $csf_chloride; ?>" type="text"></td>
                                                                    <td>120 - 130mmol/L</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Glucose</td>
                                                                    <td><input class="form-control" name="csf_glucose" value="<?php echo $csf_glucose; ?>" type="text"></td>
                                                                    <td>(2.8-3.9)mmol/L</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>mg/dl</td>
                                                                    <td colspan="2">Up to 130</td>
                                                                </tr>

                                                                <tr>
                                                                    <td colspan="3" style="text-align: center"><b>Faecal Occult Blood Test:</b></td>
                                                                </tr>

                                                                <tr>
                                                                    <td colspan="3"><input class="form-control" name="faecal" value="<?php echo $faecal; ?>" type="text"></td>
                                                                </tr>



                                                                <tr>
                                                                    <td colspan="3" style="text-align: center"><b>Pregnancy Test</b></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Urine</td>
                                                                    <td colspan="2"><input class="form-control" name="pt_urine" value="<?php echo $pt_urine; ?>" type="text"></td>

                                                                </tr>

                                                                <tr>
                                                                    <td>Blood</td>
                                                                    <td colspan="2"><input class="form-control" name="pt_blood" value="<?php echo $pt_blood; ?>" type="text"></td>

                                                                </tr>

                                                                <tr>
                                                                    <td colspan="3"><b>Notes</b></td>

                                                                </tr>

                                                                <tr>
                                                                    <td colspan="3"><textarea class="form-control" cols="2" rows="6" name="notes"><?php echo $notes; ?></textarea></td>

                                                                </tr>

                                                            </table>

                                                        </div>



                                                    </div>
                                                </div>

                                                <h4 style="text-align: center"> <b>ORAL GLUCOSE TOLERANCE TEST REPORT SHEET</b> </h4>

                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                        <tr>
                                                            <th> </th>
                                                            <th> Fasting</th>
                                                            <th>30 Minutes </th>
                                                            <th>60 Minutes </h4>
                                                            </th>
                                                            <th>90 Minutes </th>
                                                            <th>120 Minutes</th>
                                                            <th>150 Minutes</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td>Blood Glucose Level (mmol/L)</td>
                                                            <td><input class="form-control" value="<?php echo $fasting; ?>" name="fasting" /></td>
                                                            <td> <input class="form-control" value="<?php echo $thirty_min; ?>" name="thirty_min" /> </td>
                                                            <td> <input class="form-control" value="<?php echo $one_hour; ?>" name="one_hour" /> </td>
                                                            <td><input class="form-control" value="<?php echo $ninety_min; ?>" name="ninety_min" /></td>
                                                            <td> <input class="form-control" value="<?php echo $two_hours; ?>" name="two_hours" /> </td>
                                                            <td> <input class="form-control" value="<?php echo $ogtt; ?>" name="ogtt" /> </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Urine Glucose </td>
                                                            <td><input class="form-control" value="<?php echo $fasting_urine; ?>" name="fasting_urine" /></td>
                                                            <td> <input class="form-control" value="<?php echo $thirty_min_urine; ?>" name="thirty_min_urine" /> </td>
                                                            <td> <input class="form-control" value="<?php echo $one_hour_urine; ?>" name="one_hour_urine" /> </td>
                                                            <td><input class="form-control" value="<?php echo $ninety_min_urine; ?>" name="ninety_min_urine" /></td>
                                                            <td> <input class="form-control" value="<?php echo $two_hours_urine; ?>" name="two_hours_urine" /> </td>
                                                            <td> <input class="form-control" value="<?php echo $ogtt_urine; ?>" name="ogtt_urine" /> </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>




                                                <p class="margin-top-30">
                                                    <!--
                                                    <button type="submit" name="save_only" class="btn btn-lg btn-primary">Save Only</button> &nbsp;&nbsp;
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
