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

$index = 1;

$finds = RevenueHead::find_all();
$index = 1;


if(is_post()){
    if ($_POST['revenue_name']) {
        if (empty($_POST['revenue_name'])) {
            $errorName= " Name Of RevenueHead is Required";
            $errorMessage .= $errorName . "<br/>";
        } else {
            $revenue_name = test_input($_POST['revenue_name']);
            //  if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
            //      $errorName = "Only letters and white space are allowed for Category Name";
            //      $errorMessage .= $errorName . "<br/>";
            //  }
        }
    }


 //   echo $revenue_name; exit;

    if ((!$errorMessage) and empty($errorMessage)){
        $revenue_head                = new RevenueHead();
        $revenue_head->revenue_code  = "";
        $revenue_head->revenue_name  = $revenue_name;
        $revenue_head->date_created  = strftime("%Y-%m-%d %H:%M:%S", time());
        $revenue_head->date_modified = strftime("%Y-%m-%d %H:%M:%S", time());
        if ($revenue_head->create()){
            $done = TRUE;
            $session->message("A new RevenueHead has been created.");
            redirect_to('index.php');
        } else {
            $done = FALSE;
            $session->message("Could not create a new RevenueHead.");

        }
    }
}




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

                                    <div class="body">
                                        <ul class="nav nav-tabs-new">
                                            <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#ipd-sevices">IPD Services</a></li>
                                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#ward-beds">Ward/Bed Management</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane show active" id="ipd-sevices">
                                                <h6>IPD Services</h6>
                                        <div class="text-right"><a href="add_ipd.php" class="btn btn-primary"> Add IPD Services </a></div>
                                         
                                            </div>
                                            <div class="tab-pane" id="ward-beds">
                                                <h6>Ward/Bed Management</h6>
                                                            <div class="table-responsive">
                                                    <table class="table no-margin">
                                                        <thead>
                                                        <tr>
                                                            <th>S/N</th>
                                                            <th>Revenue </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                      
                                                            <tr>
                                                                <td>1</td>
                                                                <td> <a href="location.php"> Location </a></td>       
                                                            </tr>
                                                              <tr>
                                                                <td>2</td>
                                                                <td> <a href="wards.php"> Wards </a></td>
                                                            </tr>
                                                              <tr>
                                                                <td>3</td>
                                                                <td> <a href="beds.php"> Beds </a></td>
                                                            </tr>
                                                     
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