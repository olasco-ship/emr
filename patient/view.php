<?php
require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$index = 1;

$patient = Patient::find_by_id($_GET['id']);

$patient_clinics = PatientSubClinic::count_patient_clinics($patient->id);




if (is_post()) {

    if (isset($_POST['update_patient_record'])) {

        if (empty($_POST['title'])) {
            $errTitle = "Title is Required";
            $errMessage .= $errTitle . "<br/>";
        } else {
            $patient->title = test_input($_POST['title']);
        }


        if (empty($_POST['first_name'])) {
            $errFirstName = "First Name is Required";
            $errMessage .= $errFirstName . "<br/>";
        } else {
            $patient->first_name = test_input($_POST['first_name']);
  /*          if (!preg_match("/^[a-zA-Z]*$/", $first_name)) {
                $errFirstName = "Only letters and white space are allowed for First Name";
                $errMessage .= $errFirstName . "<br/>";
            }*/
        }

        if (empty($_POST['last_name'])) {
            $errLastName = "Last Name is Required";
            $errMessage .= $errLastName . "<br/>";
        } else {
            $patient->last_name = $_POST['last_name'];
/*            if (!preg_match("/^[a-zA-Z]*$/", $last_name)) {
                $errLastName = "Only letters and white space are allowed for Last Name";
                $errMessage .= $errLastName . "<br/>";
            }*/
        }


        if (empty($_POST['hosp_number'])) {
            $errFolderNumber = "Hospital Number  is Required";
            $errMessage .= $errFolderNumber . "<br/>";
        } else {
            $patient->hosp_number = test_input($_POST['hosp_number']);
               $pat = Patient::find_by_number($_POST['hosp_number']);
           //    print_r($pat);  exit;

               if (isset($pat) && !empty($pat)) {
                  $errHospNumber = "Hospital Number already exists";
                   $errMessage .= $errHospNumber . "<br/>";
               }
        }

        //   $patient->hosp_number = $_POST['hosp_number'];




        $dob = new DateTime($_POST['dob']);
        $dob = date_format($dob, 'Y-m-d');

        $patient->clinic_number  = test_input($_POST['clinic_number']);
        $patient->marital_status = test_input($_POST['marital_status']);

        if (empty($_POST['gender'])) {
            $errGender = "Gender is Required";
            $errMessage .= $errGender . "<br/>";
        } else {
            $patient->gender = test_input($_POST['gender']);
        }


        if (empty($_POST['nationality'])) {
            $errNationality = "Nationality is Required";
            $errMessage .= $errNationality . "<br/>";
        } else {
            $patient->nationality = test_input($_POST['nationality']);
            if (!preg_match("/^[a-zA-Z]*$/", $patient->nationality)) {
                $errNationality = "Only letters and white space are allowed for Nationality";
                $errMessage .= $errNationality . "<br/>";
            }
        }

        $patient->other_nation = test_input($_POST['other_nation']);

        if (empty($_POST['state'])) {
            $errState = "State Of Origin is Required";
            $errMessage .= $errState . "<br/>";
        } else {
            $patient->state = test_input($_POST['state']);
        }

        if (empty($_POST['lga'])) {
            $errLga = "Local Govt. of Birth is Required";
            $errMessage .= $errLga . "<br/>";
        } else {
            $patient->lga = test_input($_POST['lga']);
        }

        $patient->occupation = test_input($_POST['occupation']);

        if (empty($_POST['address'])) {
            $errAddress = "Contact Address is Required";
            $errMessage .= $errAddress . "<br/>";
        } else {
            $patient->address = test_input($_POST['address']);
        }

        if (empty($_POST['phone_number'])) {
            $errPhoneNumber = "Phone Number  is Required";
            $errMessage .= $errPhoneNumber . "<br/>";
        } else {
            $patient->phone_number = test_input($_POST['phone_number']);
        }

        $patient->email = test_input($_POST['email']);

        $patient->religion = test_input($_POST['religion']);

        $patient->english = test_input($_POST['English']);

        $patient->pidgin = test_input($_POST['Pidgin']);

        $patient->hausa = test_input($_POST['Hausa']);

        $patient->yoruba = test_input($_POST['Yoruba']);

        $patient->igbo = test_input($_POST['Igbo']);

        $patient->other_lang = test_input($_POST['other_lang']);

        $patient->next_kin = test_input($_POST['next_kin']);

        $patient->relation_next_kin = test_input($_POST['relation_next_kin']);

        $patient->address_next_kin = test_input($_POST['address_next_kin']);

        $patient->phone_number_next_kin = test_input($_POST['phone_number_next_kin']);

        $waiting_list = test_input($_POST['waiting']);

        $folder_number = getSystemNumber($first_name, $last_name);



        //   if ((!$errMessage) and (empty($errMessage))) {
        $patient->sync             = "off";
        $patient->folder_number    = $_POST['hosp_number'];
        $patient->tracking_no      = "Tracking Number";
        $patient->title            = $_POST['title'];
        $patient->first_name       = $_POST['first_name'];
        $patient->last_name        = $_POST['last_name'];
        $patient->gender           = $_POST['gender'];
        $patient->blood_group      = "";
        $patient->genotype         = "";
        $patient->phone_number     = $_POST['phone_number'];
        $patient->email            = $_POST['email'];
        $patient->address          = $_POST['address'];
        $patient->occupation       = $_POST['occupation'];
        $patient->marital_status   = $_POST['marital_status'];
        $patient->nationality      = $_POST['nationality'];
        $patient->other_nation     = $_POST['other_nation'];
        $patient->state            = $_POST['state'];
        $patient->lga              = $_POST['lga'];
        $patient->religion         = $_POST['religion'];
        $patient->language         = "";
        $patient->english          = $_POST['English'];
        $patient->pidgin           = $_POST['Pidgin'];
        $patient->hausa            = $_POST['Hausa'];
        $patient->yoruba           = $_POST['Yoruba'];
        $patient->igbo             = $_POST['Igbo'];
        $patient->other_lang       = "";
        $patient->next_kin_surname      =   $_POST['next_kin'];
        $patient->next_kin_other_names  = "";
        $patient->next_kin_relationship = $_POST['relation_next_kin'];
        $patient->next_kin_phone        = $_POST['phone_number_next_kin'];
        $patient->next_kin_address      = $_POST['address_next_kin'];

        if (isset($errMessage)){
            $session->message("Patient details has been updated.");
        } else {
            if ($patient->save()) {
                $done = TRUE;
                $session->message("Patient details has been updated.");
                redirect_to("view.php?id=$patient->id");
            }
        }





        if ($errMessage) {
            $panelClass = 'panel-danger';
            $panelHeader = '<div class="panel-heading"><h3 class="panel-title">Please correct the errors in the form<br></h3> class=
                          "panel-title alert alert-danger">' . $errMessage . '</h3> </div>';
        }
    }

    if (isset($_POST['save_file_upload'])) {

        $clinic_date = trim($_POST['clinicDate']);
        $clinic_date = date("Y-m-d", strtotime($clinic_date));

        //   echo $clinic_date;
        //   exit;


        $patientUpload              = new PatientUpload();
        $patientUpload->patient_id  = $patient->id;
        $patientUpload->ClinicDate  = $clinic_date;
        //   $patientUpload->fileName    = "";
        $patientUpload->date        = strftime("%Y-%m-%d %H:%M:%S", time());


        $patientUpload->attach_file($_FILES['file_upload']);
        //   echo "no here"; exit;
        if ($patientUpload->save()) {
            redirect_to("view.php?id=$patient->id");
        } else {
            //  echo "failed"; exit;
            $errorMessage = join("<br/>", $patientUpload->errors);
        }
    }
}






