<?php
require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$user = User::find_by_id($session->user_id);

//echo $user->unit;  exit;

$lab = LabServices::find_by_id($_GET['id']);


$testRequest = TestRequest::find_by_id($lab->test_request_id);

$labWalkIn = LabWalkIn::find_by_id($testRequest->labWalkIn_id);

$patient = Patient::find_by_id($testRequest->patient_id);





if(is_post()) {



    $date_col = strftime("%Y-%m-%d %H:%M:%S", time());

    $time_col = strftime("%H:%M:%S", time());

    $dept   = test_input($_POST['department']);

    $urine = test_input($_POST['Urine']);

    $blood = test_input($_POST['Blood']);

    $stool = test_input($_POST['Stool']);

    $swab  = test_input($_POST['Swab']);

    $body_aspirate = test_input($_POST['BodyAspirate']);

    $sputum = test_input($_POST['Sputum']);

    $semen = test_input($_POST['Semen']);

    $specimen = array();
    if (isset($urine) and !empty($urine)){
        $specimen[] = $urine;
    }
    if (isset($blood) and !empty($blood)){
        $specimen[] = $blood;
    }
    if (isset($stool) and !empty($stool)){
        $specimen[] = $stool;
    }
    if (isset($swab) and !empty($swab)){
        $specimen[] = $swab;
    }
    if (isset($body_aspirate) and !empty($body_aspirate)){
        $specimen[] = $body_aspirate;
    }
    if (isset($sputum) and !empty($sputum)){
        $specimen[] = $sputum;
    }
    if (isset($semen) and !empty($semen)){
        $specimen[] = $semen;
    }

    $json = json_encode($specimen);
 //   print_r($json); exit;

    $result                  = new Result();
    $result->exempted_by     = "";
    $result->sync            = "off";
    $result->lab_no          = 0;
    $result->bill_id         = $lab->bill_id;   
    $result->patient_id      = $patient->id;
    $result->labWalkIn_id    = $labWalkIn->id;
    $result->waiting_list_id = $testRequest->waiting_list_id; 
    $result->test_request_id = $testRequest->id;
    $result->ward            = $lab->ward_clinic;
    $result->clinic          = $lab->ward_clinic;
    $result->doctor          = $testRequest->consultant;
    $result->consultant      = "";
    $result->test            = $lab->services; // specimen_condition
    $result->specimen        = $json;
    $result->specimen_condition = $_POST['specimen_condition'];
    $result->date_col        = $date_col;
    $result->date_rec        = "";
    $result->time_col        = $time_col;
    $result->time_rec        = "";
    $result->sample_col_by   = $user->full_name();
    $result->sample_rec_by   = "";
    $result->doctor_note     = $testRequest->doc_note;
    $result->scientist_note  = "";
    $result->path_note       = "";
    $result->dept            = $user->unit;  // $dept;
    $result->unit            = $_POST['unit'];
    $result->resultData      = "";
    $result->scientist       = "";
    $result->pathologist     = "";
    $result->status          = "REQUEST";
    $result->date            =  "";
    if ($result->save()){
        $lab->status = 'DONE';
        $lab->save();
        $session->message("Patient's sample has been received.");
        redirect_to('sample_col_service.php');
    }





}



require('../layout/header.php');
?>



    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> LABORATORY </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="home.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active">Sample Collection</li>
                        </ul>
                    </div>

                </div>
            </div>

            <a href="../lab/sample_col_service.php" style="font-size: large">&laquo; Back</a>

            <div class="row clearfix">
                <div class="col-lg-6 col-md-6 col-sm-6 ">
                    <div class="card">

                        <div class="body">

                            <h4>  Patient Details</h4>
                            <table class="table table">
                                <tr class="table">
                                    <th> Patient </th>
                                    <td id="account_number">
                                    <?php
                                        if (!empty($patient)){
                                            echo $patient->first_name ." ". $patient->last_name;
                                        } else {
                                            $labWalkIn = LabWalkIn::find_by_id($testRequest->labWalkIn_id);
                                            echo $labWalkIn->first_name ." ". $labWalkIn->last_name;
                                        }
                                     ?>
                                    </td>
                                </tr>
                                <tr class="table">
                                    <th>Age</th>
                                    <td id="account_name"><?php
                                     if (!empty($patient)){
                                        echo getAge($patient->dob) ."years";
                                    } else {
                                        $labWalkIn = LabWalkIn::find_by_id($testRequest->labWalkIn_id);
                                        echo $labWalkIn->age ."years";
                                    } 
                                        ?>
                                    </td>
                                </tr>
                                <tr class="table">
                                    <th> Gender</th>
                                    <td id="account_balance">
                                        <?php
                                            if (!empty($patient)){
                                                echo $patient->gender;
                                            } else {
                                                $labWalkIn = LabWalkIn::find_by_id($testRequest->labWalkIn_id);
                                                echo $labWalkIn->gender;
                                            } 
                                          
                                        ?>
                                    </td>
                                </tr>
                                <tr class="table">
                                    <th> Clinic </th>
                                    <td id="account_balance">
                                    <?php 
                                      if (!empty($patient)){
                                        echo $lab->ward_clinic; 
                                        } else {
                                            echo "NA";
                                        } 
                                   ?>

                                    </td>
                                </tr>

                                <tr class="table">
                                    <th> Doctor </th>
                                    <td id="account_balance"><?php echo $testRequest->consultant ?></td>
                                </tr>
                                <tr class="table">
                                    <th> Investigation(s) </th>
                                    <td id="account_balance"><?php
                                        $decode = json_decode($lab->services);
                                        if (empty($decode)){
                                            echo $lab->services;
                                        } else {
                                            foreach ($decode as $item) {
                                                echo $item. "<br/>";
                                            }
                                        }  
                                        ?></td>
                                </tr>
                                <tr class="table">
                                    <th> Date Of Request</th>
                                    <td id="created"><?php $d_date = date('d/m/Y h:i a', strtotime($testRequest->date ));
                                        echo $d_date ?></td>
                                </tr>
                            </table>



                        </div>
                    </div>

                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 ">
                    <div class="card">
                        <div class="header">
                            <h2>Sample Collection</h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <form  method="post" action="">

                                    <?php
                                        if ($user->unit == 'Haematology'){ ?>
                                            <div class="col-sm-12">
                                                <b>Select Laboratory Unit</b>
                                                <select class="form-control" name="unit" required >
                                                    <option value="" selected="selected" >--Select Laboratory--</option>
                                                    <option value='Haematology'>Haematology</option>
                                                    <option value='Blood Transfusion'>Blood Transfusion</option>
                                                </select>
                                            </div>
                                   <?php } ?>

                                    <?php
                                    if ($user->unit == 'Microbiology'){ ?>
                                        <div class="col-sm-12">
                                            <b>Select Laboratory Unit</b>
                                            <select class="form-control" name="unit" required >
                                                <option value="" selected="selected" >--Select Laboratory--</option>
                                                <option value='Microbiology'>Microbiology</option>
                                                <option value='Parasitology'>Parasitology</option>
                                            </select>
                                        </div>
                                    <?php } ?>

                                    <?php
                                    if ($user->unit == 'Chemical Pathology'){ ?>
                                        <div class="col-sm-12">
                                            <b>Select Laboratory Unit</b>
                                            <select class="form-control" name="unit" required >
                                                <option value="" selected="selected" >--Select Laboratory--</option>
                                                <option value='Chemical Pathology'>Chemical Pathology</option>
                                            </select>
                                        </div>
                                    <?php } ?>

                                    <?php
                                    if ($user->unit == 'Histology'){ ?>
                                        <div class="col-sm-12">
                                            <b>Select Laboratory Unit</b>
                                            <select class="form-control" name="unit" required >
                                                <option value="" selected="selected" >--Select Laboratory--</option>
                                                <option value='Histology'>Histology</option>
                                            </select>
                                        </div>
                                    <?php } ?>

