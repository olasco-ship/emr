<?php

require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$dept = 'lab';

$count_paid = Bill::count_paid($dept);

$count_billed = Bill::count_billed($dept);

$count_request = Encounter::count_lab_request();

$count_pending = Result::count_pending();

$count_results = Result::count_all_checked();

$count_pending_qc = Result::count_all_pending_qc();

$count_prelim_checked = Result::count_all_prelim_checked();

$count_final_checked = Result::count_all_final_checked();


require('../layout/header.php');
?>



    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>
                            Laboratory Department </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="home.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active">Lab Activities</li>
                        </ul>
                    </div>

                </div>
            </div>


            <div class="row clearfix">
                <div class="col-lg-12 col-md-12">
                    <div class="card">

                        <div class="body">

                            <ul>
                                <li><a href="haem.php">Haematology Form</a> </li>
                                <li><a href="blood.php">Blood Transfusion Form</a> </li>
                                <li><a href="chem.php">Chemical Pathology Form</a> </li>
                                <li><a href="para.php">Parasitology Form</a> </li>
                                <li> <a href="micro.php">Microbiology Form</a> </li>
                                <li> <a href="histo.php">Histology Form</a> </li>
                            </ul>



                        </div>






                    </div>
                </div>
            </div>





        </div>
    </div>




























<?php

require('../layout/footer.php');
