<?php

/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/1/2019
 * Time: 9:25 AM
 */
require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$usr = User::find_by_id($_GET['id']);

$user = User::find_by_id($session->user_id);



define("nl", "<br>");
$errMessage = '';
$password = $confirmPassword = '';
$errPassword = $errConfirmPassword = '';
$done = FALSE;

if (is_post()){

    $usr->delete();
    $session->message("A User has been deleted.");
    redirect_to("user.php");

}



require('../layout/header.php');
?>



    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>User Account</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="home.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">My Profile</li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="body">

                            <h5><a style="..." href="user.php"> << Back </a></h5>


                            <div class="tab-pane" id="modify">

                                <form id="basic-form" method="post" action="">
                                    <div class="card">

                                        <div class="body">
                                            <h4> Are you sure you want delete? </h4>
                                            <div class="row clearfix">

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>First Name</label>
                                                        <input type="text" class="form-control" name="first_name" value="<?php echo $usr->first_name ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Last Name</label>
                                                        <input type="text" class="form-control" name="last_name" value="<?php echo $usr->last_name ?>" required>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row clearfix">

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>User Name</label>
                                                        <input type="text" class="form-control" name="username" value="<?php echo $usr->username ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Department </label>
                                                        <input type="text" class="form-control" name="department" value="<?php echo $usr->department ?>" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix">

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>User Role</label>
                                                        <select class="form-control"  name="role">
                                                            <option value=""></option>
                                                            <option <?php echo ($usr->role == 'User') ? 'selected ="TRUE"' : ''; ?>
                                                                value="User">User
                                                            </option>
                                                            <option <?php echo ($usr->role == 'admin') ? 'selected ="TRUE"' : ''; ?>
                                                                value="admin">admin
                                                            </option>
                                                            <!--	<option  value="LAB HOD">LAB HOD</option>   -->
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">

                                                </div>
                                            </div>

                                            <div class="row clearfix">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <button type="submit" name="update_patient_record" class="btn btn-primary">Delete</button>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">

                                                </div>
                                                <div class="col-sm-4">

                                                </div>

                                            </div>

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
