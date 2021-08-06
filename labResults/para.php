<?php



//$result = Result::find_by_id($_GET['id']);
//$patient = Patient::find_by_id($result->patient_id);
//$user = User::find_by_id($session->user_id);


?>

<h6 style="text-align: center">DEPARTMENT OF MEDICAL MICROBIOLOGY AND PARASITOLOGY</h6>
<?php
if ($result->status == 'PRELIM') {
    echo "<h6 style='text-align: center'><b>PRELIMINARY PARASITOLOGY RESULT</b></h6>";
} else if ($result->status == 'FINAL') {
    echo "<h6 style='text-align: center'><b>FINAL PARASITOLOGY RESULT</b></h6>";
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

        Parasitology

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
                            if ($key == 'macroscopy') {
                                echo "<tr>";
                                echo "<td><b>Stool Analysis</b></td>";
                                echo "<td style='text-align: center'></td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'macroscopy') {
                                echo "<tr>";
                                echo "<td>Macroscopy</td>";
                                echo "<td>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'microscopy') {
                                echo "<tr>";
                                echo "<td>Microscopy</td>";
                                echo "<td>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'others') {
                                echo "<tr>";
                                echo "<td>Others</td>";
                                echo "<td>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'mp') {
                                echo "<tr>";
                                echo "<td><b>Blood Parasite</b></td>";
                                echo "<td></td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'mp') {
                                echo "<tr>";
                                echo "<td>Malaria Parasite</td>";
                                echo "<td>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'microfilaria') {
                                echo "<tr>";
                                echo "<td>Microfilaria</td>";
                                echo "<td>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'Trypanosomes') {
                                echo "<tr>";
                                echo "<td>Trypanosomes</td>";
                                echo "<td>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'skin_snip') {
                                echo "<tr>";
                                echo "<td colspan='2'><b> Skin Snip </b></td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'skin_snip') {
                                echo "<tr>";
                                echo "<td colspan='2'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'sputum_macro') {
                                echo "<tr>";
                                echo "<td><b> SPUTUM ANALYSIS  </b></td>";
                                echo "<td></td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'sputum_macro') {
                                echo "<tr>";
                                echo "<td>Macroscopy</td>";
                                echo "<td >$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'sputum_micro') {
                                echo "<tr>";
                                echo "<td>Microscopy</td>";
                                echo "<td>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'notes') {
                                echo "<tr>";
                                echo "<td>Remark</td>";
                                echo "<td>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }



                    ?>
                </table>


            </div>

        </div>