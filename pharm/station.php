<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/2/2019
 * Time: 11:40 AM
 */

require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$index = 1;

$finds = PharmacyStation::find_all_station_by_name();
$index = 1;


if(is_post()){
    if ($_POST['name']) {
        if (empty($_POST['name'])) {
            $errorName= "Brand Name is Required";
            $errorMessage .= $errorName . "<br/>";
        } else {
            $name = test_input($_POST['name']);
            //  if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
            //      $errorName = "Only letters and white space are allowed for Category Name";
            //      $errorMessage .= $errorName . "<br/>";
            //  }
        }
    }

    if ((!$errorMessage) and empty($errorMessage)){
        $station = new PharmacyStation();
        $station->name = $name;
        $station->created = strftime("%Y-%m-%d %H:%M:%S", time());
        if ($station->create()){
            $done = TRUE;
            $session->message("A new Dispensary has been created.");
            redirect_to('station.php');
        } else {
            $done = FALSE;
            $session->message("Could not create a new Dispensary.");

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
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>
                        Dispensary Pharmacy</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo emr_lucid ?>/pharmacy/storage.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Pharmacy</li>
                        <li class="breadcrumb-item active">Dispensary</li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-4 col-sm-12 text-right">
                    <div class="bh_chart hidden-xs">
                        <div class="float-left m-r-15">
                            <small>Visitors</small>
                            <h6 class="mb-0 mt-1"><i class="icon-user"></i> 1,784</h6>
                        </div>
                        <span class="bh_visitors float-right">2,5,1,8,3,6,7,5</span>
                    </div>
                    <div class="bh_chart hidden-sm">
                        <div class="float-left m-r-15">
                            <small>Visits</small>
                            <h6 class="mb-0 mt-1"><i class="icon-globe"></i> 325</h6>
                        </div>
                        <span class="bh_visits float-right">10,8,9,3,5,8,5</span>
                    </div>
                    <div class="bh_chart hidden-sm">
                        <div class="float-left m-r-15">
                            <small>Chats</small>
                            <h6 class="mb-0 mt-1"><i class="icon-bubbles"></i> 13</h6>
                        </div>
                        <span class="bh_chats float-right">1,8,5,6,2,4,3,2</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <!-- <h2>Basic Example 8</h2>-->
                    </div>
                    <div class="body">

                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <!--                                    <div class="header">
                                                                        <h2>Example Tab 2 <small><code class="highlighter-rouge">.nav-tabs-new</code></small></h2>
                                                                    </div>-->
                                <div class="body">

                                <a href="storage.php">Back</a>

                                    <ul class="nav nav-tabs-new">
                                        <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#Home-new"> Dispensaries </a></li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Profile-new">Add New Dispensary</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane show active" id="Home-new">
                                            <h3 class="heading"> Dispensaries </h3>
                                            <div class="table-responsive">
                                                <table class="table no-margin">
                                                    <thead>
                                                    <tr>
                                                        <th>S/N</th>
                                                        <th> Dispensary </th>
                                                        <th>Date Added</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php foreach($finds as $find) {   ?>
                                                        <tr>
                                                            <td><?php echo $index++; ?></td>
                                                            <td> <a href="drugs.php?id=<?php echo $find->id ?>"> <?php echo $find->name; ?> </a> </td>
                                                            <td><?php $d_date = date('d/m/Y h:i a', strtotime($find->created)); echo $d_date; ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="Profile-new">
                                            <h3 class="heading"> Add New Dispensary</h3>
                                            <form action="" method="post">

                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <input class="form-control" name="name" placeholder="Dispensary Name" style="width: 300px"
                                                               type="text">
                                                        <button type="submit" class="btn btn-primary">Save </button>
                                                    </div>
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























<?php

require('../layout/footer.php');