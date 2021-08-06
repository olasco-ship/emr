<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/1/2019
 * Time: 9:25 AM
 */
require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}


$index = 1;

$user = User::find_by_id($session->user_id);


require('../layout/header.php');



?>


    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Storage </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Supplies</li>

                        </ul>
                    </div>

                </div>
            </div>



            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card patients-list">

                        <div class="body">

                            <a href="storage.php" style="font-size: large">&laquo; Back</a>
                            <div href="#" class="right">
                                <form class="form-inline" id="basic-form" action="" method="post">
                                    <div class="form-group">
                                        <input type="text"  class="form-control" placeholder=" Search "
                                               name="search" required>
                                        <button type="submit" class="btn btn-outline-primary">Search</button>
                                        <button type="button" name="search" onClick="location.href=location.href"  class="btn btn-outline-warning">Refresh</button>
                                    </div>
                                </form>
                                <?php if (is_post()){
                                    $query = trim($_POST['search']);
                                    ?>
                                    <div id="success" class="alert alert-info alert-dismissible" role="alert" style="width: 500px">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                        All records for <?php echo $query ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <?php echo output_message($message); ?>
                            <ul class="nav nav-tabs-new2">
                                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#All"> Stock History </a></li>
                            </ul>

                            <div class="tab-content m-t-10 padding-0">
                                <div class="tab-pane table-responsive active show" id="All">
                                    <table class="table m-b-0 table-hover">
                                        <thead class="thead-dark">
                                        <tr>
                                            <th> S/N</th>
                                            <th> Supplier  </th>
                                            <th> Received By </th>
                                            <th> Dispensory Unit</th>
                                            <th> Total Drugs </th>
                                            <th> Date </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php

                                        $history = StockIn::find_all_desc();
                                        foreach($history as $h) {   ?>
                                            <tr>
                                                <td> <?php echo $index++ ?> </td>
                                                <td><a href='print_stock.php?id=<?php echo $h->id ?>'><?php echo $h->supplier ?></a></td>
                                                <td><?php echo $h->receiver ?></td>
                                                <td><?php  echo $h->pharmacy_station ?></td>
                                                <td><?php echo $h->item_count ?></td>
                                                <td><?php $d_date = date('d/m/Y h:i a', strtotime($h->date)); echo $d_date ?></td>
                                            </tr>
                                        <?php }  ?>

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





<?php

require('../layout/footer.php');























