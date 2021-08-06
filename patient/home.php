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
                        <div class="row clearfix">
                            <div class="col-md-3">
                               <!-- <a href="#"> -->
                                  <a href="bill_patient.php"> 
                                    <div class="body bg-success text-light">
                                        <h4><i class="icon-wallet"></i>
                                        </h4>
                                        <span>Bill Patient</span>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="folder.php">
                                    <div class="body bg-warning text-light">
                                        <h4><i class="icon-wallet"></i>
                                        </h4>
                                        <span>Recent Bills </span>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <!--   <a href="auth_code.php">   -->
                                <a href="reg_patient.php">
                                    <div class="body bg-primary text-light">
                                        <h4><i class="icon-wallet"></i><!-- 14,965$-->
                                        </h4>
                                        <span>Register New Patient</span>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-3">
                                <a href="visit.php">
                                    <div class="body bg-dark text-light">
                                        <h4><i class="icon-wallet"></i>
                                            <!--7,12,326$-->
                                        </h4>
                                        <span>Patient Re-visit</span>
                                    </div>
                                </a>
                            </div>

                        </div>

                        <!--<div id="total_revenue" class="ct-chart m-t-20"></div>-->

                    </div>

                    <div class="body">
                        <div class="row clearfix">

                            <div class="col-md-3">
                                <a href="index.php">
                                    <div class="body bg-danger text-light">
                                        <h4><i class="icon-wallet"></i><!-- 25,965$-->
                                        </h4>
                                        <span>Patient Records</span>
                                    </div>
                                </a>

                            </div>


                            <div class="col-md-3">
                                <a href="app.php">
                                    <div class="body bg-success text-light">
                                        <h4><i class="icon-wallet"></i> </h4>
                                        <span>Appointment </span>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-3">
                                <a href="ref.php">
                                    <div class="body bg-info text-light">
                                        <h4><i class="icon-wallet"></i>
                                            <!--25,965$-->
                                        </h4>
                                        <span> Referrals </span>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-3">
                                <a href="<?php echo emr_lucid ?>/nhis/check.php">
                                    <div class="body bg-secondary text-light">
                                        <h4><i class="icon-wallet"></i>
                                            <!--14,965$-->
                                        </h4>
                                        <span> NHIS </span>
                                    </div>
                                </a>
                            </div>

                            <!--
                                <div class="col-md-3">
                                    <a href="reschedule.php">
                                        <div class="body bg-warning text-light">
                                            <h4><i class="icon-wallet"></i> </h4>
                                            <span>Appointment Re-scheduling</span>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-md-3">
                                    <a href="book.php">
                                        <div class="body bg-info text-light">
                                            <h4><i class="icon-wallet"></i> </h4>
                                            <span> Confirm Appointment </span>
                                        </div>
                                    </a>
                                </div>
                                -->

                        </div>

                    </div>

                    <div class="body">
                        <div class="row clearfix">

                            <div class="col-md-3">
                                <a href="coding.php">
                                    <div class="body bg-info text-light">
                                        <h4><i class="icon-wallet"></i>
                                            <!--25,965$-->
                                        </h4>
                                        <span> Coding & Indexing </span>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-3">
                                <a href="<?php echo emr_lucid ?>/reports/index.php">
                                    <div class="body bg-secondary text-light">
                                        <h4><i class="icon-wallet"></i>
                                            <!--14,965$-->
                                        </h4>
                                        <span> Statistical Reports </span>
                                    </div>
                                </a>
                            </div>


                            <div class="col-md-3">
                                <a href="emergency.php">
                                    <div class="body bg-danger text-light">
                                        <h4><i class="icon-wallet"></i></h4>
                                        <span> Emergency </span>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-3">
                                <a href="records_users.php">
                                    <div class="body bg-warning text-light">
                                        <h4><i class="icon-wallet"></i> </h4>
                                        <span>User Management</span>
                                    </div>
                                </a>
                            </div>



                        </div>



                    </div>


                    <div class="body">
                        <div class="row clearfix">

                            <div class="col-md-3">
                                <a href="other_hosp_ref.php">
                                    <div class="body bg-success text-light">
                                        <h4><i class="icon-wallet"></i> </h4>
                                        <span>Ref-Patient Registration</span>
                                    </div>
                                </a>
                            </div>

<!--                            <div class="col-md-3">-->
<!--                                <a href="create_temp.php">-->
<!--                                    <div class="body bg-success text-light">-->
<!--                                        <h4><i class="icon-wallet"></i> </h4>-->
<!--                                        <span> Registration </span>-->
<!--                                    </div>-->
<!--                                </a>-->
<!--                            </div>-->

                            <div class="col-md-3">
                                <a href="revenue.php">
                                    <div class="body bg-info text-light">
                                        <h4><i class="icon-wallet"></i>
                                            <!--25,965$-->
                                        </h4>
                                        <span> Revenues </span>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-3">
                                <a href="../admission/reg.php">
                                    <div class="body bg-dark text-light">
                                        <h4><i class="icon-wallet"></i>
                                        </h4>
                                        <span>Admission Registration</span>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-3">
                                <a href="<?php /*echo emr_lucid */?>/admission/rep.php">
                                    <div class="body bg-secondary text-light">
                                        <h4><i class="icon-wallet"></i>
                                        </h4>
                                        <span> Admission Reports </span>
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
