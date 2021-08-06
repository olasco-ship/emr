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
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Reports </h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active">Main Dashboard</li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="row clearfix">

            <div class="col-lg-12 col-md-12">
                <div class="card">

                    <div class="body">
                        <a style="font-size: large" href="../store/storage.php">&laquo;Back</a>
                        <div class="row clearfix">

                            <div class="col-md-3">
                                <a href="supply_rep.php">
                                    <div class="body bg-dark text-light">
                                        <h4><i class="icon-wallet"></i><!-- 25,965$-->
                                        </h4>
                                        <span> Item Supply Report </span>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-3">
                                <a href="assigned_rep.php">
                                    <div class="body bg-primary text-light">
                                        <h4><i class="icon-wallet"></i><!-- 25,965$-->
                                        </h4>
                                        <span> Items Assigned Report </span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>


                </div>
            </div>




        </div>
    </div>




    <?php
    require('../layout/footer.php');
