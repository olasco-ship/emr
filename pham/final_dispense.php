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

$user = User::find_by_id($session->user_id);

//echo $user->unit;  exit;





$errMessage = "";
$errDrug    = "";

if (is_post()) {

    $service = DrugServices::find_by_id($_GET['id']);
    $request = DrugRequest::find_by_id($service->drug_request_id);
    $patient = Patient::find_by_id($request->patient_id);

    $pharmStation = PharmacyStation::find_station_by_name($user->unit);
  //  $station_id = $_POST['station_id'];
  //  echo $station_id; exit;

    $decode = json_decode($service->services);

    if (!empty($pharmStation)) {
        foreach ($decode as $item) {
            $it = explode( ',', $item);
            $eachDrug = EachDrug::find_by_name_and_request_id($it[0], $service->drug_request_id);
            //  $pharmStationProduct = ProductPharmacyStation::find_by_product_and_station($eachDrug->product_id, $station_id);
            $pharmStationProduct = ProductPharmacyStation::find_by_product_and_station($eachDrug->product_id, $pharmStation->id);

            if (!empty($pharmStationProduct)){
                if ($pharmStationProduct->quantity >= $eachDrug->quantity) {
                    $pharmStationProduct->quantity -= $eachDrug->quantity;
                    //   $pharmStationProduct->save();
                    $eachDrug->status = "DISPENSED";
                    //  $eachDrug->save();
                }  else {
                    $errDrug  .= " The prescribed quantity is more than the available quantity for $it[0] " . "<br/>";
                }
            } else {
                $errDrug  .= " $it[0] not available at Dispensary" . "<br/>";
            }
        }
    } else {
        $errDrug .= "User is not attached to any Dispensary Unit!". "<br/>";
    }



   
     $errMessage .= $errDrug;

  //   echo $errMessage;   exit;
    if (empty($errMessage)) {
        foreach ($decode as $item) {
            $it = explode( ',', $item);
            $eachDrug = EachDrug::find_by_name_and_request_id($it[0], $service->drug_request_id);
            $pharmStationProduct = ProductPharmacyStation::find_by_product_and_station($eachDrug->product_id, $pharmStation->id);

            if (!empty($pharmStationProduct)){
                if ($pharmStationProduct->quantity >= $eachDrug->quantity) {
                    $pharmStationProduct->quantity  -= $eachDrug->quantity;
               //     $pharmStationProduct->pharmacist = $user->full_name();
                    $pharmStationProduct->save();
                    $eachDrug->pharmacy = $user->full_name();
                    $eachDrug->status = "DISPENSED";
                    $eachDrug->save();
                }
            }
        }

        $service = DrugServices::find_by_id($_GET['id']);
        $service->status  = "DISPENSED";
        $service->save();
        redirect_to("dispensed.php");
    }



}






require('../layout/header.php');

?>









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

                                        if (is_post()) { 
                                            if (!empty($errMessage)) { 
                                            ?>
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                    aria-hidden="true">&times;</span></button>
                                            <?php echo $errMessage; ?>
                                        </div>


                                  <?php   } }   ?>
                                     
                                

                                    <table>

                                        <tr>
                                            <td><b>Patient </b></td>
                                            <td style='padding-left: 100px'><?php

                                                 echo $patient->full_name();
                                                ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><b> Folder Number </b></td>
                                            <td style='padding-left: 100px'><?php
                                                $patient = Patient::find_by_id($request->patient_id);
                                                echo $patient->folder_number; ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><b> Ward/Clinic  </b></td>
                                            <td style='padding-left: 100px'><?php
                                                echo $service->ward_clinic
                                                 ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><b> Consultant  </b></td>
                                            <td style='padding-left: 100px'><?php
                                                echo $request->consultant
                                                 ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><b> Prescription Date  </b></td>
                                            <td style='padding-left: 100px'><?php
                                                $d_date = date('d/m/Y h:i a', strtotime($request->date));
                                                echo $d_date;
                                                 ?>
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
                                         
                                            $decode = json_decode($service->services);


/*                                            print_r($decode);
                                            echo "<br/>";
                                                 foreach($decode as $item){
                                                     $it = explode( ',', $item);
                                                    echo $it[0] . "<br/>";
                                                }
                                                 exit;
*/


                                            foreach ($decode as $item) {
                                                $it = explode( ',', $item);
                                                $eachDrug = EachDrug::find_by_name_and_request_id($it[0], $service->drug_request_id);
                                               
                                               // $product = Product::find_by_id($e->product_id);

                                             
                                            ?>
                                                <tr>
                                                    <td><?php echo $eachDrug->product_name; ?></td>
                                                    <td> <?php echo $eachDrug->quantity; ?></td>
                                                    <td><?php  echo $eachDrug->dosage;   ?></td>
                                                    <td><?php  echo $eachDrug->duration;   ?></td>
                                                </tr>

                                            <?php
                                            }   ?>



                                    </table>

                                    <!--
                                    <table>
                                        <tr>
                                            <td><b>Biller</b></td>
                                            <td style='padding-left: 90px;'><?php  echo $bill->revenue_officer; ?></td>
                                        </tr>


                                        <tr>
                                            <td><b>Bill Date</b></td>
                                            <td style='padding-left: 90px'>
                                                <?php
                                                $d_date = date('d/m/Y h:i a', strtotime($service->date));
                                                echo $d_date; ?>
                                            </td>
                                        </tr>

                                    </table>
                                    -->

                                </div>

                                <form class="form-inline" id="basic-form" action="" method="post">
                                    <div class="form-group">
                                      <!--  <select class="form-control" id="station_id" name="station_id" required>
                                            <option value="">--Select Dispensary--</option>
                                            <?php
/*                                            $finds = PharmacyStation::find_all();
                                            foreach ($finds as $find) { */?>
                                                <option value="<?php /*echo $find->id; */?>"><?php /*echo $find->name; */?></option>
                                            <?php /*} */?>
                                        </select>-->
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



































<?php

require('../layout/footer.php');
