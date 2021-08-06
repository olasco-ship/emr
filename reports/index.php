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

                        

                        <h5>Statistical Reports</h5>
                        <hr />
                        <a href="../patient/home.php" style="font-size: large">&laquo; Back</a>
                        <ul style="font-size: large;">
                            <!--
                            <li><a href="all_patient.php">All Patient Report </a></li>
                            <li><a href="nhis_patient.php">All NHIS Patient </a></li>
                            <li><a href="activity_report.php">All Patient Report By Clinic </a></li>
                            -->
                            <li><a href="reg_pat.php">All Registered Patient Report </a></li>
                     <!--       <li><a href="reg_pat_clinic.php">All Registered Patient By Clinic </a></li>  -->
                            <li><a href="reg_pat_user.php">All Registered Patient By Record Officer </a></li>

                            <li><a href="hosp_visit.php">All Hospital Visit </a></li>
                            <li><a href="hosp_visit_dept.php">All Hospital Visit By Clinic </a></li>

                            <li><a href="visit_done.php"> Hospital Visit (Consultation Done) </a></li>
                            <li><a href="visit_done_dept.php"> Hospital Visit By Clinic (Consultation Done) </a></li>

                            <li><a href="visit_not_done.php"> Hospital Visit (Consultation Not Done) </a></li>
                            <li><a href="visit_not_done_dept.php"> Hospital Visit By Clinic (Consultation Not Done) </a></li>

                            <li><a href="nhis_inpatient.php">All NHIS In-Patients</a> </li>

                            <li><a href="coded_patient.php">All Coded Patient</a> </li>
                            <li><a href="coded_patient_dept.php">All Coded Patient By Clinic</a> </li>
                            <li><a href="count_used_icd.php">All Used ICD with their numbers</a> </li>

                            <li><a href="lab.php">Laboratory Report</a></li>
                            <li><a href="lab_dept.php">Laboratory Report By Department</a></li>
                            <li><a href="rad.php">Radiology Report</a></li>
                            <li><a href="pending_adm.php">Pending Admission Report</a></li>
                            <li><a href="pending_adm_ward.php">Pending Admission By Ward</a></li>
                            <li><a href="in_pat.php">In-patient Report</a></li>
                            <li><a href="in_pat_ward.php">In-patient Ward Report</a></li>
                            <li><a href="pending_dis.php">Pending Discharge Report</a></li>
                            <li><a href="pending_dis_ward.php">Pending Discharge By Ward</a></li>
                            <li><a href="bed_space.php"> Bed Space Report </a></li>
                            <li><a href="discharge_report.php">Discharge Report</a></li>
                            <li><a href="discharge_report_ward.php">Discharge Report By Ward</a></li>
                            <li><a href="birth_report.php">Birth Report</a></li>
                            <li><a href="death_report.php">Death Report</a></li>

                            <!--
                            <hr/>
                            <h5>Account&Audit</h5>
                            <li><a href="death_report.php">All Bills</a></li>
                            <li><a href="death_report.php">All Bills By Department</a></li>
                            <li><a href="death_report.php">All Unpaid Bills</a></li>
                            <li><a href="death_report.php">All Unpaid Bills By Department</a></li>
                            -->


                        </ul>



                    </div>






                </div>
            </div>
        </div>




    </div>
</div>




<?php
require('../layout/footer.php');
