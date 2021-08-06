<?php

//$result = Result::find_by_waiting_list_id($waitList->id);
$result = Result::find_by_id($_GET['id']);
$patient = Patient::find_by_id($result->patient_id);
$user = User::find_by_id($session->user_id);
$labWalk = LabWalkIn::find_by_id($result->labWalkIn_id);



?>



<h4 style="text-align: center">OBAFEMI AWOLOWO UNIVERSITY TEACHING HOSPITALS COMPLEX, ILE IFE</h4>
<?php
if ($result->status == 'PRELIM') {
    echo "<h6 style='text-align: center'><b>PRELIMINARY CHEMICAL PATHOLOGY RESULT</b></h6>";
} else if ($result->status == 'FINAL') {
    echo "<h6 style='text-align: center'><b>FINAL CHEMICAL PATHOLOGY RESULT</b></h6>";
}

?>


<div class="row">
    <div class="col-md-6">

        <div class="table-responsive">
            <!--<h4><?php /*echo $patient->full_name() */ ?></h4>-->
            <table class="table table">
                <tbody>
                <tr class="active">
                    <th>Patient</th>
                    <td> <?php // echo $patient->full_name()
                        if (!empty($patient)) {
                            echo $patient->full_name();
                        } else {
                            echo $labWalk->first_name . " " . $labWalk->last_name;
                        }
                        ?></td>
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
                            echo $d_date ;
                        }
                        ?></td>
                </tr>

                <tr class="active">
                    <th>Age</th>
                    <td> <?php
                        if (!empty($patient)) {
                            echo getAge($patient->dob) . 'years' ;
                        } else {
                            echo $labWalk->age. 'years' ;
                        }
                        ?></td>
                </tr>
                <tr class="active">
                    <th>Sex</th>
                    <td> <?php
                        if (!empty($patient)) {
                            echo $patient->gender;
                        } else {
                            echo $labWalk->gender ;
                        }
                        ?> </td>
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
                <td> <?php echo $result->lab_no  ?></td>
            </tr>

            <tr class="active">
                <th>Hospital No.</th>
                <td> <?php echo $patient->folder_number   ?> </td>
            </tr>
            <tr class="active">
                <th>Clinic </th>
                <td> <?php echo $result->clinic  ?> </td>
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

        Chemical Pathology

    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-12">

                <div class="table-responsive">

                    <table class="table table-bordered">
                        <tr>
                            <td><b>Blood Investigation</b></td>
                            <td><b>Result</b></td>
                            <td><b>Reference/Unit</b></td>
