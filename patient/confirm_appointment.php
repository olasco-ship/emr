<?php
require_once("../includes/initialize.php");
if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}


$app = Appointment::find_by_id($_GET['id']);


if (is_post()) {

/*    $app_date = new DateTime($_POST['app_date']);
    $app_date = date_format($app_date, 'Y-m-d');*/

    $app_date = trim($_POST['app_date']);

    $app_date = date("Y-m-d", strtotime($app_date));

    $appointment           = Appointment::find_by_id($_GET['id']);
    $appointment->sync     = "off";
    $appointment->app_date = $app_date;
    $appointment->status   = "CONFIRMED";
    $appointment->save();
    $session->message("Appointment has been confirmed for this patient");
    redirect_to("appointment.php");

}



require('../layout/header.php');
?>


    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>  Appointments</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Confirm Appointments</li>
                            <li class="breadcrumb-item active">View Appointments </li>
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
                <div class="col-md-12">
                    <div class="card patients-list">
                        <div class="header">

                            <ul class="header-dropdown">
                                <li><a class="tab_btn" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Weekly">W</a></li>
                                <li><a class="tab_btn" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Monthly">M</a></li>
                                <li><a class="tab_btn active" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Yearly">Y</a></li>
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another Action</a></li>
                                        <li><a href="javascript:void(0);">Something else</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>


                        <div class="body">
                            <a href="book.php" style="font-size: large">&laquo; Back</a>
                            <br/>
                            <?php
                              $patient = Patient::find_by_id($app->patient_id);
                              if (!empty(SubClinic::find_by_id($app->sub_clinic_id))){
                                $sub_clinic = SubClinic::find_by_id($app->sub_clinic_id);
                                $clinic = Clinic::find_by_id($sub_clinic->clinic_id);
                              }

                            ?>

                            <form method="post" action="">

                                <div class="form-group">
                                    <input type="text" class="form-control" style="width: 300px"  placeholder="First Name"  name="first_name"
                                               value="<?php  echo $patient->full_name()  ?>" readonly >
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control" style="width: 300px"  placeholder="Surname" name="last_name"
                                           
                                    value="<?php  if (!empty(SubClinic::find_by_id($app->sub_clinic_id))){
                                                 echo $clinic->name .'/'. $sub_clinic->name ;                                                
                                           } else {
                                            $ref  = ReferAdmission::find_by_id($app->ref_adm_id);
                                            $ward = Wards::find_by_id($ref->ward_no);
                                            echo $ward->ward_number;
                                           }?>
                                           " readonly >
                                           
                                           
                                </div>

                                <!--
                                <div class="form-group">
                                    <input type="text" class="form-control" style="width: 300px"  placeholder="Surname" name="last_name"
                                           value="<?php echo $sub_clinic->name  ?>" readonly >
                                </div>
                                -->

                                <div class="form-group">
                                    <input type="text" class="form-control" style="width: 300px"  placeholder="Surname" name="last_name"
                                           value="<?php echo date_to_text($app->date)   ?>" readonly >
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control" style="width: 300px"  placeholder="Surname" name="last_name"
                                           value="<?php echo $app->next_app ?>" readonly >
                                </div>


                                <div class="form-group">
                                    <input type="text" id="app_date" style="width: 300px" class="form-control" placeholder="Select Date"
                                           name="app_date" required>
                                    <br/>
                                    <button type="submit" class="btn btn-outline-primary">Search</button>
                                </div>


                            </form>




                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>











<?php

require('../layout/footer.php');























