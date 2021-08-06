<?php

/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/2/2019
 * Time: 9:54 AM
 */


require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}


$user = User::find_by_id($session->user_id);


$product_array = $_SESSION["product_name"];




$message = "";
$done = FALSE;


if (is_post()) {

    $product_name        = $_POST['product_name'];
    //$productType_id      = $_POST['productType_id'];
    $productType_id      = "";
    $cost_price          = $_POST['cost_price'];
    $quantity            = $_POST['quantity'];
    $carton              = $_POST['carton'];
    $no_carton           = $_POST['no_carton'];
    $batch_no            = $_POST['batch_no'];
    $barcode             = $_POST['barcode'];
    $man_date            = $_POST['man_date'];
    $exp_date            = $_POST['exp_date'];

    $new_array = array();
    for ($x = 0; $x < count($product_name); $x++) {
        $new_array[$x] = array(
            'product_name'   => $product_name[$x],
            'productType_id' => $productType_id,
            'cost_price'     => $cost_price[$x],
            'quantity'       => $quantity[$x],
            'Carton'         => $carton[$x],
            'NoInCarton'     => $no_carton[$x],
            'batch_no'       => $batch_no[$x],
            'barcode'        => $barcode[$x],
            'man_date'       => $man_date[$x],
            'exp_date'       => $exp_date[$x]
        );
    }

    $name3        = 'MarkUp';
    $notification = StockNotification::find_by_name($name3);
    $markup       = $notification->value;

    $newStock                   = new StoreIn();
    $newStock->sync             = "off";
    $newStock->code             = rand(10000, 99999);
    $newStock->items            = json_encode($new_array);
    $newStock->item_count       = count($new_array);
    $newStock->supplier         = $_POST['supplier'];
    //$newStock->pharmacy_station = $_POST['station'];
    $newStock->pharmacy_station = "Main Store";
    $newStock->receiver         = $user->full_name();
    $newStock->date             = strftime("%Y-%m-%d %H:%M:%S", time());
    $newStock->attach_file($_FILES['file_upload']);
    if ($newStock->save()) {
      //  $markup = 0.1;
        foreach ($new_array as $item) {
            $product                 = new StockItems();
            $product->sync           = "off";
            $product->name           = $item['product_name'];
            $product->barcode        = $item['barcode'];
            $product->category_id    = 0;
            $product->productType_id = $item['productType_id'];
            $product->description    = "";
            $product->created        = strftime("%Y-%m-%d %H:%M:%S", time());
            if ($product->save()) {
                $selling_price = ($item['cost_price'] * $markup) + $item['cost_price'];
                $selling_price = round($selling_price);
                $newProductBatch                = new StockBatch();
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
        }
        $_SESSION["product_name"] = array();
        redirect_to("../store/stock_history.php");
    } else {
        $errorMessage = join("<br/>", $newStock->errors);
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
                            Stock Upload </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="storage.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Store</li>
                            <li class="breadcrumb-item active">Items</li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="row clearfix">



                <div class="col-lg-12">
                    <div class="card">

                        <div class="body">
                            <a style="font-size: large;" href="create.php">Back</a>
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
<!--                                        <th>Product Type</th>-->
                                        <th>Cost Price</th>
                                        <th>Quantity</th>
                                        <th>Carton(s)</th>
                                        <th>No. In Carton</th>
                                        <th>Batch No.</th>
                                        <th>Barcode</th>
                                        <th>Man. Date</th>
                                        <th>Exp. Date</th>


                                    </tr>
                                    </thead>

                                    <tbody>
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <?php
                                        $product_array = $_SESSION["product_name"];
                                        foreach ($product_array as $product) {   ?>

                                            <tr>
                                                <td>
                                                    <input type='text' class='form-control' name='product_name[]' value='<?php echo $product ?>' hidden>
                                                    <?php echo $product  ?>
                                                </td>
<!--                                                <td>-->
<!--                                                    <select class="form-control" style="width: 200px" id="productType_id" name="productType_id" required >-->
<!--                                                        <option value="">--Select Product Type--</option>-->
<!--                                                        --><?php
//                                                        $finds = ProductType::find_all_order_by_name();
//                                                        foreach ($finds as $find) {
//                                                            ?>
<!--                                                            <option value="--><?php //echo $find->id; ?><!--">--><?php //echo $find->name; ?><!--</option>-->
<!--                                                            --><?php
//                                                        }
//                                                        ?>
<!--                                                    </select>-->
<!--                                                </td>-->
                                                <td><input type='text' class='form-control' name='cost_price[]' value='' style='width:80px;'required ></td>
                                                <td><input type='text' class='form-control' name='quantity[]' value='' style='width:80px;' required ></td>
                                                <td><input type='text' class='form-control' name='carton[]' value='' style='width:80px;' required ></td>
                                                <td><input type='text' class='form-control' name='no_carton[]' value='' style='width:80px;' required ></td>
                                                <td><input type='text' class='form-control' name='batch_no[]' value='' style='width:100px;' required ></td>
                                                <td><input type='text' class='form-control' name='barcode[]' value='' style='width:100px;' required ></td>
                                                <td><input type='date' class='form-control' name='man_date[]' value='' style='width:150px;' required > </td>
                                                <td><input type='date' class='form-control' name='exp_date[]' value='' style='width:150px;' required > </td>
                                            </tr>

                                        <?php } ?>

                                        <tr>
                                            <th> Supplier's Name </th>
                                            <td colspan="9"><input style="width: 75%;" type='text' class='form-control' name='supplier' required > </td>
                                        </tr>

<!--                                        <tr>-->
<!--                                            <th> Pharmacy Station </th>-->
<!--                                            <td colspan="9">-->
<!--                                                <select class="form-control" name="station" style="width: 75%;" required>-->
<!--                                                    <option value=""><strong>-- Pharmacy Station --</strong></option>-->
<!--                                                    --><?php
//                                                    $station = PharmacyStation::find_all();
//                                                    foreach ($station as $s) {
//                                                        ?>
<!--                                                        <option value="--><?php //echo $s->name; ?><!--">--><?php //echo $s->name; ?><!--</option>-->
<!--                                                        --><?php
//                                                    }
//                                                    ?>
<!--                                                </select>-->
<!---->
<!--                                            </td>-->
<!--                                        </tr>-->

                                        <tr>
                                            <td colspan="10">
                                                <div class="form-group">
                                                    <label for="fileUpload" class="control-label">File Upload(jpg, jpeg, png format is allowed)</label>
                                                    <div style="width: 300px">
                                                        <input class="form-control" type="file" id="file_upload" name="file_upload" required>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>



                                        <tr>
                                            <td colspan="10"><button type="submit" class="btn btn-success"> Save To Assign </button></td>
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




<?php

require('../layout/footer.php');
