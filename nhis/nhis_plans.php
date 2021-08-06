<?php



require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$user = User::find_by_id($session->user_id);

$message = "";
$finds = nhisPlan::find_all();
$index = 1;

/*$val_year = 0;

$val_month = 0;

$cal_month = date('d/m/Y', strtotime('+2 months'));

$val_date = new DateTime($_POST['val_date']);
$val_date = date_format($val_date, 'Y-m-d');*/

if(is_post()) {
    if ($_POST['plan_name']) {
        if (empty($_POST['plan_name'])) {
            $errorName = " Plan name is Required";
            $errorMessage .= $errorName . "<br/>";
        } else {
            $plan_name = test_input($_POST['plan_name']);
        }
    }


    $val_month = test_input($_POST['val_month']);

    if ((!$errorMessage) and empty($errorMessage)) {
        $plan_names = new nhisPlan();
        $plan_names->sync = "off";
        $plan_names->plan_name = $plan_name;
        $plan_names->validity_months = $val_month;
        $plan_names->date_added = strftime("%Y-%m-%d %H:%M:%S", time());
        if ($plan_names->create()) {
            $done = TRUE;
            $session->message("A new plan name has been created.");
            redirect_to('#');
        } else {
            $done = FALSE;
            $session->message("Could not create a new plan name.");

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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Account & Revenue </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="nhis_plans.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Plan Names</li>
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

                                        <a href="home.php" style="font-size: large">&laquo; Back</a>
                                        <ul class="nav nav-tabs-new">
                                            <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#Home-new">Plan Names</a></li>
                                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Profile-new">Add Plan Name</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane show active" id="Home-new">
                                                <h6>NHIS Plan</h6>
                                                <div class="table-responsive">
                                                    <table class="table no-margin">
                                                        <thead>
                                                        <tr>
                                                            <th>S/N</th>
                                                            <th>Plan Names </th>
                                                            <th>Validity Month(s)</th>
                                                            <th>Date Added</th>
                                                            <th> </th>
                                                            <th> </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php foreach($finds as $find) { ?>
                                                            <tr>
                                                                <td><?php echo $index++; ?></td>
                                                                <td><a href="#"><?php echo $find->plan_name; ?></a></td>
                                                                <td><a href="#"><?php echo $find->validity_months; ?></a></td>
                                                                <td><?php $d_date = date('d/m/Y h:i a', strtotime($find->date_added));echo $d_date; ?></td>
                                                                <td><a href="edit_nhis_plan.php?id=<?php echo $find->id; ?> ">Edit</a></td>
                                                                <td><a href="delete_nhis_plan.php?id=<?php echo $find->id; ?> ">Delete</a></td>
                                                            </tr>
                                                        <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="Profile-new">
                                                <h6>Add New Plan Name</h6>
                                                <form action="" method="post">

                                                    <div class="form-group">
                                                        <input class="form-control" name="plan_name" id="plan_name" placeholder="Plan Name" type="text" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Number of Month"
                                                               name="val_month" id="val_month" value="" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary">Save Plan Name</button>
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
        </div>
    </div>







<?php

require('../layout/footer.php');
