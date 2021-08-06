<?php
require_once("../includes/initialize.php");


$index = 1;

$users = User::find_all();



require('../layout/header.php');
?>


    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> User Records</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo emr_lucid ?>/home.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Users</li>
                            <li class="breadcrumb-item active">User Records</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                           <!-- <h2>Basic Example 1</h2>-->
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table m-b-0">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Department</th>
                                        <th>Date Registered</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php  foreach($users as $user) {   ?>
                                    <tr>
                                        <td><?php echo $index++ ?></td>
                                        <td><span><?php echo $user->full_name() ?></span></td>
                                        <td><span class="text-info"><?php echo $user->username ?></span></td>
                                        <td><?php echo $user->department ?></td>
                                        <td><?php $d_date = date('d/m/Y h:i a', strtotime($user->date)); echo $d_date ?></td>
                                        <td><span class="badge badge-success">Admit</span></td>
                                    </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


        </div>
    </div>





<?php

require('../layout/footer.php');