require('../layout/header.php');
?>






<div id="main-content" class="profilepage_1">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Patient Profile</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Patient</li>
                        <li class="breadcrumb-item active">Patient Profile</li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="row clearfix">


            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <a href="index.php" style="font-size: large">&laquo; Back</a>
                    <div class="body">

                <!--        <?php
/*                        if (is_post()) {
                            if (!empty($errMessage)) {  */?>
                                <div class="alert alert-warning alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <?php /* echo $errMessage; */?>
                                </div>
                        --><?php /*  }
                        }
                        */?>

                        <ul class="nav nav-tabs-new2">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#details">Patient's Details</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#history">Patient's History</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#modify">Modify Patient's Details</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#fileUpload">File Uploads</a></li>
                        </ul>
                        <div class="tab-content mt-3">

                            <div class="tab-pane active" id="details">

                                <div class="col-lg-12 col-md-12">
                                    <div class="table-responsive">
                                        <table border="1" cellspacing="0" cellpadding="5" style="margin-top:0px;font-size:16px; width: 100%;">
                                            <tr>
                                                <th>System Number</th>
                                                <td><?php echo $patient->system_number ?></td>
                                            </tr>
                                            <tr>
                                                <th>Hospital Number(Old)</th>
                                                <td><?php echo $patient->folder_number ?></td>
                                            </tr>
                                            <tr>
                                                <th> Number Of Clinics</th>
                                                <td><?php echo $patient_clinics ?></td>
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
                                                <?php  }  ?>
                                            </tr>
                                            <tr>
                                                <?php if (isset($patient->nhis_no) and (!empty($patient->nhis_no))) { ?>
                                                    <th>NHIS Eligibility</th>
                                                    <td><?php echo $patient->nhis_eligibility ?></td>
                                                <?php  }  ?>
                                            </tr>
                                            <tr>
                                                <th>Title </th>
                                                <td><?php echo $patient->title ?></td>
                                            </tr>
                                            <tr>
                                                <th>Last Name(Surname)</th>
                                                <td><?php echo $patient->last_name ?></td>
                                            </tr>
                                            <tr>
                                                <th>First Name</th>
                                                <td><?php echo $patient->first_name ?></td>
                                            </tr>
                                            <tr>
                                                <th>Birth Date</th>
                                                <td><?php echo date('d/m/Y', strtotime($patient->dob))  ?></td>
                                            </tr>
                                            <tr>
                                                <th>Age</th>
                                                <td><?php echo getAge($patient->dob) . 'year(s)' ?></td>
                                            </tr>
                                            <tr>
                                                <th>Gender</th>
                                                <td><?php echo $patient->gender  ?></td>
                                            </tr>
                                            <tr>
                                                <th>Blood Group</th>
                                                <td><?php echo $patient->blood_group  ?></td>
                                            </tr>
                                            <tr>
                                                <th> Genotype </th>
                                                <td><?php echo $patient->genotype  ?></td>
                                            </tr>
                                            <tr>
                                                <th> Phone Number </th>
                                                <td><?php echo $patient->phone_number  ?></td>
                                            </tr>
                                            <tr>
                                                <th> Contact Address </th>
                                                <td><?php echo $patient->address  ?></td>
                                            </tr>
                                            <tr>
                                                <th> Email Address </th>
                                                <td><?php echo $patient->email  ?></td>
                                            </tr>
                                            <tr>
                                                <th> Marital Status </th>
                                                <td><?php echo $patient->marital_status  ?></td>
                                            </tr>
                                            <tr>
                                                <th> Occupation </th>
                                                <td><?php echo $patient->occupation  ?></td>
                                            </tr>
                                            <tr>
                                                <th> Nationality </th>
                                                <td><?php echo $patient->nationality  ?></td>
                                            </tr>
                                            <tr>
                                                <th> Place Of Origin </th>
                                                <td><?php echo $patient->place_origin  ?></td>
                                            </tr>
                                            <tr>
                                                <th> State </th>
                                                <td><?php echo $patient->state  ?></td>
                                            </tr>
                                            <tr>
                                                <th> LGA </th>
                                                <td><?php echo $patient->lga  ?></td>
                                            </tr>
                                            <tr>
                                                <th> Religion </th>
                                                <td><?php echo $patient->religion  ?></td>
                                            </tr>
                                            <tr>
                                                <th> Language(s) </th>
                                                <td><?php
                                                    if (isset($patient->english))
                                                        echo $patient->english . ", ";
                                                    if (isset($patient->pidgin))
                                                        echo $patient->pidgin . ", ";
                                                    if (isset($patient->hausa))
                                                        echo $patient->hausa . ", ";
                                                    if (isset($patient->yoruba))
                                                        echo $patient->yoruba . ", ";
                                                    if (isset($patient->igbo))
                                                        echo $patient->igbo;
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th> Next Of Kin </th>
                                                <td><?php echo $patient->next_kin_surname  ?></td>
                                            </tr>
                                            <tr>
                                                <th> Relationship with Next Of Kin </th>
                                                <td><?php echo $patient->next_kin_relationship  ?></td>
                                            </tr>
                                            <tr>
                                                <th> Phone No. Of Next Of Kin </th>
                                                <td><?php echo $patient->next_kin_phone  ?></td>
                                            </tr>
                                            <tr>
                                                <th> Address Of Next Of Kin </th>
                                                <td><?php echo $patient->next_kin_address  ?></td>
                                            </tr>
                                            <tr>
                                                <th> Registered Date </th>
                                                <td><?php echo date('d/m/Y h:i a', strtotime($patient->date_registered)); ?></td>
                                            </tr>
                                            <tr>
                                                <th> Registered By </th>
                                                <td><?php echo $patient->registered_by  ?></td>
                                            </tr>


                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="history">

                                <ul class="nav nav-tabs-new2">
                                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#PendingAdmission"> Patient's Visit History </a></li>
                                </ul>


                                <div class="tab-content m-t-10 padding-0">

                                    <div class="tab-pane table-responsive active show" id="PendingAdmission">
                                        <table class="table m-b-0 table-hover">
                                            <thead class="thead-primary">
                                                <tr>
                                                    <th>S/No.</th>
                                                    <th>Folder No.</th>
                                                    <th>Patient Name</th>
                                                    <th> Sub Clinic </th>
                                                    <th>Consultant Seen</th>
                                                    <th> Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                $allVisit = WaitingList::find_all_done_by_patient($patient->id);

                                                foreach ($allVisit as $visit) {
                                                    $patient     = Patient::find_by_id($visit->patient_id);
                                                    $subClinic   = SubClinic::find_by_id($visit->sub_clinic_id);
                                                ?>
                                                    <tr>
                                                        <td><?php echo $index++; ?></td>
                                                        <td><a href='visit_detail.php?id=<?php echo $visit->id ?>'><?php echo $patient->folder_number ?></a></td>
                                                        <td><?php echo $patient->full_name()  ?></td>
                                                        <td><?php echo $subClinic->name ?></td>
                                                        <td><?php  ?> </td>
                                                        <td><?php $d_date = date('d/m/Y', strtotime($visit->date));
                                                            echo $d_date ?></td>
                                                    </tr>

                                                <?php  }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                            </div>

                            <div class="tab-pane" id="modify">

                                <form id="basic-form" method="post" action="">
                                    <div class="card">
                                        <div class="header">
                                            <h2>Basic Information </h2>
                                        </div>
                                        <div class="body">
                                            <div class="row clearfix">

                                                <div class="col-sm-3">
                                                    <?php
                                                    $mr = "";
                                                    $mrs = "";
                                                    $master = "";
                                                    $miss = "";
                                                    $titl = "";
                                                    if ($patient->title == "Mr") {
                                                        $mr = "checked='checked'";
                                                        $mrs = "";
                                                        $master = "";
                                                        $miss = "";
                                                        $titl = "";
                                                    } else if ($patient->title == "Mrs") {
                                                        $mrs = "checked='checked'";
                                                    } else if ($patient->title == "Master") {
                                                        $master = "checked='checked'";
                                                    } else if ($patient->title == "Miss") {
                                                        $miss = "checked='checked'";
                                                    }
                                                    ?>
                                                    <div class="form-group">
                                                        <label> Title </label>
                                                        <br>
                                                        <label class="fancy-radio">
                                                            <input type="radio" name="title" value="Mr" required="" data-parsley-errors-container="#error-radio" <?= $mr ?>>
                                                            <span><i></i>Mr</span>
                                                        </label>
                                                        <label class="fancy-radio">
                                                            <input type="radio" name="title" value="Mrs" <?= $mrs ?>>
                                                            <span><i></i>Mrs</span>
                                                        </label>
                                                        <label class="fancy-radio">
                                                            <input type="radio" name="title" value="Master" <?= $master ?>>
                                                            <span><i></i>Master</span>
                                                        </label>
                                                        <label class="fancy-radio">
                                                            <input type="radio" name="title" value="Miss" <?= $miss ?>>
                                                            <span><i></i>Miss</span>
                                                        </label>
                                                        <p id="error-radio"></p>
                                                    </div>

                                                </div>


                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>Last Name(Surname)</label>
                                                        <input type="text" class="form-control" name="last_name" value="<?php echo $patient->last_name ?>" required>
                                                    </div>
                                                </div>

                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>First Name</label>
                                                        <input type="text" class="form-control" name="first_name" value="<?php echo $patient->first_name ?>" required>
                                                    </div>
                                                </div>

                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>Hospital Number (Old)</label>
                                                        <input type="text" class="form-control" name="hosp_number" value="<?php echo $patient->folder_number ?>" required>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row clearfix">
                                                <!--
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>Hospital Number</label>
                                                        <input type="text" class="form-control" name="folder_number" value="<?php echo $patient->folder_number ?>" required>
                                                    </div>
                                                </div>                                              
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>Hospital Clinic</label>
                                                        <select class="form-control" id="clinic_id" name="clinic_id" required>
                                                            <option value="">--Select Clinic--</option>
                                                            <?php
                                                            $finds = Clinic::find_all();
                                                            foreach ($finds as $find) { ?>
                                                                <option value="<?php echo $find->id; ?>"><?php echo $find->name; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>Sub-Clinic</label>
                                                        <div id="sub_clinic_id">

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>Clinic Number</label>
                                                        <input type="text" class="form-control" name="clinic_number" value="<?php echo $clinic_number ?>" required>
                                                    </div>
                                                </div>
                                                -->

                                            </div>

                                            <div class="row clearfix">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Date Of Birth</label>
                                                        <input type="text" class="form-control" name="dob" id="dob" placeholder="dd-mm-yyyy" value="<?php echo $patient->dob ?>" required>
                                                    </div>
                                                </div>

                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label> Gender </label>
                                                        <br>
                                                        <label class="fancy-radio">
                                                            <input type="radio" name="gender" value="Male" required="" data-parsley-errors-container="#error-radio" <?= ($patient->gender == "Male") ? "checked='checked'" : '' ?> />
                                                            <span><i></i>Male</span>
                                                        </label>
                                                        <label class="fancy-radio">
                                                            <input type="radio" name="gender" value="Female" <?= ($patient->gender == "Female") ? "checked='checked'" : '' ?> />
                                                            <span><i></i>Female</span>
                                                        </label>
                                                        <p id="error-radio"></p>
                                                    </div>
                                                </div>


                                                <div class="col-sm-5">

                                                    <div class="form-group">
                                                        <label> Marital Status </label>
                                                        <br />
                                                        <label class="fancy-radio">
                                                            <input type="radio" name="marital_status" value="Single" required="" data-parsley-errors-container="#error-radio" <?= ($patient->marital_status == "Single") ? "checked='checked'" : '' ?> />
                                                            <span><i></i>Single</span>
                                                        </label>
                                                        <label class="fancy-radio">
                                                            <input type="radio" name="marital_status" value="Married" <?= ($patient->marital_status == "Married") ? "checked='checked'" : '' ?> />
                                                            <span><i></i>Married</span>
                                                        </label>
                                                        <label class="fancy-radio">
                                                            <input type="radio" name="marital_status" value="Separated" <?= ($patient->marital_status == "Separated") ? "checked='checked'" : '' ?> />
                                                            <span><i></i>Separated</span>
                                                        </label>
                                                        <label class="fancy-radio">
                                                            <input type="radio" name="marital_status" value="Divorced" <?= ($patient->marital_status == "Divorced") ? "checked='checked'" : '' ?> />
                                                            <span><i></i>Divorced</span>
                                                        </label>
                                                        <label class="fancy-radio">
                                                            <input type="radio" name="marital_status" value="Widow/Widower" <?= ($patient->marital_status == "Widow/Widower") ? "checked='checked'" : '' ?> />
                                                            <span><i></i>Widow/Widower</span>
                                                        </label>
                                                        <label class="fancy-radio">
                                                            <input type="radio" name="marital_status" value="Single Parent" <?= ($patient->marital_status == "Single Parent") ? "checked='checked'" : '' ?> />
                                                            <span><i></i>Single Parent</span>
                                                        </label>
                                                        <p id="error-radio"></p>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row clearfix">
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label> Nationality </label>
                                                        <br />
                                                        <label class="fancy-radio">
                                                            <input type="radio" name="nationality" value="Nigerian" required data-parsley-errors-container="#error-radio" <?= ($patient->nationality == "Nigerian") ? "checked='checked'" : '' ?> />
                                                            <span><i></i>Nigerian</span>
                                                        </label>
                                                        <label class="fancy-radio">
                                                            <input type="radio" name="nationality" value="Others" <?= ($patient->nationality == "Others") ? "checked='checked'" : '' ?> />
                                                            <span><i></i>Others</span>
                                                        </label>
                                                        <p id="error-radio"></p>
                                                    </div>
                                                </div>

                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>Specify for Others</label>
                                                        <input type="text" class="form-control" name="other_nation" value="<?php echo $patient->other_nation ?>">
                                                    </div>
                                                </div>



                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label class="control-label"> State Of Origin</label>
                                                        <select class="form-control" name="state" required>
                                                            <option value="" selected="selected">- Select State-</option>
                                                            <option <?php echo ($patient->state == 'Abia') ? 'selected ="TRUE"' : ''; ?>value="Abia">Abia</option>
                                                            <option <?php echo ($patient->state == 'Adamawa') ? 'selected ="TRUE"' : ''; ?>value="Adamawa">Adamawa</option>
                                                            <option <?php echo ($patient->state == 'AkwaIbom') ? 'selected ="TRUE"' : ''; ?>value="AkwaIbom">AkwaIbom</option>
                                                            <option <?php echo ($patient->state == 'Anambra') ? 'selected ="TRUE"' : ''; ?>value="Anambra">Anambra</option>
                                                            <option <?php echo ($patient->state == 'Bauchi') ? 'selected ="TRUE"' : ''; ?>value="Bauchi">Bauchi</option>
                                                            <option <?php echo ($patient->state == 'Bayelsa') ? 'selected ="TRUE"' : ''; ?>value="Bayelsa">Bayelsa</option>
                                                            <option <?php echo ($patient->state == 'Benue') ? 'selected ="TRUE"' : ''; ?>value="Benue">Benue</option>
                                                            <option <?php echo ($patient->state == 'Borno') ? 'selected ="TRUE"' : ''; ?>value="Borno">Borno</option>
                                                            <option <?php echo ($patient->state == 'Cross River') ? 'selected ="TRUE"' : ''; ?>value="Cross River">Cross River</option>
                                                            <option <?php echo ($patient->state == 'Delta') ? 'selected ="TRUE"' : ''; ?>value="Delta">Delta</option>
                                                            <option <?php echo ($patient->state == 'Ebonyi') ? 'selected ="TRUE"' : ''; ?>value="Ebonyi">Ebonyi</option>
                                                            <option <?php echo ($patient->state == 'Edo') ? 'selected ="TRUE"' : ''; ?>value="Edo">Edo</option>
                                                            <option <?php echo ($patient->state == 'Ekiti') ? 'selected ="TRUE"' : ''; ?>value="Ekiti">Ekiti</option>
                                                            <option <?php echo ($patient->state == 'Enugu') ? 'selected ="TRUE"' : ''; ?>value="Enugu">Enugu</option>
                                                            <option <?php echo ($patient->state == 'FCT') ? 'selected ="TRUE"' : ''; ?>value="FCT">FCT</option>
                                                            <option <?php echo ($patient->state == 'Gombe') ? 'selected ="TRUE"' : ''; ?>value="Gombe">Gombe</option>
                                                            <option <?php echo ($patient->state == 'Imo') ? 'selected ="TRUE"' : ''; ?>value="Imo">Imo</option>
                                                            <option <?php echo ($patient->state == 'Jigawa') ? 'selected ="TRUE"' : ''; ?>value="Jigawa">Jigawa</option>
                                                            <option <?php echo ($patient->state == 'Kaduna') ? 'selected ="TRUE"' : ''; ?>value="Kaduna">Kaduna</option>
                                                            <option <?php echo ($patient->state == 'Kano') ? 'selected ="TRUE"' : ''; ?>value="Kano">Kano</option>
                                                            <option <?php echo ($patient->state == 'Katsina') ? 'selected ="TRUE"' : ''; ?>value="Katsina">Katsina</option>
                                                            <option <?php echo ($patient->state == 'Kebbi') ? 'selected ="TRUE"' : ''; ?>value="Kebbi">Kebbi</option>
                                                            <option <?php echo ($patient->state == 'Kogi') ? 'selected ="TRUE"' : ''; ?>value="Kogi">Kogi</option>
                                                            <option <?php echo ($patient->state == 'Kwara') ? 'selected ="TRUE"' : ''; ?>value="Kwara">Kwara</option>
                                                            <option <?php echo ($patient->state == 'Lagos') ? 'selected ="TRUE"' : ''; ?>value="Lagos">Lagos</option>
                                                            <option <?php echo ($patient->state == 'Nasarawa') ? 'selected ="TRUE"' : ''; ?>value="Nasarawa">Nasarawa</option>
                                                            <option <?php echo ($patient->state == 'Niger') ? 'selected ="TRUE"' : ''; ?>value="Niger">Niger</option>
                                                            <option <?php echo ($patient->state == 'Ogun') ? 'selected ="TRUE"' : ''; ?>value="Ogun">Ogun</option>
                                                            <option <?php echo ($patient->state == 'Ondo') ? 'selected ="TRUE"' : ''; ?>value="Ondo">Ondo</option>
                                                            <option <?php echo ($patient->state == 'Osun') ? 'selected ="TRUE"' : ''; ?>value="Osun">Osun</option>
                                                            <option <?php echo ($patient->state == 'Oyo') ? 'selected ="TRUE"' : ''; ?>value="Oyo">Oyo</option>
                                                            <option <?php echo ($patient->state == 'Plateau') ? 'selected ="TRUE"' : ''; ?>value="Plateau">Plateau</option>
                                                            <option <?php echo ($patient->state == 'Rivers') ? 'selected ="TRUE"' : ''; ?>value="Rivers">Rivers</option>
                                                            <option <?php echo ($patient->state == 'Sokoto') ? 'selected ="TRUE"' : ''; ?>value="Sokoto">Sokoto</option>
                                                            <option <?php echo ($patient->state == 'Taraba') ? 'selected ="TRUE"' : ''; ?>value="Taraba">Taraba</option>
                                                            <option <?php echo ($patient->state == 'Yobe') ? 'selected ="TRUE"' : ''; ?>value="Yobe">Yobe</option>
                                                            <option <?php echo ($patient->state == 'Zamfara') ? 'selected ="TRUE"' : ''; ?>value="Zamfara">Zamfara</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>LGA</label>
                                                        <input type="text" class="form-control" name="lga" value="<?php echo $patient->lga ?>">
                                                    </div>
                                                </div>


                                            </div>

                                            <div class="row clearfix">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Occupation</label>
                                                        <input type="text" class="form-control" name="occupation" value="<?php echo $patient->occupation ?>">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Contact Address</label>
                                                        <textarea class="form-control" name="address" rows="3" cols="10" required><?php echo $patient->address ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Phone Number</label>
                                                        <input type="text" class="form-control" name="phone_number"  value="<?php echo $patient->phone_number ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Email Address</label>
                                                        <input type="email" class="form-control" name="email" value="<?php echo $patient->email ?>">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label> Religion </label>
                                                        <br />
                                                        <label class="fancy-radio">
                                                            <input type="radio" name="religion" value="Muslim" required data-parsley-errors-container="#error-radio" <?= ($patient->religion == "Muslim") ? "checked='checked'" : '' ?>>
                                                            <span><i></i>Muslim</span>
                                                        </label>
                                                        <label class="fancy-radio">
                                                            <input type="radio" name="religion" value="Christian" <?= ($patient->religion == "Christian") ? "checked='checked'" : '' ?>>
                                                            <span><i></i>Christian</span>
                                                        </label>
                                                        <label class="fancy-radio">
                                                            <input type="radio" name="religion" value="Others" <?= ($patient->religion == "Others") ? "checked='checked'" : '' ?>>
                                                            <span><i></i>Others</span>
                                                        </label>
                                                        <p id="error-radio"></p>
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Language Spoken</label>
                                                        <br />
                                                        <label class="fancy-checkbox">
                                                            <input type="checkbox" name="English" value="English" <?= ($patient->english == "English") ? "checked='checked'" : '' ?> >
                                                            <span>English</span>
                                                        </label>
                                                        <label class="fancy-checkbox">
                                                            <input type="checkbox" name="Pidgin" value="Pidgin" <?= ($patient->pidgin == "Pidgin") ? "checked='checked'" : '' ?>>
                                                            <span>Pidgin</span>
                                                        </label>
                                                        <label class="fancy-checkbox">
                                                            <input type="checkbox" name="Hausa" value="Hausa" <?= ($patient->hausa == "Hausa") ? "checked='checked'" : '' ?>>
                                                            <span>Hausa</span>
                                                        </label>
                                                        <label class="fancy-checkbox">
                                                            <input type="checkbox" name="Igbo" value="Igbo" <?= ($patient->igbo == "Igbo") ? "checked='checked'" : '' ?>>
                                                            <span>Igbo</span>
                                                        </label>
                                                        <label class="fancy-checkbox">
                                                            <input type="checkbox" name="Yoruba" value="Yoruba" <?= ($patient->yoruba == "Yoruba") ? "checked='checked'" : '' ?>>
                                                            <span>Yoruba</span>
                                                        </label>
                                                        <p id="error-checkbox"></p>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="row clearfix">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Name Of Next Of Kin</label>
                                                        <input type="text" class="form-control" name="next_kin" value="<?php echo $patient->next_kin_surname ?>">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Relationship To Next Of Kin</label>
                                                        <input type="text" class="form-control" name="relation_next_kin" value="<?php echo $patient->next_kin_relationship ?>">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label> Address Of Next Of Kin</label>
                                                        <textarea class="form-control" name="address_next_kin" rows="3" cols="10"><?php echo $patient->next_kin_address ?></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Phone No. Of Next Of Kin</label>
                                                        <input type="text" class="form-control" name="phone_number_next_kin" value="<?php echo $patient->next_kin_phone ?>">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">



                                                </div>
                                                <div class="col-sm-4">

                                                </div>
                                            </div>

                                            <div class="row clearfix">
                                                <div class="col-sm-4">



                                                </div>
                                                <div class="col-sm-4">

                                                </div>
                                                <div class="col-sm-4">

                                                </div>
                                            </div>


                                            <div class="row clearfix">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <button type="submit" name="update_patient_record" class="btn btn-primary">Update Patient Record</button>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">

                                                </div>
                                                <div class="col-sm-4">

                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </form>

                            </div>

                            <div class="tab-pane" id="fileUpload">

                                <div class="row">

                                    <div class="col-lg-5 col-md-5">
                                        <h4>File Upload</h4>

                                        <form action="" method="post" enctype="multipart/form-data">

                                            <div class="form-group">
                                                <label for="fileUpload" class="control-label">File Upload(jpg, jpeg, png format is allowed)</label>
                                                <div style="width: 400px">
                                                    <input class="form-control" type="file" id="file_upload" name="file_upload" required>
                                                </div>
                                            </div>

                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon3">Clinic Date</span>
                                                </div>
                                                <div style="width: 300px">
                                                    <input type="text" class="form-control" autocomplete="off" name="clinicDate" id="endDate" placeholder="Clinic Date" value="<?php echo $clinicDate; ?>" required>
                                                </div>
                                            </div>

                                            <div class="input-group mb-3">
                                                <button type="submit" name="save_file_upload" class="btn btn-primary">Submit</button>
                                                <button type="button" name="search" onClick="location.href=location.href" class="btn btn-outline-warning">Refresh</button>
                                            </div>

                                        </form>


                                    </div>

                                    <div class="col-lg-7 col-md-7">


                                        <div class="table-responsive">
                                            <table class="table table-hover js-basic-example dataTable table-custom">
                                                <thead class="thead-dark">
                                                    <tr>

                                                        <th>Clinic Date</th>
                                                        <th>Date Registered </th>
                                                        <th>View</th>

                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php foreach (PatientUpload::find_all() as $pat) {   ?>
                                                        <tr>
                                                            <td><?php echo date_to_text($pat->ClinicDate);  ?></td>
                                                            <td><?php  $d_date = date('d/m/Y', strtotime($pat->date)); echo $d_date; 
                                                                  ?>
                                                            </td>
                                                            <td><a href="../patient<?php echo $pat->image_path(); ?>" target="_blank" class="btn btn-outline-warning" role="button">
                                                                    View Upload
                                                                </a></td>

                                                        </tr>
                                                    <?php } ?>

                                                </tbody>
                                            </table>
                                        </div>


                                    </div>

                                </div>



                            </div>

                        </div>

                    </div>
                </div>
            </div>



        </div>
    </div>
</div>




<?php

require('../layout/footer.php');

?>

<script>
    let options = {
        Abia: ['Select item...', 'Aba North', 'Aba South', 'Arochukwu', 'Bende', 'Ikwuano', 'Isiala Ngwa North', 'Isiala Ngwa South', 'Isuikwuato', 'Obi Ngwa', 'Ohafia', 'Osisioma', 'Ugwunagbo', 'Ukwa East', 'Ukwa West', 'Umuahia North', 'muahia South', 'Umu Nneochi'],
        Adamawa: ['Select item...', 'Demsa', 'Fufure', 'Ganye', 'Gayuk', 'Gombi', 'Grie', 'Hong', 'Jada', 'Larmurde', 'Madagali', 'Maiha', 'Mayo Belwa', 'Michika', 'Mubi North', 'Mubi South', 'Numan', 'Shelleng', 'Song', 'Toungo', 'Yola North', 'Yola South'],
        AkwaIbom: [
            "Abak",
            "Eastern Obolo",
            "Eket",
            "Esit Eket",
            "Essien Udim",
            "Etim Ekpo",
            "Etinan",
            "Ibeno",
            "Ibesikpo Asutan",
            "Ibiono-Ibom",
            "Ika",
            "Ikono",
            "Ikot Abasi",
            "Ikot Ekpene",
            "Ini",
            "Itu",
            "Mbo",
            "Mkpat-Enin",
            "Nsit-Atai",
            "Nsit-Ibom",
            "Nsit-Ubium",
            "Obot Akara",
            "Okobo",
            "Onna",
            "Oron",
            "Oruk Anam",
            "Udung-Uko",
            "Ukanafun",
            "Uruan",
            "Urue-Offong Oruko",
            "Uyo"
        ],
        Anambra: [
            "Aguata",
            "Anambra East",
            "Anambra West",
            "Anaocha",
            "Awka North",
            "Awka South",
            "Ayamelum",
            "Dunukofia",
            "Ekwusigo",
            "Idemili North",
            "Idemili South",
            "Ihiala",
            "Njikoka",
            "Nnewi North",
            "Nnewi South",
            "Ogbaru",
            "Onitsha North",
            "Onitsha South",
            "Orumba North",
            "Orumba South",
            "Oyi"
        ],
        Bauchi: [
            "Alkaleri",
            "Bauchi",
            "Bogoro",
            "Damban",
            "Darazo",
            "Dass",
            "Gamawa",
            "Ganjuwa",
            "Giade",
            "Itas-Gadau",
            "Jama are",
            "Katagum",
            "Kirfi",
            "Misau",
            "Ningi",
            "Shira",
            "Tafawa Balewa",
            " Toro",
            " Warji",
            " Zaki"
        ],

        Bayelsa: [
            "Brass",
            "Ekeremor",
            "Kolokuma Opokuma",
            "Nembe",
            "Ogbia",
            "Sagbama",
            "Southern Ijaw",
            "Yenagoa"
        ],
        Benue: [
            "Agatu",
            "Apa",
            "Ado",
            "Buruku",
            "Gboko",
            "Guma",
            "Gwer East",
            "Gwer West",
            "Katsina-Ala",
            "Konshisha",
            "Kwande",
            "Logo",
            "Makurdi",
            "Obi",
            "Ogbadibo",
            "Ohimini",
            "Oju",
            "Okpokwu",
            "Oturkpo",
            "Tarka",
            "Ukum",
            "Ushongo",
            "Vandeikya"
        ],
        Borno: [
            "Abadam",
            "Askira-Uba",
            "Bama",
            "Bayo",
            "Biu",
            "Chibok",
            "Damboa",
            "Dikwa",
            "Gubio",
            "Guzamala",
            "Gwoza",
            "Hawul",
            "Jere",
            "Kaga",
            "Kala-Balge",
            "Konduga",
            "Kukawa",
            "Kwaya Kusar",
            "Mafa",
            "Magumeri",
            "Maiduguri",
            "Marte",
            "Mobbar",
            "Monguno",
            "Ngala",
            "Nganzai",
            "Shani"
        ],
        "Cross River": [
            "Abi",
            "Akamkpa",
            "Akpabuyo",
            "Bakassi",
            "Bekwarra",
            "Biase",
            "Boki",
            "Calabar Municipal",
            "Calabar South",
            "Etung",
            "Ikom",
            "Obanliku",
            "Obubra",
            "Obudu",
            "Odukpani",
            "Ogoja",
            "Yakuur",
            "Yala"
        ],

        Delta: [
            "Aniocha North",
            "Aniocha South",
            "Bomadi",
            "Burutu",
            "Ethiope East",
            "Ethiope West",
            "Ika North East",
            "Ika South",
            "Isoko North",
            "Isoko South",
            "Ndokwa East",
            "Ndokwa West",
            "Okpe",
            "Oshimili North",
            "Oshimili South",
            "Patani",
            "Sapele",
            "Udu",
            "Ughelli North",
            "Ughelli South",
            "Ukwuani",
            "Uvwie",
            "Warri North",
            "Warri South",
            "Warri South West"
        ],

        Ebonyi: [
            "Abakaliki",
            "Afikpo North",
            "Afikpo South",
            "Ebonyi",
            "Ezza North",
            "Ezza South",
            "Ikwo",
            "Ishielu",
            "Ivo",
            "Izzi",
            "Ohaozara",
            "Ohaukwu",
            "Onicha"
        ],
        Edo: [
            "Akoko-Edo",
            "Egor",
            "Esan Central",
            "Esan North-East",
            "Esan South-East",
            "Esan West",
            "Etsako Central",
            "Etsako East",
            "Etsako West",
            "Igueben",
            "Ikpoba Okha",
            "Orhionmwon",
            "Oredo",
            "Ovia North-East",
            "Ovia South-West",
            "Owan East",
            "Owan West",
            "Uhunmwonde"
        ],

        Ekiti: [
            "Ado Ekiti",
            "Efon",
            "Ekiti East",
            "Ekiti South-West",
            "Ekiti West",
            "Emure",
            "Gbonyin",
            "Ido Osi",
            "Ijero",
            "Ikere",
            "Ikole",
            "Ilejemeje",
            "Irepodun-Ifelodun",
            "Ise-Orun",
            "Moba",
            "Oye"
        ],
        Rivers: [
            "Port Harcourt",
            "Obio-Akpor",
            "Okrika",
            "Ogu–Bolo",
            "Eleme",
            "Tai",
            "Gokana",
            "Khana",
            "Oyigbo",
            "Opobo–Nkoro",
            "Andoni",
            "Bonny",
            "Degema",
            "Asari-Toru",
            "Akuku-Toru",
            "Abua–Odual",
            "Ahoada West",
            "Ahoada East",
            "Ogba–Egbema–Ndoni",
            "Emohua",
            "Ikwerre",
            "Etche",
            "Omuma"
        ],
        Enugu: [
            "Aninri",
            "Awgu",
            "Enugu East",
            "Enugu North",
            "Enugu South",
            "Ezeagu",
            "Igbo Etiti",
            "Igbo Eze North",
            "Igbo Eze South",
            "Isi Uzo",
            "Nkanu East",
            "Nkanu West",
            "Nsukka",
            "Oji River",
            "Udenu",
            "Udi",
            "Uzo Uwani"
        ],
        Abuja: [
            "Abaji",
            "Bwari",
            "Gwagwalada",
            "Kuje",
            "Kwali",
            "Municipal Area Council"
        ],
        Gombe: [
            "Akko",
            "Balanga",
            "Billiri",
            "Dukku",
            "Funakaye",
            "Gombe",
            "Kaltungo",
            "Kwami",
            "Nafada",
            "Shongom",
            "Yamaltu-Deba"
        ],
        Imo: [
            "Aboh Mbaise",
            "Ahiazu Mbaise",
            "Ehime Mbano",
            "Ezinihitte",
            "Ideato North",
            "Ideato South",
            "Ihitte-Uboma",
            "Ikeduru",
            "Isiala Mbano",
            "Isu",
            "Mbaitoli",
            "Ngor Okpala",
            "Njaba",
            "Nkwerre",
            "Nwangele",
            "Obowo",
            "Oguta",
            "Ohaji-Egbema",
            "Okigwe",
            "Orlu",
            "Orsu",
            "Oru East",
            "Oru West",
            "Owerri Municipal",
            "Owerri North",
            "Owerri West",
            "Unuimo"
        ],
        Jigawa: [
            "Auyo",
            "Babura",
            "Biriniwa",
            "Birnin Kudu",
            "Buji",
            "Dutse",
            "Gagarawa",
            "Garki",
            "Gumel",
            "Guri",
            "Gwaram",
            "Gwiwa",
            "Hadejia",
            "Jahun",
            "Kafin Hausa",
            "Kazaure",
            "Kiri Kasama",
            "Kiyawa",
            "Kaugama",
            "Maigatari",
            "Malam Madori",
            "Miga",
            "Ringim",
            "Roni",
            "Sule Tankarkar",
            "Taura",
            "Yankwashi"
        ],
        Kaduna: [
            "Birnin Gwari",
            "Chikun",
            "Giwa",
            "Igabi",
            "Ikara",
            "Jaba",
            "Jema a",
            "Kachia",
            "Kaduna North",
            "Kaduna South",
            "Kagarko",
            "Kajuru",
            "Kaura",
            "Kauru",
            "Kubau",
            "Kudan",
            "Lere",
            "Makarfi",
            "Sabon Gari",
            "Sanga",
            "Soba",
            "Zangon Kataf",
            "Zaria"
        ],
        Kano: [
            "Ajingi",
            "Albasu",
            "Bagwai",
            "Bebeji",
            "Bichi",
            "Bunkure",
            "Dala",
            "Dambatta",
            "Dawakin Kudu",
            "Dawakin Tofa",
            "Doguwa",
            "Fagge",
            "Gabasawa",
            "Garko",
            "Garun Mallam",
            "Gaya",
            "Gezawa",
            "Gwale",
            "Gwarzo",
            "Kabo",
            "Kano Municipal",
            "Karaye",
            "Kibiya",
            "Kiru",
            "Kumbotso",
            "Kunchi",
            "Kura",
            "Madobi",
            "Makoda",
            "Minjibir",
            "Nasarawa",
            "Rano",
            "Rimin Gado",
            "Rogo",
            "Shanono",
            "Sumaila",
            "Takai",
            "Tarauni",
            "Tofa",
            "Tsanyawa",
            "Tudun Wada",
            "Ungogo",
            "Warawa",
            "Wudil"
        ],
        Katsina: [
            "Bakori",
            "Batagarawa",
            "Batsari",
            "Baure",
            "Bindawa",
            "Charanchi",
            "Dandume",
            "Danja",
            "Dan Musa",
            "Daura",
            "Dutsi",
            "Dutsin Ma",
            "Faskari",
            "Funtua",
            "Ingawa",
            "Jibia",
            "Kafur",
            "Kaita",
            "Kankara",
            "Kankia",
            "Katsina",
            "Kurfi",
            "Kusada",
            "Mai Adua",
            "Malumfashi",
            "Mani",
            "Mashi",
            "Matazu",
            "Musawa",
            "Rimi",
            "Sabuwa",
            "Safana",
            "Sandamu",
            "Zango"
        ],
        Kebbi: [
            "Aleiro",
            "Arewa Dandi",
            "Argungu",
            "Augie",
            "Bagudo",
            "Birnin Kebbi",
            "Bunza",
            "Dandi",
            "Fakai",
            "Gwandu",
            "Jega",
            "Kalgo",
            "Koko Besse",
            "Maiyama",
            "Ngaski",
            "Sakaba",
            "Shanga",
            "Suru",
            "Wasagu Danko",
            "Yauri",
            "Zuru"
        ],
        Kogi: [
            "Adavi",
            "Ajaokuta",
            "Ankpa",
            "Bassa",
            "Dekina",
            "Ibaji",
            "Idah",
            "Igalamela Odolu",
            "Ijumu",
            "Kabba Bunu",
            "Kogi",
            "Lokoja",
            "Mopa Muro",
            "Ofu",
            "Ogori Magongo",
            "Okehi",
            "Okene",
            "Olamaboro",
            "Omala",
            "Yagba East",
            "Yagba West"
        ],
        Kwara: [
            "Asa",
            "Baruten",
            "Edu",
            "Ekiti",
            "Ifelodun",
            "Ilorin East",
            "Ilorin South",
            "Ilorin West",
            "Irepodun",
            "Isin",
            "Kaiama",
            "Moro",
            "Offa",
            "Oke Ero",
            "Oyun",
            "Pategi"
        ],
        Lagos: [
            "Agege",
            "Ajeromi-Ifelodun",
            "Alimosho",
            "Amuwo-Odofin",
            "Apapa",
            "Badagry",
            "Epe",
            "Eti Osa",
            "Ibeju-Lekki",
            "Ifako-Ijaiye",
            "Ikeja",
            "Ikorodu",
            "Kosofe",
            "Lagos Island",
            "Lagos Mainland",
            "Mushin",
            "Ojo",
            "Oshodi-Isolo",
            "Shomolu",
            "Surulere"
        ],
        Nassarawa: [
            "Akwanga",
            "Awe",
            "Doma",
            "Karu",
            "Keana",
            "Keffi",
            "Kokona",
            "Lafia",
            "Nasarawa",
            "Nasarawa Egon",
            "Obi",
            "Toto",
            "Wamba"
        ],
        Niger: [
            "Agaie",
            "Agwara",
            "Bida",
            "Borgu",
            "Bosso",
            "Chanchaga",
            "Edati",
            "Gbako",
            "Gurara",
            "Katcha",
            "Kontagora",
            "Lapai",
            "Lavun",
            "Magama",
            "Mariga",
            "Mashegu",
            "Mokwa",
            "Moya",
            "Paikoro",
            "Rafi",
            "Rijau",
            "Shiroro",
            "Suleja",
            "Tafa",
            "Wushishi"
        ],
        Ogun: [
            "Abeokuta North",
            "Abeokuta South",
            "Ado-Odo Ota",
            "Egbado North",
            "Egbado South",
            "Ewekoro",
            "Ifo",
            "Ijebu East",
            "Ijebu North",
            "Ijebu North East",
            "Ijebu Ode",
            "Ikenne",
            "Imeko Afon",
            "Ipokia",
            "Obafemi Owode",
            "Odeda",
            "Odogbolu",
            "Ogun Waterside",
            "Remo North",
            "Shagamu"
        ],
        Ondo: [
            "Akoko North-East",
            "Akoko North-West",
            "Akoko South-West",
            "Akoko South-East",
            "Akure North",
            "Akure South",
            "Ese Odo",
            "Idanre",
            "Ifedore",
            "Ilaje",
            "Ile Oluji-Okeigbo",
            "Irele",
            "Odigbo",
            "Okitipupa",
            "Ondo East",
            "Ondo West",
            "Ose",
            "Owo"
        ],
        Osun: [
            "Atakunmosa East",
            "Atakunmosa West",
            "Aiyedaade",
            "Aiyedire",
            "Boluwaduro",
            "Boripe",
            "Ede North",
            "Ede South",
            "Ife Central",
            "Ife East",
            "Ife North",
            "Ife South",
            "Egbedore",
            "Ejigbo",
            "Ifedayo",
            "Ifelodun",
            "Ila",
            "Ilesa East",
            "Ilesa West",
            "Irepodun",
            "Irewole",
            "Isokan",
            "Iwo",
            "Obokun",
            "Odo Otin",
            "Ola Oluwa",
            "Olorunda",
            "Oriade",
            "Orolu",
            "Osogbo"
        ],
        Oyo: [
            "Afijio",
            "Akinyele",
            "Atiba",
            "Atisbo",
            "Egbeda",
            "Ibadan North",
            "Ibadan North-East",
            "Ibadan North-West",
            "Ibadan South-East",
            "Ibadan South-West",
            "Ibarapa Central",
            "Ibarapa East",
            "Ibarapa North",
            "Ido",
            "Irepo",
            "Iseyin",
            "Itesiwaju",
            "Iwajowa",
            "Kajola",
            "Lagelu",
            "Ogbomosho North",
            "Ogbomosho South",
            "Ogo Oluwa",
            "Olorunsogo",
            "Oluyole",
            "Ona Ara",
            "Orelope",
            "Ori Ire",
            "Oyo",
            "Oyo East",
            "Saki East",
            "Saki West",
            "Surulere"
        ],
        Plateau: [
            "Bokkos",
            "Barkin Ladi",
            "Bassa",
            "Jos East",
            "Jos North",
            "Jos South",
            "Kanam",
            "Kanke",
            "Langtang South",
            "Langtang North",
            "Mangu",
            "Mikang",
            "Pankshin",
            "Qua an Pan",
            "Riyom",
            "Shendam",
            "Wase"
        ],
        Sokoto: [
            "Binji",
            "Bodinga",
            "Dange Shuni",
            "Gada",
            "Goronyo",
            "Gudu",
            "Gwadabawa",
            "Illela",
            "Isa",
            "Kebbe",
            "Kware",
            "Rabah",
            "Sabon Birni",
            "Shagari",
            "Silame",
            "Sokoto North",
            "Sokoto South",
            "Tambuwal",
            "Tangaza",
            "Tureta",
            "Wamako",
            "Wurno",
            "Yabo"
        ],
        Taraba: [
            "Ardo Kola",
            "Bali",
            "Donga",
            "Gashaka",
            "Gassol",
            "Ibi",
            "Jalingo",
            "Karim Lamido",
            "Kumi",
            "Lau",
            "Sardauna",
            "Takum",
            "Ussa",
            "Wukari",
            "Yorro",
            "Zing"
        ],
        Yobe: [
            "Bade",
            "Bursari",
            "Damaturu",
            "Fika",
            "Fune",
            "Geidam",
            "Gujba",
            "Gulani",
            "Jakusko",
            "Karasuwa",
            "Machina",
            "Nangere",
            "Nguru",
            "Potiskum",
            "Tarmuwa",
            "Yunusari",
            "Yusufari"
        ],
        Zamfara: [
            "Anka",
            "Bakura",
            "Birnin Magaji Kiyaw",
            "Bukkuyum",
            "Bungudu",
            "Gummi",
            "Gusau",
            "Kaura Namoda",
            "Maradun",
            "Maru",
            "Shinkafi",
            "Talata Mafara",
            "Chafe",
            "Zurmi"
        ]
    };

    jQuery(function() {
        $("#state").change(function() {
            let output = ""; // will hold the HTML for second list

            // Loop over the array that matches the selected state
            options[$(this).val()].forEach(function(st) {
                output += "<option>" + st + "</option>";
            });

            $("#lga").html(output); // Inject the HTML string into the list
        })
    });

    $('#hosp_number').change(function(){
        const folder = document.querySelector('#hosp_number').value;
        // alert(folder);
        $.post('check_folder.php', {'folder_number' : folder}, function(data) {
            const result = document.querySelector('#folderResult');
            if(data =='exist') {
                result.html('<span>Already exist</span>');
                //   result.append("Already exist");
            } else {
                result.append(data);
            }
        });
    });


</script>
