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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Storage </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="home.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active"> Add Stock</li>
                        </ul>
                    </div>

                </div>
            </div>

            <a href="../store/storage.php" style="font-size: large">&laquo; Back</a>

            <div class="row clearfix">
                <div class="col-lg-6 col-md-6 col-sm-6 ">
                    <div class="card">

                        <div class="body">

                            <div class="col-md-6">
                                <a href="<?php echo emr_lucid ?>/store/stocking.php">
                                    <div class="body bg-primary text-light">
                                        <h4><i class="icon-wallet"></i> </h4>
                                        <span>Add Existing Stock</span>
                                    </div>
                                </a>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 ">
                    <div class="card">

                        <div class="body">

                            <div class="col-md-6">
                                <a href="<?php echo emr_lucid ?>/store/create.php">
                                    <div class="body bg-dark text-light">
                                        <h4><i class="icon-wallet"></i>
                                        </h4>
                                        <span> Add New Stock </span>
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
