<?php



$result = Result::find_by_waiting_list_id($waitList->id);
$patient = Patient::find_by_id($result->patient_id);
$user = User::find_by_id($session->user_id);


?>




<h4 style="text-align: center">OBAFEMI AWOLOWO UNIVERSITY TEACHING HOSPITALS COMPLEX</h4>
<h6 style="text-align: center">HISTOLOGY FORM</h6>


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

        Histology

    </div>

    <div class="card-body">

        <?php
        $result->resultData;
        $decode = json_decode($result->resultData);
        if (isset($result->resultData) and !empty($result->resultData)) {

        ?>

            <div class="row">
                <div class="col-md-6">

                    <div class="form-group">
                        <label>HISTOPATHOLOGY</label>
                        <br />
                        <?php foreach ($decode as $key => $value) {
                            if ($key == 'Processing') {
                        ?>
                                <label class="fancy-checkbox">
                                    <input type="checkbox" name="Processing" value="Processing" <?= ($value == "Processing") ? "checked='checked'" : "" ?>>
                                    <span>Processing</span>
                                </label>
                        <?php  }
                        }
                        ?>
                        <br />

                        <?php foreach ($decode as $key => $value) {
                            if ($key == 'Microtomy') {
                        ?>
                                <label class="fancy-checkbox">
                                    <input type="checkbox" name="Microtomy" value="Microtomy" <?= ($value == "Microtomy") ? "checked='checked'" : "" ?>>
                                    <span>Microtomy</span>
                                </label>
                        <?php  }
                        }
                        ?>
                        <br />

                        <?php foreach ($decode as $key => $value) {
                            if ($key == 'HE') {
                        ?>
                                <label class="fancy-checkbox">
                                    <input type="checkbox" name="H&E" value="H&E" <?= ($value == "H&E") ? "checked='checked'" : "" ?>>
                                    <span>H & E</span>
                                </label>
                        <?php  }
                        }
                        ?>
                        <br />

                        <?php foreach ($decode as $key => $value) {
                            if ($key == 'SpecialStain') {
                        ?>
                                <label class="fancy-checkbox">
                                    <input type="checkbox" name="SpecialStain" value="SpecialStain" <?= ($value == "SpecialStain") ? "checked='checked'" : "" ?>>
                                    <span>Special Stain</span>
                                </label>
                        <?php  }
                        }
                        ?>
                        <br />

                        <p id="error-checkbox"></p>
                    </div>

                    <div class="form-group">
                        <label>CYTOPATHOLOGY</label>
                        <br />
                        <?php foreach ($decode as $key => $value) {
                            if ($key == 'CytoProcessing') {
                        ?>
                                <label class="fancy-checkbox">
                                    <input type="checkbox" name="CytoProcessing" value="CytoProcessing" <?= ($value == "CytoProcessing") ? "checked='checked'" : "" ?>>
                                    <span> Processing </span>
                                </label>
                        <?php  }
                        }
                        ?> <br />

                        <?php foreach ($decode as $key => $value) {
                            if ($key == 'CytoStaining') {
                        ?>
                                <label class="fancy-checkbox">
                                    <input type="checkbox" name="CytoStaining" value="CytoStaining" <?= ($value == "CytoStaining") ? "checked='checked'" : "" ?>>
                                    <span> Staining </span>
                                </label>
                        <?php  }
                        }
                        ?> <br />

                        <p id="error-checkbox"></p>
                    </div>

                    <div class="form-group">

                        <?php foreach ($decode as $key => $value) {
                            if ($key == 'FrozenSection') {
                        ?>
                                <label class="fancy-checkbox">
                                    <input type="checkbox" name="FrozenSection" value="FrozenSection" <?= ($value == "FrozenSection") ? "checked='checked'" : "" ?>>
                                    <span>FROZEN SECTION</span>
                                </label>
                        <?php  }
                        }
                        ?> <br />

                        <p id="error-checkbox"></p>
                    </div>


                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>IMMUNOHISTOCHEMISTRY</label>
                                <br /> <br />
                                <label class="fancy-checkbox">
                                    <input type="checkbox" name="Breast Panel" value="Breast Panel">
                                    <!--  <span>Breast Panel</span> -->
                                    <label><b> Breast Panel </b></label>
                                </label>

                                <br />

                                <?php foreach ($decode as $key => $value) {
                                    if ($key == 'ER') {
                                ?>
                                        <label class="fancy-checkbox">
                                            <input type="checkbox" name="ER" value="ER" <?= ($value == "ER") ? "checked='checked'" : "" ?>>
                                            <span>ER</span>
                                        </label>
                                <?php  }
                                }
                                ?>
                                <br />

                                <?php foreach ($decode as $key => $value) {
                                    if ($key == 'PR') {
                                ?>
                                        <label class="fancy-checkbox">
                                            <input type="checkbox" name="PR" value="PR" <?= ($value == "PR") ? "checked='checked'" : "" ?>>
                                            <span>PR</span>
                                        </label>
                                <?php  }
                                }
                                ?>
                                <br />

                                <?php foreach ($decode as $key => $value) {
                                    if ($key == 'HER') {
                                ?>
                                        <label class="fancy-checkbox">
                                            <input type="checkbox" name="HER-2" value="HER-2" <?= ($value == "HER-2") ? "checked='checked'" : "" ?>>
                                            <span>HER-2</span>
                                        </label>
                                <?php  }
                                }
                                ?>
                                <br />

                                <?php foreach ($decode as $key => $value) {
                                    if ($key == 'BreastOthers') {
                                ?>
                                        <label class="fancy-checkbox">
                                            <input type="checkbox" name="breast_others" value="breast_others" <?= ($value == "breast_others") ? "checked='checked'" : "" ?>>
                                            <span>Others</span>
                                        </label>
                                <?php  }
                                }
                                ?>
                                <br />


                                <p id="error-checkbox"></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">

                                <br /><br />
                                <label class="fancy-checkbox">
                                    <input type="checkbox" name="Lymphoma" value="Lymphoma">
                                    <label><b> Lymphoma </b></label>
                                </label>

                                <?php foreach ($decode as $key => $value) {
                                    if ($key == 'CD3') {
                                ?>
                                        <label class="fancy-checkbox">
                                            <input type="checkbox" name="CD3" value="CD3" <?= ($value == "CD3") ? "checked='checked'" : "" ?>>
                                            <span>CD3</span>
                                        </label>
                                <?php  }
                                }
                                ?><br />

                                <?php foreach ($decode as $key => $value) {
                                    if ($key == 'CD20') {
                                ?>
                                        <label class="fancy-checkbox">
                                            <input type="checkbox" name="CD20" value="CD20" <?= ($value == "CD20") ? "checked='checked'" : "" ?>>
                                            <span>CD20</span>
                                        </label>
                                <?php  }
                                }
                                ?><br />

                                <?php foreach ($decode as $key => $value) {
                                    if ($key == 'CD15') {
                                ?>
                                        <label class="fancy-checkbox">
                                            <input type="checkbox" name="CD15" value="CD15" <?= ($value == "CD15") ? "checked='checked'" : "" ?>>
                                            <span>CD15</span>
                                        </label>
                                <?php  }
                                }
                                ?><br />

                                <?php foreach ($decode as $key => $value) {
                                    if ($key == 'CD10') {
                                ?>
                                        <label class="fancy-checkbox">
                                            <input type="checkbox" name="CD10" value="CD10" <?= ($value == "CD10") ? "checked='checked'" : "" ?>>
                                            <span>CD10</span>
                                        </label>
                                <?php  }
                                }
                                ?><br />

                                <?php foreach ($decode as $key => $value) {
                                    if ($key == 'CD45') {
                                ?>
                                        <label class="fancy-checkbox">
                                            <input type="checkbox" name="CD45" value="CD45" <?= ($value == "CD45") ? "checked='checked'" : "" ?>>
                                            <span>CD45</span>
                                        </label>
                                <?php  }
                                }
                                ?><br />

                                <?php foreach ($decode as $key => $value) {
                                    if ($key == 'CD117') {
                                ?>
                                        <label class="fancy-checkbox">
                                            <input type="checkbox" name="CD117" value="CD117" <?= ($value == "CD117") ? "checked='checked'" : "" ?>>
                                            <span>CD117</span>
                                        </label>
                                <?php  }
                                }
                                ?><br />

                                <?php foreach ($decode as $key => $value) {
                                    if ($key == 'Ki67') {
                                ?>
                                        <label class="fancy-checkbox">
                                            <input type="checkbox" name="Ki67" value="Ki67" <?= ($value == "Ki67") ? "checked='checked'" : "" ?>>
                                            <span>Ki67</span>
                                        </label>
                                <?php  }
                                }
                                ?><br />

                                <?php foreach ($decode as $key => $value) {
                                    if ($key == 'lymph_others') {
                                ?>
                                        <label class="fancy-checkbox">
                                            <input type="checkbox" name="lymph_others" value="lymph_others" <?= ($value == "lymph_others") ? "checked='checked'" : "" ?>>
                                            <span>Others</span>
                                        </label>
                                <?php  }
                                }
                                ?><br />

                                <p id="error-checkbox"></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">

                                <br /><br />
                                <label class="fancy-checkbox">
                                    <input type="checkbox" name="Soft Tissue" value="Soft Tissue">
                                    <!--  <span>Soft Tissue</span> -->
                                    <label><b> Soft Tissue </b></label>
                                </label> <br />

                                <?php foreach ($decode as $key => $value) {
                                    if ($key == 'WTI') {
                                ?>
                                        <label class="fancy-checkbox">
                                            <input type="checkbox" name="WTI" value="WTI" <?= ($value == "WTI") ? "checked='checked'" : "" ?>>
                                            <span>WTI</span>
                                        </label>
                                <?php  }
                                }
                                ?><br />

                                <?php foreach ($decode as $key => $value) {
                                    if ($key == 'EMA') {
                                ?>
                                        <label class="fancy-checkbox">
                                            <input type="checkbox" name="EMA" value="EMA" <?= ($value == "EMA") ? "checked='checked'" : "" ?>>
                                            <span>EMA</span>
                                        </label>
                                <?php  }
                                }
                                ?><br />

                                <?php foreach ($decode as $key => $value) {
                                    if ($key == 'CEA') {
                                ?>
                                        <label class="fancy-checkbox">
                                            <input type="checkbox" name="CEA" value="CEA" <?= ($value == "CEA") ? "checked='checked'" : "" ?>>
                                            <span>CEA</span>
                                        </label>
                                <?php  }
                                }
                                ?><br />

                                <?php foreach ($decode as $key => $value) {
                                    if ($key == 'soft_others') {
                                ?>
                                        <label class="fancy-checkbox">
                                            <input type="checkbox" name="soft_others" value="soft_others" <?= ($value == "soft_others") ? "checked='checked'" : "" ?>>
                                            <span>Others</span>
                                        </label>
                                <?php  }
                                }
                                ?><br />

                                <p id="error-checkbox"></p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>IMMUNOFLOURESCENCE</label>
                                <br /> <br />

                                <?php foreach ($decode as $key => $value) {
                                    if ($key == 'C3C') {
                                ?>
                                        <label class="fancy-checkbox">
                                            <input type="checkbox" name="C3C" value="C3C" <?= ($value == "C3C") ? "checked='checked'" : "" ?>>
                                            <span>C3C</span>
                                        </label>
                                <?php  }
                                }
                                ?><br />

                                <?php foreach ($decode as $key => $value) {
                                    if ($key == 'IgA') {
                                ?>
                                        <label class="fancy-checkbox">
                                            <input type="checkbox" name="IgA" value="IgA" <?= ($value == "IgA") ? "checked='checked'" : "" ?>>
                                            <span>IgA</span>
                                        </label>
                                <?php  }
                                }
                                ?><br />

                                <?php foreach ($decode as $key => $value) {
                                    if ($key == 'IgG') {
                                ?>
                                        <label class="fancy-checkbox">
                                            <input type="checkbox" name="IgG" value="IgG" <?= ($value == "IgG") ? "checked='checked'" : "" ?>>
                                            <span>IgG</span>
                                        </label>
                                <?php  }
                                }
                                ?><br />

                                <?php foreach ($decode as $key => $value) {
                                    if ($key == 'IgM') {
                                ?>
                                        <label class="fancy-checkbox">
                                            <input type="checkbox" name="IgM" value="IgM" <?= ($value == "IgM") ? "checked='checked'" : "" ?>>
                                            <span>IgM</span>
                                        </label>
                                <?php  }
                                }
                                ?><br />

                                <?php foreach ($decode as $key => $value) {
                                    if ($key == 'fluo_others') {
                                ?>
                                        <label class="fancy-checkbox">
                                            <input type="checkbox" name="fluo_others" value="fluo_others" <?= ($value == "fluo_others") ? "checked='checked'" : "" ?>>
                                            <span>Others</span>
                                        </label>
                                <?php  }
                                }
                                ?><br />

                                <p id="error-checkbox"></p>
                            </div>
                        </div>
                        <div class="col-md-4">

                        </div>
                        <div class="col-md-4">

                        </div>
                    </div>



                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label> CUT-UP </label>
                        <br />
                        <?php foreach ($decode as $key => $value) {
                            if ($key == 'Decalafication') {
                        ?>
                                <label class="fancy-checkbox">
                                    <input type="checkbox" name="Decalafication" value="Decalafication" <?= ($value == "Decalafication") ? "checked='checked'" : "" ?>>
                                    <span>For Decalafication</span>
                                </label>
                        <?php  }
                        }
                        ?><br />

                        <?php foreach ($decode as $key => $value) {
                            if ($key == 'Cassettes') {
                        ?>
                                <label class="fancy-checkbox">
                                    <input type="checkbox" name="Cassettes" value="Cassettes" <?= ($value == "Cassettes") ? "checked='checked'" : "" ?>>
                                    <span>No Of Cassettes</span>
                                </label>
                        <?php  }
                        }
                        ?><br />


                    </div>

                    <?php foreach ($decode as $key => $value) {
                        if ($key == 'macroscopy_note') {
                    ?>
                            <div class="form-group">
                                <b>MACROSCOPY </b> <br/>
                                <?php echo $value; ?>
                                <!--
                                <textarea rows="35" cols="50" class="form-control" name="macroscopy_note">
                                                                    <?php echo $value; ?>
                                                                </textarea>
                                                                -->
                            </div>

                    <?php  }
                    }
                    ?>


                </div>
            </div>


        <?php
        }  ?>
    </div>

</div>