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
                        <div class="row clearfix">

                            <div class="col-md-12">
                                <div class="card patients-list">
                                    <div class="body">

                                    <a style="font-size: large;" href="clinic.php">Back</a>

                                        <div href="#" class="right">
                                            <form class="form-inline" id="basic-form" action="" method="post">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Folder Number" name="search" required>
                                                    <button type="submit" class="btn btn-outline-primary">Search</button>
                                                    <button type="button" name="search" onClick="location.href=location.href" class="btn btn-outline-warning">Refresh</button>
                                                </div>
                                            </form>
                                            <br />
                                            <?php if (is_post()) {  ?>
                                                <div id="success" class="alert alert-success alert-dismissible" role="alert" style="width: 500px">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    All records for <?php echo $query ?>
                                                </div>
                                            <?php } ?>
                                        </div>

                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs-new2">
                                            <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#All">Nursing Department</a></li>
                                            <!--                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#USA">USA</a></li>
                                                                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#India">India</a></li>-->
                                        </ul>

                                        <!-- Tab panes -->
                                        <div class="tab-content m-t-10 padding-0">
                                            <div class="tab-pane table-responsive active show" id="All">
                                                <table class="table m-b-0 table-hover">
                                                    <thead class="thead-purple">

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
                                                            $patients = Patient::find_by_patient($query);
                                                            foreach ($patients as $patient) {   ?>
                                                                <tr>
                                                                    <td><a href='preview.php?id=<?php echo $patient->id ?>'><?php echo $patient->folder_number ?></a></td>
                                                                    <td><?php echo $patient->full_name() ?></td>
                                                                    <td>763648</td>
                                                                    <td><?php echo $patient->gender ?></td>
                                                                    <td><?php $d_date = date('d/m/Y h:i a', strtotime($patient->date_registered));
                                                                        echo $d_date ?></td>
                                                                    <td><span class="badge badge-success">COMPLETED</span></td>

                                                                </tr>
                                                            <?php }
                                                        } else {
                                                            $patSubClinics = PatientSubClinic::find_by_clinic($clinic->id);
                                                            foreach ($patSubClinics as $patSubClinic) {
                                                                $patient = Patient::find_by_id($patSubClinic->patient_id);

                                                            ?>
                                                                <tr>
                                                                    <td><a href='preview.php?id=<?php echo $patient->id ?>'><?php echo $patient->folder_number ?></a></td>
                                                                    <td><?php echo $patient->full_name() ?></td>
                                                                    <td><?php echo getAge($patient->dob) . "years"; ?></td>
                                                                    <td><?php echo $patient->gender ?></td>
                                                                    <td><?php $d_date = date('d/m/Y h:i a', strtotime($patient->date_registered));
                                                                        echo $d_date ?></td>
                                                                    <td><span class="badge badge-success">COMPLETED</span></td>

                                                                </tr>

                                                        <?php }
                                                        }
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
            </div>
        </div>


    </div>
</div>




<?php
require('../layout/footer.php');
