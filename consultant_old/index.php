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
                                        <div class="row clearfix">

                                            <div class="col-md-3">
                                                <a href="clinics.php">
                                                    <div class="body bg-danger text-light">
                                                        <h4><i class="icon-wallet"></i> </h4>
                                                        <span> All Clinics</span>
                                                    </div>
                                                </a>
                                            </div>

                                            <div class="col-md-3">
                                                <a href="../consult/m_clinics.php">
                                                    <div class="body bg-primary text-light">
                                                        <h4><i class="icon-wallet"></i></h4>
                                                        <span> My Clinics </span>
                                                    </div>
                                                </a>
                                            </div>

<!--                                            <div class="col-md-3">-->
<!--                                                <a href="../consult/visit.php">-->
<!--                                                    <div class="body bg-dark text-light">-->
<!--                                                        <h4><i class="icon-wallet"></i></h4>-->
<!--                                                        <span> Today's Visit </span>-->
<!--                                                    </div>-->
<!--                                                </a>-->
<!--                                            </div>-->

                                            <div class="col-md-3">
                                                <a href="officers.php">
                                                    <div class="body bg-warning text-light">
                                                        <h4><i class="icon-wallet"></i>
                                                            <!--25,965$-->
                                                        </h4>
                                                        <span> Consultants </span>
                                                    </div>
                                                </a>
                                            </div>

                                            <div class="col-md-3">
                                                <a href="ipd_dash.php">
                                                    <div class="body bg-info text-light">
                                                        <h4><i class="icon-wallet"></i>
                                                            <!--25,965$-->
                                                        </h4>
                                                        <span> IPD Dashboard </span>
                                                    </div>
                                                </a>
                                            </div>

                                        </div>

                                        <div class="row clearfix mt-4">

                                            <div class="col-md-3">
                                                <a href="emergency.php">
                                                    <div class="body bg-danger text-light">
                                                        <h4><i class="icon-wallet"></i> </h4>
                                                        <span> Emergency </span>
                                                    </div>
                                                </a>
                                            </div>

                                            <div class="col-md-3">
                                                <a href="ret_presc.php">
                                                    <div class="body bg-success text-light">
                                                        <h4><i class="icon-wallet"></i> </h4>
                                                        <span> Returned Prescription </span>
                                                    </div>
                                                </a>
                                            </div>

                                            <div class="col-md-3">
                                                <a href="ret_test.php">
                                                    <div class="body bg-secondary text-light">
                                                        <h4><i class="icon-wallet"></i> </h4>
                                                        <span> Returned Lab Investigations </span>
                                                    </div>
                                                </a>
                                            </div>

                                            <div class="col-md-3">
                                                <a href="ret_scan.php">
                                                    <div class="body bg-success text-light">
                                                        <h4><i class="icon-wallet"></i> </h4>
                                                        <span> Returned Scan/Ultrasound </span>
                                                    </div>
                                                </a>
                                            </div>

                                        </div>



                                        <div class="row clearfix mt-4">



                                            <div class="col-md-3">
                                                <a href="complain.php">
                                                    <div class="body bg-primary text-light">
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

                                            <div class="col-md-3">
                                                <a href="../consult/index.php">
                                                    <div class="body bg-secondary text-light">
                                                        <h4><i class="icon-wallet"></i> </h4>
                                                        <span> Reports </span>
                                                    </div>
                                                </a>
                                            </div>

                                        </div>

                                        <div class="row clearfix mt-4">




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
