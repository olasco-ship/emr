<?php

/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/2/2019
 * Time: 11:40 AM
 */

require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}


$station = PharmacyStation::find_by_id($_GET['id']);
$index = 1;
$finds = ProductPharmacyStation::find_available_drugs($station->id);






require('../layout/header.php');
?>






<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>
                        Dispensary Pharmacy</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo emr_lucid ?>/pham/storage.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Pharmacy</li>
                        <li class="breadcrumb-item active">Dispensary</li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="row clearfix">

            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="body">

                        <div class="tab-content">
                            <div class="tab-pane show active" id="Home-new">
                                <a style="font-size: large;" href="station.php">Back</a>
                                <h3 class="heading"> <?php echo $station->name;  ?> </h3>
                                <div class="table-responsive">
                                    <table class="table no-margin">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th> Drug Name </th>
                                                <th>Selling Price</th>
                                                <th>Quantity</th>
                                                <th>Date Added</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($finds as $find) {
                                                $product = Product::find_by_id($find->product_id);
                                            ?>
                                                <tr>
                                                    <td><?php echo $index++; ?></td>
                                                    <td><?php echo $product->name; ?></td>
                                                    <td><?php echo "₦$find->selling_price" ?></td>
                                                    <td><?php echo $find->quantity ?></td>
                                                    <td><?php $d_date = date('d/m/Y h:i a', strtotime($product->created));
                                                        echo $d_date; ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="Profile-new">

                            </div>

                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>









    <?php

    require('../layout/footer.php');
