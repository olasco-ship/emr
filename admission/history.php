<?php

require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$patient = Patient::find_by_id($_GET['id']);


$user = User::find_by_id($session->user_id);





$index = 1;




require('../layout/header.php');
?>



    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Admission History</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="home.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item"><?php echo $patient->full_name(); ?></li>
                           <!-- <li class="breadcrumb-item active">Payments List</li>-->
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-4 col-sm-12 text-right">
                        <div class="bh_chart hidden-xs">
                            <div class="float-left m-r-15">
                                <small>Visitors</small>
                                <h6 class="mb-0 mt-1"><i class="icon-user"></i> 1,784</h6>
                            </div>
                            <span class="bh_visitors float-right">2,5,1,8,3,6,7,5</span>
                        </div>
                        <div class="bh_chart hidden-sm">
                            <div class="float-left m-r-15">
                                <small>Visits</small>
                                <h6 class="mb-0 mt-1"><i class="icon-globe"></i> 325</h6>
                            </div>
                            <span class="bh_visits float-right">10,8,9,3,5,8,5</span>
                        </div>
                        <div class="bh_chart hidden-sm">
                            <div class="float-left m-r-15">
                                <small>Chats</small>
                                <h6 class="mb-0 mt-1"><i class="icon-bubbles"></i> 13</h6>
                            </div>
                            <span class="bh_chats float-right">1,8,5,6,2,4,3,2</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                
                        <div class="body">


                            <a href="reg.php" style="font-size: large">&laquo; Back</a>
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th>S/N</th>
                                        <th>Admission Date</th>
                                        <th>Discharge Date</th>
                                        <th>Type Of Admission</th>
                                        <th>Provider</th>
                                        <th>Type Of Discharge </th>
                      
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php  $admission = Admission::find_all_adm_by_patient($patient->id);
                                     foreach($admission as $adm) {   ?>
                                        <tr>
                                            <td><?php echo $index++ ?></td>
                                            <td><?php $d_date = date('d/m/Y', strtotime($adm->adm_date)); echo $d_date ?></td>
                                            <td><?php $d_date = date('d/m/Y', strtotime($adm->discharge_date)); echo $d_date ?></td>
                                            <td><?php echo $adm->adm_type ?></td>
                                            <td><?php echo $adm->adm_doct ?></td>
                                            <td><?php echo $adm->discharge_type ?></td>
                                        </tr>
                                    <?php } ?>

                                    </tbody>
                                </table>
                            </div>

                           

                        </div>





                    </div>
                </div>
            </div>
        </div>
    </div>




<?php

require('../layout/footer.php');




