<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/2/2019
 * Time: 11:40 AM
 */

require_once("../includes/initialize.php");

$index = 1;

$finds = Category::find_all_order_by_name();
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
        $category = new Category();
        $category->sync = "off";
        $category->name = $name;
        $category->created = strftime("%Y-%m-%d %H:%M:%S", time());
        if ($category->create()){
            $done = TRUE;
            $session->message("A new Brand has been created.");
            redirect_to('index.php');
        } else {
            $done = FALSE;
            $session->message("Could not create a new Brand.");

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
                            Brand Of Drugs</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo emr_lucid ?>/pham/storage.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Pharmacy</li>
                            <li class="breadcrumb-item active">Drugs</li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">

                        <div class="body">

                            <div class="col-lg-12 col-md-12">
                                <div class="card">

                                    <div class="body">
                                        <ul class="nav nav-tabs-new">
                                            <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#Home-new">Brand Of Drugs</a></li>
                                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Profile-new">Add New Brands</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane show active" id="Home-new">
                                                <h3 class="heading">Brand Of Drugs</h3>
                                                <div class="table-responsive">
                                                    <table class="table no-margin">
                                                        <thead>
                                                        <tr>
                                                            <th>S/N</th>
                                                            <th>Brand Name</th>
                                                            <th>Date Added</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php foreach($finds as $find) {   ?>
                                                            <tr>
                                                                <td><?php echo $index++; ?></td>
                                                                <td><?php echo $find->name; ?></td>
                                                                <td><?php $d_date = date('d/m/Y h:i a', strtotime($find->created)); echo $d_date; ?></td>
                                                            </tr>
                                                        <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="Profile-new">
                                                <h3 class="heading"> Add New Brand Of Drug</h3>
                                                <form action="" method="post">

                                                    <div class="col-md-6">
                                                    <div class="input-group">
                                                        <input class="form-control" name="name" placeholder="Brand Name" style="width: 300px"
                                                               type="text">
                                                        <button type="submit" class="btn btn-primary">Save Brand</button>
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