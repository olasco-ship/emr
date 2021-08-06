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

$products = Product::find_all();

require('../layout/header.php');
?>



<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>
                        Dispensary </h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="storage.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Drugs In Main Store</li>
                    </ul>
                </div>
             
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card">
                  
                    <div class="body">

                        <a style="font-size: large;" href="dispensary.php">Back</a>

                        <div class="table-responsive">
                                <table class="table center-aligned-table">
                                    <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Name</th>
                                        <th>Type</th>        
                                        <th>No.Batches</th>                   
                                        <th>Qty(Store)</th>   
                                        
                                              
                                                                 
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach($products as $product) {
                                            $category = $product->fetch_category();
                                            $product_type = $product->fetch_product_type();

                                            $countProductBatch = ProductBatch::countProductBatches($product->id);
                                            $sumProductQty     = ProductBatch::sumProductQuantity($product->id);
                                            ?>
                                            <tr>
                                                <td><?php echo $index++ ?></td>
                                                <td><?php echo $product->name ?></td> 
                                                <td><?php echo $product->product_type->name; ?></td>
                                              
                                                <td> <a href="#"><span class='badge badge-success'><?php echo $countProductBatch; ?></span></a> </td>
                                                <td><?php echo $sumProductQty ?></td>
                                
                                                    
                    
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
