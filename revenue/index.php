<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/13/2019
 * Time: 11:57 PM
 */


require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}


$prescription = Bill::find_by_status();

$pending_bills = Bill::count_pending_bills();

//$billed = Bill::count_billed();

$count_all = Bill::count_all();

$paid_bills = Bill::count_paid_bill();

$cleared_bills = Bill::count_cleared_bill();


/*

$prescription = Prescription::find_by_status();

$pending_bills = Prescription::count_pending_bills();

$billed = Prescription::count_billed();

$count_all = Prescription::count_all();

$cleared_bills = Prescription::count_cleared_bill();

*/




require('../layout/header.php');
?>



    <div id="main-content">
        <div class="container-fluid">
            <h1 class="sr-only">Dashboard</h1>


            <div class="dashboard-section no-margin">
                <div class="section-heading clearfix">
                    <h2 class="section-title"><i class="fa fa-user-circle"></i> Revenue(Bills & Payment) <span class="section-subtitle">(7 days report)</span></h2>
                    <a href="#" class="right">View Social Reports</a>
                </div>
                <div class="panel-content">
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <p class="metric-inline"><i class="fa fa-user-circle-o"></i>
                                <a href="gen_bill.php"> <?php echo $count_all; ?> <span>GENERATE BILL</span></a>
                            </p>
                        </div>

                        <div class="col-md-3 col-sm-6">
                            <p class="metric-inline"><i class="fa fa-user-circle-o"></i>
                                <a href="all_bills.php"> <?php echo $count_all; ?> <span>ALL BILLS</span></a>
                            </p>
                        </div>

                        <div class="col-md-3 col-sm-6">
                            <p class="metric-inline"><i class="fa fa-thumbs-o-up"></i>
                                <a href="pending_bills.php"><?php echo $pending_bills; ?><span>PENDING BILLS </span></a>
                            </p>
                        </div>

                        <div class="col-md-3 col-sm-6">
                            <p class="metric-inline"><i class="fa fa-reply-all"></i>
                                <a href="billed.php"><?php // echo $billed; ?> <span>BILLED</span></a>
                            </p>
                        </div>

                        <div class="col-md-3 col-sm-6">
                            <p class="metric-inline"><i class="fa fa-envelope-o"></i>
                                <a href="paid_bills.php"><?php echo $paid_bills; ?> <span>PAID BILLS</span></a>

                            </p>
                        </div>

                        <div class="col-md-3 col-sm-6">
                            <p class="metric-inline"><i class="fa fa-envelope-o"></i>
                                <a href="cleared_bills.php"><?php echo $cleared_bills; ?> <span>CLEARED BILLS</span></a>

                            </p>
                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div>



   <!-- <div id="main-content">
        <div class="container-fluid">
            <div class="section-heading">
                <h1 class="page-title">Revenue(Bills & Payment)</h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs nav-tabs-colored" role="tablist">
                        <li class="active"><a href="#home" role="tab" data-toggle="tab">All Bills</a></li>
                        <li><a href="#profile" role="tab" data-toggle="tab">Pending Bills</a></li>
                        <li><a href="#settings" role="tab" data-toggle="tab">Cleared Bills</a></li>
                        <li class="dropdown">
                            <a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1">
                                <li><a href="#dropdown1" tabindex="-1" data-toggle="tab">Dropdown Item 1</a></li>
                                <li><a href="#dropdown2" tabindex="-1" data-toggle="tab">Dropdown Item 2</a></li>
                            </ul>
                        </li>
                    </ul>
                    <div class="tab-content tab-content-colored">
                        <div class="tab-pane fade in active" id="home">

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="panel-content">
                                        <h3 class="heading"><i class="fa fa-square"></i> Recent Purchases</h3>
                                        <div class="table-responsive">
                                            <table class="table table-striped no-margin">
                                                <thead>
                                                <tr>
                                                    <th>Order No.</th>
                                                    <th>Name</th>
                                                    <th>Amount</th>
                                                    <th>Date &amp; Time</th>
                                                    <th>Status</th>
                                                </tr>
                                                </thead>
                                                <tbody>
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
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="panel-content">
                                        <h3 class="heading"><i class="fa fa-square"></i> Top Products</h3>
                                        <div id="chart-top-products" class="chartist"></div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="tab-pane fade" id="profile">
                            <h5>Tab Profile</h5>
                            <p>Continually mesh resource sucking synergy before sustainable e-commerce. Efficiently incentivize leading-edge alignments with go forward expertise. Conveniently myocardinate leveraged process improvements through progressive models. Collaboratively.</p>
                        </div>
                        <div class="tab-pane fade" id="settings">
                            <h5>Tab Settings</h5>
                            <p>Dramatically supply adaptive imperatives and stand-alone content. Seamlessly pursue exceptional solutions after web-enabled potentialities. Synergistically negotiate alternative best practices whereas professional "outside the box" thinking. Completely expedite dynamic.</p>
                        </div>
                        <div class="tab-pane fade" id="dropdown1">
                            <h5>Tab Dropdown 1</h5>
                            <p>Phosfluorescently revolutionize viral leadership via turnkey technology. Synergistically monetize intermandated strategic theme areas through multimedia based.</p>
                        </div>
                        <div class="tab-pane fade" id="dropdown2">
                            <h5>Tab Dropdown 2</h5>
                            <p>Continually mesh resource sucking synergy before sustainable e-commerce. Efficiently incentivize leading-edge alignments with go forward expertise. Conveniently myocardinate leveraged process improvements through progressive models. Collaboratively.</p>
                        </div>
                    </div>
                    <div class="margin-bottom-50"></div>
                </div>

            </div>
            <div class="margin-bottom-50"></div>

        </div>
    </div>-->
























<?php

require('../layout/footer.php');
