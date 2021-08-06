<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/30/2019
 * Time: 11:28 AM
 */


require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}





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
                             Radiology Request </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Radiology/Ultrasound</li>
                            <li class="breadcrumb-item active">Booked Investigations</li>
                        </ul>
                    </div>

                </div>
            </div>



            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card patients-list">

                        <div class="body">
                            <a style="font-size: larger" href="../rad/home.php">&laquo;Back</a>
                            <div href="#" class="right">
                                <form class="form-inline" id="basic-form" action="" method="post">
                                    <div class="form-group">
                                        <input type="text"  class="form-control" placeholder="Folder Number"
                                               name="search" required>
                                        <button type="submit" class="btn btn-outline-primary">Search</button>
                                        <button type="button" name="search" onClick="location.href=location.href"  class="btn btn-outline-warning">Refresh</button>
                                    </div>
                                </form>

                                <br/>

                                <?php if (is_post()){  ?>
                                    <div id="success" class="alert alert-success alert-dismissible" role="alert" style="width: 500px">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                    aria-hidden="true">&times;</span></button>
                                        All records for <?php echo $query ?>
                                    </div>
                                <?php } ?>
                            </div>

                            <ul class="nav nav-tabs-new2">
                                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#All"> Booked Investigations </a></li>

                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content m-t-10 padding-0">
                                <div class="tab-pane table-responsive active show" id="All">
                                    <table class="table m-b-0 table-hover">
                                        <thead class="thead-purple">

                                        <tr>
                                            <th>Folder No.</th>
                                            <th>Patient Name</th>                                 
                                            <th>Ward/Clinic</th>
                                         <!--   <th>Investigation No.</th>
                                            <th>Investigation left</th>  -->                                     
                                            <th>Request Date</th>   
                                            <th>Booked Date</th>                          
                                            <th></th>
                                            <th></th>
                                        </tr>

                                        </thead>
                                        <tbody>

                                        <?php
                                        if (is_post()) {
                                            $query = trim($_POST['search']);
                                            $patients = Patient::find_patient_by_num_or_name($query);
                                            foreach($patients as $patient) {   ?>
                                                <tr>
                                                    <td><?php echo $patient->folder_number ?></td>
                                                    <td><?php echo $patient->full_name() ?></td>
                                                    <td><?php echo $bill->consultant ?></td>
                                                    <td><?php echo $patient->gender ?></td>
                                                    <td><?php $d_date = date('d/m/Y h:i:a', strtotime($bill->date)); echo $d_date ?></td>
                                                    <td><a href='index.php?id=<?php echo $bill->id ?>'>Cost</a></td>
                                                </tr>
                                            <?php } } else {
                                                $testRequests = ScanRequest::find_booked();
                                            foreach($testRequests as $request) {                             
                                                $patient = Patient::find_by_id($request->patient_id);
                                                $booking = ServiceBooking::find_by_scanRequest_id($request->id);
                                                ?>
                                                <tr>
                                                    <td><?php echo $patient->folder_number ?></td>
                                                    <td><?php echo $patient->full_name()  ?></td>
                                                    <td><?php if ($request->ward_id == 0) {
                                                            $waiting = WaitingList::find_by_id($request->waiting_list_id);
                                                            $subClinic = SubClinic::find_by_id($waiting->sub_clinic_id);
                                                            echo $subClinic->name;
                                                        } else {
                                                            $ward = Wards::find_by_id($request->ward_id);
                                                            echo $ward->ward_number;
                                                        }

                                                        ?></td>
                                                <!--    <td><?php echo $request->scan_no ?></td>
                                                    <td><?php echo $request->not_done ?></td>  -->
                                                    <td><?php $d_date = date('d/m/Y h:i:a', strtotime($request->date)); echo $d_date ?></td>
                                                    <td><?php $d_date = date('d/m/Y', strtotime($booking->booked_date)); echo $d_date ?></td>
                                                    <td><?php if ($request->ward_id == 0) {  ?>

                                                            <a href='cost_scan.php?id=<?php echo $request->id ?>'>Cost</a>
                                                        <?php   } else {  ?>
                                                            <div class="btn-group" role="group">
                                                                <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    Action
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                                    <a class="dropdown-item" href='cost_scan.php?id=<?php echo $request->id ?>'>Cash</a>
                                                                    <a class="dropdown-item" href='cost_ward_scan.php?id=<?php echo $request->id ?>'>Pay From Wallet</a>
                                                                </div>
                                                            </div>

                                                        <?php   } ?>
                                                    </td>
                                                    <td> <a href='re_schedule.php?id=<?php echo $request->id ?>'>Re-schedule</a> </td>

                                                </tr>

                                            <?php }
                                        }
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