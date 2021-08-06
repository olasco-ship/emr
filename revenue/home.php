<?php



require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}


$user = User::find_by_id($session->user_id);


require('../layout/header.php');
?>





<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Account & Revenue </h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Account</li>
                    </ul>
                </div>

            </div>
        </div>



        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card patients-list">

                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-md-3">
                                <a href="<?php echo emr_lucid ?>/revenueHead/index.php">
                                    <div class="body bg-success text-light">
                                        <h4><i class="icon-wallet"></i>
                                        </h4>
                                        <span>Revenue Head</span>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="<?php echo emr_lucid ?>/revenueHead/depts.php">
                                    <div class="body bg-warning text-light">
                                        <h4><i class="icon-wallet"></i>
                                            <!--25,965$-->
                                        </h4>
                                        <span> Revenue </span>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="<?php echo emr_lucid ?>/unit/index.php">
                                    <div class="body bg-primary text-light">
                                        <h4><i class="icon-wallet"></i><!-- 14,965$-->
                                        </h4>
                                        <span> Unit </span>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-3">
                                <a href="users.php">
                                    <div class="body bg-dark text-light">
                                        <h4><i class="icon-wallet"></i>
                                            <!--7,12,326$-->
                                        </h4>
                                        <span>User Management </span>
                                    </div>
                                </a>
                            </div>

                        </div>
                    </div>

                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-md-3">
                                <a href="<?php echo emr_lucid ?>/account/index.php">
                                    <div class="body bg-danger text-light">
                                        <h4><i class="icon-wallet"></i>
                                        </h4>
                                        <span> Admission </span>
                                    </div>
                                </a>
                            </div>


                            <div class="col-md-3">
                                <a href="#">
                                    <div class="body bg-dark text-light">
                                        <h4><i class="icon-wallet"></i>
                                            <!--7,12,326$-->
                                        </h4>
                                        <span>Unavailable Tests</span>
                                    </div>
                                </a>
                            </div>


                            <div class="col-md-3">
                                <a href="<?php echo emr_lucid ?>/account/reports.php">
                                    <div class="body bg-secondary text-light">
                                        <h4><i class="icon-wallet"></i>
                                        </h4>
                                        <span> All Reports </span>
                                    </div>
                                </a>
                            </div>


                        </div>
                    </div>


                    <!--
                        IPD & Clinic Administration Found Here
                        Also in Nursing Department
                    <div class="body">
                        <div class="row clearfix">

                            <div class="col-md-3">
                                <a href="<?php echo emr_lucid ?>/clinic/index.php">
                                    <div class="body bg-dark text-light">
                                        <h4><i class="icon-wallet"></i>
                                        </h4>
                                        <span> Clinics </span>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="<?php echo emr_lucid ?>/clinic/sub.php">
                                    <div class="body bg-success text-light">
                                        <h4><i class="icon-wallet"></i> </h4>
                                        <span> Sub-clinics </span>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-3">
                                <a href="<?php echo emr_lucid ?>/rooms/index.php">
                                    <div class="body bg-danger text-light">
                                        <h4><i class="icon-wallet"></i> </h4>
                                        <span> Consulting Rooms </span>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-3">
                                <a href="ipd-admin.php">
                                    <div class="body bg-primary text-light">
                                        <h4><i class="icon-wallet"></i> </h4>
                                        <span> IPD Admin </span>
                                    </div>
                                </a>
                            </div>


                        </div>
                    </div>

                    <div class="body">
                        <div class="row clearfix">

                            <div class="col-md-3">
                                <a href="ipd_discount.php">
                                    <div class="body bg-danger text-light">
                                        <h4><i class="icon-wallet"></i> </h4>
                                        <span> IPD Discount </span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                     -->



                </div>



            </div>
        </div>



    </div>



</div>
</div>

























<?php

require('../layout/footer.php');
