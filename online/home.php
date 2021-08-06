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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Online Report </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href=""><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active">
                            </li>


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
                                    <a href="records.php">
                                        <div class="body bg-danger text-light">
                                            <h4><i class="icon-wallet"></i> </h4>
                                            <span> Medical Records </span>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-md-3">
                                    <a href="nursing.php">
                                        <div class="body bg-info text-light">
                                            <h4><i class="icon-wallet"></i> </h4>
                                            <span> Nursing Department </span>
                                        </div>
                                    </a>
                                </div>


                                <div class="col-md-3">
                                    <a href="lab.php">
                                        <div class="body bg-warning text-light">
                                            <h4><i class="icon-wallet"></i>
                                            </h4>
                                            <span> Laboratory Department </span>
                                        </div>
                                    </a>
                                </div>


                                <div class="col-md-3">
                                    <a href="rad.php">
                                        <div class="body bg-success text-light">
                                            <h4><i class="icon-wallet"></i> </h4>
                                            <span> Radiology/Ultrasound </span>
                                        </div>
                                    </a>
                                </div>







                            </div>


                        </div>


                        <div class="body">
                            <div class="row clearfix">




                                <div class="col-md-3">
                                    <a href="pham.php">
                                        <div class="body bg-secondary text-light">
                                            <h4><i class="icon-wallet"></i> </h4>
                                            <span> Pharmacy </span>
                                        </div>
                                    </a>
                                </div>


                                <div class="col-md-3">
                                    <a href="cons.php">
                                        <div class="body bg-primary text-light">
                                            <h4><i class="icon-wallet"></i> </h4>
                                            <span> Consultation </span>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-md-3">
                                    <a href="adm.php">
                                        <div class="body bg-dark text-light">
                                            <h4><i class="icon-wallet"></i> </h4>
                                            <span> Admission </span>
                                        </div>
                                    </a>
                                </div>




                            </div>
                        </div>

                        <div class="body">
                            <div class="row clearfix">

<!--                                <div class="col-md-3">
                                    <a href="../nursing/em.php">
                                        <div class="body bg-danger text-light">
                                            <h4><i class="icon-wallet"></i> </h4>
                                            <span> Emergency </span>
                                        </div>
                                    </a>
                                </div>-->




                            </div>

                        </div>



                    </div>
                </div>
            </div>


        </div>
    </div>




<?php
require('../layout/footer.php');
