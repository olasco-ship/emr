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

$user = User::find_by_id($session->user_id);

$bill = Bill::find_by_id($_GET['id']);
$scanRequest = ScanRequest::find_by_bill_id($bill->id);
$waiting     = WaitingList::find_by_id($scanRequest->waiting_list_id);

$clinic = Clinic::find_by_id($waiting->clinic_id);
$sub_clinic = SubClinic::find_by_id($waiting->sub_clinic_id);

$patient = Patient::find_by_id($bill->patient_id);


$user = User::find_by_id($session->user_id);



if (is_post()) {


    $res = $_POST['result'];
    $json = json_encode($res);


    $result                  = new ScanResult();
    $result->exempted_by     = "";
    $result->sync            = "off";
    $result->xray_no         = $_POST['xray_no'];
    $result->bill_id         = $bill->id;
    $result->patient_id      = $bill->patient_id;
    $result->waiting_list_id = $waiting->id;
    $result->scan_request_id = $scanRequest->id;
    $result->ward            = "";
    $result->clinic          = $sub_clinic->name;
    $result->doctor          = $scanRequest->consultant;
    $result->consultant      = $scanRequest->consultant;
    $result->scan            = $bill->revenues;
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
        $result->status  = "DONE";
        $result->save();
        $bill->status = 'CLEARED';
        $bill->save();
        $session->message("Result has been sent to Doctor.");
        redirect_to('results.php');
         }
    if ($result->save()) {
        $session->message("Result has been saved.");
        redirect_to('form.php?id=<?php echo $bill->id ?>');
    }
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
                <div class="col-lg-6 col-md-4 col-sm-12 text-right">
                    <div class="bh_chart hidden-xs">
                        <div class="float-left m-r-15">
                            <small>Visitors</small>
                            <h6 class="mb-0 mt-1"><i class="icon-user"></i> 1,784</h6>
                        </div>
                        <span class="bh_visitors float-right">2,5,1,8,3,6,7,5</span>
                    </div>
                    <div class="bh_chart hidden-sm">
                        <div class="float-left m-r-15">
                            <small>Visits</small>
                            <h6 class="mb-0 mt-1"><i class="icon-globe"></i> 325</h6>
                        </div>
                        <span class="bh_visits float-right">10,8,9,3,5,8,5</span>
                    </div>
                    <div class="bh_chart hidden-sm">
                        <div class="float-left m-r-15">
                            <small>Chats</small>
                            <h6 class="mb-0 mt-1"><i class="icon-bubbles"></i> 13</h6>
                        </div>
                        <span class="bh_chats float-right">1,8,5,6,2,4,3,2</span>
                    </div>
                </div>
            </div>
        </div>



        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card patients-list">
                    <div class="header">





                        <ul class="header-dropdown">
                            <li><a class="tab_btn" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Weekly">W</a></li>
                            <li><a class="tab_btn" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Monthly">M</a></li>
                            <li><a class="tab_btn active" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Yearly">Y</a></li>
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another Action</a></li>
                                    <li><a href="javascript:void(0);">Something else</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="container">

                            <a href="../rad/investigations.php">Back</a>

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
                                                        <td> <?php echo $patient->full_name()  ?></td>
                                                    </tr>
                                                    <tr class="active">
                                                        <th>Clinical Details</th>
                                                        <td> <?php echo $scanRequest->doc_com  ?></td>
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
                                                        <th>Investigations</th>
                                                        <td> <?php $decode = json_decode($bill->revenues);
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
                                                    <th>Clinic </th>
                                                    <td> <?php echo $clinic->name . " - " . $sub_clinic->name  ?> </td>
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
                                    <button type="submit" name="save_only" class="btn btn-lg btn-primary">Save Only</button> &nbsp;&nbsp;
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
