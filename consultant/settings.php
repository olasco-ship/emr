<?php

/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/3/2019
 * Time: 3:03 PM
 */


require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}


// Count all for now(Adjust later)

$count     = Patient::count_all();
$count_app = Appointment::count_all();



$waiting_list = Patient::waiting_list();

$count_waiting_list = Patient::count_waiting();




require('../layout/header.php');
?>





    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> GP Consultation </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Consultant</li>
                            <li class="breadcrumb-item active"> Doctor </li>
                        </ul>
                    </div>

                </div>
            </div>
            <?php
            if (!empty($message)) { ?>
                <div id="success" class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo output_message($message); ?>
                </div>
            <?php }
            ?>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12">
                    <div class="card">

                        <div class="body">

                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12">
                                    <div class="card">

                                        <div class="body">
                                            <a style="font-size: larger" href="index.php">&laquo;Back</a>
                                            <div class="row clearfix">

                                                <div class="col-md-3">
                                                    <a href="officers.php">
                                                        <div class="body bg-primary text-light">
                                                            <h4><i class="icon-wallet"></i>
                                                                <!--25,965$-->
                                                            </h4>
                                                            <span> Consultants </span>
                                                        </div>
                                                    </a>
                                                </div>

                                                <div class="col-md-3">
                                                    <a href="complain.php">
                                                        <div class="body bg-danger text-light">
                                                            <h4><i class="icon-wallet"></i> </h4>
                                                            <span> Complain </span>
                                                        </div>
                                                    </a>
                                                </div>

                                                <div class="col-md-3">
                                                    <a href="examination_category.php">
                                                        <div class="body bg-info text-light">
                                                            <h4><i class="icon-wallet"></i> </h4>
                                                            <span> Examination Category </span>
                                                        </div>
                                                    </a>
                                                </div>

                                                <div class="col-md-3">
                                                    <a href="examination.php">
                                                        <div class="body bg-warning text-light">
                                                            <h4><i class="icon-wallet"></i> </h4>
                                                            <span> Examination </span>
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
                </div>
            </div>






        </div>
    </div>






<?php

require('../layout/footer.php');

