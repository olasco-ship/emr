<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/23/2019
 * Time: 3:59 PM
 */


require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}


$patient = Patient::find_by_id($_GET['id']);

$vital = Vitals::find_by_patient($patient->id);






require('../layout/header.php');
?>









    <!-- MAIN CONTENT -->
    <div id="main-content">
        <div class="container-fluid">
            <h1 class="sr-only">Dashboard</h1>
            <div class="dashboard-section">

                <h1 class="page-title"><?php echo $patient->title . " " . $patient->full_name(); ?></h1>

                <ul class="nav nav-tabs" role="tablist">
                    <li class="active"><a href="#myprofile" role="tab" data-toggle="tab">Patient's Profile</a></li>
                    <li><a href="#account" role="tab" data-toggle="tab">View Vitals</a></li>
                    <li><a href="#billings" role="tab" data-toggle="tab">Patient History</a></li>
                    <li><a href="#preferences" role="tab" data-toggle="tab">New Diagnosis</a></li>
                </ul>

                <div class="tab-content content-profile">
                    <!-- MY PROFILE -->
                    <div class="tab-pane fade in active" id="myprofile">

                        <div class="profile-section">

                            <div class="tab-pane fade in active" id="myprofile">

                                <div class="profile-section">

                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="table-responsive">
                                                <h4>Patient's Basic Information</h4>
                                                <table class="table table">
                                                    <tbody>
                                                    <tr class="active">
                                                        <th>Title</th>
                                                        <td><?php echo $patient->title ?></td>
                                                    </tr>
                                                    <tr class="success">
                                                        <th>First Name</th>
                                                        <td><?php echo $patient->first_name ?></td>
                                                    </tr>
                                                    <tr class="info">
                                                        <th>Last Name</th>
                                                        <td><?php echo $patient->last_name ?></td>
                                                    </tr>
                                                    <tr class="warning">
                                                        <th>Birthdate</th>
                                                        <td> <?php $d_date = date('d-M-Y', strtotime($patient->dob));
                                                            echo $d_date ?></td>
                                                    </tr>
                                                    <tr class="danger">
                                                        <th>Gender</th>
                                                        <td><?php echo $patient->gender ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="primary"> Contact Address</th>
                                                        <td><?php echo $patient->address ?></td>
                                                    </tr>
                                                    <tr class="success">
                                                        <th> Phone Number</th>
                                                        <td><?php echo $patient->phone_number ?></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="table-responsive">
                                                <h4>Patient's Vital Signs as
                                                    at <?php $d_date = date('d/m/Y h:i a', strtotime($vital->date));
                                                    echo $d_date ?></h4>
                                                <table class="table table-bordered">
                                                    <tbody>
                                                    <tr>
                                                        <th>Blood Pressure</th>
                                                        <td><?php echo $vital->pressure ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Temperature</th>
                                                        <td><?php echo $vital->temperature ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Weight</th>
                                                        <td><?php echo $vital->weight ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Height</th>
                                                        <td><?php echo $vital->height ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Respiratory Rate</th>
                                                        <td><?php echo $vital->resp_rate ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Heart Rate(Pulse)</th>
                                                        <td><?php echo $vital->pulse ?></td>
                                                    </tr>
                                                    </tbody>
                                                </table>


                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>




                        </div>
                    </div>
                    <!-- END MY PROFILE -->
                    <!-- ACCOUNT -->
                    <div class="tab-pane fade" id="account">
                        <div class="profile-section">
                            <div class="clearfix">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="panel-content">
                                            <div class="table-responsive">
                                                <h4>Patient's Vital Signs</h4>
                                                <table class="table ">
                                                    <tbody>
                                                    <tr>
                                                        <th>Blood Pressure</th>
                                                        <td><?php echo $vital->pressure ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Temperature</th>
                                                        <td><?php echo $vital->temperature ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Weight</th>
                                                        <td><?php echo $vital->weight ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Height</th>
                                                        <td><?php echo $vital->height ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Respiratory Rate</th>
                                                        <td><?php echo $vital->resp_rate ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Heart Rate(Pulse)</th>
                                                        <td><?php echo $vital->pulse ?></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                    </div>
                                    <div class="col-md-2">
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- END ACCOUNT -->
                    <!-- BILLINGS -->
                    <div class="tab-pane fade" id="billings">
                        <div class="clearfix">

                            <h1>Hello Third</h1>

                        </div>
                        <p class="margin-top-30">

                            <button type="button" class="btn btn-primary">Update</button> &nbsp;&nbsp;
                            <button class="btn btn-default">Cancel</button>

                        </p>
                    </div>
                    <!-- END BILLINGS -->
                    <!-- PREFERENCES -->
                    <div class="tab-pane fade" id="preferences">

                        <ul class="nav nav-pills" role="tablist">
                            <li class="active"><a href="#caseNote" role="tab" data-toggle="tab"><i class="fa fa-pie-chart"></i>
                                    Case Note </a></li>
                            <li><a href="#drugs" role="tab" data-toggle="tab"><i class="fa fa-bar-chart"></i> Prescribe Drugs
                                </a></li>
                            <li><a href="#lab" role="tab" data-toggle="tab"><i class="fa fa-line-chart"></i>
                                    Laboratory(Haematology) </a></li>
                            <li><a href="#radio" role="tab" data-toggle="tab"><i class="fa fa-line-chart"></i> Radiology & Scan
                                </a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="caseNote">
                                <h3>Case Note</h3>

                                <form action="" method="post">
                                    <textarea class="ckeditor" name="editor"><?php echo $case_note ?></textarea>

                                    <input type="submit" name="save" value="Save Report" class="btn-lg btn-info"/ >
                                </form>


                            </div>
                            <div class="tab-pane fade" id="drugs">
                                <h3> Prescribe Drugs For Patient </h3>

                                <div class="row">

                                    <div class="col-md-8">

                                        <div class="left">
                                            <div class="form-group">
                                                <!--      <input type="text" placeholder="Name Of Drug" class="form-control" name="txtCountry" id="txtCountry" class="typeahead"/> -->
                                                <form class="form-inline" id="formSearch">
                                                    <input type="text" placeholder="Name Of Drug" name="txtProduct"
                                                           id="txtProduct" autocomplete="off" class="typeahead"/>
                                                    <br/>
                                                    <button type="submit" id="submit" class="btn btn-lg btn-primary"
                                                            data-loading-text="Searching...">Submit
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4" id="save_page">
                                        <!--     <div class="col-md-4 bill" id="check">-->

                                        <?php echo PatientBill::save_page(); ?>

                                    </div>

                                </div>


                            </div>

                            <div class="tab-pane fade" id="lab">
                                <h3> Laboratory(Haematology) </h3>

                                <div class="row">

                                    <div class="col-md-7">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th>Name Of Investigation</th>
                                                    <th>Reference</th>
                                                </tr>
                                                </thead>
                                                <tbody id="testItems">
                                                <?php $revs = Test::find_all();
                                                foreach ($revs as $rev) { ?>
                                                    <tr data-id="<?php echo $rev->revenueHead_id; ?>">
                                                        <td>
                                                            <div class="checkbox"><label><input type="checkbox"
                                                                                                class="add_to_bill" value=""
                                                                                                data-id="<?php echo $rev->id; ?>"><?php echo $rev->name; ?>
                                                                </label>
                                                            </div>

                                                        </td>
                                                        <td><?php echo $rev->reference ?></td>
                                                    </tr>
                                                <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>


                                    <div class="col-md-5 bill" id="testCheck">

                                    </div>

                                </div>

                            </div>

                            <div class="tab-pane fade" id="radio">
                                <h3>Radiology & Scan </h3>
                                <p>Competently implement bricks-and-clicks collaboration and idea-sharing rather than visionary
                                    internal or "organic" sources. Rapidiously matrix premium core competencies for.
                                </p>
                            </div>

                        </div>



                    </div>


                </div>



            </div>

        </div>
    </div>
    <!-- END MAIN CONTENT -->



















<?php

require('../layout/footer.php');
