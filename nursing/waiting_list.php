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
                            <?php
                            if (!empty($user->sub_clinic_id)) {
                                $subClinic = SubClinic::find_by_id($user->sub_clinic_id);
                                $clinic = Clinic::find_by_id($subClinic->clinic_id);
                                echo $clinic->name . " / " . $subClinic->name;
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

                        <a style="font-size: larger" href="clinic.php">&laquo;Back</a>
                        <ul class="nav nav-tabs-new2">
                            <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#All">Patients On Waiting List</a></li>
                        </ul>
                        <div class="tab-content m-t-10 padding-0">
                            <div class="tab-pane table-responsive active show" id="All">
                                <table class="table m-b-0 table-hover">
                                    <thead class="thead-primary">

                                        <tr>
                                            <th>Folder No.</th>
                                          <!--  <th>Clinic No.</th> -->
                                            <th>Patient Name</th>
                                            <th>Age</th>
                                            <th>Gender</th>
                                            <th>Date Registered</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $start_sec = "00:00:00";
                                        $end_sec   = "23:59:59";
                                        $today = strftime("%Y-%m-%d", time());
                                        $start_date = $today . " " . $start_sec;
                                        $end_date   = $today . " " . $end_sec;
                                        $subClinic = SubClinic::find_by_id($user->sub_clinic_id);
                                        $waiting = WaitingList::find_waiting($subClinic->clinic_id, $start_date, $end_date);

                                        foreach ($waiting as $wait) {
                                            $patient = Patient::find_by_id($wait->patient_id);
                                            $pat = PatientSubClinic::find_by_patient_id($patient->id);
                                        ?>
                                            <tr>
                                                <td><a href='view.php?id=<?php echo $wait->id ?>'><?php echo $patient->folder_number ?></a></td>
                                             <!--   <td><?php // echo $pat->clinic_number ?></td>  -->
                                                <td><?php echo $patient->full_name() ?></td>
                                                <td><?php echo getAge($patient->dob) . "years" ?></td>
                                                <td><?php echo $patient->gender ?></td>
                                                <td><?php $d_date = date('d/m/Y h:i a', strtotime($patient->date_registered));
                                                    echo $d_date ?></td>
                                            </tr>

                                        <?php }
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
