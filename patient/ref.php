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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Medical Records</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active">Records</li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="row clearfix">
  
                <div class="col-lg-12 col-md-12">
                    <div class="card">

                        <div class="body">
                            <a href="home.php" style="font-size: large">&laquo; Back</a>
                            <div class="row clearfix">

                                <div class="col-md-3">
                                    <a href="referrals.php">
                                        <div class="body bg-info text-light">
                                            <h4><i class="icon-wallet"></i> </h4>
                                            <span> Referrals </span>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-md-3">
                                    <a href="cleared_referrals.php">
                                        <div class="body bg-success text-light">
                                            <h4><i class="icon-wallet"></i> </h4>
                                            <span> Cleared Referrals </span>
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