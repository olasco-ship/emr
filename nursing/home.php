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
<!--                            --><?php
/*                            if (!empty(SubClinic::find_by_id($user->sub_clinic_id))) {
                                $subClinic = SubClinic::find_by_id($user->sub_clinic_id);
                                $clinic = Clinic::find_by_id($subClinic->clinic_id);
                                echo $clinic->name . " / " . $subClinic->name;
                            }
                            */?>
                        </li>


                    </ul>
                </div>

            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <div class="card">
             
                    <div class="body">

                      <!--  <div class="row clearfix">
                            <div class="col-md-3">
                                <a href="clinics.php">
                                    <div class="body bg-danger text-light">
                                        <h4><i class="icon-wallet"></i> </h4>
                                        <span> All Clinics</span>
                                    </div>
                                </a>
                            </div>

                            <?php
/*                            $clinics = Clinic::find_all();
                            $subClinic = SubClinic::find_by_id($user->sub_clinic_id);
                            */?>
                            <?php
/*                            if ($user->sub_clinic_id > 0) {
                                foreach ($clinics as $clinic) {
                                    if ($subClinic->clinic_id == $clinic->id) {  */?>
                                        <div class="col-md-3">
                                            <a href="clinic.php">
                                                <div class="body bg-primary text-light">
                                                    <h4><i class="icon-wallet"></i></h4>
                                                    <span><?php /*echo $clinic->name */?></span>
                                                </div>
                                            </a>
                                        </div>
                                <?php
/*                                    }
                                }
                            } else if (!empty($user->ward_id) && $user->ward_id > 0) {
                                */?>
                                <div class="col-md-3">
                                    <a href="ipd_dash.php">
                                        <div class="body bg-info text-light">
                                            <h4><i class="icon-wallet"></i> </h4>
                                            <span> IPD Dashboard </span>
                                        </div>
                                    </a>
                                </div>

                            <?php
/*                            } else if ($_SESSION['department'] == "ICT") {
                            */?>
                                <div class="col-md-3">
                                    <a href="ipd_dash.php">
                                        <div class="body bg-info text-light">
                                            <h4><i class="icon-wallet"></i> </h4>
                                            <span> IPD Dashboard </span>
                                        </div>
                                    </a>
                                </div>
                                <?php
/*                                foreach ($clinics as $clinic) {
                                    if ($subClinic->clinic_id == $clinic->id) {  */?>
                                        <div class="col-md-3">
                                            <a href="clinic.php">
                                                <div class="body bg-primary text-light">
                                                    <h4><i class="icon-wallet"></i></h4>
                                                    <span><?php /*echo $clinic->name */?></span>
                                                </div>
                                            </a>
                                        </div>
                            <?php
/*                                    }
                                }
                            }
                            */?>

                            <div class="col-md-3">
                                <a href="admin.php">
                                    <div class="body bg-dark text-light">
                                        <h4><i class="icon-wallet"></i></h4>
                                        <span>Nurses by clinic/ward</span>
                                    </div>
                                </a>
                            </div>


                            <div class="col-md-3">
                                <a href="officers.php">
                                    <div class="body bg-warning text-light">
                                        <h4><i class="icon-wallet"></i>
                                        </h4>
                                        <span> Nursing Administration </span>
                                    </div>
                                </a>
                            </div>










                        </div>-->


                        <div class="row clearfix">
                            <div class="col-md-3">
                                <a href="clinics.php">
                                    <div class="body bg-danger text-light">
                                        <h4><i class="icon-wallet"></i> </h4>
                                        <span> All Departments</span>
                                    </div>
                                </a>
                            </div>

                            <?php
                            $clinics = Clinic::find_all();
                            $subClinic = SubClinic::find_by_id($user->sub_clinic_id);
                            ?>
                            <?php
                            if ($user->sub_clinic_id > 0) {
                                foreach ($clinics as $clinic) {
                                    if ($subClinic->clinic_id == $clinic->id) {  ?>
                                        <div class="col-md-3">
                                            <a href="clinic.php">
                                                <div class="body bg-primary text-light">
                                                    <h4><i class="icon-wallet"></i></h4>
                                                    <span><?php echo $clinic->name ?></span>
                                                </div>
                                            </a>
                                        </div>
                                        <?php
                                    }
                                }
                            }
                                ?>
                                <div class="col-md-3">
                                    <a href="ipd_dash.php">
                                        <div class="body bg-info text-light">
                                            <h4><i class="icon-wallet"></i> </h4>
                                            <span> IPD Dashboard </span>
                                        </div>
                                    </a>
                                </div>


