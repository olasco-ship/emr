<?php
require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$user = User::find_by_id($session->user_id);

if (($user->role != 'Super Admin') AND ($user->department != 'Pharmacy')){
    redirect_to(emr_lucid );
}

$department = "Pharmacy";

$dept = 'drug';

$count_prescribed = Encounter::count_prescribed();

$count = Product::count_all();

$count_billed = Bill::count_billed($dept);

$count_paid = Bill::count_all_by_dept_and_paid($dept);

$count_assigned = Dispensed::count_all();

$count_users = User::count_by_department($department);

//$count_dispensed = Bill::count_dispensed_drugs($dept);

require('../layout/header.php');
?>




    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Pharmacy</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dispensary.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active">Dispensary</li>
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
                                    <a href="<?php echo emr_lucid ?>/pham/cost.php">
                                        <div class="body bg-warning text-light">
                                            <h4><i class="icon-wallet"></i>
                                                <?php
                                                $count_drug_requests = DrugRequest::count_awaiting_costing();
                                                echo $count_drug_requests ?>
                                            </h4>
                                            <span> (1) Cost & Confirmation </span>
                                        </div>
                                    </a>

                                </div>
                                <div class="col-md-3">
                                    <a href="billed.php">
                                        <div class="body bg-info text-light">
                                            <h4><i class="icon-wallet"></i>
                                                <?php $c_billed = DrugServices::count_billed(); echo $c_billed  ?>
                                            </h4>
                                            <span> (2) Unpaid Prescriptions</span>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-md-3">
                                    <a href="<?php echo emr_lucid ?>/pham/dispense_service.php">
                                        <div class="body bg-dark text-light">
                                            <h4><i class="icon-wallet"></i> <?php $c_cleared = DrugServices::count_cleared(); echo $c_cleared ?></h4>
                                            <span> (3) Yet To Dispense </span>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-md-3">
                                    <a href="<?php echo emr_lucid ?>/pham/dispensed.php">
                                        <div class="body bg-success text-light">
                                            <h4><i class="icon-wallet"></i> <?php $c_dispensed = DrugServices::count_dispensed(); echo $c_dispensed ?> </h4>
                                            <span> (4) Dispensed Drug </span>
                                        </div>
                                    </a>
                                </div>


                            </div>


                        </div>


                        <div class="body">
                            <div class="row clearfix">

                                <div class="col-md-3">
                                    <a href="<?php echo emr_lucid ?>/pham/index_dis.php">
                                        <div class="body bg-info text-light">
                                            <h4><i class="icon-wallet"></i> <?php // echo $count
                                                ?> </h4>
                                            <span>Main Store</span>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-md-3">
                                    <a href="<?php echo emr_lucid ?>/pham/dispensary_drugs.php">
                                        <div class="body bg-success text-light">
                                            <h4><i class="icon-wallet"></i> <?php // echo $count ?> </h4>
                                            <span>Drugs In Dispensary</span>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-md-3">
                                    <a href="<?php echo emr_lucid ?>/pham/ret.php">
                                        <div class="body bg-danger text-light">
                                            <h4><i class="icon-wallet"></i> <?php // echo $count ?> </h4>
                                            <span>Returned Drugs</span>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-md-3">
                                    <a href="<?php echo emr_lucid ?>/pham/user.php">
                                        <div class="body bg-secondary text-light">
                                            <h4><i class="icon-wallet"></i> <?php /*echo $count_users */?> </h4>
                                            <span> All Pharmacists  </span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="body">
                            <div class="row clearfix">

                                <div class="col-md-3">
                                    <a href="../pharm_reports/act_rep.php">
                                        <div class="body bg-dark text-light">
                                            <h4><i class="icon-wallet"></i> </h4>
                                            <span> Activity Reports </span>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-md-3">
                                    <a href="../pharm_reports/act_rep_pharm.php">
                                        <div class="body bg-success text-light">
                                            <h4><i class="icon-wallet"></i> </h4>
                                            <span> Activity Reports By Pharm. </span>
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

