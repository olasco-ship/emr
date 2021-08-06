<?php

/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 5/18/2019
 * Time: 1:41 PM
 */


require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$user = User::find_by_id($session->user_id);

$service = StockServices::find_by_id($_GET['id']);
$request = StockRequest::find_by_id($service->drug_request_id);
$clinic  = Clinic::find_by_id($request->sub_clinic_id);
$patient = User::find_by_id($request->nurse_id);

//print_r($patient->full_name()); exit();

//$array = StockBill::get_bill();
//if (empty($array)) {
//    redirect_to("dispense_service.php");
//}



/*
if (($user->role == 'Super Admin') OR ($user->department == 'Pharmacy')){
    redirect_to(emr_lucid );
}
*/

//$errMessage = "";
//$errDrug    = "";

$index = 1;


$array = StockBill::get_bill();

if (is_post()) {

    $service = StockServices::find_by_id($_GET['id']);
    $request = StockRequest::find_by_id($service->drug_request_id);
    $clinic  = Clinic::find_by_id($request->sub_clinic_id);
    $patient = User::find_by_id($request->nurse_id);

    //print_r($clinic->name); exit();

    $decode = json_decode($service->services);

    //$pharmacist   = $_POST['pharmacy'];
    //$station      = $_POST['station'];

    $drug         = $_POST['drug'];
    $carton       = $_POST['carton'];
    $no_carton    = $_POST['no_carton'];
    $quantity     = $_POST['quantity'];
    $batch_qty    = $_POST['batch'];
    $selling_price = $_POST['selling_price'];

    $array = StockBill::get_bill();
    $new_array = array();
    if (!empty($clinic)) {
        foreach ($decode as $item) {
            $it = explode(',', $item);
            $eachDrug = EachItem::find_by_name_and_request_id($it[0], $service->drug_request_id);
        }
//        foreach ($array as $item) {
            for ($x = 0; $x < count($drug); $x++) {
                $new_array[$x] = array(
                    'name' => $drug[$x],
                    'Carton' => $carton[$x],
                    'NoInCarton' => $no_carton[$x],
                    'quantity' => $quantity[$x],
                    'batch' => $batch_qty[$x],
                    'selling_price' => $selling_price[$x]
                );
            }
//        }


        $json = json_encode($array);
        $json_two = json_encode($new_array);


        //  $user = User::find_by_id($pharmacy);

        $array = StockBill::get_bill();
        foreach ($new_array as $item) {
            $product = StockItems::find_by_name($item['name']);
            //$eachDrug1 = EachItem::find_by_name_and_request_id($product, $service->id);

            //$countProductBatch = StockBatch::countProductBatches($product->id);
            //$sumProductQty     = StockBatch::sumProductQuantity($product->id);

            $countProductBatch = StockBatch::countProductBatches($eachDrug->product_id);
            $sumProductQty = StockBatch::sumProductQuantity($eachDrug->product_id);
            $selectedBatchQty = $item['batch'];
            $totalQty = $item['Carton'] * $item['NoInCarton'] + $item['quantity'];

            //print_r($totalQty); exit();

            if ($totalQty > $selectedBatchQty) {
                $errorMessage = "You cannot assign items greater than quantity in the Batch" . "<br/>";
            } else {
                $station_prod = ItemStoreStation::find_by_product_and_station($eachDrug->product_id, $clinic->id);
                if (empty($station_prod)) {
                    $productPharmacyStation = new ItemStoreStation();
                    $productPharmacyStation->sync = "off";
                    $productPharmacyStation->product_id = $eachDrug->product_id;
                    $productPharmacyStation->station_id = $clinic->id;
                    $productPharmacyStation->selling_price = $item['selling_price'];
                    $productPharmacyStation->name          = $product->name;
                    $productPharmacyStation->quantity = $totalQty;
                    $productPharmacyStation->date = strftime("%Y-%m-%d %H:%M:%S", time());
                    $productPharmacyStation->save();
                } else {
                    $station_prod->quantity += $totalQty;
                    $station_prod->selling_price = $item['selling_price'];
                    $station_prod->save();
                }
                $productBatch = StockBatch::find_product_expiring($eachDrug->product_id);
                //print_r($eachDrug->product_name); exit();
                $productBatch->quantity -= $totalQty;
                //$productBatch->quantity -= $eachDrug->quantity;
                if ($productBatch->quantity == 0) {
                    $productBatch->delete();
                }
                $productBatch->save();
            }
        }

    }
    if (empty($errorMessage)) {
        $dispenseHistory                      = new StoreDispenseHistory();
        $dispenseHistory->sync                = "off";
        $dispenseHistory->items               = $json_two;
        $dispenseHistory->item_count          = count($new_array);
        $dispenseHistory->dispenser           = $user->full_name();
        $dispenseHistory->dispense_to         = $patient->full_name();
        $dispenseHistory->station_id          = $clinic->id;
        $dispenseHistory->date                = strftime("%Y-%m-%d %H:%M:%S", time());
        $dispenseHistory->save();

        $service->status                      = "DISPENSED";
        $service->save();

        StockBill::clear_all_bill();
        redirect_to("print_dispense.php?id=$dispenseHistory->id");
    }


}






