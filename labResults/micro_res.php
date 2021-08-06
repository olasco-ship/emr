<?php



//$result = Result::find_by_waiting_list_id($waitList->id);
$patient = Patient::find_by_id($result->patient_id);
$user = User::find_by_id($session->user_id);


?>

<h4 style="text-align: center">OBAFEMI AWOLOWO UNIVERSITY TEACHING HOSPITALS COMPLEX, ILE IFE</h4>
<h6 style="text-align: center">DEPARTMENT OF MEDICAL MICROBIOLOGY AND PARASITOLOGY</h6>
<?php
if ($result->status == 'PRELIM') {
    echo "<h6 style='text-align: center'><b>PRELIMINARY MICROBIOLOGY RESULT</b></h6>";
} else if ($result->status == 'FINAL') {
    echo "<h6 style='text-align: center'><b>FINAL MICROBIOLOGY RESULT</b></h6>";
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
                        <td> <?php echo $patient->full_name()  ?></td>
                    </tr>
                    <tr class="active">
                        <th>Clinical Details</th>
                        <td> <?php echo $result->doctor_note  ?></td>
                    </tr>

                    <tr class="active">
                        <th>Birthdate</th>
                        <td> <?php $d_date = date('d-M-Y', strtotime($patient->dob));
                                echo $d_date ?></td>
                    </tr>

                    <tr class="active">
                        <th>Age</th>
                        <td> <?php echo getAge($patient->dob) . 'years'  ?></td>
                    </tr>
                    <tr class="active">
                        <th>Sex</th>
                        <td> <?php echo $patient->gender   ?> </td>
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

        Microbiology

    </div>

    <div class="card-body">


        <div class="row">

            <div class="col-md-12">

                <?php

                $result->resultData;
                $decode = json_decode($result->resultData);
                if (isset($result->resultData) and !empty($result->resultData)) {
                    foreach ($decode as $key => $value) { ?>

                <?php    }
                } ?>

                <table class="table table-bordered">


                    <?php

                    $result->resultData;
                    $decode = json_decode($result->resultData);

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'salmo_d_o') {
                                echo "<tr>";
                                echo "<td><b>WIDAL REACTION</b></td>";
                                echo "<td colspan='2' style='text-align: center'><b>TITRE</b></td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'salmo_d_o') {
                                echo "<tr>";
                                echo "<td></td>";
                                echo "<td><b> O </b></td>";
                                echo "<td><b> H </b></td>";
                                echo "</tr>";
                            }
                        }
                    }


                    echo "<tr>";
                    echo "<td><b> Salmonella Typhi D </b></td>";
                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'salmo_d_o') {
                                echo "<td> $value </td>";
                            }
                            if ($key == 'salmo_d_h') {
                                echo "<td> $value </td>";
                            }
                        }
                    }
                    echo "</tr>";


                    echo "<tr>";
                    echo "<td> <b> Salmonella Paratyphi A </b> </td>";
                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'salmo_a_o') {
                                echo "<td> $value </td>";
                            }
                            if ($key == 'salmo_a_h') {
                                echo "<td> $value </td>";
                            }
                        }
                    }
                    echo "</tr>";


                    echo "<tr>";
                    echo "<td><b> Salmonella Paratyphi B </b></td>";
                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'salmo_b_o') {
                                echo "<td> $value </td>";
                            }
                            if ($key == 'salmo_b_h') {
                                echo "<td> $value </td>";
                            }
                        }
                    }
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td> <b> Salmonella Paratyphi C </b> </td>";
                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'salmo_c_o') {
                                echo "<td> $value </td>";
                            }
                            if ($key == 'salmo_c_h') {
                                echo "<td> $value </td>";
                            }
                        }
                    }
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td> <b> Comment </b> </td>";
                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'widal_comment') {
                                echo "<td colspan='2'> $value </td>";
                            }
                        }
                    }
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td> <b> VDRL </b> </td>";
                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'vdrl') {
                                echo "<td colspan='2'> $value </td>";
                            }
                        }
                    }
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td> <b> H . Pylori </b> </td>";
                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'h_pylori') {
                                echo "<td colspan='2'> $value </td>";
                            }
                        }
                    }
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td> <b> Others </b> </td>";
                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'widal_others') {
                                echo "<td colspan='2'> $value </td>";
                            }
                        }
                    }
                    echo "</tr>";

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'date_col') {
                                echo "<tr>";
                                echo "<td colspan='3'><b> SEMEN ANALYSIS M/C/S </b></td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'mot_sperm_count') {
                                echo "<tr>";
                                echo "<td><b> Sperm Count/ml </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }


                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'date_col') {
                                echo "<tr>";
                                echo "<td><b> Collection Date </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }


                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'time_col') {
                                echo "<tr>";
                                echo "<td><b> Time Collected </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'time_rec') {
                                echo "<tr>";
                                echo "<td><b> Time Received </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'time_ex') {
                                echo "<tr>";
                                echo "<td><b> Time Examined </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'ab_period') {
                                echo "<tr>";
                                echo "<td><b> Abstinence Period </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'mode_of_col') {
                                echo "<tr>";
                                echo "<td><b> Mode of Collection </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'volume') {
                                echo "<tr>";
                                echo "<td><b> Volume </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'viscosity') {
                                echo "<tr>";
                                echo "<td><b> Viscosity </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'appearance') {
                                echo "<tr>";
                                echo "<td><b> Appearance </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'micro_pus_cell') {
                                echo "<tr>";
                                echo "<td colspan='3'><b> MICROSCOPY  </b></td>";

                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'micro_pus_cell') {
                                echo "<tr>";
                                echo "<td><b>  Pus Cell </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'mot_fully_active') {
                                echo "<tr>";
                                echo "<td colspan='3'><b>  MOTILITY </b></td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'mot_fully_active') {
                                echo "<tr>";
                                echo "<td><b> Motile </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'mot_dead') {
                                echo "<tr>";
                                echo "<td><b> Non-motile </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'abnormal') {
                                echo "<tr>";
                                echo "<td colspan='3'><b> PROGRESSION </b></td>";
                                //  echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'active') {
                                echo "<tr>";
                                echo "<td><b> Active </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }


                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'sluggish') {
                                echo "<tr>";
                                echo "<td><b> Sluggish </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'mot_sli_active') {
                                echo "<tr>";
                                echo "<td><b> % Slightly Active </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'abnormal') {
                                echo "<tr>";
                                echo "<td colspan='3'><b> MORPHOLOGY </b></td>";
                                //  echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'abnormal') {
                                echo "<tr>";
                                echo "<td><b> Abnormal </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }


                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'normal') {
                                echo "<tr>";
                                echo "<td><b> Normal </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }


                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'sperm_culture') {
                                echo "<tr>";
                                echo "<td><b> Culture </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'sperm_comment') {
                                echo "<tr>";
                                echo "<td><b> Comment </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }


                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'pus_cell') {
                                echo "<tr>";
                                echo "<td colspan='3'><b> URINE MICROSCOPY  </b></td>";

                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'pus_cell') {
                                echo "<tr>";
                                echo "<td><b>  Pus Cell </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'rbc') {
                                echo "<tr>";
                                echo "<td><b> RBC </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    /*
                                                    foreach ($decode as $key => $value) {
                                                        if (isset($value) and !empty($value)) {
                                                            if ($key == 's_haem') {   
                                                            echo "<tr>";
                                                            echo "<td><b> S.Haematobium  </b></td>";
                                                            echo "<td colspan='2' style='text-align: center'>$value</td>";
                                                            echo "</tr>";
                                                            }
                                                        }
                                                    }

                                                    foreach ($decode as $key => $value) {
                                                        if (isset($value) and !empty($value)) {
                                                            if ($key == 'casts') {   
                                                            echo "<tr>";
                                                            echo "<td><b> Casts  </b></td>";
                                                            echo "<td colspan='2' style='text-align: center'>$value</td>";
                                                            echo "</tr>";
                                                            }
                                                        }
                                                    }
                                                    */

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'crystals') {
                                echo "<tr>";
                                echo "<td><b> Crystals  </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'yeast') {
                                echo "<tr>";
                                echo "<td><b> Yeast  </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'bacteria') {
                                echo "<tr>";
                                echo "<td><b> Bacteria  </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 't_vaginalis') {
                                echo "<tr>";
                                echo "<td><b> T.Vaginalis  </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'epith_cell') {
                                echo "<tr>";
                                echo "<td><b> Epithelia Cell  </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    /*
                                                    foreach ($decode as $key => $value) {
                                                        if (isset($value) and !empty($value)) {
                                                            if ($key == 'clue_cell') {    
                                                            echo "<tr>";
                                                            echo "<td><b> Clue Cell  </b></td>";
                                                            echo "<td colspan='2' style='text-align: center'>$value</td>";
                                                            echo "</tr>";
                                                            }
                                                        }
                                                    }
                                                    */

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'others') {
                                echo "<tr>";
                                echo "<td><b> Others  </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }



                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'micro_rbc') {
                                echo "<tr>";
                                echo "<td colspan='3'><b> SWAB/MISCELLANEOUS </b></td>";

                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'sputum') {
                                echo "<tr>";
                                echo "<td><b> SPUTUM M/C/S  </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }


                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'spu_others') {
                                echo "<tr>";
                                echo "<td><b> Others  </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }


                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'micro_rbc') {
                                echo "<tr>";
                                echo "<td><b> Rbc </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'micro_epith') {
                                echo "<tr>";
                                echo "<td><b> Epith Cell </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'micro_bacteria') {
                                echo "<tr>";
                                echo "<td><b> Bacteria </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'micro_s_haem') {
                                echo "<tr>";
                                echo "<td><b> S. Haematobium </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'micro_t_v') {
                                echo "<tr>";
                                echo "<td><b> T.Vaginalis </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'micro_yeast') {
                                echo "<tr>";
                                echo "<td><b> Yeast </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'urine_pus_cell') {
                                echo "<tr>";
                                echo "<td><b> Pus Cell </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'urine_cast') {
                                echo "<tr>";
                                echo "<td><b> Cast </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'urine_crystals') {
                                echo "<tr>";
                                echo "<td><b> Crystals </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'urine_organism') {
                                echo "<tr>";
                                echo "<td><b> Organisms </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'urine_micro_culture') {
                                echo "<tr>";
                                echo "<td><b> Culture </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'mip') {
                                echo "<tr>";
                                echo "<td><b> CEFIXIME </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'cefri') {
                                echo "<tr>";
                                echo "<td><b> CEFTRIAXONE </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'gent') {
                                echo "<tr>";
                                echo "<td><b> GENTAMICIN </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'cot') {
                                echo "<tr>";
                                echo "<td><b> CO-TRIMOXAZOLE </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'lev') {
                                echo "<tr>";
                                echo "<td><b> LEVOFLOXACIN </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'net') {
                                echo "<tr>";
                                echo "<td><b> NETILLIN </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'tet') {
                                echo "<tr>";
                                echo "<td><b> TETRACYCLINE </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'amo') {
                                echo "<tr>";
                                echo "<td><b> AMOXYCLAV </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'ofl') {
                                echo "<tr>";
                                echo "<td><b> OFLOXACIN </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'cip') {
                                echo "<tr>";
                                echo "<td><b> CIPROFLOXACIN </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'cefta') {
                                echo "<tr>";
                                echo "<td><b> CEFTAZIDIME </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'cefu') {
                                echo "<tr>";
                                echo "<td><b> CEFUROXIME </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'nitro') {
                                echo "<tr>";
                                echo "<td><b> NITROFURANTOIN </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'amp') {
                                echo "<tr>";
                                echo "<td><b> AMPICILLIN </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'ery') {
                                echo "<tr>";
                                echo "<td><b> ERYTHROMYCIN </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'clo') {
                                echo "<tr>";
                                echo "<td><b> CLOXICILLIN </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'aug') {
                                echo "<tr>";
                                echo "<td><b> AUGUMENTIN </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'aug') {
                                echo "<tr>";
                                echo "<td><b> AUGUMENTIN </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'comment') {
                                echo "<tr>";
                                echo "<td><b> Comment </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'stool_analysis') {
                                echo "<tr>";
                                echo "<td><b> STOOL ANALYSIS (MACROSCOPY) </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'stool_analysis') {
                                echo "<tr>";
                                echo "<td><b> STOOL ANALYSIS (MACROSCOPY) </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'skin_snip') {
                                echo "<tr>";
                                echo "<td><b> Skin Snip for Oncho  </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }


                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'spu_pus_cells') {
                                echo "<tr>";
                                echo "<td><b> GRAM REACTION Pus Cell  </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'spu_yeast_cells') {
                                echo "<tr>";
                                echo "<td><b> Yeast Cell  </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }


                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'spu_epith') {
                                echo "<tr>";
                                echo "<td><b> Epithelia Cell  </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }


                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'spu_pos') {
                                echo "<tr>";
                                echo "<td><b> Gram Positive Cocci  </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'spu_neg') {
                                echo "<tr>";
                                echo "<td><b> Gram Negative Baccili </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'spu_pos_rod') {
                                echo "<tr>";
                                echo "<td><b> Gram Positive Rod  </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'spu_neg_cocci') {
                                echo "<tr>";
                                echo "<td><b> Gram Negative Cocci  </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'spu_culture') {
                                echo "<tr>";
                                echo "<td><b> Culture  </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }


                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'prelim') {
                                echo "<tr>";
                                echo "<td colspan='3' style='text-align: center'>BLOOD CULTURE</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'prelim') {
                                echo "<tr>";
                                echo "<td><b> Preliminary Result  </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'final') {
                                echo "<tr>";
                                echo "<td><b> Final Result  </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'mycology') {
                                echo "<tr>";
                                echo "<td colspan='3' style='text-align: center'>Mycology</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'mycology') {
                                echo "<tr>";
                                echo "<td><b> Microscopy  </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'mycology_culture') {
                                echo "<tr>";
                                echo "<td><b> Culture  </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'notes') {
                                echo "<tr>";
                                echo "<td><b> Notes  </b></td>";
                                echo "<td colspan='2' style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }










                    ?>

                </table>



            </div>

        </div>

    </div>

</div>