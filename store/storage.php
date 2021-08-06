<?php
require_once("../includes/initialize.php");


$user = User::find_by_id($session->user_id);

if (($user->role != 'Super Admin') and ($user->department != 'Store')) {
    redirect_to(emr_lucid);
}


$count_prescribed = Encounter::count_prescribed();

$count = StockItems::count_all();






require('../layout/header.php');
?>



    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Store Department</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="storage.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active">Storage</li>
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
                                    <a href="<?php echo emr_lucid ?>/store/add_stock.php">
                                        <div class="body bg-primary text-light">
                                            <h4><i class="icon-wallet"></i> <?php // echo $count
                                                ?> </h4>
                                            <span>Add Stock</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <a href="<?php echo emr_lucid ?>/store/stock_history.php">
                                        <div class="body bg-success text-light">
                                            <h4><i class="icon-wallet"></i>
                                            </h4>
                                            <span>  Supplies </span>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-md-3">
                                    <a href="#">
                                        <div class="body bg-danger text-light">
                                            <h4><i class="icon-wallet"></i>
                                            </h4>
                                            <span> Donated Items </span>
                                        </div>
                                    </a>
                                </div>


                                <div class="col-md-3">
                                    <a href="<?php echo emr_lucid ?>/store/index.php">
                                        <div class="body bg-success text-light">
                                            <h4><i class="icon-wallet"></i> <?php // echo $count
                                                ?> </h4>
                                            <span>Main Store</span>
                                        </div>
                                    </a>
                                </div>

                            </div>
                        </div>


                        <div class="body">
                            <div class="row clearfix">

                                <div class="col-md-3">
                                    <a href="<?php echo emr_lucid ?>/store/dispense_service.php">
                                        <div class="body bg-secondary text-light">
                                            <h4><i class="icon-wallet"></i> <?php $c_cleared = StockServices::count_cleared(); echo $c_cleared ?> </h4>
                                            <span> Requests </span>
                                        </div>
                                    </a>
                                </div>


                                <div class="col-md-3">
                                    <a href="<?php echo emr_lucid ?>/store/history.php">
                                        <div class="body bg-warning text-light">
                                            <h4><i class="icon-wallet"></i><!-- 25,965$-->
                                            </h4>
                                            <span> Items Assigned History </span>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-md-3">
                                    <a href="<?php echo emr_lucid ?>/store/user.php">
                                        <div class="body bg-secondary text-light">
                                            <h4><i class="icon-wallet"></i>
                                            </h4>
                                            <span> Store Keepers </span>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-md-3">
                                    <a href="../store_reports/index.php">
                                        <div class="body bg-dark text-light">
                                            <h4><i class="icon-wallet"></i>
                                            </h4>
                                            <span>  Reports </span>
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
