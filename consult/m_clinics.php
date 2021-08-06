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

                        <a style="font-size: larger" href="../consultant/index.php">&laquo;Back</a>

                        <div class="row clearfix">
                            <?php
                            $clinics = Clinic::find_all();
                            $subClinic = SubClinic::find_by_id($user->sub_clinic_id);
                            ?>


                            <div class="container">
                                <h2> My Departments </h2>
                                <?php
                                // echo gethostname() ;
                                $userSubClinic = UserSubClinic::find_by_users($user->id);

                                if (!empty($userSubClinic)) {
                                    foreach ($userSubClinic as $u) {
                                        $clinic = Clinic::find_by_id($u->clinic_id);   ?>

                                        <ul class="list-group">
                                            <li class='list-group-item'>
                                                <a href='../consultant/clinic.php?id=<?php echo $clinic->id ?>'><?php echo $clinic->name ?></a>
                                            </li>
                                        </ul>

                                <?php 
                                    }
                                }

                                ?>


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
