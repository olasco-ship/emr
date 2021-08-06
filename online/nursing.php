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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Nursing Department</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active">Nursing</li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="row clearfix">

                <div class="col-lg-12 col-md-12">
                    <div class="card">

                        <div class="body">



                            <h5>Nursing Department Reports</h5>
                            <hr />
                            <a href="home.php" style="font-size: large">&laquo; Back</a>
                            <ul style="font-size: large;">

                                <li><a href="../reports/reg_pat.php">All Registered Patient Report </a></li>
                                <li><a href="../reports/reg_pat_user.php">All Registered Patient By Record Officer </a></li>
                                <li><a href="../reports/hosp_visit.php">All Hospital Visit </a></li>
                                <li><a href="../reports/hosp_visit_dept.php">All Hospital Visit By Clinic </a></li>
                                <li><a href="../reports/visit_done.php"> Hospital Visit (Consultation Done) </a></li>
                                <li><a href="../reports/visit_done_dept.php"> Hospital Visit By Clinic (Consultation Done) </a></li>
                                <li><a href="../reports/visit_not_done.php"> Hospital Visit (Consultation Not Done) </a></li>
                                <li><a href="../reports/visit_not_done_dept.php"> Hospital Visit By Clinic (Consultation Not Done) </a></li>


                            </ul>



                        </div>






                    </div>
                </div>
            </div>




        </div>
    </div>




<?php
require('../layout/footer.php');
