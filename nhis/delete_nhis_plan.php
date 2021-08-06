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


$findPlan = NhisPlan::find_by_id($_GET['id']);


if (is_post()) {
    if ($_POST['plan_name']) {
        if (empty($_POST['plan_name'])) {
            $errorName = " Name Of Plan is Required";
            $errorMessage .= $errorName . "<br/>";
        } else {
            $plan_name = test_input($_POST['plan_name']);
        }
    }

    $val_period = $_POST['val_period'];


    $findPlan->plan_name = $plan_name;
    $findPlan->validity_period = $val_period;
    $findPlan->sync = "off";
    $session->message("A new Plan has been updated.");
    $findPlan->delete();
    redirect_to('nhis_plans.php');


}


require('../layout/header.php');
?>


    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                                    class="fa fa-arrow-left"></i></a> National Health Insurance Scheme </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">NHIS Plan Name</li>

                        </ul>
                    </div>

                </div>
            </div>


            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card patients-list">

                        <div class="body">

                            <div class="col-lg-12 col-md-12">
                                <div class="card">
                                    <div class="body">

                                        <a href="nhis_plans.php" style="font-size: large">&laquo; Back</a>

                                        <h5> Update Plan Name </h5>
                                        <br/>
                                        <form action="" method="post">

                                            <div class="input-group">
                                                <input class="form-control" name="plan_name" required
                                                       placeholder="PLAN NAME"
                                                       value="<?php echo $findPlan->plan_name ?>"
                                                       style="width: 100px" type="text">
                                            </div>
                                            <div class="input-group">
                                                <input class="form-control" name="val_period" required
                                                       placeholder="VALIDITY PERIOD"
                                                       value="<?php echo $findPlan->validity_months ?>"
                                                       style="width: 100px" type="text">
                                            </div>
                                            <div>
                                                <button type="submit" class="btn btn-primary">Delete Plan
                                                </button>
                                            </div>
                                        </form>

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

