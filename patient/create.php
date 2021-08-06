<?php

/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/1/2019
 * Time: 9:25 AM
 */
require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$user = User::find_by_id($session->user_id);

$bill = Bill::find_by_id($_GET['id']);

$confirmation = Bill::find_by_waiting_registration($bill->bill_number);

if (empty($confirmation)) {
      redirect_to("reg_patient.php");
}


$message = "";
$done = FALSE;
$errMessage = "";
$first_name = $last_name = $username = $password = $created = $role = "";
$errHospNumber = $errFirstName = $errLastName = $errUserName = $errPassword = $errCreated = $errRole = "";


if (is_post()) {

    if (empty($_POST['title'])) {
        $errTitle = "Title is Required";
        $errMessage .= $errTitle . "<br/>";
    } else {
        $title = test_input($_POST['title']);
    }

    if (empty($_POST['first_name'])) {
        $errFirstName = "First Name is Required";
        $errMessage .= $errFirstName . "<br/>";
    } else {
        $first_name = test_input($_POST['first_name']);
/*        if (!preg_match("/^[a-zA-Z]*$/", $first_name)) {
            $errFirstName = "Only letters and white space are allowed for First Name";
            $errMessage .= $errFirstName . "<br/>";
        }*/
    }

    if (empty($_POST['last_name'])) {
        $errLastName = "Last Name is Required";
        $errMessage .= $errLastName . "<br/>";
    } else {
        $last_name = test_input($_POST['last_name']);
/*        if (!preg_match("/^[a-zA-Z]*$/", $last_name)) {
            $errLastName = "Only letters and white space are allowed for Last Name";
            $errMessage .= $errLastName . "<br/>";
        }*/
    }

    /*    if (empty($_POST['hosp_number'])) {
        $errFolderNumber = "Folder Number is Required";
        $errMessage .= $errFolderNumber . "<br/>";
    } else {
        $hosp_number = test_input($_POST['hosp_number']);
    }*/

    if (empty($_POST['hosp_number'])) {
        $errFolderNumber = "Hospital Number  is Required";
        $errMessage .= $errFolderNumber . "<br/>";
    } else {
        $hosp_number = test_input($_POST['hosp_number']);
        $pat = Patient::find_by_number($hosp_number);

        if (isset($pat) && !empty($pat)) {
            $errHospNumber = "Hospital Number already exists";
            $errMessage .= $errHospNumber . "<br/>";
        }
    }



    $dob = new DateTime($_POST['dob']);
    $dob = date_format($dob, 'Y-m-d');

    $clinic_number  = test_input($_POST['clinic_number']);
    $marital_status = test_input($_POST['marital_status']);

    if (empty($_POST['gender'])) {
        $errGender = "Gender is Required";
        $errMessage .= $errGender . "<br/>";
    } else {
        $gender = test_input($_POST['gender']);
    }

    if (empty($_POST['gender'])) {
        $errGender = "Gender is Required";
        $errMessage .= $errGender . "<br/>";
    } else {
        $gender = test_input($_POST['gender']);
    }

    if (empty($_POST['nationality'])) {
        $errNationality = "Nationality is Required";
        $errMessage .= $errNationality . "<br/>";
    } else {
        $nationality = test_input($_POST['nationality']);
        if (!preg_match("/^[a-zA-Z]*$/", $nationality)) {
            $errNationality = "Only letters and white space are allowed for Nationality";
            $errMessage .= $errNationality . "<br/>";
        }
    }

    $other_nation = test_input($_POST['other_nation']);

    $place_origin = test_input($_POST['place_origin']); 

    if (empty($_POST['state'])) {
        $errState = "State Of Origin is Required";
        $errMessage .= $errState . "<br/>";
    } else {
        $state = test_input($_POST['state']);
    }

    if (empty($_POST['lga'])) {
        $errLga = "Local Govt. of Birth is Required";
        $errMessage .= $errLga . "<br/>";
    } else {
        $lga = test_input($_POST['lga']);
    }

    $occupation = test_input($_POST['occupation']);

    if (empty($_POST['address'])) {
        $errAddress = "Contact Address is Required";
        $errMessage .= $errAddress . "<br/>";
    } else {
        $address = test_input($_POST['address']);
    }

/*    if (empty($_POST['phone_number'])) {
        $errPhoneNumber = "Phone Number  is Required";
        $errMessage .= $errPhoneNumber . "<br/>";
    } else {*/
        $phone_number = test_input($_POST['phone_number']);
  //  }

    $email = test_input($_POST['email']);

    $religion = test_input($_POST['religion']);

    $english = test_input($_POST['English']);

    $pidgin = test_input($_POST['Pidgin']);

    $hausa = test_input($_POST['Hausa']);

    $yoruba = test_input($_POST['Yoruba']);

    $igbo = test_input($_POST['Igbo']);

    $other_lang = test_input($_POST['other_lang']);

    $next_kin = test_input($_POST['next_kin']);

    $relation_next_kin = test_input($_POST['relation_next_kin']);

    $address_next_kin = test_input($_POST['address_next_kin']);

    $phone_number_next_kin = test_input($_POST['phone_number_next_kin']);

    $waiting_list = test_input($_POST['waiting']);

    $system_number = getSystemNumber($first_name, $last_name);

    //  echo $hosp_number;  exit;

    //   $hNumber = Patient::find_by_hosp_number($hosp_number);

    //  echo $hNumber;  echo "<br/>";

    //  print_r($hNumber); exit;
    //  if (isset($hNumber) && !empty($hNumber)) {
    //      $errHospNumber = "Hospital Number already exists";
    //      $errMessage .= $errHospNumber . "<br/>";
    //  }


    if ((!$errMessage) and (empty($errMessage))) {
        $date_registered = strftime("%Y-%m-%d %H:%M:%S", time());

        $patient                   = new Patient();
        $patient->sync             = "off";
        $patient->folder_number    = $hosp_number;
        $patient->system_number    = $system_number;
        $patient->tracking_no      = "Tracking Number";
        $patient->nhis_no          = NULL;
        $patient->nhis_reg_date    = "";
        $patient->nhis_eligibility = NULL;
        $patient->title            = $title;
        $patient->first_name       = $first_name;
        $patient->last_name        = $last_name;
        $patient->dob              = $dob;
        $patient->age              = "";
        $patient->gender           = $gender;
        $patient->blood_group      = "";
        $patient->genotype         = "";
        $patient->phone_number     = $phone_number;
        $patient->email            = $email;
        $patient->address          = $address;
        $patient->occupation       = $occupation;
        $patient->marital_status   = $marital_status;
        $patient->nationality      = $nationality;
        $patient->other_nation     = $other_nation;
        $patient->place_origin     = $place_origin;
        $patient->state            = $state;
        $patient->lga              = $lga;
        $patient->religion         = $religion;
        $patient->language         = "";
        $patient->english          = $english;
        $patient->pidgin           = $pidgin;
        $patient->hausa            = $hausa;
        $patient->yoruba           = $yoruba;
        $patient->igbo             = $igbo;
        $patient->other_lang       = "";
        $patient->next_kin_surname = $next_kin;
        $patient->next_kin_other_names = "";
        $patient->next_kin_relationship = $relation_next_kin;
        $patient->next_kin_phone        = $phone_number_next_kin;
        $patient->next_kin_address = $address_next_kin;
        $patient->status           = $waiting_list;
        $patient->registered_by    = $user->full_name();   
        $patient->date_registered  = $date_registered;


        if ($patient->save()) {
            $patientSubClinic                = new PatientSubClinic();
            $patientSubClinic->sync          = "off";
            $patientSubClinic->patient_id    = $patient->id;
            $patientSubClinic->sub_clinic_id = $_POST['sub_clinic_id'];
            $patientSubClinic->clinic_id     = $_POST['clinic_id'];
            $patientSubClinic->clinic_number = $clinic_number;
            $patientSubClinic->date          = strftime("%Y-%m-%d %H:%M:%S", time());
            if ($patientSubClinic->save()) {
                $wait_list                = new WaitingList();
                $wait_list->sync          = "off";
                $wait_list->patient_id    = $patient->id;
                $wait_list->clinic_id     = $_POST['clinic_id'];
                $wait_list->sub_clinic_id = $_POST['sub_clinic_id'];
                $wait_list->room_id       = 0;
                $wait_list->officer       = $user->full_name();
                $wait_list->dr_seen       = "";
                $wait_list->vitals        = '';
                $wait_list->status        = 'nurse';
                $wait_list->date          = strftime("%Y-%m-%d %H:%M:%S", time());
                $wait_list->save();

                $bill->status = "CLEARED";
                $bill->save();
                $done = TRUE;
                $session->message("Patient Folder has been created.");
                redirect_to('index.php');
            }
        }
    }

    if ($errMessage) {
        $panelClass = 'panel-danger';
        $panelHeader = '<div class="panel-heading"><h3 class="panel-title">Please correct the errors in the form<br></h3> class=
                          "panel-title alert alert-danger">' . $errMessage . '</h3> </div>';
    }
}


