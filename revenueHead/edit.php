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


$revenueHead = RevenueHead::find_by_id($_GET['id']);


if (is_post()) {
    if ($_POST['revenue_name']) {
        if (empty($_POST['revenue_name'])) {
            $errorName = " Name Of RevenueHead is Required";
            $errorMessage .= $errorName . "<br/>";
        } else {
            $revenue_name = test_input($_POST['revenue_name']);
        }
    }

    $revenueHead->revenue_name = $_POST['revenue_name'];
    $revenueHead->sync = "off";
    $session->message("A new RevenueHead has been updated.");
    $revenueHead->save();
    redirect_to('index.php');


}


require('../layout/header.php');
?>


    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                                        class="fa fa-arrow-left"></i></a> Revenue Department</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Revenue Head</li>

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

                                        <a href="../revenueHead/index.php" style="font-size: large">&laquo; Back</a>

                                        <h5> Update Revenue </h5>
                                        <br/>
                                        <form action="" method="post">

                                            <div class="input-group">
                                                <input class="form-control" name="revenue_name" required
                                                       placeholder="RevenueHead"
                                                       value="<?php echo $revenueHead->revenue_name ?>"
                                                       style="width: 100px" type="text">
                                                <button type="submit" class="btn btn-primary">Update RevenueHead
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