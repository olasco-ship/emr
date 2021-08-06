<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/18/2019
 * Time: 11:52 AM
 */


require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}



$lab = 'lab';

$count = Bill::count_paid($lab);







if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $query = trim($_POST['search']);
    $min_length = 3;
}


require('../layout/header.php');
?>








    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>
                            Pending Lab Request </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Laboratory</li>
                            <li class="breadcrumb-item active">Requests</li>
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

                            <?php echo output_message($message); ?>

                            <a style="font-size: larger" href="../lab/home.php">&laquo;Back</a>
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs-new2">
                                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#All">Pending Requests</a></li>
                                <!--                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#USA">USA</a></li>
                                                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#India">India</a></li>-->
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content m-t-10 padding-0">
                                <div class="tab-pane table-responsive active show" id="All">
                                    <table class="table m-b-0 table-hover">
                                        <thead class="thead-primary">

                                        <tr>

                                            <th>Folder No.</th>
                                            <th>Patient Name</th>
                                            <th>Clinic</th>
                                            <th>Consultant</th>
                                           <!-- <th>Gender</th>-->
                                            <th>Investigation(s) No. </th>
                                            <th>Status</th>

                                        </tr>

                                        </thead>
                                        <tbody>

                                        <?php
                                        if (is_post()) {
                                            $query = trim($_POST['search']);
                                            $patients = Patient::find_patient_by_num_or_name($query);
                                            foreach($patients as $patient) {   ?>
                                                <tr>
                                                    <td><a href='index.php?id=<?php echo $bill->id ?>'><?php echo $patient->folder_number ?></a></td>
                                                    <td><?php echo $patient->first_name ?></td>
                                                    <td><?php  ?></td>
                                                    <td><?php echo $patient->gender ?></td>
                                                    <td><?php $d_date = date('d/m/Y h:i a', strtotime($patient->date_registered)); echo $d_date ?></td>
                                                    <td><span class="badge badge-warning">COMPLETED</span></td>
                                                    <!--        <td><a href='history.php?id=<?php echo $patient->id ?>' History</a></td>
                                            <td><a href='vitals.php?id=<?php echo $patient->id ?>'> Vitals</a></td>   -->
                                                </tr>
                                            <?php } } else {
                                            //  $paid  = Bill::find_all_by_dept_and_paid($lab);
                                            $bills = Bill::find_all_by_dept_and_paid($lab);
                                            foreach($bills as $bill) {
                                                $patient     = Patient::find_by_id($bill->patient_id);
                                                $testRequest = TestRequest::find_by_bill_id($bill->id);
                                                $waiting     = WaitingList::find_by_id($testRequest->waiting_list_id);
                                                ?>
                                                <tr>
                                                    <td><a href='collect.php?id=<?php echo $bill->id ?>'><?php echo $patient->folder_number ?></a></td>
                                                    <td><?php echo $patient->full_name()  ?></td>
                                                    <td><?php $clinic = Clinic::find_by_id($waiting->clinic_id);
                                                              $sub_clinic = SubClinic::find_by_id($waiting->sub_clinic_id);
                                                              echo $clinic->name ."-". $sub_clinic->name;
                                                        ?>
                                                    </td>
                                                    <td><?php echo $testRequest->consultant ?></td>
                                                    <td><?php echo $bill->quantity ?></td>
                                                    <td><span class="badge badge-warning">PENDING RESULT</span></td>
                                                    <!--          <td><a href='history.php?id=<?php echo $bill->id ?>'> History</a></td>
                                                <td><a href='vitals.php?id=<?php echo $bill->id ?>'> Vitals</a></td>   -->
                                                </tr>

                                            <?php }  }
                                        ?>

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












<?php

require('../layout/footer.php');