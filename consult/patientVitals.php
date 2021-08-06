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
        $vitals = Vitals::find_by_patient_vitals($patient->id);
        foreach ($vitals as $vit) {
            ?>

            <div class="card">
                <div class="card-header">
                    <a class="card-link" data-toggle="collapse"
                       href="#collapse<?php echo $vit->id; ?>">
                        <?php $d_date = date('d/m/Y h:i a', strtotime($vit->date));
                        echo $d_date ?>
                    </a>
                </div>
                <div id="collapse<?php echo $vit->id; ?>" class="collapse"
                     data-parent="#accordion">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <h5> Vital Signs as
                                        at <?php $d_date = date('d/m/Y h:i a', strtotime($vit->date));
                                        echo $d_date ?></h5>
                                    <table class="table table-bordered">
                                        <tbody>
                                        <tr>
                                            <?php
                                            if (isset($vit->temperature) and (!empty($vit->temperature))) {
                                                echo "<th>Temperature</th>";
                                                echo "<td> $vit->temperature</td>";
                                            }
                                            ?>
                                        </tr>
                                        <tr>
                                            <?php
                                            if (isset($vit->pulse) and (!empty($vit->pulse))) {
                                                echo "<th> Heart Rate(Pulse) </th>";
                                                echo "<td> $vit->pulse</td>";
                                            }
                                            ?>
                                        </tr>
                                        <tr>
                                            <?php
                                            if (isset($vit->resp_rate) and (!empty($vit->resp_rate))) {
                                                echo "<th> Respiratory Rate </th>";
                                                echo "<td> $vit->resp_rate</td>";
                                            }
                                            ?>
                                        </tr>
                                        <tr>
                                            <?php
                                            if (isset($vit->pressure) and (!empty($vit->pressure))) {
                                                echo "<th>Blood Pressure</th>";
                                                echo "<td> $vit->pressure</td>";
                                            }
                                            ?>
                                        </tr>
                                        <tr>
                                            <?php
                                            if (isset($vit->weight) and (!empty($vit->weight))) {
                                                echo "<th> Weight </th>";
                                                echo "<td> $vit->weight</td>";
                                            }
                                            ?>
                                        </tr>
                                        <tr>
                                            <?php
                                            if (isset($vit->height) and (!empty($vit->height))) {
                                                echo "<th> Height </th>";
                                                echo "<td> $vit->height</td>";
                                            }
                                            ?>
                                        </tr>
                                        <tr>
                                            <?php
                                            if (isset($vit->pain) and (!empty($vit->pain))) {
                                                echo "<th> Pain </th>";
                                                echo "<td> $vit->pain</td>";
                                            }
                                            ?>
                                        </tr>
                                        <tr>
                                            <?php
                                            if (isset($vit->urinalysis) and (!empty($vit->urinalysis))) {
                                                echo "<th> Urinalysis </th>";
                                                echo "<td> $vit->urinalysis</td>";
                                            }
                                            ?>
                                        </tr>

                                        <tr>
                                            <?php
                                            if (isset($vit->rbs) and (!empty($vit->rbs))) {
                                                echo "<th> RBS </th>";
                                                echo "<td> $vit->rbs</td>";
                                            }
                                            ?>
                                        </tr>

                                        </tbody>
                                    </table>
                                    <?php
                                    if (isset($vit->comment) and (!empty($vit->comment)))
                                        echo $vit->comment;
                                    ?>
                                    <p class="text-info"
                                       style="font-size: larger"><code></code>
                                        Vitals Done
                                        By <?php echo $vit->nurse ?>
                                    </p>


                                </div>
                            </div>
                           <!-- <div class="col-md-6">
                                <div class="table-responsive">
                                    <?php
/*                                    $clinic = Clinic::find_by_id($subClinic->clinic_id);
                                    */?>
                                    <h5> Clinical Vital Signs </h5>
                                    <?php
/*                                    $decoded = $vit->clinical_vitals;
                                    $array = json_decode($decoded);
                                    */?>
                                    <table class="table table-bordered">
                                        <tbody>
                                        <tr>
                                            <th>CLINIC</th>
                                            <th><?php /*echo $clinic->name */?></th>
                                        </tr>
                                        <?php
/*                                        foreach ($array as $key => $value) { */?>
                                            <tr>
                                                <th><?php /*echo $key */?></th>
                                                <td><?php /*echo $value */?></td>
                                            </tr>
                                        <?php /*} */?>

                                    </table>
                                </div>
                            </div>-->

                        </div>

                    </div>
                </div>
            </div>
        <?php } ?>

    </div>
</div>
