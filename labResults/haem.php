<?php



$result = Result::find_by_id($_GET['id']);
$patient = Patient::find_by_id($result->patient_id);
$user = User::find_by_id($session->user_id);
$labWalk = LabWalkIn::find_by_id($result->labWalkIn_id);


?>





<?php
if ($result->status == 'PRELIM') {
    echo "<h6 style='text-align: center'><b>PRELIMINARY HAEMATOLOGY RESULT</b></h6>";
} else if ($result->status == 'FINAL') {
    echo "<h6 style='text-align: center'><b>FINAL HAEMATOLOGY RESULT</b></h6>";
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

        Haematology

    </div>

    <div class="card-body">

        <div class="row">


            <div class="table-responsive">


                <table class="table table-bordered">
                    <tr>
                        <td><b>PARAMETER NAME</b></td>
                        <td><b>UNIT</b></td>
                        <td><b>RESULT</b></td>
                        <td><b>NORMAL</b></td>
                    </tr>


                    <?php
                    $result->resultData;
                    $decode = json_decode($result->resultData);
                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'Hb') {
                                echo "<tr>";
                                echo "<td> Hb </td>";
                                echo "<td>g/dl</td>";
                                echo "<td> $value</td>";
                                echo "<td>13 - 18</td>";
                                echo "</tr>";
                            }
                        }

                        if (isset($value) and !empty($value)) {
                            if ($key == 'PCV') {
                                echo "<tr>";
                                echo "<td> PCV/HCT </td>";
                                echo "<td>%</td>";
                                echo "<td> $value</td>";
                                echo "<td>40 - 54</td>";
                                echo "</tr>";
                            }
                        }


                        if (isset($value) and !empty($value)) {
                            if ($key == 'RBC') {
                                echo "<tr>";
                                echo "<td> RBC </td>";
                                echo "<td>x10^12/L</td>";
                                echo "<td> $value</td>";
                                echo "<td>4.5 - 5.5</td>";
                                echo "</tr>";
                            }
                        }

                        if (isset($value) and !empty($value)) {
                            if ($key == 'MCV') {
                                echo "<tr>";
                                echo "<td> MCV </td>";
                                echo "<td>fl</td>";
                                echo "<td> $value</td>";
                                echo "<td>76 - 93</td>";
                                echo "</tr>";
                            }
                        }

                        if (isset($value) and !empty($value)) {
                            if ($key == 'MCH') {
                                echo "<tr>";
                                echo "<td> MCH </td>";
                                echo "<td>pg</td>";
                                echo "<td> $value</td>";
                                echo "<td>27 - 31</td>";
                                echo "</tr>";
                            }
                        }

                        if (isset($value) and !empty($value)) {
                            if ($key == 'MCHC') {
                                echo "<tr>";
                                echo "<td> MCHC </td>";
                                echo "<td>g/dl</td>";
                                echo "<td> $value</td>";
                                echo "<td>31 - 35</td>";
                                echo "</tr>";
                            }
                        }


                        if (isset($value) and !empty($value)) {
                            if ($key == 'WBC') {
                                echo "<tr>";
                                echo "<td> WBC </td>";
                                echo "<td>x10^9/L</td>";
                                echo "<td> $value</td>";
                                echo "<td>4.8 - 10.8</td>";
                                echo "</tr>";
                            }
                        }

                        if (isset($value) and !empty($value)) {
                            if ($key == 'Platelets') {
                                echo "<tr>";
                                echo "<td> PLATELETS </td>";
                                echo "<td>x10^9/L</td>";
                                echo "<td> $value</td>";
                                echo "<td>140 - 400</td>";
                                echo "</tr>";
                            }
                        }

                        if (isset($value) and !empty($value)) {
                            if ($key == 'Retics') {
                                echo "<tr>";
                                echo "<td> Retics </td>";
                                echo "<td>%</td>";
                                echo "<td> $value</td>";
                                echo "<td>0.2 - 2.0</td>";
                                echo "</tr>";
                            }
                        }

                        if (isset($value) and !empty($value)) {
                            if ($key == 'ESR') {
                                echo "<tr>";
                                echo "<td> WESTERGREN ESR </td>";
                                echo "<td>mm/Hr</td>";
                                echo "<td> $value</td>";
                                echo "<td>5 - 7</td>";
                                echo "</tr>";
                            }
                        }

                        if (isset($value) and !empty($value)) {
                            if ($key == 'NEUT') {
                                echo "<tr>";
                                echo "<td> NEUT  </td>";
                                echo "<td>%</td>";
                                echo "<td> $value</td>";
                                echo "<td>40 - 75</td>";
                                echo "</tr>";
                            }
                        }

                        if (isset($value) and !empty($value)) {
                            if ($key == 'LYMPH') {
                                echo "<tr>";
                                echo "<td> LYPMH  </td>";
                                echo "<td>%</td>";
                                echo "<td> $value</td>";
                                echo "<td>20 - 45</td>";
                                echo "</tr>";
                            }
                        }

                        if (isset($value) and !empty($value)) {
                            if ($key == 'MONO') {
                                echo "<tr>";
                                echo "<td> MONO  </td>";
                                echo "<td>%</td>";
                                echo "<td> $value</td>";
                                echo "<td>2 - 10</td>";
                                echo "</tr>";
                            }
                        }

                        if (isset($value) and !empty($value)) {
                            if ($key == 'Eosino') {
                                echo "<tr>";
                                echo "<td> Eosino  </td>";
                                echo "<td>%</td>";
                                echo "<td> $value</td>";
                                echo "<td>1 - 6</td>";
                                echo "</tr>";
                            }
                        }

                        if (isset($value) and !empty($value)) {
                            if ($key == 'BASO') {
                                echo "<tr>";
                                echo "<td> BASO  </td>";
                                echo "<td>%</td>";
                                echo "<td> $value</td>";
                                echo "<td></td>";
                                echo "</tr>";
                            }
                        }

                        if (isset($value) and !empty($value)) {
                            if ($key == 'Normo') {
                                echo "<tr>";
                                echo "<td colspan = '2'> Normo  </td>";
                                /*  echo "<td>%</td>";  */
                                echo "<td> $value</td>";
                                echo "<td></td>";
                                echo "</tr>";
                            }
                        }

                        if (isset($value) and !empty($value)) {
                            if ($key == 'BleedingTime') {
                                echo "<tr>";
                                echo "<td colspan = '2'> Bleeding Time  </td>";
                                /*  echo "<td>%</td>";  */
                                echo "<td> $value</td>";
                                echo "<td>(1-5)min </td>";
                                echo "</tr>";
                            }
                        }

                        if (isset($value) and !empty($value)) {
                            if ($key == 'ClottingTime') {
                                echo "<tr>";
                                echo "<td colspan = '2'> Clotting Time  </td>";
                                /*  echo "<td>%</td>";  */
                                echo "<td> $value</td>";
                                echo "<td>(1-5)min </td>";
                                echo "</tr>";
                            }
                        }

                        if (isset($value) and !empty($value)) {
                            if ($key == 'PT') {
                                echo "<tr>";
                                echo "<td colspan = '2'> P.T.  </td>";
                                /*  echo "<td>%</td>";  */
                                echo "<td colspan = '2'> $value</td>";
                                /*   echo "<td>(1-5)min </td>"; */
                                echo "</tr>";
                            }
                        }

                        if (isset($value) and !empty($value)) {
                            if ($key == 'PTT') {
                                echo "<tr>";
                                echo "<td colspan = '2'> P.T.T.  </td>";
                                /*  echo "<td>%</td>";  */
                                echo "<td colspan = '2'> $value</td>";
                                /*   echo "<td>(1-5)min </td>"; */
                                echo "</tr>";
                            }
                        }

                        if (isset($value) and !empty($value)) {
                            if ($key == 'APTT') {
                                echo "<tr>";
                                echo "<td colspan = '2'> APTT  </td>";
                                /*  echo "<td>%</td>";  */
                                echo "<td colspan = '2'> $value</td>";
                                /*   echo "<td>(1-5)min </td>"; */
                                echo "</tr>";
                            }
                        }

                        if (isset($value) and !empty($value)) {
                            if ($key == 'HBsAg') {
                                echo "<tr>";
                                echo "<td colspan = '2'> HBsAg  </td>";
                                /*  echo "<td>%</td>";  */
                                echo "<td colspan = '2'> $value</td>";
                                /*   echo "<td>(1-5)min </td>"; */
                                echo "</tr>";
                            }
                        }

                        if (isset($value) and !empty($value)) {
                            if ($key == 'HCV') {
                                echo "<tr>";
                                echo "<td colspan = '2'> HCV  </td>";
                                /*  echo "<td>%</td>";  */
                                echo "<td colspan = '2'> $value</td>";
                                /*   echo "<td>(1-5)min </td>"; */
                                echo "</tr>";
                            }
                        }

                        if (isset($value) and !empty($value)) {
                            if ($key == 'RvsScreening') {
                                echo "<tr>";
                                echo "<td colspan = '2'> RVS Screening  </td>";
                                /*  echo "<td>%</td>";  */
                                echo "<td colspan = '2'> $value</td>";
                                /*   echo "<td>(1-5)min </td>"; */
                                echo "</tr>";
                            }
                        }

                        if (isset($value) and !empty($value)) {
                            if ($key == 'VDRL') {
                                echo "<tr>";
                                echo "<td colspan = '2'> VDRL   </td>";
                                /*  echo "<td>%</td>";  */
                                echo "<td colspan = '2'> $value</td>";
                                /*   echo "<td>(1-5)min </td>"; */
                                echo "</tr>";
                            }
                        }

                        if (isset($value) and !empty($value)) {
                            if ($key == 'MP') {
                                echo "<tr>";
                                echo "<td colspan = '2'> Malaria Parasite   </td>";
                                /*  echo "<td>%</td>";  */
                                echo "<td colspan = '2'> $value</td>";
                                /*   echo "<td>(1-5)min </td>"; */
                                echo "</tr>";
                            }
                        }

                        if (isset($value) and !empty($value)) {
                            if ($key == 'Others') {
                                echo "<tr>";
                                echo "<td colspan = '2'> Others </td>";
                                /*  echo "<td>%</td>";  */
                                echo "<td colspan = '2'> $value</td>";
                                /*   echo "<td>(1-5)min </td>"; */
                                echo "</tr>";
                            }
                        }

                        if (isset($value) and !empty($value)) {
                            if ($key == 'CoombsTest') {
                                echo "<tr>";
                                echo "<td colspan = '2'> Direct Coombs' Test </td>";
                                /*  echo "<td>%</td>";  */
                                echo "<td colspan = '2'> $value</td>";
                                /*   echo "<td>(1-5)min </td>"; */
                                echo "</tr>";
                            }
                        }

                        if (isset($value) and !empty($value)) {
                            if ($key == 'IndCoombsTest') {
                                echo "<tr>";
                                echo "<td colspan = '2'> Indirect Coombs' Test </td>";
                                /*  echo "<td>%</td>";  */
                                echo "<td colspan = '2'> $value</td>";
                                /*   echo "<td>(1-5)min </td>"; */
                                echo "</tr>";
                            }
                        }

                        if (isset($value) and !empty($value)) {
                            if ($key == 'CD4') {
                                echo "<tr>";
                                echo "<td colspan = '2'> CD4 Lymphocyte Count  </td>";
                                /*  echo "<td>%</td>";  */
                                echo "<td colspan = '2'> $value</td>";
                                /*   echo "<td>(1-5)min </td>"; */
                                echo "</tr>";
                            }
                        }

                        if (isset($value) and !empty($value)) {
                            if ($key == 'BloodGroup') {
                                echo "<tr>";
                                echo "<td colspan = '2'>  Blood Group   </td>";
                                /*  echo "<td>%</td>";  */
                                echo "<td colspan = '2'> $value</td>";
                                /*   echo "<td>(1-5)min </td>"; */
                                echo "</tr>";
                            }
                        }

                        if (isset($value) and !empty($value)) {
                            if ($key == 'HbGenotype') {
                                echo "<tr>";
                                echo "<td colspan = '2'>  Hb Genotype    </td>";
                                /*  echo "<td>%</td>";  */
                                echo "<td colspan = '2'> $value</td>";
                                /*   echo "<td>(1-5)min </td>"; */
                                echo "</tr>";
                            }
                        }

                        if (isset($value) and !empty($value)) {
                            if ($key == 'G6PD') {
                                echo "<tr>";
                                echo "<td colspan = '2'> G6PD </td>";
                                /*  echo "<td>%</td>";  */
                                echo "<td colspan = '2'> $value</td>";
                                /*   echo "<td>(1-5)min </td>"; */
                                echo "</tr>";
                            }
                        }

                        if (isset($value) and !empty($value)) {
                            if ($key == 'BoneMarrow') {
                                echo "<tr>";
                                echo "<td>  Bone Marrow / Comment    </td>";
                                /*  echo "<td>%</td>";  */
                                echo "<td colspan = '3'> $value</td>";
                                /*   echo "<td>(1-5)min </td>"; */
                                echo "</tr>";
                            }
                        }

                        if (isset($value) and !empty($value)) {
                            if ($key == 'Notes') {
                                echo "<tr>";
                                echo "<td> Scientist's Note      </td>";
                                /*  echo "<td>%</td>";  */
                                echo "<td colspan = '3'> $value </td>";
                                /*   echo "<td>(1-5)min </td>"; */
                                echo "</tr>";
                            }
                        }
                    }

                    if (isset($result->path_note) and !empty($result->path_note)) { ?>
                        <tr>
                            <td> Pathologist Note </td>
                            <td colspan='3'> <textarea class='form-control' col='80' row='100'> <?php echo $result->path_note ?> </textarea></td>
                        </tr>

                    <?php  }
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