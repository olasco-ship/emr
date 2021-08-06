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

$user = User::find_by_id($session->user_id);

$message = "";
$done = FALSE;

$index = 1;

$revenueHead_id = 2;  //Laboratory

$tests = Test::find_by_revenueHead_id($revenueHead_id);




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
    $test                 = new Test();
    $test->sync           = "off";
    $test->name           = $name;
    $test->revenueHead_id = $revenueHead_id;
    $test->unit_id        = $unit;
    $test->price          = $price;
    $test->created_by     = $user->full_name();
    $test->date_created   = strftime("%Y-%m-%d %H:%M:%S", time());
    $test->date_modified  = strftime("%Y-%m-%d %H:%M:%S", time());
    if ($test->save()) {
        $done = TRUE;
        $session->message("Investigations has been successfully uploaded");
        redirect_to('revenue.php');
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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Laboratory Department </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item"> Investigations </li>

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
                                        <a href="../lab/home.php" style="font-size: large">&laquo; Back</a>
                                        <ul class="nav nav-tabs-new">
                                            <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#Home-new"> Investigations </a></li>
                                            <?php
                                            if (($user->role == 'admin') || ($user->role == 'Super Admin')) {
                                                ?>
                                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Profile-new">Add Investigation </a></li>
                                            <?php } ?>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane show active" id="Home-new">
                                                <h6>Investigations</h6>
                                                <div class="table-responsive">
                                                    <table class="table no-margin">
                                                        <thead>
                                                        <tr>
                                                            <th>S/N</th>
                                                            <th> <!-- Test --> Investigations </th>
                                                            <th>Department</th>
                                                            <!--      <th>Unit</th>
                                                                  <th>Reference</th>-->
                                                            <th>Price</th>
                                                            <th>Date Added</th>
                                                            <?php
                                                            if (($user->role == 'admin') || ($user->role == 'Super Admin')) {
                                                                ?>
                                                                <th></th>
                                                                <th></th>
                                                            <?php } ?>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php foreach($tests as $test) {   ?>
                                                            <tr>
                                                                <td><?php echo $index++; ?></td>
                                                                <td><?php echo $test->name; ?></td>
                                                                <td><?php $revHead = RevenueHead::find_by_id($test->revenueHead_id); echo $revHead->revenue_name  ?></td>
                                                                <!--     <td><?php // $unit = Unit::find_by_id($test->unit_id); echo $unit->name ?></td>
                                                                <td><?php /*echo $test->reference; */?></td>-->
                                                                <td><?php echo '₦'.$test->price; ?></td>
                                                                <td><?php $d_date = date('d/m/Y h:i a', strtotime($test->date_created)); echo $d_date; ?></td>
                                                                <?php
                                                                if (($user->role == 'admin') || ($user->role == 'Super Admin')) {
                                                                    ?>
                                                                    <td><a href="edit_revenue.php?id=<?php echo $test->id ?>">Edit</td>
                                                                    <td><a href="delete_revenue.php?id=<?php echo $test->id ?>">Delete</td>
                                                                <?php }  ?>
                                                            </tr>
                                                        <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="Profile-new">
                                                <h6>Add New Investigations </h6>
                                                <form id="basic-form" action="" method="post">
                                                    <div class="form-group">
                                                        <!--    <label>Drug Name</label>  -->
                                                        <input type="text" class="form-control" style="width: 350px" name="name"
                                                               placeholder=" Investigations " value="<?php echo $name ?>" required>
                                                    </div>

                                                    <div class="form-group">

                                                        <select class="form-control" style="width: 350px" id="unit" name="unit">
                                                            <option value="">--Select Unit--</option>
                                                            <?php
                                                          //  $finds = Unit::find_all();
                                                            $finds = Unit::find_by_revenueHead_id(2);
                                                            foreach ($finds as $find) {
                                                                ?>
                                                                <option
                                                                        value="<?php echo $find->id; ?>"><?php echo $find->name; ?></option>
                                                                <?php
                                                                                                                }
                                                                                                                ?>
                                                        </select>
                                                    </div>



                                                    <input class="form-control" name="revenueHead_id" value="2" hidden>

                                                 <!--   <input class="form-control" name="unit" value="4" hidden>-->



                                                    <div class="form-group">
                                                        <!--    <label>Cost Price</label>  -->
                                                        <input type="text" class="form-control" style="width: 350px" name="price"
                                                               placeholder="Price" value="<?php echo $price ?>" required>
                                                    </div>

                                                    <br>
                                                    <button type="submit" class="btn btn-primary">Save Revenue <!-- Test --></button>
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


