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







$errMessage = "";
$errDrug    = "";

if (is_post()) {

    $service = DrugServices::find_by_id($_GET['id']);
    $request = DrugRequest::find_by_id($service->drug_request_id);
    $patient = Patient::find_by_id($request->patient_id);
    $station_id = $_POST['station_id'];

    $decode = json_decode($service->services);

    foreach ($decode as $item) {
        $eachDrug = EachDrug::find_by_name_and_request_id($item, $service->drug_request_id);
        $pharmStationProduct = ProductPharmacyStation::find_by_product_and_station($eachDrug->product_id, $station_id);

        if (!empty($pharmStationProduct)){
          //  echo "yes"; exit;
            if ($pharmStationProduct->quantity >= $eachDrug->quantity) {
                $pharmStationProduct->quantity -= $eachDrug->quantity;
           //     echo $pharmStationProduct->quantity; exit;
                $pharmStationProduct->save();
                $eachDrug->status = "DISPENSED";
                $eachDrug->save();
            } 
        } else {  // echo "no"; exit;
            $errDrug  .= " $item not available at Dispensary" . "<br/>";
        }
    }
   
     $errMessage .= $errDrug;

  //   echo $errMessage;   exit;
    if (empty($errMessage)) {
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
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <!-- <h2>Basic Example 8</h2>-->
                    </div>
                    <div class="body">

                        <div class="row">

                            <div class="col-sm-6">

                                <a style="font-size: larger" href="../pharm/dispense_service.php">&laquo;Back</a>

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

                                            /*
                                            print_r($decode) ;
                                            foreach($decode as $item){
                                                echo $item . "<br/>";
                                            }
                                            exit;
                                            */

                                            foreach ($decode as $item) {
                                                $eachDrug = EachDrug::find_by_name_and_request_id($item, $service->drug_request_id);
                                               
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
                                        <select class="form-control" id="station_id" name="station_id" required>
                                            <option value="">--Select Dispensary--</option>
                                            <?php
                                            $finds = PharmacyStation::find_all();
                                            foreach ($finds as $find) { ?>
                                                <option value="<?php echo $find->id; ?>"><?php echo $find->name; ?></option>
                                            <?php } ?>
                                        </select>
                                        <button type="submit" name="dispense" class="btn btn-outline-primary"> Dispense Drugs</button>
                                    </div>
                                </form>

                                <!--
                            <form class="form-inline" action="" method="post" id="formDispense">
                                <input type="hidden" value="<?php echo $bill->id; ?>"  id="billId"/>
                                <button type="submit" id="submit" class="btn btn-lg btn-success"
                                        data-loading-text="Searching...">Dispense
                                </button>
                            </form>
                            -->

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
