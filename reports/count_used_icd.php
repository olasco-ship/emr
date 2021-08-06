<?php
require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$index = 1;


$patient   = ICDCode::find_all();


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
                </div>
            </div>

            <div class="row clearfix">

                <div class="col-lg-12 col-md-12">
                    <div class="card">

                        <div class="body">
                            <a href="../reports/index.php" style="font-size: large">&laquo; Back</a>

                            <h4> All Coded Patient Report </h4>

                            <form class="form-inline" action="" method="post">

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
                                $start_date = trim($_POST['startDate']);
                                $start_date = date("Y-m-d", strtotime($start_date));

                                $end_date = trim($_POST['endDate']);
                                $end_date = date("Y-m-d", strtotime($end_date));

                                $start_sec = "00:00:00";
                                $end_sec   = "23:59:59";
                                $startDate = $start_date . " " . $start_sec;
                                $endDate   = $end_date . " " . $end_sec;

                                //$patient = CodedDiagnosis::find_all_by_date($startDate, $endDate);
                                //  $waiiting = WaitingList::find_all_by_date($startDate, $endDate);
                                if (empty($patient)) {  ?>
                                    <div  class="alert alert-info alert-dismissible" role="alert" style="width: 800px">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        No coding was done between this period
                                    </div>
                                <?php  } else {  ?>
                                    <div  class="alert alert-success alert-dismissible" role="alert" style="width: 800px">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        All folder coded between <?php echo $start_date ." and ". $end_date ?>
                                    </div>
                                <?php  } ?>
                                <div class="card">
                                    <div class="body">
                                        <div class="table-responsive">
                                            <table class="table m-b-0">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>ICD Code</th>
                                                    <th>ICD Description</th>
                                                    <th>Number</th>
                                                    <!--<th>Diagnose Code</th>
                                                    <th>Coded By</th>
                                                    <th>Date</th>-->

                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                if (is_post()) {
                                                    foreach ($patient as $pat) {
                                                        //$cd   = CodedDiagnosis::find_by_date($pat->id, $startDate, $endDate);
                                                        $code = CodedDiagnosis::count_used_icd_by_date($pat->id, $startDate, $endDate);
                                                        //$name = ICDCode::find_by_id($code);
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $index++; ?></td>
                                                            <td><a href='details.php?id=<?php echo $pat->id ?>'><?php echo $pat->code ?></a></td>
                                                            <td><?php echo $pat->name ?></td>
                                                            <td><?php echo $code  ?></td>
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


