<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/16/2019
 * Time: 1:30 PM
 */



require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}


$message = "";
$done = FALSE;

$index = 1;


$test = Test::find_by_id($_GET['id']);






if (is_post()) {

    if (empty($_POST['name'])) {
        $errTest = "Revenue Desc is Required";
        $errMessage .= $errTest . "<br/>";
    } else {
        $test->name = test_input($_POST['name']);
    }

    if (empty($_POST['price'])) {
        $errPrice = "Price is Required";
        $errMessage .= $errPrice . "<br/>";
    } else {
        $test->price = test_input($_POST['price']);
    }

    if ((!$errMessage) and (empty($errMessage))) {
        if ($test->save()) {
            $done = TRUE;
            $session->message("Revenue has been successfully uploaded");
            redirect_to('revenue.php');
        }
    }



}


require('../layout/header.php');
?>




    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Medical Records </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Medical Record's Revenue </li>

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

                                        <a href="../patient/revenue.php" style="font-size: large">&laquo; Back</a>



                                            <div class="tab-pane" id="Profile-new">
                                                <h6> Edit Revenue </h6>
                                                <form id="basic-form" action="" method="post">
                                                    <div class="form-group">
                                                        <!--    <label>Drug Name</label>  -->
                                                        <input type="text" class="form-control" style="width: 350px" name="name"
                                                               placeholder="Revenue Name" value="<?php echo $test->name ?>" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <!--    <label>Selling Price</label>  -->
                                                        <input type="text" class="form-control" style="width: 350px" name="price"
                                                               placeholder="Revenue Price" value="<?php echo $test->price ?>" required>
                                                    </div>


                                                    <br>
                                                    <button type="submit" class="btn btn-primary">Save Changes <!-- Test --></button>
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
    </div>







<?php

require('../layout/footer.php');


