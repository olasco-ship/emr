<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/14/2019
 * Time: 1:01 AM
 */


require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$pending_bills = Bill::find_by_status();



require('../layout/header.php');
?>





    <div id="main-content">
        <div class="container-fluid">
            <h1 class="sr-only">Dashboard</h1>


            <!-- SALES SUMMARY -->
            <div class="dashboard-section">
                <div class="section-heading clearfix">
                    <h2 class="section-title"><i class="fa fa-shopping-basket"></i> Pending Bills </h2>
                    <a href="#" class="right">View Sales Reports</a>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel-content">
                  <!--          <h3 class="heading"><i class="fa fa-square"></i> Recent Purchases</h3>   -->
                            <div class="table-responsive">
                                <table class="table table-striped no-margin">
                                    <thead>
                                    <tr>
                                        <th>Bill No.</th>
                                        <th>Patient Name</th>
                                        <th>Consultant</th>
                                        <th>Amount</th>
                                        <th>Date &amp; Time</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php  foreach($pending_bills as $bill) {   ?>
                                        <tr>
                                            <td><a href="bill_patient.php?id=<?php echo $bill->id ?>"><?php echo $bill->bill_number ?></a></td>
                                       <!--     <td><a href="bill_patient.php?id=<?php echo $bill->encounter_id ?>"><?php echo $bill->bill_number ?></a></td>  -->
                                            <td><?php $patient = Patient::find_by_id($bill->patient_id); echo $patient->full_name()  ?></td>
                                            <td><?php $encounter = Encounter::find_by_id($bill->encounter_id); echo $encounter->consultant;  ?></td>
                                            <td><?php echo $bill->total_price ?></td>
                                            <td><?php $d_date = date('d/m/Y h:i a', strtotime($bill->date)); echo $d_date ?></td>
                                            <td><span class="label label-warning">PENDING</span></td>
                                        </tr>
                                    <?php } ?>
                                    <!--
                                    <tr>
                                        <td><a href="#">763648</a></td>
                                        <td>Steve</td>
                                        <td>$122</td>
                                        <td>Oct 21, 2016</td>
                                        <td><span class="label label-success">COMPLETED</span></td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">763649</a></td>
                                        <td>Amber</td>
                                        <td>$62</td>
                                        <td>Oct 21, 2016</td>
                                        <td><span class="label label-warning">PENDING</span></td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">763650</a></td>
                                        <td>Michael</td>
                                        <td>$34</td>
                                        <td>Oct 18, 2016</td>
                                        <td><span class="label label-danger">FAILED</span></td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">763651</a></td>
                                        <td>Roger</td>
                                        <td>$186</td>
                                        <td>Oct 17, 2016</td>
                                        <td><span class="label label-success">SUCCESS</span></td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">763652</a></td>
                                        <td>Smith</td>
                                        <td>$362</td>
                                        <td>Oct 16, 2016</td>
                                        <td><span class="label label-success">SUCCESS</span></td>
                                    </tr>
                                    -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>




            </div>
            <!-- END SALES SUMMARY -->
        </div>
    </div>









<?php

require('../layout/footer.php');