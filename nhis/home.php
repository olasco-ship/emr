<?php
require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$dept = "Records";








require('../layout/header.php');
?>




<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> NHIS</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active"> Enrollee Management </li>
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
                                <a href="new.php">
                                    <div class="body bg-success text-light">
                                        <h4><i class="icon-wallet"></i>
                                            <!--7,12,326$-->
                                        </h4>
                                        <span>Register New Enrollee</span>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="patients.php">
                                    <div class="body bg-warning text-light">
                                        <h4><i class="icon-wallet"></i>
                                            <!--25,965$-->
                                        </h4>
                                        <span> View All Enrollees </span>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-3">
                                <a href="existing.php">
                                    <div class="body bg-danger text-light">
                                        <h4><i class="icon-wallet"></i><!-- 14,965$-->
                                        </h4>
                                        <span> Extend Subscription </span>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-3">
                                <a href="patients.php">
                                    <div class="body bg-primary text-light">
                                        <h4><i class="icon-wallet"></i><!-- 14,965$-->
                                        </h4>
                                        <span>NHIS Patients</span>
                                    </div>
                                </a>
                            </div>
                        </div>

                    </div>

                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-md-3">
                                <a href="users.php">
                                    <div class="body bg-dark text-light">
                                        <h4><i class="icon-wallet"></i>
                                        </h4>
                                        <span>User Management </span>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-3">
                                <a href="nhis_plans.php">
                                    <div class="body bg-secondary text-light">
                                        <h4>
                                            <i class="icon-wallet"></i>
                                        </h4>
                                        <span>NHIS Plans</span>
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
