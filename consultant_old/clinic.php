<?php
require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$user = User::find_by_id($session->user_id);

$clinic = Clinic::find_by_id($_GET['id']);

//$userClinic = UserSubClinic::find_by_user_id($user->id);
$userClinic = UserSubClinic::find_by_user_clinic_id($user->id, $clinic->id);
if (empty($userClinic)) {
    //redirect_to('clinics.php');
}




$patSubClinics = PatientSubClinic::find_by_clinic($clinic->id);

$countClinics = PatientSubClinic::count_clinic($clinic->id);

$countWaiting = WaitingList::count_waiting_consultation($clinic->id);

$countConsultingRooms = ConsultingRooms::count_room_by_clinic($clinic->id);




require('../layout/header.php');
?>



<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>
                        Consultancy
                    </h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active">
                            <?php echo $clinic->name;  ?>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <div class="card">





                    <div class="body">
                        <?php
                        if (!empty($message)) { ?>
                            <div id="success" class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <?php echo output_message($message); ?>
                            </div>
                        <?php }
                        ?>

                        <a style="font-size: larger" href="../consult/m_clinics.php">&laquo;Back</a>

                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12">
                                <div class="card">
                                    <div class="body">
                                        <div class="row clearfix">
                                            <div class="col-md-3">
                                                <a href="list.php?id=<?php echo $clinic->id ?>">
                                                    <div class="body bg-danger text-light">

                                                        <h4><i class="icon-wallet"></i> <?php echo $countClinics; ?> </h4>
                                                        <span> Patients In Clinic </span>
                                                    </div>
                                                </a>
                                            </div>

                                            <div class="col-md-3">
                                                <a href="wait.php?id=<?php echo $clinic->id ?>">
                                                    <div class="body bg-primary text-light">
                                                        <h4><i class="icon-wallet"></i> <?php echo $countWaiting ?></h4>
                                                        <span>All Waiting List</span>
                                                    </div>
                                                </a>
                                            </div>


                                            <div class="col-md-3">
                                                <a href="rooms.php?id=<?php echo $clinic->id ?>">
                                                    <div class="body bg-dark text-light">
                                                        <h4><i class="icon-wallet"></i></h4>
                                                        <span>Patients(Consulting Rooms)</span>
                                                    </div>
                                                </a>
                                            </div>


                                            <div class="col-md-3">
                                                <a href="../consult/m_visit.php">
                                                    <div class="body bg-warning text-light">
                                                        <h4><i class="icon-wallet"></i>
                                                        </h4>
                                                        <span> Today's Visit </span>
                                                    </div>
                                                </a>
                                            </div>

                                            <!--
                                            <div class="col-md-3">
                                                <a href="officers.php">
                                                    <div class="body bg-warning text-light">
                                                        <h4><i class="icon-wallet"></i>
                                                        </h4>
                                                        <span> Consultants </span>
                                                    </div>
                                                </a>
                                            </div>
                                            -->

                                        </div>


                                    </div>


                                </div>
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
