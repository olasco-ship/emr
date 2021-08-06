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

$stock = StockIn::find_by_id($_GET['id']);







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
                                    <th>Drug(s)</th>
                                    <th>Carton(s)</th>
                                 <!--   <th>No. In Carton(s)</th> -->
                                    <th>Unit Quantity</th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php 
                                $index = 1;
                                $decode = json_decode($stock->items);
                                foreach ($decode as $drug) { ?>

                                    <tr>                                       
                                        <td><?php echo $index++ ?></td>
                                        <td><?php echo $drug->name ?></td>
                                        <td><?php echo $drug->Carton ?></td>
                                     <!--   <td><?php // echo $drug->NoInCarton ?></td>  -->
                                        <td> <?php echo $drug->quantity ?>  </td>
                                    
                                    </tr>
                                <?php }  ?>

                                </tbody>
                                </table>

                                <table class="table table-bordered table-condensed table-hover">
                                
                                <tr>
                                  
                                    <th >Total Drugs Supplied</th>
                                    <td > <?php echo $stock->item_count ?> </td>
                                </tr>
                                <tr>
                                    <th >Drugs Supplied To</th>
                                    <td > <?php echo $stock->pharmacy_station ?> </td>
                                </tr>
                                <tr>
                                    <th >Drugs Supplied By</th>
                                    <td > <?php echo $stock->supplier ?> </td>
                                </tr>
                                <tr>
                               
                                    <th >Drugs Received By</th>
                                    <td ><?php echo $stock->receiver ?> </td>
                                </tr>
                                <tr>
                                    
                                    <th > Date  </th>
                                    <td ><?php $d_date = date('d/m/Y h:i a', strtotime($stock->date)); echo $d_date ?></td>
                                </tr>
                                <tr>
                                   
                                    <th > Signature (Supplier )  </th>
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

