<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/2/2019
 * Time: 9:54 AM
 */

require_once("../includes/initialize.php");

if (($user->role == 'Super Admin') OR ($user->department == 'Pharmacy')){
    redirect_to(emr_lucid );
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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>
                            Drug In Store</h2>
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

                        <a href="storage.php">Back</a>

                            <div class="table-responsive">
                                <table class="table center-aligned-table">
                                    <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Name</th>
                                     <!--   <th>Batch No.</th>  -->
                                        <th>Type</th>
                                       <!-- <th>  Brand</th>-->
                                        <!--   <th>C.Price</th>-->
                                        <th>S.Price</th>
                                        <th>Qty(Store)</th>
                                        <!--         <th>Qty(Shelf)</th>-->
                                        <th>Man. Date</th>
                                        <th>Exp. Date</th>
                                        <th>Exp. Period</th>
                                        <!--       <th>Date Added</th>
                                               <th>Status</th> -->
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach($products as $product) {
                                            $category = $product->fetch_category();
                                            $product_type = $product->fetch_product_type();
                                            ?>

                                            <tr>
                                                <td><?php echo $index++ ?></td>
                                                <td><?php echo $product->name ?></td>
                                            <!--    <td><?php echo $product->batch_no ?></td>   -->
                                            <!--    <td><?php echo $product->category->name; ?></td> -->
                                                <td><?php echo $product->product_type->name; ?></td>
                                                <!--    <td><?php /*echo $product->cost_price */?></td>-->
                                                <td><?php echo $product->price ?></td>
                                                <td><?php echo $product->total_quantity ?></td>
                                                <!--   <td><?php /*echo $product->quantity */?></td>-->
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
                                                <!--     <td><?php // $d_date = date('d/m/Y', strtotime($product->created)); echo $d_date ?></td>
                                            <td><span class="label label-success">COMPLETED</span></td>-->
                                            </tr>
                                        <?php   }?>

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


