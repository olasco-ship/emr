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

$user = User::find_by_id($session->user_id);

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
        $revenue_head->sync          = "off";
        $revenue_head->revenue_code  = "";
        $revenue_head->revenue_name  = $revenue_name;
        $revenue_head->created_by    = $user->full_name();
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
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Account & Revenue </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Revenue Head</li>
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

                                    <a href="../revenue/home.php" style="font-size: large">&laquo; Back</a>
                                        <ul class="nav nav-tabs-new">
                                            <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#Home-new">Revenue Heads</a></li>
                                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Profile-new">Add Revenue Heads</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane show active" id="Home-new">
                                                <h6>RevenueHead</h6>
                                                <div class="table-responsive">
                                                    <table class="table no-margin">
                                                        <thead>
                                                        <tr>
                                                            <th>S/N</th>
                                                            <th>RevenueHead </th>
                                                            <th>Date Added</th>
                                                            <th> </th>
                                                            <th> </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php foreach($finds as $find) {   ?>
                                                            <tr>
                                                                <td><?php echo $index++; ?></td>
                                                                <td><a href="view_revenue.php?id=<?php echo $find->id; ?> "><?php echo $find->revenue_name; ?></a></td>
                                                              <!--  <td><?php /*echo $find->revenue_name; */?></td>-->
                                                                <td><?php $d_date = date('d/m/Y h:i a', strtotime($find->date_created)); echo $d_date; ?></td>
                                                                <td><a href="edit.php?id=<?php echo $find->id; ?> ">Edit</a></td>            
                                                                <td><a href="delete.php?id=<?php echo $find->id; ?> ">Delete</a></td>
                                                            </tr>
                                                        <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="Profile-new">
                                                <h6>Add New Revenue Heads</h6>
                                                <form action="" method="post">

                                                    <div class="input-group">
                                                        <input class="form-control" name="revenue_name" required placeholder="RevenueHead" style="width: 100px" type="text">
                                                        <button type="submit" class="btn btn-primary">Save RevenueHead</button>
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