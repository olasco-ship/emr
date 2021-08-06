<?php
require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$index = 1;





//require('../layout/header.php');
?>



    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Reports</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active">Drug Re-Order Level Reports</li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="row clearfix">

                <div class="col-lg-12 col-md-12">
                    <div class="card">

                        <div class="body">
                            <a href="index.php" style="font-size: large">&laquo; Back</a>

                            <h4> Drug Re-Order Report </h4>

                            <div class="card">
                                <div class="body">
                                    <div class="table-responsive">
                                        <table class="table m-b-0">
                                            <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Name</th>
                                                <th>Type</th>
                                                <th>No.Batches</th>
                                                <th>Qty(Store)</th>

                                                <th>Man. Date</th>
                                                <th>Exp. Date</th>
                                                <th>Exp. Period</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php  foreach(reOrderLevel() as $productBatch) {
                                                $product = Product::find_by_id($productBatch->product_id);
                                                $sumProductQty     = ProductBatch::sumProductQuantity($product->id);
                                                $countProductBatch = ProductBatch::countProductBatches($product->id);
                                                $product_type = $product->fetch_product_type();
                                                ?>
                                                <tr>
                                                    <td><?php echo $index++ ?></td>
                                                    <td><?php echo $product->name ?></td>
                                                    <td><?php echo $product->product_type->name; ?></td>
                                                    <td> <a href="batches.php?id=<?php echo $product->id ?>"><span class='badge badge-success'><?php echo $countProductBatch; ?></span></a> </td>
                                                    <td><?php echo $sumProductQty ?></td>
                                                    <td><?php $d_date = date('d/m/Y', strtotime($productBatch->man_date)); echo $d_date ?></td>
                                                    <td><?php $d_date = date('d/m/Y', strtotime($productBatch->exp_date)); echo $d_date ?></td>
                                                    <td><?php  $months = calculateMonth($productBatch->exp_date);
                                                        $name = 'expiryPeriod';
                                                        $exp  = Notification::find_by_name($name);
                                                        if($exp->value <= $months){
                                                            echo "<span class='badge badge-success'>$months month(s)</span>";
                                                        } else {
                                                            echo "<span class='badge badge-danger'>$months month(s)</span>";
                                                        }
                                                        ?></td>
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




<?php
require('../layout/footer.php');
