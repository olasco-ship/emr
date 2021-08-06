<div class="row clearfix">
    <div class="col-lg-12" >        

    <ul class="nav nav-tabs-new2">
        <li class="nav-item nav-link-goto active show"><a class="nav-link nav-link-goto active show" data-toggle="tab" href="#Contact-withicon">Previous Vitals</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#newVitals">New Vitals</a></li>
    </ul>

    </div>
    <div class="col-lg-12">
        <div class="tab-content">
            <div class="tab-pane show active" id="Contact-withicon">
                <div class="container">
                    <h5>Previous Vitals</h5>
                    <div class="alert alert-info alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert"
                                aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                        <i class="fa fa-info-circle"></i> Most recent Patient's vitals
                    </div>


                    <div id="accordion">
                        <?php
                        $vitals = Vitals::find_by_patient_vitals($waiting_list->patient_id);
                        foreach ($vitals as $vital) {
                            ?>

                            <div class="card">
                                <div class="card-header">
                                    <a class="card-link" data-toggle="collapse"
                                    href="#collapse<?php echo $vital->id; ?>">
                                        <?php $d_date = date('d/m/Y h:i a', strtotime($vital->date));
                                        echo $d_date ?>
                                    </a>
                                </div>
                                <div id="collapse<?php echo $vital->id; ?>" class="collapse"
                                    >
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="table-responsive">
                                                    <h5> Vital Signs as
                                                        at <?php $d_date = date('d/m/Y h:i a', strtotime($vital->date));
                                                        echo $d_date ?></h5>
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                        <tr>
                                                            <?php
                                                            if (isset($vital->temperature) and (!empty($vital->temperature))) {
                                                                echo "<th>Temperature</th>";
                                                                echo "<td> $vital->temperature</td>";
                                                            }
                                                            ?>
                                                        </tr>
                                                        <tr>
                                                            <?php
                                                            if (isset($vital->pulse) and (!empty($vital->pulse))) {
                                                                echo "<th> Heart Rate(Pulse) </th>";
                                                                echo "<td> $vital->pulse</td>";
                                                            }
                                                            ?>
                                                        </tr>
                                                        <tr>
                                                            <?php
                                                            if (isset($vital->resp_rate) and (!empty($vital->resp_rate))) {
                                                                echo "<th> Respiratory Rate </th>";
                                                                echo "<td> $vital->resp_rate</td>";
                                                            }
                                                            ?>
                                                        </tr>
                                                        <tr>
                                                            <?php
                                                            if (isset($vital->pressure) and (!empty($vital->pressure))) {
                                                                echo "<th>Blood Pressure</th>";
                                                                echo "<td> $vital->pressure</td>";
                                                            }
                                                            ?>
                                                        </tr>
                                                        <tr>
                                                            <?php
                                                            if (isset($vital->weight) and (!empty($vital->weight))) {
                                                                echo "<th> Weight </th>";
                                                                echo "<td> $vital->weight</td>";
                                                            }
                                                            ?>
                                                        </tr>
                                                        <tr>
                                                            <?php
                                                            if (isset($vital->height) and (!empty($vital->height))) {
                                                                echo "<th> Height </th>";
                                                                echo "<td> $vital->height</td>";
                                                            }
                                                            ?>
                                                        </tr>
                                                        <tr>
                                                            <?php
                                                            if (isset($vital->pain) and (!empty($vital->pain))) {
                                                                echo "<th> Pain </th>";
                                                                echo "<td> $vital->pain</td>";
                                                            }
                                                            ?>
                                                        </tr>
                                                        <tr>
                                                            <?php
                                                            if (isset($vital->urinalysis) and (!empty($vital->urinalysis))) {
                                                                echo "<th> Urinalysis </th>";
                                                                echo "<td> $vital->urinalysis</td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if (isset($vital->rbs) and (!empty($vital->rbs))) {
                                                                echo "<th> RBS </th>";
                                                                echo "<td> $vital->rbs</td>";
                                                            }
                                                            ?>
                                                        </tr>

                                                        </tbody>
                                                    </table>
                                                    <?php
                                                        if (isset($vital->comment) and (!empty($vital->comment)))
                                                            echo $vital->comment;
                                                    ?>
                                                    <p class="text-info"
                                                    style="font-size: larger"><code></code>
                                                        Vitals Done
                                                        By <?php echo $vital->nurse ?>
                                                    </p>


                                                </div>
                                            </div>
                                            <!-- <div class="col-md-6">
                                                <div class="table-responsive">
                                                    <?php
                                                    // if (!empty($subClinic)) {
                                                    //     $clinic = Clinic::find_by_id($subClinic->clinic_id); ?>
                                                    <h5> Clinical Vital Signs </h5>
                                                    <?php
                                                    // $decoded = $vital->clinical_vitals;
                                                    //     $array = json_decode($decoded); ?>
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                        <tr>
                                                            <th>CLINIC</th>
                                                            <th><?php //echo $clinic->name ?></th>
                                                        </tr>
                                                        <?php
                                                       // foreach ($array as $key => $value) { ?>
                                                            <tr>
                                                                <th><?php //echo $key ?></th>
                                                                <td><?php //echo $value ?></td>
                                                            </tr>
                                                        <?php //}
                                                   // } ?>

                                                    </table>
                                                </div>
                                            </div> -->

                                        </div>

                                    </div>
                                </div>
                            </div>
                        <?php } ?>


                    </div>


                </div>

            </div>

            <!-- New Vitals --> 

            <div class="tab-pane" id="newVitals">
                <div class="col-lg-12 col-md-12">
                <!--<h6>New Vitals</h6>-->
                    <form action="" method="post">
                        <div class="row">

                            <div class="col-md-5">

                                <h4><u> General Vitals</u></h4>


                                <div class="table-responsive">
                                    <table>
                                        <tr>
                                            <th>Temperature</th>
                                            <td style='padding-left: 30px'><input type="text"
                                                                                    name="temperature"
                                                                                    required
                                                                                    class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Heart Rate(Pulse)</th>
                                            <td style='padding-left: 30px'><input type="text"
                                                                                    name="heart_rate"
                                                                                    class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Respiratory Rate</th>
                                            <td style='padding-left: 30px'><input type="text"
                                                                                    name="respiration"
                                                                                    class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Blood Pressure</th>
                                            <td style='padding-left: 30px'><input type="text"
                                                                                    name="pressure"
                                                                                    required
                                                                                    class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Weight</th>
                                            <td style='padding-left: 30px'><input type="text"
                                                                                    name="weight"
                                                                                    required
                                                                                    class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Height</th>
                                            <td style='padding-left: 30px'><input type="text"
                                                                                    name="height"
                                                                                    class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Pain</th>
                                            <td style='padding-left: 30px'><input type="text"
                                                                                    name="pain"
                                                                                    class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Urinalysis</th>
                                            <td style='padding-left: 30px'><input type="text"
                                                                                    name="urinalysis"
                                                                                    class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>RBS</th>
                                            <td style='padding-left: 30px'><input type="text"
                                                                                    name="rbs"
                                                                                    class="form-control">
                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="2">
                                                <label> Comments </label>
                                                <textarea class="form-control" name="comment" rows="5" cols="30" ></textarea>
                                            </td>
                                        </tr>


                                        <tr>
                                            <th>
                                                <button type="submit" name="save_vitals"
                                                        class="btn btn-primary">Save Vitals
                                                </button>

                                            </th>
                                            <td style='padding-left: 30px'>

                                            </td>
                                        </tr>
                                    </table>

                                </div>


                            </div>
                            <!-- <div class="col-md-7">
                                <h4><u> Clinic Vitals</u></h4>
                                

                                <div class="table-responsive">
                                    <table>
                                        <tr>
                                            <th> Select Clinic</th>
                                            <td style='padding-left: 30px'>
                                                <select class="form-control" id="clinic_vitals"
                                                        name="clinic_id" required>
                                                    <option value="">--Select Clinic--</option>
                                                    <?php
                                                    // $finds = Clinic::find_all();
                                                    // foreach ($finds as $find) { ?>
                                                        <option value="<?php //echo $find->id; ?>"><?php //echo $find->name; ?></option>
                                                    <?php //} ?>
                                                </select>
                                            </td>
                                        </tr>

                                    </table>
                                    <div id="clin_vitals">
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>