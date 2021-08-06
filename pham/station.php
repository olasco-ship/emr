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


if (is_post()) {
    if ($_POST['name']) {
        if (empty($_POST['name'])) {
            $errorName = "Brand Name is Required";
            $errorMessage .= $errorName . "<br/>";
        } else {
            $name = test_input($_POST['name']);
            //  if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
            //      $errorName = "Only letters and white space are allowed for Category Name";
            //      $errorMessage .= $errorName . "<br/>";
            //  }
        }
    }

    if ((!$errorMessage) and empty($errorMessage)) {
        $station = new PharmacyStation();
        $station->sync = "off";
        $station->name = $name;
        $station->created = strftime("%Y-%m-%d %H:%M:%S", time());
        if ($station->create()) {
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
                        Storage </h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo emr_lucid ?>/pham/storage.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Dispensary Pharmacy</li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="row clearfix">

                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="body">

                            <a style="font-size: large;" href="storage.php">Back</a>

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
                                                <th></th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($finds as $find) {   ?>
                                                <tr>
                                                    <td><?php echo $index++; ?></td>
                                                    <td> <a href="drugs.php?id=<?php echo $find->id ?>"> <?php echo $find->name; ?> </a> </td>
                                                    <td><?php $d_date = date('d/m/Y h:i a', strtotime($find->created));
                                                        echo $d_date; ?></td>
                                                    <td><a href="disp_edit.php?id=<?php echo $find->id ?>">Edit</a></td>
                                                    <td><a href="disp_delete.php?id=<?php echo $find->id ?>">Delete</a></td>
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
                                                <input class="form-control" name="name" placeholder="Dispensary Name" style="width: 300px" type="text">
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





<?php

require('../layout/footer.php');
