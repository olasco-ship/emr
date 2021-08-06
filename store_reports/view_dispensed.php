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


$dispensed = Dispensed::find_by_id($_GET['id']);




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
                        <a style="font-size: larger" href="act_rep.php">&laquo;Back</a>


                        <h3>Prescription Sheet Analysis</h3>

                        <div>

                            <table class="table table-bordered table-condensed table-hover">

                                <form action="" method="post">

                                    <thead>

                                    <?php
                                    $service = DrugServices::find_by_id($_GET['id']);
                                    $request = DrugRequest::find_by_id($service->drug_request_id);
                                    $patient = Patient::find_by_id($request->patient_id);
                                    $product = ProductPharmacyStation::find_by_id($_GET['id']);

                                    ?>

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

                                        <tr>
                                            <th> Dispensary </th>
                                            <td colspan="3">
                                                <?php /*$pharm = PharmacyStation::find_by_id($product->pharm_station_id);
                                                    echo $pharm->name;
                                                */?>
                                            </td>

                                        </tr>


                                        <tr>
                                            <th>Drug(s)</th>
                                            <th>Dosage</th>
                                            <th>Qty</th>
                                            <th> Duration</th>
                                        </tr>


                                    </thead>

                                    <tbody>

                                        <?php

                                          //  echo $dispensed->items; echo "<br/>";

                                            $decoded = json_decode($service->services);
                                         //   print_r($decoded);
                                        foreach ($decoded as $item) {
                                            $it = explode( ',', $item);
                                            $eachDrug = EachDrug::find_by_name_and_request_id($it[0], $service->drug_request_id);
                                            ?>
                                            <tr>
                                                <td><?php echo $eachDrug->product_name ?>
                                                    <input type='text' class='form-control' name='drug[]' value='<?php echo $eachDrug->name ?>' style='width:300px;' hidden>
                                                </td>
                                                <td>
                                                    <?php echo $eachDrug->dosage ?>
                                                </td>
                                                <td>
                                                     <?php echo $eachDrug->quantity ?>
                                                </td>
                                                <td>
                                                     <?php echo $eachDrug->duration ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <td colspan="4"><textarea class='form-control' rows='2' cols='70' placeholder='Prescription Note' name='doc_com'></textarea></td>
                                        </tr>

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











<?php

require('../layout/footer.php');
