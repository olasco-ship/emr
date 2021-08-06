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

$index = 1;

$product = StockItems::find_by_id($_GET['id']);

$batches = StockBatch::find_products($product->id);


require('../layout/header.php');
?>



    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>
                            Storage </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="storage.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item"><?php echo $product->name ?></li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">

                        <div class="body">

                            <a style="font-size: large;" href="index.php">Back</a>

                            <div class="table-responsive">
                                <table class="table center-aligned-table">
                                    <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Name</th>
<!--                                        <th>Type</th>-->
                                        <th>Batch</th>
                                        <th>C.Price</th>
<!--                                        <th>S.Price</th>-->
                                        <th>Qty(Store)</th>
                                        <th>Man. Date</th>
                                        <th>Exp. Date</th>
                                        <th>Exp. Period</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($batches as $batch) {
                                        $category = $product->fetch_category();
                                        $product_type = $product->fetch_product_type();
                                        ?>
                                        <tr>
                                            <td><?php echo $index++ ?></td>
                                            <td><?php echo $product->name ?></td>
<!--                                            <td>--><?php //echo $product->product_type->name; ?><!--</td>-->
                                            <td><?php echo $batch->batch_no ?></td>
                                            <td><?php echo "₦$batch->cost_price" ?></td>
<!--                                            <td>--><?php //echo "₦$batch->selling_price" ?><!--</td>-->
                                            <td><?php echo $batch->quantity ?></td>
                                            <td><?php $d_date = date('d/m/Y', strtotime($batch->man_date));
                                                echo $d_date ?></td>
                                            <td><?php $d_date = date('d/m/Y', strtotime($batch->exp_date));
                                                echo $d_date ?></td>
                                            <td><?php $months = calculateMonth($batch->exp_date); // echo $months;
                                                $name = 'expiryPeriod';
                                                $exp  = StockNotification::find_by_name($name);
                                                if ($exp->value <= $months) {
                                                    echo "<span class='badge badge-success'>$months month(s)</span>";
                                                } else {
                                                    echo "<span class='badge badge-danger'>$months month(s)</span>";
                                                }

                                                ?></td>

                                        </tr>
                                    <?php   } ?>

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