require('../layout/header.php');
?>


<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Patient Registration </h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="home.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active">Register Patient</li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <form id="basic-form" method="post" action="">
                    <div class="card">
                        <div class="header">
                            <h2>Basic Information </h2>

<!--                            <?php
/*                            if (is_post()) {
                                if ($done == TRUE) { */?>
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        Patient Folder has been created.
                                    </div>
                                <?php /*  } else if (empty($errMessage) == FALSE and isset($errMessage)) {
                                */?>
                                    <div class="alert alert-warning alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <?php /*echo $errMessage; */?>
                                    </div>
                                <?php
/*                                }
                            } else {  */?>
                                <div class="alert alert-info alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <i class="fa fa-info-circle"></i> All fields marked <span style="color: red">*</span> are required
                                </div>
                            <?php /*    } */?>

                            --><?php /*echo output_message($message); */?>



                        </div>
                        <div class="body">
                            <div class="row clearfix">

                                <div class="col-sm-4">

                                    <div class="form-group">
                                        <label> Title </label>
                                        <br />
                                        <label class="fancy-radio">
                                            <input type="radio" name="title" value="Mr" required data-parsley-errors-container="#error-radio">
                                            <span><i></i>Mr</span>
                                        </label>
                                        <label class="fancy-radio">
                                            <input type="radio" name="title" value="Mrs">
                                            <span><i></i>Mrs</span>
                                        </label>
                                        <label class="fancy-radio">
                                            <input type="radio" name="title" value="Master">
                                            <span><i></i>Master</span>
                                        </label>
                                        <label class="fancy-radio">
                                            <input type="radio" name="title" value="Miss">
                                            <span><i></i>Miss</span>
                                        </label>
                                        <p id="error-radio"></p>
                                    </div>


                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Last Name(Surname)</label>
                                        <input type="text" class="form-control" name="last_name" value="<?php echo $bill->last_name ?>" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input type="text" class="form-control" name="first_name" value="<?php echo $bill->first_name ?>" required>
                                    </div>
                                </div>


                            </div>

                            <div class="row clearfix">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Hospital Number (Old)</label>
                                        <input type="text" class="form-control" id="hosp_number" name="hosp_number" value="<?php echo $hosp_number ?>" required>
                                        <span id="folderResult"></span>
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
                                        <input type="text" class="form-control" name="clinic_number" value="<?php echo $clinic_number ?>">
                                    </div>
                                </div>

                            </div>

                            <div class="row clearfix">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Date Of Birth</label>
                                        <input type="text" class="form-control" name="dob" id="dob" placeholder="dd-mm-yyyy" value="<?php echo $dob ?>" required>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label> Gender </label>
                                        <br />
                                        <label class="fancy-radio">
                                            <input type="radio" name="gender" value="Male" required data-parsley-errors-container="#error-radio">
                                            <span><i></i>Male</span>
                                        </label>
                                        <label class="fancy-radio">
                                            <input type="radio" name="gender" value="Female">
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
                                            <input type="radio" name="marital_status" value="Single" required data-parsley-errors-container="#error-radio">
                                            <span><i></i>Single</span>
                                        </label>
                                        <label class="fancy-radio">
                                            <input type="radio" name="marital_status" value="Married">
                                            <span><i></i>Married</span>
                                        </label>
                                        <label class="fancy-radio">
                                            <input type="radio" name="marital_status" value="Separated">
                                            <span><i></i>Separated</span>
                                        </label>
                                        <label class="fancy-radio">
                                            <input type="radio" name="marital_status" value="Divorced">
                                            <span><i></i>Divorced</span>
                                        </label>
                                        <label class="fancy-radio">
                                            <input type="radio" name="marital_status" value="Widow/Widower">
                                            <span><i></i>Widow/Widower</span>
                                        </label>
                                        <label class="fancy-radio">
                                            <input type="radio" name="marital_status" value="Single Parent">
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
                                            <input type="radio" name="nationality" value="Nigerian" required data-parsley-errors-container="#error-radio">
                                            <span><i></i>Nigerian</span>
                                        </label>
                                        <label class="fancy-radio">
                                            <input type="radio" name="nationality" value="Others">
                                            <span><i></i>Others</span>
                                        </label>
                                        <p id="error-radio"></p>
                                    </div>
                                </div>

                                <!--
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Specify for Others</label>
                                        <input type="text" class="form-control" name="other_nation" value="<?php echo $other_nation ?>">
                                    </div>
                                </div>
                                -->

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Place Of Origin</label>
                                        <input type="text" class="form-control" name="place_origin" value="<?php echo $place_origin ?>">
                                    </div>
                                </div>



                                <div class="col-sm-3">
                                   
                                    <div class="form-group">
                                        <label class="control-label">State of Origin</label>
                                        <select name="state" id="state" class="form-control">
                                            <option value="" selected="selected">- Select -</option>
                                            <option value='Abia'>Abia</option>
                                            <option value='Adamawa'>Adamawa</option>
                                            <option value='AkwaIbom'>AkwaIbom</option>
                                            <option value='Anambra'>Anambra</option>
                                            <option value='Bauchi'>Bauchi</option>
                                            <option value='Bayelsa'>Bayelsa</option>
                                            <option value='Benue'>Benue</option>
                                            <option value='Borno'>Borno</option>
                                            <option value='Cross River'>Cross River</option>
                                            <option value='Delta'>Delta</option>
                                            <option value='Ebonyi'>Ebonyi</option>
                                            <option value='Edo'>Edo</option>
                                            <option value='Ekiti'>Ekiti</option>
                                            <option value='Enugu'>Enugu</option>
                                            <option value='FCT'>FCT</option>
                                            <option value='Gombe'>Gombe</option>
                                            <option value='Imo'>Imo</option>
                                            <option value='Jigawa'>Jigawa</option>
                                            <option value='Kaduna'>Kaduna</option>
                                            <option value='Kano'>Kano</option>
                                            <option value='Katsina'>Katsina</option>
                                            <option value='Kebbi'>Kebbi</option>
                                            <option value='Kogi'>Kogi</option>
                                            <option value='Kwara'>Kwara</option>
                                            <option value='Lagos'>Lagos</option>
                                            <option value='Nasarawa'>Nasarawa</option>
                                            <option value='Niger'>Niger</option>
                                            <option value='Ogun'>Ogun</option>
                                            <option value='Ondo'>Ondo</option>
                                            <option value='Osun'>Osun</option>
                                            <option value='Oyo'>Oyo</option>
                                            <option value='Plateau'>Plateau</option>
                                            <option value='Rivers'>Rivers</option>
                                            <option value='Sokoto'>Sokoto</option>
                                            <option value='Taraba'>Taraba</option>
                                            <option value='Yobe'>Yobe</option>
                                            <option value='Zamfara'>Zamfara</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="col-sm-3">
                                   
                                    <div class="form-group">
                                        <label class="control-label">LGA of Origin</label>
                                        <select name="lga" id="lga" class="form-control" required>
                                        </select>
                                    </div>
                                    
                                    <!--
                                    <div class="form-group">
                                        <label>LGA</label>
                                        <input type="text" class="form-control" name="lga" value="<?php echo $lga ?>">
                                    </div>
                                    -->
                                </div>
                                
                            </div>

                            <!--
                            <div class="row clearfix">

                                <select name="state" id="state">
                                    <option selected="selected">Select item...</option>
                                    <option value='Abia'>Abia</option>
                                    <option value='Adamawa'>Adamawa</option>
                                </select>
                                <select name="lga" id="lga"></select>


                            </div>

                            -->

                            <div class="row clearfix">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Occupation</label>
                                        <input type="text" class="form-control" name="occupation" value="<?php echo $occupation ?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Contact Address</label>
                                        <textarea class="form-control" name="address" rows="3" cols="10" required><?php echo $address ?></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input type="text" class="form-control" name="phone_number"  value="<?php echo $phone_number ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Email Address</label>
                                        <input type="email" class="form-control" name="email" value="<?php echo $email ?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label> Religion </label>
                                        <br />
                                        <label class="fancy-radio">
                                            <input type="radio" name="religion" value="Muslim" required data-parsley-errors-container="#error-radio">
                                            <span><i></i>Muslim</span>
                                        </label>
                                        <label class="fancy-radio">
                                            <input type="radio" name="religion" value="Christian">
                                            <span><i></i>Christian</span>
                                        </label>
                                        <label class="fancy-radio">
                                            <input type="radio" name="religion" value="Others">
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
                                            <input type="checkbox" name="English" value="English">
                                            <span>English</span>
                                        </label>
                                        <label class="fancy-checkbox">
                                            <input type="checkbox" name="Pidgin" value="Pidgin">
                                            <span>Pidgin</span>
                                        </label>
                                        <label class="fancy-checkbox">
                                            <input type="checkbox" name="Hausa" value="Hausa">
                                            <span>Hausa</span>
                                        </label>
                                        <label class="fancy-checkbox">
                                            <input type="checkbox" name="Igbo" value="Igbo">
                                            <span>Igbo</span>
                                        </label>
                                        <label class="fancy-checkbox">
                                            <input type="checkbox" name="Yoruba" value="Yoruba">
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
                                        <input type="text" class="form-control" name="next_kin" value="<?php echo $next_kin ?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Relationship To Next Of Kin</label>
                                        <input type="text" class="form-control" name="relation_next_kin" value="<?php echo $relation_next_kin ?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label> Address Of Next Of Kin</label>
                                        <textarea class="form-control" name="address_next_kin" rows="3" cols="10"><?php echo $address_next_kin ?></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Phone No. Of Next Of Kin</label>
                                        <input type="text" class="form-control" name="phone_number_next_kin" value="<?php echo $phone_number_next_kin ?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">

                                    <div class="form-group">
                                        <label>Add Patient To Clinic Waiting List</label>
                                        <label class="fancy-checkbox">
                                            <input type="checkbox" name="waiting" value="OPEN" required data-parsley-errors-container="#error-checkbox">
                                            <span>Add Patient </span>
                                        </label>
                                    </div>

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
                                        <button type="submit" class="btn btn-primary">Save Patient Record</button>
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

    $('#hosp_number').change(function () {
        //  var selectedOption = $('#classification_id option:selected');
        const folder = document.querySelector('#hosp_number').value;
        // console.log(selectedOption);
        folder ?
            $.post('check_folder.php', {folder_number: folder}, function (data) {
                $('#folderResult').html(data.trim());
            }) : $('#folderResult').html("");
    });


</script>