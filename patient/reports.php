<?php
require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}


require('../layout/header.php');
?>


    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                                        class="fa fa-arrow-left"></i></a> All Reports</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="home.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Reports</li>
                            <!--  <li class="breadcrumb-item active">Widgets Statistics</li>-->
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


            <a href="home.php" style="font-size: large">&laquo; Back</a>
            <div class="row clearfix">


                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card">
                        <a href="">
                            <div class="body">
                                <div class="row">
                                    <div class="col-7">
                                        <h5 class="m-t-0">Server</h5>
                                        <small class="text-small">6% higher than last month</small>
                                    </div>
                                    <div class="col-5 text-right">
                                        <h2 class="m-b-0">62%</h2>
                                        <small class="info">of 1Tb</small>
                                    </div>
                                    <div class="col-12">
                                        <div class="progress m-t-20">
                                            <div class="progress-bar progress-bar-danger" role="progressbar"
                                                 aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"
                                                 style="width: 62%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card">
                        <a href="">
                            <div class="body">
                                <div class="row">
                                    <div class="col-7">
                                        <h5 class="m-t-0">Traffic</h5>
                                        <small class="text-small">4% higher than last month</small>
                                    </div>
                                    <div class="col-5 text-right">
                                        <h2 class="m-b-0">78</h2>
                                        <small class="info">of 1Tb</small>
                                    </div>
                                    <div class="col-12">
                                        <div class="progress m-t-20">
                                            <div class="progress-bar progress-bar-success" role="progressbar"
                                                 aria-valuenow="78" aria-valuemin="0" aria-valuemax="100"
                                                 style="width: 78%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card">
                        <a href="">
                            <div class="body">
                                <div class="row">
                                    <div class="col-7">
                                        <h5 class="m-t-0">Email</h5>
                                        <small class="text-small">Total Registered email</small>
                                    </div>
                                    <div class="col-5 text-right">
                                        <h2 class="m-b-0">31</h2>
                                        <small class="info">of 100</small>
                                    </div>
                                    <div class="col-12">
                                        <div class="progress m-t-20">
                                            <div class="progress-bar progress-bar-warning" role="progressbar"
                                                 aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"
                                                 style="width: 31%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card">
                        <a href="">
                            <div class="body">
                                <div class="row">
                                    <div class="col-7">
                                        <h5 class="m-t-0">Domians</h5>
                                        <small class="text-small">Total registered Domain</small>
                                    </div>
                                    <div class="col-5 text-right">
                                        <h2 class="m-b-0">2</h2>
                                        <small class="info">of 10</small>
                                    </div>
                                    <div class="col-12">
                                        <div class="progress m-t-20">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="20"
                                                 aria-valuemin="0" aria-valuemax="100" style="width: 20%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>

                    </div>
                </div>
            </div>


        </div>
    </div>


<?php

require('../layout/footer.php');