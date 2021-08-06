<?php
require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$index = 1;

/*
if (is_post()) {
    $sub_clinic_id = $_POST['sub_clinic_id'];
    echo $sub_clinic_id; 

    $subClinic = SubClinic::find_by_id($sub_clinic_id);
    echo $subClinic->name;  exit;
}
*/


require('../layout/header.php');
?>



<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Medical Records</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active">Records</li>
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

            <div class="col-lg-12 col-md-12">
                <div class="card">

                    <div class="body">
                        <a href="../consult/index.php" style="font-size: large">&laquo; Back</a>

                        <h2> All Discharge By Ward </h2>

                        <form class="form-inline" action="" method="post">

                            <?php $wards = Wards::find_all(); ?>
                            <div class="input-group mb-3">
                                <select class="form-control" name="ward_id" required>
                                    <option value="">--Select Ward--</option>
                                    <?php
                                    foreach ($wards as $ward) { ?>
                                        <option value="<?php echo $ward->id; ?>"><?php echo $ward->ward_number; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon3">Start Date</span>
                                </div>
                                <input type="text" class="form-control" autocomplete="off" name="startDate" id="startDate" placeholder="Start Date" value="<?php echo $first_date; ?>" required>
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon3">End Date</span>
                                </div>
                                <input type="text" class="form-control" autocomplete="off" name="endDate" id="endDate" placeholder="End Date" value="<?php echo $last_date; ?>" required>
                            </div>

                            <div class="input-group mb-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" name="search" onClick="location.href=location.href" class="btn btn-outline-warning">Refresh</button>
                            </div>

                        </form>


                        <?php
                        if (is_post()) {

                            $ward       = $_POST['ward_id'];
                            $w          = Wards::find_by_id($ward);

                            $start_date = trim($_POST['startDate']);
                            $start_date = date("Y-m-d", strtotime($start_date));

                            $end_date = trim($_POST['endDate']);
                            $end_date = date("Y-m-d", strtotime($end_date));

                            $start_sec = "00:00:00";
                            $end_sec   = "23:59:59";
                            $startDate = $start_date . " " . $start_sec;
                            $endDate   = $end_date . " " . $end_sec;

                            $admission = ReferAdmission::find_discharge_by_ward($ward, $start_date, $end_date);
                          //  $admission = ReferAdmission::find_discharge($ward, $start_date, $end_date);

                            if (empty($admission)) {  ?>
                                <div class="alert alert-info alert-dismissible" role="alert" style="width: 800px">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    No discharge for <?php echo $w->ward_number ?> between <?php echo $start_date . " and " . $end_date  ?>
                                </div>
                            <?php  } else {  ?>
                                <div class="alert alert-success alert-dismissible" role="alert" style="width: 800px">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    All discharge between <?php echo $start_date . " and " . $end_date  ?>
                                </div>
                            <?php  } ?>
                            <div class="card">
                                <div class="body">
                                    <div class="table-responsive">
                                        <table class="table m-b-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Folder No.</th>
                                                    <th>Patients</th>
                                                    <th>Ward</th>
                                                    <th>Admitted By</th>
                                                    <th>Admission Date</th>
                                                    <th>Discharge Date</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (is_post()) {
                                                    foreach ($admission as $adm) {
                                                        $patient     = Patient::find_by_id($adm->patient_id);
                                                        $ward        = Wards::find_by_id($adm->ward_no);
                                                        $userConsult = User::find_by_id($adm->Consultantdr);
                                                ?>
                                                        <tr>
                                                            <td><?php echo $index++; ?></td>
                                                            <td><a href='patient_detail.php?id=<?php echo $adm->id ?>'><?php echo $patient->folder_number ?></a></td>
                                                            <td><?php echo $patient->full_name()  ?></td>
                                                            <td><?php echo $ward->ward_number ?></td>
                                                            <td><?php echo $userConsult->full_name()  ?> </td>
                                                            <td><?php $d_date = date('d/m/Y', strtotime($adm->adm_date));
                                                                echo $d_date ?></td>
                                                            <td><?php $d_date = date('d/m/Y', strtotime($adm->discharge_date));
                                                                echo $d_date ?></td>
                                                                
                                                        </tr>

                                                <?php
                                                    }
                                                }  ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        <?php }  ?>















                    </div>

                </div>
            </div>
        </div>




    </div>
</div>




<?php
require('../layout/footer.php');
