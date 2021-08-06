<?php

/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/15/2019
 * Time: 12:51 PM
 */


require_once("../includes/initialize.php");

if (($user->role == 'Super Admin') or ($user->department == 'Pharmacy')) {
    redirect_to(emr_lucid);
}

$service = DrugServices::find_by_id($_GET['id']);
$request = DrugRequest::find_by_id($service->drug_request_id);
$patient = Patient::find_by_id($request->patient_id);









require('../layout/header.php');

?>






    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>
                            View Dispensed Drugs </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="storage.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Pharmacy</li>
                            <li class="breadcrumb-item active"> Dispensed </li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="body">
                            <a style="font-size: larger" href="dispensed.php">&laquo;Back</a>


                            <h3>Prescription Sheet Analysis</h3>

                            <div>

                                <table class="table table-bordered table-condensed table-hover">

                                    <form action="" method="post">
                                        <thead>

                                        <tr>
                                            <th>Patient Name</th>
                                            <td colspan="3">
                                                <?php echo $patient->full_name() ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Folder Number</th>
                                            <td colspan="3">
                                                <?php echo $patient->folder_number ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Physician</th>
                                            <td colspan="3">
                                                <?php echo $request->consultant ?>
                                            </td>
                                        </tr>

                                    <!--    <tr>
                                            <th> Dispensary </th>
                                            <td colspan="3">
                                                <?php /*$station = PharmacyStation::find_by_id($service->pharm_station_id);
                                                echo $station->name
                                                */?>
                                            </td>
                                        </tr>-->

                                        <tr>
                                            <th>Drug(s)</th>
                                            <th>Dosage</th>
                                            <th>Qty</th>
                                            <th> Duration</th>
                                        </tr>
                                        </thead>

                                        <tbody>

                                        <?php

                                        $each = EachDrug::find_all_dispensed($request->id);
                                     //   $decoded = json_decode($dispensed->items);
                                        foreach ($each as $item) {   ?>
                                            <tr>
                                                <td><?php echo $item->product_name ?>
                                                    <input type='text' class='form-control' name='drug[]' value='<?php echo $item->product_name ?>' style='width:300px;' hidden>
                                                </td>
                                                <td>
                                                    <?php echo $item->dosage ?>
                                                </td>
                                                <td>
                                                    <?php echo $item->quantity ?>
                                                </td>
                                                <td>
                                                    <?php echo $item->duration ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                   <!--     <tr>
                                            <td colspan="4"><textarea class='form-control' rows='2' cols='70' placeholder='Prescription Note' name='doc_com'></textarea></td>
                                        </tr>-->

                                        <tr>
                                            <td colspan="4"><button type="submit" class="btn btn-success"> Print Prescription </button></td>
                                        </tr>

                                        </tbody>
                                    </form>
                                </table>

                            </div>





                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>






    <!--


    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>
                            Drugs To Dispense </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="storage.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Pharmacy</li>
                            <li class="breadcrumb-item active">Awaiting Service</li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="body">

                            <div class="row">

                                <div class="col-sm-6">

                                    <a style="font-size: larger" href="../pham/dispense_service.php">&laquo;Back</a>

                                    <div id="body">



                                        <?php
/*
                                        if (is_post()) {
                                            if (!empty($errMessage)) {
                                                */?>
                                                <div class="alert alert-danger alert-dismissible" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                            aria-hidden="true">&times;</span></button>
                                                    <?php /*echo $errMessage; */?>
                                                </div>


                                            <?php /*  } }   */?>



                                        <table>

                                            <tr>
                                                <td><b>Patient </b></td>
                                                <td style='padding-left: 100px'><?php
/*
                                                    echo $patient->full_name();
                                                    */?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><b> Folder Number </b></td>
                                                <td style='padding-left: 100px'><?php
/*                                                    $patient = Patient::find_by_id($request->patient_id);
                                                    echo $patient->folder_number; */?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><b> Ward/Clinic  </b></td>
                                                <td style='padding-left: 100px'><?php
/*                                                    echo $service->ward_clinic
                                                    */?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><b> Consultant  </b></td>
                                                <td style='padding-left: 100px'><?php
/*                                                    echo $request->consultant
                                                    */?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><b> Prescription Date  </b></td>
                                                <td style='padding-left: 100px'><?php
/*                                                    $d_date = date('d/m/Y h:i a', strtotime($request->date));
                                                    echo $d_date;
                                                    */?>
                                                </td>
                                            </tr>



                                        </table>

                                        <table class="table table-bordered table-condensed table-hover">
                                            <thead>
                                            <tr>
                                                <th>Prescription(s)</th>
                                                <th>Quantity</th>
                                                <th>Dosage</th>
                                                <th>Duration</th>

                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
/*
                                            $decode = json_decode($service->services);

                                            foreach ($decode as $item) {
                                                $it = explode( ',', $item);
                                                $eachDrug = EachDrug::find_by_name_and_request_id($it[0], $service->drug_request_id);

                                                */?>
                                                <tr>
                                                    <td><?php /*echo $eachDrug->product_name; */?></td>
                                                    <td> <?php /*echo $eachDrug->quantity; */?></td>
                                                    <td><?php /* echo $eachDrug->dosage;   */?></td>
                                                    <td><?php /* echo $eachDrug->duration;   */?></td>
                                                </tr>

                                                <?php
/*                                            }   */?>



                                        </table>


                                    </div>

                                    <form class="form-inline" id="basic-form" action="" method="post">
                                        <div class="form-group">
                                            <select class="form-control" id="station_id" name="station_id" required>
                                                <option value="">--Select Dispensary--</option>
                                                <?php
/*                                                $finds = PharmacyStation::find_all();
                                                foreach ($finds as $find) { */?>
                                                    <option value="<?php /*echo $find->id; */?>"><?php /*echo $find->name; */?></option>
                                                <?php /*} */?>
                                            </select>
                                            <button type="submit" name="dispense" class="btn btn-outline-primary"> Dispense Drugs</button>
                                        </div>
                                    </form>


                                </div>
                                <div class="col-sm-3"></div>
                                <div class="col-sm-3"></div>

                            </div>


                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>



-->































<?php

require('../layout/footer.php');
