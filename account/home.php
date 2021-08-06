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
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Account Department</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Account</li>
                        <!--<li class="breadcrumb-item active">All Patient</li>-->
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
                        <div class="row clearfix">
                            <div class="col-md-3">
                                <a href="<?php echo emr_lucid ?>/account/index.php">
                                    <div class="body bg-success text-light">
                                        <h4><i class="icon-wallet"></i>
                                        </h4>
                                        <span> Admission </span>
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
                                <a href="#">
                                    <div class="body bg-dark text-light">
                                        <h4><i class="icon-wallet"></i>
                                            <!--7,12,326$-->
                                        </h4>
                                        <span>Unavailable Tests</span>
                                    </div>
                                </a>
                            </div>

                        </div>
                    </div>


                    <div class="body">
                        <div class="row clearfix">

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









                </div>
            </div>
        </div>



    </div>
</div>

























<?php

require('../layout/footer.php');
