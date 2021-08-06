<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/16/2019
 * Time: 1:30 PM
 */



require_once("../includes/initialize.php");
$user = User::find_by_id($session->user_id);

$message = "";
$done = FALSE;

$index = 1;


$emergencies = Emergency::find_all();




if (is_post()) {




}


require('../layout/header.php');
?>




    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Emergency Department </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item"> Emergency </li>
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
                                        <ul class="nav nav-tabs-new">
                                            <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#Home-new"> Emergency Records </a></li>
                                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Profile-new">Add New Record </a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane show active" id="Home-new">
                                                <h6> Emergency Records </h6>
                                                <div class="table-responsive">
                                                    <table class="table no-margin">
                                                        <thead>
                                                        <tr>
                                                            <th>Emergency No.</th>
                                                            <th>Folder No.</th>
                                                            <th>Gender</th>
                                                            <th>Registered By</th>
                                                            <th>Date </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php foreach($emergencies as $emergency) {   ?>
                                                            <tr>                                               
                                                                <td><a href="em_dash.php?id=<?php echo $emergency->id ?>"><?php echo $emergency->emergency_no; ?></a></td>
                                                                <td><?php echo $emergency->folder ?></td>
                                                                <td><?php echo $emergency->gender; ?></td>
                                                                <td><?php echo $emergency->officer; ?></td>

                                                                <td><?php $d_date = date('d/m/Y h:i a', strtotime($emergency->date)); echo $d_date; ?></td>
                                                            </tr>
                                                        <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="Profile-new">
                                                <h6>Add New Revenue </h6>
                                                <form id="basic-form" action="" method="post">

                                                    <div class="form-group">
                                                        <!--   <label>Brand Name</label>  -->
                                                        <select class="form-control" style="width: 350px" id="gender" name="gender" required>
                                                            <option value="">--Select Patient Gender--</option>
                                                            <option value="Female">Female</option>
                                                            <option value="Male">Male</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <!--   <label>Brand Name</label>  -->
                                                        <input class="form-control" style="width: 350px" name="folder" placeholder="Folder Number" required />
                                                    </div>


                                                    <br>
                                                    <button type="submit" class="btn btn-primary"> Save Information <!-- Test --></button>
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


