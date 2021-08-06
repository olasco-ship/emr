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
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> GP Consultation </h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active">Reports</li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="row clearfix">

            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="body">

                    <a href="../consultant/index.php" style="font-size: large">&laquo; Back</a>
                        <ul style="font-size: large;">

                            <li><a href="../consult/all_visit.php">All Hospital Visit Report </a></li>
                            <li><a href="../consult/visit_clinic.php"> All Visit By Clinic </a></li>
                            <li><a href="../consult/visit_cons.php">All Visit By Consultant In Clinic </a></li>
                            <li><a href="../consult/pending_adm.php">All Pending Admission </a></li>
                            <li><a href="../consult/pending_adm_ward.php">All Pending Admission By Ward </a></li>
                            <li><a href="../consult/admitted.php">All Admitted </a></li>
                            <li><a href="../consult/admitted_ward.php">All Admitted By Ward </a></li>
                            <li><a href="../consult/pending_discharge.php"> All Pending Discharged Report</a></li>
                            <li><a href="../consult/pending_discharge_ward.php"> All Pending Discharged By Ward</a></li>
                            <li><a href="../consult/discharge.php"> All Discharged Report</a></li>
                            <li><a href="../consult/discharge_ward.php"> All Discharged By Ward</a></li>
                            <li><a href="../consult/birth.php">Birth Report</a></li>
                            <li><a href="../consult/death.php">All Death Report</a></li>
                        
                        </ul>



                    </div>






                </div>
            </div>
        </div>




    </div>
</div>




<?php
require('../layout/footer.php');
