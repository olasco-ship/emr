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

//$tests = Test::find_all();




if (is_post()) {
    if ($_POST['name']) {
        if (empty($_POST['name'])) {
            $errorName = "Product Name is Required";
            $errorMessage .= $errorName . "<br/>";
        } else {
            $name = test_input($_POST['name']);
        }
    }



    if (empty($_POST['revenueHead_id'])) {
        $errorRevenue  = "RevenueHead is Required";
        $errorMessage .= $errorRevenue . "<br/>";
    } else {
        $revenueHead_id = test_input($_POST['revenueHead_id']);
    }

    if (empty($_POST['unit'])) {
        $errorUnit = "Unit is Required";
        $errorMessage .= $errorUnit . "<br/>";
    } else {
        $unit = test_input($_POST['unit']);
    }

    $reference = test_input($_POST['reference']);


    if ($_POST['price']) {
        if (empty($_POST['price'])) {
            $errorPrice = "Price of Product is Required";
            $errorMessage .= $errorPrice . "<br/>";
        } else {
            $price = test_input($_POST['price']);
            if (!is_numeric($price)) {
                $errorPrice = "Only Numbers are allowed for  Price";
                $errorMessage .= $errorPrice . "<br/>";
            }
        }
    }



    //    if (!$errorMessage) {
    $test->sync           = "off";
    $test->name           = $name;
    $test->revenueHead_id = $revenueHead_id;
    $test->unit_id        = $unit;
    $test->reference      = $reference;
    $test->price          = $price;
    //   $test->price          = 1;
    $test->created_by     = "";
    $test->date_created   = strftime("%Y-%m-%d %H:%M:%S", time());
    $test->date_modified  = strftime("%Y-%m-%d %H:%M:%S", time());
    if ($test->save()) {
        $done = TRUE;
        $session->message("Test has been successfully updated");
        redirect_to('depts.php');
    }
    //  }


    if ($errorMessage) {
        $panelClass = 'panel-danger';
        $panelHeader = '<div class="panel-heading"><h3 class="panel-title">Please correct the errors in the form<br></h3> class=
                          "panel-title alert alert-danger">' . $errorMessage . '</h3> </div>';
    }
}


require('../layout/header.php');
?>




    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Revenue Department</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Revenue </li>
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
                                        <a href="depts.php" style="font-size: large">&laquo; Back</a>
                                        <ul class="nav nav-tabs-new">
                                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Profile-new">Edit Revenue </a></li>
                                        </ul>
                                        <div class="tab-content">

                                            <div class="tab-pane" id="Profile-new">
                                                <h6>Edit Revenue </h6>
                                                <form id="basic-form" action="" method="post">
                                                    <div class="form-group">
                                                        <!--    <label>Drug Name</label>  -->
                                                        <input type="text" class="form-control" style="width: 350px"
                                                               name="name" placeholder="Revenue Name"
                                                               value="<?php echo $test->name ?>" required>
                                                    </div>


                                                    <div class="form-group">
                                                        <!--   <label>Brand Name</label>  -->
                                                        <select class="form-control" style="width: 350px;" id="revenueHead_id" name="revenueHead_id" required>
                                                            <?php
                                                            $finds = RevenueHead::find_all();
                                                            foreach ($finds as $find) { ?>
                                                                <option <?php echo $find->id == $test->revenueHead_id ?
                                                                    'selected' : ''; ?> value="<?php echo $find->id; ?>">
                                                                    <?php echo $find->revenue_name; ?></option>
                                                            <?php } ?>

                                                        </select>
                                                    </div>


                                                    <div class="form-group">
                                                        <!--    <label>Selling Price</label>  -->
                                                        <input type="text" class="form-control" style="width: 350px" name="reference" placeholder="Reference Range" value="<?php echo $test->reference ?>" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <!--    <label>Cost Price</label>  -->
                                                        <input type="text" class="form-control" style="width: 350px" name="price" placeholder="Price" value="<?php echo $test->price ?>" required>
                                                    </div>

                                                    <br>
                                                    <button type="submit" class="btn btn-primary">Save Revenue
                                                        <!-- Test --></button>
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
    </div>







<?php

require('../layout/footer.php');
