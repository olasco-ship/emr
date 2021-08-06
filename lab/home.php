<?php

require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$dept = 'lab';

$count_paid = Bill::count_paid($dept);

$count_billed = Bill::count_billed($dept);

$count_request = Encounter::count_lab_request();

$count_pending = Result::count_pending();

$count_results = Result::count_all_checked();

$count_pending_qc = Result::count_all_pending_qc();

$count_prelim_checked = Result::count_all_prelim_checked();

$count_final_checked = Result::count_all_final_checked();


require('../layout/header.php');
?>



<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>
                        Laboratory Department </h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="home.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active">Lab Activities</li>
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
                                <a href="<?php echo emr_lucid ?>/lab/cost.php">
                                    <div class="body bg-success text-light">
                                        <h4><i class="icon-wallet"></i>
                                            <?php
                                            $count_test_requests = TestRequest::count_awaiting_costing();
                                            echo $count_test_requests ?>
                                        </h4>
                                        <span> (1) Cost & Confirmation </span>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="<?php echo emr_lucid ?>/lab/billed_service.php">
                                    <div class="body bg-warning text-light">
                                        <h4><i class="icon-wallet"></i> <?php $c_billed = LabServices::count_billed();
                                                                        echo $c_billed ?> </h4>
                                        <span> (2) Unpaid Investigations </span>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="../lab/sample_col_service.php">
                                    <div class="body bg-primary text-light">
                                        <h4><i class="icon-wallet"></i> <?php $c_cleared = LabServices::count_cleared();
                                                                        echo $c_cleared ?> </h4>
                                        <span> (3) Sample Collection </span>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-3">
                                <a href="../lab/sample_analysis.php">
                                    <div class="body bg-dark text-light">
                                        <h4><i class="icon-wallet"></i> <?php echo $count_pending ?></h4>
                                        <span> (4) Pending Requests </span>
                                    </div>
                                </a>

                            </div>

                        </div>



                    </div>

                    <div class="body">
                        <div class="row clearfix">

                          <div class="col-md-3">
                                <a href="../lab/qc_check.php">
                                    <div class="body bg-primary text-light">
                                        <h4><i class="icon-wallet"></i> <?php echo $count_pending_qc ?> </h4>
                                        <span> (5) Quality Control Check </span>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-3">
                                <a href="prelim_results.php">
                                    <div class="body bg-success text-light">
                                        <h4><i class="icon-wallet"></i> <?php echo $count_prelim_checked ?>
                                        </h4>
                                        <span> Preliminary Results </span>
                                    </div>
                                </a>
                            </div>


                            <div class="col-md-3">
                                <a href="final_results.php">
                                    <div class="body bg-secondary text-light">
                                        <!-- <div class="body bg-danger text-light"> -->
                                        <h4><i class="icon-wallet"></i> <?php echo $count_final_checked ?>
                                        </h4>
                                        <span> Final Results </span>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-3">
                                <a href="<?php echo emr_lucid ?>/lab/results.php">
                                    <div class="body bg-dark text-light">
                                        <h4><i class="icon-wallet"></i> <?php echo $count_results ?></h4>
                                        <span> (6) All Lab Results </span>
                                    </div>
                                </a>
                            </div>



                        </div>

                    </div>


                    <div class="body">
                        <div class="row clearfix">

                        <div class="col-md-3">
                                <a href="scientists.php">
                                    <div class="body bg-success text-light">
                                        <h4><i class="icon-wallet"></i>
                                        </h4>
                                        <span> Pathologist Review </span>
                                    </div>
                                </a>
                            </div>





                        <div class="col-md-3">
                                <a href="walk_in.php">
                                    <div class="body bg-warning text-light">
                                        <h4><i class="icon-wallet"></i><!-- 25,965$-->
                                        </h4>
                                        <span> Walk-In Patient/Client </span>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-3">
                                <a href="emergency.php">
                                    <div class="body bg-danger text-light">
                                        <h4><i class="icon-wallet"></i><!-- 25,965$-->
                                        </h4>
                                        <span> Emergency </span>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-3">
                                <a href="../labforms/index.php">
                                    <div class="body bg-danger text-light">
                                        <h4><i class="icon-wallet"></i><!-- 25,965$-->
                                        </h4>
                                        <span> Forms </span>
                                    </div>
                                </a>
                            </div>



                            <!--
                            <div class="col-md-3">
                                <a href="../lab/client_bills.php">
                                    <div class="body bg-primary text-light">
                                        <h4><i class="icon-wallet"></i> </h4>
                                        <span> Walk In Bills </span>
                                    </div>
                                </a>
                            </div>

                            -->

     



                        </div>

                    </div>


                    <div class="body">
                        <div class="row clearfix">

                            <div class="col-md-3">
                                <a href="scientists.php">
                                    <div class="body bg-secondary text-light">
                                        <h4><i class="icon-wallet"></i>
                                        </h4>
                                        <span>  Scientists </span>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-3">
                                <a href="scientists_unit.php">
                                    <div class="body bg-secondary text-light">
                                        <h4><i class="icon-wallet"></i>
                                        </h4>
                                        <span>  Scientists/Unit </span>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-3">
                                <a href="revenue.php">
                                    <div class="body bg-info text-light">
                                        <h4><i class="icon-wallet"></i>
                                        </h4>
                                        <span>  Investigations </span>
                                    </div>
                                </a>
                            </div>

<!--                            <div class="col-md-3">
                                <a href="revenue_unit.php">
                                    <div class="body bg-info text-light">
                                        <h4><i class="icon-wallet"></i>
                                        </h4>
                                        <span>  Investigations/Unit </span>
                                    </div>
                                </a>
                            </div>-->

                            <div class="col-md-3">
                                <a href="range_unit.php">
                                    <div class="body bg-success text-light">
                                        <h4><i class="icon-wallet"></i>
                                        </h4>
                                        <span>  Reference Range </span>
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
