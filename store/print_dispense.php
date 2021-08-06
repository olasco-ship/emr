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


$dispense = StoreDispenseHistory::find_by_id($_GET['id']);


//$st = Clinic::find_by_id($dispense->station_id );
//print_r($st); exit();




require('../layout/header.php')
?>




    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Store Items Received Note</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Print Received Note</li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="clearfix">
                <div class="card">

                    <div class="body">




                        <div class="row">
                            <div class="col-md-12">
                                <a style="font-size: large" href="dispense_service.php">Back</a>
                                <form method="post" action="">
                                    <table class="table table-bordered table-condensed table-hover">
                                        <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Item(s)</th>
                                            <th>Quantity</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <?php
                                        $index = 1;
                                        $decode = json_decode($dispense->items);
                                        // print_r($decode);
                                        foreach ($decode as $drug) { ?>
                                            <tr>
                                                <td><?php echo $index++ ?></td>
                                                <td><?php echo $drug->name ?></td>
                                                <td> <?php echo $drug->Carton * $drug->NoInCarton + $drug->quantity;
                                                    ?>  </td>

                                            </tr>
                                        <?php }  ?>

                                        </tbody>
                                    </table>

                                    <table class="table table-bordered table-condensed table-hover">

                                        <tr>

                                            <th >Total Items Assigned</th>
                                            <td > <?php echo $dispense->item_count ?> </td>
                                        </tr>
                                        <tr>
                                            <th >Items Assigned To</th>
                                            <td > <?php $st = Clinic::find_by_id($dispense->station_id );
                                                echo $st->name;
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th >Items Assigned By</th>
                                            <td > <?php echo $dispense->dispenser ?> </td>
                                        </tr>
                                        <tr>

                                            <th >Items Received By</th>
                                            <td ><?php echo $dispense->dispense_to ?> </td>
                                        </tr>
                                        <tr>

                                            <th > Date  </th>
                                            <td ><?php $d_date = date('d/m/Y h:i a', strtotime($dispense->date)); echo $d_date ?></td>
                                        </tr>
                                        <tr>

                                            <th > Signature (Assigned By)  </th>
                                            <td >---------------------------------</td>
                                        </tr>
                                        <tr>

                                            <th > Signature (Receiver)  </th>
                                            <td >---------------------------------</td>
                                        </tr>





                                        </tbody>


                                    </table>
                                    <button type="submit" id="formPrint"  class="btn btn-success"> Print Note </button>
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

