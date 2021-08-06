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

$array = StockBill::get_bill();
if (empty($array)) {
    redirect_to("flow_one.php");
}



/*
if (($user->role == 'Super Admin') OR ($user->department == 'Pharmacy')){
    redirect_to(emr_lucid );
}
*/

$index = 1;


$array = StockBill::get_bill();





if (is_post()) {

    $pharmacist   = $_POST['pharmacy'];
    $station      = $_POST['station'];

    $drug         = $_POST['drug'];
    $carton       = $_POST['carton'];
    $no_carton    = $_POST['no_carton'];
    $quantity     = $_POST['quantity'];
    $batch_qty    = $_POST['batch'];
    $selling_price = $_POST['selling_price'];

    $new_array = array();
    for ($x = 0; $x < count($drug); $x++) {
        $new_array[$x] = array(
            'name'          => $drug[$x],
            'Carton'        => $carton[$x],
            'NoInCarton'    => $no_carton[$x],
            'quantity'      => $quantity[$x],
            'batch'         => $batch_qty[$x],
            'selling_price' => $selling_price[$x]
        );
    }

    $json     = json_encode($array);
    $json_two = json_encode($new_array);

    //  $user = User::find_by_id($pharmacy);



    $array = StockBill::get_bill();
    foreach ($new_array as $item) {
        $product = StockItems::find_by_name($item['name']);

        $countProductBatch = StockBatch::countProductBatches($product->id);
        $sumProductQty     = StockBatch::sumProductQuantity($product->id);
        $selectedBatchQty  = $item['batch'];
        $totalQty          = $item['Carton'] * $item['NoInCarton'] + $item['quantity'];

        if ($totalQty > $selectedBatchQty) {
            $errorMessage = "You cannot assign drugs greater than quantity in the Batch" . "<br/>";
        } else {
            $station_prod = ProductPharmacyStation::find_by_product_and_station($product->id, $station);
            if (empty($station_prod)) {
                $productPharmacyStation                      = new ProductPharmacyStation();
                $productPharmacyStation->sync                = "off";
                $productPharmacyStation->product_id          = $product->id;
                $productPharmacyStation->pharmacy_station_id = $station;
                $productPharmacyStation->selling_price       = $item['selling_price'];
                $productPharmacyStation->quantity            = $totalQty;
                $productPharmacyStation->date                = strftime("%Y-%m-%d %H:%M:%S", time());
                $productPharmacyStation->save();
            } else {
                $station_prod->quantity        += $totalQty;
                $station_prod->selling_price    = $item['selling_price'];
                $station_prod->save();
            }
            $productBatch            = StockBatch::find_product_expiring($product->id);
            $productBatch->quantity -= $totalQty;
            if ($productBatch->quantity == 0){
                $productBatch->delete();
            }
            $productBatch->save();
        }
    }
    if (empty($errorMessage)) {
        $dispenseHistory                      = new StoreDispenseHistory();
        $dispenseHistory->sync                = "off";
        $dispenseHistory->items               = $json_two;
        $dispenseHistory->item_count          = count($array);
        $dispenseHistory->dispenser           = $user->full_name();
        $dispenseHistory->dispense_to         = $pharmacist;
        $dispenseHistory->pharmacy_station_id = $station;
        $dispenseHistory->date                = strftime("%Y-%m-%d %H:%M:%S", time());
        $dispenseHistory->save();
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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Pharmacy</h2>
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
                                    <a style="font-size: large" href="flow_one.php">Back</a>
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

                                            $array = StockBill::get_bill();
                                            foreach ($array as $drug) {
                                                $product = StockItems::find_by_name($drug->name);
                                                $productBatch = StockBatch::find_product_expiring($product->id);
                                                ?>
                                                <tr>
                                                    <td><?php echo $index++; ?></td>
                                                    <td><?php echo $drug->name ?>
                                                        <input type='text' class='form-control' name='drug[]' value='<?php echo $drug->name ?>' style='width:300px;' hidden>
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
                                                    <td><input type='text' class='form-control' name='carton[]' value='' style='width:100px;'></td>
                                                    <td>
                                                        <input type='text' class='form-control' name='no_carton[]' value='' style='width:100px;'>
                                                    </td>
                                                    <td><input type='text' class='form-control' name='quantity[]' value='' style='width:100px;'> </td>

                                                </tr>
                                            <?php } ?>
                                            <tr>
                                                <th colspan="6">
                                                    <select class="form-control" name="station" required>
                                                        <option value=""><strong>--Select Dispensary Point--</strong></option>
                                                        <?php
                                                        $station = PharmacyStation::find_all();
                                                        foreach ($station as $s) {
                                                            ?>
                                                            <option value="<?php echo $s->id; ?>"><?php echo $s->name; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </th>
                                            </tr>

                                   <!--         <tr>
                                                <th colspan="6">
                                                    <input type='text' placeholder="Receiver's Name" class='form-control' name='pharmacy' value='' required>
                                                </th>
                                            </tr>
-->
                                            <tr>
                                                <th colspan="6">
                                                    <select class="form-control" name="pharmacy">
                                                        <option value="">--Select Receiving Pharmacy--</option>
                                                        <?php
                                                        $department = "Pharmacy";  $profession = "Dispensary";
                                                     //   $pharmacists = User::find_by_department_profession($department, $profession);
                                                          $pharmacists = User::find_by_department($department);
                                                        foreach ($pharmacists as $pharmacist) {
                                                            ?>
                                                            <option value="<?php echo $pharmacist->full_name(); ?>"><?php echo $pharmacist->full_name(); ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </th>
                                            </tr>


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
