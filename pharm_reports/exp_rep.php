<?php
require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$index = 1;

$products = Product::find_all();





require('../layout/header.php');
?>



<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Reports</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active">Drug Expiry Report</li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="row clearfix">

            <div class="col-lg-12 col-md-12">
                <div class="card">

                    <div class="body">
                        <a href="index.php" style="font-size: large">&laquo; Back</a>

                        <h4> Drug Expiry Report </h4>

                        <?php // echo countExpiringDrugs() ?>

                       
                            <div class="card">
                                <div class="body">
                                    <div class="table-responsive">
                                        <table class="table m-b-0">
                                            <thead>
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Name</th>
                                                    <th>Batch No.</th>                                                  
                                                    <th>Type</th>                                               
                                                    <th>S.Price</th>
                                                    <th>Qty(Store)</th>                                           
                                                    <th>Man. Date</th>
                                                    <th>Exp. Date</th>
                                                    <th>Exp. Period</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach (expiringDrugs() as $product) {
                                                    $category = $product->fetch_category();
                                                    $product_type = $product->fetch_product_type();
                                                ?>
                                                    <tr>
                                                        <td><?php echo $index++ ?></td>
                                                        <td><?php echo $product->name ?></td>
                                                        <td><?php echo $product->batch_no ?></td>                                                    
                                                        <td><?php echo $product->product_type->name; ?></td>                                                   
                                                        <td><?php echo $product->price ?></td>
                                                        <td><?php echo $product->total_quantity ?></td>                                                   
                                                        <td><?php $d_date = date('d/m/Y', strtotime($product->man_date));
                                                            echo $d_date ?></td>
                                                        <td><?php $d_date = date('d/m/Y', strtotime($product->exp_date));
                                                            echo $d_date ?></td>
                                                        <td><?php $months = calculateMonth($product->exp_date);
                                                            $name = 'expiryPeriod';
                                                            $exp  = Notification::find_by_name($name);
                                                            if ($exp->value <= $months) {
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
