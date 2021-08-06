<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/16/2019
 * Time: 12:14 PM
 */
require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$finds = RevenueHead::find_all();
$index = 1;

$discountpat = Discount::find_all();




require('../layout/header.php');
?>








    <div id="main-content">
        <div class="container-fluid">
        <?php include "../layout/header_chart.php"; ?>



            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card patients-list">
                        <div class="body">


                            <div class="col-lg-12 col-md-12">
                                <div class="card">
<!--                                    <div class="header">
                                        <h2>Example Tab 2 <small><code class="highlighter-rouge">.nav-tabs-new</code></small></h2>
                                    </div>-->
                                    <div class="body">
                                        
                                        <div class="tab-content">
                                            <div >
                                                <h6>IPD Discount</h6>
                                                            <div class="table-responsive">
                                                    <table class="table no-margin">
                                                        <thead>
                                                        <tr>
                                                            <th>S/N</th>
                                                            <th>Patient Name </th>
                                                            <th>Nurse Name </th>
                                                            <th>Amount </th>
                                                            <th>Date/Time </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php 
                                                            if (isset($discountpat)) {
                                                                foreach ($discountpat as $k => $dosData) {
                                                                    $patname = Patient::find_by_id_pdf($dosData->patient_id);
                                                                    $nursename = User::find_by_id($dosData->nurse_id);
                                                                    ?>
                                                                        <tr>
                                                                            <td><?= $k + 1 ?></td>
                                                                            <td> <a href="javascript::void(0)"><?= $patname->first_name." ".$patname->last_name ?></a></td>       
                                                                            <td> <a href="javascript::void(0)"><?= $nursename->first_name." ".$nursename->last_name ?></a></td>       
                                                                            <td> <a href="javascript::void(0)"><?= $dosData->amount ?></a></td>       
                                                                            <td> <a href="javascript::void(0)"><?= date("m/d/Y H:i:s", strtotime($dosData->amount)) ?></a></td>       
                                                                        </tr>
                                                        <?php
                                                                }
                                                            } ?>
                                                     
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
            </div>
        </div>
    </div>







<?php

require('../layout/footer.php');