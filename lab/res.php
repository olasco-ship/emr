
<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 5/23/2019
 * Time: 9:53 PM
 */


require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}






require('../layout/header.php');
?>


    <div id="main-content">
        <div class="container-fluid">
            <div class="section-heading">
                <h1 class="page-title">Laboratory Result

                </h1>
            </div>

            <form action="" method="post">

                <div class="clearfix">

                    <?php
                       $result = Result::find_by_id($_GET['id']);
                       $patient = Patient::find_by_id($result->patient_id);  echo $patient->full_name();
                    ?>




                    <div class="panel-group" id="accordion">
                        <?php $bills = Bill::find_by_patient_id($patient->id);
                        foreach ($bills as $bill) { ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion"
                                           href="#collapse<?php echo $bill->id; ?>">
                                            <?php $d_date = date('d-M-Y', strtotime($bill->date));
                                            echo $d_date; ?></a>
                                        <a href="#accordion"
                                           class="pull-right"></a>
                                    </div>

                                </div>
                                <div id="collapse<?php echo $bill->id; ?>" class="panel-collapse collapse">
                                    <div class="panel-body">

                                        <div class="row">
                                            <div class="col-md-2"></div>
                                            <div class="col-md-8">
                                                <?php

                                                //    $res = Result::find_by_bill_id($bill->id);
                                                echo "<br/>";
                                                //    echo $res ;
                                                //    $testResult = TestResult::find_by_result_id($result->id);



                                                $testRequest = TestRequest::find_by_bill_id($bill->id);

                                                $start_sec = "00:00:00";
                                                $end_sec = "23:59:59";

                                                $start_date = date_only($bill->date) . " " . $start_sec;
                                                $end_date = date_only($bill->date) . " " . $end_sec;


                                                $results = Result::find_all_result_by_date($patient->id, $start_date, $end_date);


                                                //   $m = TestResult::find_by_result_id($result->id);


                                                ?>


                                                <table>
                                                    <table class="table table-bordered">

                                                        <tr>
                                                            <td></td>
                                                            <td align="center"><b>RESULT</b></td>
                                                            <td><b>REFERENCE</b></td>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->hb) and (!empty($m->hb))) {
                                                                echo "<td><h4> Hb </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->hb type='text' readonly></td>";
                                                                echo "<td>11-16gm/100ml</td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->pcv) and (!empty($m->pcv))) {
                                                                echo "<td><h4> PCV </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->pcv type='text' readonly></td>";
                                                                echo "<td>36-54%</td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->wbc) and (!empty($m->wbc))) {
                                                                echo "<td><h4> WBC </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->pcv type='text' readonly></td>";
                                                                echo "<td>4-10.000/cmm</td>";
                                                            }
                                                            ?>
                                                        </tr>


                                                        <tr>
                                                            <?php
                                                            if (isset($m->esr) and (!empty($m->esr))) {
                                                                echo "<td><h4> ESR </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->esr type='text' readonly></td>";
                                                                echo "<td>0-9mm/hr Westergreen Method</td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->rbc) and (!empty($m->rbc))) {
                                                                echo "<td><h4> RBC </h4> </td>";
                                                                echo "<td ><input class='form-control' value=$m->rbc type='text' readonly></td>";
                                                                echo "<td>4-6mil/ml</td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->mch) and (!empty($m->mch))) {
                                                                echo "<td><h4> MCH </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->mch type='text' readonly></td>";
                                                                echo "<td>27.0-32.0pg</td>";
                                                            }
                                                            ?>
                                                        </tr>


                                                        <tr>
                                                            <?php
                                                            if (isset($m->mchc) and (!empty($m->mchc))) {
                                                                echo "<td><h4> MCHC </h4> </td>";
                                                                echo "<td ><input class='form-control' value=$m->mchc type='text' readonly></td>";
                                                                echo "<td>30.0-35.0</td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->mcv) and (!empty($m->mcv))) {
                                                                echo "<td><h4> MCV </h4> </td>";
                                                                echo "<td ><input class='form-control' value=$m->mcv type='text' readonly></td>";
                                                                echo "<td>78-96cm3</td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->sickling_test) and (!empty($m->sickling_test))) {
                                                                echo "<td><h4> Sickling Test </h4> </td>";
                                                                echo "<td ><input class='form-control' value=$m->sickling_test type='text' readonly></td>";
                                                                echo "<td></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->hb_genotype) and (!empty($m->hb_genotype))) {
                                                                echo "<td><h4> Hb genotype </h4> </td>";
                                                                echo "<td ><input class='form-control' value=$m->hb_genotype type='text' readonly></td>";
                                                                echo "<td></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->blood_group) and (!empty($m->blood_group))) {
                                                                echo "<td><h4> Blood Group </h4> </td>";
                                                                echo "<td ><input class='form-control' value=$m->blood_group type='text' readonly></td>";
                                                                echo "<td></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->retics) and (!empty($m->retics))) {
                                                                echo "<td><h4> Reticulocyte Count </h4> </td>";
                                                                echo "<td ><input class='form-control' value=$m->retics type='text' readonly></td>";
                                                                echo "<td>2-6% Infant 0-2% Adult</td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->g6pd) and (!empty($m->g6pd))) {
                                                                echo "<td><h4> G6PD </h4> </td>";
                                                                echo "<td ><input class='form-control' value=$m->g6pd type='text' readonly></td>";
                                                                echo "<td></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->platelet_count) and (!empty($m->platelet_count))) {
                                                                echo "<td><h4> Platelet Count </h4> </td>";
                                                                echo "<td ><input class='form-control' value=$m->platelet_count type='text' readonly></td>";
                                                                echo "<td>150-400.00cmm</td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->bleeding_time) and (!empty($m->bleeding_time))) {
                                                                echo "<td><h4> Bleeding Time </h4> </td>";
                                                                echo "<td ><input class='form-control' value=$m->bleeding_time type='text' readonly></td>";
                                                                echo "<td>Up to 9minutes</td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->clotting_time) and (!empty($m->clotting_time))) {
                                                                echo "<td><h4> Clotting Time </h4> </td>";
                                                                echo "<td ><input class='form-control' value=$m->clotting_time type='text' readonly></td>";
                                                                echo "<td>5-11minutes</td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->le_cells) and (!empty($m->le_cells))) {
                                                                echo "<td><h4> L.E Cells </h4> </td>";
                                                                echo "<td ><input class='form-control' value=$m->le_cells type='text' readonly></td>";
                                                                echo "<td></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->red_cells_frag) and (!empty($m->red_cells_frag))) {
                                                                echo "<td><h4> Red Cells Fragility  </h4> </td>";
                                                                echo "<td ><input class='form-control' value=$m->red_cells_frag type='text' readonly></td>";
                                                                echo "<td></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->mean_cells_frag) and (!empty($m->mean_cells_frag))) {
                                                                echo "<td><h4> Mean Cell Fragility  </h4> </td>";
                                                                echo "<td ><input class='form-control' value=$m->mean_cells_frag type='text' readonly></td>";
                                                                echo "<td></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->pt) and (!empty($m->pt))) {
                                                                echo "<td><h4> Prothrombin (PT) </h4> </td>";
                                                                echo "<td ><input class='form-control' value=$m->pt type='text' readonly></td>";
                                                                echo "<td>0.4-0.45%</td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->ptc) and (!empty($m->ptc))) {
                                                                echo "<td><h4> Prothn. Time Control </h4> </td>";
                                                                echo "<td ><input class='form-control' value=$m->ptc type='text' readonly></td>";
                                                                echo "<td>secs</td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->pti) and (!empty($m->pti))) {
                                                                echo "<td><h4> PTI</h4> </td>";
                                                                echo "<td ><input class='form-control' value=$m->pti type='text' readonly></td>";
                                                                echo "<td>secs</td>";
                                                            }
                                                            ?>
                                                        </tr>


                                                        <tr>
                                                            <?php
                                                            if (isset($m->wbc_diff) and (!empty($m->wbc_diff))) {
                                                                echo "<td><h4> W.B.C Differential</h4> </td>";
                                                                echo "<td ><input class='form-control' value=$m->wbc_diff type='text' readonly></td>";
                                                                echo "<td></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->neutrophil) and (!empty($m->neutrophil))) {
                                                                echo "<td><h4> Polym. Neutrophils </h4> </td>";
                                                                echo "<td ><input class='form-control' value=$m->neutrophil type='text' readonly></td>";
                                                                echo "<td>40-70%</td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->lymphocyte) and (!empty($m->lymphocyte))) {
                                                                echo "<td><h4> Lymphocytes </h4> </td>";
                                                                echo "<td ><input class='form-control' value=$m->lymphocyte type='text' readonly></td>";
                                                                echo "<td>20-50%</td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->eosinophil) and (!empty($m->eosinophil))) {
                                                                echo "<td><h4> Eosinophils </h4> </td>";
                                                                echo "<td ><input class='form-control' value=$m->eosinophil type='text' readonly></td>";
                                                                echo "<td>1-8%</td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->monocyte) and (!empty($m->monocyte))) {
                                                                echo "<td><h4> Monocyte </h4> </td>";
                                                                echo "<td ><input class='form-control' value=$m->monocyte type='text' readonly></td>";
                                                                echo "<td>2-10%</td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->basophil) and (!empty($m->basophil))) {
                                                                echo "<td><h4> Basophil </h4> </td>";
                                                                echo "<td ><input class='form-control' value=$m->basophil type='text' readonly></td>";
                                                                echo "<td>0-1%</td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->blood_film) and (!empty($m->blood_film))) {
                                                                echo "<td><h4> Blood Film Reports </h4> </td>";
                                                                echo "<td colspan='2'><textarea rows='3' cols='20' class='form-control'   readonly>$m->blood_film</textarea></td>";

                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->ani) and (!empty($m->ani))) {
                                                                echo "<td><h4> Anisocytosis </h4> </td>";
                                                                echo "<td ><input class='form-control' value=$m->basophil type='text' readonly></td>";
                                                                echo "<td></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->poikil) and (!empty($m->poikil))) {
                                                                echo "<td><h4> Poikilocytosis </h4> </td>";
                                                                echo "<td ><input class='form-control' value=$m->poikil type='text' readonly></td>";
                                                                echo "<td></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->poly) and (!empty($m->poly))) {
                                                                echo "<td><h4> Polychromasia </h4> </td>";
                                                                echo "<td ><input class='form-control' value=$m->poly type='text' readonly></td>";
                                                                echo "<td></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->macro) and (!empty($m->macro))) {
                                                                echo "<td><h4> Macrosytosis </h4> </td>";
                                                                echo "<td ><input class='form-control' value=$m->macro type='text' readonly></td>";
                                                                echo "<td></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->micro) and (!empty($m->micro))) {
                                                                echo "<td><h4> Microcytosis </h4> </td>";
                                                                echo "<td ><input class='form-control' value=$m->micro type='text' readonly></td>";
                                                                echo "<td></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->hypo) and (!empty($m->hypo))) {
                                                                echo "<td><h4> Hypochromla </h4> </td>";
                                                                echo "<td ><input class='form-control' value=$m->hypo type='text' readonly></td>";
                                                                echo "<td></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->sickle_cells) and (!empty($m->sickle_cells))) {
                                                                echo "<td><h4> Sickle Cells </h4> </td>";
                                                                echo "<td ><input class='form-control' value=$m->sickle_cells type='text' readonly></td>";
                                                                echo "<td></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->target_cells) and (!empty($m->target_cells))) {
                                                                echo "<td><h4> Target Cells </h4> </td>";
                                                                echo "<td ><input class='form-control' value=$m->target_cells type='text' readonly></td>";
                                                                echo "<td></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->spherocytes) and (!empty($m->spherocytes))) {
                                                                echo "<td><h4> Spherocytes </h4> </td>";
                                                                echo "<td ><input class='form-control' value=$m->spherocytes type='text' readonly></td>";
                                                                echo "<td></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->nucleated) and (!empty($m->nucleated))) {
                                                                echo "<td><h4> Nucleated RBC </h4> </td>";
                                                                echo "<td ><input class='form-control' value=$h->nucleated type='text' readonly></td>";
                                                                echo "<td></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->inclusion) and (!empty($m->inclusion))) {
                                                                echo "<td><h4> Inclusion bodies </h4> </td>";
                                                                echo "<td ><input class='form-control' value=$m->inclusion type='text' readonly></td>";
                                                                echo "<td></td>";
                                                            }
                                                            ?>
                                                        </tr>
                                                    </table>
                                                </table>

                                                <table>
                                                    <table class="table table-bordered">

                                                        <tr>
                                                            <td></td>
                                                            <td align="center"><b>RESULT</b></td>
                                                            <td><b>REFERENCE</b></td>
                                                        </tr>


                                                        <tr>
                                                            <?php
                                                            if (isset($m->rft) and (!empty($m->rft))) {
                                                                echo "<td colspan='3'><h4> $m->rft </h4> </td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->sodium) and (!empty($m->sodium))) {
                                                                echo "<td style='padding-left: 30px'><h4> Sodium </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->sodium type='text' readonly></td>";
                                                                echo "<td>130-145mg/dl</td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->potassium) and (!empty($m->potassium))) {
                                                                echo "<td style='padding-left: 30px'><h4> Potassium </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->potassium type='text' readonly></td>";
                                                                echo "<td>3.5 - 5.5mmol/L</td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->bicarbonate) and (!empty($m->bicarbonate))) {
                                                                echo "<td style='padding-left: 30px'><h4> Bicarbonate </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->bicarbonate type='text' readonly></td>";
                                                                echo "<td>20-30mol/L</td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->chloride) and (!empty($m->chloride))) {
                                                                echo "<td style='padding-left: 30px'><h4> Chloride </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->chloride type='text' readonly></td>";
                                                                echo "<td>95-115mol/L</td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->calcium) and (!empty($m->calcium))) {
                                                                echo "<td style='padding-left: 30px'><h4> Calcium </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->calcium type='text' readonly></td>";
                                                                echo "<td>9-11mg/dl</td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->magnessium) and (!empty($m->magnessium))) {
                                                                echo "<td style='padding-left: 30px'><h4> Magnessium </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->magnessium type='text' readonly></td>";
                                                                echo "<td>0.7 - 1.0mmol/L</td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->phosphorus) and (!empty($m->phosphorus))) {
                                                                echo "<td style='padding-left: 30px'><h4> Phosphorus </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->phosphorus type='text' readonly></td>";
                                                                echo "<td>2.0-4.5mg/dL</td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->urea) and (!empty($m->urea))) {
                                                                echo "<td style='padding-left: 30px'><h4> Urea </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->urea type='text' readonly></td>";
                                                                echo "<td>10-55mg/dl</td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->creatinine) and (!empty($m->creatinine))) {
                                                                echo "<td style='padding-left: 30px'><h4> Creatinine </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->creatinine type='text' readonly></td>";
                                                                echo "<td>0.5-1.2mg/dl</td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->creatinine_clearance) and (!empty($m->creatinine_clearance))) {
                                                                echo "<td style='padding-left: 30px'><h4> Creatinine Clearance </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->creatinine_clearance type='text' readonly></td>";
                                                                echo "<td>90 - 130 ml/min</td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->uric_acid) and (!empty($m->uric_acid))) {
                                                                echo "<td ><h4> Uric Acid </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->uric_acid type='text' readonly></td>";
                                                                echo "<td>4.0-8.0mg/dl</td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->fasting_glucose) and (!empty($m->fasting_glucose))) {
                                                                echo "<td ><h4> Fasting Glucose </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->fasting_glucose type='text' readonly></td>";
                                                                echo "<td>75-115mg/dl</td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->hpp) and (!empty($m->hpp))) {
                                                                echo "<td ><h4> 2HPP </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->hpp type='text' readonly></td>";
                                                                echo "<td>80-180</td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->random_glucose) and (!empty($m->random_glucose))) {
                                                                echo "<td ><h4> Random Glucose  </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->random_glucose type='text' readonly></td>";
                                                                echo "<td>80-180mg/dl</td>";
                                                            }
                                                            ?>
                                                        </tr>


                                                        <tr>
                                                            <?php
                                                            if (isset($m->ogtt) and (!empty($m->ogtt))) {
                                                                echo "<td colspan='3'><h4> $m->ogtt </h4> </td>";
                                                            }
                                                            ?>
                                                        </tr>


                                                        <tr>
                                                            <?php
                                                            if (isset($m->thirty_min) and (!empty($m->thirty_min))) {
                                                                echo "<td style='padding-left: 30px'><h4> 30min </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->thirty_min type='text' readonly></td>";
                                                                echo "<td></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->one_hour) and (!empty($m->one_hour))) {
                                                                echo "<td style='padding-left: 30px'><h4> 1HR </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->one_hour type='text' readonly></td>";
                                                                echo "<td></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->ninety_min) and (!empty($m->ninety_min))) {
                                                                echo "<td style='padding-left: 30px'><h4> 1.5HR </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->ninety_min type='text' readonly></td>";
                                                                echo "<td></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->two_hours) and (!empty($m->two_hours))) {
                                                                echo "<td style='padding-left: 30px'><h4> 2HRS </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->two_hours type='text' readonly></td>";
                                                                echo "<td></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->fasting) and (!empty($m->fasting))) {
                                                                echo "<td style='padding-left: 30px'><h4> 3HRS </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->fasting type='text' readonly></td>";
                                                                echo "<td></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->hbA) and (!empty($m->hbA))) {
                                                                echo "<td ><h4> Glycated Haemoglobin(hbA)  </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->hbA type='text' readonly></td>";
                                                                echo "<td>5.7-6.4%</td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->total_protein) and (!empty($m->total_protein))) {
                                                                echo "<td ><h4> Total Protein  </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->total_protein type='text' readonly></td>";
                                                                echo "<td>6.0-8.0g/dl</td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->albumin) and (!empty($m->albumin))) {
                                                                echo "<td ><h4> Albumin  </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->albumin type='text' readonly></td>";
                                                                echo "<td>3.5-5.0g/dl</td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->total_bilirubin) and (!empty($m->total_bilirubin))) {
                                                                echo "<td ><h4> Total Bilirubin  </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->total_bilirubin type='text' readonly></td>";
                                                                echo "<td>0.2-1.0mg/dl</td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->conj_bilirubin) and (!empty($m->conj_bilirubin))) {
                                                                echo "<td ><h4> Conj. Bilirubin  </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->conj_bilirubin type='text' readonly></td>";
                                                                echo "<td>0.2-0.5mg/dl</td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->unconj_bilirubin) and (!empty($m->unconj_bilirubin))) {
                                                                echo "<td ><h4> Unconj. Bilirubin  </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->unconj_bilirubin type='text' readonly></td>";
                                                                echo "<td>0.2-0.5mg/dl</td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->ast) and (!empty($m->ast))) {
                                                                echo "<td ><h4> AST (SGOT)  </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->ast type='text' readonly></td>";
                                                                echo "<td>1 - 12u/l</td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->alt) and (!empty($m->alt))) {
                                                                echo "<td ><h4> ALT (SGPT)  </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->alt type='text' readonly></td>";
                                                                echo "<td>1 - 12u/l</td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->alk_phosphate) and (!empty($m->alk_phosphate))) {
                                                                echo "<td ><h4> Alk Phosphate  </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->alk_phosphate type='text' readonly></td>";
                                                                echo "<td>98-279iu/l</td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->albumin_ratio) and (!empty($m->albumin_ratio))) {
                                                                echo "<td ><h4> Albumin/Creatinine Ratio </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->albumin_ratio type='text' readonly></td>";
                                                                echo "<td>30-300mg/g</td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->gamma_gt) and (!empty($m->gamma_gt))) {
                                                                echo "<td ><h4> Gamma GT </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->gamma_gt type='text' readonly></td>";
                                                                echo "<td>11 - 52</td>";
                                                            }
                                                            ?>
                                                        </tr>


                                                        <tr>
                                                            <?php
                                                            if (isset($m->acid_phosphate) and (!empty($m->acid_phosphate))) {
                                                                echo "<td colspan='3'><h4> $m->acid_phosphate </h4> </td>";
                                                            }
                                                            ?>
                                                        </tr>


                                                        <tr>
                                                            <?php
                                                            if (isset($m->total) and (!empty($m->total))) {
                                                                echo "<td style='padding-left: 30px'><h4> Total </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->total type='text' readonly></td>";
                                                                echo "<td>01-11U/L</td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->prostatic) and (!empty($m->prostatic))) {
                                                                echo "<td style='padding-left: 30px'><h4> Prostatic </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->prostatic type='text' readonly></td>";
                                                                echo "<td>0.4U/L</td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->ck_mb) and (!empty($m->ck_mb))) {
                                                                echo "<td ><h4> Creatine Kinase (ck-mb) </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->ck_mb type='text' readonly></td>";
                                                                echo "<td>U/L</td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->ldh) and (!empty($m->ldh))) {
                                                                echo "<td ><h4> Lactate Dehydrogenase (LDH) </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->ldh type='text' readonly></td>";
                                                                echo "<td>U/L</td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->amylase) and (!empty($m->amylase))) {
                                                                echo "<td ><h4> Amylase </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->amylase type='text' readonly></td>";
                                                                echo "<td>U/L</td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->cholinesterase) and (!empty($m->cholinesterase))) {
                                                                echo "<td ><h4> Cholinesterase </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->cholinesterase type='text' readonly></td>";
                                                                echo "<td>U/L</td>";
                                                            }
                                                            ?>
                                                        </tr>


                                                        <tr>
                                                            <?php
                                                            if (isset($m->lipid_profile) and (!empty($m->lipid_profile))) {
                                                                echo "<td colspan='3'><h4> $m->lipid_profile </h4> </td>";
                                                            }
                                                            ?>
                                                        </tr>


                                                        <tr>
                                                            <?php
                                                            if (isset($m->total_cholesterol) and (!empty($m->total_cholesterol))) {
                                                                echo "<td style='padding-left: 30px'><h4> Total Cholesterol </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->total_cholesterol type='text' readonly></td>";
                                                                echo "<td>50-200mg/dL</td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->hdl_cholesterol) and (!empty($m->hdl_cholesterol))) {
                                                                echo "<td style='padding-left: 30px'><h4> HDL Cholesterol </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->hdl_cholesterol type='text' readonly></td>";
                                                                echo "<td>25-67mg/dl</td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->ldl_cholesterol) and (!empty($m->ldl_cholesterol))) {
                                                                echo "<td style='padding-left: 30px'><h4> LDL Cholesterol </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->ldl_cholesterol type='text' readonly></td>";
                                                                echo "<td>Up to 130mg/dl</td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->vldl_cholesterol) and (!empty($m->vldl_cholesterol))) {
                                                                echo "<td style='padding-left: 30px'><h4> VLDL Cholesterol </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->vldl_cholesterol type='text' readonly></td>";
                                                                echo "<td>10-40mg/dl</td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->triglycerides) and (!empty($m->triglycerides))) {
                                                                echo "<td style='padding-left: 30px'><h4> Triglycerides </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->triglycerides type='text' readonly></td>";
                                                                echo "<td>50 - 200mg/dl </td>";
                                                            }
                                                            ?>
                                                        </tr>


                                                        <tr>
                                                            <?php
                                                            if (isset($m->csf) and (!empty($m->csf))) {
                                                                echo "<td colspan='3'><h4> $m->csf </h4> </td>";
                                                            }
                                                            ?>
                                                        </tr>


                                                        <tr>
                                                            <?php
                                                            if (isset($m->csf_glucose) and (!empty($m->csf_glucose))) {
                                                                echo "<td style='padding-left: 30px'><h4> Glucose </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->csf_glucose type='text' readonly></td>";
                                                                echo "<td> </td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->csf_protein) and (!empty($m->csf_protein))) {
                                                                echo "<td style='padding-left: 30px'><h4> Protein </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->csf_protein type='text' readonly></td>";
                                                                echo "<td> 55-110mg/dL </td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->csf_chloride) and (!empty($m->csf_chloride))) {
                                                                echo "<td style='padding-left: 30px'><h4> Chloride </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->csf_chloride type='text' readonly></td>";
                                                                echo "<td> 96-110mg/L </td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->urine) and (!empty($m->urine))) {
                                                                echo "<td colspan='3'><h4> $m->urine </h4> </td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->electrolytes) and (!empty($m->electrolytes))) {
                                                                echo "<td style='padding-left: 30px'><h4> Electrolytes </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->electrolytes type='text' readonly></td>";
                                                                echo "<td> mmol/l </td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->protein) and (!empty($m->protein))) {
                                                                echo "<td style='padding-left: 30px'><h4> Protein </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->protein type='text' readonly></td>";
                                                                echo "<td> mmol/l </td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->urine_volume) and (!empty($m->urine_volume))) {
                                                                echo "<td style='padding-left: 30px'><h4> 24HR Urine Volume </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->urine_volume type='text' readonly></td>";
                                                                echo "<td>  </td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->urinary_protein) and (!empty($m->urinary_protein))) {
                                                                echo "<td style='padding-left: 30px'><h4> 24HR Urine Protein </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->urinary_protein type='text' readonly></td>";
                                                                echo "<td> 0.05-0.1g/24hrs </td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->urinary_creatinine) and (!empty($m->urinary_creatinine))) {
                                                                echo "<td style='padding-left: 30px'><h4> 24HR Urine Creatinine </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->urinary_creatinine type='text' readonly></td>";
                                                                echo "<td> 1.0-1.5g/24hrs </td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->others) and (!empty($m->others))) {
                                                                echo "<td style='padding-left: 30px'><h4> Others   </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->others type='text' readonly></td>";
                                                                echo "<td>  </td>";
                                                            }
                                                            ?>
                                                        </tr>
                                                    </table>
                                                </table>

                                                <table>
                                                    <table class="table table-bordered">

                                                        <tr>
                                                            <td></td>
                                                            <td align="center"><b>RESULT</b></td>
                                                        </tr>


                                                        <tr>
                                                            <?php
                                                            if (isset($m->colour) and (!empty($m->colour))) {
                                                                echo "<td colspan='2'><h4> URINALYSIS </h4> </td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->colour) and (!empty($m->colour))) {
                                                                echo "<td style='padding-left: 30px'><h4> Colour </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->colour type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->appearance) and (!empty($m->appearance))) {
                                                                echo "<td style='padding-left: 30px'><h4> Appearance </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->appearance type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->ph) and (!empty($m->ph))) {
                                                                echo "<td style='padding-left: 30px'><h4> pH </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->ph type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->pus_cell) and (!empty($m->pus_cell))) {
                                                                echo "<td style='padding-left: 30px'><h4> Pus Cells </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->pus_cell type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->micro_rbc) and (!empty($m->micro_rbc))) {
                                                                echo "<td style='padding-left: 30px'><h4> RBC </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->micro_rbc type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->ova_cysts) and (!empty($m->ova_cysts))) {
                                                                echo "<td style='padding-left: 30px'><h4> Ova Cysts </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->ova_cysts type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->sg) and (!empty($m->sg))) {
                                                                echo "<td style='padding-left: 30px'><h4> SG </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->sg type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->micro_protein) and (!empty($m->micro_protein))) {
                                                                echo "<td style='padding-left: 30px'><h4> Protein </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->micro_protein type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->glucose) and (!empty($m->glucose))) {
                                                                echo "<td style='padding-left: 30px'><h4> Glucose </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->glucose type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->epith_cell) and (!empty($m->epith_cell))) {
                                                                echo "<td style='padding-left: 30px'><h4> Epith Cells </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->epith_cell type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->casts) and (!empty($m->casts))) {
                                                                echo "<td style='padding-left: 30px'><h4> Casts </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->casts type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->crystals) and (!empty($m->crystals))) {
                                                                echo "<td style='padding-left: 30px'><h4> Crystals </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->crystals type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->ketone) and (!empty($m->ketone))) {
                                                                echo "<td style='padding-left: 30px'><h4> Ketones </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->ketone type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->occ_blood) and (!empty($m->occ_blood))) {
                                                                echo "<td style='padding-left: 30px'><h4> Occ. Blood </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->occ_blood type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->urobilnogen) and (!empty($m->urobilnogen))) {
                                                                echo "<td style='padding-left: 30px'><h4> Urobilnogen </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->urobilnogen type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->nitrite) and (!empty($m->nitrite))) {
                                                                echo "<td style='padding-left: 30px'><h4> Nitrites </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->nitrite type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->bilirubin) and (!empty($m->bilirubin))) {
                                                                echo "<td style='padding-left: 30px'><h4> Bilirubin </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->bilirubin type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->ascorbic_acid) and (!empty($m->ascorbic_acid))) {
                                                                echo "<td style='padding-left: 30px'><h4> Ascorbic Acid </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->ascorbic_acid type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->direct_coombs) and (!empty($m->direct_coombs))) {
                                                                echo "<td colspan='2'><h4> SEROLOGY </h4> </td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->direct_coombs) and (!empty($m->direct_coombs))) {
                                                                echo "<td style='padding-left: 30px'><h4> Direct Coombs </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->direct_coombs type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->indirect_coombs) and (!empty($m->indirect_coombs))) {
                                                                echo "<td style='padding-left: 30px'><h4> Indirect Coombs </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->indirect_coombs type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->heaf) and (!empty($m->heaf))) {
                                                                echo "<td style='padding-left: 30px'><h4> Heaf/Mantoux Test(Blood TB)  </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->heaf type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->hiv_screening) and (!empty($m->hiv_screening))) {
                                                                echo "<td style='padding-left: 30px'><h4> HIV Screening </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->hiv_screening type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->vdrl) and (!empty($m->vdrl))) {
                                                                echo "<td style='padding-left: 30px'><h4> VDRL/KHAN/TPHA/TIPI </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->vdrl type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->r_factor) and (!empty($m->r_factor))) {
                                                                echo "<td style='padding-left: 30px'><h4> Rheumatoid Factor </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->r_factor type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->australian) and (!empty($m->australian))) {
                                                                echo "<td style='padding-left: 30px'><h4> Australian Antigen(HBsAg)  </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->australian type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->hcv) and (!empty($m->hcv))) {
                                                                echo "<td style='padding-left: 30px'><h4> HCV  </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->hcv type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->aso_titre) and (!empty($m->aso_titre))) {
                                                                echo "<td style='padding-left: 30px'><h4> ASO Titre </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->aso_titre type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>
                                                    </table>

                                                </table>

                                                <table>
                                                    <table class="table table-bordered">

                                                        <tr>
                                                            <?php
                                                            if (isset($m->salmo_d_o) and (!empty($m->salmo_d_o))) {
                                                                echo "<td colspan='3' align='center'><h4> WIDAL TEST REPORT </h4> </td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->salmo_d_o) and (!empty($m->salmo_d_o))) {
                                                                echo "<td><h4> Salm Typhi. (D) </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->salmo_d_o type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->salmo_d_h type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->salmo_a_o) and (!empty($m->salmo_a_o))) {
                                                                echo "<td><h4> Salm. Paratyphi A </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->salmo_a_o type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->salmo_a_h type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->salmo_b_o) and (!empty($m->salmo_b_o))) {
                                                                echo "<td><h4> Salm. Paratyphi B </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->salmo_b_o type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->salmo_b_h type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->salmo_c_o) and (!empty($m->salmo_c_o))) {
                                                                echo "<td><h4> Salm. Paratyphi C </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->salmo_c_o type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->salmo_c_h type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->salmo_comment) and (!empty($m->salmo_comment))) {
                                                                echo "<td><h4> Comments </h4> </td>";
                                                                echo "<td colspan='2'><textarea rows='3' cols='20' class='form-control'   readonly>$m->salmo_comment</textarea></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->mp) and (!empty($m->mp))) {
                                                                echo "<td ><h4> Malaria Parasite </h4> </td>";
                                                                echo "<td colspan='2'><input class='form-control'  value=$m->mp type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->micro_pt) and (!empty($m->micro_pt))) {
                                                                echo "<td ><h4> Pregnancy Test  </h4> </td>";
                                                                echo "<td colspan='2'><input class='form-control'  value=$m->micro_pt type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>
                                                    </table>

                                                </table>
                                                <table>
                                                    <table class="table table-bordered">

                                                        <tr>
                                                            <?php
                                                            if (isset($m->mode_of_col) and (!empty($m->mode_of_col))) {
                                                                echo "<td colspan='2' align='center'><h4> SEMINAL FLUID ANALYSIS   </h4> </td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->mode_of_col) and (!empty($m->mode_of_col))) {
                                                                echo "<td ><h4> Date Of Collection  </h4> </td>";
                                                                echo "<td colspan='2'><input class='form-control'  value=$m->date_of_col type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->mode_of_col) and (!empty($m->mode_of_col))) {
                                                                echo "<td ><h4> Mode Of Collection  </h4> </td>";
                                                                echo "<td colspan='2'><input class='form-control'  value=$m->mode_of_col type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->period_of_ab) and (!empty($m->period_of_ab))) {
                                                                echo "<td ><h4> Period Of Abstinence  </h4> </td>";
                                                                echo "<td colspan='2'><input class='form-control'  value=$m->period_of_ab type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if ($m->time_prod != "00:00:00") {

                                                                echo "<td ><h4> Time Produced  </h4> </td>";
                                                                echo "<td colspan='2'><input class='form-control'  value=$m->time_prod type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if ($m->time_rec != "00:00:00") {
                                                                echo "<td ><h4> Time Received  </h4> </td>";
                                                                echo "<td colspan='2'><input class='form-control'  value=$m->time_rec type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if ($m->time_ex != "00:00:00") {
                                                                echo "<td ><h4> Time Examined  </h4> </td>";
                                                                echo "<td colspan='2'><input class='form-control'  value=$m->time_ex type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->sem_colour) and (!empty($m->sem_colour))) {
                                                                echo "<td ><h4> Colour  </h4> </td>";
                                                                echo "<td colspan='2'><input class='form-control'  value=$m->sem_colour type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->sem_ph) and (!empty($m->sem_ph))) {
                                                                echo "<td ><h4> pH  </h4> </td>";
                                                                echo "<td colspan='2'><input class='form-control'  value=$m->sem_ph type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->sem_odour) and (!empty($m->sem_odour))) {
                                                                echo "<td ><h4> Odour  </h4> </td>";
                                                                echo "<td colspan='2'><input class='form-control'  value=$m->sem_odour type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->sem_sluggish) and (!empty($m->sem_sluggish))) {
                                                                echo "<td ><h4> %Sluggish  </h4> </td>";
                                                                echo "<td colspan='2'><input class='form-control'  value=$m->sem_sluggish type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->sem_dead) and (!empty($m->sem_dead))) {
                                                                echo "<td ><h4> %Dead  </h4> </td>";
                                                                echo "<td colspan='2'><input class='form-control'  value=$m->sem_dead type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->sem_vol) and (!empty($m->sem_vol))) {
                                                                echo "<td ><h4> Volume  </h4> </td>";
                                                                echo "<td colspan='2'><input class='form-control'  value=$m->sem_vol type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->sem_total_count) and (!empty($m->sem_total_count))) {
                                                                echo "<td ><h4> Total Count  </h4> </td>";
                                                                echo "<td colspan='2'><input class='form-control'  value=$m->sem_total_count type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->sem_pus_cells) and (!empty($m->sem_pus_cells))) {
                                                                echo "<td ><h4> Micro: Pus Cells  </h4> </td>";
                                                                echo "<td colspan='2'><input class='form-control'  value=$m->sem_pus_cells type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->sem_rbc) and (!empty($m->sem_rbc))) {
                                                                echo "<td ><h4> RBC  </h4> </td>";
                                                                echo "<td colspan='2'><input class='form-control'  value=$m->sem_rbc type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->other_one) and (!empty($m->other_one))) {
                                                                echo "<td ><h4> $m->other_one   </h4> </td>";
                                                                echo "<td colspan='2'><input class='form-control'  value=$m->other_one_res type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->other_two) and (!empty($m->other_two))) {
                                                                echo "<td ><h4> $m->other_two   </h4> </td>";
                                                                echo "<td colspan='2'><input class='form-control'  value=$m->other_two_res type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->other_three) and (!empty($m->other_three))) {
                                                                echo "<td ><h4> $m->other_three   </h4> </td>";
                                                                echo "<td colspan='2'><input class='form-control'  value=$m->other_three_res type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>


                                                    </table>
                                                </table>
                                                <table>
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <?php
                                                            if (isset($m->pef) and (!empty($m->pef))) {
                                                                echo "<td colspan='4' align='center'><h4> CUlTURE ANTIBIOGRAM     </h4> </td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->pef) and (!empty($m->pef))) {
                                                                echo "<td ><h4> PEFLACIN  </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->pef type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->pef2 type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->pef3 type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->zin) and (!empty($m->zin))) {
                                                                echo "<td ><h4> ZINACEFF  </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->zin type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->zin2 type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->zin3 type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->amp) and (!empty($m->amp))) {
                                                                echo "<td ><h4> AMPICILLIN  </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->amp type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->amp2 type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->amp3 type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->clo) and (!empty($m->clo))) {
                                                                echo "<td ><h4> CLOXACILLIN  </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->clo type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->clo2 type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->clo3 type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->chl) and (!empty($m->chl))) {
                                                                echo "<td ><h4> CHLORAMPHENICOL  </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->chl type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->chl2 type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->chl3 type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->cot) and (!empty($m->cot))) {
                                                                echo "<td ><h4> COTRIMOXAZOLE  </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->cot type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->cot2 type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->cot3 type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->gent) and (!empty($m->gent))) {
                                                                echo "<td ><h4> GENTAMYCIN  </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->gent type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->gent2 type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->gent3 type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->tetra) and (!empty($m->tetra))) {
                                                                echo "<td ><h4> TETRACYCLINE  </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->tetra type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->tetra2 type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->tetra3 type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->ery) and (!empty($m->ery))) {
                                                                echo "<td ><h4> ERYTHROMYCIN  </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->ery type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->ery2 type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->ery3 type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->pen) and (!empty($m->pen))) {
                                                                echo "<td ><h4> PENICILLIN  </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->pen type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->pen2 type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->pen3 type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->nitro) and (!empty($m->nitro))) {
                                                                echo "<td ><h4> NITROFURANTION  </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->nitro type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->nitro2 type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->nitro3 type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->nal) and (!empty($m->nal))) {
                                                                echo "<td ><h4> NALIDIXIC ACID  </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->nal type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->nal2 type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->nal3 type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->aug) and (!empty($m->aug))) {
                                                                echo "<td ><h4> AUGMENTIN  </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->aug type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->aug2 type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->aug3 type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->strep) and (!empty($m->strep))) {
                                                                echo "<td ><h4> STREPTOMYCIN  </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->strep type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->strep2 type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->strep3 type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>


                                                        <tr>
                                                            <?php
                                                            if (isset($m->norbactin) and (!empty($m->norbactin))) {
                                                                echo "<td ><h4> NORBACTIN  </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->norbactin type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->norbactin2 type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->norbactin3 type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>


                                                        <tr>
                                                            <?php
                                                            if (isset($m->clin) and (!empty($m->clin))) {
                                                                echo "<td ><h4> CLINDAMYSIN  </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->clin type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->clin2 type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->clin3 type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>


                                                        <tr>
                                                            <?php
                                                            if (isset($m->cef) and (!empty($m->cef))) {
                                                                echo "<td ><h4> CEFTRIAXONE  </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->cef type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->cef2 type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->cef3 type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->cip) and (!empty($m->cip))) {
                                                                echo "<td ><h4> CIPROFLOXACIN  </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->cip type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->cip2 type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->cip3 type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->ofl) and (!empty($m->ofl))) {
                                                                echo "<td ><h4> OFLOXACIN   </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->ofl type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->ofl2 type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->ofl3 type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->azi) and (!empty($m->azi))) {
                                                                echo "<td ><h4> AZITHROMYCIN  </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->azi type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->azi2 type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->azi3 type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->cefto) and (!empty($m->cefto))) {
                                                                echo "<td ><h4> CEFOTAXIME  </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->cefto type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->cefto2 type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->cefto3 type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->levo) and (!empty($m->levo))) {
                                                                echo "<td ><h4> LEVOFLOXACIN  </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->levo type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->levo2 type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->levo3 type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->cefi) and (!empty($m->cefi))) {
                                                                echo "<td ><h4> CEFIXIME  </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->cefi type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->cefi2 type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->cefi3 type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->imi) and (!empty($m->imi))) {
                                                                echo "<td ><h4> IMIPENEM  </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->imi type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->imi2 type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->imi3 type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->cefu) and (!empty($m->cefu))) {
                                                                echo "<td ><h4> CEFUROXIME  </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->cefu type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->cefu2 type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->cefu3 type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>


                                                        <tr>
                                                            <?php
                                                            if (isset($m->anti_one) and (!empty($m->anti_one))) {
                                                                echo "<td ><h4> $m->anti_one  </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->anti_one_res type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->anti_one_res2 type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->anti_one_res3 type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->anti_two) and (!empty($m->anti_two))) {
                                                                echo "<td ><h4> $m->anti_two  </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->anti_two_res type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->anti_two_res2 type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->anti_two_res3 type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->anti_three) and (!empty($m->anti_three))) {
                                                                echo "<td ><h4> $m->anti_three  </h4> </td>";
                                                                echo "<td ><input class='form-control'  value=$m->anti_three_res type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->anti_three_res2 type='text' readonly></td>";
                                                                echo "<td ><input class='form-control'  value=$m->anti_three_res3 type='text' readonly></td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($m->notes) and (!empty($m->notes))) {
                                                                echo "<td ><h4> NOTES  </h4> </td>";
                                                                echo "<td colspan='3'><textarea rows='3' cols='20' class='form-control'   readonly>$m->notes</textarea></td>";
                                                            }
                                                            ?>
                                                        </tr>
                                                    </table>
                                                </table>

                                                <table >
                                                    <tr>
                                                        <td><h4> Medical Lab. Scientist</h4></td>
                                                        <td style="padding-left: 200px"><h4><?php echo $results->scientist; ?></h4></td>
                                                    </tr>

                                                    <tr>
                                                        <td><h4>Date:</h4></td>
                                                        <td style="padding-left: 200px"><h4><?php $d_date = date('d/m/Y h:i a', strtotime($results->date)); echo $d_date; ?></h4></td>
                                                    </tr>

                                                    <tr>
                                                        <td><h4>Signature:</h4></td>
                                                        <td style="padding-left: 200px"><h4>----------------------------</h4></td>
                                                    </tr>
                                                </table>





                                            </div>
                                            <div class="col-md-2"></div>


                                        </div>


                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                    </div>


                </div>

            </form>





        </div>
    </div>


<?php

require('../layout/footer.php');