<!--                                    --><?php
//                                    if ($user->unit == 'Nuclear Medicine'){ ?>
<!--                                        <div class="col-sm-12">-->
<!--                                            <b>Select Laboratory Unit</b>-->
<!--                                            <select class="form-control" name="unit" required >-->
<!--                                                <option value="" selected="selected" >--Select Laboratory--</option>-->
<!--                                                <option value='Nuclear Medicine'>Nuclear Medicine</option>-->
<!--                                            </select>-->
<!--                                        </div>-->
<!--                                    --><?php //} ?>

<!--                                    <div class="col-sm-12">
                                        <b>Select Laboratory Unit</b>
                                        <select class="form-control" name="department" required >
                                            <option value="" selected="selected" >--Select Laboratory--</option>
                                            <option value='Haematology'>Haematology</option>
                                            <option value='Blood Transfusion'>Blood Transfusion</option>
                                            <option value='Chemical Pathology'>Chemical Pathology</option>
                                            <option value='Microbiology'>Microbiology</option>
                                            <option value='Parasitology'>Parasitology</option>
                                            <option value='Histology'>Histology</option>
                                        </select>
                                    </div>
                                    -->
                                    <br/>

                                   <!-- <div class="col-sm-12">
                                        <b>Time Sample Taken (12 hour)</b>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="icon-clock"></i></span>
                                            </div>
                                            <input type="time" class="form-control" name="time_col" placeholder="Ex: 11:59 pm">
                                        </div>
                                     </div>-->


                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label> Nature Of Specimen </label>
                                            <br/>
                                            <label class="fancy-checkbox">
                                                <input type="checkbox" name="Urine" value="Urine" >
                                                <span>Urine</span>
                                            </label>
                                            <label class="fancy-checkbox">
                                                <input type="checkbox" name="Blood" value="Blood">
                                                <span>Blood</span>
                                            </label>
                                            <label class="fancy-checkbox">
                                                <input type="checkbox" name="Stool" value="Stool">
                                                <span>Stool</span>
                                            </label>
                                            <label class="fancy-checkbox">
                                                <input type="checkbox" name="Swab" value="Swab">
                                                <span>Swab</span>
                                            </label>
                                            <label class="fancy-checkbox">
                                                <input type="checkbox" name="BodyAspirate" value="Body Aspirate">
                                                <span>Body Aspirate</span>
                                            </label>
                                            <label class="fancy-checkbox">
                                                <input type="checkbox" name="Sputum" value="Sputum">
                                                <span>Sputum</span>
                                            </label>
                                            <label class="fancy-checkbox">
                                                <input type="checkbox" name="Semen" value="Semen">
                                                <span>Semen</span>
                                            </label>
                                            <label class="fancy-checkbox">
                                                <input type="checkbox" name="Tissue" value="Tissue">
                                                <span>Tissue</span>
                                            </label>
                                            <!--<p id="error-checkbox"></p>-->
                                        </div>

                                    </div>

                                    <div class="col-sm-12">
                                        <b>Condition Of Specimen</b>
                                        <input class="form-control" name="specimen_condition"  required
                                         placeholder="Condition Of Specimen" />
                                    </div>
                                    <br/>


                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <button type="submit"  class="btn btn-outline-primary">Send Sample For Analysis</button>
                                        </div>
                                    </div>
                                </form>






                            </div>



                        </div>
                    </div>




                </div>

            </div>







        </div>
    </div>




<?php

require('../layout/footer.php');