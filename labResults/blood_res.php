<?php


$result = Result::find_by_waiting_list_id($waitList->id);
$patient = Patient::find_by_id($result->patient_id);
$user = User::find_by_id($session->user_id);

?>

<h4 style="text-align: center">OBAFEMI AWOLOWO UNIVERSITY TEACHING HOSPITALS COMPLEX, ILE IFE</h4>
<?php
if ($result->status == 'PRELIM') {
    echo "<h6 style='text-align: center'><b>PRELIMINARY BLOOD TRANSFUSION RESULT</b></h6>";
} else if ($result->status == 'FINAL') {
    echo "<h6 style='text-align: center'><b>FINAL BLOOD TRANSFUSION RESULT</b></h6>";
}
?>


<div class="row">
    <div class="col-md-6">


        <div class="table-responsive">
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

        Blood Transfusion

    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-12 col-sm-12 col-lg-12">

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
                            if ($key == 'no_whole_blood') {
                                echo "<tr>";
                                echo "<td><b>Number of Unit of Whole Blood Required</b></td>";
                                echo "<td style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'no_red_cell') {
                                echo "<tr>";
                                echo "<td><b>Number of Units of Red Cell Concentrate(packed red cells)</b></td>";
                                echo "<td style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'other_blood') {
                                echo "<tr>";
                                echo "<td><b>Other Blood Components(please state)</b></td>";
                                echo "<td style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'exchange') {
                                echo "<tr>";
                                echo "<td><b>Exchange Blood Transfusion</b></td>";
                                echo "<td style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'abo_rh') {
                                echo "<tr>";
                                echo "<td><b>ABO and Rh Grouping Only</b></td>";
                                echo "<td style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'hep_c') {
                                echo "<tr>";
                                echo "<td><b>Hepatitis 'C' Surface Ag Screening</b></td>";
                                echo "<td style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'coombs_test') {
                                echo "<tr>";
                                echo "<td><b>Direct Coombs' Test</b></td>";
                                echo "<td style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'ind_coombs_test') {
                                echo "<tr>";
                                echo "<td><b>Indirect Coombs' Test</b></td>";
                                echo "<td style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'anti_screening') {
                                echo "<tr>";
                                echo "<td><b>Other Antibody Screening</b></td>";
                                echo "<td style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'hep_b') {
                                echo "<tr>";
                                echo "<td><b> HBsAg Screening </b></td>";
                                echo "<td style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'hbs_ab') {
                                echo "<tr>";
                                echo "<td><b> HBsAb </b></td>";
                                echo "<td style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'hbe_ag') {
                                echo "<tr>";
                                echo "<td><b> HBeAg </b></td>";
                                echo "<td style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'hbe_ab') {
                                echo "<tr>";
                                echo "<td><b> HBeAb </b></td>";
                                echo "<td style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'hbc_ab') {
                                echo "<tr>";
                                echo "<td><b> HBcAb(Total) </b></td>";
                                echo "<td style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'hbc_ab_igm') {
                                echo "<tr>";
                                echo "<td><b> HBcAb(IgM) </b></td>";
                                echo "<td style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'hiv') {
                                echo "<tr>";
                                echo "<td><b> HIV Screening (I x II) </b></td>";
                                echo "<td style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'syplius') {
                                echo "<tr>";
                                echo "<td><b> Syphilis Screening </b></td>";
                                echo "<td style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'type_crossmatch') {
                                echo "<tr>";
                                echo "<td><b> Type of Cross Match Required </b></td>";
                                echo "<td style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'normal') {
                                echo "<tr>";
                                echo "<td><b> Normal  </b></td>";
                                echo "<td style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'emergency') {
                                echo "<tr>";
                                echo "<td><b> Emergency(15mins)  </b></td>";
                                echo "<td style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'other') {
                                echo "<tr>";
                                echo "<td><b> Others  </b></td>";
                                echo "<td style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'rec_prev_tran') {
                                echo "<tr>";
                                echo "<td><b> Record Of Previous Transfusion(Date and Time)  </b></td>";
                                echo "<td style='text-align: center'>$value</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    ?>
            </div>
        </div>

        <div class="row">

            <div class="col-md-6">

                <table>
                    <h5>ABO/Rh</h5>

                    <?php

                    $result->resultData;
                    $decode = json_decode($result->resultData);

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'group_one') {
                                echo "<tr>";
                                echo "<td><b> Grp.  </b></td>";
                                echo "<td style='padding-left: 100px'><input class='form-control' value='$value' readonly /></td>";
                                echo "</tr>";
                            }

                            if ($key == 'group_two') {
                                echo "<tr>";
                                echo "<td><b> Grp.  </b></td>";
                                echo "<td style='padding-left: 100px'><input class='form-control' value='$value' readonly /></td>";
                                echo "</tr>";
                            }

                            if ($key == 'group_three') {
                                echo "<tr>";
                                echo "<td><b> Grp.  </b></td>";
                                echo "<td style='padding-left: 100px'><input class='form-control' value='$value' readonly /></td>";
                                echo "</tr>";
                            }

                            if ($key == 'group_four') {
                                echo "<tr>";
                                echo "<td><b> Grp.  </b></td>";
                                echo "<td style='padding-left: 100px'><input class='form-control' value='$value' readonly /></td>";
                                echo "</tr>";
                            }
                        }
                    }

                    ?>

                </table>

            </div>
            <div class="col-md-6">
                <h5>Date/Time</h5>
                <dl class="dl-horizontal">

                    <?php

                    $result->resultData;
                    $decode = json_decode($result->resultData);

                    foreach ($decode as $key => $value) {
                        if (isset($value) and !empty($value)) {
                            if ($key == 'rh_one') {
                                echo "<dt> </dt>";
                                echo "<dd><input class='form-control' style='width: 150px;' value='$value' readonly /> </dd>";
                            }

                            if ($key == 'rh_two') {
                                echo "<dt> </dt>";
                                echo "<dd><input class='form-control' style='width: 150px;' value='$value' readonly /> </dd>";
                            }

                            if ($key == 'rh_three') {
                                echo "<dt> </dt>";
                                echo "<dd><input class='form-control' style='width: 150px;' value='$value' readonly /> </dd>";
                            }

                            if ($key == 'rh_four') {
                                echo "<dt> </dt>";
                                echo "<dd><input class='form-control' style='width: 150px;' value='$value' readonly /> </dd>";
                            }
                        }
                    } ?>

                </dl>
            </div>

        </div>

        <div class="row">

            <div class="col-md-12">

                <?php

                $result->resultData;
                $decode = json_decode($result->resultData);

                foreach ($decode as $key => $value) {
                    if (isset($value) and !empty($value)) {
                        if ($key == 'rep_ser_inv') {    ?>

                            <div class="form-group">
                                <label for="quantity" class="control-label col-md-12"> REPORT OF SEROLOGICAL INVESTIGATION:</label>
                                <div class="col-md-12" style="width: 500px">
                                    <textarea class="form-control"><?php echo $value ?>  </textarea>
                                </div>
                            </div>

                <?php
                        }
                    }
                }
                ?>

            </div>

        </div>

    </div>

</div>