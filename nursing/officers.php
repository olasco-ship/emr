<?php
require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$index = 1;

$user = User::find_by_id($session->user_id);

$department = "Nursing";

$users = User::find_by_department($department);


require('../layout/header.php');
?>


    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Nursing Department </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo emr_lucid ?>/home.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item"> Nurses </li>
                            <!--<li class="breadcrumb-item active">User Records</li>-->
                        </ul>
                    </div>

                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">

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
                                        <th>Username</th>
                                        <th>Name</th>
                                        <th>Clinic/Ward</th>
                                       <!-- <th>Department</th>
                                        <th>Date Registered</th> -->
                                        <th>Role</th>
                                        <?php
                                        if (($user->role == 'admin') || ($user->role == 'Super Admin')) {
                                            ?>
                                            <th>Add clinic/Ward</th>
                                            <th></th>
                                            <th></th>
                                        <?php } ?>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php  foreach($users as $usr) {   ?>
                                        <tr>
                                            <td><?php echo $index++ ?></td>
                                            <td><span class="text-info"><a href="add_clinic.php"><?php echo $usr->username ?></a> </span></td>
                                            <td><span><?php echo $usr->full_name() ?></span></td>
                                            <td><?php //  echo $usr->id;
                                                if($usr->ward_id == 1){
                                                    //echo $user->ward_id;
                                                    $wardName = UserMultiWards::find_by_user_id($usr->id);
                                                 //   print_r($wardName); //die;
                                                    foreach($wardName as $wName){
                                                        echo $wName->ward_name;
                                                        echo "<br>";
                                                    }
                                                }else{
                                                    if (empty($usr->sub_clinic_id)) {
                                                        echo "no clinic/ward";
                                                    } else {
                                                        $sub_clinic = SubClinic::find_by_id($usr->sub_clinic_id);
                                                        $clinic = Clinic::find_by_id($sub_clinic->clinic_id);
                                                        echo $clinic->name ."/". $sub_clinic->name;
                                                    }
                                                }
                                                ?>
                                            </td>
                                            <td><?php  echo $usr->role ?></td>
                                            <!--<td><?php /*echo $user->department */?></td>
                                            <td><?php // $d_date = date('d/m/Y h:i a', strtotime($user->date)); echo $d_date ?></td>-->
                                            <?php
                                            if (($user->role == 'admin') || ($user->role == 'Super Admin')) {
                                                ?>
                                                <td><a href="add_clinic.php?id=<?php echo $usr->id ?>">add clinic/ward</a></td>
                                                <td><a href="edit_user.php?id=<?php echo $usr->id ?>">Edit</a> </td>
                                                <td><a href="delete_user.php?id=<?php echo $usr->id ?>">Delete</a>  </td>
                                            <?php } ?>
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