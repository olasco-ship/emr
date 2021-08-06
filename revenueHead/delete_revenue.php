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



$test = Test::find_by_id($_GET['id']);

$message = "";
$done = FALSE;

$index = 1;

$test = Test::find_by_id($_GET['id']);


if(is_post()){

    $test = Test::find_by_id($_GET['id']);
    $test->delete();
    redirect_to('depts.php');


}




require('../layout/header.php');
?>








    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Revenue</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Revenue</li>
                            <!--<li class="breadcrumb-item active">All Patient</li>-->
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


                                        <a href="../revenueHead/depts.php" style="font-size: large">&laquo; Back</a>

                                        <h5> Delete Revenue </h5>
                                        <br/>
                                        <form action="" method="post">

                                            <div class="input-group">
                                                <input class="form-control" name="revenue_name" readonly placeholder="Revenue" value="<?php echo $test->name ?>" style="width: 100px" type="text">
                                                <button type="submit" class="btn btn-primary">Delete Revenue</button>
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