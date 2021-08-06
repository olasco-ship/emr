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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>
                            Consultancy </h2>
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

                            <a style="font-size: larger" href="index.php">&laquo;Back</a>

<!--                            <div class="row clearfix">-->
                                <?php
                                    $clinics = Clinic::order_name();
                                    $subClinic = SubClinic::find_by_id($user->sub_clinic_id);
                                ?>

                                <!--<div class="container">
                                    <h2> Clinical Departments  </h2>


                                </div>-->
                                <div id="accordion">
                                    <?php
                                    foreach ($clinics as $clinic) {
                                        $sub = SubClinic::find_by_clinic_id($clinic->id);
                                        ?>

                                        <div class="card">
                                            <div class="card-header">
                                                <a class="card-link" data-toggle="collapse"
                                                   href="#collapse<?php echo $clinic->id; ?>">
                                                    <?php echo $clinic->name; ?>
                                                </a>
                                            </div>
                                            <div id="collapse<?php echo $clinic->id; ?>"
                                                 class="collapse" data-parent="#accordion">
                                                <div class="card-body">

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <?php  foreach ($sub as $subs) {  ?>
                                                            <ul class="">
                                                                <li>
                                                                    <?php echo $subs->name ?>
                                                                </li>
                                                            </ul>
                                                            <?php } ?>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    <?php } ?>

                                </div>

                        </div>

                    </div>




                </div>






            </div>
        </div>
    </div>


<!--        </div>-->
<!--    </div>-->




<?php
require('../layout/footer.php');