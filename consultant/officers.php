<?php
require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}


$index = 1;

//$users = User::find_all();

$department = "Consultancy";
$users = User::find_by_department($department);

require('../layout/header.php');
?>


<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Consultant </h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo emr_lucid ?>/home.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item"> Consultant </li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">

                    <div class="body">
                        <a href="index.php" style="font-size: large">&laquo; Back</a>
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
                                        <th>Role</th>
                                        <th>Clinics</th>
                                        <?php
                                        if (($user->role == 'admin') || ($user->role == 'Super Admin')) {
                                            ?>
                                            <th>Add clinic</th>
                                            <th></th>
                                            <th></th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $usr) {
                                        $userSubClinic = UserSubClinic::find_by_users($usr->id);
                                    ?>
                                        <tr>
                                            <td><?php echo $index++ ?></td>
                                            <td><span><?php echo  $usr->full_name() ?></span></td>
                                            <td><span class="text-info"><?php echo $usr->username ?></span></td>
                                            <td><span class="text-info"><?php echo $usr->role ?></span></td>
                                            <td> <?php
                                                    if (!empty($userSubClinic)) {
                                                        foreach ($userSubClinic as $u) {
                                                            $clinic = Clinic::find_by_id($u->clinic_id);
                                                            echo $clinic->name . "<br/>";
                                                        }
                                                    } else {
                                                        echo "no clinic";
                                                    }


                                                    ?>
                                            </td>
                                            <?php
                                            if (($user->role == 'admin') || ($user->role == 'Super Admin')) {
                                                ?>
                                                <td><a href="add_clinic.php?id=<?php echo $usr->id ?>">add clinic</a></td>
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
