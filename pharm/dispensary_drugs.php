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

if (($user->role == 'Super Admin') OR ($user->department == 'Pharmacy')){
    redirect_to(emr_lucid );
}

$index = 1;






require('../layout/header.php');
?>



    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>
                            Drug In Dispensary</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="storage.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Pharmacy</li>
                            <li class="breadcrumb-item active">Drugs</li>
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

                        <a href="dispensary.php"  style="font-size: large">Back</a>

 
                          <div href="#" class="right">
                                <form class="form-inline" id="basic-form" action="" method="post">
                                    <div class="form-group">
                                        <?php   $station = PharmacyStation::find_all(); ?>
                                        <select class="form-control" id="station_id" name="station_id" required>
                                            <option value="">--Select Dispensary--</option>
                                            <?php
                                            foreach ($station as $s) { ?>
                                                <option
                                                    value="<?php echo $s->id; ?>"><?php echo $s->name; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                        <button type="submit" name="select_dispensary"  class="btn btn-outline-primary"> Select Dispensary </button>
                                        <button type="button" name="search" onClick="location.href=location.href"  class="btn btn-outline-warning">Refresh</button>
                                    </div>
                                </form>
                          </div>
                          <br/>

                          <?php
                            if (is_post()) {
                                $station_id = trim($_POST['station_id']);
                                $pharmStation = PharmacyStation::find_by_id($station_id);
                                echo "<h4>$pharmStation->name </h4>";
                            }                                              
                          ?>


                            <div class="table-responsive">
                                <table class="table center-aligned-table">
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
                                    <?php
                                    if (is_post()) {
                                            $station_id = trim($_POST['station_id']);

                        
                                            $prodStation = ProductPharmacyStation::find_all_by_product_id($station_id);                                    
                                            foreach($prodStation as $pro) {  
                                                $prods = Product::find_by_id($pro->product_id);
                                                $product_type = $prods->fetch_product_type();
                                                ?>
                                            <tr>
                                                <td><?php echo $index++ ?></td>
                                                <td><?php echo $prods->name ?></td>
                                                <td><?php echo $prods->batch_no ?></td>
                                                <td><?php echo $prods->product_type->name; ?></td>
                                                <td><?php echo $prods->price ?></td>
                                                <td><?php echo $pro->quantity ?></td>                               
                                                <td><?php $d_date = date('d/m/Y', strtotime($prods->man_date)); echo $d_date ?></td>
                                                <td><?php $d_date = date('d/m/Y', strtotime($prods->exp_date)); echo $d_date ?></td>
                                                <td><?php  $months = calculateMonth($prods->exp_date);
                                                    $name = 'expiryPeriod';
                                                    $exp  = Notification::find_by_name($name);
                                                    if($exp->value <= $months){
                                                        echo "<span class='badge badge-success'>$months month(s)</span>";
                                                    } else {
                                                        echo "<span class='badge badge-danger'>$months month(s)</span>";
                                                    }

                                                    ?></td>
                                            </tr>
                                            <?php } } else {
                                            $products = Product::find_all();
                                            foreach($products as $product) { 
                                                $product_type = $product->fetch_product_type();
                                                ?>
                                                <!--
                                            <tr>
                                                <td><?php echo $index++ ?></td>
                                                <td><?php echo $product->name ?></td>
                                                <td><?php echo $product->batch_no ?></td>
                                                <td><?php echo $product->product_type->name; ?></td>
                                                <td><?php echo $product->price ?></td>
                                                <td><?php echo $product->total_quantity ?></td>                               
                                                <td><?php $d_date = date('d/m/Y', strtotime($product->man_date)); echo $d_date ?></td>
                                                <td><?php $d_date = date('d/m/Y', strtotime($product->exp_date)); echo $d_date ?></td>
                                                <td><?php  $months = calculateMonth($product->exp_date);
                                                    $name = 'expiryPeriod';
                                                    $exp  = Notification::find_by_name($name);
                                                    if($exp->value <= $months){
                                                        echo "<span class='badge badge-success'>$months month(s)</span>";
                                                    } else {
                                                        echo "<span class='badge badge-danger'>$months month(s)</span>";
                                                    }

                                                    ?></td>
                                            </tr>
                                            -->
                                        <?php }  }?>

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


