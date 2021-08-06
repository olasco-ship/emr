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

$index = 1;

$user = User::find_by_id($session->user_id);

echo $user->unit; // exit;

$sta = PharmacyStation::find_station_by_name($user->unit);

//echo $sta->id; exit;








require('../layout/header.php');
?>



<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>
                        Dispensary</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="storage.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item"> Drugs In Dispensary</li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card">

                    <div class="body">

                        <a href="dispensary.php" style="font-size: large">Back</a>

                        <div href="#" class="right">
                            <form class="form-inline" id="basic-form" action="" method="post">
                                <div class="form-group">
                                    <?php $station = PharmacyStation::find_all(); ?>
                                    <select class="form-control" id="station_id" name="station_id" required>
                                        <option value="">--Select Dispensary--</option>
                                        <?php
                                        foreach ($station as $s) { ?>
                                            <option value="<?php echo $s->id; ?>"><?php echo $s->name; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <button type="submit" name="select_dispensary" class="btn btn-outline-primary"> Select Dispensary </button>
                                    <button type="button" name="search" onClick="location.href=location.href" class="btn btn-outline-warning">Refresh</button>

                                </div>
                            </form>
                        </div>
                        <br />

                        <?php
                        if (is_post()) {
                          //  $station_id = trim($_POST['station_id']);
                          //  $pharmStation = PharmacyStation::find_by_id($station_id);

                            $pharmStation = PharmacyStation::find_by_id($sta->id);
                            echo "<h4>$pharmStation->name </h4>";
                        }
                        ?>


                        <div class="table-responsive">
                            <table class="table center-aligned-table">
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
                                <?php

                                    // $station_id = trim($_POST['station_id']);
                                    //  $prodStation = ProductPharmacyStation::find_all_by_product_id($station_id);

                                    if (!empty($sta)) {
                                        $prodStation = ProductPharmacyStation::find_available_drugs($sta->id);
                                        foreach ($prodStation as $pro) {
                                            $prods = Product::find_by_id($pro->product_id);
                                            $product_type = $prods->fetch_product_type();
                                            ?>
                                            <tr>
                                                <td><?php echo $index++; ?></td>
                                                <td><?php echo $prods->name; ?></td>
                                                <td><?php echo "₦$pro->selling_price" ?></td>
                                                <td><?php echo $pro->quantity ?></td>
                                                <td><?php $d_date = date('d/m/Y h:i a', strtotime($prods->created));
                                                    echo $d_date; ?></td>
                                            </tr>
                                        <?php }
                                    }
                                 ?>

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
