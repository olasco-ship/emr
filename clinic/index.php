<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/16/2019
 * Time: 1:52 PM
 */



require_once("../includes/initialize.php");

$index = 1;

$finds = Clinic::find_all();


if(is_post()){
    if ($_POST['name']) {
        if (empty($_POST['name'])) {
            $errorName= "Clinic is Required";
            $errorMessage .= $errorName . "<br/>";
        } else {
            $name = test_input($_POST['name']);
        }
    }


    if ((!$errorMessage) and empty($errorMessage)){
        $clinic              = new Clinic();
        $clinic->sync        = "off";
        $clinic->name        = $name;
        $clinic->date        = strftime("%Y-%m-%d %H:%M:%S", time());
        if ($clinic->create()){
            $done = TRUE;
            $session->message("A new Clinic has been created.");
            redirect_to('index.php');
        } else {
            $done = FALSE;
            $session->message("Could not create a new Clinic.");

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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Hospitals</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Clinics </li>
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
                                        <a href="../nursing/home.php" style="font-size: large">&laquo; Back</a>
                                        <ul class="nav nav-tabs-new">
                                            <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#Home-new"> Clinics </a></li>
                                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Profile-new">Add Clinics </a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane show active" id="Home-new">
                                                <h6>Clinic</h6>
                                                <div class="table-responsive">
                                                    <table class="table no-margin">
                                                        <thead>
                                                        <tr>
                                                            <th>S/N</th>
                                                            <th>Clinic</th>
                                                            <th>Date Added</th>
                                                            <th></th>
                                                            <th></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php foreach($finds as $find) {   ?>
                                                            <tr>
                                                                <td><?php echo $index++; ?></td>
                                                                <td><?php echo $find->name; ?></td>
                                                                <td><?php $d_date = date('d/m/Y h:i a', strtotime($find->date)); echo $d_date; ?></td>
                                                                <td><a href="edit_clinic.php?id=<?php echo $find->id; ?> ">Edit</a> </td>
                                                                <td><a href="delete_clinic.php?id=<?php echo $find->id; ?>">Delete</a> </td>
                                                            </tr>
                                                        <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="Profile-new">
                                                <h6>Add New Clinic </h6>
                                                <form action="" method="post">

                                                    <div class="input-group">
                                                        <input class="form-control" name="name" placeholder="Clinic" style="width: 300px" type="text" required>
                                                        <button type="submit" class="btn btn-primary">Save Clinic</button>
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