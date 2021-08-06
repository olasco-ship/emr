<?php
require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$user = User::find_by_id($session->user_id);


if (!empty($user->sub_clinic_id)) {
    $subClinic = SubClinic::find_by_id($user->sub_clinic_id);
    $clinic = Clinic::find_by_id($subClinic->clinic_id);
 //   echo $clinic->name . " / " . $subClinic->name;
}

$today      = strftime("%Y-%m-%d", time());
$start_sec  = "00:00:00";
$end_sec    = "23:59:59";
$start_date = $today . " " . $start_sec;
$end_date   = $today . " " . $end_sec;

$patSubClinics = PatientSubClinic::find_by_clinic($clinic->id);

$countPatientInClinics = PatientSubClinic::count_clinic($clinic->id);

$countWaiting = WaitingList::count_waiting($clinic->id, $start_date, $end_date);

$countConsultingRooms = ConsultingRooms::count_room_by_clinic($clinic->id);

$dept = 'Nursing';
$countUserClinic = User::count_by_dept_clinic($subClinic->id, $dept);

$countVisit = WaitingList::count_all_waiting($start_date, $end_date);


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
                                <?php
                                if (!empty(SubClinic::find_by_id($user->sub_clinic_id))){
                                    $subClinic = SubClinic::find_by_id($user->sub_clinic_id);
                                    $clinic = Clinic::find_by_id($subClinic->clinic_id);
                                    echo $clinic->name ." / ". $subClinic->name ;
                                }
                                ?>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12">
                    <div class="card">

                        <div class="body">
                            <a style="font-size: large" href="home.php">&laquo;Back</a>

                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <a href="clinic_patients.php">
                                        <div class="card text-center bg-info">
                                            <div class="body">
                                                <div class="p-15 text-light">
                                                    <h3><?php echo $countPatientInClinics; ?></h3>
                                                    <span> Patients In Clinic </span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <a href="waiting_list.php">
                                        <div class="card text-center bg-secondary">
                                            <div class="body">
                                                <div class="p-15 text-light">
                                                    <h3><?php echo $countWaiting ?></h3>
                                                    <span>Patients On Waiting List</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <a href="rooms.php">
                                        <div class="card text-center bg-warning">
                                            <div class="body">
                                                <div class="p-15 text-light">
                                                    <h3><?php echo $countConsultingRooms ?></h3>
                                                    <span>Consultation Rooms</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <a href="visit.php">
                                        <div class="card text-center bg-dark">
                                            <div class="body">
                                                <div class="p-15 text-light">
                                                    <h3><?php echo $countVisit ?></h3>
                                                    <span> Today's Visit </span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <a href="clinic_nurses.php">
                                        <div class="card text-center bg-danger">
                                            <div class="body">
                                                <div class="p-15 text-light">
                                                    <h3><?php echo $countUserClinic; ?></h3>
                                                    <span>Nurses In Clinic</span>
                                                </div>
                                            </div>
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