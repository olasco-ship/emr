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

$user = User::find_by_id($session->user_id);



define("nl", "<br>");
$errMessage = '';
$password = $confirmPassword = '';
$errPassword = $errConfirmPassword = '';
$done = FALSE;


if ($_SERVER["REQUEST_METHOD"] == "POST" && $user) {

    if (empty($_POST['old_password'])) {
        $errConfirmPassword = "Confirm password";
        $errMessage .= $errConfirmPassword . nl;
    } else {
        if ($_POST['old_password'] != $user->password ) {
            $errConfirmPassword = "Incorrect old password!";
            $errMessage .= $errConfirmPassword . nl;
        } else {
            $new_password = $_POST['new_password'];
        }
    }

    if (empty($_POST['new_password'])) {
        $errPassword = "New Password is Required";
        $errMessage .= $errPassword . nl;
    }

    if (strlen($_POST['new_password']) < 6) {
        $errPassword = "Password must have a minimum of 6 characters!";
        $errMessage .= $errPassword . nl;
    } else {
        $new_password = $_POST['new_password'];
    }


    if (empty($_POST['confirm_password'])) {
        $errConfirmPassword = "Confirm password";
        $errMessage .= $errConfirmPassword . nl;
    } else {
        if ($_POST['new_password'] != $_POST['confirm_password']) {
            $errConfirmPassword = "New Password & Old Password did not match!";
            $errMessage .= $errConfirmPassword . nl;
        } else {
            $new_password = $_POST['new_password'];
        }
    }
    // $password_hash = hash('md5',$password);

    if (empty($errMessage)) {
        $user->password = $new_password;
        $user->save();
        $done = TRUE;
    } else {
        $panelClass = 'panel-danger';
        $panelHeader = '<div class="panel-heading"><h3 class="panel-title">Please correct the errors in the form<br></h3> class=
                              "panel-title alert alert-danger">' . $errMessage . '</h3> </div>';
    }
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


                        <div class="tab-pane" id="modify">

                            <form id="basic-form" method="post" action="">
                                <div class="card">

                                    <div class="body">
                                        <h4>Basic Details </h4>
                                        <div class="row clearfix">

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>First Name</label>
                                                    <input type="text" class="form-control" name="first_name" value="<?php echo $user->first_name ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Last Name</label>
                                                    <input type="text" class="form-control" name="last_name" value="<?php echo $user->last_name ?>" required>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row clearfix">

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>User Name</label>
                                                    <input type="text" class="form-control" name="username" value="<?php echo $user->username ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Department </label>
                                                    <input type="text" class="form-control" name="department" value="<?php echo $user->department ?>" required>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <hr />

                                    <div class="body">
                                        <h4> Password Settings </h4>
                                        <?php if ($done == TRUE) { ?>
                                            <div class="alert alert-success alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                Your password has been changed!
                                            </div>
                                        <?php } else if (empty($errMessage) == FALSE and isset($errMessage)) {
                                        ?>
                                            <div class="alert alert-warning alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <?php echo $errMessage; ?>
                                            </div>
                                        <?php
                                        } ?>
                                        <div class="row clearfix">

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Current Password</label>
                                                    <input type="password" class="form-control" name="old_password" minlength="6" value="<?php echo $old_password ?>" required>
                                                </div>
                                            </div>


                                        </div>

                                        <div class="row clearfix">

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>New Password</label>
                                                    <input type="password" class="form-control" name="new_password" minlength="6" value="<?php echo $new_password ?>" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix">

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label> Confirm Password </label>
                                                    <input type="password" class="form-control" name="confirm_password" minlength="6" value="<?php echo $confirm_password ?>" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <button type="submit" name="update_patient_record" class="btn btn-primary">Update Password</button>
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
