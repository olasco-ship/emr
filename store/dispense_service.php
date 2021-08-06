<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/15/2019
 * Time: 12:51 PM
 */


require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

if (($user->role == 'Super Admin') OR ($user->department == 'Store')) {
    redirect_to(emr_lucid);
}

$index = 1;


require('../layout/header.php');
?>


    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                                        class="fa fa-arrow-left"></i></a>
                            Items To Dispense </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="storage.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Store</li>
                            <li class="breadcrumb-item active">Awaiting Service</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="body">

                            <a style="font-size: larger" href="storage.php">&laquo;Back</a>

<!--                            <form class="form-inline" id="basic-form" action="" method="post">
                                <div class="form-group">
                                    <select class="form-control" id="station_id" name="station_id" required>
                                        <option value="">--Select Dispensary--</option>
                                        <?php
/*                                        $finds = PharmacyStation::find_all();
                                        foreach ($finds as $find) { */?>
                                            <option value="<?php /*echo $find->id; */?>"><?php /*echo $find->name; */?></option>
                                        <?php /*} */?>
                                    </select>
                                    <button type="submit" name="select_dispensary" class="btn btn-outline-primary">
                                        Select Dispensary
                                    </button>
                                    <button type="button" name="search" onClick="location.href=location.href"
                                            class="btn btn-outline-warning">Refresh
                                    </button>
                                </div>
                            </form>
-->
                            <br/>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel-content">
                                        <!--          <h3 class="heading"><i class="fa fa-square"></i> Recent Purchases</h3>   -->
                                        <div class="table-responsive">
                                            <table class="table table-striped no-margin">
                                                <thead class="thead-purple">
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Nurse Name</th>
                                                    <th>Clinic/Ward</th>
<!--                                                    <th>Consultant</th>-->
                                                    <!-- <th>Amount(s)</th>-->
                                                    <th></th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $drugService = StockServices::find_cleared();
                                                foreach ($drugService as $service) {
                                                    $request = StockRequest::find_by_id($service->drug_request_id);
                                                    //$patient = User::find_by_id($request->nurse_id);
                                                    $nurse = User::find_by_id($request->nurse_id);
                                                    $clinic  = Clinic::find_by_id($request->sub_clinic_id);

                                                    ?>
                                                    <tr>
                                                        <td><?php echo $index++ ?></td>
                                                        <td><?php echo $nurse->full_name() ?></td>
                                                        <td><?php echo $clinic->name ?></td>
<!--                                                        <td>--><?php //echo $request->consultant ?><!--</td>-->
                                                        <!--        <td><?php // echo "₦$bill->total_price" ?></td>    -->
                                                        <td><a href="testing2.php?id=<?php echo $service->id ?>">Dispense</a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
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


<?php

require('../layout/footer.php');


