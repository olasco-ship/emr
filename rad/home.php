<?php

require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$dept = 'scan';

$count_paid = Bill::count_paid($dept);

$count_billed = Bill::count_billed($dept);

$count_request = Encounter::count_lab_request();

$count_result = ScanResult::count_result();

//$count_results = Result::count_all_done();


require('../layout/header.php');
?>



<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>
                        Radiology/Ultrasound Scan </h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="home.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active"> Activities</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <div class="card">

                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-md-3">
                                <a href="<?php echo emr_lucid ?>/rad/cost.php">
                                    <div class="body bg-success text-light">
                                        <h4><i class="icon-wallet"></i>
                                            <?php
                                            $count_scan_requests = ScanRequest::count_awaiting_costing();
                                            echo $count_scan_requests ?>
                                        </h4>
                                        <span> (1) Cost & Confirmation </span>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="<?php echo emr_lucid ?>/rad/billed_service.php">
                                    <div class="body bg-warning text-light">
                                        <h4><i class="icon-wallet"> </i><?php $c_billed = RadioServices::count_billed();
                                                                        echo $c_billed ?> </h4>
                                        <span> (2) Unpaid Investigations
                                            <!-- Billed Investigation --> </span>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="../rad/investigations_service.php">
                                    <div class="body bg-primary text-light">
                                        <h4><i class="icon-wallet"> </i> <?php $c_cleared = RadioServices::count_cleared();
                                                                            echo $c_cleared ?></h4>
                                        <span> (3) Pending Investigations </span>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-3">
                                <a href="../rad/results.php">
                                    <div class="body bg-dark text-light">
                                        <h4><i class="icon-wallet"></i> <?php echo $count_result ?></h4>
                                        <span> (4) Radiology Results </span>
                                    </div>
                                </a>

                            </div>

                        </div>

                        <!--<div id="total_revenue" class="ct-chart m-t-20"></div>-->

                    </div>

                    <div class="body">
                        <div class="row clearfix">

                            <div class="col-md-3">
                                <a href="bookings.php">
                                    <div class="body bg-secondary text-light">
                                        <h4><i class="icon-wallet"></i>
                                        </h4>
                                        <span> Booked Investigations </span>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-3">
                                <a href="../rad/users.php">
                                    <div class="body bg-danger text-light">
                                        <h4><i class="icon-wallet"></i><!-- 25,965$-->
                                        </h4>
                                        <span> Radiologist/Sonologist </span>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-3">
                                <a href="<?php echo emr_lucid ?>/rad/walk_in.php">
                                    <div class="body bg-warning text-light">
                                        <h4><i class="icon-wallet">
                                         </i> </h4>                                 
                                        <span> Other Hospitals <!--Walk-In Patient/Client --> </span>
                                           
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-3">
                                <a href="revenues.php">
                                    <div class="body bg-info text-light">
                                        <h4><i class="icon-wallet"></i>
                                        </h4>
                                        <span> Investigations </span>
                                    </div>
                                </a>
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
