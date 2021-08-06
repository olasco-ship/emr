<?php
require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$user = User::find_by_id($session->user_id);


$count_prescribed = Encounter::count_prescribed();

$count = Product::count_all();






require('../layout/header.php');
?>




<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Payment Confirmation </h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active"> Payment Details </li>
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
                                        </h4>
                                        <span>Confirm Bill Payment</span>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="confirm_deposit.php">
                                    <div class="body bg-warning text-light">
                                        <h4><i class="icon-wallet"></i>
                                        </h4>
                                        <span> Confirm Admission Deposit </span>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-3">
                                <a href="users.php">
                                    <div class="body bg-dark text-light">
                                        <h4><i class="icon-wallet"></i>
                                        </h4>
                                        <span>User Management </span>
                                    </div>
                                </a>
                            </div>
                            
                            <!--
                            <div class="col-md-3">
                                <a href="patients.php">
                                    <div class="body bg-primary text-light">
                                        <h4><i class="icon-wallet"></i>
                                        </h4>
                                        <span>NHIS Patients</span>
                                    </div>
                                </a>
                            </div>
                            -->

                        </div>

                    </div>

                    <div class="body">
                        <div class="row clearfix">

                            <!--
                            <div class="col-md-3">
                                <a href="existing.php">
                                    <div class="body bg-danger text-light">
                                        <h4><i class="icon-wallet"></i>
                                        </h4>
                                        <span> Extend Subscription </span>
                                    </div>
                                </a>
                            </div>
                            -->



                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>










<?php

require('../layout/footer.php');
