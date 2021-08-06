<?php
require_once("../includes/initialize.php");


$user = User::find_by_id($session->user_id);

if (($user->role != 'Super Admin') and ($user->department != 'Pharmacy')) {
    redirect_to(emr_lucid);
}


$count_prescribed = Encounter::count_prescribed();

$count = Product::count_all();






require('../layout/header.php');
?>



<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Pharmacy</h2>
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
                                <a href="<?php echo emr_lucid ?>/pharm/stocking.php">
                                    <div class="body bg-primary text-light">
                                        <h4><i class="icon-wallet"></i> <?php // echo $count 
                                                                        ?> </h4>
                                        <span>Add Existing Stock</span>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="<?php echo emr_lucid ?>/pharm/create.php">
                                    <div class="body bg-dark text-light">
                                        <h4><i class="icon-wallet"></i>
                                        </h4>
                                        <span> Add New Stock </span>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="<?php echo emr_lucid ?>/pharm/stock_history.php">
                                    <div class="body bg-success text-light">
                                        <h4><i class="icon-wallet"></i>
                                        </h4>
                                        <span> Stock History </span>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-3">
                                <a href="<?php echo emr_lucid ?>/type/index.php">
                                    <div class="body bg-danger text-light">
                                        <h4><i class="icon-wallet"></i>
                                        </h4>
                                        <span> Donated Drugs </span>
                                    </div>
                                </a>
                            </div>

                        </div>


                    </div>


                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-md-3">
                                <a href="<?php echo emr_lucid ?>/pharm/index.php">
                                    <div class="body bg-success text-light">
                                        <h4><i class="icon-wallet"></i> <?php // echo $count 
                                                                        ?> </h4>
                                        <span>Main Store</span>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="<?php echo emr_lucid ?>/pharm/create.php">
                                    <div class="body bg-danger text-light">
                                        <h4><i class="icon-wallet"></i>
                                            <!--25,965$-->
                                        </h4>
                                        <span> Add Drugs </span>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="<?php echo emr_lucid ?>/brand/index.php">
                                    <div class="body bg-primary text-light">
                                        <h4><i class="icon-wallet"></i><!-- 14,965$-->
                                        </h4>
                                        <span> Brand Of Drug </span>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-3">
                                <a href="<?php echo emr_lucid ?>/type/index.php">
                                    <div class="body bg-dark text-light">
                                        <h4><i class="icon-wallet"></i>
                                            <!--7,12,326$-->
                                        </h4>
                                        <span>Type Of Drug </span>
                                    </div>
                                </a>
                            </div>

                        </div>


                    </div>

                    <div class="body">
                        <div class="row clearfix">

                            <div class="col-md-3">
                                <a href="<?php echo emr_lucid ?>/pharm/station.php">
                                    <div class="body bg-secondary text-light">
                                        <h4><i class="icon-wallet"></i> <?php /*echo $count_users */ ?> </h4>
                                        <span> Dispensaries </span>
                                    </div>
                                </a>
                            </div>


                            <div class="col-md-3">
                                <a href="<?php echo emr_lucid ?>/pharm/flow_one.php">
                                    <div class="body bg-info text-light">
                                        <h4><i class="icon-wallet"></i>
                                            <!--14,965$-->
                                        </h4>
                                        <span> Assign Drugs </span>
                                    </div>
                                </a>

                            </div>


                            <div class="col-md-3">
                                <a href="<?php echo emr_lucid ?>/pharm/history.php">
                                    <div class="body bg-warning text-light">
                                        <h4><i class="icon-wallet"></i><!-- 25,965$-->
                                        </h4>
                                        <span> Dispensory History </span>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-3">
                                <a href="settings.php">
                                    <div class="body bg-danger text-light">
                                        <h4><i class="icon-settings"></i>
                                            <!--7,12,326$-->
                                        </h4>
                                        <span> Settings </span>
                                    </div>
                                </a>
                            </div>




                        </div>
                    </div>

                    <div class="body">
                        <div class="row clearfix">


                            <div class="col-md-3">
                                <a href="<?php echo emr_lucid ?>/pharm/user.php">
                                    <div class="body bg-warning text-light">
                                        <h4><i class="icon-wallet"></i><!-- 25,965$-->
                                        </h4>
                                        <span> All Pharmacist </span>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-3">
                                <a href="<?php echo emr_lucid ?>/pharm/stocking.php">
                                    <div class="body bg-primary text-light">
                                        <h4><i class="icon-wallet"></i> <?php // echo $count
                                            ?> </h4>
                                        <span>Add Stock</span>
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