<!--                                <?php
/*                                foreach ($clinics as $clinic) {
                                    if ($subClinic->clinic_id == $clinic->id) {  */?>
                                        <div class="col-md-3">
                                            <a href="clinic.php">
                                                <div class="body bg-primary text-light">
                                                    <h4><i class="icon-wallet"></i></h4>
                                                    <span><?php /*echo $clinic->name */?></span>
                                                </div>
                                            </a>
                                        </div>
                                        --><?php
/*                                    }
                                }
                            */?>

          <!--                  <div class="col-md-3">
                                <a href="admin.php">
                                    <div class="body bg-dark text-light">
                                        <h4><i class="icon-wallet"></i></h4>
                                        <span>Nurses by clinic/ward</span>
                                    </div>
                                </a>
                            </div>-->


                            <div class="col-md-3">
                                <a href="officers.php">
                                    <div class="body bg-warning text-light">
                                        <h4><i class="icon-wallet"></i>
                                            <!--25,965$-->
                                        </h4>
                                        <span> Nursing Administration </span>
                                    </div>
                                </a>
                            </div>










                        </div>


                    </div>


                    <div class="body">
                        <div class="row clearfix">


                            <div class="col-md-3">
                                <a href="<?php echo emr_lucid ?>/clinic/sub.php">
                                    <div class="body bg-success text-light">
                                        <h4><i class="icon-wallet"></i> </h4>
                                        <span> Sub-clinics </span>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-3">
                                <a href="<?php echo emr_lucid ?>/rooms/index.php">
                                    <div class="body bg-secondary text-light">
                                        <h4><i class="icon-wallet"></i> </h4>
                                        <span> Consulting Rooms </span>
                                    </div>
                                </a>
                            </div>


                            <div class="col-md-3">
                                <a href="../revenue/ipd-admin.php">
                                    <div class="body bg-primary text-light">
                                        <h4><i class="icon-wallet"></i> </h4>
                                        <span> IPD Admin </span>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-3">
                                <a href="../revenue/ipd_discount.php">
                                    <div class="body bg-danger text-light">
                                        <h4><i class="icon-wallet"></i> </h4>
                                        <span> IPD Discount </span>
                                    </div>
                                </a>
                            </div>

                        </div>
                    </div>

                    <div class="body">
                        <div class="row clearfix">

                            <div class="col-md-3">
                                <a href="../nursing/em.php">
                                    <div class="body bg-danger text-light">
                                        <h4><i class="icon-wallet"></i> </h4>
                                        <span> Emergency </span>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-3">
                                <a href="<?php echo emr_lucid ?>/nursingProcess/index.php">
                                    <div class="body bg-success text-light">
                                        <h4><i class="icon-wallet"></i> </h4>
                                        <span> NANDA Domains </span>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-3">
                                <a href="<?php echo emr_lucid ?>/nursingProcess/classification.php">
                                    <div class="body bg-success text-light">
                                        <h4><i class="icon-wallet"></i> </h4>
                                        <span> NANDA Classification </span>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-3">
                                <a href="<?php echo emr_lucid ?>/nursingProcess/diagnosis.php">
                                    <div class="body bg-success text-light">
                                        <h4><i class="icon-wallet"></i> </h4>
                                        <span> NANDA Diagnosis </span>
                                    </div>
                                </a>
                            </div>




                        </div>

                    </div>

                    <div class="body">
                        <div class="row clearfix">

                            <div class="col-md-3">
                                <a href="../nursingReport/home.php">
                                    <div class="body bg-secondary text-light">
                                        <h4><i class="icon-wallet"></i> </h4>
                                        <span> Reports </span>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-3">
                                <a href="<?php echo emr_lucid ?>/clinic/index.php">
                                    <div class="body bg-dark text-light">
                                        <h4><i class="icon-wallet"></i>
                                        </h4>
                                        <span> Manage Departments </span>
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
