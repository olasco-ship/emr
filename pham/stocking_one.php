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


$items = PatientBill::get_bill();


if ($_SERVER["REQUEST_METHOD"] == 'POST') {

    $drug        = $_POST['drug'];
    $cost_price  = $_POST['cost_price'];
    $quantity    = $_POST['quantity'];
    $carton      = $_POST['carton'];
    $no_carton   = $_POST['no_carton'];
    $batch_no    = $_POST['batch_no'];

    $man_date    = $_POST['man_date'];
    $exp_date    = $_POST['exp_date'];

    $new_array = array();
    for ($x = 0; $x < count($drug); $x++) {
        $new_array[$x] = array(
            'product_name' => $drug[$x],
            'cost_price'   => $cost_price[$x],
            'quantity'     => $quantity[$x],
            'Carton'       => $carton[$x],
            'NoInCarton'   => $no_carton[$x],
            'batch_no'     => $batch_no[$x],
            'man_date'     => $man_date[$x],
            'exp_date'     => $exp_date[$x]
        );
    }

    $name3        = 'MarkUp';
    $notification = Notification::find_by_name($name3);
    $markup       = $notification->value;


    $newStock                   = new StockIn();
    $newStock->sync             = "off";
    $newStock->code             = rand(10000, 99999);
    $newStock->items            = json_encode($new_array);
    $newStock->item_count       = count($new_array);
    $newStock->supplier         = $_POST['supplier'];
    $newStock->pharmacy_station = $_POST['station'];
    $newStock->receiver         = $user->full_name();
    $newStock->date             = strftime("%Y-%m-%d %H:%M:%S", time());
    $newStock->attach_file($_FILES['file_upload']);
    if ($newStock->save()) {
      //  $markup = 0.1;
        foreach ($new_array as $item) {
            $selling_price = ($item['cost_price'] * $markup) + $item['cost_price'];
            $selling_price = round($selling_price);
            $product                        = Product::find_by_name($item['product_name']);
            $newProductBatch                = new ProductBatch();
            $newProductBatch->sync          = "off";
            $newProductBatch->product_id    = $product->id;
            $newProductBatch->cost_price    = $item['cost_price'];
            $newProductBatch->quantity      = $item['Carton'] * $item['NoInCarton'] + $item['quantity'];
            $newProductBatch->markup        = $markup;
            $newProductBatch->selling_price = $selling_price;
            $newProductBatch->batch_no      = $item['batch_no'];
            $newProductBatch->man_date      = $item['man_date'];
            $newProductBatch->exp_date      = $item['exp_date'];
            $newProductBatch->created       = strftime("%Y-%m-%d %H:%M:%S", time());
            $newProductBatch->save();
        }
        PatientBill::clear_all_bill();
        redirect_to("../pham/stock_history.php");
    } else {
        $errorMessage = join("<br/>", $newStock->errors);
    }
}



//PatientBill::clear_all_bill();


require('../layout/header.php');
?>


    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>
                            Pharmacy </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active">Assign Drugs</li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="row clearfix">

                <div class="col-lg-12 col-md-12">
                    <div class="card">

                        <div class="body">

                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <a style="font-size: large;" href="stocking.php">Back</a>
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

                                    <div class="table-responsive">


                                        <table class="table table-bordered table-condensed table-hover">

                                            <thead>
                                            <tr>
                                                <th>Drug(s)</th>
                                                <th>Cost Price</th>
                                                <th>Quantity</th>
                                                <th>Carton(s)</th>
                                                <th>No. In Carton</th>
                                                <th>Batch No.</th>
                                                <th>Man. Date</th>
                                                <th>Exp. Date</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            <form action="" method="post" enctype="multipart/form-data">
                                                <?php
                                                $items = PatientBill::get_bill();
                                                foreach ($items as $item) {   ?>
                                                    <tr>
                                                        <td><?php echo $item->name ?>
                                                            <input type='text' class='form-control' name='drug[]' value='<?php echo $item->name ?>' style='width:300px;' hidden>
                                                        </td>
                                                        <td><input type='text' class='form-control' name='cost_price[]' value='' style='width:80px;'></td>
                                                        <td><input type='text' class='form-control' name='quantity[]' value='' style='width:80px;'></td>
                                                        <td><input type='text' class='form-control' name='carton[]' value='' style='width:80px;'></td>
                                                        <td><input type='text' class='form-control' name='no_carton[]' value='' style='width:80px;'></td>
                                                        <td><input type='text' class='form-control' name='batch_no[]' value='' style='width:100px;'></td>
                                                        <td><input type='date' class='form-control' name='man_date[]' value='' style='width:150px;'> </td>
                                                        <td><input type='date' class='form-control' name='exp_date[]' value='' style='width:150px;'> </td>
                                                    </tr>
                                                <?php } ?>
                                                <tr>
                                                    <th> Supplier's Name </th>
                                                    <td colspan="7"><input type='text' class='form-control' name='supplier'> </td>
                                                </tr>

                                                <tr>
                                                    <th> Pharmacy Station </th>
                                                    <td colspan="7">
                                                        <select class="form-control" name="station" required>
                                                            <option value=""><strong>-- Pharmacy Station --</strong></option>
                                                            <?php
                                                            $station = PharmacyStation::find_all();
                                                            foreach ($station as $s) {
                                                                ?>
                                                                <option value="<?php echo $s->name; ?>"><?php echo $s->name; ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>

                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td colspan="8">
                                                        <div class="form-group">
                                                            <label for="fileUpload" class="control-label">File Upload(jpg, jpeg, png format is allowed)</label>
                                                            <div style="width: 300px">
                                                                <input class="form-control" type="file" id="file_upload" name="file_upload" required>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <!--
                                                <tr>
                                                    <td colspan="4">
                                                        <div class="input-group mb-3">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" name="file_upload" id="file_upload">
                                                                <label class="control-label" for="fileUpload">Upload(jpg, jpeg, png format is allowed) Invoice...</label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                -->


                                                <tr>
                                                    <td colspan="8"><button type="submit" class="btn btn-success"> Save To Assign </button></td>
                                                </tr>
                                            </form>
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






<?php
require('../layout/footer.php');
?>