require('../layout/header.php');
?>










    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Store</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dispensary.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active">Dispensary</li>
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
                                    <a style="font-size: large" href="dispense_service.php">Back</a>
                                    <form method="post" action="">

                                        <?php
                                        if (is_post()) {
                                            if (!empty($errorMessage)) {  ?>
                                                <div class="alert alert-warning alert-dismissible" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <?php echo $errorMessage; ?>
                                                </div>
                                            <?php   }
                                        }
                                        ?>

                                        <table class="table table-bordered table-condensed table-hover">
                                            <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Drug(s)</th>
                                                <th>Batch Qty</th>
                                                <th>Carton(s)</th>
                                                <th>No. In Carton</th>
                                                <th>Unit Quantity</th>

                                            </tr>
                                            </thead>

                                            <tbody>
                                            <?php

                                            $decode = json_decode($service->services);

                                            foreach ($decode as $item) {
                                                $it = explode( ',', $item);
                                                $eachDrug = EachItem::find_by_name_and_request_id($it[0], $service->drug_request_id);

                                                // $product = Product::find_by_id($e->product_id);

//                                                        $array = StockBill::get_bill();
//                                                        foreach ($array as $drug) {
//                                                        $product = StockItems::find_by_name($drug->name);
//                                                        $eachDrug = EachItem::find_by_name_and_request_id($product, $service->id);
                                                $productBatch = StockBatch::find_product_expiring($eachDrug->product_id);
                                                ?>
                                                <tr>
                                                    <td><?php echo $index++; ?></td>
                                                    <td><?php echo $eachDrug->product_name ?>
                                                        <input type='text' class='form-control' name='drug[]' value='<?php echo $eachDrug->product_name ?>' style='width:300px;' hidden>
                                                    </td>
                                                    <td> <input type='text' class='form-control' name='selling_price[]' value='<?php echo $productBatch->selling_price  ?>' style='width:300px;' hidden>
                                                        <select class="form-control" name="batch[]" required>
                                                            <option value=""><strong>--Select Batch Qty--</strong></option>
                                                            <?php
                                                            //   foreach ($productBatch as $pB) {
                                                            ?>
                                                            <option value="<?php echo $productBatch->quantity; ?>"><?php echo $productBatch->quantity; ?></option>
                                                            <?php
                                                            //    }
                                                            ?>
                                                        </select>
                                                    </td>
                                                    <td><input type='text' class='form-control' name='carton[]' value='' style='width:100px;' required></td>
                                                    <td>
                                                        <input type='text' class='form-control' name='no_carton[]' value='' style='width:100px;' required>
                                                    </td>
                                                    <td><input type='text' class='form-control' name='quantity[]' value='<?php echo $eachDrug->quantity ?>' style='width:100px;' required> </td>

                                                </tr>
                                            <?php } ?>
                                            <!--                                            <tr>-->
                                            <!--                                                <th colspan="6">-->
                                            <!--                                                    <select class="form-control" name="station" required>-->
                                            <!--                                                        <option value=""><strong>--Select Dispensary Point--</strong></option>-->
                                            <!--                                                        --><?php
                                            //                                                        $station = PharmacyStation::find_all();
                                            //                                                        foreach ($station as $s) {
                                            //                                                            ?>
                                            <!--                                                            <option value="--><?php //echo $s->id; ?><!--">--><?php //echo $s->name; ?><!--</option>-->
                                            <!--                                                            --><?php
                                            //                                                        }
                                            //                                                        ?>
                                            <!--                                                    </select>-->
                                            <!--                                                </th>-->
                                            <!--                                            </tr>-->

                                            <!--         <tr>
                                                         <th colspan="6">
                                                             <input type='text' placeholder="Receiver's Name" class='form-control' name='pharmacy' value='' required>
                                                         </th>
                                                     </tr>
         -->
                                            <!--                                            <tr>-->
                                            <!--                                                <th colspan="6">-->
                                            <!--                                                    <select class="form-control" name="pharmacy">-->
                                            <!--                                                        <option value="">--Select Receiving Pharmacy--</option>-->
                                            <!--                                                        --><?php
                                            //                                                        $department = "Pharmacy";  $profession = "Dispensary";
                                            //                                                        //   $pharmacists = User::find_by_department_profession($department, $profession);
                                            //                                                        $pharmacists = User::find_by_department($department);
                                            //                                                        foreach ($pharmacists as $pharmacist) {
                                            //                                                            ?>
                                            <!--                                                            <option value="--><?php //echo $pharmacist->full_name(); ?><!--">--><?php //echo $pharmacist->full_name(); ?><!--</option>-->
                                            <!--                                                            --><?php
                                            //                                                        }
                                            //                                                        ?>
                                            <!--                                                    </select>-->
                                            <!--                                                </th>-->
                                            <!--                                            </tr>-->


                                            </tbody>


                                        </table>
                                        <button type="submit" class="btn btn-success"> Save To Dispense </button>
                                    </form>

                                </div>

                                <!--
                            <div class="col-md-5">
                                <?php

                                /*
                                  print_r($array);
                                  echo "<br/>"; echo "<br/>";
                                  $json = json_encode($array);
                                  echo $json;
                                  echo "<br/>"; echo "<br/>";
                                  echo count($array);
                                  echo "<br/>"; echo "<br/>";
                                  echo $user->full_name();
                                  */



                                ?>
                            </div>
                            -->

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>




<?php
require('../layout/footer.php');


