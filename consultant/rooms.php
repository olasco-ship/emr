<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/3/2019
 * Time: 4:12 PM
 */


require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$clinic = Clinic::find_by_id($_GET['id']);

// echo gethostname();  // Change the Computer name to Room No.






if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $room_id = trim($_POST['search']);
 //  echo $query; exit;
}


require('../layout/header.php');
?>





    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>
                            Patients on Waiting List</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Patient In Consulting Room</li>
                            <li class="breadcrumb-item active"> Room --- </li>
                        </ul>
                    </div>
                </div>
            </div>



            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card patients-list">

                        <div class="body">
                            <a style="font-size: larger" href="clinic.php?id=<?php echo $clinic->id ?>">&laquo;Back</a>
                            <div href="#" class="right">

                                <div class="col-sm-3">
                                    <form class="form-inline" id="basic-form" action="" method="post">
                                        <div class="form-group">
                                            <!-- <label> Consulting Rooms </label>-->
                                            <select class="form-control"  id="search" name="search" required>
                                                <option value="">--Select Consulting Rooms--</option>
                                                <?php
                                                //   $finds = Clinic::find_all();
                                                $finds = ConsultingRooms::find_room_by_clinic($clinic->id);
                                                foreach ($finds as $find) { ?>
                                                    <option value="<?php echo $find->id; ?>"><?php echo $find->room_no; ?></option>
                                                <?php } ?>
                                            </select>
                                            <button type="submit" class="btn btn-outline-success">Select</button>
                                            <button type="button" name="search" onClick="location.href=location.href"  class="btn btn-outline-danger">Refresh</button>
                                        </div>
                                    </form>
                                </div>



                            </div>
                            <ul class="nav nav-tabs-new2">
                                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#All">
                                        Patients Waiting List
                                        <?php
                                            if (is_post()){
                                                $room_num = ConsultingRooms::find_by_id($room_id);
                                                echo " for ". $room_num->room_no;
                                            }
                                        ?>
                                    </a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content m-t-10 padding-0">
                                <div class="tab-pane table-responsive active show" id="All">
                                    <table class="table m-b-0 table-hover">
                                        <thead class="thead-success">
                                        <tr>
                                            <th>Folder No.</th>
                                            <th>Patient Name</th>
                                            <th>Age</th>
                                            <th>Gender</th>
                                            <th>Date Registered</th>
                                            <th>Status</th>
                                        </tr>

                                        </thead>
                                        <tbody>

                                        <?php
                                        if (is_post()) {
                                            $query = trim($_POST['search']);

                                            $waitingConsultation = WaitingList::find_waiting_by_room($clinic->id, $room_id);
                                            foreach($waitingConsultation as $waiting)  {
                                                $patient = Patient::find_by_id($waiting->patient_id);
                                                ?>
                                                <tr>
                                                    <!--<td><a href='stage.php?id=<?php /*echo $patient->id */?>'><?php /*echo $patient->folder_number */?></a></td>-->
                                                    <td><a href='dashboard.php?id=<?php echo $waiting->id ?>'><?php echo $patient->folder_number ?></a></td>
                                                    <td><?php echo $patient->full_name() ?></td>
                                                    <td><?php echo getAge($patient->dob) ?></td>
                                                    <td><?php echo $patient->gender ?></td>
                                                    <td><?php $d_date = date('d/m/Y h:i a', strtotime($patient->date_registered)); echo $d_date ?></td>
                                                    <td><span class="badge badge-success">COMPLETED</span></td>
                                                    <!--        <td><a href='history.php?id=<?php echo $patient->id ?>' History</a></td>
                                            <td><a href='vitals.php?id=<?php echo $patient->id ?>'> Vitals</a></td>   -->
                                                </tr>
                                            <?php } }
                                        else {
                                            $room_id = 6;
                                            $waitingConsultation = WaitingList::find_waiting_by_room($clinic->id, $room_id);
                                            foreach($waitingConsultation as $waiting)  {
                                                $patient = Patient::find_by_id($waiting->patient_id);
                                                ?>
                                                <tr>
                                                    <!--<td><a href='stage.php?id=<?php /*echo $patient->id */?>'><?php /*echo $patient->folder_number */?></a></td>-->
                                                    <td><a href='dashboard.php?id=<?php echo $waiting->id ?>'><?php echo $patient->folder_number ?></a></td>
                                                    <td><?php echo $patient->full_name() ?></td>
                                                    <td><?php echo getAge($patient->dob) . "years" ?></td>
                                                    <td><?php echo $patient->gender ?></td>
                                                    <td><?php $d_date = date('d/m/Y h:i a', strtotime($patient->date_registered)); echo $d_date ?></td>
                                                    <td><span class="badge badge-success">COMPLETED</span></td>
                                                </tr>

                                            <?php   } }
                                        ?>

                                        </tbody>
                                    </table>
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
