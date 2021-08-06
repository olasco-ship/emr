



                    <div class="tab-pane show active" id="PatientDetails">

                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page"><b> VITAL SIGNS
                                    </b></li>
                            </ol>
                        </nav>
                        <?php
                        $vitals    = Vitals::find_by_waiting_list($waitList->id);
                        foreach ($vitals as $vital) {
                            ?>
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

                                            <tr>
                                                <?php
                                                if (isset($vital->bmi) and (!empty($vital->bmi))) {
                                                    echo "<th> BMI </th>";
                                                    echo "<td> $vital->bmi</td>";
                                                }
                                                ?>
                                            </tr>

                                            </tbody>
                                        </table>
                                        <?php
                                        if (isset($vital->comment) and (!empty($vital->comment)))
                                            echo $vital->comment;
                                        ?>
                                        <p class="text-info" style="font-size: larger"><code></code>
                                            Vitals Done
                                            By <?php echo $vital->nurse ?>
                                        </p>


                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="table-responsive">
                                        <?php


                                        $subClinic = SubClinic::find_by_id($vital->sub_clinic_id);

                                        $clinic = Clinic::find_by_id($subClinic->clinic_id);
                                        ?>
                                        <h5> Clinical Vital Signs </h5>
                                        <?php
                                        $decoded = $vital->clinical_vitals;
                                        $array = json_decode($decoded);
                                        ?>
                                        <table class="table table-bordered">
                                            <tbody>
                                            <tr>
                                                <th>CLINIC</th>
                                                <th><?php echo $clinic->name ?></th>
                                            </tr>
                                            <?php
                                            foreach ($array as $key => $value) { ?>
                                                <tr>
                                                    <th><?php echo $key ?></th>
                                                    <td><?php echo $value ?></td>
                                                </tr>
                                            <?php } ?>

                                        </table>
                                    </div>
                                </div>

                            </div>
                        <?php }  ?>

                        <?php
                        $case_note = CaseNote::find_open_case_note($waitList->id, $patient->id);
                        if (!empty($case_note)) {
                            ?>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active" aria-current="page"><b> CLINICAL NOTES
                                        </b></li>
                                </ol>
                            </nav>
                            <ul style="font-size: medium">
                                <?php
                                $case_note = CaseNote::find_open_case_note($waitList->id, $patient->id);
                                if (!empty($case_note)) {
                                    ?>
                                    <div class="col-sm-12">

                                        <table>
                                            <tr>
                                                <th>Complains</th>
                                                <?php $decoded = json_decode($case_note->complains);
                                                        foreach($decoded as $single){
                                                            ?>
                                                <td style="padding-left: 100px">
                                                           <?php echo $single . ", "; ?>
                                                </td>
                                                <?php
                                                        }
                                                ?>
                                            </tr>
                                            <tr>
                                                <th>Duration Of Complain</th>
                                                <?php $decoded = json_decode($case_note->duration);
                                                foreach($decoded as $single){
                                                    ?>
                                                    <td style="padding-left: 100px">
                                                        <?php echo $single . ", "; ?>
                                                    </td>
                                                    <?php
                                                }
                                                ?>
                                            </tr>
                                            <tr>
                                                <th>History Of Complain</th>
                                                <td style="padding-left: 100px"><?php echo $case_note->hpc ?></td>
                                            </tr>
                                            <tr>
                                                <th>Systemic Review</th>
                                                <td style="padding-left: 100px"><?php echo $case_note->sys_review ?></td>
                                            </tr>
                                            <tr>
                                                <th>Physical Examination</th>
                                                <td style="padding-left: 100px"><?php $decoded = json_decode($case_note->examination);
                                                    foreach($decoded as $single)
                                                        echo $single->general . ", ";
                                                    ?></td>
                                            </tr>

                                            <tr>
                                                <th>Condition of Examination</th>
                                                <td style="padding-left: 100px"><?php $decoded = json_decode($case_note->examination);
                                                    foreach($decoded as $single)
                                                        echo $single->condition . ", ";
                                                    ?></td>
                                            </tr>

                                            <tr>
                                                <th>Family History</th>
                                                <td style="padding-left: 100px"><?php echo $case_note->family_history ?></td>
                                            </tr>

                                            <tr>
                                                <th>Personal History</th>
                                                <td style="padding-left: 100px"><?php echo $case_note->personal_history ?></td>
                                            </tr>

                                            <tr>
                                                <th>Mental State</th>
                                                <td style="padding-left: 100px"><?php echo $case_note->mental_state ?></td>
                                            </tr>

                                            <?php
                                            if (isset($case_note->past_history) and !empty($case_note->past_history)){
                                                ?>
                                                <tr>
                                                    <th>Past Medical History</th>
                                                    <td style="padding-left: 100px"><?php echo $case_note->past_history ?></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>

                                            <?php
                                            if (isset($case_note->immune_history) and !empty($case_note->immune_history)){
                                                ?>
                                                <tr>
                                                    <th>Immunization History</th>
                                                    <td style="padding-left: 100px"><?php echo $case_note->immune_history ?></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>

                                            <?php
                                            if (isset($case_note->nutri_history) and !empty($case_note->nutri_history)){
                                                ?>
                                                <tr>
                                                    <th>Immunization History</th>
                                                    <td style="padding-left: 100px"><?php echo $case_note->nutri_history ?></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>

                                            <?php
                                            if (isset($case_note->dev_history) and !empty($case_note->dev_history)){
                                                ?>
                                                <tr>
                                                    <th>Developmental History</th>
                                                    <td style="padding-left: 100px"><?php echo $case_note->dev_history ?></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>

                                            <?php
                                            if (isset($case_note->soc_history) and !empty($case_note->soc_history)){
                                                ?>
                                                <tr>
                                                    <th>Social History</th>
                                                    <td style="padding-left: 100px"><?php echo $case_note->soc_history ?></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>

                                            <tr>
                                                <th>Systemic Examination</th>
                                                <?php $decoded = json_decode($case_note->systemic_examination);
                                                foreach($decoded as $single){
                                                    $cat = ExaminationCategory::find_by_id($single->examination);
                                                    ?>
                                                    <td style="padding-left: 100px">
                                                        <?php echo $cat->name; ?>
                                                    </td>
                                                    <?php
                                                }
                                                ?>
                                            </tr>

                                            <tr>
                                                <th>Symptoms</th>
                                                <?php $decoded = json_decode($case_note->systemic_examination);
                                                foreach($decoded as $single){
                                                    $symptoms = Examination::find_by_id($single->symptoms);
                                                    ?>
                                                    <td style="padding-left: 100px">
                                                        <?php echo $symptoms->name . ", "; ?>
                                                    </td>
                                                    <?php
                                                }
                                                ?>
                                            </tr>
                                            <tr>
                                                <th>Diagnosis</th>
                                                <td style="padding-left: 100px"><?php echo $case_note->diagnosis ?></td>
                                            </tr>
                                            <tr>
                                                <th>Differentials</th>
                                                <td style="padding-left: 100px"><?php echo $case_note->differentials ?></td>
                                            </tr>
                                            <tr>
                                                <th> Additional Notes  </th>
                                                <td style="padding-left: 100px"><?php echo $case_note->note ?></td>
                                            </tr>

                                            <?php
                                            if (isset($case_note->surgery) and !empty($case_note->surgery)){
                                                $decoded = json_decode($case_note->surgery);
                                                foreach ($decoded as $key => $value){
                                                    ?>
                                                    <tr>
                                                        <th><?php echo $key ?></th>
                                                        <td style="padding-left: 100px"><?php echo $value ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>

                                            <?php
                                            if (isset($case_note->icu) and !empty($case_note->icu)){
                                                $decoded = json_decode($case_note->icu);
                                                foreach ($decoded as $key => $value){
                                                    ?>
                                                    <tr>
                                                        <th><?php echo $key ?></th>
                                                        <td style="padding-left: 100px"><?php echo $value ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>

                                            <?php
                                            if (isset($case_note->anaesthesia) and !empty($case_note->anaesthesia)){
                                                $decoded = json_decode($case_note->anaesthesia);
                                                foreach ($decoded as $key => $value){
                                                    ?>
                                                    <tr>
                                                        <th><?php echo $key ?></th>
                                                        <td style="padding-left: 100px"><?php echo $value ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </table>
                                    </div>
                              <?php  }
                                ?>
                            </ul>

                        <?php }  ?>



                        <?php
                        $test_request = TestRequest::find_requests($waitList->id, $patient->id);
                        if (!empty($test_request)) {
                            ?>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active" aria-current="page"><b> LABORATORY TEST REQUEST
                                        </b></li>
                                </ol>
                            </nav>
                            <ul style="font-size: large">
                                <?php
                                $t_Request = TestRequest::find_requests($waitList->id, $patient->id);
                                if (empty($t_Request)) {
                                    echo "<h5>No Lab Investigation selected</h5>";
                                } else {
                                    $e_Test = EachTest::find_all_requests($t_Request->id);

                                    $result = Result::find_checked_test_request($t_Request->id);
                                    if (empty($result)) {
                                        // echo "Test Result Not Available yet";
                                    } else {
                                        //  print_r($result);
                                    }
                                    foreach ($e_Test as $e) {
                                        echo "<li> $e->test_name</li>";
                                    }
                                    if (!empty($t_Request->doc_com))
                                        echo " Request Note: " .  $t_Request->doc_com . "<br/>";
                                }
                                ?>
                            </ul>
                            <?php
                            if (isset($t_Request->id)){
                                $results = Result::find_checked_test_request($t_Request->id);
                                if (empty($results)) {
                                    echo "Test Result Not Available yet";
                                }
                                else {
                                    foreach ($results as $result) {
                                        switch ($result->dept) {
                                            case "Microbiology":
                                                include("../labResults/micro_res.php");
                                                break;
                                            case "Haematology":
                                                include("../labResults/haem_res.php");
                                                break;
                                            case "Chemical Pathology":
                                                include("../labResults/chem_res.php");
                                                break;
                                            case "Parasitology":
                                                include("../labResults/para_res.php");
                                                break;
                                            case "Histology":
                                                include("../labResults/histo_res.php");
                                                break;
                                            default:
                                                echo "";
                                        }


                                    }
                                }
                            }

                            ?>
                        <?php }   ?>

                        <?php
                        $scan_request = ScanRequest::find_requests($waitList->id, $patient->id);
                        if (!empty($scan_request)) {
                            ?>
                            <br/>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active" aria-current="page"><b> RADIOLOGY/ULTRASOUND REQUEST
                                        </b></li>
                                </ol>
                            </nav>
                            <ul style="font-size: large">
                                <?php
                                $s_Request = ScanRequest::find_requests($waitList->id, $patient->id);
                                if (empty($s_Request)) {
                                    echo "<h5>No Xray/Ultrasound selected</h5>";
                                } else {
                                    $e_Scan = EachScan::find_all_requests($s_Request->id);
                                    //   print_r($e_Scan);
                                    foreach ($e_Scan as $scan) {
                                        echo "<li> $scan->scan_name</li>";
                                    }
                                }
                                ?>
                            </ul>
                            <?php
                            if (!empty($s_Request->doc_com))
                                echo "<b>Note: </b>" .  $s_Request->doc_com . "<br/>";
                            ?>
                        <?php }
                        if (isset($s_Request->id)){
                            $results = ScanResult::find_completed_results_by_scan_req($s_Request->id);
                            if (empty($results)) {
                                echo " Result Not Available yet";
                            }
                            else {
                                foreach ($results as $result) {
                                    include("../rad/rad_res.php");
                                }
                            }
                        }
                        ?>

                       <!-- --><?php
/*                        $results = ScanResult::find_completed_results_by_scan_req($s_Request->id);
                        if (empty($results)) {
                            echo " Result Not Available yet";
                        }
                        else {
                            foreach ($results as $result) {
                                include("../rad/rad_res.php");
                            }
                        }
                        */?>




                        <?php
                        $drug_request = DrugRequest::find_requests($waitList->id, $patient->id);
                        if (!empty($drug_request)) {
                            ?>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active" aria-current="page"><b> DRUG PRESCRIPTION
                                        </b></li>
                                </ol>
                            </nav>
                            <ul style="font-size: large">
                                <?php
                                $d_Request = DrugRequest::find_requests($waitList->id, $patient->id);

                                if (empty($d_Request)) {
                                    echo "<h5>No drugs selected</h5>";
                                } else {
                                    $e_Drug = EachDrug::find_all_requests($d_Request->id);
                                    $table = "                                                       
                                                        <table class='table table-bordered table-condensed table-hove'>
                                                            <thead>
                                                                <tr>
                                                                    <th>Drug(s)</th>
                                                                    <th>Duration</th>
                                                                    <th>Dosage</th>
                                                                </tr>
                                                            </thead>                                          
                                                            <tbody>";
                                    foreach ($e_Drug as $drug) {
                                        $table .=
                                            "<tr><td>$drug->product_name</td>
                                                                    <td>$drug->duration </td>
                                                                    <td>$drug->dosage</td>
                                                               </tr>
                                                  
                                                        ";
                                    }
                                    $table .= "</tbody>
                                                    </table> ";
                                    echo $table;

                                }
                                ?>
                            </ul>
                        <?php }  ?>

                        <?php
                        //   $referral    = Referrals::find_pending_referrals($waitList->id, $patient->id);
                        $referral    = Referrals::find_patient_referral($waitList->id, $patient->id);
                        if (!empty($referral)) {
                            ?>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active" aria-current="page"><b> CLINIC REFERRALS
                                        </b></li>
                                </ol>
                            </nav>
                            <ul style="font-size: medium">
                                <?php
                             //   $referral    = Referrals::find_pending_referrals($waitList->id, $patient->id);
                                $referral    = Referrals::find_patient_referral($waitList->id, $patient->id);
                                if (!empty($referral)) {
                                    $cur_clinic = SubClinic::find_by_id($referral->current_sub_clinic_id);
                                    $sub_clinic = SubClinic::find_by_id($referral->referred_sub_clinic_id);
                                }
                                ?>
                                <table>
                                    <tr>
                                        <th>Referred From:</th>
                                        <td style="padding-left: 50px"><?php echo $cur_clinic->name ?></td>
                                    </tr>
                                    <tr>
                                        <th>Referred Clinic:</th>
                                        <td style="padding-left: 50px"><?php echo $sub_clinic->name ?></td>
                                    </tr>
                                    <tr>
                                        <th>Referral Note:</th>
                                        <td style="padding-left: 50px"><?php echo $referral->referral_note ?></td>
                                    </tr>
                                </table>

                            </ul>

                        <?php }   ?>

                        <?php
                     //   $appointment = Appointment::find_pending_appointment($waitList->id, $patient->id);
                        $appointment = Appointment::find_patient_appointment($waitList->id, $patient->id);
                        if (!empty($appointment)) {
                            ?>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active" aria-current="page"><b> APPOINTMENT
                                        </b></li>
                                </ol>
                            </nav>
                            <ul style="font-size: large">
                                <?php
                                $appointment = Appointment::find_patient_appointment($waitList->id, $patient->id);
                                if (empty($appointment)) {
                                    echo "No Appointment";
                                } else {
                                    echo $appointment->next_app;
                                }

                                ?>
                            </ul>
                        <?php }    ?>

                        <?php
                        $admission = ReferAdmission::find_by_waiting_list($waitList->id, $patient->id);
                        if (!empty($admission)) {
                            ?>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active" aria-current="page"><b> ADMISSION DETAILS
                                        </b></li>
                                </ol>
                            </nav>

                                <h4>Patient has been admitted, Do the UI</h4>


                        <?php }  ?>

                        <br/>  <br/>
                        <p class="text-info" style="font-size: larger"><code></code>
                             Done
                            By <?php echo $waitList->dr_seen ?>
                        </p>









                    </div>