<!--                            <td><b></b></td>-->
                        </tr>


                        <?php

                        $result->resultData;
                        $decode = json_decode($result->resultData);
                        $range = json_decode($result->refRangeUnit);

                        foreach ($decode as $key => $value) {
                            if (isset($value) and !empty($value)) {
                                if ($key == 'Sodium') {
                                    echo "<tr>";
                                    echo "<td> Sodium </td>";
                                    echo "<td> $value</td>";
                                    echo "<td>$range->Sodium</td>";
//                                    echo "<td>136 - 145</td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'Potassium') {
                                    echo "<tr>";
                                    echo "<td> Potassium </td>";
                                    echo "<td> $value</td>";
                                    echo "<td>$range->Potassium</td>";
//                                    echo "<td>3.0 - 5.0</td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'Chloride') {
                                    echo "<tr>";
                                    echo "<td> Chloride </td>";
                                    echo "<td> $value</td>";
                                    echo "<td>$range->Chloride</td>";
//                                    echo "<td>95 - 110</td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'lithium') {
                                    echo "<tr>";
                                    echo "<td> Lithium </td>";
                                    echo "<td> $value</td>";
                                    echo "<td>$range->lithium</td>";
//                                    echo "<td>1</td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'Bicarbonate') {
                                    echo "<tr>";
                                    echo "<td> Bicarbonate </td>";
                                    echo "<td> $value</td>";
                                    echo "<td>$range->Bicarbonate</td>";
//                                    echo "<td>20 - 30</td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'IonizedCalcium') {
                                    echo "<tr>";
                                    echo "<td> Ionized Calcium </td>";
                                    echo "<td> $value</td>";
                                    echo "<td>$range->ionized_calcium</td>";
//                                    echo "<td>0.11 - 1.23</td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'InorganicPhos') {
                                    echo "<tr>";
                                    echo "<td> Inorganic Phos </td>";
                                    echo "<td> $value</td>";
                                    echo "<td>$range->ionized_phosphate</td>";
//                                    echo "<td>0.80 - 1.60 </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'Magnessium') {
                                    echo "<tr>";
                                    echo "<td> Magnessium </td>";
                                    echo "<td> $value</td>";
                                    echo "<td>$range->magnessium</td>";
//                                    echo "<td>0.80 - 1.60 </td>";
                                    echo "</tr>";
                                }
                            }



                            if (isset($value) and !empty($value)) {
                                if ($key == 'Urea') {
                                    echo "<tr>";
                                    echo "<td> Urea </td>";
                                    echo "<td> $value</td>";
                                    echo "<td>$range->urea</td>";
                                    echo "<td> 2.5 - 5.8 </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'creatinine') {
                                    echo "<tr>";
                                    echo "<td> Creatinine </td>";
                                    echo "<td> $value</td>";
                                    echo "<td>$range->creatinine</td>";
//                                    echo "<td> 44 - 132 </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'creatinine_clearance') {
                                    echo "<tr>";
                                    echo "<td> Creatinine Clearance </td>";
                                    echo "<td> $value</td>";
                                    echo "<td>$range->creatinine_clearance</td>";
//                                    echo "<td> </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'uric_acid') {
                                    echo "<tr>";
                                    echo "<td> Uric Acid  </td>";
                                    echo "<td> $value</td>";
                                    echo "<td>$range->uric_acid</td>";
//                                    echo "<td> M(202-416) F(142-330) </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'Calcium') {
                                    echo "<tr>";
                                    echo "<td> Calcium  </td>";
                                    echo "<td> $value</td>";
                                    echo "<td>$range->Calcium</td>";
//                                    echo "<td> 2.2 - 2.7 </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'total_bilirubin') {
                                    echo "<tr>";
                                    echo "<td> Total Bilirubin  </td>";
                                    echo "<td> $value</td>";
                                    echo "<td>$range->total_bilirubin</td>";
//                                    echo "<td> 1.71 - 17.1 </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'conj_bilirubin') {
                                    echo "<tr>";
                                    echo "<td> Conj. Bilirubin  </td>";
                                    echo "<td> $value</td>";
                                    echo "<td>$value->conjugate_bilirubin</td>";
//                                    echo "<td> 1.7 - 8.5 </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'alk_phosphate') {
                                    echo "<tr>";
                                    echo "<td> ALK. Phosphatase  </td>";
                                    echo "<td> $value</td>";
                                    echo "<td>$range->alk_phosphate</td>";
//                                    echo "<td> 98 - 279 </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'ast') {
                                    echo "<tr>";
                                    echo "<td> AST. (SGOT)  </td>";
                                    echo "<td> $value</td>";
                                    echo "<td>$range->ast</td>";
//                                    echo "<td> 0 - 40 </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'alt') {
                                    echo "<tr>";
                                    echo "<td> ALT. (SGPT)  </td>";
                                    echo "<td> $value</td>";
                                    echo "<td>$range->alt</td>";
//                                    echo "<td> 0 - 40 </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'gamma_gt') {
                                    echo "<tr>";
                                    echo "<td> Gamma-GT  </td>";
                                    echo "<td> $value</td>";
                                    echo "<td>$range->gamma_gt</td>";
//                                    echo "<td>  </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'total_protein') {
                                    echo "<tr>";
                                    echo "<td> Total Protein  </td>";
                                    echo "<td> $value</td>";
                                    echo "<td> $range->total_protein</td>";
//                                    echo "<td> 58 - 80 </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'albumin') {
                                    echo "<tr>";
                                    echo "<td> Albumin	   </td>";
                                    echo "<td> $value</td>";
                                    echo "<td> $range->total_albumin </td>";
//                                    echo "<td> 35 - 50 </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'globulin') {
                                    echo "<tr>";
                                    echo "<td> Globulin	   </td>";
                                    echo "<td> $value</td>";
                                    echo "<td> $range->globulin </td>";
//                                    echo "<td> 20 - 45 </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'acid_phosphate') {
                                    echo "<tr>";
                                    echo "<td> Total Acid Phosphatase</td>";
                                    echo "<td> $value</td>";
                                    echo "<td> $range->acid_phosphate</td>";
//                                    echo "<td> 0 - 11 </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'prostatic') {
                                    echo "<tr>";
                                    echo "<td> Prostatic Acid Phosphatase </td>";
                                    echo "<td> $value</td>";
                                    echo "<td> $range->prostatic</td>";
//                                    echo "<td> 0 - 0.4 </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'amylase') {
                                    echo "<tr>";
                                    echo "<td> Amylase </td>";
                                    echo "<td> $value</td>";
                                    echo "<td>$range->amylase</td>";
//                                    echo "<td> </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'cpk') {
                                    echo "<tr>";
                                    echo "<td> CPK </td>";
                                    echo "<td> $value</td>";
                                    echo "<td>$range->cpk</td>";
//                                    echo "<td> </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'ck_mb') {
                                    echo "<tr>";
                                    echo "<td> CKMB </td>";
                                    echo "<td> $value</td>";
                                    echo "<td> $range->ckmb</td>";
//                                    echo "<td> </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'ldh') {
                                    echo "<tr>";
                                    echo "<td> LDH </td>";
                                    echo "<td> $value</td>";
                                    echo "<td>$range->ldh </td>";
//                                    echo "<td> </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'total_cholesterol') {
                                    echo "<tr>";
                                    echo "<td> Total Cholesterol </td>";
                                    echo "<td> $value</td>";
                                    echo "<td>$range->total_cholesterol</td>";
//                                    echo "<td> 2.5 - 5.0 </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'triglycerides') {
                                    echo "<tr>";
                                    echo "<td> Triglycerides  </td>";
                                    echo "<td> $value</td>";
                                    echo "<td>$range->triglycerides</td>";
//                                    echo "<td> <1.71 </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'hdl_cholesterol') {
                                    echo "<tr>";
                                    echo "<td> HDL-Cholesterol  </td>";
                                    echo "<td> $value</td>";
                                    echo "<td>$range->hdl_cholesterol</td>";
//                                    echo "<td> 1.06 - 1.52 </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'ldl_cholesterol') {
                                    echo "<tr>";
                                    echo "<td> LDL-Cholesterol  </td>";
                                    echo "<td> $value</td>";
                                    echo "<td>$range->ldl_cholesterol</td>";
//                                    echo "<td> <3.9 </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'fasting_glucose') {
                                    echo "<tr>";
                                    echo "<td> Fasting Glucose  </td>";
                                    echo "<td> $value</td>";
                                    echo "<td>$range->fasting_glucose</td>";
//                                    echo "<td> 2.5 - 5.6 </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'hpp') {
                                    echo "<tr>";
                                    echo "<td> Glucose (2HPP)  </td>";
                                    echo "<td> $value</td>";
                                    echo "<td>$range->hpp </td>";
//                                    echo "<td>  </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'random_glucose') {
                                    echo "<tr>";
                                    echo "<td> Random Glucose  </td>";
                                    echo "<td> $value</td>";
                                    echo "<td>$range->random_glucose </td>";
//                                    echo "<td>  </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'hbA') {
                                    echo "<tr>";
                                    echo "<td> GLYCATED HAEMOGLOBIN(hbA)  </td>";
                                    echo "<td> $value</td>";
                                    echo "<td>$range->hba</td>";
//                                    echo "<td> 6 - 8.3 </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'Phosphorus') {
                                    echo "<tr>";
                                    echo "<td> Phosphorus </td>";
                                    echo "<td> $value</td>";
                                    echo "<td>$range->phosphorus</td>";
//                                    echo "<td>0.3 - 1.5 </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'tibc') {
                                    echo "<tr>";
                                    echo "<td> TIBC </td>";
                                    echo "<td> $value</td>";
                                    echo "<td></td>";
//                                    echo "<td> </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'g6pd') {
                                    echo "<tr>";
                                    echo "<td> G6PD </td>";
                                    echo "<td> $value</td>";
                                    echo "<td></td>";
//                                    echo "<td> </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'lipase') {
                                    echo "<tr>";
                                    echo "<td> Lipase </td>";
                                    echo "<td> $value</td>";
                                    echo "<td></td>";
//                                    echo "<td> </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'lipase') {
                                    echo "<tr>";
                                    echo "<td> Lipase </td>";
                                    echo "<td> $value</td>";
                                    echo "<td></td>";
//                                    echo "<td> </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'psa') {
                                    echo "<tr>";
                                    echo "<td> PSA </td>";
                                    echo "<td> $value</td>";
                                    echo "<td></td>";
//                                    echo "<td> </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 't3') {
                                    echo "<tr>";
                                    echo "<td> T3 </td>";
                                    echo "<td> $value</td>";
                                    echo "<td></td>";
//                                    echo "<td> </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 't4') {
                                    echo "<tr>";
                                    echo "<td> T4 </td>";
                                    echo "<td> $value</td>";
                                    echo "<td></td>";
//                                    echo "<td> </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'tsh') {
                                    echo "<tr>";
                                    echo "<td> TSH </td>";
                                    echo "<td> $value</td>";
                                    echo "<td></td>";
//                                    echo "<td> </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'e2') {
                                    echo "<tr>";
                                    echo "<td> E2 </td>";
                                    echo "<td> $value</td>";
                                    echo "<td></td>";
//                                    echo "<td> </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'lh') {
                                    echo "<tr>";
                                    echo "<td> LH </td>";
                                    echo "<td> $value</td>";
                                    echo "<td></td>";
//                                    echo "<td> </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'fsh') {
                                    echo "<tr>";
                                    echo "<td> FSH </td>";
                                    echo "<td> $value</td>";
                                    echo "<td></td>";
//                                    echo "<td> </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'prolactin') {
                                    echo "<tr>";
                                    echo "<td> Prolactin </td>";
                                    echo "<td> $value</td>";
                                    echo "<td></td>";
//                                    echo "<td> </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'progesterone') {
                                    echo "<tr>";
                                    echo "<td> Progesterone </td>";
                                    echo "<td> $value</td>";
                                    echo "<td></td>";
//                                    echo "<td> </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'testosterone') {
                                    echo "<tr>";
                                    echo "<td> Testosterone </td>";
                                    echo "<td> $value</td>";
                                    echo "<td></td>";
//                                    echo "<td> </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'afp') {
                                    echo "<tr>";
                                    echo "<td> AFP </td>";
                                    echo "<td> $value</td>";
                                    echo "<td></td>";
//                                    echo "<td> </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'beta_hcg') {
                                    echo "<tr>";
                                    echo "<td> Beta HCG </td>";
                                    echo "<td> $value</td>";
                                    echo "<td></td>";
//                                    echo "<td> </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'urine_protein') {
                                    echo "<tr>";
                                    echo "<td> Protein  </td>";
                                    echo "<td> $value</td>";
                                    echo "<td></td>";
//                                    echo "<td> </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'urine_glucose') {
                                    echo "<tr>";
                                    echo "<td> Glucose  </td>";
                                    echo "<td> $value</td>";
                                    echo "<td></td>";
//                                    echo "<td> </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'urine_blood') {
                                    echo "<tr>";
                                    echo "<td> Blood  </td>";
                                    echo "<td> $value</td>";
                                    echo "<td></td>";
//                                    echo "<td> </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'urine_bilirubin') {
                                    echo "<tr>";
                                    echo "<td> Bilirubin  </td>";
                                    echo "<td> $value</td>";
                                    echo "<td></td>";
//                                    echo "<td> </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'urine_urobilinogen') {
                                    echo "<tr>";
                                    echo "<td> Urobilinogen  </td>";
                                    echo "<td> $value</td>";
                                    echo "<td></td>";
//                                    echo "<td> </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'urine_ketones') {
                                    echo "<tr>";
                                    echo "<td> Ketones  </td>";
                                    echo "<td> $value</td>";
                                    echo "<td></td>";
//                                    echo "<td> </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'urine_ascorbic_acid') {
                                    echo "<tr>";
                                    echo "<td> Ascorbic Acid  </td>";
                                    echo "<td> $value</td>";
                                    echo "<td></td>";
//                                    echo "<td> </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'urine_nitrite') {
                                    echo "<tr>";
                                    echo "<td> Nitrite   </td>";
                                    echo "<td> $value</td>";
                                    echo "<td></td>";
//                                    echo "<td> </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'urine_ph') {
                                    echo "<tr>";
                                    echo "<td> pH   </td>";
                                    echo "<td> $value</td>";
                                    echo "<td></td>";
//                                    echo "<td> </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'urine_sp_gravity') {
                                    echo "<tr>";
                                    echo "<td> Sp Gravity   </td>";
                                    echo "<td> $value</td>";
                                    echo "<td></td>";
//                                    echo "<td> </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'csf_protein') {
                                    echo "<tr>";
                                    echo "<td> Protein   </td>";
                                    echo "<td> $value</td>";
                                    echo "<td></td>";
//                                    echo "<td> </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'csf_chloride') {
                                    echo "<tr>";
                                    echo "<td> Chloride   </td>";
                                    echo "<td> $value</td>";
                                    echo "<td></td>";
//                                    echo "<td> </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'csf_glucose') {
                                    echo "<tr>";
                                    echo "<td> Glucose   </td>";
                                    echo "<td> $value</td>";
                                    echo "<td></td>";
//                                    echo "<td> </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'faecal') {
                                    echo "<tr>";
                                    echo "<td> Faecal Occult Blood Test:   </td>";
                                    echo "<td colspan='3'> $value</td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'mantoux_test') {
                                    echo "<tr>";
                                    echo "<td> Mantoux Test   </td>";
                                    echo "<td> $value</td>";
                                    echo "<td></td>";
//                                    echo "<td> </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'pt_urine') {
                                    echo "<tr>";
                                    echo "<td> Urine PT    </td>";
                                    echo "<td> $value</td>";
                                    echo "<td></td>";
//                                    echo "<td> </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'pt_blood') {
                                    echo "<tr>";
                                    echo "<td> Blood PT    </td>";
                                    echo "<td> $value</td>";
                                    echo "<td></td>";
//                                    echo "<td> </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'fasting') {
                                    echo "<tr>";
                                    echo "<td> OGTT(Blood) Fasting   </td>";
                                    echo "<td> $value</td>";
                                    echo "<td></td>";
//                                    echo "<td> </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'thirty_min') {
                                    echo "<tr>";
                                    echo "<td> OGTT(Blood) 30 min   </td>";
                                    echo "<td> $value</td>";
                                    echo "<td></td>";
//                                    echo "<td> </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'one_hour') {
                                    echo "<tr>";
                                    echo "<td> OGTT(Blood) 60 min   </td>";
                                    echo "<td> $value</td>";
                                    echo "<td></td>";
//                                    echo "<td> </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'ninety_min') {
                                    echo "<tr>";
                                    echo "<td> OGTT(Blood) 90 min   </td>";
                                    echo "<td> $value</td>";
                                    echo "<td></td>";
//                                    echo "<td> </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'two_hours') {
                                    echo "<tr>";
                                    echo "<td> OGTT(Blood) 120 min   </td>";
                                    echo "<td> $value</td>";
                                    echo "<td></td>";
//                                    echo "<td> </td>";
                                    echo "</tr>";
                                }
                            }


                            if (isset($value) and !empty($value)) {
                                if ($key == 'fasting_urine') {
                                    echo "<tr>";
                                    echo "<td> OGTT(Urine) Fasting   </td>";
                                    echo "<td> $value</td>";
                                    echo "<td></td>";
//                                    echo "<td> </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'thirty_min_urine') {
                                    echo "<tr>";
                                    echo "<td> OGTT(Urine) 30 min   </td>";
                                    echo "<td> $value</td>";
                                    echo "<td></td>";
//                                    echo "<td> </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'one_hour_urine') {
                                    echo "<tr>";
                                    echo "<td> OGTT(Urine) 60 min   </td>";
                                    echo "<td> $value</td>";
                                    echo "<td></td>";
//                                    echo "<td> </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'ninety_min_urine') {
                                    echo "<tr>";
                                    echo "<td> OGTT(Urine) 90 min   </td>";
                                    echo "<td> $value</td>";
                                    echo "<td></td>";
//                                    echo "<td> </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'two_hours_urine') {
                                    echo "<tr>";
                                    echo "<td> OGTT(Urine) 120 min   </td>";
                                    echo "<td> $value</td>";
                                    echo "<td></td>";
//                                    echo "<td> </td>";
                                    echo "</tr>";
                                }
                            }

                            if (isset($value) and !empty($value)) {
                                if ($key == 'notes') {
                                    echo "<tr>";
                                    echo "<td>  Scientist Note    </td>";
                                    /*  echo "<td>%</td>";  */
                                    echo "<td colspan = '3'> $value  </td>";
                                    /*   echo "<td>(1-5)min </td>"; */
                                    echo "</tr>";
                                }
                            }
                        }



                        ?>




                    </table>

                    <table class="table table-bordered">



                        <tr>
                            <td><b> Med. Lab. Scientist</b></td>
                            <td colspan='3'><?php echo $result->scientist ?></td>
                        </tr>

                        <?php
                        if (isset($result->pathologist) and !empty($result->pathologist)) { ?>
                            <tr>
                                <td><b> Pathologist </b></td>
                                <td colspan='3'><?php echo $result->pathologist ?></td>
                            </tr>

                        <?php  }
                        ?>


                        <tr>
                            <td><b> Date Of Result </b></td>
                            <td colspan='3'><?php $d_date = date('d/m/Y h:i a', strtotime($result->date));
                                echo $d_date ?></td>
                        </tr>

                    </table>


                </div>


            </div>

        </div>

    </div>

</div>