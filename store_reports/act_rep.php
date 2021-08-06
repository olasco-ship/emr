<?php
require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$index = 1;

//$user = User::find_by_id($_GET('id'));

/*if (($user->role == 'Super Admin') OR ($user->department == 'Pharmacy')){
    redirect_to(emr_lucid );
}*/






require('../layout/header.php');
?>



<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Reports</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active">Activity Reports</li>
                    </ul>
                </div>
              
            </div>
        </div>

        <div class="row clearfix">

            <div class="col-lg-12 col-md-12">
                <div class="card">

                    <div class="body">
                        <a href="../pham/dispensary.php" style="font-size: large">&laquo; Back</a>

                        <h4> Activity Report (All Dispensed Reports) </h4>

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

                            $dispensed = StockServices::find_dispensed_by_date($startDate, $endDate);
                            if (empty($dispensed)) {  ?>
                                <div  class="alert alert-info alert-dismissible" role="alert" style="width: 800px">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    No Drugs was dispensed for this period
                                </div>
                            <?php  } else {  ?>
                                <div  class="alert alert-success alert-dismissible" role="alert" style="width: 800px">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    All dispensed drugs between <?php echo $start_date ." and ". $end_date ?> 
                                </div>
                         <?php  } ?>         
                            <div class="card">
                                <div class="body">
                                    <div class="table-responsive">
                                        <table class="table m-b-0">
                                            <thead>
                                                <tr>
                                                    <th>Folder No.</th>
                                                    <th>Patient Name</th>
                                                    <th>Consultant</th>
                                                    <th>Pharmacist</th>
                                                    <th>Date</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (is_post()) {
                                                $drugService = DrugServices::find_dispensed();
                                                    foreach($drugService as $service) {
                                                        $request = DrugRequest::find_by_id($service->drug_request_id);
                                                        $patient = Patient::find_by_id($request->patient_id);
                                                        $pharm = ProductPharmacyStation::find_by_id($request->patient_id);

                                                        ?>
                                                    <tr>
                                                        <td><a href="view_dispensed.php?id=<?php echo $service->id ?>"> <?php echo $patient->folder_number ?> </a></td>
                                                        <td><?php echo $patient->full_name()  ?></td>
                                                        <td><?php echo $request->consultant ?></td>
                                                        <td><?php echo $pharm->pharmacist  ?></td>
                                                        <td><?php $d_date = date('d/m/Y h:i a', strtotime($request->date)); echo $d_date ?></td>
                                                        <td><a href="view_dispensed.php?id=<?php echo $service->id ?>"> View Dispensed </a></td>
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
