<?php
require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}


$index = 1;

//$users = User::find_all();

$department = "ICT";

$users = User::find_by_department($department);

require('../layout/header.php');
?>


    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> ICT Department</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo emr_lucid ?>/home.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">ICT</li>
                            <!--<li class="breadcrumb-item active">User Records</li>-->
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
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <!-- <h2>Basic Example 1</h2>-->
                        </div>
                        <div class="body">
                            <a href="home.php" style="font-size: large">&laquo; Back</a>
                            <?php
                                    if (($user->role == 'admin') || ($user->role == 'Super Admin')) {
                                    ?>
                            <a href="create_users.php" style="font-size: large">| Create Users</a>
                                    <?php } ?>
                            <div class="table-responsive">
                                <table class="table m-b-0">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Department</th>
                                        <th>Date Registered</th>
                           
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