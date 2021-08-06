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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Nursing Department </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active">
                                Clinics
                            </li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                       
                        <div class="body">

                            <a style="font-size: large;" href="home.php">Back</a>

                            <div class="row clearfix">
                                <?php
                                    $clinics = Clinic::find_all();
                                    $subClinic = SubClinic::find_by_id($user->sub_clinic_id);
                                ?>


                                <div class="container">
                                    <h2> Hospital Clinics  </h2>
                                    <?php  foreach ($clinics as $clinic) {  ?>
                                    <ul class="list-group">
                                        <li class='list-group-item'>
                                             <a href='#'><?php echo $clinic->name ?></a>
                                        </li>
                                    </ul>
                                    <?php } ?>

                                </div>

                              <!--  <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card">
                                        <div class="body">
                                            <div class="row text-center">
                                                <div class="col-lg-2 col-md-4 col-6">
                                                    <div class="body xl-turquoise">
                                                        <i class="fa fa-map-marker"></i>
                                                        <h5>GOPD</h5>
                                                        <span>clinic</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-md-4 col-6">
                                                    <div class="body xl-khaki">
                                                        <i class="fa fa-map-marker"></i>
                                                        <h5>MOPD</h5>
                                                        <span>clinic</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-md-4 col-6">
                                                    <div class="body xl-parpl">
                                                        <i class="fa fa-map-marker"></i>
                                                        <h5>SODP</h5>
                                                        <span>clinic</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-md-4 col-6">
                                                    <div class="body xl-salmon">
                                                        <i class="fa fa-map-marker"></i>
                                                        <h6>Dermatology</h6>
                                                        <span>clinic</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-md-4 col-6">
                                                    <div class="body xl-blue">
                                                        <i class="fa fa-map-marker"></i>
                                                        <h6> Gynae Oncology   </h6>
                                                    </div>
                                                </div>

                                                <div class="col-lg-2 col-md-4 col-6">
                                                    <a href="">
                                                        <div class="body xl-slategray">
                                                            <i class="fa fa-map-marker"></i>
                                                            <h6>Haematology</h6>
                                                        </div>
                                                    </a>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="body">
                                            <div class="row text-center">
                                                <div class="col-lg-2 col-md-4 col-6">
                                                    <div class="body xl-turquoise">
                                                        <i class="fa fa-map-marker"></i>
                                                        <h5>Family Planning</h5>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-md-4 col-6">
                                                    <div class="body xl-khaki">
                                                        <i class="fa fa-map-marker"></i>
                                                        <h5>Staff Clinic</h5>
                                                        <span>MOPD</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-md-4 col-6">
                                                    <div class="body xl-parpl">
                                                        <i class="fa fa-map-marker"></i>
                                                        <h5>SODP</h5>
                                                        <span>SOPD</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-md-4 col-6">
                                                    <div class="body xl-salmon">
                                                        <i class="fa fa-map-marker"></i>
                                                        <h6>Dermatology</h6>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-md-4 col-6">
                                                    <div class="body xl-blue">
                                                        <i class="fa fa-map-marker"></i>
                                                        <h6> Gynae Oncology   </h6>
                                                    </div>
                                                </div>

                                                <div class="col-lg-2 col-md-4 col-6">
                                                    <a href="">
                                                        <div class="body xl-slategray">
                                                            <i class="fa fa-map-marker"></i>
                                                            <h6>Haematology</h6>
                                                        </div>
                                                    </a>

                                                </div>
                                            </div>
                                        </div>


                                    </div>
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