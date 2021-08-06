<?php

/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/17/2019
 * Time: 4:43 PM
 */


require_once("../includes/initialize.php"); 

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$user        = User::find_by_id($session->user_id);


$service     = RadioServices::find_by_id($_GET['id']);
$scanRequest = ScanRequest::find_by_id($service->scan_request_id);

/*
    $bill = Bill::find_by_id($_GET['id']);
    $scanRequest = ScanRequest::find_by_bill_id($bill->id);
    $waiting     = WaitingList::find_by_id($scanRequest->waiting_list_id);

    $clinic = Clinic::find_by_id($waiting->clinic_id);
    $sub_clinic = SubClinic::find_by_id($waiting->sub_clinic_id);
*/

$patient = Patient::find_by_id($scanRequest->patient_id);


$user = User::find_by_id($session->user_id);



if (is_post()) {


    $res = $_POST['result'];
    $json = json_encode($res);


    $result                  = new ScanResult();
    $result->exempted_by     = "";
    $result->sync            = "off";
    $result->xray_no         = $_POST['xray_no'];
    $result->bill_id         = $service->bill_id;
    $result->patient_id      = $patient->id;
    $result->waiting_list_id = $scanRequest->waiting_list_id;
    $result->scan_request_id = $scanRequest->id;
    $result->ward            = $service->ward_clinic;
    $result->clinic          = $service->ward_clinic;
    $result->doctor          = $scanRequest->consultant;
    $result->consultant      = $scanRequest->consultant;
    $result->scan            = $service->services;
    $result->date_ex         = "";
    $result->time_ex         = "";
    $result->doctor_note     = $scanRequest->doc_com;
    $result->radiologist_note = "";
    $result->resultData      = $json;
    $result->clinical        = $scanRequest->doc_com;
    $result->diagnosis       = "";
    $result->radiologist     = "";
    $result->ultrasound      = "";
    $result->radiologist     = $user->full_name();

    $result->dept            = $dept;
    $result->dept_id         = $dept_id;

    $result->date            =  strftime("%Y-%m-%d %H:%M:%S", time());
    if (isset($_POST['save_and_send'])) {
        $service->status = "DONE";
        $service->save();
        $result->status  = "DONE";
        $result->save();
        $bill->status = 'CLEARED';
        //  $bill->save();
        $session->message("Result has been sent to Doctor.");
        redirect_to('results.php');
    }
/*    if ($result->save()) {
        $session->message("Result has been saved.");
        redirect_to('form.php?id=<?php echo $bill->id ?>');
    }*/
}








require('../layout/header.php');
?>


<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>
                        Radiology Request Forms </h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Radiology</li>
                        <li class="breadcrumb-item active">Forms</li>
                    </ul>
                </div>

            </div>
        </div>



        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card patients-list">

                    <div class="body">
                        <div class="container">

                            <a href="../rad/investigations_service.php">Back</a>

                            <h4 style="text-align: center">OBAFEMI AWOLOWO UNIVERSITY TEACHING HOSPITALS COMPLEX</h4>
                            <h6 style="text-align: center">RADIOLOGY/ULTRASOUND FORM</h6>




                            <form action="" method="post">


                                <div class="row">

                                </div>

                                <div class="row">


                                    <div class="col-md-6">


                                        <div class="table-responsive">
                                            <!--<h4><?php /*echo $patient->full_name() */ ?></h4>-->
                                            <table class="table table">
                                                <tbody>
                                                    <tr class="active">
                                                        <th>Patient</th>
                                                        <td>
                                                            <?php
                                                            if (!empty($patient)) {
                                                                echo $patient->first_name . " " . $patient->last_name;
                                                            } else {
                                                                $radWalkIn = RadWalkIn::find_by_id($scanRequest->radWalkIn_id);
                                                                echo $radWalkIn->first_name . " " . $radWalkIn->last_name;
                                                            }

                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr class="active">
                                                        <th>Clinical Details</th>
                                                        <td> <?php echo $scanRequest->doc_com  ?></td>
                                                    </tr>

                                                    <?php
                                                    if (!empty($patient)) {  ?>
                                                        <tr class="active">
                                                            <th>Birthdate</th>
                                                            <td> <?php $d_date = date('d-M-Y', strtotime($patient->dob));
                                                                    echo $d_date ?></td>
                                                        </tr>
                                                    <?php } ?>

                                                    <tr class="table">
                                                        <th>Age</th>
                                                        <td id="account_name">
                                                            <?php
                                                                                if (!empty($patient)) {
                                                                                    echo getAge($patient->dob) . "years";
                                                                                } else {
                                                                                    $radWalkIn = RadWalkIn::find_by_id($scanRequest->radWalkIn_id);
                                                                                    echo $radWalkIn->age . "years";
                                                                                }
                                                                                ?>
                                                        </td>
                                                    </tr>

                                                    <tr class="table">
                                                        <th>Sex</th>
                                                        <td id="account_name"><?php
                                                                                if (!empty($patient)) {
                                                                                    echo $patient->gender;
                                                                                } else {
                                                                                    $radWalkIn = RadWalkIn::find_by_id($scanRequest->radWalkIn_id);
                                                                                    echo $radWalkIn->gender;
                                                                                }
                                                                                ?>
                                                        </td>
                                                    </tr>

                                                    <tr class="active">
                                                        <th>Investigations</th>
                                                        <td> <?php $decode = json_decode($service->services);
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
                                                    <th>Xray No.</th>
                                                    <td> <input class="form-control" style="width: 300px;" value="" name="xray_no" /> </td>
                                                </tr>

                                                <tr class="active">
                                                    <th>Hospital No.</th>
                                                    <td> <?php echo $patient->folder_number   ?> </td>
                                                </tr>
                                                <tr class="active">
                                                    <th>Ward/Clinic </th>
                                                    <td> <?php echo $service->ward_clinic ?> </td>
                                                </tr>
                                                <tr class="active">
                                                    <th> Doctor </th>
                                                    <td> <?php echo $scanRequest->consultant  ?> </td>
                                                </tr>
                                                <!--
                                                <tr class="active">
                                                    <th>Date Sample Col.</th>
                                                    <td> <?php $d_date = date('d/M/Y', strtotime($result->date_col));
                                                            $time = date('h:i a', strtotime($result->time_col));
                                                            echo $d_date . " " . $time ?>  </td>
                                                </tr>
                                                -->


                                            </tbody>
                                        </table>

                                    </div>
                                </div>

                                <div class="col-md-12"> 

                                    <div class="body">
                                        <!--   <div class="summernote" name="editor" >   -->
                                        <textarea class="summernote" name="result">


                                            </textarea>

                                        <!--  </div>   -->


                                        <div class="input-group mb-3">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="inputGroupFile02">
                                                <label class="custom-file-label" for="inputGroupFile02">Choose file...</label>
                                            </div>
                                            <!--
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="">Upload</span>
                                            </div>
                                            -->
                                        </div>


                                    </div>

                                </div>

                                <p class="margin-top-30">
                                    <!--<button type="submit" name="save_only" class="btn btn-lg btn-primary">Save Only</button> &nbsp;&nbsp;-->
                                    <button type="submit" name="save_and_send" class="btn btn-lg btn-success">Save And Send</button>
                                </p>




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
