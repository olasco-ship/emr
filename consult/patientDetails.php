<div class="row">

<div class="col-md-12">
    <div style="font-size:20px; text-align:center; background-color:gray;"><b>Patient Details</b></div>
    <div class="table-responsive">
        <table cellspacing="0" cellpadding="5" class="table table-bordered">

            <tr>
                <th>Hospital Number</th>
                <td><?php echo $patient->folder_number ?></td>
            </tr>

            <tr>
                <th> Number Of Clinics</th>
                <td><?php $patient_clinics = PatientSubClinic::count_patient_clinics($patient->id);
                    echo $patient_clinics ?></td>
            </tr>

            <tr>
                <th> Clinic(s)</th>
                <td><?php
                    $clinics = PatientSubClinic::find_patient_clinics($patient->id);
                    foreach ($clinics as $clinic) {
                        $sub_clinic = SubClinic::find_by_id($clinic->sub_clinic_id);
                        echo $sub_clinic->name . "<br/>";
                    }

                    ?>
                </td>
            </tr>

            <tr>
                <?php if (isset($patient->nhis_no) and (!empty($patient->nhis_no))) { ?>
                    <th>NHIS Number</th>
                    <td><?php echo $patient->nhis_no ?></td>
                <?php } ?>
            </tr>
            <tr>
                <?php if (isset($patient->nhis_no) and (!empty($patient->nhis_no))) { ?>
                    <th>NHIS Eligibility</th>
                    <td><?php echo $patient->nhis_eligibility ?></td>
                <?php } ?>
            </tr>
            <tr>
                <th>Title</th>
                <td><?php echo $patient->title ?></td>
            </tr>
            <tr>
                <th>First Name</th>
                <td><?php echo $patient->first_name ?></td>
            </tr>
            <tr>
                <th>Last Name</th>
                <td><?php echo $patient->last_name ?></td>
            </tr>
            <tr>
                <th>Birth Date</th>
                <td><?php echo date('d/m/Y', strtotime($patient->dob)) ?></td>
            </tr>
            <tr>
                <th>Age</th>
                <td><?php echo getAge($patient->dob) . 'year(s)' ?></td>
            </tr>
            <tr>
                <th>Gender</th>
                <td><?php echo $patient->gender ?></td>
            </tr>
            <tr>
                <th>Blood Group</th>
                <td><?php echo $patient->blood_group ?></td>
            </tr>
            <tr>
                <th> Genotype</th>
                <td><?php echo $patient->genotype ?></td>
            </tr>
            <tr>
                <th> Phone Number</th>
                <td><?php echo $patient->phone_number ?></td>
            </tr>
            <tr>
                <th> Contact Address</th>
                <td><?php echo $patient->address ?></td>
            </tr>
            <tr>
                <th> Email Address</th>
                <td><?php echo $patient->email ?></td>
            </tr>
            <tr>
                <th> Marital Status</th>
                <td><?php echo $patient->marital_status ?></td>
            </tr>
            <tr>
                <th> Occupation</th>
                <td><?php echo $patient->occupation ?></td>
            </tr>
            <tr>
                <th> Nationality</th>
                <td><?php echo $patient->nationality ?></td>
            </tr>
            <tr>
                <th> State</th>
                <td><?php echo $patient->state ?></td>
            </tr>
            <tr>
                <th> LGA</th>
                <td><?php echo $patient->lga ?></td>
            </tr>
            <tr>
                <th> Religion</th>
                <td><?php echo $patient->religion ?></td>
            </tr>
            <tr>
                <th> Language(s)</th>
                <td><?php
                    if (isset($patient->english)) {
                        echo $patient->english . ", ";
                    }

                    if (isset($patient->pidgin)) {
                        echo $patient->pidgin . ", ";
                    }

                    if (isset($patient->hausa)) {
                        echo $patient->hausa . ", ";
                    }

                    if (isset($patient->yoruba)) {
                        echo $patient->yoruba . ", ";
                    }

                    if (isset($patient->igbo)) {
                        echo $patient->igbo;
                    }

                    ?>
                </td>
            </tr>
            <tr>
                <th> Next Of Kin</th>
                <td><?php echo $patient->next_kin_surname ?></td>
            </tr>
            <tr>
                <th> Relationship with Next Of Kin</th>
                <td><?php echo $patient->next_kin_relationship ?></td>
            </tr>
            <tr>
                <th> Phone No. Of Next Of Kin</th>
                <td><?php echo $patient->next_kin_phone ?></td>
            </tr>
            <tr>
                <th> Address Of Next Of Kin</th>
                <td><?php echo $patient->next_kin_address ?></td>
            </tr>


        </table>
    </div>


</div>

</div>