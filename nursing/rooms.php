<?php

/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/1/2019
 * Time: 12:18 PM
 */


require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$user = User::find_by_id($session->user_id);


$clinics = Clinic::find_all();
foreach ($clinics as $clinic) {
    //  echo "<h4>$clinic->name</h4>" . "<br/>";
    $rooms = ConsultingRooms::find_room_by_clinic($clinic->id);
    foreach ($rooms as $r) {
        //    echo $r->room_no . "<br/>";
    }
}



$rooms = ConsultingRooms::find_all();
foreach ($rooms as $room) {
    //  echo $room->room_no . "<br/>";
}
// exit;




require('../layout/header.php');

?>


<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> All Patient</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Patient</li>
                        <li class="breadcrumb-item active">All Patient</li>
                    </ul>
                </div>

            </div>
        </div>


        <div class="row clearfix">
            <div class="col-md-12">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="body">


                            <div class="row clearfix">

                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="body">
                                            <a style="font-size: larger" href="clinic.php">&laquo;Back</a>
                                            <h2 class="page-title">All Consulting Rooms</h2>
                                            <div class="accordion" id="accordion">
                                                <?php
                                                foreach ($clinics as $clinic) {

                                                ?>
                                                    <div>
                                                        <div class="card-header" id="headingOne">
                                                            <h5 class="mb-0">
                                                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse<?php echo $clinic->id ?>" aria-expanded="true" aria-controls="collapseOne">
                                                                    <?php echo $clinic->name ?>
                                                                </button>
                                                            </h5>
                                                        </div>
                                                        <div id="collapse<?php echo $clinic->id ?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                                            <div class="card-body">

                                                                <div class="row">



                                                                    <div class="col-md-12">
                                                                        <h6> Consulting Rooms </h6>

                                                                        <div class="body">
                                                                            <div class="table-responsive">
                                                                                <table class="table table-bordered">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>#</th>
                                                                                            <?php
                                                                                            $rooms = ConsultingRooms::find_room_by_clinic($clinic->id);
                                                                                            foreach ($rooms as $r) { ?>
                                                                                                <th><?php echo $r->room_no ?></th>
                                                                                            <?php }
                                                                                            ?>
                                                                                        </tr>

                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <th>Waiting</th>
                                                                                            <?php
                                                                                            $rooms = ConsultingRooms::find_room_by_clinic($clinic->id);
                                                                                            foreach ($rooms as $r) {
                                                                                                $count_waiting = PatientConsultingRooms::count_patient_in_room($r->id);
                                                                                            ?>
                                                                                                <td><?php echo $count_waiting ?></td>
                                                                                            <?php }
                                                                                            ?>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>Engaged</th>
                                                                                            <?php
                                                                                            $rooms = ConsultingRooms::find_room_by_clinic($clinic->id);
                                                                                            foreach ($rooms as $r) { ?>
                                                                                                <td><?php echo $r->room_no ?></td>
                                                                                            <?php }
                                                                                            ?>
                                                                                        </tr>

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

            </div>
        </div>


    </div>
</div>


<?php

require('../layout/footer.php');
