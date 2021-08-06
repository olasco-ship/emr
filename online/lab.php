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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Laboratory Department</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active">Laboratory</li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="row clearfix">

                <div class="col-lg-12 col-md-12">
                    <div class="card">

                        <div class="body">



                            <h5>Laboratory Department Reports</h5>
                            <hr />
                            <a href="home.php" style="font-size: large">&laquo; Back</a>
                            <ul style="font-size: large;">

                                <li><a href="../reports/lab.php">Laboratory Report</a></li>
                                <li><a href="../reports/lab_dept.php">Laboratory Report By Department</a></li>





                            </ul>



                        </div>






                    </div>
                </div>
            </div>




        </div>
    </div>




<?php
require('../layout/footer.php');
