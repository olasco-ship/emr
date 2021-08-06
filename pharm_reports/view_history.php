<?php

/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/14/2019
 * Time: 6:10 PM
 */


require_once("../includes/initialize.php");


if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$stock = StoreCount::find_by_id($_GET['id']);



require('../layout/header.php')
?>




<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Drug Stocking Note</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Print Stock Note</li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="clearfix">
            <div class="card">

                <div class="body">




                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" action="">
                                <table class="table table-bordered table-condensed table-hover">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Drug(s) Counted</th>
                                            <th>Drugs Counted</th>
                                            <th>Drugs In System</th>
                                            <th>Remark</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $index = 1;
                                        $decode = json_decode($stock->counted_items);
                                        foreach ($decode as $drug) {
                                        ?>
                                            <tr>
                                                <td><?php echo $index++ ?></td>
                                                <td><?php echo $drug->name ?></td>
                                                <td> <?php echo $drug->quantity ?> </td>
                                                <td><?php echo $drug->system_qty ?></td>
                                                <td><?php
                                                    if ($drug->quantity != $drug->system_qty) {
                                                        echo "<span class='badge badge-danger'>Incomplete</span>";
                                                    } else {
                                                        echo "<span class='badge badge-success'>Complete</span>";
                                                    }
                                                    ?>
                                                </td>


                                            </tr>
                                        <?php }  ?>

                                    </tbody>
                                </table>

                                <table class="table table-bordered table-condensed table-hover">

                                    <tr>

                                        <th> Drugs Counted By </th>
                                        <td> <?php echo $stock->counted_by ?> </td>
                                    </tr>

                                    <tr>

                                        <th> Date </th>
                                        <td><?php $d_date = date('d/m/Y h:i a', strtotime($stock->date));
                                            echo $d_date ?></td>
                                    </tr>

                                    <!--
                                <tr>   
                                    <th > Signature (Supplier )  </th>
                                    <td >---------------------------------</td>
                                </tr>
                                <tr>        
                                    <th > Signature (Receiver)  </th>
                                    <td >---------------------------------</td>
                                </tr>
                                -->





                                    </tbody>


                                </table>
                                <button type="submit" id="formPrint" class="btn btn-success"> Print Note </button>
                            </form>

                        </div>

                        <!--
                    <div class="col-md-2">
                    </div>
                    -->


                    </div>




                </div>

            </div>

        </div>
    </div>
</div>

























<?php
require('../layout/footer.